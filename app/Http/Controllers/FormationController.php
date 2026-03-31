<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'duree' => 'required',
            'prix' => 'required|numeric',
            'devise' => 'required',
            'remuneration' => 'required|numeric|min:0|max:100',
            'nombre_lecons' => 'required|integer',
            'programme' => 'required',
            'langue' => 'required',
            'image' => 'required|image',
            'video' => 'nullable|url',  // ou 'nullable|file|mimes:mp4'
        ]);

        // Création
        $formation = new Formation();
        $formation->formateur_id = auth()->user()->formateur->id;  // Lier au formateur connecté
        $formation->titre = $request->titre;
        $formation->description = $request->description;
        $formation->duree = $request->duree;
        $formation->prix = $request->prix;
        $formation->devise = $request->devise;
        $formation->remuneration = $request->remuneration;
        $formation->nombre_lecons = $request->nombre_lecons;
        $formation->programme = $request->programme;
        $formation->langue = $request->langue;
        $formation->statut = 'pending';  // En attente de validation

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('formations/images', 'public');
            $formation->image = $path;
        }

        // Gestion de la vidéo (si fichier)
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('formations/videos', 'public');
            $formation->video = $path;
        } else {
            $formation->video = $request->video;  // Si c'est une URL
        }

        $formation->save();

        return redirect()->route('welcome')->with('success', 'Votre formation a été soumise avec succès. En attente de validation.');
    }

    public function formulaireValider()
    {
        //si l'utilisateur clic sur soummetre le formulaire, le statut devient en attente de validation
         

    }
}
