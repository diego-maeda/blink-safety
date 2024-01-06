<?php

namespace App\Http\Controllers;

use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;

use App\Models\Run;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $event = Event::where('precinct', '33705')->latest('crime_date')->first();
        $run = Run::where('precinct', '33705')->latest('created_at')->first();

        return Inertia::render('New', [
            'last_incident' => new LastIncidentResource($event),
            'last_run' => new LastRunResource($run),
        ]);
    }

    public function city($state, $city)
    {
        // Return the city and state requested
        $city = ucfirst($city);
        $state = strtoupper($state);

        $event = Event::where('precinct', '32803')->latest('crime_date')->first();
        $run = Run::where('precinct', '32803')->latest('created_at')->first();

        return Inertia::render('City', [
            'city' => $city,
            'state' => $state,
            'last_incident' => new LastIncidentResource($event),
            'last_run' => new LastRunResource($run),
        ]);
    }
}
