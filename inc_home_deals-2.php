
<?php
$pageID = '30';
$result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
$row    = mysqli_fetch_assoc( $result );
?>
<div class="theme-page-section theme-page-section-xxl ">
    <div class="container _pv-40">
        <div class="theme-page-section-header hotdealstitle">
            <h5 class="theme-page-section-title theme-page-section-title-lg title-blue"><?php echo $row['pageTitle']; ?></h5>

            <p class="theme-page-section-subtitle black-text"><?php echo $row['subTitle']; ?></p>
        </div>
        <div class="theme-inline-slider row" data-gutter="10">
            <div class="owl-carousel" data-items="4" data-loop="true" data-nav="true">

                <?php
                $weeklyResult = $db->query( "SELECT * FROM rent_lease_cars WHERE active = 1 AND weeklyDeals = 1" );
                while ( $weeklyRow = mysqli_fetch_assoc( $weeklyResult ) )
                {
                    ?>
                    <div class="theme-inline-slider-item deals-index">
                        <div class="theme-blog-item theme-blog-item-white">
                            <a class="theme-blog-item-link" href="book-rent-cars/<?php echo $weeklyRow['slug']?>"></a>
                            <div class="banner">
                                <div class=""><img src="uploads/rentlease/<?php echo $weeklyRow['image']?>" alt="<?php echo $weeklyRow['image']?>"></div>
                                <div class="banner-caption banner-caption-">
                                   <center> <h5 class="theme-blog-item-title text-center black-text"><?php echo $weeklyRow['carTitle']?></h5></center>
                                    <ul class="theme-search-results-item-car-feature-list">

                                        <li>

                                            <i class="fa fa-male"></i> <span><?php echo $weeklyRow['noOfSeats']; ?>

														</span>

                                        </li>

                                        <li>

                                            <i class="fa fa-suitcase"></i> <span><?php echo $weeklyRow['luggage']; ?>

                            							</span>

                                        </li>

                                        <li>

                                            <i class="fa fa-cog"></i> <span><?php echo getTransmissionFromID( $weeklyRow['transmissionID'] ); ?>

                            									</span>

                                        </li>

                                        <?php if ( $weeklyRow['ac'] == 'Y' )
                                        {
                                            ?>
                                            <li>

                                                <i class="fa fa-bluetooth"></i> <span><?php echo "B/T";?></span>

                                            </li>
                                        <?php } ?>

                                        <li>

                                            <i class="fa fa-car"></i> <span><?php echo $weeklyRow['noOfDoors']; ?>



                            </span>

                                        </li>



                                    </ul>
                                    <br>
                                    <center>

<!---->
<!--                                        <a class="btn btn-primary-invert btn-shadow text-upcase" href="book-rent-cars/--><?php //echo $weeklyRow['slug']?><!--">-->
<!---->
<!--                                            --><?php
//
//                                            echo "" . $_SESSION[ CURRENT_CURRENCY ] . " " . $weeklyRow[ 'monthly' . $_SESSION[ CURRENT_CURRENCY ] ];
//                                            ?>
<!--                                            <span class="strike-font">-->
<!--                                            --><?php
//                                            if ( ! empty( $weeklyRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
//                                            {
//                                                echo "<strike><br>" . $_SESSION[ CURRENT_CURRENCY ] . " " .$weeklyRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] . "</strike>";
//                                            }
//                                            ?>
<!--                                                </span>-->
<!--                                        </a>-->




                                        <a class="btn btn-primary-invert btn-shadow " href="book-rent-cars/<?php echo $weeklyRow['slug']?>">


                                                <?php
                                                echo  " ";

                                                if ( ! empty( $weeklyRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
                                                {
                                                    echo "<span class='was-title'>was&nbsp;<strike>" .' '.$weeklyRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] . "</span></strike>";
                                                }
                                                ?>
                                                <br>
                                                <?php
                                                echo "<span class='amount-title'>" .''. $_SESSION[ CURRENT_CURRENCY ] .'</span>'.'<span style="font-size:20px">'.$weeklyRow[ 'monthly' . $_SESSION[ CURRENT_CURRENCY ] ].'</span>';
                                                ?>
                                                <span class="sub-font-1"> /month </span>
                                        </a>







<!---->
<!--                                        --><?php
//                                        if ( !empty( $weeklyRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] ) )
//                                        {
//                                        ?>
<!--                                        <a class="btn btn-primary-invert btn-shadow text-upcase" href="book-rent-cars/--><?php //echo $weeklyRow['slug']?><!--">-->
<!--                                            --><?php //echo "<strike><br>" . $_SESSION[ CURRENT_CURRENCY ] . " " .$weeklyRow[ 'monthlyDummy' . $_SESSION[ CURRENT_CURRENCY ] ] . "</strike>";?>
<!---->
<!--                                        </a>-->
<!--                                        --><?php
//                                        }
//                                        else
//                                        {
//                                        ?>
<!--                                            <a class="btn btn-primary-invert btn-shadow text-upcase" href="book-rent-cars/--><?php //echo $weeklyRow['slug']?><!--">-->
<!--                                                --><?php //echo "" . $_SESSION[ CURRENT_CURRENCY ] . " " . $weeklyRow[ 'monthly' . $_SESSION[ CURRENT_CURRENCY ] ];?>
<!---->
<!--                                            </a>-->
<!---->
<!--                                        --><?php
//                                        }
//                                        ?>





                                    </center>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

