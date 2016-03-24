<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");

$device_id = GetFromBrowser("device_id", "");

$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysqli_select_db(DB_NAME, $link);
mysqli_query("SET NAMES 'utf8'");

$value = array("data" => array());

if($action == "get_RV3D"){
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql = "SELECT * FROM device WHERE device_type_id='4'";
    }
    elseif($_COOKIE["gbox"]["role"] == SUPERUSER){
        $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
        $res_user = mysqli_query($sql_user, $link);
        $data_user = mysqli_fetch_array($res_user);

        $sql = "SELECT device.* FROM device INNER JOIN device_user ON device.id=device_user.deviceid WHERE device_user.userid='".$data_user["id"]."' AND device.device_type_id='4'";
    }
    $res = mysqli_query($sql, $link);
    while($data = mysqli_fetch_array($res)){
        $sub = array(
            "device_id" => $data["id"],
            "device_desc" => $data["device_desc"]
        );
        array_push($value["data"], $sub);
    }
}
if($action == "import_RV3D"){
    $i = 0;
    $xml = simplexml_load_file($_FILES["fileRV3D"]["tmp_name"]);
    $folders = $xml -> Document -> Folder;
    foreach ($folders as $folder){
        $placemark = $folder -> Placemark;
        $timestamp = $placemark -> ExtendedData -> Data -> value;
        if($timestamp != ""){
            $point = $placemark -> Point -> coordinates;

            $datetime = explode(" ", $timestamp);
            $date = $datetime[0];
            $time = $datetime[1];

            $gps = explode(",", $point);
            $lng = DECtoDMSLn($gps[0]);
            $lat = DECtoDMSLn($gps[1]);
            $alt = $gps[2];

            $sql_ck = "SELECT COUNT(*) AS num_row FROM datarv3d WHERE deviceid='".$device_id."' AND date=STR_TO_DATE('".$date."', '%Y-%m-%d') AND time='".$time."'";
            $res_ck = mysqli_query($sql_ck, $link);
            $data_ck = mysqli_fetch_array($res_ck);

            if($data_ck["num_row"] == 0){
                $sql = "INSERT INTO datarv3d(deviceid, date, time, latitude, longitude, altitude, speed, adc1, adc2) VALUES('".$device_id."', STR_TO_DATE('".$date."', '%Y-%m-%d'), '".$time."', '".$lat."', '".$lng."', '".$alt."', '0', '0', '0')";
                $res = mysqli_query($sql, $link);
            }
            //print $date." ".$time." ".$lat." ".$lng." ".$alt."<br>";
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

mysqli_close($link);

$json = json_encode($value);

header("Content-Type: application/json");
echo $json;
?>