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
        <div class="content-wrap page-profile">
          
          <div class="subsite-banner">
            <img src="img/subsite-banner-5.jpg">
          </div>
          <div class="subsite subsite-with-banner">
            
            
            <div class="row-avatar">
              <div class="avatar-img">
                <img src="img/profile4.jpg">
              </div>
            </div>
            <div class="row-info-profile">
              <div class="proname">Lilia Doe</div>
              <div class="proname-info">Photographer. Youtuber. Traveler.</div>
              
              
            </div>
            
            <form class="form-group">
              
              <div class="row field-row">
                <div class="col no-padding-right">
                  <label>First name</label>
                  <div class="field-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control with-icon" value="Lillia">
                  </div>
                </div>
                <div class="col">
                  <label>Last name</label>
                  <div class="field-group">
                    <input type="text" class="form-control" value="Doe">
                  </div>
                </div>
              </div>
              <div class="row field-row">
                <div class="col">
                  <label>Phone</label>
                  <div class="field-group">
                    <i class="fas fa-phone-square"></i>
                    <input type="text" class="form-control with-icon" value="+628570857857">
                  </div>
                </div>
              </div>
              <div class="row field-row">
                <div class="col">
                  <label>Email</label>
                  <div class="field-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" class="form-control with-icon" value="lilliadoe@domain.com">
                  </div>
                </div>
              </div>
              <div class="row field-row">
                <div class="col ">
                  <label>Address </label>
                  <div class="field-group">
                    <i class="fas fa-home"></i>
                    <input type="text" class="form-control with-icon" value="988 Monjali st, Yogyakarta">
                  </div>
                </div>
              </div>
              <div class="row field-row">
                <div class="col">
                  <label>Change photo</label>
                  <div class="field-group">
                    <i class="fas fa-camera"></i>
                    <input type="file" class="form-control with-icon" id="inputGroupFile02">
                  </div>
                </div>
              </div>
              <div class="row field-row setting-submit">
                <div class="col">
                  <div class="button">
                    <button type="submit" class="theme-button">&nbsp;Save&nbsp;</button>
                    <button class="theme-button">Cancel</button>
                  </div>
                </div>
              </div>
            </form>
            
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