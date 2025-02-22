<?php

declare(strict_types=1);

session_start();


require '../../database.php'; // Ensure this contains your Medoo initialization
require 'functions/validate_hu.php';
require '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

header('Content-Type: application/json');

$inputData = json_decode(file_get_contents("php://input"), true);
$uuid = $_SESSION['uuid'] ?? null;
$headers = getallheaders();
$hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;
$fileUuid = Uuid::uuid4()->toString();


$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = parse_url($scheme . '://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST);
if (defined('DEV_MODE') && DEV_MODE) {
    respondWithJson(["debug" => compact('uuid', 'hu', 'host')]);
}

// Validate request
if (!isValidRequest($uuid, $hu, $host)) {
    respondWithJson(["error" => "Invalid request"], 400);
}

// Validate HU
if (!isHuValid($uuid, $hu)) {
    respondWithJson(["error" => "Invalid HU"], 401);
}

// Handle only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respondWithJson(['error' => 'Method Not Allowed'], 405);
}

handleFileUpload($headers, $uuid);

function handleFileUpload(array $headers, ?string $uuid): void
{
    global $database; // Medoo instance

    global $fileUuid;

    $hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;
    $personName = sanitizePersonName($headers['X-Person-Name'] ?? '');
    $orderId = $headers['X-Order-ID'] ?? $headers['X-Order-Id'] ?? '';
    $travelerId = $headers['X-Traveler-ID'] ?? $headers['X-Traveler-Id'] ?? '';

    if (!$hu || !$personName || !$orderId || empty($_FILES['file'])) {
        respondWithJson(['error' => 'Missing required headers or file'], 400);
    }

    $uploadDir = prepareUploadDirectory($orderId, $personName);
    if (!$uploadDir) {
        respondWithJson(['error' => 'Failed to create upload directory'], 500);
    }

    $passportDir = "$uploadDir/passport";
    if (!is_dir($passportDir) && !mkdir($passportDir, 0755, true)) {
        respondWithJson(['error' => 'Failed to create passport directory'], 500);
    }

    $file = $_FILES['file'];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'];

    if (!in_array($extension, $allowedExtensions, true)) {
        respondWithJson(['error' => 'Invalid file extension'], 400);
    }

    if (!in_array($extension, ['pdf'], true) && !getimagesize($file['tmp_name'])) {
        respondWithJson(['error' => 'Uploaded file is not a valid image or PDF'], 400);
    }
    $filePath = "$passportDir/{$fileUuid}_passport.$extension";

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $passportFilename = basename($filePath);

        $dbResult = $database->insert('passports', [
            'uploaded_by_user_id' => $uuid,
            'order_id'            => $orderId,
            'traveler_id'         => $travelerId,
            'passport_filename'   => $passportFilename,
            'upload_date'         => date('Y-m-d H:i:s'),
            'is_finished'         => 1
        ]);

        if (!$dbResult) {
            respondWithJson(['error' => 'Database insertion failed'], 500);
        }

        respondWithJson([
            'success'      => true,
            'message'      => 'Passport uploaded successfully',
            'passport_url' => $filePath
        ]);
    }

    respondWithJson(['error' => 'Failed to move uploaded file'], 500);
}

function sanitizePersonName(string $name): string
{
    return trim(preg_replace("/[^a-zA-Z0-9 ]/", "", $name));
}

function prepareUploadDirectory(string $orderId, string $personName): ?string
{
    $uploadBaseDir = "../../user_uploads/$orderId";
    $uploadDir = "$uploadBaseDir/$personName";

    foreach ([$uploadBaseDir, $uploadDir] as $dir) {
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_writable($dir)) {
            return null;
        }
    }

    return $uploadDir;
}
