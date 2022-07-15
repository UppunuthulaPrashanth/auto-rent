<div class="tab-pane active" id="SearchAreaTabs-1" role="tab-panel">

	<form id="rentcars" name="rentcars" method="post" action="/rent-a-car">

		<div class="container">



			<div class="theme-search-area-options _mob-h theme-search-area-options-white theme-search-area-options-center theme-search-area-options-dot-white clearfix">

				<div class="btn-group theme-search-area-options-list" data-toggle="buttons" style="display: none">

					<label class="btn btn-primary active"><input type="radio" name="rent-duration" id="rent-duration-daily" checked="" value="daily">Daily </label>

					<label class="btn btn-primary">	<input type="radio" name="rent-duration" id="rent-duration-weekly" value="weekly">Weekly </label>

					<label class="btn btn-primary"> <input type="radio" name="rent-duration" id="rent-duration-monthly" value="monthly">Monthly </label>



				</div>

			</div>



			<div class="theme-search-area theme-search-area-white">

				<div class="theme-search-area-form">

					<div class="row" data-gutter="10">

						<div class="col-md-5 ">

							<div class="row" data-gutter="10">



								<div class="col-md-4 ">

									<div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

										<div class="theme-search-area-section-inner">

<!--											<i class="theme-search-area-section-icon lin lin-location-pin"></i>-->
											<i class="theme-search-area-section-icon"><img src="uploads/pages/car-icon.png" alt="Car Icon"></i>

											<select class="theme-search-area-section-input" id="rentBodyType" name="rentBodyType" required>



												<option value="" disabled>Car Category</option>

                                                <option selected value="">Choose Cars</option>

												<?php

												$result = $db->query( "SELECT * FROM rent_lease_cars 

												LEFT JOIN mtr_bodytype ON rent_lease_cars.bodyTypeID = mtr_bodytype.bodyTypeID

												WHERE rent_lease_cars.active = 1 GROUP BY rent_lease_cars.bodyTypeID" );

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





								<div class="col-md-4 ">

									<div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

										<div class="theme-search-area-section-inner">

											<i class="theme-search-area-section-icon lin lin-location-pin"></i>

											<!--																				   <input class="theme-search-area-section-input typeahead" type="text" placeholder="Pick up location">-->

											<select class="theme-search-area-section-input" id="pickupLocation" name="pickupLocation" required>
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

								</div>



								<div class="col-md-4 ">

									<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

										<div class="theme-search-area-section-inner">

											<i class="theme-search-area-section-icon lin lin-location-pin"></i>

											<!--											                                        <input class="theme-search-area-section-input typeahead" type="text" placeholder="Drop off location">-->

											<select class="theme-search-area-section-input" id="dropLocation" name="dropLocation" required>

												<!--												<i class="theme-search-area-section-icon lin lin-location-pin"></i>-->

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

										</div>

									</div>

								</div>







							</div>

						</div>

						<div class="col-md-2 ">

							<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

								<div class="theme-search-area-section-inner">

									<i class="theme-search-area-section-icon lin lin-calendar"></i>

									<input class="theme-search-area-section-input datePickerStart latest-rent-pickupDate" id="pickupDate" required

										   name="pickupDate" type="text" placeholder="Pick Up Date"/>

									<input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

								</div>

							</div>

						</div>

						<div class="col-md-2 ">

							<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">

								<div class="theme-search-area-section-inner">

									<i class="theme-search-area-section-icon lin lin-calendar"></i>

									<input class="theme-search-area-section-input latest-rent-dropDate" id="dropDate" name="dropDate" required type="text" placeholder="Drop Off Date"/> <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>

								</div>

							</div>

						</div>

						<div class="col-md-1 ">

							<button class="theme-search-area-submit

							_mt-0 theme-search-area-submit-no-border

							theme-search-area-submit-curved" id="btnRentSearch" name="btnRentSearch" type="submit">

								Search</button>



						</div>


                        <div class="col-md-2 view-all-cars-btn">

                            <a href="rent-cars" class=" theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved" type="submit">

                                View all Cars</a>



                        </div>



					</div>

				</div>

<!--				<div class="theme-search-area-options _mob-h theme-search-area-options-white theme-search-area-options-center theme-search-area-options-dot-white clearfix">-->

<!--					<div class="btn-group theme-search-area-options-list" data-toggle="buttons">-->

<!--						--><?php

//						$i      = 0;

//						$result = $db->query( "SELECT * FROM mtr_car_classes WHERE active = 1 ORDER BY so ASC" );

//						while ( $row = mysqli_fetch_assoc( $result ) )

//						{

//							$i ++;

//							?>

<!--							<label class="btn btn-primary --><?php //if ( $i == 1 )

//							{

//								echo "active";

//							} ?><!--"> <input type="radio" name="carClass" required value="--><?php //echo $row['carClassID']; ?><!--" id="carClass--><?php //echo $i; ?><!--" --><?php //if ( $i == 1 )

//								{

//									echo "checked='checked'";

//								} else

//								{

//									//echo "checked=''";

//								} ?><!-- />-->

<!--								--><?php //echo $row['carClass']; ?>

<!--							</label>-->

<!--							--><?php

//						}

//						?>

<!--					</div>-->

<!--				</div>-->





			</div>

		</div>

	</form>

</div>

