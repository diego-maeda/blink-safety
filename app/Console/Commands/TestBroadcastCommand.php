<?php

namespace App\Console\Commands;

use App\Events\DomesticAbuseDetected;
use App\Http\Resources\LastIncidentResource;
use App\Models\Event;
use App\Models\Precinct;
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
        $event = Event::first();
        $precinct = Precinct::where('precinct', 32803)->first();
        DomesticAbuseDetected::dispatch($precinct, new LastIncidentResource($event));
    }
}
