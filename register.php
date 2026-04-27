<?php
session_start();
require_once 'db_config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->getConnection();
    
    $role = $_POST['role'] ?? 'EMPLOYEE'; // Default fallback
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $name = $firstName . ' ' . $lastName;
    $email = trim($_POST['email'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($firstName) || empty($email) || empty($password)) {
        $error = 'Please fill in all required fields.';
    } else {
        // Check if email exists
        $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'An account with this email already exists.';
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $roleEnum = strtoupper($role);
            if (!in_array($roleEnum, ['HR', 'EMPLOYEE', 'TEACHER', 'STUDENT'])) {
                $roleEnum = 'EMPLOYEE';
            }
            
            $insertStmt = $db->prepare("INSERT INTO users (name, email, password, role, department) VALUES (?, ?, ?, ?, ?)");
            try {
                $insertStmt->execute([$name, $email, $hashedPassword, $roleEnum, $department]);
                $success = 'Account created successfully! Redirecting to login...';
                echo "<script>setTimeout(() => { window.location.href = 'login.php'; }, 2000);</script>";
            } catch (PDOException $e) {
                $error = 'Error creating account: ' . $e->getMessage();
            }
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
        --success: #1a7a4a;
        --success-bg: #edf7f1;
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

    .nav-hint a:hover {
        color: var(--ink)
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
        opacity: .55;
        font-size: .9rem;
        font-weight: 300;
        line-height: 1.7
    }

    .role-list {
        margin-top: 2.5rem;
        display: flex;
        flex-direction: column;
        gap: .6rem
    }

    .role-item {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .75rem 1rem;
        border-radius: 10px;
        cursor: pointer;
        transition: background .15s;
        border: 1px solid transparent
    }

    .role-item:hover {
        background: rgba(255, 255, 255, .07)
    }

    .role-item.active {
        background: rgba(255, 255, 255, .12);
        border-color: rgba(255, 255, 255, .15)
    }

    .role-ico {
        width: 2rem;
        height: 2rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, .12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .95rem;
        flex-shrink: 0
    }

    .role-text h4 {
        font-size: .85rem;
        font-weight: 500;
        margin-bottom: .1rem
    }

    .role-text p {
        font-size: .75rem;
        opacity: .5;
        line-height: 1.4
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

    /* RIGHT PANEL — FORM */
    .panel-right {
        padding: 3rem 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        max-width: 520px;
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

    /* ROLE SELECTOR (small) */
    .role-tabs {
        display: flex;
        gap: .4rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem
    }

    .role-tab {
        padding: .4rem .85rem;
        border-radius: 999px;
        border: 1px solid var(--border);
        font-size: .78rem;
        font-weight: 500;
        cursor: pointer;
        color: var(--ink2);
        background: transparent;
        font-family: var(--sans);
        transition: all .15s
    }

    .role-tab:hover {
        border-color: var(--border2);
        color: var(--ink)
    }

    .role-tab.active {
        background: var(--pill-bg);
        color: var(--pill-txt);
        border-color: transparent
    }

    /* FORM FIELDS */
    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .75rem;
        margin-bottom: .75rem
    }

    .field {
        margin-bottom: .75rem
    }

    .field label {
        display: block;
        font-size: .8rem;
        font-weight: 500;
        color: var(--ink2);
        margin-bottom: .4rem
    }

    .field input,
    .field select {
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

    .field input:focus,
    .field select:focus {
        border-color: #8888cc
    }

    .field input::placeholder {
        color: var(--ink3)
    }

    .field select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23999' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right .85rem center
    }

    /* PASSWORD STRENGTH */
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

    .strength-bar {
        display: flex;
        gap: 3px;
        margin-top: .5rem
    }

    .strength-seg {
        height: 3px;
        flex: 1;
        border-radius: 999px;
        background: var(--border);
        transition: background .25s
    }

    .strength-seg.s1 {
        background: #e24b4a
    }

    .strength-seg.s2 {
        background: #ef9f27
    }

    .strength-seg.s3 {
        background: #1a7a4a
    }

    .strength-label {
        font-size: .72rem;
        color: var(--ink3);
        margin-top: .3rem
    }

    /* DIVIDER */
    .divider {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin: 1.25rem 0;
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

    /* TERMS */
    .terms {
        display: flex;
        align-items: flex-start;
        gap: .6rem;
        margin-bottom: 1.25rem
    }

    .terms input[type=checkbox] {
        margin-top: .2rem;
        accent-color: var(--accent);
        width: 14px;
        height: 14px;
        flex-shrink: 0
    }

    .terms label {
        font-size: .78rem;
        color: var(--ink3);
        line-height: 1.55
    }

    .terms label a {
        color: var(--ink2);
        border-bottom: 1px solid var(--border2)
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
        letter-spacing: .01em
    }

    .btn-submit:hover {
        background: var(--accent2)
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
        transition: border-color .15s
    }

    .btn-social:hover {
        border-color: var(--border2);
        color: var(--ink)
    }

    /* STEPS */
    .step-dots {
        display: flex;
        gap: 5px;
        justify-content: center;
        margin-bottom: 2rem
    }

    .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--border)
    }

    .dot.active {
        background: var(--accent);
        width: 18px;
        border-radius: 999px
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

        .field-row {
            grid-template-columns: 1fr
        }
    }
</style>

<nav>
    <div class="logo">AbsenceIQ</div>
    <div class="nav-hint">Already have an account? <a href="./login.php">Sign in</a></div>
</nav>

<div class="page">
    <!-- LEFT -->
    <div class="panel-left">
        <div>
            <h2>The smarter way to manage absences</h2>
            <p>Join thousands of teams and schools making faster, fairer decisions with AI-assisted analysis.</p>

            <div class="role-list" id="leftRoles">
                <div class="role-item active" data-role="hr">
                    <div class="role-ico">💼</div>
                    <div class="role-text">
                        <h4>HR manager</h4>
                        <p>Validate leave, detect patterns, reduce admin</p>
                    </div>
                </div>
                <div class="role-item" data-role="employee">
                    <div class="role-ico">👔</div>
                    <div class="role-text">
                        <h4>Employee</h4>
                        <p>Submit requests, track status instantly</p>
                    </div>
                </div>
                <div class="role-item" data-role="teacher">
                    <div class="role-ico">📚</div>
                    <div class="role-text">
                        <h4>Teacher</h4>
                        <p>Review excuses intelligently, flag concerns early</p>
                    </div>
                </div>
                <div class="role-item" data-role="student">
                    <div class="role-ico">🎓</div>
                    <div class="role-text">
                        <h4>Student</h4>
                        <p>Submit reasons, get feedback right away</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-quote">
            <blockquote id="quoteText">"AbsenceIQ cut our leave processing time by 60%. The AI flags the ones that need a closer look — we don't have to."</blockquote>
            <cite id="quoteAuthor">— Priya S., HR Lead at Meridian Corp</cite>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="panel-right">
        <div class="step-dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

        <div class="form-eyebrow">Step 1 of 3</div>
        <div class="form-title">Create your account</div>
        <div class="form-sub">Quick setup — under 2 minutes. <a href="#">Need help?</a></div>

        <!-- ROLE TABS -->
        <div class="role-tabs" id="roleTabs">
            <button type="button" class="role-tab active" data-role="hr">HR manager</button>
            <button type="button" class="role-tab" data-role="employee">Employee</button>
            <button type="button" class="role-tab" data-role="teacher">Teacher</button>
            <button type="button" class="role-tab" data-role="student">Student</button>
        </div>

        <!-- SOCIAL -->
        <button type="button" class="btn-social">
            <svg width="16" height="16" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05" />
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
            </svg>
            Continue with Google
        </button>

        <div class="divider">or register with email</div>

        <?php if (!empty($error)): ?>
            <div style="background: var(--err-bg); color: var(--err); padding: 10px; border-radius: 8px; margin-bottom: 15px; border: 1px solid var(--err);">
                ⚠ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div style="background: var(--success-bg); color: var(--success); padding: 10px; border-radius: 8px; margin-bottom: 15px; border: 1px solid var(--success);">
                ✓ <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <input type="hidden" name="role" id="roleInput" value="hr">
            <!-- FIELDS -->
            <div class="field-row">
                <div class="field"><label>First name</label><input type="text" name="first_name" placeholder="Ada" required></div>
                <div class="field"><label>Last name</label><input type="text" name="last_name" placeholder="Lovelace"></div>
            </div>
            <div class="field"><label>Work email</label><input type="email" name="email" placeholder="ada@company.com" required></div>

            <!-- CONTEXTUAL FIELD -->
            <div class="field" id="contextField">
                <label id="contextLabel">Organisation / company</label>
                <input type="text" name="department" id="contextInput" placeholder="Meridian Corp">
            </div>

            <div class="field">
                <label>Password</label>
                <div class="pw-wrap">
                    <input type="password" name="password" id="pwInput" placeholder="Min. 8 characters" oninput="checkStrength(this.value)" required>
                    <button type="button" class="pw-toggle" onclick="togglePw()">show</button>
                </div>
                <div class="strength-bar">
                    <div class="strength-seg" id="s1"></div>
                    <div class="strength-seg" id="s2"></div>
                    <div class="strength-seg" id="s3"></div>
                </div>
                <div class="strength-label" id="sLabel">Enter a password</div>
            </div>

            <div class="terms">
                <input type="checkbox" id="agree" required>
                <label for="agree">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I understand AbsenceIQ may process absence data on my behalf.</label>
            </div>

            <button type="submit" class="btn-submit">Create account →</button>
        </form>
    </div>
</div>

<script>
    const quotes = {
        hr: {
            q: '"AbsenceIQ cut our leave processing time by 60%. The AI flags the ones that need a closer look — we don\'t have to."',
            a: '— Priya S., HR Lead at Meridian Corp'
        },
        employee: {
            q: '"I submitted my leave request in under a minute and had an answer the same day. No chasing anyone."',
            a: '— James K., Software Engineer'
        },
        teacher: {
            q: '"The excuse analyzer instantly highlights repeat patterns I used to have to track manually."',
            a: '— Ms. Fernandez, Secondary School Teacher'
        },
        student: {
            q: '"Got feedback on my absence submission right away. Super simple to use."',
            a: '— Arjun M., University Student'
        }
    };
    const contextMap = {
        hr: {
            label: 'Organisation / company',
            placeholder: 'Meridian Corp'
        },
        employee: {
            label: 'Organisation / company',
            placeholder: 'Your employer'
        },
        teacher: {
            label: 'School / institution',
            placeholder: 'St. Anne\'s College'
        },
        student: {
            label: 'School / student ID',
            placeholder: 'SN-20240182'
        }
    };

    function setRole(role) {
        document.querySelectorAll('.role-tab').forEach(t => t.classList.toggle('active', t.dataset.role === role));
        document.querySelectorAll('#leftRoles .role-item').forEach(r => r.classList.toggle('active', r.dataset.role === role));
        const q = quotes[role];
        document.getElementById('quoteText').textContent = '\u201C' + q.q.replace(/^"|"$/g, '') + '\u201D';
        document.getElementById('quoteAuthor').textContent = q.a;
        const ctx = contextMap[role];
        document.getElementById('contextLabel').textContent = ctx.label;
        document.getElementById('contextInput').placeholder = ctx.placeholder;
        document.getElementById('roleInput').value = role; // Update hidden input
    }

    document.querySelectorAll('.role-tab').forEach(t => t.addEventListener('click', () => setRole(t.dataset.role)));
    document.querySelectorAll('#leftRoles .role-item').forEach(r => r.addEventListener('click', () => setRole(r.dataset.role)));

    function checkStrength(v) {
        const segs = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3')];
        const lbl = document.getElementById('sLabel');
        segs.forEach(s => {
            s.className = 'strength-seg'
        });
        if (!v) {
            lbl.textContent = 'Enter a password';
            return
        }
        let score = 0;
        if (v.length >= 8) score++;
        if (/[A-Z]/.test(v) && /[0-9]/.test(v)) score++;
        if (/[^A-Za-z0-9]/.test(v)) score++;
        const labels = ['Weak', 'Fair', 'Strong'];
        const cls = ['s1', 's2', 's3'];
        for (let i = 0; i < score; i++) segs[i].classList.add(cls[i]);
        lbl.textContent = labels[score - 1] || 'Too short';
    }

    function togglePw() {
        const inp = document.getElementById('pwInput');
        inp.type = inp.type === 'password' ? 'text' : 'password';
        event.target.textContent = inp.type === 'password' ? 'show' : 'hide';
    }
</script>