<?php
require(dirname(__FILE__)."/../config.php");

$serial = GetFromBrowser("serial", "");
$start = GetFromBrowser("start", "");
$stop = GetFromBrowser("stop", "");

$start_arr = explode("-", $start);
$stop_arr = explode("-", $stop);

$start_time = mktime(0, 0, 0, $start_arr[1], $start_arr[0], $start_arr[2]) - date("Z");
$stop_time = mktime(0, 0, 0, $stop_arr[1], $stop_arr[0]+1, $stop_arr[2]) - date("Z");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME,$link);
mysql_query("SET NAMES 'utf8'");

// Print the head of the document
$kml  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
$kml .= '<kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom">'."\n";
$kml .= '<Document>'."\n";

// Now iterate over all placemarks (rows)
// Query the database data
$sql_dev = "SELECT * FROM device WHERE device_serial='".$serial."'";
$res_dev = mysql_query($sql_dev, $link);
$data_dev = mysql_fetch_array($res_dev);

$sql = "SELECT * FROM data WHERE deviceid='".$data_dev['id']."' AND time >= '".$start_time."' AND time < '".$stop_time."' ORDER BY time ASC";
$res = mysql_query($sql, $link);
while ($data = mysql_fetch_array($res)) {
    $time = date('d-m-Y H:i:s', $data['time'] + date("Z"));
    //print '<alt>'.$data['alt'].'</alt>'."<br>";
    $kml .= '<Placemark>'."\n";
    $kml .= '<name>'.$data_dev['device_serial'].'</name>'."\n";
    $kml .= '<time>'.$time.'</time>'."\n";
    $kml .= '<active>'.$data['active'].'</active>'."\n";
    $kml .= '<speed>'.$data['speed'].'</speed>'."\n";
    $kml .= '<alt>'.$data['altitude'].'</alt>'."\n";
    $kml .= '<direction>'.$data['direction'].'</direction>'."\n";
    $kml .= '<adc1>'.$data['adc1'].'</adc1>'."\n";
    $kml .= '<adc2>'.$data['adc2'].'</adc2>'."\n";
    $kml .= '<Point>'."\n";
    $kml .= '<coordinates>'.GPSToGEarth($data['longitude']).' , '.GPSToGEarth($data['latitude']).'</coordinates>'."\n";
    $kml .= '</Point>'."\n";
    $kml .= '</Placemark>'."\n";
};

$kml .= '</Document>'."\n";
$kml .= '</kml>'."\n";

mysql_close($link);

header('Content-type: application/vnd.google-earth.kml+xml');
header('Content-disposition: attachment; filename="adc_'.$serial.'_'.$start.'_'.$stop.'.kml"');

echo $kml;
?>