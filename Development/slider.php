<section id="nw_banner">
	<!-- sliders -->
	<img class="img-responsive large" style="display: none;" alt="CRICK900" title="CRICK900" src="">
	<div class="nw_slider">
	   <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="none">
		  <ol class="carousel-indicators">
			 <li data-target="#myCarousel" data-slide-to="0" class=""></li>
			 <li data-target="#myCarousel" data-slide-to="1" class=""></li>
			 <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
			 <li data-target="#myCarousel" data-slide-to="3" class=""></li>
		  </ol>
		  <div class="carousel-inner">
			 <div class="item">
				<img class="img-responsive large" alt="" title="" src="images/homepage/1436960899_bg-key-services.jpg">
				<img class="img-responsive small hidden" alt="" title="" src="images/homepage/1436960899_bg-key-services.jpg">
				<div class="container">
				   <div class="carousel-caption my_txt">
					  <!-- <div class="header-content">
						 <h2><i>"MyChoize"</i> Self Drive Cars offers</h2>
						 <h1>Self Drive Car Rental</h1>
						 <h4>We help you to get the best self drive cars on rent in Delhi with MyChoize Self Drive Cars.</h4>
						 </div> -->
				   </div>
				</div>
			 </div>
			 <div class="item">
				<img class="img-responsive large" alt="" title="" src="images/homepage/1436960899_bg-key-services.jpg">
				<img class="img-responsive small hidden" alt="" title="" src="images/homepage/1436960899_bg-key-services.jpg">
				<div class="container">
				   <div class="carousel-caption my_txt">
					  <!-- <div class="header-content">
						 <h2><i>"Auto rent"</i> Self Drive Cars offers</h2>
						 <h1>Self Drive Car Rental</h1>
						 <h4>We help you to get the best self drive cars on rent in Delhi with MyChoize Self Drive Cars.</h4>
						 </div> -->
				   </div>
				</div>
			 </div>
			 <div class="item active">
				<img class="img-responsive large" alt="" title="" src="images/homepage/1436960899_bg-key-services.jpg">
				<img class="img-responsive small hidden" alt="" title="" src="images/homepage/1436960899_bg-key-services.jpg">
				<div class="container">
				   <div class="carousel-caption my_txt">
					  <!-- <div class="header-content">
						 <h2><i>"MyChoize"</i> Self Drive Cars offers</h2>
						 <h1>Self Drive Car Rental</h1>
						 <h4>We help you to get the best self drive cars on rent in Delhi with MyChoize Self Drive Cars.</h4>
						 </div> -->
				   </div>
				</div>
			 </div>
		  </div>
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		  <i class="glyphicon glyphicon-chevron-left"></i>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" data-slide="next">
		  <i class="glyphicon glyphicon-chevron-right"></i>
		  </a>
	   </div>
	</div>
	<!-- end sliders -->
	<!-- booking form -->
	<div class="nw_search staticBanner">
	   <div class="search_text">
		  <h4>REACH YOUR DESTINATION</h4>
		  <div class="MainForm" style="padding-left:20px">
			 <form class="" name="userForm" id="searchformbooking"  method="post" action="/rent-a-car" >
				<div class="form-group">
				   <span>Choose car</span>
				   <div class="input-group">
					  <div id="radioBtn" class="btn-group">
						 <?php
							$i=0;
							$result = $db->query("SELECT * FROM rent_lease_cars 
							LEFT JOIN mtr_bodytype ON rent_lease_cars.bodyTypeID = mtr_bodytype.bodyTypeID
							WHERE rent_lease_cars.active = 1 GROUP BY rent_lease_cars.bodyTypeID");
							while ($row = mysqli_fetch_assoc($result)) { ?>
						 <a class="btn btn-primaryy btn-sm <?php if($i==0) { 
							$i=1;
							echo 'active'; }else{echo 'notActive';} ?> " data-toggle="rentBodyType" data-title="<?php echo $row[
							"bodyTypeID"
							]; ?>"><?php echo $row["bodytype"]; ?></a>
						 <?php }
							?>
					  </div>
					  <input type="hidden" name="rentBodyType" id="rentBodyType">
				   </div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group left-icon">
					  <label>Pick up location</label>
					  <select class="form-control" id="pickupLocation" name="pickupLocation" required>
						 <?php
							$result = $db->query( "SELECT * FROM pickup_drop_locations WHERE active = 1 ORDER BY so ASC" );
							while ( $row = mysqli_fetch_assoc( $result ) )
							{
								if($row['location'] == 'Dubai - Al Quoz')
								{
								?>
						 <option selected value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>
						 <?php
							}
							else
								?>
						 <option value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>
						 <?php
							}
							
							?>
					  </select>
				   </div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group right-icon">
					  <label>Pickup Time</label>
					  <select class="form-control" id="dropLocation" name="dropLocation" required>
						 <option selected value="" disabled>Drop off</option>
						 <?php
							$result = $db->query( "SELECT * FROM pickup_drop_locations WHERE active = 1 ORDER BY so ASC" );
							
							while ( $row = mysqli_fetch_assoc( $result ) )
							
							{
							if($row['location'] == 'Dubai - Al Quoz')
							{
								?>
						 <option selected value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>
						 <?php
							}
							else
								?>
						 <option value="<?php echo $row['pdLocationID']; ?>"><?php echo $row['location']; ?></option>
						 <?php
							}
							
							?>
					  </select>
					  <i class="fa fa-angle-down"></i>
				   </div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group left-icon">
					  <label>Pickup Date</label>
					  <i class=" lin lin-calendar"></i>
					  <input class="form-control" id="date_picker" required
						 name="pickupDate" type="date" placeholder="Pick Up Date"/>
				   </div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				   <div class="form-group left-icon">
					  <label>Drop Off Date</label>
					  <i class=" lin lin-calendar"></i>
					  <input class="form-control" id="date_picker1" required
						 name="dropDate" type="date" placeholder="Drop off"/>
				   </div>
				</div>
				<div class="viewButton col-md-6" style="margin-top:10px">
				   <button class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved" id="btnRentSearch" name="btnRentSearch" type="submit">Search</button>
				</div>
				<div class="viewAllButton view-all-cars-btn col-md-6"  style="margin-top:10px">
				   <a href="rent-cars" class=" theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved" type="submit">View all Cars</a>
				</div>
			 </form>
		  </div>
	   </div>
	</div>
	<!-- end booking form -->
 </section>