
                <?php
require "../lib/config/config.php";
require "../lib/config/autoload.php";
error_reporting(E_ALL);
ob_start();
  

$user = userdb::getInstance();
$vehicle = vehical::getInstance();
$location = new dbcountrylocation;
$types = $vehicle->getVehicalTypes();
$vehicles = $vehicle->getVehicles();
$partner = partnerdb::getInstance();
$country = dbcountrylocation::getInstance();

$d= dealdb::getInstance();
$options = options::getInstance();
$selected_url=$options->get_sitemap_url("asdasdaa"); 

$installfile = "install.php";
$configfile = "config_202.php";

$language="";
if(isset($_SESSION["lang"]) && $_SESSION["lang"]=="en")
{
    header("Location:../index.php");
    $language="1";
}
else
{
    $language="2";
}
$cid="";
if(isset($_SESSION["selected_country"]))
{
    $selected_country=$location->fetch_Countrybyname($_SESSION["selected_country"]);
    $home_content = $options->getcountrycontent($selected_country["id"],$language);
    $cid=$selected_country["id"];
}
else
{
    $home_content = $options->getcountrycontent(5,$language);
    $cid=5;
}


if (file_exists($installfile) && !file_exists($configfile)) {
	header("Location:install.php");
	exit();
}
if (file_exists($configfile)) {
	if (file_exists($installfile)) {
		unlink($installfile);
	}
} else {
	echo "Sorry no Configration Found.";
	exit();
}


if ($partner->checkLogin() == true) {
	header("Location:partner/partnerpanel.php");
}



unset($_SESSION["pd"]);
unset($_SESSION["dd"]);

unset($_SESSION["country"]);
unset($_SESSION["city1"]);
unset($_SESSION["city2"]);

$lenght= strlen($home_content["heading"]);
$pos = strpos($home_content["heading"], "{");

if ($pos === false) {
   $main_content=$home_content["heading"];
} else {
    $main_content= substr($home_content["heading"], 0, $pos);
    $cities= substr($home_content["heading"], $pos,$lenght); 
    $cities=str_replace("{","",$cities);
    $cities=str_replace("}","",$cities);
    $cities_array = explode("|", $cities);
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
           <?php include "header.php"; ?>
    <?php echo $head; ?>
    <meta name="title" content="<?php echo $selected_url["meta_title"]; ?>">
    <meta name="keywords" content="<?php echo $selected_url["meta_keywords"]; ?>"/>
    <meta name="description" content="<?php echo $selected_url["meta_description"]; ?>"/>
    <title><?php echo $selected_url["page_title"]; ?></title>
    
    
        <style>
    
    .message_area{
         background-color: #f2dede;
        border: 1px solid #ebccd1;
        color: #a94442;
        position: absolute;
        top: -16px;
        bottom: 0;
        z-index: 1;
        left: 0;
        height: 163%;
        width: 100%;
        line-height: 4.2;
        font-size: 18px;
        text-align: center;
    }
    
    button.close {
    -webkit-appearance: none;
    padding: 0;
    cursor: pointer;
    background: 0 0;
    border: 0;
    position: relative;
    top: 26px;
    right: 10px;
}

 .bxslider11 img{
    width:100%;
    height:600px;
     -webkit-background-size: cover;
    background-size: cover;
    background-position: center center;
}
 .bxslider11 li{
 left:0!important;
}
.bx-wrapper .bx-viewport {

    box-shadow: none!important;
    border: none!important;
    left: initial!important;
    }
    .bx-wrapper .bx-pager {
    text-align: center;
    font-size: .85em;
    font-family: Arial;
    font-weight: bold;
    color: #666;
    padding-top: 15px;
        bottom: 0px;
    background: rgba(35, 38, 41, 0.36);
}
    .bx-wrapper .bx-pager .bx-pager-item {
    display: inline-block;
    position: relative;
    top: -4px;
}
    .bx-wrapper .bx-pager.bx-default-pager a {
    background: #D3D3D3;
    }
.bx-wrapper .bx-pager.bx-default-pager a:hover, .bx-wrapper .bx-pager.bx-default-pager a.active {
    background: #CE1432;
}
.maincontent{
        position: absolute;
    top: 0;
    margin: 0 auto;
    right: 0;
    left: 0;
    z-index:1;
}
    </style>
    </head>
    <body>
 <!-- ==========================================================================
                              Header Area 
   ========================================================================== -->
        
	    <section class="header head-bgg" style="background: url("");-webkit-background-size: cover;background-size: cover;background-position: center center;background-attachment: fixed;">

       <?php echo $mainnav; ?> 

       <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>

  


<div class="slider_content" style="position: relative;" >

              <ul class="bxslider11">
              <?php 
              $slider_images=explode(",",$home_content["img_url"]);
              foreach($slider_images as $image)
                {
                    ?>
                    <li><img src="../images/homepage/<?php echo $image; ?>" /></li>
                    <?php
                }
              ?>
              
   
             </ul>

		 
		 	<div class="maincontent" >
		 	<div class="col-md-12">
		 		<div class="container nopad-lr ">

		 		<div class="col-md-12">
					<div class=" midbox wow bounceInRight" data-wow-duration="2s">
              <div class="">
    						 <!--  <h1>REDUNDANT, RELIABLE &amp; COST-EFFECTIVE CLOUD SERVERS</h1> -->
    						 <h1><?php echo $main_content;?><span class="changetxt"></span></h1>
    				   </div>   
					</div>

					<div class=" midbox mainbpx2 wow bounceInLeft" data-wow-duration="2s" <?php if($cid!=5){?> style="margin-bottom: 30px;" <?php } ?>>
           <div class="">
						 <!--  <h1>REDUNDANT, RELIABLE &amp; COST-EFFECTIVE CLOUD SERVERS</h1> -->
						   <h1><?php echo $home_content["sub_heading"];?></h1>
				   </div>  
					</div>





<div class=" mainboxes3 wow fadeIn"  data-wow-duration="2s" >
						<div class="col-md-12">
				           <div class="col-md-4 nopad-lr">
				           	<a href="" class="activenav tab-link1"><img  class="img-pos " src="../images/car-icon.png" height="19" width="30" alt=""> تأجير سيارات</a>
				           </div>
				             <div class="col-md-4 nopad-lr">
				           		<a href="" class="secchild tab-link2"><img class="img-pos" src="../images/limousine-icon.png" height="20" width="54" alt=""> عقد الإيجار</a>
				           </div>
				             <div class="col-md-4 nopad-lr">
				           		<a href="" class="tab-link3"><img  class="img-pos" src="../images/buy-used-car-icon.png" height="29" width="24" alt=""> شراء سيارات مستعملة</a>
				           </div>
              </div>
					</div>

					<form method="post" action="search.php" name="carsearch" id="carsearch" >
						<div class=" col-md-12 searchlocation wow fadeIn tab1"  data-wow-duration="2s">
            <div class="col-md-9">
            <?php 
                if (isset($_GET["location"]) && !empty($_GET["location"])) {
                  $date = date("Y/m/d H:i");
                  ?>
                    <div class="col-md-6 nopad-r"><i class="fa fa-calendar"></i><input type="text" id="pd" class="pd" name="pd" value="<?php echo $date; ?>" placeholder="التقاط الوقت"></div>
                    <div class="col-md-6 nopad-r "><i class="fa fa-calendar"></i><input type="text" id="dd" class="dd" value="<?php echo $date; ?>" name="dd" placeholder="غلبه النعاس الوقت">
                  <?php

                }
                else
                {?>
              <div class="col-md-6 nopad-r"><i class="fa fa-calendar"></i><input type="text" id="pd" class="pd" name="pd" placeholder="التقاط الوقت"></div>
              <div class="col-md-6 nopad-r "><i class="fa fa-calendar"></i><input type="text" id="dd" class="dd"  name="dd" placeholder="غلبه النعاس الوقت">
                <?php 
                }


            ?>
							

              </div>

              <?php
                $result = $country->fetch_Country_all();
               
              
                  $loc = new dbcountrylocation;
                       $row["id"] = $cid; 
                        $result2 = $loc->fetch_Locations_ById($row["id"]);
                        foreach ($result2 as $r) {
                          // $suggestions[] = 
                          $suggestions[] = $r["ar_name"];
                          $query = null;
                          $data[] = $r["id"];
                        }
                    

                  $response = array(
                      "query" => $query,
                      "suggestions" => $suggestions,
                      "data" => $data,
                  );

              ?>


                <div class="hide location-txt  col-md-6 nopad-r ">
                  



                           <i class="fa fa-map-marker locationicon" ></i>
                           <?php 
                              if (isset($_GET["location"]) && !empty($_GET["location"])) {
                                ?>
                                <input type="text" name="country" id="country" class="autocomplete" value="<?php echo $_GET["location"]; ?>" placeholder="اختر موقعا"/>
                                <?php 
                              }
                              else
                              {
                                ?>
                                <input type="text" name="country" id="country" class="autocomplete" placeholder="بالتنقيط خارج الموقع"/>
                                <?php 
                              }

                           ?>
                            
    <?php
                    $result = $country->fetch_Country_all();

                    foreach ($result as $row) {

                      $loc = new dbcountrylocation;
                      $result2 = $loc->fetch_Locations_ById($row["id"]);
                      foreach ($result2 as $r) {?>
                      
                        <option value="<?php echo $row["id"];echo ",";echo $r["id"];?> >"<?php echo $row["name"]; echo ","; echo $r["name"]; ?></option>
                      <?php
                      }

                    }
                    ?>


                </div>

                  <div class="hide location-txt  col-md-6 nopad-r ">


                   <i class="fa fa-map-marker locationicon"></i>
                   <?php 
                              if (isset($_GET["location"]) && !empty($_GET["location"])) {
                                ?>
                                <input type="text" name="city" id="city" class="autocomplete" value="<?php echo $_GET["location"]; ?>" placeholder="Drop Location"/>
                                <?php 
                              }
                              else
                              {
                                ?>
                                <input type="text" name="city" id="city" class="autocomplete" placeholder="Drop Location"/>
                                <?php 
                              }

                           ?>
                  <!--   <select name="city" id="city">
                           <option value="" selected="true" style="display:none;">Drop Location</option>
                      </select> -->

                  </div>
							
             </div>

							<div class="col-md-3 nopad-r btnsection" ><input class="btnsearch" type="submit" value="استئجار الآن"></div>



						</div>
					</form> 






 <form method="post" action="#" name="carsearch" id="carsearch" >
            
            <div class=" col-md-12 searchlocation wow fadeIn tab2 hide22"  data-wow-duration="2s">
            <div class="col-md-12">
            <p id="lease_error"></p>
              <div class="col-md-6 nopad-r"><input type="text" id="lease_name" name="pd" class="pd pd-left15"  placeholder="الإسم "></div>
              <div class="col-md-6 nopad-r "><input type="text" id="lease_subject" name="dd" class="dd pd-left15"  placeholder="موضوع"></div>
				  <div class="col-md-6 nopad-r"><input type="text" id="lease_email" name="pd" class="pd pd-left15"  placeholder="البريد الإلكتروني "></div>
              <div class="col-md-6 nopad-r "><input type="text" id="lease_cell" name="dd" class="dd pd-left15"  placeholder="هاتف"></div>
               <div class="col-md-12 nopad-r "><textarea  name="" id="lease_msg" cols="30" rows="10" class="pd-left15"  style="font-size:17px;height: 90px;" placeholder="اكتب رسالتك"></textarea></div>
             
               <div class="col-md-12" style="text-align:center">
                     <input class="btnsearch" style="border: none;padding: 0 50px;background: #ce1432;color: #fff;" type="button" id="lease_form" value="عرض">  
                      <!--  <input class="btnsearch" type="button" id="lease_reset" value="Reset">-->
                  </div>
              
              </div>

              <div class="col-md-12 nopad-r btnsection" >
              </div>



            </div>
          </form> 







          <form method="post" action="#" name="carsearch" id="carsearch" >
            <div class=" col-md-12 searchlocation wow fadeIn tab3 hide22"  data-wow-duration="2s">
            <div class="col-md-12">
            <p id="buy_car_error"></p>
              <div class="col-md-6 nopad-r"><input type="text" id="buy_car_name" name="pd" class="pd pd-left15"  placeholder="الإسم "></div>
              <div class="col-md-6 nopad-r "><input type="text" id="buy_car_subject" name="dd" class="dd pd-left15"  placeholder="موضوع"></div>
				  <div class="col-md-6 nopad-r"><input type="text" id="buy_car_email" name="pd" class="pd pd-left15"  placeholder="البريد الإلكتروني "></div>
              <div class="col-md-6 nopad-r "><input type="text" id="buy_car_cell" name="dd" class="dd pd-left15"  placeholder="هاتف"></div>
               <div class="col-md-12 nopad-r "><textarea  name="" id="buy_car_msg" cols="30" rows="10" class="pd-left15" style="font-size:17px;height: 90px;" placeholder="اكتب رسالتك"></textarea></div>

             </div>

              <div class="col-md-12  btnsection" >
                   <div class="col-md-12" style="text-align:center">
                     <input  class="btnsearch" type="button" id="buy_car_form" value="عرض">  
                      <!--  <input class="btnsearch" type="button" id="buy_car_reset" value="Reset">-->
                  </div>
                  
              
              </div>



            </div>
          </form> 

		 		 </div>
		 		</div>
		 	</div>
            </div>
            
            </div>
            </div>
     	</section>

	 <!-- ==========================================================================
                             SEction 1
   ========================================================================== -->
<section class="about-sect">
            <div class="container">
                <h1 class="wow fadeInDown" data-wow-duration="2s">نبذة عن الاوتورينت</h1>
                <span class="hr1">
                <div class="smalcircle">
                </div>
                </span>
                <p data-wow-duration="2s" class="wow fadeInDown">
                 الاوتورينت هي شركة رائدة في استئجار وتاجير السيارات. مركزها الرئيسي في الامارات العربية المتحدة و تمتلك مواقع عمليات في سلطنة عمان والمملكة العربية السعودية
                
                </p>
                <div class="about-boxes">
                    <div class="clearfix"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeIn" data-wow-duration="3s">
                        <div class="round-circle">
                            <img src="../images/over-vehicle-icon.png"  alt="">
                        </div>
                        <h2>أكثر من 12،000 المركبات</h2>
                        <p>
                        الاوتورينت بدأت عملها في عام 2006 مع 50 مركبة؛ الشركة حاليا لديها أكثر من 12،000 سيارة ، تدار من قبل أكثر من 300 موظف .
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeIn" data-wow-duration="3s">
                        <div class="round-circle">
                            <img src="../images/award-icon.png" alt="">
                        </div>
                        <h2>جائزة احتساء النبيذ الشركة</h2>
                        <p>
                        الاوتورينت التي منحت مؤخرا " أفضل علامة تجارية تأجير السيارات في الإمارات العربية المتحدة " من قبل مجلة العلامات التجارية العالمية .
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeIn" data-wow-duration="3s">
                        <div class="round-circle">
                            <img src="../images/international-presence-icon.png" alt="">
                        </div>
                        <h2>التواجد الدولي</h2>
                        <p>
                        الاوتورينت لديها أسطولها . انتشار عبر 24 موقعا و 3 دول تشمل الإمارات العربية المتحدة وسلطنة عمان و المملكة العربية السعودية.
                
        </p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </section>
        <div class="clearfix"></div>

	 <!-- ==========================================================================
     SEction 2
   ========================================================================== -->

 <section class="services-sec service-bgg" >
 
            <div class="container" style="position: relative; z-index: 10;">
             الاوتورينت يوفر تأجير السيارات، تأجير السيارات، سيارة قبل المملوكة ، ليموزين و نقل الخدمة إلى مجموعة من الصناعات تشمل الضيافة ، والبناء ، وتكنولوجيا المعلومات ، والنفط و الغاز ، والحكومة ، وسلع استهلاكية والسيارات و هلم جرا 
                <div class="service-bg">
                        <h1 class=" key-heading wow fadeInDown " data-wow-duration="2s">الخدمات الرئيسية</h1>
                                    
                        <p style="font-size:16px;margin-top: 12px;" class="fadeInDown wow " data-wow-duration="2s">
                        	 .
                        </p>
                        <div class="clearfix"></div>
                        <div class="service-boxes">
                            
                            
                            <?php 
                                if($cid==5)
                                {?>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 wow fadeInDown" data-wow-duration="2s">
                                    <div class="circle car-rental">
                                        <img src="../images/car-rental-icon.png"  alt="">
                                    </div>
                                    <h2>أعرف أكثر</h2>
                                    <a href="Car-hire-pay-as-you-drive.php" class="btn-learn-more">أعرف أكثر</a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 wow fadeInDown" data-wow-duration="2s">
                                    <div class="circle car-leasing">
                                        <img src="../images/car-leasing-icon.png"  alt="">
                                    </div>
                                    <h2>???? ????</h2>
                                    <a href="short-term-car-leasing.php" class="btn-learn-more">أعرف أكثر</a>
                                </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 wow fadeInDown" data-wow-duration="2s">
                                        <div class="circle linousine-srvc">
                                            <img src="../images/limousine-srvc-icon.png"  alt="">
                                        </div>
                                        <h2>خدمات النقل</h2>
                                        <a href="limousineservices.php" class="btn-learn-more">أعرف أكثر</a>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 wow fadeInDown" data-wow-duration="2s">
                                        <div class="circle transportation">
                                            <img src="../images/transportation-srvc-icon.png"  alt="">
                                        </div>
                                        <h2>تاجير سيارة</h2>
                                        <a href="transportation-services-offered.php" class="btn-learn-more">أعرف أكثر</a>
                                    </div>
                                <?php 
                                }
                                else
                                {?>
                                <div class="col-md-6" style="text-align: center;margin-left: auto;margin-right: auto;float: none;">
                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12 wow fadeInDown" data-wow-duration="2s">
                                        <div class="circle car-rental">
                                            <img src="../images/car-rental-icon.png"  alt="">
                                        </div>
                                        <h2>أعرف أكثر</h2>
                                        <a href="Car-hire-pay-as-you-drive.php" class="btn-learn-more">أعرف أكثر</a>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12 wow fadeInDown" data-wow-duration="2s">
                                        <div class="circle car-leasing">
                                            <img src="../images/car-leasing-icon.png"  alt="">
                                        </div>
                                        <h2>???? ????</h2>
                                        <a href="short-term-car-leasing.php" class="btn-learn-more">???? ????</a>
                                    </div>
                                </div>
                                
                                <?php 
                                }
                            ?>
                            
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                </div><div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            </section>
            <div class="clearfix"></div>
    	 <!-- ==========================================================================
                          section 3
   ========================================================================== -->
   
   
      
   
   	<section class="news-sec" style="text-align:right;direction:rtl;" >
		<div class="container">
        
        <?php echo $selected_url["content"]; ?>
        
       	</div>
        <div class="clearfix"></div>
	</section>
   </section><div class="clearfix"></div>
   
   
    	 <!-- ==========================================================================
                           Footer Area
   ========================================================================== -->

            <?php echo $footer; ?>

<script>
 new WOW().init();
</script>

      <script type="text/javascript">
      $(document).ready(function()
      {
      $(".bxslider11").bxSlider({
         auto:true,
         speed:700,
         mode:"fade",
         autoStart:true,
        });
        
        
        
        $("#country").change(function(){
          var location = $("#country").val();
          var ind = location.indexOf(",");

          var cid = location.substr(0, ind);
          $.ajax({
            type:"post",
            url:"city.php",
            data:{cid:cid},
            success:function(response)
            {
            $("#city").html(response);
            }
          });
        });




        $("#lease_form").click(function()
        {

          var name = $("#lease_name").val();
          var subject = $("#lease_subject").val();
          var email = $("#lease_email").val();
          var cell = $("#lease_cell").val();
          var msg = $("#lease_msg").val();

          if(name =="" || subject == "" || email == "" || cell == "" || msg == "")
          {
            $("#lease_error").html("الرجاء إدخال جميع الحقول المطلوبة");
          }
          else
          {
              $.ajax({
              url: "../include/lease_enquiry.php",
              type: "POST",
              data:
              {
                name: name,
                subject: subject,
                email: email,
                cell: cell,
                msg: msg,
              },
              success: function(response)
              {
                console.log(response);
                if (response=="1") 
                {
                    $("#lease_error").html("واضاف الاستفسار الخاص بك بنجاح");
                }
                else if (response=="2") 
                {
                    $("#lease_error").html("بعض حدث خطأ يرجى المحاولة مرة أخرى.");
                }
                else if (response=="3") 
                {
                    $("#lease_error").html("???? ???????? ????");
                }
               else if (response=="4") 
                {
                    $("#lease_error").html("الرجاء إدخال جميع الحقول المطلوبة.");
                }
                else if (response=="5") 
                {
                    $("#lease_error").html("رسائل وأرقام فقط مسموح للموضوع");
                    $("#lease_form").reset();
                }
                else if (response=="6") 
                {
                    $("#lease_error").html("فقط رسائل يسمح للاسم??? ??? ????.");
                    $("#lease_form").reset();
                }
              }
              });
          }

        return false;
        });
        
                $("#buy_car_form").click(function()
        {

          var name = $("#buy_car_name").val();
          var subject = $("#buy_car_subject").val();
          var email = $("#buy_car_email").val();
          var cell = $("#buy_car_cell").val();
          var msg = $("#buy_car_msg").val();

          if(name =="" || subject == "" || email == "" || cell == "" || msg == "")
          {
            $("#buy_car_error").html("واضاف الاستفسار الخاص بك بنجاح?.");
          }
          else
          {
              $.ajax({
              url: "../include/buy_car_enquiry.php",
              type: "POST",
              data:
              {
                name: name,
                subject: subject,
                email: email,
                cell: cell,
                msg: msg,
              },
              success: function(response)
              {
                console.log(response);
                if (response=="1") 
                {
                    $("#buy_car_error").html("حدد تاريخ قطرة ?????.");
                }
                else if (response=="2") 
                {
                    $("#buy_car_error").html("بعض حدث خطأ يرجى المحاولة مرة أخرى.");
                }
                else if (response=="3") 
                {
                    $("#buy_car_error").html("???? حدد تاريخ بيك");
                }
               else if (response=="4") 
                {
                    $("#buy_car_error").html("??????? ????? ???? ??????.");
                }
                else if (response=="5") 
                {
                    $("#buy_car_error").html("????? ????????? ????? ?? ?????");
                    $("#buy_car_form").reset();
                }
                else if (response=="6") 
                {
                    $("#buy_car_error").html("??? ??? ??? ???? ???????? ??? ????.");
                    $("#buy_car_form").reset();
                }
              }
              });
          }

        return false;
        });



        $("#carsearch").submit(function(){
          var pd = $("#pd").val();
          var dd = $("#dd").val();

          var country = $("#country").val();
          var vt = $("#vt").val();


        if(pd=="")
          {
            alert("??? ????? ???");
            return false;
          }
          else if(dd=="")
          {
            alert("??? ????? ????");
            return false;
          }
          else if(country=="")
          {
            alert("??? ?????? ??????");
            return false;
          }
          else
          {
            return true;
          }
        });

        $("#popup").hide();

        $( "#login" ).click(function()
        {
        $("#popup").show();
        });



      });

    </script>	 


      <script type="text/javascript">




      var countries = [];
    


countries.push(<?php

                     for($a=0; $a<count($response["suggestions"]); $a++)
                      {
                        if($a<count($response["suggestions"])-1)
                        {?>
                        
                          {value: <?php echo "" . $response["suggestions"][$a] . ""?>},;
                          <?php
                        }
                        else
                        {?>
                          {value:<?php echo "".$response["suggestions"][$a]."" ?>};
                          <?php
                        }
                      }
 
                    ?>);
                    console.log(countries);

                $(document).ready(function(){
                    $(".autocomplete").autocomplete({ 
                          lookup: countries,
                          minChars: 0,
                        // callback function:
                         onSelect: function (suggestion) {
                        // alert("You selected: " + suggestion.value + ", " + suggestion.data);
                    }
                    }); 
                });
     </script>
<script>
    (function($){
        $(window).load(function(){

            $(".main-box-auto").mCustomScrollbar({
              axis:"y"
              });
        });
    })(jQuery);
</script>

       <script>
       
       
       
       
        $(function(){

 var country=<?php echo $cid; ?>;
if(country=="5")
{
   $(".changetxt").typed({
         strings: ["???^1000", "???????^1000" , "?????^1000"],
        typeSpeed: 100,
          backSpeed: 50,
          loop: true,
          backDelay: 500,
      });
}
else if(country=="6")
{
   $(".changetxt").typed({
        strings: ["????? ??????^1000", "???^1000" , "??? ???????^1000" , "???????^1000"],
        typeSpeed: 100,
          backSpeed: 50,
          loop: true,
          backDelay: 500,
      });
}
else if(country=="7")
{
   $(".changetxt").typed({
       strings: ["??????? ??? ??? ?????^1000", "?????^1000" , "????^1000" , "????^1000"],
        typeSpeed: 100,
          backSpeed: 50,
          loop: true,
          backDelay: 500,
      });
}
      
    
  });
  
  
    $(document).ready(function() { 
     
     $(".news-boxs .inner2").each(function() {
        
         var txt = $(this).text();
         var res = txt.substr(0,334)+"...";
        
         //$(this).text(res);
 });
    
    });
</script>



    </body>
</html>
