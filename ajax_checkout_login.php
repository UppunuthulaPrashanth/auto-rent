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


if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $email    = filter_var( $_POST['email'], FILTER_SANITIZE_STRING );
    $password = filter_var( $_POST['password'], FILTER_SANITIZE_EMAIL );

    $res = $db->query( "SELECT * FROM users WHERE emailID = ?s and password= PASSWORD(?s)", $email, $password );

    if ( mysqli_num_rows( $res ) > 0 )
    {
        while ( $row = mysqli_fetch_assoc( $res ) )
        {
            $_SESSION[ USERID ] = $row['userID'];
            $_SESSION[ USER_EMAIL ] = $row['emailID'];
            $_SESSION[ FIRSTNAME ]  = $row['firstName'];
            $_SESSION[ LASTNAME ]   = $row['lastName'];
            $_SESSION[ LOGGED_IN ]  = true;


            $_SESSION["current_currency"] = $row['currentCurrency'];
            $_SESSION["current_language"] = $row['currentLanguage'];

            unset( $_SESSION["CURRENT_CURRENCY"] );
            unset( $_SESSION["CURRENT_LANGUAGE"] );
        }
        echo "SUCCESS";
        exit();
    } else
    {
        echo "ERROR|Check your username or password!";
        exit();
    }

}


exit();