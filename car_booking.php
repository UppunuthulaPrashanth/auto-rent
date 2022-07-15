<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
ob_start();
   require 'lib/config/config.php';
   require 'lib/config/autoload.php';
   error_reporting(E_ALL);
   
   $user = userdb::getInstance();
   $part = partnerdb::getInstance();
   $uid = $user->getUseerIDfromSession();
   $profile = $user->fetch_profile($uid);
   
   $country = dbcountrylocation::getInstance();
   $currency = paymentdb::getInstance();
   $vehicle = vehical::getInstance();
   $dealdb = dealdb::getInstance();
   $tran = paymentdb::getInstance();
   $online_gatway=$tran->fetch_gateways();
   
   $types = $vehicle->getVehicalTypes();
   
   if($_SESSION['days']>29)
   {
        $divider=30;
   }
   else if($_SESSION['days']>6)
   {
        $divider=7;
   }
   else
   {
        $divider=1;
   }

   if (isset($_POST['carId'])) {
     $_SESSION['v_id'] = $_POST['carId'];
   }    
    
    if(empty($_SESSION['country']) || empty($_SESSION['pd']) || empty($_SESSION['dd']) || empty($_SESSION['city1']) || empty($_SESSION['city2']) || empty($_SESSION['days']) || empty($_SESSION['v_id']))
   {
        header('Location:index.php');
        exit();
   }
   
   if(isset($_POST['coupon']) && !empty($_POST['coupon']))
   {
    $coupon=$_POST['coupon'];
    $promotion_status = $dealdb->deal_promotion_by_coupon($coupon);
   }
   else
   {
    $coupon='';
   }  
   
   
   $type=$vehicle->getType($_SESSION['v_id']);
   $selvehicle = $vehicle->getVehicle($_SESSION['v_id']);
   if ($profile['ref'] != "") {
       $partner = $part->fetchbyusername($profile['ref']);
       $sale_tariff_check = $vehicle->sale_tariff_check($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
       if ($sale_tariff_check>0) {
   
           if ( $_SESSION['days']>29) {
                  $vehical_tariff = $vehicle->sale_monthly_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
                  $per_day_cost=$vehical_tariff['rent']/30;
           }
           else if( $_SESSION['days']>6)
           {
               $vehical_tariff = $vehicle->sale_weekly_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
                  $per_day_cost=$vehical_tariff['rent']/7;
   
           }
           else
           {
               $vehical_tariff = $vehicle->sale_daily_tariff($_SESSION['v_id'],$_SESSION['country'],$partner['id']);
                  $per_day_cost=$vehical_tariff['rent'];
   
           }
       }
        else
       {
            $vehicle_tariff_check = $vehicle->check_vehicle_tariff($_SESSION['v_id'],$_SESSION['country']);
           if ($vehicle_tariff_check>0) {
               if ( $_SESSION['days']>29) {
                      $vehical_tariff = $vehicle->vehical_monthly_tariff($_SESSION['v_id'],$_SESSION['country']);
                      $per_day_cost=$vehical_tariff['rent']/30;
       
               }
               else if( $_SESSION['days']>6)
               {
                   $vehical_tariff = $vehicle->vehical_weekly_tariff($_SESSION['v_id'],$_SESSION['country']);
                      $per_day_cost=$vehical_tariff['rent']/7;
       
               }
               else
               {
                   $vehical_tariff = $vehicle->vehical_daily_tariff($_SESSION['v_id'],$_SESSION['country']);
                      $per_day_cost=$vehical_tariff['rent'];
       
               }
           }
       }
       
   } else {
       $vehicle_tariff_check = $vehicle->check_vehicle_tariff($_SESSION['v_id'],$_SESSION['country']);
       if ($vehicle_tariff_check>0) {
           if ( $_SESSION['days']>29) {
                  $vehical_tariff = $vehicle->vehical_monthly_tariff($_SESSION['v_id'],$_SESSION['country']);
                  $per_day_cost=$vehical_tariff['rent']/30;
   
           }
           else if( $_SESSION['days']>6)
           {
               $vehical_tariff = $vehicle->vehical_weekly_tariff($_SESSION['v_id'],$_SESSION['country']);
                  $per_day_cost=$vehical_tariff['rent']/7;
   
           }
           else
           {
               $vehical_tariff = $vehicle->vehical_daily_tariff($_SESSION['v_id'],$_SESSION['country']);
                  $per_day_cost=$vehical_tariff['rent'];
   
           }
       }
       else
       {
            header('Location:index.php');
            exit();
       }
   }
   $per_day_cost=round($per_day_cost,2);
                   
   ?>
<!DOCTYPE html>
<html class="no-js">
   <?php include 'header.php'; ?>
   <?php echo $head; ?>
   <title><?php echo $pagetitle['CB'];?> </title>
   </head>
   <body>
      <!-- ==========================================================================
         Header Area
         ========================================================================== -->
      <section class="header-booking">
         <?php echo $mainnav; ?>
         <?php echo $login_model; ?>
         <?php echo  $forgetpass_model; ?>
         <div class="clearfix"></div>
         <div class="search-cover">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 icon"><img class="pull-right" src="images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Make Your Booking</span></h1> </div>
                </div>
            </div>
        </div>
         <div class="clearfix" ></div>
      </section>
      <!-- ==========================================================================
         main-section
         ========================================================================== -->
      <?php
         $val = new dbcountrylocation;
         
         $country = $val->fetch_Country($_SESSION['country']);
         $city1 = $val->fetch_Location($_SESSION['city1']);
         $city2 = $val->fetch_Location($_SESSION['city2']);
         ?>
         <div id="loader"></div>
      <section id="confirm-booking">
         <div class="container">
         <div class="col-md-8 left">
            <div class="col-md-12 vehicle">
               <div class="section-header" >
                  <h1 class="section-title" style="  padding-bottom: 7px; padding-top: 7px;"><?php echo $selvehicle['name']; ?></h1>
               </div>
               <div class="vehicle-details">
                  <div class="col-md-4 vehicle-img">
                     <img src="images/admin_images/vehicle_images/<?php echo $selvehicle['img_url'];?>"  style="  position: relative;top: 30px;height: 136px;" alt="">
                  </div>
                  <div class="col-md-8 vehicle-info">
                     <div style="  padding-left: 40px;" class="col-md-6 features">
                        <h1 class="heading" style="margin-top:0">Car Features</h1>
                        <ul class="list-inline boking-li">
                           <p>
                           <div class="icon"><img src="images/Masculine_Avatar_24.png" alt=""> <span> </div>
                           &nbsp;Up to <?php echo $selvehicle['passenger'] ?> Passengers</span></p>
                           <p>
                           <div class="icon"><img src="images/Travelling_luggage_24.png" alt=""></div>
                           <span> &nbsp;<?php echo $selvehicle['luggage'] ?> Piece of Luggage</span> </p>
                           <p>
                           <div class="icon"><img src="images/door.png" alt=""></div>
                           <span> &nbsp;Up to <?php echo $selvehicle['door'] ?> Door</span></p>
                           <p>
                           <div class="icon"><img src="images/fuel-adj.png" alt=""></div>
                           <span> &nbsp;Fuel Capacity <?php echo $selvehicle['fuel_capacity'] ?></span></p>
                           <p>
                           <div class="icon"><img src="images/Tower_signal_symbol_24.png" alt=""></div>
                           <span> &nbsp; <?php if($selvehicle['tranmision']==1){echo "Manual"; } else { echo "Auto"; } ?> Transmission</span></p>
                        </ul>
                     </div>
                     <div style="  padding-left: 45px;" class="col-md-6 details">
                        <h1 class="heading" style="margin-top:0">Car Details</h1>
                        <p class="specifications">Type : <span class="engine-type"><?php echo $vehicle->getType($selvehicle['vt_id']);?></span> </p>
                        <p class="specifications">Engine : <span class="engine-type"><?php echo $selvehicle['engine'];?></span>  </p>
                        <?php 
                        if($selvehicle['model'])
                        {
                            ?>
                                <p class="specifications">Modal Year : <span class="engine-type"><?php echo $selvehicle['model'];?></span>  </p>
                            <?php
                        }
                        ?>
                        
                        <ul class="list-inline boking-li">
                           <li>
                              <span class="box-icon"><img src="images/airbag.png" alt=""></span> 
                              <span class="box-icon"><img src="images/anti-brake.png" alt=""></span>
                              <span class="box-icon"><img src="images/cruse-control.png" alt=""></span>
                           </li>
                           <br>
                           <li style="padding-top:0;  margin-top: -4px;">
                              <?php 
                                 if ($selvehicle['airbags']==1) {?>
                              <span class="box-icon opt-icon"><img src="images/check.png" alt=""></span>
                              <?php
                                 }
                                 else
                                 {?>
                              <span class="box-icon opt-icon"><img src="images/cross.png" alt=""></span> 
                              <?php
                                 }
                                 ?>
                              <?php 
                                 if ($selvehicle['anti_brake']==1) {?>
                              <span class="box-icon opt-icon"><img src="images/check.png" alt=""></span>
                              <?php
                                 }
                                 else
                                 {?>
                              <span class="box-icon opt-icon"><img src="images/cross.png" alt=""></span> 
                              <?php
                                 }
                                 ?>
                              <?php 
                                 if ($selvehicle['cruise_control']==1) {?>
                              <span class="box-icon opt-icon"><img src="images/check.png" alt=""></span>
                              <?php
                                 }
                                 else
                                 {?>
                              <span class="box-icon opt-icon"><img src="images/cross.png" alt=""></span> 
                              <?php
                                 }
                                 ?>                                    
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="col-md-12 terms" style="  padding-top: 0;  margin-top: 25px;border: 1px solid rgb(204, 204, 204);">
               <h4 style="margin-top: 0;" class="section-heading">Booking Terms and Conditions</h4>
               <div class="desc" style="padding-left:15px;padding-right:15px;padding-bottom:15px"><?php echo $selvehicle['terms_condition']; ?></div>
            </div>
         </div>
         <form action="car_booking.php" method="post" id="form">
            <input type="hidden" name="carId" id="carId" value="<?php echo $_SESSION['v_id'];?>">
         </form>
         <form action="<?php if(!empty($online_gatway) && $online_gatway['name']=="Paypal"){ ?>lib/API/paypal/process.php<?php }else{?>lib/API/ccavenue/ccavRequestHandler.php<?php } ?>" method="post" id="frm">
            <input type="hidden" name="tid" id="tid" value="">
            <input type="hidden" name="coupon" id="deal_coupon" value="<?php echo $coupon;?>">
            <input type="hidden" name="carId" value="<?php echo $_SESSION['v_id'];?>">
            <input type="hidden" name="currency" value="<?php echo $country['currency'];?>">

            <div class="col-md-4 right">
               <div class="rightsidebar">
                  <h1 class="heading">Booking Summary</h1>
                  <div class="pickup-time">
                     <h4 class="sub-heading">Pickup Time</h4>
                     <p class="timing"><span class="day"><?php echo $_SESSION['pd']; ?></span></p>
                  </div>
                  <div class="dropoff-time">
                     <h4 class="sub-heading">Drop Time</h4>
                     <p class="timing"><span class="day"><?php echo $_SESSION['dd']; ?></span></p>
                  </div>
                  <div class="clearfix"></div>
                  <div class="pickup-location">
                     <div class="section-heading">
                        <h4 class="section-title">PICKUP LOCATION</h4>
                     </div>
                     <div class="icon">
                        <i class="icon-map-marker"></i>
                     </div>
                     <div class="address">
                        <p class="address-detail"><?php echo $city1['name']; ?></p>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="pickup-location">
                     <div class="section-heading">
                        <h4 class="section-title">DROP LOCATION</h4>
                     </div>
                     <div class="icon">
                        <i class="icon-map-marker"></i>
                     </div>
                     <div class="address">
                        <p class="address-detail"><?php echo $city2['name']; ?></p>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="section-heading">
                     <h4 class="section-title">Vehicle Rent</h4>
                  </div>
                  <div class="more-option" style="  padding: 5px 0; padding-right: 0px;">
                     <div class="extra-option rent-box">
                        <span class="text">Rent Per Day</span>
                        <span class="figure"><span><?php echo $country['currency']; ?></span> <span id="rent_per_day"><?php echo $per_day_cost?></span></span>
                        <input type="hidden" name="per_day_cost" id="per_day_cost" value="<?php echo $per_day_cost?>">
                        <input type="hidden" name="actual_cost" id="actual_cost" value="<?php echo $per_day_cost?>">
                        <input type="hidden" name="curr_unit" id="curr_unit" value="<?php echo $country['currency']?>">
                        <div class="clearfix"></div>
                     </div>
                     <div class="extra-option rent-box">
                        <span class="text">No. Of Days</span>
                        <span class="figure"><span id="number_of_days"><?php echo $_SESSION['days']; ?></span></span>
                        <input type="hidden" name="days" id="days" value="<?php echo $_SESSION['days'];?>">
                        <div class="clearfix"></div>
                     </div>
                     <div class="extra-option rent-box" style="  padding-top: 8px !important; border-top: 1px solid rgb(215, 215, 215);">
                        <span class="text" style="  font-weight: bold;">Total Vehicle Rent</span>
                        <span class="figure" style="  font-weight: bold;"><span><?php echo $country['currency']; ?></span><span id="total_vehicle_rent"> <?php echo $per_day_cost * $_SESSION['days'];?></span></span>
                        <div class="clearfix"></div>
                     </div>
                     <div class="cleafix"></div>
                  </div>
                  <div class="section-heading">
                     <h4 class="section-title">Add Extra Options</h4>
                  </div>
                  <div class="more-option" style="  padding-bottom: 0;">
                     <ul class="list-unstyled" style="margin:0;">                        
                        <input type="hidden" value="<?php echo $vehical_tariff['dc'];?>" name="driver_val" id="driver_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['gpsc'];?>" name="gps_val" id="gps_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['csc'];?>" name="bs_val" id="bs_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['cdw'];?>" name="cdw_val" id="cdw_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['pai'];?>" name="pai_val" id="pai_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['hc'];?>" name="hc_val"  id="hc_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['ic'];?>" name="ic_val" id="ic_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['oic'];?>" name="oic_val" id="oic_val" />
                        <input type="hidden" value="<?php echo $vehical_tariff['ekmc'];?>" name="ekmc_val" id="ekmc_val" />
                        
                        <?php 
                        if(round($vehical_tariff['dc']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="driver" id="driver">
                               <label class="checkbox-label" for="driver">Driver (<?php echo round($vehical_tariff['dc']/$divider,2).' ' .  $country['currency'];?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        
                        
                        <?php 
                        if(round($vehical_tariff['gpsc']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="gps" id="gps">
                               <label class="checkbox-label" for="gps">GPS (<?php echo round($vehical_tariff['gpsc']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        
                        <?php 
                        if(round($vehical_tariff['csc']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="bs" id="bs" >
                               <label class="checkbox-label" for="bs">Baby Seat (<?php echo round($vehical_tariff['csc']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        <?php 
                        if(round($vehical_tariff['cdw']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="cdw" id="cdw">
                               <label class="checkbox-label" for="cdw">Collision Damage Waiver (<?php echo round($vehical_tariff['cdw']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        <?php 
                        if(round($vehical_tariff['pai']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="pai" id="pai" >
                               <label class="checkbox-label" for="pai">Personal Accident Insurance (<?php echo round($vehical_tariff['pai']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        <?php 
                        if(round($vehical_tariff['hc']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="hc" id="hc">
                               <label class="checkbox-label" for="hc">Delivery off hire Cost (<?php echo round($vehical_tariff['hc']/$divider,2).' ' .  $country['currency'];?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        <?php 
                        if(round($vehical_tariff['ic']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="ic" id="ic">
                               <label class="checkbox-label" for="ic">Insurance Cost (<?php echo round($vehical_tariff['ic']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        
                        <?php 
                        if(round($vehical_tariff['oic']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="oic" id="oic" >
                               <label class="checkbox-label" for="oic">Offroad Insurance Cost (<?php echo round($vehical_tariff['oic']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>
                        
                        
                        <?php 
                        if(round($vehical_tariff['ekmc']/$divider,2)>0)
                        {?>
                            <li>
                               <input class="square-checkbox" tabindex="1" type="checkbox" name="ekmc" id="ekmc">
                               <label class="checkbox-label" for="ekmc">Extra KM Cost (<?php echo round($vehical_tariff['ekmc']/$divider,2).' ' . $country['currency']; ?> Per Day)</label> 
                               
                            </li>
                        <?php                             
                        }                        
                        ?>                                         
                     </ul>
                     <div class="cleafix"></div>
                  </div>
                  <div class="section-heading" style="  background-color: transparent;border-top: 1px solid rgb(224, 224, 224);">
                     <span class="total">Total Extra Options</span>
                     <span class="numbers"><span><?php echo $country['currency']; ?> </span><span id="options_cost">0</span> </span>
                  </div>
                  <div class="section-heading">
                     <span class="total">Grant Total</span>
                     <span class="numbers"><span><?php echo $country['currency'];echo " "; ?></span><span id="totalRent"><?php echo $per_day_cost * $_SESSION['days'];;?></span>  </span>
                  </div>
                  <div class="extra-option" style="  padding-bottom: 0px;">
                     <input type="text" id="coupon" name="coupon" class="form-control coupon" autocomplete="off" placeholder="Add Coupon Code Here" style="height: 27px;<?php if(!empty($coupon) && !empty($promotion_status)){?> display: none; <?php } ?> ">
                     <span style="padding-left: 15px;" class="text">Discount Applied</span>
                     <span style="padding-right: 15px;" class="figure"><?php echo $country['currency']; ?><span id="discount">0</span></span>
                     <div class="clearfix"></div>
                  </div>
                  <?php $result=$currency->currency_converter($per_day_cost * $_SESSION['days'],$country['currency'],'USD'); ?>
                  <div class="section-heading tot-payment" style="">
                     <span class="total" style="  font-size: 17px;">Payable Amount</span>
                     <span class="numbers"><span style="  font-size: 18px;"><?php echo $country['currency'];echo " "; ?></span><span id="fianlRent" style="  font-size: 18px;"><?php echo $per_day_cost * $_SESSION['days'];?></span></span>
                      <!-- <span class="numbers" style="  width: 95%;position: relative;top: -19px;font-size: 14px;font-weight: normal;"><span id="dollorRent"><?php echo "= " . $result . '$' ?></span></span>-->
                  </div>
                  <?php 
                     ?>
                  <input type="hidden"  id="tRent" name="tRent" value="<?php echo $per_day_cost * $_SESSION['days'];?>,<?php echo $result?>" />
                  <input type="hidden" id="uid" value="<?php echo $uid;?>" />
                  <div class="col-md-12 btn-cont">
                     <!--  <button class="proceed-btn" id="process">Proceed To Payment</button>  -->
                     <div class="col-md-12"  style="padding:0 5px;">
                        <div class="col-md-5" style="padding:0">
                           <p style="text-align:left;margin: 0;font-size: 16px;font-weight: bold;position: relative;top: -4px;">Payment Method</p>
                        </div>
                        <div class="col-md-7" style="padding:0;  ">
                           <div class="col-md-12" style="padding:0"> <label class="checkbox-label gateway" for="gateway"> 
    <input style="position:relative;right: 3px;margin-right: 5px;" class="square-checkbox" tabindex="1" <?php if($country['id']==7 || empty($online_gatway)){?> checked="true" <?php } ?> type="radio" name="gateway" id="gateway"  value="0"  <span>Pay at Location</span></label> </div>
                           <?php 
                           if($online_gatway)
                           {
                                if($country['id']==5 || $country['id']==6)
                                {
                                    ?>
                                        <div class="col-md-12" style="padding:0"> <label class="checkbox-label gateway" for="gateway">  <input style="margin-right: 5px;" class="square-checkbox" tabindex="1" checked="true" type="radio" name="gateway" id="gateway" value="1" >  <span>Online Payment</span></label> </div>
                                    <?php 
                                }
                           }
                            ?>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <style>
                     .prfile_info{
                       background: #DA3F59;
                        line-height: 1.3;
                        padding: 5px;
                        color: #fff;
                        font-size: 13px;
                        margin-top: 36px;
                        display: block;
                       }</style>
                     <p class="prfile_info hide"></p>
                     <div class="col-md-12" style="  margin-top: 20px;"> 
                        <a id="process"  class="proceed-btn">Proceed to Payment</a>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="clearfix"></div>
            </div>
         </form>
      </section>

        <div id="preloader"></div>
      <!-- 
         Footer Area
         ========================================================================== -->
      <?php echo $footer; ?>
      <script>
         $(document).ready(function(){
           var callbacks_list = $('.demo-callbacks ul');
           $('#driver,#gps,#bs,#cdw,#pai,#hc,#ic,#oic,#ekmc').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
             callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
           }).iCheck({
             checkboxClass: 'icheckbox_square-blue',
             radioClass: 'iradio_square-blue',
             increaseArea: '20%'
           });
         });
                  
         $(document).ready(function() {
            deal_coupon=$('#deal_coupon').val();
            if(deal_coupon!="")
            {
        $("#loader").addClass('preloader');
        coupon = $(this).val();
        vid=$('#carId').val();
        per_day_cost=$('#per_day_cost').val();
        actual_cost=$('#actual_cost').val();
        unit=$('#curr_unit').val();
        $.ajax({

                  url: 'include/coupon_rates.php',
                  type: 'POST',
                  data:
                  {
                    coupon: deal_coupon,
                    vid: vid,
                    per_day_cost:per_day_cost,
                    actual_cost:actual_cost,
                  },
                  success: function(response)
                  {
                    response=parseFloat(response);
                    $('#rent_per_day').text(response);
                    var days = $("#days").val();
                    $('#total_vehicle_rent').text(response*days);
                    
                    res=response*days;
                    
                    if(days>29)
                            {
                                divider=30;
                            }
                            else if(days>6)
                            {
                                divider=7;
                            }
                            else
                            {
                                divider=1;
                            }
                  
                    if($('#gps').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#gps_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#bs').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#bs_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#driver').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#driver_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#cdw').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#cdw_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#pai').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#pai_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#hc').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#hc_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#ic').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#ic_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#oic').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#oic_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    if($('#ekmc').prop('checked'))
                    {
                        var option_cost = parseFloat((($("#ekmc_val").val())/divider)*days);
                        res=res+option_cost;
                    }
                    $("#totalRent").text(res);
                    
                    $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $('#discount').text((actual_cost-response)*days);
                    $("#tRent").val(res + ',' + data);
                    $('#per_day_cost').val(response);
                    $('#coupon').val(deal_coupon);
                    $("#loader").removeClass('preloader');
                  }
                  });
                  }
        });
    }
    else
    {
        coupon='';
    }
            
var lastValue = '';
$("#coupon").on('change keyup paste', function() {  
    $( "#coupon" ).css({"display":"none"});
    if ($(this).val() != coupon) {        
        $("#loader").addClass('preloader');
        vid=$('#carId').val();
        per_day_cost=$('#per_day_cost').val();
        actual_cost=$('#actual_cost').val();
        unit=$('#curr_unit').val();
        
        
        var timeOutId = 0;
        var ajaxFn = function () {
            coupon = $("#coupon").val();
                    $.ajax({            
                          url: 'include/coupon_rates.php',
                          type: 'POST',
                          cache:false,
                          data:
                          {
                            coupon: coupon,
                            vid: vid,
                            per_day_cost:per_day_cost,
                            actual_cost:actual_cost,
                          },
                          success: function(response)
                          {
                            response=parseFloat(response);
                            $('#rent_per_day').text(response);
                            var days = $("#days").val();
                            $('#total_vehicle_rent').text(parseFloat(response*days).toFixed(2));
                            
                            res=response*days;
                          
                            if(days>29)
                                    {
                                        divider=30;
                                    }
                                    else if(days>6)
                                    {
                                        divider=7;
                                    }
                                    else
                                    {
                                        divider=1;
                                    }
                          
                            if($('#gps').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#gps_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#bs').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#bs_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#driver').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#driver_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#cdw').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#cdw_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#pai').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#pai_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#hc').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#hc_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#ic').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#ic_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#oic').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#oic_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            if($('#ekmc').prop('checked'))
                            {
                                var option_cost = parseFloat((($("#ekmc_val").val())/divider)*days);
                                res=res+option_cost;
                            }
                            
                            res = parseFloat(res.toFixed(2));
                            
                            $("#totalRent").text(res);
                            
                            $.ajax({
        
                          url: 'currency_converter.php',
                          type: 'POST',
                          data:
                          {
                            amount: res,
                            from: unit,
                            to: 'USD',
                          },
                          success: function(data)
                          {
                            $("#fianlRent").text(res);
                            $('#discount').text((actual_cost-response)*days);
                            $("#tRent").val(res + ',' + data);
                            $('#per_day_cost').val(response);
                            $("#loader").removeClass('preloader');
                            $( "#coupon" ).css({"display":"block"});
                          }
                          });
                          }
                });
        }
        ajaxFn();
        //OR use BELOW line to wait 10 secs before first call
        timeOutId = setTimeout(ajaxFn, 10000);
    }
    else
    {
        $( "#coupon" ).css({"display":"block"});
    }
    
});
         
      $('#gps').on('ifChanged', function(event){
        $("#loader").addClass('preloader');
          var a = parseFloat($("#tRent").val());
          var b = parseFloat($("#gps_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
            if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            b = parseFloat(b.toFixed(2));
      var res;

          if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
        
        res = parseFloat(res.toFixed(2));
        $("#totalRent").text(res);

              $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
          });
        

        $('#bs').on('ifChanged', function(event){
          $("#loader").addClass('preloader');
      var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#bs_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
                        
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            b = parseFloat(b.toFixed(2));
            var res;

          if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
        res = parseFloat(res.toFixed(2));
        $("#totalRent").text(res);
              $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
          });

        $('#driver').on('ifChanged', function(event){
            $("#loader").addClass('preloader');
              
      
      var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#driver_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            b = parseFloat(b.toFixed(2));
            var res;            
          if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
        res = parseFloat(res.toFixed(2));
        $("#totalRent").text(res);
      $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });

          });

        $('#cdw').on('ifChanged', function(event){
          $("#loader").addClass('preloader');
      var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#cdw_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            b = parseFloat(b.toFixed(2));
            var res;

          if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
        res = parseFloat(res.toFixed(2));
        $("#totalRent").text(res);
              $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
          });


        $('#pai').on('ifChanged', function(event){
          $("#loader").addClass('preloader');
          var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#pai_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
            if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            
           b = parseFloat(b.toFixed(2));
            var res;
            
           if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
        res = parseFloat(res.toFixed(2));
        $("#totalRent").text(res);
              $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
          });

        $('#hc').on('ifChanged', function(event){
          $("#loader").addClass('preloader');
            var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#hc_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
b = parseFloat(b.toFixed(2));
            var res;

             if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
              res = parseFloat(res.toFixed(2));
              $("#totalRent").text(res);
                    $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
            });

         $('#ic').on('ifChanged', function(event){
          $("#loader").addClass('preloader');
            var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#ic_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
           b = parseFloat(b.toFixed(2));
            var res;

             if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
              res = parseFloat(res.toFixed(2));
              $("#totalRent").text(res);
                    $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                   $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
            });

          $('#oic').on('ifChanged', function(event){
            $("#loader").addClass('preloader');
            var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#oic_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            b = parseFloat(b.toFixed(2));
            var res;

             if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
              res = parseFloat(res.toFixed(2));
              $("#totalRent").text(res);
                    $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
            });


           $('#ekmc').on('ifChanged', function(event){
            $("#loader").addClass('preloader');
            var a = parseFloat($("#tRent").val());
            var b = parseFloat($("#ekmc_val").val());
            var options_cost = parseFloat($("#options_cost").text());
            options_cost = parseFloat(options_cost.toFixed(2));
            unit=$('#curr_unit').val();
            var days = $("#days").val();
                        if(days>29)
            {
                b=(b/30)*days;
            }
            else if(days>6)
            {
                b=(b/7)*days;
            }
            else
            {
                b=(b/1)*days;
            }
            b = parseFloat(b.toFixed(2));
            var res;

             if($(this).prop('checked'))
           { 
                res=a+b;           
                $("#options_cost").text(parseFloat(options_cost + b).toFixed(2));
            }
            else
            {
                res=a-b;
                $("#options_cost").text(parseFloat(options_cost - b).toFixed(2));
            }
              res = parseFloat(res.toFixed(2));
              $("#totalRent").text(res);
                    $.ajax({

                  url: 'currency_converter.php',
                  type: 'POST',
                  data:
                  {
                    amount: res,
                    from: unit,
                    to: 'USD',
                  },
                  success: function(data)
                  {
                    $("#fianlRent").text(res);
                    $("#tRent").val(res + ',' + data);
                    $("#loader").removeClass('preloader');
                  }
                  });
            });
         
          $('#process').click(function() {
            if ($('#uid').val()=="")
             {
                 $('#process').attr('data-toggle', 'modal');
                 $('#process').attr('data-target', '#basicModal');
                 $('.logintype').hide(); 
         
             }
             else
             {
             	$.ajax({

                  url: 'include/validate_profile.php',
                  type: 'POST',
                  success: function(data)
                  {
                    if(data==1)
                    {
                        $('#frm').submit();
                      /*$.ajax({

                        url: 'include/validated_document.php',
                        type: 'POST',
                        success: function(data)
                        {
                          if(data==1)
                          {
                            $('#frm').submit();
                          }
                          else
                          {
                            $('.prfile_info').removeClass('hide').html('No Validated Document Found.Please First Add Verification Documents');
                          }
                        }
                      });*/ 
                    }
                    else
                    {
                    	$('.prfile_info').removeClass('hide').html('Your Profile is Not Complete.<br><a href="edit-profile.php?process=booking" style="color:white;text-decoration:underline;">Click Here To Complete Your Profile</a>');
                    }
                  }
                });              
             }
          });
         
         });
      </script>
      
      <script>
    	window.onload = function() {
    		var d = new Date().getTime();
    		document.getElementById("tid").value = d;
    	};
    </script>
      
      <script type="text/javascript">
  $(function(){  
  	  var jsonData;
  	  var access_code="AVHK02CJ30AO72KHOA" // shared by CCAVENUE 
	  var amount="1.00";
  	  var currency="AED";
  	  
      $.ajax({
           url:'https://secure.ccavenue.ae/transaction/transaction.do?command=getJsonData&access_code='+access_code+'&currency='+currency+'&amount='+amount,
           dataType: 'jsonp',
           jsonp: false,
           jsonpCallback: 'processData',
           success: function (data) { 
                 jsonData = data;
                 // processData method for reference
                 processData(data); 
		 // get Promotion details
                 $.each(jsonData, function(index,value) {
			if(value.Promotions != undefined  && value.Promotions !=null){  
				var promotionsArray = $.parseJSON(value.Promotions);
		               	$.each(promotionsArray, function() {
					console.log(this['promoId'] +" "+this['promoCardName']);	
					var	promotions=	"<option value="+this['promoId']+">"
					+this['promoName']+" - "+this['promoPayOptTypeDesc']+"-"+this['promoCardName']+" - "+currency+" "+this['discountValue']+"  "+this['promoType']+"</option>";
					$("#promo_code").find("option:last").after(promotions);
				});
			}
		});
           },
           error: function(xhr, textStatus, errorThrown) {
               alert('An error occurred! ' + ( errorThrown ? errorThrown :xhr.status ));
               //console.log("Error occured");
           }
   		});
 
   function processData(data){
         var paymentOptions = [];
         var creditCards = [];
         var debitCards = [];
         var netBanks = [];
         var cashCards = [];
         var mobilePayments=[];
         $.each(data, function() {
         	 // this.error shows if any error   	
             console.log(this.error);
              paymentOptions.push(this.payOpt);
              switch(this.payOpt){
                case 'OPTCRDC':
                	var jsonData = this.OPTCRDC;
                 	var obj = $.parseJSON(jsonData);
                 	$.each(obj, function() {
                 		creditCards.push(this['cardName']);
                	});
                break;
                case 'OPTDBCRD':
                	var jsonData = this.OPTDBCRD;
                 	var obj = $.parseJSON(jsonData);
                 	$.each(obj, function() {
                 		debitCards.push(this['cardName']);
                	});
                break;
              	case 'OPTNBK':
	              	var jsonData = this.OPTNBK;
	                var obj = $.parseJSON(jsonData);
	                $.each(obj, function() {
	                 	netBanks.push(this['cardName']);
	                });
                break;
                
                case 'OPTCASHC':
                  var jsonData = this.OPTCASHC;
                  var obj =  $.parseJSON(jsonData);
                  $.each(obj, function() {
                  	cashCards.push(this['cardName']);
                  });
                 break;
                   
                  case 'OPTMOBP':
                  var jsonData = this.OPTMOBP;
                  var obj =  $.parseJSON(jsonData);
                  $.each(obj, function() {
                  	mobilePayments.push(this['cardName']);
                  });
              }
              
            });
      }
  });
</script>
   </body>
</html>