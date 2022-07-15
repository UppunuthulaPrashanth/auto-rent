<div class="sticky-col ">
    <?php
    $blogResult = $db->query( "SELECT * FROM car_listing_blog WHERE active = 1 ORDER BY so ASC" );
    while ( $blogRow = mysqli_fetch_assoc( $blogResult ) )
    {
    ?>
    <div class="theme-ad _mb-20">
        <a class="theme-ad-link" target="_blank" href="<?php echo $blogRow['linkTo']?>"></a>
        <img class="theme-ad-img" src="uploads/news/<?php echo $blogRow['image']?>" alt="" title=""/>
    </div>
    <?php } ?>
</div>