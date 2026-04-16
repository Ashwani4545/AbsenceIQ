<?php
/**
 * AUTOMATIC LEAVE SANCTION RULES ENGINE
 * Defines rules for automatically approving/rejecting leave requests based on reason keywords
 */

class LeaveSanctionRules {
    
    /**
     * Define sanction rules for different leave types and reason patterns
     */
    public static $AUTO_SANCTION_RULES = [
        
        // MEDICAL/HEALTH REASONS - AUTO APPROVE
        'medical_high_confidence' => [
            'type' => 'APPROVE',
            'min_reason_length' => 20,
            'keywords' => [
                'doctor', 'hospital', 'medical', 'clinic', 'appointment',
                'treatment', 'surgery', 'checkup', 'prescription', 'vaccine',
                'vaccination', 'consultation', 'sick', 'illness', 'fever',
                'flu', 'cough', 'cold', 'infection', 'diagnosed',
                'emergency room', 'er', 'dental', 'dentist', 'ophthalmologist'
            ],
            'confidence_score' => 95,
            'reason_prefix' => 'Medical'
        ],
        
        // FAMILY EMERGENCY - AUTO APPROVE
        'emergency_high_confidence' => [
            'type' => 'APPROVE',
            'min_reason_length' => 15,
            'keywords' => [
                'emergency', 'urgent', 'critical', 'hospitalized',
                'accident', 'death', 'passed away', 'funeral',
                'family emergency', 'crisis', 'tragedy', 'injured',
                'serious', 'critical condition', 'icu', 'intensive care'
            ],
            'confidence_score' => 92,
            'reason_prefix' => 'Emergency'
        ],
        
        // DEATH/BEREAVEMENT - AUTO APPROVE
        'bereavement' => [
            'type' => 'APPROVE',
            'min_reason_length' => 10,
            'keywords' => [
                'death', 'died', 'passed away', 'funeral', 'mourning',
                'bereavement', 'cremation', 'burial', 'condolences',
                'relative passed', 'family death'
            ],
            'confidence_score' => 98,
            'reason_prefix' => 'Bereavement'
        ],
        
        // LEGAL/COURT MATTERS - AUTO APPROVE
        'legal_matters' => [
            'type' => 'APPROVE',
            'min_reason_length' => 15,
            'keywords' => [
                'court', 'legal', 'hearing', 'lawyer', 'attorney',
                'litigation', 'case', 'subpoena', 'deposition',
                'police', 'fir', 'complaint', 'document submission'
            ],
            'confidence_score' => 90,
            'reason_prefix' => 'Legal'
        ],
        
        // VAGUE/SUSPICIOUS REASONS - FLAG FOR REVIEW
        'vague_low_confidence' => [
            'type' => 'PENDING',
            'max_reason_length' => 10,
            'keywords_absent' => true, // Flag if no verified keywords found
            'confidence_score' => 25,
            'suspicious_words' => ['busy', 'stuff', 'things', 'personal', 'reason']
        ],
        
        // REPETITIVE PATTERN - FLAG IF EXCESSIVE
        'pattern_abuse' => [
            'type' => 'PENDING',
            'flag_if_count_exceeds' => 3, // More than 3 in same month
            'flag_if_pattern' => 'monday_friday', // No leave between Tue-Thu
            'confidence_score' => 40,
            'reason_prefix' => 'Pattern Alert'
        ]
    ];
    
    /**
     * Get auto sanction status for a leave request
     * 
     * @param string $reason - The leave reason provided by employee
     * @param string $leave_type - Type of leave (Sick, Casual, etc.)
     * @param int $reason_quality - AI credibility score (0-100)
     * @param int $consecutive_requests - Number of consecutive requests in period
     * 
     * @return array ['status' => 'APPROVE|PENDING|REJECT', 'confidence' => score, 'message' => reason]
     */
    public static function getSanctionStatus($reason, $leave_type = null, $reason_quality = 50, $consecutive_requests = 0) {
        
        $reason_lower = strtolower(trim($reason));
        $reason_length = strlen($reason_lower);
        $matched_rule = null;
        $best_score = 0;
        
        // Check MEDICAL reasons
        if (self::containsKeywords($reason_lower, self::$AUTO_SANCTION_RULES['medical_high_confidence']['keywords'])) {
            if ($reason_length >= self::$AUTO_SANCTION_RULES['medical_high_confidence']['min_reason_length']) {
                return [
                    'status' => 'APPROVE',
                    'confidence' => 95,
                    'auto_sanctioned' => true,
                    'reason' => 'Medical reason with sufficient detail - Auto-approved',
                    'rule_matched' => 'medical_high_confidence'
                ];
            }
        }
        
        // Check EMERGENCY reasons
        if (self::containsKeywords($reason_lower, self::$AUTO_SANCTION_RULES['emergency_high_confidence']['keywords'])) {
            if ($reason_length >= self::$AUTO_SANCTION_RULES['emergency_high_confidence']['min_reason_length']) {
                return [
                    'status' => 'APPROVE',
                    'confidence' => 92,
                    'auto_sanctioned' => true,
                    'reason' => 'Emergency situation - Auto-approved',
                    'rule_matched' => 'emergency_high_confidence'
                ];
            }
        }
        
        // Check BEREAVEMENT
        if (self::containsKeywords($reason_lower, self::$AUTO_SANCTION_RULES['bereavement']['keywords'])) {
            return [
                'status' => 'APPROVE',
                'confidence' => 98,
                'auto_sanctioned' => true,
                'reason' => 'Bereavement leave - Auto-approved',
                'rule_matched' => 'bereavement'
            ];
        }
        
        // Check LEGAL matters
        if (self::containsKeywords($reason_lower, self::$AUTO_SANCTION_RULES['legal_matters']['keywords'])) {
            if ($reason_length >= self::$AUTO_SANCTION_RULES['legal_matters']['min_reason_length']) {
                return [
                    'status' => 'APPROVE',
                    'confidence' => 90,
                    'auto_sanctioned' => true,
                    'reason' => 'Legal matter - Auto-approved',
                    'rule_matched' => 'legal_matters'
                ];
            }
        }
        
        // Check for VAGUE/LOW QUALITY reasons
        if ($reason_length <= 10 || self::containsKeywords($reason_lower, self::$AUTO_SANCTION_RULES['vague_low_confidence']['suspicious_words'])) {
            return [
                'status' => 'PENDING',
                'confidence' => 25,
                'auto_sanctioned' => false,
                'reason' => 'Reason too vague or lacks detail - Requires HR review',
                'rule_matched' => 'vague_low_confidence'
            ];
        }
        
        // Check for PATTERN ABUSE
        if ($consecutive_requests >= 3) {
            return [
                'status' => 'PENDING',
                'confidence' => 40,
                'auto_sanctioned' => false,
                'reason' => 'Multiple consecutive requests - Flagged for review',
                'rule_matched' => 'pattern_abuse'
            ];
        }
        
        // DEFAULT: If AI confidence is high, auto-approve; otherwise pending
        if ($reason_quality >= 75) {
            return [
                'status' => 'APPROVE',
                'confidence' => $reason_quality,
                'auto_sanctioned' => true,
                'reason' => 'Good credibility score and reasonable explanation',
                'rule_matched' => 'default_quality_based'
            ];
        }
        
        // DEFAULT: Pending review
        return [
            'status' => 'PENDING',
            'confidence' => $reason_quality,
            'auto_sanctioned' => false,
            'reason' => 'Requires HR review for final approval',
            'rule_matched' => 'default_pending_review'
        ];
    }
    
    /**
     * Check if reason contains any of the keywords
     */
    private static function containsKeywords($reason_text, $keywords) {
        foreach ($keywords as $keyword) {
            if (strpos($reason_text, strtolower($keyword)) !== false) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * Calculate AI Credibility Score based on reason quality
     * 
     * @param string $reason - The leave reason
     * @return int - Score between 0-100
     */
    public static function calculateCredibilityScore($reason) {
        $score = 50; // Base score
        $reason_lower = strtolower(trim($reason));
        $reason_length = strlen($reason_lower);
        
        // Length scoring (20-100 chars is optimal)
        if ($reason_length >= 20 && $reason_length <= 100) {
            $score += 15;
        } elseif ($reason_length > 100) {
            $score += 20; // Detailed reasons score higher
        } elseif ($reason_length < 10) {
            $score -= 25; // Too short
        }
        
        // Medical keywords boost
        $medical_words = ['doctor', 'hospital', 'medical', 'clinic', 'appointment', 'treatment'];
        if (self::containsKeywords($reason_lower, $medical_words)) {
            $score += 20;
        }
        
        // Professional tone
        $professional_words = ['appointment', 'matter', 'situation', 'condition', 'required'];
        if (self::containsKeywords($reason_lower, $professional_words)) {
            $score += 10;
        }
        
        // Specific dates/times boost
        if (preg_match('/\d{1,2}:\d{2}|am|pm|morning|afternoon|evening/', $reason_lower)) {
            $score += 15;
        }
        
        // Punctuation and proper grammar
        $quality_chars = 0;
        if (preg_match('/[.!?]/', $reason)) $quality_chars++;
        if (preg_match('/^[A-Z]/', $reason)) $quality_chars++; // Starts with capital
        $score += ($quality_chars * 5);
        
        // Cap score at 100
        return min($score, 100);
    }
    
    /**
     * Get all high-confidence keywords for auto-approval
     */
    public static function getAutoApproveKeywords() {
        $keywords = array_merge(
            self::$AUTO_SANCTION_RULES['medical_high_confidence']['keywords'],
            self::$AUTO_SANCTION_RULES['emergency_high_confidence']['keywords'],
            self::$AUTO_SANCTION_RULES['bereavement']['keywords'],
            self::$AUTO_SANCTION_RULES['legal_matters']['keywords']
        );
        return array_unique($keywords);
    }
}

?>
