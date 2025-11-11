<?php
// supabase_client.php — universal helper for Render + Supabase REST API

$supabaseUrl  = getenv('SUPABASE_URL') ?: 'https://rfvbvulklpqihpuhwcpo.supabase.co';
$serviceKey   = getenv('SUPABASE_SERVICE_ROLE_KEY'); // full-access key (server-only)
$anonKey      = getenv('SUPABASE_ANON_KEY');         // anon key (safe)
$schema       = getenv('SUPABASE_SCHEMA') ?: 'mcq_test';

/**
 * Generic Supabase REST request helper
 */
function sb_request($method, $path, $data = null, $useService = true, $extraHeaders = []) {
    global $supabaseUrl, $serviceKey, $anonKey, $schema;

    $url = rtrim($supabaseUrl, '/') . '/rest/v1/' . ltrim($path, '/');
    $headers = [
        "Content-Type: application/json",
        "Accept: application/json",
        "Prefer: return=representation",
        "Accept-Profile: {$schema}",
    ];

    $apiKey = $useService && $serviceKey ? $serviceKey : $anonKey;
    $headers[] = "apikey: {$apiKey}";
    $headers[] = "Authorization: Bearer {$apiKey}";

    foreach ($extraHeaders as $h) $headers[] = $h;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => $headers,
    ]);

    if ($data !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error    = curl_error($ch);
    curl_close($ch);

    return [
        'status' => $httpCode,
        'body'   => $response,
        'json'   => json_decode($response, true),
        'error'  => $error
    ];
}
?>
