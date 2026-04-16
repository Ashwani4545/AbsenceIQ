<?php
/**
 * IMPLEMENTATION GUIDE - Backend Integration
 * 
 * This file contains example code for integrating the automatic leave sanction
 * system with a real database backend (MySQL/PostgreSQL)
 */

// ============================================================================
// STEP 1: Database Setup
// ============================================================================

$sql_create_table = "
CREATE TABLE IF NOT EXISTS leave_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    leave_type VARCHAR(50) NOT NULL,
    from_date DATE NOT NULL,
    to_date DATE NOT NULL,
    reason LONGTEXT NOT NULL,
    credibility_score INT DEFAULT 50 CHECK (credibility_score >= 0 AND credibility_score <= 100),
    sanction_status ENUM('APPROVE', 'PENDING', 'REJECT') DEFAULT 'PENDING',
    auto_sanctioned BOOLEAN DEFAULT FALSE,
    sanction_reason VARCHAR(255),
    rule_matched VARCHAR(100),
    submitted_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    approval_date TIMESTAMP NULL,
    approval_reason VARCHAR(255),
    approved_by INT NULL,
    rejection_reason VARCHAR(255),
    rejected_by INT NULL,
    rejection_date TIMESTAMP NULL,
    
    INDEX (user_id),
    INDEX (sanction_status),
    INDEX (submitted_date),
    INDEX (auto_sanctioned),
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (approved_by) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (rejected_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS leave_sanction_audit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    request_id INT NOT NULL,
    action VARCHAR(50),
    old_status VARCHAR(50),
    new_status VARCHAR(50),
    action_by INT,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT,
    
    FOREIGN KEY (request_id) REFERENCES leave_requests(id) ON DELETE CASCADE,
    FOREIGN KEY (action_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS leave_sanction_stats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    month VARCHAR(7),
    total_requests INT DEFAULT 0,
    auto_approved INT DEFAULT 0,
    auto_rejected INT DEFAULT 0,
    pending_review INT DEFAULT 0,
    hr_approved INT DEFAULT 0,
    hr_rejected INT DEFAULT 0,
    avg_processing_hours DECIMAL(5,2),
    
    UNIQUE (month)
);
";

// ============================================================================
// STEP 2: Database Connection Class
// ============================================================================

class LeaveDatabase {
    private $conn;
    private $host = 'localhost';
    private $db = 'absenceiq';
    private $user = 'root';
    private $pass = '';
    
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db,
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
    
    /**
     * Submit leave request with automatic sanction
     */
    public function submitLeaveRequest($userId, $leaveType, $fromDate, $toDate, $reason) {
        try {
            // Calculate credibility score
            require_once 'leave_sanction_rules.php';
            $score = LeaveSanctionRules::calculateCredibilityScore($reason);
            
            // Count consecutive requests for pattern detection
            $consecutiveCount = $this->countConsecutiveRequests($userId, $fromDate);
            
            // Get sanction status
            $sanction = LeaveSanctionRules::getSanctionStatus($reason, $leaveType, $score, $consecutiveCount);
            
            // Insert into database
            $stmt = $this->conn->prepare("
                INSERT INTO leave_requests (
                    user_id, leave_type, from_date, to_date, reason,
                    credibility_score, sanction_status, auto_sanctioned,
                    sanction_reason, rule_matched, submitted_date, approval_date
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?
                )
            ");
            
            $approvalDate = ($sanction['status'] === 'APPROVE') ? date('Y-m-d H:i:s') : NULL;
            
            $stmt->execute([
                $userId,
                $leaveType,
                $fromDate,
                $toDate,
                $reason,
                $score,
                $sanction['status'],
                ($sanction['auto_sanctioned'] ? 1 : 0),
                $sanction['reason'],
                $sanction['rule_matched'],
                $approvalDate
            ]);
            
            $requestId = $this->conn->lastInsertId();
            
            // Log to audit trail
            $this->logAudit($requestId, 'SUBMITTED', 'N/A', $sanction['status'], $userId, $sanction['reason']);
            
            // Update stats
            $this->updateStats($fromDate, $sanction['status']);
            
            return [
                'success' => true,
                'request_id' => $requestId,
                'status' => $sanction['status'],
                'auto_sanctioned' => $sanction['auto_sanctioned'],
                'score' => $score,
                'message' => $sanction['reason']
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Count consecutive requests in same month
     */
    private function countConsecutiveRequests($userId, $fromDate) {
        $month = date('Y-m', strtotime($fromDate));
        
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) as count FROM leave_requests
            WHERE user_id = ? AND DATE_FORMAT(from_date, '%Y-%m') = ?
        ");
        
        $stmt->execute([$userId, $month]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['count'] ?? 0;
    }
    
    /**
     * Get pending requests for HR review
     */
    public function getPendingRequests($limit = 20, $offset = 0) {
        $stmt = $this->conn->prepare("
            SELECT 
                lr.id, lr.user_id, lr.leave_type, lr.from_date, lr.to_date,
                lr.reason, lr.credibility_score, lr.sanction_status, 
                lr.auto_sanctioned, lr.sanction_reason, lr.rule_matched,
                lr.submitted_date,
                u.name as employee_name, u.department, u.email
            FROM leave_requests lr
            JOIN users u ON lr.user_id = u.id
            WHERE lr.sanction_status = 'PENDING'
            ORDER BY lr.submitted_date DESC
            LIMIT ? OFFSET ?
        ");
        
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get auto-approved requests (statistics only)
     */
    public function getAutoApprovedRequests($limit = 10) {
        $stmt = $this->conn->prepare("
            SELECT 
                lr.id, lr.user_id, lr.leave_type, lr.from_date, lr.to_date,
                lr.credibility_score, lr.rule_matched, lr.submitted_date,
                u.name as employee_name, u.department
            FROM leave_requests lr
            JOIN users u ON lr.user_id = u.id
            WHERE lr.sanction_status = 'APPROVE' AND lr.auto_sanctioned = TRUE
            ORDER BY lr.submitted_date DESC
            LIMIT ?
        ");
        
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * HR Override - Reject an auto-approved request
     */
    public function overrideRequest($requestId, $newStatus, $reason, $hrUserId) {
        try {
            $stmt = $this->conn->prepare("
                UPDATE leave_requests
                SET sanction_status = ?, approval_reason = ?, approved_by = ?, approval_date = NOW()
                WHERE id = ?
            ");
            
            $stmt->execute([$newStatus, $reason, $hrUserId, $requestId]);
            
            // Log audit
            $oldStmt = $this->conn->prepare("SELECT sanction_status FROM leave_requests WHERE id = ?");
            $oldStmt->execute([$requestId]);
            $oldStatus = $oldStmt->fetch(PDO::FETCH_ASSOC)['sanction_status'];
            
            $this->logAudit($requestId, 'OVERRIDDEN', $oldStatus, $newStatus, $hrUserId, $reason);
            
            return [
                'success' => true,
                'message' => 'Request status updated successfully'
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Log action to audit trail
     */
    private function logAudit($requestId, $action, $oldStatus, $newStatus, $userId, $notes) {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO leave_sanction_audit 
                (request_id, action, old_status, new_status, action_by, notes)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([$requestId, $action, $oldStatus, $newStatus, $userId, $notes]);
        } catch (Exception $e) {
            error_log("Audit log error: " . $e->getMessage());
        }
    }
    
    /**
     * Update statistics
     */
    private function updateStats($date, $status) {
        try {
            $month = date('Y-m', strtotime($date));
            $countColumn = '';
            
            if ($status === 'APPROVE') {
                $countColumn = 'auto_approved';
            } elseif ($status === 'PENDING') {
                $countColumn = 'pending_review';
            }
            
            if ($countColumn) {
                $stmt = $this->conn->prepare("
                    INSERT INTO leave_sanction_stats (month, total_requests, $countColumn)
                    VALUES (?, 1, 1)
                    ON DUPLICATE KEY UPDATE 
                        total_requests = total_requests + 1,
                        $countColumn = $countColumn + 1
                ");
                
                $stmt->execute([$month]);
            }
        } catch (Exception $e) {
            error_log("Stats update error: " . $e->getMessage());
        }
    }
    
    /**
     * Get monthly statistics
     */
    public function getStatistics($month = null) {
        if (!$month) {
            $month = date('Y-m');
        }
        
        $stmt = $this->conn->prepare("
            SELECT * FROM leave_sanction_stats WHERE month = ?
        ");
        
        $stmt->execute([$month]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
    }
    
    /**
     * Get request by ID
     */
    public function getRequestById($requestId) {
        $stmt = $this->conn->prepare("
            SELECT 
                lr.*, 
                u.name as employee_name, u.email, u.department,
                au.name as approved_by_name
            FROM leave_requests lr
            JOIN users u ON lr.user_id = u.id
            LEFT JOIN users au ON lr.approved_by = au.id
            WHERE lr.id = ?
        ");
        
        $stmt->execute([$requestId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get audit trail for a request
     */
    public function getAuditTrail($requestId) {
        $stmt = $this->conn->prepare("
            SELECT 
                lsa.*,
                u.name as action_by_name
            FROM leave_sanction_audit lsa
            LEFT JOIN users u ON lsa.action_by = u.id
            WHERE request_id = ?
            ORDER BY action_date DESC
        ");
        
        $stmt->execute([$requestId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// ============================================================================
// STEP 3: API Endpoints Example
// ============================================================================

// api/submit_leave_request.php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $db = new LeaveDatabase();
    
    $result = $db->submitLeaveRequest(
        $_SESSION['user_id'],
        $input['leave_type'],
        $input['from_date'],
        $input['to_date'],
        $input['reason']
    );
    
    header('Content-Type: application/json');
    echo json_encode($result);
}
*/

// api/get_pending_requests.php
/*
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new LeaveDatabase();
    $requests = $db->getPendingRequests(20, 0);
    
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'count' => count($requests),
        'data' => $requests
    ]);
}
*/

// api/override_request.php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $db = new LeaveDatabase();
    
    $result = $db->overrideRequest(
        $input['request_id'],
        $input['new_status'],
        $input['reason'],
        $_SESSION['user_id']
    );
    
    header('Content-Type: application/json');
    echo json_encode($result);
}
*/

// ============================================================================
// STEP 4: Email Notifications (Optional)
// ============================================================================

class LeaveNotifications {
    
    public static function notifyAutoApproved($requestId, $employeeEmail, $leaveDates) {
        $subject = "✓ Your Leave Request Has Been Auto-Approved!";
        $message = "Your leave request for $leaveDates has been automatically approved.\n";
        $message .= "No further action needed. Your leave is confirmed.";
        
        // mail($employeeEmail, $subject, $message);
    }
    
    public static function notifyPendingReview($requestId, $employeeEmail, $reason) {
        $subject = "⏳ Your Leave Request is Under Review";
        $message = "Your leave request has been submitted and is pending HR review.\n";
        $message .= "Reason: $reason\n";
        $message .= "You'll be notified once approved or if more information is needed.";
        
        // mail($employeeEmail, $subject, $message);
    }
    
    public static function notifyHRPendingRequests($count) {
        $subject = "📋 $count Leave Requests Pending Review";
        $message = "$count leave requests are pending your review.\n";
        $message .= "Log in to the dashboard to review them.";
        
        // Admin email notification
    }
}

// ============================================================================
// STEP 5: Usage Example
// ============================================================================

/*

// Initialize database
$db = new LeaveDatabase();

// Employee submits leave request
$response = $db->submitLeaveRequest(
    user_id: 123,
    leaveType: 'Sick Leave',
    fromDate: '2026-04-15',
    toDate: '2026-04-16',
    reason: 'I have a doctor\'s appointment at 2 PM for my annual checkup.'
);

// Response:
{
    "success": true,
    "request_id": 456,
    "status": "APPROVE",
    "auto_sanctioned": true,
    "score": 92,
    "message": "Medical reason with sufficient detail - Auto-approved"
}

// Get HR pending requests
$pending = $db->getPendingRequests(20, 0);

// HR overrides a request
$override = $db->overrideRequest(
    requestId: 456,
    newStatus: 'REJECT',
    reason: 'Employee called in - no leave needed',
    hrUserId: 999
);

// Get statistics
$stats = $db->getStatistics('2026-04');

*/

?>

<!-- ============================================================================
     STEP 6: Frontend Update (JavaScript)
     ============================================================================ -->

<!-- Update the form submission in emp_dash.php to call the backend API: -->

<script>
document.querySelector('form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = {
        leave_type: document.querySelector('select[name="leave_type"]').value,
        from_date: document.querySelector('input[name="from_date"]').value,
        to_date: document.querySelector('input[name="to_date"]').value,
        reason: document.querySelector('textarea[name="reason"]').value
    };

    try {
        const response = await fetch('api/submit_leave_request.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            if (result.auto_sanctioned) {
                alert(`✓ AUTO-APPROVED!\n\nYour leave has been approved.\nRequest ID: ${result.request_id}`);
            } else {
                alert(`⏳ Submitted for Review\n\nYour request is pending HR approval.\nRequest ID: ${result.request_id}`);
            }
            document.querySelector('form').reset();
        }
    } catch (error) {
        alert('Error submitting request: ' + error.message);
    }
});
</script>
