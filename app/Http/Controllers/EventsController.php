<?php

namespace App\Http\Controllers;

use App\Http\Resources\LastIncidentResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


/**
 * This controller handles API requests for retrieving previous and next incidents based on a
 * provided event ID and precinct.
 */
class EventsController extends Controller
{
    /**
     * Searches for the event with an ID less than the provided id within the same precinct.
     * @param Request $request
     * @return JsonResponse
     */
    public function findPrevious(Request $request): JsonResponse
    {
        try {
            $event = Event::where('id', '<', $request->id)
                ->where('precinct', '=', $request->precinct)
                ->orderBy('id', 'desc')->first();

            // If not found, returns a 404 response with a "Event not found" message.
            if (is_null($event)) {
                return response()->json(['message' => 'Event not found'], 404);
            }

            // If found, returns a JSON response containing the previous incident details as a
            // LastIncidentResource object.
            return response()->json([
                'last_incident' => new LastIncidentResource($event)
            ]);
        } catch (\Exception $exception) {
            Log::error($exception);
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }

    /**
     * Searches for the event with an ID greater than the provided id within the same precinct.
     * @param Request $request
     * @return JsonResponse
     */
    public function findNext(Request $request): JsonResponse
    {
        try {
            $event = Event::where('id', '>', $request->id)
                ->where('precinct', '=', $request->precinct)
                ->orderBy('id', 'asc')->first();

            // If not found, returns a 404 response with a "Event not found" message.
            if (is_null($event)) {
                return response()->json(['message' => 'Event not found'], 404);
            }

            // If found, returns a JSON response containing the next incident details as a LastIncidentResource object.
            return response()->json([
                'last_incident' => new LastIncidentResource($event)
            ]);
        } catch (\Exception $exception) {
            Log::error($exception);
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }


}
