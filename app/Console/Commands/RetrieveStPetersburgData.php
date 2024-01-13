<?php

namespace App\Console\Commands;

use App\Events\DatabaseUpdated;
use App\Events\DomesticAbuseDetected;
use App\Events\EmptyResultsDetected;
use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;
use App\Models\Run;
use DateTimeZone;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 * This command will retrieve St. Petersburg data from time to time
 */
class RetrieveStPetersburgData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:retrieve-st-petersburg-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will retrieve the data from the St. Petersburg PD';

    /**
     * This will store the last new event if any
     * @var ?Event $event | null
     */
    protected ?Event $event = null;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $start_date = Carbon::now()->subDays(2)->format('Y-m-d\TH:i:s');
            $end_date = Carbon::now()->format('Y-m-d\TH:i:s');

            Log::info('Start date: ' . $start_date);
            Log::info('End date: ' . $end_date);

            $new_events = 0;

            $response = Http::withHeaders([
                'X-App-Token' => 'e4VAbacu29Rs5RFhaDtjwFtmB',
            ])->get("https://stat.stpete.org/resource/2eks-pg5j.json?\$where=crime_date between '$start_date' and '$end_date' AND starts_with(type_of_engagement, 'DOMESTIC')");

            if ($response->ok()) {

                foreach ($response->json() as $event) {

                    if(in_array($event['type_of_engagement'], ['DOMESTIC BRAWL', 'DOMESTIC BATTERY'])){
                        // Try to locate the event and make sure it's new
                        $db_event = Event::where(['event_id' => $event['id'], 'precinct' => '33705'])->first();

                        // If the event is new we store it and create a new dispatch a new broadcast
                        if (empty($db_event)) {

                            // The API will return something like 2024-01-11T11:56:33.000
                            // We create a new date, shift the timezone to the local time and then change it to UTC to standardize the database
                            $crime_date = Carbon::createFromDate($event['crime_date'])->shiftTimezone('EST')->setTimezone('UTC');

                            $this->event = Event::create([
                                'precinct' => '33705',
                                'event_id' => $event['id'],
                                'event_number' => $event['event_number'],
                                'type_of_engagement' => $event['type_of_engagement'],
                                'sub_engagement' => $event['sub_engagement'],
                                'classification' => $event['classification'],
                                'display_address' => (array_key_exists('display_address', $event)) ? $event['display_address'] : 'No display address available.',
                                'crime_date' => $crime_date,
                                'crime_time' => $crime_date->format('H:i:s'),
                                'latitude' => $event['latitude'],
                                'longitude' => $event['longitude'],
                                'neighborhood_name' => (array_key_exists('neighborhood_name', $event)) ? $event['neighborhood_name'] : '',
                                'council_district' => (array_key_exists('council_district', $event)) ? $event['council_district'] : '',
                                'event_subtype_type_of_event' => $event['event_subtype_type_of_event'],
                            ]);

                            // We update this counter to make sure only to broadcast one notification per run
                            $new_events++;
                        }
                    }
                }
            }


            // If any new events where created we retrieve the last one and update the UI broadcasting an event
            if($new_events > 0){
                DomesticAbuseDetected::dispatch('33705', new LastIncidentResource($this->event));
            // Otherwise we notify the UI to turn off the lights
            } else {
                EmptyResultsDetected::dispatch('33705');
            }

            // After we finish running we update the UI notifying to update the next run as well
            $run = Run::create([
                'precinct' => '33705',
                'command' => 'app:retrieve-st-petersburg-data'
            ]);
            DatabaseUpdated::dispatch('33705', new LastRunResource($run));


            $this->info('Command successful.');

        } catch (Exception $exception) {
            $this->error('Something went wrong.');
            Log::error($exception);
        }
    }
}
