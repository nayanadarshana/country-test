<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('countries/get-all-countries', [\App\Http\Controllers\CallController::class, 'getAllCountries']);

Route::get('selected-country/{id}', [\App\Http\Controllers\CallController::class, 'getSelectedCountry']);

Route::get('selected-state/{id}', [\App\Http\Controllers\CallController::class, 'getSelectedState']);

Route::get('selected-city/{id}', [\App\Http\Controllers\CallController::class, 'getSelectedCity']);
