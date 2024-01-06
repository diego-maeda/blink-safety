<?php

namespace App\Console\Commands;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Run;
use Illuminate\Console\Command;

class FixRunsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-runs-table';

    /**
     * The console command description.r
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Run::where('precinct', '')->chunk(100, function (Collection $runs) {
            foreach ($runs as $run) {
                if ($run->command == 'app:retrieve-st-petersburg-data') {
                    DB::table('runs')
                        ->where('id', $run->id)
                        ->update(['precinct' => '33705']);
                } else if ($run->command == 'app:retrieve-orlando-data') {
                    DB::table('runs')
                        ->where('id', $run->id)
                        ->update(['precinct' => '32803']);
                }
            }
        });
    }
}
