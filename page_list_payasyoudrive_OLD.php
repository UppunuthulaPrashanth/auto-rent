<?php include "inc_opendb.php";
$PAGEID = "Pay as You Drive";

//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );

$queryAppend = "";


//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();

//[driveBodyType] => 3
//    [drivePickupLocation] => 7
//    [driveDropLocation] => 8
//    [drivePickupDate] => 12/11/2020 4:00 PM
//[driveDropDate] => 12/13/2020 4:00 PM
//[btnDriveSearch] =>
//


//if (isset($_POST["carClass"]))
//{
//    $carClass = filter_var($_POST['carClass'], FILTER_SANITIZE_STRING);
//    //$queryAppend .= " OR id_bodytype = 0”;
//}
//if ( $_SERVER['REQUEST_METHOD'] !== 'POST' )
//{
//    header( "location:/" );
//    exit();
//}
//
//if ( isset( $_POST["drivePickupLocation"] ) )
//{
//    $drivePickupLocation = filter_var( $_POST['drivePickupLocation'], FILTER_SANITIZE_STRING );
//}
//if ( isset( $_POST["driveDropLocation"] ) )
//{
//    $driveDropLocation = filter_var( $_POST['driveDropLocation'], FILTER_SANITIZE_STRING );
//}
//if ( isset( $_POST["drivePickupDate"] ) )
//{
//    $drivePickupDate = filter_var( $_POST['drivePickupDate'], FILTER_SANITIZE_STRING );
//}
//if ( isset( $_POST["driveDropDate"] ) )
//{
//    $driveDropDate = filter_var( $_POST['driveDropDate'], FILTER_SANITIZE_STRING );
//}
//if ( isset( $_POST["driveBodyType"] ) )
//{
//    $driveBodyType = filter_var( $_POST['driveBodyType'], FILTER_SANITIZE_STRING );
//}


?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php';
$geo           = $_SESSION[ CURRENT_GEOLOCATION ];
if (empty($driveBodyType))
{
    $rentCarResult = $db->query("SELECT * FROM pay_as_you_drive WHERE active = 1 ");
}

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
                                <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Pay as you Drive</h2>
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
                                    <a>Pay as you Drive</a>
                                </p>
                            </li>
                            <li>
                                <p class="theme-breadcrumbs-item-title">
                                    <a>Search Results</a>
                                </p>
                                <p class="theme-breadcrumbs-item-subtitle"><?php echo $counter; ?> vehicles</p>
                            </li>


                        </ul>
                    </div>
                    <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                        <h4 class="theme-search-area-inline-title">Autorent Cars</h4>
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
                        <form id="driveSidebarSearchForm" name="driveSidebarSearchForm" method="post" action="/pay-as-you-drive">

                            <div class="theme-search-area-form" id="hero-search-form">
                                <div>
                                    <label class="theme-search-area-section-label">Modify Search</label>


                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <label class="theme-search-area-section-label">Body Type</label>
                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                            <i class="fa fa-angle-down"></i>
                                            <select class="form-control" id="driveBodyType" name="driveBodyType" required>

                                                <option selected value="" disabled>Body Type</option>
                                                <?php
                                                $result = $db->query( "SELECT * FROM pay_as_you_drive 
LEFT JOIN mtr_bodytype ON pay_as_you_drive.bodyTypeID = mtr_bodytype.bodyTypeID
WHERE pay_as_you_drive.active = 1 GROUP BY pay_as_you_drive.bodyTypeID" );
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
                                            <!--                                            <i class="fa fa-angle-down"></i>-->


                                            <select class="form-control" id="drivePickupLocation" name="drivePickupLocation" required>

                                                <option selected value="" disabled>Pick up location</option>
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
                                            <!--                                            <i class="fa fa-angle-down"></i>-->

                                            <select class="form-control" id="driveDropLocation" name="driveDropLocation" required>
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
                                            <input class="theme-search-area-section-input datePickerStart" id="drivePickupDate" required name="drivePickupDate" type="text" placeholder="Pick Up Date"/>
                                            <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>
                                        </div>
                                    </div>
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <label class="theme-search-area-section-label">Drop Off Date</label>
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                            <input class="theme-search-area-section-input datePickerEnd " id="driveDropDate" name="driveDropDate" required type="text" placeholder="Drop Off Date"/>
                                            <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>
                                        </div>
                                    </div>

                                </div>

                                <div>


                                </div>
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">


                                </div>

                                <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary" id="btnDriveSearch" name="btnDriveSearch" type="submit">Modify Search</button>

                            </div>

                        </form>
                    </div>


                </div>


            </div>
            <div class="col-md-8-5 ">

                <div class="theme-search-results-item theme-search-results-item-">
                    <div class="theme-search-results-item-preview">
                        <?php
                        $pageID = '21';
                        $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
                        $row    = mysqli_fetch_assoc( $result );
                        ?>
                        <div class="row row-col-static" id="sticky-parent" data-gutter="20">
                            <h4><?php echo $row['pageTitle'];?></h4>
                            <?php echo $row['summary'];?>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="theme-search-results">
                    <form name="rentcarsStep1" method="post" role="form" action="/book-pay-as-you-drive">
                        <input type="hidden" name="pickupLocation" id="pickupLocation" value="<?php echo $drivePickupLocation; ?>"/>
                        <input type="hidden" name="dropLocation" id="dropLocation" value="<?php echo $driveDropLocation; ?>"/>
                        <input type="hidden" name="pickupDate" id="pickupDate" value="<?php echo $drivePickupDate; ?>"/>
                        <input type="hidden" name="dropDate" id="dropDate" value="<?php echo $driveDropDate; ?>"/>
                        <input type="hidden" name="driveBodyType" id="driveBodyType" value="<?php echo $driveBodyType; ?>"/>
                        <input type="hidden" name="totalDays" id="totalDays" value="<?php echo $totalDays; ?>"/>

                        <div class="_mob-h">

                            <div class="theme-search-results-item theme-search-results-item-">
                                <div class="theme-search-results-item-preview products-grid" id="payAsYouDriveCarItemsContainer">
                                    <?php
                                    $itemsPerPage = 3;
                                    $totalItems   = 0;

                                    //                                    if (empty($driveBodyType))
                                    //                                    {
                                    //                                        $queryAppendcar = " ";
                                    //                                    }
                                    //                                    else
                                    //                                    {
                                    //                                        $queryAppendcar = "and bodyTypeID = $driveBodyType";
                                    //                                    }

                                    //                                    $rentCarResult = $db->query( "SELECT * FROM pay_as_you_drive WHERE active = 1 ORDER BY payDriveCarID DESC limit 0,3" );

                                    $rentCarResult = $db->query( "SELECT * FROM pay_as_you_drive WHERE active = 1 $queryAppend ORDER BY s1DailyAED ASC");
                                    $totalItems    = mysqli_num_rows( $rentCarResult );


                                    $rentCarResult = $db->query( "SELECT * FROM pay_as_you_drive WHERE active = 1 $queryAppend ORDER BY s1DailyAED ASC limit 0,?i", $itemsPerPage );

                                    //                                    $totalItems    = mysqli_num_rows( $rentCarResult );
                                    //                                    $rentCarListingResQuery = $db->lastQuery() . " LIMIT ?i, ?i";

                                    if ( $totalItems > $itemsPerPage )
                                    {
//                                        $rentCarResult = $db->query( $rentCarListingResQuery, $currentIndex, $itemsPerPage );
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

                                            <div class="col-md-4">
                                                <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle'] ?></h5>
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

                                            <div class="col-md-5 ">



                                                <div class="row">


                                                    <div class="col-md-4 ">



                                                        <!--DAILY-->
                                                        <div class="theme-search-results-item-book">
                                                            <div class="theme-search-results-item-price">
                                                                <p class="theme-search-results-item-price-tag">
                                                                    <!--                                                            --><?php
                                                                    //                                                            echo $_SESSION[ CURRENT_CURRENCY ] . " ";
                                                                    //                                                            echo " " . $rentCarRow[ 's1Daily' . $_SESSION[ CURRENT_CURRENCY ] ];
                                                                    //                                                            ?>
                                                                    <!--                                                            /Day <p class="theme-search-results-item-car-location-title">For --><?php //echo $rentCarRow['s1DailyKM']; ?><!-- KM</p>-->
                                                                    <!--                                                            From-->
                                                                    <?php
                                                                    echo $_SESSION[ CURRENT_CURRENCY ] . "<br>";

                                                                    //                                                            if ( ! empty( $rentCarRow[ 's1Daily' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                                                    //                                                            {
                                                                    //                                                                echo "<strike>" . $rentCarRow[ 's1Daily' . $_SESSION[ CURRENT_CURRENCY ] ] . "</strike>";
                                                                    //                                                            }
                                                                    echo " " . $rentCarRow[ 's1Daily' . $_SESSION[ CURRENT_CURRENCY ] ];
                                                                    ?>
                                                                    <br><span class="sub-font-1"> per day</span> <p class="theme-search-results-item-car-location-title">For <?php echo $rentCarRow['s1DailyKM']; ?> KM</p>
                                                                </p>

                                                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->
                                                                <!--                                                        <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook--><?php //echo $i; ?><!--" value="--><?php //echo $rentCarRow['slug']; ?><!--" data-id="--><?php //echo $rentCarRow['slug']; ?><!--" name="btnBookDaily" type="submit">Book Daily</button>-->
                                                            </div>
                                                        </div>

                                                        <!--                                                --><?php
                                                        //                                                if ( $totalDays >= 7 )
                                                        //                                                {
                                                        //                                                    ?>



                                                    </div>




                                                    <div class="col-md-4 ">









                                                        <div class="theme-search-results-item-book">
                                                            <div class="theme-search-results-item-price">
                                                                <p class="theme-search-results-item-price-tag">
                                                                    <!--                                                                --><?php
                                                                    //                                                                echo $_SESSION[ CURRENT_CURRENCY ] . " ";
                                                                    //                                                                echo " " . $rentCarRow[ 's1Weekly' . $_SESSION[ CURRENT_CURRENCY ] ];
                                                                    //                                                                ?>
                                                                    <!--                                                                /Week <p class="theme-search-results-item-car-location-title">For --><?php //echo $rentCarRow['s1WeeklyKM']; ?><!-- KM</p></p>-->
                                                                    <!--                                                                From-->
                                                                    <?php
                                                                    echo $_SESSION[ CURRENT_CURRENCY ] . "<br>";

                                                                    //                                                                if ( ! empty( $rentCarRow[ 's1Weekly' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                                                    //                                                                {
                                                                    //                                                                    echo "<strike>" . $rentCarRow[ 's1Weekly' . $_SESSION[ CURRENT_CURRENCY ] ] . "</strike>";
                                                                    //                                                                }
                                                                    echo " " . $rentCarRow[ 's1Weekly' . $_SESSION[ CURRENT_CURRENCY ] ];
                                                                    ?>
                                                                    <br><span class="sub-font-1"> per week</span> <p class="theme-search-results-item-car-location-title">For <?php echo $rentCarRow['s1WeeklyKM']; ?> KM</p>
                                                                </p>
                                                                <!--                                                            <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook--><?php //echo $i; ?><!--" value="--><?php //echo $rentCarRow['slug']; ?><!--" data-id="--><?php //echo $rentCarRow['slug']; ?><!--" name="btnBookWeekly" type="submit">Book Weekly</button>-->
                                                            </div>
                                                        </div>
                                                        <!--                                                    --><?php
                                                        //                                                }
                                                        //
                                                        //                                                if ( $totalDays >= 30 )
                                                        //                                                {
                                                        //                                                    ?>



                                                    </div>


                                                    <div class="col-md-4 ">









                                                        <!--MONTHLY-->
                                                        <div class="theme-search-results-item-book">
                                                            <div class="theme-search-results-item-price">
                                                                <p class="theme-search-results-item-price-tag">
                                                                    <!--                                                                --><?php
                                                                    //                                                                echo $_SESSION[ CURRENT_CURRENCY ] . " ";
                                                                    //                                                                echo " " . $rentCarRow[ 's1Monthly' . $_SESSION[ CURRENT_CURRENCY ] ];
                                                                    //                                                                ?>
                                                                    <!--                                                                /Month <p class="theme-search-results-item-car-location-title">For --><?php //echo $rentCarRow['s1MonthlyKM']; ?><!-- KM</p>-->
                                                                    <!--                                                                From-->
                                                                    <?php
                                                                    echo $_SESSION[ CURRENT_CURRENCY ] . "<br>";

                                                                    //                                                                if ( ! empty( $rentCarRow[ 's1Monthly' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                                                    //                                                                {
                                                                    //                                                                    echo "<strike>" . $rentCarRow[ 's1Monthly' . $_SESSION[ CURRENT_CURRENCY ] ] . "</strike>";
                                                                    //                                                                }
                                                                    echo " " . $rentCarRow[ 's1Monthly' . $_SESSION[ CURRENT_CURRENCY ] ];
                                                                    ?>
                                                                    <br><span class="sub-font-1"> per month</span> <p class="theme-search-results-item-car-location-title">For <?php echo $rentCarRow['s1MonthlyKM']; ?> KM</p>
                                                                </p>

                                                                <!--														<p class="theme-search-results-item-price-sign">per month</p>-->
                                                                <!--                                                            <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook--><?php //echo $i; ?><!--" value="--><?php //echo $rentCarRow['slug']; ?><!--" data-id="--><?php //echo $rentCarRow['slug']; ?><!--" name="btnBookMonthly" type="submit">Book Monthly</button>-->

                                                            </div>

                                                        </div>
                                                        <!--                                                    --><?php
                                                        //                                                }
                                                        //                                                ?>

                                                    </div>

                                                </div>



                                                <p class="alert alert-info">
                                                    Choose pick up and drop off date from the side panel.
                                                </p>




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

                    if ( $totalItems > 3 )
                    { ?>

                        <a class="btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg" href="#" id="loadingLabelPanel">Loading...</a>
                    <?php } ?>

                </div>

            </div>

        </div>
    </div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>


<script>
    $(document).ready(function () {
        //alert("die");
        var start = 0; //Starting position
        var limit = <?php echo $itemsPerPage ?>; //Show records limit
        var action = 'inactive';
        var bodyTypeID = "";



        $("#loadingLabelPanel").hide();

        function loadMoreFromServer() {

            <?php
            if(!empty($driveBodyType) )
            {
            ?>
            bodyTypeID = '<?php echo $driveBodyType; ?>';
            <?php
            }
            ?>

            // alert(make);
            start += limit;

            $.ajax({
                type: 'POST', url: 'fetchPayAsYouDriveList.php',
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

                    $("#payAsYouDriveCarItemsContainer").append(data);

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
</script>
</body>
</html>