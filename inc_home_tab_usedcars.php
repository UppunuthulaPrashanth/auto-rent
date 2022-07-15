<div class="tab-pane" id="SearchAreaTabs-3" role="tab-panel">
	<div class="container">
		<div class="theme-search-area theme-search-area-white">
            <form id="sliderUsedCarsForm" name="sliderUsedCarsForm" method="post" action="/used-cars">
			<div class="theme-search-area-form" id="usedcarsIndividualDiv">
				<div class="row" data-gutter="10">
					<div class="col-md-5 ">
						<div class="row" data-gutter="10">
							<div class="col-md-6 ">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                <div class="theme-search-area-section-inner">
                                <select class="theme-search-area-section-input" id="make" name="make" required>
                                    <option value="" selected disabled>Select Make</option>
                                    <?php
                                    $makeRes = $db->query( "select * from mtr_make WHERE makeID IN (SELECT distinct(makeID) FROM view_used_cars WHERE active = 1) AND active = 1 ORDER BY make ASC" );
                                    while ( $makeRow = mysqli_fetch_assoc( $makeRes ) )
                                    {
                                        ?>
                                        <option value="<?php echo $makeRow['makeID']; ?>"><?php echo $makeRow['make']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                </div>
                                </div>
							</div>
							<div class="col-md-6 ">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                <select class="theme-search-area-section-input" id="model" name="model">
                                    <option selected value="" disabled>Select Model</option>
                                    <option value="" disabled>Please Select Make First</option>
                                </select>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<div class="col-md-6 ">
						<div class="row" data-gutter="10">
							<div class="col-md-6">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                <select class="theme-search-area-section-input" id="bodytype" name="bodytype">
                                    <option selected value="" disabled>Select Body Type</option>
<!--                                    --><?php
//                                    $bodyRes = $db->query("SELECT * FROM mtr_bodytype WHERE active = 1 ORDER BY so ASC");
//                                    while ($bodyRow = mysqli_fetch_assoc($bodyRes)) {
//                                        ?>
<!--                                        <option value="--><?php //echo $bodyRow['bodyTypeID']; ?><!--">--><?php //echo $bodyRow['bodytype']; ?><!--</option>-->
<!--                                        --><?php
//                                    }
//                                    ?>
                                </select>
                                    </div>
                                </div>
							</div>
							<div class="col-md-6">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                <select class="theme-search-area-section-input" id="year" name="year">
                                    <option selected value="" disabled>Select Year</option>
<!--                                    --><?php
//                                    $yearRes = $db->query("SELECT * FROM mtr_year WHERE active = 1 ORDER BY so ASC");
//                                    while ($yearRow = mysqli_fetch_assoc($yearRes)) {
//                                        ?>
<!--                                        <option value="--><?php //echo $yearRow['yearID']; ?><!--">--><?php //echo $yearRow['year']; ?><!--</option>-->
<!--                                        --><?php
//                                    }
//                                    ?>
                                </select>
                                    </div>
                                </div>
							</div>
<!--							<div class="col-md-4 ">-->
<!--								<div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border ">-->
<!--									<div class="theme-search-area-section-inner">-->
<!--										<i class="theme-search-area-section-icon fa fa-map-marker"></i> <input class="theme-search-area-section-input " type="text" placeholder="Location">-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
						</div>
					</div>
					<div class="col-md-1 ">
						<button type="submit" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Search</button>
					</div>
				</div>
			</div>


                <div class="theme-search-area-form" id="usedcarsCompanyDiv">
                    <div class="row" data-gutter="10">
                        <div class="col-md-11">
                            <div class="row" data-gutter="10">
                                <div class="col-md-2">
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" name="companyLeaseName" id="companyLeaseName" type="text" placeholder="Name">
                                            <input type="hidden" name="companyLease" id="companyLease" value="companyLease"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="companyLeaseCompanyName" id="companyLeaseCompanyName" placeholder="Company Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="email" name="companyLeaseEmail" id="companyLeaseEmail" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="companyLeasePhone" id="companyLeasePhone" placeholder="Phone" onkeypress="return isNumberKey(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                        <div class="theme-search-area-section-inner">
                                            <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="companyLeaseSpecificRequirement" id="companyLeaseSpecificRequirement" placeholder="Specific Requirement">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 ">
                            <button type="submit" id="companyLease-btn" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Submit</button>
                        </div>
                    </div>
                </div>


			<div class="theme-search-area-options theme-search-area-options-white theme-search-area-options-center theme-search-area-options-dot-white clearfix">
				<div class="btn-group theme-search-area-options-list" data-toggle="buttons">
					<label class="btn btn-primary active">
                        <input value="Individual"  type="radio" name="usedCarsType" id="usedCarsType" checked/>Individual
                    </label>
                    <label class="btn btn-primary">
                        <input value="Company" type="radio" name="usedCarsType" id="usedCarsCompany"/>Company
                    </label>
				</div>
			</div>
		</div>
    </form>
	</div>
</div>