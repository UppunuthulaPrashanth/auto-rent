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
        $selectedType          = filter_var($_POST['selectedType'],FILTER_SANITIZE_STRING);
        $firstName             = filter_var($_POST['firstName'],FILTER_SANITIZE_STRING);
        $lastName              = filter_var($_POST['lastName'],FILTER_SANITIZE_EMAIL);
        $email                 = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $phone                 = filter_var($_POST['phone'],FILTER_SANITIZE_EMAIL);
        $country               = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
        $city                  = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
        $vehicle               = filter_var($_POST['vehicle'],FILTER_SANITIZE_STRING);
        $specificRequirement   = filter_var($_POST['specificRequirement'],FILTER_SANITIZE_STRING);

        $corporateCompanyName                   = filter_var($_POST['corporateCompanyName'],FILTER_SANITIZE_STRING);
        $corporateFullName                      = filter_var($_POST['corporateFullName'],FILTER_SANITIZE_STRING);
//        $corporateEmail                         = filter_var($_POST['corporateEmail'],FILTER_SANITIZE_STRING);
//        $corporatePhone                         = filter_var($_POST['corporatePhone'],FILTER_SANITIZE_STRING);
//        $corporateCountry                       = filter_var($_POST['corporateCountry'],FILTER_SANITIZE_STRING);
//        $corporateCity                          = filter_var($_POST['corporateCity'],FILTER_SANITIZE_STRING);
        $corporateVehicle                         = filter_var($_POST['corporateVehicle'],FILTER_SANITIZE_STRING);
        $noOfVehicle                            = filter_var($_POST['noOfVehicle'],FILTER_SANITIZE_STRING);
        $corporateSpecificRequirement           = filter_var($_POST['corporateSpecificRequirement'],FILTER_SANITIZE_STRING);



        $result = $db->query("INSERT INTO inb_new_vehicle_enquiry (selectedType,
                                                                    individualFirstName,
                                                                     individualLastName,
                                                                      email,
                                                                       phone,
                                                                       country,
                                                                       city,
                                                                       individualVehicle,
                                                                       individualSpecificRequirement,
                                                                       corporateCompanyName,
                                                                       corporateFullName,
                                                                       corporateVehicle,
                                                                       corporateNoOfVehicle,
                                                                        corporateSpecificRequirement)
                                VALUES(?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s)",
                                                                        $selectedType, $firstName, $lastName, $email, $phone, $country, $city, $vehicle, $specificRequirement,
                                                                         $corporateCompanyName, $corporateFullName, $corporateVehicle, $noOfVehicle, $corporateSpecificRequirement);


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

        $notificationType = 6; // this is for New vehicle Enquiry Form
        //Retrieve the Notification options
        $sql = $db->query("SELECT * FROM notification_options WHERE id = ?i",$notificationType);
        $row = mysqli_fetch_assoc($sql);

        $emailOutbound = $row["emailOutbound"];
        $emailOutboundName = $row["emailOutboundName"];
        $client_subject = $row["autorespondSubject"];
        $client_message = $row["autorespondMessage"];


        $message = file_get_contents('emailTemplates/lease-cars-corporate-leasing.html', true);
        $message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );



        $client_email = $email;
        $internal_subject = $row["int_notificationSubject"];
        $internal_message = $row["int_notificationMessage"];
        $resultPageMessage = $row["resultPageMessage"];


//        if ($debug) echo "Client Sub: " . $sql;



        if($selectedType =='Individual')
        {

            $formData = "Selected Type: " . $selectedType . "<br/>" .
                "First Name: " . $firstName . "<br/>" .
                "Last Name: " . $lastName . "<br/>" .
                "Email: " . $email . "<br/>" .
                "Phone: " . $phone . "<br/>" .
                "Country: " . $country . "<br/>" .
                "City: " . $city . "<br/>" .
                "Vehicle: " . $vehicle . "<br/>" .
                "Specific Requirement: " . $specificRequirement  ;


            $recipientFormData = "Selected Type: " . $selectedType . "<br/>" .
                "First Name: " . $firstName . "<br/>" .
                "Last Name: " . $lastName . "<br/>" .
                "Email: " . $email . "<br/>" .
                "Phone: " . $phone . "<br/>" .
                "Country: " . $country . "<br/>" .
                "City: " . $city . "<br/>" .
                "Vehicle: " . $vehicle . "<br/>" .
                "Specific Requirement: " . $specificRequirement ."<br/><br/><br/><br/><br/><br/>" .
                "<img src='$FULL_HOST_NAME/uploads/pages/logo-web.png'> <br/>".
                "For more details, please call - 600549993 <br/>";



//            $client_message = $client_message . "<br/> <br/>" . $recipientFormData;
            $client_message = $message;


            $internal_message = $internal_message . "<br/> <br/>" . $recipientFormData;

        }
        if($selectedType =='Corporate')
        {

            $formData = "Selected Type: " . $selectedType . "<br/>" .
                "Company Name: " . $corporateCompanyName . "<br/>" .
                "Name: " . $corporateFullName . "<br/>" .
                "Email: " . $email . "<br/>" .
                "Phone: " . $phone . "<br/>" .
                "Country: " . $country . "<br/>" .
                "City: " . $city . "<br/>" .
                "Vehicle: " . $corporateVehicle . "<br/>" .
                "No.of.Vehicle Required: " . $noOfVehicle . "<br/>" .
                "Specific Requirement: " . $corporateSpecificRequirement  ;


            $recipientFormData = "Selected Type: " . $selectedType . "<br/>" .
                "Company Name: " . $corporateCompanyName . "<br/>" .
                "Name: " . $corporateFullName . "<br/>" .
                "Email: " . $email . "<br/>" .
                "Phone: " . $phone . "<br/>" .
                "Country: " . $country . "<br/>" .
                "City: " . $city . "<br/>" .
                "Vehicle: " . $corporateVehicle . "<br/>" .
                "No.of.Vehicle Required: " . $noOfVehicle . "<br/>" .
                "Specific Requirement: " . $corporateSpecificRequirement  ;

//            $client_message = $client_message . "<br/> <br/>" . $recipientFormData;

            $client_message = $message;

            $internal_message = $internal_message . "<br/> <br/>" . $recipientFormData;
        }

//        $formData = "Selected Type: " . $selectedType . "<br/>" .
//            "First Name: " . $firstName . "<br/>" .
//            "Last Name: " . $lastName . "<br/>" .
//            "Email: " . $email . "<br/>" .
//            "Phone: " . $phone . "<br/>" .
//            "Country: " . $country . "<br/>" .
//            "City: " . $city . "<br/>" .
//            "Vehicle: " . $vehicle . "<br/>" .
//            "Specific Requirement: " . $specificRequirement  ;
//
//
//        $recipientFormData = "Name: " . $name . "<br/>" .
//            "Subject: " . $subject . "<br/>" .
//            "Email: " . $email . "<br/>" .
//            "Phone: " . $phone . "<br/>" .
//            "Address: " . $address . "<br/>" .
//            "Message: " . $message  ;
//
//        $client_message = $client_message . "<br/> <br/>" . $recipientFormData;
//        $internal_message = $internal_message . "<br/> <br/>" . $recipientFormData;


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