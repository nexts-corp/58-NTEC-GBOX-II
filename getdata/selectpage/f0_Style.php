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
    <form style="height: 690px;" action="f1_main.php" method="post">
        <table style="background-color: white; width: 100%; height: 64px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr style="font-size: small; font-family: Arial;">
                    <td style="background-color: rgb(255, 204, 255);" colspan="3" rowspan="1">
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
                        <span>
                            <span style="font-weight: bold; font-style: italic; color: red;">Style Report Function </span>
                            <span>
                                <?php
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
                    <td style="text-align: left;" rowspan="1" colspan="3">
                        <span>
                            <?php
                            //$DName = $deviceName;
                            //$selectT = "Test21";
                            //if ($selectT=="Test21") {

                            $link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
                            mysql_select_db(DB_NAME,$link);
                            mysql_query("SET NAMES 'utf8'");
                            mysql_query("SET NAMES 'utf8'");

                            $strSubmit = "SELECT DISTINCT * FROM  `selecttest` WHERE  `route` = '$tripdir' AND  `date`='$Date1' AND  `time1` =  '$Time1' " ; /*The Last time stamp*/
                            $objSubmit1 = mysql_query($strSubmit) or die ("Error Query [".$strSubmit."]");
                            $submit = mysql_fetch_array($objSubmit1);

                            $DName = $submit["name"];
                            $tripdir = $submit["route"];
                            //}
                            ?>
                            <span style="font-weight: bold;">Name : </span>
                            <span>
                                <?php
                                echo"$DName";
                                ?>
                            </span>
                        </span>
                        <span>
                            <span style="font-weight: bold;">Date : </span>
                            <span>
                                <?php
                                /*$dd = explode("/",$Date1);
                                $ddf = array($dd[0],$dd[1],$dd[2]);
                                $ddg = implode('-',$ddf);*/
                                echo "$Date1";
                                $DateBegin=$Date1;
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
                        <input style="width: 60px; height: 40px;" onclick="window.open('f1_IntegrateNorm.php')" value="Norm" name="Behavior" type="button">
                    </td>
                    <td colspan="1" rowspan="2" style="text-align: center; background-color: rgb(102, 204, 204); width: 20%; font-size: small;">
                        <span>
                            <span style="font-weight: bold;">เส้นทาง</span><br>
                            <span style="font-weight: bold;">
                                <?php
                                echo "$tripdir";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: left; width: 20%; color: white;">
                        <span>
                            <span style="font-weight: bold;">คะแนนเฉลี่ยในเส้นทาง</span>
                            <span>
                                <?php
                                echo "$score_SA";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; color: white; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">ระยะทางเฉลี่ย</span>
                            <span>
                                <?php
                                echo "$dis_norm_i km";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; color: white; width: 17%;">
                        <span>
                            <span style="font-weight: bold;">ความเร็วเฉลี่ย</span>
                            <span>
                                <?php
                                echo "$spd_a km/hr";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; width: 17%; color: white;">
                        <span>
                            <span style="font-weight: bold;">ระยะเวลาเฉลี่ย</span>
                            <span>
                                <?php
                                $deltaT = round($time_d,0);
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
                                echo " $time ";
                                ?>
                            </span>
                        </span>
                    </td>
                </tr>
                <tr style="font-family: Arial; font-size: x-small; background-color: rgb(204, 255, 255);">
                    <td style="text-align: right; width: 20%; color: black;">
                        <span>
                            <span style="font-weight: bold;">ผลการขับขี่</span>
                            <img style="width: 15px; height: 15px; vertical-align: middle;" alt="" src="ar.png">
                        </span>
                    </td>
                    <td style="text-align: center; width: 16%;">
                        <span>
                            <span style="font-weight: bold;">ระยะทาง</span>
                            <span>
                                <?php
                                $dis_sum_km = round((abs($dis_sum)/1000),2);
                                echo "$dis_sum_km km";
                                ?>
                            </span>
                        </span>
                    </td>
                    <td style="text-align: center; width: 17%;">
                        <span>
                            <span style="font-weight: bold;">ความเร็วเเฉลี่ย</span>
                            <span>
                                <?php
                                if ($deltaT!=0) {
                                    $speed_avg3 = round((3600*$dis_sum_km/$deltaT),2);
                                }
                                else {
                                    $speed_avg3 = 0;
                                }
                                echo "$speed_avg3 km/hr";
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
                <tr>
                    <td>
                        <?php
                        include ("f2_acc_function.php");
                        ?>
                    </td>
                    <td>
                        <?php
                        include ("f2_speed_function.php");
                        ?>
                    </td>
                    <td>
                        <?php
                        include ("f2_turn_function.php");
                        ?>
                    </td>
                    <td>
                        <?php
                        include ("f2_zone_function.php");
                        ?>
                    </td>
                    <td>
                        <?php
                        include ("f2_style_function.php");
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width: 90%; height: 13px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="vertical-align: middle; width: 35%;">
                        <?php
                        include ("f0_style_gauge.php");
                        ?>
                    </td>
                    <td style="vertical-align: middle; text-align: left; width: 65%;">
                        <table style="text-align: left; width: 100%; height: 226px;" border="0" cellpadding="2" cellspacing="2">
                            <tbody>
                                <tr>
                                    <td style="background-color: rgb(255, 255, 204); text-align: center;">
                                        <span>โปรดเพิ่มความระมัดระวัง</span>
                                        <span style="color: blue">
                                            <?php
                                            echo "$sp";
                                            ?>
                                        </span><br>
                                        <span>ในการใช้ความเร็วขณะ<span>
                                        <span style="color: blue">
                                            <?php
                                            echo "$typ";
                                            ?>
                                        </span>
                                    </td>
                                    <td style="text-align: center;" colspan="1" rowspan="4">
                                        <?php
                                        if ($total_scr<40) {
                                            $score1_i = 3;
                                            $emo = "3star.jpg";
                                        }
                                        elseif (($total_scr>=40) AND ($total_scr<60)) {
                                            $score1_i = 2;
                                            $emo = "2star.jpg";
                                        }
                                        elseif (($total_scr>=60) AND ($total_scr<80)) {
                                            $score1_i = 1;
                                            $emo = "1star.jpg";
                                        }
                                        elseif ($total_scr>=80) {
                                            $score1_i = 0;
                                            $emo = "0star.jpg";
                                        }
                                        echo " <img src='$emo'/>";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr align="center">
                                    <td style="background-color: rgb(255, 255, 204);">
                                        <span>โปรดเพิ่มความระมัดระวัง</span>
                                        <span style="color: blue">
                                            <?php
                                            echo "$acp";
                                            ?>
                                        </span><br>
                                        <span>เมื่อใช้อัตราเร่งในขณะ</span>
                                        <span style="color: blue">
                                            <?php
                                            echo "$ac";
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                                <tr align="center">
                                    <td style="background-color: rgb(255, 255, 204);">
                                        <span>โปรดเพิ่มความระมัดระวัง</span>
                                        <span style="color: blue;">
                                            <?php
                                            echo "$tp";
                                            ?>
                                        </span><br>
                                        <span>การเลี้ยวในขณะ</span>
                                        <span style="color: blue">
                                            <?php
                                            echo "$tnp";
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
        <hr style="width: 100%; height: 2px;">
        <table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;">
            <tbody>
                <tr>
                    <td>
                        <?php
                        $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
                        $objDB = mysql_select_db(DB_NAME);

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
                        echo "</table>";
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>