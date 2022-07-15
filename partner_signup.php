<?php 
   require 'lib/config/config.php';
   require 'lib/config/autoload.php';
   error_reporting(E_ALL);
   ob_start();
   $user = userdb::getInstance();
   if (isset($_GET['ref'])) {
       $ref = ($_GET['ref']);
   } else {
       $ref = "";
   }
   require_once 'lib/API/DB1-IPV6-COUNTRY.BIN/IP2Location.php';
   
   $loc = new IP2Location('lib/API/DB1-IPV6-COUNTRY.BIN/IP-COUNTRY.BIN', IP2Location::FILE_IO);
   
   /*
   Cache whole database into system memory and share among other scripts & websites
   WARNING: Please make sure your system have sufficient RAM to enable this feature
    */
   //$loc = new IP2Location('databases/IP-COUNTRY-SAMPLE.BIN', IP2Location::SHARED_MEMORY);
   
   /*
   Cache the database into memory to accelerate lookup speed
   WARNING: Please make sure your system have sufficient RAM to enable this feature
    */
   //$loc = new IP2Location(ROOT . 'databases/IP-COUNTRY-SAMPLE.BIN', IP2Location::MEMORY_CACHE);
   
   $ip = '23.29.192.0';
   // $ip = '88.85.32.0';
   // $ip = '212.77.31.255';
   // $ip = '14.7.255.255';
   // $ip = '181.232.127.255';
   // $ip = '94.100.111.255';
   // $ip = '193.188.47.255';
   // $ip = $_SERVER['REMOTE_ADDR'];
   
   // Lookup for all fields
   $record = $loc->lookup($ip, IP2Location::ALL);
   
   // echo '<pre>';
   // print_r($record);
   // echo '</pre>';
   
    ?>
<!DOCTYPE html>
<html class="no-js">
   <?php include 'header.php'; ?>
   <?php echo $head; ?>
   <title>Sign Up</title>
   <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script>
      $(document).ready(function(){
        $(".country-list").click(function(){
          $(".country-menu").toggleClass("showMenu");
            $(".country-menu > li").click(function(){
              $(".country-list > p").text($(this).text());
              $(".country-menu").removeClass("showMenu");
            });
        });
      });
      
      $(document).ready(function(){
        $(".city-list").click(function(){
          $(".city-menu").toggleClass("showMenu");
            $(".city-menu > li").click(function(){
              $(".city-list > p").text($(this).text());
              $(".city-menu").removeClass("showMenu");
            });
        });
      });
   </script>
   </head>
    <style>
    .preloader{
        
            z-index: 1051;
    }
    </style>
   <body>
   

 
      <!-- 
         Header Area
         ========================================================================== -->
      <div id="loader"></div>
      <section class="header-search">
         <?php echo $mainnav; ?>
             <?php echo $login_model; ?>    
    <?php echo  $forgetpass_model; ?>
    <?php echo  $partner_forgetpass_model; ?>
         <div class="clearfix"></div>
      </section>
      <div class="clearfix"></div>
      
      <section id="signup">
         <div class="container">
            <div class="tagline" style="    margin-bottom: 20px;">
               <h1 class="">Partner</h1>
               
            </div>
            <div class="form-wrapper">
               <div class="loginform">
                  <div style="margin-bottom: 40px;border-bottom: 1px solid #ddd;" class="col-md-12 nopad-l">
                    <div style="float: none;margin-left:auto;margin-right:auto;" class="col-md-3 col-sm-6  col-xs-8 nopad-l">
                     <ul style="border-bottom: none!important;" class="nav nav-tabs">
                        <li style=" font-size:17px;" class="active"><a data-toggle="tab" href="#partner">Signup</a></li>
                        <li style=" font-size:17px;"><a data-toggle="tab" href="#individual">Login</a></li>
                     </ul>
                  </div>
               </div>
<?php       
if (isset($_GET['error']) && $_GET['error'] == 1) {
   echo '<p style="color:white">Token is Expired.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 2) {
   echo '<p style="color:white">User Name is not Available.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 3) {
   echo '<p style="color:white">Partner already exist with same Email.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 4) {
   echo '<p style="color:white">Ony Letters And Numbers Are Allowed For Company Name.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 5) {
   echo '<p style="color:white">Ony Letters Are Allowed For Person Name.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 6) {
   echo '<p style="color:white">Ony Letters Are Allowed For Designation.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 7) {
   echo '<p style="color:white">Ony Numbers Are Allowed For Phone.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 8) {
   echo '<p style="color:white">Ony Letters And Numbers Are Allowed For User Name.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 9) {
   echo '<p style="color:white">Email is Not in a Correct Formate.</p>';
}
 elseif (isset($_GET['error']) && $_GET['error'] == 9) {
   echo '<p style="color:white">Alphabets, numbers, hyphen, fullstops forward and back slash and commas and spaces .</p>';
}

if (isset($_GET['response']) && $_GET['response'] == "success") {
   echo '<p style="color:white">Your Request For Joining as a Partner Has Sent To The Administrator You Will be informed When Administrator Responed T0 Your Request..</p>';
}
?>
                  <p class="errorLogin" style="color:white"></p>
                  <div class="tab-content">
                  <div id="individual" class="tab-pane fade">
                    
                     <form action="#" method="post" id="form" enctype="multipart/form-data">

                        <h1 style="color: #fff;font-size: 36px;text-align: center;">Fill Out Form</h1>
                       
                        <div class="clearfix"></div>
                      
                        <div class="col-md-12 ">
                           <div class="form-group">
                              <label for="user-email">Email ID :</label>
                              <input type="email" class="form-control" name="email" id="pemail" required>
                           </div>
                        </div>
                         <div class="col-md-12 ">
                           <div class="form-group">
                              <label for="password">Password :</label>
                              <input type="password" class="form-control" name="password" id="ppass" required>
                           </div>
                        </div>
                          <div class="clearfix"></div>
                         <div class="col-md-6 ">
                           <div class="form-group">
                              <p><a href="#" data-toggle="modal" data-target="#partner_forgetpass_model" style="color: #fff;">Forget Password</a></p>
                           </div>
                        </div>
                        
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <p style="text-align: right;"><input type="checkbox" style="position: relative;top: 2px;" class="" id="rmber" name="rmber"/> Remeber me</p>
                           </div>
                        </div>
                       
                        
                      
                        <div class="col-md-12 ">
                           <div class="form-group">
                              <input type="button" id="partnerlogin" value="Login" class="btn-create-account"> 
                           </div>
                        </div>
                        </form>
                        
                        
                        
                        
                     </div>
               
                     <!--  /partner tab -->
                     <div id="partner" class="tab-pane fade  in active">
                          <form action="partner/include/partner_signup.php" method="post" id="form" enctype="multipart/form-data">

                        <h1 style="color: #fff;">Fill Out Form</h1>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="company-name">Company Name :</label>
                              <input type="text" class="form-control" name="company" id="cname" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="contact-person">Contact Person :</label>
                              <input type="text" class="form-control" name="pname" id="cperson" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="designation">Designation/Title :</label>
                              <input type="text" class="form-control" name="des" id="designation" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="phone-number">Phone No :</label>
                              <input type="phone" class="form-control" name="cell" id="num" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="user-name">User Name :</label>
                              <input type="text" class="form-control" name="username" id="username" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="user-email">Email ID :</label>
                              <input type="email" class="form-control" name="email" id="pemail" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="user-email">Address :</label>
                              <input type="text" class="form-control" name="address" id="address" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 nopad-l">
                           <div class="form-group">
                              <p class="" style="text-align: left; color:#fff">Attachment (Commercial trade license) – Mendatory</p>
                              <!-- Change the wording using a title tag -->
                              <input type="file" title="Search for a file to add" name="img" id="attach" required value="sasasassa">
                           </div>
                        </div>
                        <div class="col-md-12 nopad-l">
                           <div class="form-group">
                              <input type="submit" value="Create Account" class="btn-create-account"> 
                           </div>
                        </div>
                        </form>
                     </div>
         
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </section>
      <!--
         Footer Area
         ========================================================================== -->
      <?php echo $footer; ?>
      <script type="text/javascript">
         $(document).ready(function()
         {
         $("#partnerlogin").click(function()
            {
                $("#loader").addClass("preloader");
    
              var user_email = $("#pemail").val();
              var user_password = $("#ppass").val();
              var remember = "no";
              var isChecked = $("#rmber:checked").val()?true:false;
    
              if(isChecked)
              {
                remember = "yes";
              }
    
              if(user_email =="" || user_password == "")
              {
                $(".errorLogin").html("Please enter all required fields.");
                $("#loader").removeClass("preloader");
              }
              else
              {
                  $.ajax({
                  url: "partner/include/partner_login.php",
                  type: "POST",
                  data:
                  {
                    email: user_email,
                    password: user_password,
                    remember: remember,
                    location: "dashboard.php"
                  },
                  success: function(data)
                  {
                    if(data == "1")
                    {
                    $(".errorLogin").html("Partner not found");
                    }
                    else if(data == "2")
                    {
                    $(".errorLogin").html("Password not match.");
                    }
                    else if(data="yes")
                    {
                    window.location.href = "index.php";
                    }
                    $("#loader").removeClass("preloader");
                  }
                  });
              }
    
            return false;
            });
        
           $('#user_reg').click(function()
           {
               var fname = $('#fname').val();
               var lname = $('#lname').val();
               var email = $('#email').val();
               var dob = $('#user_dob').val();
               var password = $('#password').val();
               var conpass = $('#conpass').val();
               var gen = $("input:radio[name=gen]:checked").val();
               var countrycode = $('#countrycode').val();
               var ipnumber = $('#ipnumber').val();
               var ref = $('#ref').val();
               var biladres1 = $('#biladres1').val();
               var country = $('#country').val();
               var city = $('#city').val();
               var postalcode = $('#postalcode').val();
         
               if (fname=="") 
               {
                   $('.errorLogin').html("Please Enter First Name.");
               }
               else if(lname=="")
               {
                   $('.errorLogin').html("Please Enter Last Name.");
               }
               else if(email=="")
               {
                   $('.errorLogin').html("Please Enter Email.");
               }
               else if(dob=="")
               {
                   $('.errorLogin').html("Please Select Date Of Birth. ");
               }
               else if(password=="")
               {
                   $('.errorLogin').html("Please Enter Password.");
               }
               else if(conpass=="")
               {
                   $('.errorLogin').html("Please Confirm YOur Password.");
               }
               else if(biladres1=="")
               {
                   $('.errorLogin').html("Please Enter Address");
               }
               else if(city=="")
               {
                   $('.errorLogin').html("Please Enter City");
               }
               else if(postalcode=="")
               {
                   $('.errorLogin').html("Please Enter Postal Code.");
               }
               else
               {
                                 $.ajax({
                 url: 'include/user_signup.php',
                 type: 'POST',
                 data:
                 {
                   fname: fname,
                   lname: lname,
                   email: email,
                   dob: dob,
                   password: password,
                   conpass: conpass,
                   gen: gen,
                   adres: biladres1,
                   country: country,
                   countrycode: countrycode,
                   ipnumber: ipnumber,
                   city: city,
                   postalcode: postalcode,
                   ref: ref,
         
                 },
                 success: function(data)
                 {
                       if (data==1) 
                       {
                           $('.errorLogin').html("Password And Confirm Password Not Matched.");
                       }
                       else if(data==2)
                       {
                           $('.errorLogin').html("User With Same Email Already Exists.");
                       }
                       else if(data==3)
                       {
                           $('.errorLogin').html("Some Error Occure While Creating Account.");
                       }
                       else if(data==4)
                       {
                           $('.errorLogin').html("Only Letters Are Allowed For First Name.");
                       }
                       else if(data==5)
                       {
                           $('.errorLogin').html("Only Letters Are Allowed For Last Name.");
                       }
                       else if(data==6)
                       {
                           $('.errorLogin').html("Email is Not In Valid Form.");
                       }
                       else if(data==7)
                       {
                           $('.errorLogin').html("Only Letters And Numbers Are Allowed For Address.");
                       }
                       else if(data==8)
                       {
                           $('.errorLogin').html("Only Letters Are Allowed For Country.");
                       }
                       else if(data==9)
                       {
                           $('.errorLogin').html("Only Letters Are Allowed For City.");
                       }
                       else if(data==10)
                       {
                           $('.errorLogin').html("Only Numbers Are Allowed For Postal Code.");
                       }
                       else
                       {
                           $('.errorLogin').html("You Have Successfully Registerd.A Mail Hase Been Sent To Your Email Address.Please Confirm Your Email Address."); 
                           setTimeout(function () {
                               window.location.href = "<?php echo URL ?>index.php"; //will redirect to your blog page (an ex: blog.html)
                               }, 5000);
                       }
                 }
                 });
               } 
         
           
               });
               
               


         });
      </script>
   </body>
</html>