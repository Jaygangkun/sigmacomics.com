<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
include_once('inc/connections.php');

define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
/*require __DIR__ . '/wp-blog-header.php';*/


$request = $_SERVER['REQUEST_URI'];



switch ($request) {
    

    case constant("BASEURL").'/forgot-password' :
        require __DIR__ . '/forgot-password.php';
        break;
    
    case constant("BASEURL").'/forgot-password2' :
        require __DIR__ . '/forgot-password-2.php';
        break;
    case constant("BASEURL").'forgot-password2/' :
        require __DIR__ . '/forgot-password-2.php';
        break;
    case constant("BASEURL").'/login' :
        require __DIR__ . '/login.php';
        break;
    case constant("BASEURL").'login/' :
        require __DIR__ . '/login.php';
        break;
    case constant("BASEURL").'/login2' :
        require __DIR__ . '/login2.php';
        break;
    case constant("BASEURL").'login2/' :
        require __DIR__ . '/login2.php';
        break;
    case constant("BASEURL").'/individual-digital-issue-select' :
        require __DIR__ . '/individual-digital-issue-select.php';
        break;
    case constant("BASEURL").'individual-digital-issue-select/' :
        require __DIR__ . '/individual-digital-issue-select.php';
        break;
    case constant("BASEURL").'digital-subscription-add-to-cart/' :
        require __DIR__ . '/digital-subscription-add-to-cart.php';
        break;
    case constant("BASEURL").'/digital-subscription-add-to-cart' :
        require __DIR__ . '/digital-subscription-add-to-cart.php';
        break;
  
    case constant("BASEURL").'/digital-subscription-added-to-cart' :
        require __DIR__ . '/digital-subscription-added-to-cart';
        break;
    case constant("BASEURL").'digital-subscription-added-to-cart/' :
        require __DIR__ . '/digital-subscription-added-to-cart';
        break;
    case constant("BASEURL").'print-collector-digital-subscription-add-to-cart/' :
        require __DIR__ . '/print-collector-digital-subscription-add-to-cart.php';
        break;
    case constant("BASEURL").'/print-collector-digital-subscription-add-to-cart' :
        require __DIR__ . '/print-collector-digital-subscription-add-to-cart.php';
        break;
   
    case constant("BASEURL").'/cart' :
        require __DIR__ . '/cart.php';
        break;
    case constant("BASEURL").'cart/' :
        require __DIR__ . '/cart.php';
        break;
    case constant("BASEURL").'/checkout' :
        require __DIR__ . '/checkout.php';
        break;
    case constant("BASEURL").'checkout/' :
        require __DIR__ . '/checkout.php';
        break;
    case constant("BASEURL").'/signup' :
        require __DIR__ . '/signup.php';
        break;
    
    case constant("BASEURL").'/print-reader-digital-subscription-add-to-cart' :
        require __DIR__ . '/print-reader-digital-subscription-add-to-cart.php';
        break;
    case constant("BASEURL").'thank-you-digital2/' :
        require __DIR__ . '/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/thank-you-digital2' :
        require __DIR__ . '/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/thank-you-for-order' :
        require __DIR__ . '/thank-you-for-order.php';
        break;
    case constant("BASEURL").'/thank-you-print' :
        require __DIR__ . '/thank-you-print.php';
        break;
    /*case constant("BASEURL").'/retailer-landing' :
        require __DIR__ . '/retailer-landing.php';
        break;*/
    case constant("BASEURL").'/cart-retail' :
        require __DIR__ . '/cart-retail.php';
        break;
    case constant("BASEURL").'/checkout-retail' :
        require __DIR__ . '/checkout-retail.php';
        break;

    /** SPANISH */
    case constant("BASEURL").'/spanish/signup' :
        require __DIR__ . '/spanish/signup.php';
        break;
    case constant("BASEURL").'/spanish/login' :
        require __DIR__ . '/spanish/login.php';
        break;
    case constant("BASEURL").'/spanish/login2' :
        require __DIR__ . '/spanish/login2.php';
        break;
    case constant("BASEURL").'/spanish/forgot-password' :
        require __DIR__ . '/spanish/forgot-password.php';
        break;
    case constant("BASEURL").'/spanish/forgot-password2' :
        require __DIR__ . '/spanish/forgot-password-2.php';
        break;
    case constant("BASEURL").'/spanish/thank-you-digital2' :
        require __DIR__ . '/spanish/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/spanish/digital-subscription-add-to-cart' :
        require __DIR__ . '/spanish/digital-subscription-add-to-cart.php';
    case constant("BASEURL").'/spanish/cart' :
        require __DIR__ . '/spanish/cart.php';
    case constant("BASEURL").'/spanish/checkout' :
        require __DIR__ . '/spanish/checkout.php';
    
    /** FRENCH */
    case constant("BASEURL").'/french/signup' :
        require __DIR__ . '/french/signup.php';
        break;
    case constant("BASEURL").'/french/login' :
        require __DIR__ . '/french/login.php';
        break;
    case constant("BASEURL").'/french/login2' :
        require __DIR__ . '/french/login2.php';
        break;
    case constant("BASEURL").'/french/forgot-password' :
        require __DIR__ . '/french/forgot-password.php';
        break;
    case constant("BASEURL").'/french/forgot-password2' :
        require __DIR__ . '/french/forgot-password-2.php';
        break;
    case constant("BASEURL").'/french/thank-you-digital2' :
        require __DIR__ . '/french/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/french/digital-subscription-add-to-cart' :
        require __DIR__ . '/french/digital-subscription-add-to-cart.php';
    case constant("BASEURL").'/french/cart' :
        require __DIR__ . '/french/cart.php';
    case constant("BASEURL").'/french/checkout' :
        require __DIR__ . '/french/checkout.php';


    /** GERMAN */
    case constant("BASEURL").'/german/signup' :
        require __DIR__ . '/german/signup.php';
        break;
    case constant("BASEURL").'/german/login' :
        require __DIR__ . '/german/login.php';
        break;
    case constant("BASEURL").'/german/login2' :
        require __DIR__ . '/german/login2.php';
        break;
    case constant("BASEURL").'/german/forgot-password' :
        require __DIR__ . '/german/forgot-password.php';
        break;
    case constant("BASEURL").'/german/forgot-password2' :
        require __DIR__ . '/german/forgot-password-2.php';
        break;
    case constant("BASEURL").'/german/thank-you-digital2' :
        require __DIR__ . '/german/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/german/digital-subscription-add-to-cart' :
        require __DIR__ . '/german/digital-subscription-add-to-cart.php';
    case constant("BASEURL").'/german/cart' :
        require __DIR__ . '/german/cart.php';
    case constant("BASEURL").'/german/checkout' :
        require __DIR__ . '/german/checkout.php';


    /** JAPANESE */
    case constant("BASEURL").'/japanese/signup' :
        require __DIR__ . '/japanese/signup.php';
        break;
    case constant("BASEURL").'/japanese/login' :
        require __DIR__ . '/japanese/login.php';
        break;
    case constant("BASEURL").'/japanese/login2' :
        require __DIR__ . '/japanese/login2.php';
        break;
    case constant("BASEURL").'/japanese/forgot-password' :
        require __DIR__ . '/japanese/forgot-password.php';
        break;
    case constant("BASEURL").'/japanese/forgot-password2' :
        require __DIR__ . '/japanese/forgot-password-2.php';
        break;
    case constant("BASEURL").'/japanese/thank-you-digital2' :
        require __DIR__ . '/japanese/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/japanese/digital-subscription-add-to-cart' :
        require __DIR__ . '/japanese/digital-subscription-add-to-cart.php';
    case constant("BASEURL").'/japanese/cart' :
        require __DIR__ . '/japanese/cart.php';
    case constant("BASEURL").'/japanese/checkout' :
        require __DIR__ . '/japanese/checkout.php';

    /** ITALIAN */
    case constant("BASEURL").'/italian/signup' :
        require __DIR__ . '/italian/signup.php';
        break;
    case constant("BASEURL").'/italian/login' :
        require __DIR__ . '/italian/login.php';
        break;
    case constant("BASEURL").'/italian/login2' :
        require __DIR__ . '/italian/login2.php';
        break;
    case constant("BASEURL").'/italian/forgot-password' :
        require __DIR__ . '/italian/forgot-password.php';
        break;
    case constant("BASEURL").'/italian/forgot-password2' :
        require __DIR__ . '/italian/forgot-password-2.php';
        break;
    case constant("BASEURL").'/italian/thank-you-digital2' :
        require __DIR__ . '/italian/thank-you-digital2.php';
        break;
    case constant("BASEURL").'/italian/digital-subscription-add-to-cart' :
        require __DIR__ . '/italian/digital-subscription-add-to-cart.php';
    case constant("BASEURL").'/italian/cart' :
        require __DIR__ . '/italian/cart.php';
    case constant("BASEURL").'/italian/checkout' :
        require __DIR__ . '/italian/checkout.php';

    default:
        require __DIR__ . '/wp-blog-header.php';
        break;
}
