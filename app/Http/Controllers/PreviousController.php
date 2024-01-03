<?php

namespace App\Http\Controllers;

use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;
use App\Models\Run;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PreviousController extends Controller
{
    public function previous($id)
    {
        $event = Event::where('id', $id)->first();
        $run = Run::latest('created_at')->first();

        return response()->json([
            'last_incident' => new LastIncidentResource($event),
            'last_run' => new LastRunResource($run),
        ]);
    }
}
