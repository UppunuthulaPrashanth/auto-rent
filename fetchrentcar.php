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

$totalDays = filter_var( $_POST['totalDays'], FILTER_SANITIZE_STRING );

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
                    if ( ! empty( $rentCarRow[ 'dailyDummyAED'] && $rentCarRow[ 'weeklyDummyAED'] && $rentCarRow[ 'monthlyDummyAED'] ) )
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

						<p class="theme-search-results-item-car-location-title"><?php echo getBodyTypeFromID( $rentCarRow['bodyTypeID'] ); ?></p>

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

                                    <?php

                                    echo " ";



                                    if ( ! empty( $rentCarRow[ 'dailyDummyAED'] ) )

                                    {

                                        echo "<span class='was-title'>was&nbsp;<strike>" . (int)$rentCarRow[ 'dailyDummyAED'] . "</span></strike>";

                                    }
                                    ?>
                                    <br>
                                    <?php

                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '. (int)$rentCarRow[ 'dailyAED'];

                                    ?>

                                    <br><span class="sub-font-1">/day</span> </p>

                                <!--														<p class="theme-search-results-item-price-sign">per day</p>-->


                                <?php

                                if ( $totalDays < 7 )

                                {

                                    ?>

                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookDaily" type="submit">Daily</button>
                                    <?php

                                }

                                else

                                {

                                    ?>
                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookDaily" type="submit" disabled>Daily</button>
                                    <?php

                                }

                                ?>
                            </div>

                        </div>









                    </div>



                    <div class="col-md-4 ">









                        <!--WEEKLY-->

                        <div class="theme-search-results-item-book">

                            <div class="theme-search-results-item-price">

                                <p class="theme-search-results-item-price-tag">

                                    <?php

                                    echo " ";



                                    if ( ! empty( $rentCarRow[ 'weeklyDummyAED'] ) )

                                    {

                                        echo "<span class='was-title'>was&nbsp;<strike>" . (int)$rentCarRow[ 'weeklyDummyAED'] . "</span></strike>";

                                    }
                                    ?>
                                    <br>
                                    <?php

                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' ' . (int)$rentCarRow[ 'weeklyAED'];

                                    ?><br><span class="sub-font-1">/week</span> </p>

                                <!--														<p class="theme-search-results-item-price-sign">per week</p>-->



                                <?php

                                if ( $totalDays >= 7 && $totalDays < 30)

                                {

                                    ?>

                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookWeekly" type="submit">Weekly</button>

                                    <?php

                                } else

                                {

                                    ?>

                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" name="btnBookWeekly" disabled>Weekly</button>

                                    <?php

                                }

                                ?>

                            </div>

                        </div>





                    </div>





                    <div class="col-md-4 ">









                        <?php





                        ?>



                        <!--MONTHLY-->

                        <div class="theme-search-results-item-book">

                            <div class="theme-search-results-item-price">

                                <p class="theme-search-results-item-price-tag">

                                    <?php



                                    echo  " ";



                                    if ( ! empty( $rentCarRow[ 'monthlyDummyAED'] ) )

                                    {

                                        echo "<span class='was-title'>was&nbsp;<strike>" . ' '.(int)$rentCarRow[ 'monthlyDummyAED'] . "</span></strike>";

                                    }
                                    ?>
                                    <br>
                                    <?php

                                    echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span><br>'.' '. (int)$rentCarRow[ 'monthlyAED'];

                                    ?><br><span class="sub-font-1">/month</span> </p>

                                <!--														<p class="theme-search-results-item-price-sign">per month</p>-->



                                <?php





                                if ( $totalDays >= 30 )

                                {

                                    ?>

                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" id="btnBook<?php echo $i; ?>" value="<?php echo $rentCarRow['slug']; ?>" data-id="<?php echo $rentCarRow['slug']; ?>" name="btnBookMonthly" type="submit">Monthly</button>

                                    <?php



                                } else

                                {



                                    ?>

                                    <button class="btn btn-primary-inverse btn-block theme-search-results-item-price-btn _mt-10" disabled>Monthly</button>

                                    <?php

                                }



                                ?>

                            </div>





                        </div>






                    </div>







                </div>



                <br>
                <center>
                    <a class="btn btn-primary-invert btn-shadow text-upcase" href="rent-cars-enquiry/<?php echo $rentCarRow['slug']?>">
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
