<?php
require_once 'db_connect.php';
require_once 'supabase_client.php';
// Get POST data
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$role = trim($_POST['role']);

// Input validation
if (empty($name) || empty($email) || empty($password)) {
    die("All fields are required.");
}

// Hash password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Check if email already exists
$check_query = "SELECT * FROM users WHERE email = $1";
$check_result = pg_query_params($conn, $check_query, array($email));

if (pg_num_rows($check_result) > 0) {
    die("Email already registered. <a href='register.php'>Go Back</a>");
}

// Insert new user
$insert_query = "INSERT INTO users (email, password_hash, name, role) VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $insert_query, array($email, $password_hash, $name, $role));

if ($result) {
    header("Location: success.php");
    exit;
} else {
    echo "Error: " . pg_last_error($conn);
}
?>
