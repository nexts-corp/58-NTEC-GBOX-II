<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");

$device_id = GetFromBrowser("device_id", "");
$user_id = GetFromBrowser("user_id", "");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME, $link);
mysql_query("SET NAMES 'utf8'");

$value = array();

if($action == "show_role"){
    $value["device"] = array();
    $value["user"] = array();
    $value["role"] = array();

    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql_dev = "SELECT * FROM device ORDER BY device_desc ASC";
        $sql_user = "SELECT * FROM user WHERE role_id!='3' ORDER BY firstname, lastname ASC";
    }
    else if($_COOKIE["gbox"]["role"] == SUPERUSER){
        $sql_id = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
        $res_id = mysql_query($sql_id, $link);
        $data_id = mysql_fetch_array($res_id);

        $sql_dev = "SELECT device.* FROM device INNER JOIN device_user ON device.id=device_user.deviceid WHERE device_user.userid='".$data_id["id"]."' ORDER BY device.device_desc ASC";
        $sql_user = "SELECT * FROM user WHERE superuser='".$_COOKIE["gbox"]["username"]."' ORDER BY firstname, lastname ASC";
    }
    $res_dev = mysql_query($sql_dev, $link);
    while($data_dev = mysql_fetch_array($res_dev)){
        $sub = array(
            "device_id" => $data_dev["id"],
            "device_desc" => $data_dev["device_desc"]
        );
        array_push($value["device"], $sub);
    }

    $res_user = mysql_query($sql_user, $link);
    while($data_user = mysql_fetch_array($res_user)){
        $sub = array(
            "user_id" => $data_user["id"],
            "firstname" => $data_user["firstname"],
            "lastname" => $data_user["lastname"],
        );
        array_push($value["user"], $sub);
    }

    $sql_role = "SELECT * FROM device_user ORDER BY deviceid, userid ASC";
    $res_role = mysql_query($sql_role, $link);
    while($data_role = mysql_fetch_array($res_role)){
        $sub = array(
            "device_id" => $data_role["deviceid"],
            "user_id" => $data_role["userid"]
        );
        array_push($value["role"], $sub);
    }
}

if($action == "add_role"){
    $value["data"] = array();

    $sql = "INSERT INTO device_user(deviceid, userid) VALUES('".$device_id."', '".$user_id."')";
    if($res = mysql_query($sql, $link)){
        $sub = array(
            "status" => "Success"
        );
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => mysql_error()
        );
    }
    array_push($value["data"], $sub);
}

if($action == "delete_role"){
    $value["data"] = array();

    $sql = "DELETE FROM device_user WHERE deviceid='".$device_id."' AND userid='".$user_id."'";
    if($res = mysql_query($sql, $link)){
        $sub = array(
            "status" => "Success"
        );
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => mysql_error()
        );
    }
    array_push($value["data"], $sub);
}
mysql_close($link);

$json = json_encode($value);

header("Content-Type: application/json");
echo $json;
?>