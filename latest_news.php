<?php
require 'lib/config/config.php';
require 'lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();

$user = userdb::getInstance();
$vehicle = vehical::getInstance();
$types = $vehicle->getVehicalTypes();
$vehicles = $vehicle->getVehicles();
$options = options::getInstance();
$partner = partnerdb::getInstance();
if ($partner->checkLogin() == true) {
	header('Location:partner/partnerpanel.php');
}
$country = dbcountrylocation::getInstance();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
           <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title></title>

    </head>
    <body>
 <!-- ==========================================================================
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
                    <div class="col-md-1 icon"><img class="pull-right" src="images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Auto Rent News</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

<div class="clearfix"></div>


<!-- .......................section tabss...................... -->

<section class="ser-tabs" style="padding: 40px 0;">



<div class="col-md-12 ">

<div class="container">

  <div class="main-childsec ">
    
        <?php 
$news=$options->getnews();
if(!empty($news))
{
    ?>
        <div class="col-md-3 left-side2">
        
        <div id='cssmenu'>
        
                    <ul>
            
                        
               <li class='active no-dropdownnn'><a href='#'><span>News</span></a></li>
<?php
foreach($news as $new)
    { 
?>
            <li class='last'><a href='<?php echo $new['slug'].'.php'; ?>'><span><?php echo $new['title']; ?></span></a></li>
        <?php
    }
?>

     
</ul>
     
            </div>     
        </div>



          <div class="col-md-9 right-tabs  "> 
          <p><?php echo $news[0]['content']; ?></p>
         

         </div>
<?php 
}    
?>


  </div>




  
  


<div class="clearfix"></div>
</div><div class="clearfix"></div>
</div><div class="clearfix"></div>


</section>

<div class="clearfix"></div>

    	 <!-- ==========================================================================
                           Footer Area
   ========================================================================== -->

            <?php echo $footer; ?>

<script>
 new WOW().init();




</script>

<script>
$(document).ready(function() {

     
      
          
               $('.main-link2').click(function(e) {
           $('.submenu1').slideUp();
                 $(this).toggleClass("newactive");
              
            link1 = $(this).parents('.menu-box1').find('.submenu1');
        
                link1.stop().slideToggle();
                
         
e.preventDefault();
       
        });
        
         
        
        
           $('.submenu1 .sub-link11').click(function(e) {
              $('.sub-link11').removeClass("focus1");
              $(this).addClass("focus1");
  
        });
        
           

        
        
        


 });




</script>



    </body>
</html>