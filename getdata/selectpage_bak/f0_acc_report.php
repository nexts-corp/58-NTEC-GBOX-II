<?php
error_reporting(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>TATANAD GPS Supervisory Program</title>
</head>
<body style="font-family: Arial;">
    <table style="width: 1010px; height: 17px; text-align: left; margin-left: auto; margin-right: auto;">
        <tbody>
        <tr>
            <td style="vertical-align: middle; text-align: center; height: 13px; width: 179px; background-color: rgb(51, 153, 204);">
                <span style="color: white; font-weight: bold; font-family: tahoma; font-size: small;">
                    Driving Score 2.0 beta
                </span>
            </td>
            <td style="height: 13px; width: 110px;">
                <a href="www.nectec.or.th">
                    <img style="border: 0px solid ; width: 100px; height: 22px;" alt="" src="nectec.png">
                </a>
            </td>
            <td style="background-color: rgb(51, 153, 204); text-align: center; width: 77px; height: 13px;">
                <a style="color: white;" target="_blank" href="www.thairoadsafety.net">
                    <span style="font-weight: bold; font-size: small;">WebSite</span>
                </a>
            </td>
            <td style="width: 626px; text-align: right; background-color: rgb(51, 153, 204); color: white; font-weight: bold; height: 13px; font-size: small;">
                <span>
                    <a style="color: white;" href="f0_routRisk.php" target="_top">Rout Risk</a>
                </span>
                <span>
                    <a style="color: white;" href="f1_integrate.php" target="_blank">Integrate</a>
                </span>
                <span>
                    <a href="f1_speedBehavior.php" style="color: white;" target="_blank">Speed</a>
                </span>
                <span>
                    <a href="f1_accBehavior.php" style="color: white;" target="_blank">Acceleration</a>
                </span>
                <span>
                    Turn
                </span>
                <span>
                    <a style="color: white;" href="f0_Style.php" target="_top">Style</a>
                </span>
            </td>
        </tr>
        </tbody>
    </table>
    <form style="height: 345px;" action="f0_acc_report.php" method="get">
        <input type="hidden" name="deviceid" value="<?php print $_GET["deviceid"]; ?>">
        <input type="hidden" name="date1" value="<?php print $_GET["date1"]; ?>">
        <input type="hidden" name="time1" value="<?php print $_GET["time1"]; ?>">
        <input type="hidden" name="time2" value="<?php print $_GET["time2"]; ?>">

        <table style="background-color: white; width: 1010px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="height: 13px; background-color: white; vertical-align: top; width: 174px; font-size: small;" colspan="3" rowspan="1">
                        <span>
                            <span style="font-weight: bold;">Name : </span>
                        </span>
                        <span>
                            <?php
                            require(dirname(__FILE__)."/../../config.php");

                            $deviceid = $_GET["deviceid"];
                            $Date1 = $_GET["date1"];
                            $time1 = $_GET["time1"];
                            $time2 = $_GET["time2"];

                            $Time1 = $time1;
                            $Time2 = $time2;
                            if($_GET["over_index"] != "") $over_index = $_GET["over_index"];


                            include ("f2_getdata.php");
                            echo "$deviceName";
                            ?>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Date : </span>
                            <?php
                            $DateBegin = $date1;
                            echo "$date1";
                            $datev1 = $date1;
                            $speed_max_new = $speed_max;
                            $dateacc= $date1;
                            ?>
                            <span style="font-weight: bold;">Time : </span>
                        </span>
                        <span>
                            <?php
                            echo "$TimeBegin - $TimeEnd";
                            if (($TimeBegin>="06:00:00") AND ($TimeBegin<="18:00:00")) {
                                echo " <img src='sun.png' width='20' height='20'/>";
                                $daylight="noon";
                            }
                            else {
                                echo " <img src='moon.png' width='20' height='20'/>";
                                $daylight="night";
                            }
                            ?>
                        </span>
                    </td>
                    <td colspan="3" rowspan="1" style="font-size: small; font-family: Arial; height: 13px; text-align: right; background-color: white; vertical-align: top; width: 146px;">
                        <div style="text-align: right;">
                            <span>
                                <?php
                                include("f2_acc_function.php");
                                $g = round(($acc_limit/9.81),2);
                                echo "<b>Acc. limt</b>: $g G";
                                ?>
                            </span>
                            <span>
                                <span style="font-weight: bold;">Total Ack. : </span>
                                <span>
                                    <?php
                                    echo "$acc_num_2 ครั้ง";
                                    ?>
                                </span>
                            </span>
                            <span>
                                <span style="font-weight: bold;">Dangerous : </span>
                            </span>
                    <?php
                    echo "$acc_num_1";
                    ?>&nbsp;
                    <big>
                        &#3588;&#3619;&#3633;&#3657;&#3591;
                    </big>
                    <small>
                        <span style="font-family: Arial; font-weight: bold;">GPS Lose:&nbsp;</span>
                        <?php
                        echo "$gpsl";
                        ?>
                        <span style="font-family: Arial;">
                                    &nbsp;&#3588;&#3619;&#3633;&#3657;&#3591;
                                </span>
                    </small>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: rgb(204, 255, 255); height: 10px; width: 155px;">
                <small>
                            <span style="font-family: Arial;">
                                <span style="font-weight: bold;"></span>&nbsp;
                            </span>
                </small>
                <small style="font-family: Arial;">
                    <span style="font-weight: bold;">Speed max. : </span>
                    <small>
                        <?php
                        echo "$speed_maxy";
                        ?>&nbsp;km/hr
                    </small>
                </small>
            </td>
            <td style="font-family: Arial; text-align: left; background-color: rgb(204, 255, 255); vertical-align: middle; height: 10px; width: 167px;">
                <small style="font-family: Arial;">
                    <span style="font-weight: bold;">&nbsp;All time : </span>
                    <?php
                    $time_s = explode(":", $time_i[1]);
                    $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                    $time_s = explode(":", $time_i[$num_rows-1]);
                    $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                    $deltaT = $sec2 - $sec1;
                    $hour_trip = floor($deltaT/3600);
                    $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
                    if ($deltaT<60) {
                        $sec_trip = $deltaT;
                    }
                    elseif ((60<=$deltaT) AND ($deltaT<3600)) {
                        $sec_trip = ($deltaT- ($min_trip*60));
                    }
                    elseif ($deltaT>=3600) {
                        $sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));
                    }
                    echo "$hour_trip hr $min_trip min $sec_trip sec";
                    $dis_sum = 0;
                    for ($i=0; $i<($num_rows-1); $i++) {
                        $time_s = explode(":", $time_i[$i-1]);
                        $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                        $time_s = explode(":", $time_i[$i]);
                        $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                        $sec_del = $sec2 - $sec1;
                        if ($sec_del<=3) {
                            $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600);
                        }
                        $distance = $velocity * $sec_del;
                        $dis_sum = $distance + $dis_sum;
                    }
                    if ($deltaT!=0) {
                        $speed_avg = ($dis_sum/$deltaT) * (3600/1000);
                    }
                    ?>&nbsp;
                </small>
                <small>
                    <span style="font-weight: bold;"></span>
                </small>
                <small style="font-family: Arial;">
                    <span style="font-weight: bold;"></span>
                </small>
            </td>
            <td style="background-color: rgb(153, 255, 153); text-align: center; width: 174px;">&nbsp;
                <small style="color: red;">
                    <small style="font-family: Arial; font-weight: bold;">
                        <?php
                        if ($over_index=="") {
                            $over_index=301;
                        }
                        if ($over_index>=300) {
                            $jk=$over_index-300;
                            if ($del_a[$jk]<0) {
                                $typeS="Brake";
                            }
                            elseif ($del_a[$jk]>=0) {
                                $typeS="Acc";
                            }
                            $title = "Over Acc. No.";
                            echo "Sudden $typeS No. $over_index";
                        }
                        elseif (($over_index>=100) AND ($over_index<300)) {
                            $title = "Un Control No.";
                            $jk=$over_index-100;
                            echo "$title $jk";
                        }
                        elseif ($over_index<100) {
                            $title = "Speed Over No.";
                            echo "$title $over_index";
                        }
                        ?>
                    </small>
                </small>
            </td>
            <td style="vertical-align: middle; height: 10px; font-family: Arial; background-color: rgb(153, 255, 153); text-align: center; width: 146px;">
                <small style="font-family: Arial;">
                    <span style="font-weight: bold;"> Type : </span>
                    <?php
                    if ($over_index<100) {
                        if ($over_index=="") {
                            $over_index=1;
                        }
                        if ($spdType[$over_index]==1) {
                            $typeS = "Lane Change";
                        }
                        elseif ($spdType[$over_index]==2) {
                            $typeS = "Turn";
                        }
                        elseif ($spdType[$over_index]==0) {
                            $typeS = "Straight";
                        }
                        else {
                            $typeS = "other";
                        }
                    }
                    elseif (($over_index>=100) AND ($over_index<300)) {
                        $kk = $over_index-100;
                        $typeS = "$unControl[$kk]";
                    }
                    elseif ($over_index>=300) {
                        $kk = $over_index-300;
                        if ($del_a[$kk]<0) {
                            $typeS="Brake";
                        }
                        elseif ($del_a[$kk]>=0) {
                            $typeS="Accelleration";
                        }
                        $gg = round(($del_a[$kk]/9.81),2);
                    }
                    echo "$StrType[$kk] $gg G";
                    $typeT = $StrType[$kk];
                    ?>
                </small>
            </td>
            <td style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 160px;">
                <small>
                            <span style="font-weight: bold; font-family: Arial;">
                                <small>Speed max. : </small>
                            </span>
                    <small>
                                <span style="font-family: Arial;">
                                    <?php
                                    $jj=$over_index-300;
                                    $gg = ($acc_vmax[$jj]);
                                    echo "$gg";
                                    ?>
                                </span>
                    </small> &nbsp;
                    <small>
                        <span style="font-family: Arial;">km/hr</span>
                    </small>
                </small>
            </td>
            <td colspan="1" rowspan="1" style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 156px;">
                <small style="font-family: Arial;">
                    <span style="font-weight: bold;">Theta diff. : </span>
                    <?php
                    $kk = $over_index-300;
                    $intdelMax1[$kk] = round($intdelMax1[$kk],2);
                    $thetas = "$intdelMax1[$kk]";
                    echo "$thetas";
                    ?>
                </small>
            </td>
        </tr>
        <tr>
            <td style="background-color: rgb(204, 255, 255); font-family: Arial; height: 18px; width: 155px;">
                <small>
                            <span style="font-family: Arial;">
                                <span style="font-weight: bold;"><small>Speed avg. : </small>
                                </span>
                            </span>
                    <small>
                        <?php
                        $speed_avg = $speed_avg*$spd_unit;
                        $speed_avg = round($speed_avg,2);
                        echo "$speed_avg";?>
                    </small>
                    <small>&nbsp;km/hr</small>
                </small>
            </td>
            <td style="background-color: rgb(204, 255, 255); height: 18px; width: 167px;">
                <small>
                            <span style="font-weight: bold;">
                                <span style="font-family: Arial;">All Distance : </span>
                            </span>
                            <span style="font-family: Arial;">
                                <?php
                                $dis_sum_km = round(($dis_sum/1000),4);
                                echo "$dis_sum_km";
                                ?>
                            </span>
                </small>
                        <span style="font-family: Arial;">&nbsp;
                            <small>km</small>
                        </span>
            </td>
            <td style="text-align: center; background-color: rgb(193, 255, 193); width: 174px;">
                <small style="font-family: Arial;">
                    <span style="font-weight: bold;">Point : </span>
                    <?php
                    $jj=$over_index-300;
                    echo "$point0[$jj]-$point4[$jj] ";
                    echo "($timesec[$jj] sec)"; $lo_i = $point0[$jj];
                    $hi_i = $point4[$jj];?>
                    <br>
                </small>
            </td>
            <td style="font-family: Arial; height: 18px; background-color: rgb(193, 255, 193); text-align: center; width: 146px;">
                        <span style="font-weight: bold;">
                            <small>Time : </small>
                        </span>
                <small>
                    <?php
                    $jj = $over_index-300;
                    echo "$time1_acc[$jj]-$time2_acc[$jj]";
                    $times1=$time1_acc[$jj];
                    $times2=$time2_acc[$jj];
                    $dates1=$Date1;
                    $devices1=$device;
                    ?>
                </small>
            </td>
            <td style="height: 18px; background-color: rgb(193, 255, 193); text-align: center; width: 160px;">
                <small>
                            <span style="font-family: Arial;">
                                <span style="font-weight: bold;">Distance : &nbsp;</span>
                                <?php
                                if ($over_index<100) {
                                    echo "$speed_dis[$over_index] km.";
                                }
                                elseif ($over_index>=100) {
                                    $kk = $over_index-300;
                                    $ta = $dis_use[$kk];
                                    echo "$ta m.";
                                }
                                ?>
                            </span>
                </small>
            </td>
            <td style="width: 156px; text-align: center; background-color: rgb(193, 255, 193);">
                <small>
                            <span style="font-family: Arial;">
                                <span style="font-weight: bold;"> Acc max. :&nbsp;</span>
                                <?php
                                $jj = $over_index-300;
                                $accP_max[$jj] = round($accP_max[$jj],2);
                                echo "$accP_max[$jj] m/s2 ($acc_maxPoint[$jj])";
                                ?>
                            </span>
                </small>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="width: 1010px; height: 40px; text-align: left; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
        <tr>
            <td colspan="1" rowspan="1" style="text-align: left; height: 22px; vertical-align: bottom; width: 946px;">&nbsp;
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="m1.png"> under 81 km/hr &nbsp;
                </font>
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="m2.png"> 81-88 km/hr&nbsp;
                </font>
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="m3.png">v88-96 km/hr&nbsp;
                </font>
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="m4.png">96-104 km/hr&nbsp;
                </font>
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="m5.png"> &#3617;&#3634;&#3585;&#3585;&#3623;&#3656;&#3634; 104 km/hr&nbsp;&nbsp;&nbsp; &nbsp;
                </font>
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="d3.png">&nbsp;
                </font>
                        <span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">
                            &#3611;&#3657;&#3634;&#3618;&#3592;&#3629;&#3604;&#3619;&#3606;
                        </span>
                <font face="Arial" size="2">&nbsp;
                    <img style="width: 16px; height: 16px;" alt="" src="d2.png">&nbsp;
                </font>
                        <span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">
                            &#3627;&#3657;&#3634;&#3617;&#3592;&#3629;&#3604;&#3619;&#3606;
                            <span class="Apple-converted-space">&nbsp;</span>
                        </span>
                <font face="Arial" size="2">&nbsp;
                    <img style="width: 16px; height: 16px;" alt="" src="d4.png">
                </font>
                        <span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">
                            <span class="Apple-converted-space">&nbsp;</span>&#3648;&#3586;&#3605;&#3607;&#3634;&#3591;&#3619;&#3606;&#3652;&#3615;
                            <span class="Apple-converted-space">&nbsp;</span>
                        </span>
                <font face="Arial" size="2">
                    <img style="width: 16px; height: 16px;" alt="" src="d5.png">&nbsp;
                </font>
                        <span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">
                            &#3607;&#3634;&#3591;&#3650;&#3588;&#3657;&#3591;
                            <span class="Apple-converted-space">&nbsp;</span>
                        </span>
                <font face="Arial" size="2">&nbsp;
                    <img style="width: 16px; height: 16px;" alt="" src="d1.png">&nbsp;
                </font>
                        <span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">
                            &#3607;&#3634;&#3591;&#3649;&#3618;&#3585;&nbsp;&nbsp;
                        </span>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="width: 1010px; height: 138px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
        <tbody>
        <tr>
            <td rowspan="2" style="background-color: rgb(255, 255, 204); height: 144px; width: 547px;">
                <?php /* include ("f2_earthSPD_function.php"); */
                include ("f2_mapEarth_function.php");
                ?>
            </td>
            <td style="height: 144px; vertical-align: middle; background-color: white; width: 443px; text-align: right;">
                <?php
                include ("f2_graphL_function_acc.php");
                ?><br>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; background-color: white; text-align: center; width: 443px;" align="center">
                <big style="font-style: italic; font-weight: bold;">
                    <?php
                    $jj = $over_index-300;
                    echo "$StrType[$jj]";
                    ?>
                </big><br>
                <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: left; vertical-align: middle;" colspan="3" rowspan="1">
                            <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                                <tbody>
                                <tr>
                                    <td style="width: 52px; vertical-align: bottom;" colspan="1" rowspan="2">
                                        <img style="width: 53px; height: 60px;" alt="" src="v1.png">
                                    </td>
                                    <td style="width: 359px; vertical-align: bottom; text-align: left;">
                                        <small style="color: rgb(102, 102, 102); font-weight: bold;">
                                            <span style="font-family: Arial;">&nbsp;</span>
                                        </small>
                                        <small>
                                            <?php
                                            $jj = $over_index-300;
                                            $sta_count0 = $pn;
                                            if ($sta_count<=0) {
                                                $sta_count=0;
                                            }
                                            echo "<font face='tahoma' size='2' color='gray'> $speed0jj-$speed2jj km/hr : ";
                                            echo " $timesec[$jj] sec : $steer_cnt_jj steer : $checkA[$jj] pedal ";
                                            ?>
                                        </small>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="2">
                                        <small>
                                            <span style="font-family: Arial;">
                                                <input style="width: 60px; height: 60px;" onclick="window.open('f2_graph_type_acc.php?deviceid=<?php echo $deviceid;?>&date1=<?php echo $date1;?>&time1=<?php echo $time1;?>&time2=<?php echo $time2;?>')" value="Total" name="Behavior" type="button">
                                            </span>
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 359px;">
                                        <big style="font-style: italic;">
                                            <big style="font-family: Arial;">
                                                <small>
                                                    <?php
                                                    $jj=$over_index-300; $lo = $point0[$jj];
                                                    $hi = $point4[$jj];
                                                    for ($i=2; $i<$sta_count_jj; $i++) {
                                                        if ($steer_stat_jj[$i]==0) {
                                                            $ste = "#FF0000";
                                                        }
                                                        elseif ($steer_stat_jj[$i]==1) {
                                                            $ste = "#0040FF";
                                                        }
                                                        echo "<b><font face='tahoma' size='2' color='$ste'>o</b>";
                                                    }
                                                    echo "<b> <font face='tahoma' size='2' color='black'> $StrTypejj[$jj] ($steer_cnt_jj) <b> <br>";
                                                    for ($i=1; $i<$sta_count_jj; $i++) {
                                                        if ($acc_stat_jj[$i]==1) {
                                                            $pedal = "#F6CECE";
                                                        }
                                                        elseif ($acc_stat_jj[$i]==2) {
                                                            $pedal = "#FF0000";
                                                        }
                                                        elseif ($acc_stat_jj[$i]==3) {
                                                            $pedal = "#CEF6F5";
                                                        }
                                                        elseif ($acc_stat_jj[$i]==4) {
                                                            $pedal = "#0040FF";
                                                        }
                                                        echo "<b><font size='4' color='$pedal'>l</b>";
                                                    }
                                                    echo "<font face='tahoma' size='2' color='black'> <b> $accType[$jj] ($checkA[$jj]) </b>";
                                                    ?>
                                                </small>
                                            </big>
                                        </big>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="width: 1010px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
        <tbody>
        <tr>
            <td>&nbsp;
                <?php
                echo "<table width='1000' border='0'>";
                echo " <tr bgcolor='#F781D8'> <td align='center'> <font size='2' color='black'> Un-C. no. </td> <td align='center'> <font size='2' color='black'> Force. Max. </td> <td align='center'> <font size='2' color='black'> Max. point </td> <td align='center'> <font size='2' color='black'> Speed max </td>
                                <td align='center'> <font size='2' color='black'> Speed end </td>
                                <td align='center'> <font size='2' color='black'> Point </td> <td align='center'> <font size='2' color='black'> Duration </td> <td align='center'> <font size='2' color='black'> Theta </td> <td align='right'> <font size='2' color='black'> Distance </td>
                                <td align='center'> <font size='2' color='black'> Time </td>
                                <td align='center'> <font size='2' color='black'> Force </td> <td align='center'> <font size='2' color='black'> lat1-lon1 </td> <td align='center'> <font size='2' color='black'> TypePND </td> <td align='center'> <font size='2' color='black'> TypeSTR </td> </tr> ";
                for ($i=1; $i<=$acc_num_1; $i++) {
                    $forceP[$i] = round($forceP[$i],2);
                    $Max_accP[$i] = round($Max_accP[$i],2);
                    $intdelMax1[$i] = round($intdelMax1[$i],2);
                    $deltaT = $time_use[$i];
                    $hour_trip = floor($deltaT/3600);
                    $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
                    if ($deltaT<60) {
                        $sec_trip = $deltaT;
                    }
                    elseif ((60<=$deltaT) AND ($deltaT<3600)) {
                        $sec_trip = ($deltaT- ($min_trip*60));
                    }
                    elseif ($deltaT>=3600) {
                        $sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));
                    }
                    $i400=$i+300;
                    echo " <tr bgcolor='#F8E0EC'> <td align='center'> <input type='submit' name='over_index' value='$i400' style='height:20px; width:30px; font-size: 10px;> </td>
                                        <td align='center'> <img src='d1.png' width='14' height='14'/> </td>
                                        <td align='center'> <font size='2' color='black'> $Max_accP[$i] m/s2 </td>
                                        <td align='center'> <font size='2' color='black'> $Max_accPoint[$i] </td>
                                        <td align='center'> <font size='2' color='black'> $acc_vmax[$i] km/hr </td>
                                        <td align='center'> <font size='2' color='black'> $speed_end[$i] km/hr </td>
                                        <td align='center'> <font size='2' color='black'> $point0[$i]-$point4[$i] </td>
                                        <td align='center'> <font size='2' color='black'> $min_trip min $sec_trip sec </td>
                                        <td align='center'> <font size='2' color='black'> $intdelMax1[$i] </td>
                                        <td align='center'> <font size='2' color='black'> $dis_use[$i] </td> <td align='center'> <font size='2' color='black'> $time1_acc[$i] </td>
                                        <td align='center'> <font size='2' color='black'> $forceP[$i] </td> <td align='center'> <font size='2' color='black'> $latABe[$i]-$lonABe[$i] </td> <td align='center'> <font size='2' color='black'> $accType[$i] </td> <td align='center'> <font size='2' color='black'> $StrType[$i] </td> </tr> ";
                    $i=$i+1;
                    $forceP[$i] = round($forceP[$i],2);
                    $Max_accP[$i] = round($Max_accP[$i],2);
                    $intdelMax1[$i] = round($intdelMax1[$i],2);
                    $i400=$i+300;
                    $deltaT = $time_use[$i];
                    $hour_trip = floor($deltaT/3600);
                    $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
                    if ($deltaT<60) {
                        $sec_trip = $deltaT;
                    }
                    elseif ((60<=$deltaT) AND ($deltaT<3600)) {
                        $sec_trip = ($deltaT- ($min_trip*60));
                    }
                    elseif ($deltaT>=3600) {
                        $sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));
                    }
                    if ($i<=$acc_num_1) {
                        echo " <tr bgcolor='#F5A9F2'> <td align='center'> <input type='submit' name='over_index' value='$i400' style='height:20px; width:30px; font-size: 10px;> </td> <td align='center'> <img src='d1.png' width='14' height='14'/> </td>
                                            <td align='center'> <font size='2' color='black'> $Max_accP[$i] m/s2</td>
                                            <td align='center'> <font size='2' color='black'> $Max_accPoint[$i] </td>
                                            <td align='center'> <font size='2' color='black'> $acc_vmax[$i] km/hr </td>
                                            <td align='center'> <font size='2' color='black'> $speed_end[$i] km/hr </td>
                                            <td align='center'> <font size='2' color='black'> $point0[$i]-$point4[$i] </td>
                                            <td align='center'> <font size='2' color='black'> $min_trip min $sec_trip sec </td>
                                            <td align='center'> <font size='2' color='black'> $intdelMax1[$i] </td>
                                            <td align='center'> <font size='2' color='black'> $dis_use[$i] </td> <td align='center'> <font size='2' color='black'> $time1_acc[$i] </td>
                                            <td align='center'> <font size='2' color='black'> $forceP[$i] </td> <td align='center'> <font size='2' color='black'> $latABe[$i]-$lonABe[$i] </td> <td align='center'> <font size='2' color='black'> $accType[$i] </td> <td align='center'> <font size='2' color='black'> $StrType[$i] </td> </tr> ";
                    }
                }
                echo "</table>";
                ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
                <table style="text-align: left; width: 986px; height: 17px;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>&nbsp;Sudden Release &nbsp;</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Sudden Release - <span style="font-style: italic;">Curve</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Sudden Release - <span style="font-style: italic;">Slalom</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small><span style="font-weight: bold;">Total Sudden Release</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);"></td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);"></td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum11";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum12";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum13";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            $j = $typeNum11 + $typeNum12 + $typeNum13 ;
                            echo "$j";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255);"></td>
                        <td style="background-color: rgb(204, 255, 255);"></td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Overtake</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Overtake - <span style="font-style: italic;">Slalom</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Overtake - <span style="font-style: italic;"> Hard</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Overtake - <span style="font-style: italic;">Sudden , Curve</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Overtake - <span style="font-style: italic;">Right</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Overtake - <span style="font-style: italic;">Left</span></small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small style="font-weight: bold;">Total Overtake</small>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum21";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum22";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum23";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum24";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum25";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum26";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            $j = $typeNum21 + $typeNum22 + $typeNum23 + $typeNum24 + $typeNum25 + $typeNum26 ;
                            echo "$j";
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Sudden Close to</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Close to - Hard</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Close to - Hard , Curve</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Close to - Slalom</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Close to - Slalom , Curve</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Close to - Very Hard</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small style="font-weight: bold;">Total Close to</small>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum31";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum32";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum33";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum34";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum35";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$typeNum36";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            $j = $typeNum31 + $typeNum32 + $typeNum33 + $typeNum34 + $typeNum35 + $typeNum36 ;
                            echo "$j";
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Stop</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Stop and Curve</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Stop - Slalom</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Sudden Stop</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small>Sudden Stop - Hard &nbsp;Left</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(153, 255, 153);">
                            <small style="font-weight: bold;">Total Stop</small>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum41";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum42";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum43";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum44";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            echo "$typeNum45";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(206, 246, 206);">
                            <?php
                            $j = $typeNum41 + $typeNum42 + $typeNum43 + $typeNum44 + $typeNum45;
                            echo "$j"?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Slalom</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Walking</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>GPS Lose</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);">
                            <small>Drowsy</small>
                        </td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);"></td>
                        <td style="text-align: center; background-color: rgb(51, 204, 255);"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; background-color: rgb(204, 255, 255);">
                            <?php
                            echo "$typeNum01";
                            ?>
                        </td>
                        <td style="text-align: center; background-color: rgb(204, 255, 255);">
                            <?php
                            echo "$typeNum02";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255); text-align: center;">
                            <?php
                            echo "$gpsl";
                            ?>
                        </td>
                        <td style="background-color: rgb(204, 255, 255);"></td>
                        <td style="background-color: rgb(204, 255, 255);"></td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <table>
                    <tbody>
                    <tr>
                        <td colspan="2" rowspan="1" style="vertical-align: top;">
                            <hr style="width: 100%; height: 2px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="undefined" valign="undefined">
                            <small><a style="color: white;" href="f0_routRisk.php" target="_blank">Rout Risk </a>&nbsp; &nbsp;</small>
                            <small><a style="color: white;" href="f1_integrate.php" target="_blank">Integrate </a></small>
                            <small>&nbsp;&nbsp;</small>
                            <small><a href="f1_speedBehavior.php" style="color: white;" target="_blank">Speed</a></small>
                            <small>&nbsp;</small>
                            <small>
                                <a style="color: white;" href="f0_routRisk.php" target="_blank">
                                    <?php
                                    $objConnect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
                                    $objDB = mysql_select_db(DB_NAME);

                                    for ($t=1; $t<=$acc_num_1; $t++) {
                                        $strSQL = "INSERT INTO `accscore` (`test`,`date`,`index`,`accmax`,`speedmax`,`theta` ,`pnt1` ,`pnt2` ,`lat1` ,`lon1` ,`lat2` ,`lon2` , `distance` , `dura` , `force` , `type`) VALUES ( '$selectT', '$dateacc', '$t', '$accP_max[$t]', '$acc_vmax[$t]', '$intdelMax1[$t]' ,'$point0[$t]','$point4[$t]', '$latABe[$t]','$lonABe[$t]' ,'$latAEn[$t]','$lonAEn[$t]','$dis_use[$t]','$time_use[$t]','$forceP[$t]','$StrType[$t]');;"; $objQuery = mysql_query($strSQL);
                                    }

                                    $objDB = mysql_select_db(DB_NAME);

                                    $delsql = " DELETE FROM `acctype` WHERE CONVERT( `test` USING utf8 ) = '$selectT' AND (`date`= '$Date1') AND (`time1`= '$Time1'); ";
                                    $objQuery = mysql_query($delsql);

                                    $strSQL = "INSERT INTO `acctype` ( `timestp` , `test` , `date` , `time1` , `time2` , `spdavg` , `spdmax` , `accmax` , `accmin` , `distance` , `forcet` , `release` , `overtake` , `closeto` , `stop` , `type0`, `type` , `score` ) VALUES ( NOW( ) , '$selectT', '$dateacc', '$Time1' , '$Time2','$speed_avg' ,'$speed_maxy','$accPmax','$accPmin','$dis_sum_km' ,'$forceT','$typeNum1', '$typeNum2', '$typeNum3', '$typeNum4', '$typeNum0', '$typeT', '$scoreT');;"; $objQuery = mysql_query($strSQL);
                                    ?>
                                </a>
                            </small>
                        </td>
                        <td align="undefined" valign="undefined"></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</form>
<br>
</body>
</html>