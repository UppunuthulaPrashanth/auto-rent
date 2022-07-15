<div class="tab-pane" id="SearchAreaTabs-5" role="tab-panel" style="padding-top:25px;">
    <form id="payAsYouDrive" name="payAsYouDrive" method="post" action="/pay-as-you-drive">
	<div class="container">
		<div class="theme-search-area theme-search-area-white">
			<div class="theme-search-area-form">
				<div class="row" data-gutter="10">
					<div class="col-md-7 ">
                        <div class="row" data-gutter="10">

                            <div class="col-md-4 ">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                        <select class="theme-search-area-section-input" id="driveBodyType" name="driveBodyType" required>

                                            <option value="" disabled>Car Category</option>
                                            <option selected value="">Choose Cars</option>
                                            <?php
                                            $result = $db->query( "SELECT * FROM pay_as_you_drive 
LEFT JOIN mtr_bodytype ON pay_as_you_drive.bodyTypeID = mtr_bodytype.bodyTypeID
WHERE pay_as_you_drive.active = 1 GROUP BY pay_as_you_drive.bodyTypeID" );
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
                                        <select class="theme-search-area-section-input" id="drivePickupLocation" name="drivePickupLocation" required>

                                            <option selected value="" disabled>Pick up location</option>
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

                            <div class="col-md-4 ">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                                        <!--											                                        <input class="theme-search-area-section-input typeahead" type="text" placeholder="Drop off location">-->
                                        <select class="theme-search-area-section-input" id="driveDropLocation" name="driveDropLocation" required>
                                            <!--												<i class="theme-search-area-section-icon lin lin-location-pin"></i>-->
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



                        </div>
					</div>
                    <div class="col-md-2 ">
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                            <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                <input class="theme-search-area-section-input datePickerStart" id="drivePickupDate" required name="drivePickupDate" type="text" placeholder="Pick Up Date"/>
                                <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                            <div class="theme-search-area-section-inner">
                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                <input class="theme-search-area-section-input datePickerEnd " id="driveDropDate" name="driveDropDate" required type="text" placeholder="Drop Off Date"/>
                                <input class="theme-search-area-section-input _mob-h _desk-h mobile-picker" type="date"/>
                            </div>
                        </div>
                    </div>
					<div class="col-md-1 ">
<!--						<a href="coming-soon" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Search</a>-->
                        <button class="theme-search-area-submit
							_mt-0 theme-search-area-submit-no-border
							theme-search-area-submit-curved" id="btnDriveSearch" name="btnDriveSearch" type="submit">
                            Search</button>

                    </div>
				</div>
			</div>
<!--			<div class="theme-search-area-options _mob-h theme-search-area-options-white theme-search-area-options-center theme-search-area-options-dot-white clearfix">-->
<!--				<div class="btn-group theme-search-area-options-list" data-toggle="buttons">-->
<!--					<label class="btn btn-primary active"> <input type="radio" name="car-options" id="car-option-1" checked/>Any </label> <label class="btn btn-primary"> <input type="radio" name="car-options" id="car-option-2"/>Sedan </label> <label class="btn btn-primary"> <input type="radio" name="car-options" id="car-option-3"/>Hatchback </label> <label class="btn btn-primary"> <input type="radio" name="car-options" id="car-option-4"/>SUV </label>-->
<!--					<label class="btn btn-primary"> <input type="radio" name="car-options" id="car-option-5"/>Crossover </label> <label class="btn btn-primary"> <input type="radio" name="car-options" id="car-option-6"/>Coupe </label>-->
<!--				</div>-->
<!--			</div>-->
		</div>
	</div>
    </form>
</div>