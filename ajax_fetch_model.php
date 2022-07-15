<?php include "inc_opendb.php";

//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );
$makeID = filter_var($_POST['id'], FILTER_SANITIZE_STRING);


if(!empty($makeID))
{
//    $res = $db->query("select * from mtr_model where id_make = ?i and active = 1  ORDER BY sortorder ASC", $makeID);
    $res = $db->query("SELECT * FROM mtr_model WHERE modelID IN (SELECT DISTINCT modelID FROM view_used_cars WHERE makeID = ?s and active = 1 ) ORDER BY so ASC", $makeID);
    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['modelID']; ?>"><?php echo $row['model']; ?></option>
        <?php
    }


    ?>|<?php

	$res = $db->query("SELECT * FROM mtr_bodytype WHERE bodyTypeID IN (SELECT DISTINCT bodyTypeID FROM view_used_cars WHERE makeID = ?s and active = 1 ) ORDER BY so ASC", $makeID);
	?>
    	<option value="">All</option>
    	<?php
	while($row=mysqli_fetch_assoc($res))
	{
		?>
    		<option value="<?php echo $row['bodyTypeID']; ?>"><?php echo $row['bodytype']; ?></option>
    		<?php
	}

    ?>|<?php

    $res = $db->query("SELECT DISTINCT `yearID` FROM view_used_cars WHERE makeID = ?s and active = 1 ORDER BY yearID DESC", $makeID);

    ?>
    <option value="">All</option>
    <?php
    while($row=mysqli_fetch_assoc($res))
    {
        ?>
        <option value="<?php echo $row['yearID']; ?>"><?php echo getYearFromID($row['yearID']); ?></option>
        <?php
    }
}

