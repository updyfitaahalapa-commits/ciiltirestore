<?php
// process_order.php - Dynamically handles order submission
require_once 'config.php';
$conn = getDBConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and sanitize
    $player_id = $conn->real_escape_string($_POST['playerId']);
    $game_name = $conn->real_escape_string($_POST['gameName']);
    $package_amount = $conn->real_escape_string($_POST['package']); // This is the UC amount from select
    $payment_number = $conn->real_escape_string($_POST['paymentNumber']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']);
    $email = ""; // Removed from UI as per user request
    
    // Fetch price from database to ensure accuracy (Vulnerability Fix: No more hardcoded array)
    $stmt = $conn->prepare("SELECT price FROM packages WHERE uc_amount = ? AND is_active = 1 LIMIT 1");
    $stmt->bind_param("s", $package_amount);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row['price'];
    } else {
        // Fallback or error if package not found
        header("Location: checkout.php?error=invalid_package");
        exit();
    }
    $stmt->close();
    
    // Validate required fields
    if (empty($player_id) || empty($game_name) || empty($package_amount) || empty($payment_number) || empty($payment_method)) {
        header("Location: checkout.php?error=missing_fields");
        exit();
    }

    
    // Handle user ID for history tracking
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    // Generate unique Order ID
    $order_id = 'CT-' . strtoupper(substr(uniqid(), -8));
    $order_date = date('Y-m-d H:i:s');
    $status = 'pending';
    
    // Secure Insertion using Prepared Statements
    $stmt = $conn->prepare("INSERT INTO orders (order_id, user_id, player_id, game_name, package_uc, price, email, payment_number, payment_method, status, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssdsssss", $order_id, $user_id, $player_id, $game_name, $package_amount, $price, $email, $payment_number, $payment_method, $status, $order_date);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect to payment instructions page
        header("Location: payment.php?order_id=" . urlencode($order_id));
        exit();
    } else {
        error_log("Order Insertion Error: " . $stmt->error);
        $stmt->close();
        $conn->close();
        header("Location: checkout.php?error=db_error");
        exit();
    }
    
} else {
    $conn->close();
    header("Location: index.php");
    exit();
}
?>
