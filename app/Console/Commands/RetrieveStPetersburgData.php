<?php

namespace App\Console\Commands;

use App\Events\DatabaseUpdated;
use App\Events\DomesticAbuseDetected;
use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;
use App\Models\Run;
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
     * This will store the last new event if any
     * @var ?Event $event | null
     */
    protected ?Event $event = null;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will retrieve the data from the St. Petersburg PD';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $start_date = Carbon::now()->subDay()->format('Y-m-d\TH:i:s');
            $end_date = Carbon::now()->format('Y-m-d\TH:i:s');

            Log::info('Start date: ' . $start_date);
            Log::info('End date: ' . $end_date);

            $new_events = 0;

            $response = Http::withHeaders([
                'X-App-Token' => 'e4VAbacu29Rs5RFhaDtjwFtmB',
            ])->get("https://stat.stpete.org/resource/2eks-pg5j.json?\$where=crime_date between '$start_date' and '$end_date' AND starts_with(type_of_engagement, 'DOMESTIC')");

            if ($response->ok()) {

                foreach ($response->json() as $event) {

                    // Try to locate the event and make sure it's new
                    $db_event = Event::where(['event_id' => $event['id'], 'precinct' => '33705'])->first();


                    // If the event is new we store it and create a new dispatch a new broadcast
                    if (empty($db_event)) {
                        $this->event = Event::create([
                            'precinct' => '33705',
                            'event_id' => $event['id'],
                            'event_number' => $event['event_number'],
                            'type_of_engagement' => $event['type_of_engagement'],
                            'sub_engagement' => $event['sub_engagement'],
                            'classification' => $event['classification'],
                            'display_address' => (array_key_exists('display_address', $event)) ? $event['display_address'] : 'No display address available.',
                            'crime_date' => $event['crime_date'],
                            'crime_time' => $event['crime_time'],
                            'latitude' => $event['latitude'],
                            'longitude' => $event['longitude'],
                            'neighborhood_name' => (array_key_exists('neighborhood_name', $event)) ? $event['neighborhood_name'] : '',
                            'council_district' => (array_key_exists('council_district', $event)) ? $event['council_district'] : '',
                            'event_subtype_type_of_event' => $event['event_subtype_type_of_event'],
                        ]);

                        $new_events++;
                    }
                }
            }


            // If any new events where created we retrieve the last one and update the UI broadcasting an event
            if($new_events > 0){
                DomesticAbuseDetected::dispatch('33705', new LastIncidentResource($this->event));
            }

            // After we finish running we update the UI notifying to update the next run as well
            $run = Run::create([
                'command' => 'app:retrieve-st-petersburg-data'
            ]);
            DatabaseUpdated::dispatch(new LastRunResource($run));


            $this->info('Command successful.');

        } catch (Exception $exception) {
            $this->info('Something went wrong.');
            Log::error($exception);
        }
    }
}
