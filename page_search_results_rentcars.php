<?php include "inc_opendb.php";
$rentCarRow[ 'dailyAED'];

$PAGEID = "Rent a Cars";



//error_reporting( E_ALL );

//ini_set( 'display_errors', 1 );



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



//if (isset($_POST["carClass"]))

//{

//    $carClass = filter_var($_POST['carClass'], FILTER_SANITIZE_STRING);

//    //$queryAppend .= " OR id_bodytype = 0”;

//}

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' )

{

	header( "location:/" );

	exit();

}



if ( isset( $_POST["pickupLocation"] ) )

{

	$pickupLocation = filter_var( $_POST['pickupLocation'], FILTER_SANITIZE_STRING );

}

if ( isset( $_POST["dropLocation"] ) )

{

	$dropLocation = filter_var( $_POST['dropLocation'], FILTER_SANITIZE_STRING );

}

if ( isset( $_POST["pickupDate"] ) )

{

	$pickupDate = filter_var( $_POST['pickupDate'], FILTER_SANITIZE_STRING );

}

elseif (isset( $_POST["drivePickupDate"] ))
{
    $pickupDate = filter_var( $_POST['drivePickupDate'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["dropDate"] ) )

{

	$dropDate = filter_var( $_POST['dropDate'], FILTER_SANITIZE_STRING );

}

elseif (isset( $_POST["driveDropDate"] ))
{
    $dropDate = filter_var( $_POST['driveDropDate'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["rentBodyType"] ) )

{

	$rentBodyType = filter_var( $_POST['rentBodyType'], FILTER_SANITIZE_STRING );

}

$geolocation = $_SESSION["current_geolocation"];



//echo $pickupLocation."-".$dropLocation."-".$pickupDate."-".$dropDate."-".$rentBodyType;

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

if ( empty( $rentBodyType ) )

{

	$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 " );

} else

{

	$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE bodyTypeID  = ?s ", $rentBodyType );

}

$counter = mysqli_num_rows( $rentCarResult );

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

					<div class="_mob-h">

						<div class="theme-hero-text theme-hero-text-white">

							<div class="breadcrumb-margins">

								<h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Rent A Car</h2>

							</div>

						</div>



					</div>

<!--					<div class="theme-search-area-inline _desk-h theme-search-area-inline-white">-->

<!--						<h4 class="theme-search-area-inline-title">New York Cars</h4>-->

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

                        <li>

                            <p class="theme-breadcrumbs-item-title">

                                <a>Search Results</a>

                            </p>

                            <p class="theme-breadcrumbs-item-subtitle"><?php echo $counter; ?> vehicles</p>

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

<!--				<div class="sticky-col _mob-h">-->



                <?php

                $totalDays = "";



                $startDateTimeStamp = strtotime( $pickupDate );

                $endDateTimeStamp   = strtotime( $dropDate );



                $totalHours = abs( $endDateTimeStamp - $startDateTimeStamp ) / ( 60 * 60 );

                $totalDays  = ceil( $totalHours / 24 );



                ?>



				<div class="sticky-col">

                    <div class="theme-sidebar-section _mb-10">

                        <h5 class="theme-sidebar-section-title">Booking Summary</h5>

                        <ul class="theme-sidebar-section-summary-list black-text">



                            <li><i class="fa fa-calendar fa-lg loc-icons"></i><strong> PICKUP</strong></li>



                            <li><?php echo getLocationFromID( $pickupLocation ); ?> <br> <?php echo date( 'F d, Y', strtotime( $pickupDate ) ); ?></li>



                        </ul>

                        <hr>

                        <ul class="theme-sidebar-section-summary-list black-text">



                            <li><i class="fa fa-calendar fa-lg loc-icons"></i><strong> Dropoff</strong></li>

                            <li><?php echo getLocationFromID( $dropLocation ); ?> <br> <?php echo date( 'F d, Y', strtotime( $dropDate ) ); ?></li>



                        </ul>

                        <hr>

                        <ul class="theme-sidebar-section-summary-list black-text">



                            <li><i class="fa fa-arrow-right fa-lg loc-icons"></i><strong> Rental Period</strong></li>

<!--                            <h5>Rental Length: --><?php //echo $totalDays; ?><!-- day--><?php //echo $totalDays > 1 ? 's' : ''; ?><!--</h5>-->

                            <li><?php echo $totalDays; ?> day<?php echo $totalDays > 1 ? 's' : ''; ?></li>



                        </ul>

                    </div>



					<div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white">









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

											<input class="theme-search-area-section-input datePickerStart" id="pickupDate" required name="pickupDate" type="text" placeholder="Pick Up Date" />

											<input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

										</div>

									</div>



									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

										<label class="theme-search-area-section-label">Drop Off Date</label>

										<div class="theme-search-area-section-inner">

											<i class="theme-search-area-section-icon lin lin-calendar"></i>

											<input class="theme-search-area-section-input datePickerEnd" id="dropDate" name="dropDate" required type="text" placeholder="Drop Off Date"/>

											<input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

										</div>

									</div>



								</div>



								<div>





								</div>

								<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">





								</div>



								<button class="modify-search-btn theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved theme-search-area-submit-sm theme-search-area-submit-white theme-search-area-submit-primary" id="btnRentSearch" name="btnRentSearch" type="submit">Modify Search</button>



							</div>



						</form>

					</div>





				</div>





			</div>

			<div class="col-md-9 ">

				<div class="theme-search-results-item theme-search-results-item-">

<!--					<div class="theme-search-results-item-preview">-->

<!---->

<!--						<div class="row row-col-static" id="sticky-parent" data-gutter="20">-->

<!---->

<!--							<h4>Your Summary</h4>-->

<!--							    <div class="col-md-6 ">-->

<!--								<h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Pickup</h5>-->

<!---->

<!--								<ul class="theme-search-results-item-car-list summary-txt">-->

<!--									<li>-->

<!--										<i class="fa fa-map-marker fa-lg loc-icons"></i> --><?php //echo getLocationFromID( $pickupLocation ); ?>

<!--									</li>-->

<!--									<br>-->

<!--									<li>-->

<!--										<i class="fa fa-calendar fa-lg loc-icons"></i> --><?php //echo date( 'F d, Y', strtotime( $pickupDate ) ); ?>

<!--									</li>-->

<!--									<br>-->

<!--									<li>-->

<!--										<i class="fa fa-clock-o fa-lg loc-icons"></i> --><?php //echo date( 'h:i A', strtotime( $pickupDate ) ); ?>

<!--									</li>-->

<!--									<br>-->

<!---->

<!--								</ul>-->

<!--							</div>-->

<!---->

<!--							<div class="col-md-6 ">-->

<!--								<h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Dropoff</h5>-->

<!---->

<!--								<ul class="theme-search-results-item-car-list summary-txt">-->

<!--									<li>-->

<!--										<i class="fa fa-map-marker fa-lg loc-icons"></i> --><?php //echo getLocationFromID( $dropLocation ); ?>

<!--									</li>-->

<!--									<br>-->

<!--									<li>-->

<!--										<i class="fa fa-calendar fa-lg loc-icons"></i> --><?php //echo date( 'F d, Y', strtotime( $dropDate ) ); ?>

<!--									</li>-->

<!--									<br>-->

<!--									<li>-->

<!--										<i class="fa fa-clock-o fa-lg loc-icons"></i> --><?php //echo date( 'h:i A', strtotime( $dropDate ) ); ?>

<!--									</li>-->

<!--									<br>-->

<!---->

<!--								</ul>-->

<!--							</div>-->

<!---->

<!--						</div>-->

<!---->

<!--						--><?php

//						$totalDays = "";

//

//						$startDateTimeStamp = strtotime( $pickupDate );

//						$endDateTimeStamp   = strtotime( $dropDate );

//

//						$totalHours = abs( $endDateTimeStamp - $startDateTimeStamp ) / ( 60 * 60 );

//						$totalDays  = ceil( $totalHours / 24 );

//

//						?>

<!--						<h5>Rental Length: --><?php //echo $totalDays; ?><!-- day--><?php //echo $totalDays > 1 ? 's' : ''; ?><!--</h5>-->

<!---->

<!---->

<!--						--><?php

//						//Calculate Months, weeks and days

//						//						include_once "inc_days_calculation.php";

//						?>

<!---->

<!---->

<!--					</div>-->

				</div>

<!--				<hr>-->



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



				<!--				<div class="theme-search-results-sort-select _desk-h">-->

				<!--					<select>-->

				<!--						<option>Price</option>-->

				<!--						<option>Guest Rating</option>-->

				<!--						<option>Property Class</option>-->

				<!--						<option>Property Name</option>-->

				<!--						<option>Recommended</option>-->

				<!--						<option>Most Popular</option>-->

				<!--						<option>Trendy Now</option>-->

				<!--						<option>Best Deals</option>-->

				<!--					</select>-->

				<!--				</div>-->





				<div class="theme-search-results">

					<form name="rentcarsStep1" id="rentcarsStep1" method="post" role="form" action="/book-rent-cars">

						<input type="hidden" name="pickupLocation2" id="pickupLocation2" value="<?php echo $pickupLocation; ?>"/>

						<input type="hidden" name="dropLocation2" id="dropLocation2" value="<?php echo $dropLocation; ?>"/>

						<input type="hidden" name="pickupDate2" id="pickupDate2" value="<?php echo $pickupDate; ?>"/>

						<input type="hidden" name="dropDate2" id="dropDate2" value="<?php echo $dropDate; ?>"/>

						<input type="hidden" name="rentBodyType2" id="rentBodyType2" value="<?php echo $rentBodyType; ?>"/>

						<input type="hidden" name="totalDays2" id="totalDays2" value="<?php echo $totalDays; ?>"/>



<!--						<div class="_mob-h">-->

						<div>





							<div class="theme-search-results-item theme-search-results-item-">

								<div class="theme-search-results-item-preview products-grid" id="carItemsContainer">

									<?php

									$itemsPerPage = 3;

									$totalItems   = 0;



									if ( empty( $rentBodyType ) )

									{

										$queryAppendcar = " ";



									} else

									{

										$queryAppendcar = " and bodyTypeID = $rentBodyType ";

									}





									$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 $queryAppendcar ORDER BY dailyAED ASC");

									$totalItems    = mysqli_num_rows( $rentCarResult );





									$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 $queryAppendcar ORDER BY dailyAED ASC limit 0,?i", $itemsPerPage );



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

<!--													<li>-->
<!---->
<!--														<i class="fa fa-snowflake-o"></i> <span>--><?php //if ( $rentCarRow['ac'] == 'Y' )
//
//															{
//
//																echo "A/C";
//
//															} else
//
//															{
//
//																echo "Non-A/C";
//
//															} ?>
<!---->
<!---->
<!---->
<!--                            </span>-->
<!---->
<!--													</li>-->



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

														<p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID( $rentCarRow['bodyTypeID'] ); ?></p>

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

															<?php

															echo " ";



															if ( ! empty( $rentCarRow[ 'dailyDummyAED' ] ) )

															{

																echo "<span class='was-title'>was&nbsp;<strike>" . (int)$rentCarRow[ 'dailyDummyAED' ] . "</span></strike>";

															}
															?>
                                                            <br>
                                                            <?php

                                                            echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '. (int)$rentCarRow[ 'dailyAED' ];

															?>

															<br><span class="sub-font-1">/day</span> </p>

														<!--														<p class="theme-search-results-item-price-sign">per day</p>-->


                                                        <?php

                                                        if ( $totalDays < 7 )

                                                        {

                                                        ?>

														<button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookDaily" type="submit">Daily</button>
                                                            <?php

                                                        }

                                                        else

                                                        {

                                                        ?>
                                                        <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookDaily" type="submit" disabled>Daily</button>
                                                        <?php

                                                        }

                                                        ?>
													</div>

												</div>



						

						

						

						</div>

										

						<div class="col-md-4 ">			

																

									

						

										

												<!--WEEKLY-->

												<div class="theme-search-results-item-book">

													<div class="theme-search-results-item-price">

														<p class="theme-search-results-item-price-tag">

															<?php

															echo " ";



															if ( ! empty( $rentCarRow[ 'weeklyDummyAED' ] ) )

															{

																echo "<span class='was-title'>was&nbsp;<strike>" . (int)$rentCarRow[ 'weeklyDummyAED' ] . "</span></strike>";

															}
															?>
                                                            <br>
                                                            <?php

                                                            echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' ' . (int)$rentCarRow[ 'weeklyAED' ];

															?><br><span class="sub-font-1">/week</span> </p>

														<!--														<p class="theme-search-results-item-price-sign">per week</p>-->



														<?php

														if ( $totalDays >= 7 && $totalDays < 30)

														{

															?>

															<button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookWeekly" type="submit">Weekly</button>

															<?php

														} else

														{

															?>

															<button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" name="btnBookWeekly" disabled>Weekly</button>

															<?php

														}

														?>

													</div>

												</div>

							

							

						</div>

						

						

						<div class="col-md-4 ">			

												

							

							

							

												<?php





												?>



												<!--MONTHLY-->

												<div class="theme-search-results-item-book">

													<div class="theme-search-results-item-price">

														<p class="theme-search-results-item-price-tag">

															<?php



															echo  " ";



															if ( ! empty( $rentCarRow[ 'monthlyDummyAED' ] ) )

															{

																echo "<span class='was-title'>was&nbsp;<strike>" . ' '.(int)$rentCarRow[ 'monthlyDummyAED' ] . "</span></strike>";

															}
															?>
                                                            <br>
                                                        <?php

                                                        echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '. (int)$rentCarRow[ 'monthlyAED' ];

															?><br><span class="sub-font-1">/month</span> </p>

														<!--														<p class="theme-search-results-item-price-sign">per month</p>-->



														<?php





														if ( $totalDays >= 30 )

														{

															?>

															<button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookMonthly" type="submit">Monthly</button>

															<?php



														} else

														{



															?>

															<button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" disabled>Monthly</button>

															<?php

														}



														?>

													</div>





												</div>




												

						</div>						

												

												

												

								</div>


<br>
                                                <center>
                                                    <a class="btn btn-primary-invert btn-shadow text-upcase" href="rent-cars-enquiry/<?php echo $rentCarRow['slug']?>">
                                                        Enquire Now
                                                    </a>
                                                </center>








                                                <?php



												?>





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

        //alert("die");

        var start = 0; //Starting position

        var limit = <?php echo $itemsPerPage ?>; //Show records limit

        var action = 'inactive';

        var bodyTypeID = "";









        $('#rentcars #rentBodyType').val('<?php echo $_POST["rentBodyType"] ?>');

        $('#rentcars #pickupLocation').val('<?php echo $_POST["pickupLocation"] ?>');

        $('#rentcars #dropLocation').val('<?php echo $_POST["dropLocation"] ?>');

        $('#rentcars #pickupDate').val('<?php echo $pickupDate ?>');

        $('#rentcars #dropDate').val('<?php echo $dropDate ?>');











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

				type: 'POST', url: 'fetchrentcar.php',

				data: {

				    'start': start,

					'limit': limit,

					'bodyTypeID': bodyTypeID,

                    'totalDays':<?php echo $totalDays?>

				},

				cache: false,

				success: function (data)

				{

					// console.log("Data From Server");

				    // console.log(data);











                    $("#loadingLabelPanel").hide();



				    $("#carItemsContainer").append(data);



				    /*

                    //console.log(data); return;

                    $("#load_data_message").hide();

                    if (data != '') {

                        $(".products-grid").append(data);

                        $("#load_data_message").show();

                        $('#load_data_message').html(" <div data-gutter='3' id='load_data_message'><a class='btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg' href='#'>Load More Results</a></div>");

                        action = "inactive";

                    } else {

                        $('#load_data_message').html("<div data-gutter='3' id='load_data_message'><a class='btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg' href='#'>No More Data</a></div>");

                        action = "active";

                    }*/

                }



            });



        }

/*



        if (action == 'inactive') {

            alert("firing now");

            action = 'active';

            load_country_data(limit, start);

        }

*/



		/*

        $(window).scroll(function () {

            if ($(window).scrollTop() + $(window).height() > $(".products-grid").height() && action == 'inactive') {



                alert("Firing");



                action = 'active';

                start = start + limit;

                setTimeout(function () {

                    load_country_data(limit, start);

                }, 3000);

            }

        });*/





        var observer = new IntersectionObserver(function(entries) {

            // isIntersecting is true when element and viewport are overlapping

            // isIntersecting is false when element and viewport don't overlap

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