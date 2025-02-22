<?php

session_start();

require '../../database.php';
require 'functions/validate_hu.php';

header('Content-Type: application/json');
$inputData = json_decode(file_get_contents("php://input"), true);

$uuid = $_SESSION['uuid'] ?? null;
$userId = $_SESSION['user_id'] ?? null;

// Fetch HU from headers
$headers = getallheaders();
$hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;

// Validate request
if (!isValidRequest($uuid, $hu, $_SERVER['HTTP_HOST'])) {
    respondWithJson(["error" => "Invalid request"], 400);
    exit;
}

// Validate HU
if (!isHuValid($uuid, $hu)) {
    respondWithJson(["error" => "Invalid HU"], 401);
    exit;
}

// Sanitize user input
$currentPassword = isset($inputData['currentPassword']) ? sanitizeInput($inputData['currentPassword']) : null;
$newPassword = isset($inputData['newPassword']) ? sanitizeInput($inputData['newPassword']) : null;
$confirmNewPassword = isset($inputData['confirmNewPassword']) ? sanitizeInput($inputData['confirmNewPassword']) : null;

if (!$currentPassword || !$newPassword || !$confirmNewPassword) {
    respondWithJson(["error" => "All fields are required"], 400);
    exit;
}

if ($newPassword !== $confirmNewPassword) {
    respondWithJson(["error" => "New passwords do not match"], 400);
    exit;
}

// Fetch user data from DB
$user = $database->get("users", ["password"], [
    "user_id" => $userId
]);

if (!$user) {
    respondWithJson(["error" => "Invalid credentials"], 401);
    exit;
}

// Verify password
if (!password_verify($currentPassword, $user['password'])) {
    respondWithJson(["error" => "Invalid current password"], 401);
    exit;
}

// Hash New Password
$options = [
    'memory_cost' => 65536, // Memory usage in KiB (default is 65536 or 64 MiB)
    'time_cost'   => 4,     // Number of iterations (default is 4)
    'threads'     => 2,     // Number of threads (default is 1)
];
$hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID, $options);

// Update password in database
$update = $database->update("users", ["password" => $hashedPassword], ["user_id" => $userId]);

if ($update->rowCount() > 0) {
    respondWithJson(["success" => "Password updated successfully"], 200);
} else {
    respondWithJson(["error" => "Failed to update password"], 500);
}
