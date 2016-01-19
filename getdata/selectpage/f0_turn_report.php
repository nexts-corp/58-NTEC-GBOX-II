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
    <form style="height: 345px;" action="f0_turn_report.php" method="get">
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
                                include ("f2_getdata.php");

                                $Time1 = $TimeBegin;
                                $Time2 = $TimeEnd;

                                echo "$deviceName";
                                ?>
                            </span>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Date : </span>
                            <span>
                                <?php
                                $DateBegin = $Date1;
                                echo "$Date1";
                                $datev1 = $Date1;
                                $DateT = $Date1;
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
                                <span style="font-weight: bold;">numrows : </span>
                                <span>
                                    <?php
                                    include ("f2_turn_function.php");
                                    echo "$jhk";
                                    ?>
                                </span>
                            </span>
                            <span>
                                <span style="font-weight: bold;">Turn : </span>
                                <span>
                                    <?php
                                    echo "$total1";
                                    ?>
                                </span>
                            </span>
                            <span>
                                <span style="font-weight: bold;">High G. : </span>
                                <span>
                                    <?php
                                    echo "$curve_over";
                                    ?>
                                </span>
                            </span>
                        </div>
                    </td>
                </tr>
        </table>
        <table style="background-color: white; width: 100%; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr style="font-family: Arial; font-size: x-small; height: 30px;">
                    <td style="background-color: rgb(204, 255, 255); width: 17%;">
                        <span>
                            <span style="font-weight: bold;">Speed max. : </span>
                            <span>
                                <?php
                                if ($device == "globalsat") {$spd_unit=1; $acc_limit=2;}
                                elseif ($device == "3dgps01") {$spd_unit=1.825; $acc_limit=2;}
                                elseif ($device == "dg200") {$spd_unit=1; $acc_limit=1.5;}
                                elseif ($device == "gps01") {$spd_unit=1; $acc_limit=1.5;}
                                else {$spd_unit=1.825; $acc_limit=1.5;}
                                //$speed_maxy = round(($speed_max*$spd_unit),2);
                                echo "$speed_maxy km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(204, 255, 255); width: 16%;">
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
                    <td style="background-color: rgb(153, 255, 153); text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Turn Number :</span>
                            <span>
                                <?php
                                if (($over_index=="") OR ($over_index=="0")) {$over_index=401;}
                                echo "$over_index";
                                $over_i = $over_index - 400;
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(153, 255, 153); text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Type : </span>
                            <span>
                                <?php
                                $over_i = $over_index - 400;
                                echo " <font color='blue'> $type_Turn[$over_i] <font color='black'>";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; background-color: rgb(153, 255, 153); width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Speed max. : </span>
                            <span>
                                <?php
                                $over_i = $over_index - 400;
                                echo "$SpeedMax[$over_i] km/hr";
                                ?>
                            </span>
                            <span>
                                <?php
                                $over_i = $over_index - 400;
                                if ($SpeedMax[$over_i]<81) { echo " <img src='m1.png' width='14' height='14'/> ";}
                                elseif (($SpeedMax[$over_i]>=81) AND ($SpeedMax[$over_i]<88)) { echo " <img src='m2.png' width='14' height='14'/> ";}
                                elseif (($SpeedMax[$over_i]>=88) AND ($SpeedMax[$over_i]<96)) { echo " <img src='m3.png' width='14' height='14'/> ";}
                                elseif (($SpeedMax[$over_i]>=96) AND ($SpeedMax[$over_i]<104)){ echo " <img src='m4.png' width='14' height='14'/> ";}
                                elseif ($SpeedMax[$over_i]>=104) { echo " <img src='m5.png' width='14' height='14'/> ";}
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; background-color: rgb(153, 255, 153); width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Theta diff. : </span>
                            <span>
                                <?php
                                echo "$delta_tt[$over_i] degree";
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
                                echo "$stp_point[$over_i]";
                                $pointE = explode("-",$stp_point[$over_i]);
                                $pointE1 = $pointE[0];
                                $pointE2 = $pointE[1];
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(193, 255, 193); text-align: center; width: 16%;">
                        <span>
                            <span>
                                <?php
                                if ($g_overR[$over_i]>=0.15) { echo "<img src='d4.png' width='12' height='12'/>"; }
                                elseif ($g_overR[$over_i]<=-0.15) { echo "<img src='d1.png' width='12' height='12'/>"; }
                                else { echo "<img src='' width='12' height='12'/>"; }
                                ?>
                            </span>
                            <span style="font-weight: bold;">G : </span>
                            <span>
                                <?php
                                echo "$g_overR[$over_i] ($altH2[$over_i])";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(193, 255, 193); text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">Duration : </span>
                            <span>
                                <?php
                                $time01 = $time_i[$pointE1];
                                $time_s = explode(":", $time01);
                                $sec01 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                $time02 = $time_i[$pointE2];
                                $time_s = explode(":", $time02);
                                $sec02 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                $deltaT = $sec02 - $sec01;
                                $hour_trip = floor($deltaT/3600);
                                $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
                                if ($deltaT<60) {$sec_trip = $deltaT;}
                                elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
                                elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
                                $sum_d_T = "$min_trip min $sec_trip sec";
                                echo "$sum_d_T";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="background-color: rgb(193, 255, 193); width: 16%; text-align: center;">
                        <span>
                            <span style="font-weight: bold;">H/d = </span>
                            <span>
                                <?php
                                if ($delDis[$over_i]!=0) {$grade = (($AccSlope[$over_i] / $delDis[$over_i])*100);}
                                $grade = round($grade,2);
                                $d = round($delDis[$over_i],2);
                                echo "$AccSlope[$over_i]/$d ($grade%)";
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
                        <?php
                        include ("f2_mapEarth_function.php");
                        ?>
                    </td>
                    <td style="height: 144px; vertical-align: middle; background-color: white; text-align: right; width: 45%;">
                        <?php
                        $j1=0;$j2=0;$j3=0;$j4=0;$j0=0;
                        $gg = $spd_zone_cnt + $dowsy_cnt;
                        for ($i=1; $i<=$gg; $i++) {
                        if ($dowsy_spdm[$i]<81) { $j0 = $j0+1;}
                        elseif (($dowsy_spdm[$i]>=81) AND ($dowsy_spdm[$i]<88)) { $j1 = $j1+1;}
                        elseif (($dowsy_spdm[$i]>=88) AND ($dowsy_spdm[$i]<96)) { $j2 = $j2+1;}
                        elseif (($dowsy_spdm[$i]>=96) AND ($dowsy_spdm[$i]<104)) { $j3 = $j3+1;}
                        elseif ($dowsy_spdm[$i]>=104) { $j4 = $j4+1;}
                        }
                        if (($j0>=1) AND ($j0<=6)) {$j0=6;}
                        if (($j1>=1) AND ($j1<=6)) {$j1=6;}
                        if (($j2>=1) AND ($j2<=6)) {$j2=6;}
                        if (($j3>=1) AND ($j3<=6)) {$j3=6;}
                        if (($j4>=1) AND ($j4<=6)) {$j4=6;}
                        $j0 = floor($j0/6); $j1 = floor($j1/6);
                        $j2 = floor($j2/6);
                        $j3 = floor($j3/6);
                        $j4 = floor($j4/6);

                        include ("f2_graphL_function_turn.php");
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; background-color: white; text-align: center; width: 443px;" align="center">
                        <table style="text-align: left; width: 100%; height: 70px;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr>
                                    <td style="height: 95px;">
                                        <table style="width: 100%; text-align: left; margin-left: auto; margin-right: 0px;" border="0" cellpadding="2" cellspacing="2">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        $k = $LD_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        $k = $LC_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        $k = $LB_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <?php
                                                        $k = $LA_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $k = $LCB_total; /* $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u5.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u6.png'/><br>"; } */
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; font-size: x-small;">Left<br>D</td>
                                                    <td style="text-align: center; font-size: x-small;">Left<br>C</td>
                                                    <td style="text-align: center; font-size: x-small;">Left<br>B</td>
                                                    <td style="text-align: center; font-size: x-small;">Left<br>A</td>
                                                    <td style="text-align: center; font-size: x-small;">Curve<br>L</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle; height: 95px;">
                                        <?php
                                        echo "<img src='turn_0.png' width='24' height='24'/>";
                                        ?>
                                    </td>
                                    <td style="height: 95px;">
                                        <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $k = $RCA_total; /* $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u5.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u6.png'/><br>"; } */
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $k = $RA_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $k = $RB_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $k = $RC_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $k = $RD_total;
                                                        $kk = 5-$k;
                                                        for ($i=1; $i<=$kk; $i++) {
                                                            echo "<img src='u5.png'/><br>";
                                                        }
                                                        for ($i=1; $i<=$k; $i++) {
                                                            echo "<img src='u6.png'/><br>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; font-size: x-small;">Curve<br>R</td>
                                                    <td style="text-align: center; font-size: x-small;">Right<br>A</td>
                                                    <td style="text-align: center; font-size: x-small;">Right<br>B</td>
                                                    <td style="text-align: center; font-size: x-small;">Right<br>C</td>
                                                    <td style="text-align: center; font-size: x-small;">Right<br>D</td>
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
                    <td style="vertical-align: top; width: 559px;">
                        <?php
                        for ($i=1; $i<=$stp_point_cnt; $i++) {
                            $g_overR[$i] = round($g_overR[$i],4);
                            $delta_tt[$i] = round($delta_tt[$i],2);
                            $latBE1[$i]= round($latBE1[$i],6);
                            $lonBE1[$i]= round($lonBE1[$i],6);
                            $latBE2[$i] = round($latBE2[$i],6);
                            $lonBE2[$i] = round($lonBE2[$i],6);
                            $speedSum = $speedSum + $SpeedMax[$i];
                            if ($g_overR[$i]>=0) { $accSumP = $accSumP + $g_overR[$i]; $ap = $ap+1;}
                            elseif ($g_overR[$i]<0) { $accSumN = $accSumN + $g_overR[$i]; $an = $an+1;}
                            if ($g_over[$i]<=-0.15) { $gcolor[$i] = "d1.png"; }
                            elseif ($g_over[$i]>=0.15) { $gcolor[$i] = "d4.png"; }
                            else { $gcolor[$i] = ""; }
                            if ($SpeedMax[$i]<41) { $colorp[$i]="m1.png";}
                            elseif (($SpeedMax[$i]>=41) AND ($SpeedMax[$i]<48)) { $colorp[$i]="m2.png";}
                            elseif (($SpeedMax[$i]>=48) AND ($SpeedMax[$i]<56)) { $colorp[$i]="m3.png";}
                            elseif (($SpeedMax[$i]>=56) AND ($SpeedMax[$i]<64)) { $colorp[$i]="m4.png";}
                            elseif ($SpeedMax[$i]>=64) { $colorp[$i]="m5.png";}
                            $k0 = explode("-",$stp_point[$i]);
                            $k1 = $k0[0]; $k2 = $k0[1];
                            $time01 = $time_i[$k1];
                            $time_s = explode(":", $time01);
                            $sec01 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                            $time02 = $time_i[$k2];
                            $time_s = explode(":", $time02);
                            $sec02 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                            $deltaT = $sec02 - $sec01;
                            $hour_trip = floor($deltaT/3600);
                            $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
                            if ($deltaT<60) {$sec_trip = $deltaT;}
                            elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
                            elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
                            $sum_ddT[$i] = "$hour_trip hr $min_trip min $sec_trip sec";
                            $duraSum = $duraSum + $deltaT;
                            if ($delDis[$i]!=0) {$gradeH[$i] = (($AccSlope[$i] / $delDis[$i])*100);}
                            $gradeH[$i] = round($gradeH[$i],2);
                            if ((abs($gradeH[$i])>=9) AND (abs($gradeH[$i])<17)) {$gradP[$i]="light2.png";}
                            elseif (abs($gradeH[$i])>=17) {$gradP[$i]="light3.png";}
                            else {$gradP[$i]="";}
                        }
                        echo "<table width='920' border='0'>";
                        echo " <tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Over no. </td> <td align='center'> <font size='2' color='black'> acc (g) </td>
                        <td align='center'> <font size='2' color='black'> point@AccMax </td> <td align='center'> <font size='2' color='black'> Height </td>
                        <td align='center'> <font size='2' color='black'> distance </td>
                        <td align='center'> <font size='2' color='black'> grade </td>
                        <td align='center'> <font size='2' color='black'> point </td> <td align='center'> <font size='2' color='black'> speed max. </td> <td align='center'> <font size='2' color='black'> type </td> <td align='center'> <font size='2' color='black'> theta </td> <td align='center'> <font size='2' color='black'> duration </td> <td align='center'> <font size='2' color='black'> lat1-lon1 </td> <td align='center'> <font size='2' color='black'> lat1-lon1 </td>
                        </tr> ";
                        for ($i=1; $i<=$stp_point_cnt; $i++) {
                            $m = $i+400;
                            $bgco = "#81F781";
                            if ($i==($over_index-400)) {$bgco = "#F3F781";}
                            echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$m' style='height:20px; width:30px; font-size: 10px;> </td>
                            <td align='center'> <img src='$colorp[$i]' width='14' height='14'/> </td>
                            <td align='right'> <font size='2' color='black'> $g_overR[$i] <img src='$gcolor[$i]' width='12' height='12'/> </td>
                            <td align='center'> <font size='2' color='black'> $altH2[$i] </td> <td align='center'> <font size='2' color='black'> $AccSlope[$i] </td>
                            <td align='center'> <font size='2' color='black'> $delDis[$i] </td>
                            <td align='right'> <font size='2' color='black'> $gradeH[$i] <img src='$gradP[$i]' width='12' height='12'/> </td>
                            <td align='center'> <font size='2' color='black'> $stp_point[$i] </td>
                            <td align='right'> <font size='2' color='black'> $SpeedMax[$i] km/hr</td> <td align='center'> <font size='2' color='black'> $type_Turn[$i] </td>
                            <td align='center'> <font size='2' color='black'> $delta_tt[$i] </td> <td align='center'> <font size='2' color='black'> $sum_ddT[$i] </td>
                            <td align='right'> <font size='2' color='black'> $latBE1[$i]-$lonBE1[$i] </td>
                            <td align='right'> <font size='2' color='black'> $latBE2[$i]-$lonBE2[$i] </td></tr> ";

                            $i = $i+1;
                            $m=$i+400;
                            $sum_d = $sum_d+$speed_dis[$i];
                            $sum_dT = $sum_dT + $speed_time[$i];
                            $bgco = "#BCF5A9";
                            if ($i==($over_index-400)) {$bgco = "#F3F781";}
                            if ($i<=$stp_point_cnt) {
                                echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$m'style='height:20px; width:30px; font-size: 10px;> </td> <td align='center'> <img src='$colorp[$i]' width='14' height='14'/> </td>
                                <td align='right'> <font size='2' color='black'> $g_overR[$i] <img src='$gcolor[$i]' width='12' height='12'/> </td>
                                <td align='center'> <font size='2' color='black'> $altH2[$i] </td> <td align='center'> <font size='2' color='black'> $AccSlope[$i] </td>
                                <td align='center'> <font size='2' color='black'> $delDis[$i] </td>
                                <td align='right'> <font size='2' color='black'> $gradeH[$i] <img src='$gradP[$i]' width='12' height='12'/> </td>
                                <td align='center'> <font size='2' color='black'> $stp_point[$i] </td>
                                <td align='right'> <font size='2' color='black'> $SpeedMax[$i] km/hr</td> <td align='center'> <font size='2' color='black'> $type_Turn[$i] </td>
                                <td align='center'> <font size='2' color='black'> $delta_tt[$i] </td>
                                <td align='center'> <font size='2' color='black'> $sum_ddT[$i] </td>
                                <td align='right'> <font size='2' color='black'>$latBE1[$i]-$lonBE1[$i] </td> <td align='right'> <font size='2' color='black'> $latBE2[$i]-$lonBE2[$i] </td>
                                </tr> ";
                                $sum_d = $sum_d+$speed_dis[$i];
                                $sum_dT = $sum_dT + $speed_time[$i];
                            }
                        }
                        echo "</table>";
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>

        <hr style="width: 100%; height: 2px;">

        <table style="font-size: small;">
            <tbody>
                <tr>
                    <td>
                        <?php
                        if ($stp_point_cnt!=0) {
                            $speedSum = round(($speedSum/$stp_point_cnt),2); $accSumP = round(($accSumP/$ap),4); $accSumN = round(($accSumN/$an),4); $duraSum = round(($duraSum/$stp_point_cnt),2);
                        }
                        $ra=0; $rb=0; $rc=0; $rd=0; $la=0; $lb=0; $lc=0; $ld=0; $cr=0; $cl=0; $sca=0; $scb=0; $ut=0;
                        for ($i=1; $i<=$curve_over; $i++) {
                            if ($Ttype_over[$i]=="Right-A") { $ra = $ra+1; }
                            elseif ($Ttype_over[$i]=="Right-B") { $rb = $rb+1; }
                            elseif ($Ttype_over[$i]=="Right-C") { $rc = $rc+1; }
                            elseif ($Ttype_over[$i]=="Right-D") { $rd = $rd+1; } elseif ($Ttype_over[$i]=="Left-A") { $la = $la+1; }
                            elseif ($Ttype_over[$i]=="Left-B") { $lb = $lb+1; }
                            elseif ($Ttype_over[$i]=="Left-C") { $lc = $lc+1; } elseif ($Ttype_over[$i]=="Left-D") { $ld = $ld+1; } elseif ($Ttype_over[$i]=="Curve-R") { $cr = $cr+1; } elseif ($Ttype_over[$i]=="Curve-L") { $cl = $cl+1; } elseif ($Ttype_over[$i]=="SCurve-A") { $sca = $sca+1; } elseif ($Ttype_over[$i]=="SCurve-B") { $scb = $acb+1; } elseif ($Ttype_over[$i]=="U-Turn") { $ut = $ut+1; } }
                        $typeR = "$ra:$rb:$rc:$rd";
                        $typeL = "$la:$lb:$lc:$ld";
                        $typeC = "$cr:$cl:$sca:$scb";
                        $typeU = "$ut";
                        $totalT = $curve_over;

                        $objConnect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
                        $objDB = mysql_select_db(DB_NAME);

                        $delsql = " DELETE FROM `turntype` WHERE CONVERT( `test` USING utf8 ) = '$selectT' AND (`date`= '$Date1') AND (`time1`= '$Time1'); ";
                        $objQuery = mysql_query($delsql);

                        $sql ="use thairoadsafety";
                        $strSQL = "INSERT INTO `turntype` ( `timestp` , `index` , `date` , `time1` , `time2` , `vavg` , `ap`, `an` , `duration` , `typeRT`, `typeLT`, `typeC`, `typeU`, `totalscore` ) VALUES (NOW( ) , '$selectT', '$DateT', '$TimeBegin', '$TimeEnd', '$speedSum', '$accSumP', '$accSumN', '$duraSum', '$typeR', '$typeL', '$typeC', '$typeU' , '$totalT'); ";

                        $objQuery = mysql_query($strSQL);
                        ?>
                    </td>
                    <td>
                        <?php
                        $objConnect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
                        $objDB = mysql_select_db(DB_NAME);

                        $sql_del = " DELETE FROM `turnscore` WHERE `index`='$selectT' AND `date`= '$DateT'; ";
                        mysql_query($sql_del) or die(mysql_error());


                        for ($i=1; $i<=$stp_point_cnt; $i++) {
                        $point = explode("-",$stp_point[$i]);
                        $du = $point[1] - $point[0];
                        $latB1j = round($latBE1[$i],6);
                        $lonB1j = round($lonBE1[$i],6);
                        $latB2j = round($latBE2[$i],6);
                        $lonB2j = round($lonBE2[$i],6);


                        $strSQL = "INSERT INTO `turnscore` (`timestp` ,`index` ,`date` , `point1` ,`point2` , `vavg` ,`ap` ,`an` ,`duration` ,`lat1` ,`lon1` ,`lat2` ,`lon2`,`type` ) VALUES (NOW( ) , '$selectT', '$DateT', '$point[0]','$point[1]', '$SpeedMax[$i]', '$g_over[$i]', '$i', '$du', '$latB1j' , '$lonB1j', '$latB2j', '$lonB2j', '$type_Turn[$i]' ); ";
                        $objQuery = mysql_query($strSQL);
                        }
                        mysql_close($objConnect);
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>