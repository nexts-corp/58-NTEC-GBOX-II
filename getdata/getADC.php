<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");
$start = GetFromBrowser("start", "");
$id = GetFromBrowser("id", "");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME,$link);
mysql_query("SET NAMES 'utf8'");

$value = array("data" => array());

if($action == "countpage"){
    if($id == "all"){
        $sql = "SELECT COUNT(*) AS page FROM data";
    }
    else{
        $sql_dev = "SELECT * FROM device WHERE device_serial='".$id."'";
        $res_dev = mysql_query($sql_dev, $link);
        $data_dev =  mysql_fetch_array($res_dev);

        $sql = "SELECT COUNT(*) AS page FROM data WHERE deviceid='".$data_dev["id"]."'";
    }
    $res = mysql_query($sql, $link);
    $data = mysql_fetch_array($res);

    $page = 0;
    $page = $data["page"] / 100;
    if($data["page"] % 100 != 0) $page += 1;

    for($i = 0; $i < $page; $i++){
        $sub = array(
            "page" => $i+1,
            "start" => ($i * 100) + 1,
            "stop" => ($i + 1) * 100
        );

        array_push($value["data"], $sub);
    }
    $json = json_encode($value);
}

if($action == "showdata"){
    //$sql = "SELECT *, TO_CHAR(timeserver, 'DD-MM-YYYY HH24:MI:SS') AS timeformat FROM data ORDER BY timeserver DESC LIMIT 100 OFFSET ".$start;
    if($id == "all"){
        $sql = "SELECT *, DATE_FORMAT(timeserver,'%d-%m-%Y %H:%i:%s') AS timeformat FROM data ORDER BY time DESC LIMIT 100 OFFSET ".$start;
    }
    else{
        $sql_dev = "SELECT * FROM device WHERE device_serial='".$id."'";
        $res_dev = mysql_query($sql_dev, $link);
        $data_dev =  mysql_fetch_array($res_dev);

        $sql = "SELECT *, DATE_FORMAT(timeserver,'%d-%m-%Y %H:%i:%s') AS timeformat FROM data WHERE deviceid='".$data_dev["id"]."' ORDER BY time DESC LIMIT 100 OFFSET ".$start;
    }
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $time = date('d-m-Y H:i:s', $data['time'] + date("Z"));

        $sql_dev = "SELECT * FROM device WHERE id='".$data['deviceid']."'";
        $res_dev = mysql_query($sql_dev, $link);
        $data_dev = mysql_fetch_array($res_dev);

        if($data['adc1'] == null) $data['adc1'] = "";
        if($data['adc2'] == null || $data['adc2'] == "") $data['adc2'] = "";

        $sub = array(
            "device" => $data_dev['device_desc'],
            "timeGPS" =>  $data['time'],
            "time" => $time,
            "timeserver" => $data['timeformat'],
            "active" => $data['active'],
            "lat" => GPSToGEarth($data['latitude']),
            "lng" => GPSToGEarth($data['longitude']),
            "speed" => $data['speed'],
            "alt" => $data['altitude'],
            "adc1" => $data['adc1'],
            "adc2" => $data['adc2']
        );

        array_push($value["data"], $sub);
    }
    $json = json_encode($value);
}
mysql_close($link);

header('Content-Type: application/json');
echo $json;
?>