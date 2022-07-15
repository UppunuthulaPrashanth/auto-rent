<?php
include "inc_opendb.php";

//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();


$queryAppend   ="";
$make          ="";
$model         ="";
$bodyType      ="";
$year          ="";

$start         = filter_var($_POST["start"],FILTER_SANITIZE_STRING);
$limit         = filter_var($_POST["limit"],FILTER_SANITIZE_STRING);
$usedCarsType  = filter_var($_POST["usedCarsType"],FILTER_SANITIZE_STRING);



    $make      = filter_var($_POST["make"],FILTER_SANITIZE_STRING);
if($make!="")
{
    $queryAppend .= " AND makeID = " . $make;
}

    $model     = filter_var($_POST["model"], FILTER_SANITIZE_STRING);
 if($model!="")
{
    $queryAppend .= " AND modelID = " . $model;

}

    $bodyType  = filter_var($_POST["bodyType"],FILTER_SANITIZE_STRING);
if($bodyType!="")
{
    $queryAppend .= " AND bodyTypeID = " . $bodyType;
}


    $year      = filter_var($_POST["year"],FILTER_SANITIZE_STRING);
if($year!="")
{
    $queryAppend .= " AND yearID = " . $year;
}



//get rows query
$usedListingRes = $db->query("SELECT * FROM view_used_cars WHERE  active = 1   $queryAppend ORDER BY userCarID DESC LIMIT ".$start.", ".$limit." ");
//number of rows



$rowCount = mysqli_num_rows($usedListingRes);

if($rowCount > 0)
{
    while ($usedListingRow = mysqli_fetch_assoc($usedListingRes)) {
        ?>

        <div class="col-md-4 ">
            <div class="theme-search-results-item _br-3 _mb-10 theme-search-results-item-bs theme-search-results-item-lift theme-search-results-item-grid">
                <div class="_h-20vh _h-mob-30vh theme-search-results-item-img-wrap-inner">
                    <img class="theme-search-results-item-img" src="uploads/usedcars/<?php echo $usedListingRow['thumbnail'];?>" alt="<?php echo $usedListingRow['make'];?> <?php echo $usedListingRow['model'];?>" title="<?php echo $usedListingRow['make'];?> <?php echo $usedListingRow['model'];?>"/>
                </div>
                <div class="theme-search-results-item-grid-body _pt-0">
                    <a class="theme-search-results-item-mask-link" href="/used-cars-info/<?php echo $usedListingRow['slug'];?>/<?php echo $usedCarsType;?>"></a>

                    <div class="theme-search-results-item-grid-header">
                        <h5 class="theme-search-results-item-title"><?php echo $usedListingRow['make'];?> <?php echo $usedListingRow['model'];?></h5>
                    </div>
                    <div class="theme-search-results-item-grid-caption">
                        <div class="row" data-gutter="10">
                            <div class="col-xs-7 ">
                                <div class="theme-search-results-item-car-location">
                                    <div class="theme-search-results-item-car-location-body">
                                        <p class="theme-search-results-item-car-location-title"><i class="fa fa-road fa-lg loc-icons"></i> <?php echo $usedListingRow['kilometers'];?>Kms</p>
                                        <p class="theme-search-results-item-car-location-subtitle"><?php echo $usedListingRow['year'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5 ">
                                <div class="theme-search-results-item-price">
                                    <p class="theme-search-results-item-price-tag"> <?php echo $_SESSION[CURRENT_CURRENCY] . " " .  $usedListingRow['price' . $_SESSION[CURRENT_CURRENCY]];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>