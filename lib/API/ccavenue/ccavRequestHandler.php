<?php
ob_start();
include_once("../Infobip/infoBipSMS.php");
require '../../config/config.php';
require '../../config/autoload.php';

$user = userdb::getInstance();
$part = partnerdb::getInstance();
$vehicle = vehical::getInstance();
$booking = bookingdb::getInstance();
$tran = paymentdb::getInstance();
$location= new dbcountrylocation;

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
?>

<html>
<head>
<title>CCAvenue: Billing Shipping</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 
    error_reporting(0);	
    $online_gatway=$tran->fetch_gateways();	
    /*$marchent_ids = explode(",", $online_gatway['marchent_id']);
    
    $merchant_data='';
    $cid='';
    if(isset($_SESSION['selected_country']))
    {
        
        
        $selected_country=$location->fetch_Countrybyname($_SESSION['selected_country']);
        $cid=$selected_country['id'];
        if($cid==6)
        {
            $merchant_data=$marchent_ids[1];
        }
        elseif($cid==7)
        {
            $merchant_data=$marchent_ids[2];
        }
        else
        {
            $merchant_data=$marchent_ids[0];
        }
    }
    else
    {
        $merchant_data=$marchent_ids[0];
    }*/


    $merchant_data=$online_gatway['marchent_id'];
	$working_key=$online_gatway['secret_key'];//Shared by CCAVENUES
	$access_code=$online_gatway['signature'];//Shared by CCAVENUES
      
    $redirect_url=URL.'lib/API/ccavenue/CUSTOM_CHECKOUT_FORM_KIT/ccavResponseHandler.php';
    $cancel_url=URL.'/car_booking.php';
    $merchant_data.='tid='.urlencode($_POST['tid']).'&merchant_id='.urlencode($merchant_data).'&order_id='.urlencode($_SESSION['bId']).'&amount='.urlencode($_SESSION['tr']).'&currency='.urlencode($currency).'&redirect_url='.urlencode($redirect_url).'&cancel_url='.urlencode($cancel_url).'&language=EN';
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

