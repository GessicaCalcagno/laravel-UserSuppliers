<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'rating', 'user_id', 'provider_id'];

    public function user()
    {
        return $this->belongsTo(User::class); // Relazione con l'utente che ha scritto la recensione
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id'); // Relazione con il fornitore
    }
}

