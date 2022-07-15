<?php
include "inc_opendb.php";
//include_once "libs/class.phpmailer.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';


//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );

$debug = false;

//echo "<pre>";
//echo print_r($_POST);
//print_r($_FILES);
//echo "</pre>";
//exit();

//$siteKey = '6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX';
//$secret = '6LcDPtAZAAAAAEbxtl-_JZ7Zv4_nUvtO4eZl3ams';
//$licenseNumber            = '';
//$licenseExpiry            = '';
//$licensePlaceOfIssue      = '';
//$passportNumber           = '';
//$passportExpiry           = '';
//$passportPlaceOfIssue     = '';



//$remoteIp = $_SERVER['REMOTE_ADDR'];

//    echo "SUCCESS|" ."Verified";


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $file_formats = array("png", "jpg", "jpeg", "pdf" );
    $filename = $_FILES['passportAttachment']['name']; // filename to get file's extension
    $size = $_FILES['passportAttachment']['size'];
    $filePath = "uploads/documents/";
    $pfile = "";

    //Check for file
    if (strlen($filename))
    {
        $extension = substr($filename, strrpos($filename, '.') + 1);
        if (in_array($extension, $file_formats))
        {
            $file_name = 'pass_';
            $pfile = ($file_name . time()) . "." . $extension;
            $tmp = $_FILES['passportAttachment']['tmp_name'];
            move_uploaded_file($tmp, $filePath . $pfile);
        }
        else
        {
            echo "ERROR|Invalid file format! Accept only .png, .jpg, .jpeg, .pdf format!!";
            exit();
        }
    }


    $file_formats = array("png", "jpg", "jpeg", "pdf");
    $filename = $_FILES['licenseAttachment']['name']; // filename to get file's extension
    $size = $_FILES['licenseAttachment']['size'];
    $filePath = "uploads/documents/";
    $file = "";
    $lfile = "";

    //Check for file
    /*if (strlen($filename))
    {
        $extension = substr($filename, strrpos($filename, '.') + 1);
        if (in_array($extension, $file_formats))
        {
            $file_name = 'lic_';
            $lfile = ($file_name . time()) . "." . $extension;
            $tmp = $_FILES['licenseAttachment']['tmp_name'];
            move_uploaded_file($tmp, $filePath . $lfile);
        }
        else
        {
            echo "ERROR|Invalid file format! Accept only .png, .jpg. .jpeg, .pdf format!!";
            exit();
        }
    }*/

    $docsupload               = 0;

    $firstName                = filter_var($_POST['firstName'],FILTER_SANITIZE_STRING);
    $lastName                 = filter_var($_POST['lastName'],FILTER_SANITIZE_STRING);
    $emailID                  = filter_var($_POST['emailID'],FILTER_SANITIZE_EMAIL);
    $mobileNo                 = filter_var($_POST['mobileNo'],FILTER_SANITIZE_STRING);
    $code                     = filter_var($_POST['code'],FILTER_SANITIZE_STRING);
    $country                  = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
    $city                     = filter_var($_POST['city'],FILTER_SANITIZE_STRING);

//        $nationality              = filter_var($_POST['nationality'],FILTER_SANITIZE_STRING);
    $address                  = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
    $state                    = filter_var($_POST['state'],FILTER_SANITIZE_EMAIL);
    $pincode                  = filter_var($_POST['pincode'],FILTER_SANITIZE_STRING);
    $visaStatus               = filter_var($_POST['visaStatus'],FILTER_SANITIZE_STRING);
    $emiratesID               = filter_var($_POST['emiratesID'],FILTER_SANITIZE_STRING);
    $docsupload               = filter_var($_POST['docs-upload'],FILTER_SANITIZE_STRING);

    $licenseNumber            = filter_var($_POST['licenseNumber'],FILTER_SANITIZE_STRING);
    $licenseExpiry            = filter_var($_POST['licenseExpiry'],FILTER_SANITIZE_STRING);
    $licensePlaceOfIssue      = filter_var($_POST['licensePlaceOfIssue'],FILTER_SANITIZE_EMAIL);
    $passportNumber           = filter_var($_POST['passportNumber'],FILTER_SANITIZE_STRING);
    $passportExpiry           = filter_var($_POST['passportExpiry'],FILTER_SANITIZE_STRING);
    $passportPlaceOfIssue     = filter_var($_POST['passportPlaceOfIssue'],FILTER_SANITIZE_STRING);


 $alreadyExsitCheckQuery=$db->query("select emailID from users where emailID=?s",$emailID);
    if(mysqli_num_rows($alreadyExsitCheckQuery)>0)
    {
        echo "ERROR|This email id is already used";
        exit();
    }
    if (strlen($filename))
    {
        $extension = substr($filename, strrpos($filename, '.') + 1);
        if (in_array($extension, $file_formats))
        {
            $file_name = 'pass_';
            $pfile = ($file_name . time()) . "." . $extension;
            $tmp = $_FILES['passportAttachment']['tmp_name'];
            move_uploaded_file($tmp, $filePath . $pfile);
        }
        else
        {
            echo "ERROR|Invalid file format! Accept only .png, .jpg, .jpeg, .pdf format!!";
            exit();
        }
    }



    if(!empty($_POST['licenseExpiry'])){
        $licenseExpiry            = filter_var($_POST['licenseExpiry'],FILTER_SANITIZE_STRING);
    }
    else{

        $licenseExpiry            = NULL;
    }




    if(!empty($_POST['passportExpiry'])) {
        $passportExpiry           = filter_var($_POST['passportExpiry'],FILTER_SANITIZE_STRING);

    }
    else
    {
        $passportExpiry = NULL;
    }


    $validdrivinglicense      = 0;

    if(isset($_POST['validdrivinglicense '])){
        $validdrivinglicense = filter_var($_POST['validdrivinglicense'],FILTER_SANITIZE_STRING);
    }


    $validpassport            = 0;
    if(isset($_POST['validpassport '])){
        $validpassport            = filter_var($_POST['validpassport'],FILTER_SANITIZE_STRING);
    }


    $validcreditcard = 0;
    if(isset($_POST['validcreditcard '])){
        $validcreditcard          = filter_var($_POST['validcreditcard'],FILTER_SANITIZE_EMAIL);
    }


    $validdriverage = 0;
    if(isset($_POST['validdriverage '])){
        $validdriverage           = filter_var($_POST['validdriverage'],FILTER_SANITIZE_STRING);
    }

    $signUpNewsletter = 0;
    if(isset($_POST['signUpNewsletter '])){
        $signUpNewsletter         = filter_var($_POST['signUpNewsletter'],FILTER_SANITIZE_STRING);
    }


    $choosePassword           = filter_var($_POST['choosePassword'],FILTER_SANITIZE_STRING);
    $confirmPassword          = filter_var($_POST['confirmPassword'],FILTER_SANITIZE_STRING);

    $check                    = "on";

    if( $docsupload == $check )
    {
        $docsupload = 1;
    }
    if( $validdrivinglicense == $check )
    {
        $validdrivinglicense = 1;
    }
    if( $validpassport == $check )
    {
        $validpassport = 1;
    }
    if( $validcreditcard == $check )
    {
        $validcreditcard = 1;
    }
    if( $validdriverage == $check )
    {
        $validdriverage = 1;
    }
//        if( $signUpNewsletter == $check )
//        {
//            $signUpNewsletter = 1;
//        }

    if($choosePassword != $confirmPassword)
    {
        echo "ERROR|Confirm Password Does Not Equal to Your Choose Password.";
        exit();
    }
    if($choosePassword == $confirmPassword) {

        $mobileNo   = $code ." - ".$mobileNo;

        $result = $db->query("INSERT INTO users (firstName, lastName, emailID, mobileNo, country, city, 
        address, state, pincode, visaStatus, emiratesID, licenseNumber, licenseExpiry, licensePlaceOfIssue, licenseAttachment,
        passportNumber, passportExpiry, passportPlaceOfIssue, passportAttachment, signUpNewsletter,password, currentCurrency,currentLanguage)
                                VALUES(?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,PASSWORD(?s),?s,?s)",

            $firstName, $lastName, $emailID, $mobileNo, $country, $city,
            $address, $state, $pincode, $visaStatus, $emiratesID, $licenseNumber,
            $licenseExpiry, $licensePlaceOfIssue, $lfile,
            $passportNumber, $passportExpiry, $passportPlaceOfIssue,
            $pfile, $signUpNewsletter,$choosePassword,'AED','en'
        );

        //Now do the login
        $newUserID = $db->insertId();
        $res = $db->query( "SELECT * FROM users WHERE userID = ?s", $newUserID );

        if ( mysqli_num_rows( $res ) > 0 )
        {
            while ( $row = mysqli_fetch_assoc( $res ) )
            {
                $_SESSION[ USER_EMAIL ] = $row['emailID'];
                $_SESSION[ USERID ] = $row['userID'];
                $_SESSION[ FIRSTNAME ]  = $row['firstName'];
                $_SESSION[ LASTNAME ]   = $row['lastName'];
                $_SESSION[ LOGGED_IN ]  = true;

                $_SESSION["current_currency"] = $row['currentCurrency'];
                $_SESSION["current_language"] = $row['currentLanguage'];
            }
        }

        $res = $db->query("SELECT * FROM smtp_details WHERE active  = 1");

        while($row=mysqli_fetch_assoc($res))
        {
            $SMTP_HOST = $row['host'];
            $SMTP_USERNAME = $row['username'];
            $SMTP_PASSWORD = $row['password'];
            $SMTP_PORT = $row['port'];
            $SMTP_SECURETYPE = $row['secured_type'];
        }


//            $nationality              = getNationalityFromID(filter_var($_POST['nationality'], FILTER_SANITIZE_STRING));
        $country                  = getCountryFromID(filter_var($_POST['country'], FILTER_SANITIZE_STRING));


        $emailTopLogo = $FULL_HOST_NAME . "emailTemplates/autorent-logo.png";


        $notificationType = 13; // this is for Register Form
        //Retrieve the Notification options
        $sql = $db->query("SELECT * FROM notification_options WHERE id = ?i",$notificationType);
        $row = mysqli_fetch_assoc($sql);

        $emailOutbound = $row["emailOutbound"];
        $emailOutboundName = $row["emailOutboundName"];
        $client_subject = $row["autorespondSubject"];
        $client_message = $row["autorespondMessage"];

        $message = file_get_contents('emailTemplates/new-registration.html', true);
        $message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );
//        $message = str_replace( "{USERNAME}", $emailID, $message );
//        $message = str_replace( "{PASSWORD}", $choosePassword, $message );


        $client_email = $emailID;
        $internal_subject = $row["int_notificationSubject"];
        $internal_message = $row["int_notificationMessage"];
        $resultPageMessage = $row["resultPageMessage"];


//        if ($debug) echo "Client Sub: " . $sql;

        $formData = "First Name: " . $firstName . "<br/>" .
            "Last Name: " . $lastName . "<br/>" .
            "Email: " . $emailID . "<br/>" .
            "Mobile: " . $mobileNo . "<br/>" .
            "Country: " . $country . "<br/>" .
            "City: " . $city . "<br/>" .
            "Address: " . $address . "<br/>" .
            "State: " . $state . "<br/>" .
            "Pincode: " . $pincode . "<br/>";


        $recipientFormData = "First Name: " . $firstName . "<br/>" .
            "Last Name: " . $lastName . "<br/>" .
            "Email: " . $emailID . "<br/>" .
            "Mobile: " . $mobileNo . "<br/>" .
            "Country: " . $country . "<br/>" .
            "City: " . $city . "<br/>" .
            "Address: " . $address . "<br/>" .
            "State: " . $state . "<br/>" .
            "Pincode: " . $pincode . "<br/><br/><br/><br/><br/><br/>" .
            "<img src='$FULL_HOST_NAME/uploads/pages/logo-web.png'> <br/>".
            "For more details, please call - 600549993 <br/>";




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


        echo "SUCCESS";

    }

}

exit();