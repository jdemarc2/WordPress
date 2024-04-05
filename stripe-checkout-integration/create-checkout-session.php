<?php
require_once plugin_dir_path(__FILE__) . 'stripe-php-master/init.php'; // Adjust the path as necessary

$stripe = new \Stripe\StripeClient([
    "api_key" => "YOUR_SECRET_KEY",
]);

// Get cart contents from WooCommerce
$cart_items = WC()->cart->get_cart();

// Prepare line items array for Stripe Checkout Session
$line_items = array();
foreach ($cart_items as $cart_item_key => $cart_item) {
    $product = $cart_item['data'];
    $price = $product->get_price();
    $product_type = 'one-time'; // Default to one-time purchase

    // Check if the product is a subscription
    if (wcs_order_contains_subscription($cart_item['data']->get_id())) {
        $product_type = 'subscription';
    }

    $line_items[] = [
        'price_data' => [
            'currency' => get_woocommerce_currency(),
            'product_data' => [
                'name' => $product->get_name(),
                'metadata' => [
                    'product_type' => $product_type,
                ],
            ],
            'unit_amount' => wc_get_price_excluding_tax($product),
        ],
        'quantity' => $cart_item['quantity'],
    ];
}
