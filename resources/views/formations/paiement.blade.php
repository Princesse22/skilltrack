<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillTract – Modalités & Paiement</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue:       #1a56db;
            --blue-light: #e8f0ff;
            --blue-dark:  #1039a0;
            --gray-100:   #f5f7fa;
            --gray-200:   #e9ecef;
            --gray-400:   #adb5bd;
            --gray-600:   #6c757d;
            --gray-800:   #2d3748;
            --white:      #ffffff;
            --shadow-sm:  0 2px 8px rgba(26,86,219,.08);
            --shadow-md:  0 8px 32px rgba(26,86,219,.13);
            --radius:     14px;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--gray-100);
            color: var(--gray-800);
            min-height: 100vh;
        }

        /* ── HEADER ── */
        header {
            background: var(--white);
            border-bottom: 2px solid var(--blue);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        header .logo-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--blue);
            letter-spacing: -.5px;
        }
        header .logo-text span { color: var(--gray-800); }

        /* ── HERO BAND ── */
        .hero-band {
            background: linear-gradient(120deg, var(--blue) 0%, #2d6ef7 100%);
            color: var(--white);
            text-align: center;
            padding: 3rem 1.5rem 2.5rem;
        }
        .hero-band h1 {
            font-family: 'Lora', serif;
            font-size: clamp(1.6rem, 3.5vw, 2.4rem);
            font-weight: 600;
            margin-bottom: .5rem;
        }
        .hero-band p {
            font-size: .95rem;
            opacity: .85;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ── LAYOUT ── */
        .page-wrap {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 2rem;
            align-items: start;
        }

        /* ── CARD BASE ── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, var(--blue) 0%, #2d6ef7 100%);
            color: var(--white);
            padding: 1.2rem 1.6rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .card-header h2 {
            font-size: 1.05rem;
            font-weight: 600;
        }

        /* ── MODALITÉS ── */
        .modalites-body {
            padding: 1.6rem 1.8rem;
            max-height: 78vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--blue-light) transparent;
        }
        .modalites-body::-webkit-scrollbar { width: 5px; }
        .modalites-body::-webkit-scrollbar-thumb { background: var(--blue-light); border-radius: 10px; }

        .section-block { margin-bottom: 1.6rem; }
        .section-block h3 {
            font-size: .92rem;
            font-weight: 600;
            color: var(--blue);
            display: flex;
            align-items: center;
            gap: .4rem;
            margin-bottom: .55rem;
            padding-bottom: .35rem;
            border-bottom: 1.5px solid var(--blue-light);
        }
        .section-block h3 .num {
            background: var(--blue);
            color: var(--white);
            font-size: .72rem;
            font-weight: 700;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .section-block p {
            font-size: .875rem;
            line-height: 1.75;
            color: var(--gray-800);
        }
        .section-block ul {
            list-style: none;
            margin-top: .4rem;
        }
        .section-block ul li {
            font-size: .875rem;
            line-height: 1.7;
            color: var(--gray-800);
            padding-left: 1.2rem;
            position: relative;
            margin-bottom: .15rem;
        }
        .section-block ul li::before {
            content: '▸';
            position: absolute;
            left: 0;
            color: var(--blue);
            font-size: .8rem;
            top: .1rem;
        }
        .highlight-box {
            background: var(--blue-light);
            border-left: 3px solid var(--blue);
            border-radius: 6px;
            padding: .6rem 1rem;
            font-size: .875rem;
            color: var(--blue-dark);
            font-weight: 500;
            margin-top: .5rem;
        }

        /* ── FORMULAIRE ── */
        .form-body { padding: 1.6rem; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .form-group {
            margin-bottom: 1.1rem;
        }
        .form-group.full { grid-column: 1 / -1; }

        label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: .35rem;
        }

        input, select {
            width: 100%;
            padding: .65rem .85rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: .875rem;
            color: var(--gray-800);
            background: var(--gray-100);
            transition: border-color .2s, box-shadow .2s, background .2s;
            outline: none;
        }
        input:focus, select:focus {
            border-color: var(--blue);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(26,86,219,.1);
        }

        /* Moyens de paiement */
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .6rem;
        }
        .pay-option {
            display: none;
        }
        .pay-label {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .55rem .75rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            cursor: pointer;
            font-size: .82rem;
            font-weight: 500;
            background: var(--gray-100);
            transition: all .2s;
            user-select: none;
        }
        .pay-label:hover { border-color: var(--blue); background: var(--blue-light); }
        .pay-option:checked + .pay-label {
            border-color: var(--blue);
            background: var(--blue-light);
            color: var(--blue-dark);
            font-weight: 600;
        }
        .pay-label .pay-icon { font-size: 1.1rem; }

        /* Politique checkbox */
        .policy-box {
            margin: 1.2rem 0 1rem;
            padding: .9rem 1rem;
            background: var(--gray-100);
            border-radius: 8px;
            border: 1.5px solid var(--gray-200);
            display: flex;
            align-items: flex-start;
            gap: .75rem;
        }
        .policy-box input[type="checkbox"] {
            width: 18px;
            height: 18px;
            min-width: 18px;
            margin-top: 2px;
            accent-color: var(--blue);
            cursor: pointer;
        }
        .policy-box label {
            text-transform: none;
            letter-spacing: 0;
            font-size: .865rem;
            font-weight: 400;
            color: var(--gray-800);
            cursor: pointer;
            line-height: 1.55;
            margin: 0;
        }
        .policy-box label a {
            color: var(--blue);
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 2px;
        }
        .policy-box label a:hover { color: var(--blue-dark); }

        /* Bouton Payer */
        .btn-pay {
            width: 100%;
            padding: .85rem;
            border: none;
            border-radius: 8px;
            font-family: 'Sora', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            letter-spacing: .3px;
            cursor: not-allowed;
            background: var(--gray-400);
            color: var(--white);
            transition: background .25s, transform .15s, box-shadow .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }
        .btn-pay.active {
            background: var(--blue);
            cursor: pointer;
            box-shadow: var(--shadow-md);
        }
        .btn-pay.active:hover {
            background: var(--blue-dark);
            transform: translateY(-1px);
        }
        .btn-pay.active:active { transform: translateY(0); }

        .lock-icon { font-size: 1rem; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .page-wrap {
                grid-template-columns: 1fr;
            }
            .modalites-body { max-height: none; }
        }
        @media (max-width: 500px) {
            .form-row { grid-template-columns: 1fr; }
            .payment-methods { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

{{-- <header>
    {{-- <div class="logo-text">Skill<span>Tract</span></div>
</header> --}}

<div class="hero-band">
    <h1>📚 Modalités de Formation & Paiement</h1>
    <p>Lisez attentivement les modalités avant de procéder au paiement de votre formation.</p>
</div>

<div class="page-wrap">

    <!-- ════ COLONNE GAUCHE : MODALITÉS ════ -->
    <div class="card">
        <div class="card-header">
            <span>📋</span>
            <h2>Modalités de la Formation</h2>
        </div>
        <div class="modalites-body">

            <div class="section-block">
                <h3><span class="num">1</span> Inscription</h3>
                <p>L'inscription à la formation se fait en ligne via la plateforme SkillTrack ou directement auprès de l'administration.<br>
                Toute inscription est considérée comme valide après confirmation du paiement des frais de formation.</p>
            </div>

            <div class="section-block">
                <h3><span class="num">2</span> Accès à la formation</h3>
                <p>Après validation du paiement, l'apprenant obtient un accès personnel aux contenus de la formation, incluant :</p>
                <ul>
                    <li>Les cours théoriques</li>
                    <li>Les tutoriels (vidéos ou supports)</li>
                    <li>Les exercices pratiques</li>
                    <li>Les quiz d'évaluation</li>
                </ul>
                <p style="margin-top:.5rem;">L'accès est strictement individuel et ne peut être partagé.</p>
            </div>

            <div class="section-block">
                <h3><span class="num">3</span> Durée de la formation</h3>
                <p>Chaque formation possède une durée déterminée précisée sur la fiche de présentation.<br>
                L'accès aux contenus reste actif uniquement pendant la période de formation définie.</p>
            </div>

            <div class="section-block">
                <h3><span class="num">4</span> Évaluation et validation</h3>
                <p>L'apprenant doit suivre les modules, réaliser les exercices et passer les quiz à la fin de chaque notion. Un quiz final est organisé à la fin de la formation.</p>
                <div class="highlight-box">👉 La formation est validée si l'apprenant obtient au moins <strong>70 %</strong> de réussite au quiz final.</div>
            </div>

            <div class="section-block">
                <h3><span class="num">5</span> Reprise de la formation</h3>
                <p>Si l'apprenant n'atteint pas le seuil de validation (70 %) à la fin de la durée de la formation :</p>
                <ul>
                    <li>Une période de rattrapage peut être accordée (selon les conditions de la formation)</li>
                    <li>En cas d'échec après cette période, une nouvelle souscription sera nécessaire pour reprendre la formation</li>
                </ul>
            </div>

            <div class="section-block">
                <h3><span class="num">6</span> Attestation de fin de formation</h3>
                <p>Une attestation de fin de formation est délivrée uniquement aux apprenants ayant :</p>
                <ul>
                    <li>Suivi la formation</li>
                    <li>Complété les modules</li>
                    <li>Validé le quiz final avec un score ≥ 70 %</li>
                </ul>
                <p style="margin-top:.5rem;">L'attestation est téléchargeable depuis l'espace personnel de l'apprenant.</p>
            </div>

            <div class="section-block">
                <h3><span class="num">7</span> Paiement et remboursement</h3>
                <p>Les frais de formation doivent être réglés avant l'accès aux contenus.<br>
                Les paiements effectués ne sont pas remboursables sauf cas exceptionnel validé par l'administration.</p>
            </div>

            <div class="section-block">
                <h3><span class="num">8</span> Engagement de l'apprenant</h3>
                <p>L'apprenant s'engage à :</p>
                <ul>
                    <li>Respecter le règlement de la plateforme</li>
                    <li>Ne pas partager les contenus de formation</li>
                    <li>Suivre la formation de manière sérieuse</li>
                    <li>Respecter les autres apprenants et formateurs</li>
                </ul>
            </div>

            <div class="section-block">
                <h3><span class="num">9</span> Support et assistance</h3>
                <p>Un accompagnement pédagogique est disponible pendant la durée de la formation pour aider l'apprenant en cas de difficulté (questions, exercices, compréhension des cours).</p>
            </div>

            <div class="section-block">
                <h3><span class="num">10</span> Modification des modalités</h3>
                <p>L'administration se réserve le droit de modifier les modalités de formation si nécessaire, afin d'améliorer la qualité pédagogique et l'organisation des formations.</p>
            </div>

        </div>
    </div>

    <!-- ════ COLONNE DROITE : FORMULAIRE ════ -->
    <div class="card">
        <div class="card-header">
            <span>💳</span>
            <h2>Paiement des frais de formation</h2>
        </div>
        <div class="form-body">
            <form id="payForm" onsubmit="return false;">

                <div class="form-row">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" placeholder="Ex : Karine" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" placeholder="Ex : Mbarga" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="tel" id="telephone" name="telephone" placeholder="Ex : +237 6XX XXX XXX" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_naissance">Date de naissance</label>
                        <input type="date" id="date_naissance" name="date_naissance" required>
                    </div>
                    <div class="form-group">
                        <label for="lieu_naissance">Lieu de naissance</label>
                        <input type="text" id="lieu_naissance" name="lieu_naissance" placeholder="Ex : Yaoundé" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="date_debut">Date de début</label>
                        <input type="date" id="date_debut" name="date_debut" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date de fin</label>
                        <input type="date" id="date_fin" name="date_fin" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Moyen de paiement</label>
                    <div class="payment-methods">

                        <input type="radio" name="paiement" id="mtn" value="mtn" class="pay-option">
                        <label for="mtn" class="pay-label">
                            <span class="pay-icon">📱</span> MTN Money
                        </label>

                        <input type="radio" name="paiement" id="orange" value="orange" class="pay-option">
                        <label for="orange" class="pay-label">
                            <span class="pay-icon">🟠</span> Orange Money
                        </label>

                        <input type="radio" name="paiement" id="paypal" value="paypal" class="pay-option">
                        <label for="paypal" class="pay-label">
                            <span class="pay-icon">🅿️</span> PayPal
                        </label>

                        <input type="radio" name="paiement" id="carte" value="carte" class="pay-option">
                        <label for="carte" class="pay-label">
                            <span class="pay-icon">💳</span> Carte bancaire
                        </label>

                    </div>
                </div>

                <!-- Case politique de confidentialité -->
                <div class="policy-box">
                    <input type="checkbox" id="politique" name="politique">
                    <label for="politique">
                        J'accepte la
                        <a href="/politique-de-confidentialite" target="_blank">politique de confidentialité</a>
                        de SkillTract et je reconnais avoir lu et compris les modalités de la formation.
                    </label>
                </div>

                <!-- Bouton Payer -->
                <a href="{{ route('formations.index') }}" class="btn-pay disabled" id="btnPayer">
    <span class="lock-icon">🔒</span>
    <span id="btnText">Acceptez la politique pour continuer</span>
</a>

            </form>
        </div>
    </div>

</div>

<script>
    const checkbox = document.getElementById('politique');
    const btn      = document.getElementById('btnPayer');
    const btnText  = document.getElementById('btnText');

    checkbox.addEventListener('change', function () {
        if (this.checked) {
            btn.classList.add('active');
            btn.disabled = false;
            btn.querySelector('.lock-icon').textContent = '✅';
            btnText.textContent = 'Payer maintenant';
        } else {
            btn.classList.remove('active');
            btn.disabled = true;
            btn.querySelector('.lock-icon').textContent = '🔒';
            btnText.textContent = 'Acceptez la politique pour continuer';
        }
    });

    // Empêcher date fin < date début
    document.getElementById('date_debut').addEventListener('change', function () {
        document.getElementById('date_fin').min = this.value;
    });
</script>

</body>
</html>
