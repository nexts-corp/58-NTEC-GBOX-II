<?php
require(dirname(__FILE__)."/../config.php");

$action = GetFromBrowser("action", "");

$username = GetFromBrowser("username", "");
$password = GetFromBrowser("password", "");
$email = GetFromBrowser("email", "");

$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME,$link);
mysql_query("SET NAMES 'utf8'");

$value = array("data" => array());
if($action == "login"){
    $password = md5($password.MOD_PASSWORD);

    $sql = "SELECT * FROM user WHERE username='".$username."' AND password='".$password."'";
    $res = mysql_query($sql, $link);
    $data = mysql_fetch_array($res);

    $sql_role = "SELECT * FROM lk_role WHERE id='".$data['role_id']."'";
    $res_role = mysql_query($sql_role, $link);
    $data_role = mysql_fetch_array($res_role);

    if(isset($data["username"])){
        setcookie("gbox[username]", $data["username"], time() + (10 * 365 * 24 * 60 * 60), "/"); // 10 year
        setcookie("gbox[name]", $data["firstname"]." ".$data["lastname"], time() + (10 * 365 * 24 * 60 * 60), "/"); // 10 year
        setcookie("gbox[role]", $data_role["role_en"], time() + (10 * 365 * 24 * 60 * 60), "/"); // 10 year
        $sub = array(
            "status" => "Success",
            "role" => $data_role["role_en"]
        );
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => "Username/Password ไม่ถูกต้อง"
        );
    }
    array_push($value["data"], $sub);
}

if($action == "send_password"){
    $sql = "SELECT * FROM user WHERE username='".$username."' AND email='".$email."'";
    $res = mysql_query($sql, $link);
    $data = mysql_fetch_array($res);

    if($data["username"] != ""){
        $password_rand = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 6);
        $sql2 = "UPDATE user SET password='".md5($password_rand.MOD_PASSWORD)."' WHERE username='".$data["username"]."'";
        $res2 = mysql_query($sql2, $link);

        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
        $headers .= "FROM: Administrator <gbox.admin@gmail.com>" . "\r\n";
        $subject = 'GBOX Change Password';

        $to = $data["email"];

        $message = '<!DOCTYPE html>'
                    .'<body>'
                        .'<p>เพื่อความปลอดภัยในการใช้งาน กรุณา Login เข้าสู่ระบบ แล้วทำการเปลี่ยนรหัสผ่านใหม่ด้วยตัวท่านเองอีกครั้ง</p>'
                        .'<p>'
                            .'<b>Username</b> : '.$data["username"].'<br>'
                            .'<b>รหัสผ่าน</b> : '.$password_rand
                        .'</p>'
                        .'<p>'
                            .'กดที่ Link นี้ เพื่อ Login และเปลี่ยนรหัสผ่านอีกครั้ง'
                            .'&nbsp;&nbsp;&nbsp;<a href="http://202.44.34.67/gbox2/login.php">ระบบ GBox</a>'
                        .'</p>'
                    .'</body>'
                .'</html>';

        if(mail($to, $subject, $message, $headers)){
            $sub = array(
                "status" => "Success"
            );
        }
        else{
            $sub = array(
                "status" => "Fail",
                "message" => "ไม่สามารถส่ง Email ได้"
            );
        }
    }
    else{
        $sub = array(
            "status" => "Fail",
            "message" => "Username/Email ไม่ถูกต้อง"
        );
    }
    array_push($value["data"], $sub);
}

if($action == "logout"){
    if(isset($_COOKIE["gbox"]["username"])) {
        setcookie("gbox[username]", "", time() - 3600, "/"); // empty value and old timestamp
        unset($_COOKIE["gbox"]["username"]);
    }
    if(isset($_COOKIE["gbox"]["name"])) {
        setcookie("gbox[name]", "", time() - 3600, "/"); // empty value and old timestamp
        unset($_COOKIE["gbox"]["name"]);
    }
    if(isset($_COOKIE["gbox"]["role"])) {
        setcookie("gbox[role]", "", time() - 3600, "/"); // empty value and old timestamp
        unset($_COOKIE["gbox"]["role"]);
    }
}

mysql_close($link);

$json = json_encode($value);

header("Content-Type: application/json");
echo $json;
?>