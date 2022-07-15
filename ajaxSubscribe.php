<?php include "inc_opendb.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';
$debug = false;

//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();

$subscribeEmail = filter_var($_POST['subscribeemail'], FILTER_SANITIZE_STRING);

$emailExist = $db->query("SELECT * FROM inb_subscribe WHERE email = ?s",$subscribeEmail);
$emailexistResult = mysqli_fetch_assoc($emailExist);

if($emailexistResult > 0)
{
    $message = "ERROR|Email already exists.";
}
else
{
    $result = $db->query("INSERT INTO inb_subscribe  (email) VALUES (?s)",$subscribeEmail);

    $res = $db->query("SELECT * FROM smtp_details WHERE active  = 1");
    while($row=mysqli_fetch_assoc($res))
    {
        $SMTP_HOST = $row['host'];
        $SMTP_USERNAME = $row['username'];
        $SMTP_PASSWORD = $row['password'];
        $SMTP_PORT = $row['port'];
        $SMTP_SECURETYPE = $row['secured_type'];
    }


    $emailTopLogo = $FULL_HOST_NAME . "emailTemplates/autorent-logo.png";

    $notificationType = 2; // this is for Subscribe Form
    //Retrieve the Notification options
    $sql = $db->query("SELECT * FROM notification_options WHERE id = ?i",$notificationType);
    $row = mysqli_fetch_assoc($sql);

    $emailOutbound = $row["emailOutbound"];
    $emailOutboundName = $row["emailOutboundName"];
    $client_subject = $row["autorespondSubject"];
    $client_message = $row["autorespondMessage"];


    $message = file_get_contents('emailTemplates/subscribe.html', true);
    $message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );




    $client_email = $subscribeEmail;
    $internal_subject = $row["int_notificationSubject"];
    $internal_message = $row["int_notificationMessage"];
    $resultPageMessage = $row["resultPageMessage"];


    if ($debug) echo "Client Sub: " . $sql;

    $formData ="Email: " . $subscribeEmail . "<br/>" ;

    $recipientFormData = "Email: " . $subscribeEmail . "<br/>" ;


//    $client_message = $client_message . "<br/> <br/>" . $recipientFormData;

    $client_message = $message;

    $internal_message = $internal_message . "<br/> <br/>" . $recipientFormData;

    //Send Emails

    //Send Client Auto Response
    $mail = new PHPMailer();
    $mail->Host = $SMTP_HOST;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->isHTML( true );
    $mail->Username   = $SMTP_USERNAME;
    $mail->Password   = $SMTP_PASSWORD;
    $mail->SMTPSecure = $SMTP_SECURETYPE;
    $mail->Port       = $SMTP_PORT;



    $mail->From = $emailOutbound;
    $mail->FromName = $emailOutboundName;
    $mail->Subject = $client_subject;
    $mail->WordWrap = 50; // some nice default value


    $mail->IsHTML(true);
    $mail->Body = $client_message;
    $mail->AddReplyTo($emailOutbound);
    $mail->AddAddress($client_email);


    if (!$mail->Send())
    {
        if ($debug) echo $mail->ErrorInfo;
        if ($debug) echo "EMAIL ERROR (email to Client)";
    }
    else
    {
        if ($debug) echo "EMAIL SENT SUCCESSFULLY (email to client)";
    }
    //Send Internal Notifications
    $result = $db->query("SELECT * FROM notification_recipients WHERE idNotificationType = ?i AND active = 1 AND sendEmail = 1",$notificationType);
    while ($row = mysqli_fetch_assoc($result))
    {
        $mail = new PHPMailer();
        $mail->Host = $SMTP_HOST;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->isHTML( true );
        $mail->Username   = $SMTP_USERNAME;
        $mail->Password   = $SMTP_PASSWORD;
        $mail->SMTPSecure = $SMTP_SECURETYPE;
        $mail->Port       = $SMTP_PORT;



        $mail->From = $emailOutbound;
        $mail->FromName = $emailOutboundName;
        $mail->Subject = $internal_subject;
        $mail->WordWrap = 50; // some nice default value


        $mail->IsHTML(true);
        $mail->Body = $internal_message;
        $mail->AddReplyTo($emailOutbound);
        $mail->AddAddress($row["recipientEmail"]);


        if (!$mail->Send())
        {
            if ($debug) echo $mail->ErrorInfo;
            if ($debug) echo "EMAIL ERROR (email to internal)";

        }
        else
        {
            if ($debug) echo "EMAIL SENT SUCCESSFULLY (email to internal)";
        }
    }

    if($result)
    {
        $message="SUCCESS|" . $resultPageMessage;
    }
    else
    {
        $message="ERROR|Oops...Something went wrong.";
    }
}
echo $message;
exit();