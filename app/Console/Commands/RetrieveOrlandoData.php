<?php

namespace App\Console\Commands;

use App\Events\DatabaseUpdated;
use App\Events\DomesticAbuseDetected;
use App\Events\EmptyResultsDetected;
use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;
use App\Models\LastEventTriggered;
use App\Models\Precinct;
use App\Models\Run;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * This is the command responsible for retrieving the data from orlando PD
 */
class RetrieveOrlandoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:retrieve-orlando-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will retrieve the data from the Orlando PD';

    /**
     * This will store the last new event if any
     * @var ?Event $event | null
     */
    protected ?Event $event = null;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //PD zipcode - 32803
        try {
            $xml = simplexml_load_file('https://www1.cityoforlando.net/opd/activecalls/activecadpolice.xml');
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            $new_events = 0;

            $precinct = Precinct::where(['precinct' => '32803'])->first();

            //'Domestic disturbance',
            foreach ($array['CALL'] as $incident) {
                // First we filter the cases for domestic disturbance
                if (in_array($incident['DESC'], ['Domestic disturbance'])) {

                    // Try to locate the event and make sure it's new
                    $db_event = Event::where(['event_id' => $incident['@attributes']['incident'], 'precinct' => $precinct->precinct])->first();

                    // If the event is new we store it
                    if (empty($db_event)) {

                        // The API will return something like 2024-01-11T11:56:33.000
                        // We create a new date, shift the timezone to the local time and then change it to UTC to standardize the database
                        $crime_date = Carbon::createFromDate($incident['DATE'])->shiftTimezone('EST')->setTimezone('UTC');

                        $this->event = Event::create([
                            'precinct' => $precinct->precinct,
                            'event_id' => $incident['@attributes']['incident'],
                            'event_number' => $incident['@attributes']['incident'],
                            'type_of_engagement' => strtoupper($incident['DESC']),
                            'sub_engagement' => 'Unknown',
                            'classification' => 'Unknown',
                            'display_address' => $incident['LOCATION'],
                            'crime_date' => $crime_date,
                            'crime_time' => $crime_date->format('H:i:s'),
                            'latitude' => 'Unknown',
                            'longitude' => 'Unknown',
                            'neighborhood_name' => 'Unknown',
                            'council_district' => $incident['DISTRICT'],
                            'event_subtype_type_of_event' => 'Unknown'
                        ]);

                        // We update this counter to make sure only to broadcast one notification per run
                        $new_events++;
                    }
                }
            }

            // If any new events where created we retrieve the last one and update the UI broadcasting an event
            if ($new_events > 0) {
                DomesticAbuseDetected::dispatch($precinct->precinct, new LastIncidentResource($this->event));
                LastEventTriggered::updateOrCreate([
                    'precinct_id' => $precinct->id
                ], [
                    'event_id' => $this->event->id,
                ]);
            }

            // After we finish running we update the UI notifying to update the next run as well
            $run = Run::create([
                'precinct' => $precinct->precinct,
                'command' => 'app:retrieve-orlando-data',
            ]);
            DatabaseUpdated::dispatch($precinct->precinct, new LastRunResource($run));

            $this->info('Command Sucessful.');
        } catch (Exception $exception) {
            $this->error('Something went wrong.');
            Log::error($exception);
        }
    }
}
