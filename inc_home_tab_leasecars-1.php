<div class="tab-pane" id="SearchAreaTabs-2" role="tab-panel" style="padding-top:25px;">
	<div class="container">

		<div class="theme-search-area theme-search-area-white">

			<!--            standard lease-->

			<form id="sliderLeaseCarsForm1" name="sliderLeaseCarsForm1" method="post" action="lease-a-car">

				<div class="theme-search-area-form" id="standardLeaseDiv">
					<div class="row" data-gutter="10">
						<div class="col-md-11">
							<div class="row" data-gutter="10">


								<div class="col-md-4">
									<div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
										<div class="theme-search-area-section-inner">
											<select class="theme-search-area-section-input" id="leaseBodyType" name="leaseBodyType" required>
												<option  value="" disabled>Car Category</option>
												<option selected value="">Choose Cars</option>
												<?php
												$result = $db->query( "SELECT * FROM lease_cars 
																	LEFT JOIN mtr_bodytype ON lease_cars.bodyTypeID = mtr_bodytype.bodyTypeID
																	WHERE lease_cars.active = 1 GROUP BY lease_cars.bodyTypeID" );
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


								<div class="col-md-4">
									<div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
										<div class="theme-search-area-section-inner">
											<select class="theme-search-area-section-input" id="leaseMake" name="leaseMake">
												<option selected value="" disabled>Select Make</option>
												<option value="" disabled>Please Select Car Category First</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
										<div class="theme-search-area-section-inner">
											<select class="theme-search-area-section-input" id="leaseModel" name="leaseModel">
												<option selected value="" disabled>Select Model</option>
												<option value="" disabled>Please Select Make First</option>
											</select>
										</div>
									</div>
								</div>


							</div>
						</div>
						<div class="col-md-1 ">
							<button type="submit" id="standardLease-btn" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Search</button>
						</div>
					</div>
				</div>

			</form>
		</div>


		<div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
		<div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
	</div>
</div>

<!--<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>-->