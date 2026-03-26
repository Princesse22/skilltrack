<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Dashboard Formateur</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#2563eb;--blue-d:#1d4ed8;--blue-l:#dbeafe;--blue-xl:#eff6ff;
  --indigo:#4f46e5;--violet:#7c3aed;--violet-l:#ede9fe;
  --green:#059669;--green-l:#d1fae5;--green-d:#047857;
  --amber:#d97706;--amber-l:#fef3c7;
  --red:#dc2626;--red-l:#fee2e2;
  --orange:#ea580c;--orange-l:#ffedd5;
  --cyan:#0891b2;--cyan-l:#cffafe;
  --gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;
  --gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;
  --gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;
  --white:#fff;
  --sidebar-w:240px;
  --font:'DM Sans',sans-serif;
  --display:'DM Serif Display',serif;
  --radius:12px;--radius-sm:8px;--radius-xs:6px;
  --shadow-sm:0 1px 3px rgba(0,0,0,.06),0 1px 2px rgba(0,0,0,.04);
  --shadow:0 4px 16px rgba(0,0,0,.08);
  --shadow-lg:0 12px 40px rgba(0,0,0,.12);
}

html,body{height:100%;font-family:var(--font);background:var(--gray-50);color:var(--gray-800);overflow:hidden}

/* ══ APP SHELL ══ */
.app{display:flex;height:100vh;width:100vw}

/* ══════════════════════════════════
   SIDEBAR
══════════════════════════════════ */
.sidebar{
  width:var(--sidebar-w);flex-shrink:0;
  background:var(--gray-900);
  display:flex;flex-direction:column;
  overflow:hidden;position:relative;
  transition:width .3s ease;
}
.sidebar::after{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse at 10% 0%,rgba(37,99,235,.15) 0%,transparent 50%);
  pointer-events:none;
}

/* Logo */
.sidebar-logo{
  padding:1.4rem 1.4rem 1rem;
  display:flex;align-items:center;gap:.7rem;
  border-bottom:1px solid rgba(255,255,255,.06);
  position:relative;z-index:1;
}
.logo-icon{
  width:34px;height:34px;background:var(--blue);border-radius:var(--radius-xs);
  display:flex;align-items:center;justify-content:center;
  font-weight:900;font-size:.9rem;color:#fff;flex-shrink:0;
  box-shadow:0 4px 12px rgba(37,99,235,.4);
}
.logo-text{font-weight:800;font-size:1.05rem;color:#fff;letter-spacing:-.3px}
.logo-text span{color:#60a5fa}

/* Nav */
.sidebar-nav{flex:1;padding:.8rem .7rem;overflow-y:auto;position:relative;z-index:1}
.sidebar-nav::-webkit-scrollbar{width:0}

.nav-group-label{
  font-size:.63rem;font-weight:700;letter-spacing:1.4px;text-transform:uppercase;
  color:rgba(255,255,255,.25);padding:.6rem .6rem .3rem;margin-top:.4rem;
}

.nav-item{
  display:flex;align-items:center;gap:.7rem;
  padding:.62rem .75rem;border-radius:var(--radius-sm);
  cursor:pointer;transition:all .18s;
  font-size:.85rem;font-weight:500;color:rgba(255,255,255,.5);
  margin-bottom:.1rem;position:relative;
  text-decoration:none;
}
.nav-item:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.85)}
.nav-item.active{background:rgba(37,99,235,.25);color:#fff;font-weight:600}
.nav-item.active::before{
  content:'';position:absolute;left:0;top:20%;bottom:20%;
  width:3px;background:var(--blue);border-radius:0 3px 3px 0;
}
.nav-item .ni-icon{font-size:1rem;width:20px;text-align:center;flex-shrink:0}
.nav-item .ni-badge{
  margin-left:auto;min-width:18px;height:18px;
  background:var(--blue);color:#fff;border-radius:99px;
  font-size:.65rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;padding:0 .35rem;
}
.nav-item .ni-badge.amber{background:var(--amber)}
.nav-item .ni-badge.green{background:var(--green)}

/* User card */
.sidebar-user{
  padding:1rem .9rem;border-top:1px solid rgba(255,255,255,.06);
  display:flex;align-items:center;gap:.7rem;
  position:relative;z-index:1;cursor:pointer;transition:background .2s;
  border-radius:0;
}
.sidebar-user:hover{background:rgba(255,255,255,.04)}
.user-avatar{
  width:34px;height:34px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,var(--blue),var(--indigo));
  display:flex;align-items:center;justify-content:center;
  font-weight:700;font-size:.85rem;color:#fff;
}
.user-info{flex:1;min-width:0}
.user-name{font-size:.82rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.user-role{font-size:.7rem;color:rgba(255,255,255,.35)}
.user-arrow{font-size:.7rem;color:rgba(255,255,255,.3)}

/* ══════════════════════════════════
   TOPBAR
══════════════════════════════════ */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0}
.topbar{
  height:56px;background:var(--white);border-bottom:1px solid var(--gray-200);
  display:flex;align-items:center;padding:0 2rem;gap:1rem;
  flex-shrink:0;box-shadow:var(--shadow-sm);
}
.topbar-title{font-size:1rem;font-weight:700;color:var(--gray-900)}
.topbar-search{
  flex:1;max-width:320px;margin-left:1.5rem;
  display:flex;align-items:center;gap:.6rem;
  background:var(--gray-100);border-radius:var(--radius-sm);
  padding:.4rem .9rem;border:1.5px solid transparent;transition:all .2s;
}
.topbar-search:focus-within{background:var(--white);border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-l)}
.topbar-search input{background:transparent;border:none;outline:none;font-family:var(--font);font-size:.83rem;color:var(--gray-800);flex:1}
.topbar-search input::placeholder{color:var(--gray-400)}
.topbar-actions{margin-left:auto;display:flex;align-items:center;gap:.6rem}

.btn-icon{
  width:36px;height:36px;border-radius:var(--radius-sm);border:none;
  background:var(--gray-100);cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;color:var(--gray-500);transition:all .18s;position:relative;
}
.btn-icon:hover{background:var(--gray-200);color:var(--gray-700)}
.btn-icon .notif-dot{
  position:absolute;top:6px;right:6px;width:7px;height:7px;
  background:var(--red);border-radius:50%;border:1.5px solid var(--white);
}

.btn-new{
  display:inline-flex;align-items:center;gap:.45rem;
  padding:.5rem 1.1rem;background:var(--blue);color:#fff;
  border:none;border-radius:var(--radius-sm);font-family:var(--font);
  font-size:.82rem;font-weight:600;cursor:pointer;transition:all .2s;
  box-shadow:0 2px 8px rgba(37,99,235,.3);
}
.btn-new:hover{background:var(--blue-d);transform:translateY(-1px);box-shadow:0 4px 14px rgba(37,99,235,.4)}

/* ══════════════════════════════════
   MAIN CONTENT
══════════════════════════════════ */
.content{flex:1;overflow-y:auto;padding:1.8rem 2rem}
.content::-webkit-scrollbar{width:5px}
.content::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:99px}

/* Page panels */
.page-panel{display:none;animation:fadeUp .3s ease}
.page-panel.active{display:block}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* ══ PAGE HEADER ══ */
.page-hdr{margin-bottom:1.8rem}
.page-hdr h1{font-family:var(--display);font-size:1.6rem;color:var(--gray-900);line-height:1.2}
.page-hdr p{font-size:.875rem;color:var(--gray-500);margin-top:.3rem}

/* ══ STAT CARDS ══ */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem;margin-bottom:2rem}
.stat-card{
  background:var(--white);border-radius:var(--radius);padding:1.3rem 1.4rem;
  box-shadow:var(--shadow-sm);border:1px solid var(--gray-200);
  position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s;cursor:default;
}
.stat-card:hover{transform:translateY(-2px);box-shadow:var(--shadow)}
.stat-card::before{
  content:'';position:absolute;top:-20px;right:-20px;
  width:80px;height:80px;border-radius:50%;opacity:.07;
}
.stat-card.blue::before{background:var(--blue)}
.stat-card.green::before{background:var(--green)}
.stat-card.amber::before{background:var(--amber)}
.stat-card.violet::before{background:var(--violet)}

.stat-top{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.8rem}
.stat-icon{
  width:38px;height:38px;border-radius:var(--radius-sm);
  display:flex;align-items:center;justify-content:center;font-size:1.1rem;
}
.stat-icon.blue{background:var(--blue-l)}
.stat-icon.green{background:var(--green-l)}
.stat-icon.amber{background:var(--amber-l)}
.stat-icon.violet{background:var(--violet-l)}

.stat-trend{font-size:.72rem;font-weight:600;padding:.15rem .45rem;border-radius:99px;display:flex;align-items:center;gap:.2rem}
.stat-trend.up{background:var(--green-l);color:var(--green-d)}
.stat-trend.down{background:var(--red-l);color:var(--red)}

.stat-val{font-size:1.75rem;font-weight:800;color:var(--gray-900);line-height:1;margin-bottom:.25rem}
.stat-label{font-size:.78rem;color:var(--gray-500);font-weight:500}

/* ══ GRID 2 COL ══ */
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.4rem;margin-bottom:1.4rem}
.grid-3{display:grid;grid-template-columns:2fr 1fr;gap:1.4rem;margin-bottom:1.4rem}

/* ══ SECTION CARDS ══ */
.sec-card{
  background:var(--white);border-radius:var(--radius);
  box-shadow:var(--shadow-sm);border:1px solid var(--gray-200);overflow:hidden;
}
.sec-card-hdr{
  padding:1rem 1.3rem;border-bottom:1px solid var(--gray-100);
  display:flex;align-items:center;justify-content:space-between;
}
.sec-card-hdr h3{font-size:.9rem;font-weight:700;color:var(--gray-800)}
.sec-card-hdr p{font-size:.75rem;color:var(--gray-400);margin-top:.1rem}
.sec-card-body{padding:1.2rem 1.3rem}

.btn-link{background:none;border:none;font-family:var(--font);font-size:.78rem;font-weight:600;color:var(--blue);cursor:pointer;padding:0;transition:color .2s}
.btn-link:hover{color:var(--blue-d)}

/* ══ FORMATION ROWS ══ */
.formation-list{display:flex;flex-direction:column;gap:.6rem}
.formation-row{
  display:flex;align-items:center;gap:1rem;
  padding:.75rem;border-radius:var(--radius-sm);
  border:1px solid var(--gray-100);transition:all .2s;cursor:pointer;
}
.formation-row:hover{background:var(--gray-50);border-color:var(--gray-200)}
.fr-thumb{
  width:48px;height:36px;border-radius:var(--radius-xs);
  background:linear-gradient(135deg,var(--blue-l),var(--violet-l));
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;flex-shrink:0;
}
.fr-info{flex:1;min-width:0}
.fr-title{font-size:.85rem;font-weight:600;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.fr-meta{font-size:.73rem;color:var(--gray-400);margin-top:.1rem}
.fr-stats{display:flex;gap:.75rem;flex-shrink:0}
.fr-stat{text-align:right}
.fr-stat .fs-val{font-size:.88rem;font-weight:700;color:var(--gray-800)}
.fr-stat .fs-lbl{font-size:.65rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:.4px}

.status-pill{
  display:inline-flex;align-items:center;gap:.3rem;
  padding:.18rem .6rem;border-radius:99px;font-size:.68rem;font-weight:700;
}
.status-pill.active{background:var(--green-l);color:var(--green-d)}
.status-pill.pending{background:var(--amber-l);color:var(--amber)}
.status-pill.draft{background:var(--gray-100);color:var(--gray-500)}
.status-pill.rejected{background:var(--red-l);color:var(--red)}

/* ══ PROGRESS BAR ══ */
.mini-prog{height:4px;background:var(--gray-200);border-radius:99px;overflow:hidden;margin-top:.4rem}
.mini-prog-fill{height:100%;border-radius:99px;transition:width .6s ease}
.mini-prog-fill.blue{background:linear-gradient(90deg,var(--blue),#60a5fa)}
.mini-prog-fill.green{background:linear-gradient(90deg,var(--green),#34d399)}
.mini-prog-fill.amber{background:linear-gradient(90deg,var(--amber),#fbbf24)}

/* ══ REVENUE CHART ══ */
.chart-wrap{height:140px;display:flex;align-items:flex-end;gap:6px;padding:.5rem 0}
.bar-col{flex:1;display:flex;flex-direction:column;align-items:center;gap:.3rem}
.bar{
  width:100%;border-radius:4px 4px 0 0;transition:opacity .2s;cursor:pointer;
  min-height:4px;
}
.bar:hover{opacity:.8}
.bar-col span{font-size:.62rem;color:var(--gray-400);font-weight:500}

/* ══ RECENT APPRENANTS ══ */
.apprenant-list{display:flex;flex-direction:column;gap:.5rem}
.apprenant-row{
  display:flex;align-items:center;gap:.75rem;
  padding:.6rem .75rem;border-radius:var(--radius-sm);
  transition:background .2s;cursor:pointer;
}
.apprenant-row:hover{background:var(--gray-50)}
.av{
  width:32px;height:32px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-size:.78rem;font-weight:700;color:#fff;
}
.apprenant-info{flex:1}
.apprenant-name{font-size:.83rem;font-weight:600;color:var(--gray-800)}
.apprenant-course{font-size:.72rem;color:var(--gray-400)}
.apprenant-score{
  font-size:.75rem;font-weight:700;padding:.15rem .5rem;
  border-radius:99px;
}
.apprenant-score.high{background:var(--green-l);color:var(--green-d)}
.apprenant-score.mid{background:var(--amber-l);color:var(--amber)}
.apprenant-score.low{background:var(--red-l);color:var(--red)}

/* ══ NOTIFS ══ */
.notif-list{display:flex;flex-direction:column;gap:.4rem}
.notif-item{
  display:flex;align-items:flex-start;gap:.75rem;
  padding:.65rem .75rem;border-radius:var(--radius-sm);
  background:var(--gray-50);border:1px solid var(--gray-100);
  cursor:pointer;transition:all .2s;
}
.notif-item:hover{border-color:var(--gray-200);background:var(--white)}
.notif-item.unread{background:var(--blue-xl);border-color:var(--blue-l)}
.notif-icon{width:30px;height:30px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.85rem}
.notif-icon.blue{background:var(--blue-l)}
.notif-icon.green{background:var(--green-l)}
.notif-icon.amber{background:var(--amber-l)}
.notif-icon.red{background:var(--red-l)}
.notif-content{flex:1}
.notif-text{font-size:.8rem;color:var(--gray-700);font-weight:500;line-height:1.4}
.notif-time{font-size:.68rem;color:var(--gray-400);margin-top:.15rem}

/* ══ MENSUALITÉS TABLE ══ */
.rev-table{width:100%;border-collapse:collapse}
.rev-table th{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--gray-400);padding:.5rem .75rem;text-align:left;border-bottom:1px solid var(--gray-200)}
.rev-table td{font-size:.82rem;padding:.65rem .75rem;border-bottom:1px solid var(--gray-100);color:var(--gray-700)}
.rev-table tr:last-child td{border-bottom:none}
.rev-table tr:hover td{background:var(--gray-50)}
.rev-amount{font-weight:700;color:var(--gray-900)}
.rev-amount.positive{color:var(--green-d)}

/* ══ PAGES SECONDAIRES ══ */
/* Formations page */
.formations-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem}
.fc{
  background:var(--white);border-radius:var(--radius);border:1px solid var(--gray-200);
  overflow:hidden;transition:all .2s;cursor:pointer;
}
.fc:hover{transform:translateY(-3px);box-shadow:var(--shadow)}
.fc-thumb{height:100px;display:flex;align-items:center;justify-content:center;font-size:2.5rem;position:relative}
.fc-thumb.blue{background:linear-gradient(135deg,#dbeafe,#ede9fe)}
.fc-thumb.green{background:linear-gradient(135deg,#d1fae5,#cffafe)}
.fc-thumb.amber{background:linear-gradient(135deg,#fef3c7,#ffedd5)}
.fc-body{padding:1rem}
.fc-title{font-size:.88rem;font-weight:700;color:var(--gray-800);margin-bottom:.35rem;line-height:1.3}
.fc-meta{font-size:.73rem;color:var(--gray-400);margin-bottom:.65rem}
.fc-stats{display:flex;justify-content:space-between}
.fc-stats .fcs{text-align:center}
.fc-stats .fcs .fcs-v{font-size:.9rem;font-weight:700;color:var(--gray-800)}
.fc-stats .fcs .fcs-l{font-size:.65rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:.3px}
.fc-footer{padding:.7rem 1rem;border-top:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between}

/* Tabs */
.tabs{display:flex;gap:.2rem;background:var(--gray-100);padding:.25rem;border-radius:var(--radius-sm);margin-bottom:1.4rem;width:fit-content}
.tab{padding:.45rem 1rem;border-radius:var(--radius-xs);font-size:.82rem;font-weight:600;color:var(--gray-500);cursor:pointer;transition:all .2s;border:none;background:transparent;font-family:var(--font)}
.tab.active{background:var(--white);color:var(--blue);box-shadow:var(--shadow-sm)}

/* Apprenants page */
.app-table{width:100%;border-collapse:collapse}
.app-table th{font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--gray-400);padding:.75rem 1rem;text-align:left;background:var(--gray-50);border-bottom:1px solid var(--gray-200)}
.app-table td{font-size:.83rem;padding:.75rem 1rem;border-bottom:1px solid var(--gray-100);color:var(--gray-700);vertical-align:middle}
.app-table tr:hover td{background:var(--gray-50)}
.app-av-row{display:flex;align-items:center;gap:.65rem}

/* Revenue page */
.rev-summary{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem}
.rs-card{background:var(--white);border:1px solid var(--gray-200);border-radius:var(--radius);padding:1.2rem 1.4rem}
.rs-val{font-size:1.5rem;font-weight:800;color:var(--gray-900)}
.rs-label{font-size:.75rem;color:var(--gray-400);margin-top:.2rem}
.rs-change{font-size:.75rem;font-weight:600;margin-top:.4rem}
.rs-change.up{color:var(--green-d)}
.rs-change.down{color:var(--red)}

/* ══ RESPONSIVE ══ */
@media(max-width:1100px){.stats-grid{grid-template-columns:repeat(2,1fr)}.formations-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:800px){.grid-2,.grid-3{grid-template-columns:1fr}.stats-grid{grid-template-columns:1fr 1fr}}
</style>
</head>
<body>
<div class="app">

<!-- ══════════════════════════════════
     SIDEBAR
══════════════════════════════════ -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">ST</div>
    <div class="logo-text">Skill<span>Tract</span></div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-group-label">Principal</div>
    <a class="nav-item active" onclick="showPage('dashboard')">
      <span class="ni-icon">🏠</span> Tableau de bord
    </a>
    <a class="nav-item" onclick="showPage('formations')">
      <span class="ni-icon">📚</span> Mes Formations
      <span class="ni-badge">3</span>
    </a>
    <a class="nav-item" onclick="showPage('apprenants')">
      <span class="ni-icon">👥</span> Apprenants
      <span class="ni-badge green">47</span>
    </a>
    <a class="nav-item" onclick="showPage('devoirs')">
      <span class="ni-icon">✏️</span> Devoirs & Soumissions
      <span class="ni-badge amber">8</span>
    </a>
    <a class="nav-item" onclick="showPage('quiz')">
      <span class="ni-icon">📝</span> Quiz & Résultats
    </a>

    <div class="nav-group-label">Revenus</div>
    <a class="nav-item" onclick="showPage('revenus')">
      <span class="ni-icon">💰</span> Revenus & Paiements
    </a>
    <a class="nav-item" onclick="showPage('factures')">
      <span class="ni-icon">🧾</span> Factures
    </a>

    <div class="nav-group-label">Compte</div>
    <a class="nav-item" onclick="showPage('profil')">
      <span class="ni-icon">👤</span> Mon Profil
    </a>
    <a class="nav-item" onclick="showPage('notifications')">
      <span class="ni-icon">🔔</span> Notifications
      <span class="ni-badge">5</span>
    </a>
    <a class="nav-item">
      <span class="ni-icon">⚙️</span> Paramètres
    </a>
    <a class="nav-item" style="margin-top:.5rem;color:rgba(220,38,38,.6)" onclick="showPage('logout')">
      <span class="ni-icon">🚪</span> Déconnexion
    </a>
  </nav>

  <div class="sidebar-user">
    <div class="user-avatar">JM</div>
    <div class="user-info">
      <div class="user-name">Jean-Paul Mbarga</div>
      <div class="user-role">Formateur certifié</div>
    </div>
    <span class="user-arrow">⌄</span>
  </div>
</aside>

<!-- ══════════════════════════════════
     MAIN
══════════════════════════════════ -->
<div class="main">
  <!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-title" id="topbarTitle">Tableau de bord</div>
    <div class="topbar-search">
        <span style="color:var(--gray-400);font-size:.85rem">🔍</span>
        <input type="text" placeholder="Rechercher une formation, un apprenant…">
    </div>
    <div class="topbar-actions">
        <button class="btn-icon" title="Notifications">
            🔔<span class="notif-dot"></span>
        </button>
        <button class="btn-icon" title="Messages">💬</button>

        <a href="{{ route('partenaire.index') }}" class="btn-new">
            ＋ Nouvelle formation
        </a>
    </div>
</div>

  <!-- CONTENT -->
  <div class="content">

    <!-- ═══════════ DASHBOARD ═══════════ -->
    <div class="page-panel active" id="page-dashboard">
      <div class="page-hdr">
        <h1>Bonjour, Jean-Paul 👋</h1>
        <p>Voici un aperçu de votre activité ce mois-ci</p>
      </div>

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card blue">
          <div class="stat-top">
            <div class="stat-icon blue">📚</div>
            <div class="stat-trend up">↑ +1</div>
          </div>
          <div class="stat-val">3</div>
          <div class="stat-label">Formations actives</div>
        </div>
        <div class="stat-card green">
          <div class="stat-top">
            <div class="stat-icon green">👥</div>
            <div class="stat-trend up">↑ +12</div>
          </div>
          <div class="stat-val">47</div>
          <div class="stat-label">Apprenants inscrits</div>
        </div>
        <div class="stat-card amber">
          <div class="stat-top">
            <div class="stat-icon amber">💰</div>
            <div class="stat-trend up">↑ +18%</div>
          </div>
          <div class="stat-val">342k</div>
          <div class="stat-label">Revenus (FCFA)</div>
        </div>
        <div class="stat-card violet">
          <div class="stat-top">
            <div class="stat-icon violet">⭐</div>
            <div class="stat-trend up">↑ 0.2</div>
          </div>
          <div class="stat-val">4.7</div>
          <div class="stat-label">Note moyenne</div>
        </div>
      </div>

      <div class="grid-3">
        <!-- Formations -->
        <div class="sec-card">
          <div class="sec-card-hdr">
            <div><h3>Mes formations</h3><p>Performances du mois</p></div>
            <button class="btn-link" onclick="showPage('formations')">Voir tout →</button>
          </div>
          <div class="sec-card-body">
            <div class="formation-list">
              <div class="formation-row">
                <div class="fr-thumb">📱</div>
                <div class="fr-info">
                  <div class="fr-title">Marketing Digital Complet</div>
                  <div class="fr-meta">28 apprenants · <span class="status-pill active">● Active</span></div>
                  <div class="mini-prog"><div class="mini-prog-fill blue" style="width:78%"></div></div>
                </div>
                <div class="fr-stats">
                  <div class="fr-stat"><div class="fs-val">78%</div><div class="fs-lbl">Taux</div></div>
                  <div class="fr-stat"><div class="fs-val">182k</div><div class="fs-lbl">FCFA</div></div>
                </div>
              </div>
              <div class="formation-row">
                <div class="fr-thumb">🎨</div>
                <div class="fr-info">
                  <div class="fr-title">Infographie avec Canva</div>
                  <div class="fr-meta">14 apprenants · <span class="status-pill active">● Active</span></div>
                  <div class="mini-prog"><div class="mini-prog-fill green" style="width:55%"></div></div>
                </div>
                <div class="fr-stats">
                  <div class="fr-stat"><div class="fs-val">55%</div><div class="fs-lbl">Taux</div></div>
                  <div class="fr-stat"><div class="fs-val">98k</div><div class="fs-lbl">FCFA</div></div>
                </div>
              </div>
              <div class="formation-row">
                <div class="fr-thumb">💼</div>
                <div class="fr-info">
                  <div class="fr-title">Bureautique Avancée</div>
                  <div class="fr-meta">5 apprenants · <span class="status-pill pending">⏳ En attente</span></div>
                  <div class="mini-prog"><div class="mini-prog-fill amber" style="width:20%"></div></div>
                </div>
                <div class="fr-stats">
                  <div class="fr-stat"><div class="fs-val">20%</div><div class="fs-lbl">Taux</div></div>
                  <div class="fr-stat"><div class="fs-val">62k</div><div class="fs-lbl">FCFA</div></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Notifications -->
        <div class="sec-card">
          <div class="sec-card-hdr">
            <div><h3>Notifications</h3><p>5 non lues</p></div>
            <button class="btn-link" onclick="showPage('notifications')">Tout voir →</button>
          </div>
          <div class="sec-card-body">
            <div class="notif-list">
              <div class="notif-item unread">
                <div class="notif-icon blue">📝</div>
                <div class="notif-content">
                  <div class="notif-text">Amina K. a soumis son devoir – Leçon 3</div>
                  <div class="notif-time">Il y a 10 min</div>
                </div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon green">✅</div>
                <div class="notif-content">
                  <div class="notif-text">Paul T. a validé le quiz final avec 85%</div>
                  <div class="notif-time">Il y a 1h</div>
                </div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon amber">⭐</div>
                <div class="notif-content">
                  <div class="notif-text">Nouvelle évaluation 5⭐ sur Marketing Digital</div>
                  <div class="notif-time">Il y a 3h</div>
                </div>
              </div>
              <div class="notif-item">
                <div class="notif-icon blue">👤</div>
                <div class="notif-content">
                  <div class="notif-text">3 nouveaux inscrits sur Infographie Canva</div>
                  <div class="notif-time">Hier à 14h32</div>
                </div>
              </div>
              <div class="notif-item">
                <div class="notif-icon green">💰</div>
                <div class="notif-content">
                  <div class="notif-text">Virement de 45 000 FCFA effectué</div>
                  <div class="notif-time">Hier à 09h00</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid-2">
        <!-- Revenus chart -->
        <div class="sec-card">
          <div class="sec-card-hdr">
            <div><h3>Revenus mensuels</h3><p>6 derniers mois · FCFA</p></div>
            <button class="btn-link" onclick="showPage('revenus')">Détails →</button>
          </div>
          <div class="sec-card-body">
            <div style="display:flex;align-items:baseline;gap:.5rem;margin-bottom:.5rem">
              <span style="font-size:1.4rem;font-weight:800;color:var(--gray-900)">342 000</span>
              <span style="font-size:.78rem;color:var(--green-d);font-weight:600">↑ +18% vs mois dernier</span>
            </div>
            <div class="chart-wrap" id="revenueChart"></div>
          </div>
        </div>

        <!-- Apprenants récents -->
        <div class="sec-card">
          <div class="sec-card-hdr">
            <div><h3>Apprenants récents</h3><p>Derniers inscrits</p></div>
            <button class="btn-link" onclick="showPage('apprenants')">Voir tout →</button>
          </div>
          <div class="sec-card-body">
            <div class="apprenant-list" id="recentApprenants"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══════════ FORMATIONS ═══════════ -->
    <div class="page-panel" id="page-formations">
      <div class="page-hdr" style="display:flex;align-items:flex-start;justify-content:space-between">
        <div><h1>Mes Formations</h1><p>Gérez et suivez vos formations</p></div>
        <button class="btn-new" onclick="showPage('nouvelle-formation')">＋ Nouvelle formation</button>
      </div>
      <div class="tabs">
        <button class="tab active">Toutes (3)</button>
        <button class="tab">Actives (2)</button>
        <button class="tab">En attente (1)</button>
        <button class="tab">Brouillons (0)</button>
      </div>
      <div class="formations-grid">
        <div class="fc">
          <div class="fc-thumb blue">📱</div>
          <div class="fc-body">
            <div class="fc-title">Marketing Digital Complet</div>
            <div class="fc-meta">10 leçons · 2 quiz · Niveau intermédiaire</div>
            <div class="fc-stats">
              <div class="fcs"><div class="fcs-v">28</div><div class="fcs-l">Apprenants</div></div>
              <div class="fcs"><div class="fcs-v">78%</div><div class="fcs-l">Complétion</div></div>
              <div class="fcs"><div class="fcs-v">4.8⭐</div><div class="fcs-l">Note</div></div>
            </div>
          </div>
          <div class="fc-footer">
            <span class="status-pill active">● Active</span>
            <button class="btn-link">Gérer →</button>
          </div>
        </div>
        <div class="fc">
          <div class="fc-thumb green">🎨</div>
          <div class="fc-body">
            <div class="fc-title">Infographie avec Canva</div>
            <div class="fc-meta">8 leçons · 1 quiz · Niveau débutant</div>
            <div class="fc-stats">
              <div class="fcs"><div class="fcs-v">14</div><div class="fcs-l">Apprenants</div></div>
              <div class="fcs"><div class="fcs-v">55%</div><div class="fcs-l">Complétion</div></div>
              <div class="fcs"><div class="fcs-v">4.6⭐</div><div class="fcs-l">Note</div></div>
            </div>
          </div>
          <div class="fc-footer">
            <span class="status-pill active">● Active</span>
            <button class="btn-link">Gérer →</button>
          </div>
        </div>
        <div class="fc">
          <div class="fc-thumb amber">💼</div>
          <div class="fc-body">
            <div class="fc-title">Bureautique Avancée</div>
            <div class="fc-meta">12 leçons · 2 quiz · Niveau avancé</div>
            <div class="fc-stats">
              <div class="fcs"><div class="fcs-v">5</div><div class="fcs-l">Apprenants</div></div>
              <div class="fcs"><div class="fcs-v">20%</div><div class="fcs-l">Complétion</div></div>
              <div class="fcs"><div class="fcs-v">—</div><div class="fcs-l">Note</div></div>
            </div>
          </div>
          <div class="fc-footer">
            <span class="status-pill pending">⏳ En attente</span>
            <button class="btn-link">Gérer →</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══════════ APPRENANTS ═══════════ -->
    <div class="page-panel" id="page-apprenants">
      <div class="page-hdr"><h1>Apprenants</h1><p>47 inscrits sur vos formations</p></div>
      <div class="tabs">
        <button class="tab active">Tous (47)</button>
        <button class="tab">En cours (31)</button>
        <button class="tab">Validés (12)</button>
        <button class="tab">Abandons (4)</button>
      </div>
      <div class="sec-card">
        <div class="sec-card-body" style="padding:0">
          <table class="app-table">
            <thead>
              <tr><th>Apprenant</th><th>Formation</th><th>Progression</th><th>Dernier accès</th><th>Score quiz</th><th>Statut</th></tr>
            </thead>
            <tbody id="appTable"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ═══════════ DEVOIRS ═══════════ -->
    <div class="page-panel" id="page-devoirs">
      <div class="page-hdr"><h1>Devoirs & Soumissions</h1><p>8 devoirs en attente de correction</p></div>
      <div class="sec-card">
        <div class="sec-card-body" style="padding:0">
          <table class="app-table">
            <thead>
              <tr><th>Apprenant</th><th>Formation · Leçon</th><th>Soumis le</th><th>Fichier</th><th>Statut</th><th>Action</th></tr>
            </thead>
            <tbody id="devoirsTable"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ═══════════ QUIZ ═══════════ -->
    <div class="page-panel" id="page-quiz">
      <div class="page-hdr"><h1>Quiz & Résultats</h1><p>Résultats des évaluations</p></div>
      <div class="sec-card">
        <div class="sec-card-body" style="padding:0">
          <table class="app-table">
            <thead>
              <tr><th>Apprenant</th><th>Formation</th><th>Quiz</th><th>Score</th><th>Date</th><th>Résultat</th></tr>
            </thead>
            <tbody id="quizTable"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ═══════════ REVENUS ═══════════ -->
    <div class="page-panel" id="page-revenus">
      <div class="page-hdr"><h1>Revenus & Paiements</h1><p>Suivi de vos gains sur SkillTract</p></div>
      <div class="rev-summary">
        <div class="rs-card"><div class="rs-val">342 000 F</div><div class="rs-label">Ce mois-ci</div><div class="rs-change up">↑ +18% vs mois dernier</div></div>
        <div class="rs-card"><div class="rs-val">1 820 000 F</div><div class="rs-label">Total cumulé</div><div class="rs-change up">↑ Depuis jan. 2025</div></div>
        <div class="rs-card"><div class="rs-val">245 000 F</div><div class="rs-label">En attente de virement</div><div class="rs-change" style="color:var(--amber)">⏳ Virement prévu le 1er</div></div>
      </div>
      <div class="sec-card">
        <div class="sec-card-hdr"><h3>Historique des transactions</h3></div>
        <div class="sec-card-body" style="padding:0">
          <table class="rev-table" id="revTable"></table>
        </div>
      </div>
    </div>

    <!-- ═══════════ NOTIFICATIONS ═══════════ -->
    <div class="page-panel" id="page-notifications">
      <div class="page-hdr"><h1>Notifications</h1><p>5 non lues</p></div>
      <div class="sec-card">
        <div class="sec-card-body">
          <div class="notif-list" id="allNotifList"></div>
        </div>
      </div>
    </div>

    <!-- ═══════════ PROFIL ═══════════ -->
    <div class="page-panel" id="page-profil">
      <div class="page-hdr"><h1>Mon Profil</h1><p>Gérez vos informations personnelles</p></div>
      <div class="grid-2">
        <div class="sec-card">
          <div class="sec-card-hdr"><h3>Informations personnelles</h3></div>
          <div class="sec-card-body">
            <div style="display:flex;align-items:center;gap:1.2rem;margin-bottom:1.5rem">
              <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--blue),var(--indigo));display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.3rem;color:#fff;flex-shrink:0">JM</div>
              <div><div style="font-weight:700;font-size:1rem">Jean-Paul Mbarga</div><div style="font-size:.8rem;color:var(--gray-500)">Formateur certifié · Marketing Digital</div></div>
            </div>
            <div style="display:flex;flex-direction:column;gap:.75rem">
              ${[['✉️','Email','jeanpaul.mbarga@email.com'],['📱','Téléphone','+237 697 123 456'],['🎓','Domaine','Marketing Digital'],['📅','Membre depuis','Janvier 2025'],['⭐','Note moyenne','4.7 / 5']].map(([i,l,v])=>`<div style="display:flex;align-items:center;gap:.75rem;padding:.6rem;background:var(--gray-50);border-radius:var(--radius-xs)"><span>${i}</span><span style="font-size:.75rem;color:var(--gray-400);width:100px;flex-shrink:0">${l}</span><span style="font-size:.85rem;font-weight:500">${v}</span></div>`).join('')}
            </div>
          </div>
        </div>
        <div class="sec-card">
          <div class="sec-card-hdr"><h3>Statistiques globales</h3></div>
          <div class="sec-card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
              ${[['📚','Formations','3'],['👥','Apprenants','47'],['💰','Revenus totaux','1.82M F'],['⭐','Évaluations','38'],['✅','Taux réussite','74%'],['🏆','Attestations','18']].map(([i,l,v])=>`<div style="background:var(--gray-50);border-radius:var(--radius-sm);padding:.9rem;text-align:center"><div style="font-size:1.3rem">${i}</div><div style="font-size:1rem;font-weight:800;color:var(--gray-900);margin:.2rem 0">${v}</div><div style="font-size:.72rem;color:var(--gray-400)">${l}</div></div>`).join('')}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══════════ NOUVELLE FORMATION ═══════════ -->
    <div class="page-panel" id="page-nouvelle-formation">
      <div class="page-hdr" style="display:flex;align-items:flex-start;justify-content:space-between">
        <div><h1>Nouvelle Formation</h1><p>Vous allez être redirigé vers le formulaire de soumission</p></div>
        <button class="btn-new" onclick="window.location.href='formulaire-formateur.html'">Ouvrir le formulaire →</button>
      </div>
      <div class="sec-card" style="max-width:600px">
        <div class="sec-card-body" style="text-align:center;padding:3rem">
          <div style="font-size:3rem;margin-bottom:1rem">📚</div>
          <div style="font-size:1.1rem;font-weight:700;color:var(--gray-800);margin-bottom:.5rem">Soumettre une nouvelle formation</div>
          <div style="font-size:.88rem;color:var(--gray-500);margin-bottom:1.5rem;line-height:1.6">Remplissez le formulaire en 6 étapes pour soumettre votre formation. Elle sera examinée par notre équipe avant d'être mise en ligne.</div>
          <button class="btn-new" style="margin:0 auto" onclick="window.location.href='formulaire-formateur.html'">Commencer le formulaire →</button>
        </div>
      </div>
    </div>

  </div><!-- end content -->
</div><!-- end main -->
</div><!-- end app -->

<script>
/* ═══════ NAVIGATION ═══════ */
const pages = {
  'dashboard':'Tableau de bord','formations':'Mes Formations','apprenants':'Apprenants',
  'devoirs':'Devoirs & Soumissions','quiz':'Quiz & Résultats','revenus':'Revenus & Paiements',
  'factures':'Factures','profil':'Mon Profil','notifications':'Notifications',
  'nouvelle-formation':'Nouvelle formation'
};

function showPage(id){
  document.querySelectorAll('.page-panel').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  const panel = document.getElementById('page-'+id);
  if(panel) panel.classList.add('active');
  document.getElementById('topbarTitle').textContent = pages[id]||id;
  // Active nav item
  document.querySelectorAll('.nav-item').forEach(n=>{
    if(n.textContent.includes(pages[id]?.split(' ')[0]||id)) n.classList.add('active');
  });
}

/* ═══════ CHART REVENUS ═══════ */
const months = ['Oct','Nov','Déc','Jan','Fév','Mar'];
const vals =   [180, 220, 195, 260, 290, 342];
const maxV = Math.max(...vals);
const colors = ['#dbeafe','#bfdbfe','#93c5fd','#60a5fa','#3b82f6','#2563eb'];

document.getElementById('revenueChart').innerHTML = months.map((m,i)=>`
  <div class="bar-col">
    <div class="bar" style="height:${Math.round(vals[i]/maxV*110)}px;background:${colors[i]};${i===5?'background:var(--blue)':''}" title="${vals[i]}k FCFA"></div>
    <span>${m}</span>
  </div>
`).join('');

/* ═══════ APPRENANTS RÉCENTS ═══════ */
const apprenants = [
  {init:'AK',name:'Amina Kamga',course:'Marketing Digital',score:85,color:'#2563eb'},
  {init:'PT',name:'Paul Tchamba',course:'Infographie Canva',score:72,color:'#059669'},
  {init:'MN',name:'Marie Nkomo',course:'Marketing Digital',score:91,color:'#7c3aed'},
  {init:'JF',name:'Jules Fomba',course:'Bureautique Avancée',score:45,color:'#d97706'},
  {init:'SB',name:'Sophie Bello',course:'Marketing Digital',score:68,color:'#0891b2'},
];
document.getElementById('recentApprenants').innerHTML = apprenants.map(a=>`
  <div class="apprenant-row">
    <div class="av" style="background:${a.color}">${a.init}</div>
    <div class="apprenant-info">
      <div class="apprenant-name">${a.name}</div>
      <div class="apprenant-course">${a.course}</div>
    </div>
    <span class="apprenant-score ${a.score>=70?'high':a.score>=50?'mid':'low'}">${a.score}%</span>
  </div>
`).join('');

/* ═══════ TABLE APPRENANTS ═══════ */
const allApp = [
  {init:'AK',name:'Amina Kamga',color:'#2563eb',course:'Marketing Digital',prog:78,access:'Aujourd\'hui',score:85,status:'active'},
  {init:'PT',name:'Paul Tchamba',color:'#059669',course:'Infographie Canva',prog:55,access:'Hier',score:72,status:'active'},
  {init:'MN',name:'Marie Nkomo',color:'#7c3aed',course:'Marketing Digital',prog:92,access:'Aujourd\'hui',score:91,status:'done'},
  {init:'JF',name:'Jules Fomba',color:'#d97706',course:'Bureautique Avancée',prog:20,access:'Il y a 3j',score:45,status:'active'},
  {init:'SB',name:'Sophie Bello',color:'#0891b2',course:'Marketing Digital',prog:40,access:'Il y a 2j',score:68,status:'active'},
  {init:'CR',name:'Christian Remy',color:'#dc2626',course:'Infographie Canva',prog:10,access:'Il y a 7j',score:0,status:'inactive'},
];
document.getElementById('appTable').innerHTML = allApp.map(a=>`
  <tr>
    <td><div class="app-av-row"><div class="av" style="background:${a.color};width:28px;height:28px;font-size:.72rem">${a.init}</div>${a.name}</div></td>
    <td>${a.course}</td>
    <td><div style="min-width:100px"><div style="font-size:.72rem;margin-bottom:3px">${a.prog}%</div><div class="mini-prog"><div class="mini-prog-fill blue" style="width:${a.prog}%"></div></div></div></td>
    <td>${a.access}</td>
    <td><span class="apprenant-score ${a.score>=70?'high':a.score>=50?'mid':'low'}">${a.score>0?a.score+'%':'—'}</span></td>
    <td><span class="status-pill ${a.status==='done'?'active':a.status==='inactive'?'draft':'pending'}">${a.status==='done'?'✅ Validé':a.status==='inactive'?'Inactif':'En cours'}</span></td>
  </tr>
`).join('');

/* ═══════ TABLE DEVOIRS ═══════ */
const devoirs=[
  {name:'Amina Kamga',color:'#2563eb',init:'AK',course:'Marketing Digital',lecon:'Leçon 3',date:'20/03/2026',file:'devoir_amina.pdf',status:'pending'},
  {name:'Paul Tchamba',color:'#059669',init:'PT',course:'Infographie Canva',lecon:'Leçon 2',date:'19/03/2026',file:'paul_canva.docx',status:'pending'},
  {name:'Marie Nkomo',color:'#7c3aed',init:'MN',course:'Marketing Digital',lecon:'Leçon 5',date:'18/03/2026',file:'marie_md5.pdf',status:'corrected'},
  {name:'Jules Fomba',color:'#d97706',init:'JF',course:'Bureautique Avancée',lecon:'Leçon 1',date:'17/03/2026',file:'jules_bureau.pdf',status:'pending'},
];
document.getElementById('devoirsTable').innerHTML = devoirs.map(d=>`
  <tr>
    <td><div class="app-av-row"><div class="av" style="background:${d.color};width:28px;height:28px;font-size:.72rem">${d.init}</div>${d.name}</div></td>
    <td>${d.course} · ${d.lecon}</td>
    <td>${d.date}</td>
    <td><a href="#" style="color:var(--blue);font-size:.8rem;font-weight:600">📎 ${d.file}</a></td>
    <td><span class="status-pill ${d.status==='corrected'?'active':'amber'}">${d.status==='corrected'?'✅ Corrigé':'⏳ En attente'}</span></td>
    <td><button class="btn-link">${d.status==='corrected'?'Voir':'Corriger →'}</button></td>
  </tr>
`).join('');

/* ═══════ TABLE QUIZ ═══════ */
const quizRes=[
  {name:'Amina Kamga',color:'#2563eb',init:'AK',course:'Marketing Digital',quiz:'Quiz Final',score:85,date:'20/03/2026'},
  {name:'Marie Nkomo',color:'#7c3aed',init:'MN',course:'Marketing Digital',quiz:'Quiz Partie 1',score:91,date:'18/03/2026'},
  {name:'Paul Tchamba',color:'#059669',init:'PT',course:'Infographie Canva',quiz:'Quiz Final',score:72,date:'17/03/2026'},
  {name:'Jules Fomba',color:'#d97706',init:'JF',course:'Bureautique',quiz:'Quiz Partie 1',score:45,date:'15/03/2026'},
  {name:'Sophie Bello',color:'#0891b2',init:'SB',course:'Marketing Digital',quiz:'Quiz Partie 1',score:68,date:'14/03/2026'},
];
document.getElementById('quizTable').innerHTML = quizRes.map(q=>`
  <tr>
    <td><div class="app-av-row"><div class="av" style="background:${q.color};width:28px;height:28px;font-size:.72rem">${q.init}</div>${q.name}</div></td>
    <td>${q.course}</td>
    <td>${q.quiz}</td>
    <td><span class="apprenant-score ${q.score>=70?'high':q.score>=50?'mid':'low'}">${q.score}%</span></td>
    <td>${q.date}</td>
    <td><span class="status-pill ${q.score>=70?'active':'rejected'}">${q.score>=70?'✅ Validé':'❌ Échoué'}</span></td>
  </tr>
`).join('');

/* ═══════ TABLE REVENUS ═══════ */
const revs=[
  ['Mars 2026','Marketing Digital','28 ventes','182 000','145 600','Viré','#059669'],
  ['Mars 2026','Infographie Canva','14 ventes','98 000','78 400','Viré','#059669'],
  ['Mars 2026','Bureautique Avancée','5 ventes','62 000','49 600','En attente','#d97706'],
  ['Fév. 2026','Marketing Digital','22 ventes','143 000','114 400','Viré','#059669'],
  ['Fév. 2026','Infographie Canva','11 ventes','77 000','61 600','Viré','#059669'],
];
document.getElementById('revTable').innerHTML =
  `<thead><tr><th>Période</th><th>Formation</th><th>Ventes</th><th>Brut (FCFA)</th><th>Net (FCFA)</th><th>Statut</th></tr></thead>
   <tbody>${revs.map(r=>`<tr>
     <td>${r[0]}</td><td>${r[1]}</td><td>${r[2]}</td>
     <td class="rev-amount">${parseInt(r[3]).toLocaleString()}</td>
     <td class="rev-amount positive">+ ${parseInt(r[4]).toLocaleString()}</td>
     <td><span class="status-pill ${r[5]==='Viré'?'active':'pending'}" style="color:${r[6]};background:${r[5]==='Viré'?'var(--green-l)':'var(--amber-l)'}">${r[5]==='Viré'?'✅':⏳} ${r[5]}</span></td>
   </tr>`).join('')}</tbody>`;

/* ═══════ NOTIFS COMPLÈTES ═══════ */
const allNotifs=[
  {icon:'📝',cls:'blue',text:'Amina K. a soumis son devoir – Leçon 3 (Marketing Digital)',time:'Il y a 10 min',unread:true},
  {icon:'✅',cls:'green',text:'Paul T. a validé le quiz final avec 85%',time:'Il y a 1h',unread:true},
  {icon:'⭐',cls:'amber',text:'Nouvelle évaluation 5⭐ sur Marketing Digital',time:'Il y a 3h',unread:true},
  {icon:'👤',cls:'blue',text:'3 nouveaux inscrits sur Infographie Canva',time:'Hier à 14h32',unread:true},
  {icon:'💰',cls:'green',text:'Virement de 45 000 FCFA effectué sur votre compte',time:'Hier à 09h00',unread:true},
  {icon:'🔔',cls:'amber',text:'Marie N. a terminé l\'intégralité de la formation Marketing Digital',time:'Il y a 2j',unread:false},
  {icon:'📝',cls:'blue',text:'Jules F. a soumis son devoir – Leçon 1 (Bureautique)',time:'Il y a 3j',unread:false},
  {icon:'⚠️',cls:'red',text:'Votre formation Bureautique est en attente de validation depuis 5 jours',time:'Il y a 5j',unread:false},
];
document.getElementById('allNotifList').innerHTML = allNotifs.map(n=>`
  <div class="notif-item ${n.unread?'unread':''}">
    <div class="notif-icon ${n.cls}">${n.icon}</div>
    <div class="notif-content">
      <div class="notif-text">${n.text}</div>
      <div class="notif-time">${n.time}</div>
    </div>
  </div>
`).join('');

/* ═══════ TABS (simple toggle) ═══════ */
document.querySelectorAll('.tabs').forEach(tabs=>{
  tabs.querySelectorAll('.tab').forEach(tab=>{
    tab.addEventListener('click',()=>{
      tabs.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
      tab.classList.add('active');
    });
  });
});
</script>
</body>
</html>
