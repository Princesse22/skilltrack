{{-- resources/views/admin/formation-detail.blade.php --}}

@extends('layouts.app')

@section('title', 'Détail de la formation – ' . $formation->titre)

@section('content')

<style>
/* ══ VARIABLES ══ */
:root {
    --blue: #2563eb; --blue-l: #dbeafe; --blue-xl: #eff6ff;
    --green: #16a34a; --green-l: #dcfce7;
    --amber: #d97706; --amber-l: #fef3c7;
    --red: #dc2626; --red-l: #fee2e2;
    --violet: #7c3aed; --violet-l: #ede9fe;
    --gray-50: #f9fafb; --gray-100: #f3f4f6; --gray-200: #e5e7eb;
    --gray-400: #9ca3af; --gray-500: #6b7280; --gray-600: #4b5563;
    --gray-700: #374151; --gray-800: #1f2937; --gray-900: #111827;
    --white: #fff;
    --r: 12px; --r-sm: 8px;
    --sh: 0 1px 3px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.06);
    --sh-md: 0 4px 16px rgba(0,0,0,.1);
}

/* ══ PAGE LAYOUT ══ */
.detail-page {
    background: var(--gray-50);
    min-height: 100vh;
    padding-bottom: 3rem;
}

/* ══ TOPBAR ══ */
.detail-topbar {
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    padding: .85rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    box-shadow: var(--sh);
    position: sticky;
    top: 0;
    z-index: 100;
}
.detail-topbar .back-btn {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    font-size: .85rem;
    font-weight: 600;
    color: var(--gray-600);
    text-decoration: none;
    padding: .42rem .85rem;
    border-radius: var(--r-sm);
    border: 1.5px solid var(--gray-200);
    transition: all .18s;
    background: var(--white);
}
.detail-topbar .back-btn:hover {
    border-color: var(--gray-400);
    color: var(--gray-800);
    background: var(--gray-50);
}
.topbar-actions { display: flex; gap: .6rem; }
.btn-action {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .5rem 1.1rem;
    border-radius: var(--r-sm);
    font-size: .84rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    transition: all .2s;
    text-decoration: none;
}
.btn-validate { background: var(--green); color: #fff; box-shadow: 0 2px 8px rgba(22,163,74,.3); }
.btn-validate:hover { background: #15803d; transform: translateY(-1px); }
.btn-reject { background: var(--red-l); color: var(--red); border: 1.5px solid rgba(220,38,38,.2); }
.btn-reject:hover { background: var(--red); color: #fff; }

/* ══ HERO BANNER ══ */
.formation-hero {
    position: relative;
    height: 280px;
    overflow: hidden;
    background: linear-gradient(135deg, #1e293b, #0f172a);
}
.formation-hero img.hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: .4;
}
.formation-hero .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(15,23,42,.9) 0%, rgba(15,23,42,.4) 60%, transparent 100%);
}
.formation-hero .hero-no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 5rem;
    opacity: .15;
}
.hero-content {
    position: absolute;
    bottom: 1.5rem;
    left: 2rem;
    right: 2rem;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    font-size: .7rem;
    font-weight: 700;
    padding: .2rem .65rem;
    border-radius: 99px;
    margin-bottom: .6rem;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.hero-badge.pending { background: rgba(217,119,6,.25); color: #fcd34d; border: 1px solid rgba(217,119,6,.3); }
.hero-badge.validated { background: rgba(22,163,74,.25); color: #86efac; border: 1px solid rgba(22,163,74,.3); }
.hero-badge.rejected { background: rgba(220,38,38,.2); color: #fca5a5; border: 1px solid rgba(220,38,38,.3); }
.hero-title {
    font-family: 'Georgia', serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.25;
    margin-bottom: .4rem;
}
.hero-meta {
    display: flex;
    gap: 1.2rem;
    font-size: .8rem;
    color: rgba(255,255,255,.55);
}
.hero-meta span { display: flex; align-items: center; gap: .3rem; }

/* ══ CONTENT ══ */
.detail-body {
    max-width: 1100px;
    margin: 0 auto;
    padding: 2rem 2rem 0;
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 1.5rem;
}

/* ══ SECTION CARDS ══ */
.sec-card {
    background: var(--white);
    border-radius: var(--r);
    border: 1px solid var(--gray-200);
    box-shadow: var(--sh);
    overflow: hidden;
    margin-bottom: 1.2rem;
}
.sec-hdr {
    padding: .85rem 1.3rem;
    border-bottom: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    gap: .6rem;
}
.sec-ico {
    width: 30px; height: 30px;
    border-radius: var(--r-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem; flex-shrink: 0;
}
.sec-hdr h3 { font-size: .9rem; font-weight: 800; color: var(--gray-800); }
.sec-body { padding: 1.2rem 1.3rem; }

/* Champ info */
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; }
.info-field {
    background: var(--gray-50);
    border-radius: var(--r-sm);
    padding: .65rem .9rem;
    border: 1px solid var(--gray-100);
}
.info-field.full { grid-column: 1 / -1; }
.info-field .if-label {
    font-size: .65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--gray-400);
    margin-bottom: .22rem;
}
.info-field .if-val {
    font-size: .9rem;
    font-weight: 600;
    color: var(--gray-800);
    line-height: 1.5;
}
.info-field .if-val.long {
    font-size: .86rem;
    font-weight: 400;
    color: var(--gray-700);
    line-height: 1.7;
}
.if-val.price {
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--green);
}
.if-empty { color: var(--gray-400); font-style: italic; font-size: .82rem; }

/* Photo profil */
.formateur-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--gray-50);
    border-radius: var(--r);
    border: 1px solid var(--gray-200);
    margin-bottom: 1rem;
}
.formateur-avatar {
    width: 60px; height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--gray-200);
    flex-shrink: 0;
}
.formateur-avatar-placeholder {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--blue), var(--violet));
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; font-weight: 800; color: #fff;
    flex-shrink: 0;
}
.formateur-name { font-size: 1rem; font-weight: 700; color: var(--gray-800); }
.formateur-meta { font-size: .78rem; color: var(--gray-500); margin-top: .15rem; }

/* Programme */
.programme-list {
    display: flex;
    flex-direction: column;
    gap: .45rem;
}
.prog-item {
    display: flex;
    align-items: flex-start;
    gap: .65rem;
    padding: .5rem .75rem;
    background: var(--gray-50);
    border-radius: var(--r-sm);
    border: 1px solid var(--gray-100);
}
.prog-num {
    width: 22px; height: 22px;
    border-radius: 50%;
    background: var(--blue-l);
    color: var(--blue);
    font-size: .65rem; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px;
}
.prog-text { font-size: .86rem; color: var(--gray-700); line-height: 1.5; }

/* Video */
.video-wrap {
    position: relative;
    padding-top: 56.25%;
    border-radius: var(--r-sm);
    overflow: hidden;
    background: var(--gray-900);
}
.video-wrap iframe {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
}
.video-link {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .55rem 1rem;
    background: var(--blue-xl);
    color: var(--blue);
    border-radius: var(--r-sm);
    font-size: .84rem;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid var(--blue-l);
    transition: all .2s;
}
.video-link:hover { background: var(--blue); color: #fff; }

/* Diplôme photo */
.diplome-img {
    width: 100%;
    max-height: 240px;
    object-fit: cover;
    border-radius: var(--r-sm);
    border: 1px solid var(--gray-200);
    cursor: zoom-in;
    transition: transform .2s;
}
.diplome-img:hover { transform: scale(1.01); }

/* ══ SIDEBAR ══ */
.sidebar-col { position: sticky; top: 80px; }

/* Pill tags */
.pill {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .22rem .65rem;
    border-radius: 99px;
    font-size: .72rem;
    font-weight: 700;
}
.pill.blue { background: var(--blue-l); color: var(--blue); }
.pill.green { background: var(--green-l); color: var(--green); }
.pill.amber { background: var(--amber-l); color: var(--amber); }
.pill.violet { background: var(--violet-l); color: var(--violet); }

/* Divider */
.divider { height: 1px; background: var(--gray-200); margin: .85rem 0; }

/* Responsive */
@media (max-width: 900px) {
    .detail-body { grid-template-columns: 1fr; }
    .info-grid { grid-template-columns: 1fr; }
    .sidebar-col { position: static; }
}
</style>

<div class="detail-page">

    {{-- ══ TOPBAR ══ --}}
    <div class="detail-topbar">
        <a href="{{ url()->previous() }}" class="back-btn">← Retour</a>

        <div class="topbar-actions">
            {{-- Bouton visible seulement si en attente --}}
            @if($formation->statut === 'en_attente')
                <form method="POST" action="{{ route('admin.formation.valider', $formation->id) }}" style="display:inline">
                    @csrf
                    <button class="btn-action btn-validate" type="submit">✅ Valider la formation</button>
                </form>
                <form method="POST" action="{{ route('admin.formation.rejeter', $formation->id) }}" style="display:inline">
                    @csrf
                    <button class="btn-action btn-reject" type="submit">❌ Rejeter</button>
                </form>
            @elseif($formation->statut === 'validee')
                <span class="pill green">✅ Formation validée</span>
            @elseif($formation->statut === 'rejetee')
                <span class="pill" style="background:var(--red-l);color:var(--red)">❌ Formation rejetée</span>
            @endif
        </div>
    </div>

    {{-- ══ HERO ══ --}}
    <div class="formation-hero">
        @if($formation->image)
            <img class="hero-img" src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->titre }}">
            <div class="hero-overlay"></div>
        @else
            <div class="hero-no-image">📚</div>
            <div class="hero-overlay"></div>
        @endif

        <div class="hero-content">
            <div class="hero-badge {{ $formation->statut === 'validee' ? 'validated' : ($formation->statut === 'rejetee' ? 'rejected' : 'pending') }}">
                {{ $formation->statut === 'validee' ? '✅ Validée' : ($formation->statut === 'rejetee' ? '❌ Rejetée' : '⏳ En attente') }}
            </div>
            <h1 class="hero-title">{{ $formation->titre }}</h1>
            <div class="hero-meta">
                <span>📚 {{ $formation->nombre_lecons }} leçons</span>
                <span>⏱ {{ $formation->duree }}</span>
                <span>🌍 {{ $formation->langue }}</span>
                <span>💰 {{ number_format($formation->prix, 0, ',', ' ') }} {{ $formation->devise }}</span>
            </div>
        </div>
    </div>

    {{-- ══ BODY ══ --}}
    <div class="detail-body">

        {{-- ═══ COLONNE GAUCHE ═══ --}}
        <div class="main-col">

            {{-- FORMATEUR --}}
            <div class="sec-card">
                <div class="sec-hdr">
                    <div class="sec-ico" style="background:var(--blue-l)">👤</div>
                    <div><h3>Informations du Formateur</h3></div>
                </div>
                <div class="sec-body">
                    <div class="formateur-card">
                        @if($formation->user->photo_profil)
                            <img class="formateur-avatar"
                                 src="{{ asset('storage/' . $formation->user->photo_profil) }}"
                                 alt="{{ $formation->user->name }}">
                        @else
                            <div class="formateur-avatar-placeholder">
                                {{ strtoupper(substr($formation->user->name, 0, 2)) }}
                            </div>
                        @endif
                        <div>
                            <div class="formateur-name">{{ $formation->user->name }}</div>
                            <div class="formateur-meta">{{ $formation->user->email }}</div>
                            <div class="formateur-meta" style="margin-top:.3rem">
                                <span class="pill blue">ID #{{ $formation->user_id }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-field">
                            <div class="if-label">Téléphone</div>
                            <div class="if-val">{{ $formation->telephone ?? '—' }}</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Date de naissance</div>
                            <div class="if-val">{{ $formation->date_naissance ? \Carbon\Carbon::parse($formation->date_naissance)->format('d/m/Y') : '—' }}</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Années d'expérience</div>
                            <div class="if-val">{{ $formation->annees_experience ?? '—' }} an{{ $formation->annees_experience > 1 ? 's' : '' }}</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Rémunération souhaitée</div>
                            <div class="if-val">{{ $formation->remuneration ?? '—' }}</div>
                        </div>
                        <div class="info-field full">
                            <div class="if-label">Biographie</div>
                            <div class="if-val long">{{ $formation->bibliographie ?? 'Non renseignée' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DIPLÔME --}}
            @if($formation->photo_diplome)
            <div class="sec-card">
                <div class="sec-hdr">
                    <div class="sec-ico" style="background:var(--amber-l)">🎓</div>
                    <div><h3>Diplôme / Certification</h3></div>
                </div>
                <div class="sec-body">
                    <img class="diplome-img"
                         src="{{ asset('storage/' . $formation->photo_diplome) }}"
                         alt="Diplôme"
                         onclick="window.open(this.src,'_blank')">
                    <p style="font-size:.75rem;color:var(--gray-400);margin-top:.5rem">Cliquez sur l'image pour l'agrandir</p>
                </div>
            </div>
            @endif

            {{-- FORMATION --}}
            <div class="sec-card">
                <div class="sec-hdr">
                    <div class="sec-ico" style="background:var(--violet-l)">📚</div>
                    <div><h3>Détails de la Formation</h3></div>
                </div>
                <div class="sec-body">
                    <div class="info-grid">
                        <div class="info-field full">
                            <div class="if-label">Titre</div>
                            <div class="if-val" style="font-size:1rem">{{ $formation->titre }}</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Durée totale</div>
                            <div class="if-val">{{ $formation->duree }}</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Nombre de leçons</div>
                            <div class="if-val">{{ $formation->nombre_lecons }} leçons</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Langue</div>
                            <div class="if-val">{{ $formation->langue }}</div>
                        </div>
                        <div class="info-field">
                            <div class="if-label">Prix</div>
                            <div class="if-val price">{{ number_format($formation->prix, 0, ',', ' ') }} {{ $formation->devise }}</div>
                        </div>
                        <div class="info-field full">
                            <div class="if-label">Description</div>
                            <div class="if-val long">{{ $formation->description }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROGRAMME --}}
            @if($formation->programme)
            <div class="sec-card">
                <div class="sec-hdr">
                    <div class="sec-ico" style="background:var(--green-l)">📋</div>
                    <div><h3>Programme de la formation</h3></div>
                </div>
                <div class="sec-body">
                    <div class="programme-list">
                        @foreach(explode("\n", $formation->programme) as $index => $ligne)
                            @if(trim($ligne))
                            <div class="prog-item">
                                <div class="prog-num">{{ $index + 1 }}</div>
                                <div class="prog-text">{{ trim($ligne) }}</div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- VIDÉO --}}
            @if($formation->video)
            <div class="sec-card">
                <div class="sec-hdr">
                    <div class="sec-ico" style="background:var(--red-l)">🎥</div>
                    <div><h3>Vidéo de présentation</h3></div>
                </div>
                <div class="sec-body">
                    @php
                        // Convertir lien YouTube en embed
                        $video = $formation->video;
                        $isYoutube = str_contains($video, 'youtube.com') || str_contains($video, 'youtu.be');
                        if($isYoutube) {
                            preg_match('/(?:v=|youtu\.be\/)([^&\?]+)/', $video, $m);
                            $youtubeId = $m[1] ?? null;
                        }
                    @endphp

                    @if($isYoutube && isset($youtubeId))
                        <div class="video-wrap">
                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    allowfullscreen></iframe>
                        </div>
                    @else
                        <a href="{{ $video }}" target="_blank" class="video-link">
                            ▶️ Voir la vidéo de présentation
                        </a>
                    @endif
                </div>
            </div>
            @endif

        </div>

        {{-- ═══ SIDEBAR DROITE ═══ --}}
        <div class="sidebar-col">

            {{-- Récapitulatif --}}
            <div class="sec-card">
                <div class="sec-hdr">
                    <div class="sec-ico" style="background:var(--gray-100)">📊</div>
                    <div><h3>Récapitulatif</h3></div>
                </div>
                <div class="sec-body">
                    <div style="display:flex;flex-direction:column;gap:.6rem">
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:.5rem .65rem;background:var(--gray-50);border-radius:var(--r-sm);border:1px solid var(--gray-100)">
                            <span style="font-size:.78rem;color:var(--gray-500)">Statut</span>
                            <span class="pill {{ $formation->statut === 'validee' ? 'green' : ($formation->statut === 'rejetee' ? '' : 'amber') }}"
                                  style="{{ $formation->statut === 'rejetee' ? 'background:var(--red-l);color:var(--red)' : '' }}">
                                {{ $formation->statut === 'validee' ? '✅ Validée' : ($formation->statut === 'rejetee' ? '❌ Rejetée' : '⏳ En attente') }}
                            </span>
                        </div>

                        @foreach([
                            ['📅', 'Soumis le', \Carbon\Carbon::parse($formation->created_at)->format('d/m/Y à H:i')],
                            ['📚', 'Leçons', $formation->nombre_lecons],
                            ['⏱', 'Durée', $formation->duree],
                            ['🌍', 'Langue', $formation->langue],
                            ['💰', 'Prix', number_format($formation->prix, 0, ',', ' ') . ' ' . $formation->devise],
                            ['🤝', 'Rémunération', $formation->remuneration ?? '—'],
                            ['🎓', 'Expérience', ($formation->annees_experience ?? '—') . ' ans'],
                        ] as [$ic, $lb, $vl])
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:.5rem .65rem;background:var(--gray-50);border-radius:var(--r-sm);border:1px solid var(--gray-100)">
                            <span style="font-size:.78rem;color:var(--gray-500)">{{ $ic }} {{ $lb }}</span>
                            <span style="font-size:.82rem;font-weight:700;color:var(--gray-800)">{{ $vl }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="divider"></div>

                    {{-- Image de couverture miniature --}}
                    @if($formation->image)
                    <div>
                        <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--gray-400);margin-bottom:.45rem">Image de couverture</div>
                        <img src="{{ asset('storage/' . $formation->image) }}"
                             style="width:100%;border-radius:var(--r-sm);border:1px solid var(--gray-200);object-fit:cover;height:120px;"
                             alt="Couverture">
                    </div>
                    @endif

                    <div class="divider"></div>

                    {{-- Actions --}}
                    @if($formation->statut === 'en_attente')
                    <div style="display:flex;flex-direction:column;gap:.5rem">
                        <form method="POST" action="{{ route('admin.formation.valider', $formation->id) }}">
                            @csrf
                            <button class="btn-action btn-validate" type="submit" style="width:100%;justify-content:center">
                                ✅ Valider la formation
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.formation.rejeter', $formation->id) }}">
                            @csrf
                            <button class="btn-action btn-reject" type="submit" style="width:100%;justify-content:center">
                                ❌ Rejeter
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
