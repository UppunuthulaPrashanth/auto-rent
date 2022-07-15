<html>
<head>
<title>PHPMailer - Sendmail basic test</title>
</head>
<body>


<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'autorentllc@gmail.com';                   // SMTP username
$mail->Password = 'gr8autorent';               // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('autorentllc@gmail.com', 'Autorent');     //Set who the message is to be sent from
$mail->addReplyTo('autorentllc@gmail.com', 'Autorent');  //Set an alternative reply-to address
$mail->addAddress('visit4hiren@gmail.com', 'Hiren');  // Add a recipient
$mail->addAddress('hiren@autorent-me.com', 'Hiren');  // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments
//$mail->addAttachment('/images/image.jpg', 'new.jpg'); // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'First Test';
$mail->Body    = 'Normal Body Text Test';
$mail->AltBody = 'Alternative Body Text';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
?>

</body>
</html>
