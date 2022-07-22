<?php include "inc_opendb.php";
$PAGEID = "Book Lease a Car";

//echo "<pre>";
//echo print_r( $_POST );
//echo "</pre>";
//exit();


if ( isset( $_POST["leaseBodyType"] ) )
{
	$leaseBodyType = filter_var( $_POST['leaseBodyType'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["leaseMake"] ) )
{
	$leaseMake = filter_var( $_POST['leaseMake'], FILTER_SANITIZE_STRING );
}

if ( isset( $_POST["leaseModel"] ) )
{
	$leaseModel = filter_var( $_POST['leaseModel'], FILTER_SANITIZE_STRING );
}


if ( isset( $_POST["btnBook"] ) )
{
	$leaseslug = filter_var( $_POST['btnBook'], FILTER_SANITIZE_STRING );
}

if ( isset( $leaseslug ) && ! empty( $leaseslug ) )
{
	$result     = $db->query( "SELECT * FROM lease_cars WHERE slug = ?s", $leaseslug );
	$rentCarRow = mysqli_fetch_assoc( $result );

	$onlinePrice = $rentCarRow[ 'monthlyAED'];
	$vehicleID   = $rentCarRow['leaseCarID'];
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
								<h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Choose Your Plan</h2>
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
									<a >Lease Cars</a>
								</p>
							</li>
							<li>
								<p class="theme-breadcrumbs-item-title">
									<a>Choose your plan</a>
								</p>

							</li>


						</ul>
					</div>
					<div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
						<h4 class="theme-search-area-inline-title">Dubai Cars</h4>
						<p class="theme-search-area-inline-details">Nissan Sunny</p>
						<a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal"> <i class="fa fa-pencil"></i>Edit </a>
						<div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
							<div class="theme-search-area theme-search-area-vert">
								<div class="theme-search-area-header">
									<h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>
									<p class="theme-search-area-subtitle">Prices might be different from current results</p>
								</div>
								<div class="theme-search-area-form">
									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
										<label class="theme-search-area-section-label">Make</label>
										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
											<i class="fa fa-angle-down"></i> <select class="form-control">
												<option>Select Make</option>
												<option>Audi</option>


												<option>Bugatti</option>
												<option>Cadillac</option>
												<option>Dodge</option>

											</select>
										</div>
									</div>
									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
										<label class="theme-search-area-section-label">Model</label>
										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
											<i class="fa fa-angle-down"></i> <select class="form-control">
												<option>Select Model</option>
												<option>Audi</option>


												<option>Bugatti</option>
												<option>Cadillac</option>
												<option>Dodge</option>

											</select>
										</div>
									</div>

									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
										<label class="theme-search-area-section-label">Term</label>
										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
											<i class="fa fa-angle-down"></i> <select class="form-control">
												<option>Select Lease Term</option>
												<option>6 Months</option>


												<option>12 Months</option>
												<option>18 Months</option>
												<option>24 Months</option>

											</select>
										</div>
									</div>


									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
										<label class="theme-search-area-section-label">Location</label>
										<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
											<i class="fa fa-angle-down"></i> <select class="form-control">
												<option>Select Location</option>
												<option>Abu Dhabi</option>


												<option>Dubai</option>
												<option>Sharjah</option>
												<option>RAK</option>

											</select>
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

							<div class="row" data-gutter="20">

								<div class="col-md-3 ">
									<div class="theme-search-results-item-img-wrap">
										<img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo getMakeFromID($rentCarRow['makeID']) . " " . getModelFromID($rentCarRow['modelID']) ?>" title="<?php echo getMakeFromID($rentCarRow['makeID']) . " " . getModelFromID($rentCarRow['modelID'])  ?>"/>
									</div>
									<ul class="theme-search-results-item-car-feature-list">
										<li>
											<i class="fa fa-male"></i> <span><?php echo $rentCarRow['noOfSeats']; ?></span>
										</li>
										<li>
											<i class="fa fa-suitcase"></i> <span><?php echo $rentCarRow['luggage']; ?></span>
										</li>
										<li>
											<i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $rentCarRow['transmissionID'] ); ?></span>
										</li>
										<li>
											<i class="fa fa-snowflake-o"></i> <span><?php if ( $rentCarRow['ac'] == 'Y' ) {
													echo "A/C";
												} else {
													echo "Non-A/C";
												} ?></span>
										</li>
										<li>
											<i class="fa fa-snowflake-o"></i> <span><?php echo $rentCarRow['noOfDoors']; ?></span>
										</li>

									</ul>
								</div>

								<div class="col-md-7 ">
									<h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo getMakeFromID($rentCarRow['makeID']) . " " . getModelFromID($rentCarRow['modelID']) ; ?></h5>
									<div class="theme-search-results-item-car-location">

										<div class="theme-search-results-item-car-location-body">
											<input type="hidden" name="carTitle" id="carTitle" value="<?php echo $rentCarRow['carTitle']; ?>"/> <input type="hidden" name="carClass" id="carClass" value="<?php echo $rentCarRow['carClassID']; ?>"/><?php echo getCarClassedFromID( $rentCarRow['carClassID'] ); ?></p><p class="theme-search-results-item-car-location-subtitle"><?php echo $leaseTerm; ?> Contract</p>
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
											<p class="theme-search-results-item-price-tag">
												<?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . $rentCarRow[ 'monthlyAED']; ?></p>
											<p class="theme-search-results-item-price-sign">per Month</p>
										</div>

									</div>




								</div>
							</div>
						</div>
					</div>
					<!--
							   <div class="disclaimer">
						   <i class="fa fa-exclamation-circle fa-lg"></i> <p class="disclaimer-txt">The hirer is liable to pay the applicable INSURANCE EXCESS of 900.00 AED in case of an accident where the hirer is at mistake or the Third party is unknown.</p>



								 </div>
					-->


					<hr>


					<!--              <div class="theme-item-page-tabs _mb-30">-->
					<!--              <div class="tabbable">-->
					<!--                <ul class="nav nav-tabs nav-default nav-sqr nav-mob-inline nav-justified" role="tablist">-->
					<!--                  <li class="active" role="presentation">-->
					<!--                    <a aria-controls="HotelPageTabs-1" role="tab" data-toggle="tab" href="#HotelPageTabs-1">Pay As You Go</a>-->
					<!--                  </li>-->
					<!--                  <li role="presentation">-->
					<!--                    <a aria-controls="HotelPageTabs-2" role="tab" data-toggle="tab" href="#HotelPageTabs-2">Fixed Rate</a>-->
					<!--                  </li>-->
					<!--                -->
					<!--                </ul>-->
					<!--                <div class="tab-content _pt-30">-->
					<!--                  <div class="tab-pane active" id="HotelPageTabs-1" role="tab-panel">-->
					<!--                    <div class="theme-item-page-rooms-table">-->
					<!--                      -->
					<!--                      <table class="table table-bordered table-striped">-->
					<!--                  -->
					<!--                  <tbody>-->
					<!--                    <tr>-->
					<!--                      <td><strong>Monthly Rate</strong></td>-->
					<!--                      <td><strong>AED 1200</strong></td>-->
					<!--                   -->
					<!--                    </tr>-->
					<!--                    <tr>-->
					<!--                      <td>First 1,000 Km per Month</td>-->
					<!--                      <td>Free</td>-->
					<!--                     -->
					<!--                    </tr>-->
					<!--                      <form name="listForm"></form>-->
					<!--                    <tr>-->
					<!--                      <td><input type="radio" name="plan" > Extra 100 Km</td>-->
					<!--                      <td>AED 23.00 </td>-->
					<!--                    -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      <tr>-->
					<!--                      <td> <input type="radio" name="plan" > Extra 250 Km</td>-->
					<!--                      <td>AED 55.00 </td>-->
					<!--                     -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      <tr>-->
					<!--                      <td> <input type="radio" name="plan" > Extra 500 Km</td>-->
					<!--                      <td>AED 103.00</td>-->
					<!--                     -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      <tr>-->
					<!--                      <td> <input type="radio" name="plan" > Extra 1000 Km</td>-->
					<!--                      <td>AED 187.00 </td>-->
					<!--                     -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      <tr>-->
					<!--                      <td> <strong>Total Price</strong></td>-->
					<!--                      <td><strong>AED 1200/ M</strong></td>-->
					<!--                     -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                    -->
					<!--                  </tbody>-->
					<!--                </table>-->
					<!--                      <br>-->
					<!--             <div class="row">-->
					<!--        <div class="col-md-12">-->
					<!--<form id="formaddons" name="formaddons" method="post" action="addon-lease-cars">-->
					<!--    <input type="hidden" name="carTitle4" id="carTitle4" value="--><?php //echo $rentCarRow['carTitle']; ?><!--" />-->
					<!--    <input type="hidden" name="carClass4" id="carClass4" value="--><?php //echo $rentCarRow['carClassID']; ?><!--" />-->
					<!--    <input type="hidden" name="leaseTerm4" id="leaseTerm4" value="--><?php //echo $leaseTerm; ?><!--" />-->
					<!--    <button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn book-btn txt-right" id="addon" name="addon" type="submit"-->
					<!--    > Proceed to Addons <i class="fa fa-chevron-right loc-icons"></i></button><br>-->
					<!--    <input type="hidden" name="leaseslug" id="leaseslug" value="--><?php //echo $leaseslug; ?><!--" />-->
					<!--</form>-->
					<!---->
					<!---->
					<!--         </div>-->
					<!---->
					<!--    </div>-->
					<!--                    </div>-->
					<!--                  </div>-->
					<!--                  <div class="tab-pane" id="HotelPageTabs-2" role="tab-panel">-->
					<!--                    <div class="theme-item-page-rooms-table">-->
					<!--                      -->
					<!--                      <table class="table table-bordered table-striped">-->
					<!--                  -->
					<!--                  <tbody>-->
					<!--                    <tr>-->
					<!--                      <td><input type="radio" name="plan2" > 6 Months</td>-->
					<!--                      <td><strong>AED 6000</strong></td>-->
					<!--                   -->
					<!--                    </tr>-->
					<!--                    <tr>-->
					<!--                      <td><input type="radio" name="plan2" > 12 Months</td>-->
					<!--                      <td><strong>AED 12000</strong></td>-->
					<!--                     -->
					<!--                    </tr>-->
					<!--                    <tr>-->
					<!--                      <td><input type="radio" name="plan2" > 18 Months</td>-->
					<!--                      <td><strong>AED 18000</strong> </td>-->
					<!--                    -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      <tr>-->
					<!--                      <td>First 1,000 Km per Month</td>-->
					<!--                      <td><strong>Free</strong> </td>-->
					<!--                     -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      <tr>-->
					<!--                      <td>Extra Kilometers Per Month</td>-->
					<!--                      <td><strong>Chargable as AED 5/10Km</strong></td>-->
					<!--                     -->
					<!--                      -->
					<!--                    </tr>-->
					<!--                      -->
					<!--                  </tbody>-->
					<!--                </table>-->
					<!--                      -->
					<!--              -->
					<!--                    </div>-->
					<!--                    <br>-->
					<!--             <div class="row">-->
					<!--        <div class="col-md-12">-->
					<!--   <form id="addonsform2" name="addonsform2" method="post" action="addon-lease-cars">-->
					<!--       <button class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn book-btn txt-right" id="btnaddon" name="btnaddon" type="submit"> Proceed to Addons-->
					<!--           <i class="fa fa-chevron-right loc-icons"></i></button><br></div>-->
					<!--                 <input type="hidden" name="leaseslug2" id="leaseslug2" value="--><?php //echo $leaseslug; ?><!--" />-->
					<!--                 <input type="hidden" name="leaseTerm4" id="leaseTerm4" value="--><?php //echo $leaseTerm; ?><!--" />-->
					<!---->
					<!--                 </form>-->
					<!---->
					<!---->
					<!---->
					<!--    </div>-->
					<!--                  </div>-->
					<!--                  -->
					<!--                  -->
					<!--                  -->
					<!--                </div>-->
					<!--              </div>-->
					<!--            </div>-->


					<div class="theme-payment-page-form _mb-20">

						<div class="row row-col-gap" data-gutter="20">
							<h5 class="theme-search-results-item-title theme-search-results-item-title-sm"> Place An Enquiry</h5><br>
							<form id="leaseCarsNewEnquiryForm" name="leaseCarsNewEnquiryForm" method="post">
								<input type="hidden" name="vehicleID" id="vehicleID" value="<?php echo $vehicleID; ?>"/>
								<div class="theme-payment-page-form">
									<div class="row row-col-gap" data-gutter="20">
										<div class="col-md-12">
											<div class="theme-payment-page-form-item form-group">
												<i class="fa fa-angle-down"></i> <select class="form-control" name="EnquirySelectedType" id="EnquirySelectedType" required>
													<option selected disabled>Select*</option>
													<option value="Individual">Individual</option>
													<option value="Corporate">Corporate</option>
												</select>
											</div>
										</div>


										<div class="col-md-6" id="EnquiryIndividualFirstNameDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name*" required/>
											</div>
										</div>
										<div class="col-md-6 " id="EnquiryIndividualLastNameDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name*" required/>
											</div>
										</div>


										<div class="col-md-6 " id="EnquiryCorporateCompanyNameDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="corporateCompanyName" id="corporateCompanyName" placeholder="Company Name*" required/>
											</div>
										</div>
										<div class="col-md-6 " id="EnquiryCorporateNameDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="corporateFullName" id="corporateFullName" placeholder="Name*" required/>
											</div>
										</div>


										<div class="col-md-6 " id="EnquiryIndividualEmailDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="email" name="email" id="email" placeholder="E-Mail*" required/>
											</div>
										</div>
										<div class="col-md-6 " id="EnquiryIndividualPhoneDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="phone" id="phone" placeholder="Phone*" onkeypress="return isNumberKey(event)" required/>
											</div>
										</div>
										<div class="col-md-6" id="EnquiryIndividualCountryDiv">
											<div class="theme-payment-page-form-item form-group">
												<i class="fa fa-angle-down"></i> <select class="form-control" name="country" id="country" required>

													<option value="" selected disabled>Select Country*</option>
													<?php
													$countryRes = $db->query( "select * from mtr_country  ORDER BY countryName ASC" );
													while ( $countryRow = mysqli_fetch_assoc( $countryRes ) )
													{
														?>
														<option value="<?php echo $countryRow['countryName']; ?>"><?php echo $countryRow['countryName']; ?></option>
														<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-6" id="EnquiryIndividualCityDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" type="text" name="city" id="city" placeholder="City*" required/>
											</div>
										</div>
										<!--                                    <div class="col-md-12 " id="IndividualVehicleDiv">-->
										<!--                                        <div class="theme-payment-page-form-item form-group">-->
										<!--                                            <input class="form-control" name="vehicle" id="vehicle" type="text" placeholder="Vehicle*" required/>-->
										<!--                                        </div>-->
										<!--                                    </div>-->
										<!--                                    <div class="col-md-6 " id="CorporateVehicleDiv">-->
										<!--                                        <div class="theme-payment-page-form-item form-group">-->
										<!--                                            <input class="form-control" name="corporateVehicle" id="corporateVehicle" type="text" placeholder="Vehicle*" required/>-->
										<!--                                        </div>-->
										<!--                                    </div>-->
										<div class="col-md-12 " id="EnquiryCorporateNoOfVehicleDiv">
											<div class="theme-payment-page-form-item form-group">
												<input class="form-control" name="noOfVehicle" id="noOfVehicle" type="text" placeholder="No. of Vehicle Required*" required/>
											</div>
										</div>
										<div class="col-md-12 " id="EnquiryIndividualSpecificRequirementDiv">
											<div class="form-group theme-contact-form-group">
												<textarea class="form-control" name="specificRequirement" id="specificRequirement" rows="5" placeholder="Specific Requirement"></textarea>
											</div>
										</div>


										<!--                                              <div class="col-md-6 " id="CorporateEmailDiv">-->
										<!--                                                  <div class="theme-payment-page-form-item form-group">-->
										<!--                                                      <input class="form-control" type="email" name="corporateEmail" id="corporateEmail" placeholder="E-Mail*" required/>-->
										<!--                                                  </div>-->
										<!--                                              </div>-->
										<!--                                              <div class="col-md-6 " id="CorporatePhoneDiv">-->
										<!--                                                  <div class="theme-payment-page-form-item form-group">-->
										<!--                                                      <input class="form-control" type="text" name="corporatePhone" id="corporatePhone" placeholder="Phone*" onkeypress="return isNumberKey(event)" required/>-->
										<!--                                                  </div>-->
										<!--                                              </div>-->
										<!--                                              <div class="col-md-6" id="CorporateCountryDiv">-->
										<!--                                                  <div class="theme-payment-page-form-item form-group">-->
										<!--                                                      <i class="fa fa-angle-down"></i>-->
										<!--                                                      <select class="form-control" name="corporateCountry" id="corporateCountry" required>-->
										<!---->
										<!--                                                          <option value="" selected disabled>Select Country*</option>-->
										<!--                                                          --><?php
										//                                                          $countryRes = $db->query( "select * from mtr_country  ORDER BY countryName ASC" );
										//                                                          while ( $countryRow = mysqli_fetch_assoc( $countryRes ) )
										//                                                          {
										//                                                              ?>
										<!--                                                              <option value="--><?php //echo $countryRow['countryName'];?><!--">--><?php //echo $countryRow['countryName'];?><!--</option>-->
										<!--                                                              --><?php
										//                                                          }
										//                                                          ?>
										<!--                                                      </select>-->
										<!--                                                  </div>-->
										<!--                                              </div>-->
										<!--                                              <div class="col-md-6" id="CorporateCityDiv">-->
										<!--                                                  <div class="theme-payment-page-form-item form-group">-->
										<!--                                                      <input class="form-control" type="text" name="corporateCity" id="corporateCity" placeholder="City*" required/>-->
										<!--                                                  </div>-->
										<!--                                              </div>-->

										<div class="col-md-12 " id="EnquiryCorporateSpecificRequirementDiv">
											<div class="form-group theme-contact-form-group">
												<textarea class="form-control" name="corporateSpecificRequirement" id="corporateSpecificRequirement" rows="5" placeholder="Specific Requirement"></textarea>
											</div>
										</div>


									</div>
									<div class="col-md-12">
										<br>
										<div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div>
										<br> <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
									</div>
									<hr>
									<button type="submit" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="leaseNewEnquiryBtn" name="leaseNewEnquiryBtn">Submit</button>
								</div>
							</form>

						</div>
						<br><br>
						<div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
						<div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
					</div>


				</div>
			</div>
			<div class="col-md-4 ">
				<?php include "inc_leasecars_sidebar_searchform.php";?>
			</div>
		</div>
	</div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>
</body>
</html>