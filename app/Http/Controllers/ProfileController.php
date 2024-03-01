<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

/**
 * This controller manages functionalities related to user profiles within the application.
 * @author Diego Maeda maeda.diego@gmail.com
 */
class ProfileController extends Controller
{
    /**
     * This method renders the user's profile view using the Inertia.js framework.
     * @return Response
     */
    public function show()
    {
        $language = auth()->user()->language;
        $notifications = auth()->user()->notification;

        return Inertia::render('Authenticated/Profile', [
            'user' => auth()->user(),
            'language' => $language,
            'notifications' => $notifications,
        ]);
    }

    /**
     * This method handles updating the user's profile information based on the provided request data.
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function store(ProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->file('photo')->storeAs('images', $request->user()->id . '.' . $request->file('photo')->getClientOriginalExtension(), 'public'),
        ]);

        return to_route('profile');
    }


    /**
     * This method handles user's account removal
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $user = auth()->user();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $user->delete();

        return to_route('index');
    }
}
