<?php


function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


//Get Make
function getMakeFromID($makeID)
{
    global $db;
    $result = $db->query("SELECT make FROM mtr_make WHERE makeID = ?i", $makeID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['make'];
    return $returnString;
}
//Get Model
function getModelFromID($modelID)
{
    global $db;
    $result = $db->query("SELECT model FROM mtr_model WHERE modelID = ?i", $modelID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['model'];
    return $returnString;
}


//Get Year
function getYearFromID($yearID)
{
    global $db;
    $result = $db->query("SELECT `year` FROM mtr_year WHERE yearID = ?i", $yearID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['year'];
    return $returnString;
}

//Get PickupDropLocation
function getLocationFromID($locationID)
{
    global $db;
    $result = $db->query("SELECT `location` FROM pickup_drop_locations WHERE pdLocationID = ?i", $locationID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['location'];
    return $returnString;
}

//Get Car Classes
function getCarClassedFromID($classID)
{
    global $db;
    $result = $db->query("SELECT `carClass` FROM mtr_car_classes WHERE carClassID = ?i", $classID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['carClass'];
    return $returnString;
}

//Get Transmission
function getTransmissionFromID($transmissionID)
{
    global $db;
    $result = $db->query("SELECT `transmission` FROM mtr_transmission WHERE transmissionID = ?i", $transmissionID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['transmission'];
    return $returnString;
}

//Get Body Type
function getBodyTypeFromID($bodytypeID)
{
    global $db;
    $result = $db->query("SELECT bodytype FROM mtr_bodytype WHERE bodyTypeID = ?i", $bodytypeID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['bodytype'];
    return $returnString;
}

//Get Fuel Type
function getFuelTypeFromID($fueltypeID)
{
    global $db;
    $result = $db->query("SELECT fuelType FROM mtr_fuel_type WHERE fuelTypeID = ?i", $fueltypeID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['fuelType'];
    return $returnString;
}

//Get Regional Spec
function getRegionalSpecFromID($regionalspecID)
{
    global $db;
    $result = $db->query("SELECT regionalSpecs FROM mtr_regional_spec WHERE regionalID = ?i", $regionalspecID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['regionalSpecs'];
    return $returnString;
}


//Get Warranty
function getWarrantyFromID($warrantyID)
{
    global $db;
    $result = $db->query("SELECT warrantyName FROM mtr_warranty WHERE warrantyID = ?i", $warrantyID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['warrantyName'];
    return $returnString;
}


//Get Transmission Type
function getTransmissionTypeFromID($transmissionID)
{
    global $db;
    $result = $db->query("SELECT transmission FROM mtr_transmission WHERE transmissionID = ?i", $transmissionID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['transmission'];
    return $returnString;
}

//Get Cylinder
function getCylinderFromID($cylinderID)
{
    global $db;
    $result = $db->query("SELECT cylinder FROM mtr_cylinder WHERE cylinderID = ?i", $cylinderID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['cylinder'];
    return $returnString;
}

function isLoggedIn(){
	if(isset($_SESSION[LOGGED_IN]) && $_SESSION[LOGGED_IN] == true)
		return true;
	else
		return false;
}



function getRentLeaseCarIDFromSlug($slug)
{
	global $db;
	$result = $db->query("SELECT rentLeaseCarID FROM rent_lease_cars WHERE slug = ?s", $slug);
	$row = mysqli_fetch_assoc($result);
	$returnString = $row['rentLeaseCarID'];
	return $returnString;
}



function getPayasyouDriveIDFromSlug($slug)
{
    global $db;
    $result = $db->query("SELECT payDriveCarID FROM pay_as_you_drive WHERE slug = ?s", $slug);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['payDriveCarID'];
    return $returnString;
}


function generateBookingNumberForRentCars(){
	global $db;
	$res = $db->query("SELECT random_num
FROM (
  SELECT FLOOR(RAND() * 99999) AS random_num
) AS numbers_mst_plus_1
WHERE random_num NOT IN (SELECT bookingNumber FROM inb_bookings WHERE bookingNumber IS NOT NULL)
LIMIT 1");

	$row = mysqli_fetch_assoc($res);
	$returnString = $row['random_num'];
	return $returnString;
}


function generateBookingNumberForPayasyouDrive(){
    global $db;
    $res = $db->query("SELECT random_num
FROM (
  SELECT FLOOR(RAND() * 99999) AS random_num
) AS numbers_mst_plus_1
WHERE random_num NOT IN (SELECT bookingNumber FROM inb_bookings WHERE bookingNumber IS NOT NULL)
LIMIT 1");

    $row = mysqli_fetch_assoc($res);
    $returnString = $row['random_num'];
    return $returnString;
}

function getPickupLocationFromID($pdLocationID)
{
    global $db;
    $result = $db->query("SELECT location FROM pickup_drop_locations WHERE pdLocationID = ?s", $pdLocationID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['location'];
    return $returnString;
}

function getNationalityFromID($nationalityID)
{
    global $db;
    $result = $db->query("SELECT nationalityName FROM mtr_nationality WHERE nationalityID = ?s", $nationalityID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['nationalityName'];
    return $returnString;
}

function getCountryFromID($countryID)
{
    global $db;
    $result = $db->query("SELECT countryName FROM mtr_country WHERE countryID = ?s", $countryID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['countryName'];
    return $returnString;
}


function getVehicleNameFromID($rentLeaseCarID)
{
    global $db;
    $result = $db->query("SELECT carTitle FROM rent_lease_cars WHERE rentLeaseCarID = ?s", $rentLeaseCarID);
    $row = mysqli_fetch_assoc($result);
    $returnString = $row['carTitle'];
    return $returnString;
}