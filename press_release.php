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
     table tbody td{
             font-size: 14px;
              font-family: 'proxima_nova_rgbold';
                  color: #A3A3A3;
             letter-spacing: .5px;
        } 
         table tbody td:first-child{
             letter-spacing: 0px;
           font-size: 18px;
            font-family: 'proxima_nova_rgregular';
     }
     
         table tbody td:nth-child(even){
            line-height: 31px;
     }
        
          table tbody tr{
            border-bottom: 10px solid white;
            background-color: #F9F9F9;
           }
        
          table tbody td a{
            color: #676767;
        
     }
     .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
  
    border-top:none;
  
}
     
     .table>thead>tr>th {
    padding: 9px 15px;
     color: #676767;
            font-size: 21px;
     
         font-family: 'proxima_nova_rgbold';
   
}
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
                    <div class="col-md-7 text"><h1 class="tagline pull-left" style="font-size: 30px;"><span>Press Release</span></h1> </div>
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
         <div class="col-md-12 blog-desc" style="padding:0">
         <table class="table table-striped">
               
                <tbody>
<?php
$options = options::getInstance();
$news=$options->getnews();
foreach($news as $new)
{
    ?>
    <tr>
        <td> 
            <div class="col-md-12 nopad-lr">
                <?php $path=$new['slug'].'.php'; ?>
                <a href="<?php echo $path; ?>"><?php echo $new["title"]; ?></a>
                <?php
                if (strlen($new['content']) > 250) {

                                // truncate string
                                $stringCut = substr($new['content'], 0, 250);
                            
                                // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
                            }
                            else
                            {
                                $string=$new['content'];
                            }
                ?>
                            
                <p><?php echo $string; ?></p>
                <a href="<?php echo $path; ?>" style="font-size: 14px;color: #C01732;" >Read More</a>
            </div>
        </td>
                    
        <td style="width: 120px;"><?php echo $new["create_date"]; ?></td>
                 
    </tr>
<?php
}


?>           
                  
                                                                                                                                     
                 
                </tbody>
              </table>
         </div>
         </div>
           <?php echo $news_sidebar; ?>
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
