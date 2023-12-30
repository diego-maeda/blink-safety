<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Run;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LatestController extends Controller
{
    /**
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            $event = Event::latest('crime_date')->first();
            $run = Run::latest('created_at')->first();

            return response()->json([
                'last_incident' => [
                    'id' => $event->id,
                    'since' => Carbon::createFromDate($event->crime_date)->diffForHumans(), // How long ago it happened
                    'time' => Carbon::createFromDate($event->crime_date)->format('m/d/Y H:i:s'), // Crime date
                    'type' => $event->type_of_engagement, // Type of crime
                    'display_address' => $event->display_address, // Display address
                ],
                'last_run' => $run
            ]);
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }
}
