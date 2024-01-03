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
    public function __invoke(): Response
    {
        $event = Event::latest('crime_date')->first();
        $run = Run::latest('created_at')->first();

        return Inertia::render('New', [
            'last_incident' => new LastIncidentResource($event),
            'last_run' => new LastRunResource($run),
        ]);
    }
}
