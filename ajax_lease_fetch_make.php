<?php include "inc_opendb.php";


$bodyTypeID = filter_var($_POST['bodyTypeID'], FILTER_SANITIZE_STRING);
//if(!empty($bodyTypeID))
//{
//    $res = $db->query("SELECT * FROM mtr_make WHERE makeID IN (SELECT DISTINCT makeID FROM lease_cars WHERE bodyTypeID = ?s and active = 1 ) ORDER BY so ASC", $bodyTypeID);
//    ?>
<!--    <option value="0">All</option>-->
<!--    --><?php
//    while($row=mysqli_fetch_assoc($res))
//    {
//        ?>
<!--        <option value="--><?php //echo $row['makeID']; ?><!--">--><?php //echo $row['make']; ?><!--</option>-->
<!--        --><?php
//    }
//
//}




if(empty($bodyTypeID))
{
    $res = $db->query("SELECT * FROM mtr_make WHERE makeID IN (SELECT DISTINCT makeID FROM lease_cars WHERE active = 1 ) ORDER BY so ASC");
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['makeID']; ?>"><?php echo $row['make']; ?></option>
        <?php
    }

}
else{

    $res = $db->query("SELECT * FROM mtr_make WHERE makeID IN (SELECT DISTINCT makeID FROM lease_cars WHERE bodyTypeID = ?s and active = 1 ) ORDER BY so ASC", $bodyTypeID);
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['makeID']; ?>"><?php echo $row['make']; ?></option>
        <?php
    }
}

