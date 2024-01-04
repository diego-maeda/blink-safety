<?php

namespace App\Events;

use App\Http\Resources\LastRunResource;
use App\Models\Run;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * This event is used to signal de UI to update when we get
 */
class DatabaseUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public LastRunResource $run;

    /**
     * Create a new event instance.
     * @param LastRunResource $run
     */
    public function __construct(LastRunResource $run)
    {
        $this->run = $run;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('run'),
        ];
    }
}
