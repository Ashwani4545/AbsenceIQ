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

  /* LEAVE BALANCE */
  .balance-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .75rem;
    margin-bottom: 1.25rem
  }

  .bal-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 1rem;
    text-align: center
  }

  .bal-num {
    font-family: var(--serif);
    font-size: 1.8rem;
    line-height: 1;
    margin-bottom: .2rem
  }

  .bal-label {
    font-size: .72rem;
    color: var(--ink3)
  }

  .bal-sub {
    font-size: .7rem;
    color: var(--ink3);
    margin-top: .25rem
  }

  .bal-ring {
    width: 48px;
    height: 48px;
    margin: 0 auto .5rem;
    position: relative
  }

  .bal-ring svg {
    transform: rotate(-90deg)
  }

  /* SUBMIT FORM */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .75rem
  }

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
    min-height: 70px
  }

  .ai-preview {
    background: var(--blue-bg);
    border: 1px solid var(--blue-b);
    border-radius: 8px;
    padding: .75rem;
    font-size: .78rem;
    color: var(--blue);
    margin-bottom: .85rem;
    display: none
  }

  .ai-preview.show {
    display: block
  }

  .btn-submit {
    padding: .65rem 1.4rem;
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .82rem;
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
    width: 32px;
    height: 32px;
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

  .hist-right {
    text-align: right
  }

  .hist-right .days {
    font-size: .8rem;
    font-weight: 500
  }

  .hist-right .date {
    font-size: .7rem;
    color: var(--ink3)
  }

  /* AI SCORE BAR */
  .ai-bar-wrap {
    margin-top: .4rem
  }

  .ai-bar-label {
    display: flex;
    justify-content: space-between;
    font-size: .7rem;
    color: var(--ink3);
    margin-bottom: .25rem
  }

  .ai-bar-bg {
    height: 4px;
    background: var(--border);
    border-radius: 999px;
    overflow: hidden
  }

  .ai-bar-fill {
    height: 100%;
    border-radius: 999px
  }

  .grid2 {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: .85rem
  }

  @media(max-width: 768px) {
    .shell {
      display: flex;
      flex-direction: column;
    }
    .sidebar {
      flex-direction: row;
      overflow-x: auto;
      white-space: nowrap;
      padding: 0.5rem;
    }
    .sb-logo, .sb-section, .sb-footer {
      display: none;
    }
    .sb-item {
      padding: 0.4rem 0.8rem;
      border-left: none;
      border-bottom: 2px solid transparent;
      margin: 0;
    }
    .sb-item.active {
      border-left-color: transparent;
      border-bottom-color: rgba(255, 255, 255, .5);
      background: rgba(255, 255, 255, .1);
    }
    .grid2 {
      grid-template-columns: 1fr;
    }
    .balance-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    .form-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="shell">
  <aside class="sidebar">
    <div class="sb-logo">AbsenceIQ</div>
    <div class="sb-section">Main</div>
    <div class="sb-item active">▦ Dashboard</div>
    <div class="sb-item">📋 My Requests</div>
    <div class="sb-item">📅 Calendar</div>
    <div class="sb-section">Account</div>
    <div class="sb-item">🔔 Notifications</div>
    <div class="sb-item">⚙ Settings</div>
    <div class="sb-footer">
      <div class="sb-avatar">AK</div>
      <div class="sb-user">
        <h4>Arjun Mehta</h4>
        <p>Engineering</p>
      </div>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div class="topbar-left">
        <h2>My Dashboard</h2>
        <p>Tuesday, 14 April 2026</p>
      </div>
      <button class="btn-sm btn-dark">+ New Request</button>
    </div>

    <div class="content">
      <!-- BALANCE -->
      <div class="card">
        <div class="card-head">
          <h3>Leave Balance — FY 2026</h3><a href="#">Full breakdown →</a>
        </div>
        <div class="balance-grid">
          <div class="bal-card">
            <div class="bal-num" style="color:var(--green)">8</div>
            <div class="bal-label">Sick Leave</div>
            <div class="bal-sub">4 used · 12 total</div>
          </div>
          <div class="bal-card">
            <div class="bal-num" style="color:var(--blue)">5</div>
            <div class="bal-label">Casual Leave</div>
            <div class="bal-sub">3 used · 8 total</div>
          </div>
          <div class="bal-card">
            <div class="bal-num" style="color:var(--amber)">12</div>
            <div class="bal-label">Annual Leave</div>
            <div class="bal-sub">6 used · 18 total</div>
          </div>
          <div class="bal-card">
            <div class="bal-num" style="color:var(--ink3)">2</div>
            <div class="bal-label">Comp Off</div>
            <div class="bal-sub">0 used · 2 total</div>
          </div>
        </div>
      </div>

      <div class="grid2">
        <!-- SUBMIT FORM -->
        <div class="card">
          <div class="card-head">
            <h3>Submit Leave Request</h3>
          </div>
          <form method="POST" action="submit-request.php">
            <input type="hidden" name="csrf_token" value="">
            <div class="form-grid">
              <div class="field">
                <label>Leave type</label>
                <select name="leave_type" onchange="previewAI()">
                  <option value="">Select type</option>
                  <option>Sick Leave</option>
                  <option>Casual Leave</option>
                  <option>Annual Leave</option>
                  <option>Comp Off</option>
                </select>
              </div>
              <div class="field">
                <label>Number of days</label>
                <input type="number" name="days" min="1" max="30" placeholder="1">
              </div>
              <div class="field">
                <label>From date</label>
                <input type="date" name="from_date">
              </div>
              <div class="field">
                <label>To date</label>
                <input type="date" name="to_date">
              </div>
            </div>
            <div class="field">
              <label>Reason <span style="color:var(--ink3);font-weight:400">(be specific — helps AI validation)</span></label>
              <textarea name="reason" id="reasonField" placeholder="e.g. Doctor's appointment for routine checkup at 2 PM..." oninput="previewAI()"></textarea>
              <div class="char-count"><span id="charCount">0</span>/500</div>
            </div>
            
            <!-- AI SANCTION PREVIEW -->
            <div class="ai-preview" id="aiPreview">
              🤖 AI preview: Your reason looks credible. Estimated approval score: <strong id="scoreText">50</strong>%. 
              <span id="sanctionHint"></span>
            </div>
            
            <!-- AUTO-SANCTION ALERT -->
            <div id="sanctionAlert" style="display:none;border-radius:8px;padding:.75rem 1rem;font-size:.78rem;margin-bottom:.85rem;line-height:1.6;border:1px solid #ccc;">
              <div style="display:flex;align-items:center;gap:.5rem;">
                <span id="sanctionIcon" style="font-size:1.2rem;"></span>
                <div>
                  <strong id="sanctionTitle"></strong><br>
                  <span id="sanctionMessage" style="font-size:.75rem;opacity:.9"></span>
                </div>
              </div>
            </div>
            
            <button type="submit" class="btn-submit" id="submitBtn">Submit request →</button>
          </form>
        </div>

        <!-- HISTORY -->
        <div class="card">
          <div class="card-head">
            <h3>Request History</h3><a href="#">All →</a>
          </div>
          <div class="hist-item">
            <div class="hist-icon" style="background:var(--red-bg);color:var(--red)">🤒</div>
            <div class="hist-body">
              <h4>Sick Leave</h4>
              <p>Mar 3 – Mar 4, 2026</p>
              <div class="ai-bar-wrap">
                <div class="ai-bar-label"><span>AI score</span><span>94%</span></div>
                <div class="ai-bar-bg">
                  <div class="ai-bar-fill" style="width:94%;background:var(--green)"></div>
                </div>
              </div>
            </div>
            <div class="hist-right">
              <div class="days">2d</div><span class="badge badge-green">Approved</span>
            </div>
          </div>
          <div class="hist-item">
            <div class="hist-icon" style="background:var(--blue-bg);color:var(--blue)">🏖</div>
            <div class="hist-body">
              <h4>Annual Leave</h4>
              <p>Feb 10 – Feb 14, 2026</p>
              <div class="ai-bar-wrap">
                <div class="ai-bar-label"><span>AI score</span><span>99%</span></div>
                <div class="ai-bar-bg">
                  <div class="ai-bar-fill" style="width:99%;background:var(--green)"></div>
                </div>
              </div>
            </div>
            <div class="hist-right">
              <div class="days">5d</div><span class="badge badge-green">Approved</span>
            </div>
          </div>
          <div class="hist-item">
            <div class="hist-icon" style="background:var(--amber-bg);color:var(--amber)">📋</div>
            <div class="hist-body">
              <h4>Casual Leave</h4>
              <p>Jan 22, 2026</p>
              <div class="ai-bar-wrap">
                <div class="ai-bar-label"><span>AI score</span><span>61%</span></div>
                <div class="ai-bar-bg">
                  <div class="ai-bar-fill" style="width:61%;background:#ef9f27"></div>
                </div>
              </div>
            </div>
            <div class="hist-right">
              <div class="days">1d</div><span class="badge badge-amber">Reviewed</span>
            </div>
          </div>
          <div class="hist-item">
            <div class="hist-icon" style="background:var(--red-bg);color:var(--red)">✕</div>
            <div class="hist-body">
              <h4>Sick Leave</h4>
              <p>Jan 6, 2026</p>
              <div class="ai-bar-wrap">
                <div class="ai-bar-label"><span>AI score</span><span>28%</span></div>
                <div class="ai-bar-bg">
                  <div class="ai-bar-fill" style="width:28%;background:var(--red)"></div>
                </div>
              </div>
            </div>
            <div class="hist-right">
              <div class="days">1d</div><span class="badge badge-red">Rejected</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // Auto-approval keywords
  const autoApproveKeywords = [
    'doctor', 'hospital', 'medical', 'clinic', 'appointment', 'treatment', 'surgery',
    'checkup', 'consultation', 'sick', 'illness', 'fever', 'flu', 'cough', 'infection',
    'emergency', 'urgent', 'critical', 'hospitalized', 'accident', 'death', 'funeral',
    'passed away', 'court', 'legal', 'hearing', 'lawyer', 'police'
  ];

  function calculateCredibilityScore() {
    const reason = document.querySelector('textarea[name="reason"]').value;
    let score = 50;
    const reasonLower = reason.toLowerCase();
    const reasonLength = reason.length;

    // Length scoring
    if (reasonLength >= 20 && reasonLength <= 100) {
      score += 15;
    } else if (reasonLength > 100) {
      score += 20;
    } else if (reasonLength < 10) {
      score -= 25;
    }

    // Keyword matching
    autoApproveKeywords.forEach(keyword => {
      if (reasonLower.includes(keyword)) {
        score += 20;
        return;
      }
    });

    // Professional tone
    const professionalWords = ['appointment', 'matter', 'situation', 'condition', 'required'];
    if (professionalWords.some(w => reasonLower.includes(w))) {
      score += 10;
    }

    // Specific times/dates
    if (/\d{1,2}:\d{2}|am|pm|morning|afternoon|evening/.test(reasonLower)) {
      score += 15;
    }

    // Punctuation
    if (/[.!?]/.test(reason)) score += 5;
    if (/^[A-Z]/.test(reason)) score += 5;

    return Math.min(Math.max(score, 0), 100);
  }

  function getSanctionStatus(reason, score) {
    const reasonLower = reason.toLowerCase();
    const reasonLength = reason.length;

    // Medical - High Confidence
    if (reasonLength >= 20) {
      if (reasonLower.includes('doctor') || reasonLower.includes('hospital') || 
          reasonLower.includes('medical') || reasonLower.includes('appointment')) {
        return {
          status: 'APPROVE',
          confidence: 95,
          autoSanctioned: true,
          message: 'Medical reason with sufficient detail',
          icon: '✓'
        };
      }
    }

    // Emergency - High Confidence
    if (reasonLength >= 15) {
      if (reasonLower.includes('emergency') || reasonLower.includes('critical') || 
          reasonLower.includes('hospitalized')) {
        return {
          status: 'APPROVE',
          confidence: 92,
          autoSanctioned: true,
          message: 'Emergency situation detected',
          icon: '✓'
        };
      }
    }

    // Bereavement
    if (reasonLower.includes('death') || reasonLower.includes('funeral') || 
        reasonLower.includes('passed away')) {
      return {
        status: 'APPROVE',
        confidence: 98,
        autoSanctioned: true,
        message: 'Bereavement leave approved',
        icon: '✓'
      };
    }

    // Legal matters
    if (reasonLength >= 15) {
      if (reasonLower.includes('court') || reasonLower.includes('legal') || 
          reasonLower.includes('hearing')) {
        return {
          status: 'APPROVE',
          confidence: 90,
          autoSanctioned: true,
          message: 'Legal matter approved',
          icon: '✓'
        };
      }
    }

    // Vague reason
    if (reasonLength <= 10) {
      return {
        status: 'PENDING',
        confidence: 25,
        autoSanctioned: false,
        message: 'Reason too vague - will be reviewed by HR',
        icon: '⏳'
      };
    }

    // Default based on score
    if (score >= 75) {
      return {
        status: 'APPROVE',
        confidence: score,
        autoSanctioned: true,
        message: 'Good credibility score - Auto-approved',
        icon: '✓'
      };
    }

    return {
      status: 'PENDING',
      confidence: score,
      autoSanctioned: false,
      message: 'Will be reviewed by HR',
      icon: '⏳'
    };
  }

  function previewAI() {
    const reason = document.querySelector('textarea[name="reason"]').value;
    const type = document.querySelector('select[name="leave_type"]').value;
    const preview = document.getElementById('aiPreview');
    const sanctionAlert = document.getElementById('sanctionAlert');
    const charCount = document.getElementById('charCount');
    const scoreText = document.getElementById('scoreText');
    const sanctionHint = document.getElementById('sanctionHint');

    // Update character count
    charCount.textContent = reason.length;

    if (reason.length > 10 && type) {
      // Calculate score
      const score = calculateCredibilityScore();
      scoreText.textContent = score;
      
      // Get sanction status
      const sanction = getSanctionStatus(reason, score);
      
      // Show preview
      preview.classList.add('show');
      sanctionHint.textContent = sanction.message + '.';
      
      // Show sanction alert if auto-approved or flagged
      if (sanction.autoSanctioned || sanction.status !== 'PENDING') {
        sanctionAlert.style.display = 'flex';
        document.getElementById('sanctionIcon').textContent = sanction.icon;
        document.getElementById('sanctionTitle').textContent = 
          sanction.status === 'APPROVE' ? '✓ Auto-Approved!' : '⏳ Under Review';
        document.getElementById('sanctionMessage').textContent = sanction.message;
        
        // Color coding
        if (sanction.status === 'APPROVE') {
          sanctionAlert.style.background = 'var(--green-bg)';
          sanctionAlert.style.borderColor = 'var(--green-b)';
          sanctionAlert.style.color = 'var(--green)';
          document.getElementById('sanctionTitle').style.color = 'var(--green)';
        } else if (sanction.status === 'PENDING') {
          sanctionAlert.style.background = 'var(--amber-bg)';
          sanctionAlert.style.borderColor = 'var(--amber-b)';
          sanctionAlert.style.color = 'var(--amber)';
          document.getElementById('sanctionTitle').style.color = 'var(--amber)';
        }
        
        // Update submit button hint
        document.getElementById('submitBtn').textContent = 
          sanction.autoSanctioned ? '✓ Submit (Will be auto-approved)' : '⏳ Submit (Pending review)';
      } else {
        sanctionAlert.style.display = 'none';
        document.getElementById('submitBtn').textContent = 'Submit request →';
      }
    } else {
      preview.classList.remove('show');
      sanctionAlert.style.display = 'none';
      document.getElementById('submitBtn').textContent = 'Submit request →';
    }
  }

  // Form submission
  document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = {
      leave_type: document.querySelector('select[name="leave_type"]').value,
      from_date: document.querySelector('input[name="from_date"]').value,
      to_date: document.querySelector('input[name="to_date"]').value,
      reason: document.querySelector('textarea[name="reason"]').value
    };

    // Validate
    if (!formData.leave_type || !formData.from_date || !formData.to_date || !formData.reason) {
      alert('Please fill all fields');
      return;
    }

    // Show processing
    const btn = document.getElementById('submitBtn');
    const originalText = btn.textContent;
    btn.textContent = '⏳ Processing...';
    btn.disabled = true;

    try {
      // Send to backend API
      const response = await fetch('api/submit_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      const result = await response.json();

      if (result.success) {
        alert(`✓ Request Submitted!\n\nStatus: ${result.status}\nCredibility: ${result.score}%\n${result.message}`);
        document.querySelector('form').reset();
        previewAI();
      } else {
        alert('Error: ' + result.message);
      }
      btn.textContent = originalText;
      btn.disabled = false;

    } catch (error) {
      alert('Error submitting request. Please try again.');
      btn.textContent = originalText;
      btn.disabled = false;
    }
  });
</script>