<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur;
use App\Models\Formation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartenaireController extends Controller
{
    public function soumettreTout(Request $request)
    {
        // 1. Validation de l'ensemble des données (Formateur + Formation)
        $request->validate([
            // Informations du Formateur
            'nom'               => 'required|string|max:255',
            'telephone'         => 'required|string',
            'photo_profil'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo_diplome'     => 'required|image|mimes:jpeg,png,jpg,pdf|max:4096',
            'annees_experience' => 'required|integer|min:0',
            'bibliographie'     => 'required|string',
            'date_naissance'    => 'required|date',

            // Informations de la Formation
            'f_titre'           => 'required|string|max:255',
            'f_categorie'       => 'required|string',
            'f_langue'          => 'required|string',
            'f_niveau'          => 'required|string',
            'f_desc_courte'     => 'required|string|max:500',
            'f_cover'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'f_video'           => 'nullable|url',
            'f_public'          => 'required|string',
            'f_objectifs'       => 'required|string',
            'f_nb_lecons'       => 'required|integer|min:1',
            'f_duree_lecon'     => 'required|string',
            'f_duree_totale'    => 'required|string',
            'plan_items'        => 'required|array|min:1',
            'plan_items.*'      => 'required|string',
            'f_score_min'       => 'nullable|integer|min:0|max:100',
            'f_type_prix'       => 'required|in:payante,gratuite',
            'f_prix'            => 'required_if:f_type_prix,payante|nullable|numeric|min:0',
            'f_devise'          => 'required_if:f_type_prix,payante|nullable|string',
            'f_remuneration'    => 'required|string',
            'f_partage'         => 'nullable|integer|min:0|max:100',

            // Engagements obligatoires
            'chk0'              => 'required',
            'chk1'              => 'required',
            'chk2'              => 'required',
        ]);

        // Début de la transaction pour sécuriser l'écriture simultanée dans les 2 tables
        DB::beginTransaction();

        try {
            $user_id = Auth::id();

            // 2. Enregistrement dans la table "formateurs"
            $formateur = new Formateur();
            $formateur->user_id = $user_id;
            $formateur->nom = $request->nom;
            $formateur->phone = $request->telephone;
            $formateur->annees_experience = $request->annees_experience;
            $formateur->bibliographie = $request->bibliographie;
            $formateur->date_naissance = $request->date_naissance;
            $formateur->statut = 'pending';

            if ($request->hasFile('photo_profil')) {
                $formateur->photo_profil = $request->file('photo_profil')->store('formateurs/images', 'public');
            }
            if ($request->hasFile('photo_diplome')) {
                $formateur->photo_diplome = $request->file('photo_diplome')->store('formateurs/images', 'public');
            }
            $formateur->save();

            // 3. Enregistrement dans la table "formations"
            $formation = new Formation();
            $formation->user_id = $user_id;
            $formation->titre = $request->f_titre;
            $formation->categorie = $request->f_categorie;
            $formation->langue = $request->f_langue;
            $formation->niveau = $request->f_niveau;
            $formation->description = $request->f_desc_courte;
            $formation->nombre_lecons = $request->f_nb_lecons;
            $formation->duree_lecon = $request->f_duree_lecon;
            $formation->duree_totale = $request->f_duree_totale;

            // Conversion du tableau dynamique du programme en chaîne textuelle séparée par des retours à la ligne
            $formation->programme = implode("\n", $request->plan_items);

            $formation->public_cible = $request->f_public;
            $formation->objectifs = $request->f_objectifs;
            $formation->prix = $request->f_type_prix === 'gratuite' ? 0 : ($request->f_prix ?? 0);
            $formation->devise = $request->f_type_prix === 'gratuite' ? 'XAF' : ($request->f_devise ?? 'XAF');
            $formation->reduction = $request->f_reduction ?? 0;
            $formation->type_remuneration = $request->f_remuneration;
            $formation->partage_formateur = $request->f_remuneration === 'partage' ? ($request->f_partage ?? 70) : 100;
            $formation->score_minimum = $request->f_score_min ?? 70;
            $formation->statut = 'pending';

            if ($request->hasFile('f_cover')) {
                $formation->image = $request->file('f_cover')->store('formations/covers', 'public');
            }
            if ($request->f_video) {
                $formation->video = $request->f_video;
            }
            $formation->save();

            // Tout est bon, on confirme en Base de données
            DB::commit();

            // Redirection vers le dashboard avec message flash de succès
            return redirect()->route('partenaire.dashboard')->with('success', 'Votre candidature de formateur et votre formation ont été soumises avec succès !');

        } catch (\Exception $e) {
            // En cas de problème, on annule tout ce qui a été fait pendant cette requête
            DB::rollBack();
            return back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage()])->withInput();
        }
    }
}
