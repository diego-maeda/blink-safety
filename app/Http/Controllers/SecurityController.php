<?php

namespace App\Http\Controllers;

use App\Http\Requests\Security\passwordChangeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class SecurityController extends Controller
{
    public function index()
    {
        return Inertia::render('Authenticated/Security');
    }

    public function passwordChange(passwordChangeRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->update(['password' => Hash::make($request->new_password)]);

        return back();
    }
}
