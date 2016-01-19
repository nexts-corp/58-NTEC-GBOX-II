<?php
error_reporting(E_ERROR);
require(dirname(__FILE__)."/config.php");

if($_COOKIE["gbox"]["role"] == ""){
?>
<!DOCTYPE html>
<html>
<head>
<title>Mini GBox</title>
    <link rel="stylesheet" type="text/css" href="css/design.css" />
    <link rel="stylesheet" type="text/css" href="jquery-ui/development-bundle/themes/redmond/jquery.ui.all.css">

    <script src="jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="javascript/login.js"></script>
</head>

<body>

<form class="login" onsubmit="return false;">
    <h1>GBox</h1>
    <fieldset class="inputs-login" style="border: 0;">
        <input id="username" name="username" type="text" placeholder="Username" autofocus required>
        <input id="password" name="password" type="password" placeholder="Password" required>
    </fieldset>
    <div id="messageError" style="width: 100%; text-align: center; font-weight: bolder; color: white">&nbsp;</div>
    <fieldset class="actions" style="border: 0;">
        <!--<button class="button" onclick="javascript: getLogin();">Log in</button>-->
        <button class="simple" onclick="javascript: login();">Log in</button>
        <!--<span class="simple" > <a href="javascript: getLogin();">Log In</a> </span>-->
        <a class="forget" href="#" onclick="javascript: forgetPassword();">ลืมรหัสผ่าน?</a><!--<a href="">Register</a>-->
    </fieldset>
</form>
<div id="dialogLogin"></div>
</body>
</html>
<?php
}
else{
    if($_COOKIE["gbox"]["role"] == ADMINISTRATOR){
        header("Location: index_admin.php");
    }
    else if($_COOKIE["gbox"]["role"] == SUPERUSER){
        header("Location: index_superuser.php");
    }
    else if($_COOKIE["gbox"]["role"] == USER){
        header("Location: index_user.php");
    }
}
?>