<?php include "inc_opendb.php";
$PAGEID = "Cancel Booking";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <?php $page_id = "page_base_a"; ?>
    <?php $page_title = "Add Extras"; ?>
    <?php $page_keywords = "Website Keywords"; ?>
    <?php $page_description = "Website Description"; ?>
    <meta charset="UTF-8"/>
    <?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php'; ?>



<div class="theme-hero-area">
    <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel-1.png);"></div>
        <div class="theme-hero-area-grad-mask"></div>
    </div>
    <div class="theme-hero-area-body">
        <div class="container">
            <div class="row _pv-60">
                <div class="col-md-9 ">
                    <div class="_mob-h">
                        <div class="theme-hero-text theme-hero-text-white">
                            <div class="">
                                <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Cancel Booking Details</h2>
                            </div>
                        </div>

                    </div>
                    <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                        <h4 class="theme-search-area-inline-title">Dubai </h4>
                        <p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>
                        <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal">
                            <i class="fa fa-pencil"></i>Modify
                        </a>
                        <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
                            <div class="theme-search-area theme-search-area-vert">
                                <div class="theme-search-area-header">
                                    <h1 class="theme-search-area-title theme-search-area-title-sm">Modify</h1>
                                    <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                                </div>
                                <div class="theme-search-area-form">
                                    <div>
                                        <label class="theme-search-area-section-label">Pick Up Information</label>
                                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">

                                            <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                                <i class="fa fa-angle-down"></i>
                                                <select class="form-control">
                                                    <option>City</option>
                                                    <option>Abu-Dhabi</option>


                                                    <option>Dubai</option>
                                                    <option>Ras Al Khaimah</option>
                                                    <option>Sharjah</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">

                                            <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                                <i class="fa fa-angle-down"></i>
                                                <select class="form-control">
                                                    <option>Location</option>
                                                    <option>Oud Metha</option>
                                                    <option>Al Mamzar</option>
                                                    <option>Al Qouz</option>

                                                </select>
                                            </div>
                                        </div>



                                        <div class="theme-search-area-section theme-search-area-section-curved">

                                            <div class="theme-search-area-section-inner">
                                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                                <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Date & Time"/>
                                                <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
                                            </div>
                                        </div>


                                    </div>
                                    <div>
                                        <label class="theme-search-area-section-label">Drop Off Information</label>
                                        <div class="checkbox theme-search-results-sidebar-section-checkbox-list-item">
                                            <label class="icheck-label">
                                                <input class="icheck" type="checkbox"/>
                                                <span class="icheck-title">Return Car to different location</span>
                                            </label>

                                        </div>
                                        <br>
                                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">

                                            <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                                <i class="fa fa-angle-down"></i>
                                                <select class="form-control">
                                                    <option>City</option>
                                                    <option>Abu-Dhabi</option>


                                                    <option>Dubai</option>
                                                    <option>Ras Al Khaimah</option>
                                                    <option>Sharjah</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">

                                            <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">
                                                <i class="fa fa-angle-down"></i>
                                                <select class="form-control">
                                                    <option>Location</option>
                                                    <option>Oud Metha</option>
                                                    <option>Al Mamzar</option>
                                                    <option>Al Qouz</option>

                                                </select>
                                            </div>
                                        </div>



                                        <div class="theme-search-area-section theme-search-area-section-curved">

                                            <div class="theme-search-area-section-inner">
                                                <i class="theme-search-area-section-icon lin lin-calendar"></i>
                                                <input class="theme-search-area-section-input datePickerStart _mob-h" type="text" placeholder="Date & Time"/>
                                                <input class="theme-search-area-section-input _desk-h mobile-picker" type="date"/>
                                            </div>
                                        </div>


                                    </div>
                                    <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="theme-page-section theme-page-section-lg">
    <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
            <div class="col-md-12 ">
                <div class="theme-payment-page-sections">


                    <div class="row" style="margin-bottom: 300px">
                        <div class="col-md-12">
                            <p class="checkout-sub" style="font-size: 40px;text-align: center; margin-top: 150px">Your booking has been cancelled.</p>
                        </div>
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