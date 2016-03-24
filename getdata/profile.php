<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");

$firstname = GetFromBrowser("firstname", "");
$lastname = GetFromBrowser("lastname", "");
$email = GetFromBrowser("email", "");
$address = GetFromBrowser("address", "");
$telephone = GetFromBrowser("telephone", "");

$password_old = GetFromBrowser("password_old", "");
$password_new = GetFromBrowser("password_new", "");

$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysqli_select_db(DB_NAME, $link);
mysqli_query("SET NAMES 'utf8'");

$value = array("data" => array());

if($action == "show_profile"){
    $sql = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
    $res = mysqli_query($sql, $link);
    while($data = mysqli_fetch_array($res)){
        $sub = array(
            "firstname" => $data["firstname"],
            "lastname" => $data["lastname"],
            "username" => $data["username"],
            "email" => $data["email"],
            "address" => $data["address"],
            "telephone" => $data["telephone"]
        );
        array_push($value["data"], $sub);
    }
}

if($action == "save_profile"){
    $sql = "UPDATE user SET firstname='".$firstname."', lastname='".$lastname."', email='".$email."', address='".$address."', telephone='".$telephone."' WHERE username='".$_COOKIE["gbox"]["username"]."'";
    if($res = mysqli_query($sql, $link)){
        setcookie("gbox[name]", $firstname." ".$lastname, time() + (10 * 365 * 24 * 60 * 60), "/"); // 10 year
        $sub = array(
            "status" => "success"
        );
    }
    else{
        $sub = array(
            "status" => "fail",
            "message" => mysqli_error()
        );
    }

    array_push($value["data"], $sub);
}

if($action == "change_password"){
    $sql = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."' AND password='".md5($password_old.MOD_PASSWORD)."'";
    $res = mysqli_query($sql, $link);
    if($data = mysqli_fetch_array($res)){
        $sql2 = "UPDATE user SET password='".md5($password_new.MOD_PASSWORD)."' WHERE username='".$_COOKIE["gbox"]["username"]."'";
        if($res2 = mysqli_query($sql2, $link)){
            $sub = array(
                "status" => "success"
            );
        }
        else{
            $sub = array(
                "status" => "fail",
                "message" => mysqli_error()
            );
        }
    }
    else{
        $sub = array(
            "status" => "fail",
            "message" => "รหัสผ่านไม่ถูกต้อง"
        );
    }


    array_push($value["data"], $sub);
}

mysqli_close($link);

$json = json_encode($value);

header("Content-Type: application/json");
echo $json;
?>