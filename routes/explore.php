<?php

use App\Http\Controllers\Api\Explore\ApiUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('explores')->group(function () {
    Route::apiResource('users', ApiUserController::class);
});
