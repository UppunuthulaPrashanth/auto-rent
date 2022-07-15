
<div class="theme-page-section theme-page-section-xxl">

    <div class="container _pv-40">

        <div class="theme-page-section-header">

            <?php

            $pageID = '25';

            $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

            $row    = mysqli_fetch_assoc( $result );

            ?>

            <h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle'] ?></h5>

            <p class="theme-page-section-subtitle black-text"><?php echo $row['subTitle']; ?></p>

        </div>

        <div class="row row-col-mob-gap" data-gutter="10">

            <?php

            $hireResult = $db->query( "SELECT * FROM car_hire WHERE active = 1 ORDER BY so ASC limit 3 " );

            while ( $hireRow = mysqli_fetch_assoc( $hireResult ) )

            {

                ?>

                <div class="col-md-4 ">

                    <div class="banner _br-5 banner-animate banner-animate-mask-in banner-animate-zoom-in">

                        <img class="banner-img" src="uploads/car_hire/<?php echo $hireRow['image']; ?>" alt="<?php echo $hireRow['title']; ?>" title="<?php echo $hireRow['title']; ?>"/>

<!--                        <div class="banner-mask"></div>-->

                        <a class="banner-link" href="<?php echo $hireRow['linkTo']; ?>"></a>

                        <div class="banner-caption _ta-c _pb-5 _pt-5 banner-caption-bottom banner-caption-grad">

                            <h4 class="banner-title _fs white-text"><?php echo $hireRow['title']; ?></h4>

                            <p class="banner-subtitle _fw-n _mt-5 white-text"><?php echo $hireRow['summary']; ?></p>

                        </div>

                    </div>

                </div>

                <?php

            }

            ?>



        </div>

    </div>

</div>