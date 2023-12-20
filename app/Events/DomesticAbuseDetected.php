<?php

namespace App\Events;

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
    public string $pd_zipcode;

    /**
     * Create a new event instance.
     */
    public function __construct($pd_zipcode)
    {
        $this->pd_zipcode = $pd_zipcode;
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
