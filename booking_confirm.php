<?php
include "inc_opendb.php";
include( 'Crypto.php' );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';
$debug = 'false';
//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );



//echo "<br>";
//echo "<br>";
//echo "<br>";
//
//echo "<pre>";
//
//print_r($_SESSION);
//echo "</pre>";
$PAGEID = "Booking Confirmation";
$paymentMode = 'offline';
if ( isset( $_GET["booking_number"] ) ) {
	$bookingNumber = filter_var( $_GET['booking_number'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["encResp"] ) ) {
	$paymentMode = 'online';
	$workingKey    = PG_WORKINGKEY;
	$encResponse   = $_POST["encResp"];
	$rcvdString    = decrypt( $encResponse, $workingKey );
	$order_status  = "";
	$decryptValues = explode( '&', $rcvdString );
	$dataSize      = sizeof( $decryptValues );
//	echo "<table cellspacing=4 cellpadding=4>";
	for ( $i = 0; $i < $dataSize; $i ++ ) {
		$information = explode( '=', $decryptValues[ $i ] );
//		echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
	}
//    	echo "</table><br>";


//	echo "<pre>";
//print_r($rcvdString);
//	echo "</pre>";
//	exit();
//

	/*
		 *
		 *
	0 order_id	085067
	1 tracking_id	110017074139
	2 bank_ref_no	344282
	3order_status	Success
	4failure_message
	5payment_mode	Credit Card
	6card_name	MasterCard
	7status_code	00
	8status_message	Approved
	9currency	AED
	10amount	430.5
	11billing_name	Mohamed Arafat
	12billing_address	1st, Main Road
	13billing_city	thanjavur
	14billing_state	Tamilnadu
	15billing_zip	613001
	16billing_country	Angola
	17billing_tel	9988776655
	18billing_email	arafat@gravityalpha.com
	delivery_name
	delivery_address
	delivery_city
	delivery_state
	delivery_zip
	delivery_country
	delivery_tel
	merchant_param1
	merchant_param2
	merchant_param3
	merchant_param4
	merchant_param5
	vault	N
	offer_type	null
	offer_code	null
	discount_value	0.0
	mer_amount	430.5
	eci_value	05
	card_holder_name
	bank_qsi_no	30000043513
	bank_receipt_no	103720344282
	merchant_param6	5204740014
		 */
	$bookingNumber = explode( '=', $decryptValues[0] )[1];
	$orderID       = explode( '=', $decryptValues[0] )[1];
	$tracking_id     = explode( '=', $decryptValues[1] )[1];
	$bank_ref_no     = explode( '=', $decryptValues[2] )[1];
	$order_status    = explode( '=', $decryptValues[3] )[1];
	$failure_message = explode( '=', $decryptValues[4] )[1];
	$paymentMode     = explode( '=', $decryptValues[5] )[1];
	$card_name       = explode( '=', $decryptValues[6] )[1];
	$status_code     = explode( '=', $decryptValues[7] )[1];
	$status_message  = explode( '=', $decryptValues[8] )[1];
	$currency        = explode( '=', $decryptValues[9] )[1];
	$amount          = explode( '=', $decryptValues[10] )[1];
	$billing_name    = explode( '=', $decryptValues[11] )[1];
	$billing_address = explode( '=', $decryptValues[12] )[1];
	$billing_city    = explode( '=', $decryptValues[13] )[1];
	$billing_state   = explode( '=', $decryptValues[14] )[1];
	$billing_zip     = explode( '=', $decryptValues[15] )[1];
	$billing_country = explode( '=', $decryptValues[16] )[1];
	$billing_tel     = explode( '=', $decryptValues[17] )[1];
	$billing_email   = explode( '=', $decryptValues[18] )[1];
	$delivery_name    = explode( '=', $decryptValues[19] )[1];
	$delivery_address = explode( '=', $decryptValues[20] )[1];
	$delivery_city    = explode( '=', $decryptValues[21] )[1];
	$delivery_state   = explode( '=', $decryptValues[22] )[1];
	$delivery_zip     = explode( '=', $decryptValues[23] )[1];
	$delivery_country = explode( '=', $decryptValues[24] )[1];
	$delivery_tel     = explode( '=', $decryptValues[25] )[1];
	$merchant_param1  = explode( '=', $decryptValues[26] )[1];
	$merchant_param2  = explode( '=', $decryptValues[27] )[1];
	$merchant_param3  = explode( '=', $decryptValues[28] )[1];
	$merchant_param4  = explode( '=', $decryptValues[29] )[1];
	$merchant_param5  = explode( '=', $decryptValues[30] )[1];
	$vault            = explode( '=', $decryptValues[31] )[1];
	$offer_type       = explode( '=', $decryptValues[32] )[1];
	$offer_code       = explode( '=', $decryptValues[33] )[1];
	$discount_value   = explode( '=', $decryptValues[34] )[1];
	$mer_amount       = explode( '=', $decryptValues[35] )[1];
	$eci_value        = explode( '=', $decryptValues[36] )[1];
	$card_holder_name = explode( '=', $decryptValues[37] )[1];
	$bank_qsi_no      = explode( '=', $decryptValues[38] )[1];
	$bank_receipt_no  = explode( '=', $decryptValues[39] )[1];
	$merchant_param6  = explode( '=', $decryptValues[40] )[1];
	$bookingModule = 'RENT';

    $bookingModuleEmail = 'RENTAL';

	//	echo "tracking_id Number: " . $bookingNumber;
	/*
	 *





	 * */

//    echo "<pre>";
//    print_r($_POST);
//    echo "</pre>";
//    exit();


    $res    = $db->query( "SELECT userID FROM inb_bookings WHERE bookingNumber = ?s", $bookingNumber );
	$row    = mysqli_fetch_assoc( $res );
	$userID = $row['userID'];
//    echo "First Query";
	$res = $db->query( "SELECT * FROM users WHERE userID = ?s", $userID );
	if ( mysqli_num_rows( $res ) > 0 ) {
		while ( $row = mysqli_fetch_assoc( $res ) ) {
			$_SESSION[ USERID ]     = $row['userID'];
			$_SESSION[ USER_EMAIL ] = $row['emailID'];
			$_SESSION[ FIRSTNAME ]  = $row['firstName'];
			$_SESSION[ LASTNAME ]   = $row['lastName'];
			$_SESSION[ LOGGED_IN ]  = true;

			$_SESSION["current_currency"] = $row['currentCurrency'];
			$_SESSION["current_language"] = $row['currentLanguage'];

			$name        = $row['firstName'] . ' ' . $row['lastName'];
			$address     = $row['address'];
			$country = getCountryFromID( $row['country'] );
			$mobile      = $row['mobileNo'];
			$visa        = $row['visaStatus'];
		}
	}
//    echo "Third Query \n";
//	echo "User Id" .' '. $row['userID'];
//	echo "Session User Id" .' '. $_SESSION[USERID];
	$result = $db->query( "INSERT INTO pg_transactions (userID, bookingNumber, bookingModule, order_id, tracking_id, bank_ref_no, order_status, failure_message,
                            payment_mode, card_name, status_code, status_message, currency, amount, billing_name, billing_address, billing_city, billing_state,
                            billing_zip, billing_country, billing_tel, billing_email, delivery_name, delivery_address, delivery_city, delivery_state, delivery_zip,
                            delivery_country, delivery_tel, merchant_param1, merchant_param2, merchant_param3, merchant_param4, merchant_param5, vault, offer_type,
                            offer_code, discount_value, mer_amount, eci_value, card_holder_name, bank_qsi_no, bank_receipt_no, merchant_param6)
                                VALUES(?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,
                                       ?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,
                                       ?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,
                                       ?s,?s,?s,?s,?s,?s,?s,?s,?s,?s,
                                       ?s,?s,?s,?s)", $_SESSION[ USERID ], $bookingNumber, $bookingModule, $orderID, $tracking_id, $bank_ref_no, $order_status, $failure_message, $paymentMode, $card_name, $status_code, $status_message, $currency, $amount, $billing_name, $billing_address, $billing_city, $billing_state, $billing_zip, $billing_country, $billing_tel, $billing_email, $delivery_name, $delivery_address, $delivery_city, $delivery_state, $delivery_zip, $delivery_country, $delivery_tel, $merchant_param1, $merchant_param2, $merchant_param3, $merchant_param4, $merchant_param5, $vault, $offer_type, $offer_code, $discount_value, $mer_amount, $eci_value, $card_holder_name, $bank_qsi_no, $bank_receipt_no, $merchant_param6 );
}
$bookingResult = $db->query( "SELECT * FROM inb_bookings WHERE bookingNumber = ?s", $bookingNumber );
$bookingRow    = mysqli_fetch_assoc( $bookingResult );
$rentLeaseCarID   = $bookingRow['rentLeaseCarID'];
$pickupLocation   = getPickupLocationFromID( $bookingRow['pickUpLocation'] );
$dropLocation     = getPickupLocationFromID( $bookingRow['dropLocation'] );
$pickUpDate       = $bookingRow['pickUpDate'];
$dropDate         = $bookingRow['dropDate'];
$noOfDays         = $bookingRow['noOfDays'];
$rentalAmount     = $bookingRow['rentalAmount'];
$totalAmount      = $bookingRow['totalAmount'];
$vat              = $bookingRow['vat'];
$orangeCard       = $bookingRow['orangeCard'];
$gps              = $bookingRow['gps'];
$deliveryCharge   = $bookingRow['deliveryCharge'];
$collectionCharge = $bookingRow['collectionCharge'];
$grandTotal       = $bookingRow['grandTotal'];

$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE rentLeaseCarID = ?i ", $rentLeaseCarID );
$rentCarRow    = mysqli_fetch_assoc( $rentCarResult );


//email template
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


//if($orangeCard != '')
//{
//    $orangeCard = $orangeCard;
//}


if($orangeCard == '')
{
    $orangeCard = '-';
}

if($gps == '')
{
    $gps = '-';
}

if($deliveryCharge == '')
{
    $deliveryCharge = '-';
}

if($collectionCharge == '')
{
    $collectionCharge = '-';
}


$amount_table = '<table width="100%" border="0" align="center" >
  <tbody>
    <tr style="background: #CCCCCC">
      <th width="40%" valign="middle" scope="col"><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"><strong>Charges</strong></p></th>
  
      <th width="20%" scope="col"><p style="text-align: left; font-size: 14px; color: #3f4345; font-weight: normal"><strong>Without VAT </strong> </p></th>
		 <th width="20%" scope="col"><p style="text-align: left; font-size: 14px; color: #3f4345; font-weight: normal"> <strong> VAT </strong></p></th>
		 <th width="20%" scope="col"><p style="text-align: left; font-size: 14px; color: #3f4345; font-weight: normal"><strong>Total </strong> </p></th>
    </tr>
    <tr style="background: #f2f2f2">
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"><strong>Rental Charges</strong></p></td>
     
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$rentalAmount.'</p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"> - </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$rentalAmount.' </p></td>
    </tr>
	   
	 
	   
	   <tr style="background: #f2f2f2">
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">Orange Card</p></td>
     
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$orangeCard.' </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"> - </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$orangeCard.' </p></td>
    </tr>
    
    
      <tr style="background: #f2f2f2">
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">GPS</p></td>
     
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$gps.' </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"> - </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$gps.' </p></td>
    </tr>
    
    
      <tr style="background: #f2f2f2">
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">Delivery Charges</p></td>
     
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$deliveryCharge .' </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"> - </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$deliveryCharge .' </p></td>
    </tr>
    
    
      <tr style="background: #f2f2f2">
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">Collection Charges</p></td>
     
      <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$collectionCharge .' </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"> - </p></td>
		 <td><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal">'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$collectionCharge .'</p></td>
    </tr>
    
    
	 <tr style="background: #CCCCCC">
      <th width="40%" valign="middle" scope="col"><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"><strong>Grand Total</strong></p></th>
  
      <th width="20%" scope="col"><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"><strong>'.$_SESSION[ CURRENT_CURRENCY ] . ' '.$totalAmount .'</strong> </p></th>
		 <th width="20%" scope="col"><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"> <strong> '.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$vat .'</strong></p></th>
		 <th width="20%" scope="col"><p style="text-align: left; font-size: 13px; color: #3f4345; font-weight: normal"><strong>'.$_SESSION[ CURRENT_CURRENCY ] . ' ' .$grandTotal .'</strong> </p></th>
    </tr>
  </tbody>
</table>';
if ( $order_status == 'Success' ) {
	$message = file_get_contents( 'emailTemplates/booking-rental-success.html', true );
	$message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );
	$message = str_replace( "{BOOKING-TYPE}", $bookingModuleEmail, $message );
	$message = str_replace( "{BOOKING-ID}", $bookingNumber, $message );
	$message = str_replace( "{VEHICLE-NAME}", $rentCarRow['carTitle'], $message );
	$message = str_replace( "{RENTAL-DURATION}", $noOfDays, $message );
	$message = str_replace( "{TOTAL-AMOUNT}", $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal ), $message );
	$message = str_replace( "{PICKUP-LOCATION}", $pickupLocation, $message );
	$message = str_replace( "{PICKUP-DATE-TIME}", $pickUpDate, $message );
	$message = str_replace( "{DROP-LOCATION}", $dropLocation, $message );
	$message = str_replace( "{DROP-DATE-TIME}", $dropDate, $message );
	$message = str_replace( "{NAME}", $name, $message );
	$message = str_replace( "{ADDRESS}", $address, $message );
	$message = str_replace( "{COUNTRY}", $country, $message );
	$message = str_replace( "{MOBILE}", $mobile, $message );
	$message = str_replace( "{VISA-STATUS}", $visa, $message );
	$message = str_replace( "{AMOUNT-TABLE}", $amount_table, $message );


} elseif ( $order_status == 'Failure' ) {
	$message = file_get_contents( 'emailTemplates/booking-rental-failure.html', true );
	$message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );
    $message = str_replace( "{BOOKING-TYPE}", $bookingModuleEmail, $message );
    $message = str_replace( "{BOOKING-ID}", $bookingNumber, $message );
    $message = str_replace( "{VEHICLE-NAME}", $rentCarRow['carTitle'], $message );
    $message = str_replace( "{RENTAL-DURATION}", $noOfDays, $message );
    $message = str_replace( "{TOTAL-AMOUNT}", $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal ), $message );
    $message = str_replace( "{PICKUP-LOCATION}", $pickupLocation, $message );
    $message = str_replace( "{PICKUP-DATE-TIME}", $pickUpDate, $message );
    $message = str_replace( "{DROP-LOCATION}", $dropLocation, $message );
    $message = str_replace( "{DROP-DATE-TIME}", $dropDate, $message );
    $message = str_replace( "{NAME}", $name, $message );
    $message = str_replace( "{ADDRESS}", $address, $message );
    $message = str_replace( "{COUNTRY}", $country, $message );
    $message = str_replace( "{MOBILE}", $mobile, $message );
    $message = str_replace( "{VISA-STATUS}", $visa, $message );
    $message = str_replace( "{AMOUNT-TABLE}", $amount_table, $message );


} elseif ( $order_status == 'initiated' ) {
	$message = file_get_contents( 'emailTemplates/booking-rental-failure.html', true );
	$message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );
    $message = str_replace( "{BOOKING-TYPE}", $bookingModuleEmail, $message );
    $message = str_replace( "{BOOKING-ID}", $bookingNumber, $message );
    $message = str_replace( "{VEHICLE-NAME}", $rentCarRow['carTitle'], $message );
    $message = str_replace( "{RENTAL-DURATION}", $noOfDays, $message );
    $message = str_replace( "{TOTAL-AMOUNT}", $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal ), $message );
    $message = str_replace( "{PICKUP-LOCATION}", $pickupLocation, $message );
    $message = str_replace( "{PICKUP-DATE-TIME}", $pickUpDate, $message );
    $message = str_replace( "{DROP-LOCATION}", $dropLocation, $message );
    $message = str_replace( "{DROP-DATE-TIME}", $dropDate, $message );
    $message = str_replace( "{NAME}", $name, $message );
    $message = str_replace( "{ADDRESS}", $address, $message );
    $message = str_replace( "{COUNTRY}", $country, $message );
    $message = str_replace( "{MOBILE}", $mobile, $message );
    $message = str_replace( "{VISA-STATUS}", $visa, $message );
    $message = str_replace( "{AMOUNT-TABLE}", $amount_table, $message );


} else {
	$message = file_get_contents( 'emailTemplates/booking-rental-failure.html', true );
	$message = str_replace( "{TOP-LOGO}", $emailTopLogo, $message );
    $message = str_replace( "{BOOKING-TYPE}", $bookingModuleEmail, $message );
    $message = str_replace( "{BOOKING-ID}", $bookingNumber, $message );
    $message = str_replace( "{VEHICLE-NAME}", $rentCarRow['carTitle'], $message );
    $message = str_replace( "{RENTAL-DURATION}", $noOfDays, $message );
    $message = str_replace( "{TOTAL-AMOUNT}", $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal ), $message );
    $message = str_replace( "{PICKUP-LOCATION}", $pickupLocation, $message );
    $message = str_replace( "{PICKUP-DATE-TIME}", $pickUpDate, $message );
    $message = str_replace( "{DROP-LOCATION}", $dropLocation, $message );
    $message = str_replace( "{DROP-DATE-TIME}", $dropDate, $message );
    $message = str_replace( "{NAME}", $name, $message );
    $message = str_replace( "{ADDRESS}", $address, $message );
    $message = str_replace( "{COUNTRY}", $country, $message );
    $message = str_replace( "{MOBILE}", $mobile, $message );
    $message = str_replace( "{VISA-STATUS}", $visa, $message );
    $message = str_replace( "{AMOUNT-TABLE}", $amount_table, $message );

}


$client_email = $_SESSION[ USER_EMAIL ];
//        $client_email = $userEmail;
$internal_subject  = $row["int_notificationSubject"];
//$internal_message  = $row["int_notificationMessage"];
$internal_message  = $message;
$resultPageMessage = $row["resultPageMessage"];
//        if ($debug) echo "Client Sub: " . $sql;
//        $name = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
//        $pickupLocation = getPickupLocationFromID(filter_var($_POST['pickupLocation2'], FILTER_SANITIZE_STRING));
//        $dropLocation = getPickupLocationFromID(filter_var($_POST['dropLocation2'], FILTER_SANITIZE_STRING));
//        $formData = "Booking Number: " . $bookingNumber . "<br/>" .
//            "Name: " . $name . "<br/>" .
//            "Email: " . $userEmail . "<br/>" .
//            "Car Name: " . $carTitle . "<br/>" .
//            "Pickup Location: " . $pickupLocation . "<br/>" .
//            "Drop Location: " . $dropLocation . "<br/>" .
//            "Pickup Date: " . $pickupDate . "<br/>" .
//            "Drop Date: " . $dropDate . "<br/>" .
//            "Booking Term: " . filter_var($_POST['bookingTerm'], FILTER_SANITIZE_STRING) . "<br/>" .
//            "Grand Total: " . filter_var($_POST['grandTotal'], FILTER_SANITIZE_STRING) . "<br/>";
//        $recipientFormData = "Booking Number: " . $bookingNumber . "<br/>" .
//            "Name: " . $name . "<br/>" .
//            "Email: " . $userEmail . "<br/>" .
//            "Car Name: " . $carTitle . "<br/>" .
//            "Pickup Location: " . $pickupLocation . "<br/>" .
//            "Drop Location: " . $dropLocation . "<br/>" .
//            "Pickup Date: " . $pickupDate . "<br/>" .
//            "Drop Date: " . $dropDate . "<br/>" .
//            "Booking Term: " . filter_var($_POST['bookingTerm'], FILTER_SANITIZE_STRING) . "<br/>" .
//            "Grand Total: " . filter_var($_POST['grandTotal'], FILTER_SANITIZE_STRING) . "<br/><br/><br/><br/><br/><br/>" .
//            "<img src='$FULL_HOST_NAME/uploads/pages/logo-web.png'> <br/>" .
//            "For more details, please call - 600549993 <br/>";
//    $client_message = $client_message . "<br/> <br/>" . $recipientFormData;
$client_message = $message;
//        $internal_message = $internal_message . "<br/> <br/>" . $message;
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
	}
}
//email template
//echo "<pre>";
//echo print_r( $_GET );
//echo "</pre>";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php'; ?>
<div class="theme-hero-area">
	<div class="theme-hero-area-bg-wrap">
		<div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light"
		     style="background-image:url(img/patterns/travel-1.png);"></div>
		<div class="theme-hero-area-grad-mask"></div>
	</div>
	<div class="theme-hero-area-body">
		<div class="container">
			<div class="row _pv-30">
				<div class="col-md-9 ">
					<div class="_mob-h">
						<div class="theme-hero-text theme-hero-text-white">
							<div class="breadcrumb-margins">
								<h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Booking Confirmation</h2>
							</div>
						</div>
					</div>
					<!--					<div class="theme-search-area-inline _desk-h theme-search-area-inline-white">-->
					<!--						<h4 class="theme-search-area-inline-title">Dubai </h4>-->
					<!--						<p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>-->
					<!--						<a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal"> <i class="fa fa-pencil"></i>Modify </a>-->
					<!--						<div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">-->
					<!--							<div class="theme-search-area theme-search-area-vert">-->
					<!--								<div class="theme-search-area-header">-->
					<!--									<h1 class="theme-search-area-title theme-search-area-title-sm">Modify</h1>-->
					<!--									<p class="theme-search-area-subtitle">Prices might be different from current results</p>-->
					<!--								</div>-->
					<!--								<div class="theme-search-area-form">-->
					<!--									<div>-->
					<!--										<label class="theme-search-area-section-label">Pick Up Information</label>-->
					<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
					<!---->
					<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
					<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->
					<!--													<option>City</option>-->
					<!--													<option>Abu-Dhabi</option>-->
					<!---->
					<!---->
					<!--													<option>Dubai</option>-->
					<!--													<option>Ras Al Khaimah</option>-->
					<!--													<option>Sharjah</option>-->
					<!---->
					<!--												</select>-->
					<!--											</div>-->
					<!--										</div>-->
					<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
					<!---->
					<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
					<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->
					<!--													<option>Location</option>-->
					<!--													<option>Oud Metha</option>-->
					<!--													<option>Al Mamzar</option>-->
					<!--													<option>Al Qouz</option>-->
					<!---->
					<!--												</select>-->
					<!--											</div>-->
					<!--										</div>-->
					<!---->
					<!---->
					<!--										<div class="theme-search-area-section theme-search-area-section-curved">-->
					<!---->
					<!--											<div class="theme-search-area-section-inner">-->
					<!--												<i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Date & Time"/> <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>-->
					<!--											</div>-->
					<!--										</div>-->
					<!---->
					<!---->
					<!--									</div>-->
					<!--									<div>-->
					<!--										<label class="theme-search-area-section-label">Drop Off Information</label>-->
					<!--										<div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
					<!--											<label class="icheck-label"> <input class="icheck" type="checkbox"/> <span class="icheck-title">Return Car to different location</span> </label>-->
					<!---->
					<!--										</div>-->
					<!--										<br>-->
					<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
					<!---->
					<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
					<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->
					<!--													<option>City</option>-->
					<!--													<option>Abu-Dhabi</option>-->
					<!---->
					<!---->
					<!--													<option>Dubai</option>-->
					<!--													<option>Ras Al Khaimah</option>-->
					<!--													<option>Sharjah</option>-->
					<!---->
					<!--												</select>-->
					<!--											</div>-->
					<!--										</div>-->
					<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
					<!---->
					<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
					<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->
					<!--													<option>Location</option>-->
					<!--													<option>Oud Metha</option>-->
					<!--													<option>Al Mamzar</option>-->
					<!--													<option>Al Qouz</option>-->
					<!---->
					<!--												</select>-->
					<!--											</div>-->
					<!--										</div>-->
					<!---->
					<!---->
					<!--										<div class="theme-search-area-section theme-search-area-section-curved">-->
					<!---->
					<!--											<div class="theme-search-area-section-inner">-->
					<!--												<i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Date & Time"/> <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>-->
					<!--											</div>-->
					<!--										</div>-->
					<!---->
					<!---->
					<!--									</div>-->
					<!--									<button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>-->
					<!--								</div>-->
					<!--							</div>-->
					<!--						</div>-->
					<!--					</div>-->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="theme-page-section theme-page-section-lg">
	<div class="container">
		<div class="row row-col-static row-col-mob-gap"
		     id="sticky-parent"
		     data-gutter="60">
			<div class="col-md-12 ">
				<div class="theme-payment-page-sections">
					<div class="row">
						<div class="col-md-12">
							<?php
							if ( $paymentMode == 'offline' ) {
								?>
								<p class="booking-txt"> Thank You. Your Booking has been created. </p>
								<?php
							} else {
								if ( $order_status == "Success" ) {
									?>
									<p class="booking-txt"> Thank You for your payment. We are processing your Order!</p>
									<?php
								} else {
									?>
									<p class="booking-txt"> Payment Failed. Please make your payment at the counter. <br> Your Booking has been created successfully. </p>
									<?php
								}
								?><?php
							}
							?>
							<p class="booking-txt"> Booking Ref: <?php echo $bookingNumber; ?></p>
							<h5>A confirmation email has been sent to the provided email address</h5>
						</div>
						<div class="col-md-6">
							<!--							<button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn txt-right"> Download Booking</button>-->
						</div>
					</div>
					<hr>
					<div class="theme-search-results-item theme-search-results-item-">
						<div class="theme-search-results-item-preview">
							<div class="row"
							     data-gutter="20">
								<div class="col-md-4 ">
									<div class="theme-search-results-item-img-wrap">
										<img class="theme-search-results-item-img"
										     src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>"
										     alt="<?php echo $rentCarRow['carTitle'] ?>"
										     title="<?php echo $rentCarRow['carTitle'] ?>"/>
									</div>
									<h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle'] ?></h5>
									<ul class="theme-search-results-item-car-feature-list">
										<li>
											<i class="fa fa-male"></i>
											<span><?php echo $rentCarRow['noOfSeats']; ?></span>
										</li>
										<li>
											<i class="fa fa-suitcase"></i>
											<span><?php echo $rentCarRow['luggage']; ?></span>
										</li>
										<li>
											<i class="fa fa-cog"></i>
											<span><?php echo getTransmissionFromID( $rentCarRow['transmissionID'] ); ?></span>
										</li>
										<?php if ( $rentCarRow['ac'] == 'Y' ) {
											?>
											<li>
												<i class="fa fa-bluetooth"></i>
												<span><?php echo "B/T"; ?></span>
											</li>
										<?php } ?>
										<li>
											<i class="fa fa-car"></i>
											<span><?php echo $rentCarRow['noOfDoors']; ?></span>
										</li>
									</ul>
								</div>
								<div class="col-md-8 ">
									<div class="theme-search-results-item-preview">
										<div class="row"
										     data-gutter="20">
											<div class="col-md-6 ">
												<h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Pickup</h5>
												<ul class="theme-search-results-item-car-list summary-txt">
													<li>
														<i class="fa fa-map-marker fa-lg loc-icons"></i> <?php echo $pickupLocation; ?>
													</li>
													<br>
													<li>
														<i class="fa fa-calendar fa-lg loc-icons"></i><?php echo date( 'F d, Y', strtotime( $pickUpDate ) ); ?>
													</li>
													<br>
													<li>
														<i class="fa fa-clock-o fa-lg loc-icons"></i> <?php echo date( "H:i", strtotime( $pickUpDate ) ); ?>
													</li>
													<br>
												</ul>
											</div>
											<div class="col-md-6 ">
												<h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Dropoff</h5>
												<ul class="theme-search-results-item-car-list summary-txt">
													<li>
														<i class="fa fa-map-marker fa-lg loc-icons"></i> <?php echo $dropLocation; ?>
													</li>
													<br>
													<li>
														<i class="fa fa-calendar fa-lg loc-icons"></i><?php echo date( 'F d, Y', strtotime( $dropDate ) ); ?>
													</li>
													<br>
													<li>
														<i class="fa fa-clock-o fa-lg loc-icons"></i> <?php echo date( "H:i", strtotime( $dropDate ) );; ?>
													</li>
													<br>
												</ul>
											</div>
										</div>
										<h5>Rental Length: <?php echo $noOfDays; ?> day(s)</h5>
									</div>
									<!--									<table class="table">-->
									<!--										<tr class="checkout-table">-->
									<!--											<th>Item</th>-->
									<!--											<th></th>-->
									<!--											<th class="table-content-right">Price</th>-->
									<!--										</tr>-->
									<!--										<tr>-->
									<!--											<td>Rental charge</td>-->
									<!--											<td></td>-->
									<!--											<td class="table-content-right">--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $rentalAmount, 2 ); ?><!--</td>-->
									<!--										</tr>-->
									<!---->
									<!--										--><?php
									//										if ( isset( $orangeCard ) )
									//										{
									//											?>
									<!--											<tr>-->
									<!--												<td>Orange Card</td>-->
									<!--												<td></td>-->
									<!--												<td class="table-content-right">--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $orangeCard, 2 ); ?><!--</td>-->
									<!--											</tr>-->
									<!--											--><?php
									//										}
									//										?>
									<!--										--><?php
									//										if ( isset( $gps ) )
									//										{
									//											?>
									<!--											<tr>-->
									<!--												<td>GPS</td>-->
									<!--												<td></td>-->
									<!--												<td class="table-content-right">--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $gps, 2 ); ?><!--</td>-->
									<!--											</tr>-->
									<!--											--><?php
									//										}
									//										?>
									<!--										--><?php
									//										if ( isset( $deliveryCharge ) )
									//										{
									//											?>
									<!--											<tr>-->
									<!--												<td>Delivery</td>-->
									<!--												<td></td>-->
									<!--												<td class="table-content-right">--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $deliveryCharge, 2 ); ?><!--</td>-->
									<!--											</tr>-->
									<!--											--><?php
									//										}
									//										?>
									<!--										--><?php
									//										if ( isset( $collectionCharge ) )
									//										{
									//											?>
									<!--											<tr>-->
									<!--												<td>Collection</td>-->
									<!--												<td></td>-->
									<!--												<td class="table-content-right">--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $collectionCharge, 2 ); ?><!--</td>-->
									<!--											</tr>-->
									<!--											--><?php
									//										}
									//										?>
									<!---->
									<!--										<tr class="checkout-table-2">-->
									<!--											<td><strong>Total (Without Vat)</strong></td>-->
									<!--											<td></td>-->
									<!--											<td class="table-content-right"><strong>--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $totalAmount, 2 ); ?><!--</strong></td>-->
									<!---->
									<!--										</tr>-->
									<!---->
									<!--										<tr class="checkout-table-2">-->
									<!--											<td><strong>VAT</strong></td>-->
									<!--											<td>5%</td>-->
									<!--											<td class="table-content-right"><strong>--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $vat, 2 ); ?><!--</strong></td>-->
									<!---->
									<!--										</tr>-->
									<!---->
									<!---->
									<!--										<tr class="checkout-table-2">-->
									<!--											<td><strong>Grand Total (With Vat)</strong></td>-->
									<!--											<td></td>-->
									<!--											--><?php
									//
									//											?>
									<!--											<td class="table-content-right"><strong>--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal, 2 ); ?><!--</strong></td>-->
									<!---->
									<!--										</tr>-->
									<!--									</table>-->
									<div class="enhance-experience-div">
										<div class="theme-account-notifications-item">
											<div class="row">
												<div class="col-sm-9">
													<label class="icheck-label book-rental-icon">
														<span class="icheck-title rental-addons-title"> <strong>Item</strong></span>
													</label>
												</div>
												<div class="col-md-3">
													<div class="row">
														<div class="col-md-11">

													<span class="icheck-title">

														<strong>Price</strong>
													</span>
														</div>
														<div class="col-md-1"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="theme-account-notifications-item">
											<div class="row">
												<div class="col-sm-9">
													<label class="icheck-label book-rental-icon"> <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-credit-card"></i>
														<span class="icheck-title rental-addons-title"> Rental Charge</span>
													</label>
												</div>
												<div class="col-md-3">
													<div class="row">
														<div class="col-md-11">

													<span class="icheck-title">

														<?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (int) $rentalAmount ); ?>
													</span>
														</div>
														<div class="col-md-1"></div>
													</div>
												</div>
											</div>
										</div>
										<?php
										if ( isset( $orangeCard ) ) {
											?>
											<div class="theme-account-notifications-item">
												<div class="row">
													<div class="col-sm-9">
														<label class="icheck-label book-rental-icon"> <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-credit-card"></i>
															<span class="icheck-title rental-addons-title"> Orange Card</span>
														</label>
													</div>
													<div class="col-md-3">
														<div class="row">
															<div class="col-md-11">

													<span class="icheck-title">

														<?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (int) $orangeCard ); ?>
													</span>
															</div>
															<div class="col-md-1"></div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>

										<?php
										if ( isset( $gps ) ) {
											?>
											<div class="theme-account-notifications-item">
												<div class="row">
													<div class="col-sm-9">
														<label class="icheck-label book-rental-icon"> <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-map-marker"></i>
															<span class="icheck-title rental-addons-title">GPS</span>
														</label>
													</div>
													<div class="col-md-3">
														<div class="row">
															<div class="col-md-11">

													<span class="icheck-title">

														<?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (int) $gps ); ?>
													</span>
															</div>
															<div class="col-md-1"></div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>

										<?php
										if ( isset( $deliveryCharge ) ) {
											?>
											<div class="theme-account-notifications-item">
												<div class="row">
													<div class="col-sm-9">
														<label class="icheck-label book-rental-icon"> <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-truck"></i>
															<span class="icheck-title rental-addons-title">Delivery Charges</span>
														</label>
													</div>
													<div class="col-md-3">
														<div class="row">
															<div class="col-md-11">

													<span class="icheck-title">

														<?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (int) $deliveryCharge ); ?>
													</span>
															</div>
															<div class="col-md-1"></div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>


										<?php
										if ( isset( $collectionCharge ) ) {
											?>
											<div class="theme-account-notifications-item">
												<div class="row">
													<div class="col-sm-9">
														<label class="icheck-label book-rental-icon"> <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-truck"></i>
															<span class="icheck-title rental-addons-title">Collection Charges</span>
														</label>
													</div>
													<div class="col-md-3">
														<div class="row">
															<div class="col-md-11">

													<span class="icheck-title">

														<?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (int) $collectionCharge ); ?>
													</span>
															</div>
															<div class="col-md-1"></div>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
										<div class="theme-account-notifications-item booking-white-bg">
											<div class="row">
												<div class="col-sm-9">
													<label class="icheck-label book-rental-icon">
														<span class="icheck-title rental-addons-title"><strong>Total (Without Vat)</strong></span>
													</label>
												</div>
												<div class="col-md-3">
													<div class="row">
														<div class="col-md-11">

													<span class="icheck-title">

														<strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' .(int)$totalAmount ; ?></strong>
													</span>
														</div>
														<div class="col-md-1"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="theme-account-notifications-item booking-white-bg">
											<div class="row">
												<div class="col-sm-6">
													<label class="icheck-label book-rental-icon">
														<span class="icheck-title rental-addons-title"><strong>VAT @5%</strong></span>
													</label>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">

													<span class="icheck-title">
														<!-- 5%-->
													</span>
														</div>
														<div class="col-md-6">
															<strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $vat ); ?></strong>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="theme-account-notifications-item booking-white-bg">
											<div class="row">
												<div class="col-sm-9">
													<label class="icheck-label book-rental-icon">
														<span class="icheck-title rental-addons-title"><strong>Grand Total (With Vat)</strong></span>
													</label>
												</div>
												<div class="col-md-3">
													<div class="row">
														<div class="col-md-11">

													<span class="icheck-title">

														<strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal ); ?></strong>
													</span>
														</div>
														<div class="col-md-1"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>
</body>
</html>