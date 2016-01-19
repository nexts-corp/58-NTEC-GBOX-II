<?php
error_reporting(0);

if($_COOKIE["gbox"]["codeUser"] == 1){
    setcookie("gbox[codeUser]", "", 0, "/");
    unset($_COOKIE["gbox"]["codeUser"]);

    header("Cache-Control: no-store, no-cache");
    header("Content-type: text/javascript");

    echo file_get_contents("globalFunction.js").";";
    echo file_get_contents("init.js").";";
    echo file_get_contents("login.js").";";
    echo file_get_contents("profile.js").";";
    echo file_get_contents("selectPage.js").";";
    echo file_get_contents("exportGBox.js").";";
}
?>
