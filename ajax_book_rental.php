<?php
include "inc_opendb.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';
$debug = false;

//
//echo "<pre>";
//echo print_r( $_POST );
//echo "</pre>";
//exit();



//
//
//echo print_r($_SESSION);
//exit();
//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );
/*
    [carTitle] => Renault Symbol 1.6L
    [fullRentalPrice] => 140.00
    [totalcalculate1] => 180.00
    [pickupLocation2] => 1
    [dropLocation2] => 2
    [pickupDate2] => 01/06/2021 6:00 PM
    [dropDate2] => 01/07/2021 6:00 PM
    [slug2] => renault-symbol-1.6l
    [totalDays2] => 1
    [phase1OrangeCard] => 10.00
    [phase1GPS] => 10.00
    [phase1DeliveryCharges] => 10.00
    [phase1CollectionCharges] => 10.00
    [grandTotal] => 189
)
Array
(
    [current_geolocation] => AE
    [current_currency] => AED
    [current_language] => ar
    [vat] => 5
    [userid] => 3
    [user_email] => arafat@gravityalpha.com
    [firstName] => Mohamed
    [lastName] => Arafat
    [LOGGED_IN] => 1
 */
//
//<pre>Array
//(
//    [carTitle] => Nissan Sunny 1.5L
//[bookingTerm] => Daily
//[fullRentalPrice] => 155.00
//    [totalcalculate1] => 585.00
//    [pickupLocation2] => 6
//    [dropLocation2] => 6
//    [pickupDate2] => 01/27/2021 6:00 PM
//[dropDate2] => 01/28/2021 6:00 PM
//[slug2] => nissan-sunny-1.5l
//[totalDays2] => 1
//    [phase1OrangeCard] => 200.00
//    [phase1GPS] => 150.00
//    [phase1DeliveryCharges] => 40.00
//    [phase1CollectionCharges] => 40.00
//    [grandTotal] => 614.25
//    [vatAmount] => 29.25
//)
//1</pre>Array
//(
//    [current_geolocation] => AE
//    [current_currency] => AED
//[current_language] => en
//[vat] => 5
//    [user_email] => vasu@bluespot.in
//[firstName] => Tester
//[lastName] => One
//[LOGGED_IN] => 1
//)
//1

$carTitle = filter_var( $_POST['carTitle'], FILTER_SANITIZE_STRING );
$pickupDate = filter_var( $_POST['pickupDate2'], FILTER_SANITIZE_STRING );
$pickupDate = date( "Y-m-d H:i:s", strtotime( $pickupDate ) );
$dropDate = filter_var( $_POST['dropDate2'], FILTER_SANITIZE_STRING );
$dropDate = date( "Y-m-d H:i:s", strtotime( $dropDate ) );
$rentLeaseCarID = getRentLeaseCarIDFromSlug( filter_var( $_POST['slug2'], FILTER_SANITIZE_STRING ) );
$bookingNumber = generateBookingNumberForRentCars();
$paymentMethod = filter_var( $_POST['paymentMethod'], FILTER_SANITIZE_STRING );

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	if ( $paymentMethod == 'offline' ) {
		$res = $db->query( "INSERT INTO `inb_bookings` (`bookingNumber`, 
`pickUpLocation`,
 `dropLocation`,
  `pickUpDate`,
   `dropDate`,
    `noOfDays`, 
    `bookingTerm`,
     `gps`,
      `orangeCard`,
       `deliveryCharge`,
        `collectionCharge`,
         `rentalAmount`,
          `totalAmount`,
           `vat`,
            `grandTotal`,
             `userID`,
              `rentLeaseCarID`,
                            `paymentMethod`)
                VALUES (?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s);",
            $bookingNumber,
            filter_var( $_POST['pickupLocation2'], FILTER_SANITIZE_STRING ),
            filter_var( $_POST['dropLocation2'], FILTER_SANITIZE_STRING ),
            $pickupDate,
            $dropDate,
            filter_var( $_POST['totalDays2'], FILTER_SANITIZE_STRING ),
            filter_var( $_POST['bookingTerm'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1GPS'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1GPS'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1OrangeCard'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1OrangeCard'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1DeliveryCharges'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1DeliveryCharges'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1CollectionCharges'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1CollectionCharges'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['fullRentalPrice'], FILTER_SANITIZE_NUMBER_INT ) ) ? "0.00" : filter_var( $_POST['fullRentalPrice'], FILTER_SANITIZE_NUMBER_INT ),
            empty( filter_var( $_POST['totalcalculate1'], FILTER_SANITIZE_NUMBER_INT ) ) ? "0.00" : filter_var( $_POST['totalcalculate1'], FILTER_SANITIZE_NUMBER_INT ),
            filter_var( $_POST['vatAmount'], FILTER_SANITIZE_STRING ),
            filter_var( $_POST['grandTotal'], FILTER_SANITIZE_STRING ),
            $_SESSION[ USERID ],
            $rentLeaseCarID,
            $paymentMethod );


		$lastInsertID = $db->insertId();
		$res = $db->query( "select * from inb_bookings WHERE bookingID = ?s", $lastInsertID );
		$row           = mysqli_fetch_assoc( $res );
		$bookingNumber = $row['bookingNumber'];
		$userEmail     = $_SESSION['user_email'];
		$res = $db->query( "SELECT * FROM smtp_details WHERE active  = 1" );
		while ( $row = mysqli_fetch_assoc( $res ) ) {
			$SMTP_HOST       = $row['host'];
			$SMTP_USERNAME   = $row['username'];
			$SMTP_PASSWORD   = $row['password'];
			$SMTP_PORT       = $row['port'];
			$SMTP_SECURETYPE = $row['secured_type'];
		}
		$emailTopLogo = $FULL_HOST_NAME . "emailTemplates/autorent-logo.png";
		$notificationType = 11; // this is for Booking Form
		//Retrieve the Notification options
		$sql = $db->query( "SELECT * FROM notification_options WHERE id = ?i", $notificationType );
		$row = mysqli_fetch_assoc( $sql );
		$emailOutbound     = $row["emailOutbound"];
		$emailOutboundName = $row["emailOutboundName"];
		$client_subject    = $row["autorespondSubject"];
		$client_message    = $row["autorespondMessage"];
        if ($paymentMethod == 'offline') {

            $message = file_get_contents('emailTemplates/booking-rental-success.html', true);
            $message = str_replace("{TOP-LOGO}", $emailTopLogo, $message);


        }
        elseif ($order_status == 'Failure') {
            $message = file_get_contents('emailTemplates/booking-rental-failure.html', true);
            $message = str_replace("{TOP-LOGO}", $emailTopLogo, $message);

        } elseif ($order_status == 'initiated') {
            $message = file_get_contents('emailTemplates/booking-rental-success.html', true);
            $message = str_replace("{TOP-LOGO}", $emailTopLogo, $message);
        }
        else {
            $message = file_get_contents('emailTemplates/booking-rental-failure.html', true);
            $message = str_replace("{TOP-LOGO}", $emailTopLogo, $message);
        }
//    $client_email = $_SESSION[USER_EMAIL];
		$client_email      = $userEmail;
		$internal_subject  = $row["int_notificationSubject"];
		$internal_message  = $row["int_notificationMessage"];
		$resultPageMessage = $row["resultPageMessage"];
//        if ($debug) echo "Client Sub: " . $sql;
		$name           = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
		$pickupLocation = getPickupLocationFromID( filter_var( $_POST['pickupLocation2'], FILTER_SANITIZE_STRING ) );
		$dropLocation   = getPickupLocationFromID( filter_var( $_POST['dropLocation2'], FILTER_SANITIZE_STRING ) );
		$formData = "Booking Number: " . $bookingNumber . "<br/>" . "Name: " . $name . "<br/>" . "Email: " . $userEmail . "<br/>" . "Car Name: " . $carTitle . "<br/>" . "Pickup Location: " . $pickupLocation . "<br/>" . "Drop Location: " . $dropLocation . "<br/>" . "Pickup Date: " . $pickupDate . "<br/>" . "Drop Date: " . $dropDate . "<br/>" . "Booking Term: " . filter_var( $_POST['bookingTerm'], FILTER_SANITIZE_STRING ) . "<br/>" . "Grand Total: " . filter_var( $_POST['grandTotal'], FILTER_SANITIZE_STRING ) . "<br/>";
		$recipientFormData = "Booking Number: " . $bookingNumber . "<br/>" . "Name: " . $name . "<br/>" . "Email: " . $userEmail . "<br/>" . "Car Name: " . $carTitle . "<br/>" . "Pickup Location: " . $pickupLocation . "<br/>" . "Drop Location: " . $dropLocation . "<br/>" . "Pickup Date: " . $pickupDate . "<br/>" . "Drop Date: " . $dropDate . "<br/>" . "Booking Term: " . filter_var( $_POST['bookingTerm'], FILTER_SANITIZE_STRING ) . "<br/>" . "Grand Total: " . filter_var( $_POST['grandTotal'], FILTER_SANITIZE_STRING ) . "<br/><br/><br/><br/><br/><br/>" . "<img src='$FULL_HOST_NAME/uploads/pages/logo-web.png'> <br/>" . "For more details, please call - 600549993 <br/>";


//		$client_message = $client_message . "<br/> <br/>" . $recipientFormData;
        $client_message = $message;
//		$internal_message = $internal_message . "<br/> <br/>" . $recipientFormData;
		$internal_message = $message;


		//Send Emails
		//Send Client Auto Response
		$mail       = new PHPMailer();
		$mail->Host = $SMTP_HOST;
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->isHTML( true );
		$mail->Username   = $SMTP_USERNAME;
		$mail->Password   = $SMTP_PASSWORD;
		$mail->SMTPSecure = $SMTP_SECURETYPE;
		$mail->Port       = $SMTP_PORT;
		$mail->From     = $emailOutbound;
		$mail->FromName = $emailOutboundName;
		$mail->Subject  = $client_subject;
		$mail->WordWrap = 50; // some nice default value
		$mail->IsHTML( true );
		$mail->Body = $client_message;
		$mail->AddReplyTo( $emailOutbound );
		$mail->AddAddress( $client_email );
//        $mail->SMTPDebug = 2;
//        $debug = true;
		if ( ! $mail->Send() ) {
			if ( $debug ) {
				echo $mail->ErrorInfo;
			}
			if ( $debug ) {
				echo "EMAIL ERROR (email to Client)";
			}
		} else {
			if ( $debug ) {
				echo "EMAIL SENT SUCCESSFULLY (email to client)";
			}
		}
		//Send Internal Notifications
		$result = $db->query( "SELECT * FROM notification_recipients WHERE idNotificationType = ?i AND active = 1 AND sendEmail = 1", $notificationType );
		while ( $row = mysqli_fetch_assoc( $result ) ) {
			$mail       = new PHPMailer();
			$mail->Host = $SMTP_HOST;
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			$mail->isHTML( true );
			$mail->Username   = $SMTP_USERNAME;
			$mail->Password   = $SMTP_PASSWORD;
			$mail->SMTPSecure = $SMTP_SECURETYPE;
			$mail->Port       = $SMTP_PORT;
			$mail->From     = $emailOutbound;
			$mail->FromName = $emailOutboundName;
			$mail->Subject  = $internal_subject;
			$mail->WordWrap = 50; // some nice default value
			$mail->IsHTML( true );
			$mail->Body = $internal_message;
			$mail->AddReplyTo( $emailOutbound );
			$mail->AddAddress( $row["recipientEmail"] );
//            $mail->SMTPDebug = 2;
//            $debug = true;
			if ( ! $mail->Send() ) {
				if ( $debug ) {
					echo $mail->ErrorInfo;
				}
				if ( $debug ) {
					echo "EMAIL ERROR (email to internal)";
				}
			} else {
				if ( $debug ) {
					echo "EMAIL SENT SUCCESSFULLY (email to internal)";
				}
			}
		}
		echo "SUCCESS|" . "$bookingNumber";
	} else {

		$res = $db->query( "INSERT INTO `inb_bookings` (`bookingNumber`, 
`pickUpLocation`,
 `dropLocation`,
  `pickUpDate`,
   `dropDate`,
    `noOfDays`, 
    `bookingTerm`,
     `gps`,
      `orangeCard`,
       `deliveryCharge`,
        `collectionCharge`,
         `rentalAmount`,
          `totalAmount`,
           `vat`,
            `grandTotal`,
             `userID`,
              `rentLeaseCarID`,
                            `paymentMethod`)
                VALUES (?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,?s);",
            $bookingNumber,
            filter_var( $_POST['pickupLocation2'],
                FILTER_SANITIZE_STRING ),
            filter_var( $_POST['dropLocation2'], FILTER_SANITIZE_STRING ),
            $pickupDate,
            $dropDate,
            filter_var( $_POST['totalDays2'], FILTER_SANITIZE_STRING ),
            filter_var( $_POST['bookingTerm'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1GPS'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1GPS'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1OrangeCard'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1OrangeCard'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1DeliveryCharges'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1DeliveryCharges'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['phase1CollectionCharges'], FILTER_SANITIZE_STRING ) ) ? "0.00" : filter_var( $_POST['phase1CollectionCharges'], FILTER_SANITIZE_STRING ),
            empty( filter_var( $_POST['fullRentalPrice'], FILTER_SANITIZE_NUMBER_INT ) ) ? "0.00" : filter_var( $_POST['fullRentalPrice'], FILTER_SANITIZE_NUMBER_INT ),
            empty( filter_var( $_POST['totalcalculate1'], FILTER_SANITIZE_NUMBER_INT ) ) ? "0.00" : filter_var( $_POST['totalcalculate1'], FILTER_SANITIZE_NUMBER_INT ),
            filter_var( $_POST['vatAmount'], FILTER_SANITIZE_STRING ),
            filter_var( $_POST['grandTotal'], FILTER_SANITIZE_STRING ),
            $_SESSION[ USERID ],
            $rentLeaseCarID,
            $paymentMethod );
		echo "SUCCESS|" . "$bookingNumber";
	}
} else {
	$errors = $resp->getErrorCodes();
	echo "ERROR|" . "Something went wrong!";
	exit();
}
exit();