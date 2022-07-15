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

//echo print_r($_POST); exit();

$country                = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
$nationality            = filter_var($_POST['nationality'],FILTER_SANITIZE_STRING);
$state                  = filter_var($_POST['state'],FILTER_SANITIZE_STRING);
$city                   = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
$email                   = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $db->query("UPDATE users SET country = ?s, nationality = ?s, state=?s, city=?s WHERE emailID = ?s", $country, $nationality, $state, $city, $email);
//echo $db->lastQuery();
    if ($result) {
        echo "SUCCESS|Passport Information has been Updated.";
        exit();
    } else {
        echo "ERROR|Oops...Something went wrong.";
        exit();
    }
}
?>