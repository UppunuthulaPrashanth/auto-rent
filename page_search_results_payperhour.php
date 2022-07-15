<?php include "inc_opendb.php";
$PAGEID = "Pay Per Hour";
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
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Rent A Car</h2>
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
                      <a href="#">Pay per Hour</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#">Search Results</a>
                    </p>
                    <p class="theme-breadcrumbs-item-subtitle">24 vehicles</p>
                  </li>
                  
                  
                </ul>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title">Dubai </h4>
                <p class="theme-search-area-inline-details">10hrs</p>
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
                        <div>
                        <label class="theme-search-area-section-label">Pick Up Information</label>
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>City</option>
                        <option>Abu-Dhabi</option>
                        
                        
                        <option>Dubai</option>
                        <option>Ras Al Khaimah</option>
                        <option>Sharjah</option>
                        
                      </select>
                    </div>
                  </div>
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Location</option>
                        <option>Oud Metha</option>
                        <option>Al Mamzar</option>
                        <option>Al Qouz</option>
                        
                      </select>
                    </div>
                  </div>
                      
                  
                     
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Pickup Date & Time"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
                            </div>
                          </div>
                     
                        
                      </div>
                        <div>
                        <label class="theme-search-area-section-label">Drop Off Information</label>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                          <label class="icheck-label">
                            <input class="icheck" type="checkbox"/>
                            <span class="icheck-title">Return Car to different location</span>
                          </label>
                          
                        </div>
                            <br>
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>City</option>
                        <option>Abu-Dhabi</option>
                        
                        
                        <option>Dubai</option>
                        <option>Ras Al Khaimah</option>
                        <option>Sharjah</option>
                        
                      </select>
                    </div>
                  </div>
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Location</option>
                        <option>Oud Metha</option>
                        <option>Al Mamzar</option>
                        <option>Al Qouz</option>
                        
                      </select>
                    </div>
                  </div>
                      
                  
                     
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Dropoff Date & Time"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
                            </div>
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
      
     
     
     
     
     <div class="theme-page-section theme-page-section-gray">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent" data-gutter="20">
          <div class="col-md-3 ">
            <div class="sticky-col _mob-h">
              
              <div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white">
                <div class="theme-search-area-form" id="hero-search-form">
                  <div>
                  <label class="theme-search-area-section-label">Pick Up Information</label>
                  
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>City</option>
                        <option>Abu-Dhabi</option>
                        
                        
                        <option>Dubai</option>
                        <option>Ras Al Khaimah</option>
                        <option>Sharjah</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Location</option>
                        <option>Oud Metha</option>
                        <option>Al Mamzar</option>
                        <option>Al Qouz</option>
                        
                      </select>
                    </div>
                  </div>
                  
                  
                  
                      
              
                   
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-calendar"></i>
                          <input class="theme-search-area-section-input datePickerStart _mob-h"  type="text" placeholder="Date & Time"/>
                          <input class="theme-search-area-section-input _desk-h mobile-picker"  type="date"/>
                        </div>
                      </div>
                   
                
                      </div>
                  
                  <div>
                  <label class="theme-search-area-section-label">Return Information</label>
                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                          <label class="icheck-label">
                            <input class="icheck" type="checkbox"/>
                            <span class="icheck-title">Return Car to different location</span>
                          </label>
                          
                        </div>
                    <br>
                    
                  
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>City</option>
                        <option>Abu-Dhabi</option>
                        
                        
                        <option>Dubai</option>
                        <option>Ras Al Khaimah</option>
                        <option>Sharjah</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Location</option>
                        <option>Oud Metha</option>
                        <option>Al Mamzar</option>
                        <option>Al Qouz</option>
                        
                      </select>
                    </div>
                  </div>
                  
                  
                  
                      
              
                   
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-calendar"></i>
                          <input class="theme-search-area-section-input datePickerStart _mob-h"  type="text" placeholder="Date & Time"/>
                          <input class="theme-search-area-section-input _desk-h mobile-picker"  type="date"/>
                        </div>
                      </div>
                   
                
                      </div>
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                        
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control">
                        <option>Car Type</option>
                        <option>Sedan</option>
                        
                        
                        <option>SUV</option>
                        <option>Pickup</option>
                        <option>Commercial</option>
                        
                      </select>
                    </div>
                  </div>
               
               
                  <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary">Modify Search</button>
                </div>
              </div>
              
              
            </div>
          </div>
          <div class="col-md-8-5 ">
            <div class="theme-search-results-item theme-search-results-item-">
                  <div class="theme-search-results-item-preview">
                    
                    <div class="row" data-gutter="20">
                      <h4>Your Summary</h4>
                      <div class="col-md-6 ">
                        <h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Pickup</h5>
                        
                        <ul class="theme-search-results-item-car-list summary-txt">
                          <li>
                            <i class="fa fa-map-marker fa-lg loc-icons"></i> Al Qouz, Dubai
                          </li><br>
                          <li >
                            <i class="fa fa-calendar fa-lg loc-icons"></i> September 24, 2020
                          </li><br>
                          <li>
                            <i class="fa fa-clock-o fa-lg loc-icons"></i> 11:00 pm
                          </li><br>
                         
                        </ul>
                      </div>
                      
                      <div class="col-md-6 ">
                        <h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Dropoff</h5>
                        
                        <ul class="theme-search-results-item-car-list summary-txt">
                          <li>
                            <i class="fa fa-map-marker fa-lg loc-icons"></i> Al Qouz, Dubai
                          </li><br>
                          <li >
                            <i class="fa fa-calendar fa-lg loc-icons"></i> September 25, 2020
                          </li><br>
                          <li>
                            <i class="fa fa-clock-o fa-lg loc-icons"></i> 08:00 am
                          </li><br>
                         
                        </ul>
                      </div>
                      
                    </div>
                    <h5>Rental Length : 9 hours </h5>
                  </div>
                </div>
            <hr>
<!--
            <div class="theme-search-results-sort _mob-h _b-n clearfix">
              <h5 class="theme-search-results-sort-title">Sort by:</h5>
              <ul class="theme-search-results-sort-list">
                <li class="active">
                  <a href="#">Price
                    <span>Low &rarr; High</span>
                  </a>
                </li>
                
                
                
                
              </ul>
              <div class="dropdown theme-search-results-sort-alt">
                <a id="dropdownMenu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">More
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                  <li>
                    <a href="#">Recommended</a>
                  </li>
                  <li>
                    <a href="#">Most Popular</a>
                  </li>
                  <li>
                    <a href="#">Trendy Now</a>
                  </li>
                  <li>
                    <a href="#">Best Deals</a>
                  </li>
                </ul>
              </div>
            </div>
-->
            <div class="theme-search-results-sort-select _desk-h">
              <select>
                <option>Price</option>
                <option>Guest Rating</option>
                <option>Property Class</option>
                <option>Property Name</option>
                <option>Recommended</option>
                <option>Most Popular</option>
                <option>Trendy Now</option>
                <option>Best Deals</option>
              </select>
            </div>
            
            
            
            
            
            <div class="theme-search-results">
              <div class="_mob-h">
                
                
                
                
                
                
                
                
                
                <div class="theme-search-results-item theme-search-results-item-">
                  <div class="theme-search-results-item-preview">
                    
                    <div class="row" data-gutter="20">
                      
                      <div class="col-md-3 ">
                        <div class="theme-search-results-item-img-wrap">
                          <img class="theme-search-results-item-img" src="img/car-results/1.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <ul class="theme-search-results-item-car-feature-list">
                          <li>
                            <i class="fa fa-male"></i>
                            <span>5</span>
                          </li>
                          <li>
                            <i class="fa fa-suitcase"></i>
                            <span>5</span>
                          </li>
                          <li>
                            <i class="fa fa-cog"></i>
                            <span>Auto</span>
                          </li>
                          <li>
                            <i class="fa fa-snowflake-o"></i>
                            <span>A/C</span>
                          </li>
                          <li>
                            <i class="fa fa-snowflake-o"></i>
                            <span>4</span>
                          </li>
                          
                        </ul>
                      </div>
                      
                      <div class="col-md-7 ">
                        <h5 class="theme-search-results-item-title theme-search-results-item-title-lg">Toyota Yaris</h5>
                        <div class="theme-search-results-item-car-location">
                          
                          <div class="theme-search-results-item-car-location-body">
                            <p class="theme-search-results-item-car-location-title">Sedan</p>
                            <p class="theme-search-results-item-car-location-subtitle">or similar</p>
                          </div>
                        </div>
                        <ul class="theme-search-results-item-car-list">
                          <li class="list-float ">
                            <i class="fa fa-check"></i>Unlimited mileage
                          </li>
                          <li class="list-float ">
                            <i class="fa fa-check"></i>Pay at the counter
                          </li>
                          <li class="list-float ">
                            <i class="fa fa-check"></i>Free cancellation
                          </li>
                           <li class="list-float ">
                            <i class="fa fa-check"></i>Pay at the counter
                          </li>
                          <li class="list-float ">
                            <i class="fa fa-check"></i>Free cancellation
                          </li>
                        </ul>
                      </div>
                      <div class="col-md-2 ">
                        <div class="theme-search-results-item-book">
                          <div class="theme-search-results-item-price">
                             <p class="theme-search-results-item-price-sign">Pay Online</p>
                            <p class="theme-search-results-item-price-tag">AED 12</p>
                            <p class="theme-search-results-item-price-sign">per hour</p>
                          </div>
                         
                        </div>
                   
                        <div class="theme-search-results-item-book">
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-sign">Pay Later</p>
                            <p class="theme-search-results-item-price-tag">AED 20</p>
                            <p class="theme-search-results-item-price-sign">per hour</p>
                          </div>
                          <a class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" href="/book_rent_cars.php">Book</a>
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
              </div>
              
              
              
              <div class="_desk-h">
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                    <img class="theme-search-results-item-img" src="img/car-results/1.jpg" alt="Image Alternative text" title="Image Title"/>
                  </div>
                  <div class="theme-search-results-item-grid-body _pt-0">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <h5 class="theme-search-results-item-title _fs">Toyota Yaris</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-12 ">
                          <div class="theme-search-results-item-car-location">
                            <i class="fa fa-car theme-search-results-item-car-location-icon"></i>
                            <div class="theme-search-results-item-car-location-body">
                              <p class="theme-search-results-item-car-location-title">Sedan</p>
                              <p class="theme-search-results-item-car-location-subtitle">or similar</p>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <hr>
                      <div class="row" data-gutter="10">
                        
                        <div class="col-xs-6">
                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Now</h5>
                          <div class="theme-search-results-item-price ">
                            <p class="theme-search-results-item-price-tag txt-center">AED 12</p>
                            <p class="theme-search-results-item-price-sign txt-center">per day</p>
                          </div>
                        </div>
                        <div class="col-xs-6 txt-center">
                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Later</h5>
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag txt-center">AED 20</p>
                            <p class="theme-search-results-item-price-sign txt-center">per hour</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                  <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                    <img class="theme-search-results-item-img" src="img/car-results/17.jpg" alt="Image Alternative text" title="Image Title"/>
                  </div>
                  <div class="theme-search-results-item-grid-body _pt-0">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="theme-search-results-item-grid-header">
                      <h5 class="theme-search-results-item-title _fs">Mazda 3</h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                      <div class="row" data-gutter="10">
                        <div class="col-xs-12 ">
                          <div class="theme-search-results-item-car-location">
                            <i class="fa fa-car theme-search-results-item-car-location-icon"></i>
                            <div class="theme-search-results-item-car-location-body">
                              <p class="theme-search-results-item-car-location-title">Sedan</p>
                              <p class="theme-search-results-item-car-location-subtitle">or similar</p>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <hr>
                      <div class="row" data-gutter="10">
                        
                        <div class="col-xs-6  ">
                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Now</h5>
                          <div class="theme-search-results-item-price ">
                            <p class="theme-search-results-item-price-tag txt-center">AED 15</p>
                            <p class="theme-search-results-item-price-sign txt-center">per hour</p>
                          </div>
                        </div>
                        <div class="col-xs-6 txt-center">
                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Later</h5>
                          <div class="theme-search-results-item-price">
                            <p class="theme-search-results-item-price-tag txt-center">AED 23</p>
                            <p class="theme-search-results-item-price-sign txt-center">per hour</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-search-results-mobile-filters" id="mobileFilters">
                <a class="theme-search-results-mobile-filters-btn magnific-inline" href="#MobileFilters">
                  <i class="fa fa-filter"></i>Filters
                </a>
                <div class="magnific-popup mfp-hide" id="MobileFilters">
                  <div class="theme-search-results-sidebar">
                    <div class="theme-search-results-sidebar-sections">
                      
                      
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Passengers</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">1 to 2 passengers</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">270</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">3 to 5 passengers</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">107</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">6 or more</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">123</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Bags</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">1 to 2 bags</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">109</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">3 to 4 bags</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">389</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">5 or more</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">370</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-sidebar-section">
                        <h5 class="theme-search-results-sidebar-section-title">Car Type</h5>
                        <div class="theme-search-results-sidebar-section-checkbox-list">
                          <div class="theme-search-results-sidebar-section-checkbox-list-items">
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Small</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">250</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Large</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">302</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Medium</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">377</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">SUV</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">347</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Van</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">351</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Commercial</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">333</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Luxury</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">421</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Pickup truck</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">474</span>
                            </div>
                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                              <label class="icheck-label">
                                <input class="icheck" type="checkbox"/>
                                <span class="icheck-title">Convertable</span>
                              </label>
                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">345</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a class="btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg" href="#">Load More Results</a>
          </div>
          
        </div>
      </div>
    </div>

     
     
      
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
   </body>
</html>