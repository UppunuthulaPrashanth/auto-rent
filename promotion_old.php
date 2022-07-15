<?php include "inc_opendb.php"; ?>
<!DOCTYPE HTML>
<html lang="en">
   <head>
      <?php $page_id = "page_base_b"; ?>
       <?php $page_title = "Special Offers"; ?>
       <?php $page_keywords = "Website Keywords"; ?>
       <?php $page_description = "Website Description"; ?>
       <meta charset="UTF-8"/>
       <?php include 'inc_metadata.php'; ?>
   </head>
   <body>
      <?php include 'inc_header.php'; ?>


      <div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(img/activity-adult-beach-beautiful-378152_1500x800.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title">Special Offers</h1>
                <p class="theme-page-header-subtitle">Best offers in the market </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



     <div class="theme-page-section theme-page-section-xxl">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div class="row row-col-gap grid" data-gutter="10">

              <div class="col-md-4 grid-item">
                <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg" style="background-image:url(img/nissan_sunny_offer.jpg);"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link" href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                    <h5 class="banner-title">Rent for 3 days and Get 4th Day Free</h5>
                    <p class="banner-subtitle">Valid from -xxxx-xxxx</p>
                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-item">
                <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg" style="background-image:url(img/Dream_it.jpg);"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link" href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                    <h5 class="banner-title">Get 20% Discount on Monthly Rental</h5>
                    <p class="banner-subtitle">Valid from -xxxx-xxxx</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-item">
                <div class="banner _h-33vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg" style="background-image:url(img/nissan_path.jpg);"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link" href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                    <h5 class="banner-title">20% off on Nissan Pathfinder on Monthly Rental </h5>
                    <p class="banner-subtitle">Valid from -xxxx-xxxx</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-item">
                <div class="banner _h-33vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg" style="background-image:url(img/teachers_special.jpg);"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link" href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                    <h5 class="banner-title">Special offer for Teachers</h5>
                    <p class="banner-subtitle">Valid from -xxxx-xxxx</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-item">
                <div class="banner _h-33vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg" style="background-image:url(img/patrol.jpg);"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link" href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                    <h5 class="banner-title">Weekend offer on Nissan Safari</h5>
                    <p class="banner-subtitle">Valid from -xxxx-xxxx</p>
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
<script>
    // $('.grid').masonry({
    //     columnWidth: 200,
    //     itemSelector: '.grid-item'
    // });
    document.ready(function(){
        $('.grid').masonry();
    });
</script>
   </body>
</html>