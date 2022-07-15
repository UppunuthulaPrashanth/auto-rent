<?php
session_start();
require '../lib/config/config.php';
require '../lib/config/autoload.php';
$term = termdb::getInstance();
$user = userdb::getInstance();
$adm = admin::getInstance();
$tem = templetedb::getInstance();
$result = $tem->activetemplete();
$art = articledb::getInstance();

if (isset($_GET['article'])) {
	$id = $_GET['article'];
	if (!empty($id)) {
		if ($art->checkarticle($id) == true) {
			$selarticle = $art->fetcharticle($id);
		}
        else {
	header('Location:blog.php');
}
	}
    else {
	header('Location:blog.php');
}

} else {
	header('Location:blog.php');
}
?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
<title>مشاهدة المشاركة </title>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1626956707518578";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Blog</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <!-- 
                                        Careers Section
    ========================================================================== -->



 <section class="blog-sec">
     <div class="container">
         <div class="col-md-9 blog-left">
           <div class="col-md-12 " style="background-color: #F9F9F9;padding: 15px;">
         <?php
         
         
         
         
         if (isset($selarticle)) { ?>
         
         
              <div class="col-md-12" style="padding:0">
                       <h1 style="font-size: 30px;margin-bottom: 5px;font-family: 'proxima_nova_rgbold';"><?php echo $selarticle['title'];?></h1>
                       
                        <span style="display:block;margin-bottom:10px; letter-spacing: 1px;font-size: 15px;font-family: 'proxima_nova_rgregular';;color: #9C9C9C;">Posted by 
                           <span style="font-size: 14px;color: #888787; font-family: 'proxima_nova_rgbold';" > 
                           <?php $author=$adm->getAdmin($selarticle['uid']);?>
                           <?php echo $author['fname'];?>  </span> 
                           
                           <?php 
                           $old_date = date('Y-m-d H:i:s');              // returns Saturday, January 30 10 02:06:34
                            $old_date_timestamp = strtotime($selarticle['date']);
                            $date = date('Y-m-d', $old_date_timestamp);
                           
                           
                           ?>
                        on <span style="font-size: 14px;color: #888787; font-family: 'proxima_nova_rgbold';"><?php echo $date;?></span>  </span>
                   
                         <img style="    width: 100%;" src="../images/admin_images/artilces/<?php echo $selarticle['img_url'];?>" class="postimg"  alt="">
                    <div class="col-md-12 nopad-lr blog-desc">
                       
                       
                        <?php echo $selarticle['description'];?>
                        
                        
                      
                    </div>
                       
        
                 </div>
                 
                 
                 
                 <!--<div class="col-md-12" style="padding:0">
                       <h1><?php //echo $selarticle['title'];?></h1>
                       <img style="    width: 100%;" src="images/admin_images/artilces/<?php //echo $selarticle['img_url'];?>" class="postimg"  alt="">
                       <p>
                       <?php //$author=$adm->getAdmin($selarticle['uid']);?>
                           <span style="font-family: 'proxima_nova_rgbold';"><?php //echo $author['fname'];?> – <?php //echo $selarticle['date'];?> </span><?php //echo $selarticle['description'];?>
                       </p>
        
                 </div>-->
        <?php
         }
         ?>
           </div>
           
           <div>           
                <div class="fb-comments col-md-12" data-href="http://autorent-me.com/new/view_post.php?article=<?php echo $id; ?>" data-numposts="5"></div>
           </div>
           
         </div>

        <?php echo $blog_sidebar; ?>
     </div> <div class="clearfix"></div>
 </section>
 <div class="clearfix"></div>
    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>


    <script type="text/javascript">
      
    </script>
</body>
</html>
