<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");

$device_id = GetFromBrowser("device_id", "");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME, $link);
mysql_query("SET NAMES 'utf8'");

$value = array("data" => array());

if($action == "get_DLT"){
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql = "SELECT * FROM device WHERE device_type_id='3'";
    }
    elseif($_COOKIE["gbox"]["role"] == SUPERUSER){
        $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
        $res_user = mysql_query($sql_user, $link);
        $data_user = mysql_fetch_array($res_user);

        $sql = "SELECT device.* FROM device INNER JOIN device_user ON device.id=device_user.deviceid WHERE device_user.userid='".$data_user["id"]."' AND device.device_type_id='3'";
    }
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $sub = array(
            "device_id" => $data["id"],
            "device_desc" => $data["device_desc"]
        );
        array_push($value["data"], $sub);
    }
}
if($action == "import_DLT"){
    $objCSV = fopen($_FILES["fileDLT"]["tmp_name"], "r");

    $i = 0;
    while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
        if($objArr[0] != "version" && $objArr[0] != ""){
            $datetime = explode("-", $objArr[4]);
            $date = $datetime[0];
            $time = $datetime[1];
            $lat = DECtoDMSLn($objArr[5]);
            $lng = DECtoDMSLn($objArr[6]);
            $alt = $objArr[7];
            $speed = $objArr[8];
            $direction = $objArr[9];

            //print $objArr[0]." ".$objArr[1]." ".$objArr[2]." ".$objArr[3]." ".$objArr[4]." ".$objArr[5]."<br>"; // Date, Time, Longitude, Latitude, Altitude, Speed
            $sql_ck = "SELECT COUNT(*) AS num_row FROM datadlt01 WHERE deviceid='".$device_id."' AND date=STR_TO_DATE('".$date."', '%Y/%m/%d') AND time='".$time."'";
            $res_ck = mysql_query($sql_ck, $link);
            $data_ck = mysql_fetch_array($res_ck);

            if($data_ck["num_row"] == 0){
                $sql = "INSERT INTO datadlt01(deviceid, date, time, latitude, longitude, altitude, speed, direction, adc1, adc2) VALUES('".$device_id."', STR_TO_DATE('".$date."', '%Y/%m/%d'), '".$time."', '".$lat."', '".$lng."', '".$alt."', '".$speed."', '".$direction."', '0', '0')";
                $res = mysql_query($sql, $link);
            }
        }
        $i++;
    }

    if($i > 0){
        $sub = array(
            "status" => "Success",
            "sql" => $sql
        );
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => "ไม่สามารถ Import ข้อมูลได้"
        );
    }
    array_push($value["data"], $sub);

    fclose($objCSV);
}

mysql_close($link);

$json = json_encode($value);

header("Content-Type: application/json");
echo $json;
?>