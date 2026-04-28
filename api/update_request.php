<?php
session_start();
header('Content-Type: application/json');

require_once '../db_config.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['HR', 'TEACHER'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        $input = $_POST;
    }

    $request_id = $input['request_id'] ?? null;
    $action = $input['action'] ?? null; // 'APPROVE' or 'REJECT'

    if (!$request_id || !in_array($action, ['APPROVE', 'REJECT'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        exit;
    }

    $db = (new Database())->getConnection();

    try {
        $db->beginTransaction();

        // Get old status
        $stmt = $db->prepare("SELECT sanction_status FROM leave_requests WHERE id = ?");
        $stmt->execute([$request_id]);
        $req = $stmt->fetch();

        if (!$req) {
            echo json_encode(['success' => false, 'message' => 'Request not found']);
            $db->rollBack();
            exit;
        }

        $old_status = $req['sanction_status'];

        // Update request
        if ($action === 'APPROVE') {
            $stmt = $db->prepare("UPDATE leave_requests SET sanction_status = 'APPROVE', approval_date = NOW(), approved_by = ? WHERE id = ?");
            $stmt->execute([$_SESSION['user_id'], $request_id]);
        } else {
            $stmt = $db->prepare("UPDATE leave_requests SET sanction_status = 'REJECT', rejection_date = NOW(), rejected_by = ? WHERE id = ?");
            $stmt->execute([$_SESSION['user_id'], $request_id]);
        }

        // Add to audit
        $auditStmt = $db->prepare("
            INSERT INTO leave_sanction_audit 
            (request_id, action, old_status, new_status, action_by, notes)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $auditStmt->execute([$request_id, "MANUAL_$action", $old_status, $action, $_SESSION['user_id'], "Manual action by " . $_SESSION['user_role']]);

        $db->commit();

        echo json_encode(['success' => true, 'new_status' => $action]);

    } catch (PDOException $e) {
        $db->rollBack();
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
