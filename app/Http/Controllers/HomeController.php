<?php

namespace App\Http\Controllers;

use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;

use App\Models\Precinct;
use App\Models\Run;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
//    public function index(): Response
//    {
//        $event = Event::where('precinct', '33705')->latest('crime_date')->first();
//        $run = Run::where('precinct', '33705')->latest('created_at')->first();
//
//        return Inertia::render('New', [
//            'last_incident' => new LastIncidentResource($event),
//            'last_run' => new LastRunResource($run),
//        ]);
//    }

    public function city($state = null, $city = null): Response
    {
        // We need to decode the city to handle multiple word cities like St Petersburg.
        $city = urldecode($city);

        // Locate the first town
        $precinct = Precinct::where(['state' => $state, 'city' => $city])->first();

        // In case we don't find a precint we default to the first one [St. Petersburg]
        if($precinct == null){
            $precinct = Precinct::where('id', 1)->first();
        }

        // Return the city and state requested
        $city = ucwords($precinct->city);
        $state = strtoupper($precinct->state);

        $event = Event::where('precinct', $precinct->precinct)->latest('crime_date')->first();
        $run = Run::where('precinct', $precinct->precinct)->latest('created_at')->first();

        return Inertia::render('City', [
            'city' => $city,
            'state' => $state,
            'last_incident' => new LastIncidentResource($event),
            'last_run' => new LastRunResource($run),
        ]);
    }
}
