<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // Prendo alcuni fornitori e clienti
        $providers = User::where('user_type', 'fornitore')->take(2)->get();
        $clients = User::where('user_type', 'cliente')->take(8)->get();

        foreach ($providers as $provider) {
            foreach ($clients as $client) {
                // Creo recensioni casuali per ogni fornitore da parte dei clienti
                Review::create([
                    'content' => 'Recensione casuale per il fornitore ' . $provider->name,
                    'rating' => rand(1, 5), // Assegno un voto casuale da 1 a 5
                    'user_id' => $client->id,
                    'provider_id' => $provider->id,
                ]);
            }
        }
    }
}
