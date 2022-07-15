<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();

if (isset($_GET['check']) && isset($_GET['token']) && isset($_GET['type'])) {
  $id = $_GET['check'];
  $token = $_GET['token'];
  $type = $_GET['type'];

  $tok = tokendb::getINstance();
  $check = $tok->checktoken($id, $token,$type);
}


 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>Reset Password</title>
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
<body>
    <!-- 
                                        Header Area
    ========================================================================== -->
    <section class="header-search">
        <?php echo $mainnav; ?>
               <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <section id="login">
        <div class="container">
        <?php 
              if ($check) {?>
                    <div class="tagline">
                <h1 class="">Password Reset</h1>
                
                <p class="">Now you can reset your password.We highly recommend that you create unique passwords.</p>
            </div>
            <div class="form-wrapper">

            <form class="loginform" action="include/reset_password.php" method="post">
                  <p class="reset_error"></p>
                    <input type="hidden" name="id" id="check" value="<?php echo $id;?>">
                  <input type="hidden" name="token" id="token" value="<?php echo $token;?>">
                  <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
                    <div class="form-group">
                        <label style="margin-bottom: 5px;" for="password">New Password:</label>
                        <input type="password" class="form-control" name="password" id="newpassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label style="margin-bottom: 5px;" for="conpassword">Confirm Password:</label>
                        <input type="password" class="form-control" name="conpassword" id="conpassword" placeholder="Confirm Password">
                    </div>
                  
                  
                    <div class="form-group">
                        <div class="col-md-6 nopad-l">
                           <input  type="button" id="reset" class="btn-block btn-login" value="Reset"> 
                        </div>
                       
                        <div class="clearfix"></div>
                        
                    </div>

                </form>
            </div>
              <?php

              }
              else
              {?>
                   <div class="tagline">
                    
                    <p class="">Invalid Token Number Or The Token Is Expired.Please Try Again.</p>
                </div>
            <?php 
              }
        ?>
            
        </div>
    </section>



    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>

    <script type="text/javascript">

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
                //setTimeout(function() { window.location.href = "index.php"; }, 1000 );
                window.location.href = "index.php";
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
                //setTimeout(function() { window.location.href = "index.php"; }, 1000 );
                window.location.href = "partner/partnerpanel.php";
                }
              }
              });
            }
          }

        return false;
        });

            $('#reset').click(function()
        {    
          var id = $('#check').val();
          var token = $('#token').val();
          var type = $('#type').val();
          var password = $('#password').val();
          var conpassword = $('#conpassword').val();

          if(password =="" || conpassword == "")
          {
            $('.reset_error').html("Please enter all required fields.");
          }
          else
          {
              $.ajax({
              url: '../include/reset_password.php',
              type: 'POST',
              data:
              {
                id: id,
                token: token,
                type: type,
                password: password,
                conpassword: conpassword,
              },
              success: function(data)
              {
                alert(data);
                console.log(data);
                if(data == "1")
                {
                    $('.reset_error').html("Password And Confirm Password Not Matched");
                }
                else if(data == "2")
                {
                    $('.reset_error').html("Your Password is Succefully Reset.");
                    setTimeout(function () {
                                   window.location.href = "<?php echo URL ?>index.php"; //will redirect to your blog page (an ex: blog.html)
                                   }, 5000);
                    window.location.href = "index.php";
                }
              }
              });
          
          }

        return false;
        });
    </script>
</body>
</html>
