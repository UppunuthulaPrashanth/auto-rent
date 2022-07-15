<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
   require '../lib/config/config.php';
   
   require '../lib/config/autoload.php';
   
   
   
   error_reporting(E_ALL);
   
   
   
   $user = userdb::getInstance();
   
   $vehicle = vehical::getInstance();
   $part = partnerdb::getInstance();
   $options = options::getInstance();
   $location= new dbcountrylocation;
   $deal = dealdb::getInstance();//update
   
   $uid = $user->getUseerIDfromSession();
   $profile = $user->fetch_profile($uid);
   
   $types = $vehicle->getVehicalTypes();
   
   $makes = $vehicle->getVehicles_arabic_makes();
   
   $cid='';
    if(isset($_SESSION['selected_country']))
    {
        $selected_country=$location->fetch_Countrybyname($_SESSION['selected_country']);
        $cid=$selected_country['id'];
    }
    else
    {
        $selected_country=$location->fetch_Countrybyname("UAE");//update
        $cid=5;
    }
   
   if ($_POST) {
   
   
   
    $loc_name = $_POST['country'];
       $check=$location->check_location_by_arabicname($loc_name);
       if ($check) {
          $Pickup_location=$location->fetch_locationby_arabicname($loc_name);
       }
   
    $city2 = $_POST['city'];
   
    $pd = $_POST['pd'];
   
    $dd = $_POST['dd'];
    $diff_result=$options->dateDiff($pd,$dd);
    
    $diff=0;
    if($diff_result[0]>0)
    {
        $diff=$diff + $diff_result[0]*365;
    }
    if($diff_result[1]>0)
    {
        $diff=$diff + $diff_result[1]*30;
    }
    if($diff_result[2]>0)
    {
        $diff= $diff + $diff_result[2];
    }
    if($diff_result[3]>0 || $diff_result[4]>0)
    {
        $diff=$diff+1;
    }
   
    $_SESSION['pd'] = $pd;
   
    $_SESSION['dd'] = $dd;
   
    $_SESSION['country'] = $Pickup_location['cid'];
   
    $_SESSION['city1'] = $Pickup_location['id'];
    
    if($diff==0)
    {
        $_SESSION['days'] = 1;
    }
    else
    {
        $_SESSION['days'] = $diff;
    }
   
    if ($city2 != "") {
   
           $check=$location->check_location_by_arabicname($city2);
           if ($check) {
              $drop_location=$location->fetch_locationby_arabicname($city2);
           }
        $_SESSION['city2'] = $drop_location['id'];
   
    } else {
   
        $_SESSION['city2'] = $Pickup_location['id'];
   
    }
    if (isset($_POST['catetype'])) {
   
        $catetype = $_POST['catetype'];
   
        $_SESSION['catetype'] = $catetype;
   
        $result = $vehicle->getVehicalesCountriesByCId($_SESSION['country']);
   
   
   
        foreach ($result as $row) {
   
            $typeResult = $vehicle->getvehicle($row['v_id']);
   
            if ($catetype == 0) {
   
                $ids[] = $row['v_id'];
   
            } elseif ($typeResult['vt_id'] == $catetype) {
   
                $ids[] = $row['v_id'];
   
            }
   
        }
   
   
   
    } else {
   
        $result = $vehicle->getVehicalesCountriesByCId($_SESSION['country']);
   
        foreach ($result as $row) {
   
            $ids[] = $row['v_id'];
   
        }
   
    }
   
   
   
    if (!empty($ids)) {
   
        $id = implode(",", $ids);
   
        
   
        $vehicle_results = $vehicle->vehicles_sorted_bytariff($id,$diff,$profile['ref']);
        // $vehicle_results = $vehicle->getVehiclesById2($id);
   
           $country = $location->fetch_Country($_SESSION['country']);
   
    }
       else
       {
           $vehicle_results= array();
       }
   
   
   
   } else {
   
       header('Location:index.php');
   }
   
   if(empty($_SESSION['country']) || empty($_SESSION['pd']) || empty($_SESSION['dd']) || empty($_SESSION['city1']) || empty($_SESSION['city2']) || empty($_SESSION['days']))
   {
        header('Location:index.php');
        exit();
   }
   
   ?>
<!DOCTYPE html>
<html class="no-js">
<style>

.action2 {
  position: relative !important;
   background-color: #fff!important;
}
.action2 .feature-tab {
  position: absolute !important;
  right: 0 !important;
}
.action2 span {
  position: absolute !important;
  top: 6px !important;
}


select{
    padding-right: 28px!important;
}
</style>
   <?php include 'header.php'; ?>
   <?php echo $head; ?>
   <body>
      <!-- ==========================================================================
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
                 <div class="col-md-11 text"><h1 class="tagline pull-right"><span> اختر سيارتك</span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    
                
                  
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </section>
      <!-- ==========================================================================
         main-section
         
         ========================================================================== -->
         <div id="loader"></div>
      <section id="search-vehicle">
         <div class="container">
           
            <!-- .................................  right ............................... -->
            <div class="col-md-9 nopad-lr">
             <div class="col-md-4 pull-right">
               <select name="sort_filter" class="searchby" id="sort_filter">
                  <option value="0">السعر (من الأقل إلى الأعلى)</option>
                  <option value="1">السعر (من الأعلى إلى الأقل)</option>
               </select>
            </div>
            
            <div class="col-md-4 pull-right">
               <select name="records-type" class="searchby" id="records_type">
                  <option value="0">جميع المركبات</option>
                  <option value="1">عروض سيارات</option>
               </select>
            </div>
            </div>
            
            <div class="col-md-9 right" id="vahicles">
               <?php 
                  $delete_check=$vehicle->delete_filter_vehicles();
                  
                     foreach($vehicle_results as $v)
                     {
                                 if ($profile['ref'] != "") {
                                     $partner = $part->fetchbyusername($profile['ref']);
                                     $check=$vehicle->sale_tariff_check($v['id'],$country['id'],$partner['id']);
                                     $perday_price= '0.00';
                                     if ($check > 0) {
                                         if($diff>29)
                     
                                         {
                     
                                             $tariff_result=$vehicle->sale_monthly_tariff($v['id'],$country['id'],$partner['id']);
                                             $perday_price=$tariff_result['rent'] / 30;
                     
                                         }
                     
                                         elseif($diff>6)
                     
                                         {
                     
                                             $tariff_result=$vehicle->sale_weekly_tariff($v['id'],$country['id'],$partner['id']);
                                             $perday_price=$tariff_result['rent'] / 7;
                                         }
                     
                                         else{
                     
                                             $tariff_result=$vehicle->sale_daily_tariff($v['id'],$country['id'],$partner['id']);
                                             $perday_price=$tariff_result['rent'];
                     
                     
                     
                                         }
                                     }
                                     else
                                     {
                                     	$check=$vehicle->check_vehicle_tariff($v['id'],$country['id']);
                                      $perday_price= '0.00';
                                      if ($check > 0) {
                                          if($diff>29)
                      
                                          {
                      
                                              $tariff_result=$vehicle->vehical_monthly_tariff($v['id'],$country['id']);
                                              $perday_price=$tariff_result['rent'] / 30;
                      
                                          }
                      
                                          elseif($diff>6)
                      
                                          {
                      
                                              $tariff_result=$vehicle->vehical_weekly_tariff($v['id'],$country['id']);
                                              $perday_price=$tariff_result['rent'] / 7;
                                          }
                      
                                          else{
                      
                                              $tariff_result=$vehicle->vehical_daily_tariff($v['id'],$country['id']);
                                              $perday_price=$tariff_result['rent'];
                      
                      
                      
                                          }
                                      }
                                     }                   
                                 }
                                 else
                                 {
                                     $check=$vehicle->check_vehicle_tariff($v['id'],$country['id']);
                                     $perday_price= '0.00';
                                     if ($check > 0) {
                                         if($diff>29)
                     
                                         {
                     
                                             $tariff_result=$vehicle->vehical_monthly_tariff($v['id'],$country['id']);
                                             $perday_price=$tariff_result['rent'] / 30;
                     
                                         }
                     
                                         elseif($diff>6)
                     
                                         {
                     
                                             $tariff_result=$vehicle->vehical_weekly_tariff($v['id'],$country['id']);
                                             $perday_price=$tariff_result['rent'] / 7;
                                         }
                     
                                         else{
                     
                                             $tariff_result=$vehicle->vehical_daily_tariff($v['id'],$country['id']);
                                             $perday_price=$tariff_result['rent'];
                     
                     
                     
                                         }
                                     }
                                 }
                                 

                     
                                 if ($perday_price>0) {
                                    
                                 if($v['tranmision']==1)
                                 {
                                    $transmission= "Manual"; 
                                 }
                                 else
                                 {
                                    $transmission= "Auto"; 
                                 }
                                 $type = $vehicle->get_arabic_Type($v['vt_id']);
                                 $deal_price=0;
                                 $sorting_price=$perday_price;
                                 $vid=$v['id'];
                                 $coupon='';
                                 
                                 
                                $insert_check=$vehicle->filter_vehicles($v['ar_name'], $v['passenger'], $v['luggage'], $v['door'], $v['fuel_capacity'], $transmission, $type,$v['engine'], $v['model'], $v['airbags'], $v['anti_brake'],$v['cruise_control'], $perday_price, $deal_price, $sorting_price, $country['currency'],$vid,$coupon, $v['img_url']);              
                                    
                                    $deal_ids=$deal->fetch_vehicles_deals($v['id'],$country['id']);
                                    if(!empty($deal_ids))
                                    {
                                        foreach($deal_ids as $did){
                                            $check=$deal->deal_existance($did['did'],$_SESSION['pd'],$_SESSION['dd']);
                                            if($check)
                                            {
                                                $deal_result=$deal->getdeal($did['did']);
                                                if($deal_result['search_page'])
                                                {
                                                    if(!empty($deal_result['fixed_price']))
                                                        {
                                                            $perday_deal_price=$deal->fetch_fix_deal_price($did['did'],$v['id']);
                                                    
                                                        }
                                                        else if(!empty($deal_result['discount_price']))
                                                        {
                                                            
                                                            $percentage = $deal_result['discount_price'];
                                                            $totalWidth = $perday_price;
                                                            
                                                            $discount = ($percentage / 100) * $totalWidth;
                                                            $perday_deal_price=$perday_price-$discount;
                                                        }
                                                        
                                                        $coupon=$deal_result['coupon'];
                                                 if($perday_deal_price)
                                                {       
                                                $insert_check=$vehicle->filter_vehicles($v['ar_name'], $v['passenger'], $v['luggage'], $v['door'], $v['fuel_capacity'], $transmission, $type,$v['engine'], $v['model'], $v['airbags'], $v['anti_brake'],$v['cruise_control'], $perday_price, $perday_deal_price, $perday_deal_price, $country['currency'],$vid,$coupon,$v['img_url']);
                                                }
                                                }
                                                        
                                            }
  
                                        }
                                    }
                                         

               
                  }
              }
              
              
              $vehicle_results=$vehicle->fetch_filter_vehicles();
              $best_check=0; 
              foreach($vehicle_results as $v)
              {?>
                                   <!-- vehicle -->
               <div class="col-md-12 vehicle">
                  <div class="col-md-3 vehicle-img">
                     <div class="img-box">
                        <img src="../images/admin_images/vehicle_images/<?php echo $v['img'];?>" alt="">
                        <div class="vehicle-name">
                           <h4><?php echo $v['vname']; ?></h4>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="col-md-6 vehicle-details">
                     <div class="col-md-6">
                        <ul class="list-unstyled">
                           <li>
                              <div class="icon"><img src="../images/Masculine_Avatar_24.png" alt=""></div>
                              <span>حتى <?php echo $v['passengers']; ?> الركاب</span>
                           </li>
                           <li>
                              <div class="icon"><img src="../images/Travelling_luggage_24.png" alt=""></div>
                              <span><?php echo $v['luggage']; ?> قطعة من الأمتعة</span>
                           </li>
                           <li>
                              <div class="icon"><img src="../images/door.png" alt=""></div>
                              <span>حتى <?php echo $v['door']; ?> باب</span>
                           </li>
                           <li>
                              <div class="icon"><img src="../images/fuel-adj.png" alt=""></div>
                              <span>وقود Capacity <?php echo $v['capacity']; ?> </span>
                           </li>
                           <li>
                              <div class="icon"><img src="../images/Tower_signal_symbol_24.png" alt=""></div>
                              <span><?php echo $v['transmission']; ?> انتقال</span>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-6">
                        <ul class="list-unstyled">
                           <li>
                              <p>اكتب: <span><?php echo $v['type']; ?></span></p>
                           </li>
                           <li>
                              <p>المحرك: <span><?php echo $v['engine']; ?></span> </p>
                           </li>
                           
                           <?php 
                                if($v['model'])
                                {
                                    ?>
                                        <li>
                                          <p>نموذج عام: <span><?php echo $v['model']; ?></span></p>
                                       </li>
                                    <?php
                                }
                           ?>
                           
                           
                           <li>
                              <span class="box-icon"><img src="../images/airbag.png" alt=""></span> 
                              <span class="box-icon"><img src="../images/anti-brake.png" alt=""></span>
                              <span class="box-icon"><img src="../images/cruse-control.png" alt=""></span>
                           </li>
                           <li style="padding-top:0;  margin-top: -4px;">
                              <?php 
                                 if ($v['airbags']==1) {?>
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
                                 if ($v['anti_brake']==1) {?>
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
                                 if ($v['cruise_control']==1) {?>
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
                     <div class="clearfix"></div>
                  </div>
                  <div class="col-md-3 action">
                  
                  <?php 
                    if($v['deal_price'])
                    {?>
                        <div class="section-header action2" style="display: block;    background-color: #4D5D6F;">
                            <div class="feature-tab">
                               <i class="fa fa-star"  style="  position: relative;left: -12px;top: 10px;"></i>
                            </div>
                        </div>
                    <?php                        
                    }
                    
                    else
                    {
                        if(empty($best_check))
                        {
                            $best_check=1;
                            ?>

                                <div class="section-header " style="display: block;    background-color: #4D5D6F;">
                                    <div class="feature-tab">
                                       <i class="fa fa-star"  style="  position: relative;left: -12px;top: 10px;"></i>
                                    </div>
                                    <span>العرض الخاص</span>
                                </div>
                            <?php                        
                        }
                    }
                    ?>
                     

                     <div class="clearfix"></div>
                     <p class="currency-symbol"><?php echo $v['currency']; ?></p>
                     <p class="amount">
                     <?php 
                     if($v['deal_price'])
                     {?>
                     <strike><?php echo round($v['perday_price'],2); ?></strike>
                     <?php  
                     }
                     ?>
                     <?php echo round($v['sorting_price'],2); ?> <span> /day</span></p>
                     <div class="clearfix"></div>
                     <form method="post" action="car_booking.php">
                        <input type="hidden" name="carId" value=<?php echo $v['vid'];?> />
                        
                        <?php 
                            if($v['deal_price'])
                            {?>
                                <input type="hidden" name="coupon" value="<?php echo $v['coupon']; ?>">
                            <?php                        
                            }
                            ?>
                        
                        
                        <div class="btn-box"><button class="btn-book">كتاب الان</button></div>
                     </form>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="clearfix"></div>
              <?php  
              }
                        
                  
                  ?>
            </div>
            
            
            
            
            
            
            
            
             <div class="col-md-3 left">
               <form method="post" action="search.php" name="frmsearch" id="frmsearch">
                  <div class="box">
                     <div class="section-header">
                        <h1 class="section-title">تغيير عمليات البحث</h1>
                        <div class="clearfix"></div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12">
                        <label class="custom-label" for="car-type">نوع السيارة</label>
                        <select class="flat-select form-control" name="catetype" id="catetype">
                           <option value="0">كل الانواع</option>
                           <?php
                              foreach ($types as $type) {?>
                           <option value="<?php echo $type['id'];?>"><?php echo $type['ar_type'];?></option>
                           <?php
                              }
                              
                              ?>
                        </select>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12">
                     
                        <label class="custom-label"  for="pickup-date">اختر تاريخا :</label>
                        <input type="text" id="pd" class="pd" name="pd" value="<?php echo $_SESSION['pd']; ?>" required="">
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12">
                        <label class="custom-label" for="drop-date">غلبه النعاس التسجيل :</label>
                        <input type="text" id="dd" name="dd" value="<?php echo $_SESSION['dd']; ?>" required="">
                     </div>
                     <div class="clearfix"></div>
                     
                      <?php
                $result = $location->fetch_Country_all();
               
              
                  $loc = new dbcountrylocation;
                       $row['id'] = $cid; 
                        $result2 = $loc->fetch_Locations_ById($row['id']);
                        foreach ($result2 as $r) {
                          // $suggestions[] = 
                          $suggestions[] = $r['ar_name'];
                          $query = null;
                          $data[] = $r['id'];
                        }
                    

                  $response = array(
                      'query' => $query,
                      'suggestions' => $suggestions,
                      'data' => $data,
                  );

              ?>
              
                     <div class="col-md-12">
                        <label class="custom-label" for="car-type">اختر موقعا</label>
                        <input type="text" name="country" id="country" class="autocomplete" value="<?php echo $loc_name; ?>" placeholder="اختر موقعا"/>
                     </div>
                     <div class="col-md-12">
                        <label class="custom-label" for="car-type">غلبه النعاس الموقع</label>
                        <input type="text" name="city" id="city" class="autocomplete" value="<?php echo $city2; ?>" placeholder="غلبه النعاس الموقع"/>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12 text-center">
                        <input class="search-btn2" type="submit" name="submit" class="btn-search" id="search2" value="بحث">
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </form>
               <div class="clearfix"></div>
               <div class="box">
                  <div class="section-header">
                     <h1 class="section-title">تصفية حسب</h1>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12">
                     <div style="padding: 10px 0;">
                        <label  class="custom-label" for="car-type">السعر</label>
                        <input class="bg-success" type="text" id="price" value="" name="range" />
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12">
                     <label  class="custom-label" for="car-type">نوع السيارة</label>
                     <select class="flat-select form-control" name="type" id="type">
                        <option value="0">كل الانواع</option>
                        <?php
                           foreach ($types as $type) {?>
                        <option value="<?php echo $type['id'];?>"><?php echo $type['ar_type'];?></option>
                        <?php
                           }
                           
       
                           ?>
                     </select>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12">
                     <label  class="custom-label" for="car-type">السيارة جعل</label>
                     <select class="flat-select form-control" name="make" id="make">
                        <option value="0">كافة الماركات</option>
                        <?php
                           foreach ($makes as $make) {?>
                        <option value="<?php echo $make['ar_make'];?>"><?php echo $make['ar_make'];?></option>
                        <?php
                           }
                           
                           ?>
                     </select>
                  </div>
                  
                  <div class="col-md-12">
                     <label  class="custom-label" for="car-model">المركبة الموديل</label>
                 <select name="yearpicker" id="model">
                 <option value="0">اختر الموديل</option>
                 
                 </select>
                  </div>

                  
                  
                  <input type="hidden" id="diff" value="<?php echo $diff; ?>">
                  <div class="clearfix"></div>
                  <div class="col-md-12 booking-options">
                     <label  class="custom-label" for="car-type">خيارات الحجز</label>
                     <ul class="list-unstyled options">
                        <li>
                           <input class="square-checkbox" tabindex="1" type="checkbox" id="input-1" value="1">
                           <label class="checkbox-label" for="input-1">وسائد هوائية</label> 
                        </li>
                        <li>
                           <input class="square-checkbox" tabindex="1" type="checkbox" id="input-2"  value="2">
                           <label class="checkbox-label" for="input-2">اتوماتيك</label> 
                        </li>
                        <li>
                           <input class="square-checkbox" tabindex="1" type="checkbox" id="input-3"  value="3">
                           <label class="checkbox-label" for="input-3">مكافحة الفرامل</label> 
                        </li>
                        <li>
                           <input class="square-checkbox" tabindex="1" type="checkbox" id="input-4"  value="4">
                           <label class="checkbox-label" for="input-4">مثبت سرعه</label> 
                        </li>
                        <li>
                           <input class="square-checkbox" tabindex="1" type="checkbox" id="input-5"  value="5">
                           <label class="checkbox-label" for="input-5">دفع رباعي</label> 
                        </li>
                     </ul>
                  </div>
                  <div class="clearfix"></div>
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
      <script type="text/javascript">
         $(document).ready(function() {
             $('#popup').hide();
         
             $( "#login" ).click(function()
             {
             $('#popup').show();
             });
         
         
             $('#loginCMS').click(function()
                 {
                  $("#loader").addClass('preloader');
         
                   var user_email = $('#email').val();
                   var user_password = $('#password').val();
                   var user_type = $('#usertype').val();
                   var remember = "no";
                   var isChecked = $('#remember:checked').val()?true:false;
         
                   if(isChecked)
                   {
                     remember = "yes";
                   }
         
                   if(user_email =="" || user_password == "" || user_type == "")
                   {
                     $('.errorLogin').html("الرجاء إدخال جميع الحقول المطلوبة.");
                   }
                   else
                   {
                     if(user_type=='1')
                     {
                       $.ajax({
                       url: '../include/user_login.php',
                       type: 'POST',
                       data:
                       {
                         email: user_email,
                         password: user_password,
                         remember: remember,
                         location: "dashboard.php"
                       },
                       success: function(data)
                       {
         
                         if(data == "1")
                         {
                         $('.errorLogin').html("المستخدم ليس موجود");
                         }
                         else if(data == "2")
                         {
                         $('.errorLogin').html("البريد الإلكتروني أو كلمة المرور غير متطابقة.");
                         }
                         else if(data="yes")
                         {
                         //setTimeout(function() { window.location.href = "index.php"; }, 1000 );
                         window.location.href = "index.php";
                         }
                       }
                       });
                     }
                     else if(user_type=='2')
                     {
                       $.ajax({
                       url: '../partner/include/partner_login.php',
                       type: 'POST',
                       data:
                       {
                         email: user_email,
                         password: user_password,
                         remember: remember,
                         location: "dashboard.php"
                       },
                       success: function(data)
                       {
         
                         if(data == "1")
                         {
                         $('.errorLogin').html("لم يتم العثور على الشريك");
                         }
                         else if(data == "2")
                         {
                         $('.errorLogin').html("كلمة السر غير متطابقة.");
                         }
                         else if(data="yes")
                         {
                         //setTimeout(function() { window.location.href = "index.php"; }, 1000 );
                         window.location.href = "../partner/Partnerpanel.php";
                         }
                         $("#loader").removeClass('preloader');
                       }
                       });
                     }
                   }
                  
                 return false;
                 });
         
             $("#price").ionRangeSlider({
                   type: "double",
                   grid: true,
                   min: 0,
                   max: 10000,
                   prefix: ""
               });
         
         
             $('.booking-options .square-checkbox').on('ifChanged', function(event){
              $("#loader").addClass('preloader');
                  var allVals = [];
         
         			var sort=$('#sort_filter').val();
                    var records_type=$('#records_type').val();
                    
                  var type = $('#type').val();
                  var make = $('#make').val();
                  var model = $('#model').val();
                  var diff = $('#diff').val();
                  $('input.square-checkbox:checked').each(function()
                     {
                       allVals.push($(this).val());
                     });
         
                        from = $('#price').data("from"),
                       to = $('#price').data("to");
         
                       $.ajax({
                       url: '../include/arabic_filters.php',
                       type: 'POST',
                       data:
                       {
                         sort: sort,
                         records_type: records_type,
                         type: type,
                         make: make,
                         model: model,
                         diff: diff,
                         from: from,
                         to: to,
                         features: allVals
                       },
                       success: function(data)
                       {
                         $('#vahicles').html(data);
                         $("#loader").removeClass('preloader');
                       }
                     });
                 });
         
               $('#search2').click(function() {
                 $('#frmsearch').submit();
               });
               $("#country").change(function(){
                $("#loader").addClass('preloader');
               var location = $("#country").val();
               var ind = location.indexOf(",");
         
               var cid = location.substr(0, ind);
               $.ajax({
                 type:"post",
                 url:"city.php",
                 data:{cid:cid},
                 success:function(response)
                 {
                 $("#city").html(response);
                 $("#loader").removeClass('preloader');
                 }
               });
             });
         
               
               $('#type,#price,#make,#model,#sort_filter,#records_type').change(function() {
                $("#loader").addClass('preloader');
                 
                 
                 var sort=$('#sort_filter').val();
                 var records_type=$('#records_type').val();
                   var type = $('#type').val();
                  var make = $('#make').val();
                  var model = $('#model').val();
                  var diff = $('#diff').val();
                   var allVals = [];
                   $('input.square-checkbox:checked').each(function()
                     {
                       allVals.push($(this).val());
                     });
         
                   from = $('#price').data("from"),
                   to = $('#price').data("to");
         
                   $.ajax({
                   url: '../include/arabic_filters.php',
                   type: 'POST',
                   data:
                   {
                     sort: sort,
                     records_type: records_type,
                     type: type,
                     make: make,
                     model: model,
                     diff: diff,
                     from: from,
                     to: to,
                     features: allVals
                   },
                   success: function(data)
                   {
                     $('#vahicles').html(data);
                     $("#loader").removeClass('preloader');
                   }
                 });
               });
         
         });
             
             
         
         
         
         
         
      </script>
            <script type="text/javascript">




      var countries = [];
    


countries.push(<?php

                      for($a=0; $a<count($response['suggestions']); $a++)
                      {
                        if($a<count($response['suggestions'])-1)
                        {

                          echo '{value: "'.$response['suggestions'][$a].'"},';
                        }
                        else
                        {
                          echo '{value: "'.$response['suggestions'][$a].'"}';
                        }
                      }
 
                    ?>);
                    console.log(countries);

                $(document).ready(function(){
                    $('.autocomplete').autocomplete({ 
                          lookup: countries,
                          minChars: 0,
                        // callback function:
                         onSelect: function (suggestion) {
                        // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    }
                    }); 
                });
     </script>
   </body>
</html>