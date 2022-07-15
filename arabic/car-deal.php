<?php
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();

$user = userdb::getInstance();
$vehicle = vehical::getInstance();
$options = options::getInstance();
$d = dealdb::getInstance();
$location = new dbcountrylocation;

$partner = partnerdb::getInstance();
if ($partner->checkLogin() == true) {
	header('Location:partner/partnerpanel.php');
}
$country = dbcountrylocation::getInstance();

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


$id=$_GET['deal'];

$check = $d->check_deal($id,$cid);

$uid = $user->getUseerIDfromSession();
$profile = $user->fetch_profile($uid);

if($check)
{
    $deal = $options->get_deal($id);
    $deal_vehicles = $options->get_dealvehicles($id);
}
else
{
   header('Location:index.php');
}




?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
           <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>Special Deals</title>
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
                  <div class="col-md-11 text"><h1 class="tagline pull-right"><span>السيارات صفقة</span></h1> </div>
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                  
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>





<div class="clearfix"></div>



  <!-- ....................section 2.................. -->


  <section class="cardeal-sec feature-sec1">
    <div class="container">
        <input type="hidden" id="did" value="<?php echo $deal['id']; ?>">
        <h1 class="wow fadeInDown" data-wow-duration="2s"><?php echo $deal['ar_name']; ?></h1>
        <input type="hidden" name="deal" id="deal" value="<?php echo $deal['name']; ?>" />
      <span class="hr1" style="  margin-bottom: 20px;">
        <div class="smalcircle">
        </div>
        </span>




 



      <div class="col-md-6 deal-right">

        <img src="../images/admin_images/deals/<?php echo $deal['deal_img']; ?>"  style="  height: 500px; width: 500px;" alt="">
      </div>



      <div class="col-md-6  deal-left" >
        
       
          <div class="" style="direction: rtl;">
            <h3 style="margin-top:0">فترة العرض الترويجي: <?php echo $deal['deal_from']; ?> to <?php echo $deal['deal_to']; ?></h3>
            <p><?php echo $deal['ar_des']; ?></p>
            
            <div class="clearfix"></div>
          </div><div class="clearfix"></div>
      </div><div class="clearfix"></div>


    </div><div class="clearfix"></div>
  </section>

<div class="clearfix"></div>



<section class="header dealsec1 ">


		 
		 	<div class="col-md-12" style="  background-color: rgb(245, 242, 236);">
            
            
            
		 		<div class="container nopad-lr ">
                
                 <h1 class="wow fadeInDown" style="text-align: center; "  data-wow-duration="2s">اختر الموقع</h1>
         <span class="hr1" style="width: 250px;">
        <div class="smalcircle">
        </div>
        </span>
            <p class="form_error"></p>
		 		<div class="col-md-12">
				
						<div class=" col-md-9 searchlocation wow fadeIn tab1"  data-wow-duration="2s" style="margin-left: 12%;margin-right:12%;">
            <div class="col-md-12">
            <?php 
                if (isset($_GET['location']) && !empty($_GET['location'])) {
                  $date = date('Y/m/d H:i');
                  ?>
                    <div class="col-md-6 nopad-r"><i class="fa fa-calendar"></i><input type="text" id="pd" class="pd" name="pd" value="<?php echo $date; ?>" placeholder="البيك اب الوقت"></div>
                    <div class="col-md-6 nopad-r "><i class="fa fa-calendar"></i><input type="text" id="dd" class="" value="<?php echo $date; ?>" name="dd" placeholder="غلبه النعاس الوقت">
                  <?php

                }
                else
                {?>
              <div class="col-md-6 nopad-r"><i class="fa fa-calendar"></i><input type="text" id="pd" class="pd" name="pd" placeholder="البيك اب الوقت"></div>
              <div class="col-md-6 nopad-r "><i class="fa fa-calendar"></i><input type="text" id="dd" class=""  name="dd" placeholder="غلبه النعاس الوقت">
                <?php 
                }


            ?>
							

              </div>

              <?php
                $result = $country->fetch_Country_all();
               
              
                  $loc = new dbcountrylocation;
                       $row['id'] = $cid; 
                        $result2 = $loc->fetch_Locations_ById($row['id']);
                        foreach ($result2 as $r) {
                          // $suggestions[] = 
                          $suggestions[] = $r['ar_name'];
                          $query = null;
                          $data[] = $r['id'];
                        }
                    

                  $response = array(
                      'query' => $query,
                      'suggestions' => $suggestions,
                      'data' => $data,
                  );

              ?>


                <div class=" location-txt  col-md-6 nopad-r ">
                  



                           <i class="fa fa-map-marker locationicon" ></i>
                           <?php 
                              if (isset($_GET['location']) && !empty($_GET['location'])) {
                                ?>
                                <input type="text" name="country" id="country" class="autocomplete" value="<?php echo $_GET['location']; ?>" placeholder="اختر موقعا"/>
                                <?php 
                              }
                              else
                              {
                                ?>
                                <input type="text" name="country" id="country" class="autocomplete" placeholder="اختر موقعا"/>
                                <?php 
                              }

                           ?>
                            

                <!--           <select name="country" id="country">
                         <option value="" selected="true" style="display:none;"> &#xf041; PickUp Location</option>
                        <?php
                    $result = $country->fetch_Country_all();

                    foreach ($result as $row) {

                      $loc = new dbcountrylocation;
                      $result2 = $loc->fetch_Locations_ById($row['id']);
                      foreach ($result2 as $r) {
                        echo "<option value='" . $row['id'] . ',' . $r['id'] . "'>" . $row['name'] . " , " . $r['name'] . "</option>";
                      }

                    }
                    ?>
               </select> -->

                	
                </div>

                  <div class=" location-txt  col-md-6 nopad-r ">


                   <i class="fa fa-map-marker locationicon"></i>
                   <?php 
                              if (isset($_GET['location']) && !empty($_GET['location'])) {
                                ?>
                                <input type="text" name="city" id="city" class="autocomplete" value="<?php echo $_GET['location']; ?>" placeholder="غلبه النعاس الموقع"/>
                                <?php 
                              }
                              else
                              {
                                ?>
                                <input type="text" name="city" id="city" class="autocomplete" placeholder="غلبه النعاس الموقع"/>
                                <?php 
                              }

                           ?>
                  <!--   <select name="city" id="city">
                           <option value="" selected="true" style="display:none;">Drop Location</option>
                      </select> -->

                  </div>
					<div class="col-md-12 nopad-r btnsection" ><input class="btnsearch" id="fetch_cars" type="button" value="عملية"></div>		
             </div>



						</div>
					<div class="clearfix"></div>


















		 		 </div>
		 		</div><div class="clearfix"></div>
		 	</div><div class="clearfix"></div>
		 	
		 	
		 	  
		 	    	<div class="container " style="    padding: 15px;">
		 		     <div   id="deal_cars" style="direction: rtl;"> </div>
		 		  </div>
            <div class="clearfix"></div>
  </section>
     	</section><div class="clearfix"></div>
<div class="clearfix"></div>


   <!-- ==========================================================================
                          section 3
   ========================================================================== -->


  <div class="clearfix"></div>


<div class="clearfix"></div>

    	 <!-- ==========================================================================
                           Footer Area
   ========================================================================== -->

            <?php echo $footer; ?>
<script>
 new WOW().init();




</script>


<script>
    (function($){
        $(window).load(function(){
            
            
            $(".deal-left").mCustomScrollbar({
              axis:"y"
});
        });
    })(jQuery);
</script>
      <script type="text/javascript">




      var countries = [];
    


countries.push(<?php

                      for($a=0; $a<count($response['suggestions']); $a++)
                      {
                        if($a<count($response['suggestions'])-1)
                        {

                          echo '{value: "'.$response['suggestions'][$a].'"},';
                        }
                        else
                        {
                          echo '{value: "'.$response['suggestions'][$a].'"}';
                        }
                      }
 
                    ?>);
                    console.log(countries);

                $(document).ready(function(){
                    $('.autocomplete').autocomplete({ 
                          lookup: countries,
                          minChars: 0,
                        // callback function:
                         onSelect: function (suggestion) {
                        // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    }
                    }); 
                });
     </script>
  <script type="text/javascript">
      $(document).ready(function()
      {
              $(document).on('click','#maualdeal_enquiries',  function()
         {
            $('.fromerror').html('');
          var name = $('#name').val();
          var subject = $('#subject').val();
          var email = $('#contact_email').val();
          var cemail = $('#cemail').val();
          var cell = $('#cell').val();
          var address = $('#address').val();
          var msg = $('#msg').val();
          var deal = $('#deal').val();

          if(name =="" || subject == "" || email == "" || cemail == "" || cell == "" || address == "" || msg == "")
          {
            $('.fromerror').html("Please enter all fields.");
          }
          else
          {
         
              $.ajax({
              url: '../include/maual_deal_enquiries.php',
              type: 'POST',
              data:
              {
                name: name,
                subject: subject,
                email: email,
                cemail: cemail,
                cell: cell,
                address: address,
                msg: msg,
                deal: deal,
              },
              success: function(response)
              {
                console.log(response);
                if (response=="1") 
                {
                    $('.fromerror').html("Email and Confirm Email Not Matched");
                }
                else if (response=="2") 
                {
                    $('.fromerror').html("Only Letters Are Allowed For Name.");
                }
                else if (response=="3") 
                {
                    $('.fromerror').html("Only Letters and Numbers Are Allowed For Subject.");
                }
                else if (response=="4") 
                {
                    $('.fromerror').html("Invalid Email");
                }
                else if (response=="5") 
                {
                    $('.fromerror').html("Invalid Confirm Email.");
                }
                else if (response=="6") 
                {
                    $('.fromerror').html("Only Numbers Are Allowed For Telephone.");
                }
                
                else if (response=="8") 
                {
                    $('.fromerror').html("Some Error Occure Please Try Again.");
                    $('#contact_form')[0].reset();
                }
                else 
                {
                    $('.fromerror').html("Your Enquiry is Succefully Added");
                    $('#contact_form')[0].reset();
                }
              }
              });
         
          }
         
         });
         
                   $('#fetch_cars').click(function()
        {
          var did = $('#did').val();
          var city = $('#city').val();
          var country = $('#country').val();
          var pd = $('#pd').val();
          var dd = $('#dd').val();

          if(country =="" || pd == "" || dd=="")
          {
            $('.form_error').html(" <div class='clearfix'></div>  <div class='col-md-12'><div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>الرجاء إدخال جميع الحقول المطلوبة.</div></div>");
          }
          else
          {            
            $.ajax({
              url: '../include/deal_cars_arabic.php',
              type: 'POST',
              data:
              {
                city: city,
                country: country,
                pd: pd,
                dd: dd,
                did: did,
              },
              success: function(response)
              {
                var res = JSON.parse(response);
                if (res.result==false) 
                {
                    $('.form_error').html( " <div class='clearfix'></div>  <div class='col-md-12'><div class='alert alert-danger'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+res.error+"</div></div>");
                    $('#deal_cars').html('');
                }
                else
                {
                    $('.form_error').html('');
                    $('#deal_cars').html(res.response);
                } 
              }
              });
          }

        return false;
        });
      });

    </script>

    </body>
</html>