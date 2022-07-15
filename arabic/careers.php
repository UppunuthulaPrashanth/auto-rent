<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$carr = careerdb::getInstance();
$careers = $carr->fetch_active_careers();
$location= new dbcountrylocation;

 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>Careers</title>
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
                    
                    <div class="col-md-11 text"><h1 class="tagline pull-right"><span>وظائف</span></h1> </div>
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
    <section id="careers">
        <div class="container">
        <div class="col-md-12 header-section nopad-l">
            <div class="col-md-7 left nopad-l">
                <h1 class="heading">A Great Place to Work. The Best, Actually.</h1>
                <p class="description">
                    It’s more than Bagel Fridays and endless snacks.
                    It’s about being the best place to work, applying your passion, and making a 
                    difference. Smartsheet is transforming the way people work. And that transformation 
                    is happening within our own workplace. With over 60,000 customers in 165 countries,
                    there has never been a better time to join our team.
                </p>
            </div>
            <div class="col-md-5 right">
                <div class="img-box">
                    <img src="../images/careers.jpg" alt="">
                </div>  
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <!-- ............................................................  Group Image ............................................... -->
<!--             <div class="col-md-12 group-img ">
                <div class="img-box">
                    <img src="images/group-image2.jpg"  alt="">
                </div> 
            </div>
            <div class="clearfix"></div> -->
<!-- .......................................................  Jobs Section....................................................... -->
            <div class="col-md-12 jobs nopad-lr">


<?php  

if (!empty($careers)) {
    foreach ($careers as $c) {?>
<!-- ............................................  Job .......................................... -->
                <div class="job">
                    <h3 class="heading">Job Title : <span class="job-title"><?php echo $c['title']; ?> </span></h3>
                    <?php $country=$location->Country_Name($c['country']);?>
                    <?php $city=$location->getLocationName($c['location']);?>
                    <p class="job-location"><?php echo $city . ',' . $country['name'];?></p>
                    <h4 class="sub-heading">Description</h4>
                    <p class="job-description">
                        <?php echo $c['description']; ?> 
                    </p>
                    <a href="job-application.php?job=<?php echo $c['id'];?>" class="btn-job-apply">Apply</a>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
<?php
}
}
else
{?>
                <div class="job">
                    <p>Currently No Jobs Available</p>
                    <div class="clearfix"></div>
                </div>
<?php
}

 ?>

                 <div class="clearfix"></div>
                
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- ............................................................  Group Image ............................................... -->
            <div style="padding: 0!important;" class="col-md-12 group-img nopad-lr">
                <div class="img-box">
                    <img style="margin-top: -27px;" src="../images/career2.jpg"  alt="">
                </div> 
            </div>
            <div class="clearfix"></div>
    </section>

    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>


    <script type="text/javascript">
      
    </script>
</body>
</html>
