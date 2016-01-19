<?php
error_reporting(0);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>TATANAD GPS Supervisory Program</title>
    <script type="text/javascript">
        var selectT = '';
        function getSelectT(value){
            selectT = value;
        }
        function openAccInt(){
            window.open('f2_accInt_chart.php?selectT='+selectT);
        }
    </script>
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
    <td style="background-color: rgb(255, 255, 153); width: 271px;"><small><span style="font-weight: bold;"><span style="font-style: italic;">&nbsp;&nbsp; Integrate
    Behavior</span>
    &nbsp;Function </span></small><small><?php
            require(dirname(__FILE__)."/../../config.php");
            $selectT = $_REQUEST["selectT"];
    if ( ($selectT=="") OR ($selectT=="Select Test") ) {$selectT="Test21";}


    include ("f2_intTest_function.php");

    echo "$selectT";
    ?>
</small><big style="font-family: Arial;"> </big></td>
<td colspan="1" rowspan="1" style="width: 467px; background-color: rgb(255, 255, 204);"><small></small><small><span style="font-weight: bold;"> Route</span>
:&nbsp;</small><small><?php echo"$route";
?>&nbsp;<span style="font-weight: bold;">&nbsp;Device</span>
: </small><small></small><small><?php echo "$device";?>
&nbsp;<span style="font-weight: bold;">Date</span>
:&nbsp;&nbsp;<?php echo "$dateT[0] - $dateT[$nums_score]";?>
<span style="color: red;"></span></small></td>
<td style="text-align: right; width: 244px;" colspan="1" rowspan="1" valign="undefined"><small><small><span style="font-family: Arial;"></span></small></small>&nbsp;
<select style="width: 100px;" name="selectT" onchange="getSelectT(this.value);"><option> Select Test </option><option> Test21 </option><option> Test20 </option><option> Test18 </option><option> Test2 </option><option> Test3 </option><option> Test1 </option><option> Test17 </option><option> Test4 </option><option> Test5 </option><option> Test6 </option><option> Test7 </option><option> Test8 </option><option> Test8B </option><option> Test9 </option></select>
<input name="Submit" value="Submit" type="submit"> </td>
</tr>
<tr>
<td style="width: 271px; background-color: rgb(204, 255, 255);"><small><small><span style="font-family: Arial;">&nbsp;&nbsp;</span></small></small><small> &#3588;&#3632;&#3649;&#3609;&#3609;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618; &nbsp;<?php $j = $nums_score+1;
echo "<font face='Arial' size='2' color='black'> $total_avg ($j &#3619;&#3629;&#3610;) ";
$score_a = $total_avg ;
if ($score_a<=10) { $GYR = "light0.png";}
elseif ((10<$score_a) AND ($score_a<=20)) { $GYR = "light1.png";}
elseif ((20<$score_a) AND ($score_a<=30)) { $GYR = "light2.png";}
elseif ($score_a>30) { $GYR = "light3.png";}
echo "<img src='$GYR' width='12' height='12'/>";?><span style="font-weight: bold;"></span></small></td>
<td colspan="1" rowspan="1" style="background-color: rgb(204, 255, 255); width: 467px;"><small><small><span style="font-family: Arial;"><big>&nbsp;&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;&#3593;&#3621;&#3637;&#3656;&#3618;&nbsp;</big><?php echo "$d_avg";?>
km , <big>&nbsp;</big></span></small></small><small><small><span style="font-family: Arial;"><big>&#3629;&#3633;&#3605;&#3619;&#3634;&#3648;&#3619;&#3655;&#3623;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;
</big>&nbsp;<?php echo "$v_avg";?></span></small></small><small><small><span style="font-family: Arial;"> &nbsp;km/hr ,&nbsp;</span></small></small><small><span style="font-family: Arial;"><big>&nbsp;</big>&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634;&#3593;&#3621;&#3637;&#3656;&#3618;&nbsp;<?php echo "<font face='Arial' size='1'> $time_d";?></span></small><small><small><span style="font-family: Arial;"> </span></small></small><small><small><span style="font-family: Arial;"></span></small></small><small><span style="font-family: Arial;"><big></big></span></small></td>
<td colspan="1" rowspan="1" style="text-align: right; width: 244px; background-color: white;"><small><small><span style="font-family: Arial;">&nbsp;<?php $ck1="";
$ck2="";
$ck3="";
$ck4="";
if ( $sort1=="date") { $ck1="checke";}
elseif ( $sort1=="Total") { $ck2="checke";}
elseif ( $sort1=="Trip") { $ck3="checke";}
elseif ( $sort1=="Day") { $ck4="checke";}
else { $ck1="checked";}
echo "<font size='2'> <input name='sort' type='radio' value='date'/> Date " ;
echo "<font size='2'> <input name='sort' type='radio' value='Total'/> Total" ;
echo "<font size='2'> <input name='sort' type='radio' value='Trip'/> Trip " ;
echo "<font size='2'> <input name='sort' type='radio' value='Day'/> Day " ;?>&nbsp;</span></small></small><small><small><span style="font-family: Arial;"></span></small></small></td>
</tr>
<tr>
<td style="width: 271px; background-color: white;"><small><small><span style="font-family: Arial;"></span></small></small><small><span style="font-family: Arial;"></span></small></td>
<td colspan="2" rowspan="1" style="text-align: right; width: 467px; background-color: white;"><small><small><span style="font-family: Arial;"></span></small></small>
<small><small><span style="font-family: Arial;">
<!--<input style="width: 120px;" onclick="window.open('f1_speedBehavior.php')" value="Speed Behavior" name="Behavior" type="button">-->&nbsp;</span></small></small><small><small><span style="font-family: Arial;">
<!--<input style="width: 120px;" onclick="window.open('f1_accBehavior.php')" value="Acc Behavior" name="Behavior" type="button">-->
<input style="width: 80px;" onclick="window.open('f1_IntegrateNorm.php')" value="Norm" name="Behavior" type="button">&nbsp;&nbsp;&nbsp;
<input style="width: 90px;" onclick="openAccInt();" value="Acc Behavior" name="Behavior" type="button"></span></small></small></td>
</tr>
</tbody>
</table>
</form>
<table style="text-align: left; margin-left: auto; margin-right: auto; width: 100%; height: 112px;" border="0" cellpadding="2" cellspacing="2">
<tbody>
<tr>
<td style="width: 461px;" colspan="1" rowspan="1" align="undefined" valign="undefined"><?php $Tiger01 = 0; $Lion01 = 0; $Rhnio01=0; $Bull01=0;
echo "<table border='0' width='100%' cellpadding='4' bordercolor='#D8D8D8' >";
echo "<tr bgcolor='#CCFFFF'>";
echo "<td align='center' width='20'> <font size='2'>no.</td>" ;
echo "<td align='center'> date </td>" ;
echo "<td align='center'><font size='2'> <a href='f0_acc_chart.php' target='blank'> Acc </a> </td>" ;
echo "<td align='center'><font size='2'> <a href='f0_speed_chart.php' target='blank'> Speed </a> </td>" ;
echo "<td align='center'><font size='2'> over1 </td>" ;
echo "<td align='center'><font size='2'> over2 </td>" ;
echo "<td align='center'><font size='2'> over3 </td>" ;
echo "<td align='center'><font size='2'> over4 </td>" ; echo "<td align='center'><font size='2'> <a href='f0_turn_chart.php' target='blank'> Turn </a> </td>" ;
echo "<td align='center'><font size='2'> U-Turn </td>" ;
echo "<td align='center'><font size='2'> Spd Zone </td>" ;
/* echo "<td align='center'><font size='2'> Cross </td>" ;
echo "<td align='center'><font size='2'> B Stop </td>" ;
echo "<td align='center'><font size='2'> Train </td>" ;
echo "<td align='center'><font size='2'> N Stop </td>" ;
*/
echo "<td align='center'><font size='2'> S </td>" ;
echo "<td align='center'><font size='2'> A </td>" ;
echo "<td align='center'><font size='2'> T </td>" ;
echo "<td align='center'><font size='2'> z </td>" ;
echo "<td align='center'><font size='2'> <a href='f0_total_chart.php' target='blank'> Total </a> </td>" ;
echo "<td align='center'><font size='2'> Trip </td>" ;
echo "<td align='center'><font size='2'> Day </td>" ;
echo "<td align='center'><font size='2'> Type </td>" ;
echo "<td align='center'><font size='2'> Dist. </td>" ;
echo " </tr>";
/* 16 date selected : 17 Row */
for ($j=0; $j<=$num_score; $j++) {
$index= $j+1;
echo "<tr bgcolor='#82FA58'>";
echo "<td align='center'> <font size='2'> $index </td>";
/* 17 data column : 17 Column */
$datum = explode(":" , $data_score[$j]);
$t0 = explode(".",$datum[14]);
$t1_len = strlen($t0[1]);
if ($t1_len==1) { $t0[1] = $t0[1]."0";}
$totlescore = (int)$t0[0] + (((int)$t0[1])/100);
$totlescore = round($totlescore,3);
if ($totlescore<=10) { $GYR = "light0.png";}
elseif ((10<$totlescore) AND ($totlescore<=20)) { $GYR = "light1.png";}
elseif ((20<$totlescore) AND ($totlescore<=30)) { $GYR = "light2.png";}
elseif ($totlescore>30) { $GYR = "light3.png";}
$ii=$i+2;
if ($datum[$i]=="BKK - NRM") {$bbg = "#F5A9E1"; }
elseif ( ($datum[$i]=="NRM - BKK") OR ($datum[$i]=="A - B") ) {$bbg = "#F3F781"; }
elseif ( ($datum[$i]=="CHM - BKK") ) {$bbg = "#F3F781"; }
elseif ( ($datum[$i]=="BKK - CHM") ) {$bbg = "#FFFF00"; }
elseif ( ($datum[$i]=="MSD - BKK") ) {$bbg = "#A9F5F2"; }
elseif ( ($datum[$i]=="BKK - MSD") ) {$bbg = "#58D3F7"; }
elseif ( ($datum[$i]=="SRT - BKK") ) {$bbg = "#A9F5A9"; }
elseif ( ($datum[$i]=="BKK - SRT") ) {$bbg = "#58FA58"; }
elseif ( ($datum[$i]=="UnKnow") ) {$bbg = "#FFCCFF"; }
else { $bbg = "#CCFFFF"; }
$A = $datum[1];
$S = ($datum[3]/0.2) + ($datum[4]/0.4) + ($datum[5]/0.6) + ($datum[6]/0.8) ;
$T = $datum[7] + $datum[8];
$Z = $datum[9] + $datum[10] + $datum[11] + $datum[12]+ $datum[13];
$Ak = round(($A),4);
$Sk = round(($S),4);
$Tk = round(($T),4);
$Zk = round(($z),4);
$S_sum = $S_sum + $S;
$A_sum = $A_sum + $A;
$T_sum = $T_sum + $T;
$Z_sum = $Z_sum + $Z;
$Dtype="d2.png";
if (($selectT=="Test18") OR ($selectT=="Test1")) {
if (($Sk<=4) AND ($Ak<=1) AND ($Tk<=1) ) {$Dtype = "T2_lion.png"; $Lion01 = $Lion01+1;} elseif (($Sk>=4) AND ($Ak>=1) AND ($Tk>=2) ) {$Dtype = "rhino.jpg"; $Rhnio01 = $Rhnio01+1;}
elseif (($Sk>=1) AND ($Ak>=7) AND ($Tk>=1) ) {$Dtype = "bull01.jpg"; $Bull01 = $Bull01+1;}
elseif ((($Sk>=3) AND ($Tk>=1)) OR ($Sk>=6) ) {$Dtype = "tiger01.jpg"; $Tiger01 = $Tiger01+1;}
}
else {
if (($S<=25) AND ($A<=3) AND ($T<=6) AND ($Z<41) ) {$Dtype = "T2_lion.png"; $Lion01 = $Lion01+1;} elseif (($S>=20) AND ($A>=3) AND ($T>=8) AND ($Z>=35)) {$Dtype = "rhino.jpg"; $Rhnio01 = $Rhnio01+1;}
elseif (($S>=14) AND ($A>=4) AND ($T>=4) AND ($Z<37) ) {$Dtype = "bull01.jpg"; $Bull01 = $Bull01+1;}
elseif ((($S>=14) AND ($T>=4)) OR ($S>=30) ) {$Dtype = "tiger01.jpg"; $Tiger01 = $Tiger01+1;}
}
for ($i=0; $i<=21; $i++) { /* Number of Column */ if (($i>=0) AND ($i<=9)) { echo " <td align='center' > <font size='2'> $datum[$i] </td> "; }
elseif ($i==10) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> $S </td> "; }
elseif ($i==11) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> $A </td> "; }
elseif ($i==12) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> $T </td> "; }
elseif ($i==13) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> $Z </td> "; }
elseif ($i==14) { echo " <td align='left' bgcolor='white'> <font size='2'> <img src='$GYR' width='15' height='15'/> $totlescore </td> ";}
elseif ($i==15) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> $datum[$i] </td>" ; }
elseif ($i==16) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> <img src='$datum[$i]' width='18' height='18'/> </td>" ; }
elseif ($i==17) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> <img src='$Dtype' width='18' height='18'/> </td>" ; }
elseif ($i==21) { echo " <td align='center' bgcolor='$bbg'> <font size='1'> $dist[$j] </td>" ; }
}
$sum_acc = $datum[1]+$sum_acc;
$sum_speed = $datum[2]+$sum_speed;
$sum_turn = $T+$sum_turn;
$sum_zone = $Z+$sum_zone;
$sumTU = $datum[7]+$sumTU; /* sum turn Score */
$sumTU2 = $datum[8]+$sumTU2; /* sum turn Score */
$z1 = $datum[8] + $z1; /* Speed Zone Score */
$z2 = $datum[9] + $z2; /* Cross score*/
$z3 = $datum[10]+ $z3; /* Bus Stop score*/
$z4 = $datum[11]+ $z4; /* Train score*/
$z5 = $datum[12]+ $z5; /* Nostop score*/
echo " </tr> ";
$totalSum = $totalSum + $totlescore;
}
echo "<tr>";
if ($num_score!=0) {
$S2 = round(($S_sum/($num_score+1)),2);
$A2 = round(($A_sum/($num_score+1)),2);
$T2 = round(($T_sum/($num_score+1)),2);
$Z2 = round(($Z_sum/($num_score+1)),2);
$totalSum = round(($totalSum/($num_score+1)),2);
$accSum = round(($sum_acc/($num_score+1)),2);
$speedSum = round(($sum_speed/($num_score+1)),2);
$turnSum = round(($sum_turn/($num_score+1)),2);
$turnTSum = round(($sumTU/($num_score+1)),2);
$turnT2Sum = round(($sumTU2/($num_score+1)),2);
$zoneSum = round(($sum_zone/($num_score+1)),2);
}
else {$totalSum = 0; $speedSum =0; $accSum =0; $turnSum =0;}
$sum_z = $z1+$z2+$z3+$z4+$z5;
for ($i=0; $i<=19; $i++) {
if ($i==1) { echo "<td align='center'> <font size='2'> Total </td>"; }
elseif ($i==2) { echo "<td align='center'> <font size='2'> $accSum </td>"; } /* Acc Score */
elseif ($i==3) { echo "<td align='center'> <font size='2'> $speedSum </td>"; }
elseif ($i==4) { echo "<td align='center'> <font size='2'> - </td>"; }
elseif ($i==5) { echo "<td align='center'> <font size='2'> - </td>"; }
elseif ($i==6) { echo "<td align='center'> <font size='2'> - </td>"; }
elseif ($i==7) { echo "<td align='center'> <font size='2'> - </td>"; }
elseif ($i==8) { echo "<td align='center'> <font size='2'> $turnTSum </td>"; } /* Over Speed Zone Score */
elseif ($i==9) { echo "<td align='center'> <font size='2'> $turnT2Sum </td>"; }
elseif ($i==10) { echo "<td align='center'> <font size='2'> $zoneSum </td>"; } /* Cross score */
elseif ($i==11) { echo "<td align='center'> <font size='2'> $S2 </td>"; } /* Bus Stop score */
elseif ($i==12) { echo "<td align='center'> <font size='2'> $A2 </td>"; } /* Train score */
elseif ($i==13) { echo "<td align='center'> <font size='2'> $T2 </td>"; } /* Nostop score */
elseif ($i==14) { echo "<td align='center'> <font size='2'> $Z2 </td>"; } /* Nostop score */
elseif ($i==15) { echo "<td align='center'> <font size='2'> $totalSum ($gogo) </td>"; } /* Nostop score */
elseif ($i==19) { echo "<td align='center'> <font size='2'> $dist1 </td>"; } /* Nostop score */
else { echo "<td align='center'> <font size='2'> -- </td>";}
}
echo "</tr>"; echo "<tr bgcolor='#CCFFFF'>";
for ($i=0; $i<=19; $i++) { if ($i==2) { echo "<td align='center'> <font size='2'> $acc_max </td>"; } elseif ($i==3) { echo "<td align='center'> <font size='2'> $speed_max </td>"; } elseif ($i==13) { echo "<td align='center'> <font size='2'> $turn_max </td>"; } elseif ($i==14) { echo "<td align='center'> <font size='2'> $zone_max </td>"; } elseif ($i==15) { echo "<td align='center'> <font size='2'> $score_max </td>"; } else { echo "<td> $i </td>"; }
}
echo "</tr>";
echo "</table> ";?></td>
</tr>
<tr>
<td colspan="1" rowspan="1"><?php $other01 = ($nums_score+1) - $Tiger01 - $Lion01 - $Bull01 - $Rihnio01;
include ("f2_graph_type.php");?></td>
</tr>
<tr>
<td style="width: 461px; height: 27px;" colspan="1" rowspan="1" align="undefined" valign="undefined">
<hr style="width: 100%; height: 2px;"></td>
</tr>
</tbody>
</table>
<br>
<br>
</body></html>