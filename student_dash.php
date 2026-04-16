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
    --surface: #f5f4f0;
    --card: #fff;
    --accent: #1a1a2e;
    --border: #e8e6e0;
    --sans: 'DM Sans', sans-serif;
    --serif: 'DM Serif Display', serif;
    --green: #1a7a4a;
    --green-bg: #edf7f1;
    --green-b: #b6dfc8;
    --amber: #8a5c00;
    --amber-bg: #fef8ed;
    --amber-b: #f5d98a;
    --red: #a32d2d;
    --red-bg: #fdf2f2;
    --red-b: #f5c6c6;
    --blue: #185fa5;
    --blue-bg: #e6f1fb;
    --blue-b: #b5d4f4;
    --sidebar: 210px;
  }

  body {
    font-family: var(--sans);
    background: var(--surface);
    color: var(--ink);
    font-size: 14px;
    line-height: 1.6
  }

  .shell {
    display: grid;
    grid-template-columns: var(--sidebar) 1fr;
    min-height: 100vh
  }

  .sidebar {
    background: var(--accent);
    color: #fff;
    display: flex;
    flex-direction: column
  }

  .sb-logo {
    padding: 1.4rem 1.25rem;
    font-family: var(--serif);
    font-size: 1.15rem;
    border-bottom: 1px solid rgba(255, 255, 255, .08)
  }

  .sb-section {
    padding: .75rem 1rem .25rem;
    font-size: .68rem;
    font-weight: 500;
    letter-spacing: .08em;
    text-transform: uppercase;
    opacity: .35;
    margin-top: .5rem
  }

  .sb-item {
    display: flex;
    align-items: center;
    gap: .65rem;
    padding: .6rem 1.25rem;
    font-size: .82rem;
    opacity: .55;
    cursor: pointer;
    border-left: 2px solid transparent;
    margin: .05rem 0;
    transition: all .15s
  }

  .sb-item:hover {
    opacity: .8;
    background: rgba(255, 255, 255, .05)
  }

  .sb-item.active {
    opacity: 1;
    background: rgba(255, 255, 255, .1);
    border-left-color: rgba(255, 255, 255, .5)
  }

  .sb-badge {
    margin-left: auto;
    background: rgba(255, 255, 255, .15);
    font-size: .68rem;
    padding: .1rem .4rem;
    border-radius: 999px
  }

  .sb-footer {
    margin-top: auto;
    border-top: 1px solid rgba(255, 255, 255, .08);
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    gap: .65rem
  }

  .sb-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .15);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    font-weight: 500
  }

  .sb-user h4 {
    font-size: .8rem;
    font-weight: 500
  }

  .sb-user p {
    font-size: .7rem;
    opacity: .4
  }

  .main {
    display: flex;
    flex-direction: column
  }

  .topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: .9rem 1.75rem;
    border-bottom: 1px solid var(--border);
    background: var(--card)
  }

  .topbar-left h2 {
    font-size: .95rem;
    font-weight: 500
  }

  .topbar-left p {
    font-size: .78rem;
    color: var(--ink3)
  }

  .btn-sm {
    padding: .45rem .9rem;
    border-radius: 8px;
    font-size: .8rem;
    font-family: var(--sans);
    cursor: pointer;
    border: none;
    font-weight: 500
  }

  .btn-dark {
    background: var(--accent);
    color: #fff
  }

  .content {
    padding: 1.5rem 1.75rem;
    flex: 1
  }

  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.1rem;
    margin-bottom: .85rem
  }

  .card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem
  }

  .card-head h3 {
    font-size: .85rem;
    font-weight: 500
  }

  .card-head a {
    font-size: .75rem;
    color: var(--ink3);
    border-bottom: 1px solid var(--border)
  }

  .badge {
    display: inline-flex;
    align-items: center;
    padding: .18rem .6rem;
    border-radius: 999px;
    font-size: .7rem;
    font-weight: 500
  }

  .badge-green {
    background: var(--green-bg);
    color: var(--green);
    border: 1px solid var(--green-b)
  }

  .badge-amber {
    background: var(--amber-bg);
    color: var(--amber);
    border: 1px solid var(--amber-b)
  }

  .badge-red {
    background: var(--red-bg);
    color: var(--red);
    border: 1px solid var(--red-b)
  }

  .badge-blue {
    background: var(--blue-bg);
    color: var(--blue);
    border: 1px solid var(--blue-b)
  }

  /* ATTENDANCE RING */
  .attend-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: .85rem
  }

  .ring-wrap {
    position: relative;
    width: 90px;
    height: 90px;
    flex-shrink: 0
  }

  .ring-wrap svg {
    transform: rotate(-90deg)
  }

  .ring-label {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center
  }

  .ring-pct {
    font-family: var(--serif);
    font-size: 1.3rem;
    line-height: 1
  }

  .ring-sub {
    font-size: .65rem;
    color: var(--ink3)
  }

  .attend-info h3 {
    font-size: .95rem;
    font-weight: 500;
    margin-bottom: .25rem
  }

  .attend-info p {
    font-size: .8rem;
    color: var(--ink3);
    margin-bottom: .6rem
  }

  .attend-stats {
    display: flex;
    gap: 1.25rem
  }

  .att-stat .n {
    font-size: 1.1rem;
    font-family: var(--serif)
  }

  .att-stat .l {
    font-size: .7rem;
    color: var(--ink3)
  }

  /* ALERT BANNER */
  .alert-banner {
    background: var(--amber-bg);
    border: 1px solid var(--amber-b);
    border-radius: 10px;
    padding: .8rem 1rem;
    display: flex;
    align-items: flex-start;
    gap: .65rem;
    margin-bottom: .85rem;
    font-size: .82rem;
    color: var(--amber)
  }

  .alert-banner.danger {
    background: var(--red-bg);
    border-color: var(--red-b);
    color: var(--red)
  }

  /* FORM */
  .field {
    margin-bottom: .75rem
  }

  .field label {
    display: block;
    font-size: .78rem;
    font-weight: 500;
    color: var(--ink2);
    margin-bottom: .35rem
  }

  .field input,
  .field select,
  .field textarea {
    width: 100%;
    padding: .6rem .8rem;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: .82rem;
    font-family: var(--sans);
    background: var(--card);
    color: var(--ink);
    outline: none;
    transition: border-color .15s;
    resize: vertical
  }

  .field input:focus,
  .field select:focus,
  .field textarea:focus {
    border-color: #8888cc
  }

  .field select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23999' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right .8rem center
  }

  .field textarea {
    min-height: 80px
  }

  .field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .65rem
  }

  .ai-feedback {
    border-radius: 8px;
    padding: .75rem 1rem;
    font-size: .78rem;
    margin-top: .75rem;
    display: none;
    line-height: 1.6
  }

  .ai-feedback.show {
    display: block
  }

  .ai-feedback.good {
    background: var(--green-bg);
    color: var(--green);
    border: 1px solid var(--green-b)
  }

  .ai-feedback.warn {
    background: var(--amber-bg);
    color: var(--amber);
    border: 1px solid var(--amber-b)
  }

  .ai-feedback.bad {
    background: var(--red-bg);
    color: var(--red);
    border: 1px solid var(--red-b)
  }

  .char-count {
    font-size: .7rem;
    color: var(--ink3);
    text-align: right;
    margin-top: .2rem
  }

  .btn-submit {
    width: 100%;
    padding: .7rem;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .85rem;
    font-weight: 500;
    font-family: var(--sans);
    cursor: pointer
  }

  /* HISTORY */
  .hist-item {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .6rem 0;
    border-bottom: 1px solid var(--border)
  }

  .hist-item:last-child {
    border-bottom: none
  }

  .hist-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    flex-shrink: 0
  }

  .hist-body {
    flex: 1
  }

  .hist-body h4 {
    font-size: .8rem;
    font-weight: 500
  }

  .hist-body p {
    font-size: .72rem;
    color: var(--ink3)
  }

  .hist-score {
    font-size: .72rem;
    font-weight: 500
  }

  /* TIPS */
  .tip-item {
    display: flex;
    align-items: flex-start;
    gap: .55rem;
    padding: .5rem 0;
    border-bottom: 1px solid var(--border);
    font-size: .78rem
  }

  .tip-item:last-child {
    border-bottom: none
  }

  .tip-ico {
    color: var(--blue);
    flex-shrink: 0;
    margin-top: .1rem
  }

  .tip-item p {
    color: var(--ink2);
    line-height: 1.5
  }

  .grid2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .85rem
  }

  .grid3 {
    display: grid;
    grid-template-columns: 1.2fr 1fr 0.8fr;
    gap: .85rem
  }
</style>

<div class="shell">
  <aside class="sidebar">
    <div class="sb-logo">AbsenceIQ</div>
    <div class="sb-section">Main</div>
    <div class="sb-item active">▦ Dashboard</div>
    <div class="sb-item">📋 My Submissions</div>
    <div class="sb-item">📅 Timetable</div>
    <div class="sb-section">Account</div>
    <div class="sb-item">🔔 Notifications <span class="sb-badge">1</span></div>
    <div class="sb-item">⚙ Settings</div>
    <div class="sb-footer">
      <div class="sb-avatar">AM</div>
      <div class="sb-user">
        <h4>Arjun Mehta</h4>
        <p>Class 10-A · Roll 14</p>
      </div>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div class="topbar-left">
        <h2>Student Dashboard</h2>
        <p>Tuesday, 14 April 2026</p>
      </div>
      <button class="btn-sm btn-dark">+ Submit Absence</button>
    </div>

    <div class="content">
      <!-- ATTENDANCE RING -->
      <div class="attend-card">
        <div class="ring-wrap">
          <svg width="90" height="90" viewBox="0 0 90 90">
            <circle cx="45" cy="45" r="38" fill="none" stroke="#e8e6e0" stroke-width="8" />
            <circle cx="45" cy="45" r="38" fill="none" stroke="#1a7a4a" stroke-width="8"
              stroke-dasharray="238.76" stroke-dashoffset="38.2" stroke-linecap="round" />
          </svg>
          <div class="ring-label">
            <div class="ring-pct">84%</div>
            <div class="ring-sub">present</div>
          </div>
        </div>
        <div class="attend-info">
          <h3>Your Attendance — April 2026</h3>
          <p>You need 75% to meet the minimum requirement. You're currently above it — keep it up.</p>
          <div class="attend-stats">
            <div class="att-stat">
              <div class="n" style="color:var(--green)">38</div>
              <div class="l">Present</div>
            </div>
            <div class="att-stat">
              <div class="n" style="color:var(--red)">7</div>
              <div class="l">Absent</div>
            </div>
            <div class="att-stat">
              <div class="n" style="color:var(--amber)">2</div>
              <div class="l">Pending</div>
            </div>
            <div class="att-stat">
              <div class="n">45</div>
              <div class="l">Total days</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ALERT IF LOW -->
      <div class="alert-banner">
        <span>⚠</span>
        <div>You have <strong>2 unexcused absences</strong> from last week (Apr 7 & 8). Submit your excuse before Apr 16 to avoid them being marked unexcused permanently.</div>
      </div>

      <div class="grid2">
        <!-- SUBMIT FORM -->
        <div class="card">
          <div class="card-head">
            <h3>Submit Absence Excuse</h3>
          </div>
          <form method="POST" action="submit-excuse.php">
            <input type="hidden" name="csrf_token" value="">
            <div class="field-row">
              <div class="field">
                <label>Absent date</label>
                <input type="date" name="absent_date">
              </div>
              <div class="field">
                <label>Reason type</label>
                <select name="reason_type">
                  <option value="">Select</option>
                  <option>Medical / Illness</option>
                  <option>Family emergency</option>
                  <option>Personal</option>
                  <option>Transport issue</option>
                  <option>Other</option>
                </select>
              </div>
            </div>
            <div class="field">
              <label>Explain your reason <span style="font-weight:400;color:var(--ink3)">(more detail = higher AI score)</span></label>
              <textarea name="reason" id="reasonText" placeholder="e.g. I had a high fever since the previous night. My parents took me to Dr. Kapoor who advised 2 days bed rest. I have the prescription if needed." oninput="liveScore()" maxlength="500"></textarea>
              <div class="char-count"><span id="charCount">0</span>/500</div>
            </div>
            <div class="field">
              <label>Supporting document <span style="font-weight:400;color:var(--ink3)">(optional but helps)</span></label>
              <input type="file" name="document" accept=".pdf,.jpg,.png" style="font-size:.78rem">
            </div>

            <!-- LIVE AI FEEDBACK -->
            <div class="ai-feedback" id="aiFeedback"></div>

            <button type="submit" class="btn-submit" style="margin-top:.75rem">Submit excuse →</button>
          </form>
        </div>

        <div style="display:flex;flex-direction:column;gap:.85rem">
          <!-- HISTORY -->
          <div class="card">
            <div class="card-head">
              <h3>Past Submissions</h3><a href="#">All →</a>
            </div>
            <div class="hist-item">
              <div class="hist-icon" style="background:var(--green-bg)">🩺</div>
              <div class="hist-body">
                <h4>Medical — Mar 3</h4>
                <p>Doctor visit, fever</p>
              </div>
              <div style="text-align:right">
                <div class="hist-score" style="color:var(--green)">94%</div><span class="badge badge-green">Accepted</span>
              </div>
            </div>
            <div class="hist-item">
              <div class="hist-icon" style="background:var(--blue-bg)">👨‍👩‍👧</div>
              <div class="hist-body">
                <h4>Family — Feb 22</h4>
                <p>Family function</p>
              </div>
              <div style="text-align:right">
                <div class="hist-score" style="color:#ef9f27">63%</div><span class="badge badge-amber">Reviewed</span>
              </div>
            </div>
            <div class="hist-item">
              <div class="hist-icon" style="background:var(--red-bg)">❓</div>
              <div class="hist-body">
                <h4>Other — Jan 6</h4>
                <p>"Not feeling well"</p>
              </div>
              <div style="text-align:right">
                <div class="hist-score" style="color:var(--red)">22%</div><span class="badge badge-red">Rejected</span>
              </div>
            </div>
            <div class="hist-item">
              <div class="hist-icon" style="background:var(--amber-bg)">⏳</div>
              <div class="hist-body">
                <h4>Medical — Apr 7</h4>
                <p>Pending review</p>
              </div>
              <div style="text-align:right">
                <div class="hist-score" style="color:var(--ink3)">—</div><span class="badge badge-amber">Pending</span>
              </div>
            </div>
          </div>

          <!-- TIPS -->
          <div class="card">
            <div class="card-head">
              <h3>Tips for better approval</h3>
            </div>
            <div class="tip-item"><span class="tip-ico">✓</span>
              <p>Be specific — mention symptoms, doctor name, or dates clearly</p>
            </div>
            <div class="tip-item"><span class="tip-ico">✓</span>
              <p>Attach a prescription, certificate, or note when possible</p>
            </div>
            <div class="tip-item"><span class="tip-ico">✓</span>
              <p>Submit within 3 days of the absence for faster processing</p>
            </div>
            <div class="tip-item"><span class="tip-ico">✗</span>
              <p>Vague reasons like "not feeling well" score poorly with AI</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Auto-approval keywords for students
  const autoApproveKeywords = [
    'doctor', 'dr.', 'hospital', 'medical', 'clinic', 'appointment', 'treatment',
    'fever', 'illness', 'sick', 'flu', 'cough', 'cold', 'infection', 'checkup',
    'surgery', 'vaccine', 'vaccination', 'emergency', 'urgent', 'critical',
    'hospitalized', 'accident', 'injury', 'prescription', 'certificate',
    'court', 'legal', 'hearing', 'death', 'funeral', 'transport issue'
  ];

  function calculateStudentCredibilityScore() {
    const text = document.getElementById('reasonText').value;
    let score = 30;
    const textLower = text.toLowerCase();
    const len = text.length;

    // Length scoring (minimum 20 chars is good)
    if (len >= 30 && len <= 200) {
      score += 25;
    } else if (len > 200) {
      score += 30;
    } else if (len >= 15) {
      score += 15;
    } else if (len < 10) {
      score -= 15;
    }

    // Medical/Specific keywords
    if (/doctor|dr\.|hospital|fever|certificate|prescription|parents|parents|symptom|medicine/i.test(text)) {
      score += 30;
    }

    // Other specific keywords
    autoApproveKeywords.forEach(keyword => {
      if (textLower.includes(keyword)) {
        score += 10;
        return;
      }
    });

    // Specific times/dates
    if (/\d{1,2}:\d{2}|am|pm|morning|afternoon|evening|am|pm|yesterday|today|night/i.test(text)) {
      score += 10;
    }

    // Punctuation and grammar
    if (/[.!?]/.test(text)) score += 5;
    if (/^[A-Z]/.test(text)) score += 5;

    // Document attachment (simulate if mentioned)
    if (/attach|upload|document|file|report|certificate/.test(textLower)) {
      score += 15;
    }

    return Math.min(Math.max(score, 0), 100);
  }

  function getSanctionStatusStudent(reason, score) {
    const reasonLower = reason.toLowerCase();
    const reasonLength = reason.length;

    // Medical - High Confidence
    if (reasonLength >= 30) {
      if (/doctor|hospital|medical|appointment|fever|illness|sick/.test(reasonLower)) {
        return {
          status: 'APPROVE',
          confidence: 95,
          autoSanctioned: true,
          message: 'Medical reason with detail - Auto-approved',
          icon: '✓'
        };
      }
    }

    // Emergency
    if (/emergency|critical|hospitalized|accident|injury/.test(reasonLower)) {
      return {
        status: 'APPROVE',
        confidence: 92,
        autoSanctioned: true,
        message: 'Emergency situation - Auto-approved',
        icon: '✓'
      };
    }

    // Bereavement
    if (/death|funeral|passed away/.test(reasonLower)) {
      return {
        status: 'APPROVE',
        confidence: 98,
        autoSanctioned: true,
        message: 'Bereavement - Auto-approved',
        icon: '✓'
      };
    }

    // Vague
    if (reasonLength < 15) {
      return {
        status: 'PENDING',
        confidence: 20,
        autoSanctioned: false,
        message: 'Too vague - Will be reviewed',
        icon: '⏳'
      };
    }

    // Default based on score
    if (score >= 75) {
      return {
        status: 'APPROVE',
        confidence: score,
        autoSanctioned: true,
        message: 'Good credibility - Auto-approved',
        icon: '✓'
      };
    }

    if (score >= 50) {
      return {
        status: 'PENDING',
        confidence: score,
        autoSanctioned: false,
        message: 'Needs review - Class teacher or principal will approve',
        icon: '⏳'
      };
    }

    return {
      status: 'NEED_DOCS',
      confidence: score,
      autoSanctioned: false,
      message: 'Attach a certificate/document for better approval',
      icon: '📄'
    };
  }

  function liveScore() {
    const text = document.getElementById('reasonText').value;
    const len = text.length;
    document.getElementById('charCount').textContent = len;
    
    if (len < 15) {
      document.getElementById('aiFeedback').className = 'ai-feedback';
      return;
    }

    const score = calculateStudentCredibilityScore();
    const sanction = getSanctionStatusStudent(text, score);
    const fb = document.getElementById('aiFeedback');

    let cssClass = 'ai-feedback show';
    let message = '';

    if (sanction.status === 'APPROVE') {
      cssClass += ' good';
      message = `✓ <strong>AI Score: ${Math.round(score)}%</strong> — ${sanction.message}`;
    } else if (sanction.status === 'PENDING') {
      if (score >= 50) {
        cssClass += ' warn';
        message = `⏳ <strong>AI Score: ${Math.round(score)}%</strong> — ${sanction.message}`;
      } else {
        cssClass += ' bad';
        message = `⚠ <strong>AI Score: ${Math.round(score)}%</strong> — ${sanction.message}`;
      }
    } else {
      cssClass += ' warn';
      message = `📄 <strong>AI Score: ${Math.round(score)}%</strong> — ${sanction.message}`;
    }

    fb.className = cssClass;
    fb.innerHTML = message;

    // Update button text
    const btn = document.querySelector('.btn-submit');
    if (sanction.autoSanctioned) {
      btn.style.background = 'var(--green)';
      btn.textContent = '✓ Submit (Will be auto-approved)';
    } else if (sanction.status === 'PENDING') {
      btn.style.background = 'var(--accent)';
      btn.textContent = '⏳ Submit (Pending teacher review)';
    } else {
      btn.style.background = 'var(--accent)';
      btn.textContent = '📄 Submit (with document)';
    }
  }
</script>