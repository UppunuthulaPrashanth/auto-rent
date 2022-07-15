<?php include "inc_opendb.php";
$PAGEID = "Profile";

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';

$email     = "";
$firstName = "";
$lastName  = "";
$emailID   = "";
$mobileNo  = "";
$countryd  = "";
$city      = "";

$nationalityd = "";
$address      = "";
$state        = "";
$pincode      = "";
$visaStatus   = "";

$licenseNumber        = "";
$licenseExpiry        = "";
$licensePlaceOfIssue  = "";
$passportNumber       = "";
$passportExpiry       = "";
$passportPlaceOfIssue = "";

$licenseAttachment  = "";
$passportAttachment = "";

if ( isset( $_SESSION['user_email'] ) && ! empty( $_SESSION['user_email'] ) )
{
	$email = $_SESSION['user_email'];


	$res = $db->query( "SELECT * FROM users WHERE emailID = ?s", $email );

	if ( mysqli_num_rows( $res ) > 0 )
	{

		while ( $row = mysqli_fetch_assoc( $res ) )
		{
			$_SESSION["user_email"]            = $row['emailID'];
			$_SESSION["current_currency"] = $row['currentCurrency'];
			$_SESSION["current_language"] = $row['currentLanguage'];


			$firstName = $row['firstName'];
			$lastName  = $row['lastName'];
			$emailID   = $row['emailID'];
			$mobileNo  = $row['mobileNo'];
			$countryd  = $row['country'];
			$city      = $row['city'];

			$nationalityd = $row['nationality'];



			$nationalityResult = $db->query( "select * from mtr_nationality WHERE nationalityID = ?s",$nationalityd );
			$nationalityRow = mysqli_fetch_assoc( $nationalityResult ) ;

            $nationalityName = $nationalityRow['nationalityName'];

			$address      = $row['address'];
			$state        = $row['state'];
			$pincode      = $row['pincode'];
			$visaStatus   = $row['visaStatus'];

			$licenseNumber        = $row['licenseNumber'];
			$licenseExpiry        = $row['licenseExpiry'];
			$licensePlaceOfIssue  = $row['licensePlaceOfIssue'];
			$passportNumber       = $row['passportNumber'];
			$passportExpiry       = $row['passportExpiry'];
			$passportPlaceOfIssue = $row['passportPlaceOfIssue'];

			$licenseAttachment  = $row['licenseAttachment'];
			$passportAttachment = $row['passportAttachment'];

		}

	}

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

<div class="theme-hero-area theme-hero-area-half">
	<div class="theme-hero-area-bg-wrap">
		<div class="theme-hero-area-bg" style="background-image:url(img/activity-adult-beach-beautiful-378152_1500x800.jpg);"></div>
		<div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
		<div class="theme-hero-area-inner-shadow"></div>
	</div>
	<div class="theme-hero-area-body">
		<div class="container">
			<div class="row">
				<div class="col-md-8 theme-page-header-abs">
					<div class="theme-page-header theme-page-header-lg">
						<h1 class="theme-page-header-title">Welcome <?php echo $firstName . ' ' . $lastName; ?>!</h1>
						<p class="theme-page-header-subtitle">View and Edit all your preferences.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="theme-page-section theme-page-section-gray theme-page-section-lg">
	<div class="container">
		<div class="row">
			<div class="col-md-2-5 ">
				<div class="theme-account-sidebar">

					<nav class="theme-account-nav">
						<ul class="theme-account-nav-list">
							<li class="active">
								<a href="#"> <i class="fa fa-cog"></i>Profile </a>
							</li>
							<li>
								<a href="/bookings"> <i class="fa fa-bell"></i>Bookings </a>
							</li>
							<!--  <li>
								<a href="/payments">
								  <i class="fa fa-credit-card"></i>Payment Methods
								</a>
							  </li>-->
							<li>
								<a href="/settings"> <i class="fa fa-user-circle-o"></i>Settings </a>
							</li>


						</ul>
					</nav>
				</div>
			</div>
			<div class="col-md-9-5 ">

				<div class="row">
					<div class="col-md-9 ">
						<div class="theme-account-preferences">
							<div class="theme-account-preferences-item">
								<div class="row">
									<div class="col-md-3 ">
										<h5 class="theme-account-preferences-item-title">Email Address</h5>
									</div>
									<div class="col-md-7 ">
										<p class="theme-account-preferences-item-value"><?php echo $email; ?></p>
									</div>
								</div>
							</div>


							<div class="theme-account-preferences-item">
								<div class="row">
									<div class="col-md-3 ">
										<h5 class="theme-account-preferences-item-title">Name</h5>
									</div>
									<div class="col-md-7 ">
										<p class="theme-account-preferences-item-value"><?php echo $firstName . ' ' . $lastName; ?></p>
										<div class="collapse" id="ChangeHomeAirportChange">
											<div class="theme-account-preferences-item-change">

												<form id="nameForm" name="nameForm" method="post">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>"/>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>"/> <input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email ?>"/>
															</div>
														</div>
													</div>


													<div class="theme-account-preferences-item-change-actions">
														<input type="submit" class="btn btn-sm btn-primary" id="submitname-btn" value="Save changes"/>

														<a class="btn btn-sm btn-default" href="#ChangeHomeAirportChange" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeHomeAirportChange">Cancel</a>
													</div>
												</form>

											</div>
										</div>
									</div>
									<div class="col-md-2 ">
										<a class="theme-account-preferences-item-change-link" href="#ChangeHomeAirportChange" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeHomeAirportChange"> <i class="fa fa-pencil"></i>edit </a>
									</div>
								</div>
							</div>


							<div class="theme-account-preferences-item">
								<div class="row">
									<div class="col-md-3 ">
										<h5 class="theme-account-preferences-item-title">Mobile Number</h5>
									</div>
									<form id="mobileForm" name="mobileForm" method="post">
										<div class="col-md-7 ">
											<p class="theme-account-preferences-item-value"><?php echo $mobileNo; ?></p>
											<div class="collapse" id="Mobilenumber">
												<div class="theme-account-preferences-item-change">
													<div class="form-group theme-account-preferences-item-change-form">
														<input class="form-control" placeholder="New Number" id="mobileNo" name="mobileNo" value="<?php echo $mobileNo; ?>">
                                                        <input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email ?>"/>
													</div>
													<div class="theme-account-preferences-item-change-actions">
                                                        <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
														<input type="submit" class="btn btn-sm btn-primary" id="submitmobile-btn" value="Save changes"/>
                                                        <a class="btn btn-sm btn-default" href="#Mobilenumber" data-toggle="collapse" aria-expanded="false" aria-controls="Mobilenumber">Cancel</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-2 ">
											<a class="theme-account-preferences-item-change-link" href="#Mobilenumber" data-toggle="collapse" aria-expanded="false" aria-controls="Mobilenumber"> <i class="fa fa-pencil"></i>edit </a>
										</div>
									</form>

								</div>
                                <br>
                                <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
                                <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
							</div>


							<div class="theme-account-preferences-item">
								<form id="NationalityForm" name="NationalityForm" method="post">
									<div class="row">
										<div class="col-md-3 ">
											<h5 class="theme-account-preferences-item-title">Location & Nationality</h5>
										</div>
										<div class="col-md-7 ">
											<p class="theme-account-preferences-item-value"><?php echo $nationalityName . ', ' . $state . ', ' . $city; ?></p>
											<div class="collapse" id="Country">

												<div class="theme-account-preferences-item-change">


													<div class="row">
														<div class="col-md-6">
															<div class="theme-payment-page-form-item form-group">
																<i class="fa fa-angle-down"></i> <select class="form-control" name="country" id="country" required>
																	<option disabled selected value="">Select Country</option>
																	<?php
																	$countryResult = $db->query( "select * from mtr_country order by countryName ASC" );
																	while ( $countryRow = mysqli_fetch_assoc( $countryResult ) )
																	{
																		if ( $countryd == $countryRow['countryID'] )
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
																<i class="fa fa-angle-down"></i> <select class="form-control" name="nationality" id="nationality" required>
																	<option disabled selected value="">Select Nationality</option>
																	<?php
																	$nationalityResult = $db->query( "select * from mtr_nationality order by nationalityName ASC" );
																	while ( $nationalityRow = mysqli_fetch_assoc( $nationalityResult ) )
																	{
																		if ( $nationalityd == $nationalityRow['nationalityID'] )
																		{
																			$selected = "selected";
																		} else
																		{
																			$selected = "";
																		}
																		?>
																		<option <?php echo $selected; ?>
																				value="<?php echo $nationalityRow["nationalityID"]; ?>"><?php echo $nationalityRow["nationalityName"]; ?>
																		</option>

																		<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>


													<div class="row">
														<div class="col-md-6">
															<div class="form-group theme-account-preferences-item-change-form">
																<label>State*</label> <input class="form-control" type="text" id="state" name="state" value="<?php echo $state; ?>" '>

															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group theme-account-preferences-item-change-form">

																<label>City*</label> <input class="form-control" type="text" id="city" name="city" value="<?php echo $city; ?>"/> <input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email ?>"/>
															</div>
														</div>
													</div>

													<div class="theme-account-preferences-item-change-actions">
														<input type="submit" class="btn btn-sm btn-primary" id="submitlicense-btn" value="Save changes"/> <a class="btn btn-sm btn-default" href="#Country" data-toggle="collapse" aria-expanded="false" aria-controls="Country">Cancel</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-2 ">
											<a class="theme-account-preferences-item-change-link" href="#Country" data-toggle="collapse" aria-expanded="false" aria-controls="Country"> <i class="fa fa-pencil"></i>edit </a>
										</div>
									</div>
								</form>
							</div>


							<div class="theme-account-preferences-item">
								<div class="row">
									<div class="col-md-3 ">
										<h5 class="theme-account-preferences-item-title">Address</h5>
									</div>
									<form id="addressForm" name="addressForm" method="post">
										<div class="col-md-7 ">
											<p class="theme-account-preferences-item-value"><?php echo $address; ?></p>
											<div class="collapse" id="homeaddress">
												<div class="theme-account-preferences-item-change">

													<div class="form-group theme-account-preferences-item-change-form">
														<input class="form-control" type="text" id="address" name="address" value="<?php echo $address; ?>"/> <input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email ?>"/>
													</div>
													<div class="theme-account-preferences-item-change-actions">
														<input type="submit" class="btn btn-sm btn-primary" id="submitaddress-btn" value="Save changes"/> <a class="btn btn-sm btn-default" href="homeaddress" data-toggle="collapse" aria-expanded="false" aria-controls="homeaddress">Cancel</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-2 ">
											<a class="theme-account-preferences-item-change-link" href="#homeaddress" data-toggle="collapse" aria-expanded="false" aria-controls="homeaddress"> <i class="fa fa-pencil"></i>edit </a>
										</div>
									</form>
								</div>
							</div>


							<div class="theme-account-preferences-item">
								<div class="row">
									<div class="col-md-3 ">
										<h5 class="theme-account-preferences-item-title">License Details</h5>
									</div>
									<div class="col-md-7 ">
										<p class="theme-account-preferences-item-value"><?php echo $licenseNumber . ', ' . $licensePlaceOfIssue; ?></p>
										<div class="collapse" id="license">
											<div class="theme-account-preferences-item-change">


												<form id="licenseForm" name="licenseForm" method="post" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-6"><p class="theme-account-preferences-item-change-description">License Number </p>
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="text" id="licenseNumber" name="licenseNumber" value="<?php echo $licenseNumber; ?>"/>
															</div>
														</div>
														<div class="col-md-6"><p class="theme-account-preferences-item-change-description">License Place Of Issue </p>
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="text" id="licensePlaceOfIssue" name="licensePlaceOfIssue" value="<?php echo $licensePlaceOfIssue; ?>"/>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6"><p class="theme-account-preferences-item-change-description">Expiry</p>
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="date" id="licenseExpiry" name="licenseExpiry" value="<?php echo $licenseExpiry; ?>">
															</div>
														</div>
														<div class="col-md-6"><p class="theme-account-preferences-item-change-description">Upload</p>
															<div class="form-group theme-account-preferences-item-change-form">

																<input class="form-control" type="file" id="licenseAttachment" name="licenseAttachment" value="<?php echo $licenseAttachment; ?>">
																<?php if ( $licenseAttachment != "" )
																{
																	?>
																	<a href="uploads/documents/<?php echo $licenseAttachment; ?>" target="_blank">uploaded documents</a>
																<?php } ?>
																<input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email ?>"/>
															</div>
														</div>
													</div>


													<div class="theme-account-preferences-item-change-actions">
														<input type="submit" class="btn btn-sm btn-primary" id="submitlicense-btn" value="Save changes"/> <a class="btn btn-sm btn-default" href="homeaddress" data-toggle="collapse" aria-expanded="false" aria-controls="homeaddress">Cancel</a>
													</div>
												</form>
											</div>
										</div>

									</div>
									<div class="col-md-2 ">
										<a class="theme-account-preferences-item-change-link" href="#license" data-toggle="collapse" aria-expanded="false" aria-controls="homeaddress"> <i class="fa fa-pencil"></i>edit </a>
									</div>
								</div>
							</div>


							<div class="theme-account-preferences-item">
								<div class="row">
									<div class="col-md-3 ">
										<h5 class="theme-account-preferences-item-title">Passport Details</h5>
									</div>
									<div class="col-md-7 ">
										<p class="theme-account-preferences-item-value"><?php echo $passportNumber . ', ' . $passportPlaceOfIssue; ?></p>
										<div class="collapse" id="passport">
											<div class="theme-account-preferences-item-change">
												<form id="PassportForm" name="PassportForm" method="post" enctype="multipart/form-data">


													<div class="row">
														<div class="col-md-6">
															<div class="form-group theme-account-preferences-item-change-form">
																<p class="theme-account-preferences-item-change-description">Passport Number </p>
																<input class="form-control" type="text" id="passportnumber" name="passportnumber" value="<?php echo $passportNumber; ?>"/>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group theme-account-preferences-item-change-form">
																<p class="theme-account-preferences-item-change-description">Passport Place Of Issue </p>
																<input class="form-control" type="text" id="passportPlaceOfIssue" name="passportPlaceOfIssue" value="<?php echo $passportPlaceOfIssue; ?>"/>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6"><p class="theme-account-preferences-item-change-description">Expiry</p>
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="date" id="passportExpiry" name="passportExpiry" value="<?php echo $passportExpiry; ?>">
															</div>
														</div>
														<div class="col-md-6"><p class="theme-account-preferences-item-change-description">Upload</p>
															<div class="form-group theme-account-preferences-item-change-form">
																<input class="form-control" type="file" id="passportAttachment" name="passportAttachment" value="<?php echo $passportAttachment; ?>">
																<?php if ( $passportAttachment != "" )
																{
																	?>
																	<a href="uploads/documents/<?php echo $passportAttachment; ?>" target="_blank">uploaded documents</a>
																<?php } ?>


																<input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email ?>"/>
															</div>
														</div>
													</div>


													<div class="theme-account-preferences-item-change-actions">
														<input type="submit" class="btn btn-sm btn-primary" id="submitpassport-btn" value="Save changes"/> <a class="btn btn-sm btn-default" href="homeaddress" data-toggle="collapse" aria-expanded="false" aria-controls="homeaddress">Cancel</a>
													</div>

												</form>
											</div>

										</div>
									</div>
									<div class="col-md-2 ">
										<a class="theme-account-preferences-item-change-link" href="#passport" data-toggle="collapse" aria-expanded="false" aria-controls="homeaddress"> <i class="fa fa-pencil"></i>edit </a>
									</div>
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