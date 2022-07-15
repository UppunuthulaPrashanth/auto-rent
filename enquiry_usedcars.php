<?php include "inc_opendb.php";
$PAGEID = "Enquiry Used Cars";


$slug = filter_var($_POST['slug'], FILTER_SANITIZE_STRING);
$slug1 = filter_var($_POST['slug1'], FILTER_SANITIZE_STRING);


//echo "test" . $slug;
//
//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
////exit();
//



$usedInfoResult = $db->query("SELECT * FROM view_used_cars WHERE slug = ?s", $slug);
$usedInfoRow = mysqli_fetch_assoc($usedInfoResult);


$make   = $usedInfoRow['make'];
$model  = $usedInfoRow['model'];
$year   = $usedInfoRow['year'];
$title  = $make . " " .$model. " " .$year;

$bodyTypeID   = $usedInfoRow['bodyTypeID'];
$fuelTypeID   = $usedInfoRow['fuelTypeID'];
$regionalSpecID   = $usedInfoRow['regionalID'];
$warrantyID   = $usedInfoRow['warrantyID'];
$transmissionID   = $usedInfoRow['transmissionTypeID'];
$cylinderID   = $usedInfoRow['cylinderID'];
$kilometers = $usedInfoRow['kilometers'];


//echo $db->lastQuery();
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
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">Enquire Now</h2>
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
                  
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a>Enquire</a>
                    </p>
                    
                  </li>
                </ul>
              </div>
<!--              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">-->
<!--                <h4 class="theme-search-area-inline-title">Nissan Sunny </h4>-->
<!--                <p class="theme-search-area-inline-details">2019</p>-->
<!--                <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal">-->
<!--                  <i class="fa fa-pencil"></i>Modify-->
<!--                </a>-->
<!--                <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">-->
<!--                  <div class="theme-search-area theme-search-area-vert">-->
<!--                    <div class="theme-search-area-header">-->
<!--                      <h1 class="theme-search-area-title theme-search-area-title-sm">Modify</h1>-->
<!--                      <p class="theme-search-area-subtitle">Prices might be different from current results</p>-->
<!--                    </div>-->
<!--                    <div class="theme-search-area-form">-->
<!--                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
<!--                       <label class="theme-search-area-section-label">Make</label> -->
<!--                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
<!--                      <i class="fa fa-angle-down"></i>-->
<!--                      <select class="form-control">-->
<!--                        <option>Select Make</option>-->
<!--                        <option>Audi</option>-->
<!--                        -->
<!--                        -->
<!--                        <option>Bugatti</option>-->
<!--                        <option>Cadillac</option>-->
<!--                        <option>Dodge</option>-->
<!--                        -->
<!--                      </select>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                      <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
<!--                       <label class="theme-search-area-section-label">Model</label> -->
<!--                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
<!--                      <i class="fa fa-angle-down"></i>-->
<!--                      <select class="form-control">-->
<!--                        <option>Select Model</option>-->
<!--                        <option>Audi</option>-->
<!--                        -->
<!--                        -->
<!--                        <option>Bugatti</option>-->
<!--                        <option>Cadillac</option>-->
<!--                        <option>Dodge</option>-->
<!--                        -->
<!--                      </select>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                   -->
<!--                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
<!--                       <label class="theme-search-area-section-label">Term</label> -->
<!--                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
<!--                      <i class="fa fa-angle-down"></i>-->
<!--                      <select class="form-control">-->
<!--                        <option>Select Lease Term</option>-->
<!--                        <option>6 Months</option>-->
<!--                        -->
<!--                        -->
<!--                        <option>12 Months</option>-->
<!--                        <option>18 Months</option>-->
<!--                        <option>24 Months</option>-->
<!--                        -->
<!--                      </select>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                       -->
<!---->
<!--                          <div class="theme-search-area-section theme-search-area-section-curved theme-search-area-section-sm theme-search-area-section-fade-white theme-search-area-section-no-border">-->
<!--                       <label class="theme-search-area-section-label">Location</label> -->
<!--                  <div class="theme-payment-page-form-item form-group theme-search-area-section-inner">-->
<!--                      <i class="fa fa-angle-down"></i>-->
<!--                      <select class="form-control">-->
<!--                        <option>Select Location</option>-->
<!--                        <option>Abu Dhabi</option>-->
<!--                        -->
<!--                        -->
<!--                        <option>Dubai</option>-->
<!--                        <option>Sharjah</option>-->
<!--                        <option>RAK</option>-->
<!--                        -->
<!--                      </select>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                       -->
<!--                     -->
<!--                      <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
      
     
     
     
 <div class="theme-page-section theme-page-section-lg">
      <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
          <div class="col-md-8 ">
            <div class="theme-payment-page-sections">

              
              <div class="theme-account-notifications">
<!--                <div class="row">-->
<!--                    <div class="col-md-6"><div class="">-->
<!--                      <div class="btn-group theme-search-area-options-list" data-toggle="buttons">-->
<!--                       -->
<!--                         <h5 class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> </h5>-->
<!--                        -->
<!--                        -->
<!--                      </div>-->
<!--                    </div></div>-->
<!--        <div class="col-md-3 "> <input type="radio" name="flight-option-1" id="yes" checked/> <h5 class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> Yes</h5></div>-->
<!--                  <div class="col-md-3 "> <input type="radio" name="flight-option-1" id="no"> <h5 class="theme-search-results-item-title theme-search-results-item-title-sm disclaimer-txt loc-icons"> No</h5></div>-->
<!--    </div>-->
<!--                  -->
<!--              -->
<!--                  <hr>-->
<!--               -->
<!--                 <div class="theme-payment-page-sections-item" id="autorent-customer">-->
<!--                -->
<!--                <div class="theme-payment-page-form">-->
<!--                  <div class="row row-col-gap" data-gutter="20">-->
<!--                    <div class="col-md-6 ">-->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <label>E-Mail ID*</label>-->
<!--                        <input class="form-control" type="text" placeholder="Enter Your E-Mail"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-6 ">-->
<!--                      <label>Password*</label>-->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="Password"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    -->
<!--                    -->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
                  
<!--                <div class="theme-payment-page-sections-item" id="autorent-new">-->
<!--                <h5 class="theme-search-results-item-title theme-search-results-item-title-sm"> Your Contact Info</h5>-->
<!--                <div class="theme-payment-page-form">-->
<!--                  <div class="row row-col-gap" data-gutter="20">-->
<!--                    <div class="col-md-6 ">-->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!---->
<!--                        <input class="form-control" type="text" placeholder="First Name*"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-6 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="Last Name*"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-md-6 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="E-Mail*"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-6 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="Mobile Number*"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!---->
<!---->
<!---->
<!--                    <div class="col-md-4 ">-->
<!---->
<!---->
<!--                       <div class="theme-payment-page-form-item form-group">-->
<!--                        <i class="fa fa-angle-down"></i>-->
<!--                        <select class="form-control">-->
<!--                          <option>Select Country*</option>-->
<!--                          <option>Afghanistan</option>-->
<!--                          <option>Albania</option>-->
<!--                          <option>Algeria</option>-->
<!--                          <option>American Samoa</option>-->
<!--                          <option>AndorrA</option>-->
<!--                          <option>Angola</option>-->
<!--                          <option>Anguilla</option>-->
<!--                          <option>Antarctica</option>-->
<!--                          <option>Antigua and Barbuda</option>-->
<!--                          <option>Argentina</option>-->
<!--                          <option>Armenia</option>-->
<!--                          <option>Aruba</option>-->
<!--                          <option>Australia</option>-->
<!--                          <option>Austria</option>-->
<!--                          <option>Azerbaijan</option>-->
<!--                          <option>Bahamas</option>-->
<!--                          <option>Bahrain</option>-->
<!--                          <option>Bangladesh</option>-->
<!--                          <option>Barbados</option>-->
<!--                          <option>Belarus</option>-->
<!--                          <option>Belgium</option>-->
<!--                          <option>Belize</option>-->
<!--                          <option>Benin</option>-->
<!--                          <option>Bermuda</option>-->
<!--                          <option>Bhutan</option>-->
<!--                          <option>Bolivia</option>-->
<!--                          <option>Bosnia and Herzegovina</option>-->
<!--                          <option>Botswana</option>-->
<!--                          <option>Bouvet Island</option>-->
<!--                          <option>Brazil</option>-->
<!--                          <option>British Indian Ocean Territory</option>-->
<!--                          <option>Brunei Darussalam</option>-->
<!--                          <option>Bulgaria</option>-->
<!--                          <option>Burkina Faso</option>-->
<!--                          <option>Burundi</option>-->
<!--                          <option>Cambodia</option>-->
<!--                          <option>Cameroon</option>-->
<!--                          <option>Canada</option>-->
<!--                          <option>Cape Verde</option>-->
<!--                          <option>Cayman Islands</option>-->
<!--                          <option>Central African Republic</option>-->
<!--                          <option>Chad</option>-->
<!--                          <option>Chile</option>-->
<!--                          <option>China</option>-->
<!--                          <option>Christmas Island</option>-->
<!--                          <option>Cocos (Keeling) Islands</option>-->
<!--                          <option>Colombia</option>-->
<!--                          <option>Comoros</option>-->
<!--                          <option>Congo</option>-->
<!--                          <option>Congo, The Democratic Republic of the</option>-->
<!--                          <option>Cook Islands</option>-->
<!--                          <option>Costa Rica</option>-->
<!--                          <option>Cote D"Ivoire</option>-->
<!--                          <option>Croatia</option>-->
<!--                          <option>Cuba</option>-->
<!--                          <option>Cyprus</option>-->
<!--                          <option>Czech Republic</option>-->
<!--                          <option>Denmark</option>-->
<!--                          <option>Djibouti</option>-->
<!--                          <option>Dominica</option>-->
<!--                          <option>Dominican Republic</option>-->
<!--                          <option>Ecuador</option>-->
<!--                          <option>Egypt</option>-->
<!--                          <option>El Salvador</option>-->
<!--                          <option>Equatorial Guinea</option>-->
<!--                          <option>Eritrea</option>-->
<!--                          <option>Estonia</option>-->
<!--                          <option>Ethiopia</option>-->
<!--                          <option>Falkland Islands (Malvinas)</option>-->
<!--                          <option>Faroe Islands</option>-->
<!--                          <option>Fiji</option>-->
<!--                          <option>Finland</option>-->
<!--                          <option>France</option>-->
<!--                          <option>French Guiana</option>-->
<!--                          <option>French Polynesia</option>-->
<!--                          <option>French Southern Territories</option>-->
<!--                          <option>Gabon</option>-->
<!--                          <option>Gambia</option>-->
<!--                          <option>Georgia</option>-->
<!--                          <option>Germany</option>-->
<!--                          <option>Ghana</option>-->
<!--                          <option>Gibraltar</option>-->
<!--                          <option>Greece</option>-->
<!--                          <option>Greenland</option>-->
<!--                          <option>Grenada</option>-->
<!--                          <option>Guadeloupe</option>-->
<!--                          <option>Guam</option>-->
<!--                          <option>Guatemala</option>-->
<!--                          <option>Guernsey</option>-->
<!--                          <option>Guinea</option>-->
<!--                          <option>Guinea-Bissau</option>-->
<!--                          <option>Guyana</option>-->
<!--                          <option>Haiti</option>-->
<!--                          <option>Heard Island and Mcdonald Islands</option>-->
<!--                          <option>Holy See (Vatican City State)</option>-->
<!--                          <option>Honduras</option>-->
<!--                          <option>Hong Kong</option>-->
<!--                          <option>Hungary</option>-->
<!--                          <option>Iceland</option>-->
<!--                          <option>India</option>-->
<!--                          <option>Indonesia</option>-->
<!--                          <option>Iran, Islamic Republic Of</option>-->
<!--                          <option>Iraq</option>-->
<!--                          <option>Ireland</option>-->
<!--                          <option>Isle of Man</option>-->
<!--                          <option>Israel</option>-->
<!--                          <option>Italy</option>-->
<!--                          <option>Jamaica</option>-->
<!--                          <option>Japan</option>-->
<!--                          <option>Jersey</option>-->
<!--                          <option>Jordan</option>-->
<!--                          <option>Kazakhstan</option>-->
<!--                          <option>Kenya</option>-->
<!--                          <option>Kiribati</option>-->
<!--                          <option>Korea, Democratic People"S Republic of</option>-->
<!--                          <option>Korea, Republic of</option>-->
<!--                          <option>Kuwait</option>-->
<!--                          <option>Kyrgyzstan</option>-->
<!--                          <option>Lao People"S Democratic Republic</option>-->
<!--                          <option>Latvia</option>-->
<!--                          <option>Lebanon</option>-->
<!--                          <option>Lesotho</option>-->
<!--                          <option>Liberia</option>-->
<!--                          <option>Libyan Arab Jamahiriya</option>-->
<!--                          <option>Liechtenstein</option>-->
<!--                          <option>Lithuania</option>-->
<!--                          <option>Luxembourg</option>-->
<!--                          <option>Macao</option>-->
<!--                          <option>Macedonia, The Former Yugoslav Republic of</option>-->
<!--                          <option>Madagascar</option>-->
<!--                          <option>Malawi</option>-->
<!--                          <option>Malaysia</option>-->
<!--                          <option>Maldives</option>-->
<!--                          <option>Mali</option>-->
<!--                          <option>Malta</option>-->
<!--                          <option>Marshall Islands</option>-->
<!--                          <option>Martinique</option>-->
<!--                          <option>Mauritania</option>-->
<!--                          <option>Mauritius</option>-->
<!--                          <option>Mayotte</option>-->
<!--                          <option>Mexico</option>-->
<!--                          <option>Micronesia, Federated States of</option>-->
<!--                          <option>Moldova, Republic of</option>-->
<!--                          <option>Monaco</option>-->
<!--                          <option>Mongolia</option>-->
<!--                          <option>Montserrat</option>-->
<!--                          <option>Morocco</option>-->
<!--                          <option>Mozambique</option>-->
<!--                          <option>Myanmar</option>-->
<!--                          <option>Namibia</option>-->
<!--                          <option>Nauru</option>-->
<!--                          <option>Nepal</option>-->
<!--                          <option>Netherlands</option>-->
<!--                          <option>Netherlands Antilles</option>-->
<!--                          <option>New Caledonia</option>-->
<!--                          <option>New Zealand</option>-->
<!--                          <option>Nicaragua</option>-->
<!--                          <option>Niger</option>-->
<!--                          <option>Nigeria</option>-->
<!--                          <option>Niue</option>-->
<!--                          <option>Norfolk Island</option>-->
<!--                          <option>Northern Mariana Islands</option>-->
<!--                          <option>Norway</option>-->
<!--                          <option>Oman</option>-->
<!--                          <option>Pakistan</option>-->
<!--                          <option>Palau</option>-->
<!--                          <option>Palestinian Territory, Occupied</option>-->
<!--                          <option>Panama</option>-->
<!--                          <option>Papua New Guinea</option>-->
<!--                          <option>Paraguay</option>-->
<!--                          <option>Peru</option>-->
<!--                          <option>Philippines</option>-->
<!--                          <option>Pitcairn</option>-->
<!--                          <option>Poland</option>-->
<!--                          <option>Portugal</option>-->
<!--                          <option>Puerto Rico</option>-->
<!--                          <option>Qatar</option>-->
<!--                          <option>Reunion</option>-->
<!--                          <option>Romania</option>-->
<!--                          <option>Russian Federation</option>-->
<!--                          <option>RWANDA</option>-->
<!--                          <option>Saint Helena</option>-->
<!--                          <option>Saint Kitts and Nevis</option>-->
<!--                          <option>Saint Lucia</option>-->
<!--                          <option>Saint Pierre and Miquelon</option>-->
<!--                          <option>Saint Vincent and the Grenadines</option>-->
<!--                          <option>Samoa</option>-->
<!--                          <option>San Marino</option>-->
<!--                          <option>Sao Tome and Principe</option>-->
<!--                          <option>Saudi Arabia</option>-->
<!--                          <option>Senegal</option>-->
<!--                          <option>Serbia and Montenegro</option>-->
<!--                          <option>Seychelles</option>-->
<!--                          <option>Sierra Leone</option>-->
<!--                          <option>Singapore</option>-->
<!--                          <option>Slovakia</option>-->
<!--                          <option>Slovenia</option>-->
<!--                          <option>Solomon Islands</option>-->
<!--                          <option>Somalia</option>-->
<!--                          <option>South Africa</option>-->
<!--                          <option>South Georgia and the South Sandwich Islands</option>-->
<!--                          <option>Spain</option>-->
<!--                          <option>Sri Lanka</option>-->
<!--                          <option>Sudan</option>-->
<!--                          <option>Suriname</option>-->
<!--                          <option>Svalbard and Jan Mayen</option>-->
<!--                          <option>Swaziland</option>-->
<!--                          <option>Sweden</option>-->
<!--                          <option>Switzerland</option>-->
<!--                          <option>Syrian Arab Republic</option>-->
<!--                          <option>Taiwan, Province of China</option>-->
<!--                          <option>Tajikistan</option>-->
<!--                          <option>Tanzania, United Republic of</option>-->
<!--                          <option>Thailand</option>-->
<!--                          <option>Timor-Leste</option>-->
<!--                          <option>Togo</option>-->
<!--                          <option>Tokelau</option>-->
<!--                          <option>Tonga</option>-->
<!--                          <option>Trinidad and Tobago</option>-->
<!--                          <option>Tunisia</option>-->
<!--                          <option>Turkey</option>-->
<!--                          <option>Turkmenistan</option>-->
<!--                          <option>Turks and Caicos Islands</option>-->
<!--                          <option>Tuvalu</option>-->
<!--                          <option>Uganda</option>-->
<!--                          <option>Ukraine</option>-->
<!--                          <option>United Arab Emirates</option>-->
<!--                          <option>United Kingdom</option>-->
<!--                          <option>United States</option>-->
<!--                          <option>United States Minor Outlying Islands</option>-->
<!--                          <option>Uruguay</option>-->
<!--                          <option>Uzbekistan</option>-->
<!--                          <option>Vanuatu</option>-->
<!--                          <option>Venezuela</option>-->
<!--                          <option>Viet Nam</option>-->
<!--                          <option>Virgin Islands, British</option>-->
<!--                          <option>Virgin Islands, U.S.</option>-->
<!--                          <option>Wallis and Futuna</option>-->
<!--                          <option>Western Sahara</option>-->
<!--                          <option>Yemen</option>-->
<!--                          <option>Zambia</option>-->
<!--                          <option>Zimbabwe</option>-->
<!--                        </select>-->
<!--                      </div>-->
<!---->
<!--                    </div>-->
<!--                    <div class="col-md-4 ">-->
<!---->
<!---->
<!---->
<!--                        <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="City*"/>-->
<!--                      </div>-->
<!---->
<!---->
<!---->
<!--                    </div>-->
<!--                    <div class="col-md-4 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <i class="fa fa-angle-down"></i>-->
<!--                        <select class="form-control">-->
<!--                          <option>Nationality*</option>-->
<!--                          <option>Afghanistan</option>-->
<!--                          <option>Albania</option>-->
<!--                          <option>Algeria</option>-->
<!--                          <option>American Samoa</option>-->
<!--                          <option>AndorrA</option>-->
<!--                          <option>Angola</option>-->
<!--                          <option>Anguilla</option>-->
<!--                          <option>Antarctica</option>-->
<!--                          <option>Antigua and Barbuda</option>-->
<!--                          <option>Argentina</option>-->
<!--                          <option>Armenia</option>-->
<!--                          <option>Aruba</option>-->
<!--                          <option>Australia</option>-->
<!--                          <option>Austria</option>-->
<!--                          <option>Azerbaijan</option>-->
<!--                          <option>Bahamas</option>-->
<!--                          <option>Bahrain</option>-->
<!--                          <option>Bangladesh</option>-->
<!--                          <option>Barbados</option>-->
<!--                          <option>Belarus</option>-->
<!--                          <option>Belgium</option>-->
<!--                          <option>Belize</option>-->
<!--                          <option>Benin</option>-->
<!--                          <option>Bermuda</option>-->
<!--                          <option>Bhutan</option>-->
<!--                          <option>Bolivia</option>-->
<!--                          <option>Bosnia and Herzegovina</option>-->
<!--                          <option>Botswana</option>-->
<!--                          <option>Bouvet Island</option>-->
<!--                          <option>Brazil</option>-->
<!--                          <option>British Indian Ocean Territory</option>-->
<!--                          <option>Brunei Darussalam</option>-->
<!--                          <option>Bulgaria</option>-->
<!--                          <option>Burkina Faso</option>-->
<!--                          <option>Burundi</option>-->
<!--                          <option>Cambodia</option>-->
<!--                          <option>Cameroon</option>-->
<!--                          <option>Canada</option>-->
<!--                          <option>Cape Verde</option>-->
<!--                          <option>Cayman Islands</option>-->
<!--                          <option>Central African Republic</option>-->
<!--                          <option>Chad</option>-->
<!--                          <option>Chile</option>-->
<!--                          <option>China</option>-->
<!--                          <option>Christmas Island</option>-->
<!--                          <option>Cocos (Keeling) Islands</option>-->
<!--                          <option>Colombia</option>-->
<!--                          <option>Comoros</option>-->
<!--                          <option>Congo</option>-->
<!--                          <option>Congo, The Democratic Republic of the</option>-->
<!--                          <option>Cook Islands</option>-->
<!--                          <option>Costa Rica</option>-->
<!--                          <option>Cote D"Ivoire</option>-->
<!--                          <option>Croatia</option>-->
<!--                          <option>Cuba</option>-->
<!--                          <option>Cyprus</option>-->
<!--                          <option>Czech Republic</option>-->
<!--                          <option>Denmark</option>-->
<!--                          <option>Djibouti</option>-->
<!--                          <option>Dominica</option>-->
<!--                          <option>Dominican Republic</option>-->
<!--                          <option>Ecuador</option>-->
<!--                          <option>Egypt</option>-->
<!--                          <option>El Salvador</option>-->
<!--                          <option>Equatorial Guinea</option>-->
<!--                          <option>Eritrea</option>-->
<!--                          <option>Estonia</option>-->
<!--                          <option>Ethiopia</option>-->
<!--                          <option>Falkland Islands (Malvinas)</option>-->
<!--                          <option>Faroe Islands</option>-->
<!--                          <option>Fiji</option>-->
<!--                          <option>Finland</option>-->
<!--                          <option>France</option>-->
<!--                          <option>French Guiana</option>-->
<!--                          <option>French Polynesia</option>-->
<!--                          <option>French Southern Territories</option>-->
<!--                          <option>Gabon</option>-->
<!--                          <option>Gambia</option>-->
<!--                          <option>Georgia</option>-->
<!--                          <option>Germany</option>-->
<!--                          <option>Ghana</option>-->
<!--                          <option>Gibraltar</option>-->
<!--                          <option>Greece</option>-->
<!--                          <option>Greenland</option>-->
<!--                          <option>Grenada</option>-->
<!--                          <option>Guadeloupe</option>-->
<!--                          <option>Guam</option>-->
<!--                          <option>Guatemala</option>-->
<!--                          <option>Guernsey</option>-->
<!--                          <option>Guinea</option>-->
<!--                          <option>Guinea-Bissau</option>-->
<!--                          <option>Guyana</option>-->
<!--                          <option>Haiti</option>-->
<!--                          <option>Heard Island and Mcdonald Islands</option>-->
<!--                          <option>Holy See (Vatican City State)</option>-->
<!--                          <option>Honduras</option>-->
<!--                          <option>Hong Kong</option>-->
<!--                          <option>Hungary</option>-->
<!--                          <option>Iceland</option>-->
<!--                          <option>India</option>-->
<!--                          <option>Indonesia</option>-->
<!--                          <option>Iran, Islamic Republic Of</option>-->
<!--                          <option>Iraq</option>-->
<!--                          <option>Ireland</option>-->
<!--                          <option>Isle of Man</option>-->
<!--                          <option>Israel</option>-->
<!--                          <option>Italy</option>-->
<!--                          <option>Jamaica</option>-->
<!--                          <option>Japan</option>-->
<!--                          <option>Jersey</option>-->
<!--                          <option>Jordan</option>-->
<!--                          <option>Kazakhstan</option>-->
<!--                          <option>Kenya</option>-->
<!--                          <option>Kiribati</option>-->
<!--                          <option>Korea, Democratic People"S Republic of</option>-->
<!--                          <option>Korea, Republic of</option>-->
<!--                          <option>Kuwait</option>-->
<!--                          <option>Kyrgyzstan</option>-->
<!--                          <option>Lao People"S Democratic Republic</option>-->
<!--                          <option>Latvia</option>-->
<!--                          <option>Lebanon</option>-->
<!--                          <option>Lesotho</option>-->
<!--                          <option>Liberia</option>-->
<!--                          <option>Libyan Arab Jamahiriya</option>-->
<!--                          <option>Liechtenstein</option>-->
<!--                          <option>Lithuania</option>-->
<!--                          <option>Luxembourg</option>-->
<!--                          <option>Macao</option>-->
<!--                          <option>Macedonia, The Former Yugoslav Republic of</option>-->
<!--                          <option>Madagascar</option>-->
<!--                          <option>Malawi</option>-->
<!--                          <option>Malaysia</option>-->
<!--                          <option>Maldives</option>-->
<!--                          <option>Mali</option>-->
<!--                          <option>Malta</option>-->
<!--                          <option>Marshall Islands</option>-->
<!--                          <option>Martinique</option>-->
<!--                          <option>Mauritania</option>-->
<!--                          <option>Mauritius</option>-->
<!--                          <option>Mayotte</option>-->
<!--                          <option>Mexico</option>-->
<!--                          <option>Micronesia, Federated States of</option>-->
<!--                          <option>Moldova, Republic of</option>-->
<!--                          <option>Monaco</option>-->
<!--                          <option>Mongolia</option>-->
<!--                          <option>Montserrat</option>-->
<!--                          <option>Morocco</option>-->
<!--                          <option>Mozambique</option>-->
<!--                          <option>Myanmar</option>-->
<!--                          <option>Namibia</option>-->
<!--                          <option>Nauru</option>-->
<!--                          <option>Nepal</option>-->
<!--                          <option>Netherlands</option>-->
<!--                          <option>Netherlands Antilles</option>-->
<!--                          <option>New Caledonia</option>-->
<!--                          <option>New Zealand</option>-->
<!--                          <option>Nicaragua</option>-->
<!--                          <option>Niger</option>-->
<!--                          <option>Nigeria</option>-->
<!--                          <option>Niue</option>-->
<!--                          <option>Norfolk Island</option>-->
<!--                          <option>Northern Mariana Islands</option>-->
<!--                          <option>Norway</option>-->
<!--                          <option>Oman</option>-->
<!--                          <option>Pakistan</option>-->
<!--                          <option>Palau</option>-->
<!--                          <option>Palestinian Territory, Occupied</option>-->
<!--                          <option>Panama</option>-->
<!--                          <option>Papua New Guinea</option>-->
<!--                          <option>Paraguay</option>-->
<!--                          <option>Peru</option>-->
<!--                          <option>Philippines</option>-->
<!--                          <option>Pitcairn</option>-->
<!--                          <option>Poland</option>-->
<!--                          <option>Portugal</option>-->
<!--                          <option>Puerto Rico</option>-->
<!--                          <option>Qatar</option>-->
<!--                          <option>Reunion</option>-->
<!--                          <option>Romania</option>-->
<!--                          <option>Russian Federation</option>-->
<!--                          <option>RWANDA</option>-->
<!--                          <option>Saint Helena</option>-->
<!--                          <option>Saint Kitts and Nevis</option>-->
<!--                          <option>Saint Lucia</option>-->
<!--                          <option>Saint Pierre and Miquelon</option>-->
<!--                          <option>Saint Vincent and the Grenadines</option>-->
<!--                          <option>Samoa</option>-->
<!--                          <option>San Marino</option>-->
<!--                          <option>Sao Tome and Principe</option>-->
<!--                          <option>Saudi Arabia</option>-->
<!--                          <option>Senegal</option>-->
<!--                          <option>Serbia and Montenegro</option>-->
<!--                          <option>Seychelles</option>-->
<!--                          <option>Sierra Leone</option>-->
<!--                          <option>Singapore</option>-->
<!--                          <option>Slovakia</option>-->
<!--                          <option>Slovenia</option>-->
<!--                          <option>Solomon Islands</option>-->
<!--                          <option>Somalia</option>-->
<!--                          <option>South Africa</option>-->
<!--                          <option>South Georgia and the South Sandwich Islands</option>-->
<!--                          <option>Spain</option>-->
<!--                          <option>Sri Lanka</option>-->
<!--                          <option>Sudan</option>-->
<!--                          <option>Suriname</option>-->
<!--                          <option>Svalbard and Jan Mayen</option>-->
<!--                          <option>Swaziland</option>-->
<!--                          <option>Sweden</option>-->
<!--                          <option>Switzerland</option>-->
<!--                          <option>Syrian Arab Republic</option>-->
<!--                          <option>Taiwan, Province of China</option>-->
<!--                          <option>Tajikistan</option>-->
<!--                          <option>Tanzania, United Republic of</option>-->
<!--                          <option>Thailand</option>-->
<!--                          <option>Timor-Leste</option>-->
<!--                          <option>Togo</option>-->
<!--                          <option>Tokelau</option>-->
<!--                          <option>Tonga</option>-->
<!--                          <option>Trinidad and Tobago</option>-->
<!--                          <option>Tunisia</option>-->
<!--                          <option>Turkey</option>-->
<!--                          <option>Turkmenistan</option>-->
<!--                          <option>Turks and Caicos Islands</option>-->
<!--                          <option>Tuvalu</option>-->
<!--                          <option>Uganda</option>-->
<!--                          <option>Ukraine</option>-->
<!--                          <option>United Arab Emirates</option>-->
<!--                          <option>United Kingdom</option>-->
<!--                          <option>United States</option>-->
<!--                          <option>United States Minor Outlying Islands</option>-->
<!--                          <option>Uruguay</option>-->
<!--                          <option>Uzbekistan</option>-->
<!--                          <option>Vanuatu</option>-->
<!--                          <option>Venezuela</option>-->
<!--                          <option>Viet Nam</option>-->
<!--                          <option>Virgin Islands, British</option>-->
<!--                          <option>Virgin Islands, U.S.</option>-->
<!--                          <option>Wallis and Futuna</option>-->
<!--                          <option>Western Sahara</option>-->
<!--                          <option>Yemen</option>-->
<!--                          <option>Zambia</option>-->
<!--                          <option>Zimbabwe</option>-->
<!--                        </select>-->
<!--                      </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-md-12 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="Address*"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="State*"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <input class="form-control" type="text" placeholder="Postal Code"/>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                    <div class="col-md-4 ">-->
<!---->
<!--                      <div class="theme-payment-page-form-item form-group">-->
<!--                        <i class="fa fa-angle-down"></i>-->
<!--                        <select class="form-control">-->
<!--                          <option>Visa Status*</option>-->
<!--                          <option>Resident</option>-->
<!--                          <option>Visit</option>-->
<!---->
<!--                        </select>-->
<!--                      </div>-->
<!--                    </div>-->
<!---->
<!--                     </div>-->
<!---->
<!--                </div>-->
<!--              </div>-->
                  
                  
                  
                
                
                
                
                <hr>
                
                
                <div class="theme-payment-page-sections-item">
<!--                <h3 class="theme-payment-page-sections-item-title">About Your Enquiry</h3>-->
                <div class="theme-payment-page-form _mb-20">
                  
                  <div class="row row-col-gap" data-gutter="20">
                      <h5 class="theme-search-results-item-title theme-search-results-item-title-sm"> Your Contact Info</h5>
                      <form id="usedCarsEnquiryForm" name="usedCarsEnquiryForm" method="post">
                      <div class="theme-payment-page-form">

                          <div class="row row-col-gap" data-gutter="20">
                              <div class="col-md-6 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name*" required/>
                                  </div>
                              </div>
                              <div class="col-md-6 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name*" required/>
                                  </div>
                              </div>
                              <div class="col-md-6 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <input class="form-control" type="email" name="email" id="email" placeholder="E-Mail*" required/>
                                  </div>
                              </div>
                              <div class="col-md-6 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <input class="form-control" type="text" name="phone" id="phone" placeholder="Mobile Number*" onkeypress="return isNumberKey(event)" required/>
                                  </div>
                              </div>
                              <div class="col-md-4 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <i class="fa fa-angle-down"></i>
                                      <select class="form-control" name="country" id="country" required>

                                          <option value="" selected disabled>Select Country*</option>
                                          <?php
                                          $countryRes = $db->query( "select * from mtr_country  ORDER BY countryName ASC" );
                                          while ( $countryRow = mysqli_fetch_assoc( $countryRes ) )
                                          {
                                          ?>
                                          <option value="<?php echo $countryRow['countryName'];?>"><?php echo $countryRow['countryName'];?></option>
                                          <?php
                                          }
                                          ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <input class="form-control" type="text" name="city" id="city" placeholder="City*" required/>
                                  </div>
                              </div>
                              <div class="col-md-4 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <i class="fa fa-angle-down"></i>
                                      <select class="form-control" name="nationality" id="nationality" required>
                                          <option value="" selected disabled>Nationality*</option>
                                          <?php
                                          $nationalityRes = $db->query( "select * from mtr_nationality ORDER BY nationalityName ASC" );
                                          while ($nationalityRow = mysqli_fetch_assoc($nationalityRes))
                                          {
                                              ?>
                                              <option value="<?php echo $nationalityRow['nationalityName'];?>"><?php echo $nationalityRow['nationalityName'];?></option>
                                              <?php
                                          }
                                          ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12 ">
                                  <div class="theme-payment-page-form-item form-group">
                                      <input class="form-control" name="address" id="address" type="text" placeholder="Address*" required/>
                                  </div>
                              </div>
                              <div class="col-md-12 ">
                                  <div class="form-group theme-contact-form-group">
                                      <textarea class="form-control" name="message" id="message" rows="5" placeholder="Your Enquiry"></textarea>
                                  </div>
                              </div>
                          </div>

                          <hr>
                          <div class="mb-15">
                              <input class="icheck" type="checkbox" name="newsletter" id="newsletter"/>
                              <h5>Sign up to the Autorent email newsletter and we'll keep you informed of our latest offers.  </h5>
                          </div>
                          <div class="mb-15">
                              <input class="icheck" type="checkbox" id="termsConditions" name="termsConditions" required/>
                              <h5 class="txt-red">I accept the terms & conditions. *  </h5>
                          </div>
                          <div class="col-md-12">
                              <br>
                              <div class="text-center g-recaptcha" data-sitekey="6LcDPtAZAAAAALSnfmxg6s2sxj2cnlH6MCPpWUSX"></div><br>
                              <img id="ajaxLoader" src="uploads/pages/ajax-loader.gif" alt="loader" style="display: none; margin-left: auto; margin-right: auto;">


                        <input type="hidden" name="carName" id="carName" value="<?php echo $title; ?>"/>
                        <input type="hidden" name="carPrice" id="carPrice" value="<?php echo $usedInfoRow['price' . $_SESSION[CURRENT_CURRENCY]];?>"/>
                        <input type="hidden" name="carKilometer" id="carKilometer" value="<?php echo $usedInfoRow['kilometers'];?>"/>
                        <input type="hidden" name="carRegionalSpec" id="carRegionalSpec" value="<?php echo getRegionalSpecFromID($regionalSpecID);?>"/>
                        <input type="hidden" name="carTransmission" id="carTransmission" value="<?php echo getTransmissionTypeFromID($transmissionID);?>"/>
                        <input type="hidden" name="carFuel" id="carFuel" value="<?php echo getFuelTypeFromID($fuelTypeID);?>"/>
                        <input type="hidden" name="carUsedType" id="carUsedType" value="<?php echo $slug1;?>"/>

                          </div>
                          <hr>
                          <button type="submit" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="enquiryBtn" name="enquiryBtn">Submit</button>
                      </div>
                      </form>

                  </div>
                    <br><br>
                    <div id="success-message-div" class="result sc_infobox sc_infobox_style_success" style="display: none"></div>
                    <div id="error-message-div" class="result sc_infobox sc_infobox_style_error" style="display: none"></div>
                </div>
              </div>

            </div>

<!--            <button id="confirm" class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" type="submit" disabled>Confirm Booking</button>-->
              
              
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="sticky-col">
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Your Choice</h5>
                
                <div class="theme-search-results-item-img-wrap">
                          <img class="theme-search-results-item-img" src="uploads/usedcars/<?php echo $usedInfoRow['thumbnail'];?>" alt="<?php echo $title;?>" title="<?php echo $title;?>"/>
                        </div>
                
                 <div class="row">
        <div class="col-md-6"><h5><?php echo $title;?></h5></div>
        <div class="col-md-6"><h5 class="txt-red txt-right"><?php echo $_SESSION[CURRENT_CURRENCY] . " " .  $usedInfoRow['price' . $_SESSION[CURRENT_CURRENCY]];?></h5></div>
    </div>
                
                
                <hr>
                
                
                
                <div class="row">
        <div class="col-md-6"><ul class="theme-sidebar-section-summary-list">
                  
                    <li><i class="fa fa-road fa-lg loc-icons"></i><strong> <?php echo $kilometers;?> Kms</strong> </li>
                    
                  
                </ul></div>
        <div class="col-md-6"><ul class="theme-sidebar-section-summary-list">
                  
                    <li><i class="fa fa-globe fa-lg loc-icons"></i><strong><?php echo getRegionalSpecFromID($regionalSpecID);?></strong> </li>
                    
                  
                </ul></div>
    </div>
                
                
                
                
                
                  <hr>
                <div class="row">
                
                
                  <div class="col-md-6"><ul class="theme-sidebar-section-summary-list">
                  
                    <li><i class="fa fa-cogs fa-lg loc-icons"></i><strong><?php echo getTransmissionTypeFromID($transmissionID);?></strong> </li>
                    
                  
                </ul></div>
                
                <div class="col-md-6"><ul class="theme-sidebar-section-summary-list">
                  
                    <li><i class="fa fa-tint fa-lg loc-icons"></i><strong><?php echo getFuelTypeFromID($fuelTypeID);?></strong> </li>
                    
                  
                </ul></div>
                
                
                
           </div>
                  
              </div>
                
                
              
              
            </div>
          </div>
        </div>
      </div>
    </div>

     
     
      
      <?php include 'inc_footer.php'; ?>
      <?php include 'inc_footer_scripts.php'; ?>
     
     
     <script>

         $("form#usedCarsEnquiryForm").submit(function (e)
         {

             e.preventDefault();
             $('#ajaxLoader').show();
             $('#enquiryBtn').hide();

             var formData = new FormData(this);

             $.ajax({
                 type: "POST",
                 url: "ajax_enquiry_used_cars.php",
                 data: formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function (data) {

                     console.log(data);
                     // alert(data);

                     var statusmessage = data.trim().split("|")[0];
                     var message = data.trim().split("|")[1];


                     if (statusmessage.toString().trim() === "SUCCESS") {
                         $("#error-message-div").hide();
                         $("#success-message-div").show();
                         $('#usedCarsEnquiryForm').hide();
                         $("#success-message-div").html(message);
                     }

                     if (statusmessage.toString().trim() === "ERROR") {
                         $("#ajaxLoader").css('display', 'block');
                         $('#ajaxLoader').hide();
                         $('#enquiryBtn').show();
                         $("#error-message-div").show();
                         $("#error-message-div").html(message);
                     }

                 },
                 always: function (data) {
                     console.log("Always snippet" + data);
                 },
                 fail: function (data) {
                     console.log("Error sniippet" + data);
                 }
             });

             return false;
         });




























     $(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'no') {
            $('#autorent-new').show(); 
          
       }

       else {
            $('#autorent-new').hide(); 
       
       }
   });
});
     
       
         $(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'yes') {
            $('#autorent-customer').show(); 
          
       }

       else {
            $('#autorent-customer').hide(); 
       
       }
   });
});
     
$(function () {
        $("#docs-upload").click(function () {
            if ($(this).is(":checked")) {
                $("#upload-docs").show();
              
            } else {
                $("#upload-docs").hide();
               
            }
        });
    });
       
       
     </script>
     
     
     <style>
       #autorent-new{
         display: none;
       }
       
       #upload-docs{
         display:none;
       }
     
     </style>
     
     
     
     
     
   </body>
</html>