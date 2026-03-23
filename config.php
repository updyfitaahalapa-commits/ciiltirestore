<?php
// config.php - Configuration file for database connection

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pubg_uc_store');

// Site settings
define('SITE_NAME', 'PUBG UC Store');
define('SITE_URL', 'http://localhost');
define('ADMIN_EMAIL', 'admin@pubguc.com');
define('SUPPORT_EMAIL', 'support@pubguc.com');

// Payment settings (example - replace with your actual payment gateway credentials)
define('PAYMENT_GATEWAY', 'stripe'); // or 'paypal', 'razorpay', etc.
define('PAYMENT_API_KEY', 'your_payment_api_key');
define('PAYMENT_SECRET_KEY', 'your_payment_secret_key');

// Email settings
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your_email@gmail.com');
define('SMTP_PASS', 'your_email_password');
define('SMTP_FROM', 'noreply@pubguc.com');
define('SMTP_FROM_NAME', 'PUBG UC Store');

// Security settings
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds
define('MAX_LOGIN_ATTEMPTS', 5);
define('CSRF_TOKEN_NAME', 'csrf_token');

// UC delivery settings
define('AUTO_DELIVERY', true);
define('DELIVERY_DELAY', 300); // 5 minutes in seconds
define('MAX_DELIVERY_ATTEMPTS', 3);

// Create database connection function
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        die("Sorry, we're experiencing technical difficulties. Please try again later.");
    }
    
    $conn->set_charset("utf8mb4");
    return $conn;
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set timezone
date_default_timezone_set('UTC');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Set to 0 in production
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log');
?>
