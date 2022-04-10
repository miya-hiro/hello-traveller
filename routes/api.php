<?php

use App\Http\Controllers\Api\TwitterController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//頭にapiがつく
Route::get('/tweets', [TwitterController::class, 'getTweets'])->name('getTweets');; //get-とかいらない
Route::get('/weather', [WeatherController::class, 'getWeather'])->name('getWeather'); //get-とかいらない

// Route::get('/tweets/{id}', [WeatherController::class, 'getTweet']); //get-とかいらない

// //もしpostするなら
// Route::post('/tweets', [WeatherController::class, 'storeTweets']); //get-とかいらない
// //もし削除するなら
// Route::delete('/tweets/{id}', [WeatherController::class, 'deleteTweet']); //get-とかいらない

// RESTful api 設計のプラクティス