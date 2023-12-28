<?php

use App\Events\DomesticAbuseDetected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('test-event', function(){
    DomesticAbuseDetected::dispatch('33705');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
