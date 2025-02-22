<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../../database.php'; // Include database connection
    require 'functions/validate_hu.php';



    $headers = getallheaders();
    $hu = $headers['HU'] ?? $headers['Hu'] ?? $headers['hu'] ?? null;
    $orderId = $headers['X-Order-ID'] ?? $headers['X-Order-Id'] ?? '';
    // Read JSON input
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $fileName   = sanitizeInput($data['file_name']) ?? null;
    $travelerId = sanitizeInput($data['traveler_id']) ?? null;

    if (!$fileName || !$travelerId) {
        echo json_encode(['status' => 'error', 'message' => 'Missing parameters.']);
        exit;
    }

    // Fetch document details using file_name and traveler_id
    $document = $database->get('documents', ['id', 'document_filename', 'traveler_id'], [
        'document_filename' => $fileName,
        'traveler_id'       => $travelerId,
        'order_id'         => $orderId
    ]);

    if (!$document) {
        echo json_encode(['status' => 'error', 'message' => 'Document not found.']);
        exit;
    }

    // Fetch traveler details (to get name and order ID)
    $traveler = $database->get('travelers', ['name', 'order_id'], ['id' => $document['traveler_id'], 'order_id' => $orderId]);
    if (!$traveler) {
        echo json_encode(['status' => 'error', 'message' => 'Traveler not found.']);
        exit;
    }


    // Construct the correct file path
    $safeName = preg_replace('/[^a-zA-Z0-9_-]/', ' ', strtolower($traveler['name'])); // Sanitize traveler name
    $filePath = __DIR__ . "/../../user_uploads/{$traveler['order_id']}/{$safeName}/documents/{$document['document_filename']}";

    // Delete the file from storage if it exists
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Remove document entry from the database
    $database->delete('documents', [
        'traveler_id' => $travelerId,
        'document_filename' => $fileName
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Document deleted successfully.']);
}
