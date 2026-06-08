<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    protected $table = 'formateurs'; 

    protected $fillable = [
        'user_id',
        'nom',
        'phone',
        'photo_profil',
        'photo_diplome',
        'annees_experience',
        'bibliographie',
        'date_naissance',
        'statut',
    ];

    // Un formateur appartient à un User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un formateur a plusieurs formations
    public function formations()
    {
        return $this->hasMany(Formation::class, 'user_id', 'user_id');
    }
}
