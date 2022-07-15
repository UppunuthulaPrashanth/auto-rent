<?php include "inc_opendb.php";
$PAGEID = "Used Cars";

//echo print_r($_GET()); exit();
$queryAppend ="";
$make ="";
$model="";
$bodyType="";
$year="";
$usedCarsType="";
if (isset($_POST["make"]))
{
    $make = filter_var($_POST['make'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["model"]))
{
    $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["bodytype"]))
{
    $bodyType = filter_var($_POST['bodytype'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["year"]))
{
    $year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["usedCarsType"]))
{
    $usedCarsType = filter_var($_POST['usedCarsType'], FILTER_SANITIZE_STRING);

}


//Make
$makes = "";
if ('$make') {
    $makes = $make;
    $queryAppend .= " AND makeID = " . $makes;
}

//Model
$models = "";
if ($model) {
    $models = $model;
    $queryAppend .= " AND modelID = " . $models;
}

//Bodytype
$bodyType = "";
if ($bodyType) {
    $bodyTypes = $bodyType;
    $queryAppend .= " AND bodyTypeID = " . $bodyTypes;
}

//Year
$year = "";
if ($year) {
    $years = $year;
    $queryAppend .= " AND yearID = " . $years;
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

      <?php
      $usedListingCountRes = $db->query("SELECT * FROM view_used_cars WHERE active = 1 " . $queryAppend);
      $countResult = mysqli_num_rows($usedListingCountRes);
      ?>

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
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Used Cars</h2>
                  </div>
                </div>
                <ul class="theme-breadcrumbs _mt-20">
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="/">Home</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a>Used Car</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a>Search Results</a>
                    </p>
                    <p class="theme-breadcrumbs-item-subtitle"><?php echo $countResult; ?> vehicles</p>

                      <input class="form-control" id="make33" name="make33" type="hidden" value="<?php echo $make; ?> " />
                      <input class="form-control" id="model33" name="model33" type="hidden" value="<?php echo $model; ?>" />
                      <input class="form-control" id="bodyType33" name="bodyType33" type="hidden" value="<?php echo $bodyType; ?>" />
                      <input class="form-control" id="year33" name="year33" type="hidden" value="<?php echo $year; ?>" />
                      <input class="form-control" id="usedCarsType33" name="usedCarsType33" type="hidden" value="<?php echo $usedCarsType; ?>" />

                  </li>

                </ul>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title">Dubai Cars</h4>
                <p class="theme-search-area-inline-details">Nissan Sunny</p>
                <a class="theme-search-area-inline-link magnific-inline" href="#sliderUsedCarsForm2" >
                  <i class="fa fa-pencil"></i>Edit
                </a>
                <form class="magnific-popup magnific-popup-sm mfp-hide" id="sliderUsedCarsForm1" name="sliderUsedCarsForm1" method="post" action="/used-cars">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-header">
                      <h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>
                      <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                    </div>
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Make</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control"  id="make1" name="make1" required>
                          <option value="" selected disabled>Select Make</option>
                          <?php
                          $makeRes = $db->query( "select * from mtr_make WHERE makeID IN (SELECT distinct(makeID) FROM view_used_cars WHERE active = 1) AND active = 1 ORDER BY make ASC" );
                          while ( $makeRow = mysqli_fetch_assoc( $makeRes ) )
                          {
                              ?>
                              <option value="<?php echo $makeRow['makeID']; ?>"><?php echo $makeRow['make']; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Model</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="model1" name="model1" required>
                          <option selected value="" disabled>Select Model</option>
                          <option value="" disabled>Please Select Make First</option>
                      </select>
                    </div>
                  </div>

                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Body Type</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="bodyType1" name="bodyType1">
                          <option selected value="" disabled>Select Body Type</option>
<!--                          --><?php
//                          $bodyRes = $db->query("SELECT * FROM mtr_bodytype WHERE active = 1 ORDER BY so ASC");
//                          while ($bodyRow = mysqli_fetch_assoc($bodyRes)) {
//                              ?>
<!--                              <option value="--><?php //echo $bodyRow['bodyTypeID']; ?><!--">--><?php //echo $bodyRow['bodytype']; ?><!--</option>-->
<!--                              --><?php
//                          }
//                          ?>
                      </select>
                    </div>
                  </div>


                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Year</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="year1" name="year1">
                          <option selected value="" disabled>Select Year</option>
<!--                          --><?php
//                          $yearRes = $db->query("SELECT * FROM mtr_year WHERE active = 1 ORDER BY so ASC");
//                          while ($yearRow = mysqli_fetch_assoc($yearRes)) {
//                              ?>
<!--                              <option value="--><?php //echo $yearRow['yearID']; ?><!--">--><?php //echo $yearRow['year']; ?><!--</option>-->
<!--                              --><?php
//                          }
//                          ?>
                      </select>
                    </div>
                  </div>


                      <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
                    </div>
                  </div>
                </form>

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
              <div class="theme-search-area _mb-20 _p-20 _b _bc-dw theme-search-area-vert bg-white">
                <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                  <h1 class="theme-search-area-title">Modify search</h1>
                  <p class="theme-search-area-subtitle">Magna ullamcorper turpis natoque nunc</p>
                </div>
                <div class="theme-search-area-form">
                   <form id="sliderUsedCarsForm2" name="sliderUsedCarsForm2" method="post" action="/used-cars">
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Make</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="make" name="make" required>
                          <option value="" selected disabled>Select Make</option>
                          <?php
                          $makeRes = $db->query( "select * from mtr_make WHERE makeID IN (SELECT distinct(makeID) FROM view_used_cars WHERE active = 1) AND active = 1 ORDER BY make ASC" );
                          while ( $makeRow = mysqli_fetch_assoc( $makeRes ) )
                          {
                              ?>
                              <option value="<?php echo $makeRow['makeID']; ?>"><?php echo $makeRow['make']; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Model</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="model" name="model" >
                          <option selected value="" disabled>Select Model</option>
                          <option value="" disabled>Please Select Make First</option>
                      </select>
                    </div>
                  </div>

                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Body</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="bodytype" name="bodytype">
                          <option selected value="" disabled>Select Body Type</option>
<!--                          --><?php
//                          $bodyRes = $db->query("SELECT * FROM mtr_bodytype WHERE active = 1 ORDER BY so ASC");
//                          while ($bodyRow = mysqli_fetch_assoc($bodyRes)) {
//                              ?>
<!--                              <option value="--><?php //echo $bodyRow['bodyTypeID']; ?><!--">--><?php //echo $bodyRow['bodytype']; ?><!--</option>-->
<!--                              --><?php
//                          }
//                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                       <label class="theme-search-area-section-label">Year</label>
                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                      <i class="fa fa-angle-down"></i>
                      <select class="form-control" id="year" name="year">
                          <option selected value="" disabled>Select Year</option>
<!--                          --><?php
//                          $yearRes = $db->query("SELECT * FROM mtr_year WHERE active = 1 ORDER BY so ASC");
//                          while ($yearRow = mysqli_fetch_assoc($yearRes)) {
//                              ?>
<!--                              <option value="--><?php //echo $yearRow['yearID']; ?><!--">--><?php //echo $yearRow['year']; ?><!--</option>-->
<!--                              --><?php
//                          }
//                          ?>
                      </select>
                    </div>
                  </div>

                      <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>

                </form>
                    </div>
              </div>

            </div>
          </div>
          <div class="col-md-9 ">
<!--            <div class="theme-search-results-sort-select _desk-h">-->
<!--              <select>-->
<!--                <option>Price</option>-->
<!--                <option>Guest Rating</option>-->
<!--                <option>Property Class</option>-->
<!--                <option>Property Name</option>-->
<!--                <option>Recommended</option>-->
<!--                <option>Most Popular</option>-->
<!--                <option>Trendy Now</option>-->
<!--                <option>Best Deals</option>-->
<!--              </select>-->
<!--            </div>-->

            <div class="theme-search-results _mb-10">
              <div class="row row-col-gap products-grid" data-gutter="10">


                  <?php

                  $itemsPerPage = 6;
                  $currentIndex = 0;
                  $totalItems = 0;
                  $usedListingRes = $db->query("SELECT * FROM view_used_cars WHERE active = 1  " . $queryAppend." ORDER BY userCarID DESC limit 0,6");



                  $totalItems = mysqli_num_rows($usedListingRes);

                  $usedListingResQuery = $db->lastQuery() . " LIMIT ?i, ?i";


                  if ($totalItems > $itemsPerPage)
                  {

                      $usedListingRes = $db->query($usedListingResQuery, $currentIndex, $itemsPerPage);
                  }


                  // $usedListingRes = $db->query("SELECT * FROM view_used_cars WHERE active = 1 " . $queryAppend);
                  while ($usedListingRow = mysqli_fetch_assoc($usedListingRes))
                  {
                  ?>
                  <div class="col-md-4 ">
                  <div class="theme-search-results-item _br-3 _mb-10 theme-search-results-item-bs theme-search-results-item-lift theme-search-results-item-grid">
                    <div class="_h-20vh _h-mob-30vh theme-search-results-item-img-wrap-inner">
                      <img class="theme-search-results-item-img" src="uploads/usedcars/<?php echo $usedListingRow['thumbnail'];?>" alt="<?php echo $usedListingRow['make'];?> <?php echo $usedListingRow['model'];?>" title="<?php echo $usedListingRow['make'];?> <?php echo $usedListingRow['model'];?>"/>
                    </div>
                    <div class="theme-search-results-item-grid-body _pt-0">
                      <a class="theme-search-results-item-mask-link" href="/used-cars-info/<?php echo $usedListingRow['slug'];?>/<?php echo $usedCarsType;?>"></a>

                      <div class="theme-search-results-item-grid-header">
                        <h5 class="theme-search-results-item-title"><?php echo $usedListingRow['make'];?> <?php echo $usedListingRow['model'];?></h5>
                      </div>
                      <div class="theme-search-results-item-grid-caption">
                        <div class="row" data-gutter="10">
                          <div class="col-xs-7 ">
                            <div class="theme-search-results-item-car-location">
                              <div class="theme-search-results-item-car-location-body">
                                <p class="theme-search-results-item-car-location-title"><i class="fa fa-road fa-lg loc-icons"></i> <?php echo $usedListingRow['kilometers'];?>Kms</p>
                                <p class="theme-search-results-item-car-location-subtitle"><?php echo $usedListingRow['year'];?></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xs-5 ">
                            <div class="theme-search-results-item-price">
                              <p class="theme-search-results-item-price-tag"> <?php echo $_SESSION[CURRENT_CURRENCY] . " " .  $usedListingRow['price' . $_SESSION[CURRENT_CURRENCY]];?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
<!--              <div class="theme-search-results-mobile-filters" id="mobileFilters">-->
<!--                <a class="theme-search-results-mobile-filters-btn magnific-inline" href="#MobileFilters">-->
<!--                  <i class="fa fa-filter"></i>Filters-->
<!--                </a>-->
<!--                <div class="magnific-popup mfp-hide" id="MobileFilters">-->
<!--                  <div class="theme-search-results-sidebar">-->
<!--                    <div class="theme-search-results-sidebar-sections">-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Price</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-price">-->
<!--                          <input id="price-slider-mob" name="price-slider" data-min="100" data-max="500"/>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Pickup Location</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->
<!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">LGA: LaGuardia</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">421</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">EWR: Newark</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">224</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">JFK: John F. Ken...</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">251</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Non-airport</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">464</span>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Passengers</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->
<!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">1 to 2 passengers</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">182</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">3 to 5 passengers</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">333</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">6 or more</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">352</span>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Bags</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->
<!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">1 to 2 bags</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">366</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">3 to 4 bags</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">455</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">5 or more</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">487</span>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Car Type</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->
<!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Small</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">257</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Large</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">446</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Medium</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">137</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">SUV</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">221</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Van</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">449</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Commercial</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">236</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Luxury</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">347</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Pickup truck</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">239</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Convertable</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">418</span>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Payment Type</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->
<!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Pay now</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">251</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Pay at counter</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">202</span>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="theme-search-results-sidebar-section">-->
<!--                        <h5 class="theme-search-results-sidebar-section-title">Rental Agency</h5>-->
<!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->
<!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Ace</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">205</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Action</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">217</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Advantage</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">107</span>-->
<!--                            </div>-->
<!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                              <label class="icheck-label">-->
<!--                                <input class="icheck" type="checkbox"/>-->
<!--                                <span class="icheck-title">Alamo</span>-->
<!--                              </label>-->
<!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">390</span>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                          <div class="collapse" id="mobile-SearchResultsCheckboxRentalAgency">-->
<!--                            <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Avis</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">450</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Budget</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">132</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Dollar</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">302</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Enterprise</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">299</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Hertz</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">198</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">National</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">284</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Payless</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">392</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Prestige Car Rental</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">325</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Special rate</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">198</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">Thrifty</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">199</span>-->
<!--                              </div>-->
<!--                              <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->
<!--                                <label class="icheck-label">-->
<!--                                  <input class="icheck" type="checkbox"/>-->
<!--                                  <span class="icheck-title">U-Save</span>-->
<!--                                </label>-->
<!--                                <span class="theme-search-results-sidebar-section-checkbox-list-amount">418</span>-->
<!--                              </div>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                          <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxRentalAgency" aria-expanded="false">Show more-->
<!--                            <i class="fa fa-angle-down"></i>-->
<!--                          </a>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
            </div>
              <div class="row row-col-gap" data-gutter="6"
                   id="load_data_message">
             <?php

             if($totalItems>9)
                 { ?>
                     <a class="btn _tt-uc _fs-sm btn-white btn-block btn-lg" href="#">Load More Results</a>
                 <?php } ?>

          </div>
          </div>

        </div>
      </div>
    </div>




      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>

<script>
    var $ = jQuery;

    jQuery("#make1").change(function (e) {
        // console.log("Calling this script!");
        var sendData = new FormData();
        sendData.append("id", jQuery(this).val());

        // console.log(jQuery(this).val());

        jQuery.ajax({
            type: "POST",
            url: "ajax_fetch_model.php",
            data: sendData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                var models = data.split("|")[0];
                var bodytypes = data.split("|")[1];
                var years = data.split("|")[2];

                $("#model1").html(models);
                // $("#model").selectpicker('refresh');

                $("#bodytype1").html(bodytypes);
                // $("#bodytype").selectpicker('refresh');

                $("#year1").html(years);
                // $("#year").selectpicker('refresh');

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });


    //model
    jQuery("#model1").change(function (e) {

        // alert($(this).val());
        var sendData = new FormData();
        sendData.append("makeID", jQuery("#make1").val());
        sendData.append("modelID", jQuery(this).val());

        jQuery.ajax({
            type: "POST", url: "ajax_fetch_model_change.php", data: sendData, processData: false, contentType: false, success: function (data) {
                // console.log("Test: "+data);
                var bodytypes = data.split("|")[0];
                var years = data.split("|")[1];


                $("#bodytype1").html(bodytypes);
                // $("#bodytype").selectpicker('refresh');

                $("#year1").html(years);
                // $("#year").selectpicker('refresh');

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });


    //bodytype
    jQuery("#bodyType1").change(function (e) {
        // alert($(this).val());

        var sendData = new FormData();
        sendData.append("makeID", jQuery("#make1").val());
        sendData.append("modelID", jQuery("#model1").val());
        sendData.append("bodyTypeID", jQuery(this).val());

        // console.log(jQuery(this).val());

        jQuery.ajax({
            type: "POST", url: "ajax_fetch_bodytype_change.php", data: sendData, processData: false, contentType: false, success: function (data) {

                // console.log(data);
                var years = data.split("|")[0];

                $("#year1").html(years);
                // $("#year").selectpicker('refresh');

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });



    $("form#sliderUsedCarsForm2").submit(function(e){
        var formData = new FormData();

        $.ajax({
            type: "POST",
            url: "used-cars",
            data: formData,
            success: function (data)
            {
                console.log(data);
            }
        });
        return false;
    });






    $(document).ready(function () {
//alert("die");
        var start = 3; //Starting position
        var limit = 3; //Show records limit
        var action = 'inactive';

        function load_country_data(limit, start) {
           var make =$('input[name=make33]').val();
            var model =$('input[name=model33]').val();
            var bodyType =$('input[name=bodyType33]').val();
            var year =$('input[name=year33]').val();
            var usedCarsType =$('input[name=usedCarsType33]').val();

          // alert(make);
            start += limit;
            $.ajax({
                type: 'POST',
                url: 'fetchusedcar.php',
                data: {'start': start, 'limit': limit,'make':make,'model':model,'bodyType':bodyType,'year':year,'usedCarsType':usedCarsType},
                cache: false,
                success: function (data) {
                    //console.log(data); return;
                    $("#load_data_message").hide();
                    if (data != '') {
                        $(".products-grid").append(data);
                        $("#load_data_message").show();
                        $('#load_data_message').html("<div class='col-md-4 col-md-offset-4'><a class=\'btn _tt-uc _fs-sm btn-white btn-block btn-lg\' href='#'>Load More Results</a></div>");
                        action = "inactive";
                    }
                    else {
                        $('#load_data_message').html("<div class='col-md-4 col-md-offset-4'><a class=\'btn _tt-uc _fs-sm btn-white btn-block btn-lg\' href='#'>No More Data</a></div>");
                        action = "active";
                    }
                }
            });
        }



        if (action == 'inactive') {
            action = 'active';
            load_country_data(limit, start);
        }

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() > $(".products-grid").height() && action == 'inactive') {
                action = 'active';
                start = start + limit;
                setTimeout(function () {
                    load_country_data(limit, start);
                }, 3000);
            }
        });

    });

</script>

   </body>
</html>