<?php
error_reporting(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>TATANAD GPS Supervisory Program</title>
</head>
<body style="font-family: Arial;">
    <table style="width: 100%; height: 17px; text-align: left; margin-left: auto; margin-right: auto;">
        <tbody>
        <tr>
            <td style="vertical-align: middle; text-align: center; height: 13px; width: 20%; background-color: rgb(51, 153, 204);">
                <span style="color: white; font-weight: bold; font-family: tahoma; font-size: small;">
                    Driving Score 2.0 beta
                </span>
            </td>
            <td style="height: 13px; width: 10%; text-align: center;">
                <a href="www.nectec.or.th">
                    <img style="border: 0px solid ; width: 100px; height: 22px;" alt="" src="nectec.png">
                </a>
            </td>
            <td style="background-color: rgb(51, 153, 204); text-align: center; width: 10%; height: 13px;">
                <a style="color: white;" target="_blank" href="www.thairoadsafety.net">
                    <span style="font-weight: bold; font-size: small;">WebSite</span>
                </a>
            </td>
            <td style="width: 60%; text-align: right; background-color: rgb(51, 153, 204); color: white; font-weight: bold; height: 13px; font-size: small;">
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

        <table style="background-color: white; width: 100%; height: 40px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="height: 13px; background-color: white; vertical-align: middle; width: 45%; font-size: small;">
                        <span>
                            <span style="font-weight: bold;">Name : </span>
                            <span>
                                <?php
                                require(dirname(__FILE__)."/../../config.php");

                                $deviceid = $_GET["deviceid"];
                                $Date1 = $_GET["date1"];
                                $time1 = $_GET["time1"];
                                $time2 = $_GET["time2"];

                                if($_GET["over_index"] != "") $over_index = $_GET["over_index"];

                                $Time1 = $TimeBegin;
                                $Time2 = $TimeEnd;

                                include ("f2_getdata.php");
                                echo "$deviceName";
                                ?>
                            </span>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Date : </span>
                            <span>
                                <?php
                                $DateBegin = $date1;
                                echo "$date1";
                                $datev1 = $date1;
                                $speed_max_new = $speed_max;
                                $dateacc= $date1;
                                ?>
                            </span>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Time : </span>
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
                        </span>
                    </td>
                    <td style="font-size: small; font-family: Arial; height: 13px; text-align: right; background-color: white; vertical-align: middle; width: 55%;">
                        <div style="text-align: right;">
                            <span>
                                <?php
                                include("f2_acc_function.php");
                                $g = round(($acc_limit/9.81),2);
                                echo "<b>Acc. limit</b> : $g G";
                                ?>
                            </span>
                            <span>
                                <span style="font-weight: bold;">Total Acc. : </span>
                                <span>
                                    <?php
                                    echo "$acc_num_2 ครั้ง";
                                    ?>
                                </span>
                            </span>
                            <span>
                                <span style="font-weight: bold;">Dangerous : </span>
                                <span>
                                    <?php
                                    echo "$acc_num_1 ครั้ง";
                                    ?>
                                </span>
                            </span>
                            <span>
                                <span style="font-family: Arial; font-weight: bold;">GPS Lose : </span>
                                <span>
                                    <?php
                                    echo "$gpsl ครั้ง";
                                    ?>
                                </span>
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="background-color: white; width: 100%; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr style="font-family: Arial; font-size: x-small; height: 30px;">
                    <td style="background-color: rgb(204, 255, 255); width: 17%;">
                        <span>
                            <span style="font-weight: bold;">Speed max. : </span>
                            <span>
                                <?php
                                echo "$speed_maxy km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: left; background-color: rgb(204, 255, 255); vertical-align: middle; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">All time : </span>
                            <span>
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
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(153, 255, 153); text-align: center; width: 16%; color: red;">
                        <span>
                            <span style="font-weight: bold;">
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
                                    $title = "Over Acc. Index : ";
                                    echo "Sudden $typeS Index : $over_index";
                                }
                                elseif (($over_index>=100) AND ($over_index<300)) {
                                    $title = "Un Control Index : ";
                                    $jk=$over_index-100;
                                    echo "$title $jk";
                                }
                                elseif ($over_index<100) {
                                    $title = "Speed Over Index : ";
                                    echo "$title $over_index";
                                }
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="vertical-align: middle; background-color: rgb(153, 255, 153); text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Type : </span>
                            <span>
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
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; background-color: rgb(153, 255, 153); width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Speed max. : </span>
                            <span>
                                <?php
                                $jj=$over_index-300;
                                $gg = ($acc_vmax[$jj]);
                                echo "$gg km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td colspan="1" rowspan="1" style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Theta diff. : </span>
                            <span>
                                <?php
                                $kk = $over_index-300;
                                $intdelMax1[$kk] = round($intdelMax1[$kk],2);
                                $thetas = "$intdelMax1[$kk]";
                                echo "$thetas";
                                ?>
                            </span>
                        </span>
                    </td>
                </tr>

                <tr style="font-family: Arial; font-size: x-small; height: 30px;">
                    <td style="background-color: rgb(204, 255, 255); width: 17%;">
                        <span>
                            <span style="font-weight: bold;">Speed avg. : </span>
                            <span>
                                <?php
                                $speed_avg = $speed_avg*$spd_unit;
                                $speed_avg = round($speed_avg,2);
                                echo "$speed_avg km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(204, 255, 255); width: 16%;">
                        <span>
                            <span style="font-weight: bold;">All Distance : </span>
                            <span>
                                <?php
                                $dis_sum_km = round(($dis_sum/1000),4);
                                echo "$dis_sum_km km";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; background-color: rgb(193, 255, 193); width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Point : </span>
                            <span>
                                <?php
                                $jj=$over_index-300;
                                echo "$point0[$jj]-$point4[$jj] ";
                                echo "($timesec[$jj] sec)";
                                $lo_i = $point0[$jj];
                                $hi_i = $point4[$jj];
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(193, 255, 193); text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Time : </span>
                            <span>
                                <?php
                                $jj = $over_index-300;
                                echo "$time1_acc[$jj] - $time2_acc[$jj]";
                                $times1=$time1_acc[$jj];
                                $times2=$time2_acc[$jj];
                                $dates1=$Date1;
                                $devices1=$device;
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(193, 255, 193); text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Distance : </span>
                            <span>
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
                        </span>
                    </td>
                    <td style="width: 16%; text-align: center; background-color: rgb(193, 255, 193);">
                        <span>
                            <span style="font-weight: bold;">Acc max. : </span>
                            <span>
                                <?php
                                $jj = $over_index-300;
                                $accP_max[$jj] = round($accP_max[$jj],2);
                                echo "$accP_max[$jj] m/s2 ($acc_maxPoint[$jj])";
                                ?>
                            </span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; height: 40px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="font-family: Arial; font-size: small; text-align: left; height: 22px; vertical-align: bottom; width: 100%;">
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="m1.png"> under 81 km/hr
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="m2.png"> 81-88 km/hr
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="m3.png"> 88-96 km/hr
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="m4.png"> 96-104 km/hr
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="m5.png"> มากกว่า 104 km/hr
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="d3.png"> ป้ายจอดรถ
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="d2.png"> ห้ามจอดรถ
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="d4.png"> เขตทางรถไฟ
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="d5.png"> ทางโค้ง
                        </span>
                        <span>
                            <img style="width: 16px; height: 16px;" alt="" src="d1.png"> ทางแยก
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; height: 138px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td rowspan="2" style="background-color: rgb(255, 255, 204); height: 144px; width: 55%;">
                        <?php /* include ("f2_earthSPD_function.php"); */
                        include ("f2_mapEarth_function.php");
                        ?>
                    </td>
                    <td style="height: 144px; vertical-align: middle; background-color: white; width: 45%; text-align: right;">
                        <?php
                        include ("f2_graphL_function_acc.php");
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; background-color: white; text-align: center; width: 443px;" align="center">
                        <span style="font-style: italic; font-weight: bold;">
                            <?php
                            $jj = $over_index-300;
                            echo "$StrType[$jj]";
                            ?>
                        </span>
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
                                                    <td style="font-size: small; width: 359px; vertical-align: bottom; text-align: left;">
                                                        <span>
                                                            <?php
                                                            $jj = $over_index-300;
                                                            $sta_count0 = $pn;
                                                            if ($sta_count<=0) {
                                                                $sta_count=0;
                                                            }
                                                            echo "<span style='font-family: Tahoma; color: gray; font-size: small;'> $speed0jj-$speed2jj km/hr : ";
                                                            echo " $timesec[$jj] sec : $steer_cnt_jj steer : $checkA[$jj] pedal</span>";
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td style="font-family: Arial; text-align: center; vertical-align: middle;" colspan="1" rowspan="2">
                                                        <input style="width: 60px; height: 60px;" onclick="window.open('f2_graph_type_acc.php?deviceid=<?php echo $deviceid;?>&date1=<?php echo $date1;?>&time1=<?php echo $TimeBegin;?>&time2=<?php echo $TimeEnd;?>')" value="Total" name="Behavior" type="button">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family: Arial; font-style: italic; width: 359px;">
                                                        <span>
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
                                                                echo "<span style='font-family: tahoma; font-size: small; font-weight: bold; color: $ste;'>o</span>";
                                                            }
                                                            echo "<span style='font-family: tahoma; font-size: small; font-weight: bold; color: black;'> $StrTypejj[$jj] ($steer_cnt_jj) </span><br>";
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
                                                                echo "<span style='font-weight: bold; font-size: large; color: $pedal;'>l</span>";
                                                            }
                                                            echo "<span style='font-family: tahoma; font-size: small; font-weight: bold; color: black;'> $accType[$jj] ($checkA[$jj]) </span>";
                                                            ?>
                                                        </span>
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

        <table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td>
                        <?php
                        echo "<table style='width: 100%;' border='0'>
                                <tr style='background-color: #F781D8; font-size: small; color: black;'>
                                    <th align='center'>Un-C. no.</th>
                                    <th align='center'>Force. Max.</th>
                                    <th align='center'>Max. point</th>
                                    <th align='center'>Speed max</th>
                                    <th align='center'>Speed end</th>
                                    <th align='center'>Point</th>
                                    <th align='center'>Duration</th>
                                    <th align='center'>Theta</th>
                                    <th align='right'>Distance</th>
                                    <th align='center'>Time</th>
                                    <th align='center'>Force</th>
                                    <th align='center'>lat1-lon1</th>
                                    <th align='center'>TypePND</th>
                                    <th align='center'>TypeSTR</th>
                                </tr>";

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

                                $i400 = $i + 300;

                                echo "<tr style='background-color: #F8E0EC; font-size: small; color: black;'>
                                        <td align='center'><input type='submit' name='over_index' value='$i400' style='height:20px; width:30px; font-size: 10px;'><img src='d1.png' width='14' height='14'/></td>
                                        <td align='center'>$Max_accP[$i] m/s2</td>
                                        <td align='center'>$Max_accPoint[$i]</td>
                                        <td align='center'>$acc_vmax[$i] km/hr</td>
                                        <td align='center'>$speed_end[$i] km/hr</td>
                                        <td align='center'>$point0[$i]-$point4[$i]</td>
                                        <td align='center'>$min_trip min $sec_trip sec</td>
                                        <td align='center'>$intdelMax1[$i]</td>
                                        <td align='center'>$dis_use[$i]</td>
                                        <td align='center'>$time1_acc[$i]</td>
                                        <td align='center'>$forceP[$i]</td>
                                        <td align='center'>$latABe[$i]-$lonABe[$i]</td>
                                        <td align='center'>$accType[$i]</td>
                                        <td align='center'>$StrType[$i]</td>
                                    </tr> ";

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
                                    echo "<tr style='background-color: #F5A9F2; font-size: small; color: black;' bgcolor='#F5A9F2'>
                                            <td align='center'><input type='submit' name='over_index' value='$i400' style='height:20px; width:30px; font-size: 10px;'><img src='d1.png' width='14' height='14'/></td>
                                            <td align='center'>$Max_accP[$i] m/s2</td>
                                            <td align='center'>$Max_accPoint[$i]</td>
                                            <td align='center'>$acc_vmax[$i] km/hr</td>
                                            <td align='center'>$speed_end[$i] km/hr</td>
                                            <td align='center'>$point0[$i]-$point4[$i]</td>
                                            <td align='center'>$min_trip min $sec_trip sec</td>
                                            <td align='center'>$intdelMax1[$i]</td>
                                            <td align='center'>$dis_use[$i]</td>
                                            <td align='center'>$time1_acc[$i]</td>
                                            <td align='center'>$forceP[$i]</td>
                                            <td align='center'>$latABe[$i]-$lonABe[$i]</td>
                                            <td align='center'>$accType[$i]</td>
                                            <td align='center'>$StrType[$i]</td>
                                        </tr> ";
                                }
                            }
                        echo "</table>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <table style="font-size: small; text-align: left; width: 100%; height: 17px;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr style="text-align: center; background-color: rgb(51, 204, 255);">
                                    <th>Sudden Release</th>
                                    <th>Sudden Release - <span style="font-style: italic;">Curve</span></th>
                                    <th>Sudden Release - <span style="font-style: italic;">Slalom</span></th>
                                    <th>Total Sudden Release</th>
                                </tr>

                                <tr style="background-color: rgb(204, 255, 255); text-align: center;">
                                    <td>
                                        <?php
                                        echo "$typeNum11";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum12";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum13";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $j = $typeNum11 + $typeNum12 + $typeNum13 ;
                                        echo "$j";
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table style="font-size: small; text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr style="text-align: center; background-color: rgb(153, 255, 153);">
                                    <th>Sudden Overtake</th>
                                    <th>Sudden Overtake - <span style="font-style: italic;">Slalom</span></th>
                                    <th>Overtake - <span style="font-style: italic;"> Hard</span></th>
                                    <th>Overtake - <span style="font-style: italic;">Sudden , Curve</span></th>
                                    <th>Overtake - <span style="font-style: italic;">Right</span></th>
                                    <th>Overtake - <span style="font-style: italic;">Left</span></th>
                                    <th>Total Overtake</th>
                                </tr>
                                <tr style="text-align: center; background-color: rgb(206, 246, 206);">
                                    <td>
                                        <?php
                                        echo "$typeNum21";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum22";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum23";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum24";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum25";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum26";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $j = $typeNum21 + $typeNum22 + $typeNum23 + $typeNum24 + $typeNum25 + $typeNum26 ;
                                        echo "$j";
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table style="font-size: small; text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr style="text-align: center; background-color: rgb(51, 204, 255);">
                                    <th>Sudden Close to</th>
                                    <th>Close to - Hard</th>
                                    <th>Close to - Hard , Curve</th>
                                    <th>Close to - Slalom</th>
                                    <th>Close to - Slalom , Curve</th>
                                    <th>Close to - Very Hard</th>
                                    <th>Total Close to</th>
                                </tr>
                                <tr style="background-color: rgb(204, 255, 255); text-align: center;">
                                    <td>
                                        <?php
                                        echo "$typeNum31";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum32";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum33";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum34";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum35";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum36";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $j = $typeNum31 + $typeNum32 + $typeNum33 + $typeNum34 + $typeNum35 + $typeNum36 ;
                                        echo "$j";
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table style="font-size: small; text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr style="text-align: center; background-color: rgb(153, 255, 153);">
                                    <th>Sudden Stop</th>
                                    <th>Sudden Stop and Curve</th>
                                    <th>Sudden Stop - Slalom</th>
                                    <th>Sudden Sudden Stop</th>
                                    <th>Sudden Stop - Hard Left</th>
                                    <th>Total Stop</th>
                                </tr>
                                <tr style="text-align: center; background-color: rgb(206, 246, 206);">
                                    <td>
                                        <?php
                                        echo "$typeNum41";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum42";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum43";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum44";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum45";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $j = $typeNum41 + $typeNum42 + $typeNum43 + $typeNum44 + $typeNum45;
                                        echo "$j"?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table style="font-size: small; text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr style="text-align: center; background-color: rgb(51, 204, 255);">
                                    <th>Slalom</th>
                                    <th>Walking</th>
                                    <th>GPS Lose</th>
                                    <th>Drowsy</th>
                                </tr>
                                <tr style="text-align: center; background-color: rgb(204, 255, 255);">
                                    <td>
                                        <?php
                                        echo "$typeNum01";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$typeNum02";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "$gpsl";
                                        ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>

                        <hr style="width: 100%; height: 2px;">

                        <table style="font-size: small;">
                            <tbody>
                                <tr>
                                    <td>
                                        <span>
                                            <a style="color: white;" href="f0_routRisk.php" target="_blank">Rout Risk</a>
                                        </span>
                                        <span>
                                            <a style="color: white;" href="f1_integrate.php" target="_blank">Integrate </a>
                                        </span>
                                        <span>
                                            <a href="f1_speedBehavior.php" style="color: white;" target="_blank">Speed</a>
                                        </span>
                                        <span>
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
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>