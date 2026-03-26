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
