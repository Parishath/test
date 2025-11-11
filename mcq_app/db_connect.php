<?php
// db_connect.php — Supabase connection (Render-friendly)

$host = "db.ljmengkmgbxevbenagjw.supabase.co";
$port = "5432";
$dbname = "postgres"; // Supabase default
$user = "postgres";
$password = "test123";

// 🔹 Build a connection string with SSL required (needed by Supabase)
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password sslmode=require";

// Try normal connection
$conn = @pg_connect($conn_string);

// If normal fails (usually due to IPv6), try IPv4 fallback
if (!$conn) {
    $ipv4 = gethostbyname($host); // resolves to IPv4
    if ($ipv4 && $ipv4 !== $host) {
        $conn_string_v4 = "host=$ipv4 port=$port dbname=$dbname user=$user password=$password sslmode=require";
        $conn = @pg_connect($conn_string_v4);
    }
}

// If still not connected, stop with detailed message
if (!$conn) {
    die("❌ Unable to connect to Supabase database.<br>" .
        "Error: " . htmlspecialchars(pg_last_error()) . "<br>" .
        "Host: $host<br>" .
        "Resolved IPv4: " . htmlspecialchars($ipv4 ?? 'n/a') . "<br>" .
        "Check if Supabase allows external connections.");
}

// Optional: set your schema
pg_query($conn, "SET search_path TO mcq_test;");

// ✅ Ready to use
?>
