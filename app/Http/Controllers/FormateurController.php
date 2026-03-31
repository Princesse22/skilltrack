<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Formateur;

class FormateurController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'nom' => 'required',
            'telephone' => 'required',
            'photo_profil' => 'nullable|image',
            'photo_diplome' => 'required|image',
            'annees_experience' => 'required|integer',
            'bibliographie' => 'required',
            'date_naissance' => 'required|date',
        ]);

        // Création
        $formateur = new Formateur();
        $formateur->user_id = auth()->id();
        $formateur->nom = $request->nom;
        $formateur->phone = $request->telephone;
        $formateur->annees_experience = $request->annees_experience;
        $formateur->bibliographie = $request->bibliographie;
        $formateur->date_naissance = $request->date_naissance;
        $formateur->statut = 'pending';

        // Gestion des photos
        if ($request->hasFile('photo_profil')) {
            $path = $request->file('photo_profil')->store('formateurs/images', 'public');
            $formateur->photo_profil = $path;
        }

        if ($request->hasFile('photo_diplome')) {
            $path = $request->file('photo_diplome')->store('formateurs/images', 'public');
            $formateur->photo_diplome = $path;
        }

        $formateur->save();

        return redirect()->route('welcome')->with('success', 'Votre demande a été soumise avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
