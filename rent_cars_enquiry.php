<?php include "inc_opendb.php";

$PAGEID = "Rent Cars Enquiry";

//echo "<pre>";
//echo print_r( $_POST );
//echo "</pre>";

$slug = filter_var($_GET['slug'],FILTER_SANITIZE_STRING);

if ( empty( $slug ) ) {
    header( "location:rent-cars" );
    exit();
}


$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE slug = ?s AND active = 1", $slug);

$rentCarRow     = mysqli_fetch_assoc( $rentCarResult );


$carTitle = $rentCarRow['carTitle'];


?>

<!DOCTYPE HTML>

<html lang="en">

<head>

    <meta charset="UTF-8"/>

    <?php include 'inc_metadata.php'; ?>

</head>

<body>

<?php include 'inc_header.php'; ?>

<?php

$pageID = '33';

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





                <form id="rentCarsEnquiryForm" name="rentCarsEnquiryForm" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="carTitle" id="carTitle" value="<?php echo $carTitle; ?>"/>

                    <div class="theme-payment-page-sections-item">

                        <h3 class="theme-payment-page-sections-item-title">Send Us Your Enquiry</h3>

                        <div class="theme-payment-page-form">

                            <div class="row row-col-gap" data-gutter="20">

                                <div class="col-md-6 ">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" id="fullName"  required name="fullName" placeholder="Name"/>

                                    </div>

                                </div>

                                <div class="col-md-6 ">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" id="companyName"  name="companyName" placeholder=" Company Name" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 ">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="email" id="email"  name="email" placeholder="Email Address" required/>

                                    </div>

                                </div>

                                <div class="col-md-6 ">

                                    <div class="theme-payment-page-form-item form-group">

                                        <input class="form-control" type="text" id="phone"  name="phone" placeholder="Phone Number" required onkeypress="return isNumberKey(event)"/>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="theme-payment-page-sections-item">



                        <div class="theme-payment-page-form _mb-20">



                            <div class="row row-col-gap" data-gutter="20">


                                <div class="col-md-12 ">

                                    <div class="form-group theme-contact-form-group">

                                        <textarea class="form-control" rows="5" id="specialRequirement" required name="specialRequirement" placeholder="Specific Requirement"></textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="theme-payment-page-form _mb-20">

                            <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div><br>

                            <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">

                        </div>

                    </div>

                    <div class="theme-payment-page-sections-item">

                        <div class="theme-payment-page-booking">

                            <input type="submit" class="btn _tt-uc btn-primary-inverse btn-lg btn-block" id="rentCarsEnquiry-btn" name="corporateLeasing-btn" value="Submit" />

                        </div>

                    </div>



                </form>

                <br>

                <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>

                <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>












<!--                <div class="theme-item-page-details _pv-45 theme-item-page-details-first-nm">-->
<!---->
<!--                    <div class="theme-item-page-details-section">-->
<!---->
<!--                        <div class="row">-->
<!---->
<!--                            --><?php
//
//                            $result = $db->query("SELECT * FROM corporate_leasing");
//
//                            $row = mysqli_fetch_assoc($result);
//
//                            ?>
<!---->
<!---->
<!---->
<!--                            <div class="theme-item-page-desc">-->
<!---->
<!--                                --><?php //echo $row['description'];?>
<!---->
<!--                            </div>-->
<!---->
<!---->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->

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