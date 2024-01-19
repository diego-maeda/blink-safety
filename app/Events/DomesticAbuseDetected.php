<?php

namespace App\Events;

use App\Http\Resources\LastIncidentResource;
use App\Models\Precinct;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Pusher\PushNotifications\PushNotifications;

/**
 * This event gets triggered by the Web scrapping, API pooling and Webservices and gets broadcast in the proper channel
 */
class DomesticAbuseDetected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Police department precinct
     * @var Precinct
     */
    protected Precinct $precinct;

    /**
     * The domestic violence case
     * @var LastIncidentResource
     */
    public LastIncidentResource $event;

    /**
     * Create a new event instance.
     * @param Precinct $precinct
     * @param LastIncidentResource $event
     * @throws \Exception
     */
    public function __construct(Precinct $precinct, LastIncidentResource $event)
    {
        $this->precinct = $precinct;
        $this->event = $event;

        // Create a browser notification for the web
        try {
            $push_notifications = new PushNotifications([
                "instanceId" => env('PUSHER_BEAMS_INSTANCE_ID'),
                "secretKey" => env('PUSHER_BEAMS_SECRET_KEY'),
            ]);

            $push_notifications = $push_notifications->publishToInterests(
                ['debug-' . $precinct->precinct, $precinct->precinct],
                ['web' => [
                    'notification' => [
                        'title' => 'A new domestic violence incident was detected',
                        'body' => 'Near ' . $event->display_address,
                        'icon' => 'https://blink-safety.com/build/assets/blink-safety-logo-312d4928.svg', //TODO ask Chris about this
                        'deep_link' => 'https://blink-safety.com/' . $precinct->state . '/' . str_replace(' ', '_', $precinct->city),
                        'hide_notification_if_site_has_focus' => true
                    ],
                    'data' => [
                        'some' => 'some',
                    ]
                ]
                ],
            );
        } catch (\Exception $exception) {
            Log::error($exception);
        }

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('police-department.' . $this->precinct->precinct),
        ];
    }
}
