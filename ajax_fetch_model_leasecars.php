<?php include "inc_opendb.php";

$makeID = "";
if(isset($_POST['id']))
{
    $makeID = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
}

$modelID = filter_var($_POST['modelID'], FILTER_SANITIZE_STRING);
$bodyTypeID = "";

if(!empty($makeID))
{
//    $res = $db->query("select * from mtr_model where id_make = ?i and active = 1  ORDER BY sortorder ASC", $makeID);
    $res = $db->query("SELECT * FROM mtr_model WHERE modelID IN (SELECT DISTINCT modelID FROM view_used_cars WHERE makeID = ?s and active = 1 ) ORDER BY so ASC", $makeID);
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        $res1 = $db->query("SELECT * FROM mtr_make WHERE makeID =$makeID ");
         while($row1=mysqli_fetch_assoc($res1)) {
             ?>
             <option value="<?php echo $row['modelID']; ?>"><?php echo $row1['make']; ?> <?php echo $row['model']; ?></option>
             <?php
         }
    }


    ?>|<?php

    $res = $db->query("SELECT * FROM mtr_bodytype WHERE bodyTypeID IN (SELECT DISTINCT bodyTypeID FROM view_used_cars WHERE makeID = ?s and active = 1 ) ORDER BY so ASC", $makeID);
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        $bodyTypeID = $row['bodyTypeID'];
        ?>
        <option value="<?php echo $row['bodyTypeID']; ?>"><?php echo $row['bodytype']; ?></option>

        <?php
    }


    ?>|<?php

    $res = $db->query("SELECT * FROM mtr_term WHERE termID IN (SELECT DISTINCT term FROM view_used_cars WHERE makeID = ?s and bodyTypeID = ?s and active = 1 ) ORDER BY so ASC", $makeID,$bodyTypeID);

//    echo $db->lastQuery();
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['term']; ?>"><?php echo $row['term']; ?></option>
        <?php
    }
}

if(!empty($modelID))
{

    $res = $db->query("SELECT DISTINCT term FROM view_used_cars WHERE modelID = ?s and active = 1", $modelID);
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res)) {

        $term = $row['term'];
//       echo $term;
//       die;
//        $term = str_replace("'", "", $term);

        $res1 = $db->query("SELECT * FROM mtr_term WHERE termID IN ($term)");
        while ($row1 = mysqli_fetch_assoc($res1)) {
//            echo $db->lastQuery();
            ?>
            <option value="<?php echo $row1['term']; ?>"><?php echo $row1['term']; ?></option>
            <?php
        }
    }
}