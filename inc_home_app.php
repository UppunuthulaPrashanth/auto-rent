<?php
$result = $db->query("SELECT * FROM home_apps");
$row = mysqli_fetch_assoc($result);
?>
<div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(uploads/pages/<?php echo $row['backgroundImage'];?>);"></div>
        <div class="theme-hero-area-grad-mask"></div>
        <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="theme-page-section _p-0">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <div class="theme-mobile-app">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="theme-mobile-app-section">
                        <img class="theme-mobile-app-img" src="uploads/pages/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>"/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="theme-mobile-app-section">
                        <div class="theme-mobile-app-body">
                          <div class="theme-mobile-app-header">
                            <h2 class="theme-mobile-app-title"><?php echo $row['title']; ?></h2>
                            <p class="theme-mobile-app-subtitle"><?php echo $row['subTitle']; ?></p>
                          </div>
                          <ul class="theme-mobile-app-btn-list">
                            <li>
                              <a class="btn btn-dark theme-mobile-app-btn" href="<?php echo $row['buttonLink1']; ?>">
                                <i class="theme-mobile-app-logo">
                                  <img src="uploads/pages/<?php echo $row['buttonIcon1']; ?>" alt="App Store" title="App Store"/>
                                </i>
                                <?php echo $row['buttonLinkLabel1']; ?>
                              </a>
                            </li>
                            <li>
                              <a class="btn btn-dark theme-mobile-app-btn" href="<?php echo $row['buttonLink2']; ?>">
                                <i class="theme-mobile-app-logo">
                                  <img src="uploads/pages/<?php echo $row['buttonIcon2']; ?>" alt="Google Play" title="Google Play"/>
                                </i>
                                  <?php echo $row['buttonLinkLabel2']; ?>
                              </a>
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
        </div>
      </div>
    </div>