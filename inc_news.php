<div class="theme-page-section theme-page-section-xl">
    <div class="container _pv-40">
        <?php
        $pageID = '28';
        $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
        $row    = mysqli_fetch_assoc( $result );
        ?>
        <div class="theme-page-section-header">
            <h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle']; ?></h5>
            <p class="theme-page-section-subtitle black-text"><?php echo $row['subTitle'] ?></p>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
            <div class="owl-carousel" data-items="4" data-loop="true" data-nav="true">

                <?php
                $newsListingRes = $db->query("SELECT * FROM news WHERE active = 1 ORDER BY postDate DESC");
                while ($newsRow = mysqli_fetch_assoc($newsListingRes)) {
                    ?>


                    <div class="theme-inline-slider-item">
                        <div class="theme-blog-item">
                            <a class="theme-blog-item-link" href="blog-info/<?php echo $newsRow['slug']; ?>"></a>
                            <div class="banner _h-45vh  banner-">
                                <div class="banner-bg" style="background-image:url('uploads/news/<?php echo $newsRow['thumbnail']; ?>');"></div>
                                <div class="banner-caption banner-caption-bottom banner-caption-grad">
                                    <p class="theme-blog-item-time"><?php echo time_elapsed_string($newsRow['postDate']); ?></p>
                                    <h5 class="theme-blog-item-title"><?php echo $newsRow['title']; ?></h5>
                                    <p class="theme-blog-item-desc"><?php echo $newsRow['summary'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>