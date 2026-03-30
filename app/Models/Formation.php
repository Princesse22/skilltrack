<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'duree',
        'prix',
        'devise',
        'remuneration',
        'nombre_lecons',
        'programme',
        'langue',
        'image',
        'video',
    ];
public function formateur()  // Une formation appartient à un formateur
{
    return $this->belongsTo(Formateur::class, 'formateur_id');
}

}
