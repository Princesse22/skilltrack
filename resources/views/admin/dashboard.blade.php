<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --ink:#0d1117; --ink2:#1c2333; --ink3:#2d3748;
  --blue:#2463eb; --blue-d:#1a4fd6; --blue-l:#dbeafe; --blue-xl:#eff6ff;
  --teal:#0d9488; --teal-l:#ccfbf1;
  --green:#16a34a; --green-l:#dcfce7; --green-d:#15803d;
  --amber:#b45309; --amber-l:#fef3c7; --amber-bg:#fffbeb;
  --red:#dc2626; --red-l:#fee2e2; --red-d:#b91c1c;
  --violet:#7c3aed; --violet-l:#ede9fe;
  --orange:#ea580c; --orange-l:#ffedd5;
  --gray-50:#f9fafb; --gray-100:#f3f4f6; --gray-200:#e5e7eb;
  --gray-300:#d1d5db; --gray-400:#9ca3af; --gray-500:#6b7280;
  --gray-600:#4b5563; --gray-700:#374151; --gray-800:#1f2937; --gray-900:#111827;
  --white:#fff;
  --sidebar-w:256px;
  --font:'Instrument Sans',sans-serif;
  --serif:'Instrument Serif',serif;
  --r:10px; --r-sm:6px;
  --sh:0 1px 2px rgba(0,0,0,.06),0 1px 3px rgba(0,0,0,.1);
  --sh-md:0 4px 16px rgba(0,0,0,.08);
  --sh-lg:0 10px 40px rgba(0,0,0,.12);
}
html,body{height:100%;font-family:var(--font);background:#f0f2f5;color:var(--gray-800);overflow:hidden}
.app{display:flex;height:100vh;width:100vw}

/* ═══════════════════ SIDEBAR ═══════════════════ */
.sidebar{
  width:var(--sidebar-w);flex-shrink:0;
  background:var(--ink);
  display:flex;flex-direction:column;overflow:hidden;
  position:relative;
}
.sidebar::before{
  content:'';position:absolute;
  top:0;left:0;right:0;height:200px;
  background:linear-gradient(180deg,rgba(36,99,235,.12) 0%,transparent 100%);
  pointer-events:none;
}

.sb-logo{
  padding:1.2rem 1.4rem;display:flex;align-items:center;gap:.7rem;
  border-bottom:1px solid rgba(255,255,255,.06);position:relative;z-index:1;
}
.sb-logo-mark{
  width:32px;height:32px;background:var(--blue);border-radius:var(--r-sm);
  display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:.82rem;color:#fff;flex-shrink:0;
  box-shadow:0 4px 12px rgba(36,99,235,.45);
}
.sb-logo-text{font-weight:700;font-size:1rem;color:#fff;letter-spacing:-.2px}
.sb-logo-text span{color:#60a5fa}
.sb-badge{
  margin-left:auto;font-size:.6rem;font-weight:700;padding:.15rem .45rem;
  background:rgba(36,99,235,.3);color:#93c5fd;border-radius:99px;
  letter-spacing:.5px;text-transform:uppercase;
}

.sb-nav{flex:1;padding:.75rem .65rem;overflow-y:auto}
.sb-nav::-webkit-scrollbar{width:0}

.sb-group{margin-bottom:.25rem}
.sb-group-lbl{
  font-size:.6rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  color:rgba(255,255,255,.22);padding:.8rem .65rem .3rem;
}
.sb-item{
  display:flex;align-items:center;gap:.65rem;
  padding:.58rem .7rem;border-radius:var(--r-sm);
  cursor:pointer;transition:all .15s;
  font-size:.84rem;font-weight:500;color:rgba(255,255,255,.48);
  margin-bottom:.05rem;position:relative;
}
.sb-item:hover{background:rgba(255,255,255,.06);color:rgba(255,255,255,.8)}
.sb-item.active{background:rgba(36,99,235,.22);color:#fff;font-weight:600}
.sb-item.active::before{
  content:'';position:absolute;left:0;top:25%;bottom:25%;
  width:3px;background:var(--blue);border-radius:0 3px 3px 0;
}
.sb-item .si{font-size:.95rem;width:18px;text-align:center;flex-shrink:0}
.sb-item .sb-count{
  margin-left:auto;min-width:18px;height:18px;padding:0 .3rem;
  border-radius:99px;font-size:.62rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;
}
.sb-count.blue{background:rgba(36,99,235,.35);color:#93c5fd}
.sb-count.amber{background:rgba(217,119,6,.3);color:#fcd34d}
.sb-count.red{background:rgba(220,38,38,.3);color:#fca5a5}
.sb-count.green{background:rgba(22,163,74,.3);color:#86efac}

.sb-divider{height:1px;background:rgba(255,255,255,.05);margin:.35rem .65rem}

.sb-user{
  padding:.9rem 1rem;border-top:1px solid rgba(255,255,255,.06);
  display:flex;align-items:center;gap:.7rem;cursor:pointer;
  transition:background .15s;
}
.sb-user:hover{background:rgba(255,255,255,.04)}
.su-av{
  width:32px;height:32px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,#2463eb,#7c3aed);
  display:flex;align-items:center;justify-content:center;
  font-size:.75rem;font-weight:700;color:#fff;
}
.su-info{flex:1;min-width:0}
.su-name{font-size:.8rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.su-role{font-size:.67rem;color:rgba(255,255,255,.3)}

/* ═══════════════════ TOPBAR ═══════════════════ */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0}
.topbar{
  height:54px;background:var(--white);border-bottom:1px solid var(--gray-200);
  display:flex;align-items:center;padding:0 1.8rem;gap:1rem;
  flex-shrink:0;box-shadow:var(--sh);
}
.tb-title{font-size:.95rem;font-weight:700;color:var(--gray-900)}
.tb-search{
  flex:1;max-width:300px;margin-left:1.2rem;
  display:flex;align-items:center;gap:.5rem;
  background:var(--gray-100);border-radius:var(--r-sm);
  padding:.38rem .85rem;border:1.5px solid transparent;transition:all .2s;
}
.tb-search:focus-within{background:var(--white);border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-l)}
.tb-search input{background:none;border:none;outline:none;font-family:var(--font);font-size:.82rem;color:var(--gray-800);flex:1;width:100%}
.tb-search input::placeholder{color:var(--gray-400)}
.tb-right{margin-left:auto;display:flex;align-items:center;gap:.5rem}
.tb-btn{
  width:34px;height:34px;border-radius:var(--r-sm);border:none;
  background:var(--gray-100);cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:.9rem;color:var(--gray-500);transition:all .15s;position:relative;
}
.tb-btn:hover{background:var(--gray-200);color:var(--gray-700)}
.tb-dot{position:absolute;top:5px;right:5px;width:7px;height:7px;background:var(--red);border-radius:50%;border:1.5px solid var(--white)}
.tb-avatar{
  width:32px;height:32px;border-radius:50%;
  background:linear-gradient(135deg,var(--blue),var(--violet));
  display:flex;align-items:center;justify-content:center;
  font-size:.75rem;font-weight:700;color:#fff;cursor:pointer;margin-left:.3rem;
}

/* ═══════════════════ CONTENT ═══════════════════ */
.content{flex:1;overflow-y:auto;padding:1.6rem 1.8rem}
.content::-webkit-scrollbar{width:4px}
.content::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:99px}

.page{display:none;animation:up .28s ease}
.page.show{display:block}
@keyframes up{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

/* ═══ PAGE HEADER ═══ */
.ph{margin-bottom:1.6rem;display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap}
.ph h1{font-family:var(--serif);font-size:1.55rem;color:var(--gray-900);line-height:1.2}
.ph p{font-size:.83rem;color:var(--gray-500);margin-top:.2rem}
.ph-actions{display:flex;gap:.6rem;flex-shrink:0}

/* ═══ BUTTONS ═══ */
.btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:var(--r-sm);font-family:var(--font);font-size:.82rem;font-weight:600;border:none;cursor:pointer;transition:all .18s}
.btn-primary{background:var(--blue);color:#fff;box-shadow:0 2px 6px rgba(36,99,235,.3)}
.btn-primary:hover{background:var(--blue-d);transform:translateY(-1px)}
.btn-ghost{background:var(--white);color:var(--gray-600);border:1px solid var(--gray-200)}
.btn-ghost:hover{border-color:var(--gray-400);color:var(--gray-800)}
.btn-danger{background:var(--red-l);color:var(--red);border:1px solid rgba(220,38,38,.2)}
.btn-danger:hover{background:var(--red);color:#fff}
.btn-success{background:var(--green-l);color:var(--green-d);border:1px solid rgba(22,163,74,.2)}
.btn-success:hover{background:var(--green);color:#fff}
.btn-sm{padding:.3rem .7rem;font-size:.76rem}

/* ═══ STAT CARDS ═══ */
.stats{display:grid;grid-template-columns:repeat(5,1fr);gap:1rem;margin-bottom:1.6rem}
.sc{
  background:var(--white);border-radius:var(--r);padding:1.1rem 1.2rem;
  box-shadow:var(--sh);border:1px solid var(--gray-200);
  position:relative;overflow:hidden;cursor:default;
  transition:transform .18s,box-shadow .18s;
}
.sc:hover{transform:translateY(-2px);box-shadow:var(--sh-md)}
.sc-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.7rem}
.sc-icon{width:36px;height:36px;border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;font-size:1rem}
.sc-icon.b{background:var(--blue-l)} .sc-icon.g{background:var(--green-l)}
.sc-icon.a{background:var(--amber-l)} .sc-icon.v{background:var(--violet-l)}
.sc-icon.t{background:var(--teal-l)} .sc-icon.r{background:var(--red-l)}
.sc-trend{font-size:.7rem;font-weight:600;padding:.12rem .42rem;border-radius:99px;display:flex;align-items:center;gap:.15rem}
.sc-trend.up{background:var(--green-l);color:var(--green-d)}
.sc-trend.dn{background:var(--red-l);color:var(--red)}
.sc-trend.neu{background:var(--gray-100);color:var(--gray-500)}
.sc-val{font-size:1.6rem;font-weight:800;color:var(--gray-900);line-height:1}
.sc-lbl{font-size:.75rem;color:var(--gray-500);margin-top:.22rem;font-weight:500}
.sc-bar{height:3px;background:var(--gray-100);border-radius:99px;margin-top:.8rem;overflow:hidden}
.sc-bar-f{height:100%;border-radius:99px}

/* ═══ GRID ═══ */
.g2{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem}
.g3{display:grid;grid-template-columns:2fr 1fr;gap:1.2rem;margin-bottom:1.2rem}
.g4{display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:1rem;margin-bottom:1.2rem}

/* ═══ CARD ═══ */
.card{background:var(--white);border-radius:var(--r);box-shadow:var(--sh);border:1px solid var(--gray-200);overflow:hidden}
.card-hdr{padding:.9rem 1.2rem;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;gap:.75rem}
.card-hdr h3{font-size:.88rem;font-weight:700;color:var(--gray-800)}
.card-hdr p{font-size:.72rem;color:var(--gray-400);margin-top:.1rem}
.card-body{padding:1.1rem 1.2rem}
.lnk{background:none;border:none;font-family:var(--font);font-size:.75rem;font-weight:600;color:var(--blue);cursor:pointer;padding:0;transition:color .15s}
.lnk:hover{color:var(--blue-d)}

/* ═══ CHART ═══ */
.chart-bars{height:130px;display:flex;align-items:flex-end;gap:5px}
.cb{flex:1;display:flex;flex-direction:column;align-items:center;gap:.3rem;cursor:pointer}
.cb-bar{width:100%;border-radius:4px 4px 0 0;min-height:4px;transition:opacity .2s}
.cb-bar:hover{opacity:.75}
.cb-lbl{font-size:.6rem;color:var(--gray-400);font-weight:500}

.line-chart{height:100px;position:relative;overflow:hidden}
.line-chart svg{width:100%;height:100%}

/* ═══ TABLE ═══ */
.tbl{width:100%;border-collapse:collapse}
.tbl th{font-size:.67rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--gray-400);padding:.6rem 1rem;text-align:left;background:var(--gray-50);border-bottom:1px solid var(--gray-200);white-space:nowrap}
.tbl td{font-size:.82rem;padding:.68rem 1rem;border-bottom:1px solid var(--gray-100);color:var(--gray-700);vertical-align:middle}
.tbl tr:last-child td{border-bottom:none}
.tbl tr:hover td{background:var(--gray-50)}
.tbl-wrap{overflow-x:auto}

/* ═══ AVATAR ROW ═══ */
.av-row{display:flex;align-items:center;gap:.6rem}
.av{width:28px;height:28px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:700;color:#fff}

/* ═══ PILLS ═══ */
.pill{display:inline-flex;align-items:center;gap:.25rem;padding:.17rem .55rem;border-radius:99px;font-size:.68rem;font-weight:700;white-space:nowrap}
.pill.active{background:var(--green-l);color:var(--green-d)}
.pill.pending{background:var(--amber-l);color:var(--amber)}
.pill.rejected{background:var(--red-l);color:var(--red)}
.pill.draft{background:var(--gray-100);color:var(--gray-500)}
.pill.validated{background:var(--blue-l);color:var(--blue)}
.pill.banned{background:var(--ink2);color:var(--gray-400)}

/* ═══ NOTIF LIST ═══ */
.notif-row{display:flex;align-items:flex-start;gap:.75rem;padding:.65rem .75rem;border-radius:var(--r-sm);cursor:pointer;transition:background .15s;border-bottom:1px solid var(--gray-100)}
.notif-row:last-child{border-bottom:none}
.notif-row:hover{background:var(--gray-50)}
.notif-row.unread{background:var(--blue-xl)}
.notif-row.unread:hover{background:var(--blue-l)}
.ni-dot{width:7px;height:7px;border-radius:50%;flex-shrink:0;margin-top:5px}
.ni-text{font-size:.81rem;color:var(--gray-700);line-height:1.45;flex:1}
.ni-time{font-size:.68rem;color:var(--gray-400);margin-top:.15rem}
.ni-icon{width:30px;height:30px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.82rem}

/* ═══ DONUT ═══ */
.donut-wrap{display:flex;align-items:center;gap:1.2rem}
.donut-legend{flex:1;display:flex;flex-direction:column;gap:.5rem}
.dl-row{display:flex;align-items:center;gap:.5rem;font-size:.78rem}
.dl-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.dl-lbl{color:var(--gray-600);flex:1}
.dl-val{font-weight:700;color:var(--gray-800)}

/* ═══ ACTIVITY FEED ═══ */
.feed-item{display:flex;align-items:flex-start;gap:.75rem;padding:.6rem 0;position:relative}
.feed-item:not(:last-child)::before{content:'';position:absolute;left:13px;top:28px;bottom:-4px;width:1.5px;background:var(--gray-200)}
.fi-icon{width:28px;height:28px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.78rem;z-index:1}
.fi-text{flex:1;font-size:.8rem;color:var(--gray-700);line-height:1.45;padding-top:.25rem}
.fi-text strong{color:var(--gray-900)}
.fi-time{font-size:.67rem;color:var(--gray-400);margin-top:.12rem}

/* ═══ TABS ═══ */
.tabs{display:flex;gap:.15rem;background:var(--gray-100);padding:.2rem;border-radius:var(--r-sm);margin-bottom:1.2rem;width:fit-content}
.tab{padding:.38rem .9rem;border-radius:var(--r-sm);font-size:.8rem;font-weight:600;color:var(--gray-500);cursor:pointer;border:none;background:transparent;font-family:var(--font);transition:all .15s}
.tab.on{background:var(--white);color:var(--blue);box-shadow:var(--sh)}

/* ═══ PAGES SPÉCIFIQUES ═══ */
/* Formation cards */
.fc-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
.fc{background:var(--white);border-radius:var(--r);border:1px solid var(--gray-200);overflow:hidden;transition:all .18s;cursor:pointer}
.fc:hover{transform:translateY(-2px);box-shadow:var(--sh-md)}
.fc-thumb{height:90px;display:flex;align-items:center;justify-content:center;font-size:2rem}
.fc-body{padding:.9rem}
.fc-title{font-size:.86rem;font-weight:700;color:var(--gray-800);margin-bottom:.25rem;line-height:1.3}
.fc-meta{font-size:.72rem;color:var(--gray-400);margin-bottom:.6rem}
.fc-row{display:flex;justify-content:space-between;align-items:center}

/* Rev cards */
.rev-sm{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.2rem}
.rsc{background:var(--white);border-radius:var(--r);padding:1rem 1.2rem;border:1px solid var(--gray-200);box-shadow:var(--sh)}
.rsc-v{font-size:1.4rem;font-weight:800;color:var(--gray-900)}
.rsc-l{font-size:.74rem;color:var(--gray-400);margin-top:.15rem}
.rsc-c{font-size:.73rem;font-weight:600;margin-top:.35rem}

/* Toggle switch */
.toggle{display:flex;align-items:center;gap:.5rem;cursor:pointer}
.toggle-track{width:36px;height:20px;border-radius:99px;background:var(--gray-300);position:relative;transition:background .2s;flex-shrink:0}
.toggle-track.on{background:var(--green)}
.toggle-thumb{width:16px;height:16px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;transition:left .2s;box-shadow:var(--sh)}
.toggle-track.on .toggle-thumb{left:18px}
.toggle-lbl{font-size:.8rem;color:var(--gray-600)}

/* Search filter row */
.filter-row{display:flex;gap:.6rem;align-items:center;margin-bottom:1rem;flex-wrap:wrap}
.filter-input{padding:.42rem .85rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:var(--font);font-size:.82rem;outline:none;background:var(--white);color:var(--gray-800);transition:border-color .2s}
.filter-input:focus{border-color:var(--blue)}
.filter-select{padding:.42rem .85rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:var(--font);font-size:.82rem;outline:none;background:var(--white);color:var(--gray-800);cursor:pointer}

/* ═══ MODAL / PANEL ═══ */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:500;display:none;align-items:center;justify-content:center}
.modal-overlay.show{display:flex}
.modal-box{background:var(--white);border-radius:var(--r);width:520px;max-height:80vh;overflow-y:auto;box-shadow:var(--sh-lg);animation:up .25s ease}
.modal-hdr{padding:1.1rem 1.4rem;border-bottom:1px solid var(--gray-200);display:flex;align-items:center;justify-content:space-between}
.modal-hdr h3{font-size:.95rem;font-weight:700;color:var(--gray-800)}
.modal-body{padding:1.4rem}
.modal-close{background:none;border:none;font-size:1.1rem;cursor:pointer;color:var(--gray-400);padding:.2rem;line-height:1}

/* Alert banner */
.alert{padding:.7rem 1.1rem;border-radius:var(--r-sm);font-size:.82rem;font-weight:500;display:flex;align-items:center;gap:.6rem;margin-bottom:1rem}
.alert.warn{background:var(--amber-bg);color:var(--amber);border:1px solid rgba(217,119,6,.2)}
.alert.info{background:var(--blue-xl);color:var(--blue);border:1px solid rgba(36,99,235,.15)}
.alert.danger{background:var(--red-l);color:var(--red-d);border:1px solid rgba(220,38,38,.2)}

/* ═══ RESPONSIVE ═══ */
@media(max-width:1200px){.stats{grid-template-columns:repeat(3,1fr)}.fc-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:900px){.g2,.g3{grid-template-columns:1fr}.stats{grid-template-columns:repeat(2,1fr)}.g4{grid-template-columns:1fr 1fr}}
</style>
</head>
<body>
<div class="app">

<!-- ══════════════════ SIDEBAR ══════════════════ -->
<aside class="sidebar">
  <div class="sb-logo">
    <div class="sb-logo-mark">ST</div>
    <div class="sb-logo-text">Skill<span>Tract</span></div>
    <span class="sb-badge">Admin</span>
  </div>

  <nav class="sb-nav">
    <div class="sb-group">
      <div class="sb-group-lbl">Vue d'ensemble</div>
      <div class="sb-item active" onclick="go('dashboard')"><span class="si">🏠</span>Tableau de bord</div>
      <div class="sb-item" onclick="go('analytics')"><span class="si">📊</span>Analytiques<span class="sb-count blue">Live</span></div>
    </div>

    <div class="sb-group">
      <div class="sb-group-lbl">Gestion</div>
      <div class="sb-item" onclick="go('utilisateurs')"><span class="si">👥</span>Utilisateurs<span class="sb-count blue">214</span></div>
      <div class="sb-item" onclick="go('formateurs')"><span class="si">🎓</span>Formateurs<span class="sb-count green">18</span></div>
      <div class="sb-item" onclick="go('formations')"><span class="si">📚</span>Formations<span class="sb-count amber">4</span></div>
      <div class="sb-item" onclick="go('apprenants')"><span class="si">🧑‍💻</span>Apprenants<span class="sb-count blue">192</span></div>
    </div>

    <div class="sb-group">
      <div class="sb-group-lbl">Validation</div>
      <div class="sb-item" onclick="go('validations')"><span class="si">✅</span>Formations à valider<span class="sb-count red">4</span></div>
      <div class="sb-item" onclick="go('partenaires')"><span class="si">🤝</span>Partenaires<span class="sb-count amber">3</span></div>
      <div class="sb-item" onclick="go('signalements')"><span class="si">🚩</span>Signalements<span class="sb-count red">7</span></div>
    </div>

    <div class="sb-group">
      <div class="sb-group-lbl">Finance</div>
      <div class="sb-item" onclick="go('revenus')"><span class="si">💰</span>Revenus</div>
      <div class="sb-item" onclick="go('virements')"><span class="si">💸</span>Virements<span class="sb-count amber">5</span></div>
    </div>

    <div class="sb-group">
      <div class="sb-group-lbl">Système</div>
      <div class="sb-item" onclick="go('notifications')"><span class="si">🔔</span>Notifications<span class="sb-count red">12</span></div>
      <div class="sb-item" onclick="go('parametres')"><span class="si">⚙️</span>Paramètres</div>
      <div class="sb-item" onclick="go('logs')"><span class="si">📋</span>Journaux</div>
    </div>

    <div class="sb-divider"></div>
    <div class="sb-item" style="color:rgba(220,38,38,.55)"><span class="si">🚪</span>Déconnexion</div>
  </nav>

  <div class="sb-user">
    <div class="su-av">SA</div>
    <div class="su-info">
      <div class="su-name">Super Admin</div>
      <div class="su-role">Administrateur principal</div>
    </div>
  </div>
</aside>

<!-- ══════════════════ MAIN ══════════════════ -->
<div class="main">
  <div class="topbar">
    <div class="tb-title" id="tb-title">Tableau de bord</div>
    <div class="tb-search"><span style="color:var(--gray-400);font-size:.85rem">🔍</span><input type="text" placeholder="Rechercher utilisateur, formation…"></div>
    <div class="tb-right">
      <button class="tb-btn" title="Alertes">⚠️<span class="tb-dot"></span></button>
      <button class="tb-btn" title="Notifications">🔔<span class="tb-dot"></span></button>
      <button class="tb-btn" title="Messages">💬</button>
      <div class="tb-avatar" title="Super Admin">SA</div>
    </div>
  </div>

  <div class="content">

    <!-- ══════ DASHBOARD ══════ -->
    <div class="page show" id="page-dashboard">
      <div class="ph">
        <div><h1>Vue d'ensemble</h1><p>Plateforme SkillTract · Mise à jour en temps réel</p></div>
        <div class="ph-actions">
          <button class="btn btn-ghost btn-sm">📥 Exporter</button>
          <button class="btn btn-primary btn-sm">📊 Rapport</button>
        </div>
      </div>

      <div class="alert warn">⚠️ 4 formations en attente de validation · <strong>3 virements</strong> à traiter · 7 signalements non résolus</div>

      <!-- Stats -->
      <div class="stats">
        <div class="sc">
          <div class="sc-top"><div class="sc-icon b">👥</div><div class="sc-trend up">↑ +14</div></div>
          <div class="sc-val">214</div><div class="sc-lbl">Utilisateurs</div>
          <div class="sc-bar"><div class="sc-bar-f" style="width:72%;background:var(--blue)"></div></div>
        </div>
        <div class="sc">
          <div class="sc-top"><div class="sc-icon g">🎓</div><div class="sc-trend up">↑ +3</div></div>
          <div class="sc-val">18</div><div class="sc-lbl">Formateurs</div>
          <div class="sc-bar"><div class="sc-bar-f" style="width:45%;background:var(--green)"></div></div>
        </div>
        <div class="sc">
          <div class="sc-top"><div class="sc-icon v">📚</div><div class="sc-trend up">↑ +5</div></div>
          <div class="sc-val">31</div><div class="sc-lbl">Formations actives</div>
          <div class="sc-bar"><div class="sc-bar-f" style="width:62%;background:var(--violet)"></div></div>
        </div>
        <div class="sc">
          <div class="sc-top"><div class="sc-icon a">💰</div><div class="sc-trend up">↑ +22%</div></div>
          <div class="sc-val">1.4M</div><div class="sc-lbl">Revenus (FCFA)</div>
          <div class="sc-bar"><div class="sc-bar-f" style="width:80%;background:var(--amber)"></div></div>
        </div>
        <div class="sc">
          <div class="sc-top"><div class="sc-icon t">⭐</div><div class="sc-trend up">↑ 0.1</div></div>
          <div class="sc-val">4.6</div><div class="sc-lbl">Note moyenne</div>
          <div class="sc-bar"><div class="sc-bar-f" style="width:92%;background:var(--teal)"></div></div>
        </div>
      </div>

      <div class="g3">
        <!-- Revenus chart -->
        <div class="card">
          <div class="card-hdr">
            <div><h3>Revenus mensuels</h3><p>6 derniers mois</p></div>
            <button class="lnk" onclick="go('revenus')">Voir détails →</button>
          </div>
          <div class="card-body">
            <div style="display:flex;align-items:baseline;gap:.5rem;margin-bottom:.75rem">
              <span style="font-size:1.35rem;font-weight:800;color:var(--gray-900)">1 420 000 FCFA</span>
              <span style="font-size:.75rem;color:var(--green-d);font-weight:600">↑ +22% ce mois</span>
            </div>
            <div class="chart-bars" id="chart-rev"></div>
          </div>
        </div>
        <!-- Répartition -->
        <div class="card">
          <div class="card-hdr"><div><h3>Répartition utilisateurs</h3></div></div>
          <div class="card-body">
            <div class="donut-wrap">
              <svg width="90" height="90" viewBox="0 0 36 36">
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="#f3f4f6" stroke-width="3.5"/>
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="#2463eb" stroke-width="3.5" stroke-dasharray="55 45" stroke-dashoffset="25" stroke-linecap="round"/>
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="#16a34a" stroke-width="3.5" stroke-dasharray="20 80" stroke-dashoffset="-30" stroke-linecap="round"/>
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="#7c3aed" stroke-width="3.5" stroke-dasharray="10 90" stroke-dashoffset="-50" stroke-linecap="round"/>
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="#d97706" stroke-width="3.5" stroke-dasharray="15 85" stroke-dashoffset="-60" stroke-linecap="round"/>
                <text x="18" y="20" text-anchor="middle" font-size="5" font-weight="800" fill="#111827">214</text>
              </svg>
              <div class="donut-legend">
                <div class="dl-row"><div class="dl-dot" style="background:var(--blue)"></div><span class="dl-lbl">Apprenants</span><span class="dl-val">192</span></div>
                <div class="dl-row"><div class="dl-dot" style="background:var(--green)"></div><span class="dl-lbl">Formateurs</span><span class="dl-val">18</span></div>
                <div class="dl-row"><div class="dl-dot" style="background:var(--violet)"></div><span class="dl-lbl">Partenaires</span><span class="dl-val">4</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="g2">
        <!-- Dernières inscriptions -->
        <div class="card">
          <div class="card-hdr">
            <div><h3>Dernières inscriptions</h3><p>Nouveaux utilisateurs</p></div>
            <button class="lnk" onclick="go('utilisateurs')">Tout voir →</button>
          </div>
          <div class="card-body" style="padding:0">
            <table class="tbl" id="tbl-inscriptions"></table>
          </div>
        </div>
        <!-- Activité récente -->
        <div class="card">
          <div class="card-hdr"><div><h3>Activité récente</h3></div></div>
          <div class="card-body" id="feed-activity"></div>
        </div>
      </div>

      <!-- Formations en attente -->
      <div class="card">
        <div class="card-hdr">
          <div><h3>🔴 Formations en attente de validation</h3><p>4 formations à traiter</p></div>
          <button class="lnk" onclick="go('validations')">Gérer tout →</button>
        </div>
        <div class="card-body" style="padding:0">
          <table class="tbl" id="tbl-pending"></table>
        </div>
      </div>
    </div>

    <!-- ══════ UTILISATEURS ══════ -->
    <div class="page" id="page-utilisateurs">
      <div class="ph">
        <div><h1>Utilisateurs</h1><p>214 comptes enregistrés</p></div>
        <div class="ph-actions">
          <button class="btn btn-ghost btn-sm">📥 Exporter CSV</button>
          <button class="btn btn-primary btn-sm" onclick="openModal('modal-add-user')">＋ Ajouter</button>
        </div>
      </div>
      <div class="filter-row">
        <input class="filter-input" placeholder="🔍 Rechercher…" style="flex:1;max-width:280px">
        <select class="filter-select"><option>Tous les rôles</option><option>Apprenant</option><option>Formateur</option><option>Partenaire</option><option>Admin</option></select>
        <select class="filter-select"><option>Tous les statuts</option><option>Actif</option><option>Suspendu</option><option>Banni</option></select>
      </div>
      <div class="card">
        <div class="tbl-wrap">
          <table class="tbl" id="tbl-users"></table>
        </div>
      </div>
    </div>

    <!-- ══════ FORMATEURS ══════ -->
    <div class="page" id="page-formateurs">
      <div class="ph">
        <div><h1>Formateurs</h1><p>18 formateurs enregistrés</p></div>
        <button class="btn btn-primary btn-sm">＋ Inviter un formateur</button>
      </div>
      <div class="card">
        <div class="tbl-wrap">
          <table class="tbl" id="tbl-formateurs"></table>
        </div>
      </div>
    </div>

    <!-- ══════ FORMATIONS ══════ -->
    <div class="page" id="page-formations">
      <div class="ph">
        <div><h1>Formations</h1><p>31 formations sur la plateforme</p></div>
        <div class="ph-actions">
          <button class="btn btn-ghost btn-sm">📥 Exporter</button>
        </div>
      </div>
      <div class="tabs" id="tabs-formations">
        <button class="tab on">Toutes (31)</button>
        <button class="tab">Actives (24)</button>
        <button class="tab">En attente (4)</button>
        <button class="tab">Suspendues (3)</button>
      </div>
      <div class="fc-grid" id="fc-grid"></div>
    </div>

    <!-- ══════ VALIDATIONS ══════ -->
    <div class="page" id="page-validations">
      <div class="ph">
        <div><h1>Formations à valider</h1><p>4 soumissions en attente de votre décision</p></div>
      </div>
      <div class="alert info">ℹ️ Chaque formation doit être examinée avant publication. Vérifiez le contenu, les prérequis et la conformité.</div>
      <div style="display:flex;flex-direction:column;gap:1rem" id="validation-list"></div>
    </div>

    <!-- ══════ APPRENANTS ══════ -->
    <div class="page" id="page-apprenants">
      <div class="ph"><div><h1>Apprenants</h1><p>192 apprenants inscrits</p></div></div>
      <div class="card">
        <div class="tbl-wrap"><table class="tbl" id="tbl-apprenants"></table></div>
      </div>
    </div>

    <!-- ══════ PARTENAIRES ══════ -->
    <div class="page" id="page-partenaires">
      <div class="ph"><div><h1>Partenaires</h1><p>4 partenariats actifs · 3 demandes en attente</p></div></div>
      <div class="g2">
        <div class="card">
          <div class="card-hdr"><h3>Partenaires actifs</h3></div>
          <div class="card-body" style="padding:0"><table class="tbl" id="tbl-partenaires"></table></div>
        </div>
        <div class="card">
          <div class="card-hdr"><h3>Demandes en attente</h3><span class="pill pending">3 en attente</span></div>
          <div class="card-body" style="padding:0"><table class="tbl" id="tbl-demandes-part"></table></div>
        </div>
      </div>
    </div>

    <!-- ══════ SIGNALEMENTS ══════ -->
    <div class="page" id="page-signalements">
      <div class="ph"><div><h1>Signalements</h1><p>7 signalements non traités</p></div></div>
      <div class="alert danger">🚩 Des contenus potentiellement inappropriés ont été signalés. Examinez et prenez les mesures nécessaires.</div>
      <div class="card">
        <div class="tbl-wrap"><table class="tbl" id="tbl-signalements"></table></div>
      </div>
    </div>

    <!-- ══════ REVENUS ══════ -->
    <div class="page" id="page-revenus">
      <div class="ph"><div><h1>Revenus & Finances</h1><p>Suivi financier de la plateforme</p></div></div>
      <div class="rev-sm">
        <div class="rsc"><div class="rsc-v">1 420 000 F</div><div class="rsc-l">Revenus ce mois</div><div class="rsc-c" style="color:var(--green-d)">↑ +22% vs mois dernier</div></div>
        <div class="rsc"><div class="rsc-v">9 840 000 F</div><div class="rsc-l">Total 2025</div><div class="rsc-c" style="color:var(--green-d)">↑ En progression</div></div>
        <div class="rsc"><div class="rsc-v">312 000 F</div><div class="rsc-l">Commission plateforme</div><div class="rsc-c" style="color:var(--amber)">20% des revenus</div></div>
      </div>
      <div class="card">
        <div class="card-hdr"><h3>Transactions récentes</h3></div>
        <div class="tbl-wrap"><table class="tbl" id="tbl-revenus"></table></div>
      </div>
    </div>

    <!-- ══════ VIREMENTS ══════ -->
    <div class="page" id="page-virements">
      <div class="ph"><div><h1>Virements formateurs</h1><p>5 virements en attente d'envoi</p></div></div>
      <div class="alert warn">⏳ Des formateurs attendent leur paiement. Vérifiez et validez les virements.</div>
      <div class="card">
        <div class="tbl-wrap"><table class="tbl" id="tbl-virements"></table></div>
      </div>
    </div>

    <!-- ══════ NOTIFICATIONS ══════ -->
    <div class="page" id="page-notifications">
      <div class="ph">
        <div><h1>Notifications</h1><p>12 non lues</p></div>
        <button class="btn btn-ghost btn-sm">Tout marquer lu</button>
      </div>
      <div class="card"><div id="all-notifs"></div></div>
    </div>

    <!-- ══════ PARAMÈTRES ══════ -->
    <div class="page" id="page-parametres">
      <div class="ph"><div><h1>Paramètres</h1><p>Configuration de la plateforme</p></div></div>
      <div class="g2">
        <div class="card">
          <div class="card-hdr"><h3>⚙️ Général</h3></div>
          <div class="card-body" style="display:flex;flex-direction:column;gap:1.1rem">
            ${[['Maintenance','Mettre la plateforme en maintenance'],['Inscriptions ouvertes','Autoriser les nouvelles inscriptions'],['Validation manuelle formations','Exiger validation admin avant publication'],['Emails automatiques','Envoyer des emails de notifications'],['Mode debug','Afficher les erreurs détaillées']].map(([l,d],i)=>`
            <div style="display:flex;align-items:center;justify-content:space-between">
              <div><div style="font-size:.84rem;font-weight:600;color:var(--gray-800)">${l}</div><div style="font-size:.74rem;color:var(--gray-400)">${d}</div></div>
              <div class="toggle" onclick="this.querySelector('.toggle-track').classList.toggle('on');this.querySelector('.toggle-thumb').style.left=this.querySelector('.toggle-track').classList.contains('on')?'18px':'2px'">
                <div class="toggle-track ${i>0&&i<4?'on':''}"><div class="toggle-thumb" style="left:${i>0&&i<4?18:2}px"></div></div>
              </div>
            </div>`).join('')}
          </div>
        </div>
        <div class="card">
          <div class="card-hdr"><h3>💰 Finance</h3></div>
          <div class="card-body" style="display:flex;flex-direction:column;gap:1rem">
            ${[['Commission plateforme','20%'],['Délai de virement','Mensuel'],['Devise par défaut','FCFA (XAF)'],['Montant min. virement','5 000 FCFA']].map(([l,v])=>`
            <div style="display:flex;align-items:center;justify-content:space-between;padding:.55rem .75rem;background:var(--gray-50);border-radius:var(--r-sm)">
              <span style="font-size:.82rem;color:var(--gray-600)">${l}</span>
              <span style="font-size:.82rem;font-weight:700;color:var(--gray-800)">${v}</span>
            </div>`).join('')}
            <button class="btn btn-primary btn-sm" style="margin-top:.4rem">Modifier les paramètres</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ LOGS ══════ -->
    <div class="page" id="page-logs">
      <div class="ph"><div><h1>Journaux système</h1><p>Activité et événements récents</p></div></div>
      <div class="card">
        <div class="card-body" style="padding:0"><table class="tbl" id="tbl-logs"></table></div>
      </div>
    </div>

    <!-- ══════ ANALYTIQUES ══════ -->
    <div class="page" id="page-analytics">
      <div class="ph"><div><h1>Analytiques</h1><p>Données de performance de la plateforme</p></div></div>
      <div class="g4">
        <div class="sc"><div class="sc-top"><div class="sc-icon b">👁</div><div class="sc-trend up">↑ +8%</div></div><div class="sc-val">4.2k</div><div class="sc-lbl">Visites/jour</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon g">📈</div><div class="sc-trend up">↑ +5%</div></div><div class="sc-val">68%</div><div class="sc-lbl">Taux complétion</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon a">⏱</div><div class="sc-trend neu">→ stable</div></div><div class="sc-val">24 min</div><div class="sc-lbl">Durée moy. session</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon v">🔄</div><div class="sc-trend up">↑ +12%</div></div><div class="sc-val">34%</div><div class="sc-lbl">Taux rétention</div></div>
      </div>
      <div class="g2">
        <div class="card">
          <div class="card-hdr"><h3>Inscriptions par mois</h3></div>
          <div class="card-body"><div class="chart-bars" id="chart-inscr"></div></div>
        </div>
        <div class="card">
          <div class="card-hdr"><h3>Top formations</h3></div>
          <div class="card-body">
            ${[['📱 Marketing Digital','28 inscrits','92%'],['🎨 Infographie Canva','14 inscrits','78%'],['💼 Bureautique Avancée','5 inscrits','45%']].map(([n,i,c])=>`
            <div style="display:flex;align-items:center;gap:.75rem;padding:.55rem 0;border-bottom:1px solid var(--gray-100)">
              <div style="flex:1"><div style="font-size:.83rem;font-weight:600">${n}</div><div style="font-size:.72rem;color:var(--gray-400)">${i}</div></div>
              <span style="font-size:.82rem;font-weight:700;color:var(--blue)">${c}</span>
            </div>`).join('')}
          </div>
        </div>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->
</div><!-- /app -->

<!-- ══ MODAL AJOUTER USER ══ -->
<div class="modal-overlay" id="modal-add-user">
  <div class="modal-box">
    <div class="modal-hdr">
      <h3>Ajouter un utilisateur</h3>
      <button class="modal-close" onclick="closeModal('modal-add-user')">✕</button>
    </div>
    <form method="POST" action="{{ route('admin.utilisateur.ajouter') }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-body" style="display:flex;flex-direction:column;gap:1rem">

        <!-- Nom complet -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Nom complet</label>
          <input type="text" name="nom" placeholder="Jean Dupont" class="filter-input" style="width:100%" required>
        </div>

        <!-- Email -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Email</label>
          <input type="email" name="email" placeholder="jean@email.com" class="filter-input" style="width:100%" required>
        </div>

        <!-- Téléphone -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Téléphone</label>
          <input type="tel" name="telephone" placeholder="+237 6XX XXX XXX" class="filter-input" style="width:100%">
        </div>

        <!-- Date de naissance -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Date de naissance</label>
          <input type="date" name="date_naissance" class="filter-input" style="width:100%">
        </div>

        <!-- Années d'expérience -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Années d'expérience</label>
          <input type="number" name="annees_experience" placeholder="0" class="filter-input" style="width:100%" min="0">
        </div>

        <!-- Photo de profil -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Photo de profil</label>
          <input type="file" name="photo_profil" class="filter-input" style="width:100%; padding: .3rem .5rem" accept="image/*">
        </div>

        <!-- Photo du diplôme -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Photo du diplôme</label>
          <input type="file" name="photo_diplome" class="filter-input" style="width:100%; padding: .3rem .5rem" accept="image/*">
        </div>

        <!-- Bibliographie / Biographie -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Biographie</label>
          <textarea name="bibliographie" rows="3" placeholder="Présentez-vous..." class="filter-input" style="width:100%; resize: vertical;"></textarea>
        </div>

        <!-- Rôle -->
        <div>
          <label style="font-size:.75rem;font-weight:600;color:var(--gray-600);display:block;margin-bottom:.3rem">Rôle</label>
          <select name="role" class="filter-select" style="width:100%">
            <option value="apprenant">Apprenant</option>
            <option value="formateur">Formateur</option>
            <option value="partenaire">Partenaire</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:.5rem">
          Créer le compte
        </button>
      </div>
    </form>
  </div>
</div>

<script>
/* ═══════ NAV ═══════ */
const titles={dashboard:'Tableau de bord',utilisateurs:'Utilisateurs',formateurs:'Formateurs',formations:'Formations',apprenants:'Apprenants',validations:'Formations à valider',partenaires:'Partenaires',signalements:'Signalements',revenus:'Revenus & Finances',virements:'Virements',notifications:'Notifications',parametres:'Paramètres',logs:'Journaux système',analytics:'Analytiques'};
function go(id){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('show'));
  document.querySelectorAll('.sb-item').forEach(i=>i.classList.remove('active'));
  const p=document.getElementById('page-'+id);
  if(p)p.classList.add('show');
  document.getElementById('tb-title').textContent=titles[id]||id;
  event.currentTarget&&event.currentTarget.classList.add('active');
  // find matching nav item
  document.querySelectorAll('.sb-item').forEach(i=>{if(i.textContent.trim().startsWith(titles[id]?.split(' ')[0]||'~'))i.classList.add('active')});
}
function openModal(id){document.getElementById(id).classList.add('show')}
function closeModal(id){document.getElementById(id).classList.remove('show')}
document.querySelectorAll('.modal-overlay').forEach(m=>m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('show')}));

/* ═══════ CHARTS ═══════ */
function makeBarChart(id,data,colors){
  const months=data.map(d=>d[0]),vals=data.map(d=>d[1]),mx=Math.max(...vals);
  document.getElementById(id).innerHTML=months.map((m,i)=>`
    <div class="cb">
      <div class="cb-bar" style="height:${Math.round(vals[i]/mx*110)}px;background:${colors[i%colors.length]}" title="${vals[i]}"></div>
      <span class="cb-lbl">${m}</span>
    </div>`).join('');
}
makeBarChart('chart-rev',[['Oct',820000],['Nov',950000],['Déc',880000],['Jan',1100000],['Fév',1280000],['Mar',1420000]],['#bfdbfe','#93c5fd','#60a5fa','#3b82f6','#2463eb','#1d4fd8']);
makeBarChart('chart-inscr',[['Oct',18],['Nov',24],['Déc',19],['Jan',31],['Fév',28],['Mar',36]],['#bbf7d0','#86efac','#4ade80','#22c55e','#16a34a','#15803d']);

/* ═══════ DATA ═══════ */
const usersData=[
  {av:'AK',c:'#2463eb',name:'Amina Kamga',email:'amina@gmail.com',role:'Apprenant',date:'20/03/2026',status:'active'},
  {av:'PT',c:'#16a34a',name:'Paul Tchamba',email:'paul@mail.com',role:'Formateur',date:'18/03/2026',status:'active'},
  {av:'MN',c:'#7c3aed',name:'Marie Nkomo',email:'marie@edu.cm',role:'Apprenant',date:'17/03/2026',status:'active'},
  {av:'JF',c:'#d97706',name:'Jules Fomba',email:'jules@cm.com',role:'Partenaire',date:'15/03/2026',status:'pending'},
  {av:'SB',c:'#0d9488',name:'Sophie Bello',email:'sophie@sk.com',role:'Apprenant',date:'14/03/2026',status:'active'},
  {av:'CR',c:'#dc2626',name:'Christian Remy',email:'christian@x.cm',role:'Apprenant',date:'12/03/2026',status:'banned'},
  {av:'LM',c:'#4f46e5',name:'Luc Martin',email:'luc@mail.fr',role:'Formateur',date:'10/03/2026',status:'active'},
];

/* Table inscriptions dashboard */
document.getElementById('tbl-inscriptions').innerHTML=`<thead><tr><th>Utilisateur</th><th>Rôle</th><th>Date</th><th>Statut</th><th>Action</th></tr></thead><tbody>`+
  usersData.slice(0,5).map(u=>`<tr>
    <td><div class="av-row"><div class="av" style="background:${u.c}">${u.av}</div>${u.name}</div></td>
    <td>${u.role}</td><td>${u.date}</td>
    <td><span class="pill ${u.status}">${u.status==='active'?'✅ Actif':u.status==='pending'?'⏳ Attente':'🚫 Banni'}</span></td>
    <td><button class="btn btn-ghost btn-sm">Voir</button></td>
  </tr>`).join('')+'</tbody>';

/* Table users */
document.getElementById('tbl-users').innerHTML=`<thead><tr><th>Utilisateur</th><th>Email</th><th>Rôle</th><th>Inscription</th><th>Statut</th><th>Actions</th></tr></thead><tbody>`+
  usersData.map(u=>`<tr>
    <td><div class="av-row"><div class="av" style="background:${u.c}">${u.av}</div>${u.name}</div></td>
    <td style="color:var(--gray-500)">${u.email}</td><td>${u.role}</td><td>${u.date}</td>
    <td><span class="pill ${u.status}">${u.status==='active'?'✅ Actif':u.status==='pending'?'⏳ Attente':'🚫 Banni'}</span></td>
    <td><div style="display:flex;gap:.4rem">
      <button class="btn btn-ghost btn-sm">👁</button>
      <button class="btn btn-success btn-sm">✏️</button>
      <button class="btn btn-danger btn-sm">🚫</button>
    </div></td>
  </tr>`).join('')+'</tbody>';

/* Table formateurs */
const formData=[
  {av:'PT',c:'#16a34a',name:'Paul Tchamba',email:'paul@mail.com',domaine:'Marketing Digital',formations:3,apprenants:47,revenus:'342k',note:'4.7',status:'active'},
  {av:'LM',c:'#4f46e5',name:'Luc Martin',email:'luc@mail.fr',domaine:'Dev Web',formations:5,apprenants:83,revenus:'620k',note:'4.9',status:'active'},
  {av:'FA',c:'#ea580c',name:'Fatou Aw',email:'fatou@sn.com',domaine:'Infographie',formations:2,apprenants:21,revenus:'148k',note:'4.5',status:'active'},
  {av:'KB',c:'#7c3aed',name:'Kevin Brice',email:'kevin@cm.com',domaine:'Bureautique',formations:1,apprenants:8,revenus:'56k',note:'4.2',status:'pending'},
];
document.getElementById('tbl-formateurs').innerHTML=`<thead><tr><th>Formateur</th><th>Domaine</th><th>Formations</th><th>Apprenants</th><th>Revenus (FCFA)</th><th>Note</th><th>Statut</th><th>Actions</th></tr></thead><tbody>`+
  formData.map(f=>`<tr>
    <td><div class="av-row"><div class="av" style="background:${f.c}">${f.av}</div><div><div style="font-weight:600">${f.name}</div><div style="font-size:.7rem;color:var(--gray-400)">${f.email}</div></div></div></td>
    <td>${f.domaine}</td><td style="font-weight:700">${f.formations}</td><td style="font-weight:700">${f.apprenants}</td>
    <td style="font-weight:700;color:var(--green-d)">${f.revenus}</td>
    <td><span style="font-weight:700;color:var(--amber)">⭐ ${f.note}</span></td>
    <td><span class="pill ${f.status}">${f.status==='active'?'✅ Actif':'⏳ Attente'}</span></td>
    <td><div style="display:flex;gap:.4rem"><button class="btn btn-ghost btn-sm">👁</button><button class="btn btn-danger btn-sm">🚫</button></div></td>
  </tr>`).join('')+'</tbody>';

/* Formations cards */
const formationsData=[
  {em:'📱',cls:'',bg:'linear-gradient(135deg,#dbeafe,#ede9fe)',title:'Marketing Digital',formateur:'Paul Tchamba',inscrits:28,completions:'78%',revenus:'182k',status:'active'},
  {em:'🎨',cls:'',bg:'linear-gradient(135deg,#dcfce7,#cffafe)',title:'Infographie Canva',formateur:'Fatou Aw',inscrits:14,completions:'55%',revenus:'98k',status:'active'},
  {em:'💼',cls:'',bg:'linear-gradient(135deg,#fef3c7,#ffedd5)',title:'Bureautique Avancée',formateur:'Kevin Brice',inscrits:5,completions:'20%',revenus:'62k',status:'pending'},
  {em:'🌐',cls:'',bg:'linear-gradient(135deg,#f3e8ff,#fce7f3)',title:'Dev Web React',formateur:'Luc Martin',inscrits:0,completions:'—',revenus:'0',status:'pending'},
];
document.getElementById('fc-grid').innerHTML=formationsData.map(f=>`
  <div class="fc">
    <div class="fc-thumb" style="background:${f.bg}">${f.em}</div>
    <div class="fc-body">
      <div class="fc-title">${f.title}</div>
      <div class="fc-meta">Par ${f.formateur}</div>
      <div class="fc-row">
        <div style="font-size:.78rem;color:var(--gray-500)">👥 ${f.inscrits} · ✅ ${f.completions}</div>
        <span class="pill ${f.status}">${f.status==='active'?'Active':'⏳ Attente'}</span>
      </div>
    </div>
    <div class="fc-footer" style="display:flex;justify-content:space-between;align-items:center;padding:.65rem .9rem;border-top:1px solid var(--gray-100);font-size:.78rem">
      <span style="color:var(--green-d);font-weight:700">💰 ${f.revenus} FCFA</span>
      <div style="display:flex;gap:.35rem">
        <button class="btn btn-ghost btn-sm">👁</button>
        ${f.status==='pending'?`<button class="btn btn-success btn-sm">✅</button><button class="btn btn-danger btn-sm">❌</button>`:
        `<button class="btn btn-danger btn-sm">🚫</button>`}
      </div>
    </div>
  </div>`).join('');

/* Validations */
document.getElementById('validation-list').innerHTML=[
  {id:1, title:'Bureautique Avancée', formateur:'Kevin Brice', cat:'Bureautique', lecons:12, duree:'24h', prix:'35 000 F', date:'18/03/2026'},
  {id:2, title:'Dev Web React', formateur:'Luc Martin', cat:'Développement Web', lecons:15, duree:'30h', prix:'50 000 F', date:'17/03/2026'},
  {id:3, title:'Excel Avancé', formateur:'Fatou Aw', cat:'Bureautique', lecons:8, duree:'16h', prix:'25 000 F', date:'15/03/2026'},
  {id:4, title:'SEO & Google Ads', formateur:'Paul Tchamba', cat:'Marketing Digital', lecons:10, duree:'20h', prix:'40 000 F', date:'12/03/2026'},
].map(v=>`
  <div class="card">
    <div class="card-hdr">
      <div><h3>📚 ${v.title}</h3><p>Soumis par <strong>${v.formateur}</strong> · ${v.date}</p></div>
      <span class="pill pending">⏳ En attente</span>
    </div>
    <div class="card-body">
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;margin-bottom:1rem">
        ${[['Catégorie',v.cat],['Leçons',v.lecons],['Durée totale',v.duree],['Prix',v.prix]].map(([l,val])=>`
        <div style="background:var(--gray-50);padding:.6rem .75rem;border-radius:var(--r-sm)">
          <div style="font-size:.68rem;color:var(--gray-400);text-transform:uppercase;letter-spacing:.4px">${l}</div>
          <div style="font-size:.88rem;font-weight:700;color:var(--gray-800);margin-top:.1rem">${val}</div>
        </div>`).join('')}
      </div>
      <div style="display:flex;gap:.6rem">
        <button class="btn btn-success">✅ Valider la formation</button>
        <button class="btn btn-danger">❌ Rejeter</button>
        <a href="/admin/formation/detail/${v.id}" class="btn btn-ghost">👁 Voir le contenu complet</a>
      </div>
    </div>

  </div>`).join('');
/* Apprenants table */
document.getElementById('tbl-apprenants').innerHTML=`<thead><tr><th>Apprenant</th><th>Email</th><th>Formation(s)</th><th>Progression</th><th>Score</th><th>Inscription</th><th>Statut</th></tr></thead><tbody>`+
  usersData.filter(u=>u.role==='Apprenant').concat(Array(4).fill(null).map((_,i)=>({av:['RN','BB','EC','TF'][i],c:['#0d9488','#7c3aed','#ea580c','#16a34a'][i],name:['Rachel Ndong','Boris Bika','Emma Choupo','Thierry Fon'][i],email:[`rnd@cm.com`,`bori@g.com`,`em@fr.com`,`thfon@cm.com`][i],date:['08/03','06/03','04/03','02/03'][i],role:'Apprenant',status:'active'}))).map(u=>`<tr>
    <td><div class="av-row"><div class="av" style="background:${u.c}">${u.av}</div>${u.name}</div></td>
    <td style="color:var(--gray-500);font-size:.78rem">${u.email}</td>
    <td>Marketing Digital</td>
    <td><div style="min-width:80px"><div class="sc-bar"><div class="sc-bar-f" style="width:${30+Math.random()*60|0}%;background:var(--blue)"></div></div></div></td>
    <td><span class="pill ${Math.random()>.5?'active':'pending'}">${(50+Math.random()*45|0)}%</span></td>
    <td>${u.date||'10/03/2026'}</td>
    <td><span class="pill active">✅ Actif</span></td>
  </tr>`).join('')+'</tbody>';

/* Partenaires */
document.getElementById('tbl-partenaires').innerHTML=`<thead><tr><th>Partenaire</th><th>Type</th><th>Depuis</th><th>Statut</th></tr></thead><tbody>`+
  [['🏢 TechCorp CM','Entreprise','Jan 2025'],['🎓 Université YDE','Institution','Mar 2025'],['💼 GovCM','Organisation','Fév 2025'],['🏪 SkillShop','Plateforme','Nov 2024']].map(([n,t,d])=>`<tr><td>${n}</td><td>${t}</td><td>${d}</td><td><span class="pill active">✅ Actif</span></td></tr>`).join('')+'</tbody>';
document.getElementById('tbl-demandes-part').innerHTML=`<thead><tr><th>Demandeur</th><th>Type</th><th>Date</th><th>Action</th></tr></thead><tbody>`+
  [['StartupCM','Startup','19/03/2026'],['EduGroup','Institution','17/03/2026'],['MediaCM','Média','15/03/2026']].map(([n,t,d])=>`<tr><td>${n}</td><td>${t}</td><td>${d}</td><td><div style="display:flex;gap:.35rem"><button class="btn btn-success btn-sm">✅</button><button class="btn btn-danger btn-sm">❌</button></div></td></tr>`).join('')+'</tbody>';

/* Signalements */
document.getElementById('tbl-signalements').innerHTML=`<thead><tr><th>Signalé par</th><th>Type</th><th>Cible</th><th>Motif</th><th>Date</th><th>Priorité</th><th>Action</th></tr></thead><tbody>`+
  [['Amina K.','Contenu','Leçon 5 – Mktg','Contenu inapproprié','20/03','🔴 Haute'],
   ['Paul T.','Utilisateur','Christian Remy','Harcèlement','19/03','🔴 Haute'],
   ['Marie N.','Formation','Bureautique Avancée','Informations incorrectes','18/03','🟡 Moyenne'],
   ['Jules F.','Commentaire','Forum – Leçon 3','Spam','17/03','🟢 Basse'],
   ['Sophie B.','Utilisateur','Kevin B.','Fausse identité','16/03','🟡 Moyenne'],
  ].map(([s,t,c,m,d,p])=>`<tr><td>${s}</td><td>${t}</td><td style="max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${c}</td><td>${m}</td><td>${d}</td><td>${p}</td><td><div style="display:flex;gap:.35rem"><button class="btn btn-ghost btn-sm">👁</button><button class="btn btn-danger btn-sm">🚫</button><button class="btn btn-success btn-sm">✅</button></div></td></tr>`).join('')+'</tbody>';

/* Revenus table */
document.getElementById('tbl-revenus').innerHTML=`<thead><tr><th>Apprenant</th><th>Formation</th><th>Montant</th><th>Commission</th><th>Net formateur</th><th>Date</th><th>Méthode</th></tr></thead><tbody>`+
  [['Amina K.','Marketing Digital','25 000','5 000','20 000','20/03','MTN Money'],
   ['Paul T.','Infographie Canva','20 000','4 000','16 000','19/03','Orange Money'],
   ['Marie N.','Marketing Digital','25 000','5 000','20 000','18/03','PayPal'],
   ['Jules F.','Bureautique','35 000','7 000','28 000','17/03','Carte bancaire'],
  ].map(([a,f,m,c,n,d,meth])=>`<tr><td>${a}</td><td>${f}</td><td style="font-weight:700">${m} F</td><td style="color:var(--red)">${c} F</td><td style="color:var(--green-d);font-weight:700">${n} F</td><td>${d}</td><td>${meth}</td></tr>`).join('')+'</tbody>';

/* Virements */
document.getElementById('tbl-virements').innerHTML=`<thead><tr><th>Formateur</th><th>Période</th><th>Montant net</th><th>Méthode</th><th>Statut</th><th>Action</th></tr></thead><tbody>`+
  [['Paul Tchamba','Mars 2026','145 600 F','MTN Money','pending'],
   ['Fatou Aw','Mars 2026','118 400 F','Orange Money','pending'],
   ['Luc Martin','Mars 2026','496 000 F','Virement bancaire','pending'],
   ['Kevin Brice','Fév 2026','44 800 F','MTN Money','pending'],
   ['Paul Tchamba','Fév 2026','114 400 F','MTN Money','done'],
  ].map(([f,p,m,meth,s])=>`<tr><td>${f}</td><td>${p}</td><td style="font-weight:700;color:var(--green-d)">${m}</td><td>${meth}</td><td><span class="pill ${s==='done'?'active':'pending'}">${s==='done'?'✅ Envoyé':'⏳ En attente'}</span></td><td>${s==='pending'?'<button class="btn btn-success btn-sm">💸 Virer</button>':''}</td></tr>`).join('')+'</tbody>';

/* Logs */
document.getElementById('tbl-logs').innerHTML=`<thead><tr><th>Horodatage</th><th>Type</th><th>Acteur</th><th>Action</th><th>IP</th></tr></thead><tbody>`+
  [['21/03 14:32','INFO','Admin','Connexion réussie','192.168.1.1'],
   ['21/03 14:15','SUCCESS','Paul T.','Formation soumise','41.202.xxx.xx'],
   ['21/03 13:55','WARNING','Système','Tentative connexion échouée (3x)','185.220.xxx.x'],
   ['21/03 13:22','SUCCESS','Amina K.','Paiement formation validé','154.68.xxx.xx'],
   ['21/03 12:10','INFO','Admin','Formation Bureautique validée','192.168.1.1'],
   ['21/03 11:45','ERROR','Système','Échec envoi email – timeout','—'],
  ].map(([t,ty,a,ac,ip])=>`<tr><td style="font-size:.75rem;color:var(--gray-500)">${t}</td><td><span class="pill ${ty==='ERROR'?'rejected':ty==='WARNING'?'pending':ty==='SUCCESS'?'active':'draft'}">${ty}</span></td><td>${a}</td><td>${ac}</td><td style="font-size:.75rem;color:var(--gray-400)">${ip}</td></tr>`).join('')+'</tbody>';

/* Activity feed */
document.getElementById('feed-activity').innerHTML=[
  {ic:'📝',bg:'var(--blue-l)',text:'<strong>Amina K.</strong> a soumis son devoir',time:'Il y a 10 min'},
  {ic:'✅',bg:'var(--green-l)',text:'Formation <strong>Bureautique</strong> validée par admin',time:'Il y a 45 min'},
  {ic:'👤',bg:'var(--violet-l)',text:'Nouveau formateur <strong>Kevin Brice</strong> inscrit',time:'Il y a 2h'},
  {ic:'💰',bg:'var(--amber-l)',text:'Virement de <strong>145 600 FCFA</strong> traité',time:'Il y a 3h'},
  {ic:'🚩',bg:'var(--red-l)',text:'Nouveau signalement sur <strong>Leçon 5</strong>',time:'Hier 16h'},
].map(f=>`<div class="feed-item"><div class="fi-icon" style="background:${f.bg}">${f.ic}</div><div class="fi-text">${f.text}<div class="fi-time">${f.time}</div></div></div>`).join('');

/* Notifications */
const notifData=[
  {ic:'📝',bg:'var(--blue-l)',text:'Amina K. a soumis son devoir – Leçon 3 (Marketing Digital)',time:'Il y a 10 min',unread:true},
  {ic:'✅',bg:'var(--green-l)',text:'Formation "Bureautique Avancée" en attente de validation',time:'Il y a 45 min',unread:true},
  {ic:'👤',bg:'var(--violet-l)',text:'Nouveau formateur Kevin Brice a soumis sa demande',time:'Il y a 2h',unread:true},
  {ic:'💰',bg:'var(--amber-l)',text:'5 virements formateurs en attente de traitement',time:'Il y a 3h',unread:true},
  {ic:'🚩',bg:'var(--red-l)',text:'Signalement prioritaire : contenu inapproprié Leçon 5',time:'Hier 16h',unread:true},
  {ic:'🤝',bg:'var(--teal-l)',text:'3 demandes partenariat en attente d\'examen',time:'Hier 14h',unread:false},
  {ic:'⚠️',bg:'var(--amber-l)',text:'Tentative de connexion suspecte détectée',time:'Hier 11h',unread:false},
  {ic:'📊',bg:'var(--blue-l)',text:'Rapport mensuel Mars 2026 disponible',time:'Il y a 2j',unread:false},
];
const nhtml=notifData.map(n=>`
  <div class="notif-row ${n.unread?'unread':''}">
    <div class="ni-icon" style="background:${n.bg}">${n.ic}</div>
    <div style="flex:1"><div class="ni-text">${n.text}</div><div class="ni-time">${n.time}</div></div>
    ${n.unread?'<div class="ni-dot" style="background:var(--blue)"></div>':''}
  </div>`).join('');
document.getElementById('all-notifs').innerHTML=nhtml;

/* Pending table dashboard */
document.getElementById('tbl-pending').innerHTML=`<thead><tr><th>Formation</th><th>Formateur</th><th>Catégorie</th><th>Soumis le</th><th>Prix</th><th>Actions</th></tr></thead><tbody>`+
  [['Bureautique Avancée','Kevin Brice','Bureautique','18/03/2026','35 000 F'],
   ['Dev Web React','Luc Martin','Dev Web','17/03/2026','50 000 F'],
   ['Excel Avancé','Fatou Aw','Bureautique','15/03/2026','25 000 F'],
   ['SEO & Google Ads','Paul Tchamba','Marketing','12/03/2026','40 000 F'],
  ].map(([t,f,c,d,p])=>`<tr>
    <td style="font-weight:600">${t}</td><td>${f}</td><td>${c}</td><td>${d}</td><td style="font-weight:700;color:var(--green-d)">${p}</td>
    <td><div style="display:flex;gap:.4rem">
      <button class="btn btn-success btn-sm">✅ Valider</button>
      <button class="btn btn-danger btn-sm">❌ Rejeter</button>
      <button class="btn btn-ghost btn-sm">👁</button>
    </div></td>
  </tr>`).join('')+'</tbody>';

/* Tabs */
document.querySelectorAll('.tabs').forEach(tabs=>{
  tabs.querySelectorAll('.tab').forEach(tab=>{
    tab.addEventListener('click',()=>{tabs.querySelectorAll('.tab').forEach(t=>t.classList.remove('on'));tab.classList.add('on')});
  });
});
</script>
</body>
</html>
