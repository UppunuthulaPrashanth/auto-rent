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

$passportnumber         = filter_var($_POST['passportnumber'],FILTER_SANITIZE_STRING);
$passportPlaceOfIssue   = filter_var($_POST['passportPlaceOfIssue'],FILTER_SANITIZE_STRING);
$passportExpiry         = filter_var($_POST['passportExpiry'],FILTER_SANITIZE_STRING);
$email                 = filter_var($_POST['email'],FILTER_SANITIZE_STRING);


if( $_FILES['passportAttachment']['error'] == 0)
{
    $file_formats = array("png", "jpg", "jpeg");
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
            echo "ERROR|Invalid file format! Accept only .png, .jpg. .jpeg format!!";
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if( $_FILES['passportAttachment']['error'] == 0)
    {

        $result = $db->query("UPDATE users SET passportNumber = ?s, passportPlaceOfIssue = ?s,passportExpiry=?s,passportAttachment=?s
WHERE emailID = ?s", $passportnumber, $passportPlaceOfIssue, $passportExpiry,  $pfile, $email);

    }
    else
    {
        $result = $db->query("UPDATE users SET passportNumber = ?s, passportPlaceOfIssue = ?s,passportExpiry=?s
WHERE emailID = ?s", $passportnumber, $passportPlaceOfIssue, $passportExpiry, $email);
    }


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