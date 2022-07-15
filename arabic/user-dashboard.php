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

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title><?php echo $pagetitle['USP'];?> </title>
    
    
    <style>
    
    
    .dataTables_wrapper .dataTables_filter input {
	         	margin-left: 0em;
			    padding-right: 10;
			  text-align: left;
			}
			
			.right-form label {
 
     margin-bottom: 5px;
    text-align: left;
    padding-left: 5px;
    padding-right: 5px;
}
select {
    
    padding: 10px 20px;
}
</style>
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
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>Welcome to Dashboard</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

<section class="dashboar-content">
  <div class="container" style="  background-color: #fff; padding: 15px;">
    

  <?php echo $dashnavbar; ?>

    <div class="col-md-9 nopad-lr">
    <div class="right-side">
    
      <h2 style="margin-bottom:15px;">Welcome to Autorent !</h2>
      <div class="right-form">
          <form action="" class="">
            
 <table class="table dash-table ">
    <thead>
          <tr>
        
        <?php 
                if (isset($_GET['response']) && $_GET['response'] == "registered") {
                  echo '<h5 class="alert alert-success">Your Account is Succefully Created.Please Varify Your Account From Your Email.</h5>';
                }
                if (empty($profile['fname']) || empty($profile['lname'])  || empty($profile['cell']) || empty($profile['country']) || empty($profile['dob'])) {
                  echo '<h5 class="alert alert-warning">Please Complete Your Profile.</h5>';
                } 
            
                $diff=$options->getAge($profile['dob']);

                if ($diff<24) {
                  echo '<h5 class="alert alert-warning">Your Age is less than 24 year. Renters above 24 years age would be allowed to book online. Autorent may allow exception on its discretion. Pls contact us to know more.</h5>';
                }
            ?>
<?php
if ($profile['img_url'] == "" && $profile['gender'] == 0 || $profile['gender'] == 2) {
  ?>
<td ><img src="../images/user_images/profile/male.png" class="dashboard-img"  alt=""></td>

<?php
} elseif ($profile['img_url'] == "" && $profile['gender'] == 1) {?>
<td><img class="dashboard-img" src="../images/user_images/profile/female.jpg"  alt=""></td>
    <?php
} else {?>
<td><img class="dashboard-img" src="../images/user_images/profile/<?php echo $profile['img_url'];?>"  alt=""></td>
<?php
}
?>          
      </tr>
        <tr class="">
        <td width="160" style=" border-bottom: 1px solid #ddd;">My Profile</td>
        <td style=" border-bottom: 1px solid #ddd;" ><a href="edit-profile.php">( Edit )</a></td>
   
      </tr>

    </thead>



    <tbody class="main-profile ">
    
      <tr class="">
        <td  width="160">Name:</td>
        <td><?php echo $profile['fname'];
echo " ";
echo $profile['lname'];?></td>
       
      </tr>

       <tr class="">
        <td width="160">Address:</td>
        <td><?php echo $profile['address'];?></td>
       
      </tr>


       <tr class="">
        <td width="160">City:</td>
        <td><?php echo $profile['city'];?></td>
       
      </tr>


       <tr class="">
        <td width="160">Postal Code:</td>
        <td><?php echo $profile['postal_code'];?></td>
       
      </tr>


       <tr class="">
        <td width="160">Country:</td>
        <td><?php echo $profile['country'];?></td>
       
      </tr>

             <tr class="">
        <td width="160">Email:</td>
        <td><?php echo $profile['email'];?></td>
       
      </tr>

             <tr class="">
        <td width="160">Date Of Birth:</td>
        <td><?php echo $profile['dob'];?></td>
       
      </tr>

             <tr class="">
        <td width="160">Gender:</td>
        <td><?php if ($profile['gender'] == 1) {echo "Female";} else {echo "Male";}?></td>
       
      </tr>

      <tr class="">
        <td width="160">Contact:</td>
        <td><?php echo $profile['cell'] ;?></td>
       
      </tr>
     
    </tbody>
  </table>

          </form>
      </div>
    
    </div>
   
<section class="dashboar-content" style="margin-top:20px;">





    <div class="right-side">
    
   
      <div class="right-form">

         <h2 style="text-align:center;">Booking List</h2>
          <form action="" class="">
            
<table id="table-data" class="table table-bordered" style="margin-bottom:0">
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
      </tr>
    </thead>
    <tbody>
<?php
$results = $booking->invoice_userbooking($id);
foreach ($results as $r) {
  ?>
<form method="post" action="include/cancel_booking.php">
      <tr>
      <td ><?php echo $r['id'];?></td>
      <td ><?php echo $r['booking_date'];?></td>
      <td><?php echo $r['pick_date'];?></td>
      <td><?php echo $r['drop_date'];?></td>
      <td ><?php echo $r['total'];?></td>
      <td ><?php echo $location->getLocationName($r['loc_id']);?></td>
      <td ><?php echo $location->getLocationName($r['loc_id2']);?></td>
      <td ><?php echo $vehical->getVehiclaName($r['v_id']);?></td>
      <?php

  $datetime1 = new DateTime();
  $datetime2 = new DateTime($r['pick_date']);

  if ($datetime1 < $datetime2 && $r['status'] == 1) {?>
    <input type="hidden" name="bid" value="<?php echo $r['id'];?>">
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

          </form>
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



    </body>
</html>