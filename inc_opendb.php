<?php

session_start();


error_reporting(E_ERROR | E_PARSE);
// error_reporting( E_ALL );
// ini_set( 'display_errors', 1 );



include_once "libs/safemysql-master/safemysql.class.php";

include_once("masterconfig.php");



require_once 'vendor/autoload.php';

use GeoIp2\Database\Reader;





$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbdatabase);

if (mysqli_connect_errno())

{

    echo("Database Connection Error");

    exit();

}



/*

1- UAE

2- US

3- OMAN

4- SAR

 */



$HOST_NAME      = $_SERVER['HTTP_HOST'];

$FULL_HOST_NAME = "https://" . $HOST_NAME . "/";





function getGeoLocation()

{

	try

	{

		$reader = new Reader( __DIR__ . '/maxmind/GeoLite2-Country.mmdb' );

		$record = $reader->country( $_SERVER['REMOTE_ADDR'] );



		$rLocation = $record->country->isoCode;

		if ( empty( $rLocation ) )

		{

			return 'AE';

		} else

		{

			return $rLocation;

		}

	}

	catch (Exception $e){

		return 'AE';

	}

}

define("VAT", "vat");

define("CURRENT_LANGUAGE", 'current_language');

define("CURRENT_CURRENCY", 'current_currency');

define("CURRENT_GEOLOCATION", 'current_geolocation');



define("AED", "AED");

define("SAR", "SAR");

define("OMR", "OMR");

define("USD", "USD");



define("EN", 'en');

define("AR", 'ar');





define("BOOKING_DAILY", "Daily");

define("BOOKING_WEEKLY", "Weekly");

define("BOOKING_MONTHLY", "Monthly");





define('LOGGED_IN', 'LOGGED_IN');

define('USER_EMAIL','user_email');

define('FIRSTNAME','firstName');

define('LASTNAME','lastName');

define('USERID','userid');



//Payment Gateway Credentials

define('PG_ACCESSCODE', "");
define('PG_WORKINGKEY', "");
define('PG_MERCHANTDATA', "");


 

//set the geo-location first

if(!isset($_SESSION[CURRENT_GEOLOCATION]))

{

	$_SESSION[CURRENT_GEOLOCATION] = getGeoLocation();





	if (

		$_SESSION[CURRENT_GEOLOCATION] != 'AE' ||

		$_SESSION[CURRENT_GEOLOCATION] != 'SA' ||

		$_SESSION[CURRENT_GEOLOCATION] != 'OM'	){

		$_SESSION[CURRENT_GEOLOCATION] = 'AE';

	}

}







//Set currency

if(!isset($_SESSION[CURRENT_CURRENCY]))

{

	switch ($_SESSION[CURRENT_GEOLOCATION])

	{

		case "OM":

			$_SESSION[CURRENT_CURRENCY] = OMR;

			break;



		case "SA":

			$_SESSION[CURRENT_CURRENCY] = SAR;

			break;



		default:

			$_SESSION[CURRENT_CURRENCY] = AED;

			break;

	}

}



//set the language

if(!isset($_SESSION[CURRENT_LANGUAGE]))

{

	$_SESSION[CURRENT_LANGUAGE] = EN;

}



if(!isset($_SESSION[VAT]))

{

    $_SESSION[VAT] = 5;

}



$dbInfo = array(

    'host'      => $dbhost,

    'user'      => $dbuser,

    'pass'      => $dbpass,

    'db'        => $dbdatabase,

    'port'      => NULL,

    'socket'    => NULL,

    'pconnect'  => FALSE,

    'charset'   => 'utf8',

    'errmode'   => 'error', //or exception

    'exception' => 'Exception', //Exception class name

);

$db = new SafeMySQL($dbInfo);


include "inc_generalFunctions.php";