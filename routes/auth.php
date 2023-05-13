<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::post('sign-in', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('sign-out', [AuthController::class, 'logout']);
});
