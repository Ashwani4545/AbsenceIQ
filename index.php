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
        --ink3: #888;
        --surface: #fafaf8;
        --card: #fff;
        --accent: #1a1a2e;
        --accent2: #16213e;
        --pill-bg: #f0eff9;
        --pill-txt: #3d3a8c;
        --border: #e8e6e0;
        --green: #1a7a4a;
        --green-bg: #edf7f1;
        --sans: 'DM Sans', sans-serif;
        --serif: 'DM Serif Display', serif;
    }

    body {
        font-family: var(--sans);
        background: var(--surface);
        color: var(--ink);
        font-size: 15px;
        line-height: 1.65
    }

    a {
        text-decoration: none;
        color: inherit
    }

    /* NAV */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 2.5rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface);
        position: sticky;
        top: 0;
        z-index: 100
    }

    .logo {
        font-family: var(--serif);
        font-size: 1.3rem;
        letter-spacing: -.01em
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 1.75rem
    }

    .nav-links a {
        font-size: .875rem;
        color: var(--ink2)
    }

    .nav-links a:hover {
        color: var(--ink)
    }

    .btn {
        display: inline-flex;
        align-items: center;
        padding: .55rem 1.25rem;
        border-radius: 8px;
        font-size: .875rem;
        font-family: var(--sans);
        cursor: pointer;
        transition: all .18s ease
    }

    .btn-dark {
        background: var(--accent);
        color: #fff;
        border: 1px solid var(--accent)
    }

    .btn-dark:hover {
        background: var(--accent2)
    }

    .btn-ghost {
        border: 1px solid var(--border);
        color: var(--ink2)
    }

    .btn-ghost:hover {
        border-color: #aaa;
        color: var(--ink)
    }

    /* HERO */
    .hero {
        max-width: 680px;
        margin: 0 auto;
        padding: 5rem 2rem 3rem;
        text-align: center
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: var(--pill-bg);
        color: var(--pill-txt);
        font-size: .8rem;
        padding: .35rem .9rem;
        border-radius: 999px;
        margin-bottom: 1.75rem;
        font-weight: 500
    }

    .badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--pill-txt);
        opacity: .6
    }

    h1 {
        font-family: var(--serif);
        font-size: clamp(2rem, 5vw, 3rem);
        line-height: 1.15;
        letter-spacing: -.02em;
        color: var(--ink);
        margin-bottom: 1.25rem
    }

    .hero p {
        color: var(--ink2);
        font-size: 1.05rem;
        max-width: 520px;
        margin: 0 auto 2.5rem;
        font-weight: 300
    }

    .hero-cta {
        display: flex;
        gap: .75rem;
        justify-content: center;
        flex-wrap: wrap
    }

    /* STATS */
    .stats {
        display: flex;
        justify-content: center;
        gap: 0;
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        margin: 3rem auto;
        max-width: 520px
    }

    .stat {
        flex: 1;
        padding: 1.25rem 1rem;
        text-align: center
    }

    .stat:not(:last-child) {
        border-right: 1px solid var(--border)
    }

    .stat-n {
        font-family: var(--serif);
        font-size: 1.6rem;
        display: block;
        color: var(--ink)
    }

    .stat-l {
        font-size: .78rem;
        color: var(--ink3);
        margin-top: .1rem
    }

    /* ROLES */
    .roles {
        padding: 1rem 2rem 4rem;
        max-width: 900px;
        margin: 0 auto
    }

    .section-label {
        font-size: .78rem;
        font-weight: 500;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--ink3);
        margin-bottom: 1.5rem;
        text-align: center
    }

    .role-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: .75rem
    }

    .role-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1.25rem 1rem;
        background: var(--card);
        cursor: pointer;
        transition: all .18s ease;
        text-align: center
    }

    .role-card:hover {
        border-color: #bbb;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, .06)
    }

    .role-icon {
        font-size: 1.3rem;
        margin-bottom: .75rem
    }

    .role-card h4 {
        font-size: .9rem;
        font-weight: 500;
        margin-bottom: .35rem
    }

    .role-card p {
        font-size: .78rem;
        color: var(--ink3);
        line-height: 1.5
    }

    /* FEATURES */
    .features {
        background: #fff;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 4rem 2rem
    }

    .features-inner {
        max-width: 900px;
        margin: 0 auto
    }

    .feat-block {
        margin-bottom: 3rem
    }

    .feat-block:last-child {
        margin-bottom: 0
    }

    .feat-header {
        display: flex;
        align-items: center;
        gap: .6rem;
        margin-bottom: 1.5rem
    }

    .feat-header h3 {
        font-size: 1rem;
        font-weight: 500
    }

    .ctx-pill {
        font-size: .75rem;
        padding: .25rem .7rem;
        border-radius: 999px;
        font-weight: 500
    }

    .ctx-corp {
        background: #f0f4ff;
        color: #2d4db5
    }

    .ctx-edu {
        background: #fff0e6;
        color: #b55a00
    }

    .feat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: .75rem
    }

    .feat-card {
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1.1rem 1rem;
        background: var(--surface)
    }

    .feat-card h4 {
        font-size: .85rem;
        font-weight: 500;
        margin-bottom: .35rem
    }

    .feat-card p {
        font-size: .78rem;
        color: var(--ink3);
        line-height: 1.5
    }

    /* HOW */
    .how {
        max-width: 820px;
        margin: 0 auto;
        padding: 4rem 2rem
    }

    .steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        position: relative;
        margin-top: 2rem
    }

    .steps::before {
        content: '';
        position: absolute;
        top: 1.25rem;
        left: 10%;
        right: 10%;
        height: 1px;
        background: var(--border)
    }

    .step {
        text-align: center;
        position: relative;
        z-index: 1
    }

    .step-n {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 50%;
        background: var(--card);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        font-weight: 500;
        margin: 0 auto .9rem;
        color: var(--ink)
    }

    .step h4 {
        font-size: .85rem;
        font-weight: 500;
        margin-bottom: .35rem
    }

    .step p {
        font-size: .78rem;
        color: var(--ink3);
        line-height: 1.5
    }

    /* CTA FOOTER */
    .cta-footer {
        background: var(--accent);
        color: #fff;
        text-align: center;
        padding: 4rem 2rem
    }

    .cta-footer h2 {
        font-family: var(--serif);
        font-size: 2rem;
        margin-bottom: .75rem;
        letter-spacing: -.02em
    }

    .cta-footer p {
        opacity: .65;
        font-size: .95rem;
        margin-bottom: 2rem;
        font-weight: 300
    }

    .btn-light {
        background: #fff;
        color: var(--accent);
        border: 1px solid rgba(255, 255, 255, .2)
    }

    .btn-light:hover {
        background: rgba(255, 255, 255, .9)
    }

    @media(max-width:640px) {
        nav {
            padding: 1rem 1.25rem
        }

        .role-grid {
            grid-template-columns: repeat(2, 1fr)
        }

        .feat-grid {
            grid-template-columns: 1fr 1fr
        }

        .steps {
            grid-template-columns: repeat(2, 1fr)
        }

        .steps::before {
            display: none
        }

        nav .nav-links a:not(.btn) {
            display: none
        }
    }
</style>

<nav>
    <div class="logo">AbsenceIQ</div>
    <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#how">How it works</a>
        <a href="#">Pricing</a>
        <a href="./login.php" class="btn btn-ghost">Login</a>
        <a href="./register.php" class="btn btn-dark">Get started</a>
    </div>
</nav>

<section class="hero">
    <div class="badge"><span class="badge-dot"></span> AI-powered analysis</div>
    <h1>Smart leave &amp; absence management</h1>
    <p>For HR teams, employees, teachers, and students — validate requests and surface patterns in seconds.</p>
    <div class="hero-cta">
        <a href="#" class="btn btn-dark">Start free trial</a>
        <a href="#" class="btn btn-ghost">Watch demo</a>
    </div>
</section>

<div class="stats">
    <div class="stat"><span class="stat-n">10K+</span>
        <div class="stat-l">Requests analyzed</div>
    </div>
    <div class="stat"><span class="stat-n">98%</span>
        <div class="stat-l">Accuracy rate</div>
    </div>
    <div class="stat"><span class="stat-n">5K+</span>
        <div class="stat-l">Happy users</div>
    </div>
</div>

<section class="roles" >
    <div class="section-label">Who uses AbsenceIQ</div>
    <div class="role-grid">
        <div class="role-card">
            <div class="role-icon">💼</div>
            <h4>HR manager</h4>
            <p>Manage leave requests with AI validation and pattern detection</p>
        </div>
        <div class="role-card">
            <div class="role-icon">👔</div>
            <h4>Employee</h4>
            <p>Submit requests and track approval status in real time</p>
        </div>
        <div class="role-card">
            <div class="role-icon">📚</div>
            <h4>Teacher</h4>
            <p>Review student excuse submissions intelligently</p>
        </div>
        <div class="role-card">
            <div class="role-icon">🎓</div>
            <h4>Student</h4>
            <p>Submit absence reasons and receive instant feedback</p>
        </div>
    </div>
</section>

<section class="features" id="features">
    <div class="features-inner">
        <div class="feat-block">
            <div class="feat-header">
                <span class="ctx-pill ctx-corp">Corporate</span>
                <h3>For HR &amp; employees</h3>
            </div>
            <div class="feat-grid">
                <div class="feat-card">
                    <h4>Smart validation</h4>
                    <p>Flags suspicious patterns and validates authenticity instantly</p>
                </div>
                <div class="feat-card">
                    <h4>Analytics dashboard</h4>
                    <p>Department-wide absence trends and seasonal breakdowns</p>
                </div>
                <div class="feat-card">
                    <h4>Quick processing</h4>
                    <p>Auto-approve clean requests, route complex ones for review</p>
                </div>
            </div>
        </div>
        <div class="feat-block">
            <div class="feat-header">
                <span class="ctx-pill ctx-edu">Education</span>
                <h3>For teachers &amp; students</h3>
            </div>
            <div class="feat-grid">
                <div class="feat-card">
                    <h4>Excuse analyzer</h4>
                    <p>Detects common excuse patterns and credibility signals</p>
                </div>
                <div class="feat-card">
                    <h4>Class management</h4>
                    <p>Track attendance across multiple classes and sections</p>
                </div>
                <div class="feat-card">
                    <h4>Early intervention</h4>
                    <p>Identify at-risk students before absences become chronic</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how" id="how">
    <div class="section-label" style="text-align:center">How it works</div>
    <div class="steps">
        <div class="step">
            <div class="step-n">1</div>
            <h4>Submit</h4>
            <p>A simple form for any leave or absence reason</p>
        </div>
        <div class="step">
            <div class="step-n">2</div>
            <h4>Analyze</h4>
            <p>AI reads sentiment, patterns, and credibility instantly</p>
        </div>
        <div class="step">
            <div class="step-n">3</div>
            <h4>Verdict</h4>
            <p>Auto-approve or flag for a human reviewer</p>
        </div>
        <div class="step">
            <div class="step-n">4</div>
            <h4>Improve</h4>
            <p>System learns from reviewer decisions over time</p>
        </div>
    </div>
</section>

<section class="cta-footer">
    <h2>Ready to get started?</h2>
    <p>Join 5,000+ teams making smarter absence decisions.</p>
    <a href="#" class="btn btn-light">Start your free trial</a>
</section>