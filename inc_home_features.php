<div class="theme-page-section theme-page-section-xxl">
      <div class="container">
        <div class="row row-col-mob-gap"
             data-gutter="60">
<?php
$result = $db->query("SELECT * FROM home_stats WHERE active = 1 ORDER BY so ASC");
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-3 ">
            <div class="feature feature-white feature-center">
              <i class="feature-icon feature-icon-primary feature-icon-box feature-icon-round <?php echo $row['icon']; ?>"></i>
              <div class="feature-caption">
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