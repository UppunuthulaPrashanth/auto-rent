<!-- <html>
<head>
<title>PHPMailer - Sendmail basic test</title>
</head>
<body>
-->

<?php
$to = "visit4hiren@gmail.com"; 
$subject = "Test mail autorent";
$message = "Hello! This is a simple test email message.";
$from = "autorentllc@gmail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>

<!--

</body>
</html>
-->