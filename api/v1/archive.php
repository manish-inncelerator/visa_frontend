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
$host = parse_url('http://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);

// Debug mode
if (defined('DEV_MODE') && DEV_MODE) {
    echo json_encode(["debug" => ["uuid" => $uuid, "hu" => $hu, "host" => $host]]);
}

// Validate request
if (!isValidRequest($uuid, $hu, $host)) {
    respondWithJson(["error" => "Invalid request", "debug" => getErrorDetails($uuid, $hu, $host)], 400);
    exit;
}

// Validate HU
if (!isHuValid($uuid, $hu)) {
    respondWithJson(["error" => "Invalid HU"], 401);
    exit;
}

/**
 * Main Code
 */

// Sanitize user input
$orderId = isset($inputData['orderId']) ? sanitizeInput($inputData['orderId']) : null;

if (!$orderId) {
    respondWithJson(["error" => "Missing required fields"], 400);
    exit;
}

// Update archive data in DB
try {
    $archive = $database->update("orders", ["is_archive" => 1], ["order_id" => $orderId]);

    if ($archive) {
        respondWithJson(["success" => "Order archived"], 200);
    } else {
        respondWithJson(["error" => "Failed to archive order"], 500);
    }
} catch (Exception $e) {
    respondWithJson(["error" => "Database error: " . $e->getMessage()], 500);
}
