<?php include "inc_opendb.php";
$PAGEID = "Promotions";
?>
<!DOCTYPE HTML>
<html lang="en">
   <head>
       <meta charset="UTF-8"/>
       <?php include 'inc_metadata.php'; ?>
<style>
       .masonry-column {
       padding: 0 1px;
       }

       .masonry-grid > div .thumbnail {
       margin: 5px 1px;
       }
       </style>
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
             style="background-image:url('data/special_offer_banner.jpg');"></div>
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




      <div class="container">
          <div class="row masonry-grid" style="margin-bottom: 450px">
              <?php
            $myColumn="";
            $i = 0;
            $promotionResult = $db->query("SELECT * FROM promotions WHERE active = 1");
            while ($promotionRow = mysqli_fetch_assoc($promotionResult))
            {
            $i++;
            //echo "<pre>";
            list($width, $height, $type, $attr) = getimagesize('uploads/promotions/'.$promotionRow['image']);
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
              <div class="<?php echo $myColumn;?>  masonry-column"  >

                      <a href="#" class="thumbnail"><img src="uploads/promotions/<?php echo $promotionRow['image'];?>"></a>


              </div>
             <?php } ?>
              <h1 class="theme-page-header-title text-center" style="margin-top: 200px">There are currently no offers available</h1>


          </div>
      </div>

      </div>
    </div>
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
   </body>
</html>