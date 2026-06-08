<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = 'formations';

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'categorie',
        'niveau',
        'langue',
        'duree_lecon',
        'duree_totale',
        'nombre_lecons',
        'programme',
        'public_cible',
        'objectifs',
        'competences',
        'prerequis',
        'prix',
        'devise',
        'reduction',
        'type_remuneration',
        'partage_formateur',
        'score_minimum',
        'image',
        'video',
        'statut',
    ];

    protected $casts = [
        'competences' => 'array',
        'prerequis'   => 'array',
    ];

    // Une formation appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une formation appartient à un formateur (via user_id)
    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'user_id', 'user_id');
    }
}
