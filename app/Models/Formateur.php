<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formateur extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'telephone',
        'photo_profil',
        'photo_diplome',
        'annees_experience',
        'bibliographie',
        'date_naissance',
        'statut',
    ];
//un utilisateur peu avoir plusieurs formations dans la table formateur
        public function Users()
        {
            //un utilisateur peut
            return $this->belongsTo(Users::class);
        }

        public function formation()
        {
            //avoir plusieurs formations
            return $this->hasMany(Formation::class);
        }



}
