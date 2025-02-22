<?php

session_start();

require '../../database.php';
require '../../vendor/autoload.php';
require 'functions/validate_hu.php';

use Ramsey\Uuid\Uuid;

header('Content-Type: application/json');
$inputData = json_decode(file_get_contents("php://input"), true);

$uuid = $_SESSION['uuid'] ?? null;
// Fetch HU from headers
$headers = getallheaders();
$hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = parse_url($scheme . '://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);
if (DEV_MODE) {
    echo json_encode(["debug" => ["uuid" => $uuid, "hu" => $hu, "host" => $host]]);
}

if (!isValidRequest($uuid, $hu, $host)) {
    respondWithJson(["error" => "Invalid request", "debug" => getErrorDetails($uuid, $hu, $host)], 400);
}

if (!isHuValid($uuid, $hu)) {
    respondWithJson(["error" => "Invalid HU"], 401);
}

/*
*    Form Processing
 * Main Code
 */

// Sanitize user input
$fname = isset($inputData['fname']) ? sanitizeInput($inputData['fname']) : null;
$lname = isset($inputData['lname']) ? sanitizeInput($inputData['lname']) : null;
$email = isset($inputData['email']) ? sanitizeInput($inputData['email']) : null;
$password = isset($inputData['password']) ? sanitizeInput($inputData['password']) : null;

if (!$fname || !$lname || !$email || !$password) {
    respondWithJson(["error" => "Missing required fields"], 400);
}

// Hash Password
$options = [
    'memory_cost' => 65536, // Memory usage in KiB (default is 65536 or 64 MiB)
    'time_cost'   => 4,     // Number of iterations (default is 4)
    'threads'     => 2,     // Number of threads (default is 1)
];
$hashedPassword = password_hash($password, PASSWORD_ARGON2ID, $options);

// User ID of the user
$userId = Uuid::uuid4()->toString();

// Save form data
$database->insert("users", [
    "user_id" => $userId,  // Assign the uuid as user_id
    "first_name" => $fname,
    "last_name" => $lname,
    "email" => $email,
    "password" => $hashedPassword,  // Hash password for security
    "ip_address" => getRealIpAddress(),
    "join_date" => date("Y-m-d H:i:s")
]);

if ($database->id()) {
    respondWithJson(["success" => "Registeration Successful"], 201);
} else {
    respondWithJson(["error" => "Failed to save data"], 500);
}
