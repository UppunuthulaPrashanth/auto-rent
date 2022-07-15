<?php
require '../lib/config/config.php';
require '../lib/config/autoload.php';

$cid = $_POST['cid'];

$val = "";

$loc = new dbcountrylocation;
$result = $loc->fetch_Locations_ById($cid);

$val .= "<option value=''>Drop Location</option>";

while ($row = $result->fetch()) {
	$val .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}
echo $val;
?>