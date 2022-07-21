<?php include "inc_opendb.php";

$PAGEID = "Book Pay as you Drive";


//
//echo "<pre>";
//
//echo print_r($_POST);
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



if ( isset( $_POST["drivePickupLocation2"] ) )

{

	$pickupLocation = filter_var( $_POST['drivePickupLocation2'], FILTER_SANITIZE_STRING );

}

if ( isset( $_POST["driveDropLocation2"] ) )

{

	$dropLocation = filter_var( $_POST['driveDropLocation2'], FILTER_SANITIZE_STRING );

}

if ( isset( $_POST["drivePickupDate2"] ) )

{

	$pickupDate = filter_var( $_POST['drivePickupDate2'], FILTER_SANITIZE_STRING );

}

if ( isset( $_POST["driveDropDate2"] ) )

{

	$dropDate = filter_var( $_POST['driveDropDate2'], FILTER_SANITIZE_STRING );

}

if ( isset( $_POST["driveBodyType2"] ) )

{

	$rentBodyType = filter_var( $_POST['driveBodyType2'], FILTER_SANITIZE_STRING );

}





$bookingTerm = "";



/*if ( isset( $_POST['btnBookDaily'] ) )

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

}*/





//$slug = filter_var( $_POST[ 'btnBook' . $bookingTerm ], FILTER_SANITIZE_STRING );



$bookingTerm  = filter_var( $_POST['selectedTerm'], FILTER_SANITIZE_STRING );

$slug         = filter_var( $_POST['selectedVehicleSlug'], FILTER_SANITIZE_STRING );

$selectedSlab = filter_var( $_POST['selectedSlab'], FILTER_SANITIZE_STRING );





if ( isset( $_POST["driveTotalDays2"] ) )

{

	$totalDays = filter_var( $_POST['driveTotalDays2'], FILTER_SANITIZE_STRING );

}





$s1DailyPrice = 0;

$s2DailyPrice = 0;

$s3DailyPrice = 0;

$s4DailyPrice = 0;

$s5DailyPrice = 0;



$s1DailyKM = 0;

$s2DailyKM = 0;

$s3DailyKM = 0;

$s4DailyKM = 0;

$s5DailyKM = 0;



$s1WeeklyPrice = 0;

$s2WeeklyPrice = 0;

$s3WeeklyPrice = 0;

$s4WeeklyPrice = 0;

$s5WeeklyPrice = 0;

$s1WeeklyKM    = 0;

$s2WeeklyKM    = 0;

$s3WeeklyKM    = 0;

$s4WeeklyKM    = 0;

$s5WeeklyKM    = 0;



$s1MonthlyPrice = 0;

$s2MonthlyPrice = 0;

$s3MonthlyPrice = 0;

$s4MonthlyPrice = 0;

$s5MonthlyPrice = 0;

$s1MonthlyKM    = 0;

$s2MonthlyKM    = 0;

$s3MonthlyKM    = 0;

$s4MonthlyKM    = 0;

$s5MonthlyKM    = 0;



$addon01KM    = '';

$addon01Price = '';

$addon02KM    = '';

$addon02Price = '';

$addon03KM    = '';

$addon03Price = '';

$addon04KM    = '';

$addon04Price = '';

$addon05KM    = '';

$addon05Price = '';



$selectedSlabPrice = '';



if ( isset( $slug ) && ! empty( $slug ) )

{

	$result     = $db->query( "SELECT * FROM pay_as_you_drive WHERE slug = ?s", $slug );

	$rentCarRow = mysqli_fetch_assoc( $result );



	$s1DailyPrice = $rentCarRow['s1DailyAED'];

	$s2DailyPrice = $rentCarRow['s2DailyAED'];

	$s3DailyPrice = $rentCarRow['s3DailyAED'];

	$s4DailyPrice = $rentCarRow['s4DailyAED'];

	$s5DailyPrice = $rentCarRow['s5DailyAED'];



	$s1WeeklyPrice = $rentCarRow['s1WeeklyAED'];

	$s2WeeklyPrice = $rentCarRow['s2WeeklyAED'];

	$s3WeeklyPrice = $rentCarRow['s3WeeklyAED'];

	$s4WeeklyPrice = $rentCarRow['s4WeeklyAED'];

	$s5WeeklyPrice = $rentCarRow['s5WeeklyAED'];



	$s1MonthlyPrice = $rentCarRow['s1MonthlyAED'];

	$s2MonthlyPrice = $rentCarRow['s2MonthlyAED'];

	$s3MonthlyPrice = $rentCarRow['s3MonthlyAED'];

	$s4MonthlyPrice = $rentCarRow['s4MonthlyAED'];

	$s5MonthlyPrice = $rentCarRow['s5MonthlyAED'];



	$s1DailyKM = $rentCarRow['s1DailyKM'];

	$s2DailyKM = $rentCarRow['s2DailyKM'];

	$s3DailyKM = $rentCarRow['s3DailyKM'];

	$s4DailyKM = $rentCarRow['s4DailyKM'];

	$s5DailyKM = $rentCarRow['s5DailyKM'];



	$s1WeeklyKM = $rentCarRow['s1WeeklyKM'];

	$s2WeeklyKM = $rentCarRow['s2WeeklyKM'];

	$s3WeeklyKM = $rentCarRow['s3WeeklyKM'];

	$s4WeeklyKM = $rentCarRow['s4WeeklyKM'];

	$s5WeeklyKM = $rentCarRow['s5WeeklyKM'];



	$s1MonthlyKM = $rentCarRow['s1MonthlyKM'];

	$s2MonthlyKM = $rentCarRow['s2MonthlyKM'];

	$s3MonthlyKM = $rentCarRow['s3MonthlyKM'];

	$s4MonthlyKM = $rentCarRow['s4MonthlyKM'];

	$s5MonthlyKM = $rentCarRow['s5MonthlyKM'];



	$addon01KM    = $rentCarRow['addon01KM'];

	$addon01Price = $rentCarRow['addon01Price'];

	$addon02KM    = $rentCarRow['addon02KM'];

	$addon02Price = $rentCarRow['addon02Price'];

	$addon03KM    = $rentCarRow['addon03KM'];

	$addon03Price = $rentCarRow['addon03Price'];

	$addon04KM    = $rentCarRow['addon04KM'];

	$addon04Price = $rentCarRow['addon04Price'];

	$addon05KM    = $rentCarRow['addon05KM'];

	$addon05Price = $rentCarRow['addon05Price'];





	$selectedSlabPrice = $rentCarRow[ 's' . $selectedSlab . $bookingTerm . "AED" ];



}



$totalAddonAmount = 0;

$phase1OrangeCard        = $rentCarRow['phase1OrangeCard'];

$phase1GPS               = $rentCarRow['phase1GPS'];

$phase1DeliveryCharges   = $rentCarRow['phase1DeliveryCharges'];

$phase1CollectionCharges = $rentCarRow['phase1CollectionCharges'];

//$totalAddonAmount = $phase1OrangeCard + $phase1GPS + $phase1DeliveryCharges + $phase1CollectionCharges;



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

                                <a>Pay as you Drive</a>

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



			<div class="col-md-8 ">

				<!--				--><?php

				//				echo "<pre>";

				//				echo print_r( $_POST );

				//				echo "</pre>";

				//				?>

				<div class="theme-payment-page-sections">



					<form method="post" action="/pay-as-you-drive-checkout" name="addonsForm">



						<div class="theme-search-results-item theme-search-results-item-">

							<div class="theme-search-results-item-preview">





								<?php



//								echo "<pre>";

//								echo "Selected Slab Price: " . $selectedSlabPrice;

//

//

//								print_r( $_POST );

//								echo "</pre>";



								?>





								<div class="row" data-gutter="20">

									<div class="col-md-4 ">

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



									<div class="col-md-5 ">

										<h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle']; ?></h5>

										<div class="theme-search-results-item-car-location">



											<div class="theme-search-results-item-car-location-body">

												<p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID( $rentCarRow['bodyTypeID'] ) ?></p>

												<p class="theme-search-results-item-car-location-subtitle black-text">or similar</p>

												<input type="hidden" name="carTitle" id="carTitle" value="<?php echo $rentCarRow['carTitle']; ?>"/>

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





									<div class="col-md-3">

										<div class="theme-search-results-item-book">

											<div class="theme-search-results-item-price">

												<p class="theme-search-results-item-price-tag">

													<?php

													$totalDaysForCalculation = 0;

													$fullRentalPrice         = 0;

													switch ( $bookingTerm )

													{

														case BOOKING_DAILY:

															$fullRentalPrice         = ( $selectedSlabPrice * $totalDays );

															$totalDaysForCalculation = $totalDays;

															break;



														case BOOKING_WEEKLY:

															$fullRentalPrice         = ( $selectedSlabPrice * ( $totalDays / 7 ) );

															$totalDaysForCalculation = ( $totalDays / 7 );

															break;



														case BOOKING_MONTHLY:

															$fullRentalPrice         = ( $selectedSlabPrice * ( $totalDays / 30 ) );

															$totalDaysForCalculation = ( $totalDays / 30 );



															break;

													}



													$totalAmount = $fullRentalPrice;





//													$fullRentalPrice = number_format( (float) $fullRentalPrice, 2, '.', '' );
													$fullRentalPrice = number_format( (int) $fullRentalPrice );

													echo $_SESSION[ CURRENT_CURRENCY ] . " " . $fullRentalPrice;



													//                                                    $totalAmount = $fullRentalPrice;

													//+ ( $vrf4 * $totalDays );

													?>

												</p>



											</div>



										</div>

									</div>

								</div>

							</div>

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
                            <br>
                            <p class="red-text">* In case the car is returned before 30 days then weekly rates will be applicable</p>
                        <?php } ?>

						<hr>



						<div class="row">

							<div class="col-md-6">

								<input class="form-control" name="fullRentalPrice" type="hidden" value="<?php echo $fullRentalPrice; ?>"/>

                                <input class="form-control" id="pickupLocation33" name="pickupLocation33" type="hidden" value="<?php echo $pickupLocation; ?>"/>

                                <input class="form-control" id="dropLocation33" name="dropLocation33" type="hidden" value="<?php echo $dropLocation; ?>"/>

								<input class="form-control" id="pickupDate33" name="pickupDate33" type="hidden" value="<?php echo $pickupDate; ?>"/>

                                <input class="form-control" id="dropDate33" name="dropDate33" type="hidden" value="<?php echo $dropDate; ?>"/>

                                <input class="form-control" id="rentBodyType33" name="rentBodyType33" type="hidden" value="<?php echo $rentBodyType; ?>"/>

								<input class="form-control" id="geolocation33" name="geolocation33" type="hidden" value="<?php echo $geolocation; ?>"/>

                                <input class="form-control" id="slug33" name="slug33" type="hidden" value="<?php echo $slug; ?>"/>

                                <input class="form-control" id="bookingTerm" name="bookingTerm" type="hidden" value="<?php echo $bookingTerm; ?>"/>

                                <input class="form-control" id="totalDays33" name="totalDays33" type="hidden" value="<?php echo $totalDays; ?>"/>

                                <input class="form-control" id="selectedTerm33" name="selectedTerm33" type="hidden" value="<?php echo $bookingTerm; ?>"/>

                                <input class="form-control" id="selectedVehicleSlug33" name="selectedVehicleSlug33" type="hidden" value="<?php echo $slug; ?>"/>

                                <input class="form-control" id="selectedSlab33" name="selectedSlab33" type="hidden" value="<?php echo $selectedSlab; ?>"/>

<!--                                <input class="form-control" id="slabAmount" name="slabAmount" type="hidden" value="--><?php //echo $slabAmount; ?><!--"/>-->







<!--                                $bookingTerm  = filter_var( $_POST['selectedTerm'], FILTER_SANITIZE_STRING );-->

<!--                                $slug         = filter_var( $_POST['selectedVehicleSlug'], FILTER_SANITIZE_STRING );-->

<!--                                $selectedSlab = filter_var( $_POST['selectedSlab'], FILTER_SANITIZE_STRING );-->



                            </div>



<!--							<div class="col-md-6">-->

<!--								<label class="text-upcase  mar-rt "> Total Amount :-->

<!--                                    <input type="hidden" readonly id="totalcalculate1" class="form-control totalAmountToPayInput" name="totalcalculate1" value="--><?php //echo number_format( $totalAmount, 2 ); ?><!--"/> </label>-->
                            <input type="hidden" readonly id="totalcalculate1" class="form-control totalAmountToPayInput" name="totalcalculate1" value="<?php echo number_format( (int) $totalAmount); ?>"/>
<!--								<button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="proceed" name="proceed"> Proceed</button>-->

<!--							</div>-->

						</div>



<!--						<hr>-->



						<!--**********************************************************************************************-->



						<div class="theme-account-notifications">

							<h4>Add-on Kms</h4>





							<div class="theme-account-notifications-item">

								<div class="row">

									<div class="col-sm-7">

										<label class="icheck-label">

                                                <span class="icheck-title">

                                                    0 KM

                                                </span> </label>

									</div>

									<div class="col-md-5">

										<div class="row">

											<div class="col-md-8">

												<span class="icheck-title">

													0

												</span>

											</div>

											<div class="col-md-4">

												<input class="slabRadio" name="slab" checked value="0" type="radio"/>

											</div>

										</div>

									</div>

								</div>

							</div>







							<?php

							for ( $i = 1; $i <= 5; $i ++ )

							{

								if ( ! empty( $rentCarRow[ 'addon0' . $i . 'Price' ] ) )

								{





									?>

									<div class="theme-account-notifications-item">

										<div class="row">

											<div class="col-sm-7">

												<label class="icheck-label">

                                                <span class="icheck-title">

                                                    <?php echo $rentCarRow[ 'addon0' . $i . 'KM' ] ?> KM

                                                </span> </label>

											</div>

                                            <?php

                                            $slabKM = $rentCarRow[ 'addon0' . $i . 'KM' ];

                                            ?>

											<div class="col-md-5">

												<div class="row">

													<div class="col-md-8">

												<span class="icheck-title">

													<?php

													$slabAmount = $rentCarRow[ 'addon0' . $i . 'Price' ];

//													$slabAmount = number_format( (float) ( $slabAmount * $totalDaysForCalculation ), 2, '.', '' );
													$slabAmount = number_format( (int) ( $slabAmount * $totalDaysForCalculation ) );

													echo $_SESSION[ CURRENT_CURRENCY ] . " " . $slabAmount; ?>

												</span>

													</div>

													<div class="col-md-4">

														<input class="slabRadio" name="slab"  value="<?php echo $slabAmount; ?>" type="radio"/>

													</div>

												</div>

                                                <input class="form-control" id="slabKM" name="slabKM" type="hidden" value="<?php echo $slabKM; ?>"/>

											</div>

										</div>

									</div>

									<?php

								}

							}

							?>

						</div>




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

											</span> </label>



											<input class="form-control" id="pickupLocation2" name="pickupLocation2" type="hidden" value="<?php echo $pickupLocation; ?> "/>

                                            <input class="form-control" id="dropLocation2" name="dropLocation2" type="hidden" value="<?php echo $dropLocation; ?>"/>

                                            <input class="form-control" id="pickupDate2" name="pickupDate2" type="hidden" value="<?php echo $pickupDate; ?>"/>

											<input class="form-control" id="dropDate2" name="dropDate2" type="hidden" value="<?php echo $dropDate; ?>"/>

                                            <input class="form-control" id="slug2" name="slug2" type="hidden" value="<?php echo $slug; ?>"/>

                                            <input class="form-control" id="totalDays2" name="totalDays2" type="hidden" value="<?php echo $totalDays; ?>"/>

											<!--                                            <input class="form-control" name="slab" type="hidden" value="--><?php //echo $slabAmount; ?><!--"/>-->

										</div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php





														$gpsAmount = $rentCarRow[ 'gps' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

//														$gpsAmount = number_format( (float) ( $gpsAmount * $totalDaysForCalculation ), 2, '.', '' );
														$gpsAmount = number_format( (int) ( $gpsAmount * $totalDaysForCalculation ));

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

										<div class="col-sm-7"><label class="icheck-label">

                 

                  <span class="icheck-title">Additional Driver

                    <span class="icheck-sub-title">Share the driving on any journey and enjoy the peace of mind that someone else is insured to drive if needed.</span>

                  </span> </label></div>

										<div class="col-md-5">

											<div class="row">

												<div class="col-md-8"><span class="icheck-title"><?php



														$additionalDriverAmount = $rentCarRow[ 'additionalDriver' . $bookingTerm . $_SESSION[ CURRENT_CURRENCY ] ];

														$additionalDriverAmount = number_format( (int) ( $additionalDriverAmount * $totalDaysForCalculation ) );

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

														$babySafetySeatAmount = number_format( (int) ( $babySafetySeatAmount * $totalDaysForCalculation ) );

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

														$addBabySafetySeatAmount = number_format( (int) ( $addBabySafetySeatAmount * $totalDaysForCalculation ) );

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
                                                <span class="icheck-title rental-addons-title" >Orange Card
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

														$phase1OrangeCard = number_format( (int) ( $phase1OrangeCard ) );

														echo $_SESSION[ CURRENT_CURRENCY ] . " " . $phase1OrangeCard;

														?>

													</span>

												</div>

												<div class="col-md-4 addOns-float-left">

													<input class="icheck" id="phase1OrangeCard" name="phase1OrangeCard" value="<?php echo $phase1OrangeCard; ?>" type="checkbox"/>

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

                                                </span> </label>

										</div>



										<div class="col-md-5">

											<div class="row addOns-float-right">

												<div class="col-md-8 addOns-float-left">

													<span class="icheck-title">

														<?php

														$phase1GPS = number_format( (int) ( $phase1GPS ) );

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

											<label class="icheck-label book-rental-icon" >
                                                <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round fa fa-truck"></i>
                                                <span class="icheck-title rental-addons-title">Delivery Charges
                                                <a class="tooltip-bubble" data-toggle="tooltip" data-placement="top" title="Delivery charges apply if car is rented for less than 3 days and if car delivered outside Dubai, then additional charges apply.">
                                                <i class='glyphicon glyphicon-info-sign'></i>
                                                </a>
                                                </span> </label>

										</div>



										<div class="col-md-5">

											<div class="row addOns-float-right">

												<div class="col-md-8 addOns-float-left">

													<span class="icheck-title">

														<?php

														$phase1DeliveryCharges = number_format( (int) ( $phase1DeliveryCharges ) );

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

													<input class="icheck" id="phase1CollectionCharges" name="phase1CollectionCharges" value="<?php echo $phase1CollectionCharges; ?>" type="checkbox"/>

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

									<p class="theme-payment-page-booking-subtitle black-text">By clicking book now button you agree with terms and  conditions and money back gurantee. Thank you for trusting our service. </p>

									<p class="theme-payment-page-booking-price"><?php echo $_SESSION[ CURRENT_CURRENCY ]; ?>

<!--										<input type="text" readonly class="form-control totalAmountToPayInput" value="--><?php //echo number_format( $totalAmount, 2 ); ?><!--"/>-->
                                        <input type="text" readonly class="form-control totalAmountToPayInput" value="<?php echo number_format( (int) $totalAmount ); ?>"/>
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

						<form id="rentcars" name="rentcars" method="post" action="/pay-as-you-drive">

							<div class="theme-search-area-form">



								<div>

									<label class="theme-search-area-section-label">Car Category</label>

									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">



										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">

											<i class="fa fa-angle-down"></i>





											<select class="form-control" id="driveBodyType" name="driveBodyType" required>



												<option selected value="" disabled>Car Category</option>

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

								</div>





								<div>

									<label class="theme-search-area-section-label">Pick Up Location</label>



									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">





										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">

											<i class="fa fa-angle-down"></i>





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

								</div>





								<div>

									<label class="theme-search-area-section-label">Drop off location</label>



									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">





										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">

											<i class="fa fa-angle-down"></i>





											<select class="form-control" id="driveDropLocation" name="driveDropLocation" required>

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





								<div>
									<label class="theme-search-area-section-label">Pick Up Date</label>
									<div class="theme-search-area-section theme-search-area-section-curved">
										<div class="theme-search-area-section-inner">
											<i class="theme-search-area-section-icon lin lin-calendar"></i>
											<input class="theme-search-area-section-input datePickerStart  _mob-h" id="drivePickupDate" required name="drivePickupDate" type="text" placeholder="Pick Up Date"/>
                                            <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
										</div>
									</div>
								</div>



								<div>

									<label class="theme-search-area-section-label">Drop Off Date</label>



									<div class="theme-search-area-section theme-search-area-section-curved">





										<div class="theme-search-area-section-inner">





											<i class="theme-search-area-section-icon lin lin-calendar"></i>





											<input class="theme-search-area-section-input datePickerEnd _mob-h" id="driveDropDate" name="driveDropDate" required type="text" placeholder="Drop Off Date"/> <input class="theme-search-area-section-input  _desk-h mobile-picker" type="date"/>

										</div>

									</div>

								</div>





							</div>

							<button class="theme-search-area-submit _mt-0 _fw-n _ls-0 _tt-uc theme-search-area-submit-primary theme-search-area-submit-no-border

                  theme-search-area-submit-curved" id="btnDriveSearch" name="btnDriveSearch" type="submit">Modify

							</button>

						</form>

					</div>



				</div>





			</div>





		</div>

	</div>

</div>

</div>





<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>

<!--tooltip-->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!--tooltip-->

<script>

    var $ = jQuery;







    $(document).ready(function () {

        $('#rentcars #driveBodyType').val('<?php echo $_POST["driveBodyType2"] ?>');

        $('#rentcars #drivePickupLocation').val('<?php echo $_POST["drivePickupLocation2"] ?>');

        $('#rentcars #driveDropLocation').val('<?php echo $_POST["driveDropLocation2"] ?>');

        $('#rentcars #drivePickupDate').val('<?php echo $_POST["drivePickupDate2"] ?>');

        $('#rentcars #driveDropDate').val('<?php echo $_POST["driveDropDate2"] ?>');

    });













    var totalDaysOfRent = 0;

    totalDaysOfRent = <?php echo $totalDays; ?>;



    var totalAmount = 0;

    totalAmount = <?php echo $totalAmount; ?>;



    var totalAddonsPrice = 0;

    totalAddonsPrice = <?php echo $totalAddonAmount; ?>;



    var addonKMPrice = 0;





    $('.icheck').on('ifChanged', function (event) {

        // alert('checked = ' + event.target.checked);

        // alert('value = ' + event.target.value);



        if (event.target.checked == true) {

            totalAddonsPrice += parseFloat(event.target.value);

        } else {

            totalAddonsPrice -= parseFloat(event.target.value);

        }



        // $(".totalAmountToPayInput").val((Math.round((parseFloat(totalAmount) + parseFloat(totalAddonsPrice)+ parseFloat(addonKMPrice)) * 100) / 100).toFixed(2));
        $(".totalAmountToPayInput").val((Math.round((parseFloat(totalAmount) + parseFloat(totalAddonsPrice)+ parseFloat(addonKMPrice)) * 100) / 100));



        // console.log(totalAmount);

    });





    $("input[name=slab]").change(function (e) {

        addonKMPrice = $(this).val();

        // $(".totalAmountToPayInput").val((Math.round((parseFloat(totalAmount) + parseFloat(totalAddonsPrice) + parseFloat(addonKMPrice)) * 100) / 100).toFixed(2));
        $(".totalAmountToPayInput").val((Math.round((parseFloat(totalAmount) + parseFloat(totalAddonsPrice) + parseFloat(addonKMPrice)) * 100) / 100));



    });





    $('#proceed').click(function () {

        $("#btnbooknow").click();

    })



</script>





</body>

</html>