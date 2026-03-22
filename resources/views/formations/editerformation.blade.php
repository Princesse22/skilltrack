<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkillTract – Éditeur de Formation</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Lora:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#2563eb;--blue-d:#1d4ed8;--blue-l:#dbeafe;--blue-xl:#eff6ff;
  --green:#16a34a;--green-l:#dcfce7;--green-d:#15803d;
  --amber:#d97706;--amber-l:#fef3c7;
  --rose:#e11d48;--rose-l:#ffe4e6;
  --violet:#7c3aed;--violet-l:#ede9fe;
  --orange:#ea580c;--orange-l:#ffedd5;
  --teal:#0d9488;--teal-l:#ccfbf1;
  --gray-50:#f9fafb;--gray-100:#f3f4f6;--gray-200:#e5e7eb;
  --gray-300:#d1d5db;--gray-400:#9ca3af;--gray-500:#6b7280;
  --gray-600:#4b5563;--gray-700:#374151;--gray-800:#1f2937;--gray-900:#111827;
  --white:#fff;--ink:#0f172a;
  --r:12px;--r-sm:8px;--r-xs:5px;
  --sh:0 1px 3px rgba(0,0,0,.07),0 2px 8px rgba(0,0,0,.05);
  --sh-md:0 4px 16px rgba(0,0,0,.1);
  --sh-lg:0 12px 40px rgba(0,0,0,.15);
  --font:'Inter',sans-serif;
  --serif:'Lora',serif;
}
html,body{height:100%;font-family:var(--font);background:#f0f2f5;color:var(--gray-800);overflow:hidden}
.app{display:flex;height:100vh;width:100vw;flex-direction:column}

.topbar{height:54px;background:var(--ink);display:flex;align-items:center;padding:0 1.5rem;gap:1rem;flex-shrink:0;z-index:10;position:relative}
.tb-logo{font-weight:800;font-size:1rem;color:#fff;letter-spacing:-.2px}
.tb-logo span{color:#60a5fa}
.tb-sep{width:1px;height:20px;background:rgba(255,255,255,.12)}
.tb-course{font-size:.85rem;font-weight:600;color:rgba(255,255,255,.6)}
.tb-badge{font-size:.62rem;font-weight:700;padding:.15rem .5rem;border-radius:99px;background:rgba(22,163,74,.25);color:#86efac}
.tb-right{margin-left:auto;display:flex;align-items:center;gap:.6rem}
.autosave{font-size:.7rem;color:rgba(255,255,255,.3);display:flex;align-items:center;gap:.3rem}
.dot-pulse{width:6px;height:6px;border-radius:50%;background:#22c55e;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.tbtn{display:inline-flex;align-items:center;gap:.35rem;padding:.4rem .9rem;border-radius:var(--r-sm);font-family:var(--font);font-size:.78rem;font-weight:600;border:none;cursor:pointer;transition:all .18s}
.tbtn.ghost{background:rgba(255,255,255,.08);color:rgba(255,255,255,.65);border:1px solid rgba(255,255,255,.12)}
.tbtn.ghost:hover{background:rgba(255,255,255,.15);color:#fff}
.tbtn.pub{background:var(--green);color:#fff;box-shadow:0 2px 8px rgba(22,163,74,.35)}
.tbtn.pub:hover{background:var(--green-d)}
.tb-prog{display:flex;align-items:center;gap:.5rem}
.tb-prog-track{width:100px;height:5px;background:rgba(255,255,255,.1);border-radius:99px;overflow:hidden}
.tb-prog-fill{height:100%;background:linear-gradient(90deg,#3b82f6,#8b5cf6);border-radius:99px;transition:width .5s}
.tb-prog-pct{font-size:.7rem;color:rgba(255,255,255,.4);font-weight:600}

.body{display:flex;flex:1;overflow:hidden}

/* ═══ SIDEBAR ═══ */
.sidebar{
  width:296px;flex-shrink:0;
  background:var(--white);border-right:1px solid var(--gray-200);
  display:flex;flex-direction:column;
  position:relative;
  /* CRITICAL: overflow visible pour que le dropdown s'affiche au-dessus */
  overflow:visible;
  z-index:100;
}

.sb-hdr{
  padding:.85rem 1rem;border-bottom:1px solid var(--gray-100);
  display:flex;align-items:center;justify-content:space-between;
  flex-shrink:0;background:var(--white);
  position:relative;z-index:101;
}
.sb-hdr-left h2{font-size:.85rem;font-weight:800;color:var(--gray-800)}
.sb-hdr-left p{font-size:.7rem;color:var(--gray-400);margin-top:.1rem}

.btn-add-part{
  display:inline-flex;align-items:center;gap:.3rem;
  padding:.38rem .8rem;background:var(--blue);color:#fff;
  border:none;border-radius:var(--r-sm);font-family:var(--font);
  font-size:.74rem;font-weight:700;cursor:pointer;transition:all .18s;
  box-shadow:0 2px 6px rgba(37,99,235,.3);white-space:nowrap;flex-shrink:0;
}
.btn-add-part:hover{background:var(--blue-d)}

.plan-scroll{
  flex:1;overflow-y:auto;overflow-x:visible;
  padding:.6rem .55rem;
  /* background visible pour que les z-index fonctionnent */
  position:relative;
}
.plan-scroll::-webkit-scrollbar{width:3px}
.plan-scroll::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:99px}

/* Partie */
.partie-block{border:1.5px solid var(--gray-200);border-radius:var(--r);margin-bottom:.55rem;background:var(--white);overflow:visible;position:relative}
.partie-hdr{display:flex;align-items:center;gap:.5rem;padding:.58rem .7rem;background:var(--gray-50);border-radius:var(--r) var(--r) 0 0;cursor:pointer;user-select:none}
.partie-hdr.collapsed{border-radius:var(--r)}
.ph-toggle{font-size:.62rem;color:var(--gray-400);transition:transform .2s;flex-shrink:0}
.partie-hdr.collapsed .ph-toggle{transform:rotate(-90deg)}
.partie-tag{font-size:.58rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;padding:.12rem .42rem;border-radius:99px;background:var(--blue-l);color:var(--blue);flex-shrink:0}
.partie-name{font-size:.8rem;font-weight:700;color:var(--gray-800);flex:1;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.del-icon{width:20px;height:20px;border:none;background:none;cursor:pointer;border-radius:50%;color:var(--gray-300);font-size:.72rem;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0}
.del-icon:hover{background:var(--rose-l);color:var(--rose)}

.partie-body{padding:.4rem .35rem .45rem;border-top:1px solid var(--gray-100)}

/* Leçon item */
.step-item{display:flex;align-items:center;gap:.5rem;padding:.5rem .55rem;border-radius:var(--r-sm);cursor:pointer;transition:all .15s;margin-bottom:.12rem;border:1.5px solid transparent}
.step-item:hover{background:var(--gray-50)}
.step-item.active{background:var(--blue-xl);border-color:var(--blue-l)}
.step-dot{width:20px;height:20px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:800;border:1.5px solid var(--gray-200);color:var(--gray-400);transition:all .2s}
.step-item.active .step-dot{background:var(--blue);border-color:var(--blue);color:#fff}
.step-item.done .step-dot{background:var(--green);border-color:var(--green);color:#fff}
.step-txt{flex:1;min-width:0}
.step-type{font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--blue)}
.step-name{font-size:.78rem;font-weight:600;color:var(--gray-700);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.step-item.active .step-name{color:var(--blue-d);font-weight:700}
.step-del{width:18px;height:18px;border:none;background:none;cursor:pointer;border-radius:50%;color:var(--gray-300);font-size:.68rem;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0;opacity:0}
.step-item:hover .step-del{opacity:1}
.step-del:hover{background:var(--rose-l);color:var(--rose)}

/* Quiz de partie */
.quiz-sep{display:flex;align-items:center;gap:.5rem;padding:.48rem .55rem;border-radius:var(--r-sm);margin-bottom:.12rem;border:1.5px dashed rgba(234,88,12,.25);background:rgba(255,237,213,.4);cursor:pointer;transition:all .15s}
.quiz-sep:hover{border-color:var(--orange)}
.quiz-sep.active{border-style:solid;border-color:var(--orange);background:var(--orange-l)}
.qs-dot{width:20px;height:20px;border-radius:50%;background:var(--orange);display:flex;align-items:center;justify-content:center;font-size:.6rem;color:#fff;font-weight:800;flex-shrink:0}
.quiz-sep.done .qs-dot{background:var(--green)}
.qs-txt{flex:1;min-width:0}
.qs-lbl{font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--orange)}
.qs-name{font-size:.78rem;font-weight:700;color:var(--orange);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}

/* Boutons d'ajout dans partie */
.partie-actions{display:flex;gap:.3rem;padding:.38rem .2rem .05rem;border-top:1px dashed var(--gray-200);margin-top:.35rem;flex-wrap:wrap}
.btn-pa{display:inline-flex;align-items:center;gap:.22rem;padding:.26rem .55rem;border:1px dashed var(--gray-300);background:transparent;border-radius:var(--r-xs);font-family:var(--font);font-size:.69rem;font-weight:600;color:var(--gray-500);cursor:pointer;transition:all .15s}
.btn-pa.l:hover{border-color:var(--blue);color:var(--blue);background:var(--blue-xl)}
.btn-pa.q:hover{border-color:var(--orange);color:var(--orange);background:var(--orange-l)}

/* Quiz Final */
.final-block{border:2px solid rgba(124,58,237,.2);border-radius:var(--r);background:var(--violet-l);margin-bottom:.4rem;cursor:pointer;transition:all .15s;display:flex;align-items:center;gap:.6rem;padding:.62rem .7rem}
.final-block:hover{border-color:var(--violet)}
.final-block.active{border-color:var(--violet);box-shadow:0 0 0 3px rgba(124,58,237,.12)}
.fb-icon{width:28px;height:28px;border-radius:50%;background:var(--violet);display:flex;align-items:center;justify-content:center;font-size:.82rem;color:#fff;flex-shrink:0}
.final-block.done .fb-icon{background:var(--green)}
.fb-txt{flex:1}
.fb-lbl{font-size:.57rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--violet)}
.fb-name{font-size:.8rem;font-weight:700;color:var(--violet)}

.btn-add-final{display:flex;align-items:center;justify-content:center;gap:.45rem;padding:.52rem;border:2px dashed rgba(124,58,237,.28);border-radius:var(--r);background:transparent;font-family:var(--font);font-size:.76rem;font-weight:700;color:var(--violet);cursor:pointer;transition:all .18s;width:100%;margin-bottom:.4rem}
.btn-add-final:hover{border-color:var(--violet);background:var(--violet-l)}

.sb-footer{padding:.6rem .85rem;border-top:1px solid var(--gray-100);flex-shrink:0;background:var(--white)}
.comp-row{display:flex;justify-content:space-between;font-size:.7rem;font-weight:600;color:var(--gray-500);margin-bottom:.3rem}
.comp-row strong{color:var(--blue)}
.comp-track{height:5px;background:var(--gray-100);border-radius:99px;overflow:hidden}
.comp-fill{height:100%;background:linear-gradient(90deg,var(--blue),#8b5cf6);border-radius:99px;transition:width .5s}

/* ═══ EDITOR ═══ */
.editor-area{flex:1;overflow-y:auto;background:#f0f2f5;padding:1.8rem 2rem}
.editor-area::-webkit-scrollbar{width:5px}
.editor-area::-webkit-scrollbar-thumb{background:var(--gray-300);border-radius:99px}
.editor-inner{max-width:700px;margin:0 auto}

.welcome{text-align:center;padding:4rem 2rem}
.w-icon{font-size:3.5rem;margin-bottom:1rem}
.welcome h2{font-family:var(--serif);font-size:1.35rem;color:var(--gray-800);font-weight:600}
.welcome p{font-size:.88rem;color:var(--gray-500);margin:.4rem auto 1.5rem;max-width:380px;line-height:1.7}
.w-actions{display:flex;justify-content:center;gap:.85rem;flex-wrap:wrap}

/* Step header */
.ed-step-hdr{background:var(--white);border-radius:var(--r);padding:1.1rem 1.3rem;margin-bottom:1rem;border:1px solid var(--gray-200);box-shadow:var(--sh)}
.esh-row{display:flex;align-items:center;gap:.75rem;margin-bottom:.8rem}
.esh-ico{width:38px;height:38px;border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0}
.esh-ico.lecon{background:var(--blue-l)}.esh-ico.quiz{background:var(--orange-l)}.esh-ico.final{background:var(--violet-l)}.esh-ico.partie{background:var(--blue-l)}
.esh-meta{flex:1}
.esh-type{font-size:.62rem;font-weight:800;text-transform:uppercase;letter-spacing:1px;margin-bottom:.12rem}
.esh-type.lecon{color:var(--blue)}.esh-type.quiz{color:var(--orange)}.esh-type.final{color:var(--violet)}.esh-type.partie{color:var(--blue)}
.esh-title-inp{width:100%;border:none;outline:none;font-family:var(--serif);font-size:1.15rem;font-weight:600;color:var(--gray-900);background:transparent}
.esh-title-inp::placeholder{color:var(--gray-300)}
.esh-tabs{display:flex;gap:.12rem;background:var(--gray-100);padding:.18rem;border-radius:var(--r-sm);width:fit-content}
.esh-tab{padding:.35rem .85rem;border-radius:var(--r-xs);font-size:.76rem;font-weight:700;color:var(--gray-500);cursor:pointer;border:none;background:transparent;font-family:var(--font);transition:all .15s;display:flex;align-items:center;gap:.3rem}
.esh-tab.on{background:var(--white);color:var(--blue);box-shadow:var(--sh)}
.tc{min-width:14px;height:14px;padding:0 .25rem;background:var(--blue);color:#fff;border-radius:99px;font-size:.57rem;font-weight:800;display:flex;align-items:center;justify-content:center}

/* Section card */
.sec{background:var(--white);border-radius:var(--r);border:1px solid var(--gray-200);box-shadow:var(--sh);margin-bottom:1rem;overflow:hidden}
.sec-hdr{padding:.8rem 1.1rem;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;gap:.6rem}
.sec-ico{width:28px;height:28px;border-radius:var(--r-xs);display:flex;align-items:center;justify-content:center;font-size:.88rem;flex-shrink:0}
.sec-hdr h3{font-size:.86rem;font-weight:800;color:var(--gray-800);flex:1}
.sec-hdr p{font-size:.71rem;color:var(--gray-400);margin-top:.08rem}
.sec-body{padding:1rem 1.1rem}

/* Form */
.fl{display:flex;flex-direction:column;gap:.22rem;margin-bottom:.85rem}
.fl label{font-size:.7rem;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;display:flex;align-items:center;justify-content:space-between}
.fl label small{font-weight:500;color:var(--gray-400);text-transform:none;letter-spacing:0;font-size:.68rem}
.inp{width:100%;padding:.58rem .85rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:var(--font);font-size:.86rem;color:var(--gray-800);background:var(--gray-50);outline:none;transition:border-color .2s,box-shadow .2s}
.inp:focus{border-color:var(--blue);background:var(--white);box-shadow:0 0 0 3px var(--blue-xl)}
.inp::placeholder{color:var(--gray-300)}
.txa{width:100%;padding:.7rem .9rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:var(--font);font-size:.86rem;color:var(--gray-800);background:var(--gray-50);outline:none;line-height:1.7;resize:vertical;transition:border-color .2s,box-shadow .2s}
.txa:focus{border-color:var(--blue);background:var(--white);box-shadow:0 0 0 3px var(--blue-xl)}
.txa::placeholder{color:var(--gray-300)}
.sel{width:100%;padding:.58rem .85rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);font-family:var(--font);font-size:.86rem;color:var(--gray-800);background:var(--gray-50);outline:none;cursor:pointer;transition:border-color .2s}
.sel:focus{border-color:var(--blue)}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}

/* Toolbar */
.rtb{display:flex;gap:.2rem;padding:.42rem .6rem;background:var(--gray-50);border:1.5px solid var(--gray-200);border-bottom:none;border-radius:var(--r-sm) var(--r-sm) 0 0}
.rtb+.txa{border-radius:0 0 var(--r-sm) var(--r-sm)}
.rb{width:26px;height:26px;border:none;background:none;border-radius:var(--r-xs);cursor:pointer;font-size:.78rem;font-weight:700;color:var(--gray-500);display:flex;align-items:center;justify-content:center;transition:all .15s;font-family:var(--font)}
.rb:hover{background:var(--gray-200);color:var(--gray-800)}
.rs{width:1px;height:18px;background:var(--gray-200);margin:0 .18rem;align-self:center}

/* Tutos */
.tuto-row{display:flex;align-items:center;gap:.6rem;padding:.58rem .75rem;background:var(--gray-50);border:1.5px solid var(--gray-200);border-radius:var(--r-sm);margin-bottom:.42rem;transition:border-color .2s}
.tuto-row:hover{border-color:var(--gray-300)}
.tuto-ico{width:30px;height:30px;border-radius:var(--r-xs);display:flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0}
.tuto-inp{flex:1;display:flex;gap:.45rem}
.tuto-inp input{flex:1;padding:.42rem .65rem;border:1.5px solid var(--gray-200);border-radius:var(--r-xs);font-family:var(--font);font-size:.79rem;color:var(--gray-800);outline:none;background:var(--white);transition:border-color .2s}
.tuto-inp input:focus{border-color:var(--blue)}
.del-btn{width:24px;height:24px;border:none;background:none;cursor:pointer;border-radius:50%;color:var(--gray-300);font-size:.75rem;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0}
.del-btn:hover{background:var(--rose-l);color:var(--rose)}

.btn-add{display:inline-flex;align-items:center;gap:.35rem;padding:.36rem .8rem;border:1.5px dashed var(--gray-300);background:transparent;border-radius:var(--r-sm);font-family:var(--font);font-size:.76rem;font-weight:600;color:var(--gray-500);cursor:pointer;transition:all .15s;margin-top:.4rem}
.btn-add:hover{border-color:var(--blue);color:var(--blue);background:var(--blue-xl)}
.btn-add.org:hover{border-color:var(--orange);color:var(--orange);background:var(--orange-l)}

/* Upload */
.uz{border:2px dashed var(--gray-200);border-radius:var(--r-sm);padding:1.1rem;text-align:center;cursor:pointer;background:var(--gray-50);transition:all .2s}
.uz:hover{border-color:var(--blue);background:var(--blue-xl)}
.uz.filled{border-color:var(--green);background:var(--green-l)}
.uz input{display:none}

/* Info box */
.infobox{padding:.58rem .85rem;border-radius:var(--r-sm);display:flex;align-items:flex-start;gap:.5rem;font-size:.76rem;font-weight:500;margin-bottom:.85rem;line-height:1.5}
.infobox.blue{background:var(--blue-xl);color:var(--blue);border:1px solid rgba(37,99,235,.15)}
.infobox.green{background:var(--green-l);color:var(--green-d);border:1px solid rgba(22,163,74,.15)}
.infobox.orange{background:var(--orange-l);color:var(--orange);border:1px solid rgba(234,88,12,.18)}

/* Buttons */
.btn{display:inline-flex;align-items:center;gap:.38rem;padding:.5rem 1.1rem;border-radius:var(--r-sm);font-family:var(--font);font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .18s}
.btn-prim{background:var(--blue);color:#fff;box-shadow:0 2px 8px rgba(37,99,235,.3)}
.btn-prim:hover{background:var(--blue-d);transform:translateY(-1px)}
.btn-ghost{background:transparent;color:var(--gray-600);border:1.5px solid var(--gray-200)}
.btn-ghost:hover{border-color:var(--gray-400);color:var(--gray-800)}
.btn-next{background:linear-gradient(135deg,var(--blue),#7c3aed);color:#fff;box-shadow:0 3px 12px rgba(37,99,235,.3)}
.btn-next:hover{transform:translateY(-1px)}
.btn-oran{background:var(--orange);color:#fff}
.btn-oran:hover{background:#c2410c}
.btn-viol{background:var(--violet);color:#fff}
.btn-viol:hover{background:#6d28d9}
.action-bar{display:flex;align-items:center;justify-content:flex-end;gap:.6rem;margin-top:.3rem;margin-bottom:1rem}

/* Quiz question */
.qq{background:var(--white);border:1.5px solid var(--gray-200);border-radius:var(--r);margin-bottom:.82rem;overflow:hidden;box-shadow:var(--sh)}
.qq-hdr{padding:.65rem .9rem;background:var(--gray-50);border-bottom:1px solid var(--gray-200);display:flex;align-items:center;gap:.6rem}
.qq-n{width:24px;height:24px;border-radius:50%;background:var(--orange);color:#fff;font-size:.66rem;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.qq-n.viol{background:var(--violet)}
.qq-lbl{font-size:.8rem;font-weight:700;color:var(--gray-700);flex:1}
.qq-del{width:22px;height:22px;border:none;background:none;cursor:pointer;border-radius:50%;color:var(--gray-400);font-size:.76rem;display:flex;align-items:center;justify-content:center;transition:all .15s}
.qq-del:hover{background:var(--rose-l);color:var(--rose)}
.qq-body{padding:.82rem .9rem}
.qq-opts{margin-top:.62rem;display:flex;flex-direction:column;gap:.36rem}
.qq-opt{display:flex;align-items:center;gap:.52rem;padding:.45rem .68rem;border:1.5px solid var(--gray-200);border-radius:var(--r-sm);background:var(--gray-50);transition:all .18s}
.qq-opt.correct{border-color:var(--green);background:var(--green-l)}
.qq-opt input[type="text"]{flex:1;border:none;background:transparent;font-family:var(--font);font-size:.82rem;color:var(--gray-800);outline:none}
.opt-check{width:18px;height:18px;border-radius:50%;border:2px solid var(--gray-300);display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:all .18s;font-size:.62rem;background:var(--white)}
.qq-opt.correct .opt-check{border-color:var(--green);background:var(--green);color:#fff}
.opt-del{width:20px;height:20px;border:none;background:none;cursor:pointer;border-radius:50%;color:var(--gray-300);font-size:.7rem;display:flex;align-items:center;justify-content:center;transition:all .15s;flex-shrink:0}
.opt-del:hover{background:var(--rose-l);color:var(--rose)}
.btn-add-opt{display:inline-flex;align-items:center;gap:.3rem;padding:.28rem .68rem;border:1.5px dashed var(--gray-200);background:transparent;border-radius:var(--r-sm);font-family:var(--font);font-size:.71rem;font-weight:600;color:var(--gray-400);cursor:pointer;transition:all .15s;margin-top:.3rem}
.btn-add-opt:hover{border-color:var(--orange);color:var(--orange);background:var(--orange-l)}
.btn-add-opt.viol:hover{border-color:var(--violet);color:var(--violet);background:var(--violet-l)}

.toast{position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;padding:.65rem 1.15rem;border-radius:var(--r-sm);font-size:.84rem;font-weight:600;transform:translateY(60px);opacity:0;transition:all .28s;display:flex;align-items:center;gap:.5rem;box-shadow:var(--sh-lg)}
.toast.show{transform:translateY(0);opacity:1}
.toast.success{background:var(--green);color:#fff}
.toast.info{background:var(--ink);color:#fff}
.toast.warn{background:var(--orange);color:#fff}

@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.fade{animation:fadeUp .28s ease}
</style>
</head>
<body>
<div class="app">

<div class="topbar">
  <div class="tb-logo">Skill<span>Tract</span></div>
  <div class="tb-sep"></div>
  <div class="tb-course">Marketing Digital Complet</div>
  <span class="tb-badge">✅ Validée</span>
  <div class="tb-right">
    <div class="autosave"><div class="dot-pulse"></div>Brouillon sauvegardé</div>
    <div class="tb-prog">
      <div class="tb-prog-track"><div class="tb-prog-fill" id="tbFill" style="width:0%"></div></div>
      <span class="tb-prog-pct" id="tbPct">0%</span>
    </div>
    <button class="tbtn ghost" onclick="saveAll()">💾 Sauvegarder</button>
    <button class="tbtn pub" onclick="publishAll()">🚀 Publier</button>
  </div>
</div>

<div class="body">
  <aside class="sidebar">
    <div class="sb-hdr">
      <div class="sb-hdr-left">
        <h2>Structure du cours</h2>
        <p id="sbCount">Aucune étape</p>
      </div>
      <button class="btn-add-part" onclick="addPartie()">＋ Partie</button>
    </div>
    <div class="plan-scroll" id="planScroll">
      <div id="planContent"></div>
      <div id="finalZone"></div>
    </div>
    <div class="sb-footer">
      <div class="comp-row"><span>Progression</span><strong id="sbPct">0%</strong></div>
      <div class="comp-track"><div class="comp-fill" id="sbFill" style="width:0%"></div></div>
    </div>
  </aside>

  <div class="editor-area">
    <div class="editor-inner">
      <div class="welcome" id="welcomeState">
        <div class="w-icon">✏️</div>
        <h2>Éditeur de formation</h2>
        <p>Structurez votre formation en <strong>parties</strong>. Chaque partie contient des <strong>leçons</strong> et se termine par un <strong>quiz</strong>. Un <strong>quiz final</strong> valide l'ensemble.</p>
        <div class="w-actions">
          <button class="btn btn-prim" onclick="addPartie()">📂 Ajouter une partie</button>
          <button class="btn btn-ghost" onclick="addFinalQuiz()">🏆 Ajouter le quiz final</button>
        </div>
      </div>
      <div id="editorContent" style="display:none"></div>
    </div>
  </div>
</div>
</div>
<div class="toast" id="toast"></div>

<script>
let parties=[],finalQuiz=null,selected=null,pid=0,sid=0;

function toast(msg,type='success'){
  const t=document.getElementById('toast');
  t.className='toast '+type;
  t.textContent=(type==='success'?'✅':type==='warn'?'⚠️':'ℹ️')+' '+msg;
  t.classList.add('show');setTimeout(()=>t.classList.remove('show'),3000);
}

function updateProgress(){
  let total=0,done=0;
  parties.forEach(p=>{
    p.steps.forEach(s=>{total++;if(s.filled)done++;});
    if(p.quiz){total++;if(p.quiz.filled)done++;}
  });
  if(finalQuiz){total++;if(finalQuiz.filled)done++;}
  const pct=total?Math.round(done/total*100):0;
  document.getElementById('tbFill').style.width=pct+'%';
  document.getElementById('tbPct').textContent=pct+'%';
  document.getElementById('sbFill').style.width=pct+'%';
  document.getElementById('sbPct').textContent=pct+'%';
  let steps2=0;parties.forEach(p=>{steps2+=p.steps.length+(p.quiz?1:0);});if(finalQuiz)steps2++;
  document.getElementById('sbCount').textContent=parties.length+' partie'+(parties.length!==1?'s':'')+' · '+steps2+' étape'+(steps2!==1?'s':'');
}

function renderSidebar(){
  updateProgress();
  const pc=document.getElementById('planContent'),fz=document.getElementById('finalZone');
  if(!parties.length){
    pc.innerHTML='<div style="text-align:center;padding:2rem 1rem;color:var(--gray-400)"><div style="font-size:2rem;margin-bottom:.5rem">📋</div><div style="font-size:.78rem;font-weight:600">Cliquez sur "＋ Partie"</div><div style="font-size:.7rem;margin-top:.2rem">pour commencer</div></div>';
  } else {
    let lg=0;
    pc.innerHTML=parties.map((p,pi)=>{
      let items='';
      p.steps.forEach(s=>{
        lg++;
        const isA=selected?.type==='lecon'&&selected.stepId===s.id;
        items+=`<div class="step-item ${isA?'active':''} ${s.filled?'done':''}" onclick="selectLecon(${p.id},${s.id})">
          <div class="step-dot">${s.filled?'✓':'L'+lg}</div>
          <div class="step-txt"><div class="step-type">Leçon</div><div class="step-name">${s.title||'Leçon sans titre'}</div></div>
          <button class="step-del" onclick="event.stopPropagation();removeLecon(${p.id},${s.id})">✕</button>
        </div>`;
      });
      let qHtml='';
      if(p.quiz){
        const qA=selected?.type==='quiz'&&selected.partieId===p.id;
        qHtml=`<div class="quiz-sep ${qA?'active':''} ${p.quiz.filled?'done':''}" onclick="selectQuizPartie(${p.id})">
          <div class="qs-dot">${p.quiz.filled?'✓':'Q'}</div>
          <div class="qs-txt"><div class="qs-lbl">Quiz</div><div class="qs-name">${p.quiz.title||'Quiz Partie '+(pi+1)}</div></div>
          <button class="del-btn" style="opacity:.6" onclick="event.stopPropagation();removeQuizPartie(${p.id})" title="Supprimer">✕</button>
        </div>`;
      }
      const hasQ=!!p.quiz;
      return `<div class="partie-block">
        <div class="partie-hdr ${p.collapsed?'collapsed':''}" onclick="togglePartie(${p.id})">
          <span class="ph-toggle">▾</span>
          <span class="partie-tag">Partie ${pi+1}</span>
          <span class="partie-name">${p.title||'Partie sans titre'}</span>
          <button class="del-icon" onclick="event.stopPropagation();removePartie(${p.id})">✕</button>
        </div>
        ${p.collapsed?'':
          `<div class="partie-body">${items}${qHtml}
          <div class="partie-actions">
            <button class="btn-pa l" onclick="addLecon(${p.id})">📖 + Leçon</button>
            ${hasQ?'':'<button class="btn-pa q" onclick="addQuizPartie('+p.id+')">📝 + Quiz</button>'}
          </div></div>`}
      </div>`;
    }).join('');
  }
  if(finalQuiz){
    const fA=selected?.type==='final';
    fz.innerHTML=`<div class="final-block ${fA?'active':''} ${finalQuiz.filled?'done':''}" onclick="selectFinal()">
      <div class="fb-icon">${finalQuiz.filled?'✓':'🏆'}</div>
      <div class="fb-txt"><div class="fb-lbl">Quiz Final</div><div class="fb-name">${finalQuiz.title||'Quiz Final de validation'}</div></div>
    </div>`;
  } else {
    fz.innerHTML=`<button class="btn-add-final" onclick="addFinalQuiz()">🏆 Ajouter le Quiz Final</button>`;
  }
}

function addPartie(){pid++;parties.push({id:pid,title:'',collapsed:false,steps:[],quiz:null});renderSidebar();selectPartie(pid);}
function removePartie(id){parties=parties.filter(p=>p.id!==id);if(selected?.partieId===id)clearEditor();renderSidebar();toast('Partie supprimée','info');}
function togglePartie(id){const p=parties.find(p=>p.id===id);if(p)p.collapsed=!p.collapsed;renderSidebar();}
function addLecon(partieId){sid++;const p=parties.find(p=>p.id===partieId);p.steps.push({id:sid,title:'',filled:false,data:{}});p.collapsed=false;renderSidebar();selectLecon(partieId,sid);}
function removeLecon(partieId,stepId){const p=parties.find(p=>p.id===partieId);p.steps=p.steps.filter(s=>s.id!==stepId);if(selected?.stepId===stepId)clearEditor();renderSidebar();toast('Leçon supprimée','info');}
function addQuizPartie(partieId){const p=parties.find(p=>p.id===partieId);if(p.quiz)return;p.quiz={title:'',filled:false,data:{questions:[]}};p.collapsed=false;renderSidebar();selectQuizPartie(partieId);}
function removeQuizPartie(partieId){const p=parties.find(p=>p.id===partieId);p.quiz=null;if(selected?.type==='quiz'&&selected.partieId===partieId)clearEditor();renderSidebar();toast('Quiz supprimé','info');}
function addFinalQuiz(){finalQuiz={title:'Quiz Final',filled:false,data:{questions:[]}};renderSidebar();selectFinal();}

function selectPartie(id){selected={type:'partie',partieId:id};renderSidebar();const p=parties.find(p=>p.id===id);renderPartieEditor(p);}
function selectLecon(partieId,stepId){const p=parties.find(p=>p.id===partieId),s=p.steps.find(s=>s.id===stepId);selected={type:'lecon',partieId,stepId};renderSidebar();renderLeconEditor(p,s);}
function selectQuizPartie(partieId){const p=parties.find(p=>p.id===partieId);selected={type:'quiz',partieId};renderSidebar();renderQuizEditor(p.quiz,'quiz',partieId);}
function selectFinal(){selected={type:'final'};renderSidebar();renderQuizEditor(finalQuiz,'final',null);}
function clearEditor(){selected=null;document.getElementById('welcomeState').style.display='';document.getElementById('editorContent').style.display='none';renderSidebar();}

function showEd(html){
  document.getElementById('welcomeState').style.display='none';
  const ec=document.getElementById('editorContent');
  ec.style.display='block';ec.innerHTML='<div class="fade">'+html+'</div>';
}

function renderPartieEditor(p){
  const pi=parties.indexOf(p);
  showEd(`
  <div class="ed-step-hdr">
    <div class="esh-row">
      <div class="esh-ico partie">📂</div>
      <div class="esh-meta">
        <div class="esh-type partie">Partie ${pi+1}</div>
        <input class="esh-title-inp" id="pTitle" placeholder="Titre de la partie…" value="${p.title}" oninput="updPartieTitle(${p.id},this.value)">
      </div>
    </div>
  </div>
  <div class="sec">
    <div class="sec-hdr"><div class="sec-ico" style="background:var(--blue-l)">📝</div><div><h3>Description de la partie</h3><p>Optionnel</p></div></div>
    <div class="sec-body">
      <div class="fl"><label>Description</label><textarea class="txa" id="pDesc" rows="3" placeholder="Cette partie aborde…">${p.data?.desc||''}</textarea></div>
      <div class="fl"><label>Objectifs</label><textarea class="txa" id="pObj" rows="3" placeholder="À la fin, l'apprenant sera capable de…">${p.data?.objectifs||''}</textarea></div>
    </div>
  </div>
  <div class="infobox blue">ℹ️ Ajoutez des <strong>leçons</strong> et un <strong>quiz</strong> via la barre latérale gauche ("📖 + Leçon" / "📝 + Quiz").</div>
  <div style="display:flex;gap:.75rem;flex-wrap:wrap">
    <button class="btn btn-prim" onclick="savePartie(${p.id})">💾 Sauvegarder</button>
    <button class="btn btn-ghost" onclick="addLecon(${p.id})">📖 Ajouter une leçon</button>
    ${p.quiz?`<button class="btn btn-ghost" onclick="selectQuizPartie(${p.id})">📝 Voir le quiz</button>`:`<button class="btn btn-ghost" onclick="addQuizPartie(${p.id})">📝 Ajouter un quiz</button>`}
  </div>`);
}

function renderLeconEditor(p,s){
  const lg=parties.slice(0,parties.indexOf(p)).reduce((a,pp)=>a+pp.steps.length,0)+p.steps.indexOf(s)+1;
  const d=s.data;
  showEd(`
  <div class="ed-step-hdr">
    <div class="esh-row">
      <div class="esh-ico lecon">📖</div>
      <div class="esh-meta">
        <div class="esh-type lecon">Leçon ${lg} — ${p.title||'Partie'}</div>
        <input class="esh-title-inp" id="lTitle" placeholder="Titre de la leçon…" value="${s.title}" oninput="updLeconTitle(${p.id},${s.id},this.value)">
      </div>
    </div>
    <div class="esh-tabs">
      <button class="esh-tab on" onclick="swTab(this,'cours')">📖 Cours</button>
      <button class="esh-tab" onclick="swTab(this,'tutos')">🎥 Tutoriels <span class="tc" id="tutoCount">${(d.tutos||[]).length}</span></button>
      <button class="esh-tab" onclick="swTab(this,'exercice')">✏️ Exercice</button>
      <button class="esh-tab" onclick="swTab(this,'correction')">👁 Correction</button>
    </div>
  </div>

  <div id="tab-cours">
    <div class="sec">
      <div class="sec-hdr"><div class="sec-ico" style="background:var(--blue-l)">📝</div><div><h3>Contenu du cours</h3></div></div>
      <div class="sec-body">
        <div class="fl"><label>Introduction <small>optionnel</small></label><input class="inp" id="lIntro" placeholder="Phrase d'accroche…" value="${d.intro||''}"></div>
        <div class="fl">
          <label>Contenu principal <small id="cCount">0 car.</small></label>
          <div class="rtb"><button class="rb"><b>B</b></button><button class="rb"><i>I</i></button><button class="rb"><u>U</u></button><div class="rs"></div><button class="rb">•</button><button class="rb">1.</button><button class="rb">H</button><div class="rs"></div><button class="rb">❝</button><button class="rb">🔗</button></div>
          <textarea class="txa" id="lContent" rows="9" placeholder="Contenu de la leçon…" oninput="document.getElementById('cCount').textContent=this.value.length+' car.'">${d.content||''}</textarea>
        </div>
        <div class="row2">
          <div class="fl" style="margin:0"><label>Durée</label><select class="sel" id="lDur">${['15 min','30 min','45 min','1h','1h30','2h'].map(v=>`<option ${(d.duration||'30 min')===v?'selected':''}>${v}</option>`).join('')}</select></div>
          <div class="fl" style="margin:0"><label>Niveau</label><select class="sel" id="lLvl"><option>Facile</option><option>Moyen</option><option>Difficile</option></select></div>
        </div>
      </div>
    </div>
    <div class="action-bar">
      <button class="btn btn-ghost" onclick="swTabN('tutos')">Suivant →</button>
      <button class="btn btn-prim" onclick="saveCours(${p.id},${s.id})">💾 Sauvegarder</button>
    </div>
  </div>

  <div id="tab-tutos" style="display:none">
    <div class="sec">
      <div class="sec-hdr"><div class="sec-ico" style="background:var(--orange-l)">🎥</div><div><h3>Tutoriels & Ressources</h3></div></div>
      <div class="sec-body">
        <div class="infobox blue">ℹ️ Vidéos YouTube/Vimeo, PDFs, liens externes.</div>
        <div id="tutoList_${p.id}_${s.id}"></div>
        <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.45rem">
          <button class="btn-add" onclick="addTuto(${p.id},${s.id},'video')">▶️ Vidéo</button>
          <button class="btn-add" onclick="addTuto(${p.id},${s.id},'pdf')">📄 PDF</button>
          <button class="btn-add" onclick="addTuto(${p.id},${s.id},'lien')">🔗 Lien</button>
        </div>
      </div>
    </div>
    <div class="action-bar">
      <button class="btn btn-ghost" onclick="swTabN('cours')">← Cours</button>
      <button class="btn btn-prim" onclick="toast('Tutoriels sauvegardés !')">💾 Sauvegarder</button>
      <button class="btn btn-ghost" onclick="swTabN('exercice')">Suivant →</button>
    </div>
  </div>

  <div id="tab-exercice" style="display:none">
    <div class="sec">
      <div class="sec-hdr"><div class="sec-ico" style="background:var(--violet-l)">✏️</div><div><h3>Exercice pratique</h3></div></div>
      <div class="sec-body">
        <div class="infobox orange">⚠️ L'apprenant doit soumettre son travail pour débloquer la correction.</div>
        <div class="fl"><label>Titre</label><input class="inp" id="exTitle" placeholder="Titre de l'exercice…" value="${d.exTitle||''}"></div>
        <div class="fl"><label>Énoncé <small id="exCount">0 car.</small></label>
          <div class="rtb"><button class="rb"><b>B</b></button><button class="rb">•</button><button class="rb">1.</button></div>
          <textarea class="txa" id="exContent" rows="7" placeholder="Décrivez ce que l'apprenant doit faire…" oninput="document.getElementById('exCount').textContent=this.value.length+' car.'">${d.exContent||''}</textarea>
        </div>
        <div class="row2">
          <div class="fl" style="margin:0"><label>Type de rendu</label><select class="sel" id="exType"><option>Texte rédigé</option><option>Fichier (Word/PDF)</option><option>Texte + Fichier</option><option>Lien URL</option></select></div>
          <div class="fl" style="margin:0"><label>Note max.</label><input class="inp" id="exScore" type="number" min="5" max="100" value="${d.exScore||20}"></div>
        </div>
        <div class="fl" style="margin-top:.75rem"><label>Critères <small>optionnel</small></label><textarea class="txa" id="exCrit" rows="3" placeholder="• Clarté : 5 pts&#10;• Pertinence : 5 pts…">${d.exCrit||''}</textarea></div>
      </div>
    </div>
    <div class="action-bar">
      <button class="btn btn-ghost" onclick="swTabN('tutos')">← Tutoriels</button>
      <button class="btn btn-prim" onclick="saveEx(${p.id},${s.id})">💾 Sauvegarder</button>
      <button class="btn btn-ghost" onclick="swTabN('correction')">Suivant →</button>
    </div>
  </div>

  <div id="tab-correction" style="display:none">
    <div class="sec">
      <div class="sec-hdr"><div class="sec-ico" style="background:var(--green-l)">👁</div><div><h3>Correction type</h3><p>Visible après soumission du devoir</p></div></div>
      <div class="sec-body">
        <div class="infobox green">✅ L'apprenant ne voit cette correction qu'après avoir soumis son travail.</div>
        <div class="fl"><label>Corrigé <small id="corrCount">0 car.</small></label>
          <div class="rtb"><button class="rb"><b>B</b></button><button class="rb"><i>I</i></button><button class="rb">•</button><div class="rs"></div><button class="rb">✅</button><button class="rb">❌</button></div>
          <textarea class="txa" id="corrContent" rows="8" placeholder="Rédigez la correction modèle…" oninput="document.getElementById('corrCount').textContent=this.value.length+' car.'">${d.corrContent||''}</textarea>
        </div>
        <div class="fl"><label>Fichier <small>optionnel</small></label>
          <div class="uz" onclick="this.querySelector('input').click()">
            <input type="file" accept=".pdf,.doc,.docx" onchange="handleFile(this,${p.id},${s.id})">
            <div style="font-size:1.5rem;margin-bottom:.3rem">📎</div>
            <div style="font-size:.8rem;color:var(--gray-500)"><strong>Cliquez</strong> pour joindre un PDF ou Word</div>
          </div>
        </div>
      </div>
    </div>
    <div class="action-bar">
      <button class="btn btn-ghost" onclick="swTabN('exercice')">← Exercice</button>
      <button class="btn btn-prim" onclick="saveCorr(${p.id},${s.id})">💾 Sauvegarder</button>
      <button class="btn btn-next" onclick="markLeconDone(${p.id},${s.id})">✅ Valider la leçon →</button>
    </div>
  </div>`);
  renderTutos(p.id,s.id);
}

function renderQuizEditor(quiz,type,partieId){
  const isFinal=type==='final';
  const pi=partieId?parties.findIndex(p=>p.id===partieId):-1;
  const qs=quiz.data?.questions||[];
  showEd(`
  <div class="ed-step-hdr">
    <div class="esh-row">
      <div class="esh-ico ${isFinal?'final':'quiz'}">${isFinal?'🏆':'📝'}</div>
      <div class="esh-meta">
        <div class="esh-type ${isFinal?'final':'quiz'}">${isFinal?'Quiz Final':'Quiz — '+(pi>=0?'Partie '+(pi+1):'')}</div>
        <input class="esh-title-inp" id="qTitle" placeholder="${isFinal?'Quiz Final…':'Titre du quiz…'}" value="${quiz.title}" oninput="updQuizTitle('${type}',${partieId||0},this.value)">
      </div>
    </div>
  </div>
  <div class="infobox ${isFinal?'orange':'blue'}">${isFinal?'🏆 Valide la formation entière. Score minimum : 70%.':'📝 Évalue les leçons de cette partie.'}</div>
  <div class="sec" style="margin-bottom:.85rem">
    <div class="sec-hdr"><div class="sec-ico" style="background:var(--gray-100)">⚙️</div><div><h3>Paramètres</h3></div></div>
    <div class="sec-body">
      <div class="row2">
        <div class="fl" style="margin:0"><label>Score requis (%)</label><input class="inp" type="number" id="qScore" min="50" max="100" value="${quiz.data?.passScore||70}"></div>
        <div class="fl" style="margin:0"><label>Durée limite <small>optionnel</small></label><input class="inp" type="number" id="qDur" placeholder="min. — sans limite" value="${quiz.data?.duration||''}"></div>
      </div>
      <div class="fl" style="margin-top:.75rem;margin-bottom:0"><label>Instructions <small>optionnel</small></label><textarea class="txa" id="qInstr" rows="2" placeholder="Une seule réponse correcte…">${quiz.data?.instructions||''}</textarea></div>
    </div>
  </div>
  <div class="sec">
    <div class="sec-hdr"><div class="sec-ico" style="background:${isFinal?'var(--violet-l)':'var(--orange-l)'}">${isFinal?'🏆':'📝'}</div><div><h3>Questions</h3><p id="qCount">${qs.length} question${qs.length!==1?'s':''}</p></div></div>
    <div class="sec-body">
      <div id="qList_${type}_${partieId||0}"></div>
      <button class="btn-add ${isFinal?'':'org'}" onclick="addQ('${type}',${partieId||0})">＋ Ajouter une question</button>
    </div>
  </div>
  <div class="action-bar">
    <div style="font-size:.74rem;color:var(--gray-400)"><span id="qFilled">0</span>/${qs.length} questions complètes</div>
    <button class="btn btn-ghost" onclick="saveQuiz('${type}',${partieId||0})">💾 Sauvegarder</button>
    <button class="btn ${isFinal?'btn-viol':'btn-oran'}" onclick="markQuizDone('${type}',${partieId||0})">✅ Valider le quiz →</button>
  </div>`);
  renderQs(type,partieId||0);
}

function getQuiz(type,partieId){if(type==='final')return finalQuiz;const p=parties.find(p=>p.id===partieId);return p?.quiz;}

function renderQs(type,partieId){
  const quiz=getQuiz(type,partieId);if(!quiz)return;
  const qs=quiz.data?.questions||[];const isFinal=type==='final';
  const c=document.getElementById('qList_'+type+'_'+partieId);if(!c)return;
  if(!qs.length){c.innerHTML='<div style="text-align:center;padding:1.1rem;color:var(--gray-400);font-size:.8rem;background:var(--gray-50);border-radius:var(--r-sm);border:1.5px dashed var(--gray-200)">Aucune question. Cliquez sur "Ajouter une question".</div>';return;}
  c.innerHTML=qs.map((q,qi)=>`
    <div class="qq">
      <div class="qq-hdr"><div class="qq-n ${isFinal?'viol':''}">${qi+1}</div><div class="qq-lbl">Question ${qi+1}</div><button class="qq-del" onclick="removeQ('${type}',${partieId},${qi})">✕</button></div>
      <div class="qq-body">
        <textarea class="txa" rows="2" style="min-height:58px" placeholder="Rédigez votre question…" oninput="updQ('${type}',${partieId},${qi},'text',this.value)">${q.text||''}</textarea>
        <div style="font-size:.69rem;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin:.58rem 0 .38rem;display:flex;justify-content:space-between">
          <span>Options — cochez la bonne réponse ✅</span>
          <span style="font-weight:500;text-transform:none;color:${q.correct!==undefined?'var(--green-d)':'var(--amber)'}">${q.correct!==undefined?'✅ Définie':'⚠️ À définir'}</span>
        </div>
        <div class="qq-opts">${(q.options||['','']).map((opt,oi)=>`
          <div class="qq-opt ${q.correct===oi?'correct':''}">
            <div class="opt-check" onclick="setCorrect('${type}',${partieId},${qi},${oi})">${q.correct===oi?'✓':''}</div>
            <input type="text" placeholder="Option ${String.fromCharCode(65+oi)}…" value="${opt}" oninput="updOpt('${type}',${partieId},${qi},${oi},this.value)">
            <button class="opt-del" onclick="removeOpt('${type}',${partieId},${qi},${oi})">✕</button>
          </div>`).join('')}
        </div>
        <button class="btn-add-opt ${isFinal?'viol':''}" onclick="addOpt('${type}',${partieId},${qi})">＋ Option</button>
      </div>
    </div>`).join('');
  const p=document.getElementById('qCount');if(p)p.textContent=qs.length+' question'+(qs.length!==1?'s':'');
  const f=document.getElementById('qFilled');if(f)f.textContent=qs.filter(q=>q.text&&q.correct!==undefined&&(q.options||[]).filter(o=>o).length>=2).length;
}

function addQ(type,partieId){const quiz=getQuiz(type,partieId);if(!quiz.data)quiz.data={};if(!quiz.data.questions)quiz.data.questions=[];quiz.data.questions.push({text:'',options:['','','',''],correct:undefined});renderQs(type,partieId);}
function removeQ(type,partieId,qi){const quiz=getQuiz(type,partieId);quiz.data.questions.splice(qi,1);renderQs(type,partieId);}
function updQ(type,partieId,qi,field,val){const quiz=getQuiz(type,partieId);quiz.data.questions[qi][field]=val;}
function setCorrect(type,partieId,qi,oi){const quiz=getQuiz(type,partieId);quiz.data.questions[qi].correct=oi;renderQs(type,partieId);}
function addOpt(type,partieId,qi){const quiz=getQuiz(type,partieId);quiz.data.questions[qi].options.push('');renderQs(type,partieId);}
function removeOpt(type,partieId,qi,oi){const quiz=getQuiz(type,partieId);const q=quiz.data.questions[qi];q.options.splice(oi,1);if(q.correct===oi)q.correct=undefined;else if(q.correct>oi)q.correct--;renderQs(type,partieId);}
function updOpt(type,partieId,qi,oi,val){const quiz=getQuiz(type,partieId);quiz.data.questions[qi].options[oi]=val;}

function addTuto(partieId,stepId,type){const p=parties.find(p=>p.id===partieId),s=p.steps.find(s=>s.id===stepId);if(!s.data.tutos)s.data.tutos=[];s.data.tutos.push({type,title:'',url:''});renderTutos(partieId,stepId);const c=document.getElementById('tutoCount');if(c)c.textContent=s.data.tutos.length;}
function removeTuto(partieId,stepId,ti){const p=parties.find(p=>p.id===partieId),s=p.steps.find(s=>s.id===stepId);s.data.tutos.splice(ti,1);renderTutos(partieId,stepId);const c=document.getElementById('tutoCount');if(c)c.textContent=s.data.tutos.length;}
function renderTutos(partieId,stepId){
  const c=document.getElementById('tutoList_'+partieId+'_'+stepId);if(!c)return;
  const p=parties.find(p=>p.id===partieId),s=p?.steps.find(s=>s.id===stepId);
  const tutos=s?.data?.tutos||[];const icons={video:['▶️','var(--orange-l)'],pdf:['📄','var(--blue-l)'],lien:['🔗','var(--teal-l)']};
  if(!tutos.length){c.innerHTML='<div style="text-align:center;padding:.9rem;color:var(--gray-400);font-size:.8rem;background:var(--gray-50);border-radius:var(--r-sm);border:1.5px dashed var(--gray-200)">Aucun tutoriel.</div>';return;}
  c.innerHTML=tutos.map((t,ti)=>{
    const [icon,bg]=icons[t.type]||['📎','var(--gray-100)'];
    const ph=t.type==='video'?'Lien YouTube/Vimeo…':t.type==='pdf'?'URL du PDF…':'URL du lien…';
    return `<div class="tuto-row"><div class="tuto-ico" style="background:${bg}">${icon}</div>
      <div class="tuto-inp">
        <input type="text" placeholder="Titre…" value="${t.title}" oninput="parties.find(p=>p.id==${partieId}).steps.find(s=>s.id==${stepId}).data.tutos[${ti}].title=this.value">
        <input type="text" placeholder="${ph}" value="${t.url}" oninput="parties.find(p=>p.id==${partieId}).steps.find(s=>s.id==${stepId}).data.tutos[${ti}].url=this.value">
      </div>
      <button class="del-btn" onclick="removeTuto(${partieId},${stepId},${ti})">✕</button>
    </div>`;
  }).join('');
}

function swTab(btn,name){
  document.querySelectorAll('.esh-tab').forEach(t=>t.classList.remove('on'));
  btn.classList.add('on');
  ['cours','tutos','exercice','correction'].forEach(t=>{const el=document.getElementById('tab-'+t);if(el)el.style.display=t===name?'':'none';});
}
function swTabN(name){document.querySelectorAll('.esh-tab').forEach(t=>{if(t.getAttribute('onclick')?.includes("'"+name+"'"))swTab(t,name);});}

function updPartieTitle(id,val){const p=parties.find(p=>p.id===id);if(p){p.title=val;renderSidebar();}}
function updLeconTitle(pid,sid,val){const p=parties.find(p=>p.id===pid),s=p.steps.find(s=>s.id===sid);if(s){s.title=val;renderSidebar();}}
function updQuizTitle(type,partieId,val){const quiz=getQuiz(type,partieId);if(quiz){quiz.title=val;renderSidebar();}}

function savePartie(id){const p=parties.find(p=>p.id===id);p.title=document.getElementById('pTitle')?.value||p.title;if(!p.data)p.data={};p.data.desc=document.getElementById('pDesc')?.value;p.data.objectifs=document.getElementById('pObj')?.value;renderSidebar();toast('Partie sauvegardée !');}
function saveCours(pid,sid){const p=parties.find(p=>p.id===pid),s=p.steps.find(s=>s.id===sid);s.title=document.getElementById('lTitle')?.value||s.title;s.data.intro=document.getElementById('lIntro')?.value;s.data.content=document.getElementById('lContent')?.value;s.data.duration=document.getElementById('lDur')?.value;renderSidebar();toast('Cours sauvegardé !');}
function saveEx(pid,sid){const p=parties.find(p=>p.id===pid),s=p.steps.find(s=>s.id===sid);s.data.exTitle=document.getElementById('exTitle')?.value;s.data.exContent=document.getElementById('exContent')?.value;s.data.exScore=document.getElementById('exScore')?.value;s.data.exCrit=document.getElementById('exCrit')?.value;toast('Exercice sauvegardé !');}
function saveCorr(pid,sid){const p=parties.find(p=>p.id===pid),s=p.steps.find(s=>s.id===sid);s.data.corrContent=document.getElementById('corrContent')?.value;toast('Correction sauvegardée !');}
function saveQuiz(type,partieId){const quiz=getQuiz(type,partieId);if(!quiz.data)quiz.data={};quiz.data.passScore=document.getElementById('qScore')?.value;quiz.data.duration=document.getElementById('qDur')?.value;quiz.data.instructions=document.getElementById('qInstr')?.value;toast('Quiz sauvegardé !');}

function markLeconDone(pid,sid){
  const p=parties.find(p=>p.id===pid),s=p.steps.find(s=>s.id===sid);
  s.filled=true;renderSidebar();toast('✅ Leçon validée !');
  const all=[];
  parties.forEach(pp=>{pp.steps.forEach(ss=>all.push({type:'lecon',pid:pp.id,sid:ss.id,f:ss.filled}));if(pp.quiz)all.push({type:'quiz',pid:pp.id,f:pp.quiz.filled});});
  if(finalQuiz)all.push({type:'final',f:finalQuiz.filled});
  const next=all.find(x=>!x.f);
  if(next)setTimeout(()=>{if(next.type==='lecon')selectLecon(next.pid,next.sid);else if(next.type==='quiz')selectQuizPartie(next.pid);else selectFinal();},400);
}

function markQuizDone(type,partieId){const quiz=getQuiz(type,partieId);quiz.filled=true;renderSidebar();toast('✅ Quiz validé !');}

function handleFile(input,pid,sid){
  if(input.files[0]){
    const uz=input.closest('.uz');uz.classList.add('filled');
    uz.querySelector('div').textContent='📎';uz.querySelectorAll('div')[1].innerHTML=`<strong style="color:var(--green-d)">${input.files[0].name}</strong>`;
    toast('Fichier : '+input.files[0].name);
  }
}

function saveAll(){toast('Tout sauvegardé 💾');}
function publishAll(){
  const all=[];parties.forEach(p=>{p.steps.forEach(s=>all.push(s.filled));if(p.quiz)all.push(p.quiz.filled);});if(finalQuiz)all.push(finalQuiz.filled);
  if(!all.length){toast('Ajoutez du contenu.','warn');return;}
  const nd=all.filter(f=>!f).length;if(nd>0){toast(nd+' étape(s) non complétée(s)','warn');return;}
  toast('🚀 Formation publiée !');
}

renderSidebar();
</script>
</body>
</html>
