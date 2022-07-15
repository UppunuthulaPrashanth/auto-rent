<?php include "inc_opendb.php";
$PAGEID = "History";
$email  = "";
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
$current_currency = "";
$current_language = "";
$firstName        = "";
$lastName         = "";

if ( isset( $_SESSION[USER_EMAIL] ) && ! empty( $_SESSION[USER_EMAIL] ) )
{
	$email = $_SESSION[USER_EMAIL];


	$res = $db->query( "SELECT * FROM users WHERE emailID = ?s", $email );

	if ( mysqli_num_rows( $res ) > 0 )
	{

		while ( $row = mysqli_fetch_assoc( $res ) )
		{
			$_SESSION["email"]            = $row['emailID'];
			$_SESSION["current_currency"] = $row['currentCurrency'];
			$_SESSION["current_language"] = $row['currentLanguage'];

			$current_currency = $row['currentCurrency'];
			$current_language = $row['currentLanguage'];

			$firstName = $row['firstName'];
			$lastName  = $row['lastName'];
			$emailID   = $row['emailID'];
			$mobileNo  = $row['mobileNo'];
			$countryd  = $row['country'];
			$city      = $row['city'];

			$nationalityd = $row['nationality'];
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
						<p class="theme-page-header-subtitle">Manage your Bookings.</p>
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
							<li>
								<a href="/profile"> <i class="fa fa-cog"></i>Profile </a>
							</li>
							<li class="active">
								<a href="/bookings"> <i class="fa fa-bell"></i>Bookings </a>
							</li>
							<!-- <li>
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




				<div class="theme-account-history">


					<?php
					$res = $db->query("select * from inb_bookings WHERE userID = ?s", $_SESSION[USERID]);
					if(mysqli_num_rows($res) > 0)
					{
						?>
						<h3>Rent Cars</h3>
						<table class="table">
							<thead>
							<tr>
								<th>Ref. ID</th>
								<th>Car</th>
								<th>Dates</th>
								<th>Total</th>
								<th>Payment Method</th>
								<th>Status</th>
								<th></th>
							</tr>
							</thead>
							<tbody>

							<?php



							while($row=mysqli_fetch_assoc($res))
							{
								?>


								<tr>
									<td class="theme-account-history-type">
										<p class="theme-account-history-type-title"><?php echo $row['bookingNumber'] ?></p>
									</td>
									<td>
										<p class="theme-account-history-type-title"><?php

											$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE rentLeaseCarID = ?i ",$row['rentLeaseCarID'] );
											$rentCarRow    = mysqli_fetch_assoc( $rentCarResult );

											echo $rentCarRow['carTitle']


											?></p>
										<!--									<p class="theme-account-history-item-name">Rental car</p>-->
									</td>
									<td>
										<p class="theme-account-history-date"><?php echo date( 'F d, Y', strtotime( $row['pickUpDate'] ) )  . " - " . "<br>". date( 'F d, Y', strtotime( $row['dropDate']) ); ; ?>
											<!--										Sep 16, 2020 &#8212; Sep 19, 2020-->
										</p>
									</td>
									<td class="theme-account-history-tr-date history-amount">
										<p class="theme-account-history-item-price">AED <?php echo $row['grandTotal'] ?></p>
									</td>
                                    <td>

                                        <?php
                                        $paymentMethod = $row['paymentMethod'];

                                        if($paymentMethod == 'offline')
                                        {
                                            $paymentMethod = 'Pay At Counter';
                                        }
                                        else
                                        {
                                            if($paymentMethod == 'online')
                                            {
                                                $paymentResult = $db->query( "SELECT
  `pg_transactions`.`order_status`, `pg_transactions`.`bookingNumber`,
  `inb_bookings`.`bookingNumber`, `inb_bookings`.`userID`
FROM
  `pg_transactions` INNER JOIN
  `inb_bookings` ON `pg_transactions`.`bookingNumber` =
    `inb_bookings`.`bookingNumber` WHERE pg_transactions.bookingNumber = ?s", $row['bookingNumber']);
                                                $paymentRow    = mysqli_fetch_assoc( $paymentResult );

                                                $paymentMethod = $paymentRow['order_status'];
                                            }


                                        }

                                        ?>


                                        <p class="theme-account-history-item-price"><?php echo $paymentMethod;?></p>





                                    </td>
									<td>
										<a href="/rent-booking-view/<?php echo $row['bookingNumber'] ?>">View</a>
									</td>
								</tr>


								<?php
							}

							?>


							</tbody>
						</table>

						<?php
					}








					$res = $db->query("select * from inb_bookings_pay_as_you_drive WHERE userID = ?s", $_SESSION[USERID]);
					if(mysqli_num_rows($res) > 0)
					{
						?>
						<h3>Pay As You Drive</h3>
						<table class="table">
							<thead>
							<tr>
								<th>Ref. ID</th>
								<th>Car</th>
								<th>Dates</th>
								<th>Total</th>
                                <th>Payment Method</th>
								<th>Status</th>
								<th></th>
							</tr>
							</thead>
							<tbody>

							<?php
							while($row=mysqli_fetch_assoc($res))
							{
								?>


								<tr>
									<td class="theme-account-history-type">
										<p class="theme-account-history-type-title"><?php echo $row['bookingNumber'] ?></p>
									</td>
									<td>
										<p class="theme-account-history-type-title"><?php

//											echo $row['payDriveCarID'];

//											$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE rentLeaseCarID = ?i ",$row['payDriveCarID'] );
//											$rentCarRow    = mysqli_fetch_assoc( $rentCarResult );
//
											echo $rentCarRow['carTitle']


											?></p>
										<!--									<p class="theme-account-history-item-name">Rental car</p>-->
									</td>
									<td>
										<p class="theme-account-history-date"><?php echo date( 'F d, Y', strtotime( $row['pickUpDate'] ) )  . " - " .  date( 'F d, Y', strtotime( $row['dropDate']) ); ; ?>
											<!--										Sep 16, 2020 &#8212; Sep 19, 2020-->
										</p>
									</td>
									<td class="theme-account-history-tr-date history-amount">
										<p class="theme-account-history-item-price">AED <?php echo $row['grandTotal'] ?></p>
									</td>
                                    <td>

                                        <?php
                                        $paymentMethod = $row['paymentMethod'];

                                        if($paymentMethod == 'offline')
                                        {
                                            $paymentMethod = 'Pay At Counter';
                                        }
                                        else
                                        {
                                            if($paymentMethod == 'online')
                                            {
                                                $paymentResult = $db->query( "SELECT
  `pg_transactions`.`order_status`, `pg_transactions`.`bookingNumber`,
  `inb_bookings_pay_as_you_drive`.`bookingNumber`, `inb_bookings_pay_as_you_drive`.`userID`
FROM
  `pg_transactions` INNER JOIN
  `inb_bookings_pay_as_you_drive` ON `pg_transactions`.`bookingNumber` =
    `inb_bookings_pay_as_you_drive`.`bookingNumber` WHERE pg_transactions.bookingNumber = ?s", $row['bookingNumber']);
                                                $paymentRow    = mysqli_fetch_assoc( $paymentResult );

                                                $paymentMethod = $paymentRow['order_status'];
                                            }


                                        }

                                        ?>


                                        <p class="theme-account-history-item-price"><?php echo $paymentMethod;?></p>





                                    </td>
									<td>
										<a href="/payd-booking-view/<?php echo $row['bookingNumber'] ?>">View</a>
									</td>
								</tr>


								<?php
							}

							?>


							</tbody>
						</table>

						<?php
					}







					?>

















				</div>
			</div>
		</div>
	</div>
</div>


<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>

</body>
</html>




<!--						<tr>-->
<!--							<td class="theme-account-history-type">-->
<!--								<p class="theme-account-history-type-title">346570</p>-->
<!--							</td>-->
<!--							<td>-->
<!--								<p class="theme-account-history-type-title">Hyundai Creta</p>-->
<!--								<p class="theme-account-history-item-name">Rental car</p>-->
<!--							</td>-->
<!--							<td>-->
<!--								<p class="theme-account-history-date">Apr 16, 2020 &#8212; Apr 19, 2020</p>-->
<!--							</td>-->
<!--							<td class="theme-account-history-tr-date">-->
<!--								<p class="theme-account-history-item-price">AED 874.36</p>-->
<!--							</td>-->
<!--							<td>-->
<!--								<a href="booking-view">View</a>-->
<!--							</td>-->
<!--						</tr>-->