<?php

namespace App\Http\Controllers\Api;

use App\Models\User; // Per il modello User
use App\Models\Review; // Per il modello Review
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    // Ottenere le recensioni di un fornitore (utente)
    public function showReviews($id)
    {
        // Trova il fornitore (utente) per ID
        $provider = User::findOrFail($id);  // Trova l'utente (fornitore)

        // Ottieni tutte le recensioni per questo fornitore
        $reviews = $provider->reviews;  // La relazione è già definita nel modello User

        return response()->json($reviews);  // Ritorna le recensioni
    }

    // Creare una recensione
    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'user_id' => 'required|exists:users,id', 
            //non devo chiedere lo user_id all' utente è solo perchè non ho l'autenticazione con Sactum
        ]);

        $review = Review::create([
            'provider_id' => $validated['provider_id'],
            'user_id' => $validated['user_id'],
            //'user_id' => auth()->id(),  // L'ID dell'utente che sta scrivendo la recensione
            'content' => $validated['content'],
            'rating' => $validated['rating'],
        ]);

        return response()->json($review, 201);
    }
}
