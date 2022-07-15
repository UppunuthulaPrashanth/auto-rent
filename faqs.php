<?php include "inc_opendb.php";
$PAGEID = "Faqs";
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
      $pageID = '10';
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
      

     
     <div class="theme-page-section theme-page-section-gray theme-page-section-lg">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12 ">
            
            <div class="row">
              <div class="col-md-8 ">
                <div class="theme-account-preferences">
<?php
$i = 0;
$result = $db->query("SELECT * FROM faqs WHERE active = 1 ORDER BY so ASC");
while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    ?>
    <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-10 ">
                        <a class=""
                           href="#faq<?php echo $i; ?>"
                           data-toggle="collapse"
                           aria-expanded=""false""
                           aria-controls="faq">
                          <p class="theme-account-preferences-item-value black-text"><?php echo $row['question']; ?></p>
                        </a>
                        <div class="collapse"
                             id="faq<?php echo $i; ?>">
                          <div class="theme-account-preferences-item-change">
                              <div class="row">
                                <div class="col-md-12">
                                    <p class="theme-account-preferences-item-value">
                                        <?php echo $row['answer']; ?>
                                    </p>
                                </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link"
                           href="#faq<?php echo $i; ?>"
                           data-toggle="collapse"
                           aria-expanded="false"
                           aria-controls="faq">
                          <i class="fa fa-chevron-down"></i>
                        </a>
                      </div>
                    </div>
                  </div>
<?php } ?>



                </div>
              </div>
              
              
              <div class="col-md-4 ">
            <div class="sticky-col">
              
              
              <div class="theme-sidebar-section _mb-10">
                <ul class="theme-sidebar-section-features-list"><?php
                  $pageID = '11';
                  $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s", $pageID);
                  $row = mysqli_fetch_assoc($result);
                  ?>
                  <li>
                      <h4><?php echo $row['pageTitle']; ?></h4>
                    <h5 class="theme-sidebar-section-features-list-title"><?php echo $row['subTitle'] ?></h5>
                        <?php echo $row['summary']; ?>
                      <br/>
                      <a class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="link-btn" href="/about"> About Us </a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
              
              
              
              
            </div>
          </div>
        </div>
      </div>
    </div>
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
   </body>
</html>