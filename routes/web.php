<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::post('/login', [loginController::class, 'login']);
Route::get('/logout', [loginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index']);
    //user
    Route::get('/user', function () {
        return view('user');
    });
    //settings
    Route::get('/settings', function () {
        return view('settings');
    });
    Route::get('/stockcard', function () {
        return view('stockcard');
    });
});
