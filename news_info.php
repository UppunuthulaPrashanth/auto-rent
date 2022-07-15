<?php include "inc_opendb.php";
$PAGEID = "Blog Info";

//NEWS INFO
if(isset($_GET['slug']) && !empty($_GET['slug']))
{
    $slug = filter_var($_GET['slug'],FILTER_SANITIZE_STRING);
    $newsResult = $db->query("SELECT * FROM news WHERE slug = '" . $slug . "'");
    $newsRow = mysqli_fetch_assoc($newsResult);
    $title = $newsRow['title'];
    $image = $newsRow['largeImage'];
    $postDate = date('jS F Y',strtotime($newsRow['postDate']));
    $description = $newsRow['description'];
}
else
{
    header("location:/blog");
    exit();
}




?>
<!DOCTYPE HTML>
<html lang="en">
   <head>
   <?php $metaTitle = "Blog | $title"; ?>
       <?php include 'inc_metadata.php'; ?>
	   
   </head>
   <body>
      <?php include 'inc_header.php'; ?>
      <?php





      $pageID = '7';
      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);
      $row = mysqli_fetch_assoc($result);
      ?>

      <div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url('uploads/pages/<?php echo $row['headerBG'];?>');"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title"><?php echo $title; ?></h1>
                <p class="theme-page-header-subtitle"><?php echo $postDate; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  <div class="theme-page-section _pb-30 theme-page-section-gray theme-page-section-xl">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div style="margin-bottom: 30px;">
                  <img class="img-responsive" src="uploads/news/<?php echo $image;?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>"/>
              </div>
            <div class="theme-blog-post blog-desc">
              <?php echo $description; ?>
            </div>
          </div>
        </div>
      </div>
    </div>





      <?php
      $pageID = '6';
      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);
      $row = mysqli_fetch_assoc($result);
      ?>
     
     <div class="theme-page-section theme-page-section-xl">
      <div class="container">
        <div class="theme-page-section-header">
          <h5 class="theme-page-section-title"><?php echo $row['pageTitle'];?></h5>
          <?php echo $row['summary'] ?>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel" data-items="5" data-loop="true" data-nav="true">

              <?php
              $newsResult = $db->query("SELECT * FROM news WHERE slug != '" . $slug . "'");
              while($newsRow = mysqli_fetch_assoc($newsResult)) {
                  ?>
                  <div class="theme-inline-slider-item">
              <div class="theme-blog-item">
                <a class="theme-blog-item-link"
                   href="blog-info/<?php echo $newsRow['slug'];?>"></a>
                <div class="banner _h-45vh  banner-">
                  <div class="banner-bg"
                       style="background-image:url('uploads/news/<?php echo $newsRow['thumbnail'];?>');"></div>
                  <div class="banner-caption banner-caption-bottom banner-caption-grad">
                    <p class="theme-blog-item-time"><?php echo time_elapsed_string($newsRow['postDate']); ?></p>
                    <h5 class="theme-blog-item-title"><?php echo $newsRow['title']; ?></h5>
                    <p class="theme-blog-item-desc"><?php echo $newsRow['summary']; ?></p>
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
    </div>


      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
   </body>
</html>