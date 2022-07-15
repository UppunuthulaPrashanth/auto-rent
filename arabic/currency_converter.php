<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);


if (isset($_POST)) {
	$amount=$_POST['amount'];
	$from=$_POST['from'];
	$to=$_POST['to'];

	$currency = paymentdb::getInstance();
	$result=$currency->currency_converter($amount,$from,$to);
    $result=round($result,2);

	echo $result;
}
 ?>