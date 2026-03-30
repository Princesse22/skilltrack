<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class users extends Authenticatable
{
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
    'password' => 'hashed',
    ];

}

class User extends Authenticatable
{
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
