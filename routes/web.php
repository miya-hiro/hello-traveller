<?php

use App\Http\Controllers\WeatherController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', [WeatherController::class, 'index']);
Route::get('/get-ajax', [WeatherController::class, 'ajax']);

Route::get('/axios', [WeatherController::class, 'axiosIndex']);
Route::get('/get-axios', [WeatherController::class, 'axios']);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
