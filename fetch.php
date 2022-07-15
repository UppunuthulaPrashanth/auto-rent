<?php
include "inc_opendb.php";


$start = filter_var($_POST["start"],FILTER_SANITIZE_STRING);
$limit = filter_var($_POST["limit"],FILTER_SANITIZE_STRING);

//echo "Limit: ".$limit."Start: ".$start;
//exit();
//get rows query
$newsListingRes = $db->query("SELECT * FROM news WHERE active = 1 ORDER BY postDate DESC LIMIT ".$start.", ".$limit." ");
//number of rows
$rowCount = mysqli_num_rows($newsListingRes);

if($rowCount > 0)
{
    while ($newsListingRow = mysqli_fetch_assoc($newsListingRes)) {
        ?>

        <div class="col-md-6 ">
                    <div class="theme-blog-item _br-2 theme-blog-item-center">
                        <a class="theme-blog-item-link" href="blog-info/<?php echo $newsListingRow['slug'];?>"></a>
                        <div class="banner _h-45vh  banner-">
                            <div class="banner-bg" style="background-image:url('uploads/news/<?php echo $newsListingRow['thumbnail'];?>');"></div>
                            <div class="banner-caption banner-caption-bottom banner-caption-grad">
                                <p class="theme-blog-item-time"><?php echo time_elapsed_string($newsListingRow['postDate']); ?></p>
                                <h5 class="theme-blog-item-title"><?php echo $newsListingRow['title']; ?></h5>
                                <p class="theme-blog-item-desc"><?php echo $newsListingRow['summary'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
    }
}
?>