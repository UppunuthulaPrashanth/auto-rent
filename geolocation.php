<?php
require_once 'vendor/autoload.php';
use GeoIp2\Database\Reader;

echo "<pre>";
print_r($_SERVER);
echo "</pre>";



// This creates the Reader object, which should be reused across
// lookups.
$reader = new Reader(__DIR__ . '/maxmind/GeoLite2-Country.mmdb');

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
//$record = $reader->country('116.12.212.0');
//$record = $reader->country($_SERVER['SERVER_ADDR']);
$_SERVER['REMOTE_ADDR'] = '';
$record = $reader->country($_SERVER['REMOTE_ADDR']);

print($record->country->isoCode . "\n"); // 'US'
echo "<br>";
print($record->country->name . "\n"); // 'United States'
//print($record->country->names['zh-CN'] . "\n"); // '美国'

print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

print($record->city->name . "\n"); // 'Minneapolis'

print($record->postal->code . "\n"); // '55455'

print($record->location->latitude . "\n"); // 44.9733
print($record->location->longitude . "\n"); // -93.2323

print($record->traits->network . "\n"); // '128.101.101.101/32'