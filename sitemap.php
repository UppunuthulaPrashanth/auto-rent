<?php 
require "lib/config/config.php";
require "lib/config/autoload.php";
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$carr = careerdb::getInstance();
$careers = $carr->fetch_active_careers();
$location= new dbcountrylocation;
$options = options::getInstance();

 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include "header.php"; ?>
    <?php echo $head; ?>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <title>Press Release</title>
    
    
     <style>

     </style>
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
                    <div class="col-md-1 icon"><img class="pull-right" src="images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Sitemap</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <!-- 
                                        Careers Section
    ========================================================================== -->



 <section class="sitemap-sec">
     <div class="container">
      
        <div class="col-md-12 nopad-lr sitemap-box">
                 <div class="col-md-12 sitemap-heading">
                   <h3>UAE</h3>
                </div>
                  <div class="col-md-12 ">
        <ul class="sitemap-list">
<?php 
$options = options::getInstance();
$urls = $options->filtered_sitemap_urls(5,1);
foreach($urls as $url)
{?>
  
            <li><a href="<?php echo $url['slug'].'.php'; ?>"><?php echo $url['page_title']; ?></a></li>
      
<?php
}
?>      
  </ul>        
    </div>      
        </div>
  
        <div class="col-md-12 nopad-lr sitemap-box">
                 <div class="col-md-12 sitemap-heading">
                   <h3>Saudi Arabia</h3>
                </div>
                <div class="col-md-12 ">
                <ul class="sitemap-list">
<?php 
$options = options::getInstance();
$urls = $options->filtered_sitemap_urls(6,1);
foreach($urls as $url)
{?>
    
        
            <li><a href="<?php echo $url['slug'].'.php'; ?>"><?php echo $url['page_title']; ?></a></li>
             
    
<?php
}
?>   
  </ul> 
</div>         
        </div>
        
                <div class="col-md-12 nopad-lr sitemap-box">
                 <div class="col-md-12 sitemap-heading">
                   <h3>Oman</h3>
                </div>
                 <div class="col-md-12 ">
                 <ul class="sitemap-list">
<?php 
$options = options::getInstance();
$urls = $options->filtered_sitemap_urls(7,1);
foreach($urls as $url)
{?>
   
        
            <li><a href="<?php echo $url['slug'].'.php'; ?>"><?php echo $url['page_title']; ?></a></li>
      
<?php
}
?>     
  </ul>        
    </div>       
        </div>
        
        
        
     </div> <div class="clearfix"></div>
 </section>
 <div class="clearfix"></div>
    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>
</body>
</html>
