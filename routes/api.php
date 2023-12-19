<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('first-test', function() {

    function rand_color(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    return response()->json([
        "rgb" => rand_color(),
        "time" => "2.000",
        "status" => "fadeToRGB: no blink(1) detected",
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
