<?php

use App\Http\Controllers\Api\Chat\ApiContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('chats')->group(function () {
    Route::apiResource('contacts', ApiContactController::class);
});
