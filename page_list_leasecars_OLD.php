<?php include "inc_opendb.php";

$PAGEID = "Lease a Cars";



//echo "<pre>";

//echo print_r($_POST);

//echo "</pre>";

//exit();



//

//if ( isset( $_POST["leaseBodyType"] ) )

//{

//    $leaseBodyType = filter_var( $_POST['leaseBodyType'], FILTER_SANITIZE_STRING );

//}

//

//if ( isset( $_POST["leaseMake"] ) )

//{

//    $leaseMake = filter_var( $_POST['leaseMake'], FILTER_SANITIZE_STRING );

//}

//

//if ( isset( $_POST["leaseModel"] ) )

//{

//    $leaseModel = filter_var( $_POST['leaseModel'], FILTER_SANITIZE_STRING );

//}



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



<div class="theme-hero-area">

    <div class="theme-hero-area-bg-wrap">

        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel-1.png);"></div>

        <div class="theme-hero-area-grad-mask"></div>

    </div>

    <div class="theme-hero-area-body">

        <div class="container">

            <div class="row _pv-30">

                <div class="col-md-6 ">

                    <div class="">

                        <div class="theme-hero-text theme-hero-text-white">

                            <div class="breadcrumb-margins">

                                <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Lease Cars</h2>

                            </div>

                        </div>



                    </div>

                    <!--                    <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">-->

                    <!--                        <h4 class="theme-search-area-inline-title">Dubai Cars</h4>-->

                    <!--                        <p class="theme-search-area-inline-details">Nissan Sunny</p>-->

                    <!--                        <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal"> <i class="fa fa-pencil"></i>Edit </a>-->

                    <!--                        <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">-->

                    <!--                            <div class="theme-search-area theme-search-area-vert">-->

                    <!--                                <div class="theme-search-area-header">-->

                    <!--                                    <h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>-->

                    <!--                                    <p class="theme-search-area-subtitle">Prices might be different from current results</p>-->

                    <!--                                </div>-->

                    <!--                                <div class="theme-search-area-form">-->

                    <!--                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

                    <!--                                        <label class="theme-search-area-section-label">Make</label>-->

                    <!--                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

                    <!--                                            <i class="fa fa-angle-down"></i> <select class="form-control">-->

                    <!--                                                <option>Select Make</option>-->

                    <!--                                                <option>Audi</option>-->

                    <!---->

                    <!---->

                    <!--                                                <option>Bugatti</option>-->

                    <!--                                                <option>Cadillac</option>-->

                    <!--                                                <option>Dodge</option>-->

                    <!---->

                    <!--                                            </select>-->

                    <!--                                        </div>-->

                    <!--                                    </div>-->

                    <!--                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

                    <!--                                        <label class="theme-search-area-section-label">Model</label>-->

                    <!--                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

                    <!--                                            <i class="fa fa-angle-down"></i> <select class="form-control">-->

                    <!--                                                <option>Select Model</option>-->

                    <!--                                                <option>Audi</option>-->

                    <!---->

                    <!---->

                    <!--                                                <option>Bugatti</option>-->

                    <!--                                                <option>Cadillac</option>-->

                    <!--                                                <option>Dodge</option>-->

                    <!---->

                    <!--                                            </select>-->

                    <!--                                        </div>-->

                    <!--                                    </div>-->

                    <!---->

                    <!--                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

                    <!--                                        <label class="theme-search-area-section-label">Term</label>-->

                    <!--                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

                    <!--                                            <i class="fa fa-angle-down"></i> <select class="form-control">-->

                    <!--                                                <option>Select Lease Term</option>-->

                    <!--                                                <option>6 Months</option>-->

                    <!---->

                    <!---->

                    <!--                                                <option>12 Months</option>-->

                    <!--                                                <option>18 Months</option>-->

                    <!--                                                <option>24 Months</option>-->

                    <!---->

                    <!--                                            </select>-->

                    <!--                                        </div>-->

                    <!--                                    </div>-->

                    <!---->

                    <!---->

                    <!--                                    <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->

                    <!--                                        <label class="theme-search-area-section-label">Location</label>-->

                    <!--                                        <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->

                    <!--                                            <i class="fa fa-angle-down"></i> <select class="form-control">-->

                    <!--                                                <option>Select Location</option>-->

                    <!--                                                <option>Abu Dhabi</option>-->

                    <!---->

                    <!---->

                    <!--                                                <option>Dubai</option>-->

                    <!--                                                <option>Sharjah</option>-->

                    <!--                                                <option>RAK</option>-->

                    <!---->

                    <!--                                            </select>-->

                    <!--                                        </div>-->

                    <!--                                    </div>-->

                    <!---->

                    <!---->

                    <!--                                    <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>-->

                    <!--                                </div>-->

                    <!--                            </div>-->

                    <!--                        </div>-->

                    <!--                    </div>-->

                </div>

                <div class="col-md-6">

                    <ul class="theme-breadcrumbs _mt-20 right-breadcrumb">

                        <li>

                            <p class="theme-breadcrumbs-item-title">

                                <a href="/">Home</a>

                            </p>

                        </li>

                        <li>

                            <p class="theme-breadcrumbs-item-title">

                                <a>Lease Car</a>

                            </p>

                        </li>





                        <li>

                            <p class="theme-breadcrumbs-item-title">

                                <a>Search Results</a>

                            </p>

                            <p class="theme-breadcrumbs-item-subtitle"><?php echo $counter; ?> vehicles</p>

                        </li>





                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>





<div class="theme-page-section theme-page-section-gray">

    <div class="container">





        <div class="row row-col-static" id="sticky-parent" data-gutter="20">





            <div class="col-md-3 ">

                <!--                --><?php //include "inc_leasecars_sidebar_searchform.php"; ?>

            </div>



            <div class="col-md-6 ">

                <div class="theme-search-results-item theme-search-results-item-">

                    <div class="theme-search-results-item-preview">



                        <?php

                        $pageID = '20';

                        $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

                        $row    = mysqli_fetch_assoc( $result );

                        ?>

                        <div class="row row-col-static" id="sticky-parent" data-gutter="20">

                            <h4><?php echo $row['pageTitle'];?></h4>

                            <?php echo $row['summary'];?>

                        </div>

                    </div>

                </div>

                <hr>



                <!--            <div class="theme-search-results-sort _mob-h _b-n clearfix">-->

                <!--              <h5 class="theme-search-results-sort-title">Sort by:</h5>-->

                <!--              <ul class="theme-search-results-sort-list">-->

                <!--                <li class="active">-->

                <!--                  <a href="#">Price-->

                <!--                    <span>Low &rarr; High</span>-->

                <!--                  </a>-->

                <!--                </li>-->

                <!--                -->

                <!--                -->

                <!--                -->

                <!--                -->

                <!--              </ul>-->

                <!--              <div class="dropdown theme-search-results-sort-alt">-->

                <!--                <a id="dropdownMenu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">More-->

                <!--                  <span class="caret"></span>-->

                <!--                </a>-->

                <!--                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">-->

                <!--                  <li>-->

                <!--                    <a href="#">Recommended</a>-->

                <!--                  </li>-->

                <!--                  <li>-->

                <!--                    <a href="#">Most Popular</a>-->

                <!--                  </li>-->

                <!--                  <li>-->

                <!--                    <a href="#">Trendy Now</a>-->

                <!--                  </li>-->

                <!--                  <li>-->

                <!--                    <a href="#">Best Deals</a>-->

                <!--                  </li>-->

                <!--                </ul>-->

                <!--              </div>-->

                <!--            </div>-->

                <!--                <div class="theme-search-results-sort-select _desk-h">-->

                <!--                    <select>-->

                <!--                        <option>Price</option>-->

                <!--                        <option>Guest Rating</option>-->

                <!--                        <option>Property Class</option>-->

                <!--                        <option>Property Name</option>-->

                <!--                        <option>Recommended</option>-->

                <!--                        <option>Most Popular</option>-->

                <!--                        <option>Trendy Now</option>-->

                <!--                        <option>Best Deals</option>-->

                <!--                    </select>-->

                <!--                </div>-->





                <div class="theme-search-results">

                    <div class="">





                        <div class="theme-search-results-item theme-search-results-item-">

                            <div class="theme-search-results-item-preview products-grid">



                                <?php

                                $itemsPerPage = 3;

                                $currentIndex = 0;

                                $totalItems   = 0;





                                $rentCarResult = $db->query("SELECT * FROM lease_cars where active = 1 ORDER BY monthlyAED ASC");



                                $totalItems = mysqli_num_rows( $rentCarResult );



                                $rentCarListingResQuery = $db->lastQuery() . " LIMIT ?i, ?i";





                                if ( $totalItems > $itemsPerPage )

                                {

                                    $rentCarResult = $db->query( $rentCarListingResQuery, $currentIndex, $itemsPerPage );

                                }



                                $i = 0;

                                while ( $rentCarRow = mysqli_fetch_assoc( $rentCarResult ) )

                                {

                                    $i ++;

                                    ?>



                                    <div class="row" data-gutter="20">



                                        <div class="col-md-3 ">

                                            <div class="theme-search-results-item-img-wrap">

                                                <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>

                                            </div>

                                            <ul class="theme-search-results-item-car-feature-list">

                                                <li>

                                                    <i class="fa fa-male"></i> <span><?php echo $rentCarRow['noOfSeats']; ?></span>

                                                </li>

                                                <li>

                                                    <i class="fa fa-suitcase"></i> <span><?php echo $rentCarRow['luggage']; ?></span>

                                                </li>

                                                <li>

                                                    <i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $rentCarRow['transmissionID'] ); ?></span>

                                                </li>

                                                <li>

                                                    <i class="fa fa-snowflake-o"></i> <span><?php if ( $rentCarRow['ac'] == 'Y' )

                                                        {

                                                            echo "A/C";

                                                        } else

                                                        {

                                                            echo "Non-A/C";

                                                        } ?></span>

                                                </li>

                                                <li>

                                                    <i class="fa fa-car"></i> <span><?php echo $rentCarRow['noOfDoors']; ?></span>

                                                </li>



                                            </ul>

                                        </div>



                                        <div class="col-md-7 ">

                                            <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo getMakeFromID($rentCarRow['makeID']) . " " . getModelFromID($rentCarRow['modelID']); ?></h5>

                                            <div class="theme-search-results-item-car-location">



                                                <div class="theme-search-results-item-car-location-body">

                                                    <p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID($rentCarRow['bodyTypeID'] ); ?></p>

                                                    <!--													<p class="theme-search-results-item-car-location-subtitle">--><?php //echo $leaseTerm; ?><!-- Contract</p>-->

                                                </div>

                                            </div>

                                            <ul class="theme-search-results-item-car-list">

                                                <?php $extraFeatures = $rentCarRow['extraFeatures'];

                                                $featureResult       = $db->query( "SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)" );

                                                while ( $featureRow = mysqli_fetch_assoc( $featureResult ) )

                                                {

                                                    ?>

                                                    <li class="list-float "><i class="fa fa-check"></i><?php echo $featureRow['extraFeatures']; ?>

                                                    </li><?php } ?>

                                            </ul>

                                        </div>

                                        <div class="col-md-2 ">

                                            <div class="theme-search-results-item-book">

                                                <div class="theme-search-results-item-price">

                                                    <p class="theme-search-results-item-price-tag">

                                                        <?php

                                                        echo $_SESSION[ CURRENT_CURRENCY ] . " " . $rentCarRow[ 'monthlyAED' ];

                                                        ?></p>

                                                    <p class="theme-search-results-item-price-sign">per month</p>

                                                </div>



                                            </div>



                                            <div class="theme-search-results-item-book">



                                                <form name="leaseCarSelectForm"  method="post" action="/book-lease-cars">

                                                    <input type="hidden" name="leaseBodyType" value="<?php echo $leaseBodyType; ?>"/>

                                                    <input type="hidden" name="leaseMake"  value="<?php echo $leaseMake; ?>"/>

                                                    <input type="hidden" name="leaseModel" value="<?php echo $leaseModel; ?>"/>



                                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" name="btnBook" value="<?php echo $rentCarRow['slug'] ?>" type="submit">Enquire Now</button>



                                                </form>

                                            </div>





                                        </div>

                                    </div>

                                    <hr/>

                                    <?php

                                }

                                ?>

                                <br><br>

                                <div class="theme-payment-page-form _mb-20">

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

                                                    <br> <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif"  alt="loader" style="display: none; margin-left: auto; margin-right: auto;">

                                                </div>

                                                <hr>

                                                <button type="submit" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="leaseNewVehicleEnquiryBtn" name="leaseNewVehicleEnquiryBtn">Submit</button>

                                            </div>

                                        </form>



                                    </div>

                                    <br><br>

                                    <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>

                                    <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>

                                </div>

                            </div>

                        </div>

                    </div>





                    <!--              <div class="_desk-h">-->

                    <!--                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">-->

                    <!--                  <div class="_h-30vh theme-search-results-item-img-wrap-inner">-->

                    <!--                    <img class="theme-search-results-item-img" src="img/car-results/1.jpg" alt="Image Alternative text" title="Image Title"/>-->

                    <!--                  </div>-->

                    <!--                  <div class="theme-search-results-item-grid-body _pt-0">-->

                    <!--                    <a class="theme-search-results-item-mask-link" href="#"></a>-->

                    <!--                    <div class="theme-search-results-item-grid-header">-->

                    <!--                      <h5 class="theme-search-results-item-title _fs">Toyota Yaris</h5>-->

                    <!--                    </div>-->

                    <!--                    <div class="theme-search-results-item-grid-caption">-->

                    <!--                      <div class="row" data-gutter="10">-->

                    <!--                        <div class="col-xs-12 ">-->

                    <!--                          <div class="theme-search-results-item-car-location">-->

                    <!--                            <i class="fa fa-car theme-search-results-item-car-location-icon"></i>-->

                    <!--                            <div class="theme-search-results-item-car-location-body">-->

                    <!--                              <p class="theme-search-results-item-car-location-title">Sedan</p>-->

                    <!--                              <p class="theme-search-results-item-car-location-subtitle">6 Months Contract</p>-->

                    <!--                            </div>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                        -->

                    <!--                      </div>-->

                    <!--                      <hr>-->

                    <!--                      <div class="row" data-gutter="10">-->

                    <!--                        -->

                    <!--                        <div class="col-xs-6">-->

                    <!--                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Now</h5>-->

                    <!--                          <div class="theme-search-results-item-price ">-->

                    <!--                            <p class="theme-search-results-item-price-tag txt-center">AED 1161</p>-->

                    <!--                            <p class="theme-search-results-item-price-sign txt-center">per month</p>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                        <div class="col-xs-6 txt-center">-->

                    <!--                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Later</h5>-->

                    <!--                          <div class="theme-search-results-item-price">-->

                    <!--                            <p class="theme-search-results-item-price-tag txt-center">AED 1300</p>-->

                    <!--                            <p class="theme-search-results-item-price-sign txt-center">per month</p>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                    </div>-->

                    <!--                  </div>-->

                    <!--                </div>-->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                -->

                    <!--                <div class="theme-search-results-item _br-3 _mb-20 _bsh-xl theme-search-results-item-grid">-->

                    <!--                  <div class="_h-30vh theme-search-results-item-img-wrap-inner">-->

                    <!--                    <img class="theme-search-results-item-img" src="img/car-results/17.jpg" alt="Image Alternative text" title="Image Title"/>-->

                    <!--                  </div>-->

                    <!--                  <div class="theme-search-results-item-grid-body _pt-0">-->

                    <!--                    <a class="theme-search-results-item-mask-link" href="#"></a>-->

                    <!--                    <div class="theme-search-results-item-grid-header">-->

                    <!--                      <h5 class="theme-search-results-item-title _fs">Mazda 3</h5>-->

                    <!--                    </div>-->

                    <!--                    <div class="theme-search-results-item-grid-caption">-->

                    <!--                      <div class="row" data-gutter="10">-->

                    <!--                        <div class="col-xs-12 ">-->

                    <!--                          <div class="theme-search-results-item-car-location">-->

                    <!--                            <i class="fa fa-car theme-search-results-item-car-location-icon"></i>-->

                    <!--                            <div class="theme-search-results-item-car-location-body">-->

                    <!--                              <p class="theme-search-results-item-car-location-title">Sedan</p>-->

                    <!--                              <p class="theme-search-results-item-car-location-subtitle">6 Months Contract</p>-->

                    <!--                            </div>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                        -->

                    <!--                      </div>-->

                    <!--                      <hr>-->

                    <!--                      <div class="row" data-gutter="10">-->

                    <!--                        -->

                    <!--                        <div class="col-xs-6  ">-->

                    <!--                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Now</h5>-->

                    <!--                          <div class="theme-search-results-item-price ">-->

                    <!--                            <p class="theme-search-results-item-price-tag txt-center">AED 1161</p>-->

                    <!--                            <p class="theme-search-results-item-price-sign txt-center">per month</p>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                        <div class="col-xs-6 txt-center">-->

                    <!--                          <h5 class="theme-search-results-item-title _fs txt-center">Pay Later</h5>-->

                    <!--                          <div class="theme-search-results-item-price">-->

                    <!--                            <p class="theme-search-results-item-price-tag txt-center">AED 1300</p>-->

                    <!--                            <p class="theme-search-results-item-price-sign txt-center">per month</p>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                    </div>-->

                    <!--                  </div>-->

                    <!--                </div>-->

                    <!--              </div>-->

                    <!--              <div class="theme-search-results-mobile-filters" id="mobileFilters">-->

                    <!--                <a class="theme-search-results-mobile-filters-btn magnific-inline" href="#MobileFilters">-->

                    <!--                  <i class="fa fa-filter"></i>Filters-->

                    <!--                </a>-->

                    <!--                <div class="magnific-popup mfp-hide" id="MobileFilters">-->

                    <!--                  <div class="theme-search-results-sidebar">-->

                    <!--                    <div class="theme-search-results-sidebar-sections">-->

                    <!--                      <!--<div class="theme-search-results-sidebar-section">-->

                    <!--                        <h5 class="theme-search-results-sidebar-section-title">Price</h5>-->

                    <!--                        <div class="theme-search-results-sidebar-section-price">-->

                    <!--                          <input id="price-slider-mob" name="price-slider" data-min="100" data-max="500"/>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                      -->

                    <!--                      <div class="theme-search-results-sidebar-section">-->

                    <!--                        <h5 class="theme-search-results-sidebar-section-title">Passengers</h5>-->

                    <!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->

                    <!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">1 to 2 passengers</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">270</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">3 to 5 passengers</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">107</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">6 or more</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">123</span>-->

                    <!--                            </div>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                      <div class="theme-search-results-sidebar-section">-->

                    <!--                        <h5 class="theme-search-results-sidebar-section-title">Bags</h5>-->

                    <!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->

                    <!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">1 to 2 bags</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">109</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">3 to 4 bags</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">389</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">5 or more</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">370</span>-->

                    <!--                            </div>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                      <div class="theme-search-results-sidebar-section">-->

                    <!--                        <h5 class="theme-search-results-sidebar-section-title">Car Type</h5>-->

                    <!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->

                    <!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Small</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">250</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Large</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">302</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Medium</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">377</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">SUV</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">347</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Van</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">351</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Commercial</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">333</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Luxury</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">421</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Pickup truck</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">474</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Convertable</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">345</span>-->

                    <!--                            </div>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                      <div class="theme-search-results-sidebar-section">-->

                    <!--                        <h5 class="theme-search-results-sidebar-section-title">Payment Type</h5>-->

                    <!--                        <div class="theme-search-results-sidebar-section-checkbox-list">-->

                    <!--                          <div class="theme-search-results-sidebar-section-checkbox-list-items">-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Pay now</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">454</span>-->

                    <!--                            </div>-->

                    <!--                            <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">-->

                    <!--                              <label class="icheck-label">-->

                    <!--                                <input class="icheck" type="checkbox"/>-->

                    <!--                                <span class="icheck-title">Pay at counter</span>-->

                    <!--                              </label>-->

                    <!--                              <span class="theme-search-results-sidebar-section-checkbox-list-amount">340</span>-->

                    <!--                            </div>-->

                    <!--                          </div>-->

                    <!--                        </div>-->

                    <!--                      </div>-->

                    <!--                      -->

                    <!--                    </div>-->

                    <!--                  </div>-->

                    <!--                </div>-->

                    <!--              </div>-->

                </div>

                <!--                <div data-gutter="3" id="load_data_message">-->

                <!--                    --><?php

                //

                //                    if ( $totalItems > 3 )

                //                    { ?>

                <!---->

                <!--                        <a class="btn _tt-uc _fs-sm _mt-10 btn-white btn-block btn-lg" href="#">Load More Results</a>-->

                <!--                    --><?php //} ?>

                <!---->

                <!--                </div>-->



            </div>

            <div class="col-md-3">

                <div class="sticky-col">





                    <div class="theme-sidebar-section _mb-10">

                        <?php include "inc_corporate_sidebar.php";?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>





<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>



<script>





</script>



</body>

</html>