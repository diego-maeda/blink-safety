<?php

namespace App\Http\Controllers;

use App\Http\Resources\LastIncidentResource;
use App\Http\Resources\LastRunResource;
use App\Models\Event;
use App\Models\Run;
use Illuminate\Http\JsonResponse;


class EventsController extends Controller
{
    public function find($id): JsonResponse
    {
        $event = Event::where('id', $id)->first();

        return response()->json([
            'last_incident' => new LastIncidentResource($event)
        ]);
    }
}
