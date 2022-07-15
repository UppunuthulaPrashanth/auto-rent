<div class="container-fluid staticBanner">
	<div class="row">
	   <div class="col-md-5 col-md-offset-1">
		  <div class="panel panel-default">
			 <div class="panel-heading">
				<span class="fa fa-car"></span> Book car
			 </div>
			 <div class="panel-body">
				<form id="rentcars" name="rentcars" method="post" action="/rent-a-car">
				   <div class="theme-search-area theme-search-area-white">
					  <div class="theme-search-area-form">
						 <div class="row" data-gutter="10" style="margin-top: 10px">
							<div class="col-md-12">

							<div class="form-group" >
							   <label for="rentBodyType" style="color:lightslategray">Choose car</label>
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
							</div>
							<div class="col-md-6">
							   <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
								  <div class="theme-search-area-section-inner">
									 <i class="theme-search-area-section-icon lin lin-location-pin"></i>
									 <select class="theme-search-area-section-input" id="pickupLocation" name="pickupLocation" required>
										<option selected value="" disabled>Pick up location  </option>
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
							<div class="col-md-6">
							   <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
								  <div class="theme-search-area-section-inner">
									 <i class="theme-search-area-section-icon lin lin-location-pin"></i>
									 <select class="theme-search-area-section-input" id="dropLocation" name="dropLocation" required>
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
							<div class="col-md-6" style="margin-top:10px">
							   <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
								  <div class="theme-search-area-section-inner">
									 <i class="theme-search-area-section-icon lin lin-calendar"></i>
									 <input class="theme-search-area-section-input datePickerStart"
										id="pickupDate" required
										name="pickupDate" type="text"
										placeholder="Pick Up Date"/>
									 <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>
								  </div>
							   </div>
							</div>
							<div class="col-md-6" style="margin-top:10px">
							   <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
								  <div class="theme-search-area-section-inner">
									 <i class="theme-search-area-section-icon lin lin-calendar"></i>
									 <input class="theme-search-area-section-input datePickerEnd "
										id="dropDate"
										name="dropDate" required
										type="text"
										placeholder="Drop Off Date"/>
									 <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>
								  </div>
							   </div>
							</div>
							<div class="col-md-6" style="margin-top:20px">
							   <button class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved" id="btnRentSearch" name="btnRentSearch" type="submit">Search</button>
							</div>
							<div class="col-md-6" style="margin-top:20px">
							   <a href="rent-cars" class=" theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved" type="submit">View all Cars</a>
							</div>
						 </div>
					  </div>
					  <!-- <div class="theme-search-area-options _mob-h theme-search-area-options-white theme-search-area-options-center theme-search-area-options-dot-white clearfix">
						 <div class="btn-group theme-search-area-options-list" data-toggle="buttons">
							 <?php
							$i      = 0;
							$result = $db->query( "SELECT * FROM mtr_car_classes WHERE active = 1 ORDER BY so ASC" );
							while ( $row = mysqli_fetch_assoc( $result ) )
							{
								$i ++;
								?>
								 <label class="btn btn-primary <?php if ( $i == 1 ) {
							echo "active";
							} ?>"> <input type="radio" name="carClass" required value="<?php echo $row['carClassID']; ?>" id="carClass<?php echo $i; ?>" <?php if ( $i == 1 )
							{
								echo "checked='checked'";
							} else
							{
								//echo "checked=''";
							} ?> />
									 <?php echo $row['carClass']; ?>
								 </label>
								 <?php
							}
							?>
						 </div>
						 </div> -->
				   </div>
				</form>
			 </div>
		  </div>
	   </div>
	</div>
 </div>