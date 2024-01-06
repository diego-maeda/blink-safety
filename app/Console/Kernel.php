<?php

namespace App\Console;

use App\Console\Commands\RetrieveOrlandoData;
use App\Console\Commands\RetrieveStPetersburgData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(RetrieveStPetersburgData::class)->everyFiveMinutes();
        $schedule->command(RetrieveOrlandoData::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
