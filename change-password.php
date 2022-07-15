<?php
require 'lib/config/config.php';
require 'lib/config/autoload.php';
error_reporting(E_ALL);
$user = userdb::getInstance();
if ($user->checkLogin() == false) {
	header('Location: index.php');exit;
}
$id = $user->getUseerIDfromSession();
$profile = $user->fetch_profile($id);
require 'header_client.php';
echo $head;?>
<title><?php echo $pagetitle['CP'];?> </title>
<?php
echo $headbelow;
?>

     <?php echo $headbelow;?>
    <!-- css and other file link ... -->
</head>
<body>
<?php echo $login;?>
<?php echo $signup;?>
    <!-- header area ... -->
     <section class="navsection">

        <!-- ....top nav  ..... -->
        <?php echo $navbar;?>
                <!-- ....top nav  end  ..... -->

    </section>


    <!-- ...................section 1............. -->
    <section class=" pg2-sec1 dashboard">
        <div class="row">
         <!-- ..........left side............. -->
   <div class="large-3 columns browser-left user-left ">

          <?php echo $dashnavbar;?>









        </div>

        <div class="large-9 columns user-right edit-right">
        <!-- ..........right side............. -->


              <!-- .......box 1.............. -->
            <div class="large-12 columns">
            <div class="large-12 columns">
               <h3>Change Password</h3>
            </div>
             <div class="clearfix"></div>
            <div class=" columns large-12 editform">

                            <?php
if (isset($_GET['result']) && $_GET['result'] == 1) {
	echo '<h5>Password is Succefully Changed.</h3>';
} else if (isset($_GET['result']) && $_GET['result'] == 2) {
	echo '<h5>Invalid Old Password</h3>';
} else if (isset($_GET['result']) && $_GET['result'] == 3) {
	echo '<h5>Password and Confirm Password not Matched</h3>';
}
?>
                 <form method="post" action="include/ChangePassword.php" id="editform">
                   <div class="large-6 columns">
                   <label for="email">Email</label>
                   <input type="email" id="email" name="email" value="<?php echo $profile['email'];?>" disabled>
                 </div>
                 <div class="large-6 columns">
                   <label for="oldpass">Old Password</label>
                   <input type="password" id="oldpass" name="oldpass" required>
                 </div>
                   <div class="large-6 columns">
                   <label for="newpass">New Password</label>
                   <input type="password" id="newpass" name="npass" required>
                 </div>
                   <div class="large-6 columns">
                   <label for="confrmpass">Confirm Password</label>
                   <input type="password" id="confrmpass" name="conpass" required>
                 </div>


                   <div class="large-12 columns">

                   <input type="submit" id="change" name="change" value="Change" class="button ">
                 </div>
                 </form>


            </div>
            </div>







           </div>

            </div>




        </div>
    </section>


 <!-- .............section 6............ -->
            <?php echo $footer;?>
      <?php echo $script;?>

 <script type="text/javascript">
      $(document).ready(function()
      {
        $('#popup').hide();

        $( "#login" ).click(function()
        {
        $('#popup').show();
        });


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
              url: 'include/user_login.php',
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
                $('.errorLogin').html("Email or Password not match.");
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
              url: 'partner/include/partner_login.php',
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
                window.location.href = "partner/Partnerpanel.php";
                }
              }
              });
            }
          }

        return false;
        });
      });
    </script>
</body>
</html>