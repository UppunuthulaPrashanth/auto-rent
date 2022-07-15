<!doctype html>
<html lang="en">
	 <?php include 'inc_metadata.php'; ?>
	<body class="default">
		
		<!-- Preloading -->
		 <?php include 'inc_preloader.php'; ?>
		<!-- .Preloading -->
		<!-- Sidebar left -->
			 <?php include 'inc_menu_leftsidebar.php'; ?>
			<!-- .Sidebar left -->
			<!-- Sidebar right -->
			 <?php include 'inc_rightsidebar.php'; ?>
			<!-- .Sidebar right-->
			<!-- Header  -->
			<?php include 'inc_topbar.php'; ?>
			<!-- .Header  -->
			<!-- Content  -->
			<div id="content">
        <div class="content-wrap page-login">
          <div class="subsite-banner">
            <img src="img/subsite-banner-6.jpg">
          </div>
          <div class="subsite subsite-with-banner">
            <div class="row">
              <div class="col-md-12">
                <div class="subsite-heading">
                  Login Account
                </div>
              </div>
            </div>
            <form class="form-group">
              
              <div class="row field-row">
                <div class="col">
                  <label>Username</label>
                  <div class="field-group">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" class="form-control with-icon"   >
                  </div>
                </div>
              </div>
              
              
              <div class="row field-row">
                <div class="col">
                  <label>Password</label>
                  <div class="field-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control with-icon" >
                  </div>
                </div>
              </div>
              
              <div class="row field-row login-submit">
                <div class="col">
                  <div class="button">
                    <button type="button" class="theme-button" onclick="window.location='home.php'">Login</button>
                  </div>
                </div>
              </div>
                
              <div class="row field-row text-with-link">
                <div class="col">
                  <div class="field-group">
                    <a href="#"> Forgot password </a>
                  </div>
                </div>
              </div>
              
            </form>
            <div class="row">
              <div class="col-md-12">
                <div class="connect-with">
                  <div class="text-head">
                    Or connect with:
                  </div>
                  <ul>
                    <li><a class="connect-facebook" href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li><li><a class="connect-google" href="#"><i class="fab fa-google"></i> Google</a></li><li><a class="connect-twitter" href="#"><i class="fab fa-twitter"></i> twitter</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row field-row text-with-link">
              <div class="col">
                <div class="field-group">
                  Don't have an Account ? <a href="#">Sign Up</a>
                </div>
              </div>
            </div>
            
          </div> 
        </div>
      </div>
			<!-- .Content  -->
			<!-- Botom Panel  -->
				<?php include 'inc_bottompanel.php'; ?>
			<!-- .Bottom Panel  -->
			
			
			<div class="overlay"></div>
			
			<!-- Optional JavaScript -->
			<!-- jQuery v3.4.1 -->
			<?php include 'inc_footerscript.php'; ?>
			
		</body>
	</html>