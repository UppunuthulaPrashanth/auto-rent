<div class="theme-page-section theme-page-section-xl theme-page-section-gray" style="padding:90px 0px; background:#f7f7f7">
      <div class="container _pv-40">
        <div class="row row-col-mob-gap"
             data-gutter="60">
            <?php

            $pageID = '27';

            $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

            $row    = mysqli_fetch_assoc( $result );

            ?>
          <div class="theme-page-section-header">
        
            <h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle'] ?></h5>
          <p class="theme-page-section-subtitle black-text"><?php echo $row['subTitle']; ?></p>
        </div>
          <br>
<?php
$result = $db->query("SELECT * FROM home_stats WHERE active = 1 ORDER BY so ASC");
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-3 why-autorent">
            <div class="feature feature-white feature-center">
              <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round <?php echo $row['icon']; ?>"></i>
              <div class="feature-caption">
                <h5 class="feature-title black-text"><?php echo $row['title']; ?></h5>
                <p class="feature-subtitle black-text"><?php echo $row['summary']; ?></p>
              </div>
            </div>

            </div>
    <?php
}
?>
        </div>
      </div>
    </div>