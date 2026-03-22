<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Mon Espace</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Fraunces:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#f5f3ef;
  --blue:#2563eb;--blue-d:#1d4ed8;--blue-l:#dbeafe;--blue-xl:#eff6ff;
  --green:#16a34a;--green-l:#dcfce7;--green-d:#15803d;
  --amber:#d97706;--amber-l:#fef3c7;
  --rose:#e11d48;--rose-l:#ffe4e6;
  --violet:#7c3aed;--violet-l:#ede9fe;
  --teal:#0d9488;--teal-l:#ccfbf1;
  --orange:#ea580c;--orange-l:#ffedd5;
  --gray-100:#f3f4f6;--gray-200:#e5e7eb;--gray-300:#d1d5db;
  --gray-400:#9ca3af;--gray-500:#6b7280;--gray-600:#4b5563;
  --gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;
  --white:#fff;--ink:#1a1a2e;
  --sidebar-w:248px;
  --font:'Nunito',sans-serif;
  --serif:'Fraunces',serif;
  --r:14px;--r-sm:8px;--r-xs:6px;
  --sh:0 1px 3px rgba(0,0,0,.06),0 2px 8px rgba(0,0,0,.06);
  --sh-md:0 6px 20px rgba(0,0,0,.1);
}
html,body{height:100%;font-family:var(--font);background:var(--bg);color:var(--gray-800);overflow:hidden}
.app{display:flex;height:100vh;width:100vw}

/* ═══════════════════ SIDEBAR ═══════════════════ */
.sidebar{
  width:var(--sidebar-w);flex-shrink:0;
  background:var(--ink);
  display:flex;flex-direction:column;
  position:relative;overflow:hidden;
}
.sidebar::before{
  content:'';position:absolute;
  bottom:-60px;right:-60px;
  width:200px;height:200px;border-radius:50%;
  background:radial-gradient(circle,rgba(37,99,235,.15),transparent 70%);
  pointer-events:none;
}

.sb-top{
  padding:1.4rem 1.3rem 1rem;
  position:relative;z-index:1;
}
.sb-brand{display:flex;align-items:center;gap:.65rem;margin-bottom:1.5rem}
.sb-mark{
  width:32px;height:32px;background:var(--blue);border-radius:var(--r-xs);
  display:flex;align-items:center;justify-content:center;
  font-weight:900;font-size:.82rem;color:#fff;
  box-shadow:0 3px 10px rgba(37,99,235,.4);
}
.sb-brand-txt{font-weight:800;font-size:1rem;color:#fff;letter-spacing:-.2px}
.sb-brand-txt span{color:#60a5fa}

/* User card inside sidebar */
.sb-user-card{
  background:rgba(255,255,255,.06);border-radius:var(--r);
  padding:.85rem 1rem;display:flex;align-items:center;gap:.75rem;
  border:1px solid rgba(255,255,255,.08);
}
.sb-av{
  width:40px;height:40px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,#f59e0b,#ef4444);
  display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:.9rem;color:#fff;
  border:2px solid rgba(255,255,255,.2);
}
.sb-user-info{flex:1;min-width:0}
.sb-user-name{font-size:.85rem;font-weight:700;color:#fff;line-height:1.2}
.sb-user-role{font-size:.68rem;color:rgba(255,255,255,.4);margin-top:.1rem}
.sb-user-xp{display:flex;align-items:center;gap:.4rem;margin-top:.4rem}
.xp-bar{flex:1;height:4px;background:rgba(255,255,255,.1);border-radius:99px;overflow:hidden}
.xp-fill{height:100%;background:linear-gradient(90deg,#f59e0b,#ef4444);border-radius:99px;width:68%}
.xp-txt{font-size:.63rem;color:rgba(255,255,255,.35);font-weight:600}

/* Nav */
.sb-nav{flex:1;padding:.75rem .85rem;overflow-y:auto}
.sb-nav::-webkit-scrollbar{width:0}
.sb-grp-lbl{font-size:.6rem;font-weight:800;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.2);padding:.75rem .55rem .3rem}

.sbi{
  display:flex;align-items:center;gap:.65rem;
  padding:.58rem .65rem;border-radius:var(--r-sm);
  cursor:pointer;font-size:.84rem;font-weight:600;
  color:rgba(255,255,255,.45);margin-bottom:.05rem;
  transition:all .18s;position:relative;
}
.sbi:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.85)}
.sbi.on{background:rgba(37,99,235,.25);color:#fff}
.sbi.on::before{content:'';position:absolute;left:0;top:22%;bottom:22%;width:3px;background:var(--blue);border-radius:0 3px 3px 0}
.sbi .si{font-size:.95rem;width:18px;text-align:center;flex-shrink:0}
.sbi .badge{margin-left:auto;min-width:18px;height:18px;padding:0 .3rem;background:rgba(37,99,235,.35);color:#93c5fd;border-radius:99px;font-size:.62rem;font-weight:700;display:flex;align-items:center;justify-content:center}
.sbi .badge.red{background:rgba(225,29,72,.3);color:#fda4af}

.sb-div{height:1px;background:rgba(255,255,255,.06);margin:.4rem .55rem}

.sb-bottom{padding:.85rem 1rem;border-top:1px solid rgba(255,255,255,.05)}
.sb-logout{display:flex;align-items:center;gap:.6rem;padding:.5rem .65rem;border-radius:var(--r-sm);cursor:pointer;font-size:.82rem;font-weight:600;color:rgba(225,29,72,.5);transition:all .18s}
.sb-logout:hover{background:rgba(225,29,72,.1);color:rgba(225,29,72,.8)}

/* ═══════════════════ MAIN ═══════════════════ */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;min-width:0}

.topbar{
  height:58px;background:var(--white);
  border-bottom:1px solid var(--gray-200);
  display:flex;align-items:center;padding:0 1.8rem;gap:1rem;
  flex-shrink:0;box-shadow:var(--sh);
}
.tb-page-title{font-size:.95rem;font-weight:800;color:var(--gray-900)}
.tb-search{
  flex:1;max-width:260px;margin-left:1rem;
  display:flex;align-items:center;gap:.5rem;
  background:var(--gray-100);border-radius:99px;
  padding:.38rem .95rem;border:1.5px solid transparent;transition:all .2s;
}
.tb-search:focus-within{background:var(--white);border-color:var(--blue);box-shadow:0 0 0 3px var(--blue-l)}
.tb-search input{background:none;border:none;outline:none;font-family:var(--font);font-size:.82rem;color:var(--gray-800);flex:1}
.tb-search input::placeholder{color:var(--gray-400)}
.tb-right{margin-left:auto;display:flex;align-items:center;gap:.5rem}
.tb-ico{width:34px;height:34px;border-radius:99px;border:none;background:var(--gray-100);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.9rem;color:var(--gray-500);transition:all .15s;position:relative}
.tb-ico:hover{background:var(--gray-200)}
.tb-dot{position:absolute;top:5px;right:5px;width:7px;height:7px;background:var(--rose);border-radius:50%;border:1.5px solid var(--white)}
.tb-av{width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#ef4444);display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:800;color:#fff;cursor:pointer;border:2px solid var(--gray-200)}

/* ═══════════════════ CONTENT ═══════════════════ */
.content{flex:1;overflow-y:auto;padding:1.6rem 2rem}
.content::-webkit-scrollbar{width:4px}
.content::-webkit-scrollbar-thumb{background:var(--gray-300);border-radius:99px}

.page{display:none;animation:fadeUp .3s ease}
.page.show{display:block}
@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* ═══ HELPERS ═══ */
.ph{margin-bottom:1.6rem}
.ph h1{font-family:var(--serif);font-size:1.55rem;color:var(--gray-900);line-height:1.25}
.ph p{font-size:.85rem;color:var(--gray-500);margin-top:.3rem}

.g2{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem}
.g3{display:grid;grid-template-columns:2fr 1fr;gap:1.2rem;margin-bottom:1.2rem}
.g4{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.4rem}

.card{background:var(--white);border-radius:var(--r);box-shadow:var(--sh);border:1px solid var(--gray-200);overflow:hidden}
.card-hdr{padding:.9rem 1.2rem;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between}
.card-hdr h3{font-size:.9rem;font-weight:800;color:var(--gray-800)}
.card-hdr p{font-size:.72rem;color:var(--gray-400);margin-top:.1rem}
.card-body{padding:1.1rem 1.2rem}
.lnk{background:none;border:none;font-family:var(--font);font-size:.76rem;font-weight:700;color:var(--blue);cursor:pointer;padding:0;transition:color .15s}
.lnk:hover{color:var(--blue-d)}

/* ═══ STAT CARDS ═══ */
.stat-mini{background:var(--white);border-radius:var(--r);padding:1rem 1.1rem;border:1px solid var(--gray-200);box-shadow:var(--sh);cursor:default;transition:transform .18s,box-shadow .18s}
.stat-mini:hover{transform:translateY(-2px);box-shadow:var(--sh-md)}
.sm-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:.6rem}
.sm-icon{width:36px;height:36px;border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;font-size:1rem}
.sm-icon.b{background:var(--blue-l)} .sm-icon.g{background:var(--green-l)}
.sm-icon.a{background:var(--amber-l)} .sm-icon.v{background:var(--violet-l)}
.sm-icon.t{background:var(--teal-l)} .sm-icon.r{background:var(--rose-l)}
.sm-val{font-size:1.5rem;font-weight:900;color:var(--gray-900);line-height:1}
.sm-lbl{font-size:.75rem;color:var(--gray-500);margin-top:.2rem;font-weight:600}

/* ═══ FORMATION CARD ═══ */
.fc{background:var(--white);border-radius:var(--r);border:1px solid var(--gray-200);overflow:hidden;cursor:pointer;transition:all .2s;box-shadow:var(--sh)}
.fc:hover{transform:translateY(-3px);box-shadow:var(--sh-md)}
.fc-thumb{height:110px;display:flex;align-items:center;justify-content:center;font-size:2.5rem;position:relative;overflow:hidden}
.fc-thumb::after{content:'';position:absolute;inset:0;background:linear-gradient(0deg,rgba(0,0,0,.15),transparent)}
.fc-pill{position:absolute;top:.6rem;left:.6rem;z-index:1;font-size:.65rem;font-weight:800;padding:.2rem .55rem;border-radius:99px}
.fc-pill.active{background:var(--green);color:#fff}
.fc-pill.pending{background:var(--amber-l);color:var(--amber)}
.fc-pill.done{background:var(--blue-l);color:var(--blue)}
.fc-body{padding:1rem}
.fc-title{font-size:.9rem;font-weight:800;color:var(--gray-800);line-height:1.3;margin-bottom:.25rem}
.fc-meta{font-size:.73rem;color:var(--gray-400);margin-bottom:.75rem}
.prog-label{display:flex;justify-content:space-between;font-size:.72rem;font-weight:700;color:var(--gray-600);margin-bottom:.35rem}
.prog-track{height:7px;background:var(--gray-100);border-radius:99px;overflow:hidden}
.prog-fill{height:100%;border-radius:99px;transition:width .8s ease}
.fc-footer{padding:.7rem 1rem;border-top:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between}

/* ═══ BUTTONS ═══ */
.btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:99px;font-family:var(--font);font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .18s}
.btn-primary{background:var(--blue);color:#fff;box-shadow:0 3px 10px rgba(37,99,235,.3)}
.btn-primary:hover{background:var(--blue-d);transform:translateY(-1px)}
.btn-ghost{background:var(--white);color:var(--gray-600);border:1.5px solid var(--gray-200)}
.btn-ghost:hover{border-color:var(--gray-400);color:var(--gray-800)}
.btn-green{background:var(--green);color:#fff;box-shadow:0 3px 10px rgba(22,163,74,.3)}
.btn-green:hover{background:var(--green-d)}
.btn-sm{padding:.35rem .85rem;font-size:.78rem}

/* ═══ QUIZ RESULT ═══ */
.quiz-result-card{
  border-radius:var(--r);padding:1rem 1.2rem;
  display:flex;align-items:center;gap:.9rem;
  border:1px solid var(--gray-200);background:var(--white);
  margin-bottom:.6rem;transition:all .18s;cursor:pointer;box-shadow:var(--sh);
}
.quiz-result-card:hover{transform:translateX(3px);box-shadow:var(--sh-md)}
.qrc-score{
  width:52px;height:52px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-weight:900;font-size:1rem;
}
.qrc-info{flex:1}
.qrc-title{font-size:.86rem;font-weight:700;color:var(--gray-800)}
.qrc-sub{font-size:.73rem;color:var(--gray-400);margin-top:.1rem}
.qrc-badge{font-size:.68rem;font-weight:700;padding:.18rem .55rem;border-radius:99px}
.qrc-badge.pass{background:var(--green-l);color:var(--green-d)}
.qrc-badge.fail{background:var(--rose-l);color:var(--rose)}

/* ═══ NOTIF ═══ */
.notif-item{
  display:flex;align-items:flex-start;gap:.75rem;
  padding:.7rem .85rem;border-radius:var(--r-sm);
  cursor:pointer;transition:background .15s;border-bottom:1px solid var(--gray-100);
}
.notif-item:last-child{border-bottom:none}
.notif-item:hover{background:var(--gray-50)}
.notif-item.unread{background:var(--blue-xl)}
.ni-ico{width:32px;height:32px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.88rem}
.ni-body{flex:1}
.ni-text{font-size:.82rem;color:var(--gray-700);font-weight:500;line-height:1.45}
.ni-time{font-size:.68rem;color:var(--gray-400);margin-top:.15rem}

/* ═══ TABS ═══ */
.tabs{display:flex;gap:.15rem;background:var(--gray-100);padding:.2rem;border-radius:99px;margin-bottom:1.2rem;width:fit-content}
.tab{padding:.38rem 1rem;border-radius:99px;font-size:.8rem;font-weight:700;color:var(--gray-500);cursor:pointer;border:none;background:transparent;font-family:var(--font);transition:all .18s}
.tab.on{background:var(--white);color:var(--blue);box-shadow:var(--sh)}

/* ═══ CATALOGUE ═══ */
.cat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
.cat-card{background:var(--white);border-radius:var(--r);border:1px solid var(--gray-200);overflow:hidden;cursor:pointer;transition:all .2s;box-shadow:var(--sh)}
.cat-card:hover{transform:translateY(-3px);box-shadow:var(--sh-md)}
.cat-thumb{height:90px;display:flex;align-items:center;justify-content:center;font-size:2.2rem}
.cat-body{padding:.85rem}
.cat-title{font-size:.88rem;font-weight:800;color:var(--gray-800);margin-bottom:.2rem}
.cat-meta{font-size:.72rem;color:var(--gray-400);margin-bottom:.55rem}
.cat-footer{display:flex;align-items:center;justify-content:space-between}
.cat-price{font-size:.88rem;font-weight:800;color:var(--blue)}
.cat-note{font-size:.75rem;color:var(--amber);font-weight:700}

/* ═══ PROFIL ═══ */
.profil-hero{
  background:linear-gradient(135deg,var(--ink),#1e3a5f);
  border-radius:var(--r);padding:2rem;
  display:flex;align-items:center;gap:1.5rem;
  margin-bottom:1.2rem;color:#fff;
}
.profil-av{
  width:72px;height:72px;border-radius:50%;flex-shrink:0;
  background:linear-gradient(135deg,#f59e0b,#ef4444);
  display:flex;align-items:center;justify-content:center;
  font-weight:900;font-size:1.5rem;color:#fff;
  border:3px solid rgba(255,255,255,.25);
}
.profil-name{font-family:var(--serif);font-size:1.35rem;font-weight:600;line-height:1.2}
.profil-role{font-size:.8rem;opacity:.55;margin-top:.2rem}
.profil-xp{display:flex;align-items:center;gap:.75rem;margin-top:.75rem}
.profil-xp-bar{flex:1;height:6px;background:rgba(255,255,255,.15);border-radius:99px;overflow:hidden;max-width:180px}
.profil-xp-fill{height:100%;background:linear-gradient(90deg,#f59e0b,#ef4444);border-radius:99px;width:68%}
.profil-xp-txt{font-size:.75rem;opacity:.6}

.profil-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.9rem;margin-bottom:1.2rem}
.ps-card{background:var(--white);border-radius:var(--r);padding:1rem;border:1px solid var(--gray-200);text-align:center;box-shadow:var(--sh)}
.ps-icon{font-size:1.4rem;margin-bottom:.35rem}
.ps-val{font-size:1.2rem;font-weight:900;color:var(--gray-900)}
.ps-lbl{font-size:.72rem;color:var(--gray-400);margin-top:.1rem;font-weight:600}

/* ═══ ATTESTATIONS ═══ */
.attest-card{
  background:linear-gradient(135deg,#fef9ee,#fff8f0);
  border:1.5px solid rgba(217,119,6,.2);border-radius:var(--r);
  padding:1.2rem 1.4rem;display:flex;align-items:center;gap:1rem;
  cursor:pointer;transition:all .2s;box-shadow:var(--sh);
}
.attest-card:hover{transform:translateY(-2px);box-shadow:var(--sh-md)}
.attest-seal{
  width:52px;height:52px;background:linear-gradient(135deg,#f59e0b,#ea580c);
  border-radius:50%;display:flex;align-items:center;justify-content:center;
  font-size:1.4rem;flex-shrink:0;box-shadow:0 4px 12px rgba(245,158,11,.35);
}
.attest-info{flex:1}
.attest-title{font-size:.9rem;font-weight:800;color:var(--gray-800)}
.attest-sub{font-size:.75rem;color:var(--gray-500);margin-top:.15rem}
.attest-date{font-size:.7rem;color:var(--amber);font-weight:700;margin-top:.3rem}

/* ═══ CALENDRIER ═══ */
.cal-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:.3rem;margin-top:.75rem}
.cal-day-lbl{font-size:.65rem;font-weight:700;color:var(--gray-400);text-align:center;padding-bottom:.3rem;text-transform:uppercase}
.cal-day{
  aspect-ratio:1;border-radius:var(--r-xs);display:flex;align-items:center;justify-content:center;
  font-size:.72rem;font-weight:600;cursor:pointer;transition:all .15s;color:var(--gray-500);
}
.cal-day:hover{background:var(--blue-l);color:var(--blue)}
.cal-day.active{background:var(--green);color:#fff;font-weight:800}
.cal-day.today{background:var(--blue);color:#fff;font-weight:800}
.cal-day.other{color:var(--gray-300)}

/* ═══ FORUM ═══ */
.forum-item{padding:.8rem .85rem;border-bottom:1px solid var(--gray-100);cursor:pointer;transition:background .15s;display:flex;gap:.75rem;align-items:flex-start}
.forum-item:last-child{border-bottom:none}
.forum-item:hover{background:var(--gray-50)}
.fi-av{width:30px;height:30px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:#fff}
.fi-body{flex:1}
.fi-title{font-size:.84rem;font-weight:700;color:var(--gray-800)}
.fi-sub{font-size:.72rem;color:var(--gray-400);margin-top:.1rem}
.fi-tag{display:inline-flex;padding:.1rem .45rem;background:var(--blue-l);color:var(--blue);border-radius:99px;font-size:.65rem;font-weight:700;margin-top:.3rem}

/* ═══ INPUT ═══ */
.inp{width:100%;padding:.6rem .9rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:var(--font);font-size:.85rem;color:var(--gray-800);background:var(--white);outline:none;transition:border-color .2s}
.inp:focus{border-color:var(--blue)}
.inp-label{font-size:.76rem;font-weight:700;color:var(--gray-600);display:block;margin-bottom:.35rem}

/* ═══ RESPONSIVE ═══ */
@media(max-width:1100px){.g4{grid-template-columns:1fr 1fr}.cat-grid{grid-template-columns:1fr 1fr}.profil-stats{grid-template-columns:1fr 1fr}}
@media(max-width:900px){.g2,.g3{grid-template-columns:1fr}}
</style>
</head>
<body>
<div class="app">

<!-- ══════════════ SIDEBAR ══════════════ -->
<aside class="sidebar">
  <div class="sb-top">
    <div class="sb-brand">
      <div class="sb-mark">ST</div>
      <div class="sb-brand-txt">Skill<span>Tract</span></div>
    </div>
    <div class="sb-user-card">
      <div class="sb-av">AK</div>
      <div class="sb-user-info">
        <div class="sb-user-name">Amina Kamga</div>
        <div class="sb-user-role">Apprenant · Niveau 4</div>
        <div class="sb-user-xp">
          <div class="xp-bar"><div class="xp-fill"></div></div>
          <span class="xp-txt">680 / 1000 XP</span>
        </div>
      </div>
    </div>
  </div>

  <nav class="sb-nav">
    <div class="sb-grp-lbl">Mon espace</div>
    <div class="sbi on" onclick="go('accueil')"><span class="si">🏠</span>Accueil</div>
    <div class="sbi" onclick="go('mes-formations')"><span class="si">📚</span>Mes formations<span class="badge">3</span></div>
    <div class="sbi" onclick="go('devoirs')"><span class="si">✏️</span>Mes devoirs<span class="badge red">2</span></div>
    <div class="sbi" onclick="go('quiz')"><span class="si">📝</span>Mes quiz</div>
    <div class="sbi" onclick="go('attestations')"><span class="si">🏆</span>Attestations<span class="badge">1</span></div>

    <div class="sb-div"></div>
    <div class="sb-grp-lbl">Découvrir</div>
    <div class="sbi" onclick="go('catalogue')"><span class="si">🔍</span>Catalogue</div>
    <div class="sbi" onclick="go('mentors')"><span class="si">👨‍🏫</span>Mentors</div>
    <div class="sbi" onclick="go('forum')"><span class="si">💬</span>Forum<span class="badge">5</span></div>

    <div class="sb-div"></div>
    <div class="sb-grp-lbl">Compte</div>
    <div class="sbi" onclick="go('profil')"><span class="si">👤</span>Mon profil</div>
    <div class="sbi" onclick="go('parametres')"><span class="si">⚙️</span>Paramètres</div>
    <div class="sbi" onclick="go('notifications')"><span class="si">🔔</span>Notifications<span class="badge red">4</span></div>
  </nav>

  <div class="sb-bottom">
    <div class="sb-logout"><span>🚪</span>Déconnexion</div>
  </div>
</aside>

<!-- ══════════════ MAIN ══════════════ -->
<div class="main">
  <div class="topbar">
    <div class="tb-page-title" id="tb-title">Accueil</div>
    <div class="tb-search"><span style="color:var(--gray-400)">🔍</span><input type="text" placeholder="Chercher une formation…"></div>
    <div class="tb-right">
      <button class="tb-ico">🔔<span class="tb-dot"></span></button>
      <button class="tb-ico">💬</button>
      <div class="tb-av">AK</div>
    </div>
  </div>

  <div class="content">

    <!-- ══════ ACCUEIL ══════ -->
    <div class="page show" id="page-accueil">

      <!-- Hero greeting -->
      <div style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);border-radius:var(--r);padding:1.8rem 2rem;margin-bottom:1.4rem;display:flex;align-items:center;justify-content:space-between;overflow:hidden;position:relative">
        <div style="position:absolute;top:-40px;right:-40px;width:200px;height:200px;border-radius:50%;background:radial-gradient(circle,rgba(37,99,235,.25),transparent 70%)"></div>
        <div style="position:relative;z-index:1">
          <div style="font-size:.78rem;font-weight:700;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:1px;margin-bottom:.4rem">Bon retour 👋</div>
          <div style="font-family:var(--serif);font-size:1.5rem;color:#fff;font-weight:600;line-height:1.25">Amina, continuez sur<br><em style="color:#60a5fa">votre lancée !</em></div>
          <div style="font-size:.83rem;color:rgba(255,255,255,.5);margin-top:.5rem">Vous avez <strong style="color:#fbbf24">2 devoirs</strong> en attente et <strong style="color:#34d399">1 quiz</strong> à compléter.</div>
          <div style="display:flex;gap:.65rem;margin-top:1.1rem">
            <button class="btn btn-primary btn-sm" onclick="go('mes-formations')">Reprendre le cours →</button>
            <button class="btn btn-ghost btn-sm" style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.7);border-color:rgba(255,255,255,.12)">Voir mes devoirs</button>
          </div>
        </div>
        <div style="font-size:4rem;opacity:.15;position:absolute;right:2rem;bottom:-10px;font-size:8rem;line-height:1">📚</div>
      </div>

      <!-- Stats mini -->
      <div class="g4" style="margin-bottom:1.4rem">
        <div class="stat-mini">
          <div class="sm-top"><div class="sm-icon b">📚</div></div>
          <div class="sm-val">3</div><div class="sm-lbl">Formations actives</div>
        </div>
        <div class="stat-mini">
          <div class="sm-top"><div class="sm-icon g">✅</div></div>
          <div class="sm-val">78%</div><div class="sm-lbl">Progression moy.</div>
        </div>
        <div class="stat-mini">
          <div class="sm-top"><div class="sm-icon a">🏆</div></div>
          <div class="sm-val">1</div><div class="sm-lbl">Attestation obtenue</div>
        </div>
        <div class="stat-mini">
          <div class="sm-top"><div class="sm-icon v">⭐</div></div>
          <div class="sm-val">680</div><div class="sm-lbl">Points XP</div>
        </div>
      </div>

      <div class="g3">
        <!-- Formations en cours -->
        <div>
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.9rem">
            <div style="font-size:1rem;font-weight:800;color:var(--gray-800)">📌 En cours</div>
            <button class="lnk" onclick="go('mes-formations')">Tout voir →</button>
          </div>
          <div style="display:flex;flex-direction:column;gap:.85rem" id="home-formations"></div>
        </div>

        <!-- Côté droit -->
        <div style="display:flex;flex-direction:column;gap:1.2rem">
          <!-- Streak / Activité -->
          <div class="card">
            <div class="card-hdr"><div><h3>🔥 Série d'apprentissage</h3></div></div>
            <div class="card-body" style="text-align:center;padding:1.2rem">
              <div style="font-size:2.5rem;font-weight:900;color:var(--orange)">7</div>
              <div style="font-size:.8rem;color:var(--gray-500);margin-top:.2rem;font-weight:600">jours consécutifs</div>
              <div style="display:flex;justify-content:center;gap:.35rem;margin-top:.85rem">
                ${['L','M','M','J','V','S','D'].map((j,i)=>`<div style="display:flex;flex-direction:column;align-items:center;gap:.3rem">
                  <div style="width:26px;height:26px;border-radius:50%;background:${i<7?'var(--orange)':'var(--gray-100)'};display:flex;align-items:center;justify-content:center;font-size:.7rem">${i<7?'🔥':''}</div>
                  <span style="font-size:.6rem;color:var(--gray-400);font-weight:700">${j}</span>
                </div>`).join('')}
              </div>
            </div>
          </div>
          <!-- Prochain devoir -->
          <div class="card">
            <div class="card-hdr"><div><h3>⏰ Prochain devoir</h3></div></div>
            <div class="card-body">
              <div style="font-size:.85rem;font-weight:700;color:var(--gray-800);margin-bottom:.3rem">Leçon 4 – Stratégie de contenu</div>
              <div style="font-size:.75rem;color:var(--gray-400)">Marketing Digital · À rendre dans</div>
              <div style="font-size:1.2rem;font-weight:900;color:var(--rose);margin:.4rem 0">2 jours restants</div>
              <button class="btn btn-primary btn-sm" style="width:100%;justify-content:center" onclick="go('devoirs')">Voir le devoir →</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Notifications récentes -->
      <div class="card">
        <div class="card-hdr">
          <div><h3>🔔 Notifications récentes</h3></div>
          <button class="lnk" onclick="go('notifications')">Tout voir →</button>
        </div>
        <div id="home-notifs"></div>
      </div>
    </div>

    <!-- ══════ MES FORMATIONS ══════ -->
    <div class="page" id="page-mes-formations">
      <div class="ph"><h1>Mes Formations</h1><p>3 formations en cours · 1 terminée</p></div>
      <div class="tabs">
        <button class="tab on">En cours (3)</button>
        <button class="tab">Terminées (1)</button>
        <button class="tab">À commencer (0)</button>
      </div>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem" id="formations-grid"></div>
    </div>

    <!-- ══════ DEVOIRS ══════ -->
    <div class="page" id="page-devoirs">
      <div class="ph"><h1>Mes Devoirs</h1><p>2 à soumettre · 4 corrigés</p></div>
      <div class="tabs">
        <button class="tab on">À faire (2)</button>
        <button class="tab">Soumis (4)</button>
        <button class="tab">Corrigés (3)</button>
      </div>
      <div style="display:flex;flex-direction:column;gap:.9rem" id="devoirs-list"></div>
    </div>

    <!-- ══════ QUIZ ══════ -->
    <div class="page" id="page-quiz">
      <div class="ph"><h1>Mes Quiz</h1><p>Résultats et évaluations</p></div>
      <div class="g3">
        <div>
          <div style="font-size:.85rem;font-weight:800;color:var(--gray-600);text-transform:uppercase;letter-spacing:.6px;margin-bottom:.85rem">Résultats récents</div>
          <div id="quiz-list"></div>
        </div>
        <div>
          <div class="card" style="margin-bottom:1rem">
            <div class="card-hdr"><h3>📊 Statistiques</h3></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:.7rem">
              ${[['Quiz passés','6'],['Score moyen','74%'],['Validés (≥70%)','4'],['À repasser','2']].map(([l,v])=>`
              <div style="display:flex;align-items:center;justify-content:space-between;padding:.5rem .7rem;background:var(--gray-50);border-radius:var(--r-sm)">
                <span style="font-size:.82rem;color:var(--gray-600)">${l}</span>
                <span style="font-size:.88rem;font-weight:800;color:var(--gray-900)">${v}</span>
              </div>`).join('')}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ ATTESTATIONS ══════ -->
    <div class="page" id="page-attestations">
      <div class="ph"><h1>Mes Attestations</h1><p>1 obtenue · 2 en cours de validation</p></div>
      <div class="g2">
        <div>
          <div style="font-size:.85rem;font-weight:800;color:var(--gray-600);text-transform:uppercase;letter-spacing:.6px;margin-bottom:.85rem">✅ Attestations obtenues</div>
          <div class="attest-card" style="margin-bottom:.85rem">
            <div class="attest-seal">🏆</div>
            <div class="attest-info">
              <div class="attest-title">Marketing Digital Complet</div>
              <div class="attest-sub">Score final : 85% · Mention Bien</div>
              <div class="attest-date">Obtenu le 15 Mars 2026</div>
            </div>
            <button class="btn btn-ghost btn-sm">📥 Télécharger</button>
          </div>
          <div style="font-size:.85rem;font-weight:800;color:var(--gray-600);text-transform:uppercase;letter-spacing:.6px;margin-bottom:.85rem;margin-top:1.4rem">⏳ En cours</div>
          ${[['Infographie Canva','Quiz final en cours','55%'],['Bureautique Avancée','Leçon 4 / 12','20%']].map(([t,s,p])=>`
          <div class="card" style="padding:1rem 1.2rem;margin-bottom:.7rem;display:flex;align-items:center;gap:1rem">
            <div style="font-size:1.5rem">📜</div>
            <div style="flex:1">
              <div style="font-size:.86rem;font-weight:700;color:var(--gray-800)">${t}</div>
              <div style="font-size:.74rem;color:var(--gray-400);margin-top:.1rem">${s}</div>
              <div style="height:4px;background:var(--gray-100);border-radius:99px;overflow:hidden;margin-top:.5rem"><div style="height:100%;width:${p};background:linear-gradient(90deg,var(--blue),#818cf8);border-radius:99px"></div></div>
            </div>
            <span style="font-size:.82rem;font-weight:700;color:var(--blue)">${p}</span>
          </div>`).join('')}
        </div>
        <div class="card">
          <div class="card-hdr"><h3>🎖 Badges obtenus</h3></div>
          <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;text-align:center">
              ${[['🔥','7 jours streak','Feu sacré'],['📚','3 formations','Studieux'],['✅','85% quiz','Expert'],['💬','5 posts forum','Communauté'],['⭐','Premier cours','Débutant'],['🏃','À venir','???']].map(([ic,v,n],i)=>`
              <div style="background:${i<5?'var(--amber-l)':'var(--gray-50)'};border-radius:var(--r-sm);padding:.75rem .5rem;border:1px solid ${i<5?'rgba(217,119,6,.2)':'var(--gray-200)'}">
                <div style="font-size:1.5rem;filter:${i>=5?'grayscale(1) opacity(.3)':'none'}">${ic}</div>
                <div style="font-size:.7rem;font-weight:800;color:${i<5?'var(--amber)':'var(--gray-400)'};margin-top:.3rem">${n}</div>
                <div style="font-size:.64rem;color:var(--gray-400);margin-top:.1rem">${v}</div>
              </div>`).join('')}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ CATALOGUE ══════ -->
    <div class="page" id="page-catalogue">
      <div class="ph" style="display:flex;align-items:flex-end;justify-content:space-between">
        <div><h1>Catalogue des Formations</h1><p>Découvrez toutes nos formations disponibles</p></div>
        <div style="display:flex;gap:.6rem">
          <select style="padding:.42rem .85rem;border:1.5px solid var(--gray-200);border-radius:99px;font-family:var(--font);font-size:.8rem;outline:none;cursor:pointer"><option>Toutes catégories</option><option>Marketing</option><option>Design</option><option>Dev Web</option></select>
          <select style="padding:.42rem .85rem;border:1.5px solid var(--gray-200);border-radius:99px;font-family:var(--font);font-size:.8rem;outline:none;cursor:pointer"><option>Tous niveaux</option><option>Débutant</option><option>Intermédiaire</option><option>Avancé</option></select>
        </div>
      </div>
      <div class="cat-grid" id="catalogue-grid"></div>
    </div>

    <!-- ══════ MENTORS ══════ -->
    <div class="page" id="page-mentors">
      <div class="ph"><h1>Nos Mentors</h1><p>Rencontrez nos formateurs experts</p></div>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem" id="mentors-grid"></div>
    </div>

    <!-- ══════ FORUM ══════ -->
    <div class="page" id="page-forum">
      <div class="ph" style="display:flex;align-items:flex-end;justify-content:space-between">
        <div><h1>Forum</h1><p>Échangez avec la communauté SkillTract</p></div>
        <button class="btn btn-primary btn-sm">✏️ Nouveau sujet</button>
      </div>
      <div class="g3">
        <div class="card">
          <div class="card-hdr"><h3>💬 Discussions récentes</h3></div>
          <div id="forum-list"></div>
        </div>
        <div style="display:flex;flex-direction:column;gap:1rem">
          <div class="card">
            <div class="card-hdr"><h3>🔥 Sujets populaires</h3></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:.5rem">
              ${['Comment faire un bon SEO ?','Les meilleures pratiques Canva','Réussir son quiz final','Les outils du marketing digital'].map((t,i)=>`
              <div style="padding:.5rem .65rem;background:var(--gray-50);border-radius:var(--r-sm);font-size:.82rem;font-weight:600;color:var(--gray-700);cursor:pointer;transition:background .15s" onmouseover="this.style.background='var(--blue-xl)'" onmouseout="this.style.background='var(--gray-50)'">${['🔥','💡','📝','🛠'][i]} ${t}</div>`).join('')}
            </div>
          </div>
          <div class="card">
            <div class="card-hdr"><h3>📌 Poster un message</h3></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:.75rem">
              <div><label class="inp-label">Titre</label><input class="inp" type="text" placeholder="Votre question…"></div>
              <div><label class="inp-label">Message</label><textarea class="inp" rows="3" placeholder="Décrivez votre problème…" style="resize:none"></textarea></div>
              <button class="btn btn-primary" style="justify-content:center">Publier →</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ PROFIL ══════ -->
    <div class="page" id="page-profil">
      <div class="profil-hero">
        <div class="profil-av">AK</div>
        <div>
          <div class="profil-name">Amina Kamga</div>
          <div class="profil-role">Apprenant · Membre depuis Janvier 2025</div>
          <div class="profil-xp">
            <div class="profil-xp-bar"><div class="profil-xp-fill"></div></div>
            <span class="profil-xp-txt">Niveau 4 · 680 / 1000 XP</span>
          </div>
        </div>
        <div style="margin-left:auto;text-align:right">
          <button class="btn btn-ghost btn-sm" style="background:rgba(255,255,255,.1);color:#fff;border-color:rgba(255,255,255,.2)">✏️ Modifier le profil</button>
        </div>
      </div>

      <div class="profil-stats">
        <div class="ps-card"><div class="ps-icon">📚</div><div class="ps-val">3</div><div class="ps-lbl">Formations actives</div></div>
        <div class="ps-card"><div class="ps-icon">🏆</div><div class="ps-val">1</div><div class="ps-lbl">Attestations</div></div>
        <div class="ps-card"><div class="ps-icon">🔥</div><div class="ps-val">7</div><div class="ps-lbl">Jours streak</div></div>
        <div class="ps-card"><div class="ps-icon">📝</div><div class="ps-val">74%</div><div class="ps-lbl">Score moyen quiz</div></div>
      </div>

      <div class="g2">
        <div class="card">
          <div class="card-hdr"><h3>👤 Informations personnelles</h3><button class="btn btn-ghost btn-sm">Modifier</button></div>
          <div class="card-body" style="display:flex;flex-direction:column;gap:.7rem">
            ${[['✉️','Email','amina.kamga@gmail.com'],['📱','Téléphone','+237 677 123 456'],['📅','Membre depuis','Janvier 2025'],['📍','Localisation','Yaoundé, Cameroun'],['🎯','Objectif','Devenir experte en marketing']].map(([ic,l,v])=>`
            <div style="display:flex;align-items:center;gap:.75rem;padding:.55rem .75rem;background:var(--gray-50);border-radius:var(--r-sm)">
              <span>${ic}</span>
              <span style="font-size:.75rem;color:var(--gray-400);width:90px;flex-shrink:0">${l}</span>
              <span style="font-size:.84rem;font-weight:600;color:var(--gray-800)">${v}</span>
            </div>`).join('')}
          </div>
        </div>
        <div style="display:flex;flex-direction:column;gap:1rem">
          <div class="card">
            <div class="card-hdr"><h3>📅 Calendrier d'activité</h3></div>
            <div class="card-body">
              <div style="font-size:.78rem;font-weight:700;color:var(--gray-600);text-align:center;margin-bottom:.5rem">Mars 2026</div>
              <div class="cal-grid" id="cal-grid"></div>
            </div>
          </div>
          <div class="card">
            <div class="card-hdr"><h3>🔒 Sécurité</h3></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:.6rem">
              <button class="btn btn-ghost" style="justify-content:center;width:100%">🔑 Changer le mot de passe</button>
              <button class="btn btn-ghost" style="justify-content:center;width:100%">📱 Activer la 2FA</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════ NOTIFICATIONS ══════ -->
    <div class="page" id="page-notifications">
      <div class="ph" style="display:flex;align-items:flex-end;justify-content:space-between">
        <div><h1>Notifications</h1><p>4 non lues</p></div>
        <button class="btn btn-ghost btn-sm">Tout marquer lu</button>
      </div>
      <div class="card"><div id="all-notifs"></div></div>
    </div>

    <!-- ══════ PARAMÈTRES ══════ -->
    <div class="page" id="page-parametres">
      <div class="ph"><h1>Paramètres</h1><p>Gérez vos préférences</p></div>
      <div class="g2">
        <div class="card">
          <div class="card-hdr"><h3>🔔 Notifications</h3></div>
          <div class="card-body" style="display:flex;flex-direction:column;gap:1rem">
            ${[['Devoirs & rappels',true],['Résultats de quiz',true],['Nouveaux messages forum',true],['Newsletters & promotions',false],['Rappels d\'activité',true]].map(([l,on])=>`
            <div style="display:flex;align-items:center;justify-content:space-between">
              <span style="font-size:.85rem;font-weight:600;color:var(--gray-700)">${l}</span>
              <div style="width:36px;height:20px;border-radius:99px;background:${on?'var(--green)':'var(--gray-300)'};position:relative;cursor:pointer;transition:background .2s" onclick="this.style.background=this.style.background.includes('green')?'var(--gray-300)':'var(--green)'">
                <div style="width:16px;height:16px;border-radius:50%;background:#fff;position:absolute;top:2px;left:${on?'18px':'2px'};transition:left .2s;box-shadow:0 1px 3px rgba(0,0,0,.2)"></div>
              </div>
            </div>`).join('')}
          </div>
        </div>
        <div class="card">
          <div class="card-hdr"><h3>🎨 Apparence</h3></div>
          <div class="card-body" style="display:flex;flex-direction:column;gap:1rem">
            <div><label class="inp-label">Langue</label>
              <select class="inp"><option>Français</option><option>English</option></select>
            </div>
            <div><label class="inp-label">Thème</label>
              <div style="display:flex;gap:.6rem">
                <div style="flex:1;padding:.6rem;background:var(--white);border:2px solid var(--blue);border-radius:var(--r-sm);text-align:center;cursor:pointer;font-size:.8rem;font-weight:700;color:var(--blue)">☀️ Clair</div>
                <div style="flex:1;padding:.6rem;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--r-sm);text-align:center;cursor:pointer;font-size:.8rem;font-weight:700;color:var(--gray-500)">🌙 Sombre</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<script>
/* ═══════ NAV ═══════ */
const TITLES={accueil:'Accueil','mes-formations':'Mes Formations',devoirs:'Mes Devoirs',quiz:'Mes Quiz',attestations:'Attestations',catalogue:'Catalogue',mentors:'Mentors',forum:'Forum',profil:'Mon Profil',notifications:'Notifications',parametres:'Paramètres'};
function go(id){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('show'));
  document.querySelectorAll('.sbi').forEach(i=>i.classList.remove('on'));
  const p=document.getElementById('page-'+id);
  if(p)p.classList.add('show');
  document.getElementById('tb-title').textContent=TITLES[id]||id;
  // Match nav item
  document.querySelectorAll('.sbi').forEach(i=>{
    const txt=i.textContent.trim();
    if(TITLES[id]&&txt.startsWith(TITLES[id].split(' ')[0])) i.classList.add('on');
  });
}

/* ═══════ DATA ═══════ */
const formations=[
  {em:'📱',bg:'linear-gradient(135deg,#dbeafe,#ede9fe)',title:'Marketing Digital Complet',formateur:'Paul Tchamba',lecons:10,duree:'20h',prog:78,status:'active'},
  {em:'🎨',bg:'linear-gradient(135deg,#d1fae5,#cffafe)',title:'Infographie avec Canva',formateur:'Fatou Aw',lecons:8,duree:'16h',prog:55,status:'active'},
  {em:'💼',bg:'linear-gradient(135deg,#fef3c7,#ffedd5)',title:'Bureautique Avancée',formateur:'Kevin Brice',lecons:12,duree:'24h',prog:20,status:'active'},
  {em:'🌐',bg:'linear-gradient(135deg,#f3e8ff,#fce7f3)',title:'Dev Web React',formateur:'Luc Martin',lecons:15,duree:'30h',prog:100,status:'done'},
];

const progColors=['linear-gradient(90deg,#2563eb,#818cf8)','linear-gradient(90deg,#16a34a,#34d399)','linear-gradient(90deg,#d97706,#fbbf24)','linear-gradient(90deg,#7c3aed,#a78bfa)'];

/* Home formations */
document.getElementById('home-formations').innerHTML=formations.slice(0,3).map((f,i)=>`
  <div style="background:var(--white);border-radius:var(--r);border:1px solid var(--gray-200);padding:.85rem 1rem;display:flex;align-items:center;gap:.85rem;cursor:pointer;transition:all .18s;box-shadow:var(--sh)" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform=''">
    <div style="width:46px;height:46px;border-radius:var(--r-sm);background:${f.bg};display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0">${f.em}</div>
    <div style="flex:1;min-width:0">
      <div style="font-size:.86rem;font-weight:700;color:var(--gray-800);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${f.title}</div>
      <div style="font-size:.72rem;color:var(--gray-400);margin-top:.1rem">${f.formateur}</div>
      <div style="display:flex;align-items:center;gap:.5rem;margin-top:.4rem">
        <div style="flex:1;height:5px;background:var(--gray-100);border-radius:99px;overflow:hidden"><div style="height:100%;width:${f.prog}%;background:${progColors[i]};border-radius:99px"></div></div>
        <span style="font-size:.7rem;font-weight:700;color:var(--gray-600)">${f.prog}%</span>
      </div>
    </div>
    <button class="btn btn-primary btn-sm" onclick="go('mes-formations')">→</button>
  </div>`).join('');

/* Formations grid */
document.getElementById('formations-grid').innerHTML=formations.slice(0,3).map((f,i)=>`
  <div class="fc">
    <div class="fc-thumb" style="background:${f.bg}">
      <span class="fc-pill active">● Active</span>
      ${f.em}
    </div>
    <div class="fc-body">
      <div class="fc-title">${f.title}</div>
      <div class="fc-meta">Par ${f.formateur} · ${f.lecons} leçons · ${f.duree}</div>
      <div class="prog-label"><span>Progression</span><span>${f.prog}%</span></div>
      <div class="prog-track"><div class="prog-fill" style="width:${f.prog}%;background:${progColors[i]}"></div></div>
    </div>
    <div class="fc-footer">
      <span style="font-size:.73rem;color:var(--gray-400)">Leçon ${Math.ceil(f.lecons*f.prog/100)} / ${f.lecons}</span>
      <button class="btn btn-primary btn-sm">Continuer →</button>
    </div>
  </div>`).join('');

/* Catalogue */
const catalogue=[
  {em:'🤖',bg:'linear-gradient(135deg,#dbeafe,#e0e7ff)',t:'Intelligence Artificielle',f:'Dr. Samuel Eto',p:'65 000 FCFA',n:'4.9',l:'15 leçons',niv:'Avancé'},
  {em:'📸',bg:'linear-gradient(135deg,#fce7f3,#ede9fe)',t:'Photographie Professionnelle',f:'Claire Abena',p:'30 000 FCFA',n:'4.8',l:'10 leçons',niv:'Débutant'},
  {em:'💹',bg:'linear-gradient(135deg,#d1fae5,#fef9c3)',t:'Finance Personnelle',f:'Eric Manga',p:'20 000 FCFA',n:'4.7',l:'8 leçons',niv:'Débutant'},
  {em:'🎬',bg:'linear-gradient(135deg,#fee2e2,#fce7f3)',t:'Montage Vidéo Capcut',f:'Rose Nkengne',p:'25 000 FCFA',n:'4.6',l:'12 leçons',niv:'Intermédiaire'},
  {em:'🔐',bg:'linear-gradient(135deg,#e0e7ff,#ccfbf1)',t:'Cybersécurité Basics',f:'Amos Tchoupo',p:'45 000 FCFA',n:'4.8',l:'14 leçons',niv:'Intermédiaire'},
  {em:'📊',bg:'linear-gradient(135deg,#fef3c7,#ffedd5)',t:'Excel & Power BI',f:'Fatou Aw',p:'35 000 FCFA',n:'4.5',l:'11 leçons',niv:'Tous niveaux'},
];
document.getElementById('catalogue-grid').innerHTML=catalogue.map(c=>`
  <div class="cat-card">
    <div class="cat-thumb" style="background:${c.bg}">${c.em}</div>
    <div class="cat-body">
      <div class="cat-title">${c.t}</div>
      <div class="cat-meta">${c.f} · ${c.l} · ${c.niv}</div>
      <div class="cat-footer">
        <span class="cat-price">${c.p}</span>
        <span class="cat-note">⭐ ${c.n}</span>
      </div>
    </div>
    <div style="padding:.65rem 1rem;border-top:1px solid var(--gray-100);display:flex;gap:.5rem">
      <button class="btn btn-primary btn-sm" style="flex:1;justify-content:center">S'inscrire</button>
      <button class="btn btn-ghost btn-sm">👁</button>
    </div>
  </div>`).join('');

/* Mentors */
const mentors=[
  {av:'PT',c:'#16a34a',n:'Paul Tchamba',sp:'Marketing Digital',f:3,a:47,note:'4.9'},
  {av:'FA',c:'#ea580c',n:'Fatou Aw',sp:'Design & Infographie',f:4,a:62,note:'4.8'},
  {av:'LM',c:'#4f46e5',n:'Luc Martin',sp:'Développement Web',f:5,a:83,note:'4.9'},
  {av:'KB',c:'#7c3aed',n:'Kevin Brice',sp:'Bureautique',f:2,a:18,note:'4.5'},
  {av:'EA',c:'#0d9488',n:'Eric Abeng',sp:'Finance & Gestion',f:3,a:35,note:'4.7'},
  {av:'CN',c:'#db2777',n:'Claire Nkengne',sp:'Photographie',f:2,a:28,note:'4.6'},
];
document.getElementById('mentors-grid').innerHTML=mentors.map(m=>`
  <div class="card" style="cursor:pointer;transition:all .2s" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='var(--sh-md)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
    <div style="height:70px;background:linear-gradient(135deg,${m.c}22,${m.c}44);display:flex;align-items:center;justify-content:center;position:relative">
      <div style="width:56px;height:56px;border-radius:50%;background:${m.c};display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;color:#fff;border:3px solid var(--white);box-shadow:var(--sh-md)">${m.av}</div>
    </div>
    <div style="padding:.9rem;text-align:center">
      <div style="font-size:.9rem;font-weight:800;color:var(--gray-800)">${m.n}</div>
      <div style="font-size:.74rem;color:var(--gray-400);margin-top:.15rem">${m.sp}</div>
      <div style="display:flex;justify-content:center;gap:.75rem;margin:.7rem 0;font-size:.75rem;color:var(--gray-500)">
        <span>📚 ${m.f} formations</span><span>👥 ${m.a} apprenants</span>
      </div>
      <div style="font-size:.82rem;font-weight:700;color:var(--amber)">⭐ ${m.note}</div>
      <button class="btn btn-ghost btn-sm" style="width:100%;justify-content:center;margin-top:.65rem">Voir le profil</button>
    </div>
  </div>`).join('');

/* Devoirs */
const devoirsData=[
  {title:'Leçon 4 – Stratégie de contenu',course:'Marketing Digital',due:'22/03/2026',status:'urgent'},
  {title:'Leçon 2 – Bases du design Canva',course:'Infographie Canva',due:'25/03/2026',status:'todo'},
  {title:'Leçon 1 – Introduction',course:'Marketing Digital',due:'10/03/2026',score:'18/20',status:'corrected'},
  {title:'Leçon 3 – Réseaux sociaux',course:'Marketing Digital',due:'15/03/2026',score:'15/20',status:'corrected'},
];
document.getElementById('devoirs-list').innerHTML=devoirsData.filter(d=>d.status!=='corrected').map(d=>`
  <div class="card" style="padding:1.1rem 1.3rem;display:flex;align-items:center;gap:1rem">
    <div style="width:44px;height:44px;border-radius:var(--r-sm);background:${d.status==='urgent'?'var(--rose-l)':'var(--amber-l)'};display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0">${d.status==='urgent'?'🚨':'📝'}</div>
    <div style="flex:1">
      <div style="font-size:.88rem;font-weight:700;color:var(--gray-800)">${d.title}</div>
      <div style="font-size:.75rem;color:var(--gray-400);margin-top:.15rem">${d.course} · À rendre le ${d.due}</div>
    </div>
    <span style="font-size:.72rem;font-weight:700;padding:.2rem .6rem;border-radius:99px;background:${d.status==='urgent'?'var(--rose-l)':'var(--amber-l)'};color:${d.status==='urgent'?'var(--rose)':'var(--amber)'}">${d.status==='urgent'?'🔴 Urgent':'⏳ À faire'}</span>
    <button class="btn btn-primary btn-sm">Soumettre →</button>
  </div>`).join('');

/* Quiz */
document.getElementById('quiz-list').innerHTML=[
  {t:'Quiz Final',c:'Marketing Digital',s:85,d:'15/03/2026'},
  {t:'Quiz Partie 1',c:'Marketing Digital',s:72,d:'10/03/2026'},
  {t:'Quiz Final',c:'Dev Web React',s:91,d:'01/03/2026'},
  {t:'Quiz Partie 1',c:'Infographie Canva',s:58,d:'25/02/2026'},
  {t:'Quiz Final',c:'Bureautique',s:45,d:'18/02/2026'},
].map(q=>`
  <div class="quiz-result-card">
    <div class="qrc-score" style="background:${q.s>=70?'var(--green-l)':q.s>=50?'var(--amber-l)':'var(--rose-l)'};color:${q.s>=70?'var(--green-d)':q.s>=50?'var(--amber)':'var(--rose)'}">${q.s}%</div>
    <div class="qrc-info">
      <div class="qrc-title">${q.t}</div>
      <div class="qrc-sub">${q.c} · ${q.d}</div>
    </div>
    <span class="qrc-badge ${q.s>=70?'pass':'fail'}">${q.s>=70?'✅ Validé':'❌ Échoué'}</span>
  </div>`).join('');

/* Notifications */
const notifsData=[
  {ic:'📝',bg:'var(--blue-l)',t:'Votre devoir Leçon 3 a été corrigé – Note : 15/20',time:'Il y a 1h',unread:true},
  {ic:'✅',bg:'var(--green-l)',t:'Félicitations ! Vous avez validé le quiz final avec 85%',time:'Il y a 3h',unread:true},
  {ic:'🔥',bg:'var(--orange-l)',t:'7 jours consécutifs ! Continuez comme ça 💪',time:'Hier',unread:true},
  {ic:'📚',bg:'var(--violet-l)',t:'Nouvelle leçon disponible sur Marketing Digital',time:'Hier 14h',unread:true},
  {ic:'💬',bg:'var(--blue-l)',t:'Paul Tchamba a répondu à votre question dans le forum',time:'Il y a 2j',unread:false},
  {ic:'🏆',bg:'var(--amber-l)',t:'Votre attestation Marketing Digital est prête à télécharger',time:'Il y a 3j',unread:false},
];
const nHtml=notifsData.map(n=>`
  <div class="notif-item ${n.unread?'unread':''}">
    <div class="ni-ico" style="background:${n.bg}">${n.ic}</div>
    <div class="ni-body">
      <div class="ni-text">${n.t}</div>
      <div class="ni-time">${n.time}</div>
    </div>
    ${n.unread?'<div style="width:7px;height:7px;border-radius:50%;background:var(--blue);margin-top:5px;flex-shrink:0"></div>':''}
  </div>`).join('');
document.getElementById('all-notifs').innerHTML=nHtml;
document.getElementById('home-notifs').innerHTML=notifsData.slice(0,4).map(n=>`
  <div class="notif-item ${n.unread?'unread':''}">
    <div class="ni-ico" style="background:${n.bg}">${n.ic}</div>
    <div class="ni-body"><div class="ni-text">${n.t}</div><div class="ni-time">${n.time}</div></div>
  </div>`).join('');

/* Forum */
document.getElementById('forum-list').innerHTML=[
  {av:'MN',c:'#7c3aed',n:'Marie Nkomo',t:'Comment créer une campagne Meta Ads efficace ?',cat:'Marketing',rep:5,time:'Il y a 30 min'},
  {av:'JF',c:'#d97706',n:'Jules Fomba',t:'Problème avec l\'exercice Leçon 6 – Canva',cat:'Design',rep:3,time:'Il y a 2h'},
  {av:'SB',c:'#0d9488',n:'Sophie Bello',t:'Les meilleurs outils d\'analyse SEO en 2026',cat:'SEO',rep:12,time:'Hier'},
  {av:'CR',c:'#dc2626',n:'Christian R.',t:'Conseils pour réussir le quiz final',cat:'Conseils',rep:8,time:'Il y a 2j'},
].map(f=>`
  <div class="forum-item">
    <div class="fi-av" style="background:${f.c}">${f.av}</div>
    <div class="fi-body">
      <div class="fi-title">${f.t}</div>
      <div class="fi-sub">${f.n} · ${f.rep} réponses · ${f.time}</div>
      <span class="fi-tag">${f.cat}</span>
    </div>
  </div>`).join('');

/* Calendrier */
const days=['L','M','M','J','V','S','D'];
const activeDays=[3,7,8,10,14,15,16,17,18,19,20,21];
let calHtml=days.map(d=>`<div class="cal-day-lbl">${d}</div>`).join('');
for(let i=1;i<=31;i++){
  const cls=i===22?'today':activeDays.includes(i)?'active':i>22?'other':'';
  calHtml+=`<div class="cal-day ${cls}">${i}</div>`;
}
document.getElementById('cal-grid').innerHTML=calHtml;

/* Tabs */
document.querySelectorAll('.tabs').forEach(t=>{
  t.querySelectorAll('.tab').forEach(tab=>{
    tab.addEventListener('click',()=>{t.querySelectorAll('.tab').forEach(x=>x.classList.remove('on'));tab.classList.add('on')});
  });
});
</script>
</body>
</html>
