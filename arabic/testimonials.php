<?php
require '../lib/config/config.php';
require '../lib/config/autoload.php';
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

$test = options::getInstance();
$testimonials = $test->getactivetestimonial();

if(isset($_GET['id']))
{
    $selected_page='';
    $id=$_GET['id'];
    $check=$options->checkpage($id);
    if($check)
    {
        $selected_page=$options->get_custom_page($id);
    }
    else
    {
        
    }
}
    

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
           <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>testimonials</title>
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
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Testimonials</span></h1> </div>
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
if (isset($_GET['success']) && $_GET['success'] == 1) {
	echo "<h5>Thank you, your testimonial has been submitted.</h5>";
}
if (isset($_GET['error']) && $_GET['error'] == 1) {
	echo "<h5>Please Add All Fields.</h5>";
}
?>







       <div class="col-md-3 left-side2">
        
        <div id='cssmenu'>
        
              <ul>
              <?php       
              if(!empty($testimonials))
                {  ?>  
                    <li class='last'>
                        <a href=''  class="last1 tstlink1"><span>Testimonials</span></a>
                    </li>
                    <?php 
                }
                ?>   
                  <li class='last'>
                    <a href=''  class="last1 tstlink2"><span>Create New Testimonial</span></a>
                    </li>
               </ul>
     
            </div>     
        </div>
        
        
        
        
        
        
      <!--  <div class="col-md-3 left-side2">
        
<?php 
             
  if(!empty($testimonials))
       {  ?>  
        <div class="col-md-12 menu-box1" style="padding: 0;">
            <a href="" class="main-link tstlink1">Testimonials</a>
        </div>
         
        <?php 
        }
        ?>      
        <div class="col-md-12 menu-box1 t" style="padding: 0;">
            <a href="" class="main-link tstlink2">Create New Testimonial</a>
        </div>
                 
     </div> -->

<div class="col-md-9 right-tabs  " style="  padding: 0;background-color:transparent"> 
    <div class="col-md-12 testimonalsbox " style="padding: 0;"> 
     
       <?php 
          if(!empty($testimonials))
              { 
                 foreach($testimonials as $testimonial)
                {?>
                
                <div class="col-md-12 innex-box " style="background-color: #F9F9F9;padding: 15px;margin-bottom: 10px;"> 
                    <p style="  font-family: 'proxima_nova_rgregular';font-size: 15px; font-style: italic; ">
                    
                   &ldquo; <?php echo $testimonial['content']; ?> &rdquo;
                    
                     
                    </p>
                    <p style="margin-bottom: 0;"><span style="color: rgb(206, 20, 50);font-family: 'proxima_nova_rgbold';"><?php echo $testimonial['name']; ?></span>
                    <span style="color: rgb(3, 78, 162); font-family: 'proxima_nova_rgregular';"> - <?php echo $testimonial['company']; ?></span>
                    </p>
                    
                    <div class="clearfix"></div>
                </div>
                    <div class="clearfix"></div>
                   
                <?php 
                }
    
             }
            else
            {
                    echo "Create New Testimonial";
            }
            
            ?>
            
    </div>
    
    
     <div class="col-md-12 testimonalsform hide" style="padding: 30px 15px;background-color: #F9F9F9;"> 
        <form role="form" action="../include/testimonial.php" method="post">
        <div class="col-md-6" style="padding-left: 0;">
         <label>Name
          <input  type="text" name="name" />
         </label>
        </div>
           <div class="col-md-6" style="padding-right: 0;">
         <label>Company
          <input  type="text" name="company" />
         </label>
        </div>
        
         <div class="col-md-12" style="padding: 0;">
         <label>Message
          <textarea style="height: 140px;" name="content" ></textarea>
         </label>
        </div>
          <div class="col-md-12" style="padding: 0;">
         <input type="submit" name="Add" value="Add" class="adbtn" style="background-color: #CD3049;border: none;color: #fff;width: 10%;padding: 8px;" />
        </div>
        
        
        </form>
     
      </div>
     
         </div>
         
        


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

      $('.submenu1').slideUp();
     
     $('.main-link').click(function(e) {
         $('.submenu1').slideUp();
            link1 = $(this).parents('.menu-box1').find('.submenu1');
        link1.stop().slideToggle();
         
       
         e.preventDefault();
       
        });
      
          
        
       
        
           $('.submenu1 .sub-link11').click(function(e) {
              $('.sub-link11').removeClass("focus1");
           $(this).addClass("focus1");

        });
        
           









        
        $('.tstlink1').click(function(e) {
            e.preventDefault();
              $('.testimonalsbox').removeClass("hide");
          $('.testimonalsform').addClass("hide");

        });
              
        $('.tstlink2').click(function(e) {
            e.preventDefault();
              $('.testimonalsbox').addClass("hide");
          $('.testimonalsform').removeClass("hide");

        });
        


 });




</script>



    </body>
</html>