<?php

namespace App\Console\Commands;

use App\Events\DomesticAbuseDetected;
use Illuminate\Console\Command;

class TestBroadcastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-broadcast-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DomesticAbuseDetected::dispatch('33705');
    }
}
