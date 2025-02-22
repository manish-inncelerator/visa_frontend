<?php
session_start();

require '../../database.php';
require '../../vendor/autoload.php';
require 'functions/validate_hu.php';

header('Content-Type: application/json');
$inputData = json_decode(file_get_contents("php://input"), true);

$uuid = $_SESSION['uuid'] ?? null;

// Fetch HU from headers
$headers = getallheaders();
$hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;
$orderId = $headers['X-Order-ID'] ?? $headers['X-Order-Id'] ?? '';
$name = $headers['X-Person-Name'] ?? '';

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = parse_url($scheme . '://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);

if (defined('DEV_MODE') && DEV_MODE) {
    echo json_encode(["debug" => ["uuid" => $uuid, "hu" => $hu, "host" => $host]]);
}

if (!isValidRequest($uuid, $hu, $host)) {
    respondWithJson(["error" => "Invalid request", "debug" => getErrorDetails($uuid, $hu, $host)], 400);
}

if (!isHuValid($uuid, $hu)) {
    respondWithJson(["error" => "Invalid HU"], 401);
}

// Validate traveler ID
$traveler_id = isset($inputData['traveler_id']) ? intval($inputData['traveler_id']) : null;

if (!$traveler_id) {
    respondWithJson(["success" => false, "message" => "Invalid traveler ID"], 400);
}

// Fetch photo filename
$passport = $database->get("passports", "passport_filename", ["traveler_id" => $traveler_id, "order_id" => $orderId]);

// echo $passport;

if ($passport) {
    $passportPath = realpath("../../user_uploads/{$orderId}/{$name}/passport/{$passport}");

    if ($passportPath && file_exists($passportPath)) {
        if (!unlink($passportPath)) {
            respondWithJson(["success" => false, "message" => "Failed to delete file"], 500);
        }
    }
}

// Delete record from database
$database->delete("passports", ["traveler_id" => $traveler_id]);

respondWithJson(["success" => true]);
