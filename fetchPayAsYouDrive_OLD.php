<?php
include "inc_opendb.php";

//echo "<pre>";
//echo print_r($_POST);
//echo "</pre>";
//exit();


$queryAppend = "";
$bodyType    = "";

$start      = filter_var( $_POST["start"], FILTER_SANITIZE_STRING );
$limit      = filter_var( $_POST["limit"], FILTER_SANITIZE_STRING );
$bodyTypeID = filter_var( $_POST['bodyTypeID'], FILTER_SANITIZE_STRING );
if ( empty( $bodyTypeID ) )
{
    $queryAppendcar = " ";

} else
{
    $queryAppendcar = " and bodyTypeID = $bodyTypeID ";
}

//$rentCarResult = $db->query( "SELECT * FROM pay_as_you_drive WHERE active = 1 $queryAppendcar ORDER BY payDriveCarID DESC limit ?i,?i", $start, $limit );
$rentCarResult = $db->query( "SELECT * FROM pay_as_you_drive WHERE active = 1 $queryAppendcar ORDER BY s1DailyAED ASC limit ?i,?i", $start, $limit );

$rowCount = mysqli_num_rows( $rentCarResult );

if ( $rowCount > 0 )
{
    $i = $start;

    while ( $rentCarRow = mysqli_fetch_assoc( $rentCarResult ) )
    {
        $i ++;
        ?>

        <div class="row" data-gutter="20">
            <div class="col-md-3 ">
                <div class="theme-search-results-item-img-wrap">
                    <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>
                </div>
                <ul class="theme-search-results-item-car-feature-list">
                    <li>
                        <i class="fa fa-male"></i> <span><?php echo $rentCarRow['noOfSeats']; ?>
                            </span>
                    </li>
                    <li>
                        <i class="fa fa-suitcase"></i> <span><?php echo $rentCarRow['luggage']; ?>
                            </span>
                    </li>
                    <li>
                        <i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $rentCarRow['transmissionID'] ); ?>

                            </span>
                    </li>
                    <li>
                        <i class="fa fa-snowflake-o"></i> <span><?php if ( $rentCarRow['ac'] == 'Y' )
                            {
                                echo "A/C";
                            } else
                            {
                                echo "Non-A/C";
                            } ?>

                            </span>
                    </li>
                    <li>
                        <i class="fa fa-snowflake-o"></i> <span><?php echo $rentCarRow['noOfDoors']; ?>

                            </span>
                    </li>

                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle'] ?></h5>
                <div class="theme-search-results-item-car-location">

                    <div class="theme-search-results-item-car-location-body">
                        <p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID($rentCarRow['bodyTypeID'] ); ?></p>
                        <p class="theme-search-results-item-car-location-subtitle">or similar</p>
                    </div>
                </div>
                <ul class="theme-search-results-item-car-list"><?php $extraFeatures = $rentCarRow['extraFeatures'];
                    $featureResult                                                  = $db->query( "SELECT * FROM mtr_extra_features WHERE featureID IN ($extraFeatures)" );
                    while ( $featureRow = mysqli_fetch_assoc( $featureResult ) )
                    {
                        ?>
                        <li class="list-float "><i class="fa fa-check"></i><?php echo $featureRow['extraFeatures']; ?>
                        </li><?php } ?>
                </ul>
            </div>

            <div class="col-md-5 ">

                <!--DAILY-->
                <div class="theme-search-results-item-book">
                    <div class="theme-search-results-item-price">
                        <p class="theme-search-results-item-price-tag">
                            <?php
                            echo $_SESSION[ CURRENT_CURRENCY ] . " ";
                            echo " " . $rentCarRow[ 's1Daily' . $_SESSION[ CURRENT_CURRENCY ] ];
                            ?>
                            /Day <p class="theme-search-results-item-car-location-title">For <?php echo $rentCarRow['s1DailyKM']; ?> KM</p>
                        </p>

                        <!--														<p class="theme-search-results-item-price-sign">per day</p>-->
                        <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookDaily" type="submit">Book Daily</button>
                    </div>
                </div>

                <!--                --><?php
                //                if ( $totalDays >= 7 )
                //                {
                //                    ?>
                <!--WEEKLY-->
                <div class="theme-search-results-item-book">
                    <div class="theme-search-results-item-price">
                        <p class="theme-search-results-item-price-tag">
                            <?php
                            echo $_SESSION[ CURRENT_CURRENCY ] . " ";
                            echo " " . $rentCarRow[ 's1Weekly' . $_SESSION[ CURRENT_CURRENCY ] ];
                            ?>
                            /Week <p class="theme-search-results-item-car-location-title">For <?php echo $rentCarRow['s1WeeklyKM']; ?> KM</p></p>
                        <!--														<p class="theme-search-results-item-price-sign">per week</p>-->
                        <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookWeekly" type="submit">Book Weekly</button>
                    </div>
                </div>
                <!--                    --><?php
                //                }
                //
                //                if ( $totalDays >= 30 )
                //                {
                //                    ?>

                <!--MONTHLY-->
                <div class="theme-search-results-item-book">
                    <div class="theme-search-results-item-price">
                        <p class="theme-search-results-item-price-tag">
                            <?php
                            echo $_SESSION[ CURRENT_CURRENCY ] . " ";
                            echo " " . $rentCarRow[ 's1Monthly' . $_SESSION[ CURRENT_CURRENCY ] ];
                            ?>
                            /Month <p class="theme-search-results-item-car-location-title">For <?php echo $rentCarRow['s1MonthlyKM']; ?> KM</p>
                        </p>
                        <!--														<p class="theme-search-results-item-price-sign">per month</p>-->
                        <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookMonthly" type="submit">Book Monthly</button>
                    </div>

                </div>
                <!--                    --><?php
                //                }
                //                ?>


            </div>
        </div>
        <hr/>
        <?php
    }
}
?>