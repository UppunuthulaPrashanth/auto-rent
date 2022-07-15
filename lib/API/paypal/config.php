<?php
//start session in all pages
if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

$PayPalMode 			= 'sandbox'; // sandbox or live
$PayPalApiUsername 		= 'waqas-facilitator_api1.d4int.com'; //PayPal API Username
$PayPalApiPassword 		= '8C56GBNA9RTUCK5A'; //Paypal API password
$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31ANfssSADPa0zDOjCENer.nvk7SZB'; //Paypal API Signature
$PayPalCurrencyCode 	= 'USD'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://autorent-me.com/lib/API/paypal/process.php'; //Point to process.php page
$PayPalCancelURL 		= 'http://autorent-me.com/cancel_url.php'; //Cancel URL if user clicks cancel
?>
