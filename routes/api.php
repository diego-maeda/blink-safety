<?php

use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('test-event', function () {
    Artisan::call('app:test-broadcast-command');
});

Route::get('/find-event/{id}', [EventsController::class, 'find']);
