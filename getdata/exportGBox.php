<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");

$device_id = GetFromBrowser("device_id", "");
$type = GetFromBrowser("type", "");
$date = GetFromBrowser("date", "");
$time1 = GetFromBrowser("time1", "");
$time2 = GetFromBrowser("time2", "");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME, $link);
mysql_query("SET NAMES 'utf8'");

if($action == "get_GBox"){
    $value = array("data" => array());

    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql = "SELECT * FROM device WHERE device_type_id='1'";
    }
    elseif($_COOKIE["gbox"]["role"] == SUPERUSER || $_COOKIE["gbox"]["role"] == USER){
        $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
        $res_user = mysql_query($sql_user, $link);
        $data_user = mysql_fetch_array($res_user);

        $sql = "SELECT device.* FROM device INNER JOIN device_user ON device.id=device_user.deviceid WHERE device_user.userid='".$data_user["id"]."' AND device.device_type_id='1'";
    }
//print $sql;
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $sub = array(
            "device_id" => $data["id"],
            "device_desc" => $data["device_desc"]
        );
        array_push($value["data"], $sub);
    }

    $json = json_encode($value);

    header("Content-Type: application/json");
    echo $json;
}
if($action == "export_GBox"){
    $unix_time1 = mktime(substr($time1, 0, 2), substr($time1, 3, 2), 0, substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)) - date("Z");
    $unix_time2 = mktime(substr($time2, 0, 2), substr($time2, 3, 2), 59, substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)) - date("Z");

    $sql_name = "SELECT * FROM device WHERE id='".$device_id."'";
    $res_name = mysql_query($sql_name, $link);
    $data_name = mysql_fetch_array($res_name);

    $value = "id,date,time,lat,lon,speed,direction,altitude,adc1,adc2\r\n";
    $sql = "SELECT * FROM data WHERE deviceid='".$device_id."' AND time>='".$unix_time1."' AND time<='".$unix_time2."' ORDER BY time ASC";
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $unit_time = explode(" ", date("d-m-Y H:i:s", $data["time"] + date("Z")));
        $value .= $data_name["device_desc"].",".$unit_time[0].",".$unit_time[1].",".GPSToGEarth($data["latitude"]).",".GPSToGEarth($data["longitude"]).",".$data["speed"].",".$data["direction"].",".$data["altitude"].",".$data["adc1"].",".$data["adc2"]."\r\n";
    }
    header("Content-type: text/".$type);
    header("Content-Disposition: attachment; filename=".$data_name["device_desc"]."_".str_replace("/", "-", $date).".".$type);
    header("Pragma: no-cache");
    header("Expires: 0");

    echo $value;
}

mysql_close($link);


?>