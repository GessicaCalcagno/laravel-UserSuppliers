<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard route - solo per Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->middleware(['auth', 'verified', 'admin'])  // Admin può accedere
        ->name('dashboard');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->name('admin.')->group(function () {
    // User management - solo per Admin
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Provider routes
Route::middleware(['auth', 'verified', 'provider'])->group(function () {
    // Aggiungi qui le rotte specifiche per i fornitori, ad esempio per gestire il proprio profilo o altre funzionalità
    Route::get('/provider/dashboard', function () {
        return view('provider.dashboard');  // Assicurati di avere la vista provider.dashboard
    })->name('provider.dashboard');
});

// Client routes
Route::middleware(['auth', 'verified', 'client'])->group(function () {
    // Aggiungi qui le rotte specifiche per i clienti, ad esempio per lasciare recensioni
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');  // Assicurati di avere la vista client.dashboard
    })->name('client.dashboard');
});

require __DIR__ . '/auth.php';

