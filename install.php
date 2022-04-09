<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "942848d4521b3a3f035388fc420e095c";
$scopes = "read_orders,write_products";
$redirect_uri = "http://localhost/sigma-comics/shopify/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();