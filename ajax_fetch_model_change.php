<?php include "inc_opendb.php";

//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );
$makeID  = filter_var( $_POST['makeID'], FILTER_SANITIZE_STRING );
$modelID = filter_var( $_POST['modelID'], FILTER_SANITIZE_STRING );

//echo "<pre>";
//echo print_r($_GET);
//echo "</pre>";

if ( ! empty( $makeID ) )
{
    $res = $db->query("select * from mtr_model where makeID = ?i and active = 1  ORDER BY so ASC", $makeID);
	if ( $modelID <> 0 )
	{
		$res = $db->query( "SELECT * FROM mtr_bodytype WHERE bodyTypeID IN (SELECT DISTINCT bodyTypeID FROM view_used_cars WHERE makeID = ?s and modelID = ?s and active = 1 ) ORDER BY so ASC", $makeID, $modelID );
	} else
	{
		$res = $db->query( "SELECT * FROM mtr_bodytype WHERE bodyTypeID IN (SELECT DISTINCT bodyTypeID FROM view_used_cars WHERE makeID = ?s  and active = 1 ) ORDER BY so ASC", $makeID);
	}
    ?>
    <option value="0">All</option>
    <?php
    while ( $row = mysqli_fetch_assoc( $res ) )
    {
        ?>
        <option value="<?php echo $row['bodyTypeID']; ?>"><?php echo $row['bodytype']; ?></option>
        <?php
    }

    ?>|<?php

    if($modelID <> 0)
        $res = $db->query( "SELECT DISTINCT `yearID` FROM view_used_cars WHERE makeID = ?s and modelID = ?s and active = 1 ORDER BY year DESC", $makeID, $modelID );
    else
        $res = $db->query( "SELECT DISTINCT `yearID` FROM view_used_cars WHERE makeID = ?s  and active = 1 ORDER BY year DESC", $makeID );

    ?>
    <option value="0">All</option>
    <?php
    while ( $row = mysqli_fetch_assoc( $res ) )
    {
        ?>
        <option value="<?php echo $row['yearID']; ?>"><?php echo getYearFromID($row['yearID']); ?></option>
        <?php
    }
}