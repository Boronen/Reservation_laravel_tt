<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/airlines/create', [AirlineController::class, 'create']);
Route::get('/airlines/{airline}/edit', [AirlineController::class, 'edit']);
Route::apiResource('airlines', AirlineController::class);

Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{flight}', [FlightController::class, 'show']);
Route::put('/flights/{flight}', [FlightController::class, 'update']);
Route::post('/flights', [FlightController::class, 'store']);
Route::delete('/flights/{flight}', [FlightController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::post('/users', [UserController::class, 'store']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
