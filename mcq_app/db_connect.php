<?php
/**
 * db_connect.php
 * --------------------------------------------------------------------
 * Secure PostgreSQL (Supabase) connection file for Render-hosted PHP apps.
 * Reads all values from environment variables set in Render.
 * --------------------------------------------------------------------
 */

// Fetch environment variables
$database_url = getenv('DATABASE_URL');
$schema       = getenv('SUPABASE_SCHEMA') ?: 'public';

// Fail early if DATABASE_URL is not set
if (!$database_url) {
    die("<pre style='color:red'>❌ DATABASE_URL environment variable is missing.</pre>");
}

// Parse DATABASE_URL → parts
$parts = parse_url($database_url);
if (!$parts) {
    die("<pre style='color:red'>❌ Invalid DATABASE_URL format.</pre>");
}

$host = $parts['host'];
$port = $parts['port'] ?? 5432;
$user = $parts['user'];
$pass = $parts['pass'];
$db   = ltrim($parts['path'], '/');

// Force IPv4 to avoid Render’s IPv6 restrictions
$ipv4 = gethostbyname($host);

// Build connection string with SSL (Supabase requires this)
$conn_string = sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s sslmode=require",
    $ipv4,
    $port,
    $db,
    $user,
    $pass
);

// Attempt connection
$conn = @pg_connect($conn_string);

// Handle connection errors gracefully
if (!$conn) {
    $err = error_get_last();
    echo "<pre style='color:red'>";
    echo "❌ PostgreSQL Connection Failed\n";
    echo "Host: $ipv4\n";
    echo "Database: $db\n";
    echo "User: $user\n";
    echo "Error: " . ($err['message'] ?? 'Unknown') . "\n";
    echo "</pre>";
    exit;
}

// Set schema (e.g. mcq_test)
pg_query($conn, "SET search_path TO {$schema};");

// Optional: Confirm success (for debugging)
// echo "<pre style='color:green'>✅ Connected to Supabase database successfully. Schema: {$schema}</pre>";
?>
