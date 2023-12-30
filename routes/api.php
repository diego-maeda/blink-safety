<?php

use App\Events\DomesticAbuseDetected;
use App\Http\Controllers\LatestController;
use App\Http\Controllers\PreviousController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('test-event', function () {
    DomesticAbuseDetected::dispatch('33705');
});

Route::get('/previous/{id}', [PreviousController::class, 'previous']);
Route::get('/latest/', LatestController::class);
