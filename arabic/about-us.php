<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$options = options::getInstance();
$content = $options->getaboutuscontent();

 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>عن الاوتورنت</title>
</head>
<body>

<div class="custom-modal">
  <div class="modal-bg"><div class="overlay"></div></div>
    <a href="" class="close1"><i class="fa fa-times"></i></a>
     <div class="c-modal-body">
         <div class="col-md-12 image-modal clear">
                <img class="hide" src="../images/aboutus/uae-large.jpg">
                  <img class="hide" src="../images/aboutus/ksa-large.jpg">
                  <img class="hide" src="../images/aboutus/oman-large.jpg">
          </div>
  </div>
</div>


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
                <div class="col-md-11 text"><h1 class="tagline pull-right"><span>عن الاوتورنت</span></h1> </div>
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
    <section id="about">
        <div class="container">
            <div class="row">
                <h1 class="heading">تأجير السيارات رحلة</h1>
                <p class="history-details" style="padding-bottom: 20px;">LLC تأجير السيارات الاوتورينت هي الرائدة في مجال تأجير السيارات وخدمة تأجير مزود في الإمارات العربية المتحدة. الاوتورينت لديها أكثر من 12،000 سيارة في أسطولها. في الإمارات العربية المتحدة، الاوتورينت ديها اكثر من 10 موقعا بما في ذلك دبي والشارقة وأبوظبي. منحت الاوتورينت مؤخرا "أفضل علامة تجارية تأجير السيارات في الإمارات العربية المتحدة</p>

            </div>
            <div class="row group">
                <div class="clearfix"></div>
                <div class="col-md-4 group-img nopad-l">
                    <div class="img-box">
                        <img src="../images/aboutus/<?php echo $content['vision_img'];?>"  alt="" style="    width: 92%;">
                    </div>
                    <div class="clearfix"></div>
                    <div class="text txt-mrgin">
                        <h3 class="heading">رؤية</h3>
                        <p class="para"><?php echo $content['ar_vision'];?></p>
                    </div>
                </div>
                
                
                   <div class="col-md-4 group-img nopad-r">
                    <div class="img-box">
                        <img src="../images/aboutus/<?php echo $content['values_img'];?>"  alt="" style="width: 68%;">
                    </div>
                    <div class="clearfix"></div>
                    <div class="text txt-mrgin">
                        <h3 class="heading">القيم الأساسية</h3>
                        <p class="para"><?php echo $content['ar_val'];?></p>
                    </div>
                </div>
                
                <div class="col-md-4 group-img">
                    <div class="img-box">
                        <img src="../images/aboutus/<?php echo $content['mission_img'];?>"  alt="" style="width: 90%;">
                    </div>
                    <div class="clearfix"></div>
                    <div class="text txt-mrgin">
                         <h3 class="heading">مهمة</h3>
                        <p class="para"><?php echo $content['ar_mission'];?></p>
                    </div>
                </div>
             
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <div class="clearfix"></div>
   
    
    <section id="reputation">
        <div class="container canvas">
            <h1 class="heading">الاوتورينت  في التقييم تتحدث عن نفسها</h1>
            <div class="col-md-3 circle-cont">
              
                <span class=".integers counter"><?php echo $content['years'];?></span>
                <h4 class="heading">سنوات في إدارة الأعمال</h4>
            </div> 
            <div class="col-md-3  circle-cont">
                 <span style="color: #21A7F5;" class="counter"><?php echo $content['bookings'];?></span>
                <h4 class="heading">الحجوزات المنجزة</h4>
            </div> 
            <div class="col-md-3  circle-cont">
                 <span style="color: #46AB60;" class="counter"><?php echo $content['fleet'];?></span>
                <h4 class="heading">إجمالي أسطول</h4>
            </div> 
            <div class="col-md-3  circle-cont">
                 <span style="    color: #A456BE;" class="counter"><?php echo $content['customers'];?></span>
                <h4 class="heading">رضى العملاء</h4>
            </div> 
            
        </div>
    </section>
    <div class="clearfix"></div>
   <!-- <section id="team">
        <div class="container">
        <h1 class="heading">الناس المتفانين خلف الكواليس</h1>
        <div class="clearfix"></div>
<?php
$options = options::getInstance();
$results = $options->get_team();

foreach($results as $res)
{?>

            <div class="col-md-3">
                <div class="team-member">
                  
                    <div class="info">
                        <p class="name"><?php echo $res['ar_name'];?></p>
                        <p class="designation"><?php echo $res['ar_designation'];?></p>
                    </div>
                      <div style="text-align: center;padding: 10px;" class="img-box">
                      <p><?php echo $res['ar_description'];?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

<?php    
}

?>


        </div>
    </section> -->
    
    
       <!-- ............................................................  Group Image ............................................... -->
       
     <section id="team2">
        <div class="container">
        <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="team-member">
                    <div class="info">
                        <p class="name">الإمارات العربية المتحدة</p>
                        
                    </div>
                      <div style="text-align: center;padding: 0px;" class="img-box cleafix">
                      <div class="img-bg col-md-12" style="height: 300px; background-image:url(../images/aboutus/uae-large.jpg);background-size:cover;background-position:center center"> </div> 
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
              <div class="col-md-4">
                <div class="team-member">
                    <div class="info">
                     <p class="name">المملكة العربية السعودية</p>
                      
                    </div>
                      <div style="text-align: center;padding: 0px;" class="img-box cleafix">
                      <div class="img-bg col-md-12" style="height: 300px; background-image:url(../images/aboutus/ksa-large.jpg);background-size:cover;background-position:center center"> </div> 
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
              <div class="col-md-4">
                <div class="team-member">
                    <div class="info">
                       <p class="name">سلطنة عمان</p>
                    </div>
                      <div style="text-align: center;padding: 0px;" class="img-box cleafix">
                      <div class="img-bg col-md-12" style=" height: 300px; background-image:url(../images/aboutus/oman-large.jpg);background-size:cover;background-position:center center"> </div> 
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>


        </div>
    </section>
      <style>
    .img-bg{
      cursor: pointer;
      }</style>
    <div class="clearfix"></div>

            
            
    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>


    <script type="text/javascript">
     $(document).ready(function() {
     
       $('.counter').counterUp();
       var current_img=0;
       $(document).on('click', '.img-box a', function(event) {
        	event.preventDefault();
         	current_img=$(this).closest('.img-box ').index();
            $('.image-modal img').addClass("hide").eq(current_img).removeClass("hide");
            $('.custom-modal').addClass("fadein");
            $("body").css({ overflow: 'hidden' });
           console.log(current_img);
        });
       $(document).on('click', '.close1', function(event) {
        	event.preventDefault();
            $('.custom-modal').removeClass("fadein");
            $("body").css({ overflow: 'visible' });
             $('.image-modal img').addClass("hide");
        });
      $(document).on('click', '.custom-modal', function(event) {
    	if($(event.target).is('.overlay'))
		{
			$('.custom-modal').removeClass("fadein");
			$("body").css({ overflow: 'visible' });
             $('.image-modal img').addClass("hide");
			
		}
        });
      
    });

    </script>
</body>
</html>
