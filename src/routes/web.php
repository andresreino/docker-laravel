<?php

use App\Http\Controllers\CitasTallerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TallerMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Crea de forma abreviada múltiples rutas: users.index, users.create, users.store... (las 7 por defecto)
    // Además, le aplicamos un middleware para que verifique que es usuario "taller"
    Route::resource('/users', UserController::class)->middleware(TallerMiddleware::class);
       
    Route::resource('/citas', CitasTallerController::class);





    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
