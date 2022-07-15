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

$language              = filter_var($_POST['language'],FILTER_SANITIZE_STRING);
$email                 = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = $db->query("UPDATE users SET currentLanguage = ?s
WHERE emailID = ?s", $language, $email);
//echo $db->lastQuery();
    if ($result) {
        $_SESSION["current_language"] = $language;

        echo "SUCCESS|language Information has been Updated.";
        exit();
    } else {
        echo "ERROR|Oops...Something went wrong.";
        exit();
    }
}
?>