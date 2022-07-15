<?php
$remainingDays = $totalDays;
$aMonths       = 0;
$aWeeks        = 0;
$aDays         = 0;

if($remainingDays >= 30){
	$aMonths = floor($remainingDays/30);
	$remainingDays = $remainingDays - ($aMonths * 30);
}
if($remainingDays >= 7)
{
	$aWeeks = floor($remainingDays/7);
	$remainingDays = $remainingDays - ($aWeeks * 7);
}
$aDays = $remainingDays;


//							echo "months: " . $aMonths;
//							echo "<br>";
//							echo "weeks: " . $aWeeks;
//							echo "<br>";
//							echo "days: " . $aDays;
