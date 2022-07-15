<?php include "inc_opendb.php";
$PAGEID = "Used Cars Info";

//
//echo "<pre>";
//echo print_r($_GET);
//echo "</pre>";
//exit();



$slug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING);
$slug1 = filter_var($_GET['slug1'], FILTER_SANITIZE_STRING);




if (empty($slug)) {
    header("location:used-cars");
    exit();
}



$usedInfoResult = $db->query("SELECT * FROM view_used_cars WHERE slug = ?s", $slug);
$usedInfoRow = mysqli_fetch_assoc($usedInfoResult);

$make   = $usedInfoRow['make'];
$model  = $usedInfoRow['model'];
$title  = $make . " " .$model;
$year   = $usedInfoRow['year'];
$bodyTypeID   = $usedInfoRow['bodyTypeID'];
$fuelTypeID   = $usedInfoRow['fuelTypeID'];
$regionalSpecID   = $usedInfoRow['regionalID'];
$warrantyID   = $usedInfoRow['warrantyID'];
$transmissionID   = $usedInfoRow['transmissionTypeID'];
$cylinderID   = $usedInfoRow['cylinderID'];
$extraFeatures = $usedInfoRow['extra_features'];

?>

<!DOCTYPE HTML>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <?php include 'inc_metadata.php'; ?>
   </head>
   <body>
      <?php include 'inc_header.php'; ?>

      
      
      <div class="theme-hero-area">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel-1.png);"></div>
        <div class="theme-hero-area-grad-mask"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row _pv-60">
            <div class="col-md-9 ">
              <div class="_mob-h">
                <div class="theme-hero-text theme-hero-text-white">
                  <div class="">
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm"><?php echo $title;?></h2>
                  </div>
                </div>
                <ul class="theme-breadcrumbs _mt-20">
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="/">Home</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a>Used Cars</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a><?php echo $title;?></a>
                    </p>
                    
                  </li>
                </ul>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title"><?php echo $title;?></h4>
                <p class="theme-search-area-inline-details"><?php echo $year;?></p>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
     
     
     
 <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ">
            <div class="row row-col-static" id="sticky-parent">
              <div class="col-md-7 ">

                        <div class="theme-item-page-overview">
                          <div class="fotorama _mb-20" data-nav="thumbs" data-minwidth="100%" data-arrows="always" data-allowfullscreen="native" >
                              <?php
                              if (strlen($usedInfoRow['thumbnail']) > 3) {
                              ?>
                            <img src="uploads/usedcars/<?php echo $usedInfoRow['thumbnail'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                              <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_01']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_01'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_02']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_02'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_03']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_03'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_04']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_04'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_05']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_05'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_06']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_06'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_07']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_07'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_08']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_08'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_09']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_09'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_10']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_10'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_11']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_11'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>

                              <?php
                              if (strlen($usedInfoRow['img_12']) > 3) {
                                  ?>
                                  <img src="uploads/usedcars/<?php echo $usedInfoRow['img_12'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                                  <?php
                              }
                              ?>
                          </div>

                          <div class="theme-item-page-desc">

                            <?php
                            if (strlen($usedInfoRow['summary']) > 0) {
                                echo $usedInfoRow['summary'];
                            }
                              ?>
                            <h5 class="feature-title">Additional Features</h5>
                     
                              <div class="row">
                                <div class="col-md-6 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">

                                      <?php
                                      if (strlen($extraFeatures) > 0)
                                      {
                                          $i=0;
                                          $featureResult = $db->query("SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)");
                                          while ($featureRow = mysqli_fetch_assoc($featureResult))
                                          {
                                              $i++;
                                              if($i<11) {
                                                  ?>
                                                  <li>
                                                      <?php
                                                      echo $featureRow['extraFeatures'];
                                                      ?>
                                                  </li>
                                                  <?php
                                              }
                                          }
                                      }
                                      ?>
                                  </ul>
                                </div>
                                <div class="col-md-6 ">
                                  <ul class="theme-item-page-details-list theme-item-page-details-list-checked">
                                      <?php
                                      if (strlen($extraFeatures) > 0) {
                                          $j = 0;
                                          $featureResult = $db->query("SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)");
                                          $counter = mysqli_num_rows($featureResult);
                                          while ($featureRow = mysqli_fetch_assoc($featureResult)) {
                                              $j++;
                                              if ($j >= 11) {
                                                  ?>
                                                  <li>
                                                      <?php
                                                      echo $featureRow['extraFeatures'];
                                                      ?>
                                                  </li>
                                                  <?php
                                              }
                                          }

                                      }
                                      ?>
                                  </ul>
                                </div>
                                
                              </div>
                         
                            
                            
                            
                          </div>
                        </div>
                    
            
              </div>
              <div class="col-md-5 ">
                <div class="sticky-col">
                    <form name="enquiryFormBtn" id="enquiryFormBtn" method="post" action="/enquiry-used-cars">
                        <input type="hidden" name="slug" id="slug" value="<?php echo $slug; ?>"/>
                        <input type="hidden" name="slug1" id="slug1" value="<?php echo $slug1; ?>"/>
<!--                        <input type="hidden" name="carYear" id="carYear" value="--><?php //echo $year; ?><!--"/>-->
<!--                        <input type="hidden" name="carPrice" id="carPrice" value="--><?php //echo $usedInfoRow['price' . $_SESSION[CURRENT_CURRENCY]];?><!--; ?>"/>-->
<!--                        <input type="hidden" name="carKilometer" id="carKilometer" value="--><?php //echo $usedInfoRow['kilometers'];?><!--; ?>"/>-->
<!--                        <input type="hidden" name="carRegionalSpec" id="carRegionalSpec" value="--><?php //echo getRegionalSpecFromID($regionalSpecID);?><!--; ?>"/>-->
<!--                        <input type="hidden" name="carTransmission" id="carTransmission" value="--><?php //echo getTransmissionTypeFromID($transmissionID);?><!--; ?>"/>-->
<!--                        <input type="hidden" name="carFuel" id="carFuel" value="--><?php //echo getFuelTypeFromID($fuelTypeID);?><!--; ?>"/>-->
                    <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved" type="submit">Enquire Now !</button> <hr>
                    </form>
                  <div class="theme-search-area _mb-20 _p-20 _b _bc-dw theme-search-area-vert bg-white">
                <div class="theme-search-area-header _mb-20 theme-search-area-header-sm">
                  <h1 class="theme-search-area-title">Technical Specifications</h1>
                  
                </div>
                
                    
                    <div class="theme-item-page-rooms-table">
                      
                      <table class="table table-striped">
                  
                  <tbody>
                    <tr>
                        <?php
                        if (strlen($usedInfoRow['description']) > 0) {
                        ?>
                            <td>Description</td>
                            <td><strong><?php echo $usedInfoRow['description'];?></strong></td>
                        <?php
                        }
                        ?>
                    </tr>

                    <tr>
                        <?php
                        if (strlen(getBodyTypeFromID($bodyTypeID)) > 0) {
                        ?>
                      <td>Body Type</td>
                      <td><strong><?php echo getBodyTypeFromID($bodyTypeID); ?></strong></td>
                            <?php
                        }
                        ?>
                    </tr>

                    <tr>
                        <?php
                        if (strlen(getFuelTypeFromID($fuelTypeID)) > 0) {
                        ?>
                      <td>Fuel</td>
                      <td><strong><?php echo getFuelTypeFromID($fuelTypeID);?></strong> </td>
                            <?php
                        }
                        ?>
                    </tr>

                    <tr>
                        <?php
                        if (strlen(getRegionalSpecFromID($regionalSpecID)) > 0) {
                        ?>
                      <td>Regional Specs</td>
                      <td><strong><?php echo getRegionalSpecFromID($regionalSpecID);?></strong> </td>
                            <?php
                        }
                        ?>
                    </tr>

                    <tr>
                        <?php
                        if (strlen(getWarrantyFromID($warrantyID)) > 0) {
                        ?>
                      <td>Warranty</td>
                      <td><strong><?php echo getWarrantyFromID($warrantyID);?></strong></td>
                        <?php
                        }
                        ?>
                    </tr>


                    <tr>
                      <?php
                        if (strlen($usedInfoRow['noOfDoors']) > 0) {
                      ?>
                      <td>Doors</td>
                      <td><strong><?php echo $usedInfoRow['noOfDoors'];?></strong></td>
                     <?php
                     }
                     ?>
                      
                    </tr>

                    <tr>
                        <?php
                        if (strlen(getTransmissionTypeFromID($transmissionID)) > 0) {
                        ?>
                      <td>Trasmission</td>
                      <td><strong><?php echo getTransmissionTypeFromID($transmissionID);?></strong></td>
                            <?php
                        }
                        ?>
                    </tr>

                    <tr>
                        <?php
                        if (strlen(getCylinderFromID($cylinderID)) > 0) {
                        ?>
                      <td>Cylinders</td>
                      <td><strong><?php echo getCylinderFromID($cylinderID) ;?></strong></td>
                     <?php
                     }
                     ?>
                    </tr>

                    <tr>
                        <?php
                        if (strlen($usedInfoRow['engine']) > 0) {
                        ?>
                      <td>Engine</td>
                      <td><strong><?php echo $usedInfoRow['engine'];?></strong></td>
                          <?php
                          }
                          ?>
                    </tr>
                      
                  </tbody>
                </table>
                    </div>
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