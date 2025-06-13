<?php
require_once('app/utils/JWTHandler.php');

// Create JWT handler
$jwtHandler = new JWTHandler();

// Get headers
$headers = apache_request_headers();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : null;

echo '<h2>JWT Debug Info</h2>';
echo '<pre>';
echo 'Authorization Header: ' . ($authHeader ? htmlspecialchars($authHeader) : 'Not found') . "\n\n";

if ($authHeader) {
    $arr = explode(" ", $authHeader);
    $jwt = $arr[1] ?? null;
    
    if ($jwt) {
        echo "JWT Token found: " . substr($jwt, 0, 20) . "...\n\n";
        
        // Try to decode
        $decoded = $jwtHandler->decode($jwt);
        
        if ($decoded) {
            echo "JWT Valid! Decoded payload:\n";
            print_r($decoded);
        } else {
            echo "JWT Invalid or expired!\n";
        }
    } else {
        echo "No JWT token in Authorization header\n";
    }
} else {
    echo "No Authorization header found\n";
}
echo '</pre>';
?>
