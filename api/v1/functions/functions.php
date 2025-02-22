<?php

// Correct PHP constant declaration
define('DEV_MODE', false); // Set to false in production

function isValidRequest($uuid, $hu, $host): bool
{
    // Define allowed HTTP methods
    $allowedMethods = ['POST', 'GET', 'PUT', 'DELETE'];

    return in_array($_SERVER['REQUEST_METHOD'], $allowedMethods) &&
        !empty($uuid) &&
        !empty($hu) &&
        in_array(strtolower($host), ['localhost', 'fayyaztravels.com', 'www.fayyaztravels.com', 'availability-chelsea-martin-costa.trycloudflare.com']);
}

function getErrorDetails($uuid, $hu, $host): array
{
    $allowedMethods = ['POST', 'GET', 'PUT', 'DELETE'];
    $errors = [];

    // Check if the request method is allowed
    if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
        $errors[] = "Invalid method: {$_SERVER['REQUEST_METHOD']}";
    }

    // Validate UUID, HU, and host
    if (empty($uuid)) {
        $errors[] = "UUID not found";
    }
    if (empty($hu)) {
        $errors[] = "Hashed UUID not provided";
    }
    if (!in_array(strtolower($host), ['localhost', 'fayyaztravels.com', 'www.fayyaztravels.com'])) {
        $errors[] = "Invalid host: $host";
    }

    return $errors;
}


function respondWithJson(array $response, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

function sanitizeInput($data): string
{
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

function getRealIpAddress()
{
    // Check for common proxy headers
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ipList[0]);  // Get the first IP in the list (real client IP)
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];  // IP address passed by a shared Internet connection
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];  // Default to REMOTE_ADDR if no proxies are used
    }

    // Validate the IP address format
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return $ip;
    }

    return '0.0.0.0';  // Return a default IP if the validation fails
}
