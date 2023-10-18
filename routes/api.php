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

Route::post('/login',[\App\Http\Controllers\API\V1\AuthController::class, 'login']);
Route::post('/register',[\App\Http\Controllers\API\V1\AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('/tasks', \App\Http\Controllers\API\V1\TaskController::class);
});

