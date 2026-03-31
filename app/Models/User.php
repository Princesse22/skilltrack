<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'verification_code',
        'role',
        'is_verified',
        'code_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function formateur()
    {
        return $this->hasOne(Formateur::class);
    }

    public function estFormateur()
    {
        return $this->formateur && $this->formateur->statut === 'valide';
    }

    public function formations()
    {
        // Accéder aux formations via le formateur
        return $this->hasOneThrough(Formation::class, Formateur::class);
    }
}
