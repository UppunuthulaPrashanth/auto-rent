<?php 
   require '../lib/config/config.php';
   require '../lib/config/autoload.php';
   error_reporting(E_ALL);
   ob_start();
   $user = userdb::getInstance();   
   $vehicle = vehical::getInstance();
$location= new dbcountrylocation;
$makes = $vehicle->getVehiclesmakes();
$types = $vehicle->getVehicalTypes();
$countries = $location->fetch_Country_all();

$cid='';
if(isset($_SESSION['selected_country']))
{
    $country=$location->fetch_Countrybyname($_SESSION['selected_country']);
}
else
{
    $country=$location->fetch_Country(5);
    
}  
    ?>
<!DOCTYPE html>
<html class="no-js">
   <?php include 'header.php'; ?>
   <?php echo $head; ?>
   <title><?php echo $pagetitle['LOC'];?> </title>
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script>
      $(document).ready(function(){
        $(".country-list").click(function(){


          $(".country-menu").toggleClass("showMenu");

        });



            $(".country-menu > li").click(function(){
            	  
              $(".country-list > p").text($(this).text());
              cname=$(this).text();
	          $.ajax({
	            type:"post",
	            url:"citybyCountry.php",
	            data:{cname:cname},
	            success:function(response)
	            {
	            $(".city-menu").html(response);
	            }	
	          });	
              $(".country-menu").removeClass("showMenu");
            });
      });
      
      $(document).ready(function(){
        $(".city-list").click(function(){
          $(".city-menu").toggleClass("showMenu");

        });


          $(document).on('click', '.city-menu > li', function(event) {
          	event.preventDefault();
         
              $(".city-list > p").text($(this).text());
              loc_name=$(this).text();

              $.ajax({
	            type:"post",
	            url:"filter_location.php",
	            data:{loc_name:loc_name},
	            success:function(response)
	            {
	            	$(".details").html(response);
	            }	
	          });
              $(".city-menu").removeClass("showMenu");
            });




            $(document).on('click', '.reservation', function() {
					loc=$(this).parents('.location').find('.office-name').html();
					window.location.href='index.php?location='+loc;


            });
          
      });
   </script>
   <style>.bfh-selectbox-options{
    width:100%;
}

</style>
   </head>
   <body>
      <!-- 
         Header Area
         ========================================================================== -->
      <div id="loader"></div>
      <section class="header-search">
         <?php echo $mainnav; ?>
            <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>
         <div class="clearfix"></div>
         <div class="search-cover">
            <div class="container">
                <div class="row">
                <div class="col-md-11 text"><h1 class="tagline pull-right"><span>الموقع</span></h1> </div>
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

            
               
             
                <div class="col-md-4 vehicle-make" >
                  <select class="selectmenu" id="guide_country" style="padding-right: 25px;" >
                  <option>أختر البلد</option>
                   <?php 
                    foreach($countries as $coun)
                    {?>
                        <option value="<?php echo $coun['id'];?>" <?php if($coun['id']==$country['id']){?> selected <?php } ?>><?php echo $coun['ar_name'];?></option>
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
    
    
      <section class="" id="location">
         <div class="container">
        
        
            <div class="row details" id="all_locations">
               <?php 
                  
                  $cities=$location->fetch_arabic_cities($country['id']);?>
               <fieldset class="country">
                  <legend>
                     <div class="col-md-5 legend-bx nopad-lr"><h1><?php echo $country['ar_name']; ?></h1></div>
                  <div class="clearfix"></div></legend>
                  <?php
                     foreach ($cities as $city) {?>
                  <div class="content">
                     <div class="city">
                        <h3 class="city-name"><?php echo $city['ar_city']; ?></h3>
                        <div class="clearfix"></div>
                        <?php 
                           $locations=$location->fetch_Locations_Byarabic_cities($country['id'],$city['ar_city']);
                               foreach ($locations as $loc) {
                                 ?>
                        <div class="col-md-6">
                           <div class="location"> 
                              <div class="col-md-12">
                                 <div class="col-md-6 nopad-l">
                                    <ul class="list-unstyled complete-add" style="display:inline-block;">
                                       <li>
                                          <p class="office-name"><?php echo $loc['ar_name']; ?></p>
                                       </li>
                                       <li>
                                          <p class="address"><?php echo $loc['ar_address']; ?></p>
                                       </li>
                                       <li>
                                          <p class="phone">هاتف : <?php echo $loc['phone']; ?></p>
                                       </li>
                                       <li>
                                          <p class="fax">الفاكس : +971 4 3374 734</p>
                                       </li>
                                       <li>
                                          <p class="email-add">البريد الإلكتروني : <?php echo $loc['email']; ?></p>
                                       </li>
                                       <li>
                                          <p class="web-add">Web : www.autorent-me.com</p>
                                       </li>
                                       <li>
                                          <p class="postal-add"></p>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-6 nopad-lr">
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <!-- /MAps -->
                                 <div class="google-map map-canvas" style="height:200px;">                                
                                   <div id="m<?php echo $loc['id']?>"style="height: 200px;width: 100%;"></div>  
                                    <script>
                                    
                                    var myLatLng = {lat: <?php echo $loc['latitude']?>, lng: <?php echo $loc['longitude']?>};

                                      var map = new google.maps.Map(document.getElementById('m<?php echo $loc['id']?>'), {
                                        zoom: 10,
                                        center: myLatLng
                                      });
                                    
                                      var marker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map,
                                      });

                                     </script>
                                </div>
                                    
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-12">
                                 <a href="index.php" id="reservation" class="btn-reservation pull-right reservation">Make a Reservation</a>
                              </div>
                              <div class="clearfix"></div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        <?php
                           }
                                                      
                           ?>
                     </div>
                  </div>
                  <!-- /content -->
                  <?php
                     }
                     
                     ?>
               </fieldset>
               <div class="clearfix"></div>
            </div>
            <!-- /details -->
            <div class="clearfix"></div>
         </div>
         <!-- /container -->
      </section>
      <!-- /#location -->
      <!--
         Footer Area
         ========================================================================== -->
      <?php echo $footer; ?>
      
      
            <script type="text/javascript">
            $( function() {

            $("#guide_country").change(function(){
                 $("#loader").addClass('preloader');
               
               var country = $("#guide_country").val();
                               $.ajax({
                        url: 'filter_location.php',
                          type: 'POST',
                           data:
                           {
                             country: country
                          },
                           success: function(data)
                           {
                                $('#all_locations').html(data);
                                $("#loader").removeClass('preloader');
                           }
                         });
 
             });
             });
                

            

          
        

        </script>
        
        
        
   </body>
</html>