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

/**
 * Handles file upload and saves metadata to the database.
 */
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

    if (hasExistingFiles($uploadDir)) {
        respondWithJson(['error' => 'Only one image is allowed per person'], 400);
    }

    $file = $_FILES['file'];

    // Verify that the uploaded file is a valid image.
    if (!getimagesize($file['tmp_name'])) {
        respondWithJson(['error' => 'Uploaded file is not a valid image'], 400);
    }

    // Generate file path using uuid and the original file extension.
    $filePath = generateFilePath($uploadDir, $fileUuid, $file['name']);

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $photoFilename = basename($filePath);

        // Save file data to database.
        $dbResult = $database->insert('photos', [
            'uploaded_by_user_id' => $uuid,
            'order_id'            => $orderId,
            'traveler_id'         => $travelerId,
            'photo_filename'      => $photoFilename,
            'upload_date'         => date('Y-m-d H:i:s'),
            'is_finished'         => 1
        ]);

        if (!$dbResult) {
            respondWithJson(['error' => 'Database insertion failed'], 500);
        }

        respondWithJson([
            'success'   => true,
            'message'   => 'Photo uploaded successfully',
            'photo_url' => $filePath
        ]);
    }

    respondWithJson(['error' => 'Failed to move uploaded file'], 500);
}

/**
 * Sanitizes the person's name by allowing only alphanumeric characters and spaces.
 */
function sanitizePersonName(string $name): string
{
    return trim(preg_replace("/[^a-zA-Z0-9 ]/", "", $name));
}

/**
 * Prepares the upload directory for a specific order and person.
 */
function prepareUploadDirectory(string $orderId, string $personName): ?string
{
    $uploadBaseDir = "../../user_uploads/$orderId";
    $uploadDir = "$uploadBaseDir/$personName";

    foreach ([$uploadBaseDir, $uploadDir] as $dir) {
        if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_writable($dir)) {
            return null;
        }
    }

    return $uploadDir;
}

/**
 * Checks if any images already exist in the given directory.
 */
function hasExistingFiles(string $uploadDir): bool
{
    return (bool) glob("$uploadDir/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
}

/**
 * Generates a file path for the uploaded file using the session's uuid and the original file extension.
 */
function generateFilePath(string $uploadDir, string $uuid, string $originalFileName): string
{
    $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($extension, $allowedExtensions, true)) {
        respondWithJson(['error' => 'Invalid file extension'], 400);
    }

    return "$uploadDir/{$uuid}_photo." . $extension;
}
