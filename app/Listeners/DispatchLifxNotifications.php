<?php

namespace App\Listeners;

use App\Events\DomesticAbuseDetected;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DispatchLifxNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DomesticAbuseDetected $event): void
    {
        $users = null;
        if ($event->precinct->precinct == '33705') {
            $users = User::has('apiTokens')->whereRelation('notification', 'lifx_pd_st_petersburg', true)->get();
        } elseif ($event->precinct->precinct == '32803') {
            $users = User::has('apiTokens')->whereRelation('notification', 'lifx_pd_orlando', true)->get();
        }

        if (!is_null($users)) {
            foreach ($users as $user) {
                $token = $user->apiTokens()->where(['service' => 'lifx'])->first();

                $lamps = $user->lamps()->where(['blink_safety_connected' => true])->get();

                foreach ($lamps as $lamp) {
                    Log::info('Lamp triggered id : ' . $lamp->lamp_id);
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token->access_token
                    ])->post('https://api.lifx.com/v1/lights/id:' . $lamp->lamp_id . '/effects/breathe', [
                        'color' => 'purple',
                        'from_color' => '#000000',
                        'period' => 1,
                        'cycles' => 4,
                        'persist' => false,
                        'power_on' => true,
                        'peak' => 0.5
                    ]);

                    Log::info($response->json());

                    Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token->access_token,
                    ])->post('https://api.lifx.com/v1/lights/id:' . $lamp->lamp_id . '/effects/off', [
                        'power_off' => true,
                    ]);
                }
            }
        }
    }
}
