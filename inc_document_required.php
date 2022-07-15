<div class="theme-page-section theme-page-section-xl">
    <div class="container _pv-40">
        <div class="_mob-h">
            <div class="theme-page-section-header">

                <?php
                $pageID = '32';
                $result = $db->query( "SELECT * FROM pages_static WHERE pageID = ?s", $pageID );
                $row    = mysqli_fetch_assoc( $result );
                ?>

                <h5 class="theme-page-section-title title-blue"><?php echo $row['pageTitle']; ?></h5>
                <?php echo $row['summary']; ?>

            </div>

            <?php

            $documentResult = $db->query("SELECT * FROM home_document_required WHERE active = 1 ORDER BY so ASC");

            while ($documentRow = mysqli_fetch_assoc($documentResult)) {

                ?>

                <div class="col-md-6">
                    <div class="theme-search-results-item _mb-10 theme-search-results-item-">
                        <div class="theme-search-results-item-preview">
                            <a class="theme-search-results-item-mask-link"></a>
                            <div class="row" data-gutter="20">
                                <div class="col-md-6 ">
                                    <div class="theme-search-results-item-img-wrap">
                                        <img class="theme-search-results-item-img" src="uploads/pages/<?php echo $documentRow['image']?>" alt="<?php echo $documentRow['title']?>" title="<?php echo $documentRow['title']?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="theme-search-results-item-title theme-search-results-item-title-lg"><?php echo $documentRow['title']?></h5>
                                    <?php echo $documentRow['description']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>