<?php

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

Route::prefix('admins')->group(function() {
    Route::post('login',[\App\Http\Controllers\AdminController::class,'login']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('dashboard', [\App\Http\Controllers\AdminController::class,'dashboard']);

        Route::apiResource('contacts', \App\Http\Controllers\ContactController::class);
        Route::get('user', [\App\Http\Controllers\AdminController::class,'me']);
        Route::patch('user', [\App\Http\Controllers\AdminController::class,'update']);
        Route::any('logout',  [\App\Http\Controllers\AdminController::class,'logout']);
    });
});

Route::prefix('clients')->group(function() {
    Route::post('login',[\App\Http\Controllers\ClientController::class,'login']);
    Route::post('register',[\App\Http\Controllers\ClientController::class,'create']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::apiResource('contacts', \App\Http\Controllers\ContactController::class);
        Route::get('user', [\App\Http\Controllers\ClientController::class,'me']);
        Route::patch('user', [\App\Http\Controllers\ClientController::class,'update']);
        Route::any('logout',  [\App\Http\Controllers\ClientController::class,'logout']);
    });
});
