-- phpMyAdmin SQL Dump
-- Database: `absenceiq`
--

CREATE DATABASE IF NOT EXISTS `absenceiq`;
USE `absenceiq`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('HR','EMPLOYEE','TEACHER','STUDENT') NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT IGNORE INTO `users` (`id`, `name`, `email`, `password`, `role`, `department`) VALUES
(1, 'Dummy Employee', 'dummy@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EMPLOYEE', 'Engineering'); -- password is 'password'

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE IF NOT EXISTS `leave_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` longtext NOT NULL,
  `credibility_score` int(11) DEFAULT 50 CHECK (`credibility_score` >= 0 and `credibility_score` <= 100),
  `sanction_status` enum('APPROVE','PENDING','REJECT') DEFAULT 'PENDING',
  `auto_sanctioned` tinyint(1) DEFAULT 0,
  `sanction_reason` varchar(255) DEFAULT NULL,
  `rule_matched` varchar(100) DEFAULT NULL,
  `submitted_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `approval_date` timestamp NULL DEFAULT NULL,
  `approval_reason` varchar(255) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `rejection_reason` varchar(255) DEFAULT NULL,
  `rejected_by` int(11) DEFAULT NULL,
  `rejection_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `sanction_status` (`sanction_status`),
  KEY `submitted_date` (`submitted_date`),
  KEY `auto_sanctioned` (`auto_sanctioned`),
  CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leave_requests_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `leave_requests_ibfk_3` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_sanction_audit`
--

CREATE TABLE IF NOT EXISTS `leave_sanction_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) DEFAULT NULL,
  `action_by` int(11) DEFAULT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `action_by` (`action_by`),
  CONSTRAINT `leave_sanction_audit_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `leave_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leave_sanction_audit_ibfk_2` FOREIGN KEY (`action_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_sanction_stats`
--

CREATE TABLE IF NOT EXISTS `leave_sanction_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(7) DEFAULT NULL,
  `total_requests` int(11) DEFAULT 0,
  `auto_approved` int(11) DEFAULT 0,
  `auto_rejected` int(11) DEFAULT 0,
  `pending_review` int(11) DEFAULT 0,
  `hr_approved` int(11) DEFAULT 0,
  `hr_rejected` int(11) DEFAULT 0,
  `avg_processing_hours` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `month` (`month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
