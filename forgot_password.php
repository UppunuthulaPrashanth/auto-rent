<?php
require 'lib/config/config.php';
require 'lib/config/autoload.php';
error_reporting(E_ALL);
$user = userdb::getInstance();
require 'header_client.php';
echo $head;?>
<title><?php echo $pagetitle['FP'];?> </title>
<?php
echo $headbelow;
?>

     <?php echo $headbelow;?>
    <!-- css and other file link ... -->

</head>
<body>
<?php echo $login;?>
<?php echo $signup;?>
   <section class="navsection">

        <!-- ....top nav  ..... -->
        <?php echo $navbar;?>
                <!-- ....top nav  end  ..... -->

    </section>
<!-- ...................section 1............. -->
<section class="pg4-sec1">
  <div class="row">
    <div class="large-12 columns">
    <div class="large-12 columns"> <h2>Get Started ! it's free.</h2></div>
    </div>
  </div>
</section>
    <!-- ...................section 2............. -->


<section class="pg4-sec2">

</section>
    <section class=" pg4-sec3">
    <div class="row">
      <div class="large-12 columns formbox">
      <?php
if (isset($_GET['error']) && $_GET['error'] == 1) {
	echo '<h3>Some Error Occure While Resetting Password.Please Try Again.</h3>';
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
	echo '<h3>Password Reset Mail Has Been Sent To You.Please Check Your Mail.</h3>';
}
if (isset($_GET['success']) && $_GET['success'] == 2) {
	echo '<h3>Password is Changed.</h3>';
	header('Refresh: 5;url=index.php');

}
?>
        <form action="include/forgot_password.php" method="post">

         <div class="persanal billing">
          <div class="large-12 columns"><h3>Forget Password</h3></div>
          <div class="large-6 columns"><label for="biladres1">Email </label><input type="text" name="email" id="biladres1" required> </div>
            </div>
            <div class="large-12 columns">
              <input type="submit" class="button regbtn" value="Process">
            </div>
        </form>
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