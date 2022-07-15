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

//echo print_r($_POST);
// exit();

$mobileNo  = filter_var($_POST['mobileNo'],FILTER_SANITIZE_STRING);
$email      = filter_var($_POST['email'],FILTER_SANITIZE_STRING);


//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $db->query("UPDATE users SET mobileNo = ?s WHERE emailID = ?s", $mobileNo, $email);
//echo $db->lastQuery();
    if ($result) {
        echo "SUCCESS|Mobile Information has been Updated.";
        exit();
    } else {
        echo "ERROR|Oops...Something went wrong.";
        exit();
    }
//}
?>