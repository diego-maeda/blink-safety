<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\NotificationRequest;
use App\Models\Notification;
use App\Models\Precinct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * This controller handles updating a user's preferred notification settings within the application.
 * @author Diego Maeda maeda.diego@gmail.com
 */
class NotificationController extends Controller
{
    /**
     * This method updates the user's preferred notification based on the provided request.
     * @param NotificationRequest $request
     * @return RedirectResponse
     */
    public function update(NotificationRequest $request): RedirectResponse
    {
        $user = auth()->user();

        Notification::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'email' => $request->email,
            'lifx_pd_st_petersburg' => $request->lifx_pd_st_petersburg,
            'lifx_pd_orlando' => $request->lifx_pd_orlando,
        ]);


        return to_route('profile');
    }
}
