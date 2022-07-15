<?php if ( $PAGEID == "homepage" ) { ?>

<nav class="navbar navbar-default navbar-theme navbar-theme-abs navbar-theme-border" id="main-nav">
	<?php } else { ?>
	<nav class="navbar navbar-default navbar-theme" id="main-nav">
		<?php } ?>

		<div class="container">
			<div class="navbar-inner nav">
				<div class="navbar-header">
					<button class="navbar-toggle collapsed" data-target="#navbar-main" data-toggle="collapse" type="button" area-expanded="false">
						<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"> <img src="uploads/pages/logo-web.png" alt="Autorent" title="Autorent"/> </a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						<li>
							<a href="#">Home</a>

						</li>

						
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Rent A Car

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Budget Rentals </a>
										</li>
										<li>
											<a href="#"> Economy Rentals </a>
										</li>
										<li>
											<a href="#"> SUV Rentals </a>
										</li>
										<li>
											<a href="#"> Luxury Cars </a>
										</li>
<li>
											<a href="#"> Commercial Vehicles </a>
										</li>

										

										


									</ul>
								</div>


							</div>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Lease Cars

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Personal Lease </a>
										</li>
										<li>
											<a href="#"> Corporate Lease </a>
										</li>
										
										


										

										


									</ul>
								</div>


							</div>
						</li>
						
						<li>
							<a href="/locations">Locations</a>

						</li>
						<li>
							<a href="#">Offers</a>

						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Services

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Rental Addons </a>
										</li>
										<li>
											<a href="#"> Corporate Solutions </a>
										</li>
										<li>
											<a href="#"> Transportation </a>
										</li>
										


										

										


									</ul>
								</div>


							</div>
						</li>
						
						<li>
							<a href="#">Pre-Owned Cars</a>

						</li>

					</ul>


					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="_desk-h">Country</span> <b>UAE</b> </a>
							<div class="dropdown-menu dropdown-menu-sm">

								<div class="row" data-gutter="10">
									<div class="col-md-12">
										<ul class="dropdown-meganav-select-list-currency">

											<li class="active">
												<a href="#"> <span>UAE</span> </a>
											</li>


											


											<li>
												<a href="#"> <span>OMAN</span></a>
											</li>

											<li>
												<a href="#"> <span>KSA</span> </a>
											</li>


										</ul>
									</div>


								</div>


							</div>
						</li>
						
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="_desk-h">Currency</span> <b>AED</b> </a>
							<div class="dropdown-menu dropdown-menu-sm">

								<div class="row" data-gutter="10">
									<div class="col-md-12">
										<ul class="dropdown-meganav-select-list-currency">

											<li class="active">
												<a href="#"> <span>AED</span>U.A.E. dirham </a>
											</li>


											<li>
												<a href="#"> <span>US$</span>U.S. dollar </a>
											</li>


											<li>
												<a href="#"> <span>OMR</span>Omani Rial </a>
											</li>

											<li>
												<a href="#"> <span>SAR</span>Saudi Arabian Riyal </a>
											</li>


										</ul>
									</div>


								</div>


							</div>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="_desk-h">Language</span> <img class="navbar-flag" src="img/flags/USA.png" alt="USA" title="USA"/> </a>
							<div class="dropdown-menu dropdown-menu-sm">

								<div class="row" data-gutter="10">
									<div class="col-md-12">
										<ul class="dropdown-meganav-select-list-lang">


											<li class="active">
												<a href="#"> <img src="img/flag_codes/UK.png" alt="UK" title="UK"/>English(UK) </a>
											</li>


											<li>
												<a href="#"> <img src="img/flag_codes/ARB.png" alt="Arabic" title="Arabic"/>العربية </a>
											</li>


										</ul>
									</div>


								</div>
							</div>
						</li>

						<?php
						if ( isLoggedIn() )
						{
							?>
							<li class="navbar-nav-item-user dropdown">

								<a class="dropdown-toggle" href="account.html" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>My Account </a>
								<ul class="dropdown-menu">

									<li>
										<a href="/profile">Profile</a>
									</li>
									<li>
										<a href="/bookings">Bookings</a>
									</li>
									<li>
										<a href="/settings">Settings</a>
									</li>

								</ul>
							</li>
							<?php
						} else
						{
							?>

							<li class="navbar-nav-item-user dropdown">
                                <?php
                                $email ="";

                                if(isset($_SESSION["email"])){
                                   $email = $_SESSION['email'];
                                   $firstName = $_SESSION['firstName'];
                                   $lastName = $_SESSION['lastName'];
                               }

                               if($email!="")
                               {
                                   ?>
                                  <a href="profile" class=""  >
                                      <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>Hi,<?php echo $firstName.' '.$lastName ?>
                                  </a>
                                   </li>
                                   <li class="navbar-nav-item-user dropdown">

                                   <a class="" href="logout.php" >
                                       <i class="fa fa-sign-out navbar-nav-item-user-icon"></i>Logout
                                   </a>

                                   <?php
                               }
                               else
                               {
                                ?>
                                   <a class="" href="/login" >
                                       <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>Login
                                   </a>
                                   <?php
                               }
                                ?>


							</li>

							<?php
						}
						?>


					</ul>


				</div>
			</div>
		</div>
	</nav>