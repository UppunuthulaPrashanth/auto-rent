<?php include "inc_opendb.php";
$PAGEID = "Checkout";

//echo "<pre>";
//echo print_r( $_POST );
//echo "</pre>";
//exit();


//echo print_r($_SESSION);
//exit();
$leasehd               = 0;
$leaseTerm4            = 0;
$totalofflinerentalcar = 0;


$vat = $_SESSION['vat'];

if ( isset( $_POST["leaseslug2"] ) )
{
	$leaseslug = filter_var( $_POST['leaseslug2'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["totalcalculatelease"] ) )
{
	$totalcalculatelease = filter_var( $_POST['totalcalculatelease'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["totalcalculate1"] ) )
{
	$totalcalculatelease = filter_var( $_POST['totalcalculate1'], FILTER_SANITIZE_STRING );
	$totalcalculatelease = str_replace( ",", "", $totalcalculatelease );
}

if ( isset( $leaseslug ) && ! empty( $leaseslug ) )
{
	$result     = $db->query( "SELECT * FROM pay_as_you_drive WHERE slug = ?s", $leaseslug );
	$rentCarRow = mysqli_fetch_assoc( $result );
	//  echo $db->lastQuery();
	// die;

	$onlinePrice = $rentCarRow[ 'onlinePrice' . $_SESSION[ CURRENT_CURRENCY ] ];
}
if ( isset( $_POST["pickupLocation2"] ) )
{
	$pickupLocation = filter_var( $_POST['pickupLocation2'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["dropLocation2"] ) )
{
	$dropLocation = filter_var( $_POST['dropLocation2'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["pickupDate2"] ) )
{
	$pickupDate = filter_var( $_POST['pickupDate2'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["dropDate2"] ) )
{
	$dropDate = filter_var( $_POST['dropDate2'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["rentBodyType33"] ) )
{
	$rentBodyType = filter_var( $_POST['rentBodyType33'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["totalDays2"] ) )
{
	$totalDays = filter_var( $_POST['totalDays2'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["scdw"] ) )
{
	$scdw = filter_var( $_POST['scdw'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["cdw"] ) )
{
	$cdw = filter_var( $_POST['cdw'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["pai"] ) )
{
	$pai = filter_var( $_POST['pai'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["gps"] ) )
{
	$gps = filter_var( $_POST['gps'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["additionalDriver"] ) )
{
	$additionalDriver = filter_var( $_POST['additionalDriver'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["babySafetySeat"] ) )
{
	$babySafetySeat = filter_var( $_POST['babySafetySeat'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["addBabySafetySeat"] ) )
{
	$addBabySafetySeat = filter_var( $_POST['addBabySafetySeat'], FILTER_SANITIZE_STRING );
}



if ( isset( $_POST["selectedTerm33"] ) )
{
    $selectedTerm = filter_var( $_POST['selectedTerm33'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["selectedVehicleSlug33"] ) )
{
    $selectedVehicleSlug = filter_var( $_POST['selectedVehicleSlug'], FILTER_SANITIZE_STRING );
}
if ( isset( $_POST["selectedSlab33"] ) )
{
    $selectedSlab = filter_var( $_POST['selectedSlab33'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["slabKM"] ) )
{
    $slabKM = filter_var( $_POST['slabKM'], FILTER_SANITIZE_STRING );
}


$slab = '';
if ( isset( $_POST['slab'] ) )
{
	$slab = filter_var( $_POST['slab'], FILTER_SANITIZE_STRING );
}


$fullRentalPrice = filter_var( $_POST['fullRentalPrice'], FILTER_SANITIZE_NUMBER_INT );

$vttre  = $totalcalculatelease / 100;
$vatcal = $vttre * $vat;
$vttre  = $totalcalculatelease + $vatcal;
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<?php $page_id = "page_base_a"; ?>
	<?php $page_title = "Checkout"; ?>
	<?php $page_keywords = "Website Keywords"; ?>
	<?php $page_description = "Website Description"; ?>
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
			<div class="row _pv-30">
				<div class="col-md-6 ">
					<div class="_mob-h">
						<div class="theme-hero-text theme-hero-text-white">
							<div class="breadcrumb-margins">
								<h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Checkout</h2>
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
                                <a><?php echo $rentCarRow['carTitle']; ?></a>
                            </p>

                        </li>

                        <li>
                            <p class="theme-breadcrumbs-item-title">
                                <a>Checkout</a>
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

							<!--							<div class="row" data-gutter="20">-->
							<!--								<div class="col-md-6 brdr-right">-->
							<!--									<div class="row">-->
							<!--										<div class="col-md-6">-->
							<!--											<div class="">-->
							<!--												<div class="btn-group theme-search-area-options-list" data-toggle="buttons">-->
							<!--													<input type="radio" name="hotel-options" id="hotel-option-1" checked/><h5 class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> Pay Online</h5>-->
							<!--												</div>-->
							<!--											</div>-->
							<!--										</div>-->
							<!--										<div class="col-md-6 "><p class="theme-search-results-item-price-tag txt-right">-->
							<!--												--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . " " . $vttre; ?>
							<!--											</p></div>-->
							<!--									</div>-->
							<!--									-->
							<!---->
							<!--									<ul class="theme-payment-page-card-list cards">-->
							<!--										<li>-->
							<!--											<img src="img/credit-icons/mastercard-straight-64px.png" alt="Image Alternative text" title="Image Title"/>-->
							<!--										</li>-->
							<!--										<li>-->
							<!--											<img src="img/credit-icons/visa-straight-64px.png" alt="Image Alternative text" title="Image Title"/>-->
							<!--										</li>-->
							<!---->
							<!---->
							<!--										<li>-->
							<!--											<img src="img/credit-icons/american-express-straight-64px.png" alt="Image Alternative text" title="Image Title"/>-->
							<!--										</li>-->
							<!--									</ul>-->
							<!---->
							<!--									<p class="checkout-txt">Online payment discount (2%) on rental amount</p>-->
							<!--									<p class="checkout-sub">** A valid credit card is mandatory to rent the vehicle. However, Debit card and cash payments are accepted.</p>-->
							<!--								</div>-->
							<!---->
							<!--								<div class="col-md-6">-->
							<!--									<div class="row">-->
							<!--										<div class="col-md-6">-->
							<!--											<div class="">-->
							<!--												<div class="btn-group theme-search-area-options-list" data-toggle="buttons">-->
							<!--													<input type="radio" name="hotel-options" id="hotel-option-1">-->
							<!--													<h5 class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> Pay Later</h5>-->
							<!--												</div>-->
							<!--											</div>-->
							<!--										</div>-->
							<!----><?php
							//										//										if ( $leaseTerm4 != 0 )
							//										//										{
							//										//											$totalrentalcar        = $payonline;
							//										//											$totalofflinerentalcar = $payoffline;
							//										//										} else
							//										//										{
							//										//											$totalrentalcar        = $payonline * $totalDays;
							//										//											$totalofflinerentalcar = $payoffline * $totalDays;
							//										//										}
							//										//										?>
							<!--												<div class="col-md-6"><p class="theme-search-results-item-price-tag txt-right">--><?php ////echo $_SESSION[ CURRENT_CURRENCY ] . " " . $totalofflinerentalcar; ?><!--</p></div>-->
							<!--									</div>-->
							<!---->
							<!---->
							<!--								</div>-->
							<!---->
							<!--							</div>-->


							<!--							<hr>-->

							<table class="table">
								<tr class="checkout-table">
									<th>Item</th>
									<th></th>

									<th class="table-content-right">Price</th>
								</tr>

								<tr>
									<td>Rental Charges</td>

									<td>
										<!--										--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $fullRentalPrice, 2 ); ?><!-- -->
									</td>
<!--									<td class="table-content-right">--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $fullRentalPrice, 2 ); ?><!--</td>-->
									<td class="table-content-right"><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' .  (int) $fullRentalPrice ; ?></td>
								</tr>

                                <?php
                                if ( $slab > 0)
                                {
                                ?>
                                <tr>
                                    <td>Addon Kilometer Charges</td>

                                    <td>
                                        <!--										--><?php //echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( (float) $fullRentalPrice, 2 ); ?><!-- -->
                                    </td>
                                    <td class="table-content-right"><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . (int) $slab ; ?></td>
                                </tr>
                                <?php
                                }
                                ?>

                                <?php
                                if ( isset( $_POST["phase1OrangeCard"] ) )
                                {
                                    $phase1OrangeCard = filter_var( $_POST['phase1OrangeCard'], FILTER_SANITIZE_STRING );
                                    ?>
                                    <tr>
                                        <td>Orange Card</td>
                                        <td></td>
                                        <td class="table-content-right"><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $phase1OrangeCard ); ?></td>
                                    </tr>
                                <?php } ?>



                                <?php
                                if ( isset( $_POST["phase1GPS"] ) )
                                {
                                    $phase1GPS = filter_var( $_POST['phase1GPS'], FILTER_SANITIZE_STRING );
                                    ?>
                                    <tr>
                                        <td>GPS</td>
                                        <td></td>
                                        <td class="table-content-right"><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $phase1GPS); ?></td>
                                    </tr>
                                <?php } ?>



                                <?php
                                if ( isset( $_POST["phase1DeliveryCharges"] ) )
                                {
                                    $phase1DeliveryCharges = filter_var( $_POST['phase1DeliveryCharges'], FILTER_SANITIZE_STRING );
                                    ?>
                                    <tr>
                                        <td>Delivery</td>
                                        <td></td>
                                        <td class="table-content-right"><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $phase1DeliveryCharges); ?></td>
                                    </tr>
                                <?php } ?>


                                <?php
                                if ( isset( $_POST["phase1CollectionCharges"] ) )
                                {
                                    $phase1CollectionCharges = filter_var( $_POST['phase1CollectionCharges'], FILTER_SANITIZE_STRING );
                                    ?>
                                    <tr>
                                        <td>Collection</td>
                                        <td></td>
                                        <td class="table-content-right"><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $phase1CollectionCharges ); ?></td>
                                    </tr>
                                <?php } ?>










								<?php
								if ( isset( $_POST["scdw"] ) )
								{
									$scdw = filter_var( $_POST['scdw'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>SCDW</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $scdw ); ?></td>
									</tr>
								<?php } ?>
								<?php
								if ( isset( $_POST["cdw"] ) )
								{
									$cdw = filter_var( $_POST['cdw'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>CDW</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $cdw ); ?></td>
									</tr>
								<?php } ?>
								<?php
								if ( isset( $_POST["pai"] ) )
								{
									$pai = filter_var( $_POST['pai'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>PAI</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $pai ); ?></td>
									</tr>
								<?php } ?>
								<?php
								if ( isset( $_POST["gps"] ) )
								{
									$pai = filter_var( $_POST['gps'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>GPS</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $gps ); ?></td>
									</tr>
								<?php } ?>
								<?php
								if ( isset( $_POST["additionalDriver"] ) )
								{
									$additionalDriver = filter_var( $_POST['additionalDriver'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>Additional Driver</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $additionalDriver ); ?></td>
									</tr>
								<?php } ?>
								<?php
								if ( isset( $_POST["babySafetySeat"] ) )
								{
									$babySafetySeat = filter_var( $_POST['babySafetySeat'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>Baby Safety Seat</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $babySafetySeat ); ?></td>
									</tr>
								<?php } ?>
								<?php
								if ( isset( $_POST["addBabySafetySeat"] ) )
								{
									$addBabySafetySeat = filter_var( $_POST['addBabySafetySeat'], FILTER_SANITIZE_STRING );
									?>
									<tr>
										<td>Additional Baby Safety Seat</td>
										<td></td>
										<td><?php echo $_SESSION[ CURRENT_CURRENCY ] . ' ' . number_format( $addBabySafetySeat ); ?></td>
									</tr>
								<?php } ?>


								<tr class="checkout-table-2">
									<td><strong>Total (Without Vat)</strong></td>
									<td></td>

									<td class="table-content-right"><strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $totalcalculatelease); ?></strong></td>

								</tr>

								<tr class="checkout-table-2">
									<td><strong>VAT @5%</strong></td>
<!--									<td>5%</td>-->
									<td></td>
									<td class="table-content-right"><strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $vatcal ); ?></strong></td>

								</tr>


								<tr class="checkout-table-2">
									<td><strong>Grand Total (With Vat)</strong></td>
									<td></td>
									<?php

									?>
									<td class="table-content-right"><strong><?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . number_format( $vttre );; ?></strong></td>

								</tr>

							</table>


						</div>


					</div>
					<!--
							   <div class="disclaimer">
						   <i class="fa fa-exclamation-circle fa-lg"></i> <p class="disclaimer-txt">The hirer is liable to pay the applicable INSURANCE EXCESS of 900.00 AED in case of an accident where the hirer is at mistake or the Third party is unknown.</p>



								 </div>
					-->


					<hr>

                    <?php
                    if ( isset( $_SESSION[ LOGGED_IN ] ) && $_SESSION[ LOGGED_IN ] == true )
                    {
                    ?>
                    <form action="#" method="post" name="booking_confirmation_form" id="booking_confirmation_form">
                        <input type="hidden" value="">

                        <input type="hidden" name="carTitle" value="<?php echo filter_var($_POST['carTitle'], FILTER_SANITIZE_STRING); ?>" />
                        <input name="bookingTerm" type="hidden" value="<?php echo filter_var($_POST['bookingTerm'], FILTER_SANITIZE_STRING); ?>"/>
                        <input type="hidden" name="fullRentalPrice" value="<?php echo filter_var($_POST['fullRentalPrice'], FILTER_SANITIZE_NUMBER_INT); ?>" />
<!--                        <input type="hidden" name="slab" value="--><?php //echo filter_var($_POST['slab'], FILTER_SANITIZE_STRING); ?><!--" />-->
                        <input type="hidden" name="totalcalculate1" value="<?php echo filter_var($_POST['totalcalculate1'], FILTER_SANITIZE_NUMBER_INT); ?>" />
                        <input type="hidden" name="pickupLocation2" value="<?php echo filter_var($_POST['pickupLocation2'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="dropLocation2" value="<?php echo filter_var($_POST['dropLocation2'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="pickupDate2" value="<?php echo filter_var($_POST['pickupDate2'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="dropDate2" value="<?php echo filter_var($_POST['dropDate2'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="slug2" value="<?php echo filter_var($_POST['slug2'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="totalDays2" value="<?php echo filter_var($_POST['totalDays2'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="phase1OrangeCard" value="<?php echo filter_var($_POST['phase1OrangeCard'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="phase1GPS" value="<?php echo filter_var($_POST['phase1GPS'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="phase1DeliveryCharges" value="<?php echo filter_var($_POST['phase1DeliveryCharges'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="phase1CollectionCharges" value="<?php echo filter_var($_POST['phase1CollectionCharges'], FILTER_SANITIZE_STRING); ?>" />
                        <input type="hidden" name="grandTotal" value="<?php echo $vttre; ?>" />
                        <input type="hidden" name="vatAmount" value="<?php echo $vatcal; ?>" />

                        <input type="hidden" name="selectedTerm" value="<?php echo $selectedTerm; ?>" />
                        <input type="hidden" name="selectedSlab" value="<?php echo $selectedSlab; ?>" />
                        <input type="hidden" name="selectedSlug" value="<?php echo $selectedVehicleSlug; ?>" />
                        <input type="hidden" name="slabKM" value="<?php echo $slabKM; ?>" />


                        <!--Payment stuffs Starts-->

                        <div>
                            <input type="radio" name="paymentMethod" id="onlinePaymentMethodRadio" checked value="online"> <label for="onlinePaymentMethodRadio">Pay Online</label>
<!--                            <input type="radio" name="paymentMethod" id="offlinePaymentMethodRadio" value="offline"> <label for="offlinePaymentMethodRadio">Pay At Counter</label>-->
                        </div>
                        <br>
                        <!--Payment stuffs Ends-->




<!--                        <button id="confirm" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" type="submit" style="display: none;">Confirm Booking</button>-->
                        <button id="confirmAndPayment" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" type="submit">Confirm & Pay</button>
						<img id="confirmButtonLoading" src="/img/loading.gif" alt="" style="display: none">

                    </form>

                        <form method="post" name="paymentDataForm"  id="paymentDataForm" action="ccavRequestHandler.php" style="display: none">

                            <input type="text" name="merchant_id" value="<?php echo PG_MERCHANTDATA ?>"/>
                            <input type="text" name="order_id" id="order_id" value=""/>
<!--                            <input type="text" name="amount" value="--><?php //echo number_format( $vttre, 2 ); ?><!--"/>-->
                            <input type="text" name="amount" value="<?php echo $vttre; ?>"/>
                            <input type="text" name="currency" value="AED"/>
                            <input type="text" name="redirect_url" value="<?php echo $FULL_HOST_NAME ?>booking-confirm/"/>
                            <input type="text" name="cancel_url" value="<?php echo $FULL_HOST_NAME ?>booking-confirm/"/>
                            <input type="text" name="language" value="EN"/>



                            <?php
                            $res = $db->query("SELECT * FROM users where userID = ?s", $_SESSION[USERID]);
                            $row=mysqli_fetch_assoc($res);
                            ?>
                            <input type="text" name="billing_name" value="<?php echo $row['firstName'] . " " . $row['lastName'] ?>"/>
                            <input type="text" name="billing_address" value="<?php echo $row['address'] ?>"/>
                            <input type="text" name="billing_city" value="<?php echo $row['city'] ?>"/>

                            <input type="text" name="billing_state" value="<?php echo $row['state'] ?>"/>
                            <input type="text" name="billing_zip" value="<?php echo $row['pincode'] ?>"/>
                            <input type="text" name="billing_country" value="United Arab Emirates"/>
                            <input type="text" name="billing_tel" value="<?php echo $row['mobileNo'] ?>"/>
                            <input type="text" name="billing_email" value="<?php echo $row['emailID'] ?>"/>
                            <!--							<INPUT TYPE="submit" value="CheckOut">-->

                        </form>





                    <?php
					} else
					{
						?>


                    <div class="theme-account-notifications">
						<div class="row">
							<div class="col-md-6">
								<div class="">
									<div class="btn-group theme-search-area-options-list" data-toggle="buttons">
										<h5 class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons customer-text"> Are You already a Autorent Customer?</h5>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<input type="radio" name="flight-option-1" id="yes" checked/>
								<label for="yes" class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> Yes</label>
							</div>
							<div class="col-md-3 ">
								<input type="radio" name="flight-option-1" id="no">
								<label for="no" class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> No</label>
							</div>
						</div>


						<hr>

						<form id="checkoutLoginForm" name="checkoutLoginForm" method="post" enctype="multipart/form-data">
						<div class="theme-payment-page-sections-item" id="autorent-customer">

							<div class="theme-payment-page-form">
								<div class="row row-col-gap" data-gutter="20">
									<div class="col-md-6 ">
										<div class="theme-payment-page-form-item form-group">
											<label>E-Mail ID*</label> <input class="form-control" id="email" name="email" type="text" placeholder="Enter Your E-Mail" required/>
										</div>
									</div>
									<div class="col-md-6 ">
										<label>Password*</label>
										<div class="theme-payment-page-form-item form-group">
											<input class="form-control" type="password" id="password" name="password" placeholder="Password" required/>
										</div>
									</div>


								</div>
							</div>
							<br/>
							<img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
							<input type="submit" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="loginBtn" value="Login"/>
						</div>
						</form>
						<br>
						<div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
						<div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>

						<form id="registerForm" name="registerForm" method="post" enctype="multipart/form-data">
							<div class="theme-payment-page-sections-item" id="autorent-new">
								<h5 class="theme-search-results-item-title theme-search-results-item-title-sm"> Register with us</h5>
								<div class="theme-payment-page-form">
									<div class="row row-col-gap" data-gutter="20">
										<div class="col-md-6 ">
											<div class="theme-payment-page-form-item form-group">

												<input class="form-control" type="text" name="firstName" id="firstName" required placeholder="First Name*"/>
											</div>
										</div>
										<div class="col-md-6 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="lastName" id="lastName" required placeholder="Last Name*"/>
											</div>
										</div>

										<div class="col-md-6 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="email" name="emailID" id="emailID" required placeholder="E-Mail*"/>
											</div>
										</div>
										<div class="col-md-6 ">

                                            <div class="theme-payment-page-form-item form-group">
                                                <input class="form-control" type="text" name="mobileNo" id="mobileNo"  required placeholder="Mobile Number*" onkeypress="return isNumberKey(event)" style="padding-right: 123px;"/>
                                                <input type="hidden" id="code" name="code"/>
                                            </div>
										</div>

										<div class="col-md-6 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="password" name="choosePassword" id="choosePassword" required placeholder="Choose Password*"/>
											</div>
										</div>
										<div class="col-md-6 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="password" name="confirmPassword" id="confirmPassword" onkeypress="return isNumber(event)" required placeholder="Confirm Password*"/>
											</div>
										</div>


										<div class="col-md-6">


											<div class="theme-payment-page-form-item form-group">
												<i class="fa fa-angle-down"></i> <select class="form-control" name="country" id="country" required>
													<option disabled selected value="">Select Country</option>
													<?php
													$countryResult = $db->query( "select * from mtr_country order by countryName ASC" );
													while ( $countryRow = mysqli_fetch_assoc( $countryResult ) )
													{
														if ( $country == $countryRow['countryID'] )
														{
															$selected = "selected";
														} else
														{
															$selected = "";
														}
														?>
														<option <?php echo $selected; ?>
																value="<?php echo $countryRow["countryID"]; ?>"><?php echo $countryRow["countryName"]; ?>
														</option>

														<?php
													}
													?>
												</select>

											</div>

										</div>
										<div class="col-md-6">


											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="city" id="city" required placeholder="City*"/>
											</div>


										</div>
<!--										<div class="col-md-4 ">-->
<!---->
<!--											<div class="theme-payment-page-form-item form-group">-->
<!--												<i class="fa fa-angle-down"></i> <select class="form-control" name="nationality" id="nationality" required>-->
<!--													<option disabled selected value="">Select Nationality</option>-->
<!--													--><?php
//													$nationalityResult = $db->query( "select * from mtr_nationality order by nationalityName ASC" );
//													while ( $nationalityRow = mysqli_fetch_assoc( $nationalityResult ) )
//													{
//														if ( $nationality == $nationalityRow['nationalityID'] )
//														{
//															$selected = "selected";
//														} else
//														{
//															$selected = "";
//														}
//														?>
<!--														<option --><?php //echo $selected; ?>
<!--																value="--><?php //echo $nationalityRow["nationalityID"]; ?><!--">--><?php //echo $nationalityRow["nationalityName"]; ?>
<!--														</option>-->
<!---->
<!--														--><?php
//													}
//													?>
<!--												</select>-->
<!--											</div>-->
<!--										</div>-->

										<div class="col-md-12 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" placeholder="Address*" name="address" id="address" required/>
											</div>
										</div>
										<div class="col-md-4 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" placeholder="State*" name="state" id="state" required/>
											</div>
										</div>
										<div class="col-md-4 ">

											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" placeholder="Postal Code" name="pincode" id="pincode"/>
											</div>
										</div>
										<div class="col-md-4 ">

											<div class="theme-payment-page-form-item form-group">
												<i class="fa fa-angle-down"></i>
                                                <select class="form-control" name="visaStatus" required id="visaStatus">
                                                    <option disabled selected value="">Visa Status*</option>
                                                    <!--                                                        <option>Visa Status*</option>-->
                                                    <option value="Resident">Resident</option>
                                                    <option value="Visit">Visit</option>

                                                </select>
											</div>
										</div>


                                        <div class="col-md-4 " id="emiratesIdDIV">
                                            <div class="theme-payment-page-form-item form-group">
                                                <input class="form-control" type="text" placeholder="Emirates ID*" name="emiratesID" id="emiratesID" required/>
                                            </div>
                                        </div>



                                    </div>

								</div>
								<hr>

								<div class="mb-15">

									<input type="checkbox" id="docs-upload" name="docs-upload" style="display: none" checked>
<!--									<input type="checkbox"  disabled checked>-->
									<input type="hidden"  disabled checked>
									<h4 class="disclaimer-txt loc-icons">Upload documents (This will help to speed up the booking process) </h4>


								</div>

								<div class="theme-payment-page-form" id="upload-docs">

									<div class="row row-col-gap" data-gutter="20">
										<div class="col-md-3 ">
											<div class="theme-payment-page-form-item form-group">
												<label>License Number</label>
												<input class="form-control" type="text" placeholder="Enter License Number" name="licenseNumber" id="licenseNumber" required/>
											</div>
										</div>
										<div class="col-md-3 ">

											<div class="theme-payment-page-form-item form-group">
												<label>License Expiry</label> <input class="form-control" type="date" name="licenseExpiry" id="licenseExpiry" required/>
											</div>
										</div>

										<div class="col-md-3 ">

											<div class="theme-payment-page-form-item form-group">
												<label>Place of Issue</label> <input class="form-control" type="text" placeholder="Place of Issue" name="licensePlaceOfIssue" id="licensePlaceOfIssue" required/>
											</div>
										</div>
										<div class="col-md-3 ">

											<div class="theme-payment-page-form-item form-group">
												<label>Upload License</label> <input class="form-control" type="file" name="licenseAttachment" id="licenseAttachment" required />
											</div>
										</div>
										<div class="col-md-3 ">
											<div class="theme-payment-page-form-item form-group">
												<label>Passport Number</label> <input class="form-control" type="text" placeholder="Enter Passport Number" name="passportNumber" id="passportNumber" required/>
											</div>
										</div>
										<div class="col-md-3 ">

											<div class="theme-payment-page-form-item form-group">

												<label>Passport Expiry</label> <input class="form-control" type="date" name="passportExpiry" id="passportExpiry" required/>
											</div>
										</div>

										<div class="col-md-3 ">

											<div class="theme-payment-page-form-item form-group">
												<label>Place of Issue</label> <input class="form-control" type="text" placeholder="Place of Issue" name="passportPlaceOfIssue" id="passportPlaceOfIssue" required/>
											</div>
										</div>
										<div class="col-md-3 ">

											<div class="theme-payment-page-form-item form-group">
												<label>Upload Passport</label> <input class="form-control" type="file" placeholder="Upload" multiple name="passportAttachment" id="passportAttachment" required/>

											</div>
										</div>


									</div>

								</div>


								<hr>


								<div class="mb-15">

									<input class="icheck" type="checkbox" checked disabled="disabled" name="validdrivinglicense" id="validdrivinglicense">
									<h5>I have a valid UAE Driving License (For UAE Residents) or International Driving License (For Tourists) </h5>


								</div>
								<div class="mb-15">

									<input class="icheck" type="checkbox" checked disabled="disabled" name="validpassport" id="validpassport">
									<h5>I have an Emirates ID or Valid Passport with the visa entry stamp </h5>


								</div>
								<div class="mb-15">

									<input class="icheck" type="checkbox" name="validcreditcard" id="validcreditcard">
									<h5>I have a valid Credit Card </h5>


								</div>
								<div class="mb-15">

									<input class="icheck" type="checkbox" disabled="disabled" checked name="validdriverage" id="validdriverage">
									<h5>Driver's age is above 21 years </h5>


								</div>

								<div class="mb-15">

									<input class="icheck" type="checkbox" name="signUpNewsletter" id="signUpNewsletter">
									<h5>Sign up to the Autorent email newsletter and we'll keep you informed of our latest offers. </h5>


								</div>

								<div class="mb-15">

									<input class="icheck" type="checkbox" checked name="acceptterms" id="acceptterms">
									<h5 class="txt-red">I accept the <a href="terms-conditions"> terms & conditions.</a> * </h5>


								</div>
								<hr>
                                <img id="register-ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
								<input type="submit" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="submit-btn" value="Register & Confirm"/>
							</div>
                        </form>
                        <br>
                        <div id="register-success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
                        <div id="register-error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
					</div>


                    <?php
                    }
                    ?>

                    <!--              <hr>-->

					<!--            <button id="confirm" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" type="submit" disabled>Confirm Booking</button>-->


				</div>
			</div>
			<!-- <br>
			 <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
			 <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>-->


			<div class="col-md-4 ">
				<div class="sticky-col">
					<div class="theme-sidebar-section _mb-10">
						<h5 class="theme-sidebar-section-title">Booking Summary</h5>

						<div class="theme-search-results-item-img-wrap">
							<img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="Image Alternative text" title="Image Title"/>
						</div>

						<h5><?php echo $rentCarRow['carTitle']; ?></h5>
						<hr>
						<?php if ( $leasehd != 1 ) { ?>
							<ul class="theme-sidebar-section-summary-list black-text">

								<li><i class="fa fa-calendar fa-lg loc-icons"></i><strong> PICKUP</strong></li>
								<?php
								$pickupLocation = str_replace( ' ', '', $pickupLocation );
								$dropLocation   = str_replace( ' ', '', $dropLocation );

								?>
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
						<?php } ?>
						<?php if ( $leasehd == 1 ) { ?>
							<ul class="theme-sidebar-section-summary-list black-text">

								<li><i class="fa fa-arrow-right fa-lg loc-icons"></i><strong> Term</strong></li>
								<li><?php echo $leaseTerm4; ?> Months</li>

							</ul>
						<?php } ?>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>

<link rel="stylesheet" href="css/intlTelInput.css"/>
<script src="js/intlTelInput-jquery.min.js"></script>

<script>

    var paymentMethod = 'online';

    $('#mobileNo').intlTelInput({
        autoHideDialCode: true,
        //autoPlaceholder: "ON",
        //dropdownContainer: document.body,
        //formatOnDisplay: true,
        //hiddenInput: "full_number",
        //initialCountry: "auto",
        //nationalMode: true,
        //placeholderNumberType: "MOBILE",
        preferredCountries: ['ae', 'in'],
        separateDialCode: true
    });



    $("form#booking_confirmation_form").submit(function(e){
        e.preventDefault();


        $("#confirm").hide();
        $("#confirmButtonLoading").show();
        $("#confirmAndPayment").hide();


        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "ajax_book_pay_as_you_drive.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                console.log(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];

                if (statusmessage.toString().trim() === "SUCCESS") {
                    // window.location.href = "/booking-confirm/" + message;

                    if(paymentMethod == 'offline'){
                        window.location.href = "/booking-confirm/" + message;
                    }
                    else
                    {
                        $("#order_id").val(message);
                        $("#paymentDataForm").submit();
                    }

                }

                if (statusmessage.toString().trim() === "ERROR") {

                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });


    $("form#registerForm").submit(function (e) {
        e.preventDefault();
        $('#register-ajaxLoader').show();
        $('#submit-btn').hide();
        // $('#reset-btn').hide();

        var code = $("#mobileNo").intlTelInput("getSelectedCountryData").dialCode;
        var mobileNumber = $('#mobileNo').val();

        var formData = new FormData(this);
        formData.append("code", code);
        formData.append("mobileNo", mobileNumber);

        $.ajax({
            type: "POST",
            url: "ajax_userregistration.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    // $("#register-error-message-div").hide();
                    // $("#register-success-message-div").show();
                    // $('#registerForm').hide();
                    // $("#success-message-div").html(message);
                    window.location.reload();
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#register-ajaxLoader").css('display', 'block');
                    $('#register-ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#register-error-message-div").show();
                    $("#register-error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });


    $("form#checkoutLoginForm").submit(function (e) {
        e.preventDefault();
        $('#ajaxLoader').show();
        $('#loginBtn').hide();

        $("#error-message-div").hide();
        $("#error-message-div").html('');

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "ajax_checkout_login.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                // console.log(data);
                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];

                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.reload();
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#loginBtn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $(document).ready(function () {
        $('input[type="radio"]').click(function () {

            if ($(this).attr('id') == 'no') {
                $('#autorent-new').show();

            } else {
                $('#autorent-new').hide();

            }

                if ($(this).attr('id') == 'yes') {
                    $('#autorent-customer').show();

                } else {
                    $('#autorent-customer').hide();

                }



            //Online or Offline payment

            // if ($(this).attr('id') == 'offlinePaymentMethodRadio') {
            //     $('#confirm').show();
            //     $('#confirmAndPayment').hide();
            //     paymentMethod = 'offline';
            // }

            if ($(this).attr('id') == 'onlinePaymentMethodRadio') {
                $('#confirm').hide();
                $('#confirmAndPayment').show();
                paymentMethod = 'online';
            }



        });
    });


    //
    // $(function () {
    //     $("#docs-upload").click(function () {
    //         if ($(this).is(":checked")) {
    //             $("#upload-docs").show();
    //
    //         } else {
    //             $("#upload-docs").hide();
    //
    //         }
    //     });
    // });



    $(function () {
        $("#docs-upload").click(function () {
            if ($(this).is(":checked")) {
                $("#upload-docs").show();
                $("#licenseNumber").prop('required', true);
                $("#licenseExpiry").prop('required', true);
                $("#licensePlaceOfIssue").prop('required', true);
                $("#licenseAttachment").prop('required', true);
                $("#passportNumber").prop('required', true);
                $("#passportExpiry").prop('required', true);
                $("#passportPlaceOfIssue").prop('required', true);
                $("#passportAttachment").prop('required', true);


            } else {
                $("#upload-docs").hide();
                $("#licenseNumber").prop('required', false);
                $("#licenseExpiry").prop('required', false);
                $("#licensePlaceOfIssue").prop('required', false);
                $("#licenseAttachment").prop('required', false);
                $("#passportNumber").prop('required', false);
                $("#passportExpiry").prop('required', false);
                $("#passportPlaceOfIssue").prop('required', false);
                $("#passportAttachment").prop('required', false);

            }
        });
    });



    $(document).ready(function () {

        $("#emiratesIdDIV").hide();

    });

    $("#visaStatus").change(function() {

        if ($(this).val() == "Resident") {

            $("#emiratesIdDIV").show();

        }

    });

    $("#visaStatus").change(function() {

        if ($(this).val() == "Visit") {

            $("#emiratesIdDIV").hide();
            $("#emiratesID").removeAttr('required');
        }

    });


</script>


<style>
    #autorent-new {
        display: none;
    }

    /*#upload-docs {*/
    /*    display: none;*/
    /*}*/

    #success-message-div {
        background-color: #5aa631;
        border: 1px solid #c8f8af;
        background: #eaffdf;
        text-align: center;
        /*max-width: 700px;*/
        color: #000000;
        padding: 20px;
        left: 30px;
        width: 100%;
    }

    #error-message-div {
        background-color: #7C0304;
        border: 1px solid #ffd8d8;
        background: #e30613;
        text-align: center;
        width: 100%;
        /*max-width: 700px;*/
        color: #ffffff;
        padding: 5px;
        left: 30px;
    }



    #register-success-message-div {
        background-color: #5aa631;
        border: 1px solid #c8f8af;
        background: #eaffdf;
        text-align: center;
        /*max-width: 700px;*/
        color: #000000;
        padding: 20px;
        left: 30px;
        width: 100%;
    }

    #register-error-message-div {
        background-color: #7C0304;
        border: 1px solid #ffd8d8;
        background: #e30613;
        text-align: center;
        width: 100%;
        /*max-width: 700px;*/
        color: #ffffff;
        padding: 5px;
        left: 30px;
    }

</style>


</body>
</html>