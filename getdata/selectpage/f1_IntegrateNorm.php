<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require(dirname(__FILE__)."/../../config.php");
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
    <form action="f1_integrate.php" method="post">
        <table style="background-color: white; width: 100%; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width: 285px; background-color: white;">&nbsp;</td>
                    <td style="text-align: right; width: 237px;" colspan="1" rowspan="1"></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="1" style="width: 285px; background-color: white;">
                        <table style="width: 100%;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr style="font-family: Arial; font-size: small;">
                                    <th style="color: white; background-color: rgb(51, 102, 255);">การทดสอบ<br>(จำนวนรอบ)</th>
                                    <th style="color: white; background-color: rgb(51, 102, 255);">เส้นทาง</th>
                                    <th style="color: white; background-color: rgb(51, 102, 255);">คะแนนรวมเฉลี่ย</th>
                                    <th style="color: white; background-color: rgb(51, 102, 255);">คะแนนเฉลี่ย<br>ต่อ 100 ก.ม.</th>
                                    <th style="color: white; background-color: rgb(51, 102, 255);">ระยะทางเฉลี่ย<br>(ก.ม.)</th>
                                    <th style="color: white; background-color: rgb(51, 102, 255);">ระยะเวลาเฉลี่ย<br>(hh:mm:ss)</th>
                                    <th style="background-color: rgb(51, 204, 255);">คะแนนเฉลี่ย<br>ด้านความเร็ว</th>
                                    <th style="background-color: rgb(51, 204, 255);">คะแนนเฉลี่ย<br>ด้านอัตราเร่ง</th>
                                    <th style="background-color: rgb(51, 204, 255);">คะแนนเฉลี่ย<br>ด้านการเลี้ยว</th>
                                    <th style="background-color: rgb(0, 204, 204);">คะแนนเฉลี่ย<br>ด้านโซน</th>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(204, 255, 255); text-align: center;">
                                    <td>
                                        <span>
                                            <?php include ("f2_norm_function.php");?>
                                            <span style="font-weight: bold;">Test 21</span>
                                            <span>
                                                <?php
                                                echo " KSU ";
                                                ?>
                                            </span>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $routedir[24] ($nums[24]) ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $score[24] ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $score100[24] ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $dis_norm[24] ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            $deltaT = round($time[24],0);

                                            $hour_trip1 = floor($deltaT/3600);
                                            $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

                                            if ($deltaT<60) {
                                                $sec_trip1 = $deltaT;
                                            }
                                            elseif ((60<=$deltaT) AND ($deltaT<3600)) {
                                                $sec_trip1 = ($deltaT - ($min_trip1*60));
                                            }
                                            elseif ($deltaT>=3600) {
                                                $sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));
                                            }

                                            $time_a = "$min_trip1 min $sec_trip1 sec";

                                            echo " $time_a ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $spd_SA[24] ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $acc_SA[24] ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $turn_SA[24] ";
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $zone_SA[24] ";
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr style="font-family: Arial; font-size: small; background-color: rgb(102, 255, 255); text-align: center;">
                                    <td colspan="1" rowspan="2">
                                        <span>
                                            <span style="font-weight: bold;">Test 18 </span><br>
                                            <span>
                                                <?php
                                                echo " สงขลา ";
                                                ?>
                                            </span>
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            echo " $routedir[18] ($nums[18]) ";
                                            ?>
                                        </span></td><td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score[18] </font>";?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[18] </font>";?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[18] </font>";
?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php $deltaT = round($time[18],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[18] </font>";

?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[18] </font>";?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[18] </font>";?></td><td style="background-color: rgb(102, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[18] </font>";?></td></tr><tr><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[19] ($nums[19]) </font>";?></td><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score[19] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[19] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[19] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php $deltaT = round($time[19],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[19] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[19] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[19] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[19] </font>";?></td></tr><tr><td colspan="1" rowspan="2" style="background-color: rgb(153, 255, 255); text-align: center;"><small><span style="font-weight: bold;">Test1<br></span>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3588;&#3621;&#3629;&#3591;&#3627;&#3621;&#3623;&#3591; </font>";?></small></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[1] ($nums[1]) </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[1] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[1] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[1] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php $deltaT = round($time[1],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[1] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[1] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[1] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[1] </font>";?></td></tr><tr>

<td style="text-align: center; font-family: Arial; background-color: rgb(204, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[2] ($nums[2]) </font>";?><br></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[2] </font>";?></td><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[2] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[2] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php $deltaT = round($time[2],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td>

<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[2] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[2] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[2] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[2] </font>";?></td>
</tr>
<tr>
<td colspan="1" rowspan="2" style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small><span style="font-weight: bold;">Test2</span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3609;&#3588;&#3619;&#3619;&#3634;&#3594;&#3626;&#3637;&#3617;&#3634; </font>";?></small></td>
<td style="text-align: center; font-family: Arial; background-color: rgb(102, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[3] ($nums[3]) </font>";?><br></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[3] </font>";?></td><td style="text-align: center; background-color: rgb(102, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[3] </font>";?></td>
<td style="text-align: center; background-color: rgb(102, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[3] </font>";?></td>
<td style="text-align: center; background-color: rgb(102, 255, 255);"><?php $deltaT = round($time[3],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td>

<td style="text-align: center; background-color: rgb(102, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[3] </font>";?></td>
<td style="text-align: center; background-color: rgb(102, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[3] </font>";?></td>
<td style="text-align: center; background-color: rgb(102, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[3] </font>";?></td>
<td style="text-align: center; background-color: rgb(102, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[3] </font>";?></td>
</tr>
<tr><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[4] ($nums[4]) </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[4] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[4] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[4] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php $deltaT = round($time[4],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[4] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[4] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[4] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[4] </font>";?></td></tr><tr><td style="text-align: center; background-color: rgb(153, 255, 255);" colspan="1" rowspan="2"><small><span style="font-weight: bold;">Test3</span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3609;&#3588;&#3619;&#3619;&#3634;&#3594;&#3626;&#3637;&#3617;&#3634; </font>";?></small></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[5] ($nums[5]) </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[5] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[5] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[5] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php $deltaT = round($time[5],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[5] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[5] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[5] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[5] </font>";?></td></tr><tr>

<td style="text-align: center; font-family: Arial; background-color: rgb(204, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[6] ($nums[6]) </font>";?><br></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[6] </font>";?></td><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[6] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[6] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php $deltaT = round($time[6],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td>

<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[6] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[6] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[6] </font>";?></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[6] </font>";?></td>
</tr>
<tr>
<td colspan="1" rowspan="2" style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small><span style="font-weight: bold;">Test4</span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3648;&#3594;&#3637;&#3618;&#3591;&#3619;&#3634;&#3618; </font>";?></small></td>
<td style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[7] ($nums[7]) </font>";?><br></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[7] </font>";?></td><td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[7] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[7] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php $deltaT = round($time[7],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td>

<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[7] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[7] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[7] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[7] </font>";?></td>
</tr>
<tr><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $routedir[8] ($nums[8]) </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[8] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[8] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[8] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php $deltaT = round($time[8],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";
?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[8] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[8] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[8] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[8] </font>";?></td></tr><tr><td colspan="1" rowspan="2" style="background-color: rgb(153, 255, 255); text-align: center;"><small><span style="font-weight: bold;">Test6</span><br><?php echo "<font face='Arial' size='2' color='black'> &#3626;&#3640;&#3650;&#3586;&#3607;&#3633;&#3618; </font>";?></small></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[9] ($nums[9]) </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[9] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[9] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[9] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php $deltaT = round($time[9],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[9] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[9] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[9] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[9] </font>";?></td></tr><tr><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[10] ($nums[10]) </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[10] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[10] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[10] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php $deltaT = round($time[10],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[10] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[10] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[10] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[10] </font>";?></td></tr><tr><td style="text-align: center; background-color: rgb(153, 255, 255);" colspan="1" rowspan="2"><small><span style="font-weight: bold;">Test7</span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3648;&#3594;&#3637;&#3618;&#3591;&#3651;&#3627;&#3617;&#3656; </font>";?></small></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[11] ($nums[11]) </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[11] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[11] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[11] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php $deltaT = round($time[11],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[11] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[11] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[11] </font>";?></td><td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[11] </font>";?></td></tr><tr>

<td style="text-align: center; font-family: Arial; background-color: rgb(204, 255, 255);"><small><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[12] ($nums[12]) </font>";?><br></small></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[12] </font>";?></td><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[12] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[12] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php $deltaT = round($time[12],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td>

<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[12] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[12] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[12] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[12] </font>";?></td>
</tr>
<tr>
<td colspan="1" rowspan="2" style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small style="font-weight: bold;">&nbsp;</small><small><span style="font-weight: bold;">Test8</span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3626;&#3640;&#3619;&#3634;&#3625;&#3598;&#3619;&#3660;&#3608;&#3634;&#3609;&#3637;&#3656; </font>";?></small></td>
<td style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[13] ($nums[13]) </font>";?><br></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[13] </font>";?></td><td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[13] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[13] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php $deltaT = round($time[13],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td>

<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[13] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[13] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[13] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[13] </font>";?></td>
</tr>
<tr>

<td style="text-align: center; font-family: Arial; background-color: rgb(204, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[14] ($nums[14]) </font>";?><br></small></td>
<td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[14] </font>";?></td><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[14] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[14] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php $deltaT = round($time[14],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td>

<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[14] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[14] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[14] </font>";?></td>
<td style="text-align: center; background-color: rgb(204, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[14] </font>";?></td>
</tr>
<tr>
<td colspan="1" rowspan="2" style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small style="font-weight: bold;">&nbsp;</small><small><span style="font-weight: bold;">Test8B</span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3626;&#3640;&#3619;&#3634;&#3625;&#3598;&#3619;&#3660;&#3608;&#3634;&#3609;&#3637;&#3656; B </font>";?></small></td>
<td style="text-align: center; font-family: Arial; background-color: rgb(153, 255, 255);"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[15] ($nums[15]) </font>";?><br></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[15] </font>";?></td><td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $score100[15] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[15] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php $deltaT = round($time[15],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td>

<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[15] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[15] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[15] </font>";?></td>
<td style="text-align: center; background-color: rgb(153, 255, 255);"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[15] </font>";?></td>
</tr><tr><td style="background-color: rgb(204, 255, 255); text-align: center;"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[16] ($nums[16]) </font>";?><br></small></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[16] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[16] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[16] </font>";?></td><td style="text-align: center; background-color: rgb(204, 255, 255);"><?php $deltaT = round($time[16],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[16] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[16] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[16] </font>";?></td><td style="background-color: rgb(204, 255, 255); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[16] </font>";?></td></tr><tr><td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(255, 204, 153);"><small><span style="font-weight: bold;">Test9 </span><br>&nbsp;<?php echo "<font face='Arial' size='2' color='black'> &#3605;&#3634;&#3585; (&#3649;&#3617;&#3656;&#3626;&#3629;&#3604;) </font>";?></small></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><small><?php echo "<font face='Arial' size='2' color='black'> $routedir[21] ($nums[21]) </font>";?><br></small></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[21] </font>";?></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[21] </font>";?></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[21] </font>";?></td><td style="text-align: center; background-color: rgb(255, 204, 153);"><?php $deltaT = round($time[21],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[21] </font>";?></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[21] </font>";?></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[21] </font>";?></td><td style="background-color: rgb(255, 204, 153); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[21] </font>";?></td></tr><tr><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $routedir[22] ($nums[22]) </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score[22] </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $score100[22] </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $dis_norm[22] </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php $deltaT = round($time[22],0);

  $hour_trip1 = floor($deltaT/3600);
  $min_trip1 = ( (floor($deltaT/60) ) - ($hour_trip1 * 60));

  if ($deltaT<60) {$sec_trip1 = $deltaT;}
  elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT - ($min_trip1*60));}
  elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT - ($min_trip1*60) - ($hour_trip1*3600));}
 
  $time_a = "$hour_trip1 hr $min_trip1 min $sec_trip1 sec";

echo "<font face='Arial' size='2' color='black'> $time_a </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $spd_SA[22] </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $acc_SA[22] </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $turn_SA[22] </font>";?></td><td style="background-color: rgb(255, 255, 204); text-align: center;"><?php echo "<font face='Arial' size='2' color='black'> $zone_SA[22] </font>";?></td></tr>
</tbody>
</table>
<br>
    <!--
<table style="background-color: white; width: 1010px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td colspan="3" rowspan="1" style="width: 285px; background-color: white;"><br><table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2"><tbody><tr><td><?php //include ("f2_scoreInt_chart.php");?></td><td></td></tr><tr><td></td><td></td></tr></tbody></table><br></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>-->
</form>
</body></html>