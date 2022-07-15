<?php include "inc_opendb.php";
$PAGEID = "Rental Guide Info";

$slug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING);
if (empty($slug)) {
    header("location:/");
    exit();
}

$rentalRes = $db->query("SELECT * FROM rental_guide WHERE slug = ?s", $slug);
$rentalRow = mysqli_fetch_assoc($rentalRes);

$title   = $rentalRow['title'];
$rentalSubTitle   = $rentalRow['subTitle'];
$headerImage   = $rentalRow['headerImage'];
$description   = $rentalRow['description'];


?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php'; ?>


<div class="theme-hero-area theme-hero-area-half">
    <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url('uploads/rental_guide/<?php echo $headerImage?>');"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
    </div>
    <div class="theme-hero-area-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 theme-page-header-abs">
                    <div class="theme-page-header theme-page-header-lg">
                        <h1 class="theme-page-header-title"><?php echo $title;?></h1>
                        <p class="theme-page-header-subtitle"><?php echo $rentalSubTitle;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="theme-page-section _pv-0">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row row-col-static row-eq-height row-col-border" id="sticky-parent" data-gutter="60">
                    <div class="col-md-8 ">
                        <div class="theme-item-page-details _pv-45 theme-item-page-details-first-nm">
                            <div class="theme-item-page-details-section">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="theme-item-page-desc">
                                            <?php echo $description;?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="sticky-col _pv-45 _mob-h">
                            <div class="theme-search-area theme-search-area-vert">
                                <?php
                                $pageID = '15';
                                $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                                    <h1 class="theme-search-area-title black-text"><?php echo $row['pageTitle'];?></h1>
                                    <p class="theme-search-area-subtitle black-text"><?php echo $row['subTitle'];?></p>
                                </div>
                                <div class="theme-search-area-form">
                                    <form id="enquiryForm" method="post">
                                        <div class="row" data-gutter="10">
                                            <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                                                <div class="theme-search-area-section-inner">
                                                    <i class="theme-search-area-section-icon lin lin-user"></i>
                                                    <input class="theme-search-area-section-input" name="fullname" id="fullname" type="text" placeholder="Full Name" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" data-gutter="10">
                                            <div class="theme-search-area-section theme-search-area-section-sm theme-search-area-section-curved">
                                                <div class="theme-search-area-section-inner">
                                                    <i class="theme-search-area-section-icon lin lin-envelope"></i>
                                                    <input class="theme-search-area-section-input" name="email" id="email" type="email" placeholder="Email" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" data-gutter="10">
                                            <div class="theme-payment-page-form-item form-group">
                                                <i class="fa fa-angle-down"></i>
                                                <select class="form-control" id="service" name="service" required>
                                                    <option value="" selected disabled>Service</option>
                                                    <option value="Car Rental">Car Rental</option>
                                                    <option value="Car Leasing">Car Leasing</option>
                                                    <option value="Flexiplans">Flexiplans</option>
                                                    <option value="Transportation">Transportation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row" data-gutter="10">
                                            <div class="form-group theme-contact-form-group">
                                                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"></textarea>
                                            </div>
                                        </div>

                                        <div class="row" data-gutter="10">
                                            <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div><br>
                                            <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
                                        </div>

                                        <hr>

                                        <button type="submit" id="enquiry-btn" class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Book Now</button>
                                    </form>
                                    <br>
                                    <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
                                    <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
                                </div>

                            </div>
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