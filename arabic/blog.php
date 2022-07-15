<?php
session_start();
require '../lib/config/config.php';
require '../lib/config/autoload.php';

$term = termdb::getInstance();
$adm = admin::getInstance();
$user = userdb::getInstance();
$tem = templetedb::getInstance();
$result = $tem->activetemplete();
$art = articledb::getInstance();

if (isset($_GET['Category'])) {
	$cat = $_GET['Category'];
	if (!empty($cat)) {
		if ($term->checkTerm($cat) == true) {
			$articles = $art->fetcharticlesbycategory($cat);
		}
	}

} else {

	$articles = $art->fetcharticles();
}
?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>بلوق</title>
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
                
                    
                    <div class="col-md-11 text"><h1 class="tagline pull-right"><span>بلوق</span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    
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
          <div class="col-md-12" >
         
         
            <?php
         if (!empty($articles)) {
		      foreach ($articles as $a) {
         ?>
         
          <div class="col-md-12 blog-post1" style="background:#F9F9F9;padding: 15px;margin-bottom:15px">
              
                 <div class="col-md-5 text-center col-sm-5 blog-img1 nopad-lr">
                      <img src="../images/admin_images/artilces/<?php echo $a['img_url'];?>" class="postimg"  alt="">
                     
                 </div>
                 <div class="col-md-7 col-sm-7 blog-txt1">
                   <a href="view_post.php?article=<?php echo $a['id'];?>" style="color: #485055;"><h1 style="font-size: 25px;margin-bottom: 5px;font-family: 'proxima_nova_rgregular';"><?php echo $a['title'];?></h1></a>
                    <?php $authour=$adm->getAdmin($a['uid']);?>
                  <span style=" letter-spacing: 1px;font-size: 15px;font-family: 'proxima_nova_rgregular';;color: #9C9C9C;">Posted by 
                  <span style="font-size: 14px;color: #888787; font-family: 'proxima_nova_rgbold';" > <?php echo $authour['fname'];?> </span> 
                  <?php 
                           $old_date = date('Y-m-d H:i:s');              // returns Saturday, January 30 10 02:06:34
                            $old_date_timestamp = strtotime($a['date']);
                            $date = date('Y-m-d', $old_date_timestamp);
                           
                           
                           ?>
                  on <span style="font-size: 14px;color: #888787; font-family: 'proxima_nova_rgbold';"><?php echo $date;?></span>  </span>
                  
                  <?php 
                          if (strlen($a['description']) > 250) {
                                $strip_tags=strip_tags($a['description']);
                                // truncate string
                                $stringCut = substr($strip_tags, 0, 250);
                            
                                // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                            }
                            else
                            {
                                $string=$a['description'];
                            }
                         
                          ?>

                   <p style="font-family: 'proxima_nova_rgregular';"><?php echo $string;?> </p>
                   <div class="clearfix"></div>
                  
                    <a href="view_post.php?article=<?php echo $a['id'];?>" style="    background-color: #6693C5;padding: 5px 20px;color: #fff;" class="button btnread ">إقرا المزيد</a>
                    <div class="clearfix"></div>
                 </div>
                 
          </div>
          
      
         <!--<div class="col-md-12" style="padding:0;    margin-bottom: 20px;">

               <h1 style="    font-size: 30px;margin-bottom: 15px;font-family: 'proxima_nova_rgregular';"><?php //echo $a['title'];?></h1>
                   <img style="    width: 100%;" src="images/admin_images/artilces/<?php // echo $a['img_url'];?>" class="postimg"  alt="">
               <p>
               <?php //$authour=$adm->getAdmin($a['uid']);?>
                   <span style="font-family: 'proxima_nova_rgregular';"><?php //echo $authour['fname']; ?> – <?php //echo $a['date'];?> </span>
                 
                   <?php //echo $a['description'];?>
                   
               </p>
                 <a href="view_post.php?article=<?php //echo $a['id'];?>" style="    background-color: #6693C5;padding: 5px 20px;color: #fff;" class="button btnread ">Read More</a>
         </div>-->
         <?php
         }
         }
         ?>
           <div class="clearfix"></div>
           
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
