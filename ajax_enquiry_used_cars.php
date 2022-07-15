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
        $firstName      = filter_var($_POST['firstName'],FILTER_SANITIZE_STRING);
        $lastName       = filter_var($_POST['lastName'],FILTER_SANITIZE_STRING);
        $email          = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $phone          = filter_var($_POST['phone'],FILTER_SANITIZE_EMAIL);
        $country        = filter_var($_POST['country'],FILTER_SANITIZE_EMAIL);
        $city           = filter_var($_POST['city'],FILTER_SANITIZE_EMAIL);
        $nationality    = filter_var($_POST['nationality'],FILTER_SANITIZE_EMAIL);
        $address        = filter_var($_POST['address'],FILTER_SANITIZE_EMAIL);
        $message        = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
        $carUsedType    = filter_var($_POST['carUsedType'],FILTER_SANITIZE_STRING);
        $carName        = filter_var($_POST['carName'],FILTER_SANITIZE_STRING);
        $carPrice       = filter_var($_POST['carPrice'],FILTER_SANITIZE_STRING);
        $carKilometer   = filter_var($_POST['carKilometer'],FILTER_SANITIZE_STRING);
        $carRegionalSpec= filter_var($_POST['carRegionalSpec'],FILTER_SANITIZE_STRING);
        $carTransmission= filter_var($_POST['carTransmission'],FILTER_SANITIZE_STRING);
        $carFuel        = filter_var($_POST['carFuel'],FILTER_SANITIZE_STRING);
        $newsletter = 'No';
        if(isset($_POST['newsletter'])) {
            $newsletter = filter_var($_POST['newsletter'], FILTER_SANITIZE_STRING);
        }

        if($newsletter == 'on')
        {
            $newsletter = 'Yes';
        }
        $result = $db->query("INSERT INTO inb_used_cars_enquiry (firstName, lastName, email, mobileNumber, country, city, nationality, address, message, carUsedType, carName, price, kilometer, regionalSpec, transmission, fuel, newsletter)
                                VALUES(?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s)",
            $firstName,
            $lastName,
            $email,
            $phone,
            $country,
            $city,
            $nationality,
            $address,
            $message,
            $carUsedType,
            $carName,
            $carPrice,
            $carKilometer,
            $carRegionalSpec,
            $carTransmission,
            $carFuel,
            $newsletter );


        $res = $db->query("SELECT * FROM smtp_details WHERE active  = 1");

        while($row=mysqli_fetch_assoc($res))
        {
            $SMTP_HOST = $row['host'];
            $SMTP_USERNAME = $row['username'];
            $SMTP_PASSWORD = $row['password'];
            $SMTP_PORT = $row['port'];
            $SMTP_SECURETYPE = $row['secured_type'];
        }




        $notificationType = 4; // this is for Contact Form
        //Retrieve the Notification options
        $sql = $db->query("SELECT * FROM notification_options WHERE id = ?i",$notificationType);
        $row = mysqli_fetch_assoc($sql);

        $emailOutbound = $row["emailOutbound"];
        $emailOutboundName = $row["emailOutboundName"];
        $client_subject = $row["autorespondSubject"];
        $client_message = $row["autorespondMessage"];
        $client_email = $email;
        $internal_subject = $row["int_notificationSubject"];
        $internal_message = $row["int_notificationMessage"];
        $resultPageMessage = $row["resultPageMessage"];


//        if ($debug) echo "Client Sub: " . $sql;

        $formData = "First Name: " . $firstName . "<br/>" .
            "Last Name: " . $lastName . "<br/>" .
            "Email: " . $email . "<br/>" .
            "Phone: " . $phone . "<br/>" .
            "Country: " . $country . "<br/>" .
            "City: " . $city . "<br/>" .
            "Nationality: " . $nationality . "<br/>" .
            "Address: " . $address . "<br/>" .
            "Message: " . $message . "<br/>" .
            "Car Name: " . $carName . "<br/>" .
            "Price: " . $carPrice . "<br/>" .
            "Kilometer: " . $carKilometer . "<br/>" .
            "Regional Spec: " . $carRegionalSpec . "<br/>" .
            "Transmission: " . $carTransmission . "<br/>" .
            "Fuel: " . $carFuel;


        $recipientFormData = "First Name: " . $firstName . "<br/>" .
            "Last Name: " . $lastName . "<br/>" .
            "Email: " . $email . "<br/>" .
            "Phone: " . $phone . "<br/>" .
            "Country: " . $country . "<br/>" .
            "City: " . $city . "<br/>" .
            "Nationality: " . $nationality . "<br/>" .
            "Address: " . $address . "<br/>" .
            "Message: " . $message . "<br/>" .
            "Car Name: " . $carName . "<br/>" .
            "Price: " . $carPrice . "<br/>" .
            "Kilometer: " . $carKilometer . "<br/>" .
            "Regional Spec: " . $carRegionalSpec . "<br/>" .
            "Transmission: " . $carTransmission . "<br/>" .
            "Fuel: " . $carFuel;

        $client_message = $client_message . "<br/> <br/>" . $recipientFormData;
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