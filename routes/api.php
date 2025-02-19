<?php

use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Lista dei fornitori
Route::get('/providers', function () {
    // Ottengo tutti gli utenti con user_type 'fornitore'
    $providers = User::where('user_type', 'fornitore')->get();

    return response()->json($providers);
});

// Rotta per ottenere le recensioni di un fornitore (utente)
Route::get('/providers/{id}/reviews', [ReviewController::class, 'showReviews']);

// Rotta per creare una recensione
Route::post('/reviews', [ReviewController::class, 'store']);
