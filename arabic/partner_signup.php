<?php 
   require '../lib/config/config.php';
   require '../lib/config/autoload.php';
   error_reporting(E_ALL);
   ob_start();
   $user = userdb::getInstance();
   if (isset($_GET['ref'])) {
       $ref = ($_GET['ref']);
   } else {
       $ref = "";
   }
   require_once '../lib/API/DB1-IPV6-COUNTRY.BIN/IP2Location.php';
   
   $loc = new IP2Location('../lib/API/DB1-IPV6-COUNTRY.BIN/IP-COUNTRY.BIN', IP2Location::FILE_IO);
   
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
   
<style>

#signup .container .form-wrapper .loginform .tab-content label {
    color: #fff;
    text-align: right;
    direction: rtl;
}
</style>
   </head>
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
               <h1 class="">اشترك</h1>
               <p class="">عليك أن تكون قائمة وعاملة في أقل من دقيقة</p>
            </div>
            <div class="form-wrapper">
               <div class="loginform">
                   <div style="margin-bottom: 40px;border-bottom: 1px solid #ddd;" class="col-md-12 nopad-l">
                    <div style="float: none;margin-left:auto;margin-right:auto;" class="col-md-5 col-sm-7  col-xs-8 nopad-l">
                     <ul style="border-bottom: none!important;" class="nav nav-tabs"> 
                        <li style=" font-size:17px;" class="active"><a data-toggle="tab" href="#partner">اشترك</a></li>
                        <li style=" font-size:17px;"><a data-toggle="tab" href="#individual">تسجيل الدخول</a></li>
                     </ul>
                  </div>
               </div>
<?php       
if (isset($_GET['error']) && $_GET['error'] == 1) {
   echo '<p style="color:white">وانتهى المنوال.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 2) {
   echo '<p style="color:white">إسم المستخدم غير متوفر.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 3) {
   echo '<p style="color:white">شريك موجودة بالفعل مع نفس البريد الإلكتروني.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 4) {
   echo '<p style="color:white">رسائل بنيويورك أرقام و يسمح للاسم الشركة.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 5) {
   echo '<p style="color:white">رسائل ويسمح فقط لاسم الشخص.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 6) {
   echo '<p style="color:white">فقط رسائل يسمح للتعيين.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 7) {
   echo '<p style="color:white">الوحيدة أرقام يسمح للهاتف.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 8) {
   echo '<p style="color:white">الحروف والأرقام ويسمح فقط لاسم المستخدم.</p>';
} elseif (isset($_GET['error']) && $_GET['error'] == 9) {
   echo '<p style="color:white">البريد الإلكتروني ليست في الشكل الصحيح.</p>';
}
 elseif (isset($_GET['error']) && $_GET['error'] == 9) {
   echo '<p style="color:white">الحروف الهجائية والأرقام واصلة، توقف كامل إلى الأمام ومائل والفواصل والمسافات .</p>';
}

if (isset($_GET['response']) && $_GET['response'] == "success") {
   echo '<p style="color:white">طلبك للانضمام كشريك بعث إلى المسؤول تكونوا على علم المسؤول عند الاستجابة لطلب الخاص بك..</p>';
}
?>
                  <p class="errorLogin" style="color:white"></p>
                  <div class="tab-content">
                   
                        
                        
                        
                        
                              <div id="individual" class="tab-pane fade">
                    
                     <form action="#" method="post" id="form" enctype="multipart/form-data">

                        <h1 style="color: #fff;font-size: 36px;text-align: center;">ملء استمارة</h1>
                       
                        <div class="clearfix"></div>
                      
                        <div class="col-md-12 ">
                           <div class="form-group">
                              <label for="user-email">البريد الإلكتروني :</label>
                              <input type="email" class="form-control" name="email" id="pemail" required>
                           </div>
                        </div>
                         <div class="col-md-12 ">
                           <div class="form-group">
                              <label for="password">كلمة السر :</label>
                              <input type="password" class="form-control" name="password" id="ppass" required>
                           </div>
                        </div>
                          <div class="clearfix"></div>
                         <div class="col-md-6 ">
                           <div class="form-group">
                              <p><a href="#" data-toggle="modal" data-target="#partner_forgetpass_model" style="color: #fff;">نسيت كلمة المرور</a></p>
                           </div>
                        </div>
                        
                          <div class="col-md-6 ">
                           <div class="form-group">
                              <p style="text-align: right;"><input type="checkbox" style="position: relative;top: 2px;" class="" id="rmber" name="rmber"/> تذكرنى</p>
                           </div>
                        </div>
                       
                        
                      
                        <div class="col-md-12 ">
                           <div class="form-group">
                              <input type="button" id="partnerlogin" value="تسجيل الدخول" class="btn-create-account"> 
                           </div>
                        </div>
                        </form>
                        
                        
                        
                        
                     </div>
                     
                        
                     
               
                     <!--  /partner tab -->
                     <div id="partner" class="tab-pane fade  in active">
               <form action="../partner/include/partner_signup_arabic.php" method="post" id="form" enctype="multipart/form-data">

                        <h1 style="color: #fff;">ملء استمارة</h1>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="company-name">اسم الشركة :</label>
                              <input type="text" class="form-control" name="company" id="cname" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="contact-person">الشخص الذي يمكن الاتصال به :</label>
                              <input type="text" class="form-control" name="pname" id="cperson" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="designation">تعيين / العنوان :</label>
                              <input type="text" class="form-control" name="des" id="designation" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="phone-number">رقم الهاتف :</label>
                              <input type="phone" class="form-control" name="cell" id="num" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="user-name">اسم المستخدم :</label>
                              <input type="text" class="form-control" name="username" id="username" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="user-email">البريد الإلكتروني معرف :</label>
                              <input type="email" class="form-control" name="email" id="pemail" required>
                           </div>
                        </div>
                        <div class="col-md-6 nopad-l">
                           <div class="form-group">
                              <label for="user-email">العنوان :</label>
                              <input type="text" class="form-control" name="address" id="address" required>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 nopad-l">
                           <div class="form-group">
                              <p class="" style="text-align: left; color:#fff">المرفق (الرخصة التجارية التجاري) - إجباري</p>
                              <!-- Change the wording using a title tag -->
                              <input type="file" title="Search for a file to add" name="img" id="attach" required value="sasasassa">
                           </div>
                        </div>
                        <div class="col-md-12 nopad-l">
                           <div class="form-group">
                              <input type="submit" value="إنشاء حساب" class="btn-create-account"> 
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
                  url: "../partner/include/partner_login.php",
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
                    $(".errorLogin").html("لم يتم العثور على الشريك");
                    }
                    else if(data == "2")
                    {
                    $(".errorLogin").html("كلمة المرور غير متطابقتين.");
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
                   $('.errorLogin').html("الرجاء إدخال الاسم الأول.");
               }
               else if(lname=="")
               {
                   $('.errorLogin').html("يرجى إدخال اسم العائلة.");
               }
               else if(email=="")
               {
                   $('.errorLogin').html("الرجاء أدخل البريد الالكتروني.");
               }
               else if(dob=="")
               {
                   $('.errorLogin').html("الرجاء اختيار تاريخ الميلاد. ");
               }
               else if(password=="")
               {
                   $('.errorLogin').html("الرجاء إدخال كلمة المرور.");
               }
               else if(conpass=="")
               {
                   $('.errorLogin').html("الرجاء تأكيد كلمة السر الخاصة بك.");
               }
               else if(biladres1=="")
               {
                   $('.errorLogin').html("الرجاء إدخال عنوان");
               }
               else if(city=="")
               {
                   $('.errorLogin').html("يرجى إدخال المدينة");
               }
               else if(postalcode=="")
               {
                   $('.errorLogin').html("الرجاء إدخال الرمز البريدي.");
               }
               else
               {
                                 $.ajax({
                 url: '../include/user_signup.php',
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
                           $('.errorLogin').html("كلمة المرور وتأكيد كلمة المرور لا تضاهي.");
                       }
                       else if(data==2)
                       {
                           $('.errorLogin').html("المستخدم مع نفس البريد الإلكتروني موجود بالفعل.");
                       }
                       else if(data==3)
                       {
                           $('.errorLogin').html("بعض خطأ أثناء إنشاء حساب أكور.");
                       }
                       else if(data==4)
                       {
                           $('.errorLogin').html("رسائل ويسمح فقط للاسم الأول.");
                       }
                       else if(data==5)
                       {
                           $('.errorLogin').html("فقط رسائل ويسمح لاسم العائلة.");
                       }
                       else if(data==6)
                       {
                           $('.errorLogin').html("البريد الإلكتروني ليست في شكلها صالح.");
                       }
                       else if(data==7)
                       {
                           $('.errorLogin').html("الحروف والأرقام ويسمح فقط للالعنوان.");
                       }
                       else if(data==8)
                       {
                           $('.errorLogin').html("فقط رسائل يسمح للبلد.");
                       }
                       else if(data==9)
                       {
                           $('.errorLogin').html("فقط رسائل يسمح للمدينة.");
                       }
                       else if(data==10)
                       {
                           $('.errorLogin').html("الوحيدة أرقام يسمح لالرمز البريدي.");
                       }
                       else
                       {
                           $('.errorLogin').html("لقد تم تسجيل بنجاح. البريد الإلكتروني تم إرسالها إلى العنوان البريد الإلكتروني الخاص بك. رجاء قم بتأكيد بريدك الالكتروني."); 
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