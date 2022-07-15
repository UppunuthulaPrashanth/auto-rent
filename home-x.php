<?php include "inc_opendb.php";

$PAGEID = "Home";

//

//echo '<pre>';

//print_r($_SESSION);

//echo '</pre>';

?>

<!DOCTYPE HTML>

<html lang="en">

<head>

	<meta charset="UTF-8"/>

	<?php include 'inc_metadata.php'; ?>

</head>

<body>

<?php include 'inc_header.php'; ?>

<?php include 'inc_home_slider.php'; ?>


<?php include 'inc_home_howitworks.php'; ?>




<div class="theme-page-section theme-page-section-xxl">

    <div class="container">

        <div class="theme-page-section-header">

            <?php

            $pageID = '25';

            $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

            $row    = mysqli_fetch_assoc( $result );

            ?>

            <h5 class="theme-page-section-title"><?php echo $row['pageTitle'] ?></h5>

            <p class="theme-page-section-subtitle"><?php echo $row['subTitle']; ?></p>

        </div>

        <div class="row row-col-mob-gap" data-gutter="10">

            <?php

            $hireResult = $db->query( "SELECT * FROM car_hire WHERE active = 1 ORDER BY so ASC limit 3 " );

            while ( $hireRow = mysqli_fetch_assoc( $hireResult ) )

            {

                ?>

                <div class="col-md-4 ">

                    <div class="banner _br-5 banner-animate banner-animate-mask-in banner-animate-zoom-in">

                        <img class="banner-img" src="uploads/car_hire/<?php echo $hireRow['homeImage']; ?>" alt="<?php echo $hireRow['title']; ?>" title="<?php echo $hireRow['title']; ?>"/>

                        <div class="banner-mask"></div>

                        <a class="banner-link" href="<?php echo $hireRow['linkTo']; ?>"></a>

                        <div class="banner-caption _ta-c _pb-20 _pt-20 banner-caption-bottom banner-caption-grad">

                            <h4 class="banner-title _fs"><?php echo $hireRow['title']; ?></h4>

                            <p class="banner-subtitle _fw-n _mt-5"><?php echo $hireRow['summary']; ?></p>

                        </div>

                    </div>

                </div>

                <?php

            }

            ?>



        </div>

    </div>

</div>





<div class="theme-page-section theme-page-section-xxl ">
    <div class="container">
        <div class="theme-page-section-header">
            <h5 class="theme-page-section-title theme-page-section-title-lg">Deals of the week</h5>

            <p class="theme-page-section-subtitle">Our latest travel tips, hacks and insights</p>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
            <div class="owl-carousel" data-items="3" data-loop="true" data-nav="true">

                <?php
                $weeklyResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 AND weeklyDeals = 1" );
                while ( $weeklyRow = mysqli_fetch_assoc( $weeklyResult ) )
                {
                    ?>
                    <div class="theme-inline-slider-item">
                        <div class="theme-blog-item theme-blog-item-white">
                            <a class="theme-blog-item-link" href="book-rent-cars/<?php echo $weeklyRow['slug']?>"></a>
                            <div class="banner _h-40vh _br-3 banner-">
                                <div class="banner-bg weekly-deals-img" style="background-image:url('uploads/rentlease/<?php echo $weeklyRow['image']?>');"></div>
                                <div class="banner-caption banner-caption-bottom banner-caption-">
                                    <h5 class="theme-blog-item-title"><?php echo $weeklyRow['carTitle']?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>





<?php include 'inc_home_deals.php'; ?>



<?php // include 'inc_home_specials.php'; ?>

<?php //include 'inc_home_blog.php'; ?>

<?php include 'inc_home_features-1.php'; ?>



<?php //include 'inc_home_app.php'; ?>



<div class="row" data-gutter="0">



    <?php

    $rentalResult = $db->query("SELECT * FROM rental_guide WHERE active = 1 ORDER BY so ASC");

    while ($rentalRow = mysqli_fetch_assoc($rentalResult)) {

    ?>

    <div class="col-md-3 ">

		<div class="banner banner-animate banner-animate-mask-out">

			<img class="banner-img" src="uploads/rental_guide/<?php echo $rentalRow['image'];?>" alt="<?php echo $rentalRow['title'];?>" title="<?php echo $rentalRow['title'];?>">



			<a class="banner-link" href="/rental-guide/<?php echo $rentalRow['slug'];?>"></a>

			<div class="banner-caption _ta-c banner-caption-bottom banner-caption-grad">

				<h5 class="banner-title"><?php echo $rentalRow['title'];?></h5>

				<p class="banner-subtitle"><?php echo $rentalRow['subTitle'];?></p>

			</div>

		</div>

	</div>

    <?php

    }

    ?>



</div>





    <div class="theme-page-section theme-page-section-xl">
        <div class="container">
        <div class="_mob-h">
            <div class="theme-page-section-header">



                <h5 class="theme-page-section-title">Documents Required for Car Rental in the UAE</h5>

                <p class="theme-page-section-subtitle">If you’re planning a trip to the UAE you’ll find that all major attractions in the UAE are spread far and wide. From unique shopping destinations like the Mall Of The Emirates in Dubai, popular landmarks such as the Sheikh Zayed Grand Mosque in Abu Dhabi to exquisite hotels and resorts located in Ras Al Khaimah, the best way to get around is by car. You are eligible to rent a car across the emirates provided you have the below mentioned documents valid with you:</p>

            </div>

        <div class="col-md-6">
            <div class="theme-search-results-item _mb-10 theme-search-results-item-">
                <div class="theme-search-results-item-preview">
                    <a class="theme-search-results-item-mask-link" href="#"></a>
                    <div class="row" data-gutter="20">
                        <div class="col-md-6 ">
                            <div class="theme-search-results-item-img-wrap">
                                <img class="theme-search-results-item-img" src="data/image-car-resident.jpg" alt="" title=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="theme-search-results-item-title theme-search-results-item-title-lg">For UAE Residents</h5>
<!--                            <div class="theme-search-results-item-car-location">-->
<!--                                <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>-->
<!--                                <div class="theme-search-results-item-car-location-body">-->
<!--                                    <p class="theme-search-results-item-car-location-title">LaGuardia Airport International Airport</p>-->
<!--                                    <p class="theme-search-results-item-car-location-subtitle">Shuttle to car</p>-->
<!--                                </div>-->
<!--                            </div>-->
                            <ul class="theme-search-results-item-car-list">
                                <li>
                                    <i class="fa fa-check"></i>UAE Driving License
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>Emirates ID
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>Credit Card
                                </li>
                                <li>
                                    <i class="fa fa-check"></i>Address Proof (Dewa Bill/Telephone Bill/Company Address)
                                </li>
                                <li>
                                    <i class="fa fa-check"></i> (Residential Visa may be acceptable)
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-6">
                <div class="theme-search-results-item _mb-10 theme-search-results-item-">
                    <div class="theme-search-results-item-preview">
                        <a class="theme-search-results-item-mask-link" href="#"></a>
                        <div class="row" data-gutter="20">
                            <div class="col-md-6 ">
                                <div class="theme-search-results-item-img-wrap">
                                    <img class="theme-search-results-item-img" src="data/image-car-tourist.jpg" alt="" title=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="theme-search-results-item-title theme-search-results-item-title-lg">For Tourists visiting the UAE</h5>

                                <ul class="theme-search-results-item-car-list">
                                    <li>
                                        <i class="fa fa-check"></i>Passport
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>Valid Visit Visa
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>Credit Card
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>Home Country Driving License
                                    </li>
                                    <li>
                                        <i class="fa fa-check"></i>International Driving Permit (IDP)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>




<div class="theme-page-section  theme-page-section-lg" style="background:#f7f7f7">

	<div class="container">

		<div class="row">

			<div class="theme-page-section-header">



				<h5 class="theme-page-section-title">FAQs</h5>

				<p class="theme-page-section-subtitle">Enhance your rental experience with us !</p>

			</div>

			<div class="col-md-12 ">



				<div class="row">

					<div class="col-md-8 ">

						<div class="theme-account-preferences">

							<?php

							$i      = 0;

							$result = $db->query( "SELECT * FROM faqs WHERE active = 1 ORDER BY so ASC" );

							while ( $row = mysqli_fetch_assoc( $result ) )

							{

								$i ++;

								?>

								<div class="theme-account-preferences-item">

									<div class="row">

										<div class="col-md-10 ">

											<a class="" href="#faq<?php echo $i; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="faq">

											<p class="theme-account-preferences-item-value faq-ques"><?php echo $row['question']; ?></p></a>

											<div class="collapse" id="faq<?php echo $i; ?>">

												<div class="theme-account-preferences-item-change">

													<div class="row">

														<div class="col-md-12 faq-ans">

															<p class="theme-account-preferences-item-value ">

																<?php echo $row['answer']; ?>

															</p>

														</div>



													</div>

												</div>

											</div>

										</div>

										<div class="col-md-2 ">

											<a class="theme-account-preferences-item-change-link" href="#faq<?php echo $i; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="faq"> <i class="fa fa-chevron-down"></i> </a>

										</div>

									</div>

								</div>

							<?php } ?>





						</div>

					</div>





					<div class="col-md-4 ">

						<div class="sticky-col">





							<div class="theme-sidebar-section _mb-10">

								<ul class="theme-sidebar-section-features-list"><?php

									$pageID = '11';

									$result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

									$row    = mysqli_fetch_assoc( $result );

									?>

									<li>

										<h4><?php echo $row['pageTitle']; ?></h4>

										<h5 class="theme-sidebar-section-features-list-title"><?php echo $row['subTitle'] ?></h5>

										<p class="theme-sidebar-section-features-list-body">

											<?php echo $row['summary']; ?>

										</p><br/> <a class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="link-btn" href="/about"> About Us </a>

									</li>



								</ul>

							</div>

						</div>

					</div>





				</div>

			</div>

		</div>

	</div>

</div>



<?php include "inc_news.php" ?>






<!--<div class="theme-page-section theme-page-section-xxl">-->
<!---->
<!--    <div class="container">-->
<!---->
<!--        <div class="theme-page-section-header">-->
<!---->
<!--            <h5 class="theme-page-section-title theme-page-section-title-lg">Blog</h5>-->
<!---->
<!--            <p class="theme-page-section-subtitle">Our latest travel tips, hacks and insights</p>-->
<!---->
<!--        </div>-->
<!---->
<!--        <div class="theme-inline-slider row" data-gutter="10">-->
<!---->
<!--            <div class="owl-carousel" data-items="4" data-loop="true" data-nav="true">-->
<!---->
<!--                <div class="theme-inline-slider-item">-->
<!---->
<!--                    <div class="theme-blog-item _br-4 theme-blog-item-full">-->
<!---->
<!--                        <a class="theme-blog-item-link" href="blog-info"></a>-->
<!---->
<!--                        <div class="banner _h-45vh  banner-">-->
<!---->
<!--                            <div class="banner-bg" style="background-image:url(img/city-sun-hot-child_350x260.jpg);"></div>-->
<!---->
<!--                            <div class="banner-caption banner-caption-bottom banner-caption-grad">-->

<!--                                <p class="theme-blog-item-time">day ago</p>-->

<!--                                <h5 class="theme-blog-item-title">Booking hotel in India</h5>-->

<!--                                <p class="theme-blog-item-desc">Rhoncus congue magna faucibus accumsan per cum eu massa quis</p>-->

<!--                            </div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="theme-inline-slider-item">-->
<!---->
<!--                    <div class="theme-blog-item _br-4 theme-blog-item-full">-->
<!---->
<!--                        <a class="theme-blog-item-link" href="blog-info"></a>-->
<!---->
<!--                        <div class="banner _h-45vh  banner-">-->
<!---->
<!--                            <div class="banner-bg" style="background-image:url(img/man-wearing-black-and-red-checkered_350x435.jpg);"></div>-->
<!---->
<!--                            <div class="banner-caption banner-caption-bottom banner-caption-grad">-->

<!--                                <p class="theme-blog-item-time">week ago</p>-->

<!--                                <h5 class="theme-blog-item-title">Total Solar Eclipse</h5>-->

<!--                                <p class="theme-blog-item-desc">Cras potenti in blandit libero vehicula hac aptent inceptos porta</p>-->

<!--                            </div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="theme-inline-slider-item">-->
<!---->
<!--                    <div class="theme-blog-item _br-4 theme-blog-item-full">-->
<!---->
<!--                        <a class="theme-blog-item-link" href="blog-info"></a>-->
<!---->
<!--                        <div class="banner _h-45vh  banner-">-->
<!---->
<!--                            <div class="banner-bg" style="background-image:url(img/lights_350x260.jpg);"></div>-->
<!---->
<!--                            <div class="banner-caption banner-caption-bottom banner-caption-grad">-->

<!--                                <p class="theme-blog-item-time">2 weeks ago</p>-->

<!--                                <h5 class="theme-blog-item-title">Lights of Venice</h5>-->

<!--                                <p class="theme-blog-item-desc">Semper integer vivamus auctor amet sodales id facilisis orci faucibus</p>-->

<!--                            </div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="theme-inline-slider-item">-->
<!---->
<!--                    <div class="theme-blog-item _br-4 theme-blog-item-full">-->
<!---->
<!--                        <a class="theme-blog-item-link" href="blog-info"></a>-->
<!---->
<!--                        <div class="banner _h-45vh  banner-">-->
<!---->
<!--                            <div class="banner-bg" style="background-image:url(img/man_back_350x260.jpg);"></div>-->
<!---->
<!--                            <div class="banner-caption banner-caption-bottom banner-caption-grad">-->

<!--                                <p class="theme-blog-item-time">2 weeks ago</p>-->

<!--                                <h5 class="theme-blog-item-title">Alaska days</h5>-->

<!--                                <p class="theme-blog-item-desc">Praesent ipsum justo dui primis laoreet tincidunt tempor praesent in</p>-->

<!--                            </div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="theme-inline-slider-item">-->
<!---->
<!--                    <div class="theme-blog-item _br-4 theme-blog-item-full">-->
<!---->
<!--                        <a class="theme-blog-item-link" href="blog-info"></a>-->
<!---->
<!--                        <div class="banner _h-45vh  banner-">-->
<!---->
<!--                            <div class="banner-bg" style="background-image:url(img/plate-flight-sky-sunset_350x435.jpg);"></div>-->
<!---->
<!--                            <div class="banner-caption banner-caption-bottom banner-caption-grad">-->

<!--                                <p class="theme-blog-item-time">mounth ago</p>-->

<!--                                <h5 class="theme-blog-item-title">Mix up your cabin classes</h5>-->

<!--                                <p class="theme-blog-item-desc">Odio suspendisse congue aliquam vehicula nam vivamus fames nulla id</p>-->

<!--                            </div>-->
<!---->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--</div>-->









<?php //include 'inc_footer-r2.php'; ?>

<?php include 'inc_footer.php'; ?>

<?php include 'inc_footer_scripts.php'; ?>



</body>

</html>