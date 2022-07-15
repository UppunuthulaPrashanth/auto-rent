<?php
require '../lib/config/config.php';
require '../lib/config/autoload.php';

$cname = $_POST['cname'];

$val = "";

$loc = new dbcountrylocation;
$result = $loc->fetch_Countrybyname($cname);
if ($result) {
	$result2 = $loc->fetch_Locations_ById($result['id']);
}

while ($row = $result2->fetch()) {
	$val .= "<li>" . $row['name'] . "</li>";
}
echo $val;
?>