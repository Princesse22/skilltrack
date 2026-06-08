<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur;

class FormateurController extends Controller
{
    public function registerFormateur(Request $request)
    {
        $request->validate([
            'nom'  => 'required|string',
            'telephone'   => 'required|string',
            'photo_profil'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo_diplome'  => 'required|image|mimes:jpeg,png,jpg,pdf|max:4096',
            'annees_experience' => 'required|integer|min:0',
            'bibliographie' => 'required|string',
            'date_naissance' => 'required|date',
        ]);

        $formateur = new Formateur();
        $formateur->user_id = auth()->id();
        $formateur->nom = $request->nom;
        $formateur->phone = $request->telephone;
        $formateur->annees_experience  = $request->annees_experience;
        $formateur->bibliographie = $request->bibliographie;
        $formateur->date_naissance  = $request->date_naissance;
        $formateur->statut  = 'pending';

        if ($request->hasFile('photo_profil')) {
            $formateur->photo_profil = $request->file('photo_profil')
                                               ->store('formateurs/images', 'public');
        }

        if ($request->hasFile('photo_diplome')) {
            $formateur->photo_diplome = $request->file('photo_diplome')
                                                ->store('formateurs/images', 'public');
        }

        $formateur->save();

        return redirect()->route('welcome')
                         ->with('success', 'Votre demande de formateur a été soumise. Elle sera examinée par l\'administration.');
    }
}
