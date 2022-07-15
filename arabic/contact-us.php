<?php 
   require '../lib/config/config.php';
   require '../lib/config/autoload.php';
   error_reporting(E_ALL);
   ob_start();
   $user = userdb::getInstance();
   
    ?>
<!DOCTYPE html>
<html class="no-js">
   <?php include 'header.php'; ?>
   <?php echo $head; ?>
   <title>الاتصال بنا</title>
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
                   <div class="col-md-11 text"><h1 class="tagline pull-right"><span>الاتصال بنا</span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                 
                </div>
            </div>
        </div>
         <div class="clearfix"></div>
      </section>
      <div class="clearfix"></div>
      <!-- 
         Offices Section
         ========================================================================== -->
      <section id="offices">
         <div class="container">
            <div class="row">
               <div class="col-md-4 flag">
                <div class="col-md-12 inner-flag">
                  <div class="circle">
                     <img src="../images/KSA-Flag.png" alt="">
                  </div>
                  <div class="clearfix"></div>
                  <div class="office-address">
                     <h4 class="city-name">جدة,   المملكة العربية السعودية</h4> 
                     <h4>هاتف : <span class="phone">(+971) 600549993</span></h4>
                     <h4>البريد الإلكتروني :<span  class="email">bookings@autorent-me.com </span></h4>
                     <h4>الفاكس : <span class="fax">(+971) 600549993</span></h4>
                  </div>
                  <div class="clearfix"></div>
                  <div class="map" id="map_canvas1" style="height: 300px;width: 300px;">
                     <script>
                     
                     var myLatLng = {lat: 21.2854067, lng: 39.2375507};

                                      var map = new google.maps.Map(document.getElementById('map_canvas1'), {
                                        zoom: 10,
                                        center: myLatLng
                                      });
                                    
                                      var marker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map,
                                      });
                     </script>
                  </div>
                  </div>
               </div>
               
               <div class="col-md-4 flag">
               <div class="col-md-12 inner-flag">
                  <div class="circle">
                     <img src="../images/Muscat-Flag.png" alt="">
                  </div>
                  <div class="clearfix"></div>
                   <div class="office-address">
                    <h4 class="city-name">مسقط  , سلطنة عمان</h4>
                     <h4>هاتف : <span class="phone">(+968) 2 4571951</span></h4>
                     <h4>البريد الإلكتروني :<span  class="email">bookings@autorent-me.com </span></h4>
                     <h4>الفاكس : <span class="fax">(+971) 600549993</span></h4>
                  </div>
                  <div class="clearfix"></div>
                  <div class="map" id="map_canvas2" style="height: 300px;width: 300px;">
                     <script>
                     
                     var myLatLng = {lat: 23.58589, lng: 58.4059227};

                                      var map = new google.maps.Map(document.getElementById('map_canvas2'), {
                                        zoom: 10,
                                        center: myLatLng
                                      });
                                    
                                      var marker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map,
                                      });
                     </script>
                  </div>
                     </div>
               </div>
               
               <div class="col-md-4 flag">
               <div class="col-md-12 inner-flag">
                  <div class="circle">
                     <img src="../images/UAE_Flag.png"  alt="">
                  </div>
                  <div class="clearfix"></div>
                   <div class="office-address">
                     <h4 class="city-name">دبي، الإمارات العربية المتحدة</h4>
                     <h4>هاتف : <span class="phone">(+966) 547328866</span></h4>
                     <h4>البريد الإلكتروني :<span  class="email">bookings@autorent-me.com </span></h4>
                     <h4>الفاكس : <span class="fax">(+971) 600549993</span></h4>
                  </div>
                  <div class="clearfix"></div>
                  <div class="map" id="map_canvas3" style="height: 300px;width: 300px;">
                     <script>
                     var myLatLng = {lat: 25.2048493, lng: 55.2707828};

                                      var map = new google.maps.Map(document.getElementById('map_canvas3'), {
                                        zoom: 10,
                                        center: myLatLng
                                      });
                                    
                                      var marker = new google.maps.Marker({
                                        position: myLatLng,
                                        map: map,
                                      });
                     </script>
                  </div>
                     </div>
               </div>
               
            </div>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-md-12 form-wrapper">
                  <fieldset class="form-container">
                     <legend>الحصول على اتصال</legend>
                     <form action="#" class="form contact-form" id="contact_form">
                        <div class="fromerror" style="color:red"></div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="name">اسم : <span class="glyphicon glyphicon-asterisk"></span></label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسمك...">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="subject">موضوع : <span class="glyphicon glyphicon-asterisk"></span></label>
                              <input type="text" class="form-control" id="subject" name="subject" placeholder="أدخل موضوع الرسالة...">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="email">البريد الإلكتروني : <span class="glyphicon glyphicon-asterisk"></span></label>
                              <input type="email" class="form-control" id="contact_email" name="email" placeholder="أدخل بريدك الإلكتروني...">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="confirm-email">تأكيد البريد الإلكتروني : <span class="glyphicon glyphicon-asterisk"></span></label>
                              <input type="email" class="form-control" id="cemail" name="cemail" placeholder="ادخل بريدك الإلكتروني مرة أخرى...">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="phone">هاتف : <span class="glyphicon glyphicon-asterisk"></span></label>
                              <input type="phone" class="form-control" id="cell" name="cell" placeholder="ادخل رقم الاتصال...">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="address">العنوان : </label>
                              <input type="email" class="form-control" id="address" name="address" placeholder="أدخل عنوانك البريدي...">
                           </div>
                        </div>
                        <div class="col-md-12 ">
                           <div class="form-group">
                              <label for="email">رسالة : <span class="glyphicon glyphicon-asterisk"></span></label>
                              <textarea class="cover-letter" rows="4" cols="50" name="msg" id="msg" placeholder="اكتب تغطية الرسالة الخاصة بك هنا..."></textarea>
                           </div>
                        </div>
                        <div class="col-md-12 ">
                           <div class="form-group">
                              <button type="button" id="enquiries" value="Submit" class="form-submit">عرض</button>
                              <button type="reset" value="Reset" class="form-reset">إعادة تعيين</button>
                           </div>
                        </div>
                     </form>
                  </fieldset>
               </div>
            </div>
         </div>
      </section>
      <!--
         Footer Area
         ========================================================================== -->
      <?php echo $footer; ?>
      <script>
         $(document).ready(function() {
                      $('#loginCMS').click(function()
         {
         
          var user_email = $('#email').val();
          var user_password = $('#password').val();
          var user_type = $('#usertype').val();
          var remember = "no";
          var isChecked = $('#remember:checked').val()?true:false;
         
          if(isChecked)
          {
            remember = "yes";
          }
         
          if(user_email =="" || user_password == "" || user_type == "")
          {
            $('.errorLogin').html("Please enter all required fields.");
          }
          else
          {
            if(user_type=='1')
            {
              $.ajax({
              url: '../include/user_login.php',
              type: 'POST',
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
                $('.errorLogin').html("User not found");
                }
                else if(data == "2")
                {
                $('.errorLogin').html("Password not match.");
                }
                else if(data="yes")
                {
                	window.location.href = "contact-us.php";
                }
              }
              });
            }
            else if(user_type=='2')
            {
              $.ajax({
              url: '../partner/include/partner_login.php',
              type: 'POST',
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
                $('.errorLogin').html("Partner not found");
                }
                else if(data == "2")
                {
                $('.errorLogin').html("Password not match.");
                }
                else if(data="yes")
                {
                window.location.href = "../partner/partnerpanel.php";
                }
              }
              });
            }
          }
         
         return false;
         });
         
         
          $('#forget_pass').click(function()
         {
          var for_email = $('#for_email').val();
          var for_usertype = $('#for_usertype').val();
         
          if(for_email =="" || for_usertype == "")
          {
            $('.for_error').html("Please enter all required fields.");
          }
          else
          {
         
              $.ajax({
              url: '../include/forgot_password.php',
              type: 'POST',
              data:
              {
                email: for_email,
                type: for_usertype,
              },
              success: function(response)
              {
                if (response=="0") 
                {
                    $('.for_error').html("Invalid Email.Please Enter A Valid Email");
                }
                else
                {
                    $('#for_email').val('');
                    $('#for_usertype').val('');
                    $('.for_error').html("Password Reset Mail Has Been Sent To You.Please Check Your Mail.");
                }
              }
              });
         
          }
         
         return false;
         });
         
         
         
         $('#enquiries').click(function()
         {
          var name = $('#name').val();
          var subject = $('#subject').val();
          var email = $('#contact_email').val();
          var cemail = $('#cemail').val();
          var cell = $('#cell').val();
          var address = $('#address').val();
          var msg = $('#msg').val();

          if(name =="" || subject == "" || email == "" || cemail == "" || cell == "" || address == "" || msg == "")
          {
            $('.fromerror').html("Please enter all fields.");
          }
          else
          {
         
              $.ajax({
              url: '../include/contact_enquiries.php',
              type: 'POST',
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
                    $('.fromerror').html("Email and Confirm Email Not Matched");
                }
                else if (response=="2") 
                {
                    $('.fromerror').html("Only Letters Are Allowed For Name.");
                }
                else if (response=="3") 
                {
                    $('.fromerror').html("Only Letters and Numbers Are Allowed For Subject.");
                }
                else if (response=="4") 
                {
                    $('.fromerror').html("Invalid Email");
                }
                else if (response=="5") 
                {
                    $('.fromerror').html("Invalid Confirm Email.");
                }
                else if (response=="6") 
                {
                    $('.fromerror').html("Only Numbers Are Allowed For Telephone.");
                }                
                else if (response=="8") 
                {
                    $('.fromerror').html("Some Error Occure Please Try Again.");
                    $('#contact_form')[0].reset();
                }
                else
                {
                    $('.fromerror').html("Your Enquiry is Succefully Added");
                    $('#contact_form')[0].reset();
                }
                
              }
              });
         
          }
         
         });
         
         });
      </script>
   </body>
</html>