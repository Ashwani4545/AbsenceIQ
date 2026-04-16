
<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=DM+Serif+Display&display=swap');
  *{box-sizing:border-box;margin:0;padding:0}
  :root{
    --ink:#0f0f0f;--ink2:#555;--ink3:#999;
    --surface:#fafaf8;--card:#fff;
    --accent:#1a1a2e;--border:#e8e6e0;--border2:#d0cec8;
    --sans:'DM Sans',sans-serif;--serif:'DM Serif Display',serif;
    --green:#1a7a4a;--green-bg:#edf7f1;--green-b:#b6dfc8;
    --red:#a32d2d;--red-bg:#fdf2f2;--red-b:#f5c6c6;
    --amber:#8a5c00;--amber-bg:#fef8ed;--amber-b:#f5d98a;
  }
  body{font-family:var(--sans);background:var(--surface);color:var(--ink);font-size:15px;min-height:100vh;display:flex;flex-direction:column}
  nav{display:flex;justify-content:space-between;align-items:center;padding:1.1rem 2.5rem;border-bottom:1px solid var(--border)}
  .logo{font-family:var(--serif);font-size:1.25rem}
  .page{flex:1;display:flex;align-items:center;justify-content:center;padding:2rem}
  .box{width:100%;max-width:420px;text-align:center}
  .icon-circle{width:64px;height:64px;border-radius:50%;border:1px solid var(--border);background:var(--card);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin:0 auto 1.25rem}
  .form-eyebrow{font-size:.78rem;font-weight:500;letter-spacing:.07em;text-transform:uppercase;color:var(--ink3);margin-bottom:.4rem}
  .form-title{font-family:var(--serif);font-size:1.6rem;letter-spacing:-.02em;margin-bottom:.4rem}
  .form-sub{font-size:.875rem;color:var(--ink3);margin-bottom:.35rem;line-height:1.65}
  .email-highlight{font-weight:500;color:var(--ink);background:#f0eff9;padding:.1rem .45rem;border-radius:4px;font-size:.875rem}
  /* OTP inputs */
  .otp-row{display:flex;gap:.6rem;justify-content:center;margin:1.75rem 0 .5rem}
  .otp-input{width:48px;height:56px;border:1.5px solid var(--border);border-radius:10px;font-size:1.4rem;font-family:var(--serif);text-align:center;color:var(--ink);background:var(--card);outline:none;transition:border-color .15s;caret-color:transparent}
  .otp-input:focus{border-color:#8888cc;background:#fafaf8}
  .otp-input.filled{border-color:var(--accent)}
  .otp-input.err{border-color:var(--red);animation:shake .3s}
  .otp-input.ok{border-color:var(--green);background:var(--green-bg)}
  @keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-4px)}75%{transform:translateX(4px)}}
  /* timer */
  .timer-row{font-size:.82rem;color:var(--ink3);margin-bottom:1.5rem}
  .timer-count{font-weight:500;color:var(--ink2);font-variant-numeric:tabular-nums}
  .timer-count.expired{color:var(--red)}
  .resend-link{color:var(--ink2);border-bottom:1px solid var(--border2);cursor:pointer;font-size:.82rem;display:none}
  .resend-link.show{display:inline}
  /* status */
  .status-msg{border-radius:8px;padding:.65rem .9rem;font-size:.8rem;margin-bottom:1rem;display:none;text-align:left}
  .status-msg.show{display:flex;align-items:center;gap:.5rem}
  .status-msg.err{background:var(--red-bg);border:1px solid var(--red-b);color:var(--red)}
  .status-msg.ok{background:var(--green-bg);border:1px solid var(--green-b);color:var(--green)}
  /* btn */
  .btn-submit{width:100%;padding:.8rem;background:var(--accent);color:#fff;border:none;border-radius:8px;font-size:.9rem;font-weight:500;font-family:var(--sans);cursor:pointer;margin-bottom:1rem;opacity:.4;transition:opacity .2s,background .18s}
  .btn-submit.ready{opacity:1}
  .btn-submit:hover.ready{background:#16213e}
  .help-link{font-size:.8rem;color:var(--ink3)}
  .help-link a{color:var(--ink2);border-bottom:1px solid var(--border2)}
  /* success */
  .success-panel{display:none;text-align:center}
  .success-panel.show{display:block}
  .success-panel .big{font-size:3rem;margin-bottom:.75rem}
  .success-panel h3{font-family:var(--serif);font-size:1.5rem;margin-bottom:.4rem}
  .success-panel p{font-size:.875rem;color:var(--ink3);margin-bottom:1.5rem;line-height:1.65}
  .btn-go{display:inline-block;padding:.75rem 2rem;background:var(--accent);color:#fff;border-radius:8px;font-size:.9rem;font-weight:500;font-family:var(--sans);cursor:pointer;border:none}
  /* demo row */
  .demo-row{display:flex;gap:.5rem;margin-bottom:1.5rem;flex-wrap:wrap;justify-content:center}
  .demo-btn{padding:.3rem .75rem;border-radius:6px;border:1px solid var(--border);background:none;font-size:.75rem;font-family:var(--sans);cursor:pointer;color:var(--ink3)}
  .demo-btn:hover{border-color:#bbb;color:var(--ink2)}
  /* progress dots */
  .prog-dots{display:flex;gap:.4rem;justify-content:center;margin-bottom:2rem}
  .pdot{width:8px;height:8px;border-radius:50%;background:var(--border)}
  .pdot.done{background:var(--green)}.pdot.active{background:var(--accent)}
</style>

<nav><div class="logo">AbsenceIQ</div></nav>

<div class="page">
  <div class="box">
    <div class="prog-dots">
      <div class="pdot done"></div>
      <div class="pdot active"></div>
      <div class="pdot"></div>
    </div>

    <div class="demo-row">
      <span style="font-size:.72rem;color:var(--ink3);align-self:center">Preview:</span>
      <button class="demo-btn" onclick="fillDemo('correct')">Correct code</button>
      <button class="demo-btn" onclick="fillDemo('wrong')">Wrong code</button>
      <button class="demo-btn" onclick="showSuccess()">Success state</button>
    </div>

    <div id="verifyPanel">
      <div class="icon-circle">📧</div>
      <div class="form-eyebrow">Email verification</div>
      <div class="form-title">Check your email</div>
      <div class="form-sub">We sent a 6-digit code to</div>
      <div style="margin:.35rem 0 .25rem"><span class="email-highlight">arjun@company.com</span></div>
      <div class="form-sub" style="margin-top:.25rem">Enter it below to verify your account.</div>

      <div class="otp-row" id="otpRow">
        <input class="otp-input" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]">
        <input class="otp-input" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]">
        <input class="otp-input" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]">
        <input class="otp-input" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]">
        <input class="otp-input" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]">
        <input class="otp-input" maxlength="1" type="text" inputmode="numeric" pattern="[0-9]">
      </div>

      <div class="timer-row">
        Code expires in <span class="timer-count" id="timerEl">09:59</span>
        &nbsp;·&nbsp;
        <span class="resend-link" id="resendLink" onclick="resend()">Resend code</span>
      </div>

      <div class="status-msg" id="statusMsg"></div>

      <form method="POST" action="verify-email.php" onsubmit="return handleVerify(event)">
        <input type="hidden" name="csrf_token" value="">
        <input type="hidden" name="otp" id="otpHidden">
        <input type="hidden" name="email" value="arjun@company.com">
        <button type="submit" class="btn-submit" id="verifyBtn">Verify email →</button>
      </form>

      <div class="help-link">Wrong email? <a href="register.php">Go back and change it</a></div>
    </div>

    <div class="success-panel" id="successPanel">
      <div class="big">🎉</div>
      <h3>Email verified!</h3>
      <p>Your account is now active. Let's set up your workspace so you can get started.</p>
      <button class="btn-go" onclick="window.location='onboarding.php'">Continue to setup →</button>
    </div>
  </div>
</div>

<script>
  const inputs = document.querySelectorAll('.otp-input');
  const btn = document.getElementById('verifyBtn');
  const CORRECT = '482917';

  inputs.forEach((inp, i)=>{
    inp.addEventListener('input', e=>{
      inp.value = inp.value.replace(/[^0-9]/g,'').slice(-1);
      inp.classList.toggle('filled', inp.value.length>0);
      if(inp.value && i < inputs.length-1) inputs[i+1].focus();
      checkReady();
    });
    inp.addEventListener('keydown', e=>{
      if(e.key==='Backspace' && !inp.value && i>0){inputs[i-1].focus();inputs[i-1].value='';inputs[i-1].classList.remove('filled');}
      if(e.key==='ArrowLeft' && i>0) inputs[i-1].focus();
      if(e.key==='ArrowRight' && i<inputs.length-1) inputs[i+1].focus();
    });
    inp.addEventListener('paste', e=>{
      e.preventDefault();
      const paste = (e.clipboardData||window.clipboardData).getData('text').replace(/\D/g,'').slice(0,6);
      paste.split('').forEach((c,j)=>{if(inputs[i+j]){inputs[i+j].value=c;inputs[i+j].classList.add('filled');}});
      checkReady();
    });
  });

  function checkReady(){
    const full = [...inputs].every(i=>i.value.length===1);
    btn.classList.toggle('ready', full);
  }

  function getOtp(){ return [...inputs].map(i=>i.value).join(''); }

  function handleVerify(e){
    e.preventDefault();
    const code = getOtp();
    document.getElementById('otpHidden').value = code;
    if(code === CORRECT){ showSuccess(); return false; }
    inputs.forEach(i=>i.classList.add('err'));
    setTimeout(()=>inputs.forEach(i=>i.classList.remove('err')),600);
    const msg = document.getElementById('statusMsg');
    msg.className='status-msg err show';
    msg.innerHTML='<span>⚠</span> Incorrect code. Please check your email and try again.';
    return false;
  }

  function showSuccess(){
    document.getElementById('verifyPanel').style.display='none';
    document.getElementById('successPanel').classList.add('show');
  }

  function fillDemo(type){
    const code = type==='correct' ? CORRECT : '000000';
    code.split('').forEach((c,i)=>{inputs[i].value=c;inputs[i].classList.add('filled');});
    checkReady();
  }

  // countdown
  let secs=599;
  function tick(){
    const el=document.getElementById('timerEl');
    if(!el) return;
    if(secs<=0){
      el.textContent='Expired';el.classList.add('expired');
      document.getElementById('resendLink').classList.add('show');
      return;
    }
    const m=Math.floor(secs/60),s=secs%60;
    el.textContent=(m<10?'0':'')+m+':'+(s<10?'0':'')+s;
    secs--; setTimeout(tick,1000);
  }
  tick();

  function resend(){
    secs=599;
    document.getElementById('resendLink').classList.remove('show');
    const msg=document.getElementById('statusMsg');
    msg.className='status-msg ok show';
    msg.innerHTML='<span>✓</span> New code sent to arjun@company.com';
    inputs.forEach(i=>{i.value='';i.classList.remove('filled','ok','err');});
    btn.classList.remove('ready');
    inputs[0].focus();
  }
</script>
