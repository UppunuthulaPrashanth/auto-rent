<?php include "inc_opendb.php";
$PAGEID = "Terms and Conditions";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <?php include 'inc_metadata.php'; ?>
</head>
<body>
<?php include 'inc_header.php'; ?>
<?php
$pageID = '26';
$result = $db->query("SELECT * FROM pages_static WHERE pageID = ?s",$pageID);
$row = mysqli_fetch_assoc($result);
?>

<div class="theme-hero-area theme-hero-area-half">
    <div class="theme-hero-area-bg-wrap">
        <div class="theme-hero-area-bg" style="background-image:url('uploads/pages/<?php echo $row['headerBG'];?>');"></div>
        <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
        <div class="theme-hero-area-inner-shadow"></div>
    </div>
    <div class="theme-hero-area-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 theme-page-header-abs">
                    <div class="theme-page-header theme-page-header-lg">
                        <h1 class="theme-page-header-title"><?php echo $row['pageTitle'];?></h1>
                        <?php echo $row['summary']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="theme-page-section theme-page-section-lg">
    <div class="container">
        <div class="row row-col-static row-col-mob-gap" id="sticky-parent" data-gutter="60">
            <div class="col-md-8 ">

                <div class="theme-item-page-details theme-item-page-details-first-nm">
                    <div class="theme-item-page-details-section">
                        <div class="row">
                            <?php
                            $result = $db->query("SELECT * FROM terms_conditions");
                            $row = mysqli_fetch_assoc($result);
                            ?>

                            <div class="theme-item-page-desc">
                                <?php echo $row['description'];?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="sticky-col">


                    <div class="theme-sidebar-section _mb-10">
                        <?php include "inc_corporate_sidebar.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include 'inc_footer.php'; ?>
<?php include 'inc_footer_scripts.php'; ?>
</body>
</html>