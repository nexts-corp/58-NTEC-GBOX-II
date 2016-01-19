<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>TATANAD GPS Supervisory Program</title><?php function DMStoDECLn($pos)
    {
        $long_shift = $pos / 100;
        $lon_deg = floor($long_shift);
        $lon_lipda = floor(($long_shift - $lon_deg) * 100);
        $lon_phil = ((($long_shift - $lon_deg) * 100) - $lon_lipda) * 60;
        return $lon_deg + ((($lon_lipda * 60) + ($lon_phil)) / 3600);
    }

    function DECtoDMSLn($dec)
    {
        $vars = explode(".", $dec);
        $DD = $vars[0] * 100;
        $dddd = $vars[1] * 60 / 10000;
        return round(($DD + $dddd), 8);
    }

    function distank($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371;
        $dLat = ($lat2 - $lat1);
        $dLon = ($lon2 - $lon1);
        $a = sin(deg2rad($dLat / 2)) * sin(deg2rad($dLat / 2)) + sin(deg2rad($dLon / 2)) * sin(deg2rad($dLon / 2)) * cos(deg2rad($lat1)) * cos(deg2rad($lat2));
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c;
        return round($d, 5);
    } ?></head>
<body onload="initialize()" onunload="GUnload()">
<table style="width: 800px; height: 17px; text-align: left; margin-left: auto; margin-right: auto;">
    <tbody>
    <tr>
        <td style="vertical-align: middle; text-align: center; height: 13px; background-color: rgb(51, 153, 204); width: 176px;">
            <font weight="BOLD" color="white" face="tahoma" size="2"> <b>Driving
                    Score 2.0 beta </b> </font></td>
        <td style="height: 13px; width: 86px;"><a href="www.nectec.or.th"><img
                    style="border: 0px solid ; width: 100px; height: 22px;" alt="" src="nectec.png"></a></td>
        <td style="background-color: rgb(51, 153, 204); text-align: left; height: 13px; width: 100px;">
            <small><span style="font-family: Arial;"><span style="text-decoration: underline;"></span></span></small>
            &nbsp;
            <a style="color: white;" target="_blank" href="www.thairoadsafety.net">
                <small style="font-family: Arial; font-weight: bold;">WebSite</small>
            </a></td>
        <td style="text-align: right; background-color: rgb(51, 153, 204); color: white; font-weight: bold; font-family: Arial; height: 13px; width: 396px;">
            <small>
                <a style="color: white;" href="f0_routRisk.php" target="_top">Rout Risk
                </a>&nbsp; &nbsp;</small>
            <small><a style="color: white;" href="f1_integrate.php" target="_blank">Integrate
                </a></small>
            <small> &nbsp;
                &nbsp;</small>
            <small>&nbsp;</small>
            <small><a href="f1_speedBehavior.php" style="color: white;" target="_blank">Speed</a></small>
            <small>
                &nbsp; &nbsp;</small>
            <small><a href="f1_accBehavior.php" style="color: white;" target="_blank">Acceleration</a></small>
            <small>
                &nbsp;
                Turn &nbsp; </small>
            <small><a style="color: white;" href="f0_Style.php" target="_top">Style</a></small>
            <small>
                &nbsp;</small>
        </td>
    </tr>
    </tbody>
</table>
<form style="height: 690px;" action="f1_main.php" method="post">
    <table
        style="background-color: white; width: 800px; height: 64px; text-align: left; margin-left: auto; margin-right: auto;"
        border="0" cellpadding="2" cellspacing="2">
        <tbody>
        <tr>
            <td style="background-color: rgb(255, 204, 255); width: 170px;" colspan="3" rowspan="1">
                <small><span style="font-weight: bold;"></span></small>
                <small><span style="font-weight: bold;"></span></small>
                <small><span style="font-weight: bold;"></span></small>
                <small>
                </small>
                <small><span style="font-weight: bold;"> <span style="font-style: italic;"></span></span></small>
                <small>

                </small>
                <small><span style="font-weight: bold;"><span style="font-style: italic;"> &nbsp;</span></span></small>
                <small><span style="font-weight: bold;"><?php include("f2_getdata.php"); ?>
                        </span></small>
                <small><span style="font-weight: bold;"><span
                            style="font-style: italic; color: red;">Style Report</span><span style="color: red;">
&nbsp;Function</span>&nbsp;</span></small>
                <small style="font-family: Arial;">



                                <?php if ($deltaT != 0) {

                                        $speed_avg2 = ($dis_sum / $deltaT) * (3600 / 1000);
                                    }

                                    if ($num_rows < 0) {
                                        $n = 0;
                                    } else {
                                        $n = $num_rows;
                                    }

                                    echo "<font face='Arial' size='1' color='red'> ($n)";

                                    ?>
                </small>
            </td>
            <td style="text-align: left; width: 126px;" rowspan="1" colspan="3">
                <small><span style="font-weight: bold;"><?php $tnum = str_split($selectT, 4);
                        $number = $tnum[1];


                        $strSubmit = "SELECT DISTINCT * FROM  `selecttest` WHERE  `route` = '$tripdir' AND  `date`='$Date1' AND  `time1` =  '$Time1' "; /*The Last time stamp*/
                        $objSubmit1 = mysql_query($strSubmit) or die ("Error Query [" . $strSubmit . "]");
                        $submit = mysql_fetch_array($objSubmit1);

                        $DName = $submit["name"];
                        ?>Name</span>
                    :&nbsp;</small>
                <small>
                    <?php echo "$DName"; ?>
                    &nbsp;<span style="font-weight: bold;"></span></small>
                <small>&nbsp;
                    <span style="font-weight: bold;">Date</span>
                    :
                    &nbsp;
                    <small style="color: black;"><?php $dd = explode("-", $Date1);
                        $ddf = array($dd[2], $dd[1], $dd[0]);
                        $ddg = implode('-', $ddf);

                        echo "$Date1";

                        $DateBegin = $Date1; ?></small>
                    &nbsp;<span style="font-weight: bold;">Time&nbsp;</span>
                    <small>
                        <?php echo "$TimeBegin - $TimeEnd"; ?>
                    </small>
                </small>
                <small>&nbsp;</small>
                &nbsp;
                <small>
                    <small>

                    </small>
                </small>
                <small><span style="font-family: Arial;"></span></small>
            </td>
        </tr>
        <tr>
            <td style="background-color: rgb(102, 204, 204); text-align: center; width: 47px;" colspan="1" rowspan="2">
                <small>
                    <small><span style="font-family: Arial;"><input style="width: 60px; height: 40px;"
                                                                    onclick="window.open('f1_IntegrateSum.php')"
                                                                    value="Norm" name="Behavior" type="button"></span>
                    </small>
                </small>
            </td>
            <td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(102, 204, 204); width: 98px;">
                <small style="font-weight: bold;">
                    <small><span style="font-family: Arial;"><big><span style="color: white;"></span></big></span>
                    </small>
                </small>
                <small style="font-weight: bold;">
                    <small><span style="font-family: Arial;"><big><span style="color: white;"></span>
                                <small>&#3648;&#3626;&#3657;&#3609;&#3607;&#3634;&#3591;</small>
                                <br>
                                &nbsp;<?php echo "<font face='Arial' size='2'> <font face='Arial' size='2' color='black'>$tripdir </font> ";
                                ?>
                            </big></span></small>
                </small>
                <small style="font-weight: bold;">
                    <small><span style="font-family: Arial;"></span>
                    </small>
                </small>
            </td>
            <td colspan="1" rowspan="1" style="background-color: rgb(102, 204, 204); text-align: left; width: 170px;">
                <small>
                    <small><span style="font-family: Arial;">&nbsp;<span style="font-weight: bold;">&nbsp;</span><span
                                style="color: white; font-weight: bold;">&#3588;&#3632;&#3649;&#3609;&#3609;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;&#3651;&#3609;&#3648;&#3626;&#3657;&#3609;&#3607;&#3634;&#3591;</span></span>
                    </small>
                </small><span style="color: white;">
</span>
                <small style="color: white;">
                    <small><span style="font-family: Arial;"><?php echo "<font face='Arial' size='1' color='white'> $score_SA"; ?></span>
                    </small>
                </small>
                <small>
                    <small><span style="font-family: Arial;"></span></small>
                </small>
            </td>
            <td style="text-align: center; background-color: rgb(102, 204, 204); color: white; font-weight: bold; width: 126px;">
                <small>
                    <small><span style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</span><span
                            style="font-family: Arial;"></span></small>
                </small>
                <?php echo "<font face='Arial' size='1'> $dis_norm_i km "; ?></td>
            <td style="text-align: center; background-color: rgb(102, 204, 204); color: white; font-weight: bold; width: 145px;">
                <small style="font-family: Arial;">
                    <small>&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</small>
                </small>
                <?php echo "<font face='Arial' size='1'> $spd_a km/hr "; ?></td>
            <td colspan="1" rowspan="1"
                style="text-align: center; background-color: rgb(102, 204, 204); width: 164px; color: white; font-weight: bold;">
                &nbsp;
                <small>
                    <small>&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;
                        &nbsp;<?php $deltaT2 = round($time_d, 0);
                        $hour_trip1 = floor($deltaT2 / 3600);
                        $min_trip1 = ((floor($deltaT2 / 60)) - ($hour_trip1 * 60));

                        if ($deltaT2 < 60) {
                            $sec_trip1 = $deltaT2;
                        } elseif ((60 <= $deltaT2) AND ($deltaT2 < 3600)) {
                            $sec_trip1 = ($deltaT2 - ($min_trip1 * 60));
                        } elseif ($deltaT2 >= 3600) {
                            $sec_trip1 = ($deltaT2 - ($min_trip1 * 60) - ($hour_trip1 * 3600));
                        }

                        $time = "$hour_trip1 hr $min_trip1 m $sec_trip1 s";

                        echo "<font face='Arial' size='1'> $time "; ?>

                    </small>
                </small>
                <small>
                    <small><span style="font-family: Arial;"></span></small>
                </small>
            </td>
        </tr>
        <tr>
            <td style="background-color: rgb(204, 255, 255); text-align: right; width: 170px;">
                <small>
                    <small style="font-weight: bold; color: black;">&nbsp;&#3612;&#3621;&#3585;&#3634;&#3619;&#3586;&#3633;&#3610;&#3586;&#3637;&#3656;
                        <img style="width: 15px; height: 15px;" alt="" src="ar.png">&nbsp; </small>
                </small>
            </td>
            <td style="text-align: center; background-color: rgb(204, 255, 255); width: 126px;">
                <small>
                    <small><span
                            style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3607;&#3634;&#3591;</span><span
                            style="font-family: Arial;">&nbsp;<?php $dis_sum_km = round((abs($dis_sum) / 1000), 2);

                            echo "<font face='Arial' size='1'> $dis_sum_km"; ?>&nbsp;
km &nbsp;</span></small>
                </small>
            </td>
            <td style="text-align: center; background-color: rgb(204, 255, 255); width: 145px;">
                <small>
                    <small><span style="font-family: Arial;">&#3588;&#3623;&#3634;&#3617;&#3648;&#3619;&#3655;&#3623;&#3648;&#3648;&#3593;&#3621;&#3637;&#3656;&#3618;</span><span
                            style="font-family: Arial;">&nbsp;</span></small>
                </small><?php if ($deltaT != 0) {
                    $speed_avg3 = round((3600 * ($dis_sum_km + 1) / $deltaT), 2);
                } else {
                    $speed_avg3 = 0;
                }

                echo "<font face='Arial' size='1'> $speed_avg3 km/hr"; ?></td>
            <td colspan="1" rowspan="1" style="text-align: center; width: 164px; background-color: rgb(204, 255, 255);">
                <small>
                    <small><span
                            style="font-family: Arial;">&#3619;&#3632;&#3618;&#3632;&#3648;&#3623;&#3621;&#3634;</span><span
                            style="font-family: Arial;"> &nbsp;</span></small>
                </small><?php echo "<font face='Arial' size='1'> $hour_trip hr $min_trip min $sec_trip sec"; ?></td>
        </tr>
        <tr>
            <td><?php include("f2_acc_function.php"); ?></td>
            <td><?php include("f2_speed_function.php"); ?></td>
            <td><?php include("f2_turn_function.php"); ?></td>
            <td><?php include("f2_zone_function.php"); ?></td>
            <td><?php include("f2_style_function.php"); ?></td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <table style="width: 800px; height: 13px; text-align: left; margin-left: auto; margin-right: auto;" border="0"
           cellpadding="2" cellspacing="2">
        <tbody>
        <tr>
            <td colspan="1" rowspan="2" style="text-align: right; vertical-align: middle; width: 300px;">
                <?php include("f0_style_gauge.php");
                ?><br>
            </td>
        </tr>
        <tr align="right">
            <td style="vertical-align: middle; text-align: left; width: 650px;">
                <table style="text-align: left; width: 545px; height: 99px;" border="0" cellpadding="2" cellspacing="2">
                    <tbody>
                    <tr>
                        <td style="text-align: center; background-color: rgb(0, 191, 255);"><?php echo "<font face='Arial' size='2' color = 'black'> &#3626;&#3623;&#3633;&#3626;&#3604;&#3637;&#3588;&#3619;&#3633;&#3610;
<font face='Arial' size='2' color = '#F2F2F2'> <b> $DName </b> </font> 

&#3623;&#3633;&#3609;&#3609;&#3637;&#3657;&#3588;&#3640;&#3603;&#3586;&#3633;&#3610;&#3619;&#3606;&#3652;&#3604;&#3657;<font face='Arial' size='2' color = '#F2F2F2'> <b>   $zero_cm  </b> </font>   <br>";


                            echo "  $zero_bm "; ?></td>
                        <td style="text-align: center;" colspan="1" rowspan="2"><?php if ($total_scr < 40) {
                                $score1_i = 3;
                                $emo = "3star.jpg";
                            } elseif (($total_scr >= 40) AND ($total_scr < 60)) {
                                $score1_i = 2;
                                $emo = "2star.jpg";
                            } elseif (($total_scr >= 60) AND ($total_scr < 80)) {
                                $score1_i = 1;
                                $emo = "1star.jpg";
                            } elseif ($total_scr >= 80) {
                                $score1_i = 0;
                                $emo = "0star.jpg";
                            }

                            echo " <img src='$emo'/>"; ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; background-color: rgb(169, 226, 243);"><?php echo " <font face='Arial' size='3' color='red'> $firt_cm1";
                            ?><br><?php echo " <font face='Arial' size='3' color='red'> $firt_cm2 "; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="1"
                            style="text-align: left;"><?php echo " <br> &#3586;&#3657;&#3629;&#3649;&#3609;&#3632;&#3609;&#3635;&#3629;&#3639;&#3656;&#3609; <br>";
                            echo " <font face='Arial' size='2' color='black'> $second_cm1";
                            ?> &nbsp;<?php echo " <font face='Arial' size='2' color='black'> $second_cm2 "; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="1"
                            style="text-align: left;"><?php echo " <font face='Arial' size='2' color='black'> $third_cm1";
                            ?> &nbsp;<?php echo " <font face='Arial' size='2' color='black'> $third_cm2 ";
                            ?></td>
                    </tr>


                    </tbody>
                </table>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td style="height: 25px; width: 443px;" colspan="2" rowspan="1">
                <hr style="width: 100%; height: 2px;">
            </td>
        </tr>
        </tbody>
    </table>
    <table style="text-align: left; margin-left: auto; margin-right: auto;">
        <tbody>
        <tr>
            <td> <?php $db = mysql_connect("localhost", "tatanad", "tata789") or die("Error Connect to Database");
                $objDB = mysql_select_db("thairoadsafety");

                $exe1 = "SELECT  `test` , `name` , `route` , `date` , `time1` , `time2` ,`splevel` , `sptype` , `acclevel` , `acctype` ,  `turnlevel` ,  `turntype` ,  `total` ,  `distance`,  `v_score` ,  `a_score` ,  `t_score`,  `danger` FROM  `drivername` WHERE  `name` LIKE  '$DName' ORDER BY  `total` ASC";

                $result1 = mysql_query($exe1) or die(mysql_error());
                $num_rows = mysql_numrows($result1);

                for ($i = 1; $i <= $num_rows; $i++) {

                    list($test, $name, $route, $date, $time1, $time2, $splevel, $sptype, $acclevel, $acctype, $turnlevel, $turntype, $total, $distance, $vscore, $ascore, $tscore, $danger1) = mysql_fetch_row($result1);

                    $time_s = explode(":", $time1);
                    $sec1 = ((($time_s[0]) * 3600) + (($time_s[1]) * 60) + ($time_s[2]));

                    $time_s = explode(":", $time2);
                    $sec2 = ((($time_s[0]) * 3600) + (($time_s[1]) * 60) + ($time_s[2]));

                    $deltaT = $sec2 - $sec1;
                    $hour_trip = floor($deltaT / 3600);
                    $min_trip = ((floor($deltaT / 60)) - ($hour_trip * 60));
                    if ($deltaT < 60) {
                        $sec_trip = $deltaT;
                    } elseif ((60 <= $deltaT) AND ($deltaT < 3600)) {
                        $sec_trip = ($deltaT - ($min_trip * 60));
                    } elseif ($deltaT >= 3600) {
                        $sec_trip = ($deltaT - ($min_trip * 60) - ($hour_trip * 3600));
                    }

                    $durat_i[$i] = "$hour_trip:$min_trip:$sec_trip";


                    $date_i[$i] = $date;
                    $time1_i[$i] = $time1;
                    $time2_i[$i] = $time2;
                    $v_i[$i] = $vscore;
                    $a_i[$i] = $ascore;
                    $t_i[$i] = $tscore;

                    $route_i[$i] = $route;
                    $total_i[$i] = $total;
                    $dis_i[$i] = $distance;

                    $dan_i[$i] = $danger1;

                } ?> </td>
            <td>&nbsp; &nbsp; &nbsp;<?php echo "<table width='880' border='0'>";
                echo " <tr bgcolor='#3399CC'> <td> </td>
<td colspan=11> <font size='2' color='white'> Driver $DName : Route $tripdir ($num_rows) </td> ";
                echo " </tr> ";

                echo " <tr bgcolor='#58FA58'>
<td align='center'> <font size='2' color='black'> index </td> 
<td align='center'> <font size='2' color='black'> date </td> 
<td align='center'> <font size='2' color='black'> time </td> 
<td align='center'> <font size='2' color='black'> route </td> 

<td align='center'> <font size='2' color='black'> distance </td>
<td align='center'> <font size='2' color='black'> duration </td>
<td align='center'> <font size='2' color='black'> speed </td>
<td align='center'> <font size='2' color='black'> acc </td>
<td align='center'> <font size='2' color='black'> turn </td>
<td align='center'> <font size='2' color='black'> total </td>
<td align='center' colspan=2> <font size='2' color='black'> suggest</td>

</tr> ";

                for ($j = 1; $j <= $num_rows; $j++) {

                    $da = explode(":", $dan_i[$j]);
                    $dang1 = $da[0];
                    $dang2 = $da[1];

                    echo " <td align='center'> <font size='2' color='black'> $j </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $date_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $time1_i[$j] -  $time2_i[$j] </td> ";

                    echo " <td align='center'> <font size='2' color='black'> $route_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $dis_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $durat_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $v_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $a_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $t_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $total_i[$j] </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $dang1 </td> ";
                    echo " <td align='center'> <font size='2' color='black'> $dang2 </td> ";

                    echo "</tr>";

                    $j = $j + 1;
                    if ($j <= $num_rows) {
                        $da = explode(":", $dan_i[$j]);
                        $dang1 = $da[0];
                        $dang2 = $da[1];
                        echo " <tr bgcolor='#F3F781'>";
                        echo " <td align='center'> <font size='2' color='black'> $j </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $date_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $time1_i[$j] -  $time2_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $route_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $dis_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $durat_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $v_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $a_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $t_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $total_i[$j] </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $dang1 </td> ";
                        echo " <td align='center'> <font size='2' color='black'> $dang2 </td> ";
                        echo "</tr>";
                    }
                }
                echo "</table>"; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        </tr>
        </tbody>
    </table>
    <br>
</form>
</body>
</html>