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
$currentPassword = isset($inputData['password']) ? sanitizeInput($inputData['password']) : null;

if (!$currentPassword) {
    respondWithJson(["error" => "All fields are required"], 400);
    exit;
}

// Fetch user data from DB
$user = $database->get("users", ["password"], [
    "user_id" => $userId
]);

if (!$user) {
    respondWithJson(["error" => "Invalid data"], 401);
    exit;
}

// Verify password
if (!password_verify($currentPassword, $user['password'])) {
    respondWithJson(["error" => "Invalid password"], 401);
    exit;
} else {
    // Disable user
    $update = $database->update("users", ["is_deleted" => 1], ["user_id" => $userId]);
    respondWithJson(["success" => "Account deleted"], 401);
}
