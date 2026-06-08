<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Soumettre une Formation</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&family=Playfair+Display:wght=600;700&display=swap" rel="stylesheet">
<style>
/* ... Vos styles CSS existants restent inchangés ... */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{ --blue:#2563eb; --blue-d:#1d4ed8; --blue-l:#dbeafe; --blue-xl:#eff6ff; --indigo:#4f46e5; --violet:#7c3aed; --green:#16a34a; --green-l:#dcfce7; --orange:#ea580c; --orange-l:#fff7ed; --gray-50:#f8fafc; --gray-100:#f1f5f9; --gray-200:#e2e8f0; --gray-300:#cbd5e1; --gray-400:#94a3b8; --gray-500:#64748b; --gray-600:#475569; --gray-700:#334155; --gray-800:#1e293b; --gray-900:#0f172a; }
body{font-family:'Plus Jakarta Sans',sans-serif;background-color:#f8fafc;color:var(--gray-800);line-height:1.6}
.container{max-width:1000px;margin:40px auto;padding:0 20px}
.step{display:none}
.step.active{display:block}
.form-group{margin-bottom:24px}
label{display:block;margin-bottom:8px;font-weight:600;color:var(--gray-700);font-size:14px}
input[type="text"],input[type="number"],input[type="date"],input[type="url"],textarea,select{width:100%;padding:12px 16px;border:1.5px solid var(--gray-200);border-radius:10px;font-family:inherit;font-size:15px;color:var(--gray-900);background:#fff;transition:all .2s ease}
input:focus,textarea:focus,select:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 4px var(--blue-l)}
.btn-group{display:flex;justify-content:space-between;margin-top:40px;padding-top:24px;border-top:1.5px solid var(--gray-100)}
.btn{padding:12px 28px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;transition:all .2s ease;border:none;display:inline-flex;align-items:center;gap:8px}
.btn-prev{background:var(--gray-100);color:var(--gray-700)}
.btn-prev:hover{background:var(--gray-200)}
.btn-next{background:var(--blue);color:#fff}
.btn-next:hover{background:var(--blue-d)}
.toast{position:fixed;bottom:30px;right:30px;padding:16px 24px;border-radius:12px;background:#var(--gray-900);color:#fff;box-shadow:0 10px 25px rgba(0,0,0,.15);transform:translateY(100px);opacity:0;transition:all .4s cubic-bezier(.175,.885,.32,1.275);z-index:1000;display:flex;align-items:center;gap:12px;font-weight:500}
.toast.show{transform:translateY(0);opacity:1}
.toast.error{background:#ef4444} .toast.success{background:#22c55e} .toast.info{background:#3b82f6}
.error-box{background:#fee2e2;color:#991b1b;padding:16px;border-radius:10px;margin-bottom:24px;border:1px solid #fca5a5}
.error-box ul{list-style-position:inside}
</style>
</head>
<body>

<div class="container">

    <form action="{{ route('partenaire.soumettre') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
        @csrf

        @if($errors->any())
            <div class="error-box">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="step active" id="step-1">
            <h2>Étape 1: Profil du Formateur</h2>
            <div class="form-group">
                <label for="nom">Nom complet *</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
            </div>
            <div class="form-group">
                <label for="telephone">Numéro de téléphone *</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de naissance *</label>
                <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
            </div>
            <div class="form-group">
                <label for="annees_experience">Années d'expérience *</label>
                <input type="number" id="annees_experience" name="annees_experience" value="{{ old('annees_experience') }}" min="0" required>
            </div>
            <div class="form-group">
                <label for="photo_profil">Photo de profil</label>
                <input type="file" id="photo_profil" name="photo_profil" accept="image/*">
            </div>
            <div class="form-group">
                <label for="photo_diplome">Photo du diplôme ou certification la plus élevée *</label>
                <input type="file" id="photo_diplome" name="photo_diplome" accept="image/*,application/pdf" required>
            </div>
            <div class="form-group">
                <label for="bibliographie">Biographie / Parcour professionnel *</label>
                <textarea id="bibliographie" name="bibliographie" rows="4" required>{{ old('bibliographie') }}</textarea>
            </div>
            <div class="btn-group">
                <span></span>
                <button type="button" class="btn btn-next" onclick="changeStep(1)">Suivant</button>
            </div>
        </div>

        <div class="step" id="step-2">
            <h2>Étape 2: Détails de la Formation</h2>
            <div class="form-group">
                <label for="f_titre">Titre de la formation *</label>
                <input type="text" id="f_titre" name="f_titre" value="{{ old('f_titre') }}" required>
            </div>
            <div class="form-group">
                <label for="f_categorie">Catégorie *</label>
                <select id="f_categorie" name="f_categorie" required>
                    <option value="Developpement" {{ old('f_categorie') == 'Developpement' ? 'selected' : '' }}>Développement Web / Mobile</option>
                    <option value="Design" {{ old('f_categorie') == 'Design' ? 'selected' : '' }}>Design Graphique</option>
                    <option value="Marketing" {{ old('f_categorie') == 'Marketing' ? 'selected' : '' }}>Marketing Digital</option>
                    <option value="Business" {{ old('f_categorie') == 'Business' ? 'selected' : '' }}>Gestion & Business</option>
                </select>
            </div>
            <div class="form-group">
                <label for="f_langue">Langue d'enseignement *</label>
                <select id="f_langue" name="f_langue" required>
                    <option value="Français" {{ old('f_langue') == 'Français' ? 'selected' : '' }}>Français</option>
                    <option value="Anglais" {{ old('f_langue') == 'Anglais' ? 'selected' : '' }}>Anglais</option>
                </select>
            </div>
            <div class="form-group">
                <label>Niveau de la formation *</label>
                <input type="radio" name="f_niveau" value="Débutant" checked> Débutant
                <input type="radio" name="f_niveau" value="Intermédiaire"> Intermédiaire
                <input type="radio" name="f_niveau" value="Avancé"> Avancé
            </div>
            <div class="form-group">
                <label for="f_desc_courte">Description courte *</label>
                <textarea id="f_desc_courte" name="f_desc_courte" rows="3" required>{{ old('f_desc_courte') }}</textarea>
            </div>
            <div class="form-group">
                <label for="f_cover">Image de couverture *</label>
                <input type="file" id="f_cover" name="f_cover" accept="image/*">
            </div>
            <div class="form-group">
                <label for="f_video">Lien de la vidéo d'introduction (Optionnel)</label>
                <input type="url" id="f_video" name="f_video" value="{{ old('f_video') }}">
            </div>
            <div class="form-group">
                <label for="f_public">Public cible *</label>
                <input type="text" id="f_public" name="f_public" value="{{ old('f_public') }}" required>
            </div>
            <div class="form-group">
                <label for="f_objectifs">Objectifs d'apprentissage *</label>
                <textarea id="f_objectifs" name="f_objectifs" rows="3" required>{{ old('f_objectifs') }}</textarea>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-prev" onclick="changeStep(-1)">Précédent</button>
                <button type="button" class="btn btn-next" onclick="changeStep(1)">Suivant</button>
            </div>
        </div>

        <div class="step" id="step-3">
            <h2>Étape 3: Programme de la formation</h2>
            <div class="form-group">
                <label for="f_nb_lecons">Nombre total de leçons *</label>
                <input type="number" id="f_nb_lecons" name="f_nb_lecons" value="{{ old('f_nb_lecons', 1) }}" min="1" required>
            </div>
            <div class="form-group">
                <label for="f_duree_lecon">Durée moyenne d'une leçon (ex: 15 min) *</label>
                <input type="text" id="f_duree_lecon" name="f_duree_lecon" value="{{ old('f_duree_lecon') }}" required>
            </div>
            <div class="form-group">
                <label for="f_duree_totale">Durée totale estimée (ex: 5 heures) *</label>
                <input type="text" id="f_duree_totale" name="f_duree_totale" value="{{ old('f_duree_totale') }}" required>
            </div>
            <div class="form-group">
                <label for="f_score_min">Score minimum d'examen pour obtenir l'attestation (%)</label>
                <input type="number" id="f_score_min" name="f_score_min" value="{{ old('f_score_min', 70) }}" min="0" max="100">
            </div>

            <div class="form-group">
                <label>Plan / Chapitres du programme *</label>
                <div id="plan-container">
                    <input type="text" name="plan_items[]" placeholder="Ex: Chapitre 1 : Introduction" required style="margin-bottom:10px;">
                </div>
                <button type="button" class="btn" style="background:#e2e8f0; color:#334155; padding:6px 12px; font-size:13px;" onclick="addPlanItem()">+ Ajouter un chapitre</button>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-prev" onclick="changeStep(-1)">Précédent</button>
                <button type="button" class="btn btn-next" onclick="changeStep(1)">Suivant</button>
            </div>
        </div>

        <div class="step" id="step-4">
            <h2>Étape 4: Tarification & Engagements</h2>

            <div class="form-group">
                <label>Type de tarification *</label>
                <input type="radio" name="f_type_prix" value="gratuite" checked onclick="togglePrix(false)"> Gratuite
                <input type="radio" name="f_type_prix" value="payante" onclick="togglePrix(true)"> Payante
            </div>

            <div id="section-prix" style="display:none; background:#f1f5f9; padding:16px; border-radius:10px; margin-bottom:20px;">
                <div class="form-group">
                    <label for="f_prix">Prix de la formation</label>
                    <input type="number" id="f_prix" name="f_prix" value="{{ old('f_prix') }}" min="0">
                </div>
                <div class="form-group">
                    <label for="f_devise">Devise</label>
                    <select id="f_devise" name="f_devise">
                        <option value="XAF">FCFA (XAF)</option>
                        <option value="USD">Dollar (USD)</option>
                        <option value="EUR">Euro (EUR)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Modèle de rémunération souhaité *</label>
                <input type="radio" name="f_remuneration" value="abonnement" checked> Inclus dans l'abonnement global du site (Rémunération au prorata des vues) <br>
                <input type="radio" name="f_remuneration" value="partage"> Vente à l'unité (Partage des revenus par vente)
            </div>

            <div class="form-group">
                <label for="f_partage">Votre pourcentage souhaité sur chaque vente (%) - Si vente à l'unité</label>
                <input type="number" id="f_partage" name="f_partage" value="{{ old('f_partage', 70) }}" min="0" max="100">
            </div>

            <div class="form-group" style="margin-top:30px; background:#fff7ed; padding:16px; border-radius:10px; border:1px solid #fed7aa;">
                <label>Engagements obligatoires du partenaire :</label>
                <div style="margin-bottom:10px;">
                    <input type="checkbox" id="chk0" name="chk0" required> J'atteste que toutes les informations fournies sont exactes.
                </div>
                <div style="margin-bottom:10px;">
                    <input type="checkbox" id="chk1" name="chk1" required> Je m'engage à produire des contenus de qualité respectant la charte SkillTract.
                </div>
                <div>
                    <input type="checkbox" id="chk2" name="chk2" required> J'accepte les conditions générales d'utilisation et de partage des revenus.
                </div>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-prev" onclick="changeStep(-1)">Précédent</button>
                <button type="button" class="btn btn-next" style="background:var(--green);" onclick="submitForm()">Soumettre ma candidature</button>
            </div>
        </div>

    </form>
</div>

<div id="toast" class="toast"></div>

<script>
let currentStep = 1;
const totalSteps = 4;

function changeStep(increment) {
    // Masquer l'étape actuelle
    document.getElementById(`step-${currentStep}`).classList.remove('active');

    currentStep += increment;
    if (currentStep < 1) currentStep = 1;
    if (currentStep > totalSteps) currentStep = totalSteps;

    // Afficher la nouvelle étape
    document.getElementById(`step-${currentStep}`).classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function addPlanItem() {
    const container = document.getElementById('plan-container');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'plan_items[]';
    input.placeholder = 'Ex: Chapitre suivant...';
    input.style.marginBottom = '10px';
    input.required = true;
    container.appendChild(input);
}

function togglePrix(show) {
    document.getElementById('section-prix').style.display = show ? 'block' : 'none';
}

/* ══ SOUMISSION DU FORMULAIRE VIA LARAVEL ══ */
function submitForm() {
    const chk0 = document.getElementById('chk0');
    const chk1 = document.getElementById('chk1');
    const chk2 = document.getElementById('chk2');

    // Vérification de sécurité JavaScript avant envoi
    if (!chk0.checked || !chk1.checked || !chk2.checked) {
        showToast('Veuillez cocher les 3 engagements obligatoires.', 'error');
        return;
    }

    showToast('Envoi de vos données à Laravel en cours...', 'info');

    // Déclenchement de la vraie soumission HTTP POST vers le contrôleur Laravel
    document.getElementById('multiStepForm').submit();
}

function showToast(msg, type = 'info') {
    const t = document.getElementById('toast');
    t.className = 'toast ' + type;
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 4000);
}
</script>
</body>
</html>
