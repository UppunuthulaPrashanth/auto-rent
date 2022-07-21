<?php include "inc_opendb.php";

$PAGEID = "Book Rent a Car";




//echo "Slug Coming 1" .' '.$slug;
//echo "<pre>";
//
//echo print_r($slug);
//
//echo "</pre>";
//
//exit();



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

//echo "<pre>";

//print_r( $_POST );

//echo "</pre>";



$onlinePrice = "";

if ( isset( $_POST["pickupLocation2"] ) )

{

	$pickupLocation = filter_var( $_POST['pickupLocation2'], FILTER_SANITIZE_STRING );

}
else
{
    $pickupLocation = '3';
}

if ( isset( $_POST["dropLocation2"] ) )

{

	$dropLocation = filter_var( $_POST['dropLocation2'], FILTER_SANITIZE_STRING );

}

else
{
    $dropLocation = '3';
}

if ( isset( $_POST["pickupDate2"] ) )

{

	$pickupDate = filter_var( $_POST['pickupDate2'], FILTER_SANITIZE_STRING );

}

else
{
    $pickupDate = date('Y-m-d');
}

if ( isset( $_POST["dropDate2"] ) )

{

	$dropDate = filter_var( $_POST['dropDate2'], FILTER_SANITIZE_STRING );

}

else
{
//    $dropDate = date('Y-m-d', strtotime("+30 days"));
    $dropDate = date('Y-m-d',strtotime('+30 days',strtotime($pickupDate)));
}



if ( isset( $_POST["rentBodyType2"] ) )

{

	$rentBodyType = filter_var( $_POST['rentBodyType2'], FILTER_SANITIZE_STRING );

}

$geolocation = $_SESSION["current_geolocation"];





$bookingTerm = "";


//
//if ( isset( $_POST['btnBookDaily'] ) )
//
//{
//
//	$bookingTerm = BOOKING_DAILY;
//
//}
//
//if ( isset( $_POST['btnBookWeekly'] ) )
//
//{
//
//	$bookingTerm = BOOKING_WEEKLY;
//
//}
//
//if ( isset( $_POST['btnBookMonthly'] ) )
//
//{
//
//	$bookingTerm = BOOKING_MONTHLY;
//
//}

//echo "Booking Term" .' '.$bookingTerm;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ( isset( $_POST['btnBookDaily'] ) )

    {

        $bookingTerm = BOOKING_DAILY;

    }

    if ( isset( $_POST['btnBookWeekly'] ) )

    {

        $bookingTerm = BOOKING_WEEKLY;

    }

    if ( isset( $_POST['btnBookMonthly'] ) )

    {

        $bookingTerm = BOOKING_MONTHLY;

    }
    $slug = filter_var( $_POST[ 'btnBook' . $bookingTerm ], FILTER_SANITIZE_STRING );
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $bookingTerm = BOOKING_MONTHLY;
    $slug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING);
}








if ( isset( $_POST["totalDays2"] ) )

{

	$totalDays = filter_var( $_POST['totalDays2'], FILTER_SANITIZE_STRING );

}
else
{
    $totalDays = '30';
}




if ( isset( $slug ) && ! empty( $slug ) )

{

	$result     = $db->query( "SELECT * FROM rent_lease_cars WHERE slug = ?s", $slug );

	$rentCarRow = mysqli_fetch_assoc( $result );



//    echo "Slug Coming" .' '.$slug;

//	  echo $db->lastQuery();
//
//	 die;

	$dailyPrice   = $rentCarRow[ 'daily' . $_SESSION[ CURRENT_CURRENCY ] ];

	$weeklyPrice  = $rentCarRow[ 'weekly' . $_SESSION[ CURRENT_CURRENCY ] ];

	$monthlyPrice = $rentCarRow[ 'monthly' . $_SESSION[ CURRENT_CURRENCY ] ];

	$phase1OrangeCard = $rentCarRow[ 'phase1OrangeCard'];

	$phase1GPS = $rentCarRow[ 'phase1GPS'];

	$phase1DeliveryCharges = $rentCarRow[ 'phase1DeliveryCharges'];

	$phase1CollectionCharges = $rentCarRow[ 'phase1CollectionCharges'];



//	$onlinePrice  = $rentCarRow[ 'onlinePrice' . $_SESSION[ CURRENT_CURRENCY ] ];

//	$vrf4         = $rentCarRow[ 'vrf' . $_SESSION[ CURRENT_CURRENCY ] ];

}



//$totalcalc = $onlinePrice + $vrf4;

//$onlineprice4 = $onlinePrice * $totalDays;

//$totalcalc1   = $onlineprice4 + $vrf4;



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

								<h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Add Extras</h2>

							</div>

						</div>



					</div>





<!--					<div class="theme-search-area-inline _desk-h theme-search-area-inline-white">-->

<!--						<h4 class="theme-search-area-inline-title">Dubai </h4>-->

<!--						<p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>-->

<!--						<a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal"> <i class="fa fa-pencil"></i>Modify </a>-->

<!--						<div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">-->

<!--							<div class="theme-search-area theme-search-area-vert">-->

<!--								<div class="theme-search-area-header">-->

<!--									<h1 class="theme-search-area-title theme-search-area-title-sm">Modify</h1>-->

<!--									<p class="theme-search-area-subtitle">Prices might be different from current results</p>-->

<!--								</div>-->

<!--								<div class="theme-search-area-form">-->

<!--									<div>-->

<!--										<label class="theme-search-area-section-label">Pick Up Information</label>-->

<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

<!---->

<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->

<!--													<option>City</option>-->

<!--													<option>Abu-Dhabi</option>-->

<!---->

<!---->

<!--													<option>Dubai</option>-->

<!--													<option>Ras Al Khaimah</option>-->

<!--													<option>Sharjah</option>-->

<!---->

<!--												</select>-->

<!--											</div>-->

<!--										</div>-->

<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

<!---->

<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->

<!--													<option>Location</option>-->

<!--													<option>Oud Metha</option>-->

<!--													<option>Al Mamzar</option>-->

<!--													<option>Al Qouz</option>-->

<!---->

<!--												</select>-->

<!--											</div>-->

<!--										</div>-->

<!---->

<!---->

<!--										<div class="theme-search-area-section theme-search-area-section-curved">-->

<!---->

<!--											<div class="theme-search-area-section-inner">-->

<!--												<i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Date & Time"/> <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>-->

<!--											</div>-->

<!--										</div>-->

<!---->

<!---->

<!--									</div>-->

<!--									<div>-->

<!--										<label class="theme-search-area-section-label">Drop Off Information</label>-->

<!--										<div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

<!--											<label class="icheck-label"> <input class="icheck" type="checkbox"/> <span class="icheck-title">Return Car to different location</span> </label>-->

<!---->

<!--										</div>-->

<!--										<br>-->

<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

<!---->

<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->

<!--													<option>City</option>-->

<!--													<option>Abu-Dhabi</option>-->

<!---->

<!---->

<!--													<option>Dubai</option>-->

<!--													<option>Ras Al Khaimah</option>-->

<!--													<option>Sharjah</option>-->

<!---->

<!--												</select>-->

<!--											</div>-->

<!--										</div>-->

<!--										<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

<!---->

<!--											<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

<!--												<i class="fa fa-angle-down"></i> <select class="form-control">-->

<!--													<option>Location</option>-->

<!--													<option>Oud Metha</option>-->

<!--													<option>Al Mamzar</option>-->

<!--													<option>Al Qouz</option>-->

<!---->

<!--												</select>-->

<!--											</div>-->

<!--										</div>-->

<!---->

<!---->

<!--										<div class="theme-search-area-section theme-search-area-section-curved">-->

<!---->

<!--											<div class="theme-search-area-section-inner">-->

<!--												<i class="theme-search-area-section-icon lin lin-calendar"></i> <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Date & Time"/> <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>-->

<!--											</div>-->

<!--										</div>-->

<!---->

<!---->

<!--									</div>-->

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

                                <a><?php echo $rentCarRow['carTitle']; ?> (or similar)</a>

                            </p>



                        </li>





                    </ul>

                </div>

			</div>

		</div>

	</div>

</div>





<div class="theme-page-section theme-page-section-lg">

	<div class="container">

		<div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">





			<?php

//						echo "<pre>";

//						echo print_r($_POST);

//						echo "</pre>";

			?>

			<div class="col-md-8 ">



				<div class="theme-payment-page-sections">



					<form method="post" action="/checkout" name="addonsForm">



						<div class="theme-search-results-item theme-search-results-item-">

							<div class="theme-search-results-item-preview">



								<div class="row" data-gutter="20">

									<div class="col-md-3 ">

										<div class="theme-search-results-item-img-wrap">

											<img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>

										</div>

										<ul class="theme-search-results-item-car-feature-list">

											<li>

												<i class="fa fa-male"></i> <span><?php echo $rentCarRow['noOfSeats']; ?></span>

											</li>

											<li><i class="fa fa-suitcase"></i> <span><?php echo $rentCarRow['luggage']; ?></span>

											</li>

											<li>

												<i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $rentCarRow['transmissionID'] ); ?></span>

											</li>

                                            <?php if ( $rentCarRow['ac'] == 'Y' )
                                            {
                                                ?>
                                                <li>

                                                    <i class="fa fa-bluetooth"></i> <span><?php echo "B/T";?></span>

                                                </li>
                                            <?php } ?>

											<li>

												<i class="fa fa-car"></i> <span><?php echo $rentCarRow['noOfDoors']; ?></span>

											</li>

										</ul>

									</div>



									<div class="col-md-6 ">

										<h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle']; ?></h5>

										<div class="theme-search-results-item-car-location">



											<div class="theme-search-results-item-car-location-body">

												<p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID( $rentCarRow['bodyTypeID'] ) ?></p>

												<input type="hidden" name="carTitle" id="carTitle" value="<?php echo $rentCarRow['carTitle']; ?>"/>

												<?php echo getCarClassedFromID( $rentCarRow['carClassID'] ); ?></p>
                                                <p class="theme-search-results-item-car-location-subtitle black-text">or similar</p>

											</div>

										</div>

										<ul class="theme-search-results-item-car-list"><?php $extraFeatures = $rentCarRow['extraFeatures'];

											if ( $extraFeatures > 0 )

											{

												$featureResult = $db->query( "SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)" );

												while ( $featureRow = mysqli_fetch_assoc( $featureResult ) )

												{

													?>

													<li class="list-float "><i class="fa fa-check"></i><?php echo $featureRow['extraFeatures']; ?>

													</li><?php

												}

											} ?>



										</ul>




									</div>

									<?php

									//Calculate Months, weeks and days

									//									include_once "inc_days_calculation.php";





									?>

									<div class="col-md-3">

										<div class="theme-search-results-item-book">

											<div class="theme-search-results-item-price">

												<p class="theme-search-results-item-price-tag">

													<?php



													//													$fullRentalPrice = ( $dailyPrice * $aDays ) + ( $weeklyPrice * $aWeeks ) + ( $monthlyPrice * $aMonths );

													$totalDaysForCalculation = 0;

													$fullRentalPrice         = 0;

													switch ( $bookingTerm )

													{



														case BOOKING_DAILY:

															$fullRentalPrice         = ( $dailyPrice * $totalDays);

															$totalDaysForCalculation = $totalDays;

															break;





														case BOOKING_WEEKLY:

															$fullRentalPrice         = ( $weeklyPrice * ( $totalDays / 7 ));

															$totalDaysForCalculation = ( $totalDays / 7 );

															break;



														case BOOKING_MONTHLY:

															$fullRentalPrice         = ( $monthlyPrice * ( $totalDays / 30 ));

															$totalDaysForCalculation = ( $totalDays / 30 );

															break;

													}



                                                    $totalAmount = $fullRentalPrice;



//													$fullRentalPrice = number_format( (float) $fullRentalPrice, 2, '.', '' );
													$fullRentalPrice = number_format( (int) $fullRentalPrice);

													echo $_SESSION[ CURRENT_CURRENCY ] . " " . $fullRentalPrice;







													 //+ ( $vrf4 * $totalDays );

													?>

												</p>

												<!--											<p class="theme-search-results-item-price-sign">per day</p>-->

											</div>



										</div>

									</div>

								</div>

							</div>

						</div>



<!--						<hr>-->



						<div class="row">

							<div class="col-md-6">

								<input class="form-control" name="fullRentalPrice" type="hidden" value="<?php echo $fullRentalPrice; ?>"/>

								<input class="form-control" id="pickupLocation" name="pickupLocation" type="hidden" value="<?php echo $pickupLocation; ?>"/>

								<input class="form-control" id="dropLocation" name="dropLocation" type="hidden" value="<?php echo $dropLocation; ?>"/>

								<input class="form-control" id="pickupDate" name="pickupDate" type="hidden" value="<?php echo $pickupDate; ?>"/>

								<input class="form-control" id="dropDate" name="dropDate" type="hidden" value="<?php echo $dropDate; ?>"/>

								<input class="form-control" id="rentBodyType" name="rentBodyType" type="hidden" value="<?php echo $rentBodyType; ?>"/>

								<input class="form-control" id="slug" name="slug" type="hidden" value="<?php echo $slug; ?>"/>

								<input class="form-control" id="totalDays" name="totalDays" type="hidden" value="<?php echo $totalDays; ?>"/>

							</div>



<!--							<div class="col-md-6">-->

<!--								<label class="text-upcase  mar-rt "> Total Amount :-->

<!--                                    <input type="hidden" readonly id="totalcalculate1" class="form-control totalAmountToPayInput" name="totalcalculate1" value="--><?php //echo number_format( $totalAmount , 2 ) ; ?><!--"/>-->
                                    <input type="hidden" readonly id="totalcalculate1" class="form-control totalAmountToPayInput" name="totalcalculate1" value="<?php echo (int) $totalAmount; ?>"/>

<!--                            </label>-->

<!--								<button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="proceed" name="proceed"> Proceed</button>-->

<!--							</div>-->

						</div>
                        <?php
                        if($totalDays > 7 && $bookingTerm == 'Weekly')
                        {
                            ?>
                            <br>
                            <p class="red-text">* In case the car is returned before 7 days then daily rates will be applicable</p>
                        <?php } ?>


                        <?php
                        if($totalDays >= 30 && $bookingTerm == 'Monthly')
                        {
                            ?>
<!--                            <br>-->
<!--                            <p class="red-text">* In case the car is returned before 30 days then weekly rates will be applicable</p>-->
                        <?php
                        if($_SERVER['REQUEST_METHOD'] === 'GET' && $totalDays >= 30 )
                        {
                        ?>
                            <br>
                            <p class="red-text">* In case the car is returned before 30 days then weekly rates will be applicable</p>
                        <?php }
                        else
                        {
                            ?>
                                <br>
                            <p class="red-text">* In case the car is returned before 30 days then weekly rates will be applicable</p>
                        <?php
                        }}?>
						<hr>





						<div class="theme-account-notifications">



							<!--FOR YOUR SAFETY-->

							<div style="display: none">

								<h4>For Your Protection & Safety</h4>

								<div class="theme-account-notifications-item">



									<div class="row">

										<div class="col-sm-7"><label class="icheck-label">

                 

                  <span class="icheck-title">SCDW

                    <span class="icheck-sub-title">Super Collision Damage Waiver</span>

                  </span> </label></div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8">

												<span class="icheck-title">

													<?php

													$scdwAmount = $rentCarRow[ 'scdw' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

													$scdwAmount = number_format( (float) ( $scdwAmount * $totalDaysForCalculation ), 2, '.', '' );

													echo $_SESSION[ CURRENT_CURRENCY ] . " " . $scdwAmount; ?>

												</span>

												</div>

												<div class="col-md-4"><input class="icheck addonsCheckBox" id="scdw" name="scdw" value="<?php echo $scdwAmount; ?>" type="checkbox"/></div>

											</div>





										</div>

									</div>



								</div>

								<div class="theme-account-notifications-item">





									<div class="row">

										<div class="col-sm-7"><label class="icheck-label">

                 

                  <span class="icheck-title">CDW

                    <span class="icheck-sub-title">Collision Damage Waiver</span>

                  </span> </label></div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$cdwAmount = $rentCarRow[ 'cdw' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$cdwAmount = number_format( (float) ( $cdwAmount * $totalDaysForCalculation ), 2, '.', '' );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $cdwAmount;



														?>

												</span></div>

												<div class="col-md-4"><input class="icheck" id="cdw" name="cdw" value="<?php echo $cdwAmount; ?>" type="checkbox"/></div>

											</div>





										</div>

									</div>



								</div>

								<div class="theme-account-notifications-item">





									<div class="row">

										<div class="col-sm-7"><label class="icheck-label">

                 

                  <span class="icheck-title">Personal Accident Insurance

                    <span class="icheck-sub-title">Personal Accident Insurance Covers driver and passengers in case of serious personal injury.</span>

                  </span> </label></div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$paiAmount = $rentCarRow[ 'pai' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$paiAmount = number_format( (float) ( $paiAmount * $totalDaysForCalculation ), 2, '.', '' );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $paiAmount;



														?></span></div>

												<div class="col-md-4"><input class="icheck" id="pai" name="pai" value="<?php echo $paiAmount; ?>" type="checkbox"/></div>

											</div>





										</div>

									</div>



								</div>

							</div>

							<br>

							<!--Enhance Your Driving Experience-->

							<div style="display: none">

								<h4>Enhance Your Autorent Experience</h4>

								<hr>

								<div class="theme-account-notifications-item">





									<div class="row">

										<div class="col-sm-7">

											<label class="icheck-label">

											<span class="icheck-title">GPS<span class="icheck-sub-title">GPS satellite System</span>

											</span>

											</label>



											<input class="form-control" id="pickupLocation2" name="pickupLocation2" type="hidden" value="<?php echo $pickupLocation; ?> "/>

											<input class="form-control" id="dropLocation2" name="dropLocation2" type="hidden" value="<?php echo $dropLocation; ?>"/>

											<input class="form-control" id="pickupDate2" name="pickupDate2" type="hidden" value="<?php echo $pickupDate; ?>"/>

											<input class="form-control" id="dropDate2" name="dropDate2" type="hidden" value="<?php echo $dropDate; ?>"/>

											<input class="form-control" id="slug2" name="slug2" type="hidden" value="<?php echo $slug; ?>"/>

											<input class="form-control" id="bookingTerm" name="bookingTerm" type="hidden" value="<?php echo $bookingTerm; ?>"/>

											<input class="form-control" id="totalDays2" name="totalDays2" type="hidden" value="<?php echo $totalDays; ?>"/>

										</div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$gpsAmount = $rentCarRow[ 'gps' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$gpsAmount = number_format( (float) ( $gpsAmount * $totalDaysForCalculation ), 2, '.', '' );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $gpsAmount;





														?></span></div>

												<div class="col-md-4">

													<input class="icheck" id="gps" name="gps" value="<?php echo $gpsAmount; ?>" type="checkbox"/>

												</div>

											</div>





										</div>

									</div>



								</div>

								<div class="theme-account-notifications-item">



									<div class="row">

										<div class="col-sm-7">

											<label class="icheck-label">

											<span class="icheck-title">Additional Driver

												<span class="icheck-sub-title">Share the driving on any journey and enjoy the peace of mind that someone else is insured to drive if needed.</span>

											</span> </label>

										</div>



										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$additionalDriverAmount = $rentCarRow[ 'additionalDriver' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$additionalDriverAmount = number_format( (float) ( $additionalDriverAmount * $totalDaysForCalculation ), 2, '.', '' );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $additionalDriverAmount;



														?> </span></div>

												<div class="col-md-4"><input class="icheck" id="additionalDriver" name="additionalDriver" value="<?php echo $additionalDriverAmount; ?>" type="checkbox"/></div>

											</div>





										</div>

									</div>



								</div>

								<div class="theme-account-notifications-item">





									<div class="row">

										<div class="col-sm-7"><label class="icheck-label">

                 

                  <span class="icheck-title">Baby Safety Seat

                    <span class="icheck-sub-title">For children 1-4 years (13-25 kg, 20-50 lb)</span>

                  </span> </label></div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$babySafetySeatAmount = $rentCarRow[ 'babySafetySeat' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$babySafetySeatAmount = number_format( (float) ( $babySafetySeatAmount * $totalDaysForCalculation ), 2, '.', '' );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $babySafetySeatAmount;





														?> </span></div>

												<div class="col-md-4"><input class="icheck" id="babySafetySeat" name="babySafetySeat" value="<?php echo $babySafetySeatAmount; ?>" type="checkbox"/></div>

											</div>





										</div>

									</div>



								</div>

								<div class="theme-account-notifications-item">





									<div class="row">

										<div class="col-sm-7"><label class="icheck-label">

                 

                  <span class="icheck-title">Additional Baby Safety Seat

                    <span class="icheck-sub-title">For children 1-4 years (13-25 kg, 20-50 lb)</span>

                  </span> </label></div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$addBabySafetySeatAmount = $rentCarRow[ 'addBabySafetySeat' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$addBabySafetySeatAmount = number_format( (float) ( $addBabySafetySeatAmount * $totalDaysForCalculation ), 2, '.', '' );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $addBabySafetySeatAmount;





														?>

												</span></div>

												<div class="col-md-4"><input class="icheck" id="addBabySafetySeat" name="addBabySafetySeat" value="<?php echo $addBabySafetySeatAmount; ?>" type="checkbox"/></div>

											</div>





										</div>

									</div>



								</div>

							</div>







							<!--FOR PHASE 1-->

							<div class="enhance-experience-div">

								<h4 class="text-center">Enhance Your Autorent Experience</h4>

								<hr>





								<div class="theme-account-notifications-item">

									<div class="row">

										<div class="col-sm-7">

											<label class="icheck-label book-rental-icon">
                                                <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-credit-card"></i>
											    <span class="icheck-title rental-addons-title"> Orange Card
                                                <a class="tooltip-bubble" data-toggle="tooltip" data-placement="top" title="The Orange Card covers damages caused by the Insured to a Third Party in Oman and UAE. An Orange Card is required when you are traveling from UAE to Oman.">
                                                <i class='glyphicon glyphicon-info-sign'></i>
                                                </a>
                                                    </span>
											</label>

										</div>



										<div class="col-md-5">

											<div class="row addOns-float-right">

												<div class="col-md-8 addOns-float-left">

													<span class="icheck-title">

														<?php

//														$phase1OrangeCard = number_format( (float) ( $phase1OrangeCard ), 2, '.', '' );
														$phase1OrangeCard = number_format( (int) ( $phase1OrangeCard ) );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $phase1OrangeCard;

														?>

													</span>

												</div>

												<div class="col-md-4 addOns-float-left">



														<input class="icheck" id="phase1OrangeCard" name="phase1OrangeCard" value="<?php echo $phase1OrangeCard; ?>" type="checkbox" />

																									</div>

											</div>

										</div>

									</div>



								</div>



								<div class="theme-account-notifications-item">

									<div class="row">

										<div class="col-sm-7">

											<label class="icheck-label book-rental-icon">
                                                <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-map-marker"></i>
												<span class="icheck-title rental-addons-title">GPS
                                                <a class="tooltip-bubble" data-toggle="tooltip" data-placement="top" title="The GPS navigation service provides you with the best portable in-car navigation. Just choose your destination address, and let our GPS do the rest, directing you with clear turn-by-turn instructions.">
                                                <i class='glyphicon glyphicon-info-sign'></i>
                                                </a>

                                                </span>

											</label>

										</div>



										<div class="col-md-5">

											<div class="row addOns-float-right">

												<div class="col-md-8 addOns-float-left">

													<span class="icheck-title">

														<?php

														$phase1GPS = number_format( (int) ( $phase1GPS ));

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $phase1GPS;

														?>

													</span>

												</div>

												<div class="col-md-4 addOns-float-left">



														<input class="icheck" id="phase1GPS" name="phase1GPS" value="<?php echo $phase1GPS; ?>" type="checkbox"/>





												</div>

											</div>

										</div>

									</div>



								</div>







								<div class="theme-account-notifications-item">

									<div class="row">

										<div class="col-sm-7">

											<label class="icheck-label book-rental-icon">
                                                <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-truck"></i>
												<span class="icheck-title rental-addons-title">Delivery Charges
                                                <a class="tooltip-bubble" data-toggle="tooltip" data-placement="top" title="Delivery charges apply if car is rented for less than 3 days and if car delivered outside Dubai, then additional charges apply.">
                                                <i class='glyphicon glyphicon-info-sign'></i>
                                                </a>

                                                </span>

											</label>

										</div>



										<div class="col-md-5">

											<div class="row addOns-float-right">

												<div class="col-md-8 addOns-float-left">

													<span class="icheck-title">

														<?php



														$phase1DeliveryCharges = number_format( (int) ( $phase1DeliveryCharges ));

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $phase1DeliveryCharges;

														?>

													</span>

												</div>

												<div class="col-md-4 addOns-float-left">



														<input class="icheck" id="phase1DeliveryCharges" name="phase1DeliveryCharges" value="<?php echo $phase1DeliveryCharges; ?>" type="checkbox"/>





												</div>

											</div>

										</div>

									</div>



								</div>







								<div class="theme-account-notifications-item">

									<div class="row">

										<div class="col-sm-7">

											<label class="icheck-label book-rental-icon">
                                                <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-truck"></i>
												<span class="icheck-title rental-addons-title">Collection Charges
                                                <a class="tooltip-bubble" data-toggle="tooltip" data-placement="top" title="Collection charges apply if car is rented for less than 3 days and if car delivered outside Dubai, then additional charges apply.">
                                                <i class='glyphicon glyphicon-info-sign'></i>
                                                </a>

                                                </span>

											</label>

										</div>



										<div class="col-md-5">

											<div class="row addOns-float-right">

												<div class="col-md-8 addOns-float-left">

													<span class="icheck-title">

														<?php



														$phase1CollectionCharges = number_format( (int) ( $phase1CollectionCharges ) );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $phase1CollectionCharges;

														?>

													</span>

												</div>

												<div class="col-md-4 addOns-float-left">



														<input class="icheck" id="phase1CollectionCharges" name="phase1CollectionCharges" value="<?php echo $phase1CollectionCharges; ?>" type="checkbox" />





												</div>

											</div>

										</div>

									</div>



								</div>

















							</div>







						</div>



						<br>





						<div class="theme-payment-page-sections-item">

							<div class="theme-payment-page-booking">

								<div class="theme-payment-page-booking-header">

									<!--									<h3 class="theme-payment-page-booking-title">Total Price for --><?php //echo $totalDays; ?><!-- days</h3>-->

									<h3 class="theme-payment-page-booking-title">Total Price

										<?php if ( $aMonths > 0 )

										{

											if ( $aMonths > 1 )

											{

												echo $aMonths . " months ";

											} else

											{

												echo $aMonths . " month ";

											}

										}



										if ( $aWeeks > 0 )

										{

											if ( $aWeeks > 1 )

											{

												echo $aWeeks . " weeks ";

											} else

											{

												echo $aWeeks . " week ";

											}

										}



										if ( $aDays > 0 )

										{

											if ( $aDays > 1 )

											{

												echo $aDays . " days ";

											} else

											{

												echo $aDays . " day ";

											}

										} ?>

									</h3>

									<p class="theme-payment-page-booking-subtitle black-text">By clicking book now button you agree with terms and conditions and money back gurantee. Thank you for trusting our service. </p>

									<p class="theme-payment-page-booking-price"><?php echo $_SESSION[ CURRENT_CURRENCY ]; ?>

<!--										<input type="text" readonly class="form-control totalAmountToPayInput" value="--><?php //echo number_format( $totalAmount, 2 ); ?><!--"/>-->
										<input type="text" readonly class="form-control totalAmountToPayInput" value="<?php echo number_format( (int) $totalAmount); ?>"/>

										<!--											<input type="hidden" id="payonline" class="form-control" name="payonline" value="--><?php //echo $onlinePrice; ?><!--"/>-->

										<!--										<input type="hidden" readonly id="totalcalculate" class="form-control" name="totalcalculate" value="--><?php //echo number_format( $totalcalc, 2 ); ?><!--"/>-->

									</p>

								</div>

								<!--  <a class="btn _tt-uc btn-primary-inverse btn-lg btn-block" href="/checkout">Book Now</a>-->

								<button class="btn _tt-uc btn-primary-inverse btn-lg btn-block" id="btnbooknow" name="btnbooknow" type="submit"> Book Now

								</button>

								<br> <input type="hidden" name="leaseslug2" id="leaseslug2" value="<?php echo $slug; ?>"/>

							</div>

						</div>

					</form>





				</div>

			</div>





			<!--SIDE BAR-->

			<div class="col-md-4 ">

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

							<li><?php echo $totalDays; ?> Day (s)</li>



						</ul>

					</div>





					<!--Modify Search-->



					<div class="theme-search-area _mb-20 _p-20 _b _bc-dw theme-search-area-vert">





                    <div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white">

						<div class="theme-search-area-header _mb-20 theme-search-area-header-sm">

							<h1 class="theme-search-area-title">Modify Search</h1>

						</div>

						<form id="rentcars" name="rentcars" method="post" action="/rent-a-car">

							<div class="theme-search-area-form">



								<div>

									<label class="theme-search-area-section-label">Car Category</label>

									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">



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

								</div>





								<div>

									<label class="theme-search-area-section-label">Pick Up Location</label>



									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">





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

								</div>





								<div>

									<label class="theme-search-area-section-label">Drop off location</label>



									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">





										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">

											<i class="fa fa-angle-down"></i>





											<select class="form-control" id="dropLocation" name="dropLocation" required>

																							<i class="theme-search-area-section-icon lin lin-location-pin"></i>

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

								</div>



<!---->
<!---->
<!--								<div>-->
<!--									<label class="theme-search-area-section-label">Pick Up Date</label>-->
<!--									<div class="theme-search-area-section theme-search-area-section-curved">-->
<!--										<div class="theme-search-area-section-inner">-->
<!--											<i class="theme-search-area-section-icon lin lin-calendar"></i>-->
<!--											<input class="theme-search-area-section-input datePickerStart  _mob-h" id="pickupDate" name="pickupDate" required  type="text" placeholder="Pick Up Date"/>-->
<!--                                            <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->


                                <div>
                                    <label class="theme-search-area-section-label">Pick Up Date</label>
                                    <div class="theme-search-area-section theme-search-area-section-curved">
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon lin lin-calendar"></i>
<!--                                            <input class="theme-search-area-section-input" id="pickupDate" name="pickupDate" required type="text" placeholder="Drop Off Date" />-->
<!--                                            <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>-->

                                            <input class="theme-search-area-section-input datePickerStart" id="drivePickupDate" required name="drivePickupDate" type="text" placeholder="Pick Up Date"/>
                                            <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

                                        </div>
                                    </div>
                                </div>



                                <div>
									<label class="theme-search-area-section-label">Drop Off Date</label>
									<div class="theme-search-area-section theme-search-area-section-curved">
										<div class="theme-search-area-section-inner">
											<i class="theme-search-area-section-icon lin lin-calendar"></i>
<!--											<input class="theme-search-area-section-input" id="dropDate" name="dropDate" required type="text" placeholder="Drop Off Date" />-->
<!--                                            <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>-->

                                            <input class="theme-search-area-section-input datePickerEnd " id="driveDropDate" name="driveDropDate" required type="text" placeholder="Drop Off Date"/>
                                            <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

										</div>
									</div>
								</div>





							</div>

							<button class="theme-search-area-submit _mt-0 _fw-n _ls-0 _tt-uc theme-search-area-submit-primary theme-search-area-submit-no-border

                  theme-search-area-submit-curved" id="btnRentSearch" onclick="functionName()" name="btnRentSearch" type="submit">Modify

							</button>

						</form>

					</div>

<script>





</script>



				</div>





			</div>





		</div>

	</div>

</div>

</div>





<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>



<script>



    $(document).ready(function () {

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        ?>
            // alert('POST');
            $('#rentcars #rentBodyType').val('<?php echo $_POST["rentBodyType2"] ?>');

            $('#rentcars #pickupLocation').val('<?php echo $_POST["pickupLocation2"] ?>');

            $('#rentcars #dropLocation').val('<?php echo $_POST["dropLocation2"] ?>');

            $('#rentcars #drivePickupDate').val('<?php echo $_POST["pickupDate2"] ?>');

            $('#rentcars #driveDropDate').val('<?php echo $_POST["dropDate2"] ?>');
        <?php
                }

                else
                {
                    ?>


                    $('#rentcars #rentBodyType').val('<?php echo  $rentCarRow['bodyTypeID'] ?>');

                    $('#rentcars #pickupLocation').val('<?php echo  $pickupLocation ; ?>');

                    $('#rentcars #dropLocation').val('<?php echo  $dropLocation ; ?>');

                    $('#rentcars #drivePickupDate').val('<?php echo $pickupDate ?>');

                    $('#rentcars #driveDropDate').val('<?php echo $dropDate ?>');
                    <?php
                }
        ?>
            });
















            var $ = jQuery;



            var totalDaysOfRent = 0;

            totalDaysOfRent = <?php echo $totalDays; ?>;

    var totalAmount = 0;

    totalAmount = <?php echo $totalAmount; ?>;

    var totalAddonsPrice = 0;



    $('.icheck').on('ifChanged', function (event) {

        // alert('checked = ' + event.target.checked);

        // alert('value = ' + event.target.value);



        if (event.target.checked == true) {

            // totalAddonsPrice += (parseFloat(event.target.value) * parseFloat(totalDaysOfRent));

            totalAddonsPrice += parseFloat(event.target.value);

        } else {

            // totalAddonsPrice -= (parseFloat(event.target.value) * parseFloat(totalDaysOfRent));

            totalAddonsPrice -= parseFloat(event.target.value);

        }



        // $(".totalAmountToPayInput").val((Math.round((parseFloat(totalAmount) + parseFloat(totalAddonsPrice)) * 100) / 100).toFixed(2));
        $(".totalAmountToPayInput").val((Math.round((parseFloat(totalAmount) + parseFloat(totalAddonsPrice)) * 100) / 100));



        // console.log(totalAddonsPrice);

    });











    /*    $(".addonsCheckBox").change(function(e){

		   console.log("changed");

		});





		$(document).on('ifChanged', function (e) {



			var vrf = parseFloat($(this).val());

			console.log($(this));

			return false;



			var checkBox = document.getElementById("vrf");

			$('input[name="vrf"]:checked').each(function () {

				// alert(this.value);

				var vrf = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var vrf1 = vrf;

				var total = totalPrice + vrf;

				var totalnew = totalPrice1 + vrf1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});



			if (checkBox.checked == true) {

			} else {

				var vrf = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var vrf1 = vrf;

				var total = totalPrice - vrf;

				var totalnew = totalPrice1 - vrf1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});











		//for lease cars



	/*

		$(document).on('ifChanged', '#vrf', function (e) {

			var checkBox = document.getElementById("vrf");

			$('input[name="vrf"]:checked').each(function () {

				// alert(this.value);

				var vrf = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var vrf1 = vrf;

				var total = totalPrice + vrf;

				var totalnew = totalPrice1 + vrf1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var vrf = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var vrf1 = vrf;

				var total = totalPrice - vrf;

				var totalnew = totalPrice1 - vrf1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});



		$(document).on('ifChanged', '#scdw', function (e) {

			var checkBox = document.getElementById("scdw");

			$('input[name="scdw"]:checked').each(function () {

				// alert(this.value);

				var scdw = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var scdw1 = scdw;

				var total = totalPrice + scdw;

				var totalnew = totalPrice1 + scdw1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var scdw = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var scdw1 = scdw;

				var total = totalPrice - scdw;

				var totalnew = totalPrice1 - scdw1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});



		$(document).on('ifChanged', '#cdw', function (e) {

			var checkBox = document.getElementById("cdw");

			$('input[name="cdw"]:checked').each(function () {

				// alert(this.value);

				var cdw = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var cdw1 = cdw;

				var total = totalPrice + cdw;

				var totalnew = totalPrice1 + cdw1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var cdw = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var cdw1 = cdw;

				var total = totalPrice - cdw;

				var totalnew = totalPrice1 - cdw1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});





		$(document).on('ifChanged', '#pai', function (e) {

			var checkBox = document.getElementById("pai");

			$('input[name="pai"]:checked').each(function () {

				// alert(this.value);

				var pai = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var pai1 = pai;

				var total = totalPrice + pai;

				var totalnew = totalPrice1 + pai1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var pai = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var pai1 = pai;

				var total = totalPrice - pai;

				var totalnew = totalPrice1 - pai1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});



		$(document).on('ifChanged', '#gps', function (e) {

			var checkBox = document.getElementById("gps");

			$('input[name="gps"]:checked').each(function () {

				// alert(this.value);

				var gps = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var gps1 = gps * totalDays;

				var total = totalPrice + gps;

				var totalnew = totalPrice1 + gps1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var gps = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var gps1 = gps * totalDays;

				var total = totalPrice - gps;

				var totalnew = totalPrice1 - gps1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});

		$(document).on('ifChanged', '#additionalDriver', function (e) {

			var checkBox = document.getElementById("additionalDriver");

			$('input[name="additionalDriver"]:checked').each(function () {

				// alert(this.value);

				var additionalDriver = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var additionalDriver1 = additionalDriver * totalDays;

				var total = totalPrice + additionalDriver;

				var totalnew = totalPrice1 + additionalDriver1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var additionalDriver = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var additionalDriver1 = additionalDriver * totalDays;

				var total = totalPrice - additionalDriver;

				var totalnew = totalPrice1 - additionalDriver1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});



		$(document).on('ifChanged', '#babySafetySeat', function (e) {

			var checkBox = document.getElementById("babySafetySeat");

			$('input[name="babySafetySeat"]:checked').each(function () {

				// alert(this.value);

				var babySafetySeat = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var babySafetySeat1 = babySafetySeat * totalDays;

				var total = totalPrice + babySafetySeat;

				var totalnew = totalPrice1 + babySafetySeat1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var babySafetySeat = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var babySafetySeat1 = babySafetySeat * totalDays;

				var total = totalPrice - babySafetySeat;

				var totalnew = totalPrice1 - babySafetySeat1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});



		$(document).on('ifChanged', '#addBabySafetySeat', function (e) {

			var checkBox = document.getElementById("addBabySafetySeat");

			$('input[name="addBabySafetySeat"]:checked').each(function () {

				// alert(this.value);

				var addBabySafetySeat = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalPrice1 = parseFloat(totalcalculate1);

				var totalDays = $('input[name=totalDays33]').val();



				var addBabySafetySeat1 = addBabySafetySeat * totalDays;

				var total = totalPrice + addBabySafetySeat;

				var totalnew = totalPrice1 + addBabySafetySeat1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			});

			if (checkBox.checked == true) {

			} else {

				var addBabySafetySeat = parseFloat(this.value);

				var totalcalculate = $('input[name=totalcalculate]').val();

				var totalcalculate1 = $('input[name=totalcalculate1]').val();

				var totalDays = $('input[name=totalDays33]').val();

				var totalPrice = parseFloat(totalcalculate);

				var totalPrice1 = parseFloat(totalcalculate1);

				var addBabySafetySeat1 = addBabySafetySeat * totalDays;

				var total = totalPrice - addBabySafetySeat;

				var totalnew = totalPrice1 - addBabySafetySeat1;



				$('input[name=totalcalculate]').val(total);

				$('input[name=totalcalculate1]').val(totalnew);

			}

		});

	*/

    //

    // $(document).on('ifChanged', '#addBabySafetySeat', function (e) {

    //     var checkBox = document.getElementById("addBabySafetySeat");

    //     $('input[name="addBabySafetySeat"]:checked').each(function() {

    //         var addBabySafetySeat = parseFloat(this.value);

    //         var totalcalculate = $('input[name=totalcalculate]').val();

    //         var totalPrice = parseFloat(totalcalculate);

    //         var total = addBabySafetySeat + totalPrice;

    //         $('input[name=totalcalculate]').val(total);

    //     });

    //

    //     if (checkBox.checked == true) {

    //

    //     } else {

    //         var addBabySafetySeat = parseFloat(this.value);

    //         var totalcalculate = $('input[name=totalcalculate]').val();

    //         var totalPrice = parseFloat(totalcalculate);

    //         var total = totalPrice - addBabySafetySeat;

    //

    //         $('input[name=totalcalculate]').val(total);

    //     }

    //

    //

    // });





    // $('#proceed').click(function () {
    //
    //     $("#btnbooknow").click();
    //
    // })


    //
    // $( "#dropDate" ).change(function() {
    //     alert( "Handler for .change() called." );
    // });



</script>

<!--tooltip-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--tooltip-->

</body>

</html>