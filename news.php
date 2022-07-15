<?php include "inc_opendb.php";
$PAGEID = "Blog";
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
      $pageID = '3';
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
      

  <div class="theme-page-section theme-page-section-xl theme-page-section-gray">
      <div class="container">
        <div class="row row-col-gap"
             data-gutter="20">
<?php
$itemsPerPage = 2;
$currentIndex = 0;
$totalItems = 0;
$newsListingRes = $db->query("SELECT * FROM news WHERE active = 1 ORDER BY postDate DESC");
$totalItems = mysqli_num_rows($newsListingRes);
$newsListingResQuery = $db->lastQuery() . " LIMIT ?i, ?i";
if ($totalItems > $itemsPerPage)
{
    $newsListingRes = $db->query($newsListingResQuery, $currentIndex, $itemsPerPage);
}
?>
            <div class="row row-col-gap products-grid" data-gutter="20">
            <?php
while ($newsRow = mysqli_fetch_assoc($newsListingRes)) {
?>
          <div class="col-md-6 ">
                <div class="theme-blog-item _br-2 theme-blog-item-center">
                    <a class="theme-blog-item-link"
                       href="blog-info/<?php echo $newsRow['slug']; ?>"></a>
                    <div class="banner _h-45vh  banner-">
                        <div class="banner-bg"
                             style="background-image:url('uploads/news/<?php echo $newsRow['thumbnail']; ?>');"></div>
                        <div class="banner-caption banner-caption-bottom banner-caption-grad">
                            <p class="theme-blog-item-time"><?php echo time_elapsed_string($newsRow['postDate']); ?></p>
                            <h5 class="theme-blog-item-title"><?php echo $newsRow['title']; ?></h5>
                            <p class="theme-blog-item-desc"><?php echo $newsRow['summary'] ?></p>
                        </div>
                    </div>
                </div>
          </div>
            <?php
                }

                ?>
            </div>

        </div>


        <br/><br/>
        <div class="row row-col-gap" data-gutter="20"
             id="load_data_message">
          <div class="col-md-4 col-md-offset-4">
            <button class="btn _mt-20 _tt-uc _fw-n btn-lg btn-white btn-block">Show More</button>
          </div>
        </div>
      </div>
    </div>
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
      <script>
               $(document).ready(function () {

                   var start = 0; //Starting position
                   var limit = 2; //Show records limit
                   var action = 'inactive';

                   function load_country_data(limit, start) {
                       start += limit;
                       $.ajax({
                           type: 'POST',
                           url: 'fetch.php',
                           data: {'start': start, 'limit': limit},
                           cache: false,
                           success: function (data) {
                               //console.log(data); return;
                               $("#load_data_message").hide();
                               if (data != '') {
                                   $(".products-grid").append(data);
                                   $("#load_data_message").show();
                                   $('#load_data_message').html("<div class='col-md-4 col-md-offset-4'><button class='btn _mt-20 _tt-uc _fw-n btn-lg btn-white btn-block'>Show More</button></div>");
                                   action = "inactive";
                               }
                               else {
                                   $('#load_data_message').html("<div class='col-md-4 col-md-offset-4'><button class='btn _mt-20 _tt-uc _fw-n btn-lg btn-white btn-block'>No More Data</button></div>");
                                   action = "active";
                               }
                           }
                       });
                   }


                   if (action == 'inactive') {
                       action = 'active';
                       load_country_data(limit, start);
                   }

                   $(window).scroll(function () {
                       if ($(window).scrollTop() + $(window).height() > $(".products-grid").height() && action == 'inactive') {
                           action = 'active';
                           start = start + limit;
                           setTimeout(function () {
                               load_country_data(limit, start);
                           }, 3000);
                       }
                   });

               });
</script>
   </body>
</html>