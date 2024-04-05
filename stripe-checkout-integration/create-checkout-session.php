<?php
require_once 'path/to/stripe-php/init.php'; // Adjust the path as necessary

$stripe = new \Stripe\StripeClient([
    "api_key" => "YOUR_SECRET_KEY",
]);

$checkout_session = $stripe->checkout->sessions->create([
    'payment_method_types' => ['card'],
    'line_items' => [
        [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'T-shirt',
                ],
                'unit_amount' => 2000,
            ],
            'quantity' => 1,
        ],
    ],
    'mode' => 'payment',
    'success_url' => site_url('/checkout/success'),
    'cancel_url' => site_url('/checkout/cancel'),
]);

echo json_encode(array('sessionId' => $checkout_session->id));
