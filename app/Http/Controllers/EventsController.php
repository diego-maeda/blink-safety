<?php

namespace App\Http\Controllers;

use App\Http\Resources\LastIncidentResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class EventsController extends Controller
{
    public function findPrevious(Request $request): JsonResponse
    {
        try {
            $event = Event::where('id', '<', $request->id)
                ->where('precinct', '=', $request->precinct)
                ->orderBy('id','desc')->first();

            if(is_null($event)){
                return response()->json(['message' => 'Event not found'], 404);
            }

            return response()->json([
                'last_incident' => new LastIncidentResource($event)
            ]);
        } catch (\Exception $exception) {
            Log::error($exception);
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    public function findNext(Request $request): JsonResponse
    {
        try {
            $event = Event::where('id', '>', $request->id)
                ->where('precinct', '=', $request->precinct)
                ->orderBy('id','asc')->first();

            if(is_null($event)){
                return response()->json(['message' => 'Event not found'], 404);
            }

            return response()->json([
                'last_incident' => new LastIncidentResource($event)
            ]);
        } catch (\Exception $exception) {
            Log::error($exception);
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }


}
