<?php
require_once plugin_dir_path(__FILE__) . 'stripe-php-master/init.php'; // Adjust the path as necessary

$stripe = new \Stripe\StripeClient([
    "api_key" => "YOUR_SECRET_KEY",
]);

try {
    // Retrieve JSON from POST body
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    $session = $stripe->checkout->sessions->retrieve($jsonObj->session_id);

    echo json_encode(['status' => $session->payment_status]);
    http_response_code(200);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
