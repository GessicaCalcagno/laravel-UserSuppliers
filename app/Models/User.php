<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type', // Aggiunto
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Controllo dei ruoli
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isClient()
    {
        return $this->user_type === 'cliente';
    }

    public function isProvider()
    {
        return $this->user_type === 'fornitore';
    }

    //Recensioni ricevute
    public function reviews()
    {
        return $this->hasMany(Review::class, 'provider_id');
    }

}
