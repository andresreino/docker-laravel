<?php

use App\Http\Controllers\CocheController;
use App\Http\Controllers\ProductoController;
use App\Http\Middleware\TallerMiddleware;
use Illuminate\Support\Facades\Route;

// Aplicamos array de middlewares. Sólo usuarios autenticados pueden acceder a rutas de API
// y con throttle le indicamos que permita un máximo de 6 peticiones en 1 minuto.
// También se aplica middleware de rutas "web"
Route::middleware(['web', 'auth', 'throttle:6,1'])->group(function () {
    // Genera las rutas con los 5 métodos por defecto de una API (análogo a como hacemos con resource para CRUD)
    Route::apiResource('coches', CocheController::class);
});

// Ruta para devolver los coches que tiene un cliente y mostrarlos dinámicamente en vista create de Taller
// Antes la tenía con la protección de throttle, pero hacía que también contaran las peticiones de coches de usuario y saltaba límite muy rápido
Route::get('/coches-de-cliente/{cliente}', [CocheController::class, 'cochesPorCliente'])->middleware('web', 'auth', TallerMiddleware::class)->name('cliente.coches');