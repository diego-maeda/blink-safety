<?php

namespace App\Console\Commands;

use App\Events\EmptyResultsDetected;
use App\Models\LastEventTriggered;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * This command is responsible for monitoring the last events database (Last events triggered)
 * and after the correct time has passed we're going to remove the registries from the database.
 */
class EventMonitorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:event-monitor-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor the last triggered events to turn off after one hour';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            // Select the last events that have more than one hour
            $last_events = LastEventTriggered::where('updated_at', '>=', Carbon::now()->subHour())->get();

            // Foreach event that we find that is with more than one hour since the last update we notify the UI to
            // update and delete.
            foreach ($last_events as $last_event) {
                EmptyResultsDetected::dispatch($last_event->precinct->precinct);
                $last_event->delete();
            }

        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
