<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=DM+Serif+Display&display=swap');

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0
  }

  :root {
    --ink: #0f0f0f;
    --ink2: #555;
    --ink3: #999;
    --surface: #fafaf8;
    --card: #fff;
    --accent: #1a1a2e;
    --border: #e8e6e0;
    --border2: #d0cec8;
    --sans: 'DM Sans', sans-serif;
    --serif: 'DM Serif Display', serif;
    --green: #1a7a4a;
    --green-bg: #edf7f1;
    --green-b: #b6dfc8;
    --blue: #185fa5;
    --blue-bg: #e6f1fb;
    --blue-b: #b5d4f4;
  }

  body {
    font-family: var(--sans);
    background: var(--surface);
    color: var(--ink);
    font-size: 15px;
    min-height: 100vh;
    display: flex;
    flex-direction: column
  }

  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.1rem 2.5rem;
    border-bottom: 1px solid var(--border);
    background: var(--surface)
  }

  .logo {
    font-family: var(--serif);
    font-size: 1.25rem
  }

  .nav-hint {
    font-size: .85rem;
    color: var(--ink3)
  }

  .nav-hint a {
    color: var(--ink2);
    border-bottom: 1px solid var(--border2)
  }

  .page {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem
  }

  .box {
    width: 100%;
    max-width: 420px
  }

  .step-row {
    display: flex;
    gap: .4rem;
    margin-bottom: 2rem;
    justify-content: center
  }

  .step-dot {
    height: 3px;
    border-radius: 999px;
    background: var(--border);
    flex: 1;
    transition: background .3s
  }

  .step-dot.done {
    background: var(--accent)
  }

  .step-dot.active {
    background: var(--accent);
    opacity: .5
  }

  .icon-circle {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    margin: 0 auto 1.25rem
  }

  .form-eyebrow {
    font-size: .78rem;
    font-weight: 500;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--ink3);
    margin-bottom: .4rem;
    text-align: center
  }

  .form-title {
    font-family: var(--serif);
    font-size: 1.6rem;
    letter-spacing: -.02em;
    text-align: center;
    margin-bottom: .4rem
  }

  .form-sub {
    font-size: .875rem;
    color: var(--ink3);
    text-align: center;
    margin-bottom: 2rem;
    line-height: 1.6
  }

  .form-sub a {
    color: var(--ink2);
    border-bottom: 1px solid var(--border2)
  }

  .field {
    margin-bottom: .85rem
  }

  .field label {
    display: block;
    font-size: .8rem;
    font-weight: 500;
    color: var(--ink2);
    margin-bottom: .4rem
  }

  .field input {
    width: 100%;
    padding: .65rem .85rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: .875rem;
    font-family: var(--sans);
    background: var(--card);
    color: var(--ink);
    outline: none;
    transition: border-color .15s
  }

  .field input:focus {
    border-color: #8888cc
  }

  .field input::placeholder {
    color: var(--ink3)
  }

  .btn-submit {
    width: 100%;
    padding: .8rem;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .9rem;
    font-weight: 500;
    font-family: var(--sans);
    cursor: pointer;
    transition: background .18s;
    margin-bottom: 1rem
  }

  .btn-submit:hover {
    background: #16213e
  }

  .back-link {
    display: block;
    text-align: center;
    font-size: .82rem;
    color: var(--ink3)
  }

  .back-link a {
    color: var(--ink2);
    border-bottom: 1px solid var(--border2)
  }

  /* success state */
  .success-box {
    display: none;
    background: var(--green-bg);
    border: 1px solid var(--green-b);
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center
  }

  .success-box.show {
    display: block
  }

  .success-box h3 {
    font-size: .95rem;
    font-weight: 500;
    color: var(--green);
    margin-bottom: .4rem
  }

  .success-box p {
    font-size: .82rem;
    color: var(--green);
    opacity: .8;
    line-height: 1.6
  }

  .success-box .resend {
    font-size: .78rem;
    margin-top: .85rem;
    color: var(--ink3)
  }

  .success-box .resend a {
    color: var(--green);
    border-bottom: 1px solid var(--green-b);
    cursor: pointer
  }

  .main-form {

  }

  /* info tip */
  .info-tip {
    background: var(--blue-bg);
    border: 1px solid var(--blue-b);
    border-radius: 8px;
    padding: .7rem .9rem;
    font-size: .78rem;
    color: var(--blue);
    margin-bottom: 1rem;
    line-height: 1.55
  }
</style>

<nav>
  <div class="logo">AbsenceIQ</div>
  <div class="nav-hint">Remember it? <a href="#">Sign in</a></div>
</nav>

<div class="page">
  <div class="box">
    <div class="step-row">
      <div class="step-dot active" id="d1"></div>
      <div class="step-dot" id="d2"></div>
      <div class="step-dot" id="d3"></div>
    </div>

    <div class="main-form" id="mainForm">
      <div class="icon-circle">🔑</div>
      <div class="form-eyebrow">Password reset</div>
      <div class="form-title">Forgot your password?</div>
      <div class="form-sub">No worries. Enter your email and we'll send you a reset link within a minute.</div>

      <form method="POST" action="forgot-password.php" onsubmit="return handleSubmit(event)">
        <input type="hidden" name="csrf_token" value="">
        <div class="field">
          <label for="email">Email address</label>
          <input type="email" id="email" name="email" placeholder="you@company.com" autocomplete="email" required>
        </div>
        <div class="info-tip">ℹ We'll send a secure link valid for <strong>15 minutes</strong>. Check your spam folder if you don't see it.</div>
        <button type="submit" class="btn-submit" id="submitBtn">Send reset link →</button>
      </form>
      <div class="back-link">← <a href="login.php">Back to sign in</a></div>
    </div>

    <div class="success-box" id="successBox">
      <div style="font-size:2rem;margin-bottom:.75rem">📬</div>
      <h3>Check your inbox</h3>
      <p>We've sent a password reset link to <strong id="sentTo"></strong>. Click the link in the email to set a new password.</p>
      <div class="resend">Didn't receive it? <a onclick="resend()">Resend email</a> · <a href="login.php" style="color:var(--ink2);border-color:var(--border2)">Back to login</a></div>
    </div>
  </div>
</div>

<script>
  function handleSubmit(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const btn = document.getElementById('submitBtn');
    btn.textContent = 'Sending…';
    btn.disabled = true;
    btn.style.opacity = '.7';
    document.getElementById('d1').classList.add('done');
    document.getElementById('d2').classList.add('active');
    setTimeout(() => {
      document.getElementById('mainForm').style.display = 'none';
      document.getElementById('sentTo').textContent = email;
      document.getElementById('successBox').classList.add('show');
      document.getElementById('d2').classList.add('done');
      document.getElementById('d3').classList.add('active');
    }, 1200);
    return false;
  }

  function resend() {
    const r = document.querySelector('.resend');
    r.innerHTML = '✓ Resent successfully. Check your inbox.';
  }
</script>