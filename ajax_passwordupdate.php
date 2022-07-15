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

//echo print_r($_POST); exit();


$email                 = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
$currentpassword       = filter_var($_POST['currentpassword'],FILTER_SANITIZE_STRING);
$newpassword           = filter_var($_POST['newpassword'],FILTER_SANITIZE_EMAIL);
$retypenewpassword     = filter_var($_POST['retypepassword'],FILTER_SANITIZE_EMAIL);


$res = $db->query("SELECT * FROM users WHERE emailID = ?s and password= PASSWORD(?s)",$email,$currentpassword);

if (mysqli_num_rows($res) > 0) {

    //Check the password
    if($currentpassword == $newpassword)
    {
        echo "ERROR|New password does not equal to your previous password.";
        exit();
    }
    elseif($newpassword <> $retypenewpassword)
    {
        echo "ERROR|Password mismatch... Please enter correctly!";
        exit();
    }
    else
    {
        $result = $db->query("UPDATE users SET password = PASSWORD(?s) WHERE emailID = ?s", $newpassword, $email );

        if($result)
        {
            echo "SUCCESS|Password has been changed successfully.";
            exit();
        }
        else
        {
            echo "ERROR|Oops...Something went wrong.";
            exit();
        }
    }
    exit();
}
else
{
    echo "ERROR|Check your username or password!";
    exit();
}







