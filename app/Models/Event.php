<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model used to store the events in the database
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'precinct',
        'event_id',
        'event_number',
        'type_of_engagement',
        'sub_engagement',
        'classification',
        'display_address',
        'crime_date',
        'latitude',
        'longitude',
        'neighborhood_name',
        'council_district',
        'event_subtype_type_of_event'
    ];


}
