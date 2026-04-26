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

  .topbar-right {
    display: flex;
    gap: .6rem
  }

  .btn-sm {
    padding: .45rem .9rem;
    border-radius: 8px;
    font-size: .8rem;
    font-family: var(--sans);
    cursor: pointer;
    border: 1px solid var(--border);
    background: var(--card);
    color: var(--ink2);
    font-weight: 500
  }

  .btn-dark {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent)
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

  /* STATS */
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: .75rem;
    margin-bottom: 1.25rem
  }

  .stat-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: .9rem 1rem
  }

  .stat-card .lbl {
    font-size: .7rem;
    color: var(--ink3);
    margin-bottom: .25rem;
    font-weight: 500
  }

  .stat-card .val {
    font-size: 1.5rem;
    font-family: var(--serif)
  }

  .stat-card .sub {
    font-size: .7rem;
    color: var(--ink3);
    margin-top: .2rem
  }

  /* CLASS TABS */
  .class-tabs {
    display: flex;
    gap: .4rem;
    margin-bottom: 1rem;
    flex-wrap: wrap
  }

  .ctab {
    padding: .35rem .85rem;
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

  .ctab:hover {
    border-color: #bbb
  }

  .ctab.active {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent)
  }

  /* STUDENT TABLE */
  .stu-table {
    width: 100%;
    border-collapse: collapse
  }

  .stu-table th {
    font-size: .7rem;
    font-weight: 500;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: var(--ink3);
    padding: .4rem .5rem;
    text-align: left;
    border-bottom: 1px solid var(--border)
  }

  .stu-table td {
    padding: .55rem .5rem;
    font-size: .8rem;
    border-bottom: 1px solid var(--border)
  }

  .stu-table tr:last-child td {
    border-bottom: none
  }

  .stu-table tr:hover td {
    background: var(--surface)
  }

  .risk-dot {
    display: inline-block;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    margin-right: .35rem
  }

  .attn-bar-bg {
    width: 80px;
    height: 5px;
    background: var(--border);
    border-radius: 999px;
    overflow: hidden;
    display: inline-block;
    vertical-align: middle
  }

  .attn-bar {
    height: 100%;
    border-radius: 999px
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
    font-weight: 500;
    margin-right: .25rem
  }

  .act-btn:hover {
    border-color: #aaa
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

  /* EXCUSE REVIEW */
  .excuse-item {
    padding: .75rem 0;
    border-bottom: 1px solid var(--border)
  }

  .excuse-item:last-child {
    border-bottom: none
  }

  .excuse-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: .35rem
  }

  .excuse-top h4 {
    font-size: .82rem;
    font-weight: 500
  }

  .excuse-text {
    font-size: .78rem;
    color: var(--ink2);
    background: var(--surface);
    border-radius: 6px;
    padding: .5rem .7rem;
    margin-bottom: .4rem;
    line-height: 1.55;
    border-left: 2px solid var(--border)
  }

  .excuse-meta {
    display: flex;
    align-items: center;
    gap: .6rem;
    flex-wrap: wrap
  }

  .excuse-score {
    font-size: .75rem;
    display: flex;
    align-items: center;
    gap: .3rem
  }

  .score-pill {
    padding: .15rem .55rem;
    border-radius: 999px;
    font-size: .7rem;
    font-weight: 500
  }

  .score-high {
    background: var(--green-bg);
    color: var(--green)
  }

  .score-mid {
    background: var(--amber-bg);
    color: var(--amber)
  }

  .score-low {
    background: var(--red-bg);
    color: var(--red)
  }

  .excuse-actions {
    display: flex;
    gap: .35rem;
    margin-left: auto
  }

  .grid2 {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
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
    .stat-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    .stu-table {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }
  }
</style>

<div class="shell">
  <aside class="sidebar">
    <div class="sb-logo">AbsenceIQ</div>
    <div class="sb-section">Main</div>
    <div class="sb-item active">▦ Dashboard</div>
    <div class="sb-item">📋 Excuse Inbox <span class="sb-badge">7</span></div>
    <div class="sb-item">👥 Students</div>
    <div class="sb-item">📅 Attendance</div>
    <div class="sb-section">Tools</div>
    <div class="sb-item">📊 Reports</div>
    <div class="sb-item">🔔 Alerts <span class="sb-badge">2</span></div>
    <div class="sb-item">⚙ Settings</div>
    <div class="sb-footer">
      <div class="sb-avatar">MF</div>
      <div class="sb-user">
        <h4>Ms. Fernandez</h4>
        <p>Class Teacher</p>
      </div>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div class="topbar-left">
        <h2>Teacher Dashboard</h2>
        <p>Tuesday, 14 April 2026</p>
      </div>
      <div class="topbar-right">
        <button class="btn-sm">Export report</button>
        <button class="btn-sm btn-dark">Mark attendance</button>
      </div>
    </div>

    <div class="content">
      <div class="stat-grid">
        <div class="stat-card">
          <div class="lbl">Present Today</div>
          <div class="val" style="color:var(--green)">34</div>
          <div class="sub">of 40 students</div>
        </div>
        <div class="stat-card">
          <div class="lbl">Absent Today</div>
          <div class="val" style="color:var(--red)">6</div>
          <div class="sub">2 unexcused</div>
        </div>
        <div class="stat-card">
          <div class="lbl">Pending Excuses</div>
          <div class="val" style="color:var(--amber)">7</div>
          <div class="sub">needs review</div>
        </div>
        <div class="stat-card">
          <div class="lbl">At-Risk Students</div>
          <div class="val" style="color:var(--red)">3</div>
          <div class="sub">&lt;75% attendance</div>
        </div>
      </div>

      <div class="grid2">
        <!-- STUDENT LIST -->
        <div class="card">
          <div class="card-head">
            <h3>Student Attendance</h3>
            <div class="class-tabs">
              <button class="ctab active">10-A</button>
              <button class="ctab">10-B</button>
              <button class="ctab">10-C</button>
            </div>
          </div>
          <table class="stu-table">
            <thead>
              <tr>
                <th>Student</th>
                <th>Absences</th>
                <th>Attendance</th>
                <th>Risk</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Aarav Patel</strong></td>
                <td>2</td>
                <td>
                  <div class="attn-bar-bg">
                    <div class="attn-bar" style="width:94%;background:var(--green)"></div>
                  </div> 94%
                </td>
                <td><span class="risk-dot" style="background:var(--green)"></span>Low</td>
                <td><span class="badge badge-green">Good</span></td>
              </tr>
              <tr>
                <td><strong>Priya Iyer</strong></td>
                <td>8</td>
                <td>
                  <div class="attn-bar-bg">
                    <div class="attn-bar" style="width:78%;background:#ef9f27"></div>
                  </div> 78%
                </td>
                <td><span class="risk-dot" style="background:#ef9f27"></span>Med</td>
                <td><span class="badge badge-amber">Watch</span></td>
              </tr>
              <tr>
                <td><strong>Rohan Das</strong></td>
                <td>14</td>
                <td>
                  <div class="attn-bar-bg">
                    <div class="attn-bar" style="width:63%;background:var(--red)"></div>
                  </div> 63%
                </td>
                <td><span class="risk-dot" style="background:var(--red)"></span>High</td>
                <td><span class="badge badge-red">At risk</span></td>
              </tr>
              <tr>
                <td><strong>Sneha Gupta</strong></td>
                <td>1</td>
                <td>
                  <div class="attn-bar-bg">
                    <div class="attn-bar" style="width:98%;background:var(--green)"></div>
                  </div> 98%
                </td>
                <td><span class="risk-dot" style="background:var(--green)"></span>Low</td>
                <td><span class="badge badge-green">Good</span></td>
              </tr>
              <tr>
                <td><strong>Kiran Sharma</strong></td>
                <td>11</td>
                <td>
                  <div class="attn-bar-bg">
                    <div class="attn-bar" style="width:70%;background:var(--red)"></div>
                  </div> 70%
                </td>
                <td><span class="risk-dot" style="background:var(--red)"></span>High</td>
                <td><span class="badge badge-red">At risk</span></td>
              </tr>
              <tr>
                <td><strong>Ananya Nair</strong></td>
                <td>5</td>
                <td>
                  <div class="attn-bar-bg">
                    <div class="attn-bar" style="width:85%;background:var(--green)"></div>
                  </div> 85%
                </td>
                <td><span class="risk-dot" style="background:#ef9f27"></span>Med</td>
                <td><span class="badge badge-amber">Watch</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- EXCUSE REVIEW -->
        <div class="card">
          <div class="card-head">
            <h3>Excuse Review Inbox</h3><a href="#">All →</a>
          </div>
          <div class="excuse-item">
            <div class="excuse-top">
              <h4>Rohan Das <span style="font-weight:400;color:var(--ink3)">— Apr 12</span></h4>
              <span class="score-pill score-high">AI: 91%</span>
            </div>
            <div class="excuse-text">"Had high fever and doctor advised complete rest for two days. Medical certificate attached."</div>
            <div class="excuse-meta">
              <span class="badge badge-blue">Sick</span>
              <div class="excuse-actions">
                <button class="act-btn act-approve">✓ Accept</button>
                <button class="act-btn act-reject">✕ Reject</button>
              </div>
            </div>
          </div>
          <div class="excuse-item">
            <div class="excuse-top">
              <h4>Kiran Sharma <span style="font-weight:400;color:var(--ink3)">— Apr 11</span></h4>
              <span class="score-pill score-low">AI: 24%</span>
            </div>
            <div class="excuse-text">"Was not feeling well and couldn't come."</div>
            <div class="excuse-meta">
              <span class="badge badge-red">Flagged</span>
              <div class="excuse-actions">
                <button class="act-btn act-approve">✓ Accept</button>
                <button class="act-btn act-reject">✕ Reject</button>
              </div>
            </div>
          </div>
          <div class="excuse-item">
            <div class="excuse-top">
              <h4>Priya Iyer <span style="font-weight:400;color:var(--ink3)">— Apr 10</span></h4>
              <span class="score-pill score-mid">AI: 62%</span>
            </div>
            <div class="excuse-text">"Family function that was unavoidable. Parents were informed."</div>
            <div class="excuse-meta">
              <span class="badge badge-amber">Personal</span>
              <div class="excuse-actions">
                <button class="act-btn act-approve">✓ Accept</button>
                <button class="act-btn act-reject">✕ Reject</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>