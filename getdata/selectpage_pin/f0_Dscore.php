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
<form style="height: 690px;" action="f1_main.php" method="get">
 <input type="hidden" name="deviceid" value="<?php print $_GET["deviceid"]; ?>">
 <input type="hidden" name="date1" value="<?php print $_GET["date1"]; ?>">
 <input type="hidden" name="time1" value="<?php print $_GET["time1"]; ?>">
 <input type="hidden" name="time2" value="<?php print $_GET["time2"]; ?>">
<table style="background-color: white; width: 800px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="width: 151px;" colspan="3" rowspan="1"><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small><small></small><small><span style="font-weight: bold;"> <span style="font-style: italic;"></span></span></small><small>
</small><small><span style="font-weight: bold;"><span style="font-style: italic;"> &nbsp;</span></span></small><small><span style="font-weight: bold;"><?php
   require(dirname(__FILE__)."/../../config.php");

   $deviceid = $_GET["deviceid"];
   $Date1 = $_GET["date1"];
   $time1 = $_GET["time1"];
   $time2 = $_GET["time2"];

   $Time1 = $time1;
   $Time2 = $time2;

   include ("f2_getdata.php");
?>
</span></small><small><span style="font-weight: bold;"><span style="font-style: italic;">Driving Score</span>
&nbsp;Function&nbsp;</span></small><small style="font-family: Arial;"><?php $time_s = explode(":", $time_i[1]);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$time_s = explode(":", $time_i[$num_rows]);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$deltaT = $sec2 - $sec1;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));

if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}

for ($i=1; $i<($num_rows); $i++) {
$time_s = explode(":", $time_i[$i-1]);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$time_s = explode(":", $time_i[$i]);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$sec_del = $sec2 - $sec1;

if ($sec_del<=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); }

/* $distance = $velocity * $sec_del;

$dis_sum = $distance + $dis_sum;*/

 }

if ($deltaT!=0) {$speed_avg2 = ($dis_sum/$deltaT) * (3600/1000);} if ($num_rows<0) {$n=0;}
else {$n=$num_rows;}
echo "<font face='Arial' size='1'> ($n)"?></small>
</td>
<td style="text-align: left; width: 162px;" rowspan="1" colspan="3"><small><span style="font-weight: bold;">Name</span>
:&nbsp;</small><small><?php echo"$deviceName";?>
&nbsp;<span style="font-weight: bold;">&nbsp;</span></small><small>&nbsp;&nbsp;
<span style="font-weight: bold;">Date</span>
:
&nbsp;<small style="color: black;"><?php $dd = explode("-",$Date1);
$ddf = array($dd[2],$dd[1],$dd[0]);
$ddg = implode('-',$ddf);
echo "$ddg";
$DateBegin=$Date1;?></small>
&nbsp;<span style="font-weight: bold;">Time&nbsp;</span><small></small></small><small>&nbsp;</small>&nbsp;<small><small>
&nbsp;&nbsp;</small></small><small><span style="font-family: Arial;"></span></small></td>
</tr>
<tr>
<td style="background-color: rgb(102, 204, 204); text-align: center; width: 47px;" colspan="1" rowspan="2"><input style="height: 35px;" onclick="window.open('f2_map_function.php','mywindow')" name="map" value="Map" type="button"></td>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(102, 204, 204); width: 98px;"><small><small></small></small><small style="font-weight: bold;"><small><span style="font-family: Arial;"><span style="font-style: italic;"></span><big><span style="color: white;"> </span></big></span></small></small><small><small><span style="font-family: Arial;"><input style="width: 50px;" onclick="window.open('f1_turnAnalytic.php')" value="Rout" name="Behavior" type="button"></span></small></small><small style="font-weight: bold;"><small><span style="font-family: Arial;"><big><span style="color: white;">
</span><br>
&nbsp;<?php $tripdir1=$tripdir;
echo "<font face='Arial' size='2'> $tripdir <br> ";?></big></span></small></small><small style="font-weight: bold;"><small><span style="font-family: Arial;"></span></small></small></td>
<td colspan="1" rowspan="1" style="background-color: rgb(102, 204, 204); text-align: left; width: 151px;"><small><small><span style="font-family: Arial;">&nbsp;<span style="font-weight: bold;">&nbsp;</span><span style="color: white; font-weight: bold;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</span></span></small></small><span style="color: white;">
</span><small style="color: white;"><small><span style="font-family: Arial;"><?php /*include ("f2_avg_function.php");*/
echo "<font face='Arial' size='2' color='white'> $score_SA ($num_score)";
?></span></small></small><small><small><span style="font-family: Arial;"></span></small></small></td>
<td style="text-align: center; background-color: rgb(102, 204, 204); color: white; font-weight: bold; width: 162px;"><small><small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;</span><span style="font-family: Arial;"></span></small></small>
<?php echo "<font face='Arial' size='1'> $dis_a km";
?></td>
<td style="text-align: center; background-color: rgb(102, 204, 204); color: white; font-weight: bold; width: 164px;"><small style="font-family: Arial;"><small>&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;</small></small>
<?php echo "<font face='Arial' size='1'> $spd_a km/hr ";
?></td>
<td colspan="1" rowspan="1" style="text-align: center; background-color: rgb(102, 204, 204); width: 164px; color: white; font-weight: bold;">&nbsp;<small><small>&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634;
&nbsp;<?php $deltaT = round($time_a,0);
$hour_trip1 = floor($deltaT/3600);
$min_trip1 = ((floor($deltaT/60)) - ($hour_trip1*60));
if ($deltaT<60) {$sec_trip1 = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip1 = ($deltaT- ($min_trip1*60));}
elseif ($deltaT>=3600) {$sec_trip1 = ($deltaT- ($min_trip1*60) - ($hour_trip1*3600));}
$time = "$min_trip1 min $sec_trip1 sec";
echo "<font face='Arial' size='1'> $time ";

?></small></small><small><small><span style="font-family: Arial;"></span></small></small></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); text-align: right; width: 151px;"><small><small style="font-weight: bold; color: black;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3637;&#3656;&#3607;&#3635;&#3652;&#3604;&#3657; <img style="width: 15px; height: 15px;" alt="" src="ar.png">
&nbsp; </small></small></td>
<td style="text-align: center; background-color: rgb(204, 255, 255); width: 162px;"><small><small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;</span><span style="font-family: Arial;">&nbsp;<?php if ($deviceD == "globalsat") {$spd_unit=1; $acc_limit=2;}
elseif ($deviceD == "3dgps") {$spd_unit=1.825; $acc_limit=2;}
elseif ($deviceD == "dg200") {$spd_unit=1; $acc_limit=1.5;}
elseif ($deviceD == "gps01") {$spd_unit=1.825; $acc_limit=1.5;}
elseif ($deviceD == "DLT01") {$spd_unit=1; $acc_limit=1.5;}
elseif ($deviceD == "DLT02") {$spd_unit=1; $acc_limit=1.5;}
elseif ($deviceD == "DLT03") {$spd_unit=1; $acc_limit=1.5;}
elseif ($deviceD == "RV3D") {$spd_unit=1; $acc_limit=1.5;}
elseif ($deviceD == "ID0002") {$spd_unit=1; $acc_limit=1.5;}

for ($i=1; $i<($num_rows); $i++) {
$time_s = explode(":", $time_i[$i-1]);
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$time_s = explode(":", $time_i[$i]);
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
$sec_del = $sec2 - $sec1;

if ($sec_del >= 10) {$sec_del=0;} 

/* $velocity = (($speed_i[$i] + $speed_i[$i-1])/2) * (1000/3600); 
$distance = $spd_unit * $velocity * $sec_del;
$dis_sum = $distance + $dis_sum; */

$time_sum =$time_sum + $sec_del;
if ($deltaT!=0) {$speed_avg = $speed_i[$i]+$speed_avg;}
}

if ($time_sum!=0) {$speed_avg = round(($dis_sum/$time_sum),2);}
else {$speed_avg=0;}

$dis_sum_km = round((abs($dis_sum)/1000),2); 

echo "<font face='Arial' size='1'> $dis_sum_km";?>&nbsp;
km &nbsp;</span></small></small></td>
<td style="text-align: center; background-color: rgb(204, 255, 255); width: 164px;"><small><small><span style="font-family: Arial;">&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;</span><span style="font-family: Arial;"> &nbsp;</span></small></small><?php $time_s = explode(":", $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(":", $time_i[$num_rows]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = round(($sec2 - $sec1),2); $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT<60) {$sec_trip = $deltaT;} elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT - ($min_trip*60));} elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} if ($deltaT!=0) {$speed_avg3 = round((3600*$dis_sum_km/$deltaT),2);} else {$speed_avg3=0;} echo "<font face='Arial' size='1'> $speed_avg3 km/hr";?></td>
<td colspan="1" rowspan="1" style="text-align: center; background-color: rgb(204, 255, 255); width: 164px;"><small><small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634;</span><span style="font-family: Arial;"> &nbsp;</span></small></small><?php echo "<font face='Arial' size='1'> $hour_trip hr $min_trip min $sec_trip sec";?></td>
</tr>
</tbody>
</table>
<table style="text-align: left; margin-left: auto; margin-right: auto; width: 800px; height: 542px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="background-color: rgb(255, 255, 204); width: 355px; height: 542px;" valign="top">
<table style="text-align: left; width: 350px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr align="center">
<td style="background-color: rgb(153, 153, 153); width: 195px;" colspan="4" rowspan="1"><b style="color: rgb(255, 255, 255); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(153, 153, 153);">&#3649;&#3610;&#3610;&#3611;&#3619;&#3632;&#3648;&#3617;&#3636;&#3609;&#3614;&#3620;&#3605;&#3636;&#3585;&#3619;&#3619;&#3617;&#3585;&#3634;&#3619;&#3586;&#3633;&#3610;&#3586;&#3637;&#3656;</b></td>
</tr>
<tr>
<td colspan="2" rowspan="1" style="background-color: rgb(255, 255, 153); text-align: left; width: 195px;"><b style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);">&nbsp;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&#3611;&#3619;&#3632;&#3648;&#3617;&#3636;&#3609;</b></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 64px;"><b style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);">star</b></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px;"><b style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);">score</b></td>
</tr>
<tr>
<td style="width: 195px;"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">&nbsp;1.&#3585;&#3634;&#3619;&#3648;&#3619;&#3656;&#3591;&#3649;&#3621;&#3632;&#3594;&#3632;&#3621;&#3629;&#3607;&#3637;&#3656;&#3609;&#3640;&#3656;&#3617;&#3609;&#3623;&#3621;<?php include ("f2_acc_function.php"); $sc1 = $acc_num_1;?></span></td>
<td style="width: 9px;" align="undefined" valign="undefined"></td>
<td style="vertical-align: middle; width: 64px; text-align: right;"><?php if ($sc1<2) { $score1_i = 3; } elseif (($sc1>=2) AND ($sc1<3)) { $score1_i = 2; } elseif (($sc1>=3) AND ($sc1<4)) { $score1_i = 1; } elseif (($sc1>=4) AND ($sc1<5)) { $score1_i = 0; } elseif ($sc1>=5) { $score1_i = 0; } for ($j=1; $j<=$score1_i; $j++) { echo " <img src='star.png' width='16' height='16'/>"; }?></td>
<td style="text-align: center; width: 36px;" valign="undefined"><?php echo " <font face='Arial' size='2'> <b> $acc_num_1 </b>";
$count1 = $acc_num_1;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px;"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;2.&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;&#3605;&#3634;&#3617;&#3585;&#3635;&#3627;&#3609;&#3604;&nbsp;
&nbsp;<?php include ("f2_speed_function.php");
$sc2 = $score2; $sc2_1 = $score2_1; $sc2_2 = $score2_2; $sc2_3 = $score2_3; $sc2_4 = $score2_4;
/*
for ($t=1; $t<=$over; $t++) {
$spdp1 = $spd_pint1[$t];
$spdp2 = $spd_pint2[$t];
$spdotime = $speed_time[$t];
if ($spdType[$i]==1) {$spdotyp = "Lane Changing";}
elseif ($spdType[$i]==2) {$spdotyp = "Curve";}
elseif ($spdType[$i]==0) {$spdotyp = "Straight";}
else {$spdotyp = "Other";}
$objConnect = mysql_connect("localhost","tatanad","tata789") or die("Error Connect to Database"); $strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`overindex`,`spdp1`,`spdp2`,`overtype`,`overtime`)
VALUES ( '$selectT', NOW( ), '$spddate', '$t','$spdp1','$spdp2','$spdotyp','$spdotime');;";
$objQuery = mysql_query($strSQL);
}
for ($t=1; $t<=$dowsy_cnt; $t++) {
$spdp1 = $dowsy_point1[$t];
$spdp2 = $dowsy_point2[$t];
$spdotyp = $unControl[$t];
$spdotime = $dowsy_time[$t];
$strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`overindex`,`spdp1`,`spdp2`,`overtype`,`overtime`)
VALUES ( '$selectT', NOW( ), '$spddate', '$t','$spdp1','$spdp2','$spdotyp','$spdotime');;";
$objQuery = mysql_query($strSQL);
}
*/?></span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px;"></td>
<td colspan="1" rowspan="5" style="background-color: rgb(255, 255, 153); vertical-align: middle; width: 64px; text-align: right;"><?php if ($sc2<2) { $score2_i = 4; } elseif (($sc2>=2) AND ($sc2<7)) { $score2_i = 3; } elseif (($sc2>=7) AND ($sc2<13)) { $score2_i = 2; } elseif (($sc2>=13) AND ($sc2<18)) { $score2_i = 1; } elseif ($sc2>=18) { $score2_i = 0; } for ($j=1; $j<=$score1_i; $j++) { echo " <img src='star.png' width='16' height='16'/>"; }?></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px;"><?php $speed_over = $osp1+ $osp2+$osp3 +$osp4; echo "<font face='Arial' size='2'> <b> $score2 </b>"; $count2 = $speed_over;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);"><small><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><font style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153);" face="Arial" size="2"><small> 2.1 &#3648;&#3585;&#3636;&#3609;
81-88 &#3585;&#3617;./&#3594;&#3617; &nbsp;</small></font></small></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp1"; $count3 = $osp1;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);"><small><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
2.2
&#3648;&#3585;&#3636;&#3609; 89-96 &#3585;&#3617;./&#3594;&#3617;</span></small></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp2"; $count4 = $osp2;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);"><small>&nbsp;
<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">2.3
&#3648;&#3585;&#3636;&#3609; 97-104 &#3585;&#3617;./&#3594;&#3617;</span></small></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp3"; $count5 = $osp3;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);"><small>&nbsp;
<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">2.4
&#3648;&#3585;&#3636;&#3609; 104 &#3585;&#3617;./&#3594;&#3617;.</span> </small></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2' color='gray'> $osp4"; $count6 = $osp4;?></td>
</tr>
<tr>
<td style="width: 195px;" align="undefined" valign="undefined"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">&nbsp;3.&#3585;&#3634;&#3619;&#3648;&#3621;&#3637;&#3657;&#3618;&#3623;&#3629;&#3618;&#3656;&#3634;&#3591;&#3609;&#3640;&#3656;&#3617;&#3609;&#3623;&#3621;
&nbsp;<?php include ("f2_turn_function.php");
$sc3 = $total2;
$sc4 = $total3;
$count7_1 = $total2;
$count7_2 = $total3;?></span></td>
<td style="width: 9px;" align="undefined" valign="undefined"></td>
<td colspan="1" rowspan="3" style="vertical-align: middle; width: 64px; text-align: right;"><?php $scT=$sc3+$sc4; if ($scT<2) { $score1_i = 3; } elseif (($scT>=2) AND ($scT<3)) { $score1_i = 2; } elseif (($scT>=3) AND ($scT<4)) { $score1_i = 1; } elseif (($scT>=4) AND ($scT<5)) { $score1_i = 0; } elseif ($scT>=5) { $score1_i = 0; } for ($j=1; $j<=$score1_i; $j++) { echo " <img src='star.png' width='16' height='16'/>"; }?></td>
<td style="width: 36px; text-align: center;" valign="undefined"><small><?php $totalL = $total2+$total3;
echo "<font face='Arial' size='2'> <b> $totalL </b>";
?></small></td>
</tr>
<tr>
<td style="color: rgb(153, 153, 153);" align="undefined" valign="undefined">&nbsp;<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">
3.1 &#3585;&#3634;&#3619;&#3648;&#3621;&#3637;&#3657;&#3618;&#3623;&#3629;&#3618;&#3656;&#3634;&#3591;&#3609;&#3640;&#3656;&#3617;&#3609;&#3623;&#3621;&nbsp;</span></td>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center;" valign="undefined"><?php echo "<font face='Arial' size='2'> $sc3 ";?></td>
</tr>
<tr>
<td style="width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 201); display: inline ! important; float: none;">&nbsp;
3.2 &#3585;&#3634;&#3619;&#3585;&#3621;&#3633;&#3610;&#3619;&#3606;&#3629;&#3618;&#3656;&#3634;&#3591;&#3611;&#3621;&#3629;&#3604;&#3616;&#3633;&#3618;&nbsp;</span></td>
<td style="width: 9px;" align="undefined" valign="undefined"></td>
<td style="width: 36px; text-align: center;" valign="undefined"><?php echo "<font face='Arial' size='2'> $sc4 ";?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px;" align="undefined" valign="undefined"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;4.&#3585;&#3634;&#3619;&#3611;&#3619;&#3632;&#3614;&#3620;&#3605;&#3636;&#3651;&#3609;&#3648;&#3586;&#3605;&#3607;&#3637;&#3656;&#3585;&#3635;&#3627;&#3609;&#3604;<?php include ("f2_zone_function.php"); ?></span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px;" align="undefined" valign="undefined"></td>
<td colspan="1" rowspan="6" style="vertical-align: middle; width: 64px; text-align: right; background-color: rgb(255, 255, 153);"><?php if ($scz<2) { $score8_i = 4; } elseif (($scz>=2) AND ($scz<7)) { $score8_i = 3; }
elseif (($scz>=7) AND ($scz<13)) { $score8_i = 2; } elseif (($scz>=13) AND ($scz<18)) { $score8_i = 1; } elseif ($scz>=18) { $score8_i = 0; } for ($j=1; $j<=$score8_i; $j++) { echo "<img src='star.png' width='16' height='16'/>"; } ?></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px;" valign="undefined"><small><?php $totalL2 = ($spd_zone_cnt + $cross_cnt3 + $stop_cnt2 + $tstop_cnt2 + $nstop_cnt2)/10;
echo "<font face='Arial' size='2'> <b> $totalL2 </b>";?></small></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);">&nbsp;
<span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;4.1
&#3585;&#3634;&#3619;&#3651;&#3594;&#3657;&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;&#3607;&#3637;&#3656;&#3648;&#3627;&#3617;&#3634;&#3632;&#3626;&#3617;&nbsp;</span></td>
<td style="background-color: rgb(255, 255, 153); color: rgb(153, 153, 153);"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; color: rgb(153, 153, 153);"><?php echo "<font face='Arial' size='2'> <b> $spd_zone_cnt </b>";
$count8 = $spd_zone_cnt;
$sc5 = $spd_zone_cnt;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
&nbsp;4.2 &#3614;&#3619;&#3657;&#3629;&#3617;&#3607;&#3637;&#3656;&#3592;&#3632;&#3627;&#3618;&#3640;&#3604;&#3607;&#3637;&#3656;&#3607;&#3634;&#3591;&#3649;&#3618;&#3585;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $cross_cnt3 </b>";
$count9 = $cross_cnt3;
$sc6 = $cross_cnt3;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
&nbsp;4.3 &#3627;&#3618;&#3640;&#3604;&#3619;&#3606;&#3607;&#3637;&#3656;&#3652;&#3615;&#3626;&#3633;&#3597;&#3597;&#3634;&#3603;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $stop_cnt2 </b>"; $count10 = $stop_cnt2; $sc7 = $stop_cnt2;?></td>
</tr>
<tr>
<td colspan="2" rowspan="1" style="background-color: rgb(255, 255, 153); width: 170px; color: rgb(153, 153, 153);"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;
&nbsp;4.4 &#3592;&#3629;&#3604;&#3629;&#3618;&#3656;&#3634;&#3591;&#3611;&#3621;&#3629;&#3604;&#3616;&#3633;&#3618;&#3651;&#3585;&#3621;&#3657;&#3607;&#3634;&#3591;&#3619;&#3606;&#3652;&#3615;</span></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $tstop_cnt2 </b>"; $count11 = $tstop_cnt2; $sc9 = $tstop_cnt2; ?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); width: 195px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"><span style="font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: rgb(255, 255, 153); display: inline ! important; float: none;">&nbsp;&nbsp;
4.5 &#3585;&#3634;&#3619;&#3592;&#3629;&#3604;&#3619;&#3606;&#3651;&#3609;&#3607;&#3637;&#3656;&#3627;&#3657;&#3634;&#3617;&#3592;&#3629;&#3604;</span></td>
<td style="background-color: rgb(255, 255, 153); width: 9px; color: rgb(153, 153, 153);" align="undefined" valign="undefined"></td>
<td style="background-color: rgb(255, 255, 153); text-align: center; width: 36px; color: rgb(153, 153, 153);" valign="undefined"><?php echo "<font face='Arial' size='2'> <b> $nstop_cnt2 </b>"; $count12 = $nstop_cnt2; $sc8 = $nstop_cnt2; $scz = $sc5+$sc6+$sc7+$sc8+$sc9;?></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 204);"><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">5.&#3585;&#3634;&#3619;&#3611;&#3619;&#3632;&#3614;&#3620;&#3605;&#3636;&#3651;&#3609;&#3607;&#3634;&#3591;&#3621;&#3634;&#3604;&#3594;&#3633;&#3609;&nbsp;<?php include ("f2_slope_function.php"); ?></span></td>
<td align="undefined" valign="undefined"></td>
<td align="undefined" valign="undefined"></td>
<td style="text-align: center;" valign="undefined"><small><?php /* for ($i=1; $i<=$stp_point_cnt; $i++) {
if ($delDis[$i]!=0) {$gradeH[$i] = (($AccSlope[$i] / $delDis[$i])*100);}
$gradeH[$i] = round($gradeH[$i],2);
if ((abs($gradeH[$i])>=4)) {$slope1 = $slope1+1;}
}*/
echo "$slope_dan";?></small></td>
</tr>
<tr>
<td><small>6. &#3585;&#3634;&#3619;&#3648;&#3611;&#3621;&#3637;&#3656;&#3618;&#3609;&#3594;&#3656;&#3629;&#3591;&#3592;&#3619;&#3634;&#3592;&#3619;</small></td>
<td></td>
<td></td>
<td style="text-align: center;"><small><?php echo "$LaneC_over ($LaneC)";?></small></td>
</tr>
<tr>
<td><small>7. &#3585;&#3634;&#3619;&#3649;&#3595;&#3591;</small></td>
<td></td>
<td></td>
<td style="text-align: center;"><?php echo "$LaneC2_over";
?></td>
</tr>
<tr>
<td style="background-color: rgb(204, 204, 204); text-align: right; font-weight: bold; width: 195px;" valign="undefined">
<div style="text-align: center;"><small><span style="font-family: Arial;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3619;&#3623;&#3617;&#3585;&#3634;&#3619;&#3621;&#3632;&#3648;&#3617;&#3636;&#3604;</span></small><br>
<small><span style="font-family: Arial;"></span></small></div>
<div style="text-align: center;"><small><span style="font-family: Arial;"><span style="color: red;">&#3648;&#3626;&#3657;&#3609;&#3607;&#3634;&#3591;
</span><?php echo "<font face='Arial' size='2' color='#FF0066'> $tripdir1 <br> "; echo "<font face='Arial' size='1' color='#FF0066'> Begine : $latB1 - $lonB1 <br>"; echo "<font face='Arial' size='1' color='#FF0066'> End : $latB2 - $lonB2"; ?></span></small><small><span style="font-family: Arial;"></span></small></div>
</td>
<td style="background-color: white; font-weight: bold; text-align: center; width: 9px;" valign="undefined"><?php if (($TimeBegin>="06:00:00") AND ($TimeEnd<="18:30:00")) { $dayfont = "&#9788"; $daycolor = "#FF4000"; $daylight = "sun.png"; } else { $dayfont = "&#9789"; $daycolor = "#FFFF00"; $daylight = "moon.png";} echo "<img src='$daylight' width='22' height='22'/>";?></td>
<td style="background-color: white; text-align: center; width: 64px;" valign="undefined"><?php $totlescore = $sc1+$sc2+$sc3+$sc4+ $totalL2+ $slope1 + $LaneC_over +$LaneC2_over;
if ($totlescore<=10) { $star_i = 3;}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $star_i = 2; }
elseif ((20<$totlescore) AND ($totlescore<=30)) { $star_i = 1;;}
elseif ($totlescore>30) { $star_i = 0;}
for ($j=1; $j<=$star_i; $j++) { echo "<img src='bus.png' width='30' height='30'/>"; }?><br>
</td>
<td style="width: 36px; text-align: center; background-color: rgb(204, 204, 204); vertical-align: middle;"><?php if ($totlescore<=10) { $GYR = "light0.png";} elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";} elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";} elseif ($totlescore>30) { $GYR = "light3.png";} echo "<font face='Arial' size='2'> <b> $totlescore </b>"; echo "<img src='$GYR' width='20' height='20'/>";?>
<br>
</td>
</tr>
</tbody>
</table>
</td>
<td style="text-align: center; width: 425px; vertical-align: top; height: 542px;">
<div style="text-align: center;">
<table style="width: 100%; text-align: left; margin-left: auto; margin-right: 0px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td colspan="6" rowspan="1" style="background-color: rgb(51, 204, 255);"><small style="font-family: Arial; font-weight: bold;"><small>&#3619;&#3632;&#3604;&#3633;&#3610;&#3588;&#3632;&#3649;&#3609;&#3609;&#3607;&#3637;&#3656;&#3652;&#3604;&#3657;&#3648;&#3611;&#3619;&#3637;&#3618;&#3610;&#3648;&#3607;&#3637;&#3618;&#3610;&nbsp;<span style="font-style: italic;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</span> (NORM)
&#3586;&#3629;&#3591;&#3648;&#3626;&#3657;&#3609;&#3607;&#3634;&#3591;&nbsp;</small></small><small style="font-family: Arial; font-weight: bold;"><small><?php echo "$rout_1";?></small></small></td>
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
</div>
&nbsp;</td>
</tr>
</tbody>
</table>
</form>
</body></html>