<div class="tab-pane" id="SearchAreaTabs-2" role="tab-panel">
	<div class="container">

		<div class="theme-search-area theme-search-area-white">

<!--            standard lease-->

            <form id="sliderLeaseCarsForm1" name="sliderLeaseCarsForm1" method="post" action="lease-a-cars">

            <div class="theme-search-area-form" id="standardLeaseDiv">
				<div class="row" data-gutter="10">
					<div class="col-md-11">
						<div class="row" data-gutter="10">
                            <div class="col-md-4">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <select class="theme-search-area-section-input" id="leaseClass" name="leaseClass" required>
                                            <option value="" selected disabled>Select Car Class</option>
                                            <?php
                                            $classRes = $db->query( "select * from mtr_car_classes WHERE active = 1 ORDER BY so ASC" );
                                            while ( $classRow = mysqli_fetch_assoc( $classRes ) )
                                            {
                                                ?>
                                                <option value="<?php echo $classRow['carClassID']; ?>"><?php echo $classRow['carClass']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <input value="standardLease" type="radio" name="standardLease" style="display:none" id="standardLease" checked/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <select class="theme-search-area-section-input" id="leaseMakeModel" name="leaseMakeModel">
                                            <option selected value="" disabled>Select Make Model</option>
                                            <option value="" disabled>Please Select Class First</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
<!--							<div class="col-md-3">-->
<!--                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">-->
<!--                                    <div class="theme-search-area-section-inner">-->
<!--                                        <select class="theme-search-area-section-input" id="leaseBodytype" name="leaseBodytype">-->
<!--                                            <option selected value="" disabled>Select Body Type</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--							</div>-->
							<div class="col-md-4">
                                <div class="theme-search-area-section first theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <select class="theme-search-area-section-input" id="leaseTerm" name="leaseTerm" required>
                                            <option value="" selected disabled>Select Term</option>
                                            <option value="" disabled>Please Select Make Model First</option>
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
<!--            standard lease-->

<!--            custom lease-->
            <form id="sliderLeaseCarsForm2" name="sliderLeaseCarsForm2" method="post" action="">
            <div class="theme-search-area-form" id="customLeaseDiv">
                <div class="row" data-gutter="10">
                    <div class="col-md-11">
                        <div class="row" data-gutter="10">
                            <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" name="customLeaseName" id="customLeaseName" type="text" placeholder="Name" required>
                                      <!--  <input value="customLease" type="radio"  name="customLease" id="customLease"/>-->
                                        <input type="hidden" name="customLease" id="customLease" value="customLease"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="email" name="customLeaseEmail" id="customLeaseEmail" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" name="customLeasePhone" id="customLeasePhone" type="text" placeholder="Phone" onkeypress="return isNumberKey(event)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="customLeaseSpecificRequirement" id="customLeaseSpecificRequirement" placeholder="Specific Requirement" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 ">
                        <img id="customLeaseAjaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
                        <button type="submit" id="customLease-btn" class="theme-search-area-submit _mt-0 theme-search-area-submit-no-border theme-search-area-submit-curved">Submit</button>
                    </div>
                </div>
            </div>
            </form>
<!--            custom lease-->

<!--            company lease-->
            <form id="sliderLeaseCarsForm3" name="sliderLeaseCarsForm3" method="post" action="">
            <div class="theme-search-area-form" id="companyLeaseDiv">
                <div class="row" data-gutter="10">
                    <div class="col-md-11">
                        <div class="row" data-gutter="10">
                            <div class="col-md-2">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" name="companyLeaseName" id="companyLeaseName" type="text" placeholder="Name" required>
                                        <input type="hidden" name="companyLease" id="companyLease" value="companyLease"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="companyLeaseCompanyName" id="companyLeaseCompanyName" placeholder="Company Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="email" name="companyLeaseEmail" id="companyLeaseEmail" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="companyLeasePhone" id="companyLeasePhone" placeholder="Phone" onkeypress="return isNumberKey(event)" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-fade-white theme-search-area-section-no-border">
                                    <div class="theme-search-area-section-inner">
                                        <i class="theme-search-area-section-icon fa fa-globe"></i> <input class="theme-search-area-section-input" type="text" name="companyLeaseSpecificRequirement" id="companyLeaseSpecificRequirement" placeholder="Specific Requirement" required>
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
            </form>
<!--            company lease-->

            <div class="theme-search-area-options _mob-h theme-search-area-options-white theme-search-area-options-center theme-search-area-options-dot-white clearfix">
				<div class="btn-group theme-search-area-options-list" id="newtheme" name="newtheme" data-toggle="buttons">
					<label class="btn btn-primary active">
                        <input value="standardLease" type="radio" name="leaseCarsType" id="standardLease2" checked/>Standard
                    </label>
                    <label class="btn btn-primary">
                        <input value="customLease" type="radio" name="leaseCarsType" id="customLease2"/>Custom
                    </label>
                    <label class="btn btn-primary">
                        <input value="companyLease" type="radio" name="leaseCarsType" id="companyLease2"/>Company
                    </label>
				</div>
			</div>

		</div>
        </form>

        <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
        <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
	</div>
</div>

<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>