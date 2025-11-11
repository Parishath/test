<?php
// db_connect.php

$host = "db.ljmengkmgbxevbenagjw.supabase.co";
$port = "5432";
$dbname = "postgres"; // Supabase default
$user = "postgres";
$password = "test123";

// Create connection
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Optional: set schema search path
pg_query($conn, "SET search_path TO mcq_test;");

// You can now use $conn in other scripts
?>
