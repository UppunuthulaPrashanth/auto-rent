<?php 
require '../lib/config/config.php';
require '../lib/config/autoload.php';
error_reporting(E_ALL);
ob_start();
$user = userdb::getInstance();
$location= new dbcountrylocation;

if (isset($_GET['job']) AND $_GET['job'] == "undefined") {
    header('Location: careerslist.php?error=1');
    exit;
} else {
    $id = $_GET['job'];
    $carr=careerdb::getInstance();
    $career=$carr->fetchcareer($id);    
    if (empty($career)) {
        header('Location: careers.php');
    }
}



 ?>
 <!DOCTYPE html>
<html class="no-js">
    <?php include 'header.php'; ?>
    <?php echo $head; ?>
    <title>Job Application</title>
</head>
<body>
<!-- Modal -->
  <div class="modal fade" id="applicant-details-modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Applicant Details</h4>
        </div>
        <div class="modal-body">
            <div class="col-md-12 form-wrapper">
                <form action="include/job_application.php" method="POST" class="form applicant-form" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="file_validation" id="file_validation" value="">
                    <p style="color:red" class="file_error"></p>
                    <div class="form-group">
                        <label for="email">First Name : <span class="glyphicon glyphicon-asterisk"></span></label>
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Your First Name..." required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Last Name : <span class="glyphicon glyphicon-asterisk"></span></label>
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Your Last Name..." required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email : <span class="glyphicon glyphicon-asterisk"></span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email..." required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Job Title :</label>
                        <input type="text" class="form-control" id=""  name="career" placeholder="" readonly="readonly" value="<?php echo $career['title']; ?>">
                    </div>

                    <div class="form-group">
                        <div style="position:relative;">
                            <a class='btn-cv-upload' href='javascript:;'>Choose File...
                                <input type="file"name="file_source" size="40"  onchange="checkfile(this);" required>
                            </a>
                            <span class="label label-info" id="upload-file-info"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Message or Cover letter: <span class="glyphicon glyphicon-asterisk"></span></label>
                        <textarea class="cover-letter" name="massage" id="massage" rows="4" cols="50" required placeholder="Type your cover letter here..."></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" value="Submit" class="form-submit">Proceed</button>
                        <button type="reset" value="Reset" class="form-reset">Reset</button>
                    </div>

                </form>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
        </div>
      </div> 
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
                    <div class="col-md-1 icon"><img class="pull-right" src="../images/choose-icon.png" alt=""></div>
                    <div class="col-md-7 text"><h1 class="tagline pull-left"><span>طلب وظيفة</span></h1> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <div class="clearfix"></div>
    <!-- 
                                        apply Section
    ========================================================================== -->
    
    <section id="apply">
        <div class="container">

            <?php 
if (isset($_GET['addedSuccess']) && $_GET['addedSuccess'] == 1) {
    echo '<h4>Your Application is Succefully Added.</h4>';
} 
 ?>
            <p class="back-page"><a href="careers.php">< < Back To Careers </a></p>
            <h1>Job Title :<span class="job-title"><?php echo $career['title']; ?></span></h1>
            <?php $country=$location->Country_Name($career['country']);?>
            <?php $city=$location->getLocationName($career['location']);?>
            <p>Location :<span class="job-location"><?php echo $city . ',' . $country['name'];?></span></p>
            <p class="job-description"> 
            <?php echo $career['description']; ?>
              </p>
              <button type="button" class="btn-apply" id="myBtn3">Post Your Application</button>
        </div>
    </section>

    <!--
        Footer Area
    ========================================================================== -->
    <?php echo $footer; ?>


    <script type="text/javascript" language="javascript">



            function checkfile(sender) {
                var validExts = new Array(".docx", ".doc", ".pdf");
                var fileExt = sender.value;
                fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
                if (validExts.indexOf(fileExt) < 0) {
                  $('.file_error').text("Invalid file selected, valid files are of " +
                           validExts.toString() + " types.");
                  $('#file_validation').val('false');
                }
                else
                {
                    $('.file_error').text("");
                    $('#file_validation').val('true');
                }
                
            }

        $(document).ready(function()
              {
                $("form").submit(function(e){
                    
                    isValid=$('#file_validation').val();
                    if (isValid=="false") 
                    {
                        e.preventDefault();
                    }
                });
              });
</script>
</body>
</html>
