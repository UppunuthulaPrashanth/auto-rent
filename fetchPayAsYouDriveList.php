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
                    <?php if ( $rentCarRow['ac'] == 'Y' )
                    {
                        ?>
                        <li>

                            <i class="fa fa-bluetooth"></i> <span><?php echo "B/T";?></span>

                        </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-car"></i> <span><?php echo $rentCarRow['noOfDoors']; ?>

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



                <div class="row">
                    <table class="table">

                        <div class="col-md-4 ">
                            <!--DAILY-->
                            <div class="theme-search-results-item-book">
                                <div class="theme-search-results-item-price">
                                    <p class="theme-search-results-item-price-tag">
                                        <tr>
                                            <td>Daily</td>

                                            <?php

                                            for ( $i = 1; $i <= 5; $i ++ )
                                            {
                                                if ( ! empty( $rentCarRow[ 's' . $i . 'DailyAED' ] ) )
                                                {
                                                    ?>
                                                    <td>
                                                        <button class="paydbookbutton btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBookDailyS<?= $i ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" data-selectedterm="Daily" data-selectedslab="<?= $i ?>" data-selectedvehicleslug="<?php echo $rentCarRow['slug']; ?>" name="btnBookDaily" type="submit" disabled>
                                                            <?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . (int)$rentCarRow[ "s" . $i . "Daily" . $_SESSION[ CURRENT_CURRENCY ] ]; ?>
                                                            <br>
                                                            <?php echo $rentCarRow[ 's' . $i . 'DailyKM' ]; ?> KMs
                                                        </button>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="theme-search-results-item-book">
                                <div class="theme-search-results-item-price">
                                    <p class="theme-search-results-item-price-tag">
                                        <tr>
                                            <td>Weekly</td>
                                            <?php
                                            for ( $i = 1; $i <= 5; $i ++ )
                                            {
                                                if ( ! empty( $rentCarRow[ 's' . $i . 'WeeklyAED' ] ) )
                                                {
                                                    ?>
                                                    <td>
                                                        <button class="paydbookbutton btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBookWeeklyS<?= $i ?>" data-selectedterm="Weekly" data-selectedslab="<?= $i ?>" data-selectedvehicleslug="<?php echo $rentCarRow['slug']; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookWeekly" type="submit"
                                                            <?php if($totalDays < 7) echo 'disabled'; ?>
                                                        >
                                                            <?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . (int)$rentCarRow[ "s" . $i . "Weekly" . $_SESSION[ CURRENT_CURRENCY ] ]; ?>
                                                            <br>
                                                            <?php echo $rentCarRow[ 's' . $i . 'WeeklyKM' ]; ?> KMs
                                                        </button>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <!--MONTHLY-->
                            <div class="theme-search-results-item-book">
                                <div class="theme-search-results-item-price">
                                    <p class="theme-search-results-item-price-tag">
                                        <tr>
                                            <td>Monthly</td>

                                            <?php

                                            for ( $i = 1; $i <= 5; $i ++ )
                                            {
                                                if ( ! empty( $rentCarRow[ 's' . $i . 'MonthlyAED' ] ) )
                                                {
                                                    ?>
                                                    <td>
                                                        <button class="paydbookbutton btn btn-primary-inverse btn-block theme-search-results-item-price-btn" id="btnBookMonthlyS<?= $i ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookMonthly" type="submit" data-selectedterm="Monthly" data-selectedslab="<?= $i ?>" data-selectedvehicleslug="<?php echo $rentCarRow['slug']; ?>"

                                                            <?php if($totalDays < 30) echo 'disabled'; ?>>
                                                            <?php echo $_SESSION[ CURRENT_CURRENCY ] . " " . (int)$rentCarRow[ "s" . $i . "Monthly" . $_SESSION[ CURRENT_CURRENCY ] ]; ?>
                                                            <br>
                                                            <?php echo $rentCarRow[ 's' . $i . 'MonthlyKM' ]; ?> KMs
                                                        </button>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </p>
                                </div>

                            </div>

                        </div>
                    </table>
                </div>

<!--                    --><?php
//                }
//                ?>

                                <p class="alert alert-info sidepanelText">

                            </p>

                <center>
                    <a class="btn btn-primary-invert btn-shadow text-upcase" href="pay-as-you-drive-enquiry/<?php echo $rentCarRow['slug']?>">
                        Enquire Now
                    </a>
                </center>
            </div>
        </div>
        <hr/>
        <?php
    }
}
?>



<script>
    $(document).ready(function () {


        var wid = screen.width;

        if(wid <= 992)
        {
            $('.sidepanelText').text("Choose pick up and drop off date from top panel.");
        }
        else
        {
            $('.sidepanelText').text("Choose pick up and drop off date from the side panel.");
        }

    });
</script>
