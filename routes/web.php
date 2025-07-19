<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Ruta de bienvenida
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Rutas de autenticación (para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/ingresar', [AuthController::class, 'showLoginForm'])->name('ingresar');
    Route::post('/ingresar', [AuthController::class, 'login'])->name('login.post');
});

// Rutas protegidas (para autenticados)
Route::middleware('auth')->group(function () {
    Route::post('/cerrar-sesion', [AuthController::class, 'logout'])->name('cerrar-sesion');
    Route::get('/panel', [HomeController::class, 'dashboard'])->name('panel');
});
