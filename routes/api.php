<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('first-test', function() {

    function rand_color(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }


    $color = rand_color();


    return response()->json([
        "rgb" => $color,
        "time" => "0.200",
        "status" => "fadeToRGB: $color t:0.200",
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
