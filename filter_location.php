<?php
   require 'lib/config/config.php';
   require 'lib/config/autoload.php';
   
   $location= new dbcountrylocation;
   $cid = $_POST['country'];
   
   
$country = $location->fetch_Country($cid);

$response='';
if(!empty($country))
{
                  
                  $cities=$location->fetch_cities($country['id']);
               $response.='<fieldset class="country">
                  <legend><div class="col-md-5 legend-bx nopad-lr"><h1>'.$country["name"].'</h1></div> <div class="clearfix"></div></legend>';
                  
                     foreach ($cities as $city) {
                  $response.='<div class="content">
                     <div class="city">
                        <h3 class="city-name">'.$city['city'] .'</h3>
                        <div class="clearfix"></div>';
                           $locations=$location->fetch_Locations_Bycities($country['id'],$city['city']);
                               foreach ($locations as $loc) {
                                
                                                                   $address = $loc['city'];
$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$result = curl_exec($ch);
curl_close($ch);
$response_a = json_decode($result);
$lat = $response_a->results[0]->geometry->location->lat;
$long = $response_a->results[0]->geometry->location->lng;
                                 
                        $response.='<div class="col-md-6">
                           <div class="location"> 
                              <div class="col-md-12">
                                 <div class="col-md-6 nopad-l">
                                    <ul class="list-unstyled complete-add" style="display:inline-block;">
                                       <li>
                                          <p class="office-name">'.$loc['name'] .'</p>
                                       </li>
                                       <li>
                                          <p class="address">'.$loc['address'].'</p>
                                       </li>
                                       <li>
                                          <p class="phone">Phone : '.$loc['phone'] .'</p>
                                       </li>
                                       <li>
                                          <p class="fax">Fax : +971 4 3374 734</p>
                                       </li>
                                       <li>
                                          <p class="email-add">E-mail : '.$loc['email'].'</p>
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
                                   <div id="m'.$loc['id'].'" style="height: 200px;width: 100%;"></div>  
                                    <script>
                                    
                                    var myLatLng = {lat: '.$loc['latitude'].', lng: '.$loc['longitude'].'};

                                      var map = new google.maps.Map(document.getElementById("m'.$loc['id'].'"), {
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
                        </div>';
                           }

                    $response.=' </div>
                  </div>
                  <!-- /content -->';

                     }

               $response.='</fieldset>
               <div class="clearfix"></div>';
                  
}             
echo $response;
?>