<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Vérification</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Syne+Mono&display=swap" rel="stylesheet">
<style>
    *{

    }
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#0a0e1a;
  --card:#111827;
  --card-border:rgba(255,255,255,.07);
  --blue:#3b82f6;--blue-d:#2563eb;--blue-glow:rgba(59,130,246,.35);
  --green:#22c55e;--green-glow:rgba(34,197,94,.25);
  --red:#ef4444;--red-glow:rgba(239,68,68,.2);
  --white:#fff;
  --muted:rgba(255,255,255,.38);
  --muted2:rgba(255,255,255,.15);
  --font:'Syne',sans-serif;
  --mono:'Syne Mono',monospace;
}
html,body{height:100%;font-family:var(--font);background:var(--bg);color:var(--white);overflow:hidden}

/* ── BACKGROUND ── */
.bg{
  position:fixed;inset:0;z-index:0;
  background:
    radial-gradient(ellipse 60% 50% at 20% 20%, rgba(37,99,235,.18) 0%, transparent 60%),
    radial-gradient(ellipse 50% 40% at 80% 80%, rgba(124,58,237,.12) 0%, transparent 60%),
    #0a0e1a;
}
.bg-grid{
  position:fixed;inset:0;z-index:0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
  background-size:48px 48px;
  mask-image:radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 80%);
}

/* ── LAYOUT ── */
.page{
  position:relative;z-index:1;
  min-height:100vh;display:flex;
  align-items:center;justify-content:center;
  padding:2rem 1rem;
}

/* ── CARD ── */
.card{
  background:rgba(17,24,39,.85);
  border:1px solid var(--card-border);
  border-radius:20px;
  padding:2.8rem 2.6rem;
  width:100%;max-width:420px;
  backdrop-filter:blur(24px);
  box-shadow:0 24px 80px rgba(0,0,0,.4), inset 0 1px 0 rgba(255,255,255,.06);
  animation:slideUp .45s cubic-bezier(.16,1,.3,1);
}
@keyframes slideUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}

/* ── LOGO ── */
.logo-row{display:flex;align-items:center;justify-content:center;gap:.6rem;margin-bottom:2rem}
.logo-mark{
  width:36px;height:36px;background:var(--blue);border-radius:8px;
  display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:.88rem;color:#fff;
  box-shadow:0 0 20px var(--blue-glow);
}
.logo-text{font-weight:800;font-size:1.05rem;color:#fff;letter-spacing:-.2px}
.logo-text span{color:#60a5fa}

/* ── SHIELD ICON ── */
.shield-wrap{text-align:center;margin-bottom:1.6rem}
.shield{
  width:64px;height:64px;border-radius:50%;
  background:linear-gradient(135deg,rgba(59,130,246,.15),rgba(124,58,237,.15));
  border:1.5px solid rgba(59,130,246,.3);
  display:inline-flex;align-items:center;justify-content:center;
  font-size:1.7rem;
  animation:breathe 3s ease-in-out infinite;
  box-shadow:0 0 30px rgba(59,130,246,.15);
}
@keyframes breathe{0%,100%{box-shadow:0 0 20px rgba(59,130,246,.1)}50%{box-shadow:0 0 40px rgba(59,130,246,.3)}}

/* ── HEADING ── */
.heading{text-align:center;margin-bottom:.6rem}
.heading h1{font-size:1.35rem;font-weight:800;color:var(--white);line-height:1.2}
.heading p{font-size:.85rem;color:var(--muted);margin-top:.4rem;line-height:1.6}
.heading .user-email{
  display:inline-block;font-size:.82rem;font-weight:600;
  color:#93c5fd;background:rgba(59,130,246,.12);
  padding:.15rem .65rem;border-radius:99px;margin-top:.3rem;
  border:1px solid rgba(59,130,246,.2);
}

/* ── METHOD TOGGLE ── */
.method-toggle{
  display:flex;gap:.35rem;background:rgba(255,255,255,.04);
  padding:.25rem;border-radius:10px;margin-bottom:1.5rem;
  border:1px solid var(--card-border);
}
.mt-btn{
  flex:1;padding:.42rem;border-radius:7px;border:none;background:transparent;
  font-family:var(--font);font-size:.76rem;font-weight:600;color:var(--muted);
  cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.35rem;
}
.mt-btn.active{background:rgba(59,130,246,.18);color:#93c5fd;border:1px solid rgba(59,130,246,.25)}

/* ── CODE SENT LABEL ── */
.sent-label{
  display:flex;align-items:center;gap:.5rem;
  padding:.6rem .85rem;background:rgba(34,197,94,.08);
  border:1px solid rgba(34,197,94,.2);border-radius:8px;
  font-size:.78rem;color:#86efac;margin-bottom:1.4rem;
}
.sent-dot{width:7px;height:7px;border-radius:50%;background:#22c55e;animation:pulse 2s infinite;flex-shrink:0}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.8)}}

/* ── OTP INPUTS ── */
.otp-label{font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:.75rem;text-align:center}
.otp-wrap{display:flex;gap:.7rem;justify-content:center;margin-bottom:1.5rem}
.otp-input{
  width:52px;height:58px;
  background:rgba(255,255,255,.04);
  border:1.5px solid rgba(255,255,255,.1);
  border-radius:12px;
  font-family:var(--mono);font-size:1.5rem;font-weight:700;
  color:var(--white);text-align:center;outline:none;
  transition:all .2s;caret-color:var(--blue);
  -webkit-appearance:none;
}
.otp-input:focus{
  border-color:var(--blue);
  background:rgba(59,130,246,.08);
  box-shadow:0 0 0 3px var(--blue-glow), inset 0 1px 0 rgba(255,255,255,.05);
  transform:scale(1.05);
}
.otp-input.filled{border-color:rgba(59,130,246,.5);background:rgba(59,130,246,.1);color:#93c5fd}
.otp-input.error{border-color:var(--red);background:rgba(239,68,68,.08);animation:shake .35s ease;color:#fca5a5}
.otp-input.success{border-color:var(--green);background:rgba(34,197,94,.1);color:#86efac}
@keyframes shake{0%,100%{transform:translateX(0)}20%,60%{transform:translateX(-4px)}40%,80%{transform:translateX(4px)}}

/* Séparateur entre 3+3 */
.otp-sep{display:flex;align-items:center;color:var(--muted2);font-size:.9rem;font-weight:700;align-self:center}

/* ── PROGRESS BAR ── */
.otp-progress{height:3px;background:rgba(255,255,255,.06);border-radius:99px;margin-bottom:1.5rem;overflow:hidden}
.otp-progress-fill{height:100%;background:linear-gradient(90deg,var(--blue),#818cf8);border-radius:99px;transition:width .2s ease;width:0%}

/* ── TIMER ── */
.timer-row{display:flex;align-items:center;justify-content:center;gap:.5rem;margin-bottom:1.4rem}
.timer-ring{
  width:40px;height:40px;flex-shrink:0;
}
.timer-ring svg{transform:rotate(-90deg)}
.timer-ring circle.bg{fill:none;stroke:rgba(255,255,255,.06);stroke-width:3}
.timer-ring circle.fg{fill:none;stroke:var(--blue);stroke-width:3;stroke-linecap:round;stroke-dasharray:100;transition:stroke-dashoffset .9s linear,stroke .3s}
.timer-text{font-size:.82rem;color:var(--muted)}
.timer-text strong{font-size:.95rem;font-weight:800;color:var(--white);font-family:var(--mono)}
.timer-text .expired{color:var(--red)}

/* ── SUBMIT BUTTON ── */
.btn-verify{
  width:100%;padding:.85rem;
  background:linear-gradient(135deg,var(--blue),#7c3aed);
  color:#fff;border:none;border-radius:12px;
  font-family:var(--font);font-size:.92rem;font-weight:700;
  cursor:pointer;transition:all .25s;
  box-shadow:0 4px 20px rgba(59,130,246,.35);
  display:flex;align-items:center;justify-content:center;gap:.5rem;
  margin-bottom:1.1rem;position:relative;overflow:hidden;
}
.btn-verify::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.1),transparent);
  border-radius:12px;
}
.btn-verify:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(59,130,246,.5)}
.btn-verify:active{transform:translateY(0)}
.btn-verify:disabled{opacity:.4;cursor:not-allowed;transform:none;box-shadow:none}
.btn-verify.loading{pointer-events:none}
.btn-verify.loading .btn-text{opacity:0}
.btn-verify.loading .spinner{display:flex}
.spinner{display:none;position:absolute;align-items:center;justify-content:center}
.spin{width:20px;height:20px;border:2.5px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:spin .7s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.btn-verify.done{background:linear-gradient(135deg,#16a34a,#15803d);box-shadow:0 4px 20px var(--green-glow)}

/* ── RESEND ── */
.resend-row{text-align:center}
.btn-resend{
  background:none;border:none;font-family:var(--font);font-size:.8rem;
  font-weight:600;cursor:pointer;transition:color .2s;padding:.3rem .5rem;border-radius:6px;
}
.btn-resend:not(:disabled){color:#60a5fa}
.btn-resend:not(:disabled):hover{color:var(--white);background:rgba(59,130,246,.12)}
.btn-resend:disabled{color:var(--muted);cursor:not-allowed}

/* ── ERROR / SUCCESS STATE ── */
.state-msg{
  display:flex;align-items:center;gap:.5rem;
  padding:.6rem .85rem;border-radius:8px;
  font-size:.78rem;font-weight:600;text-align:center;
  margin-bottom:1rem;justify-content:center;
}
.state-msg.error{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#fca5a5}
.state-msg.success{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:#86efac}
.state-msg.hidden{display:none}

/* ── FOOTER LINK ── */
.card-footer{text-align:center;margin-top:1.4rem;border-top:1px solid var(--card-border);padding-top:1.1rem}
.card-footer a{font-size:.78rem;color:var(--muted);text-decoration:none;transition:color .2s;display:inline-flex;align-items:center;gap:.35rem}
.card-footer a:hover{color:#60a5fa}

/* ── SUCCESS OVERLAY ── */
.success-overlay{
  position:fixed;inset:0;z-index:100;
  background:rgba(10,14,26,.95);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem;
  opacity:0;pointer-events:none;transition:opacity .4s;
}
.success-overlay.show{opacity:1;pointer-events:all}
.success-circle{
  width:80px;height:80px;border-radius:50%;
  background:rgba(34,197,94,.15);border:2px solid rgba(34,197,94,.4);
  display:flex;align-items:center;justify-content:center;
  font-size:2rem;
  animation:popIn .5s cubic-bezier(.16,1,.3,1);
  box-shadow:0 0 40px var(--green-glow);
}
@keyframes popIn{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}
.success-title{font-size:1.25rem;font-weight:800;color:var(--white)}
.success-sub{font-size:.85rem;color:var(--muted);margin-top:-.3rem}
.success-redirect{
  display:flex;align-items:center;gap:.4rem;
  font-size:.78rem;color:var(--muted);margin-top:.5rem;
}
.sr-bar{width:120px;height:3px;background:rgba(255,255,255,.1);border-radius:99px;overflow:hidden}
.sr-fill{height:100%;background:var(--green);border-radius:99px;animation:progressBar 3s linear forwards}
@keyframes progressBar{from{width:0}to{width:100%}}
</style>
</head>
<body>
    <form method="POST" action="{{ route('auth.verifyCode') }}">

        <div class="bg"></div>
<div class="bg-grid"></div>

<div class="page">
  <div class="card">

    <!-- Logo -->
    <div class="logo-row">
      <div class="logo-mark">ST</div>
      <div class="logo-text">Skill<span>Tract</span></div>
    </div>

    <!-- Icône bouclier -->
    <div class="shield-wrap">
      <div class="shield" id="shieldIcon">🔐</div>
    </div>

    <!-- Titre -->
    <div class="heading">
      <h1>Vérification en deux étapes</h1>
      <p>Un code de vérification a été envoyé à</p>
      <span class="user-email" id="userEmail">a***@gmail.com</span>
    </div>

    <!-- Toggle méthode -->
    <div class="method-toggle" id="methodToggle">
      <button class="mt-btn active" onclick="switchMethod('email',this)">✉️ Email</button>
      <button class="mt-btn" onclick="switchMethod('sms',this)">📱 SMS</button>
    </div>

    <!-- Envoyé -->
    <div class="sent-label">
      <div class="sent-dot"></div>
      <span id="sentLabel">Code envoyé par email · Valable 5 minutes</span>
    </div>

    <!-- Label OTP -->
    <div class="otp-label">Entrez votre code à 6 chiffres</div>

<div class="bg"></div>
<div class="bg-grid"></div>

<div class="page">
  <div class="card">

    <!-- Logo -->
    <div class="logo-row">
      <div class="logo-mark">ST</div>
      <div class="logo-text">Skill<span>Tract</span></div>
    </div>

    <!-- Icône bouclier -->
    <div class="shield-wrap">
      <div class="shield" id="shieldIcon">🔐</div>
    </div>

    <!-- Titre -->
    <div class="heading">
      <h1>Vérification en deux étapes</h1>
      <p>Un code de vérification a été envoyé à</p>
      <span class="user-email" id="userEmail">a***@gmail.com</span>
    </div>

    <!-- Toggle méthode -->
    <div class="method-toggle" id="methodToggle">
      <button class="mt-btn active" onclick="switchMethod('email',this)">✉️ Email</button>
      <button class="mt-btn" onclick="switchMethod('sms',this)">📱 SMS</button>
    </div>

    <!-- Envoyé -->
    <div class="sent-label">
      <div class="sent-dot"></div>
      <span id="sentLabel">Code envoyé par email · Valable 5 minutes</span>
    </div>

    <!-- Label OTP -->
    <div class="otp-label">Entrez votre code à 6 chiffres</div>

    <!-- Inputs OTP -->
    @csrf
    <div class="otp-wrap">
      <input class="otp-input" type="text" inputmode="numeric" maxlength="1" id="d0" autocomplete="one-time-code">
      <input class="otp-input" type="text" inputmode="numeric" maxlength="1" id="d1">
      <input class="otp-input" type="text" inputmode="numeric" maxlength="1" id="d2">
      <div class="otp-sep">—</div>
      <input class="otp-input" type="text" inputmode="numeric" maxlength="1" id="d3">
      <input class="otp-input" type="text" inputmode="numeric" maxlength="1" id="d4">
      <input class="otp-input" type="text" inputmode="numeric" maxlength="1" id="d5">
    </div>

    <!-- Progress -->
    <div class="otp-progress">
      <div class="otp-progress-fill" id="otpProgress"></div>
    </div>

    <!-- Timer -->
    <div class="timer-row">
      <div class="timer-ring">
        <svg viewBox="0 0 36 36" width="40" height="40">
          <circle class="bg" cx="18" cy="18" r="15.9"/>
          <circle class="fg" cx="18" cy="18" r="15.9" id="timerCircle" stroke-dashoffset="0"/>
        </svg>
      </div>
      <div class="timer-text">
        Code expirant dans <strong id="timerDisplay">5:00</strong>
      </div>
    </div>

    <!-- Message état -->
    <div class="state-msg hidden" id="stateMsg"></div>

    <!-- Bouton vérifier -->
    <button class="btn-verify" id="btnVerify" onclick="verifyCode()" disabled>
      <span class="btn-text">🔓 Vérifier le code</span>
      <div class="spinner"><div class="spin"></div></div>
    </button>

    <!-- Renvoyer -->
    <div class="resend-row">
      <button class="btn-resend" id="btnResend" disabled onclick="resendCode()">
        Renvoyer le code <span id="resendTimer">(5:00)</span>
      </button>
    </div>

    <!-- Footer -->
    <div class="card-footer">
      <a href="#">← Retour à la connexion</a>
    </div>

  </div>
</div>

<!-- Overlay succès -->
<div class="success-overlay" id="successOverlay">
  <div class="success-circle">✅</div>
  <div class="success-title">Identité vérifiée !</div>
  <div class="success-sub">Bienvenue sur SkillTract</div>
  <div class="success-redirect">
    Redirection en cours…
    <div class="sr-bar"><div class="sr-fill"></div></div>
  </div>
</div>

 </form>
<script>
/* ═══════ CONFIG ═══════ */
const VALID_CODE = '123456'; // code de démonstration
const TOTAL_TIME = 300; // 5 minutes en secondes
let timeLeft = TOTAL_TIME;
let timerInterval = null;
let resendTimerInterval = null;
let attempts = 0;
const MAX_ATTEMPTS = 3;
let currentMethod = 'email';

const inputs = Array.from({length:6},(_,i)=>document.getElementById('d'+i));
const btnVerify = document.getElementById('btnVerify');
const stateMsg  = document.getElementById('stateMsg');

/* ═══════ OTP INPUTS ═══════ */
inputs.forEach((inp,i)=>{
  inp.addEventListener('input', e=>{
    const val = e.target.value.replace(/\D/g,'');
    e.target.value = val;
    if(val) inp.classList.add('filled');
    else     inp.classList.remove('filled');

    // Avancer auto
    if(val && i<5) inputs[i+1].focus();

    // Coller depuis presse-papier (6 chiffres)
    updateProgress();
    checkAllFilled();
  });
    // Quand l’utilisateur tape dans les cases, on concatène et met dans le champ caché
    const inputs = document.querySelectorAll('.otp-input');
    const finalCode = document.getElementById('finalCode');

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            let code = '';
            inputs.forEach(i => code += i.value);
            finalCode.value = code;
        });
    });
  inp.addEventListener('keydown', e=>{
    if(e.key==='Backspace' && !inp.value && i>0){
      inputs[i-1].focus();
      inputs[i-1].value='';
      inputs[i-1].classList.remove('filled');
      updateProgress();
      checkAllFilled();
    }
    if(e.key==='ArrowLeft' && i>0) inputs[i-1].focus();
    if(e.key==='ArrowRight' && i<5) inputs[i+1].focus();
  });

  inp.addEventListener('paste', e=>{
    e.preventDefault();
    const paste = (e.clipboardData||window.clipboardData).getData('text').replace(/\D/g,'').slice(0,6);
    if(paste.length===6){
      paste.split('').forEach((c,ci)=>{
        inputs[ci].value=c;
        inputs[ci].classList.add('filled');
      });
      inputs[5].focus();
      updateProgress();
      checkAllFilled();
    }
  });

  // Focus style
  inp.addEventListener('focus',()=>inp.select());
});

function getCode(){ return inputs.map(i=>i.value).join(''); }

function checkAllFilled(){
  const filled = inputs.every(i=>i.value.trim()!=='');
  btnVerify.disabled = !filled;
}

function updateProgress(){
  const count = inputs.filter(i=>i.value).length;
  const pct = count/6*100;
  document.getElementById('otpProgress').style.width = pct+'%';
}

/* ═══════ TIMER ═══════ */
function startTimer(){
  clearInterval(timerInterval);
  clearInterval(resendTimerInterval);
  timeLeft = TOTAL_TIME;
  updateTimerDisplay();

  timerInterval = setInterval(()=>{
    timeLeft--;
    updateTimerDisplay();
    if(timeLeft<=0){
      clearInterval(timerInterval);
      showState('error','⏱ Code expiré. Veuillez en demander un nouveau.');
      btnVerify.disabled = true;
      document.getElementById('btnResend').disabled = false;
      document.getElementById('resendTimer').textContent = '';
    }
  },1000);

  // Resend countdown (même timer)
  let resendLeft = TOTAL_TIME;
  resendTimerInterval = setInterval(()=>{
    resendLeft--;
    const m=Math.floor(resendLeft/60), s=resendLeft%60;
    document.getElementById('resendTimer').textContent = `(${m}:${s.toString().padStart(2,'0')})`;
    if(resendLeft<=0){
      clearInterval(resendTimerInterval);
      document.getElementById('btnResend').disabled = false;
      document.getElementById('resendTimer').textContent = '';
    }
  },1000);
}

function updateTimerDisplay(){
  const m = Math.floor(timeLeft/60);
  const s = timeLeft%60;
  const display = `${m}:${s.toString().padStart(2,'0')}`;
  document.getElementById('timerDisplay').textContent = display;

  // Cercle SVG
  const circle = document.getElementById('timerCircle');
  const pct = timeLeft/TOTAL_TIME;
  const offset = 100 - (pct*100);
  circle.style.strokeDashoffset = offset;

  // Couleur selon urgence
  if(timeLeft<=60)      circle.style.stroke='#ef4444';
  else if(timeLeft<=120) circle.style.stroke='#f59e0b';
  else                   circle.style.stroke='#3b82f6';

  // Texte timer
  const timerTxt = document.querySelector('.timer-text strong');
  if(timeLeft<=60) timerTxt.style.color='#fca5a5';
  else if(timeLeft<=120) timerTxt.style.color='#fcd34d';
  else timerTxt.style.color='var(--white)';
}

/* ═══════ VÉRIFICATION ═══════ */
function verifyCode(){
    const code = getCode();
    if(code.length !== 6) return;

    btnVerify.classList.add('loading');
    inputs.forEach(i => i.disabled = true);

    // ✅ Appel Laravel au lieu de comparer en JS
    fetch('{{ route("auth.verifyCode") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ code: code })
    })
    .then(res => res.json())
    .then(data => {
        btnVerify.classList.remove('loading');
        inputs.forEach(i => i.disabled = false);

        if (data.success) {
            inputs.forEach(i => i.classList.add('success'));
            showState('success', '✅ Identité vérifiée !');
            setTimeout(() => {
                document.getElementById('successOverlay').classList.add('show');
                setTimeout(() => { window.location.href = '{{ route("welcome") }}'; }, 3000);
            }, 600);
        } else {
            attempts++;
            inputs.forEach(i => { i.classList.add('error'); i.value = ''; });
            setTimeout(() => inputs.forEach(i => i.classList.remove('error')), 500);
            showState('error', '❌ ' + data.message);
            inputs[0].focus();
            btnVerify.disabled = true;
            updateProgress();
        }
    });
}

/* ═══════ RENVOYER ═══════ */
function resendCode(){
  const btn = document.getElementById('btnResend');
  btn.disabled=true;
  attempts=0;
  inputs.forEach(i=>{ i.disabled=false; i.value=''; i.classList.remove('filled','error','success'); });
  inputs[0].focus();
  updateProgress();
  btnVerify.disabled=true;
  btnVerify.classList.remove('done');
  btnVerify.querySelector('.btn-text').textContent='🔓 Vérifier le code';
  hideState();

  const method = currentMethod==='email' ? 'email' : 'SMS';
  showState('success',`📤 Nouveau code envoyé par ${method} !`);
  setTimeout(hideState, 3000);
  startTimer();
}

/* ═══════ MÉTHODE ═══════ */
function switchMethod(method, btn){
  currentMethod = method;
  document.querySelectorAll('.mt-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');

  const email = document.getElementById('userEmail');
  const label = document.getElementById('sentLabel');
  if(method==='email'){
    email.textContent='a***@gmail.com';
    label.textContent='Code envoyé par email · Valable 5 minutes';
  } else {
    email.textContent='+237 6** *** 456';
    label.textContent='Code envoyé par SMS · Valable 5 minutes';
  }
}

/* ═══════ STATE MSG ═══════ */
function showState(type, msg){
  stateMsg.className='state-msg '+type;
  stateMsg.textContent=msg;
}
function hideState(){
  stateMsg.className='state-msg hidden';
}

/* ═══════ INIT ═══════ */
startTimer();
setTimeout(()=>inputs[0].focus(),200);

/* Raccourci : Entrée pour vérifier */
document.addEventListener('keydown',e=>{
  if(e.key==='Enter'&&!btnVerify.disabled) verifyCode();
});
</script>
</body>
</html>
