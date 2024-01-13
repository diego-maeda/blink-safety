<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FixDatetimeToUTC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-datetime-to-u-t-c';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $events = Event::all();

            foreach ($events as $event) {
                $crime_date = Carbon::createFromDate($event->crime_date)->shiftTimezone('EST')->setTimezone('UTC');
                $event->update([
                    'crime_date' => $crime_date,
                    'crime_time' => $crime_date->format('H:i:s')
                ]);
            }

            $this->info('Command Sucessful');
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }
}
