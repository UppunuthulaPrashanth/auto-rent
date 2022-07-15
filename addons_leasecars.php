<?php include "inc_opendb.php";
$PAGEID = "Addon Lease Cars";

//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();

if (isset($_POST["carTitle4"]))
{
    $carTitle = filter_var($_POST['carTitle4'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["carClass4"]))
{
    $carClass = filter_var($_POST['carClass4'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["leaseTerm4"]))
{
    $leaseTerm = filter_var($_POST['leaseTerm4'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["leaseslug2"]))
{
    $leaseslug = filter_var($_POST['leaseslug2'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["leaseslug"]))
{
    $leaseslug = filter_var($_POST['leaseslug'], FILTER_SANITIZE_STRING);
}

if(isset($leaseslug) && !empty($leaseslug))
{
    $result = $db->query("SELECT * FROM rent_lease_cars WHERE slug = ?s",$leaseslug);
    $rentCarRow = mysqli_fetch_assoc($result);
    //  echo $db->lastQuery();
    // die;

    $onlinePrice = $rentCarRow['onlinePrice' . $_SESSION[CURRENT_CURRENCY]];
    $vrf4        = $rentCarRow[ 'vrf' . $_SESSION[ CURRENT_CURRENCY ] ];
}


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
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel-1.png);"></div>
        <div class="theme-hero-area-grad-mask"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row _pv-60">
            <div class="col-md-9 ">
              <div class="_mob-h">
                <div class="theme-hero-text theme-hero-text-white">
                  <div class="">
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Add Extras</h2>
                  </div>
                </div>
                <ul class="theme-breadcrumbs _mt-20">
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#">Home</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#">Lease Cars</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#"><?php echo $rentCarRow['carTitle']; ?></a>
                    </p>
                    
                  </li>
                  
                  
                </ul>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title">Dubai </h4>
                <p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>
                <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal">
                  <i class="fa fa-pencil"></i>Modify
                </a>
                <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-header">
                      <h1 class="theme-search-area-title theme-search-area-title-sm">Modify</h1>
                      <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                    </div>
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Make</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Select Make</option>
                        <option>Audi</option>
                        
                        <option>Bugatti</option>
                        <option>Cadillac</option>
                        <option>Dodge</option>
                        
                      </select>
                    </div>
                  </div>
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Model</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Select Model</option>
                        <option>Audi</option>
                        
                        
                        <option>Bugatti</option>
                        <option>Cadillac</option>
                        <option>Dodge</option>
                        
                      </select>
                    </div>
                  </div>
                   
                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Term</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Select Lease Term</option>
                        <option>6 Months</option>
                        
                        
                        <option>12 Months</option>
                        <option>18 Months</option>
                        <option>24 Months</option>
                        
                      </select>
                    </div>
                  </div>
                       

                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Location</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Select Location</option>
                        <option>Abu Dhabi</option>
                        
                        
                        <option>Dubai</option>
                        <option>Sharjah</option>
                        <option>RAK</option>
                        
                      </select>
                    </div>
                  </div>
                       
                     
                      <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
     
     
     
 <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">

          <div class="col-md-8 ">
            <div class="theme-payment-page-sections">
              <!--<div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-signin">
                  <i class="theme-payment-page-signin-icon fa fa-user-circle-o"></i>
                  <div class="theme-payment-page-signin-body">
                    <h4 class="theme-payment-page-signin-title">Sign in if you have an account</h4>
                    <p class="theme-payment-page-signin-subtitle">We will retrieve saved travelers and credit cards for faster checkout</p>
                  </div>
                  <a class="btn theme-payment-page-signin-btn btn-primary" href="#">Sign in</a>
                </div>
              </div>-->
              <div class="theme-search-results-item theme-search-results-item-">
                  <div class="theme-search-results-item-preview">
                    
                    <div class="row" data-gutter="20">
                      
                      <div class="col-md-3 ">
                        <div class="theme-search-results-item-img-wrap">
                          <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="Image Alternative text" title="Image Title"/>
                        </div>
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
                            <span><?php echo getTransmissionFromID($rentCarRow['transmissionID']); ?></span>
                          </li>
                          <li>
                            <i class="fa fa-snowflake-o"></i>
                            <span><?php if($rentCarRow['ac'] == 'Y') { echo "A/C"; } else { echo "Non-A/C";} ?></span>
                          </li>
                          <li>
                            <i class="fa fa-snowflake-o"></i>
                            <span><?php echo $rentCarRow['noOfDoors']; ?></span>
                          </li>
                          
                        </ul>
                      </div>
                      
                      <div class="col-md-7 ">
                        <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle']; ?></h5>
                        <div class="theme-search-results-item-car-location">
                          
                          <div class="theme-search-results-item-car-location-body">
<!--                            <p class="theme-search-results-item-car-location-title">--><?php //echo $rentCarRow['carTitle']; ?><!--</p>-->
<!--                            <p class="theme-search-results-item-car-location-subtitle">--><?php //echo $rentCarRow['carClassID']; ?><!--</p>-->
                              <?php echo getCarClassedFromID($rentCarRow['carClassID']); ?></p>
                              <p class="theme-search-results-item-car-location-subtitle"><?php echo  $leaseTerm;?> Contract</p>
                          </div>
                        </div>
                          <ul class="theme-search-results-item-car-list"><?php $extraFeatures = $rentCarRow['extraFeatures'];
                              $featureResult = $db->query("SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)");
                              while($featureRow = mysqli_fetch_assoc($featureResult))
                              {
                                  ?>
                                  <li class="list-float ">
                                  <i class="fa fa-check"></i><?php echo $featureRow['extraFeatures'];?>
                                  </li><?php } ?>
                          </ul>
                      </div>
                      <div class="col-md-2 ">
                        <div class="theme-search-results-item-book">
                          <div class="theme-search-results-item-price">
                             <p class="theme-search-results-item-price-sign">Pay Online</p>
                            <p class="theme-search-results-item-price-tag"><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . $rentCarRow[ 'onlinePrice' . $_SESSION[ CURRENT_CURRENCY ] ];?></p>
                            <p class="theme-search-results-item-price-sign">per month</p>
                          </div>
                         
                        </div>
                   
                        <div class="theme-search-results-item-book">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-sign">Pay Later</p>
                            <p class="theme-search-results-item-price-tag"><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . $rentCarRow[ 'offlinePrice' . $_SESSION[ CURRENT_CURRENCY ] ];?></p>
                            <p class="theme-search-results-item-price-sign">per month</p>
                          </div>
                    
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
<!--
           <div class="disclaimer">
       <i class="fa fa-exclamation-circle fa-lg"></i> <p class="disclaimer-txt">The hirer is liable to pay the applicable INSURANCE EXCESS of 900.00 AED in case of an accident where the hirer is at mistake or the Third party is unknown.</p>
    

              
             </div>
-->
              <hr>
              
      
    <div class="row">
       <div class="col-md-6">
<!--          <button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn book-btn" type="submit"><i class="fa fa-chevron-left loc-icons"></i> Modify</button><br>
--></div>
        <div class="col-md-6">
          
           <label  class=" text-upcase mar-rt " >
               Total Amount : <input type="text" readonly id="totalcalculatelease" class="form-control" name="totalcalculatelease" value="<?php echo $onlinePrice+$vrf4;?>" /></label>
     <button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="proceed" causevalidation="false" name="proceed"> Proceed</button>


      
      
      </div>
    </div>
              <hr>

                <form id="checkoutpost" name="checkoutpost" action="checkout" method="post">

              <div class="theme-account-notifications-item">



                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">Delivery
                    <span class="icheck-sub-title">This vehicle is available for delivery at your doorstep</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['additionalDriver' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?></span></div>
        <div class="col-md-4">   <input class="icheck" type="checkbox" id="iDelivery" name="iDelivery"  value="<?php echo $rentCarRow['additionalDriver'. $_SESSION[CURRENT_CURRENCY]];?>"  ></div>
    </div>
            
            
            
            
         </div>
                        
                        
           <div class="col-md-12">

              
              
              
              <div class="row row-col-mob-gap">
                <div class="col-md-12">
                  
                  <div class="form-group theme-contact-form-group">
                    <textarea class="form-control" name="iDeliveryaddress" id="iDeliveryaddress" rows="3" placeholder="Delivery Address"></textarea>

                  </div>
                </div>
              </div>
                    
              

            
            
            
            
         </div>             
                        
                        
                        
                        
    </div>

              </div>


              
              <div class="theme-account-notifications">
                  <h4>For Your Protection & Safety</h4>
              <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">VRF
                    <span class="icheck-sub-title">Vehicle Registration Fee (Mandatory Charges)</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title" style="font-size: 23px"><?php echo $rentCarRow['vrf' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> </span></div>
        <div class="col-md-4">   <input checked class="icheck" disabled="disabled" type="hidden" id="ivrf" name="ivrf"  value="<?php echo $rentCarRow[ 'vrf' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>" /></div>
    </div>
            
            
            
            
         </div>
    </div>
                
              </div>
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">SCDW
                    <span class="icheck-sub-title">Super Collision Damage Waiver</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['scdw' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> </span></div>
        <div class="col-md-4">   <input class="icheck" type="checkbox" id="iscdw" name="iscdw"  value="<?php echo $rentCarRow[ 'scdw' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>"  /></div>
    </div>
            
            
            
            
         </div>
    </div>
                
              </div>
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">CDW
                    <span class="icheck-sub-title">Collision Damage Waiver</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['cdw' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> </span></div>
        <div class="col-md-4">   <input class="icheck"  id="icdw" name="icdw"  value="<?php echo $rentCarRow[ 'cdw' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>"  type="checkbox"/></div>
    </div>
            
            
            
            
         </div>
    </div>
                
              </div>
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">Personal Accident Insurance
                    <span class="icheck-sub-title">Personal Accident Insurance Covers driver and passengers in case of serious personal injury.</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['pai' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> </span></div>
        <div class="col-md-4">   <input class="icheck" id="ipai" name="ipai"  value="<?php echo $rentCarRow[ 'pai' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>" type="checkbox"/></div>
                <input id="leasehd" name="leasehd" value="1" type="hidden"> </input>
            </div>
            
            
            
            
         </div>
    </div>
                
              </div>
                 <br>
                  <h4>Enhance Your Driving Experience</h4>
                   <hr>
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">GPS
                    <span class="icheck-sub-title">GPS satellite System</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['gps' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> / PER DAY</span></div>
        <div class="col-md-4">   <input class="icheck" id="igps" name="igps"  value="<?php echo $rentCarRow[ 'gps' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>" type="checkbox"/></div>
    </div>



            
         </div>
    </div>
                
              </div>
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">Additional Driver
                    <span class="icheck-sub-title">Share the driving on any journey and enjoy the peace of mind that someone else is insured to drive if needed.</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['additionalDriver' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> / PER DAY</span></div>
        <div class="col-md-4">   <input class="icheck" id="iad" name="iad"  value="<?php echo $rentCarRow[ 'additionalDriver' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>" type="checkbox"/></div>
    </div>
            
            
            
            
         </div>
    </div>
                
              </div>
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">Baby Safety Seat
                    <span class="icheck-sub-title">For children 1-4 years (13-25 kg, 20-50 lb)</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['babySafetySeat' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> / PER DAY</span></div>
        <div class="col-md-4">   <input class="icheck" id="ibss" name="ibss"  value="<?php echo $rentCarRow[ 'babySafetySeat' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>"  type="checkbox"/></div>
    </div>
            
            
            
            
         </div>
    </div>
                
              </div>
                  
                  <div class="theme-account-notifications-item">
                  
                  
                  
                  
                      <div class="row">
        <div class="col-sm-7"><label class="icheck-label">
                 
                  <span class="icheck-title">Additional Baby Safety Seat
                    <span class="icheck-sub-title">For children 1-4 years (13-25 kg, 20-50 lb)</span>
                  </span>
                </label></div>
        <div class="col-md-5">
            <div class="row">
        <div class="col-md-8"><span class="icheck-title"><?php echo $rentCarRow['addBabySafetySeat' . $_SESSION[CURRENT_CURRENCY]];?> <?php echo $_SESSION[CURRENT_CURRENCY];?> / PER DAY</span></div>
        <div class="col-md-4">   <input class="icheck" id="iabss" name="iabss"  value="<?php echo $rentCarRow[ 'addBabySafetySeat' . $_SESSION[ CURRENT_CURRENCY ] ]; ?>" type="checkbox"/></div>
    </div>
            
            
            
            
         </div>
    </div>
                
              </div>
              
              
              
              
              
            </div>

              <br>

              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">
                  <div class="theme-payment-page-booking-header">
                    <h3 class="theme-payment-page-booking-title">Total Price for <?php echo  $leaseTerm;?> </h3>
                    <p class="theme-payment-page-booking-subtitle">By clicking book now button you agree with terms and conditionals and money back gurantee. Thank you for trusting our service.</p>
                    <p class="theme-payment-page-booking-price"><?php echo $_SESSION[CURRENT_CURRENCY];?>
                        <input type="text" readonly id="totalcalculatelease" class="form-control" name="totalcalculatelease" value="<?php echo $onlinePrice+$vrf4;?>" />
                        <input type="hidden" id="payonline" name="payonline" value="<?php echo $onlinePrice;?>" />
                        <input type="hidden" name="leaseslug2" id="leaseslug2" value="<?php echo $leaseslug; ?>" />

                    </p></p>
                  </div>
                    <input type="hidden" name="leaseTerm4" id="leaseTerm4" value="<?php echo $leaseTerm; ?>" />
                    <button class="btn _tt-uc btn-primary-inverse btn-lg btn-block" type="submit" id="btnsubmit" name="btnsubmit">Book Now</button>
                 <!-- <a class="btn _tt-uc btn-primary-inverse btn-lg btn-block" href="#"></a>-->
                </div>
              </div>

            </div>
          </div>
            </form>
          <div class="col-md-4 ">
            <div class="sticky-col">
              
                <div class="theme-search-area _mb-20 _p-20 _b _bc-dw theme-search-area-vert">
                <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                  <h1 class="theme-search-area-title">Modify Search</h1>
                  
                </div>
                    <form id="sliderLeaseCarsForm1" name="sliderLeaseCarsForm1" method="post" action="lease-a-cars">
                <div class="theme-search-area-form">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Make</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="leaseClass" name="leaseClass" required>
                          <option value="" selected disabled>Select Car Class</option>
                          <?php
                          $classRes = $db->query( "select * from mtr_car_classes WHERE active = 1 ORDER BY so ASC" );
                          while ( $classRow = mysqli_fetch_assoc( $classRes ) )
                          {
                              ?>
                              <option value="<?php echo $classRow['carClassID']; ?>"><?php echo $classRow['carClass']; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                      <input value="standardLease" type="radio" name="standardLease" style="display:none" id="standardLease" checked/>
                    </div>
                  </div>
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Model</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="leaseMakeModel" name="leaseMakeModel">
                          <option selected value="" disabled>Select Make Model</option>
                          <option value="" disabled>Please Select Class First</option>
                      </select>
                    </div>
                  </div>
                   
                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Term</label> 
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="leaseTerm" name="leaseTerm" required>
                          <option value="" selected disabled>Select Term</option>
                          <option value="6">6 Months</option>
                          <option value="12">12 Months</option>
                          <option value="18">18 Months</option>
                          <option value="24">24 Months</option>
                      </select>
                    </div>
                  </div>





                    <button type="submit" id="standardLease-btn" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Change</button>

                </div>
</form>

              </div>
                
              
              
            </div>
          </div>
        </div>

      </div>
    </div>



      
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>


   <script>
       $(document).on('ifChanged', '#iDelivery', function (e) {
           var checkBox = document.getElementById("iDelivery");
           $('input[name="iDelivery"]:checked').each(function() {
               var iDelivery = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = iDelivery + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var iDelivery = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - iDelivery;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#ivrf', function (e) {
           var checkBox = document.getElementById("ivrf");
           $('input[name="ivrf"]:checked').each(function() {
               var ivrf = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = ivrf + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var ivrf = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - ivrf;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#iscdw', function (e) {
           var checkBox = document.getElementById("iscdw");
           $('input[name="iscdw"]:checked').each(function() {
               var iscdw = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = iscdw + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var iscdw = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - iscdw;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#icdw', function (e) {
           var checkBox = document.getElementById("icdw");
           $('input[name="icdw"]:checked').each(function() {
               var icdw = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = icdw + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var icdw = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - icdw;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#ipai', function (e) {
           var checkBox = document.getElementById("ipai");
           $('input[name="ipai"]:checked').each(function() {
               var ipai = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = ipai + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var ipai = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - ipai;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#igps', function (e) {
           var checkBox = document.getElementById("igps");
           $('input[name="igps"]:checked').each(function() {
               var igps = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = igps + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var igps = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - igps;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#iad', function (e) {
           var checkBox = document.getElementById("iad");
           $('input[name="iad"]:checked').each(function() {
               var iad = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = iad + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var iad = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - iad;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#ibss', function (e) {
           var checkBox = document.getElementById("ibss");
           $('input[name="ibss"]:checked').each(function() {
               var ibss = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = ibss + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var ibss = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - ibss;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $(document).on('ifChanged', '#iabss', function (e) {
           var checkBox = document.getElementById("iabss");
           $('input[name="iabss"]:checked').each(function() {
               var iabss = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = iabss + totalPrice;
               $('input[name=totalcalculatelease]').val(total);
           });

           if (checkBox.checked == true) {

           } else {
               var iabss = parseFloat(this.value);
               var totalcalculate = $('input[name=totalcalculatelease]').val();
               var totalPrice = parseFloat(totalcalculate);
               var total = totalPrice - iabss;
               $('input[name=totalcalculatelease]').val(total);
           }


       });

       $('#proceed').click(function(){
           $("#btnsubmit").click();
       })


   </script>
   </body>
</html>