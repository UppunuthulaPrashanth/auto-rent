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
            <div class="row row-col-gap " data-gutter="10">
                <div class='grid'>
                <?php

                $i = 0;
                $promotionResult = $db->query("SELECT * FROM promotions WHERE active = 1 ORDER BY so ASC");
                while ($promotionRow = mysqli_fetch_assoc($promotionResult)) {
                $i++;
                ?>
                    <div class="grid-item">
                <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg"
                       style="background-image:url('uploads/promotions/<?php echo $promotionRow['image']; ?>');"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link"
                     href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                      <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                      <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                  </div>
                </div>
              </div>

                    <div class="grid-item-width2">
                <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                  <div class="banner-bg"
                       style="background-image:url('uploads/promotions/<?php echo $promotionRow['image']; ?>');"></div>
                  <div class="banner-mask"></div>
                  <a class="banner-link"
                     href="#"></a>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                      <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                      <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                  </div>
                </div>
              </div>
                    </div>
                <?php
                }
?>
              <!--<div class="col-md-8 grid-item">
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
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>


      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
      <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
      <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
      <script type="text/javascript">
          $(document).ready(function(){
              $('.grid').masonry({
                  // options
                  itemSelector: '.grid-item',
                  columnWidth: 800
              });
          });
      </script
          <style>
           .grid-item { width: 200px; }
           .grid-item-width2 { width: 400px; }
       </style>
   </body>
</html>