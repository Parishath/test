<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php?error=Access+Denied");
    exit;
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$time_minutes = (int)($_POST['time_minutes'] ?? 0);
$total_time_seconds = $time_minutes * 60;
$created_by = $_SESSION['user_id'];

if (empty($title) || $total_time_seconds <= 0) {
    die("Invalid input. <a href='question_bank.php'>Go Back</a>");
}

$query = "INSERT INTO mcq_test.tests (title, description, total_time_seconds, created_by)
          VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $query, array($title, $description, $total_time_seconds, $created_by));

if ($result) {
    header("Location: view_question_banks.php?success=Question+Bank+Created");
    exit;
} else {
    echo "Database error: " . pg_last_error($conn);
}
?>
