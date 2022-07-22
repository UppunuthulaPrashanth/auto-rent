
<div class="loader"></div>




<div class="top-header-bar">
      <nav class="navbar" role="navigation"  style="background-color:#0C4DA2; float:right">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
         </div>
         <div class="row collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav np  headerbluebar">
                     <?php
                           $result = $db->query( "SELECT * FROM socials WHERE active = 1 ORDER BY so ASC" );
                           while ( $row = mysqli_fetch_assoc( $result ) )
                           {
                              ?>
                        <li >
                           <a class="<?php echo $row['class']; ?> header-call-now" href="<?php echo $row['linkTo'];?>" target="_blank" style="background-color:transparent"></a>
                        </li>
                        <?php } ?>
                              
                  <li><a href="tel:80054999" class="text-upcase header-call-now call-phone"><i class="fa fa-phone"></i> &nbsp;800 54 999</a></li>
            </ul>
         </div>
      </nav>
</div>
 



<!-- <header style="height:36px; background-color:#0C4DA2; text-color:white !important">

<div class="container">
<div>
			<ul class="nav navbar-nav navbar-left">
            <li><a href=""></a></li>
			</ul>
		</div>

		<div>
			<ul class="nav navbar-nav navbar-right">
                  <?php
                     $result = $db->query( "SELECT * FROM socials WHERE active = 1 ORDER BY so ASC" );
                     while ( $row = mysqli_fetch_assoc( $result ) )
                     {
                         ?>
                  <li >
                     <a class="<?php echo $row['class']; ?> header-call-now" href="<?php echo $row['linkTo'];?>" target="_blank" style="background-color:transparent"></a>
                  </li>
                  <?php } ?>

            <li><a href="tel:80054999" class="text-upcase header-call-now"><i class="fa fa-phone"></i> &nbsp;800 54 999</a></li>
			</ul>
		</div>
      </div>
</header> -->


<?php //if ( $PAGEID == "homepage" ) { ?>
<!---->
<!--<nav class="navbar navbar-default navbar-theme navbar-theme-abs navbar-theme-border" id="main-nav">-->
<!--	--><?php //} else { ?>
<!--	<nav class="navbar navbar-default navbar-theme" id="main-nav">-->
<!--		--><?php //} ?>
<header class="margin-bottom-xs margin-bottom-sm margin-bottom-md margin-bottom-lg margin-bottom-xl">
   <nav class="navbar navbar-default navbar-theme" id="main-nav">
      <div class="container">
         <div class="navbar-inner nav">
            <div class="navbar-header">
               <button class="navbar-toggle collapsed" data-target="#navbar-main" data-toggle="collapse" type="button" area-expanded="false">
               <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="/"> <img src="uploads/pages/Autorent-Logo.png" alt="Autorent" title="Autorent"/> </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">
               <ul class="nav navbar-nav navbar-right social-nav-div">
                  <li class="dropdown" style="display:none">
                     <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="_desk-h">Language</span> &nbsp;&nbsp;English </a>
                     <div class="dropdown-menu dropdown-menu-sm">
                        <div class="row" data-gutter="10">
                           <div class="col-md-12">
                              <ul class="dropdown-meganav-select-list-lang" >
                                 <li class="active">
                                    <a href="#">English </a>
                                 </li>
                                 <li>
                                    <a href="#"> Arabic </a>
                                 </li>
                                 <li>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="dropdown" style="display:none;">
                     <a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="_desk-h">Region</span> <img class="navbar-flag" src="img/flag_codes/uae.png" alt="UAE" title="Image Title"/>&nbsp;&nbsp;UAE </a>
                     <div class="dropdown-menu dropdown-menu-sm">
                        <div class="row" data-gutter="10">
                           <div class="col-md-12">
                              <ul class="dropdown-meganav-select-list-lang">
                                 <li class="active">
                                    <a href="#"> <img src="img/flag_codes/uae.png" alt="UAE" title="UAE"/>UAE </a>
                                 </li>
                                 <li>
                                    <a href="#"> <img src="img/flag_codes/ksa.png" alt="KSA" title="KSA"/>KSA </a>
                                 </li>
                                 <li>
                                    <a href="#"> <img src="img/flag_codes/oman.png" alt="KSA" title="KSA"/>OMAN </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </li>
                  <!-- <?php
                     $result = $db->query( "SELECT * FROM socials WHERE active = 1 ORDER BY so ASC" );
                     while ( $row = mysqli_fetch_assoc( $result ) )
                     {
                         ?>
                  <li >
                     <a class="<?php echo $row['class']; ?>" href="<?php echo $row['linkTo'];?>" target="_blank" style="background-color:transparent"></a>
                  </li>
                  <?php } ?> -->
                  <?php
                     if ( isLoggedIn() )
                     {
                     	?>
                  <li class="navbar-nav-item-user dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle-o navbar-nav-item-user-icon" style="background-color:transparent"></i><?php echo $_SESSION[FIRSTNAME] . ' ' . $_SESSION[LASTNAME] ?></a>
                     <ul class="dropdown-menu">
                        <li>
                           <a href="/profile">Profile</a>
                        </li>
                        <li>
                           <a href="/bookings">Bookings</a>
                        </li>
                        <li>
                           <a href="/settings">Settings</a>
                        </li>
                        <li>
                           <a href="/logout"> Logout </a>
                        </li>
                     </ul>
                  </li>
                  <?php
                     } else
                     {
                     	?>
                  <li class="navbar-nav-item-user dropdown">
                     <?php
                        if ( isset($_SESSION[LOGGED_IN]) &&  $_SESSION[LOGGED_IN] == true)
                        {
                        	?>
                     <a href="profile" class="">
                     <i class="fa fa-user-circle-o navbar-nav-item-user-icon"></i>Hi,<?php echo $_SESSION[FIRSTNAME] . ' ' . $_SESSION[LASTNAME] ?>
                     </a>
                  </li>
                  <li class="navbar-nav-item-user dropdown" id="logingModule">
                     <a class="" href="/logout" style="background-color:transparent"> <i class="fa fa-sign-out navbar-nav-item-user-icon"></i>Logout </a>
                     <?php
                        } else
                        {
                        	?>
                     <a class="" href="/login" style="background-color:transparent; color:#000"> <i class="glyphicon glyphicon-log-in navbar-nav-item-user-icon"></i>Login </a>
                     <?php
                        }
                        ?>
                  </li>
                  <?php
                     }
                     ?>
                  <!-- <li>
                     <a href="tel:80054999" class="btn btn-primary-invert btn-shadow text-upcase header-call-now"><i class="fa fa-phone"></i> &nbsp;800 54 999</a>
                  </li> -->
               </ul>
               <ul class="nav navbar-nav header-menu">
                  <!--						<li>-->
                  <!--							<a href="home">Home</a>-->
                  <!---->
                  <!--						</li>-->
                  <li class="dropdown ">
                     <a class="dropdown-toggle bg-red" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="<?php if($_SERVER['REQUEST_URI']=='/rent-cars' || $_SERVER['REQUEST_URI']=='/corporate-leasing' || $_SERVER['REQUEST_URI']=='/' ){echo 'active';}?>">Rental</span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-sm">
                        <div class="col-md-12 single-menu">
                           <ul class="dropdown-meganav-list-items">
                              <li>
                                 <a href="rent-cars"><span class="<?php if($_SERVER['REQUEST_URI']=='/rent-cars'){echo 'active';} ?>" >Individual</span> </a>
                              </li>
                              <li>
                                 <a href="corporate-leasing"><span class="<?php if($_SERVER['REQUEST_URI']=='/corporate-leasing'){echo 'active';} ?>">Corporate</span> </a>
                              </li>
                              <!-- 	<li>
                                 <a href="pay-you-drive"> Pay As You Drive </a>
                                 </li> -->
                              <!--										<li>-->
                              <!--											<a href="promotions"> Offers </a>-->
                              <!--										</li>-->
                           </ul>
                        </div>
                     </div>
                  </li>
                  <!-- <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                        <span class="<?php //if($_SERVER['REQUEST_URI']=='/lease-cars'){echo 'active';} ?>">Leasing</span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-sm">
                        <div class="col-md-12 single-menu">
                           <ul class="dropdown-meganav-list-items">
                              <li>
                                 <a href="corporate-leasing"> <span class="<?php //if($_SERVER['REQUEST_URI']=='/corporate-leasing'){echo 'active';} ?>"> Leasing</span> </a>
                              </li>
                           						<li>
                                                 <a href="corporate-customized-solutions"> Custom Solutions </a>
                              					</li>
                           </ul>
                        </div>
                     </div>
                  </li> -->

                  <li>
                     <a href="lease-cars"><span class="<?php if($_SERVER['REQUEST_URI']=='/lease-cars'){echo 'active';} ?>" > Leasing </span></a>
                  </li>
                  <!--						<li>-->
                  <!--							<a href="/about">About</a>-->
                  <!---->
                  <!--						</li>-->
                  <!--						<li class="dropdown">-->
                  <!--							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Contact-->
                  <!---->
                  <!--							</a>-->
                  <!--							<div class="dropdown-menu dropdown-menu-sm">-->
                  <!---->
                  <!---->
                  <!--								<div class="col-md-12 single-menu">-->
                  <!--									<ul class="dropdown-meganav-list-items">-->
                  <!---->
                  <!--										<li>-->
                  <!--											<a href="locations"> Locations </a>-->
                  <!--										</li>-->
                  <!--										<li>-->
                  <!--											<a href="contact"> Call Us </a>-->
                  <!--										</li>-->
                  <!--										<li>-->
                  <!--											<a href="road-side-assistance"> Report A Breakdown </a>-->
                  <!--										</li>-->
                  <!--										<li>-->
                  <!--											<a href="feedbacks"> Feedbacks </a>-->
                  <!--										</li>-->
                  <!--										-->
                  <!---->
                  <!---->
                  <!--									</ul>-->
                  <!--								</div>-->
                  <!---->
                  <!---->
                  <!--							</div>-->
                  <!--						</li>-->
                  <li>
         				<a href="/about"><span class="<?php if($_SERVER['REQUEST_URI']=='/about'){echo 'active';} ?>" >About us</span></a>
         			</li>
                  <li>
                     <a href="promotions"><span class="<?php if($_SERVER['REQUEST_URI']=='/promotions'){echo 'active';} ?>" > Offers </span></a>
                  </li>
                  
                  <li>
                     <a href="blog"><span class="<?php if($_SERVER['REQUEST_URI']=='/blog'){echo 'active';} ?>" > Blog</span> </a>
                  </li>
                  <li class="dropdown">
                     <a id="contact-header" href="/contact" class="dropdown-toggle"><span class="<?php if($_SERVER['REQUEST_URI']=='/contact' || $_SERVER['REQUEST_URI'=='/road-side-assistance']){echo 'active';} ?>" > Contact</span></a>
                     <div class="dropdown-menu dropdown-menu-sm">
                        <div class="col-md-12 single-menu">
                           <ul class="dropdown-meganav-list-items">
                              <li>
                                 <a href="road-side-assistance"> <span class="<?php if($_SERVER['REQUEST_URI']=='/road-side-assistance'){echo 'active';} ?>" >Road Side Assistance</span> </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </li>
                  <li>
                     <a href="feedbacks"><span class="<?php if($_SERVER['REQUEST_URI']=='/feedbacks'){echo 'active';} ?>" >Feedback</span></a>
                  </li>

                 
                  <!--                        <li>-->
                  <!--                            <a href="road-side-assistance">Road Side Assistance</a>-->
                  <!--                        </li>-->
                  <!---->
                  <!--                        <li>-->
                  <!--                            <a href="contact">Contact</a>-->
                  <!--                        </li>-->
               </ul>
            </div>
         </div>
      </div>
   </nav>
</header>