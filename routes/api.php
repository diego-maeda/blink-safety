<?php

use App\Http\Controllers\PreviousController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::get('test-event', function () {
    Artisan::call('app:test-broadcast-command');
});

Route::get('/previous/{id}', [PreviousController::class, 'previous']);
