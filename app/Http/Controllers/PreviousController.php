<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PreviousController extends Controller
{
    public function previous($id)
    {
        $event = Event::where('id', $id)->first();

        return response()->json(['last_incident' => [
            'id' => $event->id,
            'since' => Carbon::createFromDate($event->crime_date)->diffForHumans(), // How long ago it happened
            'time' => Carbon::createFromDate($event->crime_date)->format('m/d/Y H:i:s'), // Crime date
            'type' => $event->type_of_engagement, // Type of crime
            'display_address' => $event->display_address, // Display address
        ]]);
    }
}
