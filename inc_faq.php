<div class="theme-page-section  theme-page-section-lg" style="background:#ebecf0">

    <div class="container _pv-40">

        <div class="row">

            <div class="theme-page-section-header">
                <?php
                $pageID = '31';
                $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
                $row    = mysqli_fetch_assoc( $result );
                ?>


                <h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle']; ?></h5>

                <p class="theme-page-section-subtitle black-text"><?php echo $row['subTitle']; ?></p>

            </div>

            <div class="col-md-12 ">



                <div class="row">

                    <div class="col-md-12 ">

                        <div class="theme-account-preferences">

                            <?php

                            $i      = 0;

                            $result = $db->query( "SELECT * FROM faqs WHERE active = 1 ORDER BY so ASC" );

                            while ( $row = mysqli_fetch_assoc( $result ) )

                            {

                                $i ++;

                                ?>

                                <div class="theme-account-preferences-item">

                                    <div class="row">

                                        <div class="col-md-10 ">

                                            <a class="" href="#faq<?php echo $i; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="faq">

                                                <p class="theme-account-preferences-item-value faq-ques black-text"><?php echo $row['question']; ?></p></a>

                                            <div class="collapse" id="faq<?php echo $i; ?>">

                                                <div class="theme-account-preferences-item-change">

                                                    <div class="row">

                                                        <div class="col-md-12 faq-ans">

                                                            <p class="theme-account-preferences-item-value ">

                                                                <?php echo $row['answer']; ?>

                                                            </p>

                                                        </div>



                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2 ">

                                            <a class="theme-account-preferences-item-change-link" href="#faq<?php echo $i; ?>" data-toggle="collapse" aria-expanded="false" aria-controls="faq"> <i class="fa fa-chevron-down"></i> </a>

                                        </div>

                                    </div>

                                </div>

                            <?php } ?>





                        </div>

                    </div>





                    <!-- <div class="col-md-4 ">

                        <div class="sticky-col">





                            <div class="theme-sidebar-section _mb-10">

                                <ul class="theme-sidebar-section-features-list"><?php

                                    $pageID = '11';

                                    $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );

                                    $row    = mysqli_fetch_assoc( $result );

                                    ?>

                                    <li>

                                        <h4><?php echo $row['pageTitle']; ?></h4>

                                        <h5 class="theme-sidebar-section-features-list-title"><?php echo $row['subTitle'] ?></h5>



                                            <?php echo $row['summary']; ?>

                                        <br/> <a class="btn btn-primary-invert btn-shadow text-upcase theme-footer-subscribe-btn" id="link-btn" href="/about"> About Us </a>

                                    </li>



                                </ul>

                            </div>

                        </div>

                    </div> -->





                </div>

            </div>

        </div>

    </div>

</div>