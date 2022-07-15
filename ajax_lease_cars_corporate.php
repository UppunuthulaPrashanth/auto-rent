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
//
//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $leaseCarsType = filter_var($_POST['companyLease'], FILTER_SANITIZE_STRING);

        $companyLeaseName = filter_var($_POST['companyLeaseName'], FILTER_SANITIZE_STRING);
        $companyLeaseCompanyName = filter_var($_POST['companyLeaseCompanyName'], FILTER_SANITIZE_EMAIL);
        $companyLeaseEmail = filter_var($_POST['companyLeaseEmail'], FILTER_SANITIZE_EMAIL);
        $companyLeasePhone = filter_var($_POST['companyLeasePhone'], FILTER_SANITIZE_EMAIL);
        $companyLeaseSpecificRequirement = filter_var($_POST['companyLeaseSpecificRequirement'], FILTER_SANITIZE_STRING);

        if ($leaseCarsType != '' && $companyLeaseName != '' && $companyLeaseCompanyName != '' && $companyLeaseEmail != '' && $companyLeasePhone != '' && $companyLeaseSpecificRequirement != '') {

            $result = $db->query("INSERT INTO inb_lease_cars (leaseCarType, fullname, email, phone, companyName, specificRequirement)
                                VALUES(?s,?s,?s,?s,?s,?s)", $leaseCarsType, $companyLeaseName,  $companyLeaseEmail, $companyLeasePhone, $companyLeaseCompanyName, $companyLeaseSpecificRequirement);


            $res = $db->query("SELECT * FROM smtp_details WHERE active  = 1");

            while ($row = mysqli_fetch_assoc($res)) {
                $SMTP_HOST = $row['host'];
                $SMTP_USERNAME = $row['username'];
                $SMTP_PASSWORD = $row['password'];
                $SMTP_PORT = $row['port'];
                $SMTP_SECURETYPE = $row['secured_type'];
            }


            $notificationType = 5; // this is for Lease Form
            //Retrieve the Notification options
            $sql = $db->query("SELECT * FROM notification_options WHERE id = ?i", $notificationType);
            $row = mysqli_fetch_assoc($sql);

            $emailOutbound = $row["emailOutbound"];
            $emailOutboundName = $row["emailOutboundName"];
            $client_subject = $row["autorespondSubject"];
            $client_message = $row["autorespondMessage"];
            $client_email = $companyLeaseEmail;
            $internal_subject = $row["int_notificationSubject"];
            $internal_message = $row["int_notificationMessage"];
            $resultPageMessage = $row["resultPageMessage"];


//        if ($debug) echo "Client Sub: " . $sql;

            $formData = "Name: " . $companyLeaseName . "<br/>" .
                "Company Name: " . $companyLeaseCompanyName . "<br/>" .
                "Email: " . $companyLeaseEmail . "<br/>" .
                "Phone: " . $companyLeasePhone . "<br/>" .
                "Specific Requirement: " . $companyLeaseSpecificRequirement . "<br/>" .
                "Lease Car Type: " . $leaseCarsType;


            $recipientFormData = "Name: " . $companyLeaseName . "<br/>" .
                "Company Name: " . $companyLeaseCompanyName . "<br/>" .
                "Email: " . $companyLeaseEmail . "<br/>" .
                "Phone: " . $companyLeasePhone . "<br/>" .
                "Specific Requirement: " . $companyLeaseSpecificRequirement . "<br/>" .
                "Lease Car Type: " . $leaseCarsType;

            $client_message = $client_message . "<br/> <br/>" . $recipientFormData;
            $internal_message = $internal_message . "<br/> <br/>" . $recipientFormData;

            //Send Emails

            //Send Client Auto Response
            $mail = new PHPMailer();
            $mail->Host = $SMTP_HOST;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->isHTML(true);
            $mail->Username = $SMTP_USERNAME;
            $mail->Password = $SMTP_PASSWORD;
            $mail->SMTPSecure = $SMTP_SECURETYPE;
            $mail->Port = $SMTP_PORT;

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

            if (!$mail->Send()) {
                if ($debug) echo $mail->ErrorInfo;
                if ($debug) echo "EMAIL ERROR (email to Client)";
            } else {
                if ($debug) echo "EMAIL SENT SUCCESSFULLY (email to client)";
            }

            //Send Internal Notifications
            $result = $db->query("SELECT * FROM notification_recipients WHERE idNotificationType = ?i AND active = 1 AND sendEmail = 1", $notificationType);
            while ($row = mysqli_fetch_assoc($result)) {
                $mail = new PHPMailer();
                $mail->Host = $SMTP_HOST;
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->isHTML(true);
                $mail->Username = $SMTP_USERNAME;
                $mail->Password = $SMTP_PASSWORD;
                $mail->SMTPSecure = $SMTP_SECURETYPE;
                $mail->Port = $SMTP_PORT;


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

                if (!$mail->Send()) {
                    if ($debug) echo $mail->ErrorInfo;
                    if ($debug) echo "EMAIL ERROR (email to internal)";

                } else {
                    if ($debug) echo "EMAIL SENT SUCCESSFULLY (email to internal)";

                }
            }
            echo "SUCCESS|" . "$resultPageMessage";
        }
    }
else
{
    $errors = $resp->getErrorCodes();
    echo "ERROR|" ."something went wrong";
    exit();
}

exit();