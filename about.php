<?php include "inc_opendb.php";

$PAGEID = "About";

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

      $pageID = '1';

      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);

      $row = mysqli_fetch_assoc($result);

      ?>

      <div class="theme-hero-area theme-hero-area-half">

      <div class="theme-hero-area-bg-wrap">

        <div class="theme-hero-area-bg" style="background-image:url('uploads/pages/journey.jpg')"></div>

        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>

        <div class="theme-hero-area-inner-shadow"></div>

      </div>

      <div class="theme-hero-area-body">

        <div class="container">

          <div class="row">

            <div class="col-md-8 theme-page-header-abs">

              <div class="theme-page-header theme-page-header-lg">

                <h1 class="theme-page-header-title"><?php echo $row['pageTitle'];?></h1>

                <p class="theme-page-header-subtitle"><?php echo $row['subTitle']; ?></p>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

      <div class="theme-page-section theme-page-section-x-x-l theme-page-section-gray">

      <div class="container">

        <div class="theme-page-section-header">

            <?php echo $row['summary']; ?>

        </div>

        <div class="row row-col-gap" data-gutter="30">



            <?php

            $result = $db->query("SELECT * FROM about_us WHERE active = 1 ORDER BY so ASC");

            while ($row = mysqli_fetch_assoc($result)) {

                ?>

                <div class="col-md-4 ">

            <div class="banner _h-45vh _br-4 _bsh-xl _bsh-light banner-animate banner-animate-zoom-in banner-animate-very-slow">

              <div class="banner-bg"

                   style="background-image:url(uploads/pages/<?php echo $row['image'];?>);"></div>

            

              <div class="banner-caption _ph-20 _pv-15 _bg-w banner-caption-bottom banner-caption-dark">

                <h4 class="banner-title about-title"><?php echo $row['title']; ?></h4><br>

                <p class="banner-subtitle _mt-5 _fw-n about-subtitle black-text"><?php echo $row['summary']; ?></p>

              </div>

            </div>

          </div>

                <?php

            }

          ?>

          

          

          

          

          

        </div>

      </div>

    </div>

<div class="theme-hero-area">

      <div class="theme-hero-area-bg-wrap">

        <div class="theme-hero-area-bg" style="background-image:url(img/plate-flight-sky-sunset_1500x801.jpg);"></div>

        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>

      </div>

      <div class="theme-hero-area-body">

        <div class="theme-page-section theme-page-section-xxl">

          <div class="container">

            <div class="row row-col-mob-gap">

<?php

$result = $db->query("SELECT * FROM about_stats WHERE active = 1 ORDER BY so ASC");

while ($row = mysqli_fetch_assoc($result)) {

    ?>

    <div class="col-md-3">

                <div class="feature _br-5 _bsh-xl _bsh-light feature-wrap-fade-white feature-center">

                  <i class="feature-icon feature-icon-primary-inverse feature-icon-box feature-icon-round <?php echo $row['icon']; ?>"></i>

                  <div class="feature-caption _c-w">

                    <h5 class="feature-title"><?php echo $row['title']; ?></h5>

                    <p class="feature-subtitle"><?php echo $row['summary']; ?></p>

                  </div>

                </div>

              </div>

    <?php

}

                ?>

            </div>

          </div>

        </div>

      </div>

    </div>





      <?php

      $countResult = $db->query("SELECT * FROM team WHERE active = 1 ORDER BY so ASC");

      $counter = mysqli_num_rows($countResult);

      if($counter > 1)

      {

      ?>



 <div class="theme-page-section _pb-0 theme-page-section-xxl">

      <div class="container">

          <div class="theme-page-section-header">

              <?php

              $pageID = '2';

              $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);

              $row = mysqli_fetch_assoc($result);

              ?>

          <h5 class="theme-page-section-title"><?php echo $row['pageTitle']; ?></h5>

              <p class="theme-page-section-subtitle"><?php echo $row['subTitle']; ?></p>

          </div>

        <div class="row row-col-mob-gap" data-gutter="20">

<?php

$result = $db->query("SELECT * FROM team WHERE active = 1 ORDER BY so ASC");

while ($row = mysqli_fetch_assoc($result)) {

?>



          <div class="col-md-4 ">

            <div class="banner _br-5 _bsh-xl _bsh-light banner-animate banner-animate-zoom-in">

              <img class="banner-img" src="uploads/team/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>"/>

              

              <div class="banner-caption _bg-p _p-15 _pos-h-c _w-66pct _mb-30 _ta-c _br-3 banner-caption-bottom">

                <h5 class="banner-title"><?php echo $row['title']; ?></h5>

                

              </div>

            </div>

          </div>

    <?php

}

?>

        </div>

      </div>

    </div>

     <br><br>

<?php } ?>

      <?php include 'inc_footer.php'; ?>

      <?php include 'inc_footer_scripts.php'; ?>

   </body>

</html>