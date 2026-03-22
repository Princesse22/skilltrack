<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Suivi de Formation</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Crimson+Pro:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════
   VARIABLES & RESET
══════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#1a56db; --blue-d:#1039a0; --blue-l:#e8f1ff;
  --green:#16a34a; --green-l:#dcfce7;
  --orange:#ea580c; --orange-l:#fff7ed;
  --red:#dc2626; --red-l:#fee2e2;
  --gray-50:#f8fafc; --gray-100:#f1f5f9; --gray-200:#e2e8f0;
  --gray-400:#94a3b8; --gray-600:#64748b; --gray-700:#475569;
  --gray-800:#1e293b; --gray-900:#0f172a;
  --white:#fff;
  --sidebar-w:300px;
  --radius:12px; --radius-sm:8px;
  --shadow-sm:0 1px 3px rgba(0,0,0,.08); --shadow:0 4px 16px rgba(0,0,0,.1);
  --font:'Outfit',sans-serif;
}

html{scroll-behavior:smooth}
body{font-family:var(--font);background:var(--gray-50);color:var(--gray-800);display:flex;flex-direction:column;min-height:100vh;overflow-x:hidden}

/* ══ TOPBAR ══ */
.topbar{
  position:fixed;top:0;left:0;right:0;z-index:200;
  background:var(--white);border-bottom:1px solid var(--gray-200);
  height:60px;display:flex;align-items:center;padding:0 1.5rem;gap:1.5rem;
  box-shadow:var(--shadow-sm);
}
.topbar .logo{font-weight:800;font-size:1.2rem;color:var(--blue);letter-spacing:-.5px}
.topbar .logo span{color:var(--gray-800)}
.topbar .formation-title{font-size:.9rem;font-weight:500;color:var(--gray-600);border-left:2px solid var(--gray-200);padding-left:1rem}
.topbar .progress-global{margin-left:auto;display:flex;align-items:center;gap:.75rem}
.topbar .prog-label{font-size:.8rem;color:var(--gray-600);font-weight:500}
.prog-bar-wrap{width:160px;height:8px;background:var(--gray-200);border-radius:99px;overflow:hidden}
.prog-bar-fill{height:100%;background:linear-gradient(90deg,var(--blue),#4f8ef7);border-radius:99px;transition:width .5s ease}
.prog-pct{font-size:.8rem;font-weight:700;color:var(--blue)}

/* ══ LAYOUT ══ */
.layout{display:flex;margin-top:60px;min-height:calc(100vh - 60px)}

/* ══ SIDEBAR ══ */
.sidebar{
  width:var(--sidebar-w);flex-shrink:0;
  background:var(--gray-900);color:var(--white);
  position:fixed;top:60px;left:0;bottom:0;
  overflow-y:auto;padding:1.5rem 0;
  scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;
}
.sidebar::-webkit-scrollbar{width:4px}
.sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:99px}

.sidebar-section-title{
  font-size:.65rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  color:var(--gray-400);padding:.75rem 1.5rem .4rem;
}

/* Étape sidebar */
.step-item{
  display:flex;align-items:center;gap:.75rem;
  padding:.6rem 1.5rem;cursor:pointer;
  transition:background .2s;position:relative;
}
.step-item:hover{background:rgba(255,255,255,.05)}
.step-item.active{background:rgba(26,86,219,.25)}
.step-item.active::before{
  content:'';position:absolute;left:0;top:0;bottom:0;
  width:3px;background:var(--blue);border-radius:0 3px 3px 0;
}

.step-dot{
  width:28px;height:28px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-size:.75rem;font-weight:700;
  border:2px solid rgba(255,255,255,.15);color:var(--gray-400);
  transition:all .3s;
}
.step-item.done .step-dot{background:var(--green);border-color:var(--green);color:#fff}
.step-item.active .step-dot{background:var(--blue);border-color:var(--blue);color:#fff}
.step-item.quiz-step .step-dot{border-color:rgba(234,88,12,.5);color:var(--orange)}
.step-item.quiz-step.done .step-dot{background:var(--green);border-color:var(--green);color:#fff}
.step-item.quiz-step.active .step-dot{background:var(--orange);border-color:var(--orange);color:#fff}

.step-info{flex:1;min-width:0}
.step-name{font-size:.82rem;font-weight:500;color:rgba(255,255,255,.7);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.step-item.active .step-name{color:#fff;font-weight:600}
.step-item.done .step-name{color:rgba(255,255,255,.5)}
.step-type-badge{font-size:.63rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;margin-top:1px}
.step-type-badge.lecon{color:var(--blue)}
.step-type-badge.quiz{color:var(--orange)}
.step-type-badge.final{color:#a855f7}

.step-check{font-size:.85rem;opacity:.7}

/* Divider dans sidebar */
.sidebar-divider{
  margin:.5rem 1.5rem;height:1px;
  background:rgba(255,255,255,.06);
}

/* ══ MAIN CONTENT ══ */
.main{margin-left:var(--sidebar-w);flex:1;padding:2rem 2.5rem;max-width:900px}

/* ══ PROGRESS STEPPER ══ */
.stepper-wrap{
  background:var(--white);border-radius:var(--radius);
  padding:1.2rem 1.5rem;margin-bottom:2rem;
  box-shadow:var(--shadow-sm);overflow-x:auto;
}
.stepper{display:flex;align-items:center;gap:0;min-width:600px}
.stepper-step{
  display:flex;flex-direction:column;align-items:center;
  flex:1;position:relative;
}
.stepper-step:not(:last-child)::after{
  content:'';position:absolute;top:14px;left:50%;right:-50%;
  height:2px;background:var(--gray-200);z-index:0;
}
.stepper-step.done:not(:last-child)::after{background:var(--green)}
.stepper-step.active:not(:last-child)::after{background:linear-gradient(90deg,var(--blue),var(--gray-200))}

.s-dot{
  width:28px;height:28px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:.7rem;font-weight:700;z-index:1;
  border:2px solid var(--gray-200);background:var(--white);color:var(--gray-400);
  transition:all .3s;
}
.stepper-step.done .s-dot{background:var(--green);border-color:var(--green);color:#fff}
.stepper-step.active .s-dot{background:var(--blue);border-color:var(--blue);color:#fff;box-shadow:0 0 0 4px rgba(26,86,219,.2)}
.stepper-step.quiz .s-dot{border-color:var(--orange);color:var(--orange)}
.stepper-step.quiz.done .s-dot{background:var(--green);border-color:var(--green);color:#fff}
.stepper-step.quiz.active .s-dot{background:var(--orange);border-color:var(--orange);color:#fff;box-shadow:0 0 0 4px rgba(234,88,12,.2)}
.stepper-step.final .s-dot{border-color:#a855f7;color:#a855f7}
.stepper-step.final.active .s-dot{background:#a855f7;border-color:#a855f7;color:#fff;box-shadow:0 0 0 4px rgba(168,85,247,.2)}

.s-label{font-size:.6rem;font-weight:600;margin-top:.35rem;text-align:center;color:var(--gray-400);white-space:nowrap}
.stepper-step.active .s-label{color:var(--blue);font-weight:700}
.stepper-step.quiz.active .s-label{color:var(--orange)}

/* ══ CONTENT CARD ══ */
.content-card{
  background:var(--white);border-radius:var(--radius);
  box-shadow:var(--shadow-sm);overflow:hidden;margin-bottom:1.5rem;
  animation:fadeUp .35s ease;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}

.content-card-header{
  padding:1rem 1.5rem;
  border-bottom:1px solid var(--gray-100);
  display:flex;align-items:center;gap:.75rem;
}
.content-card-header .icon{
  width:36px;height:36px;border-radius:var(--radius-sm);
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;flex-shrink:0;
}
.icon.blue{background:var(--blue-l)}
.icon.orange{background:var(--orange-l)}
.icon.green{background:var(--green-l)}
.icon.purple{background:#f3e8ff}

.content-card-header h3{font-size:1rem;font-weight:700;color:var(--gray-800)}
.content-card-header p{font-size:.8rem;color:var(--gray-600);margin-top:1px}
.content-card-body{padding:1.5rem}

/* ══ COURS ÉCRIT ══ */
.cours-text{
  font-family:'Crimson Pro',serif;font-size:1.05rem;line-height:1.85;
  color:var(--gray-700);
}
.cours-text h4{font-size:1.1rem;font-weight:600;color:var(--gray-800);margin:1.2rem 0 .5rem;font-family:var(--font)}
.cours-text p{margin-bottom:.75rem}
.cours-text ul{padding-left:1.4rem;margin-bottom:.75rem}
.cours-text ul li{margin-bottom:.3rem}
.definition-box{
  background:var(--blue-l);border-left:3px solid var(--blue);
  border-radius:0 var(--radius-sm) var(--radius-sm) 0;
  padding:.75rem 1rem;margin:.75rem 0;font-size:.9rem;
}

/* ══ TUTORIELS ══ */
.tuto-list{display:flex;flex-direction:column;gap:.75rem}
.tuto-item{
  display:flex;align-items:center;gap:.85rem;
  padding:.85rem 1rem;background:var(--gray-50);
  border-radius:var(--radius-sm);border:1px solid var(--gray-200);
  cursor:pointer;transition:all .2s;text-decoration:none;color:inherit;
}
.tuto-item:hover{background:var(--blue-l);border-color:var(--blue)}
.tuto-thumb{
  width:52px;height:36px;background:var(--gray-200);border-radius:6px;
  display:flex;align-items:center;justify-content:center;font-size:1.2rem;
  flex-shrink:0;overflow:hidden;
}
.tuto-info{flex:1}
.tuto-info strong{font-size:.88rem;font-weight:600;display:block}
.tuto-info span{font-size:.75rem;color:var(--gray-600)}
.tuto-badge{
  font-size:.7rem;font-weight:600;padding:.2rem .5rem;
  border-radius:99px;background:var(--blue-l);color:var(--blue);
}

/* ══ DEVOIR ══ */
.devoir-enonce{
  background:var(--gray-50);border-radius:var(--radius-sm);
  border:1px solid var(--gray-200);padding:1rem 1.2rem;
  margin-bottom:1.25rem;font-size:.9rem;line-height:1.7;color:var(--gray-700);
}
.devoir-enonce strong{color:var(--gray-800);font-weight:600}

.upload-zone{
  border:2px dashed var(--gray-200);border-radius:var(--radius-sm);
  padding:1.2rem;text-align:center;cursor:pointer;
  transition:all .2s;margin-bottom:1rem;
  background:var(--gray-50);
}
.upload-zone:hover{border-color:var(--blue);background:var(--blue-l)}
.upload-zone.has-file{border-color:var(--green);background:var(--green-l)}
.upload-zone input{display:none}
.upload-zone p{font-size:.85rem;color:var(--gray-600);margin-top:.35rem}
.upload-zone .upload-icon{font-size:1.6rem}
.upload-zone .file-name{font-size:.85rem;color:var(--green);font-weight:600}

.devoir-textarea{
  width:100%;min-height:100px;padding:.75rem 1rem;
  border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);
  font-family:var(--font);font-size:.875rem;color:var(--gray-800);
  resize:vertical;outline:none;transition:border-color .2s;
  background:var(--gray-50);
}
.devoir-textarea:focus{border-color:var(--blue);background:var(--white)}

/* Checkbox "toutes questions répondues" */
.all-questions-check{
  display:flex;align-items:flex-start;gap:.65rem;
  padding:.75rem 1rem;background:var(--orange-l);
  border-radius:var(--radius-sm);border:1px solid rgba(234,88,12,.2);
  margin-bottom:1rem;cursor:pointer;
}
.all-questions-check input[type="checkbox"]{
  width:16px;height:16px;min-width:16px;accent-color:var(--orange);margin-top:2px;cursor:pointer;
}
.all-questions-check label{font-size:.83rem;color:var(--gray-700);cursor:pointer;line-height:1.5}
.check-error-msg{
  display:none;font-size:.78rem;color:var(--red);
  background:var(--red-l);padding:.5rem .75rem;border-radius:var(--radius-sm);
  margin-top:.4rem;
}

/* ══ BOUTONS ══ */
.btn-row{display:flex;gap:.75rem;flex-wrap:wrap;margin-top:1rem}
.btn{
  padding:.6rem 1.2rem;border-radius:var(--radius-sm);font-family:var(--font);
  font-size:.875rem;font-weight:600;border:none;cursor:pointer;
  display:inline-flex;align-items:center;gap:.4rem;transition:all .2s;
}
.btn-primary{background:var(--blue);color:#fff}
.btn-primary:hover:not(:disabled){background:var(--blue-d);transform:translateY(-1px)}
.btn-success{background:var(--green);color:#fff}
.btn-success:hover:not(:disabled){background:#15803d}
.btn-outline{background:transparent;color:var(--blue);border:1.5px solid var(--blue)}
.btn-outline:hover:not(:disabled){background:var(--blue-l)}
.btn-ghost{background:var(--gray-100);color:var(--gray-600);border:1.5px solid var(--gray-200)}
.btn:disabled{opacity:.4;cursor:not-allowed;transform:none !important}
a.btn.disabled{opacity:.4;cursor:not-allowed;pointer-events:none;transform:none}
a.btn.disabled[onclick]{pointer-events:all}
.btn-continue{background:linear-gradient(135deg,var(--blue),#4f8ef7);color:#fff;margin-left:auto}
.btn-continue:hover:not(:disabled){box-shadow:0 4px 12px rgba(26,86,219,.35);transform:translateY(-1px)}

/* ══ STATUS BADGE ══ */
.status-badge{
  display:inline-flex;align-items:center;gap:.35rem;
  padding:.25rem .7rem;border-radius:99px;font-size:.75rem;font-weight:600;
}
.status-badge.pending{background:var(--gray-100);color:var(--gray-600)}
.status-badge.submitted{background:var(--blue-l);color:var(--blue)}
.status-badge.done{background:var(--green-l);color:var(--green)}

/* ══ QUIZ ══ */
.quiz-intro{
  background:linear-gradient(135deg,#fff7ed,#ffedd5);
  border:1px solid rgba(234,88,12,.2);border-radius:var(--radius);
  padding:1.25rem 1.5rem;margin-bottom:1.5rem;
  display:flex;align-items:center;gap:1rem;
}
.quiz-intro .qi-icon{font-size:2rem}
.quiz-intro h3{font-size:1rem;font-weight:700;color:var(--gray-800)}
.quiz-intro p{font-size:.83rem;color:var(--gray-600);margin-top:.2rem}

.question-block{
  background:var(--white);border-radius:var(--radius-sm);
  border:1px solid var(--gray-200);margin-bottom:1rem;
  overflow:hidden;transition:border-color .2s;
}
.question-block.answered{border-color:var(--green)}
.question-header{
  padding:.85rem 1.1rem;display:flex;align-items:flex-start;gap:.6rem;
}
.q-num{
  width:24px;height:24px;border-radius:50%;background:var(--orange-l);
  color:var(--orange);font-size:.72rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;
}
.question-block.answered .q-num{background:var(--green-l);color:var(--green)}
.q-text{font-size:.9rem;font-weight:500;color:var(--gray-800);line-height:1.5}
.q-options{padding:0 1.1rem 1rem;display:flex;flex-direction:column;gap:.4rem}
.q-option{
  display:flex;align-items:center;gap:.65rem;
  padding:.5rem .75rem;border-radius:var(--radius-sm);
  border:1.5px solid var(--gray-200);cursor:pointer;
  transition:all .2s;font-size:.86rem;
}
.q-option:hover{background:var(--blue-l);border-color:var(--blue)}
.q-option input{accent-color:var(--blue)}
.q-option.selected{background:var(--blue-l);border-color:var(--blue);font-weight:500}

.quiz-progress-bar{
  margin-bottom:1.5rem;
}
.qpb-label{font-size:.78rem;color:var(--gray-600);margin-bottom:.35rem;font-weight:500}
.qpb-track{height:6px;background:var(--gray-200);border-radius:99px;overflow:hidden}
.qpb-fill{height:100%;background:linear-gradient(90deg,var(--orange),#fb923c);border-radius:99px;transition:width .4s ease}

.quiz-submit-row{
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;
  padding-top:1rem;border-top:1px solid var(--gray-200);
}
.quiz-answered-count{font-size:.85rem;color:var(--gray-600);font-weight:500}

/* ══ RESULT PANEL ══ */
.result-panel{
  display:none;background:var(--green-l);border:1px solid rgba(22,163,74,.2);
  border-radius:var(--radius);padding:1.5rem;text-align:center;
  animation:fadeUp .35s ease;
}
.result-panel.show{display:block}
.result-panel .score{font-size:2.5rem;font-weight:800;color:var(--green)}
.result-panel p{font-size:.9rem;color:var(--gray-700);margin-top:.4rem}

/* ══ LESSON NAV ══ */
.lesson-nav-bar{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:1.5rem;
}
.lesson-nav-bar h1{font-size:1.4rem;font-weight:700;color:var(--gray-900);line-height:1.3}
.lesson-nav-bar .lesson-meta{font-size:.82rem;color:var(--gray-500);margin-top:.2rem;display:flex;align-items:center;gap:.5rem}

/* ══ NOTIFICATION TOAST ══ */
.toast{
  position:fixed;bottom:2rem;right:2rem;z-index:999;
  background:var(--gray-900);color:#fff;
  padding:.75rem 1.25rem;border-radius:var(--radius-sm);
  font-size:.875rem;font-weight:500;
  transform:translateY(100px);opacity:0;transition:all .3s;
  display:flex;align-items:center;gap:.5rem;max-width:320px;
  box-shadow:0 8px 24px rgba(0,0,0,.2);
}
.toast.show{transform:translateY(0);opacity:1}
.toast.success{background:var(--green)}
.toast.warning{background:var(--orange)}

/* ══ RESPONSIVE ══ */
@media(max-width:768px){
  .sidebar{transform:translateX(-100%);transition:transform .3s;z-index:150}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0;padding:1.2rem}
  .stepper-wrap{display:none}
}
</style>
</head>
<body>

<!-- ══ TOPBAR ══ -->
<div class="topbar">
  <div class="logo">Skill<span>Tract</span></div>
  <div class="formation-title">📚 Marketing Digital – Module 1</div>
  <div class="progress-global">
    <span class="prog-label">Progression</span>
    <div class="prog-bar-wrap"><div class="prog-bar-fill" id="globalBar" style="width:0%"></div></div>
    <span class="prog-pct" id="globalPct">0%</span>
  </div>
</div>

<!-- ══ SIDEBAR ══ -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-section-title">Partie 1</div>

  <div class="step-item active" data-step="0" onclick="goTo(0)">
    <div class="step-dot">1</div>
    <div class="step-info">
      <div class="step-name">Introduction au Marketing</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="1" onclick="goTo(1)">
    <div class="step-dot">2</div>
    <div class="step-info">
      <div class="step-name">Le marché cible</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="2" onclick="goTo(2)">
    <div class="step-dot">3</div>
    <div class="step-info">
      <div class="step-name">Les réseaux sociaux</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="3" onclick="goTo(3)">
    <div class="step-dot">4</div>
    <div class="step-info">
      <div class="step-name">Stratégie de contenu</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="4" onclick="goTo(4)">
    <div class="step-dot">5</div>
    <div class="step-info">
      <div class="step-name">SEO & Référencement</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>

  <div class="sidebar-divider"></div>
  <div class="step-item quiz-step" data-step="5" onclick="goTo(5)">
    <div class="step-dot">Q1</div>
    <div class="step-info">
      <div class="step-name">Quiz – Partie 1</div>
      <div class="step-type-badge quiz">Quiz</div>
    </div>
    <span class="step-check"></span>
  </div>

  <div class="sidebar-divider"></div>
  <div class="sidebar-section-title">Partie 2</div>

  <div class="step-item" data-step="6" onclick="goTo(6)">
    <div class="step-dot">6</div>
    <div class="step-info">
      <div class="step-name">Email Marketing</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="7" onclick="goTo(7)">
    <div class="step-dot">7</div>
    <div class="step-info">
      <div class="step-name">Publicité en ligne</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="8" onclick="goTo(8)">
    <div class="step-dot">8</div>
    <div class="step-info">
      <div class="step-name">Analytics & KPIs</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="9" onclick="goTo(9)">
    <div class="step-dot">9</div>
    <div class="step-info">
      <div class="step-name">Gestion de campagnes</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>
  <div class="step-item" data-step="10" onclick="goTo(10)">
    <div class="step-dot">10</div>
    <div class="step-info">
      <div class="step-name">Fidélisation client</div>
      <div class="step-type-badge lecon">Leçon</div>
    </div>
    <span class="step-check"></span>
  </div>

  <div class="sidebar-divider"></div>
  <div class="step-item quiz-step" data-step="11" onclick="goTo(11)">
    <div class="step-dot">🏆</div>
    <div class="step-info">
      <div class="step-name">Quiz Final</div>
      <div class="step-type-badge final">Quiz Final</div>
    </div>
    <span class="step-check"></span>
  </div>
</div>

<!-- ══ MAIN CONTENT ══ -->
<div class="layout">
<main class="main">

  <!-- Stepper visuel -->
  <div class="stepper-wrap">
    <div class="stepper" id="stepper"></div>
  </div>

  <!-- Zone de contenu dynamique -->
  <div id="contentArea"></div>

</main>
</div>

<!-- Toast notification -->
<div class="toast" id="toast"></div>

<script>
/* ═══════════════════════════════════════════
   DONNÉES
═══════════════════════════════════════════ */
const STEPS = [
  {type:'lecon', num:1, title:'Introduction au Marketing Digital'},
  {type:'lecon', num:2, title:'Le Marché Cible'},
  {type:'lecon', num:3, title:'Les Réseaux Sociaux'},
  {type:'lecon', num:4, title:'Stratégie de Contenu'},
  {type:'lecon', num:5, title:'SEO & Référencement'},
  {type:'quiz',  num:1, title:'Quiz – Partie 1 (Leçons 1 à 5)'},
  {type:'lecon', num:6, title:'Email Marketing'},
  {type:'lecon', num:7, title:'Publicité en Ligne (Ads)'},
  {type:'lecon', num:8, title:'Analytics & KPIs'},
  {type:'lecon', num:9, title:'Gestion de Campagnes'},
  {type:'lecon', num:10, title:'Fidélisation Client'},
  {type:'quiz',  num:2, title:'Quiz Final', isFinal:true},
];

const TOTAL = STEPS.length;
const state = {
  current: 0,
  done: new Array(TOTAL).fill(false),
  devoirSubmitted: new Array(TOTAL).fill(false),
  uploadedFile: new Array(TOTAL).fill(null),
  quizAnswers: { 5: {}, 11: {} },
  quizSubmitted: { 5: false, 11: false },
};

const QUIZ_QUESTIONS = [
  { q: "Quelle est la principale différence entre marketing digital et traditionnel ?", opts:["Le coût uniquement","La mesurabilité et le ciblage précis","La créativité du message","La taille de l'audience"] },
  { q: "Qu'est-ce qu'un persona marketing ?", opts:["Un concurrent fictif","Un profil type du client idéal","Un outil de création graphique","Un type de publicité"] },
  { q: "Quel réseau social est le plus adapté au B2B ?", opts:["TikTok","Instagram","LinkedIn","Snapchat"] },
  { q: "Le SEO signifie :", opts:["Social Engagement Online","Search Engine Optimization","Sales & E-commerce Operations","Secure Email Output"] },
  { q: "Un contenu viral est un contenu qui :", opts:["Coûte très cher à produire","Se propage massivement par le partage","Est uniquement textuel","Nécessite une publicité payante"] },
  { q: "Le taux de clics (CTR) mesure :", opts:["Le nombre de vues d'une page","Le ratio clics/impressions","Le temps passé sur un site","Le nombre d'abonnés"] },
  { q: "Qu'est-ce qu'un CTA ?", opts:["Call To Action – bouton invitant l'utilisateur à agir","Coût Total par Abonné","Contenu Textuel Automatisé","Campagne de Test A/B"] },
  { q: "L'emailing est efficace car :", opts:["Il touche uniquement les jeunes","Il a un ROI parmi les plus élevés du digital","Il est gratuit à 100%","Il remplace les réseaux sociaux"] },
  { q: "Un KPI est :", opts:["Un type de réseau social","Un indicateur clé de performance","Un format d'image","Un outil de design"] },
  { q: "La fidélisation client coûte-t-elle moins cher que l'acquisition ?", opts:["Non, c'est équivalent","Oui, généralement 5 à 7 fois moins","Non, c'est toujours plus cher","Cela dépend uniquement du secteur"] },
];

/* ═══════════════════════════════════════════
   STEPPER VISUEL
═══════════════════════════════════════════ */
function buildStepper(){
  const st = document.getElementById('stepper');
  st.innerHTML = STEPS.map((s,i)=>{
    let cls = '';
    if(s.type==='quiz') cls = s.isFinal ? 'final' : 'quiz';
    if(state.done[i]) cls += ' done';
    if(state.current===i) cls += ' active';
    const label = s.type==='lecon' ? `L${s.num}` : s.isFinal ? '🏆' : `Q${s.num}`;
    return `<div class="stepper-step ${cls}">
      <div class="s-dot">${state.done[i]?'✓':label}</div>
      <div class="s-label">${s.type==='lecon'?'L'+s.num:s.isFinal?'Final':'Quiz'}</div>
    </div>`;
  }).join('');
}

/* ═══════════════════════════════════════════
   SIDEBAR SYNC
═══════════════════════════════════════════ */
function syncSidebar(){
  document.querySelectorAll('.step-item').forEach((el,i)=>{
    el.classList.remove('active','done');
    el.querySelector('.step-check').textContent = '';
    if(state.done[i]){ el.classList.add('done'); el.querySelector('.step-check').textContent='✅'; }
    if(state.current===i) el.classList.add('active');
  });
}

/* ═══════════════════════════════════════════
   BARRE GLOBALE
═══════════════════════════════════════════ */
function updateGlobal(){
  const doneCount = state.done.filter(Boolean).length;
  const pct = Math.round(doneCount/TOTAL*100);
  document.getElementById('globalBar').style.width = pct+'%';
  document.getElementById('globalPct').textContent = pct+'%';
}

/* ═══════════════════════════════════════════
   TOAST
═══════════════════════════════════════════ */
function showToast(msg, type='success'){
  const t = document.getElementById('toast');
  t.className = 'toast '+type;
  t.innerHTML = (type==='success'?'✅':type==='warning'?'⚠️':'ℹ️')+' '+msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),3200);
}

/* ═══════════════════════════════════════════
   RENDU LEÇON
═══════════════════════════════════════════ */
function renderLecon(idx){
  const s = STEPS[idx];
  const submitted = state.devoirSubmitted[idx];
  return `
  <div class="lesson-nav-bar">
    <div>
      <h1>Leçon ${s.num} – ${s.title}</h1>
      <div class="lesson-meta">
        <span>📖 Leçon</span> · <span>~20 min</span>
        · <span class="status-badge ${submitted?'done':'pending'}">${submitted?'✅ Devoir soumis':'⏳ En cours'}</span>
      </div>
    </div>
  </div>

  <!-- COURS ÉCRIT -->
  <div class="content-card">
    <div class="content-card-header">
      <div class="icon blue">📖</div>
      <div><h3>Cours</h3><p>Lisez attentivement le contenu suivant</p></div>
    </div>
    <div class="content-card-body">
      <div class="cours-text">
        <h4>Définition & Concepts clés</h4>
        <p>Le <strong>marketing digital</strong> désigne l'ensemble des techniques et stratégies marketing utilisant les canaux numériques (internet, réseaux sociaux, email, moteurs de recherche) pour atteindre une audience cible et promouvoir des produits ou services.</p>
        <div class="definition-box">💡 <strong>Définition :</strong> Le marketing digital permet de mesurer précisément l'impact de chaque action grâce aux données collectées en temps réel.</div>
        <h4>Les piliers fondamentaux</h4>
        <p>Toute stratégie de marketing digital repose sur quatre piliers essentiels :</p>
        <ul>
          <li><strong>La visibilité</strong> – Être trouvable là où se trouve votre audience</li>
          <li><strong>L'engagement</strong> – Créer une relation durable avec vos prospects</li>
          <li><strong>La conversion</strong> – Transformer les visiteurs en clients</li>
          <li><strong>La fidélisation</strong> – Maintenir et développer la relation client</li>
        </ul>
        <p>Contrairement au marketing traditionnel, le marketing digital offre une capacité de ciblage et de personnalisation sans précédent, permettant d'atteindre la bonne personne, au bon moment, avec le bon message.</p>
      </div>
    </div>
  </div>

  <!-- TUTORIELS -->
  <div class="content-card">
    <div class="content-card-header">
      <div class="icon orange">🎥</div>
      <div><h3>Tutoriels</h3><p>Supports vidéo et ressources complémentaires</p></div>
    </div>
    <div class="content-card-body">
      <div class="tuto-list">
        <div class="tuto-item">
          <div class="tuto-thumb">▶️</div>
          <div class="tuto-info">
            <strong>Vidéo 1 – Introduction au Marketing Digital</strong>
            <span>Durée : 12 min · Niveau débutant</span>
          </div>
          <span class="tuto-badge">Vidéo</span>
        </div>
        <div class="tuto-item">
          <div class="tuto-thumb">📄</div>
          <div class="tuto-info">
            <strong>Support PDF – Fiche récapitulative</strong>
            <span>4 pages · Téléchargeable</span>
          </div>
          <span class="tuto-badge">PDF</span>
        </div>
        <div class="tuto-item">
          <div class="tuto-thumb">🔗</div>
          <div class="tuto-info">
            <strong>Ressource externe – Guide complet Google</strong>
            <span>Article · Lecture 8 min</span>
          </div>
          <span class="tuto-badge">Lien</span>
        </div>
      </div>
    </div>
  </div>

  <!-- DEVOIR -->
  <div class="content-card">
    <div class="content-card-header">
      <div class="icon purple">✏️</div>
      <div><h3>Devoir Pratique</h3><p>À soumettre avant de passer à la leçon suivante</p></div>
    </div>
    <div class="content-card-body">
      <div class="devoir-enonce">
        <strong>📋 Énoncé du devoir :</strong><br><br>
        Identifiez <strong>3 entreprises camerounaises</strong> qui utilisent le marketing digital et analysez leur stratégie. Pour chaque entreprise, précisez :<br>
        · Les canaux numériques utilisés (réseaux sociaux, site web, email…)<br>
        · Le type de contenu publié<br>
        · Ce qui, selon vous, fonctionne bien ou pourrait être amélioré<br><br>
        <em>Vous pouvez rédiger votre réponse dans la zone de texte ci-dessous et/ou joindre un fichier (Word, PDF).</em>
      </div>

      <textarea class="devoir-textarea" id="devoirText_${idx}" placeholder="Rédigez votre réponse ici…" ${submitted?'disabled':''}>${submitted?'[Devoir déjà soumis]':''}</textarea>

      <div class="upload-zone ${state.uploadedFile[idx]?'has-file':''}" onclick="document.getElementById('fileInput_${idx}').click()">
        <input type="file" id="fileInput_${idx}" accept=".pdf,.doc,.docx,.txt" onchange="handleFile(${idx}, this)">
        <div class="upload-icon">${state.uploadedFile[idx]?'📎':'📁'}</div>
        ${state.uploadedFile[idx]
          ? `<div class="file-name">✅ ${state.uploadedFile[idx]}</div>`
          : `<p>Cliquez pour joindre un fichier (PDF, Word)</p>`}
      </div>

      <div class="btn-row">
        ${idx > 0 ? `<button class="btn btn-ghost" onclick="goTo(${idx-1})">← Précédent</button>` : ''}
        <button class="btn btn-primary" id="btnSoumettre_${idx}"
          ${submitted?'disabled':''} onclick="soumettrDevoir(${idx})">
          ${submitted?'✅ Devoir soumis':'📤 Soumettre mon travail'}
        </button>
        <button class="btn btn-outline" id="btnCorrection_${idx}"
          ${!submitted?'disabled':''} onclick="voirCorrection(${idx})">
          👁 Voir la correction
        </button>
        <button class="btn btn-continue" id="btnContinue_${idx}"
          ${!submitted?'disabled':''} onclick="continuer(${idx})">
          Continuer →
        </button>
      </div>
    </div>
  </div>`;
}

/* ═══════════════════════════════════════════
   RENDU QUIZ
═══════════════════════════════════════════ */
function renderQuiz(idx){
  const s = STEPS[idx];
  const isFinal = s.isFinal;
  const qAnswers = state.quizAnswers[idx] || {};
  const answered = Object.keys(qAnswers).length;
  const submitted = state.quizSubmitted[idx];
  const pct = Math.round(answered/10*100);

  const questionsHtml = QUIZ_QUESTIONS.map((q,qi)=>`
    <div class="question-block ${qAnswers[qi]!==undefined?'answered':''}" id="qblock_${idx}_${qi}">
      <div class="question-header">
        <div class="q-num">${qi+1}</div>
        <div class="q-text">${q.q}</div>
      </div>
      <div class="q-options">
        ${q.opts.map((opt,oi)=>`
          <label class="q-option ${qAnswers[qi]===oi?'selected':''}" id="opt_${idx}_${qi}_${oi}">
            <input type="radio" name="q_${idx}_${qi}" value="${oi}"
              ${qAnswers[qi]===oi?'checked':''} ${submitted?'disabled':''}
              onchange="selectAnswer(${idx},${qi},${oi})">
            ${opt}
          </label>
        `).join('')}
      </div>
    </div>
  `).join('');

  return `
  <div class="lesson-nav-bar">
    <div>
      <h1>${isFinal?'🏆':''} ${s.title}</h1>
      <div class="lesson-meta">
        <span>${isFinal?'🏆 Quiz Final':'📝 Quiz'}</span> · <span>10 questions</span>
        · <span>Score minimum requis : 70%</span>
      </div>
    </div>
  </div>

  <div class="quiz-intro">
    <div class="qi-icon">${isFinal?'🏆':'📝'}</div>
    <div>
      <h3>${isFinal?'Quiz Final de validation':'Quiz d\'évaluation – Partie '+(idx===5?'1':'2')}</h3>
      <p>Répondez aux 10 questions ci-dessous. Vous devez obtenir au moins <strong>70%</strong> pour valider ce quiz.</p>
    </div>
  </div>

  <div class="content-card">
    <div class="content-card-header">
      <div class="icon orange">📝</div>
      <div><h3>Questions</h3><p id="answeredLabel_${idx}">${answered}/10 questions répondues</p></div>
    </div>
    <div class="content-card-body">
      <div class="quiz-progress-bar">
        <div class="qpb-label" id="qpbLabel_${idx}">Progression : ${answered}/10</div>
        <div class="qpb-track"><div class="qpb-fill" id="qpbFill_${idx}" style="width:${pct}%"></div></div>
      </div>

      ${questionsHtml}

      <!-- Checkbox toutes questions répondues -->
      <div class="all-questions-check" id="allCheck_${idx}" style="margin-top:1rem">
        <input type="checkbox" id="allQuestionsOk_${idx}" onchange="handleQuizCheck(${idx}, this)">
        <label for="allQuestionsOk_${idx}">
          J'ai répondu à toutes les questions et je suis prêt(e) à soumettre
        </label>
      </div>
      <div class="check-error-msg" id="checkError_${idx}">
        ⚠️ Veuillez répondre à toutes les questions avant de cocher cette case.
      </div>

      <div class="quiz-submit-row">
        <div class="quiz-answered-count" id="qCount_${idx}">${answered} / 10 questions répondues</div>
        ${submitted
          ? `<button class="btn btn-primary" disabled>✅ Quiz soumis</button>`
          : `<button class="btn btn-primary" id="btnQuizSubmit_${idx}" disabled
               onclick="submitQuiz(${idx})">
               📤 Soumettre le quiz
             </button>`
        }
      </div>
    </div>
  </div>

  <div class="result-panel ${submitted?'show':''}" id="resultPanel_${idx}">
    <div class="score" id="quizScore_${idx}">${submitted?calcScore(idx)+'%':''}</div>
    <p id="quizResultMsg_${idx}">${submitted?getResultMsg(calcScore(idx)):''}</p>
    ${submitted?`<div class="btn-row" style="justify-content:center;margin-top:1rem">
      <button class="btn btn-continue" onclick="continuer(${idx})">Continuer →</button>
    </div>`:''}
  </div>`;
}

/* ═══════════════════════════════════════════
   LOGIQUE
═══════════════════════════════════════════ */
function goTo(idx){
  state.current = idx;
  render();
  window.scrollTo({top:0,behavior:'smooth'});
}

function render(){
  const idx = state.current;
  const s = STEPS[idx];
  const html = s.type==='lecon' ? renderLecon(idx) : renderQuiz(idx);
  document.getElementById('contentArea').innerHTML = html;
  buildStepper();
  syncSidebar();
  updateGlobal();
}

/* Fichier upload */
function handleFile(idx, input){
  if(input.files[0]){
    state.uploadedFile[idx] = input.files[0].name;
    render();
    showToast('Fichier joint : '+input.files[0].name);
  }
}

/* Checkbox quiz "toutes questions répondues" */
function handleQuizCheck(idx, checkbox){
  const answered = Object.keys(state.quizAnswers[idx] || {}).length;
  if(answered < 10){
    checkbox.checked = false;
    const errEl = document.getElementById('checkError_'+idx);
    if(errEl){ errEl.style.display='block'; setTimeout(()=>errEl.style.display='none',3500); }
    return;
  }
  const btn = document.getElementById('btnQuizSubmit_'+idx);
  if(btn) btn.disabled = !checkbox.checked;
}

/* Soumettre devoir */
function soumettrDevoir(idx){
  const text = document.getElementById('devoirText_'+idx).value.trim();
  const hasFile = state.uploadedFile[idx];
  if(!text && !hasFile){
    showToast('Veuillez rédiger votre réponse ou joindre un fichier.','warning');
    return;
  }
  state.devoirSubmitted[idx] = true;
  showToast('Devoir soumis avec succès ! 🎉');
  render();
}

function voirCorrection(idx){
  showToast('Correction disponible – Chargement…','success');
}

function continuer(idx){
  state.done[idx] = true;
  if(idx + 1 < TOTAL){
    state.current = idx + 1;
  }
  render();
  showToast('Bravo ! Prochaine étape débloquée ✨');
}

/* Quiz */
function selectAnswer(idx, qi, oi){
  if(!state.quizAnswers[idx]) state.quizAnswers[idx] = {};
  state.quizAnswers[idx][qi] = oi;

  // Update visuels sans re-render complet
  QUIZ_QUESTIONS[0].opts.forEach((_,i)=>{
    const el = document.getElementById(`opt_${idx}_${qi}_${i}`);
    if(el) el.classList.toggle('selected', i===oi);
  });
  const qblock = document.getElementById(`qblock_${idx}_${qi}`);
  if(qblock) qblock.classList.add('answered');

  const answered = Object.keys(state.quizAnswers[idx]).length;
  const pct = Math.round(answered/10*100);
  const fill = document.getElementById('qpbFill_'+idx);
  if(fill) fill.style.width = pct+'%';
  const lbl = document.getElementById('qpbLabel_'+idx);
  if(lbl) lbl.textContent = 'Progression : '+answered+'/10';
  const cnt = document.getElementById('qCount_'+idx);
  if(cnt) cnt.textContent = answered+' / 10 questions répondues';
  const albl = document.getElementById('answeredLabel_'+idx);
  if(albl) albl.textContent = answered+'/10 questions répondues';
  // Réinitialise la checkbox si on change une réponse après l'avoir cochée
  const chk = document.getElementById('allQuestionsOk_'+idx);
  const btn = document.getElementById('btnQuizSubmit_'+idx);
  if(chk && answered < 10){ chk.checked = false; if(btn) btn.disabled = true; }
}

function calcScore(idx){
  const answers = state.quizAnswers[idx] || {};
  // Réponses correctes (index 0-based, simplifiées)
  const correct = [1,1,2,1,1,1,0,1,1,1];
  let ok = 0;
  correct.forEach((c,i)=>{ if(answers[i]===c) ok++; });
  return Math.round(ok/10*100);
}

function getResultMsg(score){
  if(score >= 70) return `🎉 Félicitations ! Vous avez validé ce quiz avec ${score}%. Vous pouvez continuer.`;
  return `😕 Vous avez obtenu ${score}%. Un score minimum de 70% est requis. Révisez les leçons et réessayez.`;
}

function submitQuiz(idx){
  const answers = state.quizAnswers[idx] || {};
  if(Object.keys(answers).length < 10){
    showToast('Répondez à toutes les questions avant de soumettre.','warning');
    return;
  }
  const score = calcScore(idx);
  const isFinal = STEPS[idx].isFinal;
  // Redirection vers la page de résultat
  window.location.href = isFinal
    ? `/quiz/final/resultat?score=${score}`
    : `/quiz/${idx}/resultat?score=${score}`;
}

/* ═══════════════════════════════════════════
   INIT
═══════════════════════════════════════════ */
// Init quiz answers maps
STEPS.forEach((s,i)=>{ if(s.type==='quiz') state.quizAnswers[i] = {}; });
render();
</script>
</body>
</html>
