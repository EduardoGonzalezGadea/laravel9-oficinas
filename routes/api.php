<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('api')->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'apiLogin']);
    Route::post('logout', [AuthController::class, 'apiLogout'])->middleware('auth:api');
});
