<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show()
    {
        Return Inertia::render('Authenticated/Profile');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->photo->storeAs('images', $user->id . '.jpg'),
        ]);


    }
}
