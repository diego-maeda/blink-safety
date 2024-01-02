<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Run extends Model
{
    use HasFactory;


    protected $fillable = [
        'command',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['next_update'];


    protected function nextUpdate():Attribute
    {
        return new Attribute(
            get: function(mixed $value, array $attributes){
                // Calculate when the next run should happen
                $next_run_expected_time = Carbon::createFromDate($attributes['created_at'])->addMinutes(5);

                // Calculate the difference between then and now
                return $next_run_expected_time->format('H:i:s');
            }
        );
    }





}
