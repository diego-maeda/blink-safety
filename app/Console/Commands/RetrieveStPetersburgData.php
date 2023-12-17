<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $start_date = Carbon::now()->subDays(10)->format('Y-m-d\TH:i:s');
            $end_date = Carbon::now()->format('Y-m-d\TH:i:s');

            $response = Http::withHeaders([
                'X-App-Token' => 'e4VAbacu29Rs5RFhaDtjwFtmB',
            ])->get("https://stat.stpete.org/resource/2eks-pg5j.json?\$where=crime_date between '$start_date' and '$end_date' AND starts_with(type_of_engagement, 'DOMESTIC')");

            if($response->ok()){
                dd($response->body());
            }

        } catch (\Exception $exception) {
            Log::error($exception);

        }
    }
}
