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
    --accent2: #16213e;
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
    --sidebar: 220px;
  }

  body {
    font-family: var(--sans);
    background: var(--surface);
    color: var(--ink);
    font-size: 14px;
    line-height: 1.6
  }

  /* SHELL */
  .shell {
    display: grid;
    grid-template-columns: var(--sidebar) 1fr;
    min-height: 100vh
  }

  /* SIDEBAR */
  .sidebar {
    background: var(--accent);
    color: #fff;
    display: flex;
    flex-direction: column;
    padding: 0
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
    transition: all .15s;
    border-left: 2px solid transparent;
    margin: .05rem 0
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

  .sb-icon {
    width: 16px;
    text-align: center;
    font-size: .85rem
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

  /* MAIN */
  .main {
    display: flex;
    flex-direction: column;
    overflow: hidden
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

  .topbar-right {
    display: flex;
    align-items: center;
    gap: .75rem
  }

  .notif-btn {
    position: relative;
    background: none;
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: .45rem .65rem;
    cursor: pointer;
    font-size: .85rem;
    color: var(--ink2)
  }

  .notif-dot {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #e24b4a
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

  /* CONTENT */
  .content {
    padding: 1.5rem 1.75rem;
    overflow-y: auto;
    flex: 1
  }

  /* STAT CARDS */
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .85rem;
    margin-bottom: 1.5rem
  }

  .stat-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.1rem 1.1rem .9rem
  }

  .stat-card .label {
    font-size: .72rem;
    color: var(--ink3);
    margin-bottom: .35rem;
    font-weight: 500;
    letter-spacing: .03em
  }

  .stat-card .value {
    font-size: 1.6rem;
    font-family: var(--serif);
    color: var(--ink);
    line-height: 1
  }

  .stat-card .delta {
    font-size: .72rem;
    margin-top: .4rem;
    display: flex;
    align-items: center;
    gap: .25rem
  }

  .up {
    color: var(--green)
  }

  .down {
    color: var(--red)
  }

  .neu {
    color: var(--ink3)
  }

  .stat-card .bar-bg {
    height: 3px;
    background: var(--border);
    border-radius: 999px;
    margin-top: .65rem
  }

  .stat-card .bar-fill {
    height: 3px;
    border-radius: 999px
  }

  /* GRID 2COL */
  .grid2 {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: .85rem;
    margin-bottom: 1.5rem
  }

  /* CARD */
  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 1.1rem
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

  /* REQUESTS TABLE */
  .req-table {
    width: 100%;
    border-collapse: collapse
  }

  .req-table th {
    font-size: .7rem;
    font-weight: 500;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--ink3);
    padding: .4rem .5rem;
    text-align: left;
    border-bottom: 1px solid var(--border)
  }

  .req-table td {
    padding: .6rem .5rem;
    font-size: .8rem;
    border-bottom: 1px solid var(--border)
  }

  .req-table tr:last-child td {
    border-bottom: none
  }

  .req-table tr:hover td {
    background: var(--surface)
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

  .ai-score {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .75rem
  }

  .score-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%
  }

  .action-btns {
    display: flex;
    gap: .35rem
  }

  .act-btn {
    padding: .2rem .55rem;
    border-radius: 6px;
    font-size: .7rem;
    font-family: var(--sans);
    cursor: pointer;
    border: 1px solid var(--border);
    background: none;
    color: var(--ink2);
    font-weight: 500
  }

  .act-btn:hover {
    border-color: #aaa;
    color: var(--ink)
  }

  .act-approve {
    background: var(--green-bg);
    color: var(--green);
    border-color: var(--green-b)
  }

  .act-reject {
    background: var(--red-bg);
    color: var(--red);
    border-color: var(--red-b)
  }

  /* CHART BAR */
  .chart-bars {
    display: flex;
    align-items: flex-end;
    gap: .4rem;
    height: 100px;
    margin-top: .5rem
  }

  .bar-col {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .3rem
  }

  .bar-col .bar {
    width: 100%;
    border-radius: 4px 4px 0 0;
    transition: opacity .15s;
    cursor: pointer
  }

  .bar-col .bar:hover {
    opacity: .75
  }

  .bar-col span {
    font-size: .65rem;
    color: var(--ink3)
  }

  /* DEPT LIST */
  .dept-item {
    display: flex;
    align-items: center;
    gap: .65rem;
    padding: .5rem 0;
    border-bottom: 1px solid var(--border)
  }

  .dept-item:last-child {
    border-bottom: none
  }

  .dept-name {
    font-size: .8rem;
    flex: 1
  }

  .dept-count {
    font-size: .75rem;
    color: var(--ink3);
    min-width: 30px;
    text-align: right
  }

  .dept-bar-bg {
    flex: 2;
    height: 5px;
    background: var(--border);
    border-radius: 999px;
    overflow: hidden
  }

  .dept-bar {
    height: 100%;
    border-radius: 999px;
    background: var(--accent)
  }

  /* ALERT ITEMS */
  .alert-item {
    display: flex;
    align-items: flex-start;
    gap: .65rem;
    padding: .65rem 0;
    border-bottom: 1px solid var(--border)
  }

  .alert-item:last-child {
    border-bottom: none
  }

  .alert-ico {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    flex-shrink: 0
  }

  .alert-body h4 {
    font-size: .8rem;
    font-weight: 500;
    margin-bottom: .1rem
  }

  .alert-body p {
    font-size: .75rem;
    color: var(--ink3);
    line-height: 1.45
  }

  .alert-time {
    font-size: .68rem;
    color: var(--ink3);
    white-space: nowrap;
    margin-left: auto
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
    .stat-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    .req-table {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }
  }
</style>

<div class="shell">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sb-logo">AbsenceIQ</div>

    <div class="sb-section">Main</div>
    <div class="sb-item active"><span class="sb-icon">▦</span> Dashboard</div>
    <div class="sb-item"><span class="sb-icon">📋</span> Leave Requests <span class="sb-badge">12</span></div>
    <div class="sb-item"><span class="sb-icon">👥</span> Employees</div>
    <div class="sb-item"><span class="sb-icon">📊</span> Analytics</div>

    <div class="sb-section">Management</div>
    <div class="sb-item"><span class="sb-icon">⚙</span> Leave Policies</div>
    <div class="sb-item"><span class="sb-icon">📅</span> Calendar</div>
    <div class="sb-item"><span class="sb-icon">🔔</span> Alerts <span class="sb-badge">3</span></div>
    <div class="sb-item"><span class="sb-icon">📤</span> Reports</div>

    <div class="sb-section">Account</div>
    <div class="sb-item"><span class="sb-icon">⚙</span> Settings</div>

    <div class="sb-footer">
      <div class="sb-avatar">PS</div>
      <div class="sb-user">
        <h4>Priya Sharma</h4>
        <p>HR Manager</p>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="main">
    <div class="topbar">
      <div class="topbar-left">
        <h2>HR Dashboard</h2>
        <p>Tuesday, 14 April 2026</p>
      </div>
      <div class="topbar-right">
        <button class="notif-btn">🔔<span class="notif-dot"></span></button>
        <button class="btn-sm btn-dark">+ New Policy</button>
      </div>
    </div>

    <div class="content">
      <!-- STAT CARDS -->
      <div class="stat-grid">
        <div class="stat-card">
          <div class="label">Pending Requests</div>
          <div class="value">12</div>
          <div class="delta up">↑ 3 since yesterday</div>
          <div class="bar-bg">
            <div class="bar-fill" style="width:60%;background:#1a7a4a"></div>
          </div>
        </div>
        <div class="stat-card">
          <div class="label">Approved This Month</div>
          <div class="value">47</div>
          <div class="delta neu">→ Same as last month</div>
          <div class="bar-bg">
            <div class="bar-fill" style="width:75%;background:#185fa5"></div>
          </div>
        </div>
        <div class="stat-card">
          <div class="label">AI Flagged</div>
          <div class="value">4</div>
          <div class="delta down">↑ 2 need review</div>
          <div class="bar-bg">
            <div class="bar-fill" style="width:30%;background:#e24b4a"></div>
          </div>
        </div>
        <div class="stat-card">
          <div class="label">Avg. Processing Time</div>
          <div class="value">1.2<span style="font-size:1rem;font-family:var(--sans);color:var(--ink3)">d</span></div>
          <div class="delta up">↓ 0.4d faster this week</div>
          <div class="bar-bg">
            <div class="bar-fill" style="width:85%;background:#8a5c00"></div>
          </div>
        </div>
      </div>

      <!-- REQUESTS + ALERTS -->
      <div class="grid2">
        <!-- REQUESTS -->
        <div class="card">
          <div class="card-head">
            <h3>Recent Leave Requests</h3>
            <a href="#">View all →</a>
          </div>
          <table class="req-table">
            <thead>
              <tr>
                <th>Employee</th>
                <th>Type</th>
                <th>Dates</th>
                <th>AI Score</th>
                <th>Status</th>
                <th>Auto-Sanction</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Arjun Mehta</strong><br><span style="color:var(--ink3);font-size:.72rem">Engineering</span></td>
                <td>Sick Leave</td>
                <td>Apr 15–16</td>
                <td><span class="ai-score"><span class="score-dot" style="background:#1a7a4a"></span>94%</span></td>
                <td><span class="badge badge-green">Approved</span></td>
                <td><span class="badge badge-green" style="background:var(--green-bg);color:var(--green);border:1px solid var(--green-b)">✓ Auto</span></td>
                <td>
                  <div class="action-btns"><button class="act-btn">View</button></div>
                </td>
              </tr>
              <tr>
                <td><strong>Sneha Roy</strong><br><span style="color:var(--ink3);font-size:.72rem">Marketing</span></td>
                <td>Casual Leave</td>
                <td>Apr 18</td>
                <td><span class="ai-score"><span class="score-dot" style="background:#1a7a4a"></span>88%</span></td>
                <td><span class="badge badge-green">Approved</span></td>
                <td><span class="badge badge-green" style="background:var(--green-bg);color:var(--green);border:1px solid var(--green-b)">✓ Auto</span></td>
                <td>
                  <div class="action-btns"><button class="act-btn">View</button></div>
                </td>
              </tr>
              <tr>
                <td><strong>Ravi Kumar</strong><br><span style="color:var(--ink3);font-size:.72rem">Sales</span></td>
                <td>Sick Leave</td>
                <td>Apr 14–17</td>
                <td><span class="ai-score"><span class="score-dot" style="background:#e24b4a"></span>31%</span></td>
                <td><span class="badge badge-red">Flagged</span></td>
                <td><span class="badge badge-amber" style="background:var(--amber-bg);color:var(--amber);border:1px solid var(--amber-b)">⏳ Pending</span></td>
                <td>
                  <div class="action-btns"><button class="act-btn act-approve">✓</button><button class="act-btn act-reject">✕</button></div>
                </td>
              </tr>
              <tr>
                <td><strong>Meera Nair</strong><br><span style="color:var(--ink3);font-size:.72rem">HR</span></td>
                <td>Maternity</td>
                <td>May 1–Jun 30</td>
                <td><span class="ai-score"><span class="score-dot" style="background:#1a7a4a"></span>99%</span></td>
                <td><span class="badge badge-green">Approved</span></td>
                <td><span class="badge badge-green" style="background:var(--green-bg);color:var(--green);border:1px solid var(--green-b)">✓ Auto</span></td>
                <td>
                  <div class="action-btns"><button class="act-btn">View</button></div>
                </td>
              </tr>
              <tr>
                <td><strong>Karan Singh</strong><br><span style="color:var(--ink3);font-size:.72rem">Finance</span></td>
                <td>Sick Leave</td>
                <td>Apr 14</td>
                <td><span class="ai-score"><span class="score-dot" style="background:#ef9f27"></span>58%</span></td>
                <td><span class="badge badge-amber">Pending</span></td>
                <td><span class="badge badge-amber" style="background:var(--amber-bg);color:var(--amber);border:1px solid var(--amber-b)">⏳ Pending</span></td>
                <td>
                  <div class="action-btns"><button class="act-btn act-approve">✓</button><button class="act-btn act-reject">✕</button></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- RIGHT COL -->
        <div style="display:flex;flex-direction:column;gap:.85rem">
          <!-- ALERTS -->
          <div class="card">
            <div class="card-head">
              <h3>AI Alerts & Auto-Sanctioning</h3><a href="#">All alerts →</a>
            </div>
            <div class="alert-item">
              <div class="alert-ico" style="background:var(--green-bg);color:var(--green)">✓</div>
              <div class="alert-body">
                <h4>Auto-approved: Arjun Mehta</h4>
                <p>Sick Leave (Apr 15–16) — Medical reason with high credibility detected</p>
              </div>
              <div class="alert-time">2m ago</div>
            </div>
            <div class="alert-item">
              <div class="alert-ico" style="background:var(--green-bg);color:var(--green)">✓</div>
              <div class="alert-body">
                <h4>Auto-approved: Meera Nair</h4>
                <p>Maternity Leave (May 1–Jun 30) — Bereavement/Special circumstance detected</p>
              </div>
              <div class="alert-time">15m ago</div>
            </div>
            <div class="alert-item">
              <div class="alert-ico" style="background:var(--red-bg);color:var(--red)">⚑</div>
              <div class="alert-body">
                <h4>Flagged for review: Ravi Kumar</h4>
                <p>Sick Leave — Monday pattern detected (5 consecutive Monday absences)</p>
              </div>
              <div class="alert-time">1h ago</div>
            </div>
            <div class="alert-item">
              <div class="alert-ico" style="background:var(--amber-bg);color:var(--amber)">⚠</div>
              <div class="alert-body">
                <h4>Low credibility: Karan Singh</h4>
                <p>Casual Leave — Reason too vague ("Personal matter"). Requires manual review.</p>
              </div>
              <div class="alert-time">2h ago</div>
            </div>
          </div>

          <!-- DEPT BREAKDOWN -->
          <div class="card">
            <div class="card-head">
              <h3>By Department</h3><a href="#">Analytics →</a>
            </div>
            <div class="dept-item">
              <div class="dept-name">Engineering</div>
              <div class="dept-bar-bg">
                <div class="dept-bar" style="width:80%"></div>
              </div>
              <div class="dept-count">8</div>
            </div>
            <div class="dept-item">
              <div class="dept-name">Sales</div>
              <div class="dept-bar-bg">
                <div class="dept-bar" style="width:65%"></div>
              </div>
              <div class="dept-count">6</div>
            </div>
            <div class="dept-item">
              <div class="dept-name">Marketing</div>
              <div class="dept-bar-bg">
                <div class="dept-bar" style="width:40%"></div>
              </div>
              <div class="dept-count">4</div>
            </div>
            <div class="dept-item">
              <div class="dept-name">Finance</div>
              <div class="dept-bar-bg">
                <div class="dept-bar" style="width:30%"></div>
              </div>
              <div class="dept-count">3</div>
            </div>
            <div class="dept-item">
              <div class="dept-name">HR</div>
              <div class="dept-bar-bg">
                <div class="dept-bar" style="width:15%"></div>
              </div>
              <div class="dept-count">1</div>
            </div>
          </div>
        </div>
      </div>

      <!-- MONTHLY TREND -->
      <div class="card">
        <div class="card-head">
          <h3>Monthly Absence Trend</h3><a href="#">Full report →</a>
        </div>
        <div class="chart-bars">
          <div class="bar-col">
            <div class="bar" style="height:45px;background:var(--accent);opacity:.3"></div><span>Nov</span>
          </div>
          <div class="bar-col">
            <div class="bar" style="height:60px;background:var(--accent);opacity:.4"></div><span>Dec</span>
          </div>
          <div class="bar-col">
            <div class="bar" style="height:80px;background:var(--accent);opacity:.5"></div><span>Jan</span>
          </div>
          <div class="bar-col">
            <div class="bar" style="height:55px;background:var(--accent);opacity:.4"></div><span>Feb</span>
          </div>
          <div class="bar-col">
            <div class="bar" style="height:70px;background:var(--accent);opacity:.5"></div><span>Mar</span>
          </div>
          <div class="bar-col">
            <div class="bar" style="height:90px;background:var(--accent)"></div><span>Apr</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>