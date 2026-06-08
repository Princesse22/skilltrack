<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    public function soumettreFormation(Request $request)
    {
        $request->validate([
            'f_titre'         => 'required|string|max:255',
            'f_categorie'     => 'required|string',
            'f_langue'        => 'required|string',
            'f_niveau'        => 'required|string',
            'f_desc_courte'   => 'required|string|max:500',
            'f_cover'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'f_video'         => 'nullable|url',
            'f_public'        => 'required|string',
            'f_objectifs'     => 'required|string',
            'f_nb_lecons'     => 'required|integer|min:1',
            'f_duree_lecon'   => 'required|string',
            'f_duree_totale'  => 'required|string',
            'plan_items'      => 'required|array|min:1',
            'plan_items.*'    => 'required|string',
            'f_score_min'     => 'nullable|integer|min:0|max:100',
            'f_type_prix'     => 'required|in:payante,gratuite',
            'f_prix'          => 'required_if:f_type_prix,payante|nullable|numeric|min:0',
            'f_devise'        => 'nullable|string',
            'f_reduction'     => 'nullable|integer|min:0|max:100',
            'f_remuneration'  => 'required|in:vente,partage',
            'f_partage'       => 'required_if:f_remuneration,partage|nullable|integer',
        ]);

        // Gestion image
        $imagePath = null;
        if ($request->hasFile('f_cover')) {
            $imagePath = $request->file('f_cover')->store('formations/couvertures', 'public');
        }

        Formation::create([
            'user_id'           => Auth::id(),
            'titre'             => $request->f_titre,
            'categorie'         => $request->f_categorie,
            'langue'            => $request->f_langue,
            'niveau'            => $request->f_niveau,
            'description'       => $request->f_desc_courte,
            'nombre_lecons'     => $request->f_nb_lecons,
            'duree_lecon'       => $request->f_duree_lecon,
            'duree_totale'      => $request->f_duree_totale,
            'programme'         => implode("\n", $request->plan_items),
            'public_cible'      => $request->f_public,
            'objectifs'         => $request->f_objectifs,
            'competences'       => $request->competences ?? [],
            'prerequis'         => $request->prerequis ?? [],
            'prix'              => $request->f_type_prix === 'gratuite' ? 0 : ($request->f_prix ?? 0),
            'devise'            => $request->f_type_prix === 'gratuite' ? 'XAF' : ($request->f_devise ?? 'XAF'),
            'reduction'         => $request->f_reduction ?? 0,
            'type_remuneration' => $request->f_remuneration,
            'partage_formateur' => $request->f_remuneration === 'partage' ? ($request->f_partage ?? 70) : 100,
            'score_minimum'     => $request->f_score_min ?? 70,
            'video'             => $request->f_video,
            'image'             => $imagePath,
            'statut'            => 'en_attente',
        ]);

        return redirect()->route('dashboard')
                         ->with('success', 'Formation soumise avec succès ! Elle sera examinée par notre équipe.');
    }
}
