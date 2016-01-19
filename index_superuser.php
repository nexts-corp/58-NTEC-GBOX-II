<?php
require(dirname(__FILE__)."/config.php");

setcookie("gbox[codeSuperuser]", 1, 0, "/");

if($_COOKIE["gbox"]["role"] == SUPERUSER){
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="tis-620">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini GBox</title>

    <script src="jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="jquery-ui/development-bundle/themes/redmond/jquery.ui.all.css">
    <script type="text/javascript" src="jquery-ui/js/jquery.form.js"></script>


    <link href="css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" type="text/css" href="css/design.css" />

    <script type="text/javascript" src="javascript/bootstrap-datetimepicker.min.js"></script>

    <script language="javascript">
        document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%6A%61%76%61%73%63%72%69%70%74%2F%6A%61%76%61%53%75%70%65%72%75%73%65%72%2E%70%68%70%3F%47%42%4F%58%22%3E%3C%2F%73%63%72%69%70%74%3E%0A%09%09%09"));
    </script>
</head>
<body>
<header>
    <table cellpadding="5" cellspacing="0" style="width:100%;height: 100%;">
        <tr>
            <td valign="middle"width="70%">

            </td>
            <td style="width: 30%; text-align: right;">
                <div style="float: right; margin-right: 20px; line-height:15px;">
                    <div id="name" style="display: inline-block; font-size: 120%; color: #000000; font-weight: bolder; margin-right: 5px;">
                        <?php print $_COOKIE["gbox"]["name"]; ?>
                    </div>
                    <div id="profileOption" style="display: inline-block; position: relative;">
                        <a class="image" href="javascript: void(0);"><img src="images/dropdown.png" style="width: 15px; height: 15px;"/></a>
                        <div id="optionBox" class="option_box" style="display: none;">
                            <ul>
                                <li><a href="javascript: void(0);" onclick="javascript: editProfile();">แก้ไขข้อมูลส่วนตัว</a></li>
                                <li><a href="javascript: void(0);" onclick="javascript: changePassword();">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="javascript: void(0);" onclick="javascript: logout();">ออกจากระบบ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</header>
<div class="navigator-left scrollbar" id="style-1">
    <div class="dark">
        <form action="#">
                <span>
                    <select id="deviceId" name="deviceId" class="search rounded id_search">
                        <option value=""></option>
                    </select>
                </span>
        </form>
    </div>

    <ul class="topnav menu-left-nest" style="margin: 10px;">
        <li style="text-align: left;">
            <div class="dark">
                <div id="datetimepicker" class="input-append date">
                    <input type="text">
                        <span class="add-on">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </span>
                </div>
            </div>

        </li>

        <li style="text-align: left;">
            <div class="dark">
                <ul style="display: flex;padding: 0 0 10px 0;list-style: none;margin: 0 auto;width: 250px">
                    <li>
                        <?php
                        $tm = date("G:i", time());
                        $time = strtotime($tm) - 3600;
                        $startTIME = date('H:i', $time);
                        ?>
                        <div id="time1" class="input-append time">
                            <input data-format="hh:mm:ss" type="text" value="<?php echo $startTIME?>">
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                </span>
                        </div>
                    </li>
                    <li style="width: 50px">
                        <p style="color: #fff;text-align: center;font-weight: bolder">:</p>
                    </li>
                    <li>
                        <div id="time2" class="input-append time">
                            <input data-format="hh:mm:ss" type="text" value="<?php echo $tm?>">
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                </span>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

    <ul class="topnav menu-left-nest" style="margin: 10px;">
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable active" href="#Map">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Map</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Speed">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Speed</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Acceleration">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Acceleration</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Turn">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Turn</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Zone">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Zone</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Score">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Driving Score</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Event">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Event</span>
            </a>
        </li>
    </ul>

    <ul class="topnav menu-left-nest" style="margin: 10px;">
        <li style="text-align: left;">
            <h2>Import Data System</h2>
        </li>

        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#DG">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">DG 200</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#DLT">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">DLT</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#RV3D">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">RV3D</span>
            </a>
        </li>
    </ul>

    <ul class="topnav menu-left-nest" style="margin: 10px;">
        <li style="text-align: left;">
            <h2>Export Data System</h2>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#ExportGBox">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Mini GBox</span>
            </a>
        </li>
    </ul>

    <ul class="topnav menu-left-nest" style="margin: 10px;">
        <li style="text-align: left;">
            <h2>Management System</h2>
        </li>

        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Users">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Users</span>
            </a>
        </li>
        <li style="text-align: left;">
            <a class="tooltip-tip ajax-load tooltipster-disable" href="#Roles">
                <i class="icon-camera"></i>
                <span style="display: inline-block; float: none;">Roles</span>
            </a>
        </li>
    </ul>
</div>
<div class="display" style="position: absolute; left: 25%; width: 75%; height: 100%; overflow: auto;"></div>

<div id="dialogHome"></div>
</body>
</html>
<?php
}
else{
    header("Location: login.php");
}
?>