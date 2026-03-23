<?php
require_once 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getDBConnection();
    
    $id = (int)$_POST['order_id'];
    $new_status = $conn->real_escape_string($_POST['status']);
    
    // Validate status
    $allowed_statuses = ['pending', 'processing', 'completed', 'failed', 'refunded'];
    if (!in_array($new_status, $allowed_statuses)) {
        header("Location: admin_dashboard.php?error=invalid_status");
        exit();
    }

    $stmt = $conn->prepare("UPDATE orders SET status = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("si", $new_status, $id);
    
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?success=order_updated");
    } else {
        header("Location: admin_dashboard.php?error=db_error");
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
