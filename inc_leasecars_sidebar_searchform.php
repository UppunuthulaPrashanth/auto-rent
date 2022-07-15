<form id="sideBarLeaseCarSearchForm" name="sideBarLeaseCarSearchForm" method="post" action="lease-a-car">
	<div class="sticky-col _mob-h">
<!--		<div class="theme-search-area _mb-20 _p-20 _b _bc-dw theme-search-area-vert bg-white">-->
        <div class="theme-search-area _p-20 _bg-p _br-4 _mb-20 _bsh theme-search-area-vert theme-search-area-white">
        <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
				<h1 class="theme-search-area-title">Modify search</h1>
			</div>
			<div class="theme-search-area-form">
				<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
					<label class="theme-search-area-section-label">Car Category</label>
					<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
						<i class="fa fa-angle-down"></i>



						<select class="form-control" id="leaseBodyType" name="leaseBodyType" required>
							<option selected value="" disabled>Car Category</option>
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
				<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">
					<label class="theme-search-area-section-label">Make</label>
					<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
						<i class="fa fa-angle-down"></i>

						<select class="form-control" id="leaseMake" name="leaseMake">
							<option selected value="" disabled>Select Make</option>
							<option value="" disabled>Please Select Car Category First</option>
						</select>

					</div>
				</div>

				<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white
                          theme-search-area-section-no-border">
					<label class="theme-search-area-section-label">Model</label>
					<div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
						<i class="fa fa-angle-down"></i>
						<select class="form-control" id="leaseModel" name="leaseModel">
							<option selected value="" disabled>Select Model</option>
							<option value="" disabled>Please Select Make First</option>
						</select>
					</div>
				</div>


				<button type="submit" id="standardLease-btn" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Change</button>

			</div>
		</div>

	</div>
</form>