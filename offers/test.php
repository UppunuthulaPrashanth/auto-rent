<html>
<head>
<title>PHPMailer - Sendmail basic test</title>
</head>
<body>

<?php
// This calls sends an email to one recipient.
$mj = new Mailjet('b2608a653c0ea800fb807ea9961575f4','7d043daeacadb3fd45f7a9d6ba36d66b');
$params = array(
    "method" => "POST",
    "FromEmail" => "hiren@mailjet.com",
    "FromName" => "Mailjet Pilot",
    "Subject" => "Your email flight plan!",
    "Text-part" => "Dear passenger, welcome to Mailjet! May the delivery force be with you!",
    "Html-part" => "<h3>Dear passenger, welcome to Mailjet!</h3><br />May the delivery force be with you!",
    "Recipients" => json_decode('[{"Email":"hiren@mailjet.com"}]', true)
);
$result = $mj->send($params);
if ($mj->_response_code == 200){
   echo "success";
   var_dump($result);
} else {
   echo "error - ".$mj->_response_code;
   var_dump($mj->_response);
}
?>


</body>
</html>
