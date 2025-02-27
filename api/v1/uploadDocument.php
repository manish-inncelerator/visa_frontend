<?php
session_start();

require '../../database.php';
require 'functions/validate_hu.php';
require '../../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

header('Content-Type: application/json');

// Fetch user session data
$uuid = $_SESSION['uuid'] ?? null;
$userId = $_SESSION['user_id'] ?? null;

// Fetch headers
$headers = getallheaders();
$hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;
$fileUuid = Uuid::uuid4()->toString();

// Validate request
if (!isValidRequest($uuid, $hu, $_SERVER['HTTP_HOST']) || !isHuValid($uuid, $hu)) {
    respondWithJson(["status" => "error", "status_code" => 401, "message" => "Invalid request"], 401);
}

// Ensure POST request and file is uploaded
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respondWithJson(["status" => "error", "status_code" => 405, "message" => "Invalid request method"], 405);
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    respondWithJson(["status" => "error", "status_code" => 400, "message" => "No file uploaded or file upload error."], 400);
}

// Allowed file types
$allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'webp'];
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf', 'application/octet-stream']; // Allow octet-stream for PDFs

// Get file details
$filename = $_FILES['file']['name'];
$tmpFilePath = $_FILES['file']['tmp_name'];

if (empty($tmpFilePath) || !file_exists($tmpFilePath)) {
    respondWithJson(["status" => "error", "status_code" => 400, "message" => "Invalid file upload."], 400);
}

$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

// Use finfo to get accurate MIME type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($tmpFilePath) ?: '';

if ($extension === 'pdf' && $mimeType === 'application/octet-stream') {
    $mimeType = 'application/pdf'; // Override for PDFs that are detected as octet-stream
}

// Validate file type
if (!in_array($extension, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
    respondWithJson(["status" => "error", "status_code" => 400, "message" => "Invalid file type. Only JPG, PNG, WEBP, and PDF files are allowed."], 400);
}

// Extract form data from $_POST
$order_id = $_POST['order_id'] ?? $headers['X-Order-ID'] ?? $headers['X-Order-Id'] ?? 'unknown_order';
$person_name = $_POST['person_name'] ?? $headers['X-Person-Name'] ?? 'unknown_person';
$travelerId = $_POST['traveler_id'] ?? $headers['X-Traveler-ID'] ?? $headers['X-Traveler-Id'] ?? '';
$doc_id = $_POST['document_id'] ?? $headers['X-Document-ID'] ?? $headers['X-Document-Id'] ?? 'unknown_doc';

// Validate traveler_id and document_id
if (empty($travelerId) || empty($doc_id)) {
    respondWithJson(["status" => "error", "status_code" => 400, "message" => "Missing required form data."], 400);
}

// Get document name from database
$requiredDoc = $database->get('required_documents', 'required_document_name', ['id' => $doc_id]);
$requiredDocName = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $requiredDoc ?? ''));
$cleanRequiredDocName = str_replace('_', ' ', trim($requiredDocName, '_'));

if (!$requiredDocName) {
    respondWithJson(["status" => "error", "status_code" => 400, "message" => "Invalid document type."], 400);
}

// Check if the document already exists for this traveler
$existingDocument = $database->get('documents', 'document_filename', [
    'traveler_id' => $travelerId,
    'document_filename[~]' => "{$cleanRequiredDocName}."
]);

if ($existingDocument) {
    respondWithJson([
        "status" => "error",
        "status_code" => 409,
        "message" => ucfirst(str_replace('_', ' ', $requiredDocName)) . " already uploaded for this traveler."
    ], 409);
}

// Define upload directories
$baseUploadDir = "../../user_uploads/{$order_id}/{$person_name}/";
$uploadDir = $baseUploadDir . "documents/";

// Ensure directories exist
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
    respondWithJson(["status" => "error", "status_code" => 500, "message" => "Failed to create upload directories."], 500);
}

// Generate unique filename
$fileName = "{$fileUuid}_{$requiredDocName}.{$extension}";
$filePath = $uploadDir . $fileName;

// Move uploaded file
if (!move_uploaded_file($tmpFilePath, $filePath)) {
    respondWithJson(["status" => "error", "status_code" => 500, "message" => "Upload failed."], 500);
}

// Save file info to database
$dbResult = $database->insert('documents', [
    'uploaded_by_user_id' => $userId,
    'order_id'            => $order_id,
    'traveler_id'         => $travelerId,
    'document_type'       => $cleanRequiredDocName,
    'document_filename'   => $fileName,
    'upload_date'         => date('Y-m-d H:i:s'),
    'is_finished'         => 1
]);

if (!$dbResult) {
    respondWithJson(["status" => "error", "status_code" => 500, "message" => "Database insertion failed."], 500);
}

// Success response
respondWithJson([
    "status" => "success",
    "status_code" => 200,
    "document_name" => $fileName,
    "message" => "Document uploaded successfully",
    "document_url" => $filePath
]);
