<?php
session_start();
require '../../database.php';
require 'functions/validate_hu.php';

header('Content-Type: application/json');
$inputData = json_decode(file_get_contents("php://input"), true);

$uuid = $_SESSION['uuid'] ?? null;
$headers = getallheaders();
$hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = parse_url($scheme . '://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);
// Debug mode check
if (DEV_MODE) {
    echo json_encode(["debug" => ["uuid" => $uuid, "hu" => $hu, "host" => $host]]);
}

// Validate request and HU header
if (!isValidRequest($uuid, $hu, $host)) {
    respondWithJson(["error" => "Invalid request", "debug" => getErrorDetails($uuid, $hu, $host)], 400);
}

if (!isHuValid($uuid, $hu)) {
    respondWithJson(["error" => "Invalid HU"], 401);
}

$errors = [];
$travelersData = [];
$insertSuccess = false; // Track if at least one insert/update is successful

$order_id = isset($inputData['order_id']) ? sanitizeInput($inputData['order_id']) : 0;
$action = isset($inputData['action']) ? $inputData['action'] : 'insert';
$is_finished = 1;

// Ensure the user_uploads/order_id folder exists
$baseDir = '../../user_uploads';
$orderDir = "$baseDir/$order_id";
if (!file_exists($baseDir)) {
    mkdir($baseDir, 0777, true);
}
if (!file_exists($orderDir)) {
    mkdir($orderDir, 0777, true);
}

foreach ($inputData as $key => $value) {
    if (preg_match('/^name_(\d+)$/', $key, $matches)) {
        $index = $matches[1];

        $travelersData[] = [
            'order_id' => $order_id,
            'name' => $inputData["name_$index"],
            'passport' => $inputData["passport_$index"],
            'dob' => $inputData["dob_$index"],
            'nationality' => $inputData["nationality_$index"],
            'passport_country' => $inputData["passport_country_$index"] ?? '',
        ];

        // Create or rename directory based on action
        $travelerDir = "$orderDir/{$inputData["name_$index"]}";

        if ($action === 'update') {
            $existingTraveler = $database->get('travelers', '*', [
                'order_id' => $order_id,
                'passport_number' => $inputData["passport_$index"]
            ]);

            if ($existingTraveler && $existingTraveler['name'] !== $inputData["name_$index"]) {
                $oldDir = "$orderDir/{$existingTraveler['name']}";
                if (file_exists($oldDir) && !file_exists($travelerDir)) {
                    rename($oldDir, $travelerDir);
                }
            }
        } else {
            if (!file_exists($travelerDir)) {
                mkdir($travelerDir, 0777, true);
            }
        }
    }
}

// Abort if validation errors
if (!empty($errors)) {
    respondWithJson(['status' => 'error', 'errors' => $errors], 400);
}

// Save or Update data
foreach ($travelersData as $traveler) {
    $existingTraveler = $database->get('travelers', '*', [
        'AND' => [
            'order_id' => $traveler['order_id'],
            'passport_number' => $traveler['passport']
        ]
    ]);

    if ($existingTraveler) {
        if ($action === 'update') {
            $updateResult = $database->update('travelers', [
                'name' => $traveler['name'],
                'date_of_birth' => $traveler['dob'],
                'nationality' => $traveler['nationality'],
                'passport_issuing_country' => $traveler['passport_country'],
                'is_finished' => $is_finished,
                'edited_at' => date('Y-m-d H:i:s')
            ], [
                'AND' => [
                    'order_id' => $traveler['order_id'],
                    'passport_number' => $traveler['passport']
                ]
            ]);

            if ($updateResult->rowCount()) {
                $insertSuccess = true;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Update failed.']);
            }
        }
    } else {
        $insertResult = $database->insert('travelers', [
            'order_id' => $traveler['order_id'],
            'name' => $traveler['name'],
            'passport_number' => $traveler['passport'],
            'date_of_birth' => $traveler['dob'],
            'nationality' => $traveler['nationality'],
            'passport_issuing_country' => $traveler['passport_country'],
            'is_finished' => $is_finished
        ]);

        if ($insertResult->rowCount()) {
            $insertSuccess = true;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Insert failed.']);
        }
    }
}

// Final response
if ($insertSuccess) {
    echo json_encode(['status' => 'success', 'message' => 'Traveler data processed successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data was inserted or updated.']);
}
