<?php
session_start();
require_once 'db_connect.php';
require_once 'supabase_client.php';
// Read form data
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($email) || empty($password)) {
    header("Location: login.php?error=Please+enter+email+and+password");
    exit;
}

// Find user
$query = "SELECT * FROM users WHERE email = $1";
$result = pg_query_params($conn, $query, array($email));

if (pg_num_rows($result) === 0) {
    header("Location: login.php?error=Invalid+credentials");
    exit;
}

$user = pg_fetch_assoc($result);

// Verify password
if (!password_verify($password, $user['password_hash'])) {
    header("Location: login.php?error=Invalid+credentials");
    exit;
}

// Set session variables
$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

// Redirect by role
if ($user['role'] === 'admin') {
    header("Location: dashboard_admin.php");
} else {
    header("Location: dashboard_user.php");
}
exit;
?>
