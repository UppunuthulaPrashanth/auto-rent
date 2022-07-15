<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$d = dealdb::getInstance();
$location = new dbcountrylocation;

$cid='';
if(isset($_SESSION['selected_country']))
{
    $selected_country=$location->fetch_Countrybyname($_SESSION['selected_country']);
    $cid=$selected_country['id'];
}
else
{
    $cid=5;
}


$deals = $d->fetch_country_promotion($cid);
 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>Promotions</title>
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
                  <div class="col-md-11 text"><h1 class="tagline pull-right"><span>الترقيات</span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                  
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <!-- 
                                        About Section
    ========================================================================== -->
    <section class="prom-search" style="padding: 60px 0;">
       <div class="container">
       <h1 style="text-align:center ;  margin-top: 0;margin-bottom: 25px;">أحدث الترقيات</h1>
       <div class="col-md-12 main-proms" style="">
    <?php 
        foreach($deals as $deal)
        {?>
        <div class="col-md-4 col-sm-6 text-center " style="margin-bottom: 20px;;">
           <a href="car-deal.php?deal=<?php echo $deal['id'];  ?>">
           <img class="prom-box" src="../images/admin_images/deals/<?php echo $deal['deal_img']; ?>" style="width: 340px; height: 200px;" /></a>
        </div>
        <?php    
        }
    ?>
       </div>      
        
       
        
      </div>
    </section>
    <div class="clearfix"></div>
    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>


</body>
</html>
