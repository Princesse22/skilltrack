<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation; // ✅ IMPORT MANQUANT

class AdminController extends Controller
{
    // ✅ Voir le détail d'une formation
    public function voirFormation($id)
    {
        $formation = Formation::with('user')->findOrFail($id);
        return view('admin.formation-detail', compact('formation'));
        // ✅ Nom de vue corrigé : 'formation-detail' et non 'formation.detail'
    }

    // ✅ Valider une formation
    public function valideFormation(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $formation->statut = 'validee';
        $formation->save();

        // Passer le rôle de l'utilisateur à 'formateur'
        $formation->user->role = 'formateur';
        $formation->user->save();

        return redirect()->back()->with('success', 'Formation validée ! Le formateur peut maintenant ajouter son contenu.');
    }

    // ✅ Rejeter une formation
    public function rejeterFormation($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->statut = 'rejetee';
        $formation->save();

        return redirect()->back()->with('error', 'Formation rejetée.');
    }

    // ✅ Accès à l'éditeur de formation (formateurs seulement)
    public function ajouterContenuFormation()
    {
        if (auth()->user()->role !== 'formateur') {
            return redirect()->route('welcome')
                ->with('error', 'Vous devez être formateur pour ajouter une formation.');
        }

        return view('formations.editerformation');
    }
}
