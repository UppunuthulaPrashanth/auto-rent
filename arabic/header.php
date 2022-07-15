<?php

include '../admin/config_data.php';
include '../admin/scripts_file.txt';
require_once '../lib/API/DB1-IPV6-COUNTRY.BIN/IP2Location.php';
error_reporting(0);
$partner = partnerdb::getInstance();

if(isset($_SESSION['selected_country']))
{
    $selected_country=$_SESSION['selected_country'];
    if($selected_country=="Oman")
    {
        $selected_country="OM";
        $contact_number='(+968) 2 4571951';
        $contact_numberClick='+968-2-4571951';
    }
    else if($selected_country=="Saudi Arabia")
    {
        $selected_country="SA";
        $contact_number='(+966) 547328866';
        $contact_numberClick='+966-547328866';
    }
    else if($selected_country=="UAE")
    {
        $selected_country="AE";
        $contact_number='(+971) 600549993';
        $contact_numberClick='+971-600549993';
    }
}
else
{
    $loc = new IP2Location('../lib/API/DB1-IPV6-COUNTRY.BIN/IP-COUNTRY.BIN', IP2Location::FILE_IO);
    $ip = $_SERVER['REMOTE_ADDR'];
    $record = $loc->lookup($ip, IP2Location::ALL); 
    
    if($record->countryCode=="SA")
    {
        $geo_country="Saudi Arabia";
        $selected_country="SA";
        $contact_number='(+966) 547328866';
        $contact_numberClick='+966-547328866';
    }
    elseif($record->countryCode=="OM")
    {
        $geo_country="Oman";
        $selected_country="OM";
        $contact_number='(+968) 2 4571951';
        $contact_numberClick='+968-2-4571951';
    }
    else
    {
        $geo_country="UAE";
        $selected_country="AE";
        $contact_number='(+971) 600549993';
        $contact_numberClick='+971-600549993';
    }
    
    $_SESSION['selected_country']=$geo_country;
}

if(isset($_SESSION['lang']) && $_SESSION['lang']=="en")
{
    header('Location:../index.php');
}
 

$head = '<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- No index tag for dummy website -->

    <meta name="robots" content="index, follow">

    <!-- ==================== Styles ==================== -->

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- jquery.bxslider -->

  <link rel="stylesheet" href="assets/css/jquery.bxslider.css">

  <!-- /jquery.bxslider -->

  <!-- font-awesome -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

 
 <!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">-->


  <!-- /font-awesome -->
  <link rel="stylesheet" href="assets/css/bootstrap-formhelpers.min.css">
  <link rel="stylesheet" href="assets/css/header.css">

  <link rel="stylesheet" href="assets/css/index.css">



  <link rel="stylesheet" href="assets/css/footer.css">

  <link rel="stylesheet" href="assets/css/responsive.css">

  <!-- jquery-ui.min.css mendatory for calender(datetimepicker) plugin -->

  <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
  <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css" />

  <!-- /jquery-ui.min.css -->

  <!-- icheck -->

  <link rel="stylesheet" href="assets/css/skins/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-social.css">

  <!-- /icheck -->

  <!-- calender -->

  <link rel="stylesheet" href="assets/css/datetimepicker/jquery.datetimepicker.css">

  <!-- /calender -->




    
            
  

  <!-- RangeSlider --> 

  <link rel="stylesheet" href="assets/css/rangeslider/ion.rangeSlider.css">

  <link rel="stylesheet" href="assets/css/rangeslider/ion.rangeSlider.skinFlat.css">

  <link id="animation1" rel="stylesheet" href="assets/css/animate.css">
<link id="animation1" rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

  <!-- /RangeSlider -->';

$mainnav = '  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 smallnav-main nopad-lr">

    <nav class="smallnav">

      <div class="container">

       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center nopad-lr">
           
         <ul class="pull-left">
            <li class="main-nav-option22 mobile-number-new" ><a class="phone-num" href="tel:'.$contact_numberClick.'"><i class="fa fa-phone"></i>'.$contact_number.'</a></li>
           <!--<li><input class="topsearch" type="text" placeholder="البحث في"></li>-->
           ';
              
              

           if ($user->checkLogin() == true) {
        $row = $user->fetch_profile($_SESSION['uid']);
        $mainnav .='
            <li class="main-nav-option"><a href="user-dashboard.php" style="font-weight: bold;padding-left: 20px;color: #CE1432;"> <i class="fa fa-user" style="color: #CE1432;"></i>حسابي بحث</a></li>
        <li class="main-nav-option"><a href="blog.php" style="    padding-left: 20px;">مقالات</a></li>
          <li class="main-nav-option"><a href="careers.php" >وظائف</a></li> 
          <li class="main-nav-option"><a href="contact-us.php">اتصل بنا</a></li>';
      }
      elseif ($partner->checkLogin() == true) {
               $mainnav .='<li class="main-nav-option"><a href="../partner/partnerpanel.php" style="font-weight: bold;padding-left: 20px;color: #CE1432;"> <i class="fa fa-user" style="color: #CE1432;"></i>حسابي بحث</a></li>
        <li class="main-nav-option"><a href="blog.php" style="    padding-left: 20px;">مقالات</a></li>
          <li class="main-nav-option"><a href="careers.php" >وظائف</a></li>
          <li class="main-nav-option"><a href="contact-us.php">اتصل بنا</a></li>';
           }
      else
      {
        $mainnav .='             
			 <li class="main-nav-option">
             <a href="#" id="signup_button" data-toggle="modal" data-target="#basicModal" style="color: #CE1634;font-weight: bold; padding-left: 0;" > إشترك /</a>
             <a href="#" data-toggle="modal" id="login_button" data-target="#basicModal" style="color: #CE1634;font-weight: bold; padding-right: 0;">تسجيل الدخول</a>
             </li>
			  
               
        <li class="main-nav-option"><a href="blog.php" style="    padding-left: 20px;">بلوق</a></li>
        <!--<li><a href="car-deal.php">الصفقات</a></li>-->
          <li class="main-nav-option"><a href="careers.php" >مهن</a></li> 
          <li class="main-nav-option"><a href="contact-us.php">الاتصال بنا</a></li>
         
            ';
      } 
 

           

         $mainnav .='
         
         
         
            <li class="m-selectbox">
           
           <div class="bfh-selectbox countryselect2  bfh-countries" style="" data-country="'.$selected_country.'" data-available="OM,AE,SA" data-flags="true">
           </div>
              </li>
              
           <li class="m-selectbox">
           
           <div class="bfh-selectbox countryselect bfh-languages" style="" data-language="ar" data-available="en,ar" data-flags="false">
           </div>
              </li>
              
               <li class="main-nav-option22 mobile-number-new-show" ><a class="phone-num" href="tel:'.$contact_numberClick.'"><i class="fa fa-phone"></i>'.$contact_number.'</a></li>
         </ul>

         <div class="clearfix"></div>

       </div>
 
       </div>

   </nav>





<nav class="main-nav navbar">



<div class="container">

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0">

    <!-- Brand and toggle get grouped for better mobile display -->

    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

        <span class="sr-only">Toggle navigation</span>
  
        <span class="icon-bar"></span>
 
        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

      </button> 

      <div class="logo-container">
      <a href="index.php" class="mainlogo"><img  class="wow flipInY" src="../images/logo.png"  alt="Autorent Logo"><div class="clearfix"></div></a>

        <div class="clearfix"></div>

      </div>

      <div class="clearfix"></div>

    </div>
<div class="clearfix"></div>
    <!-- Collect the nav links, forms, and other content for toggling -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <!--   <ul class="nav navbar-nav">

    </ul> -->

      <ul class="nav navbar-nav navbar-ul navbar-right">';
        
        
           $options = options::getInstance();

                                      $links = $options->get_header_linking();

                                      foreach($links as $link)

                                      {

                                            $mainnav.='<li class="mainnav-li">

                                            <a  class="mainnav-a" href="'.$link['slug'].'.php'.'">'.$link['ar_title'].'</a>

                                            </li>';

                                      }
        
       $mainnav.='<li class="mainnav-li"><a c href="promotion.php" class="mainnav-a">الترقيات</a></li>
          <li class="mainnav-li"><a c href="location.php" class="mainnav-a">الموقع</a></li>
         <li class="mainnav-li"><a c href="fleet-guide.php" class="mainnav-a">الدليل الأسطول</a></li>
          <li class="mainnav-li"><a c href="services.php" class="mainnav-a">المنتجات والخدمات</a></li>
           <li class="mainnav-li"><a class="mainnav-a" href="about-us.php">عن الاوتورنت</a></li>
          <li class="mainnav-li"><a class="mainnav-a " href="index.php">الصفحة الرئيسية</a></li>';
                     if ($user->checkLogin() == true) {
        $row = $user->fetch_profile($_SESSION['uid']);
        $mainnav .='<!--<li><a href="car-deal.php">Deals</a></li>-->
            <li class="m-nav-option"><a href="user-dashboard.php"" style="font-weight: bold;padding-left: 20px;color: #CE1432;"> <i class="fa fa-user" style="color: #CE1432;"></i>حسابي بحث</a></li>
           <!-- <li><a href="user-dashboard.php"> ' . $row["fname"] . '  ' . $row["lname"] . '</a><li>
            <form action="../include/user_logout.php">
                      <li><input type="submit" class="btn-loginout" value="الخروج" /><li>
            </form>-->';
      }
      else
      {
        $mainnav .='             
       <li class="login-sign m-nav-option">
             <a href="#" id="signup_button" data-toggle="modal" data-target="#basicModal" style="color: #CE1634;font-weight: bold; padding-right: 0;" >إشترك /</a>
             <a href="#" data-toggle="modal" id="login_button" data-target="#basicModal" style="color: #CE1634;font-weight: bold; padding-left: 0;">تسجيل الدخول</a>
             </li>
        
               
        <li class="m-nav-option"><a href="blog.php" style=" color:#000;   padding-left: 20px;">بلوق</a></li>
        <!--<li><a href="car-deal.php" style=" color:#000; ">الصفقات</a></li>-->
          <li class="m-nav-option"><a href="careers.php" style=" color:#000; " >مهن</a></li> 
          <li class="m-nav-option"><a href="contact-us.php" style=" color:#000; ">الاتصال بنا</a></li>
         
            ';
      } 

     


       $mainnav .=' </ul>

      </ul>

      <div class="clearfix"></div>

    </div><!-- /.navbar-collapse -->

    <div class="clearfix"></div>

  </div><!-- /.container-fluid -->

  
   <div class="clearfix"></div>
  </div>
   <div class="clearfix"></div>
</nav>


 </div>

 <div class="clearfix"></div>
 
 


<div class="clearfix"></div>

';


$dashnavbar = '<div class="col-md-3 nopad-l">
      

      <div class="left-side">
      <div class="head-area">
        <h3>My Account</h3>
      </div>
        

        <div class="body-area">
          <p class="garytab"><a href="user-dashboard.php">Profile</a></p>

          <p style="  background-color: rgb(234, 234, 234);" class="garytab"><a href="booking-list.php">Bookings</a></p>

          <p class="garytab"><a href="edit-profile.php">Change Details</a></p>
          <p  style="  background-color: rgb(234, 234, 234);" class="garytab"><a href="documents.php">Documents</a></p>
          
           
         <p class="garytab"><a href="../include/user_logout.php">Log out</a></p>
        </div>
      </div>
    </div>';
    
$news_sidebar='          <div class="col-md-3 blog-right" style="">
            <div class="col-md-12 blog-icon" style="padding:0">
            
               <li  class="b-heading1" style="padding-left: 15px;margin-bottom: 16px!important;">الحصول الاجتماعية</li>
                <div class="col-md-12 get-social" style="padding:0;text-align:center">
                       <a href="http://twitter.com/autorentllc" ><i class="fa fa-twitter"></i></a>
              <a href="http://www.linkedin.com/company/autorent-group"><i class="fa fa-linkedin"></i></a>
            <a href="http://www.pinterest.com/autorentllc/" > <i class="fa fa-pinterest-p"></i></a>
              <a href="https://plus.google.com/106418551017072040346" > <i class="fa fa-google-plus"></i></a>
              <a href="http://www.youtube.com/user/autorentcarrental" > <i class="fa fa fa-youtube"></i></a>
             <a href="http://www.facebook.com/autorentllc" ><i class="fa fa-facebook"></i></a>
                <a href="http://www.autorent-me.com/rss.xml" ><i class="fa fa-rss"></i></a>
                     </div>
                </div>
                 
               <div class="clearfix"></div>
                <span class="custom-hr"></span>
                 
                <div class="col-md-12 blog-searchbox" style="padding-top:10px!important">
                    <input type="text" placeholder="بحث...">
                </div>

                  <div class="col-md-12 blog-btn" style="padding:0">
                    <a class="btn btn-3 btn-3a icon-cart" href ="index.php">إجراء الحجز</a>
                       <a class="btn btn-3  btn-33 btn-3a icon-cart" href = "services.php">عرض خدماتنا</a>
                </div>

 
                    <div class="col-md-12 blog-links" style="padding:0">
                         <li style="" class="b-heading1">منشورات شائعة</li>';
                            $options = options::getInstance();
                            $news=$options->get_latest_news();
                            foreach($news as $new) 
                            {
                            $path=$new['slug'].'.php';
                            $news_sidebar.='<li><a href="'. $path .'">'.$new["ar_title"] .'</a></li>';
                            }

                            $news_sidebar.='</div>
                     </div>';
         
         
         
         $blog_sidebar='          <div class="col-md-3 blog-right" style="">
            <div class="col-md-12 blog-icon" style="padding:0">
            
               <li  class="b-heading1" style="padding-left: 15px;margin-bottom: 16px!important;">Get Social</li>
                <div class="col-md-12 get-social" style="padding:0;text-align:center">
                         <a href="http://twitter.com/autorentllc" ><i class="fa fa-twitter"></i></a>
              <a href="http://www.linkedin.com/company/autorent-group"><i class="fa fa-linkedin"></i></a>
            <a href="http://www.pinterest.com/autorentllc/" > <i class="fa fa-pinterest-p"></i></a>
              <a href="https://plus.google.com/106418551017072040346" > <i class="fa fa-google-plus"></i></a>
              <a href="http://www.youtube.com/user/autorentcarrental" > <i class="fa fa fa-youtube"></i></a>
             <a href="http://www.facebook.com/autorentllc" ><i class="fa fa-facebook"></i></a>
                <a href="http://www.autorent-me.com/rss.xml" ><i class="fa fa-rss"></i></a>
                     </div>
                </div>
                 
               <div class="clearfix"></div>
                <span class="custom-hr"></span>
                 
                <div class="col-md-12 blog-searchbox" style="padding-top:10px!important">
                    <input type="text" placeholder="Search...">
                </div>

                  <div class="col-md-12 blog-btn" style="padding:0">
                    <a class="btn btn-3 btn-3a icon-cart" href ="index.php">MAKE A BOOKING</a>
                       <a class="btn btn-3  btn-33 btn-3a icon-cart" href = "services.php">VIEW OUR SERVICES</a>
                </div>

 
                    <div class="col-md-12 blog-links" style="padding:0">
                         <li style="" class="b-heading1">Categories</li>';
$term = termdb::getInstance();
$result = $term->fetchterms();
foreach ($result as $r) 
{
$blog_sidebar.='<li><a href="blog.php?Category='. $r['name'] .'">'.$r["name"] .'</a></li>';
}
    $blog_sidebar.='<li style="" class="b-heading1">Popular Post</li>';
    $latestart = articledb::getInstance();
	$results = $latestart->fetchlatestarticle();
    foreach ($results as $res) 
{
$blog_sidebar.='<li> 
<a href="view_post.php?article='. $res['id'] .'" style=" float: left;width: 21%;font-size: 15px;">
   <img width="47" height="47" src="../images/admin_images/artilces/'.$res['img_url'].'" />
</a>
<a href="view_post.php?article='. $res['id'] .'" style=" width: 79%;float:right;font-size: 15px;">'.$res["title"] .'</a>

<div class="clearfix"></div></li><div class="clearfix"></div>';
}
    $blog_sidebar.='</div>
         </div>';

$login_model='   <div class="modal signup-model signup-model1 fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
           <a class="close-reveal-modal close" aria-label="Close" data-dismiss="modal" aria-hidden="true">x</a>
           <ul class="btn-tabs" style="margin: 0;padding: 0;width: 320px;margin-left: auto!important;margin-right: auto!important; padding-top: 25px;">   
               <li><a href="#"  class="active-1 login-link1">تسجيل الدخول</a></li>
               <li><a href="#" class="signup-link1" >اشترك</a></li>
           </ul>
           <div class="clearfix"></div>
       </div>
         <div class="clearfix"></div>
       
       
       <!---------------login--------------------->
       <div class="modal-body login-mod">
         <div class="col-md-6  social" style="padding-right: 5px!important; ">
          <a href="../lib/sociallogin/fb/fbconfig.php" class="btn btn-block btn-social btn-facebook" style="padding: 7px 36px;padding-right: 3px;font-size: 10px;margin: 0px;margin-bottom: 10px;">
              <i class="fa fa-facebook"></i>
              تسجيل الدخول مع الفيسبوك
            </a>
         </div>
          
         <div class="col-md-6 social " style="    padding-left: 5px!important;">
            <a href="../lib/sociallogin/google/google_login.php" class="btn btn-block btn-social btn-google" style="padding: 7px 50px;padding-right: 3px;font-size: 10px;margin: 0px;margin-bottom: 10px;">
              <i class="fa fa-google"></i>
             تسجيل الدخول مع جوجل
            </a>
         </div>
         
         <div class="clearfix"></div>
         
        <div class="" style="position:relative"> <span class="centr-txt">او</span><hr></div>
        <p class="errorLogin"></p>
         <div class="col-md-12  input-container">
          <label for="loginmail">البريد الإلكتروني</label>
          <input type="text" class="email" name="email" id="email" placeholder="البريد الإلكتروني">
         </div>
         <div class="clearfix"></div>
         <div class="col-md-12  input-container">
          <label for="password">كلمة السر</label>
          <input type="password" class="password" name="password" id="password" placeholder="كلمة السر">
         </div>
         <div class="clearfix"></div>
         <div class="col-md-12   input-container ">
          <div class="col-md-6 nopad-lr">
           <label class="pull-left"><input type="checkbox" value="yes" id="remember"><span>تذكرنى</span></label> 
          </div>
          <div class="col-md-6 nopad-lr">
          <a href="#" class="pull-right" data-toggle="modal" data-target="#forgetpass_model">نسيت كلمة المرور</a>
          </div>
          <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
         <div class="col-md-12  input-container ">
          <div class="col-md-6" style=" float: none;margin-left: auto;margin-right: auto;">
           <input type="button" class="btn-login btn-block" id="loginCMS" value="تسجيل الدخول">
          </div>
           <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
       </div>
       
       
              <!---------------signup--------------------->
   <div class="modal-body signup-mod hide">
         <div class="col-md-6  social" style="padding-right: 5px!important; ">
          <a href="../lib/sociallogin/fb/fbconfig.php" class="btn btn-block btn-social btn-facebook" style="padding: 7px 40px;padding-right:0;font-size: 11px;margin: 0px;margin-bottom:10px">
              <i class="fa fa-facebook"></i>
              تسجيل الدخول مع الفيسبوك
            </a>
         </div>
          
         <div class="col-md-6 social " style="    padding-left: 5px!important;">
            <a href="../lib/sociallogin/google/google_login.php" class="btn btn-block btn-social btn-google" style="padding: 7px 40px;padding-right:0;font-size: 11px;margin: 0px;margin-bottom:10px">
              <i class="fa fa-google"></i>
             تسجيل الدخول مع جوجل
            </a>
         </div>
         
         <div class="clearfix"></div>
         <div class="" style="position:relative"> <span class="centr-txt">او</span><hr></div>
                  <p class="errorsignup"></p>';
         
         if(isset($_GET['ref'])&& $_GET['ref']!="")
         {
            $login_model.='<input type="hidden" id="referance" value="'.$_GET['ref'].'">';
         }
         else
         {
            $login_model.='<input type="hidden" id="referance" value="">';
         }
         
        $login_model.=' <div class="col-md-12  input-container">
          <label for="loginmail">البريد الإلكتروني</label>
         <input type="text" class="email" name="email" id="signup-email" placeholder="البريد الإلكتروني">
         </div>
         <div class="clearfix"></div>
         <div class="col-md-12  input-container">
          <label for="password">كلمة السر</label>
          <input type="password" class="password" name="password" id="signup-password" placeholder="كلمة السر">
         </div>
         <div class="clearfix"></div>
          <div class="col-md-12  input-container">
          <label for="cpassword">تأكيد كلمة السر</label>
          <input type="password" class="password" name="cpassword" id="signup-cpassword" placeholder"توكيد كلمة المرور">
         </div>

         <div class="clearfix"></div>
        
         <div class="clearfix"></div>
         <div class="col-md-12  input-container ">
          <div class="col-md-6" style=" float: none;margin-left: auto;margin-right: auto;">
           <input type="button" class="btn-login btn-block" id="signupCMS" value="اشترك">
          </div>
          <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
       </div>
<!--        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">قريب</button>
         <button type="button" class="btn btn-primary">حفظ التغيرات</button>
       </div> -->
     </div>
   </div>
 </div>';








 $forgetpass_model='<div class="modal signup-model forgetpass-model fade" id="forgetpass_model" tabindex="-1" role="dialog" aria-labelledby="forgetpass_model" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <a class="close-reveal-modal close" aria-label="Close" data-dismiss="modal" aria-hidden="true">×</a>
       
         <h4 class="modal-title" id="myModalLabel">نسيت كلمة المرور</h4>
       </div>
       <div class="modal-body">
        
        
         <div class="col-md-12  input-container">
        
          <p>يرجى إدخال البريد الإلكتروني الخاص بك في المربع أدناه ثم اضغط على "إرسال" لاسترجاع كلمة السر الخاصة بك. سيتم إرسالها إلى عنوان البريد الإلكتروني المسجل في حسابك.</p>
         </div>

        <p class="for_error" style="color:red"></p>
         <div class="col-md-12  input-container">
          <label for="loginmail">Email</label>
          <input type="text" class="email" name="for_email" id="for_email" placeholder="البريد الإلكتروني">
         </div>
         <div class="clearfix"></div>
      
    
         <div class="col-md-12  input-container ">
          <div class="col-md-6 nopad-l">
           <input type="button" class="btn-login btn-block" id="forget_pass" value="إرسال">
          </div>
          <div class="col-md-6 nopad-r">
     <a href="#" class="btn-signup btn-block"  data-toggle="modal" data-target="#basicModal">تسجيل الدخول</a>
          </div>
          <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
       </div>
<!--        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">أغلق</button>
         <button type="button" class="btn btn-primary">حفظ التغيرات</button>
       </div> -->
     </div>
   </div>
 </div>';
 
 
 

  $partner_forgetpass_model='<div class="modal signup-model forgetpass-model fade" id="partner_forgetpass_model" tabindex="-1" role="dialog" aria-labelledby="forgetpass_model" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <a class="close-reveal-modal close" aria-label="Close" data-dismiss="modal" aria-hidden="true">X</a>
       
         <h4 class="modal-title" id="myModalLabel">نسيت كلمة المرور</h4>
       </div>
       <div class="modal-body">
        
        
         <div class="col-md-12  input-container">
        
          <p style="direction:rtl;">يرجى إدخال البريد الإلكتروني الخاص بك في المربع أدناه ثم اضغط على "إرسال" لاسترجاع كلمة السر الخاصة بك. سيتم إرسالها إلى عنوان البريد الإلكتروني المسجل في حسابك.</p>
         </div>

        <p class="for_error" style="color:red"></p>
         <div class="col-md-12  input-container">
          <label for="loginmail">البريد الإلكتروني</label>
          <input type="text" class="email" name="partner_for_email" id="partner_for_email" placeholder="البريد الإلكتروني">
         </div>
         <div class="clearfix"></div>
    
         <div class="col-md-12  input-container ">
          <div class="col-md-6 nopad-l">
           <input type="button" class="btn-login btn-block" id="part_forget_pass" value="إرسال">
          </div>
          
          <div class="col-md-6 nopad-l">
           <input type="button" class="btn-login btn-block" data-dismiss="modal"" value="قريب">
          </div>

          <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
       </div>
     </div>
   </div>
 </div>';







$footer = '<section class="footer">

  <div class="signin">

    <div class="container nopad-l main-contener1" style="position:relative;">

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <p class="instruction wow bounceIn" data-wow-duration="2s">الاشتراك في النشرة الإخبارية لدينا اليوم لتلقي التحديثات.</p>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 nopad-l fadeIn wow " data-wow-duration="2s" >

            
        
<div id="sib_embed_signup">
    <div class="">
        <input type="hidden" id="sib_embed_signup_lang" value="en">
        <input type="hidden" id="sib_embed_invalid_email_message" value="That email address is not valid. Please try again">
        <div id="sib_loading_gif_area" style="position: absolute;z-index: 9999;display: none;">
          <img src="https://my.sendinblue.com/public/theme/version3/images/loader_sblue.gif">
        </div>
        <form class="description" id="theform" name="theform" action="https://my.sendinblue.com/users/subscribeembed/js_id/288mu/id/2" onsubmit="return false;">
            <input type="hidden" name="js_id" id="js_id" value="288mu"><input type="hidden" name="listid" id="listid" value="4"><input type="hidden" name="from_url" id="from_url" value="yes"><input type="hidden" name="hdn_email_txt" id="hdn_email_txt" value="">
            <div class="container rounded" style="width: auto;">
                
               <input type="hidden" name="req_hid" id="req_hid" value="">
               
                    
                    <div class="view-messages" > </div>
                            
                            
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 nopad-l">
                                <input type="text" name="NAME" id="NAME" value="" placeholder="اسم..." style="margin:0">
                            </div>										    
                            										    
                            <div class="hidden-btns">											
                            <a class="btn move" href="#"><i class="icon-move"></i></a><br>											
                            <a class="btn btn-danger delete" href="#"><i class="icon-white icon-trash"></i></a>										
                            </div>									
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 nopad-l">
                                    <input type="text" name="email" id="email" placeholder="البريد الإلكتروني..." style="margin:0" value="">
                                    </div>
                                <div class="hidden-btns">
                                    <a class="btn move" href="#"><i class="icon-move"></i></a><br>
                                    
                                </div>
                            
                         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 nopad-lr" >
                         <button class="button editable " type="submit" style="background-color: #CD3049;border: none;color: #fff;width: 100%;padding: 8px;" class="learnbtn" data-editfield="subscribe">الاشتراك</button></div>
                         <div style="clear:both;"></div>
                        </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="assets/js/subscribe-validate.js"></script>
<script type="text/javascript">
    jQuery.noConflict(true);
</script>
<!-- End : SendinBlue Signup Form HTML Code -->


        <div class="clearfix"></div>

      </div>

      <div class="clearfix"></div>

    </div>

  </div>

  <div class="clearfix"></div>

    <div class="links">

      <div class="container mobile-center">

            

            

            

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 social-sec">

                

                

                      <div class=" footer-col col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp mobile-show22" data-wow-duration="2s" style="padding-left:40px;">

                            <div class="section-header" style="    text-align: center;">
                
                              <img style="height: 52px;margin-bottom: 5px;" src="../images/logo-footer.png"  alt="">
                
                            </div>
                
                            <p>الاوتورينت هي شركة رائدة في استئجار وتاجير السيارات. مركزها الرئيسي في دبي , الامارات العربية المتحدة و تمتلك مواقع عمليات في سلطنة عمان والمملكة العربية السعودية
                
                            </p>
                
                            <ul class="list-inline" style="padding:0">
                
                                <li><a href="http://twitter.com/autorentllc" class="link"><i class="fa fa-twitter"></i></a></li>
                
                              <li><a href="http://www.linkedin.com/company/autorent-group" class="link"><i class="fa fa-linkedin"></i></a></li>
                           
                             <li><a href="http://www.pinterest.com/autorentllc/" class="link"> <i class="fa fa-pinterest-p"></i></a></li>
                              <li><a href="https://plus.google.com/106418551017072040346" class="link"> <i class="fa fa-google-plus"></i></a></li>
                               <li><a href="http://www.youtube.com/user/autorentcarrental" class="link"> <i class="fa fa fa-youtube"></i></a></li>
                              <li><a href="http://www.facebook.com/autorent.carrentals" class="link"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.autorent-me.com/rss.xml" class="link"><i class="fa fa-rss"></i></a></li>
                
                            </ul>
                
                            
                
                          </div>


          <div class="footer-col col-lg-3 col-md-3 col-sm-3 col-xs-12 services wow fadeInUp" data-wow-duration="2s" style="padding-left:40px;">

            <div class="section-header">

              <h4 class="section-title">الخدمات</h4>

            </div>

            <ul class="list-unstyled">
             <li><a href="used_cars.php" class="link">السيارات المستعملة</a></li>

              <li><a href="car_rental.php" class="link">تاجير سيارة</a></li>

               <li><a href="car-leasing-services.php" class="link">تأجير السيارات</a></li>

              <li><a href="transportation-services.php" class="link">خدمات المواصلات</a></li>

            </ul>

          </div>
          
          
          

          <div class=" footer-col col-lg-3 col-md-3 col-sm-3 col-xs-12 company wow fadeInUp" data-wow-duration="2s" style="padding-left:40px;">

            <div class="section-header">

              <h4 class="section-title">شركة</h4>

            </div>

            <ul class="list-unstyled">

              <li><a href="about-us.php" class="link">معلومات عنا</a></li>

              <li><a href="news_list.php" class="link">بيان صحفي</a></li>

              <li><a href="#" class="link">سياسة الخصوصية</a></li>

              <li><a href="press_release.php" class="link">إشعار قانوني</a></li>
             <li><a href="blog.php" class="link">بلوق</a></li>
              <li><a href="careers.php" class="link">مهنة</a></li>
             <li><a href="testimonials.php" class="link">الشهادات</a></li>

            </ul>

          </div>
          
          
          
          

          <div class="footer-col col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp" data-wow-duration="2s" style="padding-left:40px;">

            <div class="section-header">

              <h4 class="section-title">الحصول الاجتماعية</h4>

            </div>

            <ul class="list-unstyled" style="padding:0;">

              <li><a href="contact-us.php" class="link"><img src="../images/email-icon.png" style="margin-left:10px" alt="">البريد الإلكتروني</a></li>

              <li><a href="contact-us.php" class="link"><img src="../images/call-icon.png" style="margin-left:10px" alt="">هاتف</a></li>

              <li><a href="contact-us.php#" class="link"><img src="../images/add-icon.png" style="margin-left:10px" alt="">عنوان</a></li>

            </ul>

            <div class="clearfix"></div>

          </div>  
          
          
          
          <div class=" footer-col col-lg-3 col-md-3 col-sm-3 col-xs-12 wow fadeInUp mobile-hide22" data-wow-duration="2s" style="padding-left:40px;">

            <div class="section-header" style="    text-align: center;">

              <img style="height: 52px;margin-bottom: 5px;" src="../images/logo-footer.png"  alt="">

            </div>

            <p>الاوتورينت هي شركة رائدة في استئجار وتاجير السيارات. مركزها الرئيسي في دبي , الامارات العربية المتحدة و تمتلك مواقع عمليات في سلطنة عمان والمملكة العربية السعودية

            </p>

            <ul class="list-inline" style="padding:0">

                <li><a href="http://twitter.com/autorentllc" class="link"><i class="fa fa-twitter"></i></a></li>

              <li><a href="http://www.linkedin.com/company/autorent-group" class="link"><i class="fa fa-linkedin"></i></a></li>
           
             <li><a href="http://www.pinterest.com/autorentllc/" class="link"> <i class="fa fa-pinterest-p"></i></a></li>
              <li><a href="https://plus.google.com/106418551017072040346" class="link"> <i class="fa fa-google-plus"></i></a></li>
               <li><a href="http://www.youtube.com/user/autorentcarrental" class="link"> <i class="fa fa fa-youtube"></i></a></li>
              <li><a href="http://www.facebook.com/autorentllc" class="link"><i class="fa fa-facebook"></i></a></li>
                <li><a href="http://www.autorent-me.com/rss.xml" class="link"><i class="fa fa-rss"></i></a></li>

            </ul>

            

          </div>
          

        </div>

        <div class="clearfix"></div>

        <hr>
 <div class="clearfix"></div>
  
     
          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 mobile-center" style="text-align:left">

        <ul class="list-inline fadeIn wow "   data-wow-duration="2s">

          <li>© 2015 الاوتورينت جميع الحقوق محفوظة.</li>

        </ul>

        </div>

        <div style="text-align: center;" class="col-lg-4 col-md-4 col-sm-3 col-xs-12 countries fadeIn wow"  data-wow-duration="2s">

          <ul class="list-inline">

            <li><a href="#" class="">عمان</a></li>

            <li><a href="#" class="">الإمارات العربية المتحدة</a></li>

            <li><a href="#" class="">المملكة العربية السعودية</a></li>

          </ul>

        </div>
		
		
		
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 wow fadeIn wow "  data-wow-duration="2s">

          <ul class="list-inline">
            
            <li><a href="custom-page.php" class="link">تفاصيل اكثر</a></li>

            <li><a href="terms&conditions.php" class="link">شروط الاستخدام</a></li>
           
            <li><a href="partners.php" class="link">شركاء</a></li>
            <li><a href="#" class="link">آر إس إس يغذي</a></li>
              <li><a href="sitemap.php" class="link">خريطة الموقع</a></li>

          </ul>
                      <ul class="list-inline text-center">';
          
            $options = options::getInstance();

            $links = $options->get_footer_linking();

            foreach($links as $link)
            {
                $footer.='<li class="imp-link">
                            <a href="'.$link['slug'].'.php'.'">'.$link['ar_title'].'</a>
                        </li>';
            }

            $footer .= '
          </ul>
        </div>
        
        

        
       
        

        <div class="clearfix"></div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  imp-links fadeIn wow " style="text-align:center;" data-wow-duration="2s">

          

        <div class="clearfix"></div>

        </div>

      <div class="clearfix"></div>  

      </div>

    </div>

  </section>
  




<script src="assets/js/jquery.min.js"></script>

<script src="assets/js/jquery-ui.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script>


<script src="assets/js/bootstrap-formhelpers.min.js"></script>
<script src="assets/js/modernizr.js"></script>

<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="assets/js/jquery.bxslider.min.js"></script> 



<script src="assets/js/jquery.waypoints.min.js"></script>
<script src="assets/js/circles/counter.min.js"></script>
<script  src="assets/js/parallax.min.js"></script>

<script src="assets/js/rangeslider/ion.rangeSlider.min.js"></script>

<script src="assets/js/datetimepicker/jquery.datetimepicker.js"></script>

<script src="assets/js/icheck/icheck.js"></script>
<script src="assets/js/jquery.autocomplete.min.js"></script>
<!-- <script src="assets/js/countries.js"></script> -->
<script src="assets/js/typed.js"></script>

<script src="assets/js/wow.min.js"></script>



<script src="assets/js/modal/modal.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="assets/js/main.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    
        <!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?1dhAIQt76G8ECa6HumRmek1QuRy39cqC";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->



    <script>
        $(document).ready(function(){
            $("#table-data").DataTable(
           
            );
        });
    </script>

      <script type="text/javascript">
      $(document).ready(function()
      {
                $("#signup").submit(function()
        {
          return true;
        });
        	      $(document).on("click", ".reset-data", function() {  

            $(this).closest("form").find("input[type=text], textarea").val("");
            });
        
           $("#loginCMS").click(function()
        {

          var user_email = $("#email").val();
          var user_password = $("#password").val();
          var remember = "no";
          var isChecked = $("#remember:checked").val()?true:false;

          if(isChecked)
          {
            remember = "yes";
          }

          if(user_email =="" || user_password == "")
          {
            $(".errorLogin").html("Please enter all required fields.");
          }
          else
          {
            $("#loader").addClass("preloader");
              $.ajax({
              url: "../include/user_login.php",
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
                $(".errorLogin").html("User not found");
                $("#loader").removeClass("preloader");
      }
                else if(data == "2")
                {
                $(".errorLogin").html("Password not match.");
                $("#loader").removeClass("preloader");
                }
                else if(data="yes")
                {
                  location.reload();

                    //$.ajax({
                      //url: "../include/loginmail.php",
                      //type: "POST",
                      //data:{},
                      //success: function(data)
                      //{
                        //location.reload();
                      //}
                      //});
                }
              }
              });
          }

        return false;
        });
        
        $(document).on("click", "#signup_button", function() {  
             $("a").removeClass("active-1");
            $(".signup-model1").find(".signup-link1").addClass("active-1");
            $(".login-mod").addClass("hide");
            $(".signup-mod").removeClass("hide");
        });
        
        $(document).on("click", "#login_button", function() {  
             $("a").removeClass("active-1");
            $(".signup-model1").find(".login-link1").addClass("active-1");
            $(".signup-mod").addClass("hide");
            $(".login-mod").removeClass("hide");
        });
        
                $(".rentel-process").click(function(event){
          event.preventDefault(); 
          var pd = $("#pd").val();
          var dd = $("#dd").val();

          var country = $("#country").val();
          var vt = $("#vt").val();


        if(pd=="")
          {
            $("#rent_error").html("حدد تاريخ بيك").parents(".error-box").addClass("show-on");
          }
          else if(dd=="")
          {
           $("#rent_error").html("حدد تاريخ قطرة").parents(".error-box").addClass("show-on");
          }
          else if(country=="")
          {
            $("#rent_error").html("حدد التقاط الموقع").parents(".error-box").addClass("show-on");
          }
          else
          {
            $.ajax({
                url: "../include/verify_input.php",
                type: "POST",
                data:
                {
                    pd: pd,dd:dd
                },
                success: function(response)
                {
                    var res = JSON.parse(response);
                    if (res.result==false) 
                    {
                        $("#rent_error").html(res.error).parents(".error-box").addClass("show-on");
                    }
                    else if(res.result==true) 
                    {
                        $("#rentel-form").submit();
                    }
                }
            });
          }
        });
        
        
        $("#signupCMS").click(function()
        {

          var user_email = $("#signup-email").val();
          var user_password = $("#signup-password").val();
          var signup_cpassword = $("#signup-cpassword").val();
          ref=$("#referance").val();

          if(user_email =="" || user_password == "" || signup_cpassword == "")
          {
            $(".errorsignup").html("Please enter all required fields.");
          }
          else
          {
              $.ajax({
              url: "../include/user_signup.php",
              type: "POST",
              data:
              {
                email: user_email,
                password: user_password,
                conpass: signup_cpassword,
                ref: ref,
              },
              success: function(data)
              {
              	alert(data);	
                if(data == "1")
                {
                $(".errorsignup").html("Password And Confirm Password Not Matched.");
                }
                else if(data == "2")
                {
                $(".errorsignup").html("Invalid Email.");
                }
                else if(data == "3")
                {
                $(".errorsignup").html("User With Same Email Already Exist.");
                }
                else if(data == "4")
                {
                $(".errorsignup").html("Some Error Occure.Please Try Again");
                }
                else if(data="success")
                {

                location.reload();
                }
              }
              });            
          }

        return false;
        });
        
        
        
    $("#forget_pass").click(function()
        {
          var for_email = $("#for_email").val();

          if(for_email =="")
          {
            $(".for_error").html("Please enter Email.");
          }
          else
          {

              $.ajax({
              url: "../include/forgot_password.php",
              type: "POST",
              data:
              {
                email: for_email,
              },
              success: function(response)
              {
                if (response=="0") 
                {
                    $(".for_error").html("Invalid Email.Please Enter A Valid Email");
                }
                else
                {
                    $("#for_email").val("");
                    $(".for_error").html("Password Reset Mail Has Been Sent To You.Please Check Your Mail.");
                }
              }
              });

          }

        return false;
        });
        
        
        
        
        $("#part_forget_pass").click(function()
        {
            $("#loader").addClass("preloader");
          var for_email = $("#partner_for_email").val();

          if(for_email =="")
          {
            $(".for_error").html("Please enter Email.");
            $("#loader").removeClass("preloader");
          }
          else
          {

              $.ajax({
              url: "../include/partner_forgot_password.php",
              type: "POST",
              data:
              {
                email: for_email,
              },
              success: function(response)
              {
                if (response=="0") 
                {
                    $(".for_error").html("Invalid Email.Please Enter A Valid Email");
                }
                else
                {
                    $("#partner_for_email").val("");
                    $(".for_error").html("Password Reset Mail Has Been Sent To You.Please Check Your Mail.");
                }
                $("#loader").removeClass("preloader");
              }
              });

          }

        return false;
        });
        
        
        
                $("#subscribe").click(function() {
                    $("#loader").addClass("preloader");
          var name = $("#subname").val();
          var email = $("#subemail").val();
          if (name=="")
            {
                $(".popup-msg6").removeClass("show");
                $(".popup-msg2").removeClass("show");
                $(".popup-msg3").addClass("show");
                $(".popup-msg4").removeClass("show");
                $(".popup-msg5").removeClass("show");
                
                  $("#loader").removeClass("preloader");
            }
          else if (email=="")
            {
                $(".popup-msg6").removeClass("show");
                $(".popup-msg2").removeClass("show");
                $(".popup-msg3").removeClass("show");
                $(".popup-msg4").addClass("show");
                $(".popup-msg5").removeClass("show");
                
                  $("#loader").removeClass("preloader");
            }
            else
            {
              $.ajax({
              url: "../include/subscribe.php",
              type: "POST",
              data:
              {
                name: name,
                email: email,
              },
              success: function(data)
              {
                if(data=="done")
                {

                    $(".popup-msg6").addClass("show");
                    $(".popup-msg2").removeClass("show");
                    $(".popup-msg3").removeClass("show");
                    $(".popup-msg4").removeClass("show");
                    $(".popup-msg5").removeClass("show");                
                  $("#loader").removeClass("preloader");
                }
                if(data=="1")
                {
                    $(".popup-msg6").removeClass("show");
                    $(".popup-msg2").removeClass("show");
                    $(".popup-msg3").removeClass("show");
                    $(".popup-msg4").removeClass("show"); 
                    $(".popup-msg5").addClass("show");                
                    $("#loader").removeClass("preloader");
                }
                else
                {
                    $(".popup-msg6").removeClass("show");
                    $(".popup-msg2").addClass("show");
                    $(".popup-msg3").removeClass("show");
                    $(".popup-msg4").removeClass("show");
                    $(".popup-msg5").removeClass("show"); 
                      $("#subname").val("");
                      $("#subemail").val(""); 
                      $("#loader").removeClass("preloader");
                }
              }
              });
        }
        });
        
                $(".countryselect").on("change.bfhselectbox", function () {
                    var lang = $(this).val();
                        $.ajax({
                  url: "../include/change_language.php",
                  type: "POST",
                  data:
                  {
                    lang: lang,
                  },
                  success: function(data)
                  {
                        window.location.href = "../index.php";
                  }
                  });
        });
        
        
                 $(".countryselect2").on("change.bfhselectbox", function () {
                
                    var country = $(this).val();

                  
        $.ajax({
                    url: "../include/change_language.php",
                    type: "POST",
                    data:
                    {
                      country: country,
                    },
                    success: function(data)
                    {
                      window.location.href = "../index.php";
                    }
                    });
 
        });
        
        
                       
               
  $(".login-link1").click(function() {
    $("a").removeClass("active-1");
     $(this).addClass("active-1");
      $(".login-mod").removeClass("hide");
        $(".signup-mod").addClass("hide");
  
});
  $(".signup-link1").click(function() {
    $("a").removeClass("active-1");
     $(this).addClass("active-1");
      $(".signup-mod").removeClass("hide");
        $(".login-mod").addClass("hide");
  
});

for (i = new Date().getFullYear(); i > 1949; i--)
{
    $("#model").append($("<option />").val(i).html(i));
}


      });
</script>
 
    </body>

</html>';

  

?>







 