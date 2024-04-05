<?php
/*
Plugin Name: Stripe Checkout Integration
Description: Integrates Stripe Checkout into your WordPress site.
Version: 1.0
Author: Jonathan DeMarco
*/
require_once plugin_dir_path(__FILE__) . 'stripe-php-master/init.php'; // Adjust the path as necessary

// Enqueue scripts
function stripe_checkout_enqueue_scripts() {
    wp_enqueue_script('stripe-js', 'https://js.stripe.com/v3/', array(), null);
    wp_enqueue_script('stripe-checkout-script', plugin_dir_url(__FILE__) . 'assets/js/stripe-checkout-script.js', array('stripe-js'), null, true);
}
add_action('wp_enqueue_scripts', 'stripe_checkout_enqueue_scripts');

// Include other PHP files
require_once plugin_dir_path(__FILE__) . 'create-checkout-session.php';
require_once plugin_dir_path(__FILE__) . 'checkout-status.php';
