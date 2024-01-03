<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * This is the model that stores the last run in of the commands that verify the events on police departments
 */
class Run extends Model
{
    use HasFactory;

    protected $fillable = [
        'command',
    ];
}
