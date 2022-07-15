<?php include "inc_opendb.php";
$PAGEID = "Settings";
$email="";

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
$current_currency             = "";
$current_language             = "";
$firstName                    = "";
$lastName                     = "";

if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email']))
{
    $email = $_SESSION['user_email'] ;


    $res = $db->query("SELECT * FROM users WHERE emailID = ?s",$email);

    if (mysqli_num_rows($res) > 0) {

        while ($row = mysqli_fetch_assoc($res)) {
            $_SESSION["email"]            = $row['emailID'];
            $_SESSION["current_currency"] = $row['currentCurrency'];
            $_SESSION["current_language"] = $row['currentLanguage'];

            $current_currency             = $row['currentCurrency'];
            $current_language             = $row['currentLanguage'];

            $firstName                    = $row['firstName'];
            $lastName                     = $row['lastName'];
            $emailID                      = $row['emailID'];
            $mobileNo                     = $row['mobileNo'];
            $countryd                     = $row['country'];
            $city                         = $row['city'];

            $nationalityd                 = $row['nationality'];
            $address                      = $row['address'];
            $state                        = $row['state'];
            $pincode                      = $row['pincode'];
            $visaStatus                   = $row['visaStatus'];

            $licenseNumber                = $row['licenseNumber'];
            $licenseExpiry                = $row['licenseExpiry'];
            $licensePlaceOfIssue          = $row['licensePlaceOfIssue'];
            $passportNumber               = $row['passportNumber'];
            $passportExpiry               = $row['passportExpiry'];
            $passportPlaceOfIssue         = $row['passportPlaceOfIssue'];

            $licenseAttachment            = $row['licenseAttachment'];
            $passportAttachment           = $row['passportAttachment'];

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
      <?php include 'inc_header.php'; ?>
     
     <div class="theme-hero-area theme-hero-area-half">
      <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(img/activity-adult-beach-beautiful-378152_1500x800.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
      </div>
      <div class="theme-hero-area-body">
        <div class="container">
          <div class="row">
            <div class="col-md-8 theme-page-header-abs">
              <div class="theme-page-header theme-page-header-lg">
                <h1 class="theme-page-header-title">Welcome <?php echo $firstName.' '.$lastName ; ?>!</h1>
                <p class="theme-page-header-subtitle">View and Edit all your preferences.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     
     
     
    
    <div class="theme-page-section theme-page-section-gray theme-page-section-lg">
      <div class="container">
        <div class="row">
          <div class="col-md-2-5 ">
            <div class="theme-account-sidebar">
              
              <nav class="theme-account-nav">
                <ul class="theme-account-nav-list">
                  <li >
                    <a href="profile">
                      <i class="fa fa-cog"></i>Profile
                    </a>
                  </li>
                  <li>
                    <a href="/history">
                      <i class="fa fa-bell"></i>Bookings
                    </a>
                  </li>
                  <!--<li>
                    <a href="/payments">
                      <i class="fa fa-credit-card"></i>Payment Methods
                    </a>
                  </li>-->
                  <li class="active">
                    <a href="/settings">
                      <i class="fa fa-user-circle-o"></i>Settings
                    </a>
                  </li>
                  
                  
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-md-9-5 ">
            
            <div class="row">
              <div class="col-md-9 ">
                <div class="theme-account-preferences">
                  <div class="theme-account-preferences-item">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Email Address</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value"><?php echo $email; ?></p>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  <div class="theme-account-preferences-item">
                      <form id="passwordForm" name="passwordForm" method="post">
                    <div class="row">
                      <div class="col-md-3 ">
                        <h5 class="theme-account-preferences-item-title">Password</h5>
                      </div>
                      <div class="col-md-7 ">
                        <p class="theme-account-preferences-item-value">********</p>
                        <div class="collapse" id="ChangePassword">
                          <div class="theme-account-preferences-item-change">
                            <p class="theme-account-preferences-item-change-description">It's a good idea to use a strong password
                              <br/>that you're not using elsewhere
                            </p>
                            <div class="form-group theme-account-preferences-item-change-form">
                              <label>Current Password</label>
                              <input class="form-control" type="password" id="currentpassword" name="currentpassword" required/>
                              <label>New Password</label>
                              <input class="form-control" type="password" id="newpassword" name="newpassword" required/>
                              <label>Re-type New Password</label>
                              <input class="form-control" type="password" id="retypepassword" name="retypepassword" required/>
                                <input class="form-control" type="hidden" id="email" name="email" value="<?php echo $email?>"/>
                            </div>
                            <div class="theme-account-preferences-item-change-actions">
                                <input type="submit" class="btn btn-sm btn-primary" id="submitpassword-btn" value="Save changes" />
                              <a class="btn btn-sm btn-default" href="#ChangePassword" data-toggle="collapse" aria-expanded="false" aria-controls="ChangePassword">Cancel</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2 ">
                        <a class="theme-account-preferences-item-change-link" href="#ChangePassword" data-toggle="collapse" aria-expanded="false" aria-controls="ChangePassword">
                          <i class="fa fa-pencil"></i>edit
                        </a>
                      </div>
                    </div>
                      </form>
                  </div>
                   
<!--                    -->
<!--                  <div class="theme-account-preferences-item">-->
<!--                      <form id="languageForm" name="languageForm" method="post">-->
<!--                    <div class="row">-->
<!--                      <div class="col-md-3 ">-->
<!--                        <h5 class="theme-account-preferences-item-title">Default Language</h5>-->
<!--                      </div>-->
<!--                      <div class="col-md-7 ">-->
<!--                        <p class="theme-account-preferences-item-value">-->
<!--                            --><?php //if($current_language == "en"){ echo "English (EN)"; }
//                            if($current_language == "ar"){ echo "Arabic (AR)"; }
//                            ?>
<!--                            </p>-->
<!--                        <div class="collapse" id="ChangeLanguage-1">-->
<!--                          <div class="theme-account-preferences-item-change">-->
<!--                            <div class="form-group theme-account-preferences-item-change-form">-->
<!--                              <select class="form-control" id="language" name="language">-->
<!--                                <option --><?php //if($current_language == "en"){ echo "selected"; }?><!--  value="en">English (EN)</option>-->
<!--                                 <option --><?php //if($current_language == "ar"){ echo "selected"; }?><!--  value="ar">Arabic (AR)</option>-->
<!--                              </select>-->
<!--                                <input class="form-control" type="hidden" id="email" name="email" value="--><?php //echo $email?><!--"/>-->
<!--                            </div>-->
<!--                            <div class="theme-account-preferences-item-change-actions">-->
<!--                                <input type="submit" class="btn btn-sm btn-primary" id="submitlanguage-btn" value="Save changes" />-->
<!--                              <a class="btn btn-sm btn-default" href="#ChangeLanguage-1" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeLanguage-1">Cancel</a>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="col-md-2 ">-->
<!--                        <a class="theme-account-preferences-item-change-link" href="#ChangeLanguage-1" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeLanguage-1">-->
<!--                          <i class="fa fa-pencil"></i>edit-->
<!--                        </a>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                      </form>-->
<!--                  </div>-->
<!--                  <div class="theme-account-preferences-item">-->
<!--                      <form id="currencyForm" name="currencyForm" method="post">-->
<!--                    <div class="row">-->
<!--                      <div class="col-md-3 ">-->
<!--                        <h5 class="theme-account-preferences-item-title">Default Currency</h5>-->
<!--                      </div>-->
<!--                      <div class="col-md-7 ">-->
<!--                        <p class="theme-account-preferences-item-value">--><?php
//                            if($current_currency == "USD"){ echo "US Dollar (USD)";}
//                            if($current_currency == "OMR"){ echo "Omani Riyal (OMR)"; }
//                        if($current_currency == "SAR"){ echo "Saudi Arabian Riyal (SAR)"; }
//                        if($current_currency == "AED"){ echo "U.A.E Dirham (AED)"; }
//                        ?>
<!--                        </p>-->
<!--                        <div class="collapse" id="ChangeCurrency">-->
<!--                          <div class="theme-account-preferences-item-change">-->
<!--                            <div class="form-group theme-account-preferences-item-change-form">-->
<!--                              <select class="form-control" id="currency" name="currency">-->
<!--                                  <option --><?php //if($current_currency == "AED"){ echo "selected"; }?><!-- value="AED">U.A.E Dirham (AED)</option>-->
<!--                                  <option --><?php //if($current_currency == "USD"){ echo "selected"; }?><!-- value="USD">US Dollar (USD)</option>-->
<!--                                <option --><?php //if($current_currency == "OMR"){ echo "selected"; }?><!-- value="OMR">Omani Riyal (OMR)</option>-->
<!--                                <option --><?php //if($current_currency == "SAR"){ echo "selected"; }?><!-- value="SAR">Saudi Arabian Riyal (SAR)</option>-->
<!---->
<!--                              </select>-->
<!--                                <input class="form-control" type="hidden" id="email" name="email" value="--><?php //echo $email?><!--"/>-->
<!--                            </div>-->
<!--                            <div class="theme-account-preferences-item-change-actions">-->
<!--                                <input type="submit" class="btn btn-sm btn-primary" id="submitcurrency-btn" value="Save changes" />-->
<!--                              <a class="btn btn-sm btn-default" href="#ChangeCurrency" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeCurrency">Cancel</a>-->
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                      <div class="col-md-2 ">-->
<!--                        <a class="theme-account-preferences-item-change-link" href="#ChangeCurrency" data-toggle="collapse" aria-expanded="false" aria-controls="ChangeCurrency">-->
<!--                          <i class="fa fa-pencil"></i>edit-->
<!--                        </a>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </form>-->
<!--                  </div>-->
<!--                  -->
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