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



     <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="row row-col-gap" data-gutter="20">
<?php
    $myColumn="";
    $i = 0;
    $promotionResult = $db->query("SELECT * FROM promotions WHERE active = 1");
    while ($promotionRow = mysqli_fetch_assoc($promotionResult))
    {
        $i++;
        //echo "<pre>";
        list($width, $height, $type, $attr) = getimagesize('uploads/promotions/'.$promotionRow['image']);
// Displaying dimensions of the image
//        echo "Width of image : " . $width . "<br>";
//        echo "Height of image : " . $height . "<br>";
//        echo "Image type :" . $type . "<br>";
//        echo "Image attribute :" .$attr;
//        echo "</pre>";

       if($width>=200 && $width <=300)
        {
            $myColumn = 'col-md-3';
        }
        elseif($width>300 && $width <=400)
        {
            $myColumn = 'col-md-4';
        }
        elseif($width>400 && $width <=600)
        {
            $myColumn = 'col-md-5';
        }
        elseif($width>601 && $width <700)
        {
            $myColumn = 'col-md-6';
        }
       elseif($width>700 && $width <800)
       {
           $myColumn = 'col-md-7';
       }
        else//if($width>601 && $width < 800)
        {
            $myColumn = 'col-md-8';
        }
        ?>
        <div class="<?php echo $myColumn;?>">
            <div class="theme-blog-item _br-2 theme-blog-item-center">
              <a class="theme-blog-item-link"
                 href="#"></a>
              <div class="banner _h-45vh  banner-">
                <div class="banner-bg"
                     style="background-image:url('uploads/promotions/<?php echo $promotionRow['image'];?>');"></div>
                <div class="banner-caption banner-caption-bottom banner-caption-grad">
                  <h5 class="banner-title"><?php echo $promotionRow['title'];?></h5>
                  <p class="banner-subtitle"><?php echo $promotionRow['subTitle']; ?></p>
                </div>
              </div>
            </div>
          </div>

        <?php
    }
            ?>
        </div>
        
      </div>
    </div>


      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>


   </body>
</html>