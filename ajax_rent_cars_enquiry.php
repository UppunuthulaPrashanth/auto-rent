<?php
include "inc_opendb.php";
//include_once "libs/class.phpmailer.php";
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

$siteKey = '6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX';
$secret = '6LcDPtAZAAAAAEbxtl-_JZ7Zv4_nUvtO4eZl3ams';


require('reCaptcha/autoload.php');
//$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\CurlPost());

$gRecaptchaResponse = $_POST['g-recaptcha-response'];
$remoteIp = $_SERVER['REMOTE_ADDR'];

$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

if ($resp->isSuccess())
{
//    echo "SUCCESS|" ."Verified";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $carTitle               = filter_var($_POST['carTitle'],FILTER_SANITIZE_STRING);
        $name                   = filter_var($_POST['fullName'],FILTER_SANITIZE_STRING);
        $companyName            = filter_var($_POST['companyName'],FILTER_SANITIZE_STRING);
        $email                  = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $phone                  = filter_var($_POST['phone'],FILTER_SANITIZE_EMAIL);
        $specialRequirement     = filter_var($_POST['specialRequirement'],FILTER_SANITIZE_STRING);



        $result = $db->query("INSERT INTO inb_rent_cars_enquiry (carTitle,fullName, companyName, email, phone, specificRequirement)
                                VALUES(?s,?s,?s,?s,?s,?s)", $carTitle, $name, $companyName, $email, $phone,  $specialRequirement);


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

        $notificationType = 14; // this is for Rent Cars Enquiry Form
        //Retrieve the Notification options
        $sql = $db->query("SELECT * FROM notification_options WHERE id = ?i",$notificationType);
        $row = mysqli_fetch_assoc($sql);

        $emailOutbound = $row["emailOutbound"];
        $emailOutboundName = $row["emailOutboundName"];
        $client_subject = $row["autorespondSubject"];
        $client_message = $row["autorespondMessage"];

        $message = file_get_contents('emailTemplates/rent-enquiry.html', true);
        $message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );
//        $message = str_replace( "{VEHICLE-NAME}", $carTitle, $message );
//        $message = str_replace( "{NAME}", $name, $message );
//        $message = str_replace( "{COMPANY-NAME}", $companyName, $message );
//        $message = str_replace( "{PHONE}", $phone, $message );
//        $message = str_replace( "{EMAIL}", $email, $message );
//        $message = str_replace( "{SPECIAL-REQUIREMENT}", $specialRequirement, $message );

        $client_email = $email;
        $internal_subject = $row["int_notificationSubject"];
        $internal_message = $row["int_notificationMessage"];
        $resultPageMessage = $row["resultPageMessage"];


//        if ($debug) echo "Client Sub: " . $sql;

        $formData = "Car Title: " . $carTitle . "<br/>" .
            "Full Name: " . $name . "<br/>" .
            "Company Name: " . $companyName . "<br/>" .
            "Email: " . $email . "<br/>" .
            "Phone: " . $phone . "<br/>" .
            "Special Requirement: " . $specialRequirement  ;


        $recipientFormData = "Car Title: " . $carTitle . "<br/>" .
            "Full Name: " . $name . "<br/>" .
            "Company Name: " . $companyName . "<br/>" .
            "Email: " . $email . "<br/>" .
            "Phone: " . $phone . "<br/>" .
            "Special Requirement: " . $specialRequirement  ;

//        $client_message = $client_message . "<br/> <br/>" . $recipientFormData;
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

//        $mail->SMTPDebug = 2;
//        $debug = true;

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

//            $mail->SMTPDebug = 2;
//            $debug = true;

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
        echo "SUCCESS|" ."$resultPageMessage";
    }
}
else
{
    $errors = $resp->getErrorCodes();
    echo "ERROR|" ."Captcha Error";
    exit();
}

exit();