<?php 
date_default_timezone_set('Africa/Casablanca');
//$tz = 'Africa/Casablanca';
//$timestamp = time();
//$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
//$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

$date = date('d-m-Y');

$month = date('m');
$day = date('d');
$year = date('Y');


$today = $year . '-' . $month . '-' . $day;

$sevenday = date('Y-m-d', strtotime($today. ' - 7 days'));
$mintoday = date('Y-m-d', strtotime($today. ' - 4 days'));
$yesterday = date("Y-m-d", strtotime("yesterday"));
$moismonth = date('Y-m-d', strtotime($today. ' - 1 months'));
//$moismonth = $year . '-' . $beformonth . '-' . $day;
$dixjourafter = date('Y-m-d', strtotime($today. ' + 10 days'));



?>