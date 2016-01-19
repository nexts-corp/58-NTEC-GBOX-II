<?php
$date = $_GET["date"];

$unixtime = mktime(0, 0, 0,substr($date, 5, 2),substr($date, 8, 2),substr($date, 0, 4))-date('Z');
print $unixtime;
?>