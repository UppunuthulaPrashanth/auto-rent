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

//echo print_r($_POST);
//echo print_r("<pre>");
//echo print_r($_FILES);
//echo print_r("</pre>");

 //exit();
//die;

$licenseNumber         = filter_var($_POST['licenseNumber'],FILTER_SANITIZE_STRING);
$licensePlaceOfIssue   = filter_var($_POST['licensePlaceOfIssue'],FILTER_SANITIZE_STRING);
$licenseExpiry         = filter_var($_POST['licenseExpiry'],FILTER_SANITIZE_STRING);
$email                 = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

if( $_FILES['licenseAttachment']['error'] == 0)
{
    $file_formats = array("png", "jpg", "jpeg");
    $filename = $_FILES['licenseAttachment']['name']; // filename to get file's extension
    $size = $_FILES['licenseAttachment']['size'];
    $filePath = "uploads/documents/";


    //Check for file
    if (strlen($filename))
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
            echo "ERROR|Invalid file format! Accept only .png, .jpg. .jpeg format!!";
            exit();
        }
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if( $_FILES['licenseAttachment']['error'] == 0)
    {
        $result = $db->query("UPDATE users SET licenseNumber = ?s,licensePlaceOfIssue = ?s,licenseExpiry=?s,licenseAttachment=?s
WHERE emailID = ?s", $licenseNumber, $licensePlaceOfIssue, $licenseExpiry, $lfile, $email);

    }
    else
    {
        $result = $db->query("UPDATE users SET licenseNumber = ?s,licensePlaceOfIssue = ?s,licenseExpiry=?s
WHERE emailID = ?s", $licenseNumber, $licensePlaceOfIssue, $licenseExpiry, $email);
    }

//echo $db->lastQuery();
    if ($result) {
        echo "SUCCESS|License Information has been Updated.";
        exit();
    } else {
        echo "ERROR|Oops...Something went wrong.";
        exit();
    }
}
?>