<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $conn = getDBConnection();
    $action = $_POST['action'];

    if ($action == 'register') {
        $full_name = $conn->real_escape_string($_POST['full_name']);
        $country_code = $conn->real_escape_string($_POST['country_code']);
        $mobile_number = $conn->real_escape_string($_POST['mobile_number']);
        $region = $conn->real_escape_string($_POST['region']);
        $district = $conn->real_escape_string($_POST['district']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validation
        if ($password !== $confirm_password) {
            header("Location: register.php?error=password_mismatch");
            exit();
        }

        // Check if user exists
        $check_sql = "SELECT id FROM users WHERE mobile_number = '$mobile_number'";
        $result = $conn->query($check_sql);
        if ($result->num_rows > 0) {
            header("Location: register.php?error=user_exists");
            exit();
        }

        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $sql = "INSERT INTO users (full_name, country_code, mobile_number, region, district, password_hash) 
                VALUES ('$full_name', '$country_code', '$mobile_number', '$region', '$district', '$password_hash')";

        if ($conn->query($sql) === TRUE) {
            $redirect_url = "login.php?success=1";
            if (isset($_POST['package'])) {
                $redirect_url .= "&package=" . urlencode($_POST['package']);
            }
            header("Location: $redirect_url");
            exit();
        } else {
            header("Location: register.php?error=db_error");
            exit();
        }
    }

    if ($action == 'login') {
        $login_identifier = $conn->real_escape_string($_POST['mobile_number']);
        $password = $_POST['password'];

        // 1. Check Regular Users Table
        $sql = "SELECT id, full_name, password_hash FROM users WHERE mobile_number = '$login_identifier'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];
                
                $redirect_url = "index.php";
                if (isset($_POST['package'])) {
                    $redirect_url = "checkout.php?package=" . urlencode($_POST['package']);
                }
                
                header("Location: $redirect_url");
                exit();
            } else {
                header("Location: login.php?error=invalid_creds");
                exit();
            }
        } 
        
        // 2. Check Admin Users Table (if not found in regular users)
        $admin_sql = "SELECT id, username, password_hash, role FROM admin_users WHERE (username = '$login_identifier' OR email = '$login_identifier') AND is_active = 1";
        $admin_result = $conn->query($admin_sql);

        if ($admin_result->num_rows > 0) {
            $admin = $admin_result->fetch_assoc();
            if (password_verify($password, $admin['password_hash'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];
                
                // Update last login
                $conn->query("UPDATE admin_users SET last_login = NOW() WHERE id = " . $admin['id']);

                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: login.php?error=invalid_creds");
                exit();
            }
        }

        // If neither
        header("Location: login.php?error=not_found");
        exit();
    }

    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>
