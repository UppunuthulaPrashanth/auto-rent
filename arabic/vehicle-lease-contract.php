<?php
require "../lib/config/config.php";
require "../lib/config/autoload.php";
error_reporting(E_ALL);
ob_start();

$user = userdb::getInstance();
$vehicle = vehical::getInstance();
$types = $vehicle->getVehicalTypes();
$vehicles = $vehicle->getVehicles();
$options = options::getInstance();
$partner = partnerdb::getInstance();
if ($partner->checkLogin() == true) {
	header("Location:../partner/partnerpanel.php");
}
$country = dbcountrylocation::getInstance();
$selected_page=$options->get_page("vehicle-lease-contract"); 

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
           <?php include "header.php"; ?>
    <?php echo $head; ?>
    <meta name="keywords" content="<?php echo $selected_page["meta_keyword"]; ?>"/>
    <meta name="description" content="<?php echo $selected_page["meta_des"]; ?>"/>
    <title><?php echo $selected_page["page_title"]; ?></title>
    <script src="assets/js/jquery.min.js"></script>
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
                      <div class="col-md-11 text"><h1 class="tagline pull-right"><span><?php echo $selected_page["ar_title"]; ?></span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images//choose-icon.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>





<div class="clearfix"></div>



  <!-- ....................section 2.................. -->
<div id="loader"></div>
  <section class="ser-feature">
    <div class="container">
     



      <div class="col-md-4 ser-col">
          <div class="round-circle1">
               <img src="../images//nohiden.png"  alt="">
          </div> 
          <div class="clearfix"></div>
          <div class="content">
            <h3>أي رسوم المخفية</h3>
            <p>كل التسعير و كسر في أسفل بشكل واضح بحيث كنت في السلام قبل وبعد الحجز..
            </p>
          </div>
      </div>



      <div class="col-md-4 ser-col">
          <div class="round-circle1">
               <img src="../images//instant.png"  alt="">
          </div>
          <div class="clearfix"></div>
          <div class="content">
            <h3>تأكيد فوري</h3>
            <p>الحصول على تأكيد فوري من الحجز من خلال نظام الفوترة الآلي..</p>
          </div>
      </div>



      <div class="col-md-4 ser-col">
          <div class="round-circle1">
               <img src="../images//help.png"  alt="">
          </div>
          <div class="clearfix"></div>
          <div class="content">
            <h3>24/7 الدعم</h3>
            <p>نحن جاهزون لخدمتك على مدار الساعة عن أي نوع من الاستعلام دون أي تأخير .</p>
          </div>
      </div>


    </div>
  </section>

<div class="clearfix"></div>



<!-- .......................section tabss...................... -->

<?php 
$services=$options->get_services();
$main_tab=sizeof($services);
if(!empty($services))
{?>
    
    
        <section class="ser-tabs">

  <div class="col-md-12 tabs-head">
    <h2>إلقاء نظرة على الخدمات التي تقدمها الاوتورينت!</h2>

    <div class="tab-btn ">
      <div class="container">
       <div class="maincenter" >
<?php
$i=0;
$activetab="1";
foreach($services as $service)
{
    $i=$i+1;
    ?>
             <div class="col-md-15 ">  
                <a href="<?php echo $service["slug"].".php"; ?>" class="<?php if($service["id"]==$selected_page["parent"]){ $activetab=$i;echo "active-tab"; } elseif($service["id"]==$selected_page["id"]) { $activetab=$i;echo "active-tab"; } ?> tab<?php echo $i; ?>-link"><?php echo $service["ar_title"]; ?></a>
            </div>
        

           
<?php 
}
?>
<div class="clearfix"></div>
</div>
      </div>
    </div>
  </div>
<div class="clearfix"></div>


<?php
$i=0;
foreach($services as $service)
{
    $i=$i+1;
    ?>
     
        
<?php 
if(!empty($service["ar_content"]))
{
    $mystring = $service["content"];
    $findme   = "[Contact_Form][/Contact_Form]";
    $pos = strpos($mystring, $findme);
if ($pos === false) {
    $final_content=$service["ar_content"];
} else {
    $final_content=str_replace("[Contact_Form][/Contact_Form]","<form action='#' class='form contact-form' id='contact_form'>
                        <div class='fromerror' style='color:red'></div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='name' class='lblmargin'>الإسم <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='text' class='form-control name' name='name' placeholder='أدخل أسمك...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='subject' class='lblmargin'>موضوع <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='text' class='form-control subject' name='subject' placeholder='أدخل موضوع الرسالة...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='email' class='lblmargin'>البريد الإلكتروني <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='email' class='form-control contact_email' name='email' placeholder='ادخل بريدك الالكتروني...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                           
                              <label for='confirm-email' class='lblmargin'>.تأكيد عنوان البريد الإلكتروني <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='email' class='form-control cemail' name='cemail' placeholder='إعادة إدخال البريد الإلكتروني الخاص بك...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='phone' class='lblmargin'>هاتف <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='phone' style='border-radius:0!important; height:38px!important' class='form-control cell' name='cell' placeholder='ادخل رقم الاتصال...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='address' class='lblmargin'>عنوان <span class='staric-icon glyphicon glyphicon-asterisk'></span> </label>
                              <input type='email' class='form-control address' name='address' placeholder='أدخل العنوان البريدي...'>
                           </div>
                        </div>
                        <div class='col-md-12 nopad-lr '>
                           <div class='form-group'>
                              <label for='email' class='lblmargin'>رسالة <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <textarea class='cover-letter msg' rows='4' style='height:200px' cols='50' name='msg' placeholder='اكتب تغطية الرسالة الخاصة بك هنا...'></textarea>
                           </div>
                        </div>
                        <div class='col-md-12 nopad-lr'>
                           <div class='form-group'>
                              <button type='button' id='enquiries' value='Submit' class='enquiries main-btn form-submit'>بتقديم</button>
                              <button type='reset' value='Reset' class='main-btn form-reset'>إعادة تعيين</button>
                           </div>
                        </div>
                        <div class='clearfix'></div>
                     </form>",$mystring);

}

    ?>
<div class="tabs-content tabs-<?php echo $i; ?> <?php if($i!=$activetab){?> hide <?php } ?>">
    <div class="container">
      <div class="col-md-12">

         <p><?php echo $final_content; ?></p>
      </div>
      </div>
</div>

<?php
}
?>     
    
      
<?php 
}
?>

<div class="col-md-12 sub-tabs">

<div class="container">

<?php
$i=0;
foreach($services as $service)
{
    $products=$options->get_products($service["id"]);
    if(!empty($products))
    {
        $i=$i+1;
    ?>
    
      <div class="child-tabs<?php echo $i; ?> <?php if($i!=$activetab){?> hide <?php } ?> main-childs">
        <div class="col-md-3 left-tabs">
        
        <?php
$j=0;
foreach($products as $product)
{
    $j=$j+1;
    ?>

        
<li><a href="<?php echo $product["slug"].".php"; ?>" class="<?php if($product["id"]==$selected_page["id"]){$sub_activetab=$j;echo "active-tab-sub" ;}else{if($j==1&&$i!=$activetab){echo "active-tab-sub" ;}} ?> sub-link"><?php echo $product["ar_title"]; ?></a></li>
        
      
      
 
<?php 
}

?>
</div>

        <?php
$j=0;
foreach($products as $product)
{
    $j=$j+1;
if($service["id"]==$selected_page['parent'])
    {
        ?>
        <div class="col-md-9 right-tabs sub-tab<?php echo $j; ?> <?php if($product['id']!=$selected_page['id']){?> hide <?php } ?> "> 
        <?php
    }
    else
    {
        ?>
        <div class="col-md-9 right-tabs sub-tab<?php echo $j; ?> <?php if($j!=1){?> hide <?php } ?> "> 
        <?php
    }
    ?> 
             
             <?php
$mystring = $product["ar_content"];
$findme   = "[Contact_Form][/Contact_Form]";
$pos = strpos($mystring, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of "a" was the 0th (first) character.
if ($pos === false) {
    $final_content=$product["ar_content"];
} else {
        $final_content=str_replace("[Contact_Form][/Contact_Form]","<form action='#' class='form contact-form' id='contact_form'>
                        <div class='fromerror' style='color:red'></div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='name' class='lblmargin'>الإسم <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='text' class='form-control name' name='name' placeholder='أدخل أسمك...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='subject' class='lblmargin'>موضوع <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='text' class='form-control subject' name='subject' placeholder='أدخل موضوع الرسالة...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='email' class='lblmargin'>البريد الإلكتروني <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='email' class='form-control contact_email' name='email' placeholder='ادخل بريدك الالكتروني...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                           
                              <label for='confirm-email' class='lblmargin'>.تأكيد عنوان البريد الإلكتروني <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='email' class='form-control cemail' name='cemail' placeholder='إعادة إدخال البريد الإلكتروني الخاص بك...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-l'>
                           <div class='form-group'>
                              <label for='phone' class='lblmargin'>هاتف <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <input type='phone' style='border-radius:0!important; height:38px!important' class='form-control cell' name='cell' placeholder='ادخل رقم الاتصال...'>
                           </div>
                        </div>
                        <div class='col-md-6 nopad-r'>
                           <div class='form-group'>
                              <label for='address' class='lblmargin'>عنوان <span class='staric-icon glyphicon glyphicon-asterisk'></span> </label>
                              <input type='email' class='form-control address' name='address' placeholder='أدخل العنوان البريدي...'>
                           </div>
                        </div>
                        <div class='col-md-12 nopad-lr '>
                           <div class='form-group'>
                              <label for='email' class='lblmargin'>رسالة <span class='staric-icon glyphicon glyphicon-asterisk'></span></label>
                              <textarea class='cover-letter msg' rows='4' style='height:200px' cols='50' name='msg' placeholder='اكتب تغطية الرسالة الخاصة بك هنا...'></textarea>
                           </div>
                        </div>
                        <div class='col-md-12 nopad-lr'>
                           <div class='form-group'>
                              <button type='button' id='enquiries' value='Submit' class='enquiries main-btn form-submit'>بتقديم</button>
                              <button type='reset' value='Reset' class='main-btn form-reset'>إعادة تعيين</button>
                           </div>
                        </div>
                        <div class='clearfix'></div>
                     </form>",$mystring);

}
?>
             <p><?php echo $final_content; ?></p>

         </div>
      
<?php 
}

?>


  </div>     
<?php 
}
}
?>

</div>
</div>


</section>
    <?php     
}
?>



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
         $(document).on("click",".enquiries",function(event) {
           current_form=$(this).parents('.contact-form');
          var name = current_form.find(".name").val();
          var subject = current_form.find(".subject").val();
          var email = current_form.find(".contact_email").val();
          var cemail = current_form.find(".cemail").val();
          var cell = current_form.find(".cell").val();
          var address = current_form.find(".address").val();
          var msg = current_form.find(".msg").val();

          if(name =="" || subject == "" || email == "" || cemail == "" || cell == "" || address == "" || msg == "")
          {
            current_form.find(".fromerror").html("الرجاء إدخال جميع الحقول.");
          }
          else
          {
            $("#loader").addClass('preloader');
              $.ajax({
              url: "../include/contact_enquiries.php",
              type: "POST",
              data:
              {
                name: name,
                subject: subject,
                email: email,
                cemail: cemail,
                cell: cell,
                address: address,
                msg: msg,
              },
              success: function(response)
              {
                if (response=="1") 
                {
                    current_form.find(".fromerror").html("البريد الإلكتروني وتأكيد البريد الإلكتروني غير متطابق");
                }
                else if (response=="2") 
                {
                    current_form.find(".fromerror").html("فقط رسائل يسمح للاسم.");
                }
                else if (response=="3") 
                {
                    current_form.find(".fromerror").html("فقط رسائل وأرقام يسمح للموضوع.");
                }
                else if (response=="4") 
                {
                    current_form.find(".fromerror").html("بريد إلكتروني خاطئ");
                }
                else if (response=="5") 
                {
                    current_form.find(".fromerror").html("تأكيد البريد الإلكتروني غير صالح.");
                }
                else if (response=="6") 
                {
                    current_form.find(".fromerror").html("الوحيدة أرقام يسمح للهاتف.");
                }
                
                else if (response=="8") 
                {
                    current_form.find(".fromerror").html("بعض حدث خطأ يرجى المحاولة مرة أخرى.");
                    current_form[0].reset();
                }
                else
                {
                    current_form.find(".fromerror").html("واضاف الاستفسار الخاص بك بنجاح");
                    current_form[0].reset();
                }
                $("#loader").removeClass('preloader');
              }
              });
         
          }         
         });
  });

</script>

    </body>
</html>