<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * This model is responsible to store the precinct it's city and state
 */
class Precinct extends Model
{
    use HasFactory;

    protected $fillable = [
        'precinct',
        'city',
        'state',
        'link',
    ];

    /**
     * The users that subscribe to the role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
