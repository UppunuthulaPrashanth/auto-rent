<html>
<head>
<title>PHPMailer - Sendmail basic test</title>
</head>
<body>


<?php 
//@@@@@@@@@@@@@@@@@@@@@@
//START Init PHPMailer: This block of code only runs once per page
//@@@@@@@@@@@@@@@@@@@@@@
$mailx = new PHPMailer();
$mailx->IsSMTP();
//$mailx->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
$mailx->SMTPAuth = true;
//$mailx->SMTPSecure = 'ssl';
$mailx->Host = 'in.mailjet.com';
$mailx->Port = 80;
$mailx->Username = 'hiren@autorent-me.com';
$mailx->Password = 'autorent@sbc';
$mailx->isHTML(true);
$mailx->SMTPKeepAlive = true;
//@@@@@@@@@@@@@@@@@@@@@@
//END Init PHPMailer: This block of code only runs once per page
//@@@@@@@@@@@@@@@@@@@@@@


$mailTo = "hiren@autorent-me.com";
$mailSubject = "Test";
$mailBody ="it is test body";

function doMailJet($mailx, $mailTo, $mailSubject, $mailBody, $monitor=true, $mailFrom="marketing@autorent-me.com")
{
    $toArray = explode(',', $mailTo);

    $mailx->AltBody  = $mailBody; //This is the body in plain text for non-HTML mail clients
    $mailBody        = makeMailJetHtmlBody($mailBody);
    $mailx->Subject  = $mailSubject;
    $mailx->Body     = $mailBody;
    $mailx->From     = $mailFrom;
    $mailx->FromName = 'Message from MySite';
    $mailx->addReplyTo($mailFrom, 'Reply to MySite');
    foreach($toArray as $toAddress) $mailx->addAddress($toAddress);
    //if($monitor) $mail->AddBCC('gordon@mysite.com', 'Gordon');

    if(!$mailx->send()) {
        //echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mailx->ErrorInfo;
        return false;
    } else {
        //echo 'Message has been sent';
        return true;
    }
}

echo 'Testing doMailJet...<br>';
$time_start = microtime(true); //Lets see how long this is going to take.
for ($x=0; $x<=10; $x++) {
  echo "Sending: $x <br>";
  doMailJet($mailx, 'hiren@auotrent-me.com','Testing 123','Test Message',false);
}
echo 'getTimeElapsed: '.getTimeElapsed($time_start);
?>


</body>
</html>
