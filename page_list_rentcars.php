<?php include "inc_opendb.php";

$PAGEID = "Rent a Car";

$queryAppend = "";



//error_reporting( E_ALL );

//ini_set( 'display_errors', 1 );



$locSlug = "";

if(isset($_GET['slug']) && !empty($_GET['slug'])){

    $locSlug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING);

}





if(!empty($locSlug))

{

    $queryAppend = " ORDER BY RAND() ";

}




$totalDays = 30;

$pickupLocation = 'Dubai - Al Quoz';

$dropLocation = 'Dubai - Al Quoz';

?>



<!DOCTYPE HTML>

<html lang="en">

<head>

    <meta charset="UTF-8"/>

    <?php include 'inc_metadata.php'; ?>

</head>

<body>

<?php include 'inc_header.php';

$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1");

$counter       = mysqli_num_rows( $rentCarResult );

?>





<div class="theme-hero-area">

    <div class="theme-hero-area-bg-wrap">

        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel-1.png);"></div>

        <div class="theme-hero-area-grad-mask"></div>

    </div>

    <div class="theme-hero-area-body">

        <div class="container">

            <div class="row _pv-30">

                <div class="col-md-6 ">

                    <div class="">

                        <div class="theme-hero-text theme-hero-text-white">

                            <div class="breadcrumb-margins">



                                <?php

                                if(!empty($locSlug)){

                                    ?>

                                    <h1 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Car Rental in <?php echo $locSlug; ?> </h1>

                                    <?php

                                }

                                else

                                {



                                    ?>

                                    <h1 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Rent A Car</h1>

                                    <?php

                                }

                                ?>









                            </div>

                        </div>



                    </div>

                    <!--					<div class="theme-search-area-inline _desk-h theme-search-area-inline-white">-->

                    <!--						<h4 class="theme-search-area-inline-title">Autorent Cars</h4>-->

                    <!--						<p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>-->

                    <!--						<a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal"> <i class="fa fa-pencil"></i>Edit </a>-->

                    <!--						<div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">-->

                    <!--							<div class="theme-search-area theme-search-area-vert">-->

                    <!--								<div class="theme-search-area-header">-->

                    <!--									<h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>-->

                    <!--									<p class="theme-search-area-subtitle">Prices might be different from current results</p>-->

                    <!--								</div>-->

                    <!--								<div class="theme-search-area-form">-->

                    <!--									<div class="theme-search-area-section first theme-search-area-section-curved">-->

                    <!--										<label class="theme-search-area-section-label">Pick Up</label>-->

                    <!--										<div class="theme-search-area-section-inner">-->

                    <!--											<i class="theme-search-area-section-icon lin lin-location-pin"></i> <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Pick up location" data-provide="typeahead"/>-->

                    <!--										</div>-->

                    <!--									</div>-->

                    <!--									<div class="theme-search-area-section theme-search-area-section-curved">-->

                    <!--										<label class="theme-search-area-section-label">Drop Off</label>-->

                    <!--										<div class="theme-search-area-section-inner">-->

                    <!--											<i class="theme-search-area-section-icon lin lin-location-pin"></i> <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Drop off location" data-provide="typeahead"/>-->

                    <!--										</div>-->

                    <!--									</div>-->

                    <!---->

                    <!--									<div class="theme-search-area-section theme-search-area-section-curved">-->

                    <!--										<label class="theme-search-area-section-label">Check In</label>-->

                    <!--										<div class="theme-search-area-section-inner">-->

                    <!--											<i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/> <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>-->

                    <!--										</div>-->

                    <!--									</div>-->

                    <!---->

                    <!---->

                    <!--									<div class="theme-search-area-section theme-search-area-section-curved">-->

                    <!--										<label class="theme-search-area-section-label">Check Out</label>-->

                    <!--										<div class="theme-search-area-section-inner">-->

                    <!--											<i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/> <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>-->

                    <!--										</div>-->

                    <!--									</div>-->

                    <!---->

                    <!---->

                    <!--									<button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>-->

                    <!--								</div>-->

                    <!--							</div>-->

                    <!--						</div>-->

                    <!--					</div>-->

                </div>

                <div class="col-md-6">

                    <ul class="theme-breadcrumbs _mt-20 right-breadcrumb">

                        <li>

                            <p class="theme-breadcrumbs-item-title">

                                <a href="/">Home</a>

                            </p>

                        </li>

                        <li>

                            <p class="theme-breadcrumbs-item-title">

                                <a>Rent a Car</a>

                            </p>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>





<div class="theme-page-section theme-page-section-gray">

    <div class="container">

        <div class="row row-col-static" id="sticky-parent" data-gutter="20">

            <div class="col-md-3 ">

                <div class="sticky-col">


                    <div class="row clickme-div collapsible">
                        <div class="col-md-12 col-sm-12">

                            <a class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary modify-search-btn btn btn-primary-invert btn-shadow text-upcase book-btn-right clickme-btn">
                                Click Here to Modify Search
                            </a>

                            <br>
                        </div>

                    </div>


                    <div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white modifySearchDiv content">

                        <form id="rentcars" name="rentcars" method="post" action="/rent-a-car">



                            <div class="theme-search-area-form" id="hero-search-form">

                                <div>

                                    <label class="theme-search-area-section-label">Modify Search</label>



                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">

                                        <label class="theme-search-area-section-label">Car Category</label>

                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">

                                            <i class="fa fa-angle-down"></i>









                                            <select class="form-control" id="rentBodyType" name="rentBodyType" required>



                                                <option selected value="" disabled>Car Category</option>

                                                <?php

                                                $result = $db->query( "SELECT * FROM rent_lease_cars

																		LEFT JOIN mtr_bodytype ON rent_lease_cars.bodyTypeID = mtr_bodytype.bodyTypeID

																		WHERE rent_lease_cars.active = 1 GROUP BY rent_lease_cars.bodyTypeID" );



                                                while ( $row = mysqli_fetch_assoc( $result ) )

                                                {

                                                    ?>

                                                    <option value="<?php echo $row['bodyTypeID']; ?>"><?php echo $row['bodytype']; ?></option>

                                                    <?php

                                                }

                                                ?>

                                            </select>



                                        </div>

                                    </div>





                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">

                                        <label class="theme-search-area-section-label">Pick up location</label>

                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">

                                            <i class="fa fa-angle-down"></i>





                                            <select class="form-control" id="pickupLocation" name="pickupLocation" required>



                                                <option selected value="" disabled>Pick up location</option>

                                                <?php

                                                $result = $db->query( "SELECT * FROM pickup_drop_locations WHERE active = 1 ORDER BY so ASC" );

                                                while ( $row = mysqli_fetch_assoc( $result ) )

                                                {
                                                    if($row['location'] == 'Dubai - Al Quoz')
                                                    {
                                                        ?>

                                                        <option selected value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>

                                                        <?php
                                                    }
                                                    else
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

                                                <option selected value="" disabled>Drop off</option>

                                                <?php

                                                $result = $db->query( "SELECT * FROM pickup_drop_locations WHERE active = 1 ORDER BY so ASC" );

                                                while ( $row = mysqli_fetch_assoc( $result ) )

                                                {
                                                    if($row['location'] == 'Dubai - Al Quoz')
                                                    {
                                                        ?>

                                                        <option selected value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>

                                                        <?php
                                                    }
                                                    else
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

                                            <input class="theme-search-area-section-input datePickerStart rentalListPickupDate" id="pickupDate" required name="pickupDate" type="text" placeholder="Pick Up Date"/> <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

                                        </div>

                                    </div>





                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

                                        <label class="theme-search-area-section-label">Drop Off Date</label>

                                        <div class="theme-search-area-section-inner">

                                            <i class="theme-search-area-section-icon lin lin-calendar"></i>

                                            <input class="theme-search-area-section-input datePickerEnd rentalListDropDate"

                                                   id="dropDate" name="dropDate" required type="text" placeholder="Drop Off Date"/> <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

                                        </div>

                                    </div>



                                </div>



                                <div>





                                </div>

                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">





                                </div>



                                <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary modify-search-btn" id="btnRentSearch" name="btnRentSearch" type="submit">Modify Search</button>



                            </div>



                        </form>

                    </div>





                    <div class="theme-sidebar-section _mb-10">



                        <?php

                        $pageID = '19';

                        $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

                        $row    = mysqli_fetch_assoc( $result );

                        ?>



                        <ul class="theme-sidebar-section-features-list">

                            <?php echo $row['summary'];?>



                        </ul>

                    </div>



                </div>











            </div>

            <!--			<div class="col-md-9 _mob-h">-->
            <div class="col-md-9 ">



                <!--                <div class="theme-search-results-item theme-search-results-item-">-->

                <!--                    <div class="theme-search-results-item-preview">-->

                <!---->

                <!--                        <div class="row row-col-static" id="sticky-parent" data-gutter="20">-->

                <!--                            <h4>--><?php //echo $row['pageTitle'];?><!--</h4>-->

                <!--                            --><?php //echo $row['summary'];?>

                <!--                        </div>-->

                <!--                    </div>-->

                <!--                </div>-->

                <!--                <hr>-->



                <div class="theme-search-results">

                    <form name="rentcarsStep1" id="rentcarsStep1" method="post" role="form" action="/book-rent-cars">




                        <input type="hidden" name="pickupLocation2" id="pickupLocation2" value="<?php echo $pickupLocation; ?>"/>

                        <input type="hidden" name="dropLocation2" id="dropLocation2" value="<?php echo $dropLocation; ?>"/>

                        <input type="hidden" name="pickupDate2" id="pickupDate2" value="<?php echo $pickupDate; ?>"/>

                        <input type="hidden" name="dropDate2" id="dropDate2" value="<?php echo $dropDate; ?>"/>

                        <input type="hidden" name="rentBodyType2" id="rentBodyType2" value="<?php echo $rentBodyType; ?>"/>

                        <input type="hidden" name="totalDays2" id="totalDays2" value="<?php echo $totalDays; ?>"/>



                        <div class="">



                            <div class="theme-search-results-item theme-search-results-item-">

                                <div class="theme-search-results-item-preview products-grid" id="carItemsContainer">

                                    <?php

                                    $itemsPerPage = 3;

                                    $totalItems   = 0;







                                    //									$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 $queryAppend limit 0,3" );



                                    $rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 $queryAppend ORDER BY dailyAED ASC");

                                    $totalItems    = mysqli_num_rows( $rentCarResult );





                                    $rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 $queryAppend ORDER BY dailyAED ASC limit 0,?i", $itemsPerPage );



                                    //									$totalItems    = mysqli_num_rows( $rentCarResult );



                                    //									$rentCarListingResQuery = $db->lastQuery() . " LIMIT ?i, ?i";



                                    if ( $totalItems > $itemsPerPage )

                                    {

//										$rentCarResult = $db->query( $rentCarListingResQuery, $currentIndex, $itemsPerPage );

                                    }



                                    $i = 0;

                                    //$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE availableAt LIKE ?s", '%' . $_SESSION[ CURRENT_GEOLOCATION ] . '%' );

                                    while ( $rentCarRow = mysqli_fetch_assoc( $rentCarResult ) )

                                    {

                                        $i ++;

                                        ?>



                                        <div class="row" data-gutter="20">

                                            <div class="col-md-3 ">

                                                <div class="theme-search-results-item-img-wrap">
                                                    <?php
                                                    if ( ! empty( $rentCarRow[ 'dailyDummyAED' ] && $rentCarRow[ 'weeklyDummyAED' ] && $rentCarRow[ 'monthlyDummyAED' ] ) )
                                                    {
                                                        ?>
                                                        <div class="card" data-label="Deal">
                                                            <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>
                                                        </div>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>
                                                        <?php
                                                    }
                                                    ?>
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


                                                    <?php if ( $rentCarRow['ac'] == 'Y' )
                                                    {
                                                        ?>
                                                        <li>

                                                            <i class="fa fa-bluetooth"></i> <span><?php echo "B/T";?></span>

                                                        </li>
                                                    <?php } ?>





                                                    <li>

                                                        <i class="fa fa-car"></i> <span><?php echo $rentCarRow['noOfDoors']; ?>



                            </span>

                                                    </li>



                                                </ul>

                                            </div>



                                            <div class="col-md-3 extraFeatures-mar-bot">

                                                <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle']; ?></h5>

                                                <div class="theme-search-results-item-car-location">



                                                    <div class="theme-search-results-item-car-location-body">

                                                        <p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID($rentCarRow['bodyTypeID'] ); ?></p>

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



                                            <div class="col-md-6">



                                                <div class="row">

                                                    <div class="col-md-4 ">

                                                        <!--DAILY-->
                                                        <div class="theme-search-results-item-book">
                                                            <div class="theme-search-results-item-price">
                                                                <p class="theme-search-results-item-price-tag">
                                                                    <!--                            From-->
                                                                    <?php
                                                                    echo  " ";

                                                                    if ( ! empty( $rentCarRow[ 'dailyDummyAED' ] ) )
                                                                    {
                                                                        echo "<span class='was-title'>was&nbsp;<strike>" .' '. (int)$rentCarRow[ 'dailyDummyAED' ] . "</span></strike>";
                                                                    }
                                                                    ?>
                                                                    <br>
                                                                    <?php
                                                                    //                                                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span>'.' '. $rentCarRow[ 'dailyAED'];
                                                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '. (int)$rentCarRow[ 'dailyAED'];
                                                                    ?>
                                                                    <br><span class="sub-font-1"> /day</span></p>

                                                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->
                                                                <!--														<p class="alert alert-info">-->
                                                                <!--															Choose pick up and drop off date from the side panel.-->
                                                                <!--														</p>-->
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="col-md-4 ">



                                                        <!--Weekly-->
                                                        <div class="theme-search-results-item-book">
                                                            <div class="theme-search-results-item-price">
                                                                <p class="theme-search-results-item-price-tag">
                                                                    <!--                            From-->
                                                                    <?php
                                                                    echo  " ";

                                                                    if ( ! empty( $rentCarRow[ 'weeklyDummyAED' ] ) )
                                                                    {
                                                                        echo "<span class='was-title'>was&nbsp;<strike>" .' '. (int)$rentCarRow[ 'weeklyDummyAED' ] . "</span></strike>";
                                                                    }
                                                                    ?>
                                                                    <br>
                                                                    <?php
                                                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' ' .(int)$rentCarRow[ 'weeklyAED' ];
                                                                    ?>
                                                                    <br><span class="sub-font-1"> /week </span> </p>
                                                                <br>
                                                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->
                                                                <!--                                                        <p class="alert alert-info">-->
                                                                <!--                                                            Choose pick up and drop off date from the side panel.-->
                                                                <!--                                                        </p>-->
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="col-md-4 ">




                                                        <!--monthly-->
                                                        <div class="theme-search-results-item-book">
                                                            <div class="theme-search-results-item-price">
                                                                <p class="theme-search-results-item-price-tag">
                                                                    <!--                            From-->
                                                                    <?php
                                                                    echo  " ";

                                                                    if ( ! empty( $rentCarRow[ 'monthlyDummyAED' ] ) )
                                                                    {
                                                                        echo "<span class='was-title'>was&nbsp;<strike>" .' '.(int)$rentCarRow[ 'monthlyDummyAED' ] . "</span></strike>";
                                                                    }
                                                                    ?>
                                                                    <br>
                                                                    <?php
                                                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '.(int)$rentCarRow[ 'monthlyAED' ];
                                                                    ?>
                                                                    <br><span class="sub-font-1"> /month </span> </p>
                                                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->

                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>


                                                <!--                                                <p class="alert alert-info text-center sidepanelText" id="sidepanelText"></p>-->

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <center>
                                                            <!--                                                    <a class="btn btn-primary-invert btn-shadow text-upcase mob-book-btn" href="rent-cars-mob/--><?php //echo $rentCarRow['slug']?><!--">-->
                                                            <a class="btn btn-primary-invert btn-shadow text-upcase book-btn-right" href="rent-cars-mob/<?php echo $rentCarRow['slug']?>">
                                                                Book Now
                                                            </a>
                                                        </center>
                                                        <br>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">

                                                        <center>
                                                            <a class="btn btn-primary-invert btn-shadow text-upcase" href="rent-cars-enquiry/<?php echo $rentCarRow['slug']?>">
                                                                Enquire Now
                                                            </a>
                                                        </center>
                                                    </div>
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





                </div>



                <div data-gutter="3" id="load_data_message">

                    <?php



                    if ( $totalItems > $itemsPerPage )

                    { ?>



                        <a class="btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg" href="#" id="loadingLabelPanel">Loading...</a>

                    <?php } ?>



                </div>



            </div>

            <!--            <div class="col-md-2 ">-->
            <!--                --><?php //include 'inc_car_listing_blog_sidebar.php'?>
            <!--            </div>-->

        </div>

    </div>

</div>





<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>





<script>

    $(document).ready(function () {


        // var wid = screen.width;
        //
        // if(wid <= 992)
        // {
        //     $('.mob-book-btn').show();
        //     $('.sidepanelText').hide();
        // }
        // else
        // {
        //     $('.sidepanelText').text("Choose car category from side panel.");
        //     $('.mob-book-btn').hide();
        // }




        // click button collapse in responsive view


        var wid = screen.width;

        if(wid <= 992)
        {
            $('.clickme-div').show();
            $('.modifySearchDiv').hide();
        }
        else
        {
            $('.clickme-div').hide();
            $('.modifySearchDiv').show();
        }

        // click button collapse in responsive view




        //alert("die");

        var start = 0; //Starting position

        var limit = <?php echo $itemsPerPage ?>; //Show records limit

        var action = 'inactive';

        var bodyTypeID = "";





        $("#loadingLabelPanel").hide();



        function loadMoreFromServer() {



            <?php

            if(!empty($rentBodyType) )

            {

            ?>

            bodyTypeID = '<?php echo $rentBodyType; ?>';

            <?php

            }

            ?>



            // alert(make);

            start += limit;



            $.ajax({

                type: 'POST', url: 'fetchrentcar_pageList.php',

                data: {

                    'start': start,

                    'limit': limit,

                    'bodyTypeID': bodyTypeID

                },

                cache: false,

                success: function (data)

                {

                    // console.log("Data From Server");

                    // console.log(data);



                    $("#loadingLabelPanel").hide();



                    $("#carItemsContainer").append(data);



                }



            });



        }







        var observer = new IntersectionObserver(function(entries) {

            if(entries[0].isIntersecting === true){

                // console.log('Element has just become visible in screen');

                // console.log(bodyTypeID);

                $("#loadingLabelPanel").show();

                loadMoreFromServer();

            }

        }, { threshold: [0] });  //Change this to 1 if you want the trigger when the element is FULLY visible on the screen.



        observer.observe(document.querySelector("#load_data_message"));



    });


    // click button collapse in responsive view


    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }



</script>


</body>

</html>