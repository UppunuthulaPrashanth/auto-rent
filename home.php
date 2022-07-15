<?php include "inc_opendb.php";

$PAGEID = "Home";


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

<!--latest deals-->
<?php include 'inc_home_deals-2.php'; ?>
<!--latest deals-->


<?php //include 'inc_home_howitworks.php'; ?>

<!--why autorent-->
<?php include 'inc_home_features-1.php'; ?>
<!--why autorent-->



<?php include 'inc_car_hire.php'; ?>





<?php include 'inc_home_deals.php'; ?>



<?php // include 'inc_home_specials.php'; ?>

<?php //include 'inc_home_blog.php'; ?>





<?php //include 'inc_home_app.php'; ?>



<div class="row _pv-40" data-gutter="0">



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


<!--document requirement-->

<?php include  'inc_document_required.php'?>

<!--document requirement-->


<?php include "inc_faq.php" ?>




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

<script>
console.log(moment().add('d', 1).toDate());
    /*$('#dropDate').datetimepicker({
        minDate: moment().add('d', 1).toDate(),
        stepping: 30,
        showClose: true,
        disabledHours: [0, 1, 2, 3, 4, 5, 6, 7,8,9,20, 21, 22, 23, 24]
    }).on('dp.change', function(e) {
        if (e.date) {
            e.date.add(1, 'day');
        }
        // });
    }).data("DateTimePicker").date(moment().add('d', 30).toDate());
	//}).data("DateTimePicker").date();*/

</script>

</body>

</html>