<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitasTallerController;
use App\Http\Controllers\CitasClienteController;

// Rutas por defecto que traía Laravel

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas creadas por mí

// Nos llevan a página principal, sin sesión iniciada.
Route::get('/', function(){
    return view('index');
});

Route::get('/index', function(){
    return view('index');
});

// Rutas deben estar protegidas por el middleware de autenticación para asegurarte de que solo usuarios autenticados puedan acceder
Route::middleware(['auth'])->group(function () {
    // Ruta para el taller
    Route::get('/taller', [CitasTallerController::class, 'index'])->name('taller.index');

    // Ruta para el cliente
    Route::get('/cliente', [CitasClienteController::class, 'index'])->name('cliente.index');
    
    
    
    
    Route::get('/cliente/create', [CitasClienteController::class, 'create'])->name('cliente_create');
    
    Route::get('/cliente/show', [CitasClienteController::class, 'show'])->name('cliente_show');
    
    
    
    
    Route::get('/taller/show', [CitasTallerController::class, 'show'])->name('taller_show');
    
    Route::get('/taller/edit', [CitasTallerController::class, 'edit'])->name('taller_edit');
});








require __DIR__.'/auth.php';
