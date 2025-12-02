<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Solo admin puede gestionar usuarios
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Admin y veterinario pueden gestionar mascotas y citas
Route::middleware(['auth', 'role:admin,veterinario'])->group(function () {
    Route::resource('pets', PetController::class);
    Route::resource('appointments', AppointmentController::class);
});

// Clientes solo ven su información
Route::middleware(['auth', 'role:cliente'])->prefix('client')->name('client.')->group(function () {
    Route::get('/my-pets', [ClientController::class, 'myPets'])->name('my-pets');
    Route::get('/my-appointments', [ClientController::class, 'myAppointments'])->name('my-appointments');
});