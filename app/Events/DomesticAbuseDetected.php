<?php

namespace App\Events;

use App\Http\Resources\LastIncidentResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * This event gets triggered by the Web scrapping, API pooling and Webservices and gets broadcast in the proper channel
 */
class DomesticAbuseDetected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Police department zipcode
     * @string
     */
    protected string $pd_zipcode;

    /**
     * The domestic violence case
     * @var LastIncidentResource
     */
    public LastIncidentResource $event;

    /**
     * Create a new event instance.
     * @param string $pd_zipcode
     * @param LastIncidentResource$event
     */
    public function __construct(String $pd_zipcode, LastIncidentResource $event)
    {
        $this->pd_zipcode = $pd_zipcode;
        $this->event = $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('police-department.' . $this->pd_zipcode),
        ];
    }
}
