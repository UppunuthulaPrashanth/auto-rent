
<?php

// Define some constants
define( "RECIPIENT_NAME", "AutoRent" );
define( "RECIPIENT_EMAIL", "autorentllc@gmail.com" );

// Read the form values
//$success = false;

// $name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
//$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
//$phone = isset( $_POST['phone'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone'] ) : "";
//$company = isset( $_POST['company'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['company'] ) : "";
// $region = isset( $_POST['region'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['region'] ) : "";
// $location = isset( $_POST['location'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['location'] ) : "";
// $startdate = isset( $_POST['startdate'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['startdate'] ) : "";
// $enddate = isset( $_POST['enddate'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['enddate'] ) : "";
// $message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// defining mail subject
// $mail_subject = 'KSA Campaign Lead: A Booking request send by ' . $name;
// $mail_subject_user = 'Booking Request Information for ' . $name;


//$body = 'Name: '. $name . "\r\n";
//$body .= 'Email: '. $senderEmail . "\r\n";
//$body .= 'Phone: '. $phone . "\r\n";
//$body .= 'company: '. $company . "\r\n";
//$body .= 'region: '. $region . "\r\n";
//$body .= 'Message: '. "\r\n" . $message;

/*
$body = 'test email';
$email = 'autorentllc@gmail.com';

$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host = "smtp.office365.com"; // SMTP server
$mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->Host =  "smtp.office365.com"; // sets the SMTP server
$mail->Port = 587; // set the SMTP port for the GMAIL server
$mail->Username = "bookings@autorent-me.com"; // SMTP account username
$mail->Password = "Booking@124800"; // SMTP account password
$mail->SMTPSecure = 'tls'; //SMTP secure

$mail->SetFrom('bookings@autorent-me.com', 'Autorent Car Rental');
$mail->AddReplyTo("bookings@autorent-me.com", "Autorent Car Rental");

$mail->Subject = "Your Booking Confirmation ID : 101 (Test)";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
*/

//$mail->MsgHTML($html2);
//$mail->AddAddress($email);
//$res=$mail->Send();



// If all values exist, send the email

  // if ( $name && $senderEmail && $message ) {
  // $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  // $headers = "From: " . $name . " <" . $senderEmail . ">";
  // $success = mail( $recipient, $mail_subject, $body, $headers ); 


// another confirmation email for user 

  //$headers_user = "From: " . RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  // mail($senderEmail, $mail_subject_user, $body, $headers_user );

 /*
$mail->MsgHTML($body);
$mail->AddAddress($email);
$res=$mail->Send();
*/
  
  //echo "<p class='success'>Thanks for contacting us. We will contact you ASAP!</p>";
  
//header('Location: thank-you.html');
//exit;
//}


  mail("autorentllc@gmail.com","Test email","Test Body");
  
?>

