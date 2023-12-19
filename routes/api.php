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
        "pattern"=> [
            "name" => "policeflash",
            "pattern" => "0,#FF0000,0.5,#0000FF,0.5",
            "playcount" =>  0,
            "playedColor" => "#000000",
            "playing" => false,
            "playpos" => 0,
        ],
        "status" => "pattern add",
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
