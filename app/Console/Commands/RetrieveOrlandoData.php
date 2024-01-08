<?php

namespace App\Console\Commands;

use App\Events\DatabaseUpdated;
use App\Events\DomesticAbuseDetected;
use App\Events\EmptyResultsDetected;
use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;
use App\Models\Run;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

            //'Domestic disturbance',
            foreach ($array['CALL'] as $incident) {
                // First we filter the cases for domestic disturbance
                if (in_array($incident['DESC'], ['Domestic disturbance'])) {

                    // Try to locate the event and make sure it's new
                    $db_event = Event::where(['event_id' => $incident['@attributes']['incident'], 'precinct' => '32803'])->first();

                    // If the event is new we store it
                    if (empty($db_event)) {
                        $this->event = Event::create([
                            'precinct' => '32803',
                            'event_id' => $incident['@attributes']['incident'],
                            'event_number' => $incident['@attributes']['incident'],
                            'type_of_engagement' => strtoupper($incident['DESC']),
                            'sub_engagement' => 'Unknown',
                            'classification' => 'Unknown',
                            'display_address' => $incident['LOCATION'],
                            'crime_date' => Carbon::createFromDate($incident['DATE']),
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
                DomesticAbuseDetected::dispatch('32803', new LastIncidentResource($this->event));
            // Otherwise we notify the UI to turn off the lights
            } else {
                EmptyResultsDetected::dispatch('32803');
            }

            // After we finish running we update the UI notifying to update the next run as well
            $run = Run::create([
                'precinct' => '32803',
                'command' => 'app:retrieve-orlando-data',
            ]);
            DatabaseUpdated::dispatch('32803', new LastRunResource($run));

            $this->info('Command Sucessful.');
        } catch (Exception $exception) {
            $this->error('Something went wrong.');
            Log::error($exception);
        }
    }
}
