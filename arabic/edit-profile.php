<?php
require '../lib/config/config.php';
require '../lib/config/autoload.php';

$user = userdb::getInstance();
$booking = bookingdb::getInstance();
$location = dbcountrylocation::getInstance();
$vehical = vehical::getInstance();


if ($user->checkLogin() == false) {
  header('Location: index.php');exit;
}
$id = $user->getUseerIDfromSession();
$profile = $user->fetch_profile($id);

$is_booking="edit_profile";
if(isset($_GET['process'])and $_GET['process']=="booking")
{
    $is_booking="booking";
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title><?php echo $pagetitle['EP'];?> </title>
    </head>
    <body>
 <!-- ==========================================================================
                              Header Area 
   ========================================================================== -->
      <section class="dashboard-head">
       <?php echo $mainnav; ?> 
              <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>
  </section>


       <!-- ==========================================================================
                           section one
   ========================================================================== -->
   <section class="header-search">
    
        <div class="search-cover">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Edit Your Profile</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

<section class="dashboar-content">

  <div class="container" style="  background-color: #fff; padding: 40px;">
    

  <?php echo $dashnavbar; ?>



    <div class="col-md-9 ">
    <div class="right-side">
    
        <h2 style="  padding: 10px 15px;">Edit Profile</h2>
   
        <form method="post" class="edit-form" action="../include/edit_profile.php" id="editform" enctype="multipart/form-data">


              <div class="col-md-12">
                     <?php
           
            if($profile['img_url']!="")
            {

                ?>
                    <img src="../images/user_images/profile/<?php echo $profile['img_url'];?>" alt="" height="75px" style="  margin-bottom: 40px;">
                <?php
                }
                ?>

        
          </div>

                                <?php

if (isset($_GET['updateSuccess']) && $_GET['updateSuccess'] == 1) {
  echo "  <div class='clearfix '></div>   <div class='col-md-12'><div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Profile is Successfully Updated..</div></div>";
}

if (isset($_GET['error']) && $_GET['error'] == 1) {
  echo " <div class='clearfix'></div> <div class='col-md-12'> <div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Please Enter Required Fields.
</div></div>";
} else if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo  " <div class='clearfix'></div><div class='col-md-12'>  <div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Error while updating Profile.
</div></div>";
} else if (isset($_GET['error']) && $_GET['error'] == 3) {
    
     echo  "  <div class='clearfix'></div> <div class='col-md-12'><div class='clearfix'></div> <div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Only Letters Are Allowed For First Name.
</div></div>";

} else if (isset($_GET['error']) && $_GET['error'] == 4) {
      echo  " <div class='clearfix'></div>  <div class='col-md-12'><div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Only Letters Are Allowed For Last Name.
</div></div>";
} else if (isset($_GET['error']) && $_GET['error'] == 5) {
    
        echo  " <div class='clearfix'></div>  <div class='col-md-12'><div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Only Letters And Numbers Are Allowed For Address.
</div></div>";
} else if (isset($_GET['error']) && $_GET['error'] == 6) {
    
        echo  "  <div class='clearfix'></div> <div class='col-md-12'><div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Only Letters Are Allowed For City.
</div></div>";
} else if (isset($_GET['error']) && $_GET['error'] == 7) {
    
    
        echo  " <div class='clearfix'></div> <div class='col-md-12'><div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Only Numbers Are Allowed For Postal Code.
</div></div>";
}
else if (isset($_GET['error']) && $_GET['error'] == 8) {
    
    
        echo  " <div class='clearfix'></div> <div class='col-md-12'><div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong> Enter Number in This formate +96824571951
</div></div>";
}

else if (isset($_GET['error']) && $_GET['error'] == 9) {
    
    
        echo  " <div class='clearfix'></div> <div class='col-md-12'><div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Error!</strong>Please Enter Valid Email.
</div></div>";
}
?>
<input type="hidden" class="edit-input" id="process" name="process" value="<?php echo $is_booking;?>">
          <div class="col-md-6">
            <label for="fname">First Name : <span class="glyphicon glyphicon-asterisk"  style="color:red;font-size: 11px;"></span></label>
            <input type="text" class="edit-input" id="fname" name="fname" value="<?php echo $profile['fname'];?>">
          </div>


          <div class="col-md-6">
          <label for="name">Last Name : <span class="glyphicon glyphicon-asterisk"  style="color:red;font-size: 11px;"></span></label>
            <input type="text" class="edit-input" id="lname"  name="lname"  value="<?php echo $profile['lname'];?>">
          </div>
          
          <div class="col-md-6">
          <label for="name">Email : <span class="glyphicon glyphicon-asterisk"  style="color:red;font-size: 11px;"></span></label>
            <input type="text" class="edit-input" id="email"  name="email"  value="<?php echo $profile['email'];?>">
          </div>


          <div class="col-md-6">
          <label for="address">Address</label>
            <input type="text" class="edit-input" id="address"  name="address"  value="<?php echo $profile['address'];?>">
          </div>



          <div class="col-md-6">
          <label for="city1">City</label>
            <input type="text" class="edit-input" id="city"  name="city"  value="<?php echo $profile['city'];?>">
          </div>

            <div class="col-md-6">
          <label for="postal_code">Postal Code</label>
            <input type="text" class="edit-input" id="postal_code"  name="postal_code"  value="<?php echo $profile['postal_code'];?>">
          </div>

         

            <div class="col-md-6">
          <label for="country1">Country : <span class="glyphicon glyphicon-asterisk"  style="color:red;font-size: 11px;"></span></label>
            <select name="country" id="country" style="    padding-right: 25px;">
<option value="" selected="selected">Select Country</option>
<option value="Afghanistan" <?php if ($profile['country'] == "Afghanistan") {
  ?> selected<?php }
?>>Afghanistan</option>
<option value="Albania" <?php if ($profile['country'] == "Albania") {
  ?> selected<?php }
?>>Albania</option>
<option value="Algeria" <?php if ($profile['country'] == "Algeria") {
  ?> selected<?php }
?>>Algeria</option>
<option value="American Samoa" <?php if ($profile['country'] == "American Samoa") {
  ?> selected<?php }
?>>American Samoa</option>
<option value="Andorra" <?php if ($profile['country'] == "Andorra") {
  ?> selected<?php }
?>>Andorra</option>
<option value="Angola" <?php if ($profile['country'] == "Angola") {
  ?> selected<?php }
?>>Angola</option>
<option value="Anguilla" <?php if ($profile['country'] == "Anguilla") {
  ?> selected<?php }
?>>Anguilla</option>
<option value="Antarctica" <?php if ($profile['country'] == "Antarctica") {
  ?> selected<?php }
?>>Antarctica</option>
<option value="Antigua and Barbuda" <?php if ($profile['country'] == "Antigua and Barbuda") {
  ?> selected<?php }
?>>Antigua and Barbuda</option>
<option value="Argentina" <?php if ($profile['country'] == "Argentina") {
  ?> selected<?php }
?>>Argentina</option>
<option value="Armenia" <?php if ($profile['country'] == "Armenia") {
  ?> selected<?php }
?>>Armenia</option>
<option value="Aruba" <?php if ($profile['country'] == "Aruba") {
  ?> selected<?php }
?>>Aruba</option>
<option value="Australia" <?php if ($profile['country'] == "Australia") {
  ?> selected<?php }
?>>Australia</option>
<option value="Austria" <?php if ($profile['country'] == "Austria") {
  ?> selected<?php }
?>>Austria</option>
<option value="Azerbaijan" <?php if ($profile['country'] == "Azerbaijan") {
  ?> selected<?php }
?>>Azerbaijan</option>
<option value="Bahamas" <?php if ($profile['country'] == "Bahamas") {
  ?> selected<?php }
?>>Bahamas</option>
<option value="Bahrain" <?php if ($profile['country'] == "Bahrain") {
  ?> selected<?php }
?>>Bahrain</option>
<option value="Bangladesh" <?php if ($profile['country'] == "Bangladesh") {
  ?> selected<?php }
?>>Bangladesh</option>
<option value="Barbados" <?php if ($profile['country'] == "Barbados") {
  ?> selected<?php }
?>>Barbados</option>
<option value="Belarus" <?php if ($profile['country'] == "Belarus") {
  ?> selected<?php }
?>>Belarus</option>
<option value="Belgium" <?php if ($profile['country'] == "Belgium") {
  ?> selected<?php }
?>>Belgium</option>
<option value="Belize" <?php if ($profile['country'] == "Belize") {
  ?> selected<?php }
?>>Belize</option>
<option value="Benin" <?php if ($profile['country'] == "Benin") {
  ?> selected<?php }
?>>Benin</option>
<option value="Bermuda" <?php if ($profile['country'] == "Bermuda") {
  ?> selected<?php }
?>>Bermuda</option>
<option value="Bhutan" <?php if ($profile['country'] == "Bhutan") {
  ?> selected<?php }
?>>Bhutan</option>
<option value="Bolivia" <?php if ($profile['country'] == "Bolivia") {
  ?> selected<?php }
?>>Bolivia</option>
<option value="Bosnia and Herzegovina" <?php if ($profile['country'] == "Bosnia and Herzegovina") {
  ?> selected<?php }
?>>Bosnia and Herzegovina</option>
<option value="Botswana" <?php if ($profile['country'] == "Botswana") {
  ?> selected<?php }
?>>Botswana</option>
<option value="Bouvet Island" <?php if ($profile['country'] == "Bouvet Island") {
  ?> selected<?php }
?>>Bouvet Island</option>
<option value="Brazil" <?php if ($profile['country'] == "Brazil") {
  ?> selected<?php }
?>>Brazil</option>
<option value="British Indian Ocean Territory" <?php if ($profile['country'] == "British Indian Ocean Territory") {
  ?> selected<?php }
?>>British Indian Ocean Territory</option>
<option value="Brunei Darussalam" <?php if ($profile['country'] == "Brunei Darussalam") {
  ?> selected<?php }
?>>Brunei Darussalam</option>
<option value="Bulgaria" <?php if ($profile['country'] == "Bulgaria") {
  ?> selected<?php }
?>>Bulgaria</option>
<option value="Burkina Faso" <?php if ($profile['country'] == "Burkina Faso") {
  ?> selected<?php }
?>>Burkina Faso</option>
<option value="Burundi" <?php if ($profile['country'] == "Burundi") {
  ?> selected<?php }
?>>Burundi</option>
<option value="Cambodia" <?php if ($profile['country'] == "Cambodia") {
  ?> selected<?php }
?>>Cambodia</option>
<option value="Cameroon" <?php if ($profile['country'] == "Cameroon") {
  ?> selected<?php }
?>>Cameroon</option>
<option value="Canada" <?php if ($profile['country'] == "Canada") {
  ?> selected<?php }
?>>Canada</option>
<option value="Cape Verde" <?php if ($profile['country'] == "Cape Verde") {
  ?> selected<?php }
?>>Cape Verde</option>
<option value="Cayman Islands" <?php if ($profile['country'] == "Cayman Islands") {
  ?> selected<?php }
?>>Cayman Islands</option>
<option value="Central African Republic" <?php if ($profile['country'] == "Central African Republic") {
  ?> selected<?php }
?>>Central African Republic</option>
<option value="Chad" <?php if ($profile['country'] == "Chad") {
  ?> selected<?php }
?>>Chad</option>
<option value="Chile" <?php if ($profile['country'] == "Chile") {
  ?> selected<?php }
?>>Chile</option>
<option value="China" <?php if ($profile['country'] == "China") {
  ?> selected<?php }
?>>China</option>
<option value="Christmas Island" <?php if ($profile['country'] == "Christmas Island") {
  ?> selected<?php }
?>>Christmas Island</option>
<option value="Cocos (Keeling) Islands" <?php if ($profile['country'] == "Cocos (Keeling) Islands") {
  ?> selected<?php }
?>>Cocos (Keeling) Islands</option>
<option value="Colombia" <?php if ($profile['country'] == "Colombia") {
  ?> selected<?php }
?>>Colombia</option>
<option value="Comoros" <?php if ($profile['country'] == "Comoros") {
  ?> selected<?php }
?>>Comoros</option>
<option value="Congo" <?php if ($profile['country'] == "Congo") {
  ?> selected<?php }
?>>Congo</option>
<option value="Congo, The Democratic Republic of The" <?php if ($profile['country'] == "Congo, The Democratic Republic of The") {
  ?> selected<?php }
?>>Congo, The Democratic Republic of The</option>
<option value="Cook Islands" <?php if ($profile['country'] == "Cook Islands") {
  ?> selected<?php }
?>>Cook Islands</option>
<option value="Costa Rica" <?php if ($profile['country'] == "Costa Rica") {
  ?> selected<?php }
?>>Costa Rica</option>
<option value="Cote D'ivoire" <?php if ($profile['country'] == "Cote D'ivoire") {
  ?> selected<?php }
?>>Cote D'ivoire</option>
<option value="Croatia" <?php if ($profile['country'] == "Croatia") {
  ?> selected<?php }
?>>Croatia</option>
<option value="Cuba" <?php if ($profile['country'] == "Cuba") {
  ?> selected<?php }
?>>Cuba</option>
<option value="Cyprus" <?php if ($profile['country'] == "Cyprus") {
  ?> selected<?php }
?>>Cyprus</option>
<option value="Czech Republic" <?php if ($profile['country'] == "Czech Republic") {
  ?> selected<?php }
?>>Czech Republic</option>
<option value="Denmark" <?php if ($profile['country'] == "Denmark") {
  ?> selected<?php }
?>>Denmark</option>
<option value="Djibouti" <?php if ($profile['country'] == "Djibouti") {
  ?> selected<?php }
?>>Djibouti</option>
<option value="Dominica" <?php if ($profile['country'] == "Dominica") {
  ?> selected<?php }
?>>Dominica</option>
<option value="Dominican Republic" <?php if ($profile['country'] == "Dominican Republic") {
  ?> selected<?php }
?>>Dominican Republic</option>
<option value="Ecuador" <?php if ($profile['country'] == "Ecuador") {
  ?> selected<?php }
?>>Ecuador</option>
<option value="Egypt" <?php if ($profile['country'] == "Egypt") {
  ?> selected<?php }
?>>Egypt</option>
<option value="El Salvador" <?php if ($profile['country'] == "El Salvador") {
  ?> selected<?php }
?>>El Salvador</option>
<option value="Equatorial Guinea" <?php if ($profile['country'] == "Equatorial Guinea") {
  ?> selected<?php }
?>>Equatorial Guinea</option>
<option value="Eritrea" <?php if ($profile['country'] == "Eritrea") {
  ?> selected<?php }
?>>Eritrea</option>
<option value="Estonia" <?php if ($profile['country'] == "Estonia") {
  ?> selected<?php }
?>>Estonia</option>
<option value="Ethiopia" <?php if ($profile['country'] == "Ethiopia") {
  ?> selected<?php }
?>>Ethiopia</option>
<option value="Falkland Islands (Malvinas)" <?php if ($profile['country'] == "Falkland Islands (Malvinas)") {
  ?> selected<?php }
?>>Falkland Islands (Malvinas)</option>
<option value="Faroe Islands" <?php if ($profile['country'] == "Faroe Islands") {
  ?> selected<?php }
?>>Faroe Islands</option>
<option value="Fiji" <?php if ($profile['country'] == "Fiji") {
  ?> selected<?php }
?>>Fiji</option>
<option value="Finland" <?php if ($profile['country'] == "Finland") {
  ?> selected<?php }
?>>Finland</option>
<option value="France" <?php if ($profile['country'] == "France") {
  ?> selected<?php }
?>>France</option>
<option value="French Guiana" <?php if ($profile['country'] == "French Guiana") {
  ?> selected<?php }
?>>French Guiana</option>
<option value="French Polynesia" <?php if ($profile['country'] == "French Polynesia") {
  ?> selected<?php }
?>>French Polynesia</option>
<option value="French Southern Territories" <?php if ($profile['country'] == "French Southern Territories") {
  ?> selected<?php }
?>>French Southern Territories</option>
<option value="Gabon" <?php if ($profile['country'] == "Gabon") {
  ?> selected<?php }
?>>Gabon</option>
<option value="Gambia" <?php if ($profile['country'] == "Gambia") {
  ?> selected<?php }
?>>Gambia</option>
<option value="Georgia" <?php if ($profile['country'] == "Georgia") {
  ?> selected<?php }
?>>Georgia</option>
<option value="Germany" <?php if ($profile['country'] == "Germany") {
  ?> selected<?php }
?>>Germany</option>
<option value="Ghana" <?php if ($profile['country'] == "Ghana") {
  ?> selected<?php }
?>>Ghana</option>
<option value="Gibraltar" <?php if ($profile['country'] == "Gibraltar") {
  ?> selected<?php }
?>>Gibraltar</option>
<option value="Greece" <?php if ($profile['country'] == "Greece") {
  ?> selected<?php }
?>>Greece</option>
<option value="Greenland" <?php if ($profile['country'] == "Greenland") {
  ?> selected<?php }
?>>Greenland</option>
<option value="Grenada" <?php if ($profile['country'] == "Grenada") {
  ?> selected<?php }
?>>Grenada</option>
<option value="Guadeloupe" <?php if ($profile['country'] == "Guadeloupe") {
  ?> selected<?php }
?>>Guadeloupe</option>
<option value="Guam" <?php if ($profile['country'] == "Guam") {
  ?> selected<?php }
?>>Guam</option>
<option value="Guatemala" <?php if ($profile['country'] == "Guatemala") {
  ?> selected<?php }
?>>Guatemala</option>
<option value="Guinea" <?php if ($profile['country'] == "Guinea") {
  ?> selected<?php }
?>>Guinea</option>
<option value="Guinea-bissau" <?php if ($profile['country'] == "Guinea-bissau") {
  ?> selected<?php }
?>>Guinea-bissau</option>
<option value="Guyana" <?php if ($profile['country'] == "Guyana") {
  ?> selected<?php }
?>>Guyana</option>
<option value="Haiti" <?php if ($profile['country'] == "Haiti") {
  ?> selected<?php }
?>>Haiti</option>
<option value="Heard Island and Mcdonald Islands" <?php if ($profile['country'] == "Heard Island and Mcdonald Islands") {
  ?> selected<?php }
?>>Heard Island and Mcdonald Islands</option>
<option value="Holy See (Vatican City State)" <?php if ($profile['country'] == "Holy See (Vatican City State)") {
  ?> selected<?php }
?>>Holy See (Vatican City State)</option>
<option value="Honduras" <?php if ($profile['country'] == "Honduras") {
  ?> selected<?php }
?>>Honduras</option>
<option value="Hong Kong" <?php if ($profile['country'] == "Hong Kong") {
  ?> selected<?php }
?>>Hong Kong</option>
<option value="Hungary" <?php if ($profile['country'] == "Hungary") {
  ?> selected<?php }
?>>Hungary</option>
<option value="Iceland" <?php if ($profile['country'] == "Iceland") {
  ?> selected<?php }
?>>Iceland</option>
<option value="India" <?php if ($profile['country'] == "India") {
  ?> selected<?php }
?>>India</option>
<option value="Indonesia" <?php if ($profile['country'] == "Indonesia") {
  ?> selected<?php }
?>>Indonesia</option>
<option value="Iran, Islamic Republic of" <?php if ($profile['country'] == "Iran, Islamic Republic of") {
  ?> selected<?php }
?>>Iran, Islamic Republic of</option>
<option value="Iraq" <?php if ($profile['country'] == "Iraq") {
  ?> selected<?php }
?>>Iraq</option>
<option value="Ireland" <?php if ($profile['country'] == "Ireland") {
  ?> selected<?php }
?>>Ireland</option>
<option value="Israel" <?php if ($profile['country'] == "Israel") {
  ?> selected<?php }
?>>Israel</option>
<option value="Italy" <?php if ($profile['country'] == "Italy") {
  ?> selected<?php }
?>>Italy</option>
<option value="Jamaica" <?php if ($profile['country'] == "Jamaica") {
  ?> selected<?php }
?>>Jamaica</option>
<option value="Japan" <?php if ($profile['country'] == "Japan") {
  ?> selected<?php }
?>>Japan</option>
<option value="Jordan" <?php if ($profile['country'] == "Jordan") {
  ?> selected<?php }
?>>Jordan</option>
<option value="Kazakhstan" <?php if ($profile['country'] == "Kazakhstan") {
  ?> selected<?php }
?>>Kazakhstan</option>
<option value="Kenya" <?php if ($profile['country'] == "Kenya") {
  ?> selected<?php }
?>>Kenya</option>
<option value="Kiribati" <?php if ($profile['country'] == "Kiribati") {
  ?> selected<?php }
?>>Kiribati</option>
<option value="Korea, Democratic People's Republic of" <?php if ($profile['country'] == "Korea, Democratic People's Republic of") {
  ?> selected<?php }
?>>Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of" <?php if ($profile['country'] == "Korea, Republic of") {
  ?> selected<?php }
?>>Korea, Republic of</option>
<option value="Kuwait" <?php if ($profile['country'] == "Kuwait") {
  ?> selected<?php }
?>>Kuwait</option>
<option value="Kyrgyzstan" <?php if ($profile['country'] == "Kyrgyzstan") {
  ?> selected<?php }
?>>Kyrgyzstan</option>
<option value="Lao People's Democratic Republic" <?php if ($profile['country'] == "Lao People's Democratic Republic") {
  ?> selected<?php }
?>>Lao People's Democratic Republic</option>
<option value="Latvia" <?php if ($profile['country'] == "Latvia") {
  ?> selected<?php }
?>>Latvia</option>
<option value="Lebanon" <?php if ($profile['country'] == "Lebanon") {
  ?> selected<?php }
?>>Lebanon</option>
<option value="Lesotho" <?php if ($profile['country'] == "Lesotho") {
  ?> selected<?php }
?>>Lesotho</option>
<option value="Liberia" <?php if ($profile['country'] == "Liberia") {
  ?> selected<?php }
?>>Liberia</option>
<option value="Libyan Arab Jamahiriya" <?php if ($profile['country'] == "Libyan Arab Jamahiriya") {
  ?> selected<?php }
?>>Libyan Arab Jamahiriya</option>
<option value="Liechtenstein" <?php if ($profile['country'] == "Liechtenstein") {
  ?> selected<?php }
?>>Liechtenstein</option>
<option value="Lithuania" <?php if ($profile['country'] == "Lithuania") {
  ?> selected<?php }
?>>Lithuania</option>
<option value="Luxembourg" <?php if ($profile['country'] == "Luxembourg") {
  ?> selected<?php }
?>>Luxembourg</option>
<option value="Macao" <?php if ($profile['country'] == "Macao") {
  ?> selected<?php }
?>>Macao</option>
<option value="Macedonia, The Former Yugoslav Republic of" <?php if ($profile['country'] == "Macedonia, The Former Yugoslav Republic of") {
  ?> selected<?php }
?>>Macedonia, The Former Yugoslav Republic of</option>
<option value="Madagascar" <?php if ($profile['country'] == "Madagascar") {
  ?> selected<?php }
?>>Madagascar</option>
<option value="Malawi" <?php if ($profile['country'] == "Malawi") {
  ?> selected<?php }
?>>Malawi</option>
<option value="Malaysia" <?php if ($profile['country'] == "Malaysia") {
  ?> selected<?php }
?>>Malaysia</option>
<option value="Maldives" <?php if ($profile['country'] == "Maldives") {
  ?> selected<?php }
?>>Maldives</option>
<option value="Mali" <?php if ($profile['country'] == "Mali") {
  ?> selected<?php }
?>>Mali</option>
<option value="Malta" <?php if ($profile['country'] == "Malta") {
  ?> selected<?php }
?>>Malta</option>
<option value="Marshall Islands" <?php if ($profile['country'] == "Marshall Islands") {
  ?> selected<?php }
?>>Marshall Islands</option>
<option value="Martinique" <?php if ($profile['country'] == "Martinique") {
  ?> selected<?php }
?>>Martinique</option>
<option value="Mauritania" <?php if ($profile['country'] == "Mauritania") {
  ?> selected<?php }
?>>Mauritania</option>
<option value="Mauritius" <?php if ($profile['country'] == "Mauritius") {
  ?> selected<?php }
?>>Mauritius</option>
<option value="Mayotte" <?php if ($profile['country'] == "Mayotte") {
  ?> selected<?php }
?>>Mayotte</option>
<option value="Mexico" <?php if ($profile['country'] == "Mexico") {
  ?> selected<?php }
?>>Mexico</option>
<option value="Micronesia, Federated States of" <?php if ($profile['country'] == "Micronesia, Federated States of") {
  ?> selected<?php }
?>>Micronesia, Federated States of</option>
<option value="Moldova, Republic of" <?php if ($profile['country'] == "Moldova, Republic of") {
  ?> selected<?php }
?>>Moldova, Republic of</option>
<option value="Monaco" <?php if ($profile['country'] == "Monaco") {
  ?> selected<?php }
?>>Monaco</option>
<option value="Mongolia" <?php if ($profile['country'] == "Mongolia") {
  ?> selected<?php }
?> >Mongolia</option>
<option value="Montserrat" <?php if ($profile['country'] == "Montserrat") {
  ?> selected<?php }
?>>Montserrat</option>
<option value="Morocco" <?php if ($profile['country'] == "Morocco") {
  ?> selected<?php }
?> >Morocco</option>
<option value="Mozambique" <?php if ($profile['country'] == "Mozambique") {
  ?> selected<?php }
?>>Mozambique</option>
<option value="Myanmar" <?php if ($profile['country'] == "Myanmar") {
  ?> selected<?php }
?> >Myanmar</option>
<option value="Namibia" <?php if ($profile['country'] == "Namibia") {
  ?> selected<?php }
?>>Namibia</option>
<option value="Nauru" <?php if ($profile['country'] == "Nauru") {
  ?> selected<?php }
?>>Nauru</option>
<option value="Nepal" <?php if ($profile['country'] == "Nepal") {
  ?> selected<?php }
?>>Nepal</option>
<option value="Netherlands" <?php if ($profile['country'] == "Netherlands") {
  ?> selected<?php }
?>>Netherlands</option>
<option value="Netherlands Antilles" <?php if ($profile['country'] == "Netherlands Antilles") {
  ?> selected<?php }
?>>Netherlands Antilles</option>
<option value="New Caledonia" <?php if ($profile['country'] == "New Caledonia") {
  ?> selected<?php }
?>>New Caledonia</option>
<option value="New Zealand" <?php if ($profile['country'] == "New Zealand") {
  ?> selected<?php }
?>>New Zealand</option>
<option value="Nicaragua" <?php if ($profile['country'] == "Nicaragua") {
  ?> selected<?php }
?>>Nicaragua</option>
<option value="Niger" <?php if ($profile['country'] == "Niger") {
  ?> selected<?php }
?>>Niger</option>
<option value="Nigeria" <?php if ($profile['country'] == "Nigeria") {
  ?> selected<?php }
?> >Nigeria</option>
<option value="Niue" <?php if ($profile['country'] == "Niue") {
  ?> selected<?php }
?>>Niue</option>
<option value="Norfolk Island" <?php if ($profile['country'] == "Norfolk Island") {
  ?> selected<?php }
?>>Norfolk Island</option>
<option value="Northern Mariana Islands" <?php if ($profile['country'] == "Northern Mariana Islands") {
  ?> selected<?php }
?>>Northern Mariana Islands</option>
<option value="Norway" <?php if ($profile['country'] == "Norway") {
  ?> selected<?php }
?>>Norway</option>
<option value="Oman" <?php if ($profile['country'] == "Oman") {
  ?> selected<?php }
?>>Oman</option>
<option value="Pakistan" <?php if ($profile['country'] == "Pakistan") {
  ?> selected<?php }
?>>Pakistan</option>
<option value="Palau" <?php if ($profile['country'] == "Palau") {
  ?> selected<?php }
?>>Palau</option>
<option value="Palestinian Territory, Occupied" <?php if ($profile['country'] == "Palestinian Territory, Occupied") {
  ?> selected<?php }
?> >Palestinian Territory, Occupied</option>
<option value="Panama" <?php if ($profile['country'] == "Panama") {
  ?> selected<?php }
?>>Panama</option>
<option value="Papua New Guinea" <?php if ($profile['country'] == "Papua New Guinea") {
  ?> selected<?php }
?>>Papua New Guinea</option>
<option value="Paraguay" <?php if ($profile['country'] == "Paraguay") {
  ?> selected<?php }
?>>Paraguay</option>
<option value="Peru" <?php if ($profile['country'] == "Peru") {
  ?> selected<?php }
?>>Peru</option>
<option value="Philippines" <?php if ($profile['country'] == "Philippines") {
  ?> selected<?php }
?>>Philippines</option>
<option value="Pitcairn" <?php if ($profile['country'] == "Pitcairn") {
  ?> selected<?php }
?>>Pitcairn</option>
<option value="Poland" <?php if ($profile['country'] == "Poland") {
  ?> selected<?php }
?>>Poland</option>
<option value="Portugal" <?php if ($profile['country'] == "Portugal") {
  ?> selected<?php }
?>>Portugal</option>
<option value="Puerto Rico" <?php if ($profile['country'] == "Puerto Rico") {
  ?> selected<?php }
?>>Puerto Rico</option>
<option value="Qatar" <?php if ($profile['country'] == "Qatar") {
  ?> selected<?php }
?>>Qatar</option>
<option value="Reunion" <?php if ($profile['country'] == "Reunion") {
  ?> selected<?php }
?>>Reunion</option>
<option value="Romania" <?php if ($profile['country'] == "Romania") {
  ?> selected<?php }
?>>Romania</option>
<option value="Russian Federation" <?php if ($profile['country'] == "Russian Federation") {
  ?> selected<?php }
?>>Russian Federation</option>
<option value="Rwanda" <?php if ($profile['country'] == "Rwanda") {
  ?> selected<?php }
?>>Rwanda</option>
<option value="Saint Helena" <?php if ($profile['country'] == "Saint Helena") {
  ?> selected<?php }
?>>Saint Helena</option>
<option value="Saint Kitts and Nevis" <?php if ($profile['country'] == "Saint Kitts and Nevis") {
  ?> selected<?php }
?>>Saint Kitts and Nevis</option>
<option value="Saint Lucia" <?php if ($profile['country'] == "Saint Lucia") {
  ?> selected<?php }
?>>Saint Lucia</option>
<option value="Saint Pierre and Miquelon" <?php if ($profile['country'] == "Saint Pierre and Miquelon") {
  ?> selected<?php }
?>>Saint Pierre and Miquelon</option>
<option value="Saint Vincent and The Grenadines" <?php if ($profile['country'] == "Saint Vincent and The Grenadines") {
  ?> selected<?php }
?>>Saint Vincent and The Grenadines</option>
<option value="Samoa" <?php if ($profile['country'] == "Samoa") {
  ?> selected<?php }
?>>Samoa</option>
<option value="San Marino" <?php if ($profile['country'] == "San Marino") {
  ?> selected<?php }
?>>San Marino</option>
<option value="Sao Tome and Principe" <?php if ($profile['country'] == "Sao Tome and Principe") {
  ?> selected<?php }
?>>Sao Tome and Principe</option>
<option value="Saudi Arabia" <?php if ($profile['country'] == "Saudi Arabia") {
  ?> selected<?php }
?>>Saudi Arabia</option>
<option value="Senegal" <?php if ($profile['country'] == "Senegal") {
  ?> selected<?php }
?>>Senegal</option>
<option value="Serbia and Montenegro" <?php if ($profile['country'] == "Serbia and Montenegro") {
  ?> selected<?php }
?>>Serbia and Montenegro</option>
<option value="Seychelles" <?php if ($profile['country'] == "Seychelles") {
  ?> selected<?php }
?>>Seychelles</option>
<option value="Sierra Leone" <?php if ($profile['country'] == "Sierra Leone") {
  ?> selected<?php }
?>>Sierra Leone</option>
<option value="Singapore" <?php if ($profile['country'] == "Singapore") {
  ?> selected<?php }
?>>Singapore</option>
<option value="Slovakia" <?php if ($profile['country'] == "Slovakia") {
  ?> selected<?php }
?>>Slovakia</option>
<option value="Slovenia" <?php if ($profile['country'] == "Slovenia") {
  ?> selected<?php }
?>>Slovenia</option>
<option value="Solomon Islands" <?php if ($profile['country'] == "Solomon Islands") {
  ?> selected<?php }
?>>Solomon Islands</option>
<option value="Somalia" <?php if ($profile['country'] == "Somalia") {
  ?> selected<?php }
?>>Somalia</option>
<option value="South Africa" <?php if ($profile['country'] == "South Africa") {
  ?> selected<?php }
?>>South Africa</option>
<option value="South Georgia and The South Sandwich Islands" <?php if ($profile['country'] == "South Georgia and The South Sandwich Islands") {
  ?> selected<?php }
?>>South Georgia and The South Sandwich Islands</option>
<option value="Spain" <?php if ($profile['country'] == "Spain") {
  ?> selected<?php }
?>>Spain</option>
<option value="Sri Lanka" <?php if ($profile['country'] == "Sri Lanka") {
  ?> selected<?php }
?>>Sri Lanka</option>
<option value="Sudan" <?php if ($profile['country'] == "Sudan") {
  ?> selected<?php }
?>>Sudan</option>
<option value="Suriname" <?php if ($profile['country'] == "Suriname") {
  ?> selected<?php }
?>>Suriname</option>
<option value="Svalbard and Jan Mayen" <?php if ($profile['country'] == "Svalbard and Jan Mayen") {
  ?> selected<?php }
?>>Svalbard and Jan Mayen</option>
<option value="Swaziland" <?php if ($profile['country'] == "Swaziland") {
  ?> selected<?php }
?>>Swaziland</option>
<option value="Sweden" <?php if ($profile['country'] == "Sweden") {
  ?> selected<?php }
?>>Sweden</option>
<option value="Switzerland" <?php if ($profile['country'] == "Switzerland") {
  ?> selected<?php }
?>>Switzerland</option>
<option value="Syrian Arab Republic" <?php if ($profile['country'] == "Syrian Arab Republic") {
  ?> selected<?php }
?>>Syrian Arab Republic</option>
<option value="Taiwan, Province of China" <?php if ($profile['country'] == "Taiwan, Province of China") {
  ?> selected<?php }
?>>Taiwan, Province of China</option>
<option value="Tajikistan" <?php if ($profile['country'] == "Tajikistan") {
  ?> selected<?php }
?>>Tajikistan</option>
<option value="Tanzania, United Republic of" <?php if ($profile['country'] == "Tanzania, United Republic of") {
  ?> selected<?php }
?>>Tanzania, United Republic of</option>
<option value="Thailand" <?php if ($profile['country'] == "Thailand") {
  ?> selected<?php }
?>>Thailand</option>
<option value="Timor-leste" <?php if ($profile['country'] == "Timor-leste") {
  ?> selected<?php }
?>>Timor-leste</option>
<option value="Togo" <?php if ($profile['country'] == "Togo") {
  ?> selected<?php }
?>>Togo</option>
<option value="Tokelau" <?php if ($profile['country'] == "Tokelau") {
  ?> selected<?php }
?>>Tokelau</option>
<option value="Tonga" <?php if ($profile['country'] == "Tonga") {
  ?> selected<?php }
?>>Tonga</option>
<option value="Trinidad and Tobago" <?php if ($profile['country'] == "Trinidad and Tobago") {
  ?> selected<?php }
?>>Trinidad and Tobago</option>
<option value="Tunisia" <?php if ($profile['country'] == "Tunisia") {
  ?> selected<?php }
?>>Tunisia</option>
<option value="Turkey" <?php if ($profile['country'] == "Turkey") {
  ?> selected<?php }
?>>Turkey</option>
<option value="Turkmenistan" <?php if ($profile['country'] == "Turkmenistan") {
  ?> selected<?php }
?>>Turkmenistan</option>
<option value="Turks and Caicos Islands" <?php if ($profile['country'] == "Turks and Caicos Islands") {
  ?> selected<?php }
?>>Turks and Caicos Islands</option>
<option value="Tuvalu" <?php if ($profile['country'] == "Tuvalu") {
  ?> selected<?php }
?>>Tuvalu</option>
<option value="Uganda" <?php if ($profile['country'] == "Uganda") {
  ?> selected<?php }
?>>Uganda</option>
<option value="Ukraine" <?php if ($profile['country'] == "Ukraine") {
  ?> selected<?php }
?>>Ukraine</option>
<option value="United Arab Emirates" <?php if ($profile['country'] == "United Arab Emirates") {
  ?> selected<?php }
?>>United Arab Emirates</option>
<option value="United Kingdom" <?php if ($profile['country'] == "United Kingdom") {
  ?> selected<?php }
?>>United Kingdom</option>
<option value="United States" <?php if ($profile['country'] == "United States") {
  ?> selected<?php }
?>>United States</option>
<option value="United States Minor Outlying Islands" <?php if ($profile['country'] == "United States Minor Outlying Islands") {
  ?> selected<?php }
?>>United States Minor Outlying Islands</option>
<option value="Uruguay" <?php if ($profile['country'] == "Uruguay") {
  ?> selected<?php }
?>>Uruguay</option>
<option value="Uzbekistan" <?php if ($profile['country'] == "Uzbekistan") {
  ?> selected<?php }
?>>Uzbekistan</option>
<option value="Vanuatu" <?php if ($profile['country'] == "Vanuatu") {
  ?> selected<?php }
?>>Vanuatu</option>
<option value="Venezuela" <?php if ($profile['country'] == "Venezuela") {
  ?> selected<?php }
?>>Venezuela</option>
<option value="Viet Nam" <?php if ($profile['country'] == "Viet Nam") {
  ?> selected<?php }
?>>Viet Nam</option>
<option value="Virgin Islands, British" <?php if ($profile['country'] == "Virgin Islands, British") {
  ?> selected<?php }
?>>Virgin Islands, British</option>
<option value="Virgin Islands, U.S." <?php if ($profile['country'] == "Virgin Islands, U.S.") {
  ?> selected<?php }
?>>Virgin Islands, U.S.</option>
<option value="Wallis and Futuna" <?php if ($profile['country'] == "Wallis and Futuna") {
  ?> selected<?php }
?>>Wallis and Futuna</option>
<option value="Western Sahara" <?php if ($profile['country'] == "Western Sahara") {
  ?> selected<?php }
?>>Western Sahara</option>
<option value="Yemen" <?php if ($profile['country'] == "Yemen") {
  ?> selected<?php }
?>>Yemen</option>
<option value="Zambia" <?php if ($profile['country'] == "Zambia") {
  ?> selected<?php }
?>>Zambia</option>
<option value="Zimbabwe" <?php if ($profile['country'] == "Zimbabwe") {
  ?> selected<?php }
?>>Zimbabwe</option>
</select>
          </div>


            <div class="col-md-6">
          <label for="dob1">Date of Birth : <span class="glyphicon glyphicon-asterisk"  style="color:red;font-size: 11px;"></span></label>
            <input type="text" class="edit-input" id="dob"  name="dob" value="<?php echo $profile['dob'];?>">
          </div>

        <div class="col-md-6">
          <label for="dob1">Contact : <span class="glyphicon glyphicon-asterisk"  style="color:red;font-size: 11px;"></span></label>
            <input type="text" class="edit-input" id="cell"  name="cell" placeholder="e.g +96824571951" value="<?php echo $profile['cell'];?>">
          </div>

            <div class="col-md-6" style="  margin-top: 16px;">
          <label for="dob1">Select Gender</label>
            <input type="radio" name="gen" id="male1" value="0" <?php if ($profile['gender'] == 0) {?> checked <?php }?> >Male
            <input type="radio" name="gen" id="female1" value="1" <?php if ($profile['gender'] == 1) {?> checked <?php }?>>Female
            <input type="hidden" name="old" value="<?php echo $profile['img_url'];?>">
          <input type="hidden" name="img_url_1" value="<?php echo $profile['img_url'];?>" />
          </div>

       <div class="clearfix"></div>
         <div class="col-md-6">
          <label for="dob1" style="text-align: left;">Avator</label>
            

              <input type="file" name="img_url" value="avator" id="avator">
          </div>


            <div class="col-md-12">
              <input type="submit" style="margin-bottom: 15px;" id="save" name="save" value="Save" class="editbtn">
          </div>


          </form>
          <div class="clearfix"></div>
      
    
    </div>
      













    </div>
  </div>
</section>



<!-- ........................................booking list.................................. -->





       <!-- ==========================================================================
                           Footer Area
   ========================================================================== -->

            <?php echo $footer; ?>

<script>
 new WOW().init();
</script>



    </body>
</html>