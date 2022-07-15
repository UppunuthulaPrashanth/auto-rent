<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
//Change Currency Unit According To Country

error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$uid = $user->getUseerIDfromSession();
$part = partnerdb::getInstance();
$profile = $user->fetch_profile($uid);
$vehicle = vehical::getInstance();
$location= new dbcountrylocation;
$makes = $vehicle->getVehicles_arabic_makes();
$types = $vehicle->getVehicalTypes();
$countries = $location->fetch_Country_all();
//$vehicles = $vehicle->getVehicles();


$cid='';
if(isset($_SESSION['selected_country']))
{
    $default_country=$location->fetch_Countrybyname($_SESSION['selected_country']);
}
else
{
    $default_country=$location->fetch_Country(5);
}
$country_id=$default_country['id'];

//$default_country=$location->fetch_first_country();

$result = $vehicle->getVehicalesCountriesByCId($default_country['id']);



foreach ($result as $row) {
   
            $ids[] = $row['v_id'];
   
        }
        
        if (!empty($ids)) {
   
        $id = implode(",", $ids);
   
        
   
        //$vehicles = $vehicle->vehicles_sorted_bytariff($id,$diff,$profile['ref']);
        $vehicles = $vehicle->getVehiclesById2($id);
  
    }
 ?>

 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>دليل الأسطول

</title>

<script>
$(document).ready(function(){
  $(".vehicle-list").click(function(){
    $(".vehicle-menu").toggleClass("showMenu");
      $(".vehicle-menu > li").click(function(){
        $(".vehicle-list > p").text($(this).text());
        $(".vehicle-menu").removeClass("showMenu");
      });
  });
});

$(document).ready(function(){
  $(".type").click(function(){
    $(".type-menu").toggleClass("showMenu");
      $(".type-menu > li").click(function(){
        $(".type-list > p").text($(this).text());
        $(".type-menu").removeClass("showMenu");
      });
  });
});

$(document).ready(function(){
  $(".country").click(function(){
    $(".country-menu").toggleClass("showMenu");
      $(".country-menu > li").click(function(){
        $(".country-list > p").text($(this).text());
        $(".country-menu").removeClass("showMenu");
      });
  });
});
</script>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<style>.bfh-selectbox-options{
    width:100%;
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
    
    
<div class="modal signup-model forgetpass-model fade" id="details_model" tabindex="-1" role="dialog" aria-labelledby="details_model" aria-hidden="true">
   <div class="modal-dialog" style="width: 50%;">
     <div class="modal-content">
       <div class="modal-header">
         <a class="close-reveal-modal close" aria-label="Close" data-dismiss="modal" aria-hidden="true">×</a>
       
         <h4 class="modal-title" id="myModalLabel">Choose Location</h4>
       </div>
       <div class="modal-body">
            <form method="post" action="../include/arabic_reserve.php" id="rentel-form" name="carsearch" >
            <div class="col-md-12 error-box"> <p id="rent_error"></p><span class="close-it">X</span></div>
            
                <input type="hidden" id="vid" name="vid" value="" />
			     <div class="col-md-12"  data-wow-duration="2s">
                    <div class="col-md-12">
                        <div class="col-md-6 nopad-r">
                            <input type="text" id="pd" class="pd" name="pd" required placeholder="Pick-up Time">
                        </div>
                        
                    <div class="col-md-6 nopad-r ">
                        <input type="text" id="dd" class="dd"  name="dd" required placeholder="Drop-off Time">
                    </div>
                    
                    <?php                  
                  
                      $loc = new dbcountrylocation;
                           $row['id'] = $country_id; 
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
               </div>
               
               <div class="col-md-12">
               
                   <div class="col-md-6 nopad-r ">
                        <input type="text" name="city1" id="country" class="autocomplete" required value="" placeholder="Pick-up Location"/>
                   </div>
                   
                    <div class="col-md-6 nopad-r ">
                        <input type="text" name="city2" id="country" class="autocomplete" placeholder="Pick-up Location"/>
                   </div>
                   
                </div>
                
                <div class="col-md-4 vehicle-make" >
                    <input type="hidden" id="guide_country" name="country" value="<?php echo $country_id; ?>" />
              </div>
                
                
                <div class="col-md-6 text-center ">
                        <input type="submit" value="Process" class="rentel-process" class="main-btn" />
                </div>
             </div>
     </form>
      <div class="clearfix"></div>
   </div>
 </div>
 <div class="clearfix"></div> 
 
    </div>
 </div>
 
        <div class="clearfix"></div>
         <div class="search-cover">
            <div class="container">
                <div class="row">
                <div class="col-md-11 text"><h1 class="tagline pull-right"><span>دليل الأسطول</span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <!-- 
                                        Location Section
    ========================================================================== -->
    <section id="felter" style="padding-bottom: 0px;">
        <div class="container">
            <div class="col-md-12 feltr-header nopad-lr">
            
            
            
            
            
            
                <div class="col-md-4 vehicle-make">
                  <select class="selectmenu" id="guide_make">
                  <option value="0">جعل جميع المركبات</option>
                  <?php 
                    foreach($makes as $make)
                    {?>
                        <option value="<?php echo $make['ar_make'];?>"><?php echo $make['ar_make'];?></option>
                    <?php    
                    }
                  ?>
                            
                 </select>
              </div>
            
               
            
              
                <div class="col-md-4 vehicle-make" >
                  <select class="selectmenu" id="guide_type">
                    <option value="0">كل نوع المركبة</option>
                    <?php 
                    foreach($types as $type)
                    {?>
                        <option value="<?php echo $type['id'];?>"><?php echo $type['ar_type'];?></option>
                    <?php    
                    }
                  ?>
                           
                 </select>
              </div>

            
          
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>

    <section id="vehicle-info" style="padding-top: 20px;">
        <div class="container">
            <div class="col-md-12">
<?php 
if(!empty($vehicles))
{
    foreach($vehicles as $veh)
    {
      $perday_price= '0.00';
$weekly_price= '0.00';
$monthly_price= '0.00';
                            if ($profile['ref'] != "") {
                                     $partner = $part->fetchbyusername($profile['ref']);
                                     $check=$vehicle->sale_tariff_check($veh['id'],$default_country['id'],$partner['id']);
                                     
                                     if ($check > 0) {
   
                                             $tariff_monthly_result=$vehicle->sale_monthly_tariff($veh['id'],$default_country['id'],$partner['id']);
                                             $monthly_price=$tariff_monthly_result['rent'];
                     
                                             $tariff_weekly_result=$vehicle->sale_weekly_tariff($veh['id'],$default_country['id'],$partner['id']);
                                             $weekly_price=$tariff_weekly_result['rent'];
          
                                             $tariff_daily_result=$vehicle->sale_daily_tariff($veh['id'],$default_country['id'],$partner['id']);
                                             $perday_price=$tariff_daily_result['rent'];

                                     }
                                     else
                                     {
                                        $check=$vehicle->check_vehicle_tariff($veh['id'],$default_country['id']);
                                        if ($check > 0)
                                        {
                                            $tariff_monthly_result=$vehicle->vehical_monthly_tariff($veh['id'],$default_country['id']);
                                            $monthly_price=$tariff_monthly_result['rent'];
                     
                                            $tariff_weekly_result=$vehicle->vehical_weekly_tariff($veh['id'],$default_country['id']);
                                            $weekly_price=$tariff_weekly_result['rent'];
          
                                            $tariff_daily_result=$vehicle->vehical_daily_tariff($veh['id'],$default_country['id']);
                                            $perday_price=$tariff_daily_result['rent'];
                                            
                                        }
                                        
                                        
                                             
                                      
                                     }                   
                                 }
                                 else
                                 {
                                     $check=$vehicle->check_vehicle_tariff($veh['id'],$default_country['id']);
                                        if ($check > 0)
                                        {
                                            $tariff_monthly_result=$vehicle->vehical_monthly_tariff($veh['id'],$default_country['id']);
                                            $monthly_price=$tariff_monthly_result['rent'];
                     
                                            $tariff_weekly_result=$vehicle->vehical_weekly_tariff($veh['id'],$default_country['id']);
                                            $weekly_price=$tariff_weekly_result['rent'];
          
                                            $tariff_daily_result=$vehicle->vehical_daily_tariff($veh['id'],$default_country['id']);
                                            $perday_price=$tariff_daily_result['rent'];
                                            
                                        }
                                 }  
        if($perday_price>0 && $weekly_price>0 && $monthly_price>0)
        {
        ?>
        <div class="vehicle">
                    <div class="col-md-3 left nopad-lr" style="background-color: white;height: 197px;">
                    <h4 class="vehicle-name"><?php echo $veh['ar_name']; ?></h4>
                        <div class="img-box">
                            <img src="../images/admin_images/vehicle_images/<?php echo $veh['img_url']; ?>" alt="" style="margin-left: 20px;height: 120px!important;">
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                <div class="col-md-6 vehicle-details" style="padding-top: 15px;">
                     <div class="col-md-6">
                        <ul class="list-unstyled fleed-lst">
                           <li>
                              <div class="box-icon"><img src="../images/Masculine_Avatar_24.png" alt=""></div>
                              <span>حتى <?php echo $veh['passenger']; ?> الركاب</span>
                           </li>
                           <li>
                              <div class="box-icon"><img src="../images/Travelling_luggage_24.png" alt=""></div>
                              <span><?php echo $veh['luggage']; ?> قطعة من الأمتعة</span>
                           </li>
                           <li>
                              <div class="box-icon"><img src="../images/door.png" alt=""></div>
                              <span>حتى <?php echo $veh['door']; ?> باب</span>
                           </li>
                           <li>
                              <div class="box-icon"><img src="../images/fuel-adj.png" alt=""></div>
                              <span>سعة خزان الوقود <?php echo $veh['fuel_capacity']; ?></span>
                           </li>
                           <li>
                              <div class="box-icon"><img src="../images/Tower_signal_symbol_24.png" alt=""></div>
                              <span><?php if($veh['tranmision']==1){ echo "كتيب " ; }  else { echo "السيارات "; } ?>انتقال</span>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-6">
                        <ul class="list-unstyled ">
                            
                           <li>
                              <p>اكتب: <span><?php echo $vehicle->get_arabic_Type($veh['vt_id']); ?></span></p>
                           </li>
                           <li>
                              <p>محرك:<span><?php echo $veh['engine']; ?></span> </p>
                           </li>
                           <li>
                              <p>نموذج السنة: <span><?php echo $veh['model']; ?></span></p>
                           </li>
                           <li>
                              <span class="box-icon"><img src="../images/airbag.png" alt=""></span> 
                              <span class="box-icon"><img src="../images/anti-brake.png" alt=""></span>
                              <span class="box-icon"><img src="../images/cruse-control.png" alt=""></span>
                           </li>
                           <li style="padding-top:0;  margin-top: -4px;">
                            
                               <?php 
                                if($veh['airbags']==1)
                                {?>
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
                                if($veh['anti_brake']==1)
                                {?>
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
                                if($veh['cruise_control']==1)
                                {?>
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
                  
                  

                    <div class="col-md-3 right" style="padding: 18px 15px 0 15px;">
                        <div class="col-md-12 nopad-lr">
                            <div class="col-md-7 nopad-lr"><p>سعر لكل يوم</p></div>
                            <div class="col-md-5 nopad-lr"><p class="pull-right"><?php echo $default_country['currency']; ?> <?php echo $perday_price; ?></p></div>
                        </div>
                        <div class="clearfix"></div>


                        <div class="col-md-12 nopad-lr">
                            <div class="col-md-7 nopad-lr"><p>السعر لكل أسبوع</p></div>
                            <div class="col-md-5 nopad-lr"><p class="pull-right"><?php echo $default_country['currency'];; ?> <?php echo $weekly_price; ?></p></div>
                        </div>
                        <div class="clearfix"></div>


                        <div class="col-md-12 nopad-lr">
                            <div class="col-md-7 nopad-lr"><p>السعر لكل شهر</p></div>
                            <div class="col-md-5 nopad-lr"><p class="pull-right"><?php echo $default_country['currency'];; ?> <?php echo $monthly_price; ?></p></div>
                        </div>
                        <div class="clearfix"></div>
                        <a href="" id="view_model" data-cid="<?php echo $veh['id']; ?>"  data-toggle="modal" data-target="#details_model" class="btn-reserve">الاحتياطي الآن</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
    <?php
        }
    }
}
else
{?>
    <div class="col-md-12 nopad-lr">
        <p>لا سيارة وجدت.</p>
    </div>
<?php
}

?>
                
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
            $( function() {

            $("#guide_make,#guide_type").change(function(){
               
               var type = $("#guide_type").val();
               var country = $("#guide_country").val();
               var make = $("#guide_make").val();
               
         
                console.log(make);
                console.log(type);
                console.log(country);
                
                              $.ajax({
                      url: '../include/filter_fleet_guide_arabic.php',
                        type: 'POST',
                         data:
                         {
                          make: make,
                           type: type,
                           country: country
                        },
                         success: function(data)
                         {
                              $('#vehicle-info').html(data);
                         }
                       });
             });
             });
                

            

          
        

        </script>
        
        
        <script>
    (function($){
        $(window).load(function(){
            
            
            $(".option").mCustomScrollbar({
              axis:"y"
});
        });
    })(jQuery);
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
<script>
    (function($){
        $(window).load(function(){

            $(".main-box-auto").mCustomScrollbar({
              axis:"y"
              });
        });
    })(jQuery);
</script>



<script type="text/javascript">
      $(document).ready(function()
      {

        $(document).on("click","#view_model",function()
            {
                $('#vid').val($(this).attr('data-cid'));
            });
    });
        
</script> 
        
</body>
</html>
