<?php
require_once 'supabase_client.php';

// Fetch all users (should return JSON array)
$res = sb_request('GET', 'users?select=id,email,role', null, true);

header('Content-Type: application/json');
echo json_encode($res['json'], JSON_PRETTY_PRINT);
?>
