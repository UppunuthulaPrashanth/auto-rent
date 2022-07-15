<div class="theme-page-section theme-page-section-xxl theme-page-section-dark">
      <div class="container">
        <div class="theme-page-section-header theme-page-section-header-white">
            <?php
            $pageID = '12';
            $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s", $pageID);
            $row = mysqli_fetch_assoc($result);
            ?>
          <h5 class="theme-page-section-title"><?php echo $row['pageTitle']; ?></h5>
          <p class="theme-page-section-subtitle"><?php echo $row['subTitle']; ?></p>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
          <div class="owl-carousel owl-carousel-nav-white" data-items="4" data-loop="true" data-nav="true">
<?php
$newsResult = $db->query("SELECT * FROM news WHERE active = 1 ORDER BY postDate DESC");
while ($newsRow = mysqli_fetch_assoc($newsResult)) {
    $postDate = date('jS F Y',strtotime($newsRow['postDate']));

    ?>
    <div class="theme-inline-slider-item">
              <div class="theme-blog-item _br-4 theme-blog-item-full">
                <a class="theme-blog-item-link"
                   href="news-info/<?php echo $newsRow['slug']; ?>"></a>
                <div class="banner _h-45vh  banner-">
                  <div class="banner-bg"
                       style="background-image:url('uploads/news/<?php echo $newsRow['homeImage'];?>');"></div>
                  <div class="banner-caption banner-caption-bottom banner-caption-">
                    <p class="theme-blog-item-time"><?php echo $postDate; ?></p>
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