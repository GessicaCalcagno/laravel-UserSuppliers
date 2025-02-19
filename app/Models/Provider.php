<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends User
{
    use HasFactory;

    // id fornitore
    public function reviews()
    {
        return $this->hasMany(Review::class, 'provider_id');
    }
}
