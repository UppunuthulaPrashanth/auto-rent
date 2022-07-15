<?php include "inc_opendb.php";
$PAGEID = "Booking View Pay As You Drive";

if ( isset( $_GET["booking_number"] ) )
{
	$bookingNumber = filter_var( $_GET['booking_number'], FILTER_SANITIZE_STRING );
}


//echo "<pre>";
//echo print_r( $_GET );
//echo "</pre>";

$bookingResult = $db->query( "SELECT * FROM inb_bookings_pay_as_you_drive WHERE bookingNumber = ?s", $bookingNumber );
$bookingRow    = mysqli_fetch_assoc( $bookingResult );

$payDriveCarID    = $bookingRow['payDriveCarID'];
$pickupLocation   = getPickupLocationFromID( $bookingRow['pickUpLocation'] );
$dropLocation     = getPickupLocationFromID( $bookingRow['dropLocation'] );
$pickUpDate       = $bookingRow['pickUpDate'];
$dropDate         = $bookingRow['dropDate'];
$noOfDays         = $bookingRow['noOfDays'];
$rentalAmount     = $bookingRow['rentalAmount'];
$totalAmount      = $bookingRow['totalAmount'];
$vat              = $bookingRow['vat'];
$orangeCard       = $bookingRow['orangeCard'];
$gps              = $bookingRow['gps'];
$deliveryCharge   = $bookingRow['deliveryCharge'];
$collectionCharge = $bookingRow['collectionCharge'];
$grandTotal       = $bookingRow['grandTotal'];


$payDriveCarResult = $db->query( "SELECT * FROM pay_as_you_drive WHERE payDriveCarID = ?i ", $payDriveCarID );
$payDriveCarRow    = mysqli_fetch_assoc( $payDriveCarResult );


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
								<h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Booking Confirmation</h2>
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
			</div>
		</div>
	</div>
</div>


<div class="theme-page-section theme-page-section-lg">
	<div class="container">
		<div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
			<div class="col-md-12 ">
				<div class="theme-payment-page-sections">


					<div class="row">
						<div class="col-md-6">
							<p>Pay As You Drive</p>
							<p class="booking-txt"> Booking Ref: <?php echo $bookingNumber; ?></p>
						</div>

						<div class="col-md-6">
							<a href="/bookings" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn txt-right"><< Back To Bookings</a>
						</div>
					</div>


					<hr>
					<div class="theme-search-results-item theme-search-results-item-">


						<div class="theme-search-results-item-preview">

							<div class="row" data-gutter="20">

								<div class="col-md-4 ">
									<div class="theme-search-results-item-img-wrap">
										<img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $payDriveCarRow['image']; ?>" alt="<?php echo $payDriveCarRow['carTitle'] ?>" title="<?php echo $payDriveCarRow['carTitle'] ?>"/>
									</div>

									<h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $payDriveCarRow['carTitle'] ?></h5>
									<ul class="theme-search-results-item-car-feature-list">
										<li>
											<i class="fa fa-male"></i> <span><?php echo $payDriveCarRow['noOfSeats']; ?></span>
										</li>
										<li>
											<i class="fa fa-suitcase"></i> <span><?php echo $payDriveCarRow['luggage']; ?></span>
										</li>
										<li>
											<i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $payDriveCarRow['transmissionID'] ); ?></span>
										</li>
										<li>
											<i class="fa fa-snowflake-o"></i> <span><?php if ( $payDriveCarRow['ac'] == 'Y' )
												{
													echo "A/C";
												} else
												{
													echo "Non-A/C";
												} ?>
                                            </span>
										</li>
										<li>
											<i class="fa fa-snowflake-o"></i> <span><?php echo $payDriveCarRow['noOfDoors']; ?></span>
										</li>

									</ul>
								</div>

								<div class="col-md-8 ">

									<div class="theme-search-results-item-preview">

										<div class="row" data-gutter="20">

											<div class="col-md-6 ">
												<h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Pickup</h5>

												<ul class="theme-search-results-item-car-list summary-txt">
													<li>
														<i class="fa fa-map-marker fa-lg loc-icons"></i> <?php echo $pickupLocation; ?>
													</li>
													<br>
													<li>
														<i class="fa fa-calendar fa-lg loc-icons"></i><?php echo date( 'F d, Y', strtotime( $pickUpDate ) ); ?>
													</li>
													<br>
													<li>
														<i class="fa fa-clock-o fa-lg loc-icons"></i> <?php echo date( "H:i", strtotime( $pickUpDate ) ); ?>
													</li>
													<br>

												</ul>
											</div>

											<div class="col-md-6 ">
												<h5 class="theme-search-results-item-title theme-search-results-item-title-sm">Dropoff</h5>

												<ul class="theme-search-results-item-car-list summary-txt">
													<li>
														<i class="fa fa-map-marker fa-lg loc-icons"></i> <?php echo $dropLocation; ?>
													</li>
													<br>
													<li>
														<i class="fa fa-calendar fa-lg loc-icons"></i><?php echo date( 'F d, Y', strtotime( $dropDate ) ); ?>
													</li>
													<br>
													<li>
														<i class="fa fa-clock-o fa-lg loc-icons"></i> <?php echo date( "H:i", strtotime( $dropDate ) );; ?>
													</li>
													<br>

												</ul>
											</div>

										</div>
										<h5>Rental Length: <?php echo $noOfDays; ?> day(s)</h5>
									</div>


									<table class="table">
										<tr class="checkout-table">
											<th>Item</th>
											<th></th>
											<th>Price</th>
										</tr>
										<tr>
											<td>Rental charge</td>
											<td></td>
											<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $rentalAmount, 2 ); ?></td>
										</tr>

										<?php
										if ( isset( $orangeCard ) )
										{
											?>
											<tr>
												<td>Orange Card</td>
												<td></td>
												<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $orangeCard, 2 ); ?></td>
											</tr>
											<?php
										}
										?>
										<?php
										if ( isset( $gps ) )
										{
											?>
											<tr>
												<td>GPS</td>
												<td></td>
												<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $gps, 2 ); ?></td>
											</tr>
											<?php
										}
										?>
										<?php
										if ( isset( $deliveryCharge ) )
										{
											?>
											<tr>
												<td>Delivery</td>
												<td></td>
												<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $deliveryCharge, 2 ); ?></td>
											</tr>
											<?php
										}
										?>
										<?php
										if ( isset( $collectionCharge ) )
										{
											?>
											<tr>
												<td>Collection</td>
												<td></td>
												<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $collectionCharge, 2 ); ?></td>
											</tr>
											<?php
										}
										?>

										<tr class="checkout-table-2">
											<td><strong>Total (Without Vat)</strong></td>
											<td></td>
											<td><strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $totalAmount, 2 ); ?></strong></td>

										</tr>

										<tr class="checkout-table-2">
											<td><strong>VAT</strong></td>
											<td>5%</td>
											<td><strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $vat, 2 ); ?></strong></td>

										</tr>


										<tr class="checkout-table-2">
											<td><strong>Grand Total (With Vat)</strong></td>
											<td></td>
											<?php

											?>
											<td><strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $grandTotal, 2 ); ?></strong></td>

										</tr>
									</table>


								</div>


							</div>
						</div>
					</div>


				</div>
			</div>

		</div>
	</div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>
</body>
</html>