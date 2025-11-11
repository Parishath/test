<?php
// db_connect.php — Final Render + Supabase connection for DB: mcq_test

$host = "db.ljmengkmgbxevbenagjw.supabase.co";
$port = "5432";
$dbname = "mcq_test"; // ✅ your actual DB name
$user = "test";
$password = "test123";

// 🔹 Force IPv4 (Render free tier often lacks IPv6)
$ipv4 = gethostbyname($host);

// 🔹 Build connection string with SSL (Supabase requires it)
$conn_string = "host=$ipv4 port=$port dbname=$dbname user=$user password=$password sslmode=require";

// 🔹 Attempt connection
$conn = @pg_connect($conn_string);

// 🔹 Check connection and handle errors safely
if (!$conn) {
    $php_err = error_get_last();
    echo "<pre style='color:red;font-family:monospace'>";
    echo "❌ PostgreSQL Connection Failed\n";
    echo "Host: $host\n";
    echo "Resolved IPv4: $ipv4\n";
    echo "Port: $port\n";
    echo "Database: $dbname\n";
    echo "User: $user\n";
    echo "Error: " . ($php_err['message'] ?? 'Unknown') . "\n";
    echo "</pre>";
    exit;
}

// ✅ Connected successfully — optionally set schema
// @pg_query($conn, "SET search_path TO mcq_test;");

// ✅ You can now use $conn in all other scripts
// echo "<pre style='color:green'>✅ Connected to Supabase DB (mcq_test) successfully!</pre>";
?>
