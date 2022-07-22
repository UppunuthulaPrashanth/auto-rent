<script src="js/jquery.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>




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

<script src="js/custom-v2.js"></script>





<script src="js/multiple-select-bundle.js"></script>

<script src="js/multiple-select-select.js"></script>



<script src='https://www.google.com/recaptcha/api.js'></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb26jMuIMtepAh3T2WfJRzg5eZgUqNIIw&callback=initMap"></script>
<style>

    /*sticky header*/



    .fixed-header {

        position: fixed;

        top: 0;

        /*left: 0;*/

        width: 100%;

    }



    .scrolltop-index

    {

        z-index: 1;

    }



    .filter-form-index

    {

        z-index: 1 !important;

    }



    /*sticky header*/

</style>



<script>







    var $ = jQuery;

    // $('#contact-header').html('<a href="contact.php">Google</a>');

    $("#confirmEmail").blur(function () {

        // console.log("Calling this function!");

        if ($("#email").val() != $("#confirmEmail").val()) {

            $("#error-message-div").show();

            $("#error-message-div").html("Email doesn't match!");

            //document.getElementById("confirmEmail").focus();



        } else {

            $("#error-message-div").hide();

        }

    });







    // sticky header



    $(window).scroll(function(){

        if ($(window).scrollTop() >= 200) {

            $('nav').addClass('fixed-header');

            $('.top-cate').addClass('scrolltop-index');

            // $('nav div').addClass('visible-title');

        }

        else {

            $('nav').removeClass('fixed-header');

            $('.top-cate').removeClass('scrolltop-index');

            // $('nav div').removeClass('visible-title');

        }

    });





    // sticky header



















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

				// console.log(data);

                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];



                if (statusmessage.toString().trim() === "SUCCESS") {

                    window.location.href="/";

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

                    window.location.reload();

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

        $('#submitmobile-btn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST", url: "ajax_mobileupdate.php",

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

                    window.location.reload();

                    // $("#error-message-div").hide();

                    // $("#success-message-div").show();

                    // $('#ajaxLoader').hide();

                    // $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {

                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#submitmobile-btn').show();

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

                    window.location.reload();

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

                    window.location.reload();

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

                    window.location.reload();

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

                    window.location.reload();

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

                    window.location.reload();

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

                    window.location.reload();

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

                    window.location.reload();

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

        $('#submitreport-btn').hide();



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

                    $('#ReportbreakdownForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {

                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#submitreport-btn').show();

                    $("#error-message-div").show();

                    grecaptcha.reset();

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

                    $('#reset-btn').show();

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

        // console.log("click the button!");

        e.preventDefault();

        var formData = new FormData();



        $.ajax({

            type: "POST", url: "rent-a-cars", //url: "ajaxRentCars.php",

            data: formData, processData: false, contentType: false, success: function (data) {

                // console.log(data);

            }

        });

        return false;

    });













    $("form#btnBook").click(function (e) {

        // console.log("Calling this book button click!");

        e.preventDefault();

        var formData = new FormData();



        $.ajax({

            type: "POST", url: "book-rent-cars", data: formData, processData: false, contentType: false, success: function (data) {

                // console.log(data);

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







    $(document).ready(function () {

        $("#usedcarsIndividualDiv").show();

        $("#usedcarsCompanyDiv").hide();

    });



    $('#usedCarsCompany').change(function () {

        if (this.checked == true) {

            $("#usedcarsIndividualDiv").hide();

            $("#usedcarsCompanyDiv").show();

        }

    });



    $('#usedCarsType').change(function () {

        if (this.checked == true) {

            $("#usedcarsIndividualDiv").show();

            $("#usedcarsCompanyDiv").hide();

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

                var term = data.split("|")[2];



                $("#leaseMakeModel").html(models);

                $("#leaseTerm").html(term);



            }, always: function (data) {

                console.log("Always snippet" + data);

            }, fail: function (data) {

                console.log("Error sniippet" + data);

            }

        });



    });



    jQuery("#leaseMakeModel").change(function (e) {

        // console.log("Calling this script!");

        var sendData = new FormData();

        // sendData.append("id", jQuery(this).val());

        sendData.append("modelID", jQuery(this).val());



        // console.log(jQuery(this).val());



        jQuery.ajax({

            type: "POST", url: "ajax_fetch_model_leasecars.php", data: sendData, processData: false, contentType: false, success: function (data) {

                console.log(data);

                var term = data.split("|")[0];



                $("#leaseTerm").html(term);



            }, always: function (data) {

                console.log("Always snippet" + data);

            }, fail: function (data) {

                console.log("Error sniippet" + data);

            }

        });



    });





    // for lease cars listing new



    $(document).ready(function () {

        $("#IndividualFirstNameDiv").show();

        $("#IndividualLastNameDiv").show();

        $("#IndividualEmailDiv").show();

        $("#IndividualPhoneDiv").show();

        $("#IndividualCountryDiv").show();

        $("#IndividualCityDiv").show();

        $("#IndividualVehicleDiv").show();

        $("#IndividualSpecificRequirementDiv").show();



        $("#CorporateCompanyNameDiv").hide();

        $("#CorporateNameDiv").hide();

        $("#CorporateEmailDiv").hide();

        $("#CorporatePhoneDiv").hide();

        $("#CorporateCountryDiv").hide();

        $("#CorporateCityDiv").hide();

        $("#CorporateVehicleDiv").hide();

        $("#CorporateNoOfVehicleDiv").hide();

        $("#CorporateSpecificRequirementDiv").hide();

    });





    $("#selectedType").change(function() {

        if ($(this).val() == "Corporate") {

            $("#CorporateCompanyNameDiv").show();

                    $("#CorporateNameDiv").show();

                    $("#CorporateVehicleDiv").show();

                    $("#CorporateNoOfVehicleDiv").show();

                    $("#CorporateSpecificRequirementDiv").show();



                    $("#IndividualFirstNameDiv").hide();

                    $("#IndividualLastNameDiv").hide();

                    $("#IndividualVehicleDiv").hide();

                    $("#IndividualSpecificRequirementDiv").hide();



                    $("#firstName").removeAttr('required');

                    $('#lastName').removeAttr('required');

                    $("#vehicle").removeAttr('required');

        }

    });



    $("#selectedType").change(function() {

        if ($(this).val() == "Individual") {

                    $("#IndividualFirstNameDiv").show();

                    $("#IndividualLastNameDiv").show();

                    $("#IndividualEmailDiv").show();

                    $("#IndividualPhoneDiv").show();

                    $("#IndividualCountryDiv").show();

                    $("#IndividualCityDiv").show();

                    $("#IndividualVehicleDiv").show();

                    $("#IndividualSpecificRequirementDiv").show();



                    $("#CorporateCompanyNameDiv").hide();

                    $("#CorporateNameDiv").hide();

                    $("#CorporateVehicleDiv").hide();

                    $("#CorporateNoOfVehicleDiv").hide();

                    $("#CorporateSpecificRequirementDiv").hide();



                    $("#corporateCompanyName").removeAttr('required');

                    $("#corporateFullName").removeAttr('required');

                    $("#corporateVehicle").removeAttr('required');

                    $("#noOfVehicle").removeAttr('required');

        }

    });





    $("form#leaseCarsNewVehicleEnquiryForm").submit(function (e) {

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#leaseNewVehicleEnquiryBtn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST",

            url: "ajax_lease_listing_enquiry.php",

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

                    $('#leaseCarsNewVehicleEnquiryForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {

                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#leaseNewVehicleEnquiryBtn').show();

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







    // for lease cars enquiry new



    $(document).ready(function () {

        $("#EnquiryIndividualFirstNameDiv").show();

        $("#EnquiryIndividualLastNameDiv").show();

        $("#EnquiryIndividualEmailDiv").show();

        $("#EnquiryIndividualPhoneDiv").show();

        $("#EnquiryIndividualCountryDiv").show();

        $("#EnquiryIndividualCityDiv").show();

        $("#EnquiryIndividualVehicleDiv").show();

        $("#EnquiryIndividualSpecificRequirementDiv").show();



        $("#EnquiryCorporateCompanyNameDiv").hide();

        $("#EnquiryCorporateNameDiv").hide();

        $("#EnquiryCorporateEmailDiv").hide();

        $("#EnquiryCorporatePhoneDiv").hide();

        $("#EnquiryCorporateCountryDiv").hide();

        $("#EnquiryCorporateCityDiv").hide();

        $("#EnquiryCorporateVehicleDiv").hide();

        $("#EnquiryCorporateNoOfVehicleDiv").hide();

        $("#EnquiryCorporateSpecificRequirementDiv").hide();

    });





    $("#EnquirySelectedType").change(function() {

        if ($(this).val() == "Corporate") {

            $("#EnquiryCorporateCompanyNameDiv").show();

            $("#EnquiryCorporateNameDiv").show();

            $("#EnquiryCorporateVehicleDiv").show();

            $("#EnquiryCorporateNoOfVehicleDiv").show();

            $("#EnquiryCorporateSpecificRequirementDiv").show();



            $("#EnquiryIndividualFirstNameDiv").hide();

            $("#EnquiryIndividualLastNameDiv").hide();

            $("#EnquiryIndividualVehicleDiv").hide();

            $("#EnquiryIndividualSpecificRequirementDiv").hide();



            $("#firstName").removeAttr('required');

            $('#lastName').removeAttr('required');

            $("#vehicle").removeAttr('required');

        }

    });



    $("#EnquirySelectedType").change(function() {

        if ($(this).val() == "Individual") {

            $("#EnquiryIndividualFirstNameDiv").show();

            $("#EnquiryIndividualLastNameDiv").show();

            $("#EnquiryIndividualEmailDiv").show();

            $("#EnquiryIndividualPhoneDiv").show();

            $("#EnquiryIndividualCountryDiv").show();

            $("#EnquiryIndividualCityDiv").show();

            $("#EnquiryIndividualVehicleDiv").show();

            $("#EnquiryIndividualSpecificRequirementDiv").show();



            $("#EnquiryCorporateCompanyNameDiv").hide();

            $("#EnquiryCorporateNameDiv").hide();

            $("#EnquiryCorporateVehicleDiv").hide();

            $("#EnquiryCorporateNoOfVehicleDiv").hide();

            $("#EnquiryCorporateSpecificRequirementDiv").hide();



            $("#corporateCompanyName").removeAttr('required');

            $("#corporateFullName").removeAttr('required');

            $("#corporateVehicle").removeAttr('required');

            $("#noOfVehicle").removeAttr('required');

        }

    });





    $("form#leaseCarsNewEnquiryForm").submit(function (e) {

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#leaseNewEnquiryBtn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST",

            url: "ajax_lease_new_enquiry.php",

            data: formData,

            cache: false,

            contentType: false,

            processData: false,

            success: function (data) {



                // console.log(data);

                // alert(data);



                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];





                if (statusmessage.toString().trim() === "SUCCESS") {

                    $("#error-message-div").hide();

                    $("#success-message-div").show();

                    $('#leaseCarsNewEnquiryForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {

                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#leaseNewEnquiryBtn').show();

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





    //bodytype

    jQuery("#leaseBodyType").change(function (e) {

        // alert($(this).val());



        var sendData = new FormData();

        sendData.append("bodyTypeID", jQuery("#leaseBodyType").val());

        // sendData.append("modelID", jQuery("#model").val());

        // sendData.append("bodyTypeID", jQuery(this).val());



        // console.log(jQuery(this).val());



        jQuery.ajax({

            type: "POST",

            url: "ajax_lease_fetch_make.php",

            data: sendData,

            processData: false,

            contentType: false,

            success: function (data) {



                // console.log(data);

                var makes = data.split("|")[0];



                $("#leaseMake").html(makes);

                // $("#year").selectpicker('refresh');



            }, always: function (data) {

                console.log("Always snippet" + data);

            }, fail: function (data) {

                console.log("Error sniippet" + data);

            }

        });



    });





    jQuery("#leaseMake").change(function (e) {

        var sendData = new FormData();

        sendData.append("makeID", jQuery(this).val());





        jQuery.ajax({

            type: "POST", url: "ajax_lease_fetch_model.php",

            data: sendData,

            processData: false,

            contentType: false,

            success: function (data)

            {

                // console.log(data);

                var models = data.split("|")[0];



                $("#leaseModel").html(models);



            }, always: function (data) {

                console.log("Always snippet" + data);

            }, fail: function (data) {

                console.log("Error sniippet" + data);

            }

        });



    });











    // feedback form



    $("form#feedback-Form").on('submit', function (e) {

        // console.log("Calling form!");

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#feedback-btn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST", url: "ajaxFeedback.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);



                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];





                if (statusmessage.toString().trim() === "SUCCESS") {

                    $("#error-message-div").hide();

                    $("#success-message-div").show();

                    $('#feedback-Form').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {



                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#feedback-btn').show();

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









    // corporate Leasing form



    $("form#corporateLeasingForm").on('submit', function (e) {

        // console.log("Calling form!");

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#corporateLeasing-btn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST", url: "ajax_corporateLeasing.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);



                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];





                if (statusmessage.toString().trim() === "SUCCESS") {

                    $("#error-message-div").hide();

                    $("#success-message-div").show();

                    $('#corporateLeasingForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {



                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#corporateLeasing-btn').show();

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



    // Rent Cars Enquiry form



    $("form#rentCarsEnquiryForm").on('submit', function (e) {

        // console.log("Calling form!");

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#rentCarsEnquiry-btn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST", url: "ajax_rent_cars_enquiry.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);



                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];





                if (statusmessage.toString().trim() === "SUCCESS") {

                    $("#error-message-div").hide();

                    $("#success-message-div").show();

                    $('#rentCarsEnquiryForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {



                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#rentCarsEnquiry-btn').show();

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




    // Pay as you drive Enquiry form



    $("form#payAsYouDriveEnquiryForm").on('submit', function (e) {

        // console.log("Calling form!");

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#payAsYouDriveEnquiry-btn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST", url: "ajax_payasyoudrive_enquiry.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);



                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];





                if (statusmessage.toString().trim() === "SUCCESS") {

                    $("#error-message-div").hide();

                    $("#success-message-div").show();

                    $('#payAsYouDriveEnquiryForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {



                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#payAsYouDriveEnquiry-btn').show();

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






    // corporate solution form



    $("form#corporateSolutionForm").on('submit', function (e) {

        // console.log("Calling form!");

        e.preventDefault();

        $('#ajaxLoader').show();

        $('#corporateSolution-btn').hide();



        var formData = new FormData(this);



        $.ajax({

            type: "POST", url: "ajax_corporateSolutions.php", data: formData, cache: false, contentType: false, processData: false, success: function (data) {

                // console.log(data);



                var statusmessage = data.trim().split("|")[0];

                var message = data.trim().split("|")[1];





                if (statusmessage.toString().trim() === "SUCCESS") {

                    $("#error-message-div").hide();

                    $("#success-message-div").show();

                    $('#corporateSolutionForm').hide();

                    $("#success-message-div").html(message);

                }



                if (statusmessage.toString().trim() === "ERROR") {



                    $("#ajaxLoader").css('display', 'block');

                    $('#ajaxLoader').hide();

                    $('#corporateSolution-btn').show();

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







// input radio style
$('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})


    // $("form#corporateSolutionForm").on('submit', function (e) {

    // document.getElementById('carCategorySubmit').onclick (function() {
    //
    //     var selected = [];
    //
    //     for (var option of document.getElementById('carCategory').options)
    //
    //     {
    //
    //         if (option.selected) {
    //
    //             selected.push(option.value);
    //
    //         }
    //
    //     }
    //
    //     alert(selected);
    //
    // });



    // tooltip

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    // tooltip
	
	
	    // signup datepicker disable the past dates

    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("licenseExpiry")[0].setAttribute('min', today);

    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("passportExpiry")[0].setAttribute('min', today);
	
	

</script>

<script>
    // loader
    $(window).on('load', function(){
        $(".loader").fadeOut("slow");

    });


    

   

$(function(){
    var today = new Date().toISOString().slice(0, 16);

document.getElementsByName("dropDate")[0].min = today;
document.getElementsByName("pickupDate")[0].min = today;

});


// if ( window.history.replaceState ) {
//   window.history.replaceState( null, null, window.location.href );
// }
</script>



<!-- GetButton.io widget -->

 <script type="text/javascript">
//     (function () {
//         var options = {
//             whatsapp: "+971600549993", // WhatsApp number
//             call_to_action: "Message us", // Call to action
//             position: "left", // Position may be 'right' or 'left'
//         };
//         var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
//         var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
//         s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
//         var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
//     })();
</script>


<!-- popup map for homepage -->

<script>
var mapDiv = document.createElement('div');
mapDiv.setAttribute("id", "map");
mapDiv.style.cssText = 'display: table; width: 45vw; height: 50vh;';
// document.body.appendChild(mapDiv);
$('#over_map').append(mapDiv)

var locations = [
    ['<h3>Sur</h3> in Oman', 22.568940175808038, 59.49751999750121, 3],
    ['<h3>Gala</h3> in Oman', 23.571706656752646, 58.3577412, 5],
    ['<h3>Duqm</h3> in Oman', 19.620307052018298, 57.63793199745145, 4],
    ['<h3>Qurum</h3> in Oman', 23.609564008385103, 58.49263308217661, 3],
    ['<h3>Sohar</h3> in Oman', 24.342513047222752, 56.72674072637047, 2],
    ['<h3>Salalah</h3> in Oman', 17.01899729783929, 54.043624353233106, 1],
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 5,
      center: new google.maps.LatLng(20.6,58.6),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }



    $('#dropMap').hover(function () {
        $('#myModal').modal({
            show: true,
            backdrop: false
        });
    });
    $('#pickupMap').hover(function () {
        $('#myModal').modal({
            show: true,
            backdrop: false
        });
    });
</script>
<!-- end popup map  -->




<!-- fetching user latitude longitude -->
<!-- <script>
    $('#myModal').modal({
            show: true,
            backdrop: false
        });

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(initMap);
}

function initMap(position) {
    var lat = position.coords.latitude;
    var long = position.coords.longitude;
    
    var pointA = new google.maps.LatLng(lat, long),
        pointB = new google.maps.LatLng(17.59124843377113, 79.23058434942016),
        myOptions = {
            zoom: 10,
            center: pointA
        },
        map = new google.maps.Map(document.getElementById('over_map'), myOptions),
        // Instantiate a directions service.
        directionsService = new google.maps.DirectionsService,
        directionsDisplay = new google.maps.DirectionsRenderer({
            map: map
        }),
        markerA = new google.maps.Marker({
            position: pointA,
            title: "point A",
            label: "A",
            map: map
        }),
        markerB = new google.maps.Marker({
            position: pointB,
            title: "point B",
            label: "B",
            map: map
        });

    // get route from A to B
    calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);

}



function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
    directionsService.route({
        origin: pointA,
        destination: pointB,
        avoidTolls: true,
        avoidHighways: false,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

initMap();



</script> -->
<!-- end fetching user latitude longiture -->


<style>
    .dfBDQI
    {
        display: none !important;
    }
</style>

<!-- homepage maps style -->
<style>
  /* #over_map { position: absolute; top: 10px; left: 10px; z-index: 99; 
  width:200px;height:100px;border:1px solid black; background: white; } */
  body.modal-open {
  padding-right: 0 !important;
  }
  .modal-body{
    min-height: 330px !important;
  }

</style>
<!-- /GetButton.io widget -->




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



