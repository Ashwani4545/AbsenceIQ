<?php
/**
 * LEAVE REQUEST PROCESSOR
 * Handles leave request submission with automatic sanction logic
 */

require_once 'leave_sanction_rules.php';

class LeaveRequestProcessor {
    
    private $db_connection;
    private $user_id;
    private $request_date;
    
    public function __construct($db_connection = null, $user_id = null) {
        $this->db_connection = $db_connection;
        $this->user_id = $user_id;
        $this->request_date = date('Y-m-d H:i:s');
    }
    
    /**
     * Process a leave request with automatic sanction
     * 
     * @param array $request_data - Contains leave_type, from_date, to_date, reason
     * @return array - Response with status, message, and sanction details
     */
    public function processLeaveRequest($request_data) {
        
        // Validate input
        $validation = $this->validateRequest($request_data);
        if (!$validation['valid']) {
            return [
                'success' => false,
                'message' => $validation['errors'][0],
                'auto_sanctioned' => false
            ];
        }
        
        $leave_type = $request_data['leave_type'];
        $reason = $request_data['reason'];
        $from_date = $request_data['from_date'];
        $to_date = $request_data['to_date'];
        
        // Calculate credibility score
        $credibility_score = LeaveSanctionRules::calculateCredibilityScore($reason);
        
        // Count consecutive requests (for pattern detection)
        $consecutive_requests = $this->countConsecutiveRequests($from_date);
        
        // Get automatic sanction status
        $sanction = LeaveSanctionRules::getSanctionStatus(
            $reason,
            $leave_type,
            $credibility_score,
            $consecutive_requests
        );
        
        // Prepare request data with auto-sanction status
        $request_record = [
            'user_id' => $this->user_id,
            'leave_type' => $leave_type,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'reason' => $reason,
            'credibility_score' => $credibility_score,
            'sanction_status' => $sanction['status'],
            'auto_sanctioned' => $sanction['auto_sanctioned'] ? 1 : 0,
            'sanction_reason' => $sanction['reason'],
            'rule_matched' => $sanction['rule_matched'],
            'submitted_date' => $this->request_date,
            'updated_date' => $this->request_date,
            'approval_date' => ($sanction['status'] === 'APPROVE') ? $this->request_date : null
        ];
        
        // Save to database (mock function - implement based on your DB)
        $this->saveRequestToDatabase($request_record);
        
        // Prepare response
        return [
            'success' => true,
            'message' => $this->getStatusMessage($sanction),
            'auto_sanctioned' => $sanction['auto_sanctioned'],
            'sanction_status' => $sanction['status'],
            'credibility_score' => $credibility_score,
            'sanction_reason' => $sanction['reason'],
            'request_id' => uniqid('REQ_', true),
            'details' => [
                'leave_type' => $leave_type,
                'duration' => $this->calculateDuration($from_date, $to_date),
                'reason_length' => strlen($reason),
                'rule_matched' => $sanction['rule_matched'],
                'next_action' => $this->getNextAction($sanction['status'])
            ]
        ];
    }
    
    /**
     * Validate leave request data
     */
    private function validateRequest($data) {
        $errors = [];
        
        // Check required fields
        if (empty($data['leave_type'])) $errors[] = 'Leave type is required';
        if (empty($data['from_date'])) $errors[] = 'From date is required';
        if (empty($data['to_date'])) $errors[] = 'To date is required';
        if (empty($data['reason'])) $errors[] = 'Reason is required';
        
        // Validate dates
        if (!empty($data['from_date']) && !empty($data['to_date'])) {
            $from = strtotime($data['from_date']);
            $to = strtotime($data['to_date']);
            
            if ($from === false || $to === false) {
                $errors[] = 'Invalid date format';
            } elseif ($from > $to) {
                $errors[] = 'From date cannot be after To date';
            } elseif ($from < strtotime(date('Y-m-d'))) {
                $errors[] = 'Cannot request leave for past dates';
            }
        }
        
        // Validate reason length (minimum 10 characters for better decisions)
        if (!empty($data['reason']) && strlen(trim($data['reason'])) < 5) {
            $errors[] = 'Reason must be at least 5 characters';
        }
        
        return [
            'valid' => count($errors) === 0,
            'errors' => $errors
        ];
    }
    
    /**
     * Generate user-friendly status message
     */
    private function getStatusMessage($sanction) {
        switch ($sanction['status']) {
            case 'APPROVE':
                return '✓ Your leave has been ' . 
                       ($sanction['auto_sanctioned'] ? 'automatically approved' : 'approved') . 
                       ' (' . $sanction['reason'] . ')';
            case 'PENDING':
                return '⏳ Your leave request is pending HR review (' . $sanction['reason'] . ')';
            case 'REJECT':
                return '✕ Your leave has been rejected (' . $sanction['reason'] . ')';
            default:
                return 'Your leave request has been processed';
        }
    }
    
    /**
     * Get next action based on sanction status
     */
    private function getNextAction($status) {
        switch ($status) {
            case 'APPROVE':
                return 'Your leave has been approved. Check your dashboard for confirmation.';
            case 'PENDING':
                return 'HR will review your request within 1-2 business days.';
            case 'REJECT':
                return 'You can modify your request and resubmit with a different reason.';
            default:
                return 'Check back soon for updates on your request.';
        }
    }
    
    /**
     * Calculate leave duration in days
     */
    private function calculateDuration($from_date, $to_date) {
        $from = new DateTime($from_date);
        $to = new DateTime($to_date);
        $interval = $from->diff($to);
        return $interval->days + 1; // +1 to include both start and end dates
    }
    
    /**
     * Count consecutive requests for pattern detection
     */
    private function countConsecutiveRequests($from_date) {
        // Mock implementation - in real app, query database
        // This would check if user has X consecutive requests in the month
        $month = date('m', strtotime($from_date));
        
        // Simplified: return 0 for now
        // In production: SELECT COUNT(*) FROM leave_requests WHERE user_id = ? AND MONTH(from_date) = ?
        return 0;
    }
    
    /**
     * Save request to database (mock)
     * In real implementation, this would insert into your database
     */
    private function saveRequestToDatabase($record) {
        // TODO: Implement actual database insert
        // Example:
        // $query = "INSERT INTO leave_requests (user_id, leave_type, from_date, to_date, reason, 
        //           credibility_score, sanction_status, auto_sanctioned, sanction_reason, 
        //           rule_matched, submitted_date, approval_date) 
        //           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        // $stmt = $this->db_connection->prepare($query);
        // $stmt->execute([
        //     $record['user_id'], $record['leave_type'], $record['from_date'], $record['to_date'],
        //     $record['reason'], $record['credibility_score'], $record['sanction_status'],
        //     $record['auto_sanctioned'], $record['sanction_reason'], $record['rule_matched'],
        //     $record['submitted_date'], $record['approval_date']
        // ]);
        
        return true;
    }
}

/**
 * API Endpoint: Handle leave request submission
 * 
 * This can be called as:
 * POST /api/submit_leave_request
 * Content-Type: application/json
 * 
 * {
 *   "leave_type": "Sick Leave",
 *   "from_date": "2026-04-15",
 *   "to_date": "2026-04-16",
 *   "reason": "I have a doctor's appointment at 2 PM today for my regular checkup."
 * }
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['PHP_SELF'], 'api/') !== false) {
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Initialize processor (pass actual DB connection if available)
    $processor = new LeaveRequestProcessor(null, $_SESSION['user_id'] ?? 1);
    
    // Process request
    $response = $processor->processLeaveRequest($input);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

?>
