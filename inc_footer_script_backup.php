<script src="js/jquery.js"></script>
<script src="js/moment.js"></script>
<script src="js/bootstrap.js"></script>

<?php
if( $PAGEID == "Contact Us")
{
    ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYeBBmgAkyAN_QKjAVOiP_kWZ_eQdadeI&amp;callback=initMap&amp;libraries=places"></script>
    <?php
}
?>


<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRCDYNtqBncPVaPVLE7J2VGj8x9bKlc_8" type="text/javascript"></script>-->

<script src="js/owl-carousel.js"></script>
<script src="js/blur-area.js"></script>
<script src="js/icheck.js"></script>
<script src="js/gmap.js"></script>
<script src="js/magnific-popup.js"></script>
<script src="js/ion-range-slider.js"></script>
<script src="js/sticky-kit.js"></script>
<script src="js/smooth-scroll.js"></script>
<script src="js/fotorama.js"></script>
<script src="js/bs-datepicker.js"></script>
<script src="js/typeahead.js"></script>
<script src="js/quantity-selector.js"></script>
<script src="js/countdown.js"></script>
<script src="js/window-scroll-action.js"></script>
<script src="js/fitvid.js"></script>
<script src="js/youtube-bg.js"></script>
<script src="js/custom.js"></script>

<script src='https://www.google.com/recaptcha/api.js'></script>


<script>


    var $ = jQuery;

    $("#confirmEmail").blur(function () {
        console.log("Calling this function!");
        if ($("#email").val() != $("#confirmEmail").val()) {
            $("#error-message-div").show();
            $("#error-message-div").html("Email doesn't match!");
            //document.getElementById("confirmEmail").focus();

        } else {
            $("#error-message-div").hide();
        }
    });


    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) return false;

        return true;
    }

    $("form#loginform").submit(function (e) {
        e.preventDefault();
        $('#ajaxLoader').show();
        // $('#btnsignin').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_login.php", data: formData, cache: false, contentType: false, processData: false,

            success: function (data) {

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];

                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile.php";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#nameForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_nameupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#mobileForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_mobileupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#licenseForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_licenseupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#PassportForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_passportupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#NationalityForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_nationalityupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#currencyForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_currencyupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "settings";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#languageForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_languageupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "settings";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });



    $("form#passwordForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_passwordupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "settings";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });



    $("form#addressForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_addressupdate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    window.location.href = "profile";
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });



    $("form#registerForm").submit(function (e) {
        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_userregistration.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#error-message-div").hide();
                    $("#success-message-div").show();
                    $('#contactForm').hide();
                    $("#success-message-div").html(message);
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#sliderLeaseCarsForm2").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_lease_cars_custom.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];

                // alert(statusmessage.toString().trim());
                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#error-message-div").hide();
                    $("#success-message-div").show();
                    $('#sliderLeaseCarsForm2').hide();
                    $("#success-message-div").html(message);
                    $("#newtheme").hide();
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });



    $("form#sliderLeaseCarsForm3").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_lease_cars_corporate.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];

                // alert(statusmessage.toString().trim());
                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#error-message-div").hide();
                    $("#success-message-div").show();
                    $('#sliderLeaseCarsForm3').hide();
                    $("#success-message-div").html(message);
                    $("#newtheme").hide();
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $("form#ReportbreakdownForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_reportbreakdown.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];

                // alert(statusmessage.toString().trim());
                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#error-message-div").hide();
                    $("#success-message-div").show();
                    $('#contactForm').hide();
                    $("#success-message-div").html(message);
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });


    $("form#contactForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#submit-btn').hide();
        $('#reset-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_contactus.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#error-message-div").hide();
                    $("#success-message-div").show();
                    $('#contactForm').hide();
                    $("#success-message-div").html(message);
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#submit-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });

    $('#reset-btn').click(function () {
        $('#contactForm')[0].reset();
        location.reload();

    });


    $("form#subscribeForm").on('submit', function (e) {
        // console.log("Calling form!");
        e.preventDefault();
        $('#subscribe-ajaxLoader').show();
        $('#subscribe-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajaxSubscribe.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {
                // console.log(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#sub-error-message-div").hide();
                    $("#sub-success-message-div").show();
                    $('#subscribeForm').hide();
                    $("#sub-success-message-div").html(message);
                }

                if (statusmessage.toString().trim() === "ERROR") {

                    $("#subscribe-ajaxLoader").css('display', 'block');
                    $('#subscribe-ajaxLoader').hide();
                    $('#subscribe-btn').show();
                    $("#sub-error-message-div").show();
                    $("#sub-error-message-div").html(message);


                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;

    });


    $("form#enquiryForm").submit(function (e) {

        e.preventDefault();
        $('#ajaxLoader').show();
        $('#enquiry-btn').hide();

        var formData = new FormData(this);

        $.ajax({
            type: "POST", url: "ajax_enquiry.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);
                // alert(data);

                var statusmessage = data.trim().split("|")[0];
                var message = data.trim().split("|")[1];


                if (statusmessage.toString().trim() === "SUCCESS") {
                    $("#error-message-div").hide();
                    $("#success-message-div").show();
                    $('#enquiryForm').hide();
                    $("#success-message-div").html(message);
                }

                if (statusmessage.toString().trim() === "ERROR") {
                    $("#ajaxLoader").css('display', 'block');
                    $('#ajaxLoader').hide();
                    $('#enquiry-btn').show();
                    $("#error-message-div").show();
                    $("#error-message-div").html(message);
                }

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

        return false;
    });


    $("form#btnRentSearch").click(function (e) {
        console.log("click the button!");
        e.preventDefault();
        var formData = new FormData();

        $.ajax({
            type: "POST", url: "rent-a-cars", //url: "ajaxRentCars.php",
            data: formData, processData: false, contentType: false, success: function (data) {
                console.log(data);
            }
        });
        return false;
    });


    $("form#btnBook").click(function (e) {
        console.log("Calling this book button click!");
        e.preventDefault();
        var formData = new FormData();

        $.ajax({
            type: "POST", url: "book-rent-cars", data: formData, processData: false, contentType: false, success: function (data) {
                console.log(data);
            }
        });
        return false;
    });


    // for used cars



    jQuery("#make").change(function (e) {
        // console.log("Calling this script!");
        var sendData = new FormData();
        sendData.append("id", jQuery(this).val());

        // console.log(jQuery(this).val());

        jQuery.ajax({
            type: "POST", url: "ajax_fetch_model.php", data: sendData, processData: false, contentType: false, success: function (data) {
                console.log(data);
                var models = data.split("|")[0];
                var bodytypes = data.split("|")[1];
                var years = data.split("|")[2];

                $("#model").html(models);
                // $("#model").selectpicker('refresh');

                $("#bodytype").html(bodytypes);
                // $("#bodytype").selectpicker('refresh');

                $("#year").html(years);
                // $("#year").selectpicker('refresh');

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });


    //model
    jQuery("#model").change(function (e) {

        // alert($(this).val());
        var sendData = new FormData();
        sendData.append("makeID", jQuery("#make").val());
        sendData.append("modelID", jQuery(this).val());

        jQuery.ajax({
            type: "POST", url: "ajax_fetch_model_change.php", data: sendData, processData: false, contentType: false, success: function (data) {
                // console.log("Test: "+data);
                var bodytypes = data.split("|")[0];
                var years = data.split("|")[1];


                $("#bodytype").html(bodytypes);
                // $("#bodytype").selectpicker('refresh');

                $("#year").html(years);
                // $("#year").selectpicker('refresh');

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });

    //bodytype
    jQuery("#bodyType").change(function (e) {
        // alert($(this).val());

        var sendData = new FormData();
        sendData.append("makeID", jQuery("#make").val());
        sendData.append("modelID", jQuery("#model").val());
        sendData.append("bodyTypeID", jQuery(this).val());

        // console.log(jQuery(this).val());

        jQuery.ajax({
            type: "POST", url: "ajax_fetch_bodytype_change.php", data: sendData, processData: false, contentType: false, success: function (data) {

                // console.log(data);
                var years = data.split("|")[0];

                $("#year").html(years);
                // $("#year").selectpicker('refresh');

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });


    $("form#sliderUsedCarsForm").submit(function (e) {
        var formData = new FormData();

        $.ajax({
            type: "POST", url: "used-cars", data: formData, success: function (data) {
                console.log(data);
            }
        });
        return false;
    });

    // for used cars


    //for lease cars


    $(document).ready(function () {
        $("#standardLeaseDiv").show();
        $("#customLeaseDiv").hide();
        $("#companyLeaseDiv").hide();
    });


    $('#standardLease2').change(function () {
        if (this.checked == true) {
            $("#standardLeaseDiv").show();
            $("#customLeaseDiv").hide();
            $("#companyLeaseDiv").hide();

        }
    });

    $('#customLease2').change(function () {
        if (this.checked == true) {
            $("#standardLeaseDiv").hide();
            $("#customLeaseDiv").show();
            $("#companyLeaseDiv").hide();

        }
    });

    $('#companyLease2').change(function () {
        if (this.checked == true) {
            $("#standardLeaseDiv").hide();
            $("#customLeaseDiv").hide();
            $("#companyLeaseDiv").show();


        }
    });

    jQuery("#leaseClass").change(function (e) {
        // console.log("Calling this script!");
        var sendData = new FormData();
        sendData.append("id", jQuery(this).val());

        // console.log(jQuery(this).val());

        jQuery.ajax({
            type: "POST", url: "ajax_fetch_model_leasecars.php", data: sendData, processData: false, contentType: false, success: function (data) {
                console.log(data);
                var models = data.split("|")[0];

                $("#leaseMakeModel").html(models);

            }, always: function (data) {
                console.log("Always snippet" + data);
            }, fail: function (data) {
                console.log("Error sniippet" + data);
            }
        });

    });


    //for lease cars
    $('#vrf.icheck').change(function () {
        var checkBox = document.getElementById("vrf");
        if (checkBox.checked == true) {
            var vrt = 52.50;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = vrt + totalPrice;
            $('input[name=totalcalculate]').val(total);
        } else {
            var vrt = 52.50;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - vrt;
            $('input[name=totalcalculate]').val(total);
        }


    });

    $('#scdw.icheck').change(function () {
        var checkBox = document.getElementById("scdw");
        if (checkBox.checked == true) {
            var scdw = 52.50;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = scdw + totalPrice;
            $('input[name=totalcalculate]').val(total);
        } else {
            var scdw = 52.50;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - scdw;
            $('input[name=totalcalculate]').val(total);
        }


    });

    $('#cdw.icheck').change(function () {
        var checkBox = document.getElementById("cdw");
        if (checkBox.checked == true) {
            var cdw = 26.25;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = cdw + totalPrice;
            $('input[name=totalcalculate]').val(total);
        } else {
            var cdw = 26.25;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - cdw;
            $('input[name=totalcalculate]').val(total);
        }


    });

    $('#pai.icheck').change(function () {
        var checkBox = document.getElementById("pai");
        if (checkBox.checked == true) {
            var pai = 10.50;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = pai + totalPrice;
            $('input[name=totalcalculate]').val(total);
        } else {
            var pai = 10.50;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - pai;
            $('input[name=totalcalculate]').val(total);
        }


    });


    // $('.icheck').on('ifChanged', function(event)
    // {
    //     alert("not this one");
    // });


    $(document).on('ifChanged', '#gps', function (e) {



        var checkBox = document.getElementById("gps");
        if (checkBox.checked == true) {
            var gps = 42.00;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = gps + totalPrice;
            $('input[name=totalcalculate]').val(total);
        } else {
            var gps = 42.00;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - gps;
            $('input[name=totalcalculate]').val(total);
        }

    });

    $('#additionalDriver.icheck').change(function () {
        var checkBox = document.getElementById("additionalDriver");
        if (checkBox.checked == true) {
            var additionalDriver = 15.75;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = additionalDriver + totalPrice;
            $('input[name=totalcalculate]').val(total);
        } else {
            var additionalDriver = 15.75;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - additionalDriver;
            $('input[name=totalcalculate]').val(total);
        }

    });

    $('#babySafetySeat.icheck').change(function () {

        var checkBox = document.getElementById("babySafetySeat");
        if (checkBox.checked == true) {
            var babySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = babySafetySeat + totalPrice;
            $('input[name=totalcalculate]').val(total);

        } else {
            var babySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - babySafetySeat;
            $('input[name=totalcalculate]').val(total);

        }

    });

    $('#addBabySafetySeat.icheck').change(function () {

        var checkBox = document.getElementById("addBabySafetySeat");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculate]').val(total);

        } else {
            var addBabySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculate]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculate]').val(total);

        }

    });

    $('#iDelivery.icheck').change(function () {
        var checkBox = document.getElementById("iDelivery");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 52.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 52.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });
    $('#ivrf.icheck').change(function () {
        var checkBox = document.getElementById("ivrf");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 52.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 52.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });
    $('#iscdw.icheck').change(function () {
        var checkBox = document.getElementById("iscdw");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 52.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 52.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });
    $('#icdw.icheck').change(function () {
        var checkBox = document.getElementById("icdw");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 26.25;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 26.25;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });

    $('#ipai.icheck').change(function () {
        var checkBox = document.getElementById("ipai");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 10.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 10.50;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });

    $('#igps.icheck').change(function () {
        var checkBox = document.getElementById("igps");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 42.00;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 42.00;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });

    $('#iad.icheck').change(function () {
        var checkBox = document.getElementById("iad");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 15.75;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 15.75;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });

    $('#ibss.icheck').change(function () {
        var checkBox = document.getElementById("ibss");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });

    $('#iabss.icheck').change(function () {
        var checkBox = document.getElementById("iabss");
        if (checkBox.checked == true) {
            var addBabySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = addBabySafetySeat + totalPrice;
            $('input[name=totalcalculatelease]').val(total);

        } else {
            var addBabySafetySeat = 36.75;
            var totalcalculate = $('input[name=totalcalculatelease]').val();
            var totalPrice = parseFloat(totalcalculate);
            var total = totalPrice - addBabySafetySeat;
            $('input[name=totalcalculatelease]').val(total);

        }

    });


</script>


<style>


    #success-message-div {
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

    #error-message-div {
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


    #sub-success-message-div {
        top: -10px;
        background-color: #5aa631;
        border: 1px solid #c8f8af;
        background: #eaffdf;
        text-align: center;
        max-width: 95%;
        color: #000000;
        padding: 10px;
        left: 10px;
        width: 100%;
    }

    #sub-error-message-div {
        top: -10px;
        background-color: #7C0304;
        border: 1px solid #ffd8d8;
        background: #e30613;
        text-align: center;
        width: 100%;
        max-width: 95%;
        color: #ffffff;
        padding: 5px;
        left: 10px;
    }
</style>

