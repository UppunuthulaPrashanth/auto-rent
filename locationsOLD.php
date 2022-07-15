<?php include "inc_opendb.php";
$PAGEID = "LOCATION";
?>
<!DOCTYPE HTML>
<html lang="en">
   <head>
      <?php $page_id = "page_base_b"; ?>
      <?php $page_title = "Locations"; ?>
      <?php $page_keywords = "Website Keywords"; ?>
      <?php $page_description = "Website Description"; ?>
      <meta charset="UTF-8"/>
      <?php include 'inc_metadata.php'; ?>
   </head>
   <body>
      <?php include 'inc_header.php'; ?>
      <?php
      $pageID = '14';
      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s", $pageID);
      $row = mysqli_fetch_assoc($result);
      ?>
      
      <div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url('uploads/pages/<?php echo $row['headerBG']; ?>');"></div>
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
      

<div class="theme-page-section">
      <div class="container">
        <div class="row row-col-static" id="sticky-parent" data-gutter="60">
          <div class="col-md-12 ">
            
            <br>
            <div class="theme-item-page-tabs _mb-30">
              <div class="tabbable">
                <ul class="nav nav-tabs nav-default nav-sqr nav-justified" role="tablist"><?php
                    $i=0;
                    $result = $db->query("SELECT * FROM mtr_locations WHERE active = 1 ORDER BY so ASC");
                    while($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        ?>
                  <li <?php if($i==1) { echo 'class="active"';} else { echo 'class=""';} ?> role="presentation">
                    <a aria-controls="locationTabs-<?php echo $i; ?>" role="tab" data-toggle="tab" href="#locationTabs-<?php echo $i; ?>"><?php echo $row['locationName']; ?></a>
                  </li><?php
                    }
                   ?>
                </ul>
                
                

                <div class="tab-content _pt-30">
                   <?php
                   $i=0;
                   $result = $db->query("SELECT * FROM mtr_locations WHERE active = 1 ORDER BY so ASC");
                   while($row = mysqli_fetch_assoc($result))
                   {
                   $i++;

                        $regionResult = $db->query("SELECT * FROM region WHERE locationID = ?i",$row['locationID']);
                        while($regionRow = mysqli_fetch_assoc($regionResult))
                        {
                            ?>
                            <div class="tab-pane <?php if($i==1) { echo 'active'; } else { echo '';}?>" id="locationTabs-<?php echo $i; ?>" role="tab-panel">
                                <div class="theme-item-page-overview">
                                    <h5 class="theme-item-page-details-section-title about-title"><?php echo $regionRow['regionName']; ?></h5>
                                    <hr>
                        <?php
                        $j=0;
                        $branchResult = $db->query("SELECT * FROM branches WHERE locationID = ?i AND regionID = ?i",$row['locationID'],$regionRow['regionID']);
                        while($branchRow = mysqli_fetch_assoc($branchResult))
                        {

                            ?>
                      <div class="row row-col-mob-gap">
                          <?php
                          $j++;
                            if($i%2<>0) {?>
                           <div class="col-md-6 ">

                                <div class="col-md-6 ">
                        <iframe src="<?php echo $branchRow['map']; ?>"
                                width="245"
                                height="300"
                                frameborder="0"
                                style="border:0;"
                                allowfullscreen=""
                                aria-hidden="false"
                                tabindex="0"></iframe>

                        </div>
                                <div class="col-md-6 ">
                          <div class="theme-item-page-desc ">
                         <h4><?php echo $branchRow['branchName']; ?></h4>
                            <p><i class=" fa fa-map-marker fa-lg loc-icons"></i><?php echo $branchRow['address']; ?></p>
                            <p><i class=" fa fa-phone fa-lg loc-icons"></i><a href="tel: <?php echo $branchRow['phone']; ?>"> <?php echo $branchRow['phone']; ?></a></p>
                            <p><i class=" fa fa-fax fa-lg loc-icons"></i><a href="fax: <?php echo $branchRow['fax']; ?>"> <?php echo $branchRow['fax']; ?></a></p>
                            <p><i class=" fa fa-envelope fa-lg loc-icons"></i><a href="mailto:<?php echo $branchRow['email']; ?>"> <?php echo $branchRow['email']; ?></a></p>
                          </div>
                        </div>

                            </div>
                          <?php
                          }
                          else{
                          ?>
                          <div class="col-md-6 ">

                                    <div class="col-md-6 ">
                            <iframe src="<?php echo $branchRow['map']; ?>"
                                    width="245"
                                    height="300"
                                    frameborder="0"
                                    style="border:0;"
                                    allowfullscreen=""
                                    aria-hidden="false"
                                    tabindex="0"></iframe>

                            </div>
                                    <div class="col-md-6 ">
                              <div class="theme-item-page-desc ">
                             <h4><?php echo $branchRow['branchName']; ?></h4>
                                <p><i class=" fa fa-map-marker fa-lg loc-icons"></i><?php echo $branchRow['address']; ?></p>
                                <p><i class=" fa fa-phone fa-lg loc-icons"></i><a href="tel: <?php echo $branchRow['phone']; ?>"> <?php echo $branchRow['phone']; ?></a></p>
                                <p><i class=" fa fa-fax fa-lg loc-icons"></i><a href="fax: <?php echo $branchRow['fax']; ?>"> <?php echo $branchRow['fax']; ?></a></p>
                                <p><i class=" fa fa-envelope fa-lg loc-icons"></i><a href="mailto:<?php echo $branchRow['email']; ?>"> <?php echo $branchRow['email']; ?></a></p>
                              </div>
                            </div>

                           </div>
                              <?php
                          }
                          ?>
                      </div>
                                    <hr>

                                    <div class="row row-col-mob-gap">
                          <?php
                          $j++;
                          if($i%2<>0) {?>
                              <div class="col-md-6 ">

                                <div class="col-md-6 ">
                        <iframe src="<?php echo $branchRow['map']; ?>"
                                width="245"
                                height="300"
                                frameborder="0"
                                style="border:0;"
                                allowfullscreen=""
                                aria-hidden="false"
                                tabindex="0"></iframe>

                        </div>
                                <div class="col-md-6 ">
                          <div class="theme-item-page-desc ">
                         <h4><?php echo $branchRow['branchName']; ?></h4>
                            <p><i class=" fa fa-map-marker fa-lg loc-icons"></i><?php echo $branchRow['address']; ?></p>
                            <p><i class=" fa fa-phone fa-lg loc-icons"></i><a href="tel: <?php echo $branchRow['phone']; ?>"> <?php echo $branchRow['phone']; ?></a></p>
                            <p><i class=" fa fa-fax fa-lg loc-icons"></i><a href="fax: <?php echo $branchRow['fax']; ?>"> <?php echo $branchRow['fax']; ?></a></p>
                            <p><i class=" fa fa-envelope fa-lg loc-icons"></i><a href="mailto:<?php echo $branchRow['email']; ?>"> <?php echo $branchRow['email']; ?></a></p>
                          </div>
                        </div>

                            </div>
                              <?php
                          }
                          else{
                              ?>
                              <div class="col-md-6 ">

                                    <div class="col-md-6 ">
                            <iframe src="<?php echo $branchRow['map']; ?>"
                                    width="245"
                                    height="300"
                                    frameborder="0"
                                    style="border:0;"
                                    allowfullscreen=""
                                    aria-hidden="false"
                                    tabindex="0"></iframe>

                            </div>
                                    <div class="col-md-6 ">
                              <div class="theme-item-page-desc ">
                             <h4><?php echo $branchRow['branchName']; ?></h4>
                                <p><i class=" fa fa-map-marker fa-lg loc-icons"></i><?php echo $branchRow['address']; ?></p>
                                <p><i class=" fa fa-phone fa-lg loc-icons"></i><a href="tel: <?php echo $branchRow['phone']; ?>"> <?php echo $branchRow['phone']; ?></a></p>
                                <p><i class=" fa fa-fax fa-lg loc-icons"></i><a href="fax: <?php echo $branchRow['fax']; ?>"> <?php echo $branchRow['fax']; ?></a></p>
                                <p><i class=" fa fa-envelope fa-lg loc-icons"></i><a href="mailto:<?php echo $branchRow['email']; ?>"> <?php echo $branchRow['email']; ?></a></p>
                              </div>
                            </div>

                           </div>
                              <?php
                          }
                          ?>
                      </div>

                                </div>





                        <?php
                        }
                        ?>

                      
                      
                    </div>
                    
                    <hr>

                  </div>
                            <?php
                        }
                   }
                   ?>

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