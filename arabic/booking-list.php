<?php
require '../lib/config/config.php';
require '../lib/config/autoload.php';

$user = userdb::getInstance();
$booking = bookingdb::getInstance();
$location = dbcountrylocation::getInstance();
$vehical = vehical::getInstance();


if ($user->checkLogin() == false) {
  header('Location: index.php');exit;
}
$id = $user->getUseerIDfromSession();
$profile = $user->fetch_profile($id);


if (isset($_GET['status']) && $_GET['status'] > 0) {
  $status = $_GET['status'];
  $booking = bookingdb::getInstance();
  
  if($status==0)
  {
    $booking_results = $booking->invoice_userbooking($id);
  }
  elseif($status==1)
  {
    $booking_results = $booking->upcomming_booking($id);
  }
  elseif($status==2)
  {
    $booking_results = $booking->past_booking($id);
  }
  elseif($status==3)
  {
    $booking_results = $booking->filter_booking($id,$status);
  }
  elseif($status==4)
  {
    $booking_results = $booking->filter_booking($id,$status);
  }
   elseif($status==5)
  {
    $booking_results = $booking->reserved_booking($id);
  }


} else {
  $status = 0;
  $booking = bookingdb::getInstance();
  $booking_results = $booking->invoice_userbooking($id);
  
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title><?php echo $pagetitle['BL'];?> </title>
    </head>
    <body>
 <!-- ==========================================================================
                              Header Area 
   ========================================================================== -->
	    <section class="dashboard-head">
       <?php echo $mainnav; ?> 
              <?php echo $login_model; ?>
    <?php echo  $forgetpass_model; ?>
	</section>


       <!-- ==========================================================================
                           section one
   ========================================================================== -->
   <section class="header-search">
    
        <div class="search-cover">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Booking List</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

<section class="dashboar-content">

  <div class="container" style="  background-color: #fff; padding: 40px;">
    

  <?php echo $dashnavbar; ?>

    <div class="col-md-9 ">
 
    
<section class="dashboar-content" style=" padding-top:0">





    <div class="right-side">
     <?php
      
          if (isset($_GET['response']) && $_GET['response'] =="Cancelled") {
            echo "<p>Your refund will be processed within 2 weeks. Kindly contact the sales department for any query.</p>";
          }
          else if (isset($_GET['response']) && $_GET['response'] =="error") {
            echo "<p>Some Error Occure.Please Try Again.</p>";
          }
      ?>
         <h2  style="text-align:center">Booking List</h2>
      <div class="right-form">
      <div class="col-md-4">
      <label for="search1">Sort By</label>
        <select name="bokinglist" class="searchby" name="status" id="status">
          <option value="0" <?php if ($status == 0) {?>selected <?php }?>>All Bookings</option>
          <option value="1" <?php if ($status == 1) {?>selected <?php }?>>Upcomming</option>
          <option value="4" <?php if ($status == 4) {?>selected <?php }?>>Unfinish</option>
          <option value="2" <?php if ($status == 2) {?>selected <?php }?>>Past Booking</option>
          <option value="3" <?php if ($status == 3) {?>selected <?php }?>>Cancelled</option>
          <option value="5" <?php if ($status == 5) {?>selected <?php }?>>Reserved</option>
        </select>
      </div>   
      <!--<div class="col-md-4">
        <label for="search1" class="">Search By ID</label>
        <input type="text" name="bid" id="bid" placeholder="ID / Name">
      </div> 
      <div class="col-md-4">
        <input type="button"id="track" class="editbtn" value="Search">
      </div>   -->
      
 <table id="table-data" class="table table-bordered table-responsive" style="margin-bottom:0">

    <thead>
      <tr>
        <th>ID</th>
        <th>Booking Date</th>
        <th>Pickup Date </th>

         <th>Drop Date</th>
        <th>Rent</th>

         <th>Pick Location</th>
        <th>Drop Location</th>
        <th>Vehicle</th>
        <th>Status</th>
      </tr>
    </thead>
  <tbody id="data">
<?php
foreach ($booking_results as $r) {
  ?>
<form method="post" action="../include/cancel_booking.php">
      <tr id="table-row">
      <td ><?php echo $r['id'];?></td>
      <td ><?php echo $r['booking_date'];?></td>
      <td><?php echo $r['pick_date'];?></td>
      <td><?php echo $r['drop_date'];?></td>
      <td ><?php echo $r['total'];?></td>
      <td ><?php echo $location->getLocationName($r['loc_id']);?></td>
      <td ><?php echo $location->getLocationName($r['loc_id2']);?></td>
      <td ><?php echo $vehical->getVehiclaName($r['v_id']);?></td>
      
            <?php 
                $now=date("Y-m-d h:i:s");
                
                if($r['status'] == 3)
                {?>
                    <td><?php echo "Cancelled";?></td>
                <?php
                }
                else if($r['status'] == 4)
                {?>
                    <td style="color:red">
                    <?php 
                        echo "Unfinish";
                        if($r['pick_date'] >= $now) 
                        {?>
                            <br /><a href="../include/complete_booking.php?id=<?php echo $r['id'];?>" class="complete">Complete Booking</a></td>
                        <?php
                        }   
                }
                else if($r['pick_date'] >= $now && $r['status']!=5)
                {?>
                    <td style="color:green"><?php echo "Upcomming";?>
                    <?php
                    if($r['pick_date'] >= $now) 
                        {?>
                            <br /><a href="" class="cancel">Cancel Booking</a></td>
                        <?php
                        } 
                }
                else if($r['pick_date'] <= $now)
                {?>
                    <td ><?php echo "Past";?></td>
                <?php
                }
                else if($r['status'] == 5)
                {?>
                    <td ><?php echo "Reserved";?></td>
                <?php
                }
                
            ?>
      <input type="hidden" name="bid" id="bid" value="<?php echo $r['id'];?>">
      <?php

  $datetime1 = new DateTime();
  $datetime2 = new DateTime($r['pick_date']);

  if ($datetime1 < $datetime2 && $r['status'] == 1) {?>
    
    <input type="hidden" name="status" value="<?php echo $status;?>">
  <?php
}
  ?>
    </tr>
</form>
<?php
}

?>
  </tbody>
  </table>
      </div>
    
    </div>
      

</section>

    </div>
  </div>
</section>







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
                $('#popup').hide();

        $( "#login" ).click(function()
        {
        $('#popup').show();
        });

        $("#status").change(function(){
          var status = $("#status").val();
          window.location.href="?status=" + status;
        });
        $('#track').click(function() {
          var bid=$('#bid').val();
          if(bid % 1 === 0){
   if (bid=="")
              {
              $('#error').text("Enter Booking ID");
            }
            else{
              $('#error').text("");
              $.ajax({
              url: '../include/track_booking.php',
              type: 'POST',
              data:
              {
                bid: bid,
              },
              success: function(data)
              {
 
                  $('#data').html(data);
              }
              });
            }
}
else
{
$('#error').text("Input Is Not Valid");
}



        });
        
        
            /*$('.complete').click(function() {
                bid=$(this).parents('#table-row').find('#bid').val();
                alert(bid);
                
                
            });*/
            
            $('.cancel').click(function() {
                bid=$(this).parents('#table-row').find('#bid').val();
                $.ajax({
                  url: '../include/cancel_booking.php',
                  type: 'POST',
                  data:
                  {
                    bid: bid,
                  },
                  success: function(data)
                  {
                        if(data=="error")
                        { 
                            location.href = "http://autorent-me.com/new/arabic/booking-list.php?response=error";

                        }
                        else
                        {
                            location.href = "http://autorent-me.com/new/arabic/booking-list.php?response=Cancelled";
                        }
                  }
                  });
                
            });
        });
    </script>



    </body>
</html>
