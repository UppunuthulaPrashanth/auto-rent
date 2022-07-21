<?php 
require "lib/config/config.php";
require "lib/config/autoload.php";
//error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$carr = careerdb::getInstance();
$careers = $carr->fetch_active_careers();
$location= new dbcountrylocation;
$options = options::getInstance();
$selected_page=$options->get_page("autorent _sees_great_success"); 

 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include "header.php"; ?>
    <?php echo $head; ?>
    <meta name="keywords" content="<?php echo $selected_page["meta_keyword"]; ?>"/>
    <meta name="description" content="<?php echo $selected_page["meta_des"]; ?>"/>
    <title><?php echo $selected_page["page_title"]; ?></title>
</head>
<body>
    <!-- 
                                        Header Area
    ========================================================================== -->
    <section class="header-search">
        <?php echo $mainnav; ?>
               <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>
        <div class="clearfix"></div>
        <div class="search-cover">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 icon"><img class="pull-right" src="images/choose-icon.png" alt=""></div>
                    <div class="col-md-11 text"><h1 class="tagline pull-left" style="font-size: 30px;"><span><?php echo $selected_page["title"]; ?></span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <!-- 
                                        Careers Section
    ========================================================================== -->


<div id="loader"></div>
 <section class="blog-sec">
     <div class="container">
         <div class="col-md-9 blog-left">
         <div class="col-md-12 blog-desc" style="background-color: #F9F9F9;padding: 15px;">
               <h1 style="font-size: 30px;margin-bottom: 5px;font-family: 'proxima_nova_rgbold';"><?php echo $selected_page["title"]; ?></h1>
               
              <?php
$mystring = $selected_page["content"];
$findme   = "[Contact_Form][/Contact_Form]";
$pos = strpos($mystring, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of "a" was the 0th (first) character.
if ($pos === false) {
    $final_content=$selected_page["content"];
} else {
    $final_content=str_replace("[Contact_Form][/Contact_Form]","<form action='#' class='form contact-form' id='contact_form'>
                        <div class='fromerror' style='color:red'></div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='name' class='lblmargin'>Name <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='text' class='form-control name' name='name' placeholder='Enter Your Name...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='subject' class='lblmargin'>Subject <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='text' class='form-control subject' name='subject' placeholder='Enter Subject of Your Message...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='email' class='lblmargin'>Email <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='email' class='form-control contact_email' name='email' placeholder='Enter Your Email...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='confirm-email' class='lblmargin'>Confirm Email <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='email' class='form-control cemail' name='cemail' placeholder='Re-enter Your Email...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='phone' class='lblmargin'>Telephone <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='phone' style='border-radius:0!important; height:38px!important' class='form-control cell' name='cell' placeholder='Enter Your Contact Number...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='address' class='lblmargin'>Address <span class='staric-icon glyphicon glyphicon-asterisk'></span> </label>
                              <input type='email' class='form-control address' name='address' placeholder='Enter YOur Postal Address...'>
                           </div>
                        </div>
                        <div class='col-md-12 nopad-lr '>
                           <div class='form-group'>
                              <label for='email' class='lblmargin'>Message <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <textarea class='cover-letter msg' rows='4' style='height:200px' cols='50' name='msg' placeholder='Type your cover letter here...'></textarea>
                           </div>
                        </div>
                        <div class='col-md-12 nopad-lr'>
                           <div class='form-group'>
                              <button type='button' id='enquiries' value='Submit' class='main-btn form-submit enquiries'>Submit</button>
                              <button type='reset' value='Reset' class='main-btn form-reset'>Reset</button>
                           </div>
                        </div>
                        <div class='clearfix'></div>
                     </form>",$mystring);

}
?>
             <p><?php echo $final_content; ?></p>
         

         </div>
         </div>
           <?php echo $news_sidebar; ?>
         </div>

        
     </div> <div class="clearfix"></div>
 </section>
 <div class="clearfix"></div>
    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>


<script>
$(document).ready(function() {
    $(document).on("click",".enquiries",function(event) {
            current_form=$(this).parents(".contact-form");
          var name = current_form.find(".name").val();
          var subject = current_form.find(".subject").val();
          var email = current_form.find(".contact_email").val();
          var cemail = current_form.find(".cemail").val();
          var cell = current_form.find(".cell").val();
          var address = current_form.find(".address").val();
          var msg = current_form.find(".msg").val();

          if(name =="" || subject == "" || email == "" || cemail == "" || cell == "" || address == "" || msg == "")
          {
            current_form.find(".fromerror").html("Please enter all fields.");
          }
          else
          {
            $("#loader").addClass("preloader");
              $.ajax({
              url: "include/contact_enquiries.php",
              type: "POST",
              data:
              {
                name: name,
                subject: subject,
                email: email,
                cemail: cemail,
                cell: cell,
                address: address,
                msg: msg,
              },
              success: function(response)
              {
                if (response=="1") 
                {
                    current_form.find(".fromerror").html("Email and Confirm Email Not Matched");
                }
                else if (response=="2") 
                {
                    current_form.find(".fromerror").html("Only Letters Are Allowed For Name.");
                }
                else if (response=="3") 
                {
                    current_form.find(".fromerror").html("Only Letters and Numbers Are Allowed For Subject.");
                }
                else if (response=="4") 
                {
                    current_form.find(".fromerror").html("Invalid Email");
                }
                else if (response=="5") 
                {
                    current_form.find(".fromerror").html("Invalid Confirm Email.");
                }
                else if (response=="6") 
                {
                    current_form.find(".fromerror").html("Only Numbers Are Allowed For Telephone.");
                }                 
                else if (response=="8") 
                {
                    current_form.find(".fromerror").html("Some Error Occure Please Try Again.");
                    current_form[0].reset();
                }
                else
                {
                    current_form.find(".fromerror").html("Your Enquiry is Succefully Added");
                    current_form[0].reset();
                }
                $("#loader").removeClass("preloader");
              }
              });
         
          }         
         });
 });




</script>
</body>
</html>
