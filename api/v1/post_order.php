<?php

// Start session
session_start();

// Include database
include('../../database.php');

// Ensure that the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method.";
    exit;
}

// Retrieve and sanitize POST data
$traveller_count = isset($_POST['traveller_count']) ? intval($_POST['traveller_count']) : 1;
$country_id = isset($_POST['country_id']) ? intval($_POST['country_id']) : 1;
$date_of_journey = isset($_POST['date_of_journey']) ? $_POST['date_of_journey'] : null;
$date_of_arrival = isset($_POST['date_of_arrival']) ? $_POST['date_of_arrival'] : null;

// Fetch details from the database
$fees = $database->get(
    'countries',
    [
        'portify_fees',
        'embassy_fee',
        'vfs_service_fees'
    ],
    [
        'id' => $country_id // Filter by country ID
    ]
);

if (!$fees) {
    http_response_code(404); // Not Found
    echo "Country not found.";
    exit;
}

$embassy_fee = $fees['embassy_fee'];
$our_fee = $fees['portify_fees'];
$vfs_fee = $fees['vfs_service_fees'];
$total_amount = ($embassy_fee + $our_fee + $vfs_fee) * $traveller_count;

// order_id
$order_id = strtoupper(date('Ymd') . "-" . substr(bin2hex(random_bytes(4)), 0, 8));
$insert_status = $database->insert('orders', [
    'country_id' => $country_id,
    'order_id' => $order_id,
    'no_of_pax' => $traveller_count,
    'order_total' => $total_amount,
    'journey_date_departure' => $date_of_journey,
    'journey_date_arrival' => $date_of_arrival,
    'order_date' => date('Y-m-d H:i:s'),
    'is_ordered' => 1
]);

if ($insert_status) {
    // echo "Order successfully created. Total amount: $total_amount";
    echo 'Redirecting...';
    if (isset($_SESSION['user_id'])) {
        // Redirect to application form
        header('location:../../application/' . $order_id . '/persona?through=login');
    } else {
        // redirect to login form
        header('location:../../auth/login?o=' . $order_id);
    }
} else {
    http_response_code(500); // Internal Server Error
    echo "Failed to create order.";
}
