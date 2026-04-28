<?php
session_start();
header('Content-Type: application/json');

require_once '../db_config.php';
require_once '../leave_sanction_rules.php';

// Instantiate DB
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized. Please log in.']);
        exit;
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input) {
        // Fallback for form data
        $input = $_POST;
    }

    $leave_type = $input['leave_type'] ?? '';
    $from_date = $input['from_date'] ?? '';
    $to_date = $input['to_date'] ?? '';
    $reason = $input['reason'] ?? '';
    $user_id = $_SESSION['user_id'];

    // Validation
    if (empty($leave_type) || empty($from_date) || empty($to_date) || empty($reason)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    try {
        $score = LeaveSanctionRules::calculateCredibilityScore($reason);
        $consecutiveCount = 0; // In real logic, count consecutive requests

        $sanction = LeaveSanctionRules::getSanctionStatus($reason, $leave_type, $score, $consecutiveCount);
        
        $approvalDate = ($sanction['status'] === 'APPROVE') ? date('Y-m-d H:i:s') : NULL;

        $stmt = $db->prepare("
            INSERT INTO leave_requests (
                user_id, leave_type, from_date, to_date, reason,
                credibility_score, sanction_status, auto_sanctioned,
                sanction_reason, rule_matched, submitted_date, approval_date
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?
            )
        ");

        $stmt->execute([
            $user_id,
            $leave_type,
            $from_date,
            $to_date,
            $reason,
            $score,
            $sanction['status'],
            ($sanction['autoSanctioned'] ?? $sanction['auto_sanctioned'] ?? false) ? 1 : 0,
            $sanction['message'] ?? $sanction['reason'],
            $sanction['rule_matched'] ?? '',
            $approvalDate
        ]);

        $requestId = $db->lastInsertId();

        // Audit log
        $auditStmt = $db->prepare("
            INSERT INTO leave_sanction_audit 
            (request_id, action, old_status, new_status, action_by, notes)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $auditStmt->execute([$requestId, 'SUBMITTED', 'N/A', $sanction['status'], $user_id, $sanction['message'] ?? $sanction['reason']]);

        echo json_encode([
            'success' => true,
            'request_id' => $requestId,
            'status' => $sanction['status'],
            'auto_sanctioned' => ($sanction['autoSanctioned'] ?? $sanction['auto_sanctioned'] ?? false),
            'score' => $score,
            'message' => $sanction['message'] ?? $sanction['reason']
        ]);
        
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
