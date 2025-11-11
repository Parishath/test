<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php?error=Access+Denied");
  exit;
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$time_minutes = (int)($_POST['time_minutes'] ?? 0);
$total_time_seconds = $time_minutes * 60;
$created_by = $_SESSION['user_id'];

if ($title === '' || $total_time_seconds <= 0) {
  die("Invalid input. <a href='question_bank.php'>Go Back</a>");
}

// read env
$supabaseUrl = getenv('SUPABASE_URL') ?: 'https://ljmengkmgbxevbenagjw.supabase.co';
$serviceKey = getenv('SUPABASE_SERVICE_ROLE_KEY'); // must be set in Render env

if (!$serviceKey) {
  die("Server misconfiguration: service key missing.");
}

// PostgREST endpoint for table 'tests'
$endpoint = rtrim($supabaseUrl, '/') . '/rest/v1/tests';

// payload – match your column names
$payload = [
  'title' => $title,
  'description' => $description,
  'total_time_seconds' => $total_time_seconds,
  'created_by' => $created_by
];

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "apikey: $serviceKey",
  "Authorization: Bearer $serviceKey",
  "Prefer: return=representation"   // returns inserted row
]);
$response = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($http >= 200 && $http < 300) {
  // success — response contains the created row (as JSON array)
  header("Location: view_question_banks.php?success=Question+Bank+Created");
  exit;
} else {
  // helpful debug
  echo "<h3>Supabase API error (HTTP $http)</h3>";
  echo "<pre>" . htmlspecialchars($response . "\n\n" . $error) . "</pre>";
  exit;
}
