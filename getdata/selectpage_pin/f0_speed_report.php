<?php
error_reporting(E_ERROR);
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
    <form style="height: 345px;" action="f0_speed_report.php" method="get">
        <input type="hidden" name="deviceid" value="<?php print $_GET["deviceid"]; ?>">
        <input type="hidden" name="date1" value="<?php print $_GET["date1"]; ?>">
        <input type="hidden" name="time1" value="<?php print $_GET["time1"]; ?>">
        <input type="hidden" name="time2" value="<?php print $_GET["time2"]; ?>">

        <table style="background-color: white; width: 1010px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
            <tr>
                <td style="height: 13px; background-color: white; vertical-align: top; width: 152px;" colspan="3" rowspan="1">
                    <small>
                        <span style="font-weight: bold;"></span>
                    </small>
                    <small>
                        <span style="font-weight: bold;"></span>
                    </small>
                    <small>
                        <span style="font-weight: bold;"></span>&nbsp;
                    </small>
                    <small>
                        &nbsp;<span style="font-weight: bold;">Name:&nbsp;</span>
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
                        ?><span style="font-weight: bold;">&nbsp;</span></small><small>&nbsp;
                        <span style="font-weight: bold;">Date : </span>

                            <?php $DateBegin = $Date1;
                            $datev1 = $Date1;
                            $spddate = $Date1;
                            echo "$datev1";?>
&nbsp;&nbsp;<span style="font-weight: bold;">
Time&nbsp;</span>: &nbsp;</small><small><?php echo "$TimeBegin - $TimeEnd";
if (($TimeBegin>="06:00:00") AND ($TimeBegin<="18:00:00")) {echo " <img src='sun.png' width='20' height='20'/>"; $daylight="noon";}
else {echo " <img src='moon.png' width='20' height='20'/>"; $daylight="night";}
?>
</small></td>
<td colspan="3" rowspan="1" style="font-family: Arial; height: 13px; text-align: right; background-color: white; vertical-align: top; width: 154px;"><small><span style="font-weight: bold;"></span></small><small><span style="font-weight: bold;"></span></small>
<div style="text-align: right;">
<div style="text-align: right; margin-left: 0px; width: 500px;"><small><small><?php include("f2_speed_function.php");?></small></small>&nbsp;
<small><small><big><small><span style="font-weight: bold;">Over Speed :</span></small><small><?php echo "$over";?>
</small></big><small>&nbsp;</small>
&nbsp;<big>&#3588;&#3619;&#3633;&#3657;&#3591;</big></small></small>&nbsp;
&nbsp;<small><small><big><small><span style="font-weight: bold;">Un-Controlled :</span></small><small>
                    <?php $jj = $spd_zone_cnt + $dowsy_cnt;
                    echo "$jj";?></small></big><small>&nbsp;</small>
&nbsp;<big>&#3588;&#3619;&#3633;&#3657;&#3591;</big></small></small>&nbsp;<big>&nbsp;</big><small><small><span style="font-family: Arial; font-weight: bold;">GPS Lose
:&nbsp;</span>
<big><?php echo "$stop_bus_cnt";?><span style="font-family: Arial;">&nbsp;&#3588;&#3619;&#3633;&#3657;&#3591;
&#3592;&#3629;&#3604; :<?php echo "$zero_bus_cnt";?> &nbsp;&#3588;&#3619;&#3633;&#3657;&#3591;</span></big></small></small><big>&nbsp;</big></div>
</div>
</td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); height: 10px; width: 155px;"><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span>&nbsp;</span></small><small style="font-family: Arial;"><small><span style="font-weight: bold;">Speed max</span>. <span style="font-weight: bold;">:</span></small>&nbsp;
<small><?php echo "$speed_maxy";?>&nbsp;km/hr</small></small></td>
<td style="font-family: Arial; text-align: left; background-color: rgb(204, 255, 255); vertical-align: middle; height: 10px; width: 167px;"><small style="font-family: Arial;"><small><span style="font-weight: bold;">&nbsp;All time</span>
<span style="font-weight: bold;">:</span>&nbsp;<?php $time_s = explode(":", $time_i[1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(":", $time_i[$num_rows-1]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $deltaT = $sec2 - $sec1; $hour_trip = floor($deltaT/3600); $min_trip = ((floor($deltaT/60)) - ($hour_trip*60)); if ($deltaT<60) {$sec_trip = $deltaT;} elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));} elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));} echo "$hour_trip hr $min_trip min $sec_trip sec"; $dis_sum = 0; for ($i=0; $i<($num_rows-1); $i++) { $time_s = explode(":", $time_i[$i-1]); $sec1 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $time_s = explode(":", $time_i[$i]); $sec2 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2])); $sec_del = $sec2 - $sec1; if ($sec_del<=3) { $velocity = (($speed_i[$i]+$speed_i[$i-1])/2) * (1000/3600); } $distance = $velocity * $sec_del; $dis_sum = $distance + $dis_sum; } if ($deltaT!=0) {$speed_avg = ($dis_sum/$deltaT) * (3600/1000);} ?>&nbsp;</small></small><small><span style="font-weight: bold;"></span></small><small style="font-family: Arial;"><span style="font-weight: bold;"></span></small></td>
<td style="background-color: rgb(153, 255, 153); text-align: center; width: 152px;">&nbsp;<small style="color: red;"><small style="font-family: Arial; font-weight: bold;"><?php if ($over_index=="") {$over_index=1;}
if (($over_index>=100) AND ($over_index<200)) { $title = "Un Control No.";
$jk = $over_index-100;
echo "$title $jk"; }
elseif ($over_index>800) { $jk = $over_index-800;
$title = "Zero No.";
echo "$title $over_index";
}
elseif ($over_index<100) { $title = "Speed Over No.";
echo "$title $over_index";
}
?></small></small></td>
<td style="vertical-align: middle; height: 10px; font-family: Arial; background-color: rgb(153, 255, 153); text-align: center; width: 192px;"><small><small style="font-family: Arial;">
            <span style="font-weight: bold;"> Type : </span>&nbsp;<?php if ($over_index<100) {
                if ($over_index=="") {$over_index=1;}
                if ($spdType[$over_index]==1) {$typeS = "Lane Change";}
                elseif ($spdType[$over_index]==2) {$typeS = "Turn";}
                elseif ($spdType[$over_index]==0) {$typeS = "Straight";}
                else {$typeS = "other";}
            }
            elseif (($over_index>=100) AND ($over_index<800)) {
                $kk = $over_index-100;
                $typeS = "$unControl[$kk]";}
            elseif ($over_index>=800) {
                $kk = $over_index-800;
                $typeS = "$zero_type[$kk]";}
            echo "$typeS";
            ?>
            &nbsp;<span style="font-weight: bold;">
Level&nbsp;
:&nbsp;</span><?php if ($over_index<100) { echo "<img src='$colorp[$over_index]'/>"; }
            elseif ($over_index>=100) {
                $ii = $over_index-100;
                if ($dowsy_spdm[$ii]<81) { $colorpj[$ii]="m1.png";}
                elseif (($dowsy_spdm[$ii]>=81) AND ($dowsy_spdm[$ii])) { $colorpj[$ii]="m2.png";}
                elseif (($dowsy_spdm[$ii]>=88) AND ($dowsy_spdm[$ii]<96)) { $colorpj[$ii]="m3.png";}
                elseif (($dowsy_spdm[$ii]>=96) AND ($dowsy_spdm[$ii]<104)) { $colorpj[$ii]="m4.png";}
                elseif ($dowsy_spdm[$ii]>=104) { $colorpj[$ii]="m5.png";}
                echo "<img src='$colorpj[$ii]'/>";
            }?>
            <php title="echo &quot; &lt;img src='$colorp[$over_index]' width='10' height='10'/&gt;&quot;;">
        </small></small><small><small style="font-family: Arial;"></small></small><small><small style="font-family: Arial;">
            </small></small></td>
<td style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 154px;"><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span></span></small><span style="font-family: Arial;"><span style="font-weight: bold;"></span></span><small style="font-family: Arial;"><small><span style="font-weight: bold;"></span></small>
</small><span style="font-family: Arial;"></span><small><span style="font-weight: bold; font-family: Arial;"><small>Speed
max.&nbsp; :</small>&nbsp;</span><small><span style="font-family: Arial;"><?php if ($over_index<100) { echo "$spd_max[$over_index]";}
elseif (($over_index>=100) AND ($over_index<=800)) {$jj=$over_index-100; echo "$dowsy_spdm[$jj]";}
elseif ($over_index>800) {$jj=$over_index-800; echo "$zero_vmax[$jj]";}
$spd_max_cen = $spd_max[$over_index];
?></span></small><span style="font-weight: bold; font-family: Arial;"> &nbsp;</span><small><span style="font-family: Arial;">km/hr</span><span style="font-weight: bold;"></span></small></small></td>
<td colspan="1" rowspan="1" style="height: 10px; text-align: center; background-color: rgb(153, 255, 153); width: 138px;"><small><span style="font-weight: bold;"></span><small><span style="font-family: Arial; font-weight: bold;"></span><big><span style="font-family: Arial;"></span></big></small></small>
<small><span style="font-weight: bold;"></span><span style="font-family: Arial;"></span><small style="font-family: Arial;"><span style="font-weight: bold;">Theta diff. : </span>&nbsp;<?php if ($over_index<100) { $thetas = $intDmax7[$over_index]; } elseif ($over_index>=100) { $kk = $over_index-100; $thetas = "$dowsy_intd[$kk]"; } echo "$thetas";?></small></small></td>
</tr>
<tr>
<td style="background-color: rgb(204, 255, 255); font-family: Arial; height: 18px; width: 155px;"><small><span style="font-style: italic;"></span><span style="font-weight: bold;"></span></small><small><span style="font-family: Arial;"><span style="font-weight: bold;"> &nbsp;<small>Speed avg</small></span><small>.
</small><span style="font-weight: bold;"><small>&nbsp;:</small>&nbsp;<small>
</small></span><small><?php $speed_avg = $speed_avg*$spd_unit; $speed_avg = round($speed_avg,2); echo "$speed_avg";?></small><small>&nbsp;km/hr</small></span></small></td>
<td style="background-color: rgb(204, 255, 255); height: 18px; width: 167px;"><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span><span style="font-weight: bold;"> </span></span></small><small><span style="font-family: Arial;"><span style="font-weight: bold;">&nbsp;</span></span></small><small><small><span style="font-weight: bold;"><span style="font-family: Arial;">All Distance</span></span><span style="font-family: Arial;"> &nbsp; </span></small><span style="font-weight: bold; font-family: Arial;"><small>:</small>&nbsp;</span><small><span style="font-family: Arial;"></span></small><span style="font-weight: bold; font-family: Arial;"> </span><span style="font-family: Arial;"><?php $dis_sum_km = round(($dis_sum/1000),4); echo "$dis_sum_km";?></span><span style="font-family: Arial;">&nbsp;<small>km</small></span></small></td>
<td style="text-align: center; background-color: rgb(193, 255, 193); width: 152px;"><small><small style="font-family: Arial;"><span style="font-weight: bold;">Point : </span><?php if ($over_index<100) {echo "$spd_pint1[$over_index] - $spd_pint[$over_index]"; echo "($spdZone[$over_index])";}
elseif (($over_index>=100) AND ($over_index<=800)) {
$jj=$over_index-100; echo "$dowsy_point1[$jj] - $dowsy_point2[$jj]"; echo "($spdZone[$jj])";
$pp1 = $dowsy_point1[$jj]; $pp2 = $dowsy_point2[$jj]; }
elseif ($over_index>=800) {
$jj=$over_index-800;
echo "$zero_bus_point1[$jj] - $zero_bus_point2[$jj]";
}
?>
<br>
</small></small></td>
<td style="font-family: Arial; height: 18px; background-color: rgb(193, 255, 193); text-align: center; width: 192px;"><small><span style="font-weight: bold;"> &nbsp;</span></small><span style="font-weight: bold;"><small><small>Time
&nbsp;:</small></small></span>&nbsp;<small><small><?php if ($over_index<100){
echo "$start_time[$over_index]-$stop_time[$over_index] ($speed_time[$over_index] sec)";$dura_v0 = $speed_time[$over_index];
$times1=$start_time[$over_index];
$times2=$stop_time[$over_index];
}
elseif (($over_index>=100) AND ($over_index<=800) ) {
$jj = $over_index-100;
echo "$dowsy_TT1[$jj]-$dowsy_TT2[$jj] ($dowsy_time[$jj] sec)"; $dura_v0 = $dowsy_time[$jj];
$times1=$dowsy_TT1[$jj];
$times2=$dowsy_TT2[$jj];
}
elseif ($over_index>800) {
$jj = $over_index-800;
echo "$zeroT1[$jj] - $zeroT2[$jj] ($zero_secz[$jj])";
}
$dates1=$Date1;
$devices1=$device;
?></small></small></td>
<td style="height: 18px; background-color: rgb(193, 255, 193); text-align: center; width: 154px;"><small><small><span style="font-family: Arial;"></span></small><small style="font-family: Arial;"><span style="font-weight: bold;"></span></small></small><small><span style="font-weight: bold; font-family: Arial;"></span><small><span style="font-family: Arial;"></span><span style="font-family: Arial;"><?php if ($over_index<100) {
if ($speed_time[$over_index]!=0) {$speed_avgn = round((3600*$speed_dis[$over_index] / $speed_time[$over_index]),2);}
else {$speed_avng=0;}
$jhk = "Avg. Speed";
}
elseif (($over_index>=100) AND ($over_index<800)) {
$kk=$over_index-100;
$speed_avgn = $dowsy_intv[$kk];
$jhk = "Int.Speed";
}
elseif ($over_index>=800) {
$jhk = "Zero";
}
echo "<b>$jhk : </b>$speed_avgn ";?></span></small><span style="font-weight: bold; font-family: Arial;"> &nbsp;</span><small><span style="font-family: Arial;">km/hr</span></small></small></td>
<td style="background-color: rgb(193, 255, 193); text-align: center; width: 138px;"><small><small><span style="font-family: Arial;"><span style="font-weight: bold;"></span></span></small></small>&nbsp;<small><small><span style="font-family: Arial;"> <span style="font-weight: bold;">Distance : &nbsp;</span><?php if ($over_index<100) {echo "$speed_dis[$over_index] km."; $dis_v = $speed_dis[$over_index];}
elseif ($over_index>=100) {$kk = $over_index-100;
$ta = $dowsy_distance[$kk]*1000; $dis_v =$dowsy_distance[$kk]*1000; echo "$ta m.";}
?><span style="font-weight: bold;"> </span>&nbsp;</span></small></small></td>
</tr>
</tbody>
</table>
<br>
<table style="width: 1010px; height: 138px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td rowspan="2" style="background-color: rgb(255, 255, 204); height: 144px; width: 547px;">
<?php include ("f2_mapEarth_function.php");
?></td>
<td style="height: 144px; vertical-align: middle; width: 443px; text-align: right; background-color: white;"><?php $j1=0;$j2=0;$j3=0;$j4=0;$j0=0;
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
?><small><small><span style="font-family: Arial;"></span></small></small>
<?php include ("f2_graphL_function.php");?>&nbsp;<small><small><span style="font-family: Arial;"></span></small></small><br>
</td>

</tr>
<tr>
<td style="vertical-align: top; background-color: white; text-align: center; width: 443px;" align="center">
<table style="text-align: left; width: 446px; height: 141px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td>
<table style="width: 100%; text-align: left; margin-left: auto; margin-right: 0px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="text-align: center;"><?php $k = $j4;
$kk = 5-$k;
for ($i=1; $i<=$kk; $i++) {
echo "<img src='u5.png'/><br>";
}
for ($i=1; $i<=$k; $i++) {
echo "<img src='u6.png'/><br>";
}?></td>
<td style="text-align: center;"><?php $k = $j3; $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u5.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u6.png'/><br>"; }?></td>
<td style="text-align: center;"><?php $k = $j2; $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u5.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u6.png'/><br>"; }?></td>
<td style="text-align: right;"><?php if ($j1>=6) {$j1=6;}
$k = $j1;
$kk = 5-$k;
for ($i=1; $i<=$kk; $i++) {
echo "<img src='u5.png'/><br>";
}
for ($i=1; $i<=$k; $i++) {
echo "<img src='u6.png'/><br>";
}?></td>
<td><?php if ($j0>=6) {$j0=6;}
$k = $j0;
$kk = 5-$k;
for ($i=1; $i<=$kk; $i++) {
echo "<img src='u5.png'/><br>";
}
for ($i=1; $i<=$k; $i++) {
echo "<img src='u6.png'/><br>";
}?></td>
</tr>
<tr>
<td style="text-align: center;"><small><small><small><font face="Arial" size="2"><small><small><small>104
km/hr</small></small></small></font></small></small></small></td>
<td style="text-align: center;"><small><small><small><font face="Arial" size="2"><small><small><small>96
km/hr</small></small></small></font></small></small></small></td>
<td style="text-align: center;"><small><small><small><font face="Arial" size="2"><small><small><small>88
km/hr</small></small></small></font></small></small></small></td>
<td style="text-align: center; background-color: white;"><small><small><small><font face="Arial" size="2"><small><small><small>81
km/hr</small></small></small></font></small></small></small></td>
<td style="text-align: center;"><small><small><small><span style="font-family: Arial;">80 km/hr</span></small></small></small></td>
</tr>
</tbody>
</table>
</td>
<td style="text-align: center; vertical-align: middle;"><?php echo "<img src='turn_0.png' width='24' height='24'/>";?></td>
<td>
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td><?php $k = floor(($osp[0]/5)); if ($k>5) {$k=5;} $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u7.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u8.png'/><br>"; }?></td>
<td><?php $k = floor(($osp[1]/5)); if ($k>5) {$k=5;} $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u7.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u8.png'/><br>"; }?></td>
<td><?php $k = floor(($osp[2]/5)); if ($k>5) {$k=5;} $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u7.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u8.png'/><br>"; }?></td>
<td><?php floor(($osp[3]/5)); if ($k>5) {$k=5;} $kk = 5-$k; for ($i=1; $i<=$kk; $i++) { echo "<img src='u7.png'/><br>"; } for ($i=1; $i<=$k; $i++) { echo "<img src='u8.png'/><br>"; }?></td>
<td><?php $k = floor(($osp[4]/5));
if ($k>5) {$k=5;}
elseif ($k<5) {$k=1;}
$kk = 5-$k;
for ($i=1; $i<=$kk; $i++) {
echo "<img src='u7.png'/><br>";
}
for ($i=1; $i<=$k; $i++) {
echo "<img src='u8.png'/><br>";
}?></td>
</tr>
<tr>
<td style="text-align: center;"><small><small><span style="font-family: Arial;">80 km/hr</span></small></small></td>
<td style="text-align: center;"><small><small><font face="Arial" size="2"><small><small>81
km/hr</small></small></font></small></small></td>
<td style="text-align: center;"><small><small><font face="Arial" size="2"><small><small>88
km/hr</small></small></font></small></small></td>
<td style="text-align: center;"><small><small><font face="Arial" size="2"><small><small>96
km/hr</small></small></font></small></small></td>
<td style="text-align: center;"><small><small><font face="Arial" size="2"><small><small>104
km/hr</small></small></font></small></small></td>
</tr>
</tbody>
</table>
</td><td colspan="1" rowspan="3">&nbsp;<small><small><span style="font-family: Arial;"><input style="width: 60px; height: 40px;" onclick="window.open('f2_graph_type_speed.php?deviceid=<?php echo $deviceid;?>&date1=<?php echo $date1;?>&time1=<?php echo $time1;?>&time2=<?php echo $time2;?>')" value="Total" name="Behavior" type="button"></span></small></small></td>
</tr>
<tr>
<td style="text-align: right; color: rgb(51, 204, 255);"><small style="font-weight: bold;"><span style="font-family: Arial;"><small style="color: rgb(51, 102, 255);"><?php $overun=$dowsy_cnt+$spd_zone_cnt; echo "($overun)";?></small><span style="color: rgb(51, 102, 255);"> Un Control</span>&nbsp;</span></small></td>
<td></td>
<td style="color: rgb(255, 105, 244);"><small style="font-weight: bold;"><span style="font-family: Arial;">Hard Control <small><?php echo "($over)";?></small></span></small></td>
</tr>
<tr>
<td style="text-align: right;"><?php if ($overun==0) { $jj=0;}
elseif (($overun>0) AND ($overun<=10)) { $jj=1;}
elseif (($overun>10) AND ($overun<=20)) {$jj=2;}
elseif (($overun>20) AND ($overun<=30)) {$jj=3;}
elseif (($overun>30) AND ($overun<=40)) {$jj=4;}
elseif (($overun>40) AND ($overun<=50)) {$jj=5;}
elseif (($overun>50) AND ($overun<=60)) {$jj=6;}
elseif ($overun>60) {$jj=7;}
$fj = 7-$jj; for ($i=1; $i<=$fj; $i++) {
echo "<img src='u1.png' width='16' height='34'/>";
}
for ($i=1; $i<=$jj; $i++) {
echo "<img src='u2.png' width='16' height='34'/>";
}?></td>
<td style="text-align: center; width: 25px;">
<img style="width: 24px; height: 31px;" alt="" src="u0.png"></td>
<td><small><small><span style="font-family: Arial;"></span></small></small></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<br>
<br>
<table style="width: 1010px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="vertical-align: top;"><?php for ($i=1; $i<=$dowsy_cnt; $i++) {
if ($dowsy_spdm[$i]<81) { $colorpj[$i]="m1.png";}
elseif (($dowsy_spdm[$i]>=81) AND ($dowsy_spdm[$i]<88)) { $colorpj[$i]="m2.png";}
elseif (($dowsy_spdm[$i]>=88) AND ($dowsy_spdm[$i]<96)) { $colorpj[$i]="m3.png";}
elseif (($dowsy_spdm[$i]>=96) AND ($dowsy_spdm[$i]<104)) { $colorpj[$i]="m4.png";}
elseif ($dowsy_spdm[$i]>=104) { $colorpj[$i]="m5.png";}
$deltaT = $dowsy_time[$i];
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$duration1[$i] = "$min_trip min $sec_trip sec";
if ($unControl[$i]=="dowsy") {$unpic[$i] = "sleep.png";}
}
for ($i=1; $i<=$spd_zone_cnt; $i++) {
if ($primtime[$i]==1) {$pm[$i] = "spd04.png";}
$j=$i+$dowsy_cnt; $deltaT = $dowsy_time[$j]; /* second */
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$duration1[$j] = "$min_trip min $sec_trip sec";
if ($unControl[$j]=="zoning") {$unpic[$j] = "no.png";}
}
echo "<table width='440' border='0'>";
echo " <tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Un-C. no. </td> <td align='right'> <font size='2' color='black'> Duration </td> <td align='right'> <font size='2' color='black'> Time </td> <td align='right'> <font size='2' color='black'> Distance </td> <td align='center'> <font size='2' color='black'> Speed max </td> <td align='center'> <font size='2' color='black'> Point </td> <td align='center'> <font size='2' color='black'> Type </td> </tr> ";
echo " <tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Sea Area </td> <td align='right'> <font size='2' color='black'> <input type='submit' name='over_index' value='199' style='height:20px; width:30px; font-size: 10px;> </td> <td align='right'> <font size='2' color='black'> --- </td> <td align='right'> <font size='2' color='black'> --- </td> <td align='right'> <font size='2' color='black'> --- </td> <td align='center'> <font size='2' color='black'> --- </td> <td align='center'> <font size='2' color='black'> $pointSea1-$pointSea2 </td> <td align='center'> <font size='2' color='black'> Sea </td> </tr> ";
for ($i=1; $i<= $dowsy_cnt; $i++) {
$bgco = "#81F781"; $i00 = $i+100;
if ($i==$over_index) {$bgco = "#F3F781";}
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$i00' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <img src='$unpic[$i]' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $duration1[$i] </td> <td align='right'> <font size='2' color='black'> $dowsy_TT1[$i] </td> <td align='right'> <font size='2' color='black'> $dowsy_distance[$i] km</td> <td align='center'> <font size='2' color='black'>$dowsy_spdm[$i] km/hr</td>
<td align='center'> <font size='2' color='black'> $dowsy_point1[$i]:$dowsy_point2[$i] </td> <td align='center'> <font size='2' color='black'> $unControl[$i] </td>
</tr> ";
$i=$i+1;
$bgco = "#BCF5A9";$i00 = $i+100;
if ($i==$over_index) {$bgco = "#F3F781";}
if ($i<=$dowsy_cnt) {
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$i00' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <img src='$unpic[$i]' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $duration1[$i] </td> <td align='right'> <font size='2' color='black'> $dowsy_TT1[$i] </td> <td align='right'> <font size='2' color='black'> $dowsy_distance[$i] km</td> <td align='center'> <font size='2' color='black'>$dowsy_spdm[$i] km/hr</td>
<td align='center'> <font size='2' color='black'> $dowsy_point1[$i]:$dowsy_point2[$i] </td> <td align='center'> <font size='2' color='black'> $unControl[$i] </td>
</tr> ";
}
}
for ($i=1; $i<=$spd_zone_cnt; $i++) {
$j=$i+$dowsy_cnt;
$bgco = "#81F781"; $i00 = $dowsy_cnt+$i+100;
if ($i==$over_index) {$bgco = "#F3F781";}
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$i00' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <img src='$unpic[$j]' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $duration1[$j] </td> <td align='right'> <font size='2' color='black'> $dowsy_TT1[$j] </td> <td align='right'> <font size='2' color='black'> $dowsy_distance[$j] km</td> <td align='center'> <font size='2' color='black'>$dowsy_spdm[$j] km/hr</td>
<td align='center'> <font size='2' color='black'> $dowsy_point1[$j]:$dowsy_point2[$j] </td> <td align='center'> <font size='2' color='black'> $unControl[$j] </td>
</tr> ";
$i=$i+1; $j=$i+$dowsy_cnt;
$bgco = "#BCF5A9";$i00 = $dowsy_cnt+$i+100;
if ($i==$over_index) {$bgco = "#F3F781";}
if ($i<=$spd_zone_cnt) {
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$i00' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <img src='$unpic[$j]' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $duration1[$j] </td> <td align='right'> <font size='2' color='black'> $dowsy_TT1[$j] </td> <td align='right'> <font size='2' color='black'> $dowsy_distance[$j] km</td> <td align='center'> <font size='2' color='black'>$dowsy_spdm[$j] km/hr</td>
<td align='center'> <font size='2' color='black'> $dowsy_point1[$j]:$dowsy_point2[$j] </td> <td align='center'> <font size='2' color='black'> $unControl[$j] </td>
</tr> ";
}
}
echo "</table>"; ?>
<br>
<?php for ($i=1; $i<=$zero_bus_cnt; $i++) {
$deltaT = $zero_bus_time[$i];
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$duration[$i] = "$hour_trip:$min_trip:$sec_trip";
}
echo "<table width='440' border='0'>";
echo "<tr tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Stop no. </td> <td align='center'> <font size='2' color='black'> point </td>
<td align='center'> <font size='2' color='black'> latB - lonB </td>
<td align='center'> <font size='2' color='black'> V max </td>
<td align='center'> <font size='2' color='black'> V min </td>
<td align='center'> <font size='2' color='black'> duration </td> </tr> ";
for ($i=1; $i<=$zero_bus_cnt; $i++) {
$jk = $i+800;
echo "<tr tr bgcolor='#F3F781'> <td align='center'> <input type='submit' name='over_index' value='$jk' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <font size='2' color='black'> $i </td> <td align='center'> <font size='2' color='black'> $zero_bus_point1[$i] - $zero_bus_point2[$i] </td>
<td align='center'> <font size='2' color='black'> $zero_latB[$i] - $zero_lonB[$i] </td>
<td align='center'> <font size='2' color='black'> $zero_vmax[$i] </td> <td align='center'> <font size='2' color='black'> $zero_vmin[$i] </td> <td align='center'> <font size='2' color='black'> $duration[$i] </td> </tr> ";
}
echo "</table>";?></td>
<td style="vertical-align: top;"><?php for ($i=1; $i<=$over; $i++) {
if ($spdType[$i]==1) {$typeSJ[$i] = "Lane Changing";}
elseif ($spdType[$i]==4) {$typeSJ[$i] = "Lane Changing H";}
elseif ($spdType[$i]==2) {$typeSJ[$i] = "Curve";}
elseif ($spdType[$i]==5) {$typeSJ[$i] = "Curve H";}
elseif ($spdType[$i]==0) {$typeSJ[$i] = "Straight";}
elseif ($spdType[$i]==6) {$typeSJ[$i] = "Straight H";}
else {$typeSJ[$i] = "Other";}
$speed_avgk[$i] = round((3600*$speed_dis[$i] / $speed_time[$i]),2);
$deltaT = $speed_time[$i];
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$duration[$i] = "$hour_trip:$min_trip:$sec_trip";
}
echo "<table width='620' border='0'>";
echo " <tr bgcolor='#58FA58'> <td align='center'> <font size='2' color='black'> Over no. </td> <td align='center'> <font size='2' color='black'> speed max.@point </td> <td align='center'> <font size='2' color='black'> point </td> <td align='center'> <font size='2' color='black'> speed avg. </td> <td align='center'> <font size='2' color='black'> type </td> <td align='center'> <font size='2' color='black'> theta </td> <td align='center'> <font size='2' color='black'> duration </td> <td align='center'> <font size='2' color='black'> distance </td> <td align='center'> <font size='2' color='black'> Alt. max. </td>
</tr> ";
for ($i=1; $i<=$over; $i++) {
$bgco = "#81F781";
if ($i==$over_index) {$bgco = "#F3F781";}
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$i' style='height:20px; width:30px; font-size: 10px;> </td>
<td align='center'> <img src='$colorp[$i]' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $spd_max[$i] km/hr ($spd_pint2[$i]) </td> <td align='center'> <font size='2' color='black'> $spd_pint1[$i] - $spd_pint[$i] </td>
<td align='right'> <font size='2' color='black'> $speed_avgk[$i] km/hr</td> <td align='center'> <font size='2' color='black'> $typeSJ[$i] </td> <td align='center'> <font size='2' color='black'> $intDmax7[$i] </td> <td align='center'> <font size='2' color='black'> $duration[$i] </td> <td align='right'> <font size='2' color='black'> $speed_dis[$i] km </td> <td align='right'> <font size='2' color='black'> $altMaxi[$i] m </td> </tr> ";
$i=$i+1;
$sum_d = $sum_d+$speed_dis[$i];
$sum_dT = $sum_dT + $duration[$i];
$bgco = "#BCF5A9";
if ($i==$over_index) {$bgco = "#F3F781";}
if ($i<=$over) {
echo " <tr bgcolor='$bgco'> <td align='center'> <input type='submit' name='over_index' value='$i'style='height:20px; width:30px; font-size: 10px;> </td> <td align='center'> <img src='$colorp[$i]' width='14' height='14'/> </td>
<td align='right'> <font size='2' color='black'> $spd_max[$i] km/hr ($spd_pint2[$i]) </td> <td align='center'> <font size='2' color='black'> $spd_pint1[$i] - $spd_pint[$i] </td>
<td align='right'> <font size='2' color='black'> $speed_avgk[$i] km/hr</td> <td align='center'> <font size='2' color='black'> $typeSJ[$i] </td>
<td align='center'> <font size='2' color='black'> $intDmax7[$i] </td>
<td align='center'> <font size='2' color='black'> $duration[$i] </td>
<td align='right'> <font size='2' color='black'> $speed_dis[$i] km </td> <td align='right'> <font size='2' color='black'> $altMaxi[$i] m </td> </tr> ";
$sum_d = $sum_d+$speed_dis[$i];
$sum_dT = $sum_dT + $speed_time[$i];
}
}
$deltaT = $sum_dT;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
$sum_d_T = "$hour_trip : $min_trip : $sec_trip";
echo " <tr bgcolor='$bgco'> <td align='center'> <font size='2' color='black'> sum </td>
<td align='right'> <font size='2' color='black'> $spd_max[$i] km/hr ($spd_pint2[$i]) </td> <td align='center'> <font size='2' color='black'> $spd_pint1[$i] - $spd_pint[$i] </td>
<td align='right'> <font size='2' color='black'> $speed_avgk[$i] km/hr</td> <td align='center'> <font size='2' color='black'> $typeSJ[$i] </td>
<td align='center'> <font size='2' color='black'> $intDmax7[$i] </td>
<td align='center'> <font size='2' color='black'> $sum_d_T </td>
<td align='right'> <font size='2' color='black'> $sum_d km </td> </tr> ";
echo "</table>"; ?>
</td>
</tr>
<tr>
<td style="vertical-align: top;" colspan="1" rowspan="1">
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="background-color: rgb(255, 153, 255); text-align: center;"><small><small>Drowsy</small></small></td>
<td style="background-color: rgb(255, 153, 255); text-align: center; width: 98px;"><small><small>Zoning</small></small></td>
<td style="background-color: rgb(255, 153, 255); text-align: center; width: 99px;"><small><small>GPS
Lose</small></small></td>
<td style="background-color: rgb(255, 153, 255); text-align: center; width: 98px;"><small><small>Total</small></small></td>
</tr>
<tr>
<td style="background-color: rgb(255, 204, 255); text-align: center;"><small><small><?php echo "$dowsy_cnt";?></small></small></td>
<td style="background-color: rgb(255, 204, 204); width: 98px; text-align: center;"><small><small><?php echo "$spd_zone_cnt";?></small></small></td>
<td style="background-color: rgb(255, 204, 204); width: 99px; text-align: center;"><small><small><?php echo "$stop_bus_cnt";?></small></small></td>
<td style="background-color: rgb(255, 204, 204); width: 98px; text-align: center;"><small><small><?php $totalU = $dowsy_cnt +$spd_zone_cnt+$stop_bus_cnt;
echo "$totalU";?></small></small></td>
</tr>
</tbody>
</table>
<br>
<table style="text-align: left; width: 100%;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="background-color: rgb(51, 204, 255); text-align: center;"><small><small>
&nbsp;Z01 &nbsp;<?php $ztp1=0;$ztp2=0;$ztp3=0;$ztp4=0;$ztp5=0;$ztp6=0;$ztp7=0;$ztp8=0;
for ($i=1; $i<=$over; $i++) {
if ($spdZone[$i]=="z01") {$ztp1 = $ztp1+1; }
elseif ($spdZone[$i]=="z02") {$ztp2 = $ztp2+1; }
elseif ($spdZone[$i]=="z03") {$ztp3 = $ztp3+1; }
elseif ($spdZone[$i]=="z04") {$ztp4 = $ztp4+1; }
elseif ($spdZone[$i]=="z05") {$ztp5 = $ztp5+1; }
elseif ($spdZone[$i]=="z06") {$ztp6 = $ztp6+1; }
elseif ($spdZone[$i]=="z07") {$ztp7 = $ztp7+1; }
elseif ($spdZone[$i]=="z08") {$ztp8 = $ztp8+1; }
elseif ($spdZone[$i]=="z00") {$ztp0 = $ztp0+1; }
}
?></small></small></td>
<td style="background-color: rgb(51, 204, 255); text-align: center;"><small><small>Z02
&nbsp;</small></small></td>
<td style="background-color: rgb(51, 204, 255); text-align: center;"><small><small>Z03
&nbsp;</small></small></td>
<td style="background-color: rgb(51, 204, 255); text-align: center;"><small><small>Z04&nbsp;</small></small></td>
<td style="background-color: rgb(51, 204, 255); text-align: center;"><small><small>Z05&nbsp;</small></small></td>
<td style="background-color: rgb(51, 204, 255); text-align: center;"><small><small>Z06&nbsp;</small></small></td>
</tr>
<tr>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><small><small></small></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><small><small></small></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><small><small></small></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><small><small></small></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><small><small></small></small></td>
<td style="background-color: rgb(153, 255, 255); text-align: center;"><small><small>


        </small></small></td>
</tr>
</tbody>
</table>
<br>
</td>
<td colspan="1" rowspan="1" align="undefined" valign="undefined">
<table style="text-align: left; background-color: white; width: 560px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td colspan="2" rowspan="1" style="text-align: center; background-color: rgb(255, 153, 255);"><?php $pt1_0=0;$pt2_0=0;$pt3_0=0;$pt4_0=0;
$tp1=0;$tp2=0;$tp3=0;$tp4=0;
$pt1=0;$pt2=0;$pt3=0;$pt4=0;
$pt1_1=0;$pt1_2=0;$pt1_3=0;
$pt2_1=0;$pt2_2=0;$pt2_3=0;
$pt3_1=0;$pt3_2=0;$pt3_3=0;
$pt4_1=0;$pt4_2=0;$pt4_3=0;
$pt1_4=0; $pt1_5=0; $pt1_6=0;
$pt2_4=0; $pt2_5=0; $pt2_6=0;
$pt3_4=0; $pt3_5=0; $pt3_6=0;
$pt4_4=0; $pt4_5=0; $pt4_6=0;
for ($i=1; $i<=$over; $i++) {
if ($spdType[$i]==1) {$tp3 = $tp3+1; }
elseif ($spdType[$i]==2) {$tp2 = $tp2+1; }
elseif ($spdType[$i]==0) {$tp1 = $tp1+1; }
else {$typeSJ[$i] = "Other";}
if (($spd_max[$i]>=81) AND ($spd_max[$i]<88)) { $pt4 = $pt4+1; $dura4 = $dura4+$speed_time[$i];
$dis4 = $dis4+$speed_dis[$i];
if ($spdType[$i]==1) {$pt4_3 = $pt4_3+1; }
elseif ($spdType[$i]==2) {$pt4_2 = $pt4_2+1; }
elseif ($spdType[$i]==0) {$pt4_1 = $pt4_1+1; }
elseif ($spdType[$i]==4) {$pt4_4 = $pt4_4+1; }
elseif ($spdType[$i]==5) {$pt4_5 = $pt4_5+1; }
elseif ($spdType[$i]==6) {$pt4_6 = $pt4_6+1; }
else {$pt4_0 = $pt4_0+1;}
}
elseif (($spd_max[$i]>=88) AND ($spd_max[$i]<96)) { $pt3 = $pt3+1; $dura3 = $dura3+$speed_time[$i];
$dis3 = $dis3+$speed_dis[$i];
if ($spdType[$i]==1) {$pt3_3 = $pt3_3+1; }
elseif ($spdType[$i]==2) {$pt3_2 = $pt3_2+1; }
elseif ($spdType[$i]==0) {$pt3_1 = $pt3_1+1; }
elseif ($spdType[$i]==4) {$pt3_4 = $pt3_4+1; }
elseif ($spdType[$i]==5) {$pt3_5 = $pt3_5+1; }
elseif ($spdType[$i]==6) {$pt3_6 = $pt3_6+1; }
else {$pt3_0 = $pt3_0+1;;}
}
elseif (($spd_max[$i]>=96) AND ($spd_max[$i]<104)) { $pt2 = $pt2+1; $dura2 = $dura2+$speed_time[$i];
$dis2 = $dis2+$speed_dis[$i];
if ($spdType[$i]==1) {$pt2_3 = $pt2_3+1; }
elseif ($spdType[$i]==2) {$pt2_2 = $pt2_2+1; }
elseif ($spdType[$i]==0) {$pt2_1 = $pt2_1+1; }
elseif ($spdType[$i]==4) {$pt2_4 = $pt2_4+1; }
elseif ($spdType[$i]==5) {$pt2_5 = $pt2_5+1; }
elseif ($spdType[$i]==6) {$pt2_6 = $pt2_6+1; }
else {$pt2_0 = $pt2_0+1;}
}
elseif ($spd_max[$i]>=104) { $dura1 = $dura1+$speed_time[$i];
$dis1 = $dis1+$speed_dis[$i];
$pt1 = $pt1+1; if ($spdType[$i]==1) {$pt1_3 = $pt1_3+1; }
elseif ($spdType[$i]==2) {$pt1_2 = $pt1_2+1; }
elseif ($spdType[$i]==0) {$pt1_1 = $pt1_1+1; }
elseif ($spdType[$i]==4) {$pt1_4 = $pt1_4+1; }
elseif ($spdType[$i]==5) {$pt1_5 = $pt1_5+1; }
elseif ($spdType[$i]==6) {$pt1_6 = $pt1_6+1; }
else {$pt1_0 = $pt1_0+1;}
}
}?><small style="font-family: Arial;"><small>&#3588;&#3619;&#3633;&#3657;&#3591;</small></small></td>
<td style="text-align: center; background-color: rgb(255, 204, 255);"><small><small><span style="font-family: Arial;">Straight</span></small></small></td>
<td style="text-align: center; background-color: rgb(255, 204, 255);"><small><small style="font-family: Arial;">Curve</small></small></td>
<td style="text-align: center; background-color: rgb(255, 204, 255);"><small><small style="font-family: Arial;">Lane change</small></small></td>
<td style="background-color: rgb(255, 204, 255); text-align: center;"><small><small>Other</small></small></td>
<td style="text-align: center; background-color: rgb(255, 204, 255);"><small style="font-family: Arial;"><small>Duration</small></small></td>
<td style="background-color: rgb(255, 204, 255); text-align: center;"><small><small>Distance
(km)</small></small></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><img style="width: 16px; height: 16px;" alt="" src="m5.png"></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><small><small><span style="font-family: Arial;"></span></small></small><?php echo "<font size='2' color='black'> $pt1 ";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt1_1 | $pt1_6";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt1_2 | $pt1_5";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt1_3 | $pt1_4";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt1_0";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php $deltaT = $dura1;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
echo "<font size='2' color='black'> $hour_trip : $min_trip : $sec_trip ";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $dis1 ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><img style="width: 16px; height: 16px;" alt="" src="m4.png"></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt2";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt2_1 | $pt2_6";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt2_2 | $pt2_5";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt2_3 | $pt2_4";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt2_0";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php $deltaT = $dura2;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
echo "<font size='2' color='black'> $hour_trip : $min_trip : $sec_trip ";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $dis2 ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><img style="width: 16px; height: 16px;" alt="" src="m3.png"></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt3";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt3_1 | $pt3_6";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt3_2 | $pt3_5";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt3_3 | $pt3_4";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $pt3_0";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php $deltaT = $dura3;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
echo "<font size='2' color='black'> $hour_trip : $min_trip : $sec_trip ";?></td>
<td style="text-align: center; background-color: rgb(255, 204, 153);"><?php echo "<font size='2' color='black'> $dis3 ";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><img style="width: 16px; height: 16px;" alt="" src="m2.png"></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt4";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt4_1 | $pt4_6";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt4_2 | $pt4_5";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt4_3 | $pt4_4";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $pt4_0";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php $deltaT = $dura4;
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
echo "<font size='2' color='black'> $hour_trip : $min_trip : $sec_trip ";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 102);"><?php echo "<font size='2' color='black'> $dis4 ";?></td>
</tr>
<tr>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(255, 153, 255);"><small style="font-family: Arial;">&#3619;&#3623;&#3617;</small></td>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(255, 153, 255);"><?php $pt0 = $pt1+$pt2+$pt3+$pt4;
echo "<font size='2' color='black'> $pt0";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 255);"><?php $pts1 = $pt1_1+$pt2_1+$pt3_1+$pt4_1;
$pts1H = $pt1_6+$pt2_6+$pt3_6+$pt4_6;
echo "<font size='2' color='black'> $pts1 | $pts1H";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 255);"><?php $pts2 = $pt1_2+ $pt2_2 +$pt3_2+$pt4_2;
$pts2H = $pt1_5+ $pt2_5 +$pt3_5+$pt4_5;
echo "<font size='2' color='black'> $pts2 | $pts2H ";?></td>
<td style="text-align: center; background-color: rgb(255, 153, 255);"><?php $pts3 = $pt1_3+$pt2_3+$pt3_3+$pt4_3;
$pts3H = $pt1_4+$pt2_4+$pt3_4+$pt4_4;
echo "<font size='2' color='black'> $pts3 | $pts3H";?></td>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(255, 153, 255);"><?php $pts4 = $pt1_0+$pt2_0+$pt3_0+$pt4_0;
echo "<font size='2' color='black'> $pts4";?></td>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(255, 153, 255);"><?php $deltaT = $dura1+$dura2+$dura3+$dura4;
if ($sum_time!=0) {$sumT = ($deltaT/$sum_time)*100;}
else {$sumT=0;}
$tSum = $deltaT;
$sumT = round($sumT,2);
$hour_trip = floor($deltaT/3600);
$min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
if ($deltaT<60) {$sec_trip = $deltaT;}
elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
echo "<font size='2' color='black'> $hour_trip : $min_trip : $sec_trip ($sumT%) ";?></td>
<td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(255, 153, 255);"></td>
</tr>
<tr>
<td style="background-color: rgb(255, 153, 255); text-align: center;"><?php $pts1T = $pts1 + $pts1H;
echo "<font size='2' color='black'> $pts1T";?></td>
<td style="background-color: rgb(255, 153, 255); text-align: center;"><?php $pts2T = $pts2 + $pts2H;
echo "<font size='2' color='black'> $pts2T";?></td>
<td style="background-color: rgb(255, 153, 255); text-align: center;"><?php $pts3T = $pts3 + $pts3H;
echo "<font size='2' color='black'> $pts3T";?></td>
</tr>
<tr>
<td style="text-align: center; background-color: rgb(0, 153, 0);" colspan="6" rowspan="1"><?php $Ototal = $totalU + $pt0 - $spd_zone_cnt;
echo "<font size='2' color='black'> $Ototal";?></td>
<td style="background-color: rgb(0, 153, 0);"></td>
<td style="background-color: rgb(0, 153, 0);"></td>
</tr>
</tbody>
</table>
<br>
</td>
</tr>
<tr>
</tr>
<tr>
<td colspan="2" rowspan="1" style="vertical-align: top; width: 559px;">
<hr style="width: 100%; height: 2px;"></td>
</tr>
<tr>
<td style="width: 431px;" align="undefined" valign="undefined"><?php $zone_v = "$ztp1:$ztp2:$ztp3:$ztp4:$ztp5:$ztp6:$ztp7:$ztp8";
$level_v = "$pt1:$pt2:$pt3:$pt4";
$date7 = explode('/',$datev1);
$date8 = array($date7[2],$date7[1],$date7[0]);
$date77 = implode('-',$date8);
$totalv = $Ototal;
$otype = "$pts1:$pts2:$pts3:$pts4";
$otypeH = "$pts1H:$pts2H:$pts3H";
$utype = "$dowsy_cnt:$spd_zone_cnt:$stop_bus_cnt";
$objConnect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
$objDB = mysql_select_db(DB_NAME);
$delsql = " DELETE FROM `speedtype` WHERE `index`='$selectT' AND `date`='$datev1' AND `time1`='$Time1' ; ";
$objQuery = mysql_query($delsql);
$strSQL = "INSERT INTO `speedtype` (`timestp` ,`index` ,`date`,`time1` ,`time2`,`vmax`,`vavg` ,`zone`,`level`,`duration` ,`distance` ,`day`,`otype`,`utype`,`ototal`,`otypeH` ) VALUES ( NOW( ), '$selectT', '$datev1','$Time1','$Time2','$spd_max_cen','$speed_avgn','$zone_v','$level_v','$tSum','$sum_d','$daylight','$otype','$utype','$totalv','$otypeH');; ";
$objQuery = mysql_query($strSQL);
mysql_close($objConnect);
?></td>
<td style="width: 559px;" align="undefined" valign="undefined">&nbsp;<?php 
$objConnect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
$objDB = mysql_select_db(DB_NAME);
$delsql = " DELETE FROM `speedscore` WHERE (`test` = '$selectT') AND (`date`= '$spddate') AND (`time1`= '$TimeBegin'); ";
$objQuery = mysql_query($delsql);
for ($t=1; $t<=$ove; $t++) {
$spdp1 = $spd_pint1[$t];
$spdp2 = $spd_pint2[$t];
$spdotime = $speed_time[$t];
$lat1 = $latBe1[$t];
$lon1 = $lonBe1[$t];
$lat2 = $latEn1[$t];
$lon2 = $lonEn1[$t];
$time1 = $start_time[$t];
$time2 = $stop_time[$t];;
if ($spdType[$t]==1) {$spdotyp = "Lane Changing";}
elseif ($spdType[$t]==2) {$spdotyp = "Curve";}
elseif ($spdType[$t]==0) {$spdotyp = "Straight";}
elseif ($spdType[$t]==4) {$spdotyp = "Lane Changing H";}
elseif ($spdType[$t]==5) {$spdotyp = "Curve H ";}
elseif ($spdType[$t]==6) {$spdotyp = "Straight H";}
else {$spdotyp = "Other";}
$strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`time1`,`time2`,`overindex`,`spdp1`,`spdp2`,`lat1`,`lon1`,`lat2`,`lon2`,`overtype`,`overtime`,`rout`)
VALUES ( '$selectT', NOW( ), '$spddate', '$TimeBegin', '$TimeEnd', '$t','$spdp1','$spdp2','$lat1','$lon1','$lat2','$lon2','$spdotyp','$spdotime','$tripdir');;"; $objQuery = mysql_query($strSQL);
}
/*
for ($t=1; $t<=$dowsy_cnt; $t++) {
$spdp1 = $dowsy_point1[$t];
$spdp2 = $dowsy_point2[$t];
$lat1 = $latD1[$t];
$lon1 = $lonD1[$t];
$lat2 = $latDEn1[$t];
$lon2 = $lonDEn1[$t];
$spdotyp = "drowsy";
$spdotime = $dowsy_time[$t];
$strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`time1`,`time2`,`overindex`,`spdp1`,`spdp2`,`lat1`,`lon1`,`lat2`,`lon2`,`overtype`,`overtime`,`rout`)
VALUES ( '$selectT', NOW( ), '$spddate', '$TimeBegin', '$TimeEegin', '$t','$spdp1','$spdp2','$lat1','$lon1','$lat2','$lon2','$spdotyp','$spdotime','$tripdir');;"; $objQuery = mysql_query($strSQL);
}
for ($t=1; $t<=$spd_zone_cnt; $t++) {
$k = $t+$dowsy_cnt;
$spdp1 = $dowsy_point1[$t];
$spdp2 = $dowsy_point2[$t];
$lat1 = $latZ1Be[$t];
$lon1 = $lonZ1Be[$t];
$lat2 = $latZ1En[$t];
$lon2 = $lonZ1En[$t];
$spdotyp = "zoning";
$spdotime = $dowsy_time[$t] ;
$strSQL = "INSERT INTO `speedscore` (`test`,`timestp`,`date`,`time1`,`time2`,`overindex`,`spdp1`,`spdp2`,`lat1`,`lon1`,`lat2`,`lon2`,`overtype`,`overtime`,`rout`)
VALUES ( '$selectT', NOW( ), '$spddate', '$time1', '$time2', '$t','$spdp1','$spdp2','$lat1','$lon1','$lat2','$lon2','$spdotyp','$spdotime','$tripdir');;"; $objQuery = mysql_query($strSQL);
}
*/?></td>
</tr>
</tbody>
</table>
</form>
<br>
</body></html>