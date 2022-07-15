<?php include "inc_opendb.php";

$PAGEID = "Corporate Customized Solutions";

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

      $pageID = '18';

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

                <?php echo $row['summary']; ?>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

      

<div class="theme-page-section theme-page-section-lg">

      <div class="container">

        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">

          <div class="col-md-8 ">



            

            <form id="corporateSolutionForm" name="corporateSolutionForm" method="post" enctype="multipart/form-data">



                <div class="theme-payment-page-sections-item">

                    <h3 class="theme-payment-page-sections-item-title">Send Us Your Enquiry</h3>

                    <div class="theme-payment-page-form">

                        <div class="row row-col-gap" data-gutter="20">

                            <div class="col-md-6 ">

                                <div class="theme-payment-page-form-item form-group">

                                    <input class="form-control" type="text" id="fullName"  required name="fullName" placeholder="Name"/>

                                </div>

                            </div>

                            <div class="col-md-6 ">

                                <div class="theme-payment-page-form-item form-group">

                                    <input class="form-control" type="text" id="companyName"  name="companyName" placeholder=" Company Name" required/>

                                </div>

                            </div>

                            <div class="col-md-6 ">

                                <div class="theme-payment-page-form-item form-group">

                                    <input class="form-control" type="email" id="email"  name="email" placeholder="Email Address" required/>

                                </div>

                            </div>

                            <div class="col-md-6 ">

                                <div class="theme-payment-page-form-item form-group">

                                    <input class="form-control" type="text" id="phone"  name="phone" placeholder="Phone Number" required onkeypress="return isNumberKey(event)"/>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="theme-payment-page-sections-item">

                    <h3 class="theme-payment-page-sections-item-title">Requirement</h3>

                    <div class="theme-payment-page-form _mb-20">



                        <div class="row row-col-gap" data-gutter="20">



                            <div class="col-md-6 ">

                                <div class="theme-payment-page-form-item form-group">

                                    <input class="form-control" type="text" id="vehicleInterested"  required name="vehicleInterested" placeholder="Vehicle Interested In" re/>

                                </div>

                            </div>

                            <div class="col-md-6 ">

                                <div class="theme-payment-page-form-item form-group">

                                    <input class="form-control" type="text" id="noOfVehicles"  name="noOfVehicles" placeholder=" Number of Vehicles" required/>

                                </div>

                            </div>



                            <div class="col-md-12">


                                <h3 class="theme-payment-page-sections-item-title">Vehicle Category</h3>

                                <?php

                                $result = $db->query( "SELECT * FROM mtr_bodytype WHERE active = 1 ORDER BY bodyType ASC" );

                                while ( $row = mysqli_fetch_assoc( $result ) )

                                {

                                    ?>
                                    <div class="col-md-3">
                                        <input type="checkbox" id="bodyType<?php echo $row['bodyTypeID']; ?>" name="bodyType<?php echo $row['bodyTypeID']; ?>" value="<?php echo $row['bodyTypeID']; ?>">

                                        <label for="bodyType<?php echo $row['bodyTypeID']; ?>"><?php echo $row['bodytype']; ?></label><br>
                                    </div>
                                    <?php

                                }

                                ?>


                            </div>



                            <div class="col-md-12 ">

                                <div class="form-group theme-contact-form-group">

                                    <textarea class="form-control" rows="5" id="specialRequirement" required name="specialRequirement" placeholder="Specific Requirement"></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="theme-payment-page-form _mb-20">

                        <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div><br>

                        <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">

                    </div>

                </div>

                <div class="theme-payment-page-sections-item">

                    <div class="theme-payment-page-booking">

                        <input type="submit" class="btn _tt-uc btn-primary-inverse btn-lg btn-block" id="corporateSolution-btn" name="corporateSolution-btn" value="Submit" />

                    </div>

                </div>



            </form>

              <br>

              <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>

              <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>



              <div class="theme-item-page-details _pv-45 theme-item-page-details-first-nm">

                  <div class="theme-item-page-details-section">

                      <div class="row">



                          <?php

                          $result = $db->query("SELECT * FROM corporate_solutions");

                          $row = mysqli_fetch_assoc($result);

                          ?>



                          <div class="theme-item-page-desc">

                              <?php echo $row['description'];?>

                          </div>

                      </div>

                  </div>











              </div>







          </div>

          <div class="col-md-4 ">

            <div class="sticky-col">

              

              

              <div class="theme-sidebar-section _mb-10">

                  <?php include "inc_corporate_sidebar.php";?>

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