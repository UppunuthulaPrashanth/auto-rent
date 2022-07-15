<?php include "inc_opendb.php";

//error_reporting( E_ALL );
//ini_set( 'display_errors', 1 );
$makeID  = filter_var( $_POST['makeID'], FILTER_SANITIZE_STRING );
$modelID = filter_var( $_POST['modelID'], FILTER_SANITIZE_STRING );
$bodytypeID = filter_var( $_POST['bodyTypeID'], FILTER_SANITIZE_STRING );

if ( ! empty( $makeID ) )
{




    $criteriaString = "";

    if($makeID <> 0)
    {
        $criteriaString .= " AND makeID = '" . $makeID .  "' ";
    }

    if($modelID <> 0)
    {
        $criteriaString .= " AND modelID = '" . $modelID .  "' ";
    }

	if($bodytypeID <> 0)
	{
		$criteriaString .= " AND bodyTypeID = '" . $bodytypeID .  "' ";
	}

    $res = $db->query( "SELECT DISTINCT `yearID` FROM view_used_cars WHERE active = 1 $criteriaString ORDER BY year DESC" );
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