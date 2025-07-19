<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    Route::post('iniciar-sesion', [AuthController::class, 'loginApi'])->name('api.login');
    Route::post('cerrar-sesion', [AuthController::class, 'logoutApi'])->middleware('auth:api')->name('api.logout');
    Route::post('refrescar', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::get('usuario', [AuthController::class, 'me'])->middleware('auth:api');
});
