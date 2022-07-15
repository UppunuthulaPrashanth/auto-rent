<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$vehicle = vehical::getInstance();
$location = new dbcountrylocation;
$bk = new bookingdb;

 if(empty($_SESSION['country']) || empty($_SESSION['city1']) || empty($_SESSION['city2']) || empty($_SESSION['bId']) || empty($_SESSION['v_id']) || empty($_SESSION['gateway']))
 {
    header('Location:index.php');
    exit();
 }
 
 
$uid = $user->getUseerIDfromSession();
$profile = $user->fetch_profile($uid);

$booking=$bk->fetchBooking($_SESSION['bId']); 
$vehicle_Result=$vehicle->getVehicle($_SESSION['v_id']);
$type=$vehicle->get_arabic_Type($vehicle_Result['vt_id']);

$country = $location->fetch_Country($_SESSION['country']);
$city1 = $location->fetch_Location($_SESSION['city1']);
$city2 = $location->fetch_Location($_SESSION['city2']);

?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>Booking Confirmed</title>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".country-list").click(function(){
    $(".country-menu").toggleClass("showMenu");
      $(".country-menu > li").click(function(){
        $(".country-list > p").text($(this).text());
        $(".country-menu").removeClass("showMenu");
      });
  });
});

$(document).ready(function(){
  $(".city-list").click(function(){
    $(".city-menu").toggleClass("showMenu");
      $(".city-menu > li").click(function(){
        $(".city-list > p").text($(this).text());
        $(".city-menu").removeClass("showMenu");
      });
  });
});
</script>


   <style>
   .desc h1{
        font-size: 25px;
   }
		.icon-box11{
		   	 float: right;
		   	direction: rtl;
		   	    margin-bottom: 3px;
		   }
		.icon-box11 span{
		   	    text-align: right; 
		    direction: rtl; 
		    margin-right: 5px;
		   	
		   }
		   
		.icon-box11 img{
		   	    text-align: right; 
		    direction: rtl; 
		   	
		   }
		   
		.boking-li .icon {
		
		    float: right;
		}
		
		#confirm-booking .container .left .vehicle .section-header {
		    transform: scale(-1);
		}
		
		#confirm-booking .container .left .vehicle .section-header .section-title {
		    transform: scale(-1);
		}
		
		#confirm-booking .container .left .vehicle .vehicle-details .vehicle-info .features .heading {

			    text-align: right;
			    direction: rtl;
			     }
			     
 .more-option2 li {
  
    direction: rtl;
   float: right;
    margin-bottom: 5px;
    text-align: right;
   }
   
   .opt-icon {
    
    margin-right: 17px;
    margin-right: 6px;
    float: right;
}

#confirm-booking .container .right .rightsidebar .section-heading .grand-total {
  
    float: right;
    direction: rtl;
 padding-right: 15px;
}
#confirm-booking .container .right .rightsidebar .section-heading .numbers {
  
    text-align: left;
}
   </style>
</head>
<body>
    <!-- 
                                        Header Area
    ========================================================================== -->
    <section class="header-search">
        <?php echo $mainnav; ?>
               <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>
        <div class="clearfix"></div>
      <div class="search-cover">
            <div class="container">
                <div class="row">
                   
                    <div class="col-md-11 text"><h1 class="tagline pull-right"><span>تأكيد الحجز</span></h1> </div>
                       <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
   <!-- ==========================================================================
                                    Thank You Section
    ========================================================================== -->
    <section class="" id="thanks" style="padding-top: 40px;">
    
        <div class="container">
            <div class="col-md-12" style="text-align:center">
                <h1 class="heading" style="direction:rtl">أشكركم على الحجز مع الاوتورينت.</h1>
                <p class="description" style="direction:rtl">كود الحجز الخاص بك هو <span class="booking-id"><?php echo "AR" . $booking['id']; ?></span></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
   <!-- ==========================================================================
                                    main-section
    ========================================================================== -->
        <section id="confirm-booking">
            <div class="container">
                <div class="col-md-8 left">



    <div class="col-md-12 vehicle">
               <div class="section-header" >
                  <h1 class="section-title" style="  padding-bottom: 7px; padding-top: 7px;"><?php echo $vehicle_Result['ar_name']; ?></h1>
               </div>
               <div class="vehicle-details">
               
                  <div class="col-md-8 vehicle-info">
                  
                     <div style="  padding-left: 40px;" class="col-md-6 features">
                        <h1 class="heading" style="margin-top:0">الميزات سيارة</h1>
                        <ul class="list-inline boking-li">
                         	
                         	<div class="col-md-12 nopad-lr icon-box11">
                         	  <div class="icon"><img src="../images/Masculine_Avatar_24.png" alt="">  </div>
                         	  <span>
                             &nbsp;حتى<?php echo $vehicle_Result['passenger'] ?> الركاب</span>
                         	</div>
                         	
                         	<div class="col-md-12 nopad-lr icon-box11"> 
                         			 <div class="icon"><img src="../images/Travelling_luggage_24.png" alt=""></div>
                           <span> &nbsp;<?php echo $vehicle_Result['luggage'] ?>قطعة من الأمتعة</span>
                         		</div>
                         		
                         		
                          
                          	<div class="col-md-12 nopad-lr icon-box11"> 
                         			    <div class="icon"><img src="../images/door.png" alt=""></div>
                           <span> &nbsp;حتى <?php echo $vehicle_Result['door'] ?> باب</span>
                         		</div>
                         		
                         		
                         		
                         			<div class="col-md-12 nopad-lr icon-box11"> 
                         			 <div class="icon"><img src="../images/fuel-adj.png" alt=""></div>
                                    <span> &nbsp;سعة خزان الوقود <?php echo $vehicle_Result['fuel_capacity'] ?></span>
                         		</div>
                         		
                         		
                         		
                         			<div class="col-md-12 nopad-lr icon-box11"> 
                         		 <div class="icon"><img src="../images/Tower_signal_symbol_24.png" alt=""></div>
                                 <span> &nbsp; <?php if($vehicle_Result['tranmision']==1){echo "Manual"; } else { echo "Auto"; } ?> الإرسال</span>
                         		</div>
                    
                        </ul>
                     </div>
                     
                     <div class="col-md-6 details" style="padding-right: 31px;text-align: right;direction: rtl;">
                        <h1 class="heading" style="margin-top:0">تفاصيل السيارة</h1>
                        <p class="specifications">النوع : <span class="engine-type"><?php echo $vehicle->get_arabic_Type($vehicle_Result['vt_id']);?></span> </p>
                        <p class="specifications">المحرك : <span class="engine-type"><?php echo $vehicle_Result['engine'];?></span>  </p>
                        <p class="specifications">مشروط السنة : <span class="engine-type"><?php echo $vehicle_Result['model'];?></span>  </p>
                        <ul class="list-inline boking-li" style="padding:0;">
                           <li>
                              <span class="box-icon"><img src="../images/airbag.png" alt=""></span> 
                              <span class="box-icon"><img src="../images/anti-brake.png" alt=""></span>
                              <span class="box-icon"><img src="../images/cruse-control.png" alt=""></span>
                           </li>
                           <br>
                           <li style="padding-top:0;  margin-top: -4px;">
                              <?php 
                                 if ($vehicle_Result['airbags']==1) {?>
                              <span class="box-icon opt-icon"><img src="../images/check.png" alt=""></span>
                              <?php
                                 }
                                 else
                                 {?>
                              <span class="box-icon opt-icon"><img src="../images/cross.png" alt=""></span> 
                              <?php
                                 }
                                 ?>
                              <?php 
                                 if ($vehicle_Result['anti_brake']==1) {?>
                              <span class="box-icon opt-icon"><img src="../images/check.png" alt=""></span>
                              <?php
                                 }
                                 else
                                 {?>
                              <span class="box-icon opt-icon"><img src="../images/cross.png" alt=""></span> 
                              <?php
                                 }
                                 ?>
                              <?php 
                                 if ($vehicle_Result['cruise_control']==1) {?>
                              <span class="box-icon opt-icon"><img src="../images/check.png" alt=""></span>
                              <?php
                                 }
                                 else
                                 {?>
                              <span class="box-icon opt-icon"><img src="../images/cross.png" alt=""></span> 
                              <?php
                                 }
                                 ?>                                    
                           </li>
                        </ul>
                     </div>
                  </div>
                  
                  	   <div class="col-md-4 vehicle-img">
                     <img src="../images/admin_images/vehicle_images/<?php echo $vehicle_Result['img_url'];?>"  style="float:right;  position: relative;top: 30px;height: 136px;" alt="">
               	<div class="clearfix"></div>
                  </div>
                  
                  
                  
                  <div class="clearfix"></div>
               </div>
            </div>







 
                    
                    
                    
                    
                    
                    

                    <div class="claerfix"></div>


                    <div class="col-md-12 customer-details" style="margin-top:20px">
                            <h4 class="section-heading" style="direction:rtl;padding-right:15px">تفاصيل العميل </h4>
                            <div class="claerfix"></div>

                            </ul>

                         <table class="table custm-table" style="margin-bottom:0">

                            <tbody>
                              <tr class="" >
                               
                                <td style="border-top:none;text-align:left; direction rtl"><?php echo $profile['fname'] . ' ' . $profile['lname']; ?></td>
                                 <td style="border-top:none;font-weight: bold;direction: rtl;text-align: right; text-align:right ">اسم الزبون :</td>
                              </tr>

                                <tr class="">
                           
                                    <td style="text-align:left; direction rtl" ><?php echo $profile['country']; ?></td>
                                     <td style=" font-weight: bold;    direction: rtl; text-align:right ">البلد:</td>
                                     
                              </tr>

                                <tr class="">
                                
                                <td  style="text-align:left; direction rtl" width=""><?php echo $profile['address']; ?></td>
                                <td style="  font-weight: bold; direction: rtl; text-align:right ">العنوان:</td>
                                
                              </tr>
                             
                            
                            </tbody>
                          </table>





                            <div class="claerfix"></div>
                    </div>
                    <div class="claerfix"></div>
                        
					
					
			 <div class="col-md-12 terms" style="text-align: right; direction: rtl; padding-top: 0;  margin-top: 25px;border: 1px solid rgb(204, 204, 204);">
               <h4 style="margin-top: 0;" class="section-heading">شروط الحجز</h4>
               <div class="desc" style="padding-left:15px;padding-right:15px;padding-bottom:15px"><?php echo $vehicle_Result['ar_terms_condition']; ?></div>
            </div>

                         

                    <div class="clearfix"></div>

                </div>
                <div class="col-md-4 right">
                    <div class="rightsidebar">
                        <h1 class="heading">حجز تفاصيل</h1>
                        <div class="pickup-time">
                            <h4 class="sub-heading">تلقي وقت</h4>
                            <p class="timing"><span class="day"> <?php echo $_SESSION['pd']; ?> </span></p>
                        </div>
                        <div class="dropoff-time">
                            <h4 class="sub-heading">الوصول وقت</h4>
                            <p class="timing"><span class="day">  <?php echo $_SESSION['dd']; ?>  </span></span></p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pickup-location">
                        <div class="section-heading">
                            <h4 class="section-title">موقع التلقي</h4>
                        </div>
                        
                            <div class="icon">
                                <i class="icon-map-marker"></i>
                            </div>
                            <div class="address">
                                <p class="address-detail"><?php echo $city1['ar_name']; ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>



                            <div class="pickup-location">
                        <div class="section-heading">
                            <h4 class="section-title">وصول إلى الموقع</h4>
                        </div>
                        
                            <div class="icon">
                                <i class="icon-map-marker"></i>
                            </div>
                            <div class="address">
                                <p class="address-detail"><?php echo $city2['ar_name']; ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                     <div class="section-heading">
                            <h4 class="section-title">إيجار سيارة</h4>
                        </div>
                        
                        <div class="more-option" style="  padding: 5px 0; padding-right: 0px;">


                          <div class="extra-option rent-box">
                            <span class="text">استئجار لكل يوم</span>
                            <span class="figure"><span><?php echo $country['currency']; ?></span> <?php echo $booking['per_day_cost']?></span>
                            <div class="clearfix"></div>
                         </div>

                           <div class="extra-option rent-box">
                            <span class="text">عدد الأيام</span>
                            <span class="figure"><?php echo $booking['days']?></span>
                            <div class="clearfix"></div>
                         </div>

                           <div class="extra-option rent-box" style="  padding-top: 8px !important; border-top: 1px solid rgb(215, 215, 215);">
                            <span class="text" style="  font-weight: bold;">إجمالي إيجار سيارة</span>
                            <span class="figure" style="  font-weight: bold;"><span> <?php echo $country['currency']; ?></span> <?php echo $booking['per_day_cost'] * $booking['days']?></span>
                            <div class="clearfix"></div>
                         </div>


                            <div class="cleafix"></div>
                        </div>




















                        <div class="section-heading extra-option">
                            <h4 class="section-title">خيارات اضافية اضاف</h4>
                        </div>
                        <div class="more-option more-option2">
                                <?php 
                            if ($booking['driver']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>السائق (<?php echo $booking['driver_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>                                        
                            <?php 
                            }
                            if ($booking['gps']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>نظام تحديد المواقع العالمي (<?php echo $booking['gps_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>
                            <?php 
                            }
                            if ($booking['bs']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>طفل مقعد (<?php echo $booking['bs_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>
                                                            <?php 
                            }
                            if ($booking['cdw']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>الاصطدام الضرر التنازل (<?php echo $booking['cdw_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>

                            <?php 
                            }
                            if ($booking['pai']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>تأمين الحوادث الشخصية (<?php echo $booking['pai_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>
                            <?php 
                            }
                            if ($booking['hiring']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>تسليم على أجور تأجير (<?php echo $booking['hc_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>
                            <?php 
                            }
                            if ($booking['insurance']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>تكلفة التأمين (<?php echo $booking['ic_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>
                            <?php 
                            }
                            if ($booking['off_insurance']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>من تأمين الطريق التكلفة (<?php echo $booking['oic_cost']?> <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                            </div>
                            <?php 
                            }
                            if ($booking['ekm']==1) {?>
                                <div class="block">
                                <div class="col-md-9 nopad-lr"><p>اضافية تكلفة الكيلومتر (<?php echo $booking['ekmc_cost']?>  <?php echo $country['currency']; ?>)</p></div><div class="col-md-3"><i class="fa fa-check pull-right"></i></div>
                                <div class="clearfix"></div>
                                </div>
                            <?php 
                            }


                        ?>
                            
                            

                            
                            

                            

                            

                            

                             

                            
                            


                        </div>
                        <div class="clearfix"></div> 
                        <div class="section-heading tot-payment"> 
                            <span class="grand-total"><?php if($_SESSION['gateway']=="Manual") { echo "المبلغ المستحق"; }  else { echo "مجموع المبلغ المدفوع" ; } ?> :</span>
                              
                            <span class="numbers"><?php echo $country['currency']; ?> <?php echo $booking['total']; ?> </span> <br />
                            <!--<span class="numbers" style="width: 91%;padding-top: 0px" > <?php echo  ' = USD ' .  $booking['usd_total']; ?> </span>-->
                        </div>
                        <div class="clearfix"></div>
                           
                </div>
                <div class="clearfix"></div>

            </div>
        </section>





    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>
</body>
</html>
