<?php
error_reporting(0);

if($_COOKIE["gbox"]["codeSuperuser"] == 1){
    setcookie("gbox[codeSuperuser]", "", 0, "/");
    unset($_COOKIE["gbox"]["codeSuperuser"]);

    header("Cache-Control: no-store, no-cache");
    header("Content-type: text/javascript");

    echo file_get_contents("globalFunction.js").";";
    echo file_get_contents("init.js").";";
    echo file_get_contents("login.js").";";
    echo file_get_contents("profile.js").";";
    echo file_get_contents("user.js").";";
    echo file_get_contents("userRoles.js").";";
    echo file_get_contents("selectPage.js").";";
    echo file_get_contents("importDG200.js").";";
    echo file_get_contents("importDLT.js").";";
    echo file_get_contents("importRV3D.js").";";
    echo file_get_contents("exportGBox.js").";";
}
?>