<?php include "inc_opendb.php";
$PAGEID = "Rent a Cars";
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
$queryAppend = "";
//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();

// * [pickupLocation] => 1
//    [dropLocation] => 1
//    [pickupDate] => 09/29/2020 4:37 PM
//    [dropDate] => 09/29/2020 4:37 PM
//    [carClass] => 4
// */

if (isset($_POST["carClass"]))
{
    $carClass = filter_var($_POST['carClass'], FILTER_SANITIZE_STRING);
    //$queryAppend .= " OR id_bodytype = 0”;
}
if (isset($_POST["pickupLocation"]))
{
    $pickupLocation = filter_var($_POST['pickupLocation'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["pickupLocation"]))
{
    $dropLocation = filter_var($_POST['dropLocation'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["pickupLocation"]))
{
    $pickupDate = filter_var($_POST['pickupDate'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["pickupLocation"]))
{
    $dropDate = filter_var($_POST['dropDate'], FILTER_SANITIZE_STRING);
}
if (isset($_POST["pickupLocation"]))
{
    $carClass = filter_var($_POST['carClass'], FILTER_SANITIZE_STRING);
}
$geolocation    = $_SESSION["current_geolocation" ];

//echo $pickupLocation."-".$dropLocation."-".$pickupDate."-".$dropDate."-".$carClass;
//exit();


?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php';
$geo = $_SESSION[ CURRENT_GEOLOCATION ];
$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE availableAt LIKE '%$geo%' and carClassID  = $carClass ");

$counter       = mysqli_num_rows( $rentCarResult );
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
                                <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Rent A Car</h2>
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
                                    <a href="#">Rent a Car</a>
                                </p>
                            </li>
                            <li>
                                <p class="theme-breadcrumbs-item-title">
                                    <a href="#">Search Results</a>
                                </p>
                                <p class="theme-breadcrumbs-item-subtitle"><?php echo $counter; ?> vehicles</p>
                            </li>


                        </ul>
                    </div>
                    <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                        <h4 class="theme-search-area-inline-title">New York Cars</h4>
                        <p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>
                        <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal"> <i class="fa fa-pencil"></i>Edit </a>
                        <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
                            <div class="theme-search-area theme-search-area-vert">
                                <div class="theme-search-area-header">
                                    <h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>
                                    <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                                </div>
                                <div class="theme-search-area-form">
                                    <div class="theme-search-area-section first theme-search-area-section-curved">
                                        <label class="theme-search-area-section-label">Pick Up</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-location-pin"></i> <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Pick up location" data-provide="typeahead"/>
                                        </div>
                                    </div>
                                    <div class="theme-search-area-section theme-search-area-section-curved">
                                        <label class="theme-search-area-section-label">Drop Off</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-location-pin"></i> <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Drop off location" data-provide="typeahead"/>
                                        </div>
                                    </div>

                                    <div class="theme-search-area-section theme-search-area-section-curved">
                                        <label class="theme-search-area-section-label">Check In</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/> <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                                        </div>
                                    </div>


                                    <div class="theme-search-area-section theme-search-area-section-curved">
                                        <label class="theme-search-area-section-label">Check Out</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/> <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
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
                        <form id="rentcars" name="rentcars" method="post" action="/rent-a-car">

                            <div class="theme-search-area-form" id="hero-search-form">
                                <div>
                                    <label class="theme-search-area-section-label">Pick Up Information</label>

                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <label class="theme-search-area-section-label">Pick up location</label>
                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                            <i class="fa fa-angle-down"></i>


                                            <select class="form-control" id="pickupLocation" name="pickupLocation" required>

                                                <option selected value="" disabled>Pick up location  </option>
                                                <?php
                                                $result = $db->query( "SELECT * FROM pickup_drop_locations WHERE active = 1 ORDER BY so ASC" );
                                                while ( $row = mysqli_fetch_assoc( $result ) )
                                                {
                                                    ?>
                                                    <option value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <label class="theme-search-area-section-label">Drop off location</label>
                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                            <i class="fa fa-angle-down"></i>

                                            <select class="form-control" id="dropLocation" name="dropLocation" required>
                                                <!--												<i class="theme-search-area-section-icon lin lin-location-pin"></i>-->
                                                <option selected value="" disabled>Drop off location</option>
                                                <?php
                                                $result = $db->query( "SELECT * FROM pickup_drop_locations WHERE active = 1 ORDER BY so ASC" );
                                                while ( $row = mysqli_fetch_assoc( $result ) )
                                                {
                                                    ?>
                                                    <option value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <label class="theme-search-area-section-label">Pick Up Date</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                            <input class="theme-search-area-section-input datePickerStart _mob-h" id="pickupDate" required name="pickupDate" type="text" placeholder="Pick Up Date"/>
                                            <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
                                        </div>
                                    </div>
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <label class="theme-search-area-section-label">Drop Off Date</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                            <input class="theme-search-area-section-input datePickerEnd _mob-h" id="dropDate" name="dropDate" required type="text" placeholder="Drop Off Date"/>
                                            <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
                                        </div>
                                    </div>


                                    <select class="form-control" id="carClass" name="carClass">
                                        <option  value="1" >Any</option>
                                        <option  value="2" >Economy</option>
                                        <option  value="3" >SUV</option>
                                        <option  value="4" >Luxury</option>
                                        <option  value="5" >Budget</option>

                                    </select>
                                    <input class="form-control" id="geolocation" name="geolocation" type="hidden" value="<?php echo $geolocation; ?>" />
                                </div>

                                <div>






                                </div>
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">


                                </div>

                                <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary" id="btnRentSearch" name="btnRentSearch" type="submit">Modify Search</button>

                            </div>

                        </form>
                    </div>


                </div>



            </div>
            <div class="col-md-8-5 ">
                <div class="theme-search-results-item theme-search-results-item-">
                    <div class="theme-search-results-item-preview">

                        <div class="row row-col-static" id="sticky-parent" data-gutter="20">
                            <h4>Your Summary</h4>
                            <div class="col-md-6 ">
                                <h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Pickup</h5>

                                <ul class="theme-search-results-item-car-list summary-txt">
                                    <li>
                                        <i class="fa fa-map-marker fa-lg loc-icons"></i> <?php echo getLocationFromID( $pickupLocation ); ?>
                                    </li>
                                    <br>
                                    <li>
                                        <i class="fa fa-calendar fa-lg loc-icons"></i> <?php echo date( 'F d, Y', strtotime( $pickupDate ) ); ?>
                                    </li>
                                    <br>
                                    <li>
                                        <i class="fa fa-clock-o fa-lg loc-icons"></i> <?php echo date( 'h:i A', strtotime( $pickupDate ) ); ?>
                                    </li>
                                    <br>

                                </ul>
                            </div>

                            <div class="col-md-6 ">
                                <h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Dropoff</h5>

                                <ul class="theme-search-results-item-car-list summary-txt">
                                    <li>
                                        <i class="fa fa-map-marker fa-lg loc-icons"></i> <?php echo getLocationFromID( $dropLocation ); ?>
                                    </li>
                                    <br>
                                    <li>
                                        <i class="fa fa-calendar fa-lg loc-icons"></i> <?php echo date( 'F d, Y', strtotime( $dropDate ) ); ?>
                                    </li>
                                    <br>
                                    <li>
                                        <i class="fa fa-clock-o fa-lg loc-icons"></i> <?php echo date( 'h:i A', strtotime( $dropDate ) ); ?>
                                    </li>
                                    <br>

                                </ul>
                            </div>

                        </div>

                        <?php
                        $totalDays = "";
                        /*$earlier   = strtotime( $pickupDate );
                        $later     = strtotime( $dropDate );

                        $total   = $later - $earlier;
                        $hours   = floor( $total / 60 / 60 );
                        $minutes = round( ( $total - ( $hours * 60 * 60 ) ) / 60 );

                        $days      = $hours / 24;
                        $totalDays = round( $days );
                        //echo $hours.'.'.$minutes;*/

                        $startDateTimeStamp  = strtotime($pickupDate);
                        $endDateTimeStamp = strtotime($dropDate);

                        $totalHours = abs($endDateTimeStamp - $startDateTimeStamp)/(60*60);
                        $totalDays =  ceil($totalHours/24);
                        ?>
                        <h5>Rental Length: <?php echo $totalDays; ?> day<?php  echo $totalDays > 1?'s':''; ?></h5>
                    </div>
                </div>
                <hr>

                <!--                <div class="theme-search-results-sort _mob-h _b-n clearfix">-->
                <!--                    <h5 class="theme-search-results-sort-title">Sort by:</h5>-->
                <!--                    <ul class="theme-search-results-sort-list">-->
                <!--                        <li class="active">-->
                <!--                            <a href="#">Price <span>Low &rarr; High</span> </a>-->
                <!--                        </li>-->
                <!---->
                <!---->
                <!--                    </ul>-->
                <!--                    <div class="dropdown theme-search-results-sort-alt">-->
                <!---->
                <!--                    </div>-->
                <!--                </div>-->

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
                    <form name="rentcarsStep1" id="rentcarsStep1" method="post" role="form" action="/book-rent-cars">
                        <input type="hidden" name="pickupLocation2" id="pickupLocation2" value="<?php echo $pickupLocation; ?>"/>
                        <input type="hidden" name="dropLocation2" id="dropLocation2" value="<?php echo $dropLocation; ?>"/>
                        <input type="hidden" name="pickupDate2" id="pickupDate2" value="<?php echo $pickupDate; ?>"/>
                        <input type="hidden" name="dropDate2" id="dropDate2" value="<?php echo $dropDate; ?>"/>
                        <input type="hidden" name="carClass2" id="carClass2" value="<?php echo $carClass; ?>"/>
                        <input type="hidden" name="totalDays2" id="totalDays2" value="<?php echo $totalDays; ?>"/>
                        <input type="hidden" name="geolocation2" id="geolocation2" value="<?php echo $totalDays; ?>"/>

                        <div class="_mob-h">


                            <div class="theme-search-results-item theme-search-results-item-">
                                <div class="theme-search-results-item-preview products-grid">
                                    <?php
                                    $itemsPerPage = 3;
                                    $currentIndex = 0;
                                    $totalItems = 0;
                                    $rentCarResult =
                                        $db->query( "SELECT * FROM rent_lease_cars WHERE availableAt LIKE '%$geo%' and carClassID  = $carClass ORDER BY rentLeaseCarID DESC limit 0,3");
                                    //  $db->query( "SELECT * FROM rent_lease_cars WHERE availableAt LIKE ?s ORDER BY rentLeaseCarID DESC limit 0,3", '%' . $_SESSION[ CURRENT_GEOLOCATION ] . '%' );
                                    $totalItems = mysqli_num_rows($rentCarResult);

                                    $rentCarListingResQuery = $db->lastQuery() . " LIMIT ?i, ?i";


                                    if ($totalItems > $itemsPerPage)
                                    {

                                        $rentCarResult = $db->query($rentCarListingResQuery, $currentIndex, $itemsPerPage);
                                    }

                                    $i             = 0;
                                    //$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE availableAt LIKE ?s", '%' . $_SESSION[ CURRENT_GEOLOCATION ] . '%' );
                                    while ( $rentCarRow = mysqli_fetch_assoc( $rentCarResult ) )
                                    {
                                        $i ++;
                                        ?>


                                        <div class="row" data-gutter="20">
                                            <!--    <input type="text" name="slug" id="slug" value="
                                        <?php
                                            //echo $rentCarRow['slug'];
                                            ?>"/>
                  -->
                                            <div class="col-md-3 ">
                                                <div class="theme-search-results-item-img-wrap">
                                                    <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>
                                                </div>
                                                <ul class="theme-search-results-item-car-feature-list">
                                                    <li>
                                                        <i class="fa fa-male"></i> <span><?php echo $rentCarRow['noOfSeats']; ?>
                            </span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-suitcase"></i> <span><?php echo $rentCarRow['luggage']; ?>
                            </span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $rentCarRow['transmissionID'] ); ?>

                            </span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-snowflake-o"></i> <span><?php if ( $rentCarRow['ac'] == 'Y' )
                                                            {
                                                                echo "A/C";
                                                            } else
                                                            {
                                                                echo "Non-A/C";
                                                            } ?>

                            </span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-snowflake-o"></i> <span><?php echo $rentCarRow['noOfDoors']; ?>

                            </span>
                                                    </li>

                                                </ul>
                                            </div>

                                            <div class="col-md-7 ">
                                                <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle']; ?></h5>
                                                <div class="theme-search-results-item-car-location">

                                                    <div class="theme-search-results-item-car-location-body">
                                                        <p class="theme-search-results-item-car-location-title">
                                                            <!--                                <input type="hidden" name="carTitle" id="carTitle" value="--><?php //echo $rentCarRow['carTitle'];
                                                            ?><!--" />-->
                                                            <!--                                <input type="hidden" name="carClass" id="carClass" value="--><?php //echo $rentCarRow['carClassID'];
                                                            ?><!--" />-->
                                                            <?php echo getCarClassedFromID( $rentCarRow['carClassID'] ); ?></p>
                                                        <p class="theme-search-results-item-car-location-subtitle">or similar</p>
                                                    </div>
                                                </div>
                                                <ul class="theme-search-results-item-car-list"><?php $extraFeatures = $rentCarRow['extraFeatures'];
                                                    $featureResult                                                  = $db->query( "SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)" );
                                                    while ( $featureRow = mysqli_fetch_assoc( $featureResult ) )
                                                    {
                                                        ?>
                                                        <li class="list-float "><i class="fa fa-check"></i><?php echo $featureRow['extraFeatures']; ?>
                                                        </li><?php } ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-2 ">
                                                <div class="theme-search-results-item-book">
                                                    <div class="theme-search-results-item-price">
                                                        <p class="theme-search-results-item-price-sign">Pay Online</p>
                                                        <p class="theme-search-results-item-price-tag">
                                                            <?php

                                                            echo $_SESSION[ CURRENT_CURRENCY ] . " " . $rentCarRow[ 'onlinePrice' . $_SESSION[ CURRENT_CURRENCY ] ];

                                                            ?>

                                                        </p>
                                                        <p class="theme-search-results-item-price-sign">per day</p>
                                                    </div>

                                                </div>

                                                <div class="theme-search-results-item-book">
                                                    <div class="theme-search-results-item-price">
                                                        <p class="theme-search-results-item-price-sign">Pay Later</p>
                                                        <p class="theme-search-results-item-price-tag">
                                                            <?php

                                                            echo $_SESSION[ CURRENT_CURRENCY ] . " " . $rentCarRow[ 'offlinePrice' . $_SESSION[ CURRENT_CURRENCY ] ];

                                                            ?>
                                                        </p>
                                                        <p class="theme-search-results-item-price-sign">per day</p>
                                                    </div>

                                                    <!--													<a class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn btnBook" id="btnBook" name="btnBook" href="/book-rent-cars/--><?php //echo $rentCarRow['slug'];
                                                    ?><!--">Book</a>-->

                                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>"  data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBook" type="submit">Book</button>


                                                </div>


                                            </div>
                                        </div>
                                        <hr/>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>

                        </div>
                    </form>

                    <!--
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
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$61</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/2.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Audi Q7</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Terminal pickup</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$45</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/3.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Chevrolet Cruze</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$27</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/4.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Volkswagen Jetta</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$91</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/5.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Ford Fiesta</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$72</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/6.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Mazda 5</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">John F. Kennedy</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Terminal pickup</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$27</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/7.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Citroen DS4</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$38</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/8.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Volkswagen Touareg</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$56</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/9.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Nissan Juke</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$82</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/10.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Volvo xc70</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Terminal pickup</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$78</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/11.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Chevrolet Spark</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$93</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/12.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Mazda CX-5</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-building theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">93 Bayport Ave.</p>
                                    <p class="theme-search-results-item-car-location-subtitle">City pickup</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$69</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/13.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Nissan NV200</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Terminal pickup</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$77</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/14.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Volkswagen Golf</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">John F. Kennedy</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$86</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/15.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Hyundai Santa Fe Sport</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Terminal pickup</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$55</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">
                        <div class="_h-30vh theme-search-results-item-img-wrap-inner">
                          <img class="theme-search-results-item-img" src="img/car-results/16.jpg" alt="Image Alternative text" title="Image Title"/>
                        </div>
                        <div class="theme-search-results-item-grid-body _pt-0">
                          <a class="theme-search-results-item-mask-link" href="#"></a>
                          <div class="theme-search-results-item-grid-header">
                            <h5 class="theme-search-results-item-title _fs">Maserati Quattroporte</h5>
                          </div>
                          <div class="theme-search-results-item-grid-caption">
                            <div class="row" data-gutter="10">
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$25</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
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
                              <div class="col-xs-9 ">
                                <div class="theme-search-results-item-car-location">
                                  <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                                  <div class="theme-search-results-item-car-location-body">
                                    <p class="theme-search-results-item-car-location-title">Newark Liberty</p>
                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xs-3 ">
                                <div class="theme-search-results-item-price">
                                  <p class="theme-search-results-item-price-tag">$65</p>
                                  <p class="theme-search-results-item-price-sign">per day</p>
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
                              <h5 class="theme-search-results-sidebar-section-title">Price</h5>
                              <div class="theme-search-results-sidebar-section-price">
                                <input id="price-slider-mob" name="price-slider" data-min="100" data-max="500"/>
                              </div>
                            </div>
                            <div class="theme-search-results-sidebar-section">
                              <h5 class="theme-search-results-sidebar-section-title">Pickup Location</h5>
                              <div class="theme-search-results-sidebar-section-checkbox-list">
                                <div class="theme-search-results-sidebar-section-checkbox-list-items">
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">LGA: LaGuardia</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">101</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">EWR: Newark</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">269</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">JFK: John F. Ken...</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">490</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Non-airport</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">131</span>
                                  </div>
                                </div>
                              </div>
                            </div>
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
                            <div class="theme-search-results-sidebar-section">
                              <h5 class="theme-search-results-sidebar-section-title">Payment Type</h5>
                              <div class="theme-search-results-sidebar-section-checkbox-list">
                                <div class="theme-search-results-sidebar-section-checkbox-list-items">
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Pay now</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">454</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Pay at counter</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">340</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="theme-search-results-sidebar-section">
                              <h5 class="theme-search-results-sidebar-section-title">Rental Agency</h5>
                              <div class="theme-search-results-sidebar-section-checkbox-list">
                                <div class="theme-search-results-sidebar-section-checkbox-list-items">
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Ace</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">171</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Action</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">465</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Advantage</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">137</span>
                                  </div>
                                  <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                    <label class="icheck-label">
                                      <input class="icheck" type="checkbox"/>
                                      <span class="icheck-title">Alamo</span>
                                    </label>
                                    <span class="theme-search-results-sidebar-section-checkbox-list-amount">393</span>
                                  </div>
                                </div>
                                <div class="collapse" id="mobile-SearchResultsCheckboxRentalAgency">
                                  <div class="theme-search-results-sidebar-section-checkbox-list-items theme-search-results-sidebar-section-checkbox-list-items-expand">
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Avis</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">368</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Budget</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">196</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Dollar</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">198</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Enterprise</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">413</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Hertz</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">396</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">National</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">483</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Payless</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">191</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Prestige Car Rental</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">282</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Special rate</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">299</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">Thrifty</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">458</span>
                                    </div>
                                    <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                      <label class="icheck-label">
                                        <input class="icheck" type="checkbox"/>
                                        <span class="icheck-title">U-Save</span>
                                      </label>
                                      <span class="theme-search-results-sidebar-section-checkbox-list-amount">341</span>
                                    </div>
                                  </div>
                                </div>
                                <a class="theme-search-results-sidebar-section-checkbox-list-expand-link" role="button" data-toggle="collapse" href="#mobile-SearchResultsCheckboxRentalAgency" aria-expanded="false">Show more
                                  <i class="fa fa-angle-down"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      -->
                </div>

                <div data-gutter="3"
                     id="load_data_message">
                    <?php

                    if($totalItems>3)
                    { ?>

                        <a class="btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg" href="#">Load More Results</a>
                    <?php } ?>

                </div>

            </div>

        </div>
    </div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>
<!--<script>
    <?php
/*    $i=0;
    $rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE availableAt LIKE ?s", '%' . $_SESSION[CURRENT_GEOLOCATION] . '%' );
    while ( $rentCarRow = mysqli_fetch_assoc( $rentCarResult ) )
    {
    $i++;
    */ ?>
    $("form#btnBook<?php /*echo $i;*/ ?>").click(function (e) {
        console.log("Calling this book button click!");
        e.preventDefault();
        var sl = $(this).data("id");
        alert(sl);
        var formData = new FormData();

        $.ajax({
            type: "POST",
            url: "book-rent-cars",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
            }
        });
        return false;
    });
    <?php
/*    }
*/ ?>
</script>-->

<script>
    $(document).ready(function () {
//alert("die");
        var start = 0; //Starting position
        var limit = 3; //Show records limit
        var action = 'inactive';


        function load_country_data(limit, start) {
            var pickupLocation = $('input[name=pickupLocation2]').val();
            var dropLocation = $('input[name=dropLocation2]').val();
            var pickupDate = $('input[name=pickupDate2]').val();
            var dropDate = $('input[name=dropDate2]').val();
            var carClass = $('input[name=carClass2]').val();
            var geolocation = $('input[name=geolocation2]').val();

// alert(make);
            start += limit;
            $.ajax({
                type: 'POST',
                url: 'fetchrentcar.php',
                data: {'start': start, 'limit': limit,'pickupLocation':pickupLocation,'dropLocation':dropLocation,'pickupDate':pickupDate,'dropDate':dropDate,'carClass':carClass,'geolocation':geolocation},
                cache: false,
                success: function (data) {
//console.log(data); return;
                    $("#load_data_message").hide();
                    if (data != '') {
                        $(".products-grid").append(data);
                        $("#load_data_message").show();
                        $('#load_data_message').html(" <div data-gutter='3' id='load_data_message'><a class='btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg' href='#'>Load More Results</a></div>");
                        action = "inactive";
                    }
                    else {
                        $('#load_data_message').html("<div data-gutter='3' id='load_data_message'><a class='btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg' href='#'>No More Data</a></div>");
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