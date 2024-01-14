<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * This model is responsible for storing the last event triggered for a precinct.
 * This is used to disable all the blink(1) devices that turned on the last event
 * Obs.: No event here should be longer than 1 hour
 */
class LastEventTriggered extends Model
{
    use HasFactory;

    protected $table = 'last_events_triggered';

    protected $fillable = [
        'precinct_id',
        'event_id',
    ];

    /**
     * This is the precinct that the event is related to
     * @return BelongsTo
     */
    public function precinct(): BelongsTo
    {
        return $this->belongsTo(Precinct::class);
    }

    /**
     * This is the event which triggered the response
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
