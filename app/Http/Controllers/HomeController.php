<?php

namespace App\Http\Controllers;

use App\Models\Event;

use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $event = Event::latest('crime_date')->first();

        return Inertia::render('New', [
            'last_incident' => [
                'id' => $event->id,
                'since' => Carbon::createFromDate($event->crime_date)->diffForHumans() , // How long ago it happened
                'time' => Carbon::createFromDate($event->crime_date)->format('m/d/Y H:i:s'), // Crime date
                'type' => $event->type_of_engagement, // Type of crime
                'display_address' => $event->display_address, // Display address
            ]
        ]);
    }
}
