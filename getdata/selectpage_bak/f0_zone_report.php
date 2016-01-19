<?php
error_reporting(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title>TATANAD GPS Supervisory Program</title></head>
<body onload="initialize()" onunload="GUnload()">
<table style="width: 1010px; height: 17px; text-align: left; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td style="vertical-align: middle; text-align: center; height: 13px; width: 179px; background-color: rgb(51, 153, 204);">
<font weight="BOLD" color="white" face="tahoma" size="2"> <b>Driving
Score 2.0 beta </b> </font></td>
<td style="height: 13px; width: 110px;"> <a href="www.nectec.or.th"><img style="border: 0px solid ; width: 100px; height: 22px;" alt="" src="nectec.png"></a> </td>
<td style="background-color: rgb(51, 153, 204); text-align: left; width: 77px; height: 13px;">
<small><span style="font-family: Arial;"><span style="text-decoration: underline;"></span></span></small>&nbsp;
<a style="color: white;" target="_blank" href="www.thairoadsafety.net"><small style="font-family: Arial; font-weight: bold;">WebSite</small></a></td>
<td style="width: 626px; text-align: right; background-color: rgb(51, 153, 204); color: white; font-weight: bold; font-family: Arial; height: 13px;"><small><a style="color: white;" href="./mainpage.php" target="_top">Checklist
</a>&nbsp; &nbsp;Integrate &nbsp;
&nbsp;Speed &nbsp; &nbsp;Accelleration &nbsp;
&nbsp;Zone &nbsp; &nbsp;Turn &nbsp;</small></td>
</tr>
</tbody>
</table>
<form style="height: 345px;" action="f0_zone_report.php" method="get">
<input type="hidden" name="deviceid" value="<?php print $_GET["deviceid"]; ?>">
<input type="hidden" name="date1" value="<?php print $_GET["date1"]; ?>">
<input type="hidden" name="time1" value="<?php print $_GET["time1"]; ?>">
<input type="hidden" name="time2" value="<?php print $_GET["time2"]; ?>">

<table style="background-color: white; width: 1010px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="height: 13px; background-color: white; vertical-align: top; width: 104px;" colspan="3" rowspan="1"><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"> &nbsp;<?php require(dirname(__FILE__)."/../../config.php");
$deviceid = $_GET["deviceid"];
$Date1 = $_GET["date1"];
$time1 = $_GET["time1"];
$time2 = $_GET["time2"];

if($_GET["over_index"] != "") $over_index = $_GET["over_index"];
include ("f2_getdata.php");?>Device</span>
:&nbsp;</small><small><?php echo "$deviceid ($num_rows)";?>
&nbsp;<span style="font-weight: bold;">
ID</span> : </small><small>
        <!--<php title="if ($selectT==&quot;Test1&quot;) { $driver = &quot;&#3626;&#3617;&#3626;&#3640;&#3586; &#3626;&#3609;&#3640;&#3585;&#3648;&#3629;&#3618;&quot;; } elseif ($selectT==&quot;Test2&quot;) { $driver = &quot;&#3626;&#3617;&#3594;&#3634;&#3618; &#3626;&#3610;&#3634;&#3618;&#3592;&#3636;&#3605;&quot;; } elseif ($selectT==&quot;Test3&quot;) { $driver = &quot;&#3626;&#3617;&#3588;&#3636;&#3604; &#3605;&#3636;&#3604;&#3651;&#3592;&quot;; } else {$driver = &quot;........................&quot;;} echo&quot;$driver&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
    </small><small><?php echo "$busid / $selectT";?>&nbsp;&nbsp;
<span style="font-weight: bold;">Date</span>
:
&nbsp;<?php $DateBegin = $Date1;
echo "$Date1";
$datev1 = $Date1;
$speed_max_new = $speed_max;?>
&nbsp;&nbsp;<span style="font-weight: bold;">
Time&nbsp;</span>: &nbsp;</small><small><?php $TimeBegin = $time1;
$TimeEnd =  $time2;
echo "$TimeBegin - $TimeEnd";

if (($TimeBegin>="06:00:00") AND ($TimeBegin<="18:00:00")) {
  echo " <img src='sun.png' width='20' height='20'/>"; $daylight="noon";}

else {
  echo " <img src='moon.png' width='20' height='20'/>";
 $daylight="night";}
?>
</small><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small></td>
<td style="width: 142px;" rowspan="1" colspan="3" align="undefined" valign="undefined">
<?php include("f2_zone_function.php");

include ("f2_turn_function.php");
?></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); height: 10px; width: 195px;"><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span>&nbsp;</span></small><small style="font-family: Arial;"><small><span style="font-weight: bold;">Speed max</span>. <span style="font-weight: bold;">:</span> </small>&nbsp;
<small><?php if ($device == "globalsat") {$spd_unit=1; $acc_limit=2;}
elseif ($device == "3dgps01") {$spd_unit=1.825; $acc_limit=2;}
elseif ($device == "dg200") {$spd_unit=1; $acc_limit=1.5;}
elseif ($device == "gps01") {$spd_unit=1; $acc_limit=1.5;}

if ( ($deviceid==10) OR ($deviceid==10)  ) {$spd_unit=1.852; $acc_limit=1.5;}
$speed_max_new = $speed_max;
$speed_maxy = round(($speed_max*$spd_unit),2);

echo "$speed_maxy";?>&nbsp;km/hr</small></small></td>
<td style="font-family: Arial; text-align: left; background-color: rgb(204, 255, 255); vertical-align: middle; height: 10px; width: 181px;"><small style="font-family: Arial;"><small><span style="font-weight: bold;">&nbsp;All time</span>
<span style="font-weight: bold;">:</span>&nbsp;<?php $time_s = explode(":", $time_i[1]); 
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); 
$time_s = explode(":", $time_i[$num_rows-1]); 
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); 

$deltaT = $sec2 - $sec1; 

$hour_trip = floor($deltaT/3600); 

$min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT<60) {$sec_trip = $deltaT;} 
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));} 
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} 

echo "$hour_trip hr $min_trip min $sec_trip sec"; 
$dis_sum = 0; 

for ($i=0; $i<($num_rows-1); $i++) { 
$time_s = explode(":", $time_i[$i-1]); 
$sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); 
$time_s = explode(":", $time_i[$i]); 
$sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $sec_del = $sec2 - $sec1; 

if ($sec_del<=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); } $distance = $velocity * $sec_del; $dis_sum = $distance + $dis_sum; } if ($deltaT!=0) {$speed_avg = ($dis_sum/$deltaT) * (3600/1000);} ?>&nbsp;</small></small><small><span style="font-weight: bold;"></span></small><small style="font-family: Arial;"><span style="font-weight: bold;"></span></small></td>
<td style="text-align: center; background-color: rgb(153, 255, 153); width: 104px;">&nbsp;<small style="color: red;"><small style="font-family: Arial; font-weight: bold;"><?php if     (($over_index=="") or ($over_index=="0")) {$over_index=601;}

$title = "Zone Over No."; 
echo "$title $over_index"; ?></small></small></td>
<td style="vertical-align: middle; height: 10px; font-family: Arial; background-color: rgb(153, 255, 153); text-align: center; width: 144px;"><small><small style="font-family: Arial;">
            <!--<php title="echo &quot; $spd_pint1[$over_index] - $spd_pint[$over_index] &quot;; " xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
        </small></small><small><small style="font-family: Arial;">
            <!--<php title="echo &quot; &lt;img src='$colorp[$over_index]' width='10' height='10'/&gt;&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
        </small></small><small><small style="font-family: Arial;">
            <!--<php title="echo &quot; $spd_pint1[$over_index] - $spd_pint[$over_index] &quot;; " xmlns="http://disruptive-innovations.com/zoo/nvu">-->
            <span style="font-weight: bold;"> Type : </span>&nbsp;<?php if ($over_index>=600) {
   $kk = $over_index-600;
   echo " <font color='black'> $type_Turn[$kk] <font color='black'>";
}

else {
  $kk = $over_index-500; 
  $typeS = "$zone_type[$kk]";
  echo "$typeS";
}?>
&nbsp;<span style="font-weight: bold;"></span>
            <!--</php>--></small></small></td>
<td style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 142px;"><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span></span></small><span style="font-family: Arial;"><span style="font-weight: bold;"></span></span><small style="font-family: Arial;"><small><span style="font-weight: bold;"></span></small>
</small><span style="font-family: Arial;"></span><small><span style="font-weight: bold; font-family: Arial;"><small>Speed
avg.&nbsp; :</small>&nbsp;</span><small><span style="font-family: Arial;"><?php if ($over_index>=600) {
   $kk = $over_index-600;
   echo " <font color='black'> $SpeedMax[$kk] km/hr <font color='black'>";
}

else {
  $kk = $over_index-500; 
  echo "$crossSPD[$kk] km/hr";
  $spd_max_cen = $spd_max[$kk];
}
?></span></small><span style="font-weight: bold; font-family: Arial;">&nbsp;</span><small><span style="font-family: Arial;"></span><span style="font-weight: bold;"></span></small></small></td>
<td colspan="1" rowspan="1" style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 124px;"><small><span style="font-weight: bold;"></span><small><span style="font-family: Arial; font-weight: bold;"></span><big><span style="font-family: Arial;"></span></big></small></small>
<small><span style="font-weight: bold;"></span><span style="font-family: Arial;"></span><small style="font-family: Arial;"><span style="font-weight: bold;"></span><?php if ($over_index<100) { $thetas = $intDmax7[$over_index]; } elseif ($over_index>=100) { $kk = $over_index-100; $thetas = "$dowsy_intd[$kk]"; } echo "$thetas";?>
        <!--<php title="$thetas = $intDmax7[$over_index]; echo &quot;$thetas&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
    </small></small></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); font-family: Arial; height: 18px; width: 195px;"><small><span style="font-style: italic;"></span><span style="font-weight: bold;"></span></small><small><span style="font-family: Arial;"><span style="font-weight: bold;"> &nbsp;<small>Speed avg</small></span><small>.
</small><span style="font-weight: bold;"><small>&nbsp;:</small>&nbsp;<small>
</small></span><small><?php $speed_avg = $speed_avg*$spd_unit; $speed_avg = round($speed_avg,2); echo "$speed_avg";?></small><small>&nbsp;km/hr</small></span></small></td>
<td style="background-color: rgb(204, 255, 255); height: 18px; width: 181px;"><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span><span style="font-weight: bold;"> </span></span></small><small><span style="font-family: Arial;"><span style="font-weight: bold;">&nbsp;</span></span></small><small><small><span style="font-weight: bold;"><span style="font-family: Arial;">All Distance</span></span><span style="font-family: Arial;"> &nbsp; </span></small><span style="font-weight: bold; font-family: Arial;"><small>:</small>&nbsp;</span><small><span style="font-family: Arial;"><?php $dis_sum_km = round(($dis_sum/1000),4); echo "$dis_sum_km";?></span></small><span style="font-weight: bold; font-family: Arial;"> </span><span style="font-family: Arial;">&nbsp;<small>km</small></span></small></td>
<td style="text-align: center; background-color: rgb(193, 255, 193); width: 104px;"><small><small style="font-family: Arial;"><span style="font-weight: bold;">Point : </span><?php if ($over_index>=600) {
  $gg = $over_index-600; 
  $pointE = explode("-",$stp_point[$gg]);

  $pointE1 = $pointE[0];
  $pointE2 = $pointE[1];

echo "$pointE1:$pointE2";

}
else {
$gg = $over_index-500; 
echo "$crossPoint1[$gg]:$crossPoint4[$gg]";
}


?>
<br>
</small></small></td>
<td style="font-family: Arial; height: 18px; background-color: rgb(193, 255, 193); text-align: center; width: 144px;"><small><span style="font-weight: bold;"> &nbsp;</span></small><span style="font-weight: bold;"><small><small>Time
&nbsp;:</small></small></span>&nbsp;<small><small><?php if ($over_index>=600) {

   $time01 = $time_i[$pointE1];
   $time02 = $time_i[$pointE2];
   echo "$time01 - $time02";

}

else {
echo "$crossT1[$gg]-$crossT2[$gg]";
}
?></small></small></td>
<td style="height: 18px; background-color: rgb(193, 255, 193); text-align: center; width: 142px;"><small><small><span style="font-family: Arial;"></span></small><small style="font-family: Arial;"><span style="font-weight: bold;"></span></small></small><small><span style="font-weight: bold; font-family: Arial;"></span><small><span style="font-family: Arial;">
                <!--<php title="echo &quot;$spd_max[$over_index]&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu"></php>-->
            </span></small><span style="font-weight: bold; font-family: Arial;"></span><small><span style="font-family: Arial;"></span></small></small><small><small><span style="font-family: Arial;"> <span style="font-weight: bold;">Distance : &nbsp;</span>
                <!--<php title="echo &quot;$crossDis[$over_i] m&quot;;" xmlns="http://disruptive-innovations.com/zoo/nvu">-->
                <?php if ($over_index>=600) {
 $kk = $over_index-600;
 echo "$delDis[$kk]";
}

else {
$kk = $over_index-500;
echo "$crossDis[$kk] m";
}?><!--</php>--><span style="font-weight: bold;"> </span>&nbsp;</span></small></small></td>
<td style="background-color: rgb(193, 255, 193); text-align: center; width: 124px;"><small><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span></span></small></small>&nbsp;<small><small><span style="font-family: Arial;"></span></small></small></td>
</tr>
</tbody>
</table>
<table style="width: 1010px; height: 40px; text-align: left; margin-left: auto; margin-right: auto;" border="0">
<tbody>
<tr>
<td colspan="1" rowspan="1" style="text-align: left; height: 22px; vertical-align: bottom; width: 946px;">&nbsp;
<font face="Arial" size="2"><img style="width: 16px; height: 16px;" alt="" src="m1.png">
under 81
km/hr &nbsp;<img style="width: 16px; height: 16px;" alt="" src="m2.png"></font><font face="Arial" size="2">81-88 km/hr</font><font face="Arial" size="2"> </font><font face="Arial" size="2"><img style="width: 16px; height: 16px;" alt="" src="m3.png">
88-96 km/hr&nbsp;
</font><font face="Arial" size="2"><img style="width: 16px; height: 16px;" alt="" src="m4.png">96-104
km/hr</font><font face="Arial" size="2">
<img style="width: 16px; height: 16px;" alt="" src="m5.png"> &#3617;&#3634;&#3585;&#3585;&#3623;&#3656;&#3634; 104 km/hr &nbsp;
&nbsp;&nbsp; &nbsp;</font><font face="Arial" size="2"><img style="width: 16px; height: 16px;" alt="" src="d3.png">&nbsp;</font><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">&#3611;&#3657;&#3634;&#3618;&#3592;&#3629;&#3604;&#3619;&#3606;</span><font face="Arial" size="2">&nbsp;<img style="width: 16px; height: 16px;" alt="" src="d2.png">&nbsp;</font><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">&#3627;&#3657;&#3634;&#3617;&#3592;&#3629;&#3604;&#3619;&#3606;<span class="Apple-converted-space">&nbsp;</span></span><font face="Arial" size="2">&nbsp;<img style="width: 16px; height: 16px;" alt="" src="d4.png">
</font><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;"><span class="Apple-converted-space">&nbsp;</span>&#3648;&#3586;&#3605;&#3607;&#3634;&#3591;&#3619;&#3606;&#3652;&#3615;<span class="Apple-converted-space">&nbsp;</span></span><font face="Arial" size="2"><img style="width: 16px; height: 16px;" alt="" src="d5.png">&nbsp;</font><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">&#3607;&#3634;&#3591;&#3650;&#3588;&#3657;&#3591;<span class="Apple-converted-space">&nbsp;</span></span><font face="Arial" size="2">&nbsp;<img style="width: 16px; height: 16px;" alt="" src="d1.png">&nbsp;</font><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;">&#3607;&#3634;&#3591;&#3649;&#3618;&#3585;&nbsp;&nbsp;</span>
</td>
</tr>
</tbody>
</table>
<table style="text-align: left; margin-left: auto; margin-right: auto; height: 138px; width: 1010px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td rowspan="2" style="background-color: rgb(255, 255, 204); height: 144px; width: 547px;">
<?php /*include ("f2_earthSPD_function.php");*/
/* include ("f2_map_function.php"); */
 include ("earth_test.php");

?></td>
<td style="height: 144px; vertical-align: middle; background-color: white; text-align: right; width: 443px;"><?php /* include ("f2_graphL_function_acc.php"); */

include ("graphTest.php");?><br>
</td>
</tr>
<tr>
<td style="vertical-align: top; width: 443px; background-color: white; text-align: left;"><?php include "f2_mp4_function.php";?><br>
</td>
</tr>
</tbody>
</table>
<table style="width: 1010px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr><td><table style="text-align: left; width: 976px; height: 66px;" border="1" cellpadding="2" cellspacing="2"><tbody><tr><td style="background-color: rgb(255, 255, 153);"></td><td style="text-align: center; background-color: rgb(153, 255, 153); width: 103px; font-weight: bold;"><small><small>&#3610;&#3619;&#3636;&#3648;&#3623;&#3603;&#3607;&#3634;&#3591;&#3649;&#3618;&#3585; (i=4)</small></small></td><td style="text-align: center; background-color: rgb(153, 255, 153); width: 103px; font-weight: bold;"><small><small>&#3610;&#3619;&#3636;&#3648;&#3623;&#3603;&#3592;&#3640;&#3604;&#3592;&#3629;&#3604;</small></small></td><td style="text-align: center; background-color: rgb(153, 255, 153); width: 102px; font-weight: bold;"><small><small>&#3610;&#3619;&#3636;&#3648;&#3623;&#3603;&#3627;&#3657;&#3634;&#3617;&#3592;&#3629;&#3604;</small></small></td><td style="text-align: center; background-color: rgb(153, 255, 153); width: 102px; font-weight: bold;"><small><small>&#3610;&#3619;&#3636;&#3648;&#3623;&#3603;&#3651;&#3585;&#3621;&#3657;&#3607;&#3634;&#3591;&#3619;&#3606;&#3652;&#3615;</small></small></td><td style="text-align: center; background-color: rgb(153, 255, 153); width: 100px; font-weight: bold;"><small><small>&#3610;&#3619;&#3636;&#3648;&#3623;&#3603;&#3607;&#3634;&#3591;&#3650;&#3588;&#3657;&#3591;</small></small></td><td style="text-align: center; width: 102px; font-weight: bold; background-color: rgb(51, 255, 51);"><small><small>&#3585;&#3634;&#3619;&#3648;&#3611;&#3621;&#3637;&#3656;&#3618;&#3609;&#3594;&#3656;&#3629;&#3591;&#3592;&#3619;&#3634;&#3592;&#3619;</small></small></td><td style="text-align: center; width: 103px; font-weight: bold; background-color: rgb(51, 255, 51);"><small><small>&#3585;&#3634;&#3619;&#3649;&#3595;&#3591;</small></small></td><td style="text-align: center; width: 101px; font-weight: bold; background-color: rgb(51, 255, 51);"><small><small>&#3585;&#3634;&#3619;&#3651;&#3594;&#3657;&#3594;&#3656;&#3629;&#3591;&#3607;&#3634;&#3591;</small></small></td></tr><tr><td style="background-color: rgb(255, 255, 153); font-weight: bold; text-align: center;"><small>S - A - T</small></td><td style="width: 103px; text-align: center;"><?php for ($n=1; $n<=$cross_zone; $n++) {
  if ($in_zone_cnt1[$n]=="") {$in_zone_cnt1[$n]=0;}
  if ($in_zone_cnt2[$n]=="") {$in_zone_cnt2[$n]=0;}
  echo "<font size='1' color='black'> $speedBev1[$n] km/hr 
$in_zone_cnt1[$n] &#3588;&#3619;&#3633;&#3657;&#3591; 
$in_zone_cnt2[$n] &#3588;&#3619;&#3633;&#3657;&#3591;  <br>";
}

echo "<font size='2' color='black'> $cross_cnt3($cross_zone) ";

?></td><td style="width: 103px; text-align: center;"><?php echo "<font size='2' color='black'>$stop_cnt($stop_cnt1)";
?></td><td style="width: 102px; text-align: center;"><?php echo "<font size='2' color='black'>$nstop_cnt2($nstop_cnt1)";

?></td><td style="text-align: center; width: 102px;"><small><?php echo "<font size='2' color='black'>$tstop_cnt2($tstop_cnt1)";
?></small></td><td style="width: 100px; text-align: center;"><small><?php echo "$curve_over ($total1) ";
?></small></td><td style="width: 102px; text-align: center;"><small><?php echo "$LaneC_over ($LaneC)";

?></small></td><td style="width: 103px; text-align: center;"><small><?php echo "$LaneC2_over (...)";
?></small></td><td style="width: 101px;"></td></tr><tr><td style="background-color: rgb(255, 255, 153);"><small>Acceleration</small></td><td style="text-align: center;"><?php for ($n=1; $n<=$cross_cnt3; $n++) {
  echo "<font size='1' color='black'> $cross_score[$n] &#3588;&#3619;&#3633;&#3657;&#3591; <br>";
}
?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td style="background-color: rgb(255, 255, 153);"><small>Turn</small></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></tbody></table><br></td></tr><tr>
<td style="vertical-align: top;"><?php $time_s = explode(":", $TimeBegin);
$secE00 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

for ($i=1; $i<=$zoneP; $i++) {

$time01 = $crossT1[$i];
$time_s = explode(":", $time01);
$sec01 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

$time02 = $crossT2[$i];
$time_s = explode(":", $time02);
$sec02 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

$deltaT = $sec02 - $sec01;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));

if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$sum_ddT[$i] = "$min_trip min $sec_trip sec";

$secE01 = $sec01;
$secE02 = $sec02;

$deltaT = $secE01;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$TE1[$i] = "$min_trip:$sec_trip";

$deltaT = $secE02;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$TE2[$i] = "$min_trip:$sec_trip";

}

echo "<table width='980' border='0'>";
echo " <tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Over no. </td> 
<td align='right'> <font size='2' color='black'> speed (avg) </td> 
<td align='center'> <font size='2' color='black'> point </td> 
<td align='center'> <font size='2' color='black'> duration </td> 
<td align='right'> <font size='2' color='black'> distance </td> 
<td align='center'> <font size='2' color='black'> event type </td> 
<td align='center'> <font size='2' color='black'> begin - end </td> 

</tr> ";

for ($i=1; $i<=$zoneP; $i++) {
if ($zone_type[$i]=="CrossOver")     {$pic1 = "c1.gif"; }
elseif ($zone_type[$i]=="CrossStop") {$pic1 = "c1.gif"; }
elseif ($zone_type[$i]=="Cross")     {$pic1 = "c1.gif"; }
elseif ($zone_type[$i]=="BStop")     {$pic1 = "bus.jpg"; }
elseif ($zone_type[$i]=="Park")      {$pic1 = "park.jpg"; }
elseif ($zone_type[$i]=="Train")     {$pic1 = "train.jpg"; }

$bgco = "#81F781";
if ($i==$over_index) {$bgco = "#F3F781";}
$jj = $i+500;
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$jj' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <img src='$pic1' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $crossSPD[$i] km/hr</td> 
<td align='center'> <font size='2' color='black'> $crossPoint1[$i]:$crossPoint4[$i]</td>
<td align='center'> <font size='2' color='black'> $sum_ddT[$i]</td> 
<td align='right'> <font size='2' color='black'> $crossDis[$i] m </td> 
<td align='center'> <font size='2' color='black'> $zone_type[$i]</td> 
<td align='center'> <font size='2' color='black'> <b> $TE1[$i] - $TE2[$i] </b></td> 
</tr> ";
$i=$i+1;
if ($i<=$zoneP){
if ($zone_type[$i]=="CrossOver") {$pic1 = "c1.gif"; }
elseif ($zone_type[$i]=="CrossStop") {$pic1 = "stop.jpg"; }
elseif ($zone_type[$i]=="Cross") {$pic1 = "c1.gif"; }
elseif ($zone_type[$i]=="BStop") {$pic1 = "bus.jpg"; }
elseif ($zone_type[$i]=="Park") {$pic1 = "park.jpg"; }
elseif ($zone_type[$i]=="Train") {$pic1 = "train.jpg"; }
$jj = $i+500;
$bgco = "#BCF5A9";
if ($i==$over_index) {$bgco = "#F3F781";}
echo " <tr bgcolor='$bgco'> 
<td align='center'> <input type='submit' name='over_index' value='$jj'style='height:20px; width:30px; font-size: 10px;> </td> 
<td align='center'> <img src='$pic1' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $crossSPD[$i] km/hr</td> 
<td align='center'> <font size='2' color='black'> $crossPoint1[$i]:$crossPoint4[$i] </td>
<td align='center'> <font size='2' color='black'> $sum_ddT[$i]</td> 
<td align='right'> <font size='2' color='black'> $crossDis[$i] m</td>
<td align='center'> <font size='2' color='black'> $zone_type[$i]</td> 
<td align='center'> <font size='2' color='black'> <b> $TE1[$i] - $TE2[$i] </b></td> 

</tr> ";

}
}
echo "</table>"; 

$turnP = $zoneP+1;?></td>
</tr><tr><td><?php for ($i=1; $i<=$stp_point_cnt; $i++) {

$delta_tt[$i] = round($delta_tt[$i],2);

$latBE1[$i]= round($latBE1[$i],6);
$lonBE1[$i]= round($lonBE1[$i],6);
$latBE2[$i] = round($latBE2[$i],6);
$lonBE2[$i] = round($lonBE2[$i],6);

 $speedSum = $speedSum + $SpeedMax[$i];
 if     ($g_overR[$i]>=0) { $accSumP = $accSumP + $g_overR[$i]; $ap = $ap+1;}
 elseif ($g_overR[$i]<0)  { $accSumN = $accSumN + $g_overR[$i]; $an = $an+1;}

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
elseif (abs($gradeH[$i])>=17)                           {$gradP[$i]="light3.png";}
else {$gradP[$i]="";}

if     ($deltaT<=7)                    { $Tdurat[$i] ="light3.png"; }
elseif (($deltaT>7) AND ($deltaT<=12) ){ $Tdurat[$i] ="light2.png"; }
else   {$Tdurat[$i]="";}

if     ($SpeedMax[$i]>=120)       { $Tspd[$i] = "light3.png"; }
else   {$Tspd[$i]="";}

if     ($deltaDS[$i]>=2)       { $TDS[$i] = "light3.png"; }
else   {$TDS[$i]="";}

if    (( $type_Turn[$i]=="SCurve-A") OR ($type_Turn[$i]=="SCurve-B"))      { $TtypeDS[$i] = "light3.png"; }
else   {$TtypeDS[$i]="";}

}



echo "<table width='980' border='0'>";
echo " <tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Over no. </td> 
<td align='center'> <font size='2' color='black'> acc (g) </td>
<td align='center'> <font size='2' color='black'> point@AccMax </td> 
<td align='center'> <font size='2' color='black'> Height </td>
<td align='center'> <font size='2' color='black'> distance </td>
<td align='center'> <font size='2' color='black'> grade </td>
<td align='center'> <font size='2' color='black'> point </td> 
<td align='center'> <font size='2' color='black'> speed max. </td> 
<td align='center'> <font size='2' color='black'> type </td> 
<td align='center'> <font size='2' color='black'> theta </td> 
<td align='center'> <font size='2' color='black'> duration </td> 
<td align='center'> <font size='2' color='black'> begin-end </td> 
<td align='center'> <font size='2' color='black'> deltaDS </td> </tr> ";

for ($i=1; $i<=$stp_point_cnt; $i++) {
$m = $i+600;
$bgco = "#81F781";

if ($i==($over_index-600)) {$bgco = "#F3F781";}
echo " <tr bgcolor='$bgco'> 
<td align='center'> <input type='submit' name='over_index' value='$m' style='height:20px; width:30px; font-size: 10px;> </td>

<td align='center'> <img src='$colorp[$i]' width='14' height='14'/> </td>
<td align='center'> <font size='2' color='black'> $g_overR[$i] <img src='$gcolor[$i]' width='12' height='12'/> </td> 
<td align='center'> <font size='2' color='black'> $altH2[$i] </td> 
<td align='center'> <font size='2' color='black'> $AccSlope[$i] </td>
<td align='center'> <font size='2' color='black'> $delDis[$i] </td>
<td align='right'> <font size='2' color='black'> $gradeH[$i] <img src='$gradP[$i]' width='12' height='12'/> </td> 

<td align='center'> <font size='2' color='black'> $stp_point[$i] </td>
<td align='center'> <font size='2' color='black'> $SpeedMax[$i] km/hr <img src='$Tspd[$i]' width='12' height='12'/></td> 
<td align='center'> <font size='2' color='black'> $type_Turn[$i] <img src='$TtypeDS[$i]' width='12' height='12'/> </td> 
<td align='center'> <font size='2' color='black'> $delta_tt[$i] </td> 

<td align='center'> <font size='2' color='black'> $sum_ddT[$i] <img src='$Tdurat[$i]' width='12' height='12'/> </td> 
<td align='center'> <font size='2' color='black'> <b> $TE1_turn[$i] - $TE2_turn[$i] </b></td> 
<td align='center'> <font size='2' color='black'>  $deltaDS[$i] <img src='$TDS[$i]' width='14' height='14'/> </td></tr> ";
$i = $i+1;
$m=$i+600;
$sum_d = $sum_d+$speed_dis[$i];
$sum_dT = $sum_dT + $speed_time[$i];
$bgco = "#BCF5A9";
if ($i==($over_index-600)) {$bgco = "#F3F781";}
if ($i<=$stp_point_cnt) {
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$m'style='height:20px; width:30px; font-size: 10px;> </td> <td align='center'> <img src='$colorp[$i]' width='14' height='14'/> </td>
<td align='center'> <font size='2' color='black'> $g_overR[$i] <img src='$gcolor[$i]' width='12' height='12'/> </td> 
<td align='center'> <font size='2' color='black'> $altH2[$i] </td> 
<td align='center'> <font size='2' color='black'> $AccSlope[$i] </td>
<td align='center'> <font size='2' color='black'> $delDis[$i] </td>
<td align='right'> <font size='2' color='black'> $gradeH[$i] <img src='$gradP[$i]' width='12' height='12'/> </td> 
<td align='center'> <font size='2' color='black'> $stp_point[$i] </td>
<td align='center'> <font size='2' color='black'> $SpeedMax[$i] km/hr <img src='$Tspd[$i]' width='12' height='12'/></td> 
<td align='center'> <font size='2' color='black'> $type_Turn[$i]  <img src='$TtypeDS[$i]' width='12' height='12'/> </td>
<td align='center'> <font size='2' color='black'> $delta_tt[$i] </td>

<td align='center'> <font size='2' color='black'> $sum_ddT[$i] <img src='$Tdurat[$i]' width='12' height='12'/> </td>
<td align='center'> <font size='2' color='black'> <b> $TE1_turn[$i] - $TE2_turn[$i] </b></td> 
<td align='center'> <font size='2' color='black'>$deltaDS[$i] <img src='$TDS[$i]' width='14' height='14'/>  </td> </tr> ";
$sum_d = $sum_d+$speed_dis[$i];
$sum_dT = $sum_dT + $speed_time[$i];
}
}
echo "</table>"; ?></td></tr>
</tbody>
</table>
</form>
<br>
</body></html>