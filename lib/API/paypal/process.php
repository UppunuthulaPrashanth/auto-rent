<?php
ob_start();
include_once("config.php");
include_once("paypal.class.php");
include_once("../Infobip/infoBipSMS.php");


require '../../config/config.php';
require '../../config/autoload.php';
error_reporting(E_All);
$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

$user = userdb::getInstance();
$part = partnerdb::getInstance();
$vehicle = vehical::getInstance();
$booking = bookingdb::getInstance();
$tran = paymentdb::getInstance();
$d = new dealdb;

if(isset($_SESSION['lang']) && $_SESSION['lang']=="ar")
{
    $language="2";
}
else
{
    $language="1";
}


if($_POST) //Post Data received from product list page.
{


	
	if (isset($_POST['tRent']) && $_POST['tRent'] != "") {

	$driver_val=$_POST['driver_val'];
	$gps_val=$_POST['gps_val'];
	$bs_val=$_POST['bs_val'];
	$cdw_val=$_POST['cdw_val'];
	$pai_val=$_POST['pai_val'];
	$hc_val=$_POST['hc_val'];
	$ic_val=$_POST['ic_val'];
	$oic_val=$_POST['oic_val'];
	$ekmc_val=$_POST['ekmc_val'];

	$per_day_cost=$_POST['per_day_cost'];
	$days=$_POST['days'];
    $coupon=$_POST['coupon'];

	$gateway=$_POST['gateway'];
    $currency=$_POST['currency'];

	//echo $_POST['tRent']."<br>";
	$rent=$_POST['tRent'];
	$result=explode(',', $rent);
	$status=4;

	$default=$result['0'];
	$doller_rent=$result['1'];
    
    $_SESSION['doller_rent'] = $doller_rent;
    $extra=0;



  $_SESSION['tr'] = $default;

  if (isset($_POST['driver'])) {
    $_SESSION['driver']= '1';
    $extra=1;
  }
  else
  {
    $_SESSION['driver']= '0';
  }

  if (isset($_POST['gps'])) {
    $_SESSION['gps']= '1';
    $extra=1;
  }
  else
  {
    $_SESSION['gps']= '0';
  }

  if (isset($_POST['bs'])) {
    $extra=1;
    $_SESSION['bs']= '1';
  }
  else
  {
    $_SESSION['bs']= '0';
  }

  if (isset($_POST['cdw'])) {
    $extra=1;
    $_SESSION['cdw']= '1';
  }
  else
  {
    $_SESSION['cdw']= '0';
  }

  if (isset($_POST['pai'])) {
    $extra=1;
    $_SESSION['pai']= '1';
  }
  else
  {
    $_SESSION['pai']= '0';
  }

  if (isset($_POST['hc'])) {
    $extra=1;
    $_SESSION['hc']= '1';
  }
  else
  {
    $_SESSION['hc']= '0';
  }


  if (isset($_POST['ic'])) {
    $extra=1;
    $_SESSION['ic']= '1';
  }
  else
  {
    $_SESSION['ic']= '0';
  }

  if (isset($_POST['oic'])) {
    $extra=1;
    $_SESSION['oic']= '1';
  }
  else
  {
    $_SESSION['oic']= '0';
  }

  if (isset($_POST['ekmc'])) {
    $extra=1;
    $_SESSION['ekmc']= '1';
  }
  else
  {
    $_SESSION['ekmc']= '0';
  }
}
if ($gateway=="0") {
	$status=5;
}

$deal_result = $d->getdealbycoupon($coupon,$_SESSION['pd'], $_SESSION['dd']);
if($deal_result)
{
    $deal=$deal_result['id'];
}
else
{
    $deal=0;
}

//Callculating Commision

$uid = $user->getUseerIDfromSession();
$profile = $user->fetch_profile($uid);
$commision=0;

   if ($profile['ref'] != "") {
    
       $partner = $part->fetchbyusername($profile['ref']);
       
       $sale_tariff_check = $vehicle->sale_tariff_check($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
       if ($sale_tariff_check>0) {   
           if ( $_SESSION['days']>29) {
                  $partner_vehical_tariff = $vehicle->partner_monthly_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
                  $vehical_tariff = $vehicle->sale_monthly_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
                  
                  
                  
                  $commision+=(($vehical_tariff['rent']/30)-($partner_vehical_tariff['rent']/30))*$_SESSION['days'];
    
                    if (isset($_POST['driver'])) {
                        $commision+=(($vehical_tariff['dc']/30)-($partner_vehical_tariff['dc']/30))*$_SESSION['days'];
                    }
                    
                      if (isset($_POST['gps'])) {                        
                        $commision+=(($vehical_tariff['gpsc']/30)-($partner_vehical_tariff['gpsc']/30))*$_SESSION['days'];
                      }                      
                    
                      if (isset($_POST['bs'])) {
                        $commision+=(($vehical_tariff['csc']/30)-($partner_vehical_tariff['csc']/30))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['cdw'])) {
                        $commision+=(($vehical_tariff['cdw']/30)-($partner_vehical_tariff['cdw']/30))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['pai'])) {
                        $commision+=(($vehical_tariff['pai']/30)-($partner_vehical_tariff['pai']/30))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['hc'])) {
                        $commision+=(($vehical_tariff['hc']/30)-($partner_vehical_tariff['hc']/30))*$_SESSION['days'];
                      }
                    
                    
                      if (isset($_POST['ic'])) {
                        $commision+=(($vehical_tariff['ic']/30)-($partner_vehical_tariff['ic']/30))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['oic'])) {
                        $commision+=(($vehical_tariff['oic']/30)-($partner_vehical_tariff['oic']/30))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['ekmc'])) {
                        $commision+=(($vehical_tariff['ekmc']/30)-($partner_vehical_tariff['ekmc']/30))*$_SESSION['days'];
                      }
  
           }
           else if( $_SESSION['days']>6)
           {
                $partner_vehical_tariff = $vehicle->partner_weekly_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
               $vehical_tariff = $vehicle->sale_weekly_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);   
               
               $commision+=(($vehical_tariff['rent']/7)-($partner_vehical_tariff['rent']/7))*$_SESSION['days'];

                    if (isset($_POST['driver'])) {
                        $commision+=(($vehical_tariff['dc']/7)-($partner_vehical_tariff['dc']/7))*$_SESSION['days'];
                    }
                   
                      if (isset($_POST['gps'])) {                        
                        $commision+=(($vehical_tariff['gpsc']/7)-($partner_vehical_tariff['gpsc']/7))*$_SESSION['days'];
                      }                      
                    
                      if (isset($_POST['bs'])) {
                        $commision+=(($vehical_tariff['csc']/7)-($partner_vehical_tariff['csc']/7))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['cdw'])) {
                        $commision+=(($vehical_tariff['cdw']/7)-($partner_vehical_tariff['cdw']/7))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['pai'])) {
                        $commision+=(($vehical_tariff['pai']/7)-($partner_vehical_tariff['pai']/7))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['hc'])) {
                        $commision+=(($vehical_tariff['hc']/7)-($partner_vehical_tariff['hc']/7))*$_SESSION['days'];
                      }
                    
                    
                      if (isset($_POST['ic'])) {
                        $commision+=(($vehical_tariff['ic']/7)-($partner_vehical_tariff['ic']/7))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['oic'])) {
                        $commision+=(($vehical_tariff['oic']/7)-($partner_vehical_tariff['oic']/7))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['ekmc'])) {
                        $commision+=(($vehical_tariff['ekmc']/7)-($partner_vehical_tariff['ekmc']/7))*$_SESSION['days'];
                      }
                  
           }
           else
           {
                $partner_vehical_tariff = $vehicle->partner_daily_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
               $vehical_tariff = $vehicle->sale_daily_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']); 
                
              $commision+=(($vehical_tariff['rent']-$partner_vehical_tariff['rent']))*$_SESSION['days'];
    
                    if (isset($_POST['driver'])) {
                        $commision+=(($vehical_tariff['dc']-$partner_vehical_tariff['dc']))*$_SESSION['days'];
                    }
                    
                      if (isset($_POST['gps'])) {                        
                        $commision+=(($vehical_tariff['gpsc']-$partner_vehical_tariff['gpsc']))*$_SESSION['days'];
                      }                      
                    
                      if (isset($_POST['bs'])) {
                        $commision+=(($vehical_tariff['csc']-$partner_vehical_tariff['csc']))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['cdw'])) {
                        $commision+=(($vehical_tariff['cdw']-$partner_vehical_tariff['cdw']))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['pai'])) {
                        $commision+=(($vehical_tariff['pai']-$partner_vehical_tariff['pai']))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['hc'])) {
                        $commision+=(($vehical_tariff['hc']-$partner_vehical_tariff['hc']))*$_SESSION['days'];
                      }
                    
                    
                      if (isset($_POST['ic'])) {
                        $commision+=(($vehical_tariff['ic']-$partner_vehical_tariff['ic']))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['oic'])) {
                        $commision+=(($vehical_tariff['oic']-$partner_vehical_tariff['oic']))*$_SESSION['days'];
                      }
                    
                      if (isset($_POST['ekmc'])) {
                        $commision+=(($vehical_tariff['ekmc']-$partner_vehical_tariff['ekmc']))*$_SESSION['days'];
                      }
           }
       }
        else
       {
            $commision=0;
       }
       
   } else {
       $commision=0;
   }


//Callculating Commision End

if ($user->checkLogin() == true) {
	$id = $booking->createBooking($_SESSION['pd'], $_SESSION['dd'], $_SESSION['driver'], $_SESSION['gps'], $_SESSION['bs'], $_SESSION['cdw'], $_SESSION['pai'],$_SESSION['hc'],$_SESSION['ic'],$_SESSION['oic'],$_SESSION['ekmc']
		,$driver_val,$gps_val,$bs_val,$cdw_val,$pai_val,$hc_val,$ic_val,$oic_val,$ekmc_val,$per_day_cost,$_SESSION['days'],$_SESSION['tr'],$doller_rent,$deal,$commision,$currency, $_SESSION['city1'], $_SESSION['city2'], $_SESSION['v_id'],$_SESSION['uid'],$status);
	// $id = $booking->createBooking($_SESSION['pd'], $_SESSION['dd'], $_SESSION['tr'], $_SESSION['uid'], $_SESSION['city1'], $_SESSION['city2'], $_SESSION['v_id'], $status, $_SESSION['driver'], $_SESSION['gps'], $_SESSION['bs'], $_SESSION['cdw'], $_SESSION['pai'],$_SESSION['hc'],$_SESSION['ic'],$_SESSION['oic'],$_SESSION['ekmc']);
	$_SESSION['bId'] = $id;
}

if($extra)
{
    $_SESSION['options_type'] ='Including extras';
}
else
{
    $_SESSION['options_type']='Not including extras.';
}

if ($gateway=="0") {
    $payment_type='Blance Due on Arrival';

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
    

	$_SESSION['gateway']="Manual";
    require '../PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';
    require '../testpdf/dompdf_config.inc.php';
    include '../../../include/booking_confirmationmail.php';
    //exit();
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
}
	$vid=$_SESSION['v_id'];
	$vehicle = vehical::getInstance();
	$vehicle_Result=$vehicle->getVehicle($vid);
	$ItemName 		= $vehicle_Result['name']; //Item Name
    $ItemNumber 	= $_SESSION['bId']; //Item Number
 
 
	//$ItemPrice 		= $doller_rent; 
    $ItemPrice 		= $_SESSION['doller_rent'];
    
	$GrandTotal = ($ItemPrice);
	
	//Parameters for SetExpressCheckout, which will be sent to PayPal
	$padata = 	'&METHOD=SetExpressCheckout'.
				'&RETURNURL='.urlencode($PayPalReturnURL ).
				'&CANCELURL='.urlencode($PayPalCancelURL).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).				
				
				'&NOSHIPPING=0'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
	
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
				'&LOCALECODE=GB'. //PayPal pages to match the language on your website.
				'&LOGOIMG=http://waqas.d4int.com/cars5/images/logo.png'. //site logo
				'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
				'&ALLOWNOTE=1';
				
				############# set session variable we need later for "DoExpressCheckoutPayment" #######
				$_SESSION['ItemName'] 			=  $ItemName; //Item Name
				$_SESSION['ItemPrice'] 			=  $ItemPrice; //Item Price
				$_SESSION['ItemNumber'] 		=  $ItemNumber; //Item Number
				$_SESSION['GrandTotal'] 		=  $GrandTotal;


		//We need to execute the "SetExpressCheckOut" method to obtain paypal token
		$paypal= new MyPayPal();
		$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
		
		//Respond according to message we receive from Paypal
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
		{

				//Redirect user to PayPal store with Token received.
			 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
				header('Location: '.$paypalurl);
			 
		}else{
			//Show error message
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
		}



//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
	//we will be using these two variables to execute the "DoExpressCheckoutPayment"
	//Note: we haven't received any payment yet.
	
	$token = $_GET["token"];
	$payer_id = $_GET["PayerID"];
	
	//get session variables
	$ItemName 			= $_SESSION['ItemName']; //Item Name
	$ItemPrice 			= $_SESSION['ItemPrice'] ; //Item Price
	$ItemNumber 		= $_SESSION['ItemNumber']; //Item Number
	$GrandTotal 		= $_SESSION['GrandTotal'];

	$padata = 	'&TOKEN='.urlencode($token).
				'&PAYERID='.urlencode($payer_id).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				
				//set item info here, otherwise we won't see product details later	
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).

				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);
	
	//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
	
	//Check if everything went ok..
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
	{

			echo '<h2>Success</h2>';
			echo 'Your Transaction ID : '.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
			$paypalid=urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
				/*
				//Sometimes Payment are kept pending even when transaction is complete. 
				//hence we need to notify user about it and ask him manually approve the transiction
				*/
				
				// if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				// {
				// 	// echo '<div style="color:green">Payment Received! Your product will be sent to you very soon!</div>';
				// }
				// elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				// {
				// 	// echo '<div style="color:red">Transaction Complete, but payment is still pending! '.
				// 	// 'You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';
				// }

				// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
				// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
				$padata = 	'&TOKEN='.urlencode($token);
				$paypal= new MyPayPal();
				$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
				{
					
					echo '<br /><b>Stuff to store in database :</b><br /><pre>';

						$bid = $_SESSION['bId'];
						$user = $_SESSION['uid'];
						$processor = "PayPal";
						$payment = paymentdb::getInstance();
						$payment->insert_transactions($user, $bid, $ItemPrice,$processor,$paypalid);
						$payment = bookingdb::getInstance();
						$status = 1;
						$payment->changeBookingStatus($bid, $status);

						$_SESSION['gateway']="Paypal";
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
						// echo '<h1>Successfully charged </h1>';

					
					// echo '<pre>';
					// print_r($httpParsedResponseAr);
					// echo '</pre>';
				} else  {
					echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
					echo '<pre>';
					print_r($httpParsedResponseAr);
					echo '</pre>';

				}
	
	}else{
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
	}
}
?>
