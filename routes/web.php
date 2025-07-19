<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Grupo middleware web explícito
Route::middleware('web')->group(function () {
    // Ruta pública
    Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

    // Rutas de autenticación (solo para invitados)
    Route::middleware('guest')->group(function () {
        Route::get('/ingresar', [AuthController::class, 'showLoginForm'])->name('ingresar');
        Route::post('/ingresar', [AuthController::class, 'login'])->name('login.post');
    });

    // Rutas protegidas (solo para autenticados)
    Route::middleware('auth')->group(function () {
        Route::get('/panel', [HomeController::class, 'dashboard'])->name('panel');
        Route::post('/cerrar-sesion', [AuthController::class, 'logout'])->name('cerrar-sesion');
    });
});
