<?php include "inc_opendb.php";
$PAGEID = 'Signup'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <!--	--><?php //$page_id = "page_base_a"; ?>
    <!--	--><?php //$page_title = "Add Extras"; ?>
    <!--	--><?php //$page_keywords = "Website Keywords"; ?>
    <!--	--><?php //$page_description = "Website Description"; ?>
    <meta charset="UTF-8"/>
    <?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php'; ?>

<div class="theme-hero-area" style="margin-bottom: 50px;">
    <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url(img/adult-book-business-cactus-297755_1500x800.jpg);"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-strong-login"></div>
    </div>
    <div class="theme-hero-area-body">
        <div class="theme-page-section _pt-100 theme-page-section-xl">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <div class="theme-login theme-login-white">

                            <div class="theme-login-box">
                                <div class="theme-login-box-inner">


                                    <form id="registerForm"
                                          name="registerForm"
                                          method="post"
                                          enctype="multipart/form-data">
                                        <div class="theme-payment-page-sections-item"
                                             id="autorent-new">
                                            
                                            <h1 style="font-size: 20px;margin-top: 0px;margin-bottom: 10px;">Register with us</h1>
                                            
                                          
                                            <div class="theme-payment-page-form">
                                                <div class="row row-col-gap"
                                                     data-gutter="20">
                                                    <div class="col-md-6 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   name="firstName"
                                                                   id="firstName"
                                                                   required
                                                                   placeholder="First Name*"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   name="lastName"
                                                                   id="lastName"
                                                                   required
                                                                   placeholder="Last Name*"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="email"
                                                                   name="emailID"
                                                                   id="emailID"
                                                                   required
                                                                   placeholder="E-Mail*"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   name="mobileNo"
                                                                   id="mobileNo"
                                                                   required
                                                                   placeholder="Mobile Number*"
                                                                   onkeypress="return isNumberKey(event)"
                                                                   style="padding-right: 123px;"/> <input type="hidden"
                                                                                                          id="code"
                                                                                                          name="code"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="password"
                                                                   name="choosePassword"
                                                                   id="choosePassword"
                                                                   required
                                                                   placeholder="Choose Password*"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="password"
                                                                   name="confirmPassword"
                                                                   id="confirmPassword"
                                                                   required
                                                                   placeholder="Confirm Password*"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <i class="fa fa-angle-down"></i> <select class="form-control"
                                                                                                     name="country"
                                                                                                     id="country"
                                                                                                     required>
                                                                <option disabled
                                                                        selected
                                                                        value="">Select Country
                                                                </option>
                                                                <?php
                                                                $country       = '';
                                                                $countryResult = $db->query( "select * from mtr_country order by countryName ASC" );
                                                                while ( $countryRow = mysqli_fetch_assoc( $countryResult ) ) {
                                                                    if ( $country == $countryRow['countryID'] ) {
                                                                        $selected = "selected";
                                                                    } else {
                                                                        $selected = "";
                                                                    }
                                                                    ?>
                                                                    <option <?php echo $selected; ?>
                                                                        value="<?php echo $countryRow["countryID"]; ?>"><?php echo $countryRow["countryName"]; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   name="city"
                                                                   id="city"
                                                                   required
                                                                   placeholder="City*"/>
                                                        </div>
                                                    </div>
                                                    <!--											<div class="col-md-4 ">-->
                                                    <!---->
                                                    <!--												<div class="theme-payment-page-form-item form-group">-->
                                                    <!--													<i class="fa fa-angle-down"></i> <select class="form-control" name="nationality" id="nationality" required>-->
                                                    <!--														<option disabled selected value="">Select Nationality</option>-->
                                                    <!--														--><?php
                                                    //														$nationality       = '';
                                                    //														$nationalityResult = $db->query( "select * from mtr_nationality order by nationalityName ASC" );
                                                    //														while ( $nationalityRow = mysqli_fetch_assoc( $nationalityResult ) )
                                                    //														{
                                                    //															if ( $nationality == $nationalityRow['nationalityID'] )
                                                    //															{
                                                    //																$selected = "selected";
                                                    //															} else
                                                    //															{
                                                    //																$selected = "";
                                                    //															}
                                                    //
                                                    ?>
                                                    <!--															<option --><?php //echo $selected;
                                                    ?>
                                                    <!--																	value="--><?php //echo $nationalityRow["nationalityID"];
                                                    ?><!--">--><?php //echo $nationalityRow["nationalityName"];
                                                    ?>
                                                    <!--															</option>-->
                                                    <!---->
                                                    <!--															--><?php
                                                    //														}
                                                    //
                                                    ?>
                                                    <!--													</select>-->
                                                    <!--												</div>-->
                                                    <!--											</div>-->
                                                    <div class="col-md-12 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   placeholder="Address*"
                                                                   name="address"
                                                                   id="address"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   placeholder="State*"
                                                                   name="state"
                                                                   id="state"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   placeholder="Postal Code"
                                                                   name="pincode"
                                                                   id="pincode"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <i class="fa fa-angle-down"></i> <select class="form-control"
                                                                                                     name="visaStatus"
                                                                                                     required
                                                                                                     id="visaStatus">
                                                                <option disabled
                                                                        selected
                                                                        value="">Visa Status*
                                                                </option>
                                                                <!--                                                        <option>Visa Status*</option>-->
                                                                <option value="Resident">Resident</option>
                                                                <option value="Visit">Visit</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 "
                                                         id="emiratesIdDIV">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <input class="form-control"
                                                                   type="text"
                                                                   placeholder="Emirates ID*"
                                                                   name="emiratesID"
                                                                   id="emiratesID"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-15">
                                                <input type="checkbox"
                                                       id="docs-upload"
                                                       name="docs-upload"
                                                       checked
                                                       style="display: none">
                                                <!--										<input type="checkbox" checked disabled>-->
                                                <input type="hidden"
                                                       checked
                                                       disabled>
                                                <h4 class="disclaimer-txt loc-icons">Upload documents (This will help to speed up the booking process) </h4>
                                            </div>
                                            <div class="theme-payment-page-form"
                                                 id="upload-docs">
                                                <div class="row row-col-gap"
                                                     data-gutter="20">
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>License Number</label> <input class="form-control"
                                                                                                 type="text"
                                                                                                 placeholder="Enter License Number"
                                                                                                 name="licenseNumber"
                                                                                                 id="licenseNumber"
                                                                                                 required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>License Expiry</label> <input class="form-control"
                                                                                                 type="date"
                                                                                                 name="licenseExpiry"
                                                                                                 id="licenseExpiry"
                                                                                                 required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>Place of Issue</label> <input class="form-control"
                                                                                                 type="text"
                                                                                                 placeholder="Place of Issue"
                                                                                                 name="licensePlaceOfIssue"
                                                                                                 id="licensePlaceOfIssue"
                                                                                                 required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>Upload License</label> <input class="form-control"
                                                                                                 type="file"
                                                                                                 name="licenseAttachment"
                                                                                                 id="licenseAttachment"
                                                                                                 required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>Passport Number</label> <input class="form-control"
                                                                                                  type="text"
                                                                                                  placeholder="Enter Passport Number"
                                                                                                  name="passportNumber"
                                                                                                  id="passportNumber"
                                                                                                  required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>Passport Expiry</label> <input class="form-control"
                                                                                                  type="date"
                                                                                                  name="passportExpiry"
                                                                                                  id="passportExpiry"
                                                                                                  required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>Place of Issue</label> <input class="form-control"
                                                                                                 type="text"
                                                                                                 placeholder="Place of Issue"
                                                                                                 name="passportPlaceOfIssue"
                                                                                                 id="passportPlaceOfIssue"
                                                                                                 required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="theme-payment-page-form-item form-group">
                                                            <label>Upload Passport</label> <input class="form-control"
                                                                                                  type="file"
                                                                                                  placeholder="Upload"
                                                                                                  multiple
                                                                                                  name="passportAttachment"
                                                                                                  id="passportAttachment"
                                                                                                  required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mb-15">
                                                <input class="icheck"
                                                       type="checkbox"
                                                       checked
                                                       disabled="disabled"
                                                       name="validdrivinglicense"
                                                       id="validdrivinglicense"
                                                       value="1">
                                                <h5>I have a valid UAE Driving License (For UAE Residents) or International Driving License (For Tourists) </h5>
                                            </div>
                                            <div class="mb-15">
                                                <input class="icheck"
                                                       type="checkbox"
                                                       checked
                                                       disabled="disabled"
                                                       name="validpassport"
                                                       id="validpassport"
                                                       value="1">
                                                <h5>I have an Emirates ID or Valid Passport with the visa entry stamp </h5>
                                            </div>
                                            <div class="mb-15">
                                                <input class="icheck"
                                                       type="checkbox"
                                                       name="validcreditcard"
                                                       id="validcreditcard"
                                                       value="1">
                                                <h5>I have a valid Credit Card </h5>
                                            </div>
                                            <div class="mb-15">
                                                <input class="icheck"
                                                       type="checkbox"
                                                       disabled="disabled"
                                                       checked
                                                       name="validdriverage"
                                                       id="validdriverage"
                                                       value="1">
                                                <h5>Driver's age is above 21 years </h5>
                                            </div>
                                            <div class="mb-15">
                                                <input class="icheck"
                                                       type="checkbox"
                                                       name="signUpNewsletter"
                                                       id="signUpNewsletter"
                                                       value="1">
                                                <h5>Sign up to the Autorent email newsletter and we'll keep you informed of our latest offers. </h5>
                                            </div>
                                            <div class="mb-15">
                                                <input class="icheck"
                                                       type="checkbox"
                                                       checked
                                                       name="acceptterms"
                                                       id="acceptterms"
                                                       value="1"
                                                       required>
                                                <h5 class="txt-red">I accept the
                                                    <a href="terms-conditions"> terms & conditions.</a>
                                                    *
                                                </h5>
                                            </div>
                                            <hr>
                                            <img id="register-ajaxLoader"
                                                 src="uploads/pages/ajax-loader.gif" alt="loader"
                                                 style="display: none; margin-left: auto; margin-right: auto;">
                                            <input type="submit"
                                                   class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn"
                                                   id="registerBtn"
                                                   value="Register"/>
                                        </div>
                                    </form>
                                    <br>
                                    <div id="register-success-message-div"
                                         class="result sc_infobox sc_infobox_style_success"
                                         style="display: none"></div>
                                    <div id="register-error-message-div"
                                         class="result sc_infobox sc_infobox_style_error"
                                         style="display: none"></div>





                                </div>
                            </div>


                        </div>
<!--                        <p class="theme-login-terms text-white">By logging in you accept our <a href="#">terms of use</a> and <a href="#">privacy policy</a>. </p>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>

<link rel="stylesheet"
      href="css/intlTelInput.css"/>
<script src="js/intlTelInput-jquery.min.js"></script>
<script>

    $('#mobileNo').intlTelInput({
        autoHideDialCode: true, //autoPlaceholder: "ON",
        //dropdownContainer: document.body,
        //formatOnDisplay: true,
        //hiddenInput: "full_number",
        //initialCountry: "auto",
        //nationalMode: true,
        //placeholderNumberType: "MOBILE",
        preferredCountries: ['ae', 'in'], separateDialCode: true
    });


    $("form#registerForm").submit(function (e) {
        e.preventDefault();
        $('#register-ajaxLoader').show();
        $('#registerBtn').hide();
        // $('#reset-btn').hide();


        var code = $("#mobileNo").intlTelInput("getSelectedCountryData").dialCode;
        var mobileNumber = $('#mobileNo').val();

        var formData = new FormData(this);
        formData.append("code", code);
        formData.append("mobileNo", mobileNumber);

        $.ajax({
            type: "POST", url: "ajax_userregistration.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    // $("#register-error-message-div").hide();
                    // $("#register-success-message-div").show();
                    // $('#registerForm').hide();
                    // $("#success-message-div").html(message);
                    window.location.href = "/";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#register-ajaxLoader").css('display', 'block');
                    $('#register-ajaxLoader').hide();
                    $('#registerBtn').show();
                    $("#register-error-message-div").show();
                    $("#register-error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });




    $(function () {
        $("#docs-upload").click(function () {
            if ($(this).is(":checked")) {
                $("#upload-docs").show();
                $("#licenseNumber").prop('required', true);
                $("#licenseExpiry").prop('required', true);
                $("#licensePlaceOfIssue").prop('required', true);
                $("#licenseAttachment").prop('required', true);
                $("#passportNumber").prop('required', true);
                $("#passportExpiry").prop('required', true);
                $("#passportPlaceOfIssue").prop('required', true);
                $("#passportAttachment").prop('required', true);


            } else {
                $("#upload-docs").hide();
                $("#licenseNumber").prop('required', false);
                $("#licenseExpiry").prop('required', false);
                $("#licensePlaceOfIssue").prop('required', false);
                $("#licenseAttachment").prop('required', false);
                $("#passportNumber").prop('required', false);
                $("#passportExpiry").prop('required', false);
                $("#passportPlaceOfIssue").prop('required', false);
                $("#passportAttachment").prop('required', false);

            }
        });
    });


    $(document).ready(function () {

        $("#emiratesIdDIV").hide();

    });

    $("#visaStatus").change(function () {

        if ($(this).val() == "Resident") {

            $("#emiratesIdDIV").show();

        }

    });

    $("#visaStatus").change(function () {

        if ($(this).val() == "Visit") {

            $("#emiratesIdDIV").hide();
            $("#emiratesID").removeAttr('required');
        }

    });
</script>

<style>

    #register-success-message-div {
        background-color: #5aa631;
        border: 1px solid #c8f8af;
        background: #eaffdf;
        text-align: center;
        /*max-width: 700px;*/
        color: #000000;
        padding: 20px;
        left: 30px;
        width: 100%;
    }

    #register-error-message-div {
        background-color: #7C0304;
        border: 1px solid #ffd8d8;
        background: #e30613;
        text-align: center;
        width: 100%;
        /*max-width: 700px;*/
        color: #ffffff;
        padding: 5px;
        left: 30px;
    }

</style>

</body>
</html>