<?php include "inc_opendb.php";
$PAGEID = "Promotions";
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
      $pageID = '8';
      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s", $pageID);
      $row = mysqli_fetch_assoc($result);
      ?>
      <div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg"
             style="background-image:url('uploads/pages/<?php echo $row['headerBG']; ?>');"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title"><?php echo $row['pageTitle']; ?></h1>
                <p class="theme-page-header-subtitle"><?php echo $row['subTitle']; ?></p>
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
            <div class="theme-page-section-header"></div>
            <div class="row row-col-gap"
                 data-gutter="10">
            <?php

            $i = 0;
            $promotionResult = $db->query("SELECT * FROM promotions WHERE active = 1 ORDER BY so ASC");
            while ($promotionRow = mysqli_fetch_assoc($promotionResult)) {
                $i++;
                if ($i == 1)
                {
                    ?>
                    <div class="col-md-4 ">
                        <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                          <div class="banner-bg"
                               style="background-image:url('uploads/promotions/<?php echo $promotionRow['image'];?>');"></div>
                          <div class="banner-mask"></div>
<!--                          <a class="banner-link" href="#"></a>-->
                          <div class="banner-caption banner-caption-bottom banner-caption-grad">
                            <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                            <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                          </div>
                        </div>
                    </div>
                    <?php
                }
                if ($i == 2) {
                    ?>
                    <div class="col-md-8 ">
                        <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                          <div class="banner-bg"
                               style="background-image:url('uploads/promotions/<?php echo $promotionRow['image'];?>');"></div>
                          <div class="banner-mask"></div>
<!--                          <a class="banner-link" href="#"></a>-->
                          <div class="banner-caption banner-caption-bottom banner-caption-grad">
                            <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                            <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                          </div>
                        </div>
                    </div>
                    <?php
                }
                if ($i == 3) {
                    ?>
                    <div class="col-md-3 ">
                        <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                          <div class="banner-bg"
                               style="background-image:url('uploads/promotions/<?php echo $promotionRow['image'];?>');"></div>
                          <div class="banner-mask"></div>
                          <a class="banner-link"
                             href="#"></a>
                          <div class="banner-caption banner-caption-bottom banner-caption-grad">
                            <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                            <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                          </div>
                        </div>
                    </div>
                    <?php
                }
                if ($i == 4) {
                    ?>
                    <div class="col-md-6 ">
                        <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                          <div class="banner-bg"
                               style="background-image:url('uploads/promotions/<?php echo $promotionRow['image'];?>');"></div>
                          <div class="banner-mask"></div>
<!--                          <a class="banner-link" href="#"></a>-->
                          <div class="banner-caption banner-caption-bottom banner-caption-grad">
                            <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                            <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                          </div>
                        </div>
                    </div>
                    <?php
                }
                if ($i == 5) {
                    ?>
                    <div class="col-md-3 ">
                        <div class="banner _h-40vh banner-animate banner-animate-mask-in">
                          <div class="banner-bg"
                               style="background-image:url('uploads/promotions/<?php echo $promotionRow['image'];?>');"></div>
                          <div class="banner-mask"></div>
<!--                          <a class="banner-link"  href="#"></a>-->
                          <div class="banner-caption banner-caption-bottom banner-caption-grad">
                            <h5 class="banner-title"><?php echo $promotionRow['title']; ?></h5>
                            <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                          </div>
                        </div>
                    </div>
                    <?php
                }
                 ?>

                        <?php
            }

            ?>

            </div>
          </div>
        </div>
      </div>
    </div>
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
   </body>
</html>