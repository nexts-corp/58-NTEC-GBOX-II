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
    <form style="height: 690px;" action="f1_main.php" method="get">
        <input type="hidden" name="deviceid" value="<?php print $_GET["deviceid"]; ?>">
        <input type="hidden" name="date1" value="<?php print $_GET["date1"]; ?>">
        <input type="hidden" name="time1" value="<?php print $_GET["time1"]; ?>">
        <input type="hidden" name="time2" value="<?php print $_GET["time2"]; ?>">

        <table style="background-color: white; width: 100%; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr style="font-size: small; font-family: Arial;">
                    <td colspan="3" rowspan="1">
                        <span>
                            <?php
                            require(dirname(__FILE__)."/../../config.php");

                            $deviceid = $_GET["deviceid"];
                            $Date1 = $_GET["date1"];
                            $time1 = $_GET["time1"];
                            $time2 = $_GET["time2"];

                            include ("f2_getdata.php");

                            $Time1 = $TimeBegin;
                            $Time2 = $TimeEnd;

                            ?>
                            <span style="font-weight: bold; font-style: italic;">Driving Score Function</span>
                            <span>
                                <?php
                                $time_s = explode(":", $time_i[1]);
                                $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                $time_s = explode(":", $time_i[$num_rows]);
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

                                for ($i=1; $i<($num_rows); $i++) {
                                    $time_s = explode(":", $time_i[$i-1]);
                                    $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                    $time_s = explode(":", $time_i[$i]);
                                    $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                    $sec_del = $sec2 - $sec1;

                                    if ($sec_del<=3) {
                                        $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600);
                                    }
                                }

                                if ($deltaT!=0) {
                                    $speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);
                                }
                                if ($num_rows<0) {
                                    $n = 0;
                                }
                                else {
                                    $n = $num_rows;
                                }
                                echo "($n)"
                                ?>
                            </span>
                        </span>
                    </td>
                    <td rowspan="1" colspan="3">
                        <span>
                            <span style="font-weight: bold;">Name : </span>
                            <span>
                                <?php
                                echo"$deviceName";
                                ?>
                            </span>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Date : </span>
                            <span>
                                <?php
                                $dd = explode("-",$Date1);
                                $ddf = array($dd[2],$dd[1],$dd[0]);
                                $ddg = implode('-',$ddf);
                                echo "$Date1";
                                $DateBegin = $Date1;
                                ?>
                            </span>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Time : </span>
                             <span>
                                <?php
                                echo "$TimeBegin - $TimeEnd";
                                ?>
                            </span>
                        </span>
                    </td>
                </tr>
                <tr style="font-family: Arial; font-size: x-small; background-color: rgb(102, 204, 204);">
                    <td style="text-align: center; width: 10%;" colspan="1" rowspan="2">
                        <input style="height: 35px;" onclick="window.open('f2_map_function.php','mywindow')" name="map" value="Map" type="button">
                    </td>
                    <td colspan="1" rowspan="2" style="text-align: center; width: 20%; font-size: small;">
                        <input style="width: 50px;" onclick="window.open('f1_turnAnalytic.php')" value="Rout" name="Behavior" type="button"><br>
                        <span style="font-weight: bold;">
                            <?php
                            $tripdir1=$tripdir;
                            echo "$tripdir";
                            ?>
                        </span>
                    </td>
                    <td style="text-align: left; width: 20%; color: white;">
                        <span>
                            <span style="font-weight: bold;">คะแนนเฉลี่ย</span>
                            <span>
                                <?php
                                echo "$score_SA ($num_score)";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; color: white; width: 16%;">
                        <span>
                            <span style="font-weight: bold;;">ระยะทาง</span>
                            <span>
                                <?php
                                echo "$dis_a km";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; color: white; width: 17%;">
                        <span>
                            <span style="font-weight: bold;;">ความเร็ว</span>
                            <span>
                                <?php
                                echo "$spd_a km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; width: 17%; color: white;">
                        <span>
                            <span style="font-weight: bold;;">ระยะเวลา</span>
                            <span>
                                <?php
                                $deltaT = round($time_a,0);
                                $hour_trip1 = floor($deltaT/3600);
                                $min_trip1 = ((floor($deltaT/60)) - ($hour_trip1*60));
                                if ($deltaT<60) {
                                    $sec_trip1 = $deltaT;
                                }
                                elseif ((60<=$deltaT) AND ($deltaT<3600)) {
                                    $sec_trip1 = ($deltaT- ($min_trip1*60));
                                }
                                elseif ($deltaT>=3600) {
                                    $sec_trip1 = ($deltaT- ($min_trip1*60) - ($hour_trip1*3600));
                                }
                                $time = "$min_trip1 min $sec_trip1 sec";
                                echo "$time";
                                ?>
                            </span>
                        </span>
                    </td>
                </tr>
                <tr style="font-family: Arial; font-size: x-small; background-color: rgb(204, 255, 255);">
                    <td style="text-align: right; width: 20%;">
                        <span>
                            <span style="font-weight: bold; color: black;">ระยะที่ทำได้</span>
                            <img style="width: 15px; height: 15px; vertical-align: middle;" alt="" src="ar.png">
                        </span>
                    </td>
                    <td style="text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">ระยะทาง</span>
                            <span>
                                <?php
                                if ($deviceD == "globalsat") {
                                    $spd_unit = 1;
                                    $acc_limit = 2;
                                }
                                elseif ($deviceD == "3dgps") {
                                    $spd_unit = 1.825;
                                    $acc_limit = 2;
                                }
                                elseif ($deviceD == "dg200") {
                                    $spd_unit = 1;
                                    $acc_limit = 1.5;}
                                elseif ($deviceD == "gps01") {
                                    $spd_unit = 1.825;
                                    $acc_limit = 1.5;
                                }
                                elseif ($deviceD == "DLT01") {
                                    $spd_unit = 1;
                                    $acc_limit = 1.5;
                                }
                                elseif ($deviceD == "DLT02") {
                                    $spd_unit = 1;
                                    $acc_limit = 1.5;
                                }
                                elseif ($deviceD == "DLT03") {
                                    $spd_unit = 1;
                                    $acc_limit = 1.5;
                                }
                                elseif ($deviceD == "RV3D") {
                                    $spd_unit = 1;
                                    $acc_limit = 1.5;
                                }
                                elseif ($deviceD == "ID0002") {
                                    $spd_unit = 1;
                                    $acc_limit = 1.5;
                                }

                                for ($i=1; $i<($num_rows); $i++) {
                                    $time_s = explode(":", $time_i[$i-1]);
                                    $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                    $time_s = explode(":", $time_i[$i]);
                                    $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                    $sec_del = $sec2 - $sec1;

                                    if ($sec_del >= 10) {
                                        $sec_del = 0;
                                    }

                                    $time_sum =$time_sum + $sec_del;
                                    if ($deltaT!=0) {
                                        $speed_avg = $speed_i[$i]+$speed_avg;
                                    }
                                }

                                if ($time_sum!=0) {
                                    $speed_avg = round(($dis_sum/$time_sum),2);
                                }
                                else {
                                    $speed_avg = 0;
                                }

                                $dis_sum_km = round((abs($dis_sum)/1000),2);

                                echo "$dis_sum_km km";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; width: 17%;">
                        <span>
                            <span style="font-weight: bold;">ความเร็ว</span>
                            <span>
                                <?php
                                $time_s = explode(":", $time_i[1]);
                                $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                $time_s = explode(":", $time_i[$num_rows]);
                                $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                                $deltaT = round(($sec2 - $sec1),2);
                                $hour_trip = floor($deltaT/3600);
                                $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
                                if ($deltaT<60) {
                                    $sec_trip = $deltaT;
                                }
                                elseif ((60<=$deltaT) AND ($deltaT<3600)) {
                                    $sec_trip = ($deltaT - ($min_trip*60));
                                }
                                elseif ($deltaT>=3600) {
                                    $sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));
                                }
                                if ($deltaT!=0) {
                                    $speed_avg3 = round((3600*$dis_sum_km/$deltaT),2);
                                }
                                else {
                                    $speed_avg3 = 0;
                                } echo "$speed_avg3 km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; width: 17%;">
                        <span>
                            <span style="font-weight: bold;">ระยะเวลา</span>
                            <span>
                                <?php
                                echo "$hour_trip hr $min_trip min $sec_trip sec";
                                ?>
                            </span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table style="text-align: left; margin-left: auto; margin-right: auto; width: 100%; height: 542px;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="background-color: rgb(255, 255, 204); width: 45%; height: 542px;" valign="top">
                        <table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr align="center" style="font-family: Arial; font-size: small;">
                                    <td style="background-color: rgb(153, 153, 153); width: 195px;" colspan="4" rowspan="1">
                                        <span style="color: rgb(255, 255, 255); font-weight: bold;">แบบประเมินพฤติกรรมการขับขี่</span>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153);">
                                    <td colspan="2" style="width: 60%;">
                                        <span style="font-weight: bold;"> รายการประเมิน</span>
                                    </td>
                                    <td style="width: 20%; text-align: center;">
                                        <span style="font-weight: bold;">star</span>
                                    </td>
                                    <td style="width: 20%; text-align: center;">
                                        <span style="font-weight: bold;">score</span>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201);">
                                    <td style="width: 195px;">
                                        <span> 1.การเร่งและชะลอที่นุ่มนวล </span>
                                        <?php
                                        include ("f2_acc_function.php");
                                        $sc1 = $acc_num_1;
                                        ?>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="vertical-align: middle; text-align: right;">
                                        <?php
                                        if ($sc1<2) {
                                            $score1_i = 3;
                                        }
                                        elseif (($sc1>=2) AND ($sc1<3)) {
                                            $score1_i = 2;
                                        }
                                        elseif (($sc1>=3) AND ($sc1<4)) {
                                            $score1_i = 1;
                                        }
                                        elseif (($sc1>=4) AND ($sc1<5)) {
                                            $score1_i = 0;
                                        }
                                        elseif ($sc1>=5) {
                                            $score1_i = 0;
                                        }

                                        for ($j=1; $j<=$score1_i; $j++) {
                                            echo " <img src='star.png' width='16' height='16'/>";
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style="font-weight: bold;">
                                            <?php
                                            echo "$acc_num_1";
                                            $count1 = $acc_num_1;
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153);">
                                    <td style="width: 195px;">
                                        <span>2.ความเร็วตามกำหนด</span>
                                        <?php
                                        include ("f2_speed_function.php");
                                        $sc2 = $score2;
                                        $sc2_1 = $score2_1;
                                        $sc2_2 = $score2_2;
                                        $sc2_3 = $score2_3;
                                        $sc2_4 = $score2_4;
                                        ?>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td rowspan="5" style="vertical-align: middle; width: 64px; text-align: right;">
                                        <?php
                                        if ($sc2<2) { $score2_i = 4; }
                                        elseif (($sc2>=2) AND ($sc2<7)) { $score2_i = 3; }
                                        elseif (($sc2>=7) AND ($sc2<13)) { $score2_i = 2; }
                                        elseif (($sc2>=13) AND ($sc2<18)) { $score2_i = 1; }
                                        elseif ($sc2>=18) { $score2_i = 0; }

                                        for ($j=1; $j<=$score1_i; $j++) {
                                            echo " <img src='star.png' width='16' height='16'/>";
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        $speed_over = $osp1+ $osp2+$osp3 +$osp4;
                                        echo "<b> $score2 </b>";
                                        $count2 = $speed_over;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">2.1  เกิน 81-88 กม./ชม.</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$osp1";
                                        $count3 = $osp1;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">2.2 เกิน 89-96 กม./ชม.</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$osp2";
                                        $count4 = $osp2;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">2.3 เกิน 97-104 กม./ชม.</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$osp3";
                                        $count5 = $osp3;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">2.4 เกิน 104 กม./ชม.</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$osp4";
                                        $count6 = $osp4;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201);">
                                    <td style="width: 195px;">
                                        <span>3.การเลี้ยวอย่างนุ่มนวล</span>
                                        <?php
                                        include ("f2_turn_function.php");
                                        $sc3 = $total2;
                                        $sc4 = $total3;
                                        $count7_1 = $total2;
                                        $count7_2 = $total3;
                                        ?>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td rowspan="3" style="vertical-align: middle; width: 64px; text-align: right;">
                                        <?php
                                        $scT=$sc3+$sc4;
                                        if ($scT<2) { $score1_i = 3; }
                                        elseif (($scT>=2) AND ($scT<3)) { $score1_i = 2; }
                                        elseif (($scT>=3) AND ($scT<4)) { $score1_i = 1; }
                                        elseif (($scT>=4) AND ($scT<5)) { $score1_i = 0; }
                                        elseif ($scT>=5) { $score1_i = 0; }
                                        for ($j=1; $j<=$score1_i; $j++) {
                                            echo " <img src='star.png' width='16' height='16'/>";
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 36px; text-align: center;">
                                        <?php
                                        $totalL = $total2+$total3;
                                        echo "<b> $totalL </b>";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">3.1 การเลี้ยวอย่างนุ่มนวล</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$sc3";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">3.2 การกลับรถอย่างปลอดภัย </span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="width: 36px; text-align: center;">
                                        <?php
                                        echo "$sc4";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153);">
                                    <td style="width: 195px;">
                                        <span> 4.การประพฤติในเขตที่กำหนด</span>
                                        <?php
                                        include ("f2_zone_function.php");
                                        ?>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td rowspan="6" style="vertical-align: middle; width: 64px; text-align: right;">
                                        <?php
                                        if ($scz<2) { $score8_i = 4; }
                                        elseif (($scz>=2) AND ($scz<7)) { $score8_i = 3; }
                                        elseif (($scz>=7) AND ($scz<13)) { $score8_i = 2; }
                                        elseif (($scz>=13) AND ($scz<18)) { $score8_i = 1; }
                                        elseif ($scz>=18) { $score8_i = 0; }
                                        for ($j=1; $j<=$score8_i; $j++) {
                                            echo "<img src='star.png' width='16' height='16'/>";
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        $totalL2 = ($spd_zone_cnt + $cross_cnt3 + $stop_cnt2 + $tstop_cnt2 + $nstop_cnt2)/10;
                                        echo "<b> $totalL2 </b>";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">4.1 การใช้ความเร็วที่เหมาะสม</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="width: 36px;">
                                        <?php
                                        echo "<b> $spd_zone_cnt </b>";
                                        $count8 = $spd_zone_cnt;
                                        $sc5 = $spd_zone_cnt;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">4.2 พร้อมที่จะหยุดที่ทางแยก</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "<b> $cross_cnt3 </b>";
                                        $count9 = $cross_cnt3;
                                        $sc6 = $cross_cnt3;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">4.3 หยุดรถที่ไฟสัญญาณ</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "<b> $stop_cnt2 </b>";
                                        $count10 = $stop_cnt2;
                                        $sc7 = $stop_cnt2;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">4.4 จอดอย่างปลอดภัยใกล้ทางรถไฟ</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "<b> $tstop_cnt2 </b>";
                                        $count11 = $tstop_cnt2;
                                        $sc9 = $tstop_cnt2;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">
                                    <td style="width: 195px;">
                                        <span style="margin-left: 10px;">4.5 การจอดรถในที่ห้ามจอด</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "<b> $nstop_cnt2 </b>";
                                        $count12 = $nstop_cnt2;
                                        $sc8 = $nstop_cnt2;
                                        $scz = $sc5+$sc6+$sc7+$sc8+$sc9;
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201);">
                                    <td style="width: 195px;">
                                        <span>5.การประพฤติในทางลาดชัน</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="width: 64px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        /* for ($i=1; $i<=$stp_point_cnt; $i++) {
                                            if ($delDis[$i]!=0) {$gradeH[$i] = (($AccSlope[$i] / $delDis[$i])*100);}
                                            $gradeH[$i] = round($gradeH[$i],2);
                                            if ((abs($gradeH[$i])>=4)) {$slope1 = $slope1+1;}
                                        }*/
                                        echo "$slope_dan";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201);">
                                    <td style="width: 195px;">
                                        <span>6. การเปลี่ยนช่องจราจร</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="width: 64px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$LaneC_over ($LaneC)";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(255, 255, 201);">
                                    <td style="width: 195px;">
                                        <span>7. การแซง</span>
                                    </td>
                                    <td style="width: 9px;"></td>
                                    <td style="width: 64px;"></td>
                                    <td style="text-align: center; width: 36px;">
                                        <?php
                                        echo "$LaneC2_over";
                                        ?>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial;">
                                    <td style="background-color: rgb(204, 204, 204); text-align: center; font-weight: bold; width: 195px;">
                                        <span style="font-size: small;">คะแนนรวมการละเมิด</span><br>
                                        <span style="font-size: small; color: red;">เส้นทาง&nbsp;
                                            <?php
                                            echo " $tripdir1 ";
                                            ?>
                                        </span><br>
                                        <span style="font-size: x-small; color: #FF0066;">
                                            <?php
                                            echo " Begine : $latB1 - $lonB1 ";
                                            ?>
                                        </span><br>
                                        <span style="font-size: x-small; color: #FF0066;">
                                            <?php
                                            echo " End : $latB2 - $lonB2";
                                            ?>
                                        </span>
                                    </td>
                                    <td style="background-color: white; font-weight: bold; text-align: center; width: 9px;">
                                        <?php
                                        if (($TimeBegin>="06:00:00") AND ($TimeEnd<="18:30:00")) {
                                            $dayfont = "&#9788";
                                            $daycolor = "#FF4000";
                                            $daylight = "sun.png";
                                        } else {
                                            $dayfont = "&#9789";
                                            $daycolor = "#FFFF00";
                                            $daylight = "moon.png";
                                        }
                                        echo "<img src='$daylight' width='22' height='22'/>";
                                        ?>
                                    </td>
                                    <td style="background-color: white; text-align: center; width: 64px;">
                                        <?php
                                        $totlescore = $sc1+$sc2+$sc3+$sc4+ $totalL2+ $slope1 + $LaneC_over +$LaneC2_over;
                                        if ($totlescore<=10) { $star_i = 3;}
                                        elseif ((10<$totlescore) AND ($totlescore<=20)) { $star_i = 2; }
                                        elseif ((20<$totlescore) AND ($totlescore<=30)) { $star_i = 1;;}
                                        elseif ($totlescore>30) { $star_i = 0;}
                                        for ($j=1; $j<=$star_i; $j++) {
                                            echo "<img src='bus.png' width='30' height='30'/>";
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 36px; text-align: center; background-color: rgb(204, 204, 204); vertical-align: middle;">
                                        <?php
                                        if ($totlescore<=10) {
                                            $GYR = "light0.png";
                                        } elseif ((10<$totlescore) AND ($totlescore<=20)) {
                                            $GYR = "light1.png";
                                        } elseif ((20<$totlescore) AND ($totlescore<=30)) {
                                            $GYR = "light2.png";
                                        } elseif ($totlescore>30) {
                                            $GYR = "light3.png";
                                        }
                                        echo "<b> $totlescore </b>";
                                        echo "<img src='$GYR' width='20' height='20'/>";
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="text-align: center; width: 55%; vertical-align: top; height: 542px;">
                        <table style="background-color: white; font-family: Arial; width: 100%; text-align: left; margin-left: auto; margin-right: 0px;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr>
                                    <th colspan="6" rowspan="1" style="background-color: rgb(51, 204, 255); font-size: small;">
                                        ระดับคะแนนที่ได้เปรียบเทียบ
                                        <span style="font-style: italic;"> คะแนนเฉลี่ย </span>
                                        (NORM) ของเส้นทาง
                                        <?php
                                        echo "$rout_1";
                                        ?>
                                    </th>
                                </tr>
<tr>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center; font-family: Arial;" valign="undefined"><small><small>Speed</small></small></td>
<td style="text-align: center; font-family: Arial;" valign="undefined"><small><small>Acc</small></small></td>
<td style="text-align: center;" valign="undefined"><small><small style="font-family: Arial;">Turn</small></small></td>
<td style="font-family: Arial; text-align: center;" valign="undefined"><small><small>Zone</small></small></td>
<td style="font-family: Arial; text-align: center;" valign="undefined"><small><small>Total</small></small></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><small><small style="font-family: Arial;">max.</small></small></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $spdMax";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $accMax";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $turnMax ";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $spdMax ";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='1'> $scoreMax ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><small><small style="font-family: Arial;">avg.</small></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $spd_SA ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $acc_SA ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $turn_SA";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $zone_SA ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $score_SA ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><small><small style="font-family: Arial;">scr.</small></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $score2";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $acc_num_1";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $totalL ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $totalL2 ";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='1'> $totlescore "; if ($totlescore<=10) { $GYR = "light0.png";} elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";} elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";} elseif ($totlescore>30) { $GYR = "light3.png";} echo "<img src='$GYR' width='12' height='12'/>";?></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center;"><?php if ($spdMax!=0) {$spd_2 = ($score2/$spdMax)*100;} else {$spd_2 = 0;} $spd_2j = 100-$spd_2; $spd_2 = round($spd_2,2); for ($i=1; $i<=9; $i++) { $jk2 = $i*10; $jk1 = $jk2-10; if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>";} } $speed_2 = $spd_2;?></td>
<td style="text-align: center;"><?php if ($accMax!=0) {$spd_2 = ($acc_num_1/$accMax)*100;} else {$spd_2 = 0;} $spd_2j = 100-$spd_2; $spd_2 = round($spd_2,2); for ($i=1; $i<=9; $i++) { $jk2 = $i*10; $jk1 = $jk2-10; if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>";} } $acc_2 = $spd_2;?></td>
<td style="text-align: center;"><?php if ($turnMax!=0) {$spd_2 = ($totalL/$turnMax)*100;} else {$spd_2 = 0;} $spd_2j = 100-$spd_2; $spd_2 = round($spd_2,2); for ($i=1; $i<=9; $i++) { $jk2 = $i*10; $jk1 = $jk2-10; if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>";} } $turn_2 = $spd_2;?></td>
<td style="text-align: center;"><?php if ($zoneMax!=0) {$spd_2 = ($totalL2/$zoneMax)*100;} else {$spd_2 = 0;} $spd_2j = 100-$spd_2; $spd_2 = round($spd_2,2); for ($i=1; $i<=9; $i++) { $jk2 = $i*10; $jk1 = $jk2-10; if ($spd_2j<$jk2) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>";} } $zone_2 = $spd_2;?></td>
<td style="text-align: center;"><?php if ($totlescore>=60) {$ty = 60;} else {$ty = $totlescore;} $spd_2 = ($ty/60)*100; $spd_2j = 100-$spd_2; $spd_2 = round($spd_2,2); if ($ty>=40) {echo "<img src='a4.png'/><br>"; } else {echo "<img src='a3.png'/><br>"; } if (($ty>=30) AND ($ty<40)) {echo "<img src='a4.png'/><br>"; } else {echo "<img src='a3.png'/><br>"; } if (($ty<30) AND ($ty>=27.5)) {echo "<img src='a5.png'/><br>"; } else {echo "<img src='a6.png'/><br>"; } if (($ty<27.5) AND ($ty>=25)) {echo "<img src='a5.png'/><br>"; } else {echo "<img src='a6.png'/><br>"; } if (($ty<25) AND ($ty>=22.5)) {echo "<img src='a5.png'/><br>"; } else {echo "<img src='a6.png'/><br>"; } if (($ty<22.5) AND ($ty>=20)) {echo "<img src='a5.png'/><br>"; } else {echo "<img src='a6.png'/><br>"; } if (($ty<20) AND ($ty>=16.67)) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>"; } if (($ty<16.67) AND ($ty>=13.33)) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>"; } if (($ty<13.33) AND ($ty>=10)) {echo "<img src='a2.png'/><br>"; } else {echo "<img src='a1.png'/><br>"; } ?></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small>Speed<br>
<?php echo "<font face='Arial' size='1'>($speed_2%)";?><br>
</small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small>Acc<br>
<?php echo " <font face='Arial' size='1'> ($acc_2%)";?></small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small>&nbsp;Turn<br>
<?php echo " <font face='Arial' size='1'>($turn_2%)";?></small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small>Zone<br>
<?php echo " <font face='Arial' size='1'> ($zone_2%)"; ?></small></small></td>
<td style="text-align: center; font-family: Arial; font-weight: bold;" valign="undefined"><small><small>Total<br>
<?php echo "$deviceD";?></small></small></td>
</tr>
<tr align="center">
<td style="text-align: center;" colspan="6" rowspan="1"><small><small><span style="font-family: Arial;"></span></small></small>&nbsp;&nbsp;<?php /* include ("f2_map_function.php"); */
/*include ("f2_int_speedG1_function.php");*/
echo "<font face='Arial' size='120' color='#0489B1'> <b> Score $totlescore </b>";
$A = $acc_num_1;
$S = $osp1 + $osp2 + $osp3 + $osp4 ;
$T = $total2 + $total3;
$Z = $spd_zone_cnt + $cross_cnt3 + $stop_cnt2 + $tstop_cnt2 + $nstop_cnt2;
if (($S<=25) AND ($A<=3) AND ($T<=6) AND ($Z<41) ) {$Dtype = "T2_lion.png"; $Lion01 = $Lion01+1;} elseif (($S>=20) AND ($A>=3) AND ($T>=8) AND ($Z>=35)) {$Dtype = "rhino.jpg"; $Rhnio01 = $Rhnio01+1;}
elseif (($S>=14) AND ($A>=4) AND ($T>=4) AND ($Z<37) ) {$Dtype = "bull01.jpg"; $Bull01 = $Bull01+1;}
elseif ((($S>=14) AND ($T>=4)) OR ($S>=30) ) {$Dtype = "tiger01.jpg"; $Tiger01 = $Tiger01+1;}
echo "<img src='$Dtype' width='30' height='30'/> <br>";
?>
&nbsp;<?php if ($totlescore<=10) { $GYR = "light0.png";}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";}
elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";}
elseif ($totlescore>30) { $GYR = "light3.png";}
if (($timeStp>="06:00:00") AND ($timeStp<="18:30:00")) {
$dayfont = "&#9788"; $daycolor = "#FF4000"; $daylight = "sun.png";
}
else {
$dayfont = "&#9789"; $daycolor = "#FFFF00"; $daylight = "moon.png";}
/* Write Total Score to Database/File */
$score_pack1 = array($sc1,$sc2,$sc2_1,$sc2_2,$sc2_3,$sc2_4,$sc3,$sc4,$sc5,$sc6,$sc7,$sc8,$sc9,$totlescore);
$score_pk1 = implode(":" , $score_pack1);
$score_pack2 = array($count1,$count2,$count3,$count4,$count5,$count6,$count7_1,$count7_2,$count8,$count9,$count10,$count11,$count12);
$score_pk2 = implode(":" , $score_pack2);
/* $db = mysql_connect("53476f055e81994c02000008-nectec.clouddd.in.th:38096","adminlYkzegJ","MaLQvrNyPEpn"); */

$objConnect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
$objDB = mysql_select_db(DB_NAME);

$delsql = " DELETE FROM `selectscore` WHERE (`device` = '$id') AND (`date`= '$DateBegin') AND (`time1`= '$Time1'); ";
$objQuery = mysql_query($delsql);

$strSQL = "INSERT INTO `selectscore` (`timestmp`,`index`,`device`,`date`,`time1`,`time2`,`pack1`,`pack2`,`tripdir`,`daylight`,`speedavg`,`distanceavg`,`timeavg` )
VALUES ( NOW( ), '3', '$id','$DateBegin','$Time1','$Time2','$score_pk1','$score_pk2','$tripdir1','$daylight','$speed_avg3','$dis_sum_km','$deltaT');;";
$objQuery = mysql_query($strSQL);
mysql_close($objConnect);
?> </td>
</tr>
</tbody>
</table>

&nbsp;</td>
</tr>
</tbody>
</table>
</form>
</body></html>