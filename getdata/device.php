<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");
$device_id = GetFromBrowser("device_id", "");
$device_serial = GetFromBrowser("device_serial", "");
$device_desc = GetFromBrowser("device_desc", "");
$device_car = GetFromBrowser("device_car", "");
$car_type_id = GetFromBrowser("car_type_id", "");
$device_type_id = GetFromBrowser("device_type_id", "");

$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysqli_select_db(DB_NAME, $link);
mysqli_query("SET NAMES 'utf8'");

$value = array("data" => array());
if($action == "show"){
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql = "SELECT * FROM device ORDER BY device_desc ASC";
    }
    else{
        $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
        $res_user = mysqli_query($sql_user, $link);
        $data_user = mysqli_fetch_array($res_user);

        $sql = "SELECT device.* FROM device INNER JOIN device_user ON device.id=device_user.deviceid WHERE device_user.userid='".$data_user["id"]."' ORDER BY device.device_desc ASC";
    }
    $res = mysqli_query($sql, $link);
    while($data = mysqli_fetch_array($res)){
        $sql_car = "SELECT * FROM lk_car_type WHERE id='".$data["car_type_id"]."'";
        $res_car = mysqli_query($sql_car, $link);
        $data_car = mysqli_fetch_array($res_car);

        $sql_type = "SELECT * FROM lk_device_type WHERE id='".$data["device_type_id"]."'";
        $res_type = mysqli_query($sql_type, $link);
        $data_type = mysqli_fetch_array($res_type);

        $sub = array(
            "device_id" => $data["id"],
            "device_serial" => $data["device_serial"],
            "device_desc" => $data["device_desc"],
            "device_car" => $data["device_car"],
            "car_type" => $data_car["car_type"],
            "device_type" => $data_type["device_type"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "select"){
    $sql = "SELECT * FROM device WHERE id='".$device_id."'";
    $res = mysqli_query($sql, $link);
    while($data = mysqli_fetch_array($res)){
        $sub = array(
            "device_id" => $data["id"],
            "device_serial" => $data["device_serial"],
            "device_desc" => $data["device_desc"],
            "device_car" => $data["device_car"],
            "car_type_id" => $data["car_type_id"],
            "device_type_id" => $data["device_type_id"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "get_device_type"){
    $sql = "SELECT  * FROM lk_device_type ORDER BY id ASC";
    $res = mysqli_query($sql, $link);
    while($data = mysqli_fetch_array($res)){
        $sub = array(
            "device_type_id" => $data["id"],
            "device_type" => $data["device_type"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "get_car_type"){
    $sql = "SELECT * FROM lk_car_type ORDER BY id ASC";
    $res = mysqli_query($sql, $link);
    while($data = mysqli_fetch_array($res)){
        $sub = array(
            "type_id" => $data["id"],
            "car_type" => $data["car_type"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "insert"){
    $sql_ck = "SELECT  * FROM device WHERE device_serial='".$device_serial."'";
    $res_ck = mysqli_query($sql_ck, $link);
    $data_ck = mysqli_fetch_array($res_ck);

    if($data_ck["device_serial"] == ""){
        $sql = "INSERT INTO device(device_serial, device_desc, username, device_car, car_type_id, device_type_id, datecreated) VALUES('".$device_serial."', '".$device_desc."', '".$_COOKIE["gbox"]["username"]."', '".$device_car."', '".$car_type_id."', '".$device_type_id."', now())";
        if($res = mysqli_query($sql, $link)){
            $sub = array(
                "status" => "Success"
            );
        }
        else{
            $sub = array(
                "status" => "Fail",
                "message" => mysqli_error()
            );
        }
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => "หมายเลขประจำตัวนี้ถูกใช้ไปแล้ว"
        );
    }

    array_push($value["data"], $sub);
}

if($action == "update"){
    $sql = "UPDATE device SET device_desc='".$device_desc."', username='".$_COOKIE["gbox"]["username"]."', device_car='".$device_car."', car_type_id='".$car_type_id."', device_type_id='".$device_type_id."', dateupdated=now() WHERE id='".$device_id."'";
    if($res = mysqli_query($sql, $link)){
        $sub = array(
            "status" => "Success"
        );
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => mysqli_error()
        );
    }

    array_push($value["data"], $sub);
}

if($action == "delete"){
    $sql = "DELETE FROM device WHERE id='".$device_id."'";
    if($res = mysqli_query($sql, $link)){
        $sub = array(
            "status" => "Success"
        );
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => mysqli_error()
        );
    }

    array_push($value["data"], $sub);
}

mysqli_close($link);

$json = json_encode($value);

header("Content-Type: application/json");
echo $json;
?>