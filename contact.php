<?php include "inc_opendb.php";

$PAGEID = "Contact Us";

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

      $pageID = '9';

      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);

      $row = mysqli_fetch_assoc($result);

      ?>

      <div class="theme-hero-area theme-hero-area-half">

      <div class="theme-hero-area-bg-wrap">

        <div class="theme-hero-area-bg" style="background-image:url('uploads/pages/<?php echo $row['headerBG'];?>');"></div>

        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>

        <div class="theme-hero-area-inner-shadow"></div>

      </div>

      <div class="theme-hero-area-body">

        <div class="container">

          <div class="row">

            <div class="col-md-8 theme-page-header-abs">

              <div class="theme-page-header theme-page-header-lg">

                <h1 class="theme-page-header-title"><?php echo $row['pageTitle'];?></h1>

                <p class="theme-page-header-subtitle"><?php echo $row['subTitle'];?></p>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

      

<!--<div class="theme-page-section theme-page-section-xl theme-page-section-gray">-->

<!--      <div class="container">-->

<!--        <div class="row row-col-gap" data-gutter="20">-->

<!---->

<!--            --><?php

//            $mapResult = $db->query("SELECT * FROM contact_map WHERE active = 1 ORDER BY so ASC");

//            while($mapRow = mysqli_fetch_assoc($mapResult)) {

//            ?>

<!--              <div class="col-md-4 ">-->

<!--                <div class="theme-blog-item _br-2 theme-blog-item-center theme-blog-item-white">-->

<!--                  <div class="banner _h-45vh  banner-">-->

<!--                      <iframe src="--><?php //echo $mapRow['map'];?><!--" width="363" height="267" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->

<!--                        <div class="banner-caption banner-caption-bottom banner-caption">-->

<!--                             <h5 class="theme-blog-item-title">--><?php //echo $mapRow['title'];?><!--</h5>-->

<!--                             <p class="contact-height theme-blog-item-desc"><i class=" fa fa-phone loc-icons"></i><a href="tel:--><?php //echo $mapRow['phone'];?><!--">--><?php //echo $mapRow['phone'];?><!--</a><br>-->

<!--                             <i class="fa fa-fax loc-icons"></i><a href="tel:--><?php //echo $mapRow['fax'];?><!--">--><?php //echo $mapRow['fax'];?><!--</a><br>-->

<!--                             <i class="fa fa-envelope loc-icons"></i><a href="mailto:--><?php //echo $mapRow['email'];?><!--">--><?php //echo $mapRow['email'];?><!--</a></p>-->

<!--                        </div>-->

<!--                  </div>-->

<!--                </div>-->

<!--              </div>-->

<!--            --><?php

//            }

//            ?>

<!--        </div>-->

<!--      </div>-->

<!--</div>-->


      <div class="theme-page-section">

          <div class="container">

              <div class="row row-col-static"

                   id="sticky-parent"

                   data-gutter="60">

                  <div class="col-md-12 ">



                      <br>

                      <div class="theme-item-page-tabs _mb-30">

                          <div class="tabbable">

                              <ul class="nav nav-tabs nav-default nav-sqr nav-justified black-text" role="tablist"><?php

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

                                  while($row = mysqli_fetch_assoc($result)) {

                                      $i++;

                                      ?>

                                      <div class="tab-pane <?php if($i==1) { echo 'active';} else { echo '';} ?>" id="locationTabs-<?php echo $i; ?>" role="tab-panel">

                                          <?php

                                          $regionResult = $db->query("SELECT * FROM region WHERE locationID = ?i",$row['locationID']);

                                          while($regionRow = mysqli_fetch_assoc($regionResult))

                                          {

                                              ?>

                                              <div class="theme-item-page-overview">

                                                  <h5 class="theme-item-page-details-section-title about-title"><?php echo $regionRow['regionName']; ?></h5>

                                                  <hr>

                                                  <div class="row row-col-mob-gap">

                                                      <?php

                                                      $j=0;

                                                      $branchResult = $db->query("SELECT * FROM branches WHERE locationID = ?i AND regionID = ?i",$row['locationID'],$regionRow['regionID']);

                                                      while($branchRow = mysqli_fetch_assoc($branchResult))

                                                      {

                                                          $j++;

                                                          ?>



                                                          <div class="col-md-6 ">

                                                              <?php

                                                              if($j%2 != 0)

                                                              {

                                                                  ?>

                                                                  <div class="col-md-6 ">

                                                                      <iframe src="<?php echo $branchRow['map']; ?>"

                                                                              width="245"

                                                                              height="300"

                                                                              frameborder="0"

                                                                              style="border:0;"

                                                                              allowfullscreen=""

                                                                              aria-hidden="false"

                                                                              tabindex="0">

                                                                      </iframe>

                                                                  </div>

                                                                  <div class="col-md-6 ">

                                                                      <div class="theme-item-page-desc ">

                                                                          <h4><?php echo $branchRow['branchName']; ?></h4>

                                                                          <p class="black-text"><i class=" fa fa-map-marker fa-lg loc-icons"></i><?php echo $branchRow['address']; ?></p>

                                                                          <p><i class=" fa fa-phone fa-lg loc-icons"></i><a href="tel: <?php echo $branchRow['phone']; ?>"> <?php echo $branchRow['phone']; ?></a></p>

                                                                          <p><i class=" fa fa-fax fa-lg loc-icons"></i><a href="fax: <?php echo $branchRow['fax']; ?>"> <?php echo $branchRow['fax']; ?></a></p>

                                                                          <p><i class=" fa fa-envelope fa-lg loc-icons"></i><a href="mailto:<?php echo $branchRow['email']; ?>"> <?php echo $branchRow['email']; ?></a></p>

                                                                      </div>

                                                                  </div>

                                                              <?php } ?>



                                                              <?php

                                                              if($j%2 == 0)

                                                              {

                                                                  ?>

                                                                  <div class="col-md-6 ">

                                                                      <iframe src="<?php echo $branchRow['map']; ?>"

                                                                              width="245"

                                                                              height="300"

                                                                              frameborder="0"

                                                                              style="border:0;"

                                                                              allowfullscreen=""

                                                                              aria-hidden="false"

                                                                              tabindex="0">

                                                                      </iframe>

                                                                  </div>

                                                                  <div class="col-md-6 ">

                                                                      <div class="theme-item-page-desc ">

                                                                          <h4><?php echo $branchRow['branchName']; ?></h4>

                                                                          <p class="black-text"><i class=" fa fa-map-marker fa-lg loc-icons"></i><?php echo $branchRow['address']; ?></p>

                                                                          <p><i class=" fa fa-phone fa-lg loc-icons"></i><a href="tel: <?php echo $branchRow['phone']; ?>"> <?php echo $branchRow['phone']; ?></a></p>

                                                                          <p><i class=" fa fa-fax fa-lg loc-icons"></i><a href="fax: <?php echo $branchRow['fax']; ?>"> <?php echo $branchRow['fax']; ?></a></p>

                                                                          <p><i class=" fa fa-envelope fa-lg loc-icons"></i><a href="mailto:<?php echo $branchRow['email']; ?>"> <?php echo $branchRow['email']; ?></a></p>

                                                                      </div>

                                                                  </div>

                                                              <?php } ?>

                                                          </div>





                                                      <?php } ?>

                                                  </div>

                                                  <hr>

                                              </div>

                                          <?php } ?>



                                      </div>

                                      <?php

                                  }

                                  ?>

                              </div>

                          </div>

                      </div>

                  </div>



              </div>

          </div>

      </div>

     

  <div class="theme-page-section theme-page-section-xl theme-page-section">

      <div class="container">

        <div class="row">

          <div class="col-md-8 col-md-offset-2">

            <div class="theme-contact">
<!--                --><?php //echo "Host Name :".' '. $FULL_HOST_NAME ?>
                <form id="contactForm" method="post">

              <div class="row row-col-mob-gap">

                <div class="col-md-6">

                  <label>Name*</label>

                  <div class="form-group theme-contact-form-group">

                    <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Your Name" required/>

                  </div>

                </div>

                <div class="col-md-6">

                  <label>Subject*</label>

                  <div class="form-group theme-contact-form-group">

                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter The Subject of Your Message" required/>

                  </div>

                </div>

              </div>

              <div class="row row-col-mob-gap">

                <div class="col-md-6">

                  <label>E-Mail*</label>

                  <div class="form-group theme-contact-form-group">

                    <input class="form-control" name="email" id="email" type="email" placeholder="Enter Your E-Mail" required/>

                  </div>

                </div>

                <div class="col-md-6">

                  <label>Confirm E-Mail*</label>

                  <div class="form-group theme-contact-form-group">

                    <input class="form-control" name="confirmEmail" id="confirmEmail" type="email" placeholder="Re-Enter Your E-Mail" required/>

                  </div>

                </div>

              </div>

              <div class="row row-col-mob-gap">

                <div class="col-md-6">

                  <label>Telephone*</label>

                  <div class="form-group theme-contact-form-group">

                    <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter Your Contact Number" onkeypress="return isNumberKey(event)" required />

                  </div>

                </div>

                <div class="col-md-6">

                  <label>Address*</label>

                  <div class="form-group theme-contact-form-group">

                    <input class="form-control" name="address" id="address" type="text" placeholder="Enter Your Address" required/>

                  </div>

                </div>

              </div>

              <div class="row row-col-mob-gap">

                <div class="col-md-12">

                  <label>Message*</label>

                  <div class="form-group theme-contact-form-group">

                    <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>

                  </div>

                </div>

              </div>

                    <div class="row row-col-mob-gap">

                        <div class="col-md-12">

                            <br>

                            <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div><br>

                            <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">

                        </div>

                    </div>

              <div class="row row-col-mob-gap">

                <div class="col-md-6">

                  <button type="submit" id="submit-btn" class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Submit</button>

                </div>

                <div class="col-md-6">

                  <button type="submit" id="reset-btn" class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Reset</button>

                </div>

              </div>

              </form>

                <br>

                <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>

                <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>

            </div>

          </div>

        </div>

      </div>

    </div>











      <?php include 'inc_footer.php'; ?>

      <?php include 'inc_footer_scripts.php'; ?>

   </body>

</html>