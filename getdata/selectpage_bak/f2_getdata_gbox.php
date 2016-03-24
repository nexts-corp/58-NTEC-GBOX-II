<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>


<?php
$deviceid = $_GET["deviceid"];
$date1 = $_GET["date1"];
$time1 = $_GET["time1"];
$time2 = $_GET["time2"];

$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysqli_select_db(DB_NAME,$link);
mysqli_query("SET NAMES 'utf8'");

$sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
$res_user = mysqli_query($sql_user, $link);
$data_user = mysqli_fetch_array($res_user);

$selectT = $data_user["firstname"]." ".$data_user["lastname"];
//$id = $deviceid;
//$Date1 = $date1;
$time1 = date('H:i:s', mktime(substr($time1, 0, 2), substr($time1, 3, 2), 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)));
$time2 = date('H:i:s', mktime(substr($time2, 0, 2), substr($time2, 3, 2), 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)));

$sql_dev = "SELECT * FROM device WHERE id='".$_GET["deviceid"]."'";
$res_dev = mysqli_query($sql_dev, $link);
$data_dev = mysqli_fetch_array($res_dev);

if($data_dev["device_type_id"] == "1"){ //GBox
    $unix_time1 = mktime(substr($time1, 0, 2), substr($time1, 3, 2), 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)) - date("Z");
    $unix_time2 = mktime(substr($time2, 0, 2), substr($time2, 3, 2), 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)) - date("Z");

    $sql = "SELECT * FROM data WHERE deviceid='".$deviceid."' AND time>='".$unix_time1."' AND time<='".$unix_time2."' ORDER BY time ASC";
}
else if($data_dev["device_type_id"] == "2"){ //DG200
    $Datetime = date("Y-m-d", mktime(0, 0, 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)));

    $sql = "SELECT * FROM datadg200 WHERE deviceid='".$deviceid."' AND date='".$Datetime."' AND time>='".$time1."' AND time<='".$time2."' ORDER BY time ASC";
}
else if($data_dev["device_type_id"] == "3"){ //DLT
    $Datetime = date("Y-m-d", mktime(0, 0, 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)));

    $sql = "SELECT * FROM datadlt01 WHERE deviceid='".$deviceid."' AND date='".$Datetime."' AND time>='".$time1."' AND time<='".$time2."' ORDER BY time ASC";
}
else if($data_dev["device_type_id"] == "4"){ //RV3D
    $Datetime = date("Y-m-d", mktime(0, 0, 0, substr($date1, 3, 2), substr($date1, 0, 2), substr($date1, 6, 4)));

    $sql = "SELECT * FROM datarv3d WHERE deviceid='".$deviceid."' AND date='".$Datetime."' AND time>='".$time1."' AND time<='".$time2."' ORDER BY time ASC";
}
//print $sql;
$res = mysqli_query($sql, $link);
$i = 0;
$speed_max=0;
while($data = mysqli_fetch_array($res)){
    if($data_dev["device_type_id"] == "1") $time = date('H:i:s', $data['time'] + date("Z"));
    else $time = $data["time"];

    if($data['adc1'] == null) $data['adc1'] = "";
    if($data['adc2'] == null || $data['adc2'] == "") $data['adc2'] = "";

    $speed_i[$i] = $data['speed'];
    if ($speed_i[$i]>= $speed_max) {
        $speed_max = $speed_i[$i];
    }
    $time_i[$i] = $time;
    $lat_i[$i] = $data['latitude'];
    $lon_i[$i] = $data['longitude'];
    $dir_i[$i] = $data['direction'];
    $alt_i[$i] = $data['altitude'];
    $adc1_i[$i] = $data['adc1'];
    $adc2_i[$i] = $data['adc1'];

    if ($i==5) {$lat_begin = $lat_i[$i]; $lon_begin = $lon_i[$i];}
    else {$lat_end = $lat_i[$i]; $lon_end = $lon_i[$i];}

    //print $i."-".$speed_i[$i];
    $i++;
}
$num_rows = $i;
mysqli_close($link);

?>
</BODY>
</HTML>
