<?php include "inc_opendb.php";
$PAGEID = "Home";
?>
<!DOCTYPE HTML>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <?php include 'inc_metadata.php'; ?>
   </head>
   <body>
      <?php include 'inc_header-r2.php'; ?>
      <?php include 'inc_home_slider.php'; ?>
      <?php include 'inc_home_deals-1.php'; ?>   
      <?php// include 'inc_home_specials.php'; ?> 
      <?php //include 'inc_home_blog.php'; ?>
      <?php include 'inc_home_features-1.php'; ?>
      <?php //include 'inc_home_app.php'; ?>

     <div class="row" data-gutter="0">
      <div class="col-md-3 ">
        <div class="banner banner-animate banner-animate-mask-out">
          <img class="banner-img" src="data/dubai-1.jpg" alt="Image Alternative text" title="Image Title">
          
          <a class="banner-link" href="#"></a>
          <div class="banner-caption _ta-c banner-caption-bottom banner-caption-grad">
            <h5 class="banner-title">Dubai</h5>
            <p class="banner-subtitle">Rental Guide</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 ">
        <div class="banner banner-animate banner-animate-mask-out">
          <img class="banner-img" src="data/abudhabi-1.jpg" alt="Image Alternative text" title="Image Title">
      
          <a class="banner-link" href="#"></a>
          <div class="banner-caption _ta-c banner-caption-bottom banner-caption-grad">
            <h5 class="banner-title">Abu Dhabi</h5>
            <p class="banner-subtitle">Rental Guide</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 ">
        <div class="banner banner-animate banner-animate-mask-out">
          <img class="banner-img" src="data/sharjah-1.jpg" alt="Image Alternative text" title="Image Title">

          <a class="banner-link" href="#"></a>
          <div class="banner-caption _ta-c banner-caption-bottom banner-caption-grad">
            <h5 class="banner-title">Sharjah</h5>
            <p class="banner-subtitle">Rental Guide</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 ">
        <div class="banner banner-animate banner-animate-mask-out">
          <img class="banner-img" src="data/rak-1.jpg" alt="Image Alternative text" title="Image Title">
  
          <a class="banner-link" href="#"></a>
          <div class="banner-caption _ta-c banner-caption-bottom banner-caption-grad">
            <h5 class="banner-title">Ras Al Khaimah</h5>
            <p class="banner-subtitle">Rental Guide</p>
          </div>
        </div>
      </div>
    </div>
     <div class="theme-page-section  theme-page-section-lg" style="background:#f7f7f7">
      <div class="container">
        <div class="row">
          <div class="theme-page-section-header">
        
            <h5 class="theme-page-section-title">FAQs</h5>
          <p class="theme-page-section-subtitle">Enhance your rental experience with us !</p>
        </div>
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
                          <p class="theme-account-preferences-item-value"><?php echo $row['question']; ?></p>
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
                    <p class="theme-sidebar-section-features-list-body">
                        <?php echo $row['summary']; ?>
                    </p>
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

     
     
     
     
     
     
     
      
     
      <?php include 'inc_footer-r2.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>

   </body>
</html>