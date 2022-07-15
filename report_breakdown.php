<?php include "inc_opendb.php";
$PAGEID = "Road Side Assistance";

$email="";
$firstName                    = "";
$lastName                     = "";
$emailID                      = "";
$mobileNo                     = "";

if(isset($_SESSION['email']) && !empty($_SESSION['email']))
{
    $email = $_SESSION['email'] ;


    $res = $db->query("SELECT * FROM users WHERE emailID = ?s",$email);

    if (mysqli_num_rows($res) > 0) {

        while ($row = mysqli_fetch_assoc($res)) {
            $_SESSION["email"]            = $row['emailID'];
            $_SESSION["current_currency"] = $row['currentCurrency'];
            $_SESSION["current_language"] = $row['currentLanguage'];



            $firstName                    = $row['firstName'];
            $lastName                     = $row['lastName'];
            $emailID                      = $row['emailID'];
            $mobileNo                     = $row['mobileNo'];


        }

    }

}
?>
<!DOCTYPE HTML>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <?php include 'inc_metadata.php'; ?>
   </head>
   <body>
      <?php include 'inc_header.php';


      $pageID = '22';
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
                <p class="theme-page-header-subtitle"><?php echo $row['summary'];?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      

     
 <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
          <div class="col-md-12 ">
            <div class="theme-payment-page-sections">
<!--              <div class="theme-payment-page-sections-item">-->
<!--                  --><?php //if($emailID=="") {
//                      ?>
<!---->
<!--                  <div class="theme-payment-page-signin">-->
<!--                  <i class="theme-payment-page-signin-icon fa fa-user-circle-o"></i>-->
<!--                  <div class="theme-payment-page-signin-body">-->
<!--                    <h4 class="theme-payment-page-signin-title">Sign in if you have an account</h4>-->
<!--                    <p class="theme-payment-page-signin-subtitle">We will retrieve bookings and credit cards for faster processing</p>-->
<!--                  </div>-->
<!---->
<!--                  <a class="btn theme-payment-page-signin-btn btn-primary" href="#">Sign in</a>-->
<!--                </div>-->
<!--                  --><?php //} ?>
<!--              </div>-->

                <form id="ReportbreakdownForm" name="ReportbreakdownForm" method="post" enctype="multipart/form-data">

              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Enter Driver Details</h3>
                <div class="theme-payment-page-form">
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="firstname" value="<?php echo $firstName; ?>" required name="firstname" placeholder="First Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="lastname" required value="<?php echo $lastName; ?>" name="lastname" placeholder="Last Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="email" id="email" required value="<?php echo $emailID; ?>" name="email" placeholder="Email Address"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="phone" required value="<?php echo $mobileNo; ?>" name="phone" placeholder="Phone Number" onkeypress="return isNumberKey(event)"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">About Your Breakdown</h3>
                <div class="theme-payment-page-form _mb-20">
                  
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="bookingreferencenumber" required name="bookingreferencenumber" placeholder="Booking Reference Number"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" id="breakdownlocation" required name="breakdownlocation" placeholder="Breakdown Location"/>
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group theme-contact-form-group">
                    <textarea class="form-control" rows="5" id="causeforbreakdown" required name="causeforbreakdown" placeholder="Cause For Breakdown"></textarea>
                  </div>
                    </div>
                      <?php
                      $pageID = '24';
                      $result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);
                      $row = mysqli_fetch_assoc($result);
                      ?>
                    <p class="txt-red"><?php echo $row['pageTitle'];?></p><br>
                      <div class="col-md-12 ">
                          <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div><br>
                          <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">
                      </div>
                    
                  </div>
                </div>
                
              </div>
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">

               <input type="submit" class="btn _tt-uc btn-primary-inverse btn-lg btn-block" id="submitreport-btn" name="submitreport-btn" value="Lodge A Complaint" />

                </div>
              </div>

                </form>
                <br>
                <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
                <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
            </div>
          </div>
<!--          <div class="col-md-4 ">-->
<!--            <div class="sticky-col">-->
<!--              -->
<!--              -->
<!--              <div class="theme-sidebar-section _mb-10">-->
<!--                <ul class="theme-sidebar-section-features-list">-->
<!--                  -->
<!--                  <li>-->
<!--                    <h5 class="theme-sidebar-section-features-list-title">Hassle Free Car Rentals and Leasing!</h5>-->
<!--                    <p class="theme-sidebar-section-features-list-body">Daily, Weekly and Monthly Car rentals available.</p>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                    <h5 class="theme-sidebar-section-features-list-title">Manage your bookings!</h5>-->
<!--                    <p class="theme-sidebar-section-features-list-body">You're in control of your booking.</p>-->
<!--                  </li>-->
<!--                  <li>-->
<!--                    <h5 class="theme-sidebar-section-features-list-title">Customer support available 24/7 throughout the GCC!</h5>-->
<!--                    <p class="theme-sidebar-section-features-list-body">Satisfaction of the customer is our number one priority.</p>-->
<!--                  </li>-->
<!--                </ul>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
        </div>
      </div>
    </div>
     

      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>



<!--      $('#bookingreferencenumber').on('change', function(e){-->
<!--      var refNumber = document.getElementById("bookingreferencenumber");-->
<!---->
<!--      --><?php
//      $bookingNumber ="<script>document.getElementById('bookingreferencenumber');</script>";
//
//
//      $bookingResult = $db->query( "SELECT * FROM inb_bookings WHERE bookingNumber = ?s", $bookingNumber );
//      $bookingRow    = mysqli_fetch_assoc( $bookingResult );
//      ?>
<!---->
<!--      alert(--><?php //echo $bookingNumber ;?><!--);-->
<!---->
<!---->
<!---->
<!--      });-->



   </body>
</html>