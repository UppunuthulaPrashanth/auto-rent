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

$rentCarResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 $queryAppendcar ORDER BY dailyAED ASC limit ?i,?i", $start, $limit );

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
                    <?php
                    if ( ! empty( $rentCarRow[ 'dailyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] && $rentCarRow[ 'weeklyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] && $rentCarRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                    {
                        ?>
                        <div class="card" data-label="Deal">
                            <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <img class="theme-search-results-item-img" src="uploads/rentlease/<?php echo $rentCarRow['image']; ?>" alt="<?php echo $rentCarRow['carTitle'] ?>" title="<?php echo $rentCarRow['carTitle'] ?>"/>
                        <?php
                    }
                    ?>
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

            <div class="col-md-3 extraFeatures-mar-bot">
                <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $rentCarRow['carTitle']; ?></h5>
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

            <div class="col-md-6">



                <div class="row">

                    <div class="col-md-4 ">

                        <!--DAILY-->
                        <div class="theme-search-results-item-book">
                            <div class="theme-search-results-item-price">
                                <p class="theme-search-results-item-price-tag">
                                    <!--                            From-->
                                    <?php
                                    echo  " ";

                                    if ( ! empty( $rentCarRow[ 'dailyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                    {
                                        echo "<span class='was-title'>was&nbsp;<strike>" .' '. (int)$rentCarRow[ 'dailyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] . "</span></strike>";
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '. (int)$rentCarRow[ 'daily' . $_SESSION[ CURRENT_CURRENCY ] ];
                                    ?>
                                    <br><span class="sub-font-1"> /day</span></p>

                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->
                                <!--														<p class="alert alert-info">-->
                                <!--															Choose pick up and drop off date from the side panel.-->
                                <!--														</p>-->
                            </div>
                        </div>

                    </div>


                    <div class="col-md-4 ">



                        <!--Weekly-->
                        <div class="theme-search-results-item-book">
                            <div class="theme-search-results-item-price">
                                <p class="theme-search-results-item-price-tag">
                                    <!--                            From-->
                                    <?php
                                    echo  " ";

                                    if ( ! empty( $rentCarRow[ 'weeklyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                    {
                                        echo "<span class='was-title'>was&nbsp;<strike>" .' '. (int)$rentCarRow[ 'weeklyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] . "</span></strike>";
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' ' .(int)$rentCarRow[ 'weekly' . $_SESSION[ CURRENT_CURRENCY ] ];
                                    ?>
                                    <br><span class="sub-font-1"> /week </span> </p>
                                <br>
                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->
                                <!--                                                        <p class="alert alert-info">-->
                                <!--                                                            Choose pick up and drop off date from the side panel.-->
                                <!--                                                        </p>-->
                            </div>
                        </div>

                    </div>


                    <div class="col-md-4 ">




                        <!--monthly-->
                        <div class="theme-search-results-item-book">
                            <div class="theme-search-results-item-price">
                                <p class="theme-search-results-item-price-tag">
                                    <!--                            From-->
                                    <?php
                                    echo  " ";

                                    if ( ! empty( $rentCarRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                    {
                                        echo "<span class='was-title'>was&nbsp;<strike>" .' '.(int)$rentCarRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] . "</span></strike>";
                                    }
                                    ?>
                                    <br>
                                    <?php
                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '.(int)$rentCarRow[ 'monthly' . $_SESSION[ CURRENT_CURRENCY ] ];
                                    ?>
                                    <br><span class="sub-font-1"> /month </span> </p>
                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->

                            </div>
                        </div>


                    </div>


                </div>
                
<!--                <p class="alert alert-info text-center sidepanelText"  id="sidepanelText"></p>-->

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <center>
                            <!--                                                    <a class="btn btn-primary-invert btn-shadow text-upcase mob-book-btn" href="rent-cars-mob/--><?php //echo $rentCarRow['slug']?><!--">-->
                            <a class="btn btn-primary-invert btn-shadow text-upcase book-btn-right" href="rent-cars-mob/<?php echo $rentCarRow['slug']?>">
                                Book Now
                            </a>
                        </center>
                        <br>
                    </div>
                    <div class="col-md-6 col-sm-12">

                        <center>
                            <a class="btn btn-primary-invert btn-shadow text-upcase" href="rent-cars-enquiry/<?php echo $rentCarRow['slug']?>">
                                Enquire Now
                            </a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <?php
    }
}
?>


<!--<script>-->
<!--    $(document).ready(function () {-->
<!---->
<!---->
<!--        var wid = screen.width;-->
<!---->
<!--        if(wid <= 992)-->
<!--        {-->
<!--            $('.mob-book-btn').show();-->
<!--            $('.sidepanelText').hide();-->
<!--        }-->
<!--        else-->
<!--        {-->
<!--            $('.sidepanelText').text("Choose car category from side panel.");-->
<!--            $('.mob-book-btn').hide();-->
<!--        }-->
<!---->
<!--    });-->
<!--</script>-->
