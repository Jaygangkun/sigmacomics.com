<?php
ob_start();
session_start();
$msg = array();

// Get our helper functions
require_once("language_redirect.php");
unset($_SESSION['user']);
header('Location: '.constant("SITEURL_ITALIAN").'/login');
exit();

?>