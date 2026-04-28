<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'db_config.php';
$db = (new Database())->getConnection();

$stmt = $db->prepare("SELECT name, email, role, department, created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}

$initials = strtoupper(substr($user['name'], 0, 1));
$parts = explode(' ', $user['name']);
if (count($parts) > 1) {
    $initials .= strtoupper(substr($parts[count($parts)-1], 0, 1));
}

// Determine back link based on role
$backLink = 'emp_dash.php';
switch ($user['role']) {
    case 'HR':
        $backLink = 'hr_dash.php';
        break;
    case 'TEACHER':
        $backLink = 'teahcer_dash.php';
        break;
    case 'STUDENT':
        $backLink = 'student_dash.php';
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - AbsenceIQ</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=DM+Serif+Display&display=swap');
        
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
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--sans);
            background: var(--surface);
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .profile-card {
            background: var(--card);
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            max-width: 450px;
            width: 100%;
            text-align: center;
            border: 1px solid var(--border);
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 500;
            margin: 0 auto 1.5rem;
            letter-spacing: 1px;
        }

        .name {
            font-family: var(--serif);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .role {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--ink2);
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .details {
            text-align: left;
            margin-bottom: 2.5rem;
        }

        .detail-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--ink3);
        }

        .detail-value {
            font-weight: 500;
            font-size: 0.95rem;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-outline {
            border: 1px solid var(--border);
            color: var(--ink);
            background: transparent;
        }

        .btn-outline:hover {
            border-color: var(--ink3);
        }

        .btn-dark {
            background: var(--accent);
            color: #fff;
            border: none;
        }

        .btn-dark:hover {
            background: #2a2a4e;
        }
    </style>
</head>
<body>

<div class="profile-card">
    <div class="avatar"><?php echo htmlspecialchars($initials); ?></div>
    <h1 class="name"><?php echo htmlspecialchars($user['name']); ?></h1>
    <div class="role"><?php echo htmlspecialchars($user['role']); ?></div>

    <div class="details">
        <div class="detail-item">
            <span class="detail-label">Email Address</span>
            <span class="detail-value"><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Organization / Dept</span>
            <span class="detail-value"><?php echo htmlspecialchars($user['department'] ?: 'N/A'); ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Member Since</span>
            <span class="detail-value"><?php echo date('M j, Y', strtotime($user['created_at'])); ?></span>
        </div>
    </div>

    <div class="actions">
        <a href="<?php echo $backLink; ?>" class="btn btn-outline">← Back to Dashboard</a>
        <a href="logout.php" class="btn btn-dark">Sign Out</a>
    </div>
</div>

</body>
</html>
