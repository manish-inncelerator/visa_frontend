<?php

session_start();

require '../../database.php';
require 'functions/validate_hu.php';

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

/*** Login Processing
 * Main Code
 */

// Sanitize user input
$email = isset($inputData['email']) ? sanitizeInput($inputData['email']) : null;
$password = isset($inputData['password']) ? sanitizeInput($inputData['password']) : null;

if (!$email || !$password) {
    respondWithJson(["error" => "Missing required fields"], 400);
}
// Fetch user data from DB
$user = $database->select("users", ["email", "password", "user_id", "is_ban", "is_deleted"], [
    "email" => $email
]);

if (empty($user) || !is_array($user)) {
    respondWithJson(["error" => "Invalid credentials"], 401);
    exit;
}

$user = $user[0]; // Assuming there's only one user per email

if ((int)$user['is_ban'] === 1 || (int)$user['is_deleted'] === 1) {
    respondWithJson(["error" => "Oops! This user is either banned or their profile is deleted."], 401);
    exit;
}

// Verify password
if (password_verify($password, $user['password'])) {
    // Password is correct, generate session token and send response
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['email'] = $user['email'];

    respondWithJson(["success" => "Login successful"], 200);
} else {
    respondWithJson(["error" => "Invalid credentials"], 401);
}
