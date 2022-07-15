<?php include "inc_opendb.php";


$makeID = filter_var($_POST['makeID'], FILTER_SANITIZE_STRING);
//if(!empty($makeID))
//{
//    $res = $db->query("SELECT * FROM mtr_model WHERE modelID IN (SELECT DISTINCT modelID FROM lease_cars WHERE makeID = ?s and active = 1 ) ORDER BY so ASC", $makeID);
//    ?>
<!--    <option value="0">All</option>-->
<!--    --><?php
//    while($row=mysqli_fetch_assoc($res))
//    {
//        ?>
<!--        <option value="--><?php //echo $row['modelID']; ?><!--">--><?php //echo $row['model']; ?><!--</option>-->
<!--        --><?php
//    }
//
//}

if(empty($makeID))
{
    $res = $db->query("SELECT * FROM mtr_model WHERE modelID IN (SELECT DISTINCT modelID FROM lease_cars WHERE active = 1 ) ORDER BY so ASC");
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['modelID']; ?>"><?php echo $row['model']; ?></option>
        <?php
    }

}
else{

    $res = $db->query("SELECT * FROM mtr_model WHERE modelID IN (SELECT DISTINCT modelID FROM lease_cars WHERE makeID = ?s and active = 1 ) ORDER BY so ASC", $makeID);
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['modelID']; ?>"><?php echo $row['model']; ?></option>
        <?php
    }
}
