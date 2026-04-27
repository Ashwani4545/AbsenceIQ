<?php
session_start();
require_once 'db_config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->getConnection();
    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Please enter both email and password.';
    } else {
        $stmt = $db->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            
            // Redirect based on role
            switch ($user['role']) {
                case 'HR':
                    header("Location: hr_dash.php");
                    break;
                case 'TEACHER':
                    header("Location: teahcer_dash.php");
                    break;
                case 'STUDENT':
                    header("Location: student_dash.php");
                    break;
                case 'EMPLOYEE':
                default:
                    header("Location: emp_dash.php");
                    break;
            }
            exit;
        } else {
            $error = 'Incorrect email or password.';
        }
    }
}
?>
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
        --accent2: #16213e;
        --border: #e8e6e0;
        --border2: #d0cec8;
        --pill-bg: #f0eff9;
        --pill-txt: #3d3a8c;
        --sans: 'DM Sans', sans-serif;
        --serif: 'DM Serif Display', serif;
        --err: #c0392b;
        --err-bg: #fdf2f2;
    }

    body {
        font-family: var(--sans);
        background: var(--surface);
        color: var(--ink);
        font-size: 15px;
        line-height: 1.65;
        min-height: 100vh
    }

    /* NAV */
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

    /* LAYOUT */
    .page {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: calc(100vh - 57px)
    }

    /* LEFT PANEL */
    .panel-left {
        background: var(--accent);
        padding: 3.5rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        color: #fff
    }

    .panel-left h2 {
        font-family: var(--serif);
        font-size: 1.9rem;
        line-height: 1.2;
        letter-spacing: -.02em;
        margin-bottom: 1rem
    }

    .panel-left p {
        opacity: .5;
        font-size: .9rem;
        font-weight: 300;
        line-height: 1.7
    }

    .feature-list {
        margin-top: 2.5rem;
        display: flex;
        flex-direction: column;
        gap: .85rem
    }

    .feat-item {
        display: flex;
        align-items: flex-start;
        gap: .75rem
    }

    .feat-check {
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: .1rem;
        font-size: .7rem
    }

    .feat-item p {
        font-size: .85rem;
        opacity: .6;
        line-height: 1.5
    }

    .panel-quote {
        border-top: 1px solid rgba(255, 255, 255, .1);
        padding-top: 1.5rem;
        margin-top: auto
    }

    .panel-quote blockquote {
        font-size: .85rem;
        opacity: .5;
        font-weight: 300;
        line-height: 1.6;
        font-style: italic
    }

    .panel-quote cite {
        display: block;
        font-size: .78rem;
        opacity: .35;
        margin-top: .5rem;
        font-style: normal
    }

    /* RIGHT — FORM */
    .panel-right {
        padding: 3rem 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        max-width: 480px;
        margin: 0 auto;
        width: 100%
    }

    .form-eyebrow {
        font-size: .78rem;
        font-weight: 500;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: var(--ink3);
        margin-bottom: .5rem
    }

    .form-title {
        font-family: var(--serif);
        font-size: 1.75rem;
        letter-spacing: -.02em;
        margin-bottom: .35rem
    }

    .form-sub {
        font-size: .875rem;
        color: var(--ink3);
        margin-bottom: 2rem
    }

    .form-sub a {
        color: var(--ink2);
        border-bottom: 1px solid var(--border2)
    }

    /* ERROR BANNER */
    .error-banner {
        background: var(--err-bg);
        border: 1px solid #f5c6c6;
        border-radius: 8px;
        padding: .75rem 1rem;
        font-size: .82rem;
        color: var(--err);
        margin-bottom: 1.25rem;
        display: none
    }

    .error-banner.show {
        display: flex;
        align-items: center;
        gap: .5rem
    }

    /* FIELDS */
    .field {
        margin-bottom: .85rem
    }

    .field-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: .4rem
    }

    .field label {
        font-size: .8rem;
        font-weight: 500;
        color: var(--ink2)
    }

    .field-link {
        font-size: .78rem;
        color: var(--ink3);
        border-bottom: 1px solid var(--border2)
    }

    .field-link:hover {
        color: var(--ink2)
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

    .field input.err {
        border-color: var(--err)
    }

    /* PW */
    .pw-wrap {
        position: relative
    }

    .pw-toggle {
        position: absolute;
        right: .85rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--ink3);
        font-size: .8rem;
        font-family: var(--sans);
        padding: 0
    }

    /* REMEMBER */
    .remember-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem
    }

    .remember {
        display: flex;
        align-items: center;
        gap: .5rem
    }

    .remember input {
        accent-color: var(--accent);
        width: 14px;
        height: 14px
    }

    .remember label {
        font-size: .8rem;
        color: var(--ink3)
    }

    /* SUBMIT */
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
        letter-spacing: .01em;
        margin-bottom: 1.25rem
    }

    .btn-submit:hover {
        background: var(--accent2)
    }

    /* DIVIDER */
    .divider {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1.25rem;
        color: var(--ink3);
        font-size: .78rem
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border)
    }

    /* SOCIAL */
    .btn-social {
        width: 100%;
        padding: .7rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: .85rem;
        font-family: var(--sans);
        background: var(--card);
        color: var(--ink2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .6rem;
        transition: border-color .15s;
        margin-bottom: .6rem
    }

    .btn-social:hover {
        border-color: var(--border2);
        color: var(--ink)
    }

    /* SSO */
    .sso-row {
        text-align: center;
        margin-top: 1rem
    }

    .sso-row a {
        font-size: .8rem;
        color: var(--ink3);
        border-bottom: 1px solid var(--border2)
    }

    .sso-row a:hover {
        color: var(--ink2)
    }

    /* ROLE HINT */
    .role-hint {
        display: flex;
        gap: .4rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem
    }

    .role-chip {
        font-size: .72rem;
        padding: .25rem .65rem;
        border-radius: 999px;
        background: var(--pill-bg);
        color: var(--pill-txt);
        font-weight: 500
    }

    @media(max-width:720px) {
        .page {
            grid-template-columns: 1fr
        }

        .panel-left {
            display: none
        }

        .panel-right {
            padding: 2rem 1.5rem;
            max-width: 100%
        }
    }
</style>

<nav>
    <div class="logo">AbsenceIQ</div>
    <div class="nav-hint">No account? <a href="register.php">Sign up free</a></div>
</nav>

<div class="page">
    <!-- LEFT -->
    <div class="panel-left">
        <div>
            <h2>Welcome back</h2>
            <p>Sign in to continue managing leave and absences with AI-powered analysis.</p>

            <div class="feature-list">
                <div class="feat-item">
                    <div class="feat-check">✓</div>
                    <p>AI validates requests and surfaces patterns automatically</p>
                </div>
                <div class="feat-item">
                    <div class="feat-check">✓</div>
                    <p>Real-time approval status for employees and students</p>
                </div>
                <div class="feat-item">
                    <div class="feat-check">✓</div>
                    <p>Department and class-level analytics at a glance</p>
                </div>
                <div class="feat-item">
                    <div class="feat-check">✓</div>
                    <p>Early intervention alerts for frequent absences</p>
                </div>
            </div>
        </div>

        <div class="panel-quote">
            <blockquote>"We used to spend hours reviewing leave requests. Now it's minutes — and the decisions are more consistent."</blockquote>
            <cite>— Rohan M., People Operations, TechNova</cite>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="panel-right">
        <div class="form-eyebrow">Sign in</div>
        <div class="form-title">Good to have you back</div>
        <div class="form-sub">Don't have an account? <a href="./register.php">Create one free</a></div>

        <!-- ROLE HINT CHIPS -->
        <div class="role-hint">
            <span class="role-chip">HR manager</span>
            <span class="role-chip">Employee</span>
            <span class="role-chip">Teacher</span>
            <span class="role-chip">Student</span>
        </div>

        <!-- ERROR BANNER (shown on bad login) -->
        <div class="error-banner <?php echo !empty($error) ? 'show' : ''; ?>" id="errorBanner">
            <span>⚠</span> <?php echo !empty($error) ? htmlspecialchars($error) : 'Incorrect email or password. Please try again.'; ?>
        </div>

        <!-- FORM (PHP action) -->
        <form method="POST" action="login.php" id="loginForm">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

            <div class="field">
                <div class="field-top">
                    <label for="email">Email address</label>
                </div>
                <input type="email" id="email" name="email" placeholder="you@company.com" autocomplete="email" required>
            </div>

            <div class="field">
                <div class="field-top">
                    <label for="password">Password</label>
                    <a href="forgot_password.php" class="field-link">Forgot password?</a>
                </div>
                <div class="pw-wrap">
                    <input type="password" id="password" name="password" placeholder="Your password" autocomplete="current-password" required>
                    <button type="button" class="pw-toggle" onclick="togglePw()">show</button>
                </div>
            </div>

            <div class="remember-row">
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Keep me signed in</label>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">Sign in →</button>
        </form>

        <div class="divider">or continue with</div>

        <button class="btn-social" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05" />
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
            </svg>
            Continue with Google
        </button>

        <div class="sso-row">
            <a href="sso.php">Sign in with SSO / organisation account →</a>
        </div>
    </div>
</div>

<script>
    function togglePw() {
        const inp = document.getElementById('password');
        inp.type = inp.type === 'password' ? 'text' : 'password';
        event.target.textContent = inp.type === 'password' ? 'show' : 'hide';
    }

    // Optional: Add loading state purely for UI feedback on click
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.textContent = 'Signing in…';
        btn.style.opacity = '.7';
    });

    // Clear error on input
    document.getElementById('email').addEventListener('input', clearErr);
    document.getElementById('password').addEventListener('input', clearErr);

    function clearErr() {
        document.getElementById('errorBanner').classList.remove('show');
        document.getElementById('password').classList.remove('err');
    }
</script>