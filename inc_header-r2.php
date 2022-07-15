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
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Private

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Rental </a>
										</li>
										<li>
											<a href="#"> Lease </a>
										</li>
										<li>
											<a href="#"> Pay Per Hour </a>
										</li>
										<li>
											<a href="#"> Pay As You Go </a>
										</li>
<li>
											<a href="#"> Offers </a>
										</li>

										

										


									</ul>
								</div>


							</div>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Business

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Leasing </a>
										</li>
										<li>
											<a href="#"> Customized Solutions </a>
										</li>
										
										


										

										


									</ul>
								</div>


							</div>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Commercial

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Leasing </a>
										</li>
										<li>
											<a href="#"> Special Purpose Vehicles </a>
										</li>
										
										


										

										


									</ul>
								</div>


							</div>
						</li>
						<li>
							<a href="#">Buy Used Cars</a>

						</li>
						
						<li>
							<a href="/locations">About</a>

						</li>
						
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Contact

							</a>
							<div class="dropdown-menu dropdown-menu-sm">


								<div class="col-md-12 single-menu">
									<ul class="dropdown-meganav-list-items">

										<li>
											<a href="#"> Locations </a>
										</li>
										<li>
											<a href="#"> Call Us </a>
										</li>
										<li>
											<a href="#"> Complaints </a>
										</li>
										<li>
											<a href="#"> Feedbacks </a>
										</li>
										


										

										


									</ul>
								</div>


							</div>
						</li>
						
						

					</ul>


					<ul class="nav navbar-nav navbar-right">
						<li >
							<a href="#"> English

							</a>
							
							
						</li>
						<li >
							<a href="#"> عربى

							</a>
							
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="_desk-h">Region</span> <img class="navbar-flag" src="img/flag_codes/uae.png" alt="UAE" title="UAE"/>&nbsp;&nbsp;UAE </a>
							<div class="dropdown-menu dropdown-menu-sm">

								<div class="row" data-gutter="10">
									<div class="col-md-12">
										<ul class="dropdown-meganav-select-list-lang">


											<li class="active">
												<a href="#"> <img src="img/flag_codes/uae.png" alt="UAE" title="UAE"/>UAE </a>
											</li>

<li >
												<a href="#"> <img src="img/flag_codes/ksa.png" alt="KSA" title="KSA"/>KSA </a>
											</li>
											<li >
												<a href="#"> <img src="img/flag_codes/oman.png" alt="Oman" title="Oman"/>OMAN </a>
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