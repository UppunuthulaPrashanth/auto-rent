<?php

$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Please enter your  name";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Please enter your email";
} else {
    $email = $_POST["email"];
}

// MSG PHONE NUMBER
if (empty($_POST["msg_subject"])) {
    $errorMSG .= "Please enter your phone number";
} else {
    $msg_subject = $_POST["msg_subject"];
}


// MSG PHONE NUMBER
$msg_location = $_POST["location"];
$message_content = $_POST["message"];

// Here we get all the information from the fields sent over by the form.

$message = '<html><body>';

$message .='<p style="font-family:Verdana, Geneva, sans-serif;">New member contact with you on your website, Below are his details:</p> ';

$message .= '<table rules="all" style="border-color: #666; width: 100%; border: 1px solid #ccc; font-family:Verdana, Geneva, sans-serif;" cellpadding="10">';

$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" .$name. "</td></tr>";

$message .= "<tr><td><strong>Email:</strong> </td><td>" .$email. "</td></tr>";

$message .= "<tr><td><strong>Phone number:</strong> </td><td>" .$msg_subject. "</td></tr>";

$message .= "<tr><td><strong>Location:</strong> </td><td>" .$msg_location. "</td></tr>";

$message .= "<tr><td><strong>Message:</strong> </td><td>" .$message_content. "</td></tr>";

$message .= "</table>";

$message .= "</body></html>";



	$to = 'bookings@autorent-me.com, aniket@dmsapiens.com, sangeeta@dmsapiens.com, masna@dmsapiens.com, Julie@autorent-me.com';
	//$to = 'fromabdullah@gmail.com';
	$subject = 'Autorent (Booking Query) - '.$name;

	$headers = "MIME-Version: 1.0" . "\r\n";

	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	//$headers = "MIME-Version: 1.0" . "\r\n";

	//$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	//$headers .= "From: Autorent <ali7c1@gmail.com>";
	$headers .= "From: $email\r\n";

	//$headers .= "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n";



if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    mail($to, $subject, $message, $headers);

	echo "success";

}else{

	echo "Invalid Email, please provide an correct email.";

}

?>