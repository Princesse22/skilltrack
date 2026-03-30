<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Soumettre une Formation</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#2563eb; --blue-d:#1d4ed8; --blue-l:#dbeafe; --blue-xl:#eff6ff;
  --indigo:#4f46e5; --violet:#7c3aed;
  --green:#16a34a; --green-l:#dcfce7;
  --orange:#ea580c; --orange-l:#fff7ed;
  --gray-50:#f8fafc; --gray-100:#f1f5f9; --gray-200:#e2e8f0;
  --gray-300:#cbd5e1; --gray-400:#94a3b8; --gray-500:#64748b;
  --gray-600:#475569; --gray-700:#334155; --gray-800:#1e293b; --gray-900:#0f172a;
  --white:#fff; --red:#dc2626; --red-l:#fee2e2;
  --sidebar-w:300px;
  --font:'Plus Jakarta Sans',sans-serif;
  --display:'Playfair Display',serif;
  --radius:14px; --radius-sm:8px; --radius-xs:6px;
  --shadow:0 4px 24px rgba(0,0,0,.08);
  --shadow-lg:0 12px 40px rgba(37,99,235,.15);
}

html,body{height:100%;overflow:hidden;font-family:var(--font);background:var(--gray-50);color:var(--gray-800)}

/* ══ LAYOUT FULL SCREEN ══ */
.app{display:flex;height:100vh;width:100vw;overflow:hidden}

/* ══ SIDEBAR ══ */
.sidebar{
  width:var(--sidebar-w);flex-shrink:0;
  background:linear-gradient(160deg,var(--gray-900) 0%,#1a1f35 100%);
  display:flex;flex-direction:column;
  padding:0;overflow:hidden;position:relative;
}
.sidebar::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse at 20% 20%,rgba(37,99,235,.18) 0%,transparent 60%),
             radial-gradient(ellipse at 80% 80%,rgba(124,58,237,.12) 0%,transparent 60%);
  pointer-events:none;
}

.sidebar-top{padding:2rem 1.8rem 1.5rem;position:relative}
.logo{font-weight:800;font-size:1.3rem;color:var(--white);letter-spacing:-.5px;margin-bottom:.25rem}
.logo span{color:#60a5fa}
.sidebar-subtitle{font-size:.78rem;color:rgba(255,255,255,.4);font-weight:400}

.sidebar-divider{height:1px;background:rgba(255,255,255,.07);margin:0 1.8rem}

/* Steps nav */
.steps-nav{flex:1;padding:1.5rem 1.2rem;overflow-y:auto;position:relative}
.steps-nav::-webkit-scrollbar{width:3px}
.steps-nav::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:99px}

.step-nav-item{
  display:flex;align-items:flex-start;gap:.85rem;
  padding:.75rem .8rem;border-radius:var(--radius-sm);
  cursor:pointer;transition:background .2s;margin-bottom:.2rem;
  position:relative;
}
.step-nav-item:hover{background:rgba(255,255,255,.05)}
.step-nav-item.active{background:rgba(37,99,235,.2)}
.step-nav-item.done{opacity:.7}
.step-nav-item.locked{opacity:.35;cursor:not-allowed}

/* Connector line */
.step-nav-item:not(:last-child)::after{
  content:'';position:absolute;left:calc(.8rem + 14px);top:calc(.75rem + 28px);
  width:2px;height:calc(100% - 4px);
  background:rgba(255,255,255,.08);
}
.step-nav-item.done:not(:last-child)::after{background:rgba(37,99,235,.4)}

.step-num{
  width:28px;height:28px;border-radius:50%;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  font-size:.72rem;font-weight:700;margin-top:1px;
  border:2px solid rgba(255,255,255,.15);color:rgba(255,255,255,.4);
  transition:all .3s;
}
.step-nav-item.active .step-num{background:var(--blue);border-color:var(--blue);color:#fff;box-shadow:0 0 0 4px rgba(37,99,235,.25)}
.step-nav-item.done .step-num{background:var(--green);border-color:var(--green);color:#fff}
.step-nav-item.locked .step-num{background:transparent}

.step-nav-info{flex:1}
.step-nav-label{font-size:.67rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,.35);margin-bottom:.15rem}
.step-nav-item.active .step-nav-label{color:#60a5fa}
.step-nav-title{font-size:.86rem;font-weight:600;color:rgba(255,255,255,.55);line-height:1.3}
.step-nav-item.active .step-nav-title{color:#fff}
.step-nav-item.done .step-nav-title{color:rgba(255,255,255,.45)}

/* Global progress */
.sidebar-bottom{padding:1.5rem 1.8rem;position:relative}
.global-prog-label{font-size:.75rem;color:rgba(255,255,255,.4);margin-bottom:.5rem;display:flex;justify-content:space-between}
.global-prog-label span{color:#60a5fa;font-weight:600}
.global-prog-track{height:4px;background:rgba(255,255,255,.1);border-radius:99px;overflow:hidden}
.global-prog-fill{height:100%;background:linear-gradient(90deg,var(--blue),#818cf8);border-radius:99px;transition:width .5s ease}

/* ══ MAIN AREA ══ */
.main{flex:1;display:flex;flex-direction:column;overflow:hidden;background:var(--gray-50)}

/* Top progress bar */
.top-progress{
  height:3px;background:var(--gray-200);flex-shrink:0;
}
.top-progress-fill{height:100%;background:linear-gradient(90deg,var(--blue),var(--indigo));transition:width .5s ease}

/* Header */
.main-header{
  padding:1.5rem 3rem 0;flex-shrink:0;
  display:flex;align-items:center;justify-content:space-between;
}
.step-badge{
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.3rem .8rem;background:var(--blue-l);
  border-radius:99px;font-size:.72rem;font-weight:700;
  color:var(--blue);letter-spacing:.3px;
}
.save-indicator{font-size:.75rem;color:var(--gray-400);display:flex;align-items:center;gap:.4rem}
.save-dot{width:6px;height:6px;border-radius:50%;background:var(--green);animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}

/* Content scroll */
.main-content{flex:1;overflow-y:auto;padding:1.5rem 3rem 2rem}
.main-content::-webkit-scrollbar{width:5px}
.main-content::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:99px}

/* Step title */
.step-heading{margin-bottom:2rem}
.step-heading h1{font-family:var(--display);font-size:1.7rem;color:var(--gray-900);line-height:1.2;margin-bottom:.4rem}
.step-heading p{font-size:.9rem;color:var(--gray-500);line-height:1.6}

/* Section within step */
.form-section{margin-bottom:2rem}
.form-section-title{
  font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:1.2px;
  color:var(--blue);margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;
}
.form-section-title::after{content:'';flex:1;height:1px;background:var(--blue-l)}

/* Grid */
.form-grid{display:grid;gap:1.2rem}
.form-grid.cols-2{grid-template-columns:1fr 1fr}
.form-grid.cols-3{grid-template-columns:1fr 1fr 1fr}
.col-span-2{grid-column:span 2}
.col-span-3{grid-column:span 3}

/* Form Group */
.fg{display:flex;flex-direction:column;gap:.4rem}
.fg label{font-size:.78rem;font-weight:600;color:var(--gray-600);letter-spacing:.2px;display:flex;align-items:center;gap:.35rem}
.fg label .opt{font-weight:400;color:var(--gray-400);font-size:.72rem}
.fg label .req{color:var(--red);font-size:.75rem}

/* Inputs */
input[type=text],input[type=email],input[type=tel],input[type=number],
input[type=url],select,textarea{
  width:100%;padding:.7rem 1rem;
  border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);
  font-family:var(--font);font-size:.875rem;color:var(--gray-800);
  background:var(--white);outline:none;
  transition:border-color .2s,box-shadow .2s,background .2s;
}
input:focus,select:focus,textarea:focus{
  border-color:var(--blue);background:var(--white);
  box-shadow:0 0 0 3px rgba(37,99,235,.1);
}
input::placeholder,textarea::placeholder{color:var(--gray-300)}
textarea{resize:vertical;min-height:100px;line-height:1.6}
select{cursor:pointer}

/* Input with icon */
.input-wrap{position:relative}
.input-wrap .input-icon{
  position:absolute;left:.85rem;top:50%;transform:translateY(-50%);
  font-size:.95rem;pointer-events:none;
}
.input-wrap input,.input-wrap select{padding-left:2.5rem}

/* Photo upload */
.photo-upload{
  display:flex;align-items:center;gap:1.2rem;
}
.photo-preview{
  width:72px;height:72px;border-radius:50%;
  background:var(--gray-100);border:2px dashed var(--gray-300);
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;flex-shrink:0;overflow:hidden;cursor:pointer;
  transition:all .2s;
}
.photo-preview:hover{border-color:var(--blue);background:var(--blue-xl)}
.photo-preview img{width:100%;height:100%;object-fit:cover}
.photo-upload-info{flex:1}
.photo-upload-info .btn-upload{
  display:inline-flex;align-items:center;gap:.35rem;
  padding:.4rem .9rem;background:var(--blue-l);color:var(--blue);
  border-radius:99px;font-size:.78rem;font-weight:600;cursor:pointer;
  border:none;font-family:var(--font);transition:all .2s;
}
.photo-upload-info .btn-upload:hover{background:var(--blue);color:#fff}
.photo-upload-info p{font-size:.73rem;color:var(--gray-400);margin-top:.35rem}
#photoFileInput{display:none}

/* Tags input */
.tags-wrap{
  border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);
  padding:.5rem .75rem;background:var(--white);
  display:flex;flex-wrap:wrap;gap:.4rem;min-height:46px;
  cursor:text;transition:border-color .2s,box-shadow .2s;
}
.tags-wrap:focus-within{border-color:var(--blue);box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.tag{
  display:inline-flex;align-items:center;gap:.3rem;
  background:var(--blue-l);color:var(--blue);
  padding:.2rem .6rem;border-radius:99px;font-size:.75rem;font-weight:600;
}
.tag .tag-rm{cursor:pointer;font-size:.7rem;opacity:.7;line-height:1;border:none;background:none;color:inherit;padding:0}
.tag .tag-rm:hover{opacity:1}
.tags-input{border:none;outline:none;font-family:var(--font);font-size:.875rem;color:var(--gray-800);background:transparent;min-width:120px;flex:1;padding:.2rem 0}

/* Slider */
.slider-wrap{display:flex;align-items:center;gap:1rem}
input[type=range]{
  flex:1;height:4px;-webkit-appearance:none;
  background:var(--gray-200);border-radius:99px;outline:none;cursor:pointer;
  border:none;padding:0;box-shadow:none;
}
input[type=range]::-webkit-slider-thumb{
  -webkit-appearance:none;width:18px;height:18px;border-radius:50%;
  background:var(--blue);cursor:pointer;
  box-shadow:0 0 0 3px rgba(37,99,235,.2);
}
.slider-val{
  min-width:48px;text-align:center;padding:.3rem .6rem;
  background:var(--blue-l);color:var(--blue);
  border-radius:var(--radius-xs);font-size:.82rem;font-weight:700;
}

/* Radio cards (rémunération) */
.radio-cards{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}
.radio-card input{display:none}
.radio-card-label{
  display:flex;flex-direction:column;gap:.35rem;
  padding:1.1rem 1.2rem;border:2px solid var(--gray-200);
  border-radius:var(--radius);cursor:pointer;transition:all .25s;
  background:var(--white);
}
.radio-card-label:hover{border-color:var(--blue);background:var(--blue-xl)}
.radio-card input:checked + .radio-card-label{
  border-color:var(--blue);background:var(--blue-xl);
}
.radio-card-label .rc-icon{font-size:1.5rem;margin-bottom:.2rem}
.radio-card-label .rc-title{font-weight:700;font-size:.9rem;color:var(--gray-800)}
.radio-card-label .rc-desc{font-size:.78rem;color:var(--gray-500);line-height:1.4}
.radio-card input:checked + .radio-card-label .rc-title{color:var(--blue)}

/* Niveau badges */
.level-cards{display:flex;gap:.6rem}
.level-card input{display:none}
.level-card-label{
  flex:1;text-align:center;padding:.6rem;
  border:2px solid var(--gray-200);border-radius:var(--radius-sm);
  cursor:pointer;font-size:.82rem;font-weight:600;color:var(--gray-500);
  transition:all .2s;background:var(--white);
}
.level-card-label:hover{border-color:var(--blue);color:var(--blue)}
.level-card input:checked + .level-card-label{border-color:var(--blue);background:var(--blue-l);color:var(--blue)}

/* Checkboxes engagement */
.engage-list{display:flex;flex-direction:column;gap:.85rem}
.engage-item{
  display:flex;align-items:flex-start;gap:.85rem;
  padding:1rem 1.2rem;border:1.5px solid var(--gray-200);
  border-radius:var(--radius-sm);background:var(--white);
  cursor:pointer;transition:all .2s;
}
.engage-item:hover{border-color:var(--blue);background:var(--blue-xl)}
.engage-item.checked{border-color:var(--green);background:var(--green-l)}
.engage-item input[type=checkbox]{
  width:18px;height:18px;min-width:18px;margin-top:1px;
  accent-color:var(--green);cursor:pointer;
}
.engage-item .ei-content{flex:1}
.engage-item .ei-title{font-size:.875rem;font-weight:600;color:var(--gray-800);margin-bottom:.15rem}
.engage-item .ei-desc{font-size:.78rem;color:var(--gray-500);line-height:1.4}

/* Plan détaillé */
.plan-list{display:flex;flex-direction:column;gap:.6rem}
.plan-row{display:flex;align-items:center;gap:.6rem}
.plan-row .plan-num{
  width:28px;height:28px;border-radius:50%;background:var(--blue-l);
  color:var(--blue);font-size:.72rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.plan-row input{flex:1}
.plan-row .btn-rm-plan{
  width:28px;height:28px;border:none;background:var(--gray-100);
  border-radius:50%;cursor:pointer;color:var(--gray-400);
  font-size:.9rem;display:flex;align-items:center;justify-content:center;
  transition:all .2s;flex-shrink:0;
}
.plan-row .btn-rm-plan:hover{background:var(--red-l);color:var(--red)}
.btn-add-plan{
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.4rem .9rem;border:1.5px dashed var(--gray-300);
  background:transparent;border-radius:var(--radius-xs);
  font-family:var(--font);font-size:.8rem;color:var(--gray-500);
  cursor:pointer;margin-top:.4rem;transition:all .2s;
}
.btn-add-plan:hover{border-color:var(--blue);color:var(--blue);background:var(--blue-xl)}

/* ══ FOOTER NAV ══ */
.main-footer{
  padding:1.2rem 3rem;border-top:1px solid var(--gray-200);
  display:flex;align-items:center;justify-content:space-between;
  background:var(--white);flex-shrink:0;
}
.footer-left{display:flex;align-items:center;gap:.5rem}
.btn-prev{
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.65rem 1.3rem;border:1.5px solid var(--gray-200);
  background:transparent;border-radius:var(--radius-sm);
  font-family:var(--font);font-size:.875rem;font-weight:600;
  color:var(--gray-600);cursor:pointer;transition:all .2s;
}
.btn-prev:hover{border-color:var(--gray-400);color:var(--gray-800)}
.btn-prev:disabled{opacity:.3;cursor:not-allowed}
.step-counter{font-size:.8rem;color:var(--gray-400);padding:0 .5rem}
.btn-next{
  display:inline-flex;align-items:center;gap:.5rem;
  padding:.7rem 2rem;
  background:linear-gradient(135deg,var(--blue),var(--indigo));
  color:#fff;border:none;border-radius:var(--radius-sm);
  font-family:var(--font);font-size:.9rem;font-weight:700;
  cursor:pointer;transition:all .25s;box-shadow:0 4px 14px rgba(37,99,235,.3);
}
.btn-next:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(37,99,235,.4)}
.btn-next:active{transform:translateY(0)}
.btn-submit{
  background:linear-gradient(135deg,var(--green),#15803d);
  box-shadow:0 4px 14px rgba(22,163,74,.3);
}
.btn-submit:hover{box-shadow:0 6px 20px rgba(22,163,74,.4)}

/* ══ ANIMATIONS ══ */
.step-panel{animation:slideIn .35s cubic-bezier(.4,0,.2,1)}
@keyframes slideIn{from{opacity:0;transform:translateX(20px)}to{opacity:1;transform:translateX(0)}}

/* ══ REVIEW CARD ══ */
.review-section{margin-bottom:1.5rem}
.review-section h3{font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--blue);margin-bottom:.75rem;display:flex;align-items:center;gap:.4rem}
.review-section h3::after{content:'';flex:1;height:1px;background:var(--blue-l)}
.review-grid{display:grid;grid-template-columns:1fr 1fr;gap:.5rem}
.review-item{background:var(--white);padding:.65rem .9rem;border-radius:var(--radius-xs);border:1px solid var(--gray-200)}
.review-item .ri-label{font-size:.7rem;color:var(--gray-400);font-weight:600;text-transform:uppercase;letter-spacing:.4px}
.review-item .ri-val{font-size:.875rem;color:var(--gray-800);font-weight:500;margin-top:.1rem}

/* ══ TOAST ══ */
.toast{
  position:fixed;bottom:2rem;right:2rem;z-index:999;
  padding:.75rem 1.25rem;border-radius:var(--radius-sm);
  font-size:.875rem;font-weight:600;
  transform:translateY(80px);opacity:0;transition:all .3s;
  display:flex;align-items:center;gap:.5rem;
  box-shadow:0 8px 24px rgba(0,0,0,.15);
}
.toast.show{transform:translateY(0);opacity:1}
.toast.success{background:var(--green);color:#fff}
.toast.error{background:var(--red);color:#fff}
.toast.info{background:var(--gray-800);color:#fff}

/* Devise select inline */
.price-group{display:flex;gap:.6rem}
.price-group select{width:110px;flex-shrink:0}
.price-group input{flex:1}

/* ══ RESPONSIVE ══ */
@media(max-width:900px){
  .sidebar{display:none}
  .main-content{padding:1.2rem}
  .main-header,.main-footer{padding:1rem 1.2rem}
  .form-grid.cols-2,.form-grid.cols-3{grid-template-columns:1fr}
  .col-span-2,.col-span-3{grid-column:span 1}
  .radio-cards{grid-template-columns:1fr}
}
</style>
</head>
<body>

<div class="app">

  <!-- ══ SIDEBAR ══ -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <div class="logo">Skill<span>Tract</span></div>
      <div class="sidebar-subtitle">Formulaire de soumission</div>
    </div>
    <div class="sidebar-divider"></div>

    <nav class="steps-nav" id="stepsNav">
      <!-- généré par JS -->
    </nav>

    <div class="sidebar-divider"></div>
    <div class="sidebar-bottom">
      <div class="global-prog-label">Progression globale <span id="globalPct">0%</span></div>
      <div class="global-prog-track"><div class="global-prog-fill" id="globalFill" style="width:0%"></div></div>
    </div>
  </aside>

  <!-- ══ MAIN ══ -->
  <div class="main">
    <div class="top-progress"><div class="top-progress-fill" id="topFill" style="width:0%"></div></div>

    <div class="main-header">
      <div class="step-badge" id="stepBadge">Étape 1 sur 6</div>
      <div class="save-indicator"><div class="save-dot"></div> Brouillon sauvegardé</div>
    </div>

    <div class="main-content" id="mainContent"></div>

    <div class="main-footer">
      <div class="footer-left">
        <button class="btn-prev" id="btnPrev" onclick="prevStep()" disabled>← Précédent</button>
        <span class="step-counter" id="stepCounter">1 / 6</span>
      </div>
      <button class="btn-next" id="btnNext" onclick="nextStep()">
        Continuer <span>→</span>
      </button>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>
<input type="file" id="photoFileInput" accept="image/*" onchange="previewPhoto(this)">

<script>
/* ══════════════════════════════════
   CONFIG DES ÉTAPES
══════════════════════════════════ */
const STEPS_CONFIG = [
  { icon:'👤', label:'Étape 1', title:'Profil du Formateur',       desc:'Vos informations personnelles et professionnelles' },
  { icon:'📚', label:'Étape 2', title:'La Formation',              desc:'Informations générales et description de votre formation' },
  { icon:'🎯', label:'Étape 3', title:'Objectifs & Public',        desc:'Ce que les apprenants vont acquérir et à qui s\'adresse la formation' },
  { icon:'🗂️', label:'Étape 4', title:'Organisation Pédagogique', desc:'Structure, durée et contenu détaillé de la formation' },
  { icon:'💰', label:'Étape 5', title:'Informations Financières',  desc:'Tarification et mode de rémunération' },
  { icon:'✅', label:'Étape 6', title:'Engagement & Validation',   desc:'Confirmez et soumettez votre formation' },
];

let current = 0;
const TOTAL = STEPS_CONFIG.length;

/* Tags state */
let tags = { competences: [], prerequis: [] };
let planItems = [''];

/* ══ SIDEBAR ══ */
function buildSidebar(){
  document.getElementById('stepsNav').innerHTML = STEPS_CONFIG.map((s,i)=>{
    let cls = i < current ? 'done' : i === current ? 'active' : 'locked';
    return `<div class="step-nav-item ${cls}" onclick="tryGoTo(${i})">
      <div class="step-num">${i < current ? '✓' : i+1}</div>
      <div class="step-nav-info">
        <div class="step-nav-label">${s.label}</div>
        <div class="step-nav-title">${s.title}</div>
      </div>
    </div>`;
  }).join('');
}

function tryGoTo(i){ if(i <= current) goTo(i); }

/* ══ PROGRESS ══ */
function updateProgress(){
  const pct = Math.round((current / TOTAL) * 100);
  document.getElementById('globalFill').style.width = pct+'%';
  document.getElementById('globalPct').textContent = pct+'%';
  document.getElementById('topFill').style.width = ((current+1)/TOTAL*100)+'%';
  document.getElementById('stepBadge').textContent = `Étape ${current+1} sur ${TOTAL}`;
  document.getElementById('stepCounter').textContent = `${current+1} / ${TOTAL}`;
  document.getElementById('btnPrev').disabled = current === 0;
  const btn = document.getElementById('btnNext');
  if(current === TOTAL-1){
    btn.innerHTML = '🚀 Soumettre la formation';
    btn.className = 'btn-next btn-submit';
    btn.name = 'soumettre_formation'; // Ajout du name
    btn.value = 'true'; // Ajout de la valeur
  } else {
    btn.innerHTML = 'Continuer <span>→</span>';
    btn.className = 'btn-next';
    btn.removeAttribute('name'); // Supprime l'attribut name quand ce n'est pas le bouton submit
    btn.removeAttribute('value'); // Supprime l'attribut value
  }
}

/* ══ NAVIGATION ══ */
function nextStep(){
  if(current === TOTAL-1){ submitForm(); return; }
  current++;
  render();
}
function prevStep(){ if(current > 0){ current--; render(); } }
function goTo(i){ current = i; render(); }

function render(){
  buildSidebar();
  updateProgress();
  const c = document.getElementById('mainContent');
  c.innerHTML = getStepHTML(current);
  c.scrollTop = 0;
  // restore plan rows
  if(current === 3) renderPlanRows();
  // restore tags
  if(current === 2) { renderTags('competences'); renderTags('prerequis'); }
}

/* ══ STEP HTML ══ */
function getStepHTML(i){
  const s = STEPS_CONFIG[i];
  return `<div class="step-panel">
    <div class="step-heading">
      <h1>${s.icon} ${s.title}</h1>
      <p>${s.desc}</p>
    </div>
    ${[step1,step2,step3,step4,step5,step6][i]()}
  </div>`;
}

/* ══ ÉTAPE 1 : PROFIL FORMATEUR ══ */
function step1(){ return `
  <div class="form-section">
    <div class="form-section-title">Identité</div>
    <div class="form-grid cols-2">
      <div class="fg">
        <label>Nom complet <span class="req">*</span></label>
        <div class="input-wrap"><span class="input-icon">👤</span>
          <input type="text" id="f_nom" placeholder="Ex : Jean-Paul Mbarga" value="${fv('f_nom')}" name="nom">
        </div>
      </div>
      <div class="fg">
        <label>Email <span class="req">*</span></label>
        <div class="input-wrap"><span class="input-icon">✉️</span>
          <input type="email" id="f_email" placeholder="exemple@email.com" value="${fv('f_email')}" name="email">
        </div>
      </div>
<div class="fg">
    <label>Date de naissance <span class="req">*</span></label>
    <div class="input-wrap">
        <span class="input-icon">📅</span>
        <input type="date" id="date_naissance" placeholder="jj/mm/aaaa" value="${fv('date_naissance')}" name="date_naissance">
    </div>
</div>
      <div class="fg">
        <label>Numéro de téléphone <span class="req">*</span></label>
        <div class="input-wrap"><span class="input-icon">📱</span>
          <input type="tel" id="f_tel" placeholder="+237 6XX XXX XXX" value="${fv('f_tel')}" name="tel">
        </div>
      </div>
      <div class="fg">
        <label>Domaine d'expertise <span class="req">*</span></label>
        <div class="input-wrap"><span class="input-icon">🎓</span>
          <select id="f_domaine">
            <option value="">Sélectionner…</option>
            ${['Développement Web','Marketing Digital','Infographie & Design','Bureautique','Data Science','Gestion de Projet','Commerce & Vente','Autre'].map(d=>`<option value="${d}" ${fv('f_domaine')===d?'selected':''}>${d}</option>`).join('')}
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Photo de profil <span style="font-weight:400;color:var(--gray-400);text-transform:none;letter-spacing:0"> — optionnel</span></div>
    <div class="photo-upload">
      <div class="photo-preview" onclick="document.getElementById('photoFileInput').click()" id="photoPreview">
        ${fv('f_photo') ? `<img src="${fv('f_photo')}" id="photoImg">` : '🧑‍🏫'}
      </div>
      <div class="photo-upload-info">
        <button class="btn-upload" type="button" onclick="document.getElementById('photoFileInput').click()">📷 Choisir une photo</button>
        <p>JPG, PNG ou GIF · Max 2 Mo · Recommandé : 200×200 px</p>
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Présentation</div>
    <div class="form-grid">
      <div class="fg">
        <label>Brève biographie <span class="req">*</span></label>
        <textarea id="f_bio" placeholder="Présentez-vous en quelques phrases : votre parcours, vos spécialités, ce qui vous passionne…" rows="4">${fv('f_bio')}</textarea>
      </div>
      <div class="form-grid cols-2">
        <div class="fg">
          <label>Années d'expérience <span class="req">*</span></label>
          <div class="slider-wrap">
            <input type="range" id="f_exp" min="0" max="30" value="${fv('f_exp')||1}" oninput="document.getElementById('expVal').textContent=this.value+' an'+(this.value>1?'s':'')">
            <div class="slider-val" id="expVal">${fv('f_exp')||1} an${(fv('f_exp')||1)>1?'s':''}</div>
          </div>
        </div>
        <div class="fg">
          <label>Diplômes / Certifications <span class="opt">(optionnel)</span></label>
          <input type="file" id="f_diplomes" placeholder="Ex : Master Marketing, Google Ads…" value="${fv('f_diplomes')}">
        </div>
      </div>
    </div>
  </div>
`;}

/* ══ ÉTAPE 2 : INFOS FORMATION ══ */
function step2(){ return `
  <div class="form-section">
    <div class="form-section-title">Présentation de la formation</div>
    <div class="form-grid">
      <div class="fg">
        <label>Titre de la formation <span class="req">*</span></label>
        <div class="input-wrap"><span class="input-icon">📌</span>
          <input type="text" id="f_titre" placeholder="Ex : Maîtrisez le Marketing Digital de A à Z" value="${fv('f_titre')}">
        </div>
      </div>
      <div class="form-grid cols-2">
        <div class="fg">
          <label>Catégorie <span class="req">*</span></label>
          <select id="f_categorie">
            <option value="">Choisir…</option>
            ${['Marketing Digital','Développement Web','Infographie','Bureautique','Data Science','Gestion','Commerce','Autre'].map(c=>`<option value="${c}" ${fv('f_categorie')===c?'selected':''}>${c}</option>`).join('')}
          </select>
        </div>
        <div class="fg">
          <label>Langue <span class="req">*</span></label>
          <select id="f_langue">
            <option value="">Choisir…</option>
            ${['Français','Anglais','Français & Anglais','Autre'].map(l=>`<option value="${l}" ${fv('f_langue')===l?'selected':''}>${l}</option>`).join('')}
          </select>
        </div>
      </div>
      <div class="fg">
        <label>Niveau <span class="req">*</span></label>
        <div class="level-cards">
          ${[['debutant','🌱 Débutant'],['intermediaire','⚡ Intermédiaire'],['avance','🔥 Avancé'],['tous','🌍 Tous niveaux']].map(([v,l])=>`
            <label class="level-card"><input type="radio" name="f_niveau" value="${v}" ${fv('f_niveau')===v?'checked':''}><span class="level-card-label">${l}</span></label>
          `).join('')}
        </div>
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Description</div>
    <div class="form-grid">
      <div class="fg">
        <label>Description courte <span class="req">*</span> <span class="opt">(accroche, ~150 caractères)</span></label>
        <input type="text" id="f_desc_courte" placeholder="Une phrase percutante qui résume votre formation…" maxlength="160" value="${fv('f_desc_courte')}">
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Médias <span style="font-weight:400;color:var(--gray-400);text-transform:none;letter-spacing:0"> — optionnel</span></div>
    <div class="form-grid cols-2">
      <div class="fg">
        <label>Image de couverture</label>
        <input type="file" id="f_cover" placeholder="https://… ou laissez vide" value="${fv('f_cover')}">
      </div>
      <div class="fg">
        <label>Vidéo de présentation</label>
        <input type="url" id="f_video" placeholder="Lien YouTube ou Vimeo" value="${fv('f_video')}">
      </div>
    </div>
  </div>
`;}

/* ══ ÉTAPE 3 : OBJECTIFS & PUBLIC ══ */
function step3(){ return `
  <div class="form-section">
    <div class="form-section-title">Compétences acquises à la fin</div>
    <div class="form-grid">
      <div class="fg">
        <label>Ajoutez les compétences (appuyez Entrée pour valider) <span class="req">*</span></label>
        <div class="tags-wrap" onclick="document.getElementById('tagsInput_competences').focus()">
          <div id="tagsDisplay_competences"></div>
          <input class="tags-input" id="tagsInput_competences" placeholder="Ex : Créer une campagne Meta Ads…" onkeydown="addTag(event,'competences')">
        </div>
        <p style="font-size:.72rem;color:var(--gray-400);margin-top:.3rem">Minimum 3 compétences recommandées</p>
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Prérequis</div>
    <div class="fg">
      <label>Ce que l'apprenant doit déjà savoir <span class="opt">(optionnel)</span></label>
      <div class="tags-wrap" onclick="document.getElementById('tagsInput_prerequis').focus()">
        <div id="tagsDisplay_prerequis"></div>
        <input class="tags-input" id="tagsInput_prerequis" placeholder="Ex : Avoir un compte Facebook…" onkeydown="addTag(event,'prerequis')">
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Public cible</div>
    <div class="form-grid">
      <div class="fg">
        <label>À qui s'adresse cette formation ? <span class="req">*</span></label>
        <textarea id="f_public" rows="3" placeholder="Ex : Entrepreneurs, créateurs de contenu, étudiants en marketing souhaitant développer leur présence digitale…">${fv('f_public')}</textarea>
      </div>
      <div class="fg">
        <label>Objectifs pédagogiques <span class="req">*</span></label>
        <textarea id="f_objectifs" rows="4" placeholder="À la fin de cette formation, l'apprenant sera capable de…&#10;· Créer et gérer des publicités sur Meta&#10;· Analyser les performances via Google Analytics&#10;· Développer une stratégie de contenu…">${fv('f_objectifs')}</textarea>
      </div>
    </div>
  </div>
`;}

/* ══ ÉTAPE 4 : ORGANISATION PÉDAGOGIQUE ══ */
function step4(){ return `
  <div class="form-section">
    <div class="form-section-title">Structure</div>
    <div class="form-grid cols-3">
      <div class="fg">
        <label>Nombre de leçons <span class="req">*</span></label>
        <input type="number" id="f_nb_lecons" min="1" max="100" placeholder="Ex : 10" value="${fv('f_nb_lecons')}">
      </div>
      <div class="fg">
        <label>Durée par leçon <span class="req">*</span></label>
        <select id="f_duree_lecon">
          <option value="">Choisir…</option>
          ${['15 min','30 min','45 min','1h','1h30','2h','2h+'].map(d=>`<option value="${d}" ${fv('f_duree_lecon')===d?'selected':''}>${d}</option>`).join('')}
        </select>
      </div>
      <div class="fg">
        <label>Durée totale estimée <span class="req">*</span></label>
        <input type="text" id="f_duree_totale" placeholder="Ex : 20 heures" value="${fv('f_duree_totale')}">
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Plan détaillé de la formation</div>
    <div class="fg">
      <label>Listez les titres de chaque leçon <span class="req">*</span></label>
      <div class="plan-list" id="planList"></div>
      <button type="button" class="btn-add-plan" onclick="addPlanRow()">＋ Ajouter une leçon</button>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Évaluation</div>
    <div class="form-grid cols-2">
      <div class="fg">
        <label>Score minimum de validation (%)</label>
        <div class="slider-wrap">
          <input type="range" id="f_score_min" min="0" max="100" step="5" value="${fv('f_score_min')||70}"
            oninput="document.getElementById('scoreVal').textContent=this.value+'%'">
          <div class="slider-val" id="scoreVal">${fv('f_score_min')||70}%</div>
        </div>
      </div>
    </div>
  </div>
`;}

/* ══ ÉTAPE 5 : FINANCIER ══ */
function step5(){ return `
  <div class="form-section">
    <div class="form-section-title">Tarification</div>
    <div class="form-grid cols-2">
      <div class="fg">
        <label>Type de formation <span class="req">*</span></label>
        <div class="level-cards">
          ${[['payante','💰 Payante'],['gratuite','🎁 Gratuite']].map(([v,l])=>`
            <label class="level-card"><input type="radio" name="f_type_prix" value="${v}" ${(fv('f_type_prix')||'payante')===v?'checked':''} onchange="togglePrix(this)"><span class="level-card-label">${l}</span></label>
          `).join('')}
        </div>
      </div>
      <div class="fg" id="prixGroup">
        <label>Prix de la formation <span class="req">*</span></label>
        <div class="price-group">
          <select id="f_devise">
            ${['XAF (FCFA)','USD ($)','EUR (€)','GBP (£)'].map(d=>`<option value="${d}" ${fv('f_devise')===d?'selected':''}>${d}</option>`).join('')}
          </select>
          <div class="input-wrap" style="flex:1"><span class="input-icon">💵</span>
            <input type="number" id="f_prix" placeholder="Ex : 25000" min="0" value="${fv('f_prix')}">
          </div>
        </div>
      </div>
      <div class="fg">
        <label>Promotion / Réduction <span class="opt">(optionnel)</span></label>
        <div class="input-wrap"><span class="input-icon">🏷️</span>
          <input type="number" id="f_reduction" placeholder="Ex : 20 (pour 20% de réduction)" min="0" max="100" value="${fv('f_reduction')}">
        </div>
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Mode de rémunération</div>
    <div class="radio-cards">
      <label class="radio-card">
        <input type="radio" name="f_remuneration" value="vente" ${(fv('f_remuneration')||'vente')==='vente'?'checked':''}>
        <div class="radio-card-label">
          <div class="rc-icon">💼</div>
          <div class="rc-title">Vente complète</div>
          <div class="rc-desc">Vous percevez 100% du montant de la vente après déduction des frais de plateforme.</div>
        </div>
      </label>
      <label class="radio-card">
        <input type="radio" name="f_remuneration" value="partage" ${fv('f_remuneration')==='partage'?'checked':''}>
        <div class="radio-card-label">
          <div class="rc-icon">🤝</div>
          <div class="rc-title">Partage de revenus</div>
          <div class="rc-desc">Définissez un pourcentage de partage avec la plateforme. Idéal pour les formations co-animées.</div>
        </div>
      </label>
    </div>
    <div class="fg" id="partageGroup" style="${fv('f_remuneration')==='partage'?'':'display:none'};margin-top:1rem">
      <label>Votre part (%) <span class="req">*</span></label>
      <div class="slider-wrap">
        <input type="range" id="f_partage" min="50" max="90" step="5" value="${fv('f_partage')||70}"
          oninput="document.getElementById('partageVal').textContent=this.value+'%'">
        <div class="slider-val" id="partageVal">${fv('f_partage')||70}%</div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('input[name="f_remuneration"]').forEach(r=>{
      r.addEventListener('change',()=>{
        document.getElementById('partageGroup').style.display = r.value==='partage'?'':'none';
      });
    });
    function togglePrix(el){
      document.getElementById('prixGroup').style.display = el.value==='gratuite'?'none':'';
    }
    document.querySelectorAll('input[name="f_type_prix"]').forEach(r=>r.addEventListener('change',()=>togglePrix(r)));
  <\/script>
`;}

/* ══ ÉTAPE 6 : ENGAGEMENT ══ */
function step6(){ return `
  <div class="form-section">
    <div class="form-section-title">Récapitulatif</div>
    <div class="review-section">
      <h3>👤 Formateur</h3>
      <div class="review-grid">
        <div class="review-item"><div class="ri-label">Nom</div><div class="ri-val">${fv('f_nom')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Email</div><div class="ri-val">${fv('f_email')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Domaine</div><div class="ri-val">${fv('f_domaine')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Expérience</div><div class="ri-val">${document.getElementById('expVal')?.textContent||fv('f_exp')||'—'}</div></div>
      </div>
    </div>
    <div class="review-section">
      <h3>📚 Formation</h3>
      <div class="review-grid">
        <div class="review-item"><div class="ri-label">Titre</div><div class="ri-val">${fv('f_titre')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Catégorie</div><div class="ri-val">${fv('f_categorie')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Niveau</div><div class="ri-val">${fv('f_niveau')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Durée totale</div><div class="ri-val">${fv('f_duree_totale')||'—'}</div></div>
        <div class="review-item"><div class="ri-label">Prix</div><div class="ri-val">${fv('f_type_prix')==='gratuite'?'Gratuite':(fv('f_prix')?fv('f_prix')+' '+fv('f_devise'):'—')}</div></div>
        <div class="review-item"><div class="ri-label">Rémunération</div><div class="ri-val">${fv('f_remuneration')||'—'}</div></div>
      </div>
    </div>
  </div>

  <div class="form-section">
    <div class="form-section-title">Engagements obligatoires</div>
    <div class="engage-list">
      <label class="engage-item" id="engage0" onclick="toggleEngage(0)">
        <input type="checkbox" id="chk0">
        <div class="ei-content">
          <div class="ei-title">📝 Originalité du contenu</div>
          <div class="ei-desc">Je certifie que cette formation est originale, créée par mes soins, et ne viole aucun droit d'auteur.</div>
        </div>
      </label>
      <label class="engage-item" id="engage1" onclick="toggleEngage(1)">
        <input type="checkbox" id="chk1">
        <div class="ei-content">
          <div class="ei-title">📋 Conditions de la plateforme</div>
          <div class="ei-desc">J'accepte les <a href="/conditions" style="color:var(--blue)">conditions générales d'utilisation</a> de SkillTract ainsi que la politique de revenus.</div>
        </div>
      </label>
      <label class="engage-item" id="engage2" onclick="toggleEngage(2)">
        <input type="checkbox" id="chk2">
        <div class="ei-content">
          <div class="ei-title">✅ Validation administrative</div>
          <div class="ei-desc">J'autorise l'équipe SkillTract à examiner et valider ma formation avant sa mise en ligne.</div>
        </div>
      </label>
    </div>
  </div>
`;}

/* ══ LOGIQUE TAGS ══ */
function addTag(e, key){
  if(e.key !== 'Enter' && e.key !== ',') return;
  e.preventDefault();
  const inp = document.getElementById('tagsInput_'+key);
  const val = inp.value.trim().replace(/,$/,'');
  if(val && !tags[key].includes(val)){
    tags[key].push(val);
    renderTags(key);
  }
  inp.value = '';
}
function removeTag(key, i){ tags[key].splice(i,1); renderTags(key); }
function renderTags(key){
  const d = document.getElementById('tagsDisplay_'+key);
  if(!d) return;
  d.innerHTML = tags[key].map((t,i)=>
    `<span class="tag">${t}<button class="tag-rm" type="button" onclick="removeTag('${key}',${i})">✕</button></span>`
  ).join('');
}

/* ══ LOGIQUE PLAN ══ */
function renderPlanRows(){
  const list = document.getElementById('planList');
  if(!list) return;
  list.innerHTML = planItems.map((v,i)=>`
    <div class="plan-row" id="planRow_${i}">
      <div class="plan-num">${i+1}</div>
      <input type="text" placeholder="Titre de la leçon ${i+1}…" value="${v}"
        oninput="planItems[${i}]=this.value">
      <button type="button" class="btn-rm-plan" onclick="removePlanRow(${i})" ${planItems.length<=1?'disabled':''}>✕</button>
    </div>
  `).join('');
}
function addPlanRow(){ planItems.push(''); renderPlanRows(); }
function removePlanRow(i){ if(planItems.length>1){ planItems.splice(i,1); renderPlanRows(); } }

/* ══ ENGAGEMENT ══ */
function toggleEngage(i){
  setTimeout(()=>{
    const chk = document.getElementById('chk'+i);
    const box = document.getElementById('engage'+i);
    if(chk.checked) box.classList.add('checked');
    else box.classList.remove('checked');
  },0);
}

/* ══ FORM VALUES ══ */
const formData = {};
function fv(k){ return formData[k]||'' }
function saveCurrentStep(){
  const fields = ['f_nom','f_email','f_tel','f_domaine','f_bio','f_diplomes',
    'f_titre','f_categorie','f_langue','f_desc_courte','f_desc_complete','f_cover','f_video',
    'f_public','f_objectifs','f_nb_lecons','f_duree_lecon','f_duree_totale',
    'f_prix','f_devise','f_reduction','f_partage','f_score_min'];
  fields.forEach(k=>{ const el=document.getElementById(k); if(el) formData[k]=el.value; });
  const radioNames=['f_niveau','f_remuneration','f_type_prix','f_attestation'];
  radioNames.forEach(n=>{ const r=document.querySelector(`input[name="${n}"]:checked`); if(r) formData[n]=r.value; });
  const exp=document.getElementById('f_exp'); if(exp) formData['f_exp']=exp.value;
}

/* ══ SUBMIT ══ */
function submitForm(){
  saveCurrentStep();
  const chks = [0,1,2].map(i=>document.getElementById('chk'+i));
  if(chks.some(c=>!c||!c.checked)){
    showToast('Veuillez cocher les 3 engagements obligatoires.','error'); return;
  }
  showToast('🎉 Formation soumise avec succès ! En attente de validation.','success');
  setTimeout(()=>{ window.location.href='/formateur/dashboard'; },2500);
}

/* ══ TOAST ══ */
function showToast(msg,type='info'){
  const t=document.getElementById('toast');
  t.className='toast '+type; t.textContent=msg; t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),3500);
}

/* ══ PHOTO ══ */
function previewPhoto(input){
  if(!input.files[0]) return;
  const r=new FileReader();
  r.onload=e=>{
    formData['f_photo']=e.target.result;
    const p=document.getElementById('photoPreview');
    if(p) p.innerHTML=`<img src="${e.target.result}" id="photoImg">`;
  };
  r.readAsDataURL(input.files[0]);
}

/* ══ WRAP nextStep pour sauvegarder ══ */
const _nextStep = nextStep;
nextStep = function(){
  saveCurrentStep();
  _nextStep();
};

/* ══ INIT ══ */
render();
</script>
</body>
</html>
