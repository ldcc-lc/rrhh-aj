<?php

use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Route;


Route::inertia('/', 'Welcome')->name('home');

//Route::inertia('/personas', [PersonaController::class, 'index'])->name('personas.index');
Route::get('/personas', [PersonaController::class, 'index'])
    ->name('personas.index');
Route::post('/personas', [PersonaController::class, 'store'])
    ->name('personas.store');
Route::put('/personas/{persona}', [PersonaController::class, 'update'])
    ->name('personas.update');
Route::patch('/personas/{persona}/inactivate', [PersonaController::class, 'inactivate'])
    ->name('personas.inactivate');
Route::patch('/personas/{persona}/activate', [PersonaController::class, 'activate'])
    ->name('personas.activate');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
