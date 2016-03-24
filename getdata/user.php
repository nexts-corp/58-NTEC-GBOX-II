<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");
$user_id = GetFromBrowser("user_id", "");
$firstname = GetFromBrowser("firstname", "");
$lastname = GetFromBrowser("lastname", "");
$username = GetFromBrowser("username", "");
$password = GetFromBrowser("password", "");
$email = GetFromBrowser("email", "");
$address = GetFromBrowser("address", "");
$telephone = GetFromBrowser("telephone", "");
$role_id = GetFromBrowser("role_id", "");
$superuser = GetFromBrowser("superuser", "");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME, $link);
mysql_query("SET NAMES 'utf8'");

$value = array("data" => array());
if($action == "show"){
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql = "SELECT user.*, lk_role.role_th FROM user INNER JOIN lk_role ON user.role_id=lk_role.id ORDER BY user.role_id DESC, user.superuser, user.firstname ASC";
    }
    else if($_COOKIE["gbox"]["role"] == SUPERUSER){
        $sql = "SELECT user.*, lk_role.role_th FROM user INNER JOIN lk_role ON user.role_id=lk_role.id WHERE user.superuser='".$_COOKIE["gbox"]["username"]."' ORDER BY user.firstname ASC";
    }
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $superuser = "";
        if($data["superuser"] != ""){
            $sql_user = "SELECT  * FROM user WHERE username='".$data["superuser"]."'";
            $res_user = mysql_query($sql_user, $link);
            $data_user = mysql_fetch_array($res_user);

            $superuser = $data_user["firstname"]." ".$data_user["lastname"];
        }
        $sub = array(
            "user_id" => $data["id"],
            "firstname" => $data["firstname"],
            "lastname" => $data["lastname"],
            "username" => $data["username"],
            "email" => $data["email"],
            "address" => $data["address"],
            "telephone" => $data["telephone"],
            "role" => $data["role_th"],
            "superuser" => $superuser
        );
        array_push($value["data"], $sub);
    }
}

if($action == "select"){
    $sql = "SELECT * FROM user WHERE id='".$user_id."'";
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $sub = array(
            "user_id" => $data["id"],
            "firstname" => $data["firstname"],
            "lastname" => $data["lastname"],
            "username" => $data["username"],
            "email" => $data["email"],
            "address" => $data["address"],
            "telephone" => $data["telephone"],
            "role" => $data["role_id"],
            "superuser" => $data["superuser"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "get_role"){
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sql = "SELECT * FROM lk_role WHERE role_en!='".ADMINISTRATOR."' ORDER BY id ASC";
    }
    else if($_COOKIE["gbox"]["role"] == SUPERUSER){
        $sql = "SELECT * FROM lk_role WHERE role_en!='".ADMINISTRATOR."' AND role_en!='".SUPERUSER."' ORDER BY id ASC";
    }
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $sub = array(
            "role_id" => $data["id"],
            "role_th" => $data["role_th"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "get_superuser"){
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        $sub = array(
            "username" => "",
            "firstname" => "-",
            "lastname" => ""
        );
        array_push($value["data"], $sub);

        $sql = "SELECT * FROM user WHERE role_id='2' ORDER BY firstname ASC";
    }
    else if($_COOKIE["gbox"]["role"] == SUPERUSER){
        $sql = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
    }
    $res = mysql_query($sql, $link);
    while($data = mysql_fetch_array($res)){
        $sub = array(
            "username" => $data["username"],
            "firstname" => $data["firstname"],
            "lastname" => $data["lastname"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "insert"){
    $sql_ck = "SELECT  * FROM user WHERE username='".$username."'";
    $res_ck = mysql_query($sql_ck, $link);
    $data_ck = mysql_fetch_array($res_ck);

    if($data_ck["username"] == ""){
        $password = md5($password.MOD_PASSWORD);
        $sql = "INSERT INTO user(firstname, lastname, username, password, email, address, telephone, role_id, superuser) VALUES('".$firstname."', '".$lastname."', '".$username."', '".$password."', '".$email."', '".$address."', '".$telephone."', '".$role_id."', '".$superuser."')";
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
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => "Username นี้ถูกใช้ไปแล้ว"
        );
    }
    array_push($value["data"], $sub);
}

if($action == "update"){
    $sql = "UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."', address='".$address."', telephone='".$telephone."', role_id='".$role_id."', superuser='".$superuser."' WHERE id='".$user_id."'";
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

if($action == "delete"){
    $sql = "DELETE FROM user WHERE id='".$user_id."'";
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