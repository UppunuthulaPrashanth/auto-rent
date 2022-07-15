<?php include "inc_opendb.php";
$PAGEID = "Page Book Addons";
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
                  <div class="theme-hero-text-header">
                    <h2 class="theme-hero-text-title _mb-20 theme-hero-text-title-sm">364 Car Deals in New York</h2>
                  </div>
                </div>
                <ul class="theme-breadcrumbs _mt-20">
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="index.html">Home</a>
                    </p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#">United States</a>
                    </p>
                    <p class="theme-breadcrumbs-item-subtitle">123,878 hotels</p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title">
                      <a href="#">New York State</a>
                    </p>
                    <p class="theme-breadcrumbs-item-subtitle">5,478 hotels</p>
                  </li>
                  <li>
                    <p class="theme-breadcrumbs-item-title active">New York City Hotels</p>
                    <p class="theme-breadcrumbs-item-subtitle">2438 properties</p>
                  </li>
                </ul>
              </div>
              <div class="theme-search-area-inline _desk-h theme-search-area-inline-white">
                <h4 class="theme-search-area-inline-title">New York Cars</h4>
                <p class="theme-search-area-inline-details">June 27 &rarr; July 02</p>
                <a class="theme-search-area-inline-link magnific-inline" href="#searchEditModal">
                  <i class="fa fa-pencil"></i>Edit
                </a>
                <div class="magnific-popup magnific-popup-sm mfp-hide" id="searchEditModal">
                  <div class="theme-search-area theme-search-area-vert">
                    <div class="theme-search-area-header">
                      <h1 class="theme-search-area-title theme-search-area-title-sm">Edit your Search</h1>
                      <p class="theme-search-area-subtitle">Prices might be different from current results</p>
                    </div>
                    <div class="theme-search-area-form">
                      <div class="theme-search-area-section first theme-search-area-section-curved">
                        <label class="theme-search-area-section-label">Pick Up</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Pick up location" data-provide="typeahead"/>
                        </div>
                      </div>
                      <div class="theme-search-area-section theme-search-area-section-curved">
                        <label class="theme-search-area-section-label">Drop Off</label>
                        <div class="theme-search-area-section-inner">
                          <i class="theme-search-area-section-icon lin lin-location-pin"></i>
                          <input class="theme-search-area-section-input typeahead" value="New York" type="text" placeholder="Drop off location" data-provide="typeahead"/>
                        </div>
                      </div>
                      <div class="row" data-gutter="10">
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            <label class="theme-search-area-section-label">Check In</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerStart _mob-h" value="Wed 06/27" type="text" placeholder="Check-in"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-06-27" type="date"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 ">
                          <div class="theme-search-area-section theme-search-area-section-curved">
                            <label class="theme-search-area-section-label">Check Out</label>
                            <div class="theme-search-area-section-inner">
                              <i class="theme-search-area-section-icon lin lin-calendar"></i>
                              <input class="theme-search-area-section-input datePickerEnd _mob-h" value="Mon 07/02" type="text" placeholder="Check-out"/>
                              <input class="theme-search-area-section-input _desk-h mobile-picker" value="2018-07-02" type="date"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="theme-search-area-submit _mt-0 _tt-uc theme-search-area-submit-curved">Change</button>
                    </div>
                  </div>
                </div>
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
            <div class="theme-payment-page-sections">
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-signin">
                  <i class="theme-payment-page-signin-icon fa fa-user-circle-o"></i>
                  <div class="theme-payment-page-signin-body">
                    <h4 class="theme-payment-page-signin-title">Sign in if you have an account</h4>
                    <p class="theme-payment-page-signin-subtitle">We will retrieve saved travelers and credit cards for faster checkout</p>
                  </div>
                  <a class="btn theme-payment-page-signin-btn btn-primary" href="#">Sign in</a>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <div class="theme-search-results-item theme-payment-page-item-thumb">
                  <div class="row" data-gutter="20">
                    <div class="col-md-9 ">
                      <h5 class="theme-search-results-item-title theme-search-results-item-title-lg">Mazda CX-5</h5>
                      <div class="theme-search-results-item-car-location">
                        <i class="fa fa-plane theme-search-results-item-car-location-icon"></i>
                        <div class="theme-search-results-item-car-location-body">
                          <p class="theme-search-results-item-car-location-title">John F. Kennedy International Airport</p>
                          <p class="theme-search-results-item-car-location-subtitle">Terminal pickup</p>
                        </div>
                      </div>
                      <ul class="theme-search-results-item-car-list">
                        <li>
                          <i class="fa fa-check"></i>Unlimited mileage
                        </li>
                        <li>
                          <i class="fa fa-check"></i>Pay now
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-3 ">
                      <div class="theme-search-results-item-img-wrap">
                        <img class="theme-search-results-item-img" src="img/car-results/1.jpg" alt="Image Alternative text" title="Image Title"/>
                      </div>
                      <ul class="theme-search-results-item-car-feature-list">
                        <li>
                          <i class="fa fa-male"></i>
                          <span>4</span>
                        </li>
                        <li>
                          <i class="fa fa-suitcase"></i>
                          <span>2</span>
                        </li>
                        <li>
                          <i class="fa fa-cog"></i>
                          <span>Auto</span>
                        </li>
                        <li>
                          <i class="fa fa-snowflake-o"></i>
                          <span>A/C</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Enter Driver Details</h3>
                <div class="theme-payment-page-form">
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="First Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Last Name"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Email Address"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Phone Number"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <h3 class="theme-payment-page-sections-item-title">Enter Billing Information</h3>
                <div class="theme-payment-page-form _mb-20">
                  <h3 class="theme-payment-page-form-title">Billing Address</h3>
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Street (line 1)"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Street (line 2)"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Postal Code"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="City"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <i class="fa fa-angle-down"></i>
                        <select class="form-control">
                          <option>State/Region</option>
                          <option>Alabama</option>
                          <option>Alaska</option>
                          <option>American Samoa</option>
                          <option>Arizona</option>
                          <option>Arkansas</option>
                          <option>California</option>
                          <option>Colorado</option>
                          <option>Connecticut</option>
                          <option>Delaware</option>
                          <option>District Of Columbia</option>
                          <option>Federated States Of Micronesia</option>
                          <option>Florida</option>
                          <option>Georgia</option>
                          <option>Guam</option>
                          <option>Hawaii</option>
                          <option>Idaho</option>
                          <option>Illinois</option>
                          <option>Indiana</option>
                          <option>Iowa</option>
                          <option>Kansas</option>
                          <option>Kentucky</option>
                          <option>Louisiana</option>
                          <option>Maine</option>
                          <option>Marshall Islands</option>
                          <option>Maryland</option>
                          <option>Massachusetts</option>
                          <option>Michigan</option>
                          <option>Minnesota</option>
                          <option>Mississippi</option>
                          <option>Missouri</option>
                          <option>Montana</option>
                          <option>Nebraska</option>
                          <option>Nevada</option>
                          <option>New Hampshire</option>
                          <option>New Jersey</option>
                          <option>New Mexico</option>
                          <option>New York</option>
                          <option>North Carolina</option>
                          <option>North Dakota</option>
                          <option>Northern Mariana Islands</option>
                          <option>Ohio</option>
                          <option>Oklahoma</option>
                          <option>Oregon</option>
                          <option>Palau</option>
                          <option>Pennsylvania</option>
                          <option>Puerto Rico</option>
                          <option>Rhode Island</option>
                          <option>South Carolina</option>
                          <option>South Dakota</option>
                          <option>Tennessee</option>
                          <option>Texas</option>
                          <option>Utah</option>
                          <option>Vermont</option>
                          <option>Virgin Islands</option>
                          <option>Virginia</option>
                          <option>Washington</option>
                          <option>West Virginia</option>
                          <option>Wisconsin</option>
                          <option>Wyoming</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <i class="fa fa-angle-down"></i>
                        <select class="form-control">
                          <option>Select Country</option>
                          <option>Afghanistan</option>
                          <option>Albania</option>
                          <option>Algeria</option>
                          <option>American Samoa</option>
                          <option>AndorrA</option>
                          <option>Angola</option>
                          <option>Anguilla</option>
                          <option>Antarctica</option>
                          <option>Antigua and Barbuda</option>
                          <option>Argentina</option>
                          <option>Armenia</option>
                          <option>Aruba</option>
                          <option>Australia</option>
                          <option>Austria</option>
                          <option>Azerbaijan</option>
                          <option>Bahamas</option>
                          <option>Bahrain</option>
                          <option>Bangladesh</option>
                          <option>Barbados</option>
                          <option>Belarus</option>
                          <option>Belgium</option>
                          <option>Belize</option>
                          <option>Benin</option>
                          <option>Bermuda</option>
                          <option>Bhutan</option>
                          <option>Bolivia</option>
                          <option>Bosnia and Herzegovina</option>
                          <option>Botswana</option>
                          <option>Bouvet Island</option>
                          <option>Brazil</option>
                          <option>British Indian Ocean Territory</option>
                          <option>Brunei Darussalam</option>
                          <option>Bulgaria</option>
                          <option>Burkina Faso</option>
                          <option>Burundi</option>
                          <option>Cambodia</option>
                          <option>Cameroon</option>
                          <option>Canada</option>
                          <option>Cape Verde</option>
                          <option>Cayman Islands</option>
                          <option>Central African Republic</option>
                          <option>Chad</option>
                          <option>Chile</option>
                          <option>China</option>
                          <option>Christmas Island</option>
                          <option>Cocos (Keeling) Islands</option>
                          <option>Colombia</option>
                          <option>Comoros</option>
                          <option>Congo</option>
                          <option>Congo, The Democratic Republic of the</option>
                          <option>Cook Islands</option>
                          <option>Costa Rica</option>
                          <option>Cote D"Ivoire</option>
                          <option>Croatia</option>
                          <option>Cuba</option>
                          <option>Cyprus</option>
                          <option>Czech Republic</option>
                          <option>Denmark</option>
                          <option>Djibouti</option>
                          <option>Dominica</option>
                          <option>Dominican Republic</option>
                          <option>Ecuador</option>
                          <option>Egypt</option>
                          <option>El Salvador</option>
                          <option>Equatorial Guinea</option>
                          <option>Eritrea</option>
                          <option>Estonia</option>
                          <option>Ethiopia</option>
                          <option>Falkland Islands (Malvinas)</option>
                          <option>Faroe Islands</option>
                          <option>Fiji</option>
                          <option>Finland</option>
                          <option>France</option>
                          <option>French Guiana</option>
                          <option>French Polynesia</option>
                          <option>French Southern Territories</option>
                          <option>Gabon</option>
                          <option>Gambia</option>
                          <option>Georgia</option>
                          <option>Germany</option>
                          <option>Ghana</option>
                          <option>Gibraltar</option>
                          <option>Greece</option>
                          <option>Greenland</option>
                          <option>Grenada</option>
                          <option>Guadeloupe</option>
                          <option>Guam</option>
                          <option>Guatemala</option>
                          <option>Guernsey</option>
                          <option>Guinea</option>
                          <option>Guinea-Bissau</option>
                          <option>Guyana</option>
                          <option>Haiti</option>
                          <option>Heard Island and Mcdonald Islands</option>
                          <option>Holy See (Vatican City State)</option>
                          <option>Honduras</option>
                          <option>Hong Kong</option>
                          <option>Hungary</option>
                          <option>Iceland</option>
                          <option>India</option>
                          <option>Indonesia</option>
                          <option>Iran, Islamic Republic Of</option>
                          <option>Iraq</option>
                          <option>Ireland</option>
                          <option>Isle of Man</option>
                          <option>Israel</option>
                          <option>Italy</option>
                          <option>Jamaica</option>
                          <option>Japan</option>
                          <option>Jersey</option>
                          <option>Jordan</option>
                          <option>Kazakhstan</option>
                          <option>Kenya</option>
                          <option>Kiribati</option>
                          <option>Korea, Democratic People"S Republic of</option>
                          <option>Korea, Republic of</option>
                          <option>Kuwait</option>
                          <option>Kyrgyzstan</option>
                          <option>Lao People"S Democratic Republic</option>
                          <option>Latvia</option>
                          <option>Lebanon</option>
                          <option>Lesotho</option>
                          <option>Liberia</option>
                          <option>Libyan Arab Jamahiriya</option>
                          <option>Liechtenstein</option>
                          <option>Lithuania</option>
                          <option>Luxembourg</option>
                          <option>Macao</option>
                          <option>Macedonia, The Former Yugoslav Republic of</option>
                          <option>Madagascar</option>
                          <option>Malawi</option>
                          <option>Malaysia</option>
                          <option>Maldives</option>
                          <option>Mali</option>
                          <option>Malta</option>
                          <option>Marshall Islands</option>
                          <option>Martinique</option>
                          <option>Mauritania</option>
                          <option>Mauritius</option>
                          <option>Mayotte</option>
                          <option>Mexico</option>
                          <option>Micronesia, Federated States of</option>
                          <option>Moldova, Republic of</option>
                          <option>Monaco</option>
                          <option>Mongolia</option>
                          <option>Montserrat</option>
                          <option>Morocco</option>
                          <option>Mozambique</option>
                          <option>Myanmar</option>
                          <option>Namibia</option>
                          <option>Nauru</option>
                          <option>Nepal</option>
                          <option>Netherlands</option>
                          <option>Netherlands Antilles</option>
                          <option>New Caledonia</option>
                          <option>New Zealand</option>
                          <option>Nicaragua</option>
                          <option>Niger</option>
                          <option>Nigeria</option>
                          <option>Niue</option>
                          <option>Norfolk Island</option>
                          <option>Northern Mariana Islands</option>
                          <option>Norway</option>
                          <option>Oman</option>
                          <option>Pakistan</option>
                          <option>Palau</option>
                          <option>Palestinian Territory, Occupied</option>
                          <option>Panama</option>
                          <option>Papua New Guinea</option>
                          <option>Paraguay</option>
                          <option>Peru</option>
                          <option>Philippines</option>
                          <option>Pitcairn</option>
                          <option>Poland</option>
                          <option>Portugal</option>
                          <option>Puerto Rico</option>
                          <option>Qatar</option>
                          <option>Reunion</option>
                          <option>Romania</option>
                          <option>Russian Federation</option>
                          <option>RWANDA</option>
                          <option>Saint Helena</option>
                          <option>Saint Kitts and Nevis</option>
                          <option>Saint Lucia</option>
                          <option>Saint Pierre and Miquelon</option>
                          <option>Saint Vincent and the Grenadines</option>
                          <option>Samoa</option>
                          <option>San Marino</option>
                          <option>Sao Tome and Principe</option>
                          <option>Saudi Arabia</option>
                          <option>Senegal</option>
                          <option>Serbia and Montenegro</option>
                          <option>Seychelles</option>
                          <option>Sierra Leone</option>
                          <option>Singapore</option>
                          <option>Slovakia</option>
                          <option>Slovenia</option>
                          <option>Solomon Islands</option>
                          <option>Somalia</option>
                          <option>South Africa</option>
                          <option>South Georgia and the South Sandwich Islands</option>
                          <option>Spain</option>
                          <option>Sri Lanka</option>
                          <option>Sudan</option>
                          <option>Suriname</option>
                          <option>Svalbard and Jan Mayen</option>
                          <option>Swaziland</option>
                          <option>Sweden</option>
                          <option>Switzerland</option>
                          <option>Syrian Arab Republic</option>
                          <option>Taiwan, Province of China</option>
                          <option>Tajikistan</option>
                          <option>Tanzania, United Republic of</option>
                          <option>Thailand</option>
                          <option>Timor-Leste</option>
                          <option>Togo</option>
                          <option>Tokelau</option>
                          <option>Tonga</option>
                          <option>Trinidad and Tobago</option>
                          <option>Tunisia</option>
                          <option>Turkey</option>
                          <option>Turkmenistan</option>
                          <option>Turks and Caicos Islands</option>
                          <option>Tuvalu</option>
                          <option>Uganda</option>
                          <option>Ukraine</option>
                          <option>United Arab Emirates</option>
                          <option>United Kingdom</option>
                          <option>United States</option>
                          <option>United States Minor Outlying Islands</option>
                          <option>Uruguay</option>
                          <option>Uzbekistan</option>
                          <option>Vanuatu</option>
                          <option>Venezuela</option>
                          <option>Viet Nam</option>
                          <option>Virgin Islands, British</option>
                          <option>Virgin Islands, U.S.</option>
                          <option>Wallis and Futuna</option>
                          <option>Western Sahara</option>
                          <option>Yemen</option>
                          <option>Zambia</option>
                          <option>Zimbabwe</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="theme-payment-page-form">
                  <h3 class="theme-payment-page-form-title">Card Details</h3>
                  <div class="row row-col-gap" data-gutter="20">
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Name on Card"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="theme-payment-page-form-item form-group">
                        <input class="form-control" type="text" placeholder="Credit/Debit Card Number"/>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="row row-col-gap" data-gutter="10">
                        <div class="col-md-4 ">
                          <div class="theme-payment-page-form-item form-group">
                            <i class="fa fa-angle-down"></i>
                            <select class="form-control">
                              <option>(1) Jan</option>
                              <option>(2) Feb</option>
                              <option>(3) Mar</option>
                              <option>(4) Apr</option>
                              <option>(5) May</option>
                              <option>(6) Jun</option>
                              <option>(7) Jul</option>
                              <option>(8) Aug</option>
                              <option>(9) Sep</option>
                              <option>(10) Oct</option>
                              <option>(11) Nov</option>
                              <option>(12) Dec</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 ">
                          <div class="theme-payment-page-form-item form-group">
                            <i class="fa fa-angle-down"></i>
                            <select class="form-control">
                              <option>2018</option>
                              <option>2019</option>
                              <option>2020</option>
                              <option>2021</option>
                              <option>2022</option>
                              <option>2023</option>
                              <option>2024</option>
                              <option>2025</option>
                              <option>2026</option>
                              <option>2027</option>
                              <option>2028</option>
                              <option>2029</option>
                              <option>2030</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 ">
                          <div class="theme-payment-page-form-item form-group">
                            <input class="form-control" type="text" placeholder="Security Code"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <ul class="theme-payment-page-card-list">
                        <li>
                          <img src="img/credit-icons/mastercard-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                        </li>
                        <li>
                          <img src="img/credit-icons/visa-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                        </li>
                        <li>
                          <img src="img/credit-icons/visa-electron-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                        </li>
                        <li>
                          <img src="img/credit-icons/discover-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                        </li>
                        <li>
                          <img src="img/credit-icons/maestro-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                        </li>
                        <li>
                          <img src="img/credit-icons/american-express-straight-64px.png" alt="Image Alternative text" title="Image Title"/>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="theme-payment-page-sections-item">
                <div class="theme-payment-page-booking">
                  <div class="theme-payment-page-booking-header">
                    <h3 class="theme-payment-page-booking-title">Total Price for 6 days</h3>
                    <p class="theme-payment-page-booking-subtitle">By clicking book now button you agree with terms and conditionals and money back gurantee. Thank you for trusting our service.</p>
                    <p class="theme-payment-page-booking-price">$224.00</p>
                  </div>
                  <a class="btn _tt-uc btn-primary-inverse btn-lg btn-block" href="#">Book Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="sticky-col">
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Booking Summary</h5>
                <ul class="theme-sidebar-section-summary-list">
                  <li>Mazda CX-5, 4 people/2 bags, Automatic transmission, Air-conditioning</li>
                  <li>Check-in: Wed, Jun 27, 2018</li>
                  <li>Check-out: Tue, Jul 03, 2018</li>
                </ul>
              </div>
              <div class="theme-sidebar-section _mb-10">
                <h5 class="theme-sidebar-section-title">Charges</h5>
                <div class="theme-sidebar-section-charges">
                  <ul class="theme-sidebar-section-charges-list">
                    <li class="theme-sidebar-section-charges-item">
                      <h5 class="theme-sidebar-section-charges-item-title">6 days</h5>
                      <p class="theme-sidebar-section-charges-item-subtitle">Mazda CX-5</p>
                      <p class="theme-sidebar-section-charges-item-price">$192.00</p>
                    </li>
                    <li class="theme-sidebar-section-charges-item">
                      <h5 class="theme-sidebar-section-charges-item-title">Taxes, Fees & Surcharges</h5>
                      <p class="theme-sidebar-section-charges-item-subtitle"></p>
                      <p class="theme-sidebar-section-charges-item-price">$32.00</p>
                    </li>
                  </ul>
                  <p class="theme-sidebar-section-charges-total">Total
                    <span>$224.00</span>
                  </p>
                </div>
              </div>
              <div class="theme-sidebar-section _mb-10">
                <ul class="theme-sidebar-section-features-list">
                  <li>
                    <h5 class="theme-sidebar-section-features-list-title">Manage your bookings!</h5>
                    <p class="theme-sidebar-section-features-list-body">You're in control of your booking - no registration required.</p>
                  </li>
                  <li>
                    <h5 class="theme-sidebar-section-features-list-title">Customer support available 24/7 worldwide!</h5>
                    <p class="theme-sidebar-section-features-list-body">Website and customer support in English and 41 other languages.</p>
                  </li>
                </ul>
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