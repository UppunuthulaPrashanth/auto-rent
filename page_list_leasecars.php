<?php include "inc_opendb.php";

$PAGEID = "Lease a Cars";

?>

<!DOCTYPE HTML>

<html lang="en">

<head>

    <meta charset="UTF-8"/>

    <?php include 'inc_metadata.php'; ?>

</head>

<body>

<?php include 'inc_header.php';

if (empty($leaseBodyType))

{

    $rentCarResult = $db->query("SELECT * FROM lease_cars WHERE active = 1 ");

}

$counter       = mysqli_num_rows( $rentCarResult );

?>





<?php include 'inc_header.php'; ?>

<?php

$pageID = '34';

$result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);

$row = mysqli_fetch_assoc($result);

?>



<div class="theme-hero-area theme-hero-area-half">

    <div class="theme-hero-area-bg-wrap">

        <div class="theme-hero-area-bg" style="background-image:url('uploads/pages/<?php echo $row['headerBG'];?>');"></div>

        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>

        <div class="theme-hero-area-inner-shadow"></div>

    </div>

    <div class="theme-hero-area-body">

        <div class="container">

            <div class="row">

                <div class="col-md-8 theme-page-header-abs">

                    <div class="theme-page-header theme-page-header-lg">

                        <h1 class="theme-page-header-title"><?php echo $row['pageTitle'];?></h1>

                        <?php echo $row['summary']; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="theme-page-section theme-page-section-lg">

    <div class="container">

        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">

            <div class="col-md-8 ">



                <?php

                $pageID = '23';

                $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s", $pageID);

                $row = mysqli_fetch_assoc($result);

                ?>

                <div class="row row-col-gap" data-gutter="20">

                    <h5 class="theme-search-results-item-title theme-search-results-item-title-sm"><?php echo $row['pageTitle'];?></h5><br>

                    <form id="leaseCarsNewVehicleEnquiryForm" name="leaseCarsNewVehicleEnquiryForm" method="post">

                        <div class="theme-payment-page-form">

                            <div class="row row-col-gap" data-gutter="20">

                                <div class="col-md-12">

                                    <div class="theme-payment-page-form-item form-group">

                                        <i class="fa fa-angle-down"></i>

                                        <select class="form-control" name="selectedType" id="selectedType" required>

                                            <option value="" selected disabled>Select*</option>

                                            <option value="Individual">Individual</option>

                                            <option value="Corporate">Corporate</option>

                                        </select>

                                    </div>

                                </div>





                                <div class="col-md-6" id="IndividualFirstNameDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name*" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 " id="IndividualLastNameDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name*" required/>

                                    </div>

                                </div>





                                <div class="col-md-6 " id="CorporateCompanyNameDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" name="corporateCompanyName" id="corporateCompanyName" placeholder="Company Name*" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 " id="CorporateNameDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" name="corporateFullName" id="corporateFullName" placeholder="Name*" required/>

                                    </div>

                                </div>





                                <div class="col-md-6 " id="IndividualEmailDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="email" name="email" id="email" placeholder="E-Mail*" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 " id="IndividualPhoneDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone*" onkeypress="return isNumberKey(event)" required/>

                                    </div>

                                </div>

                                <div class="col-md-6" id="IndividualCountryDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <i class="fa fa-angle-down"></i> <select class="form-control" name="country" id="country" required>



                                            <option value="" selected disabled>Select Country*</option>

                                            <?php

                                            $countryRes = $db->query( "select * from mtr_country  ORDER BY countryName ASC" );

                                            while ( $countryRow = mysqli_fetch_assoc( $countryRes ) )

                                            {

                                                ?>

                                                <option value="<?php echo $countryRow['countryName']; ?>"><?php echo $countryRow['countryName']; ?></option>

                                                <?php

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6" id="IndividualCityDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" name="city" id="city" placeholder="City*" required/>

                                    </div>

                                </div>

                                <div class="col-md-12 " id="IndividualVehicleDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" name="vehicle" id="vehicle" type="text" placeholder="Vehicle*" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 " id="CorporateVehicleDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" name="corporateVehicle" id="corporateVehicle" type="text" placeholder="Vehicle*" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 " id="CorporateNoOfVehicleDiv">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" name="noOfVehicle" id="noOfVehicle" type="text" placeholder="No. of Vehicle Required*" required/>

                                    </div>

                                </div>

                                <div class="col-md-12 " id="IndividualSpecificRequirementDiv">

                                    <div class="form-group theme-contact-form-group">

                                        <textarea class="form-control" name="specificRequirement" id="specificRequirement" rows="5" placeholder="Specific Requirement"></textarea>

                                    </div>

                                </div>





                                <!--                                              <div class="col-md-6 " id="CorporateEmailDiv">-->

                                <!--                                                  <div class="theme-payment-page-form-item form-group">-->

                                <!--                                                      <input class="form-control" type="email" name="corporateEmail" id="corporateEmail" placeholder="E-Mail*" required/>-->

                                <!--                                                  </div>-->

                                <!--                                              </div>-->

                                <!--                                              <div class="col-md-6 " id="CorporatePhoneDiv">-->

                                <!--                                                  <div class="theme-payment-page-form-item form-group">-->

                                <!--                                                      <input class="form-control" type="text" name="corporatePhone" id="corporatePhone" placeholder="Phone*" onkeypress="return isNumberKey(event)" required/>-->

                                <!--                                                  </div>-->

                                <!--                                              </div>-->

                                <!--                                              <div class="col-md-6" id="CorporateCountryDiv">-->

                                <!--                                                  <div class="theme-payment-page-form-item form-group">-->

                                <!--                                                      <i class="fa fa-angle-down"></i>-->

                                <!--                                                      <select class="form-control" name="corporateCountry" id="corporateCountry" required>-->

                                <!---->

                                <!--                                                          <option value="" selected disabled>Select Country*</option>-->

                                <!--                                                          --><?php

                                //                                                          $countryRes = $db->query( "select * from mtr_country  ORDER BY countryName ASC" );

                                //                                                          while ( $countryRow = mysqli_fetch_assoc( $countryRes ) )

                                //                                                          {

                                //                                                              ?>

                                <!--                                                              <option value="--><?php //echo $countryRow['countryName'];?><!--">--><?php //echo $countryRow['countryName'];?><!--</option>-->

                                <!--                                                              --><?php

                                //                                                          }

                                //                                                          ?>

                                <!--                                                      </select>-->

                                <!--                                                  </div>-->

                                <!--                                              </div>-->

                                <!--                                              <div class="col-md-6" id="CorporateCityDiv">-->

                                <!--                                                  <div class="theme-payment-page-form-item form-group">-->

                                <!--                                                      <input class="form-control" type="text" name="corporateCity" id="corporateCity" placeholder="City*" required/>-->

                                <!--                                                  </div>-->

                                <!--                                              </div>-->



                                <div class="col-md-12 " id="CorporateSpecificRequirementDiv">

                                    <div class="form-group theme-contact-form-group">

                                        <textarea class="form-control" name="corporateSpecificRequirement" id="corporateSpecificRequirement" rows="5" placeholder="Specific Requirement"></textarea>

                                    </div>

                                </div>





                            </div>

                            <div class="col-md-12">

                                <br>

                                <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div>

                                <br> <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">

                            </div>

                            <hr>

                            <button type="submit" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="leaseNewVehicleEnquiryBtn" name="leaseNewVehicleEnquiryBtn">Submit</button>

                        </div>

                    </form>



                </div>

                <br><br>

                <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>

                <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>







                <div class="theme-item-page-details _pv-45 theme-item-page-details-first-nm">

                    <div class="theme-item-page-details-section">

                        <div class="row">


                            <?php

                            $pageID = '20';

                            $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

                            $row    = mysqli_fetch_assoc( $result );

                            ?>




                            <div class="theme-item-page-desc">

                                <h4><?php echo $row['pageTitle'];?></h4>

                                <?php echo $row['summary'];?>


                            </div>



                        </div>

                    </div>

                </div>

            </div>



            <div class="col-md-4 ">

                <div class="">





                    <div class="theme-sidebar-section _mb-10" style="margin-top: 45px">

                        <?php include "inc_corporate_sidebar.php";?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>









<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>

</body>

</html>