<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
