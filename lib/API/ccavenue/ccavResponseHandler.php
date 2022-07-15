<?php include('Crypto.php')?>
<?php
include_once("../Infobip/infoBipSMS.php");
require '../../config/config.php';
require '../../config/autoload.php';
$tran = paymentdb::getInstance();
$online_gatway=$tran->fetch_gateways();	
	error_reporting(0);
	
	$workingKey=$online_gatway['secret_key'];		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	if($order_status==="Success")
	{
		echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		$bid = $_SESSION['bId'];
		$user = $_SESSION['uid'];
		$processor = "CCAvenue";
		$payment = paymentdb::getInstance();
		$payment->insert_transactions($user, $bid, $ItemPrice,$processor,'');
		$payment = bookingdb::getInstance();
		$status = 1;
		$payment->changeBookingStatus($bid, $status);

        $_SESSION['gateway']="CCAvenue";
        $transaction=$tran->fetch_transactionbybid($_SESSION['bId']);
        if($profile['cell'])
        {
            $findme   = '971';
            $pos = strpos($profile['cell'], $findme);
    
            if ($pos !== false) {
                $sms=new infoBipSMS('autorentme','autorent@sbc');
                $sms_body='Dear '.$profile['fname'].' '.$profile['lname'].',Thank you for choosing Autorent. Your booking Reference ID is : AR'.$_SESSION['bId'].'. For any queries, Please contact to (+971)600549993';
                $response=$sms->send_sms_infobip('+971600549993', $profile['cell'], $sms_body);
            }      
        }
        require '../PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';
        $payment_type='Amount Paid.';                    
        include '../../../include/booking_confirmationmail.php';
                                
        if($language==1)
        {
            header('Location:../../../confirm-booking.php');
            exit();
        }
        else
        {
            header('Location:../../../arabic/confirm-booking.php');
            exit();
        }
	}
	else if($order_status==="Aborted")
	{
        if($language==1)
        {
            header('Location:../../../booking_status.php?status=Aborted');
            exit();
        }
        else
        {
            header('Location:../../../arabic/booking_status.php?status=Aborted');
            exit();
        }	
	}
	else if($order_status==="Failure")
	{
	   if($language==1)
        {
            header('Location:../../../booking_status.php?status=Failure');
            exit();
        }
        else
        {
            header('Location:../../../arabic/booking_status.php?status=Failure');
            exit();
        }
	}
	else
	{
	   if($language==1)
        {
            header('Location:../../../booking_status?status=Security_Error');
            exit();
        }
        else
        {
            header('Location:../../../arabic/booking_status?status=Security_Error');
            exit();
        }	
	}

	/*echo "<br><br>";

	echo "<table cellspacing=4 cellpadding=4>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<tr><td>'.$information[0].'</td><td>'.urldecode($information[1]).'</td></tr>';
	}

	echo "</table><br>";
	echo "</center>";*/
?>
