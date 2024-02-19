<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'dashboard'], function ($dashboard) {
    $dashboard->get('/', [DashboardController::class, 'index'])->name('dashboard');
    $dashboard->get('/access-token', [DashboardController::class, 'getAccessToken'])->name('get-access-token');
    $dashboard->post('/access-token', [DashboardController::class, 'setAccessToken'])->name('set-access-token');
    $dashboard->delete('/access-token', [DashboardController::class, 'deleteToken'])->name('delete-access-token');
    $dashboard->get('/lamps', [DashboardController::class, 'getLamps'])->name('get-lamps');
    $dashboard->get('/set-lamp/{id}', [DashboardCOntroller::class, 'setLamp'])->name('set-lamp');
    $dashboard->get('/unset-lamp/{id}', [DashboardController::class, 'unsetLamp'])->name('unset-lamp');
})->middleware(['auth', 'verified']);


Route::get('/', [HomeController::class, 'city']);
Route::get('/{state}/{city}', [HomeController::class, 'city']);

Route::get('/test', [HomeController::class, 'test']);

Route::get('/v2', function () {
    return Inertia::render('Welcome');
});


/**
 * Profile
 * Personal information routes
 */
Route::get('/profile', [ProfileController::class, 'show'])->middleware(['auth'])->name('profile');
Route::post('/profile', [ProfileController::class, 'store'])->middleware(['auth'])->name('profile.change');

/**
 * Security routes
 */
Route::get('/security', [SecurityController::class, 'index'])->middleware(['auth'])->name('security');
Route::post('/password-change', [SecurityController::class, 'passwordChange'])->middleware(['auth'])->name('password.change');

require __DIR__ . '/auth.php';
