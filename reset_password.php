
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
  }
  body{font-family:var(--sans);background:var(--surface);color:var(--ink);font-size:15px;min-height:100vh;display:flex;flex-direction:column}
  nav{display:flex;justify-content:space-between;align-items:center;padding:1.1rem 2.5rem;border-bottom:1px solid var(--border)}
  .logo{font-family:var(--serif);font-size:1.25rem}
  .page{flex:1;display:flex;align-items:center;justify-content:center;padding:2rem}
  .box{width:100%;max-width:420px}
  .icon-circle{width:52px;height:52px;border-radius:50%;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin:0 auto 1.25rem}
  .form-eyebrow{font-size:.78rem;font-weight:500;letter-spacing:.07em;text-transform:uppercase;color:var(--ink3);margin-bottom:.4rem;text-align:center}
  .form-title{font-family:var(--serif);font-size:1.6rem;letter-spacing:-.02em;text-align:center;margin-bottom:.4rem}
  .form-sub{font-size:.875rem;color:var(--ink3);text-align:center;margin-bottom:2rem;line-height:1.6}
  .field{margin-bottom:.85rem}
  .field label{display:flex;justify-content:space-between;font-size:.8rem;font-weight:500;color:var(--ink2);margin-bottom:.4rem}
  .pw-wrap{position:relative}
  .field input{width:100%;padding:.65rem .85rem;border:1px solid var(--border);border-radius:8px;font-size:.875rem;font-family:var(--sans);background:var(--card);color:var(--ink);outline:none;transition:border-color .15s}
  .field input:focus{border-color:#8888cc}
  .field input.err{border-color:var(--red)}
  .field input::placeholder{color:var(--ink3)}
  .pw-toggle{position:absolute;right:.85rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--ink3);font-size:.8rem;font-family:var(--sans);padding:0}
  /* strength */
  .strength-bar{display:flex;gap:3px;margin-top:.5rem}
  .seg{height:3px;flex:1;border-radius:999px;background:var(--border);transition:background .25s}
  .seg.s1{background:#e24b4a}.seg.s2{background:#ef9f27}.seg.s3{background:var(--green)}
  .strength-label{font-size:.72rem;color:var(--ink3);margin-top:.3rem}
  /* rules */
  .pw-rules{display:grid;grid-template-columns:1fr 1fr;gap:.3rem .75rem;margin-bottom:1.1rem;margin-top:.6rem}
  .rule{font-size:.75rem;color:var(--ink3);display:flex;align-items:center;gap:.35rem}
  .rule.ok{color:var(--green)}.rule .ri{font-size:.7rem}
  /* error */
  .err-msg{background:var(--red-bg);border:1px solid var(--red-b);border-radius:8px;padding:.65rem .9rem;font-size:.78rem;color:var(--red);margin-bottom:.85rem;display:none}
  .err-msg.show{display:block}
  /* token expired */
  .expired-box{display:none;background:var(--red-bg);border:1px solid var(--red-b);border-radius:12px;padding:1.5rem;text-align:center}
  .expired-box.show{display:block}
  .expired-box h3{font-size:.95rem;font-weight:500;color:var(--red);margin-bottom:.4rem}
  .expired-box p{font-size:.82rem;color:var(--red);opacity:.8;line-height:1.6;margin-bottom:1rem}
  /* success */
  .success-box{display:none;text-align:center}
  .success-box.show{display:block}
  .success-box .big{font-size:2.5rem;margin-bottom:.75rem}
  .success-box h3{font-family:var(--serif);font-size:1.4rem;margin-bottom:.4rem}
  .success-box p{font-size:.85rem;color:var(--ink3);margin-bottom:1.5rem}
  .btn-submit{width:100%;padding:.8rem;background:var(--accent);color:#fff;border:none;border-radius:8px;font-size:.9rem;font-weight:500;font-family:var(--sans);cursor:pointer;margin-bottom:.75rem}
  .btn-submit:hover{background:#16213e}
  .btn-outline{width:100%;padding:.75rem;background:transparent;color:var(--ink2);border:1px solid var(--border);border-radius:8px;font-size:.88rem;font-family:var(--sans);cursor:pointer}
  /* token badge */
  .token-badge{display:flex;align-items:center;gap:.5rem;background:#f5f4f0;border:1px solid var(--border);border-radius:8px;padding:.6rem .85rem;font-size:.78rem;color:var(--ink3);margin-bottom:1.5rem}
  .token-timer{margin-left:auto;font-weight:500;color:var(--ink2);font-variant-numeric:tabular-nums}
  /* demo toggle */
  .demo-row{display:flex;gap:.5rem;margin-bottom:1.25rem;flex-wrap:wrap}
  .demo-btn{padding:.3rem .75rem;border-radius:6px;border:1px solid var(--border);background:none;font-size:.75rem;font-family:var(--sans);cursor:pointer;color:var(--ink3)}
  .demo-btn:hover{border-color:#bbb;color:var(--ink2)}
</style>

<nav><div class="logo">AbsenceIQ</div></nav>

<div class="page">
  <div class="box">

    <!-- DEMO CONTROLS -->
    <div class="demo-row">
      <span style="font-size:.72rem;color:var(--ink3);align-self:center">Preview state:</span>
      <button class="demo-btn" onclick="showState('form')">Valid token</button>
      <button class="demo-btn" onclick="showState('expired')">Expired token</button>
      <button class="demo-btn" onclick="showState('success')">Success</button>
    </div>

    <!-- VALID TOKEN FORM -->
    <div id="stateForm">
      <div class="icon-circle">🔒</div>
      <div class="form-eyebrow">Set new password</div>
      <div class="form-title">Choose a strong password</div>
      <div class="form-sub">This link is valid for 15 minutes. Once you save, your old password is immediately deactivated.</div>

      <div class="token-badge">
        🔗 Reset link verified
        <span class="token-timer" id="timer">14:32</span>
      </div>

      <div class="err-msg" id="errMsg">Passwords do not match. Please try again.</div>

      <form method="POST" action="reset-password.php" onsubmit="return handleReset(event)">
        <input type="hidden" name="csrf_token" value="">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

        <div class="field">
          <label>New password</label>
          <div class="pw-wrap">
            <input type="password" id="pw1" name="password" placeholder="Min. 8 characters" oninput="checkStrength(this.value)" required>
            <button type="button" class="pw-toggle" onclick="togglePw('pw1',this)">show</button>
          </div>
          <div class="strength-bar">
            <div class="seg" id="s1"></div>
            <div class="seg" id="s2"></div>
            <div class="seg" id="s3"></div>
          </div>
          <div class="strength-label" id="sLabel">Enter a password</div>
        </div>

        <div class="pw-rules">
          <div class="rule" id="r1"><span class="ri">○</span> At least 8 characters</div>
          <div class="rule" id="r2"><span class="ri">○</span> One uppercase letter</div>
          <div class="rule" id="r3"><span class="ri">○</span> One number</div>
          <div class="rule" id="r4"><span class="ri">○</span> One special character</div>
        </div>

        <div class="field">
          <label>Confirm password</label>
          <div class="pw-wrap">
            <input type="password" id="pw2" name="confirm_password" placeholder="Repeat your password" oninput="checkMatch()" required>
            <button type="button" class="pw-toggle" onclick="togglePw('pw2',this)">show</button>
          </div>
        </div>

        <button type="submit" class="btn-submit" id="resetBtn">Save new password →</button>
      </form>
    </div>

    <!-- EXPIRED TOKEN -->
    <div class="expired-box" id="stateExpired">
      <div style="font-size:2rem;margin-bottom:.75rem">⏰</div>
      <h3>This link has expired</h3>
      <p>Password reset links are only valid for 15 minutes for security reasons. Request a new one and try again.</p>
      <button class="btn-submit" style="margin-bottom:0" onclick="window.location='forgot-password.php'">Request a new link →</button>
    </div>

    <!-- SUCCESS -->
    <div class="success-box" id="stateSuccess">
      <div class="big">✅</div>
      <h3>Password updated</h3>
      <p>Your password has been changed successfully. You can now sign in with your new credentials.</p>
      <button class="btn-submit" onclick="window.location='login.php'">Go to sign in →</button>
      <button class="btn-outline">Back to home</button>
    </div>
  </div>
</div>

<script>
  // demo state switcher
  function showState(s){
    document.getElementById('stateForm').style.display = s==='form' ? '' : 'none';
    document.getElementById('stateExpired').style.display = s==='expired' ? 'block' : 'none';
    document.getElementById('stateSuccess').style.display = s==='success' ? 'block' : 'none';
  }

  // countdown timer
  let secs = 872;
  function tick(){
    if(secs<=0){showState('expired');return;}
    const m=Math.floor(secs/60), s=secs%60;
    const el=document.getElementById('timer');
    if(el) el.textContent=(m+':')+(s<10?'0':'')+s;
    secs--; setTimeout(tick,1000);
  }
  tick();

  function togglePw(id,btn){
    const inp=document.getElementById(id);
    inp.type=inp.type==='password'?'text':'password';
    btn.textContent=inp.type==='password'?'show':'hide';
  }

  function checkStrength(v){
    const segs=[document.getElementById('s1'),document.getElementById('s2'),document.getElementById('s3')];
    const lbl=document.getElementById('sLabel');
    segs.forEach(s=>s.className='seg');
    const rules={r1:v.length>=8,r2:/[A-Z]/.test(v),r3:/[0-9]/.test(v),r4:/[^A-Za-z0-9]/.test(v)};
    Object.entries(rules).forEach(([id,ok])=>{
      const el=document.getElementById(id);
      el.className='rule'+(ok?' ok':'');
      el.querySelector('.ri').textContent=ok?'✓':'○';
    });
    let score=Object.values(rules).filter(Boolean).length;
    if(!v){lbl.textContent='Enter a password';return;}
    const labels=['','Weak','Fair','Strong','Very strong'];
    const cls=['','s1','s2','s3'];
    for(let i=0;i<Math.min(score,3);i++) segs[i].classList.add(cls[i+1]);
    lbl.textContent=labels[score]||'Too short';
  }

  function checkMatch(){
    const p1=document.getElementById('pw1').value;
    const p2=document.getElementById('pw2').value;
    const inp=document.getElementById('pw2');
    if(p2.length>0) inp.style.borderColor = p1===p2 ? 'var(--green)' : 'var(--red)';
  }

  function handleReset(e){
    e.preventDefault();
    const p1=document.getElementById('pw1').value;
    const p2=document.getElementById('pw2').value;
    if(p1!==p2){document.getElementById('errMsg').classList.add('show');return false;}
    const btn=document.getElementById('resetBtn');
    btn.textContent='Saving…'; btn.disabled=true; btn.style.opacity='.7';
    setTimeout(()=>showState('success'),1200);
    return false;
  }
</script>
