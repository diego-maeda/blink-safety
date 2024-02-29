<?php

namespace App\Http\Controllers;

use App\Http\Requests\Security\PasswordChangeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

/**
 * This controller manages functionalities related to user security within the application,
 * specifically handling password changes.
 * @author Diego Maeda maeda.diego@gmail.com
 */
class SecurityController extends Controller
{
    /**
     * Renders the "Security" view using Inertia.js.
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Authenticated/Security');
    }

    /**
     * Processes user requests to change their password.
     * @param PasswordChangeRequest $request
     * @return RedirectResponse
     */
    public function passwordChange(PasswordChangeRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->update(['password' => Hash::make($request->new_password)]);

        return back();
    }
}
