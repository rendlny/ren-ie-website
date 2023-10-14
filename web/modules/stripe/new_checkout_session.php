<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/config.ini');
\Stripe\Stripe::setApiKey($config['stripe_secret_key']);

header('Content-Type: application/json');

$checkoutSession = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => 'price_1MNPLeENL35iA36QwKlOVPSL',
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $config['site_url'] . 'order-success/',
    'cancel_url' => $config['site_url'] . 'order-cancel/',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkoutSession->url);
