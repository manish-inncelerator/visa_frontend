<?php
session_start();

// Ensure the request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo "Invalid Request Method";
    exit;
}

// Get headers
$headers = getallheaders();

// Check if 'auth' header is present
if (!isset($headers['auth'])) {
    http_response_code(400); // Bad Request
    echo "Missing Authentication Header";
    exit;
}

// Retrieve secureHash from headers
$secureHash = $headers['auth'];

// Validate session authKey against secureHash
if (!isset($_SESSION['authKey'])) {
    http_response_code(401); // Unauthorized
    echo "Session Expired or Invalid";
    exit;
}

if (md5($_SESSION['authKey']) === $secureHash) {
    echo "Match found!";
} else {
    http_response_code(403); // Forbidden
    echo "Invalid Request";
}
