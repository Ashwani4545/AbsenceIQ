<?php
// setup_db.php
$host = '127.0.0.1';
$username = 'root';
$password = '';

try {
    // Connect to MySQL server without selecting a database
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $conn->exec("CREATE DATABASE IF NOT EXISTS absenceiq");
    echo "Database created successfully.\n";
    
    // Use the newly created database
    $conn->exec("USE absenceiq");
    
    // Create users table
    $usersTable = "
    CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('HR', 'EMPLOYEE', 'TEACHER', 'STUDENT') NOT NULL,
        department VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($usersTable);
    echo "Table 'users' created.\n";

    // Create a dummy user for testing
    $dummyUser = "
    INSERT IGNORE INTO users (id, name, email, password, role, department) 
    VALUES (1, 'Dummy Employee', 'dummy@example.com', 'password', 'EMPLOYEE', 'Engineering')";
    $conn->exec($dummyUser);
    echo "Dummy user created.\n";
    
    // Create leave_requests table
    $leaveRequestsTable = "
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
        updated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
    )";
    $conn->exec($leaveRequestsTable);
    echo "Table 'leave_requests' created.\n";
    
    // Create leave_sanction_audit table
    $auditTable = "
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
    )";
    $conn->exec($auditTable);
    echo "Table 'leave_sanction_audit' created.\n";
    
    // Create leave_sanction_stats table
    $statsTable = "
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
    )";
    $conn->exec($statsTable);
    echo "Table 'leave_sanction_stats' created.\n";
    
    echo "Setup completed successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
