<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>New Document</title>
</head>
<body>

    <?php
    $deviceid = $_GET["deviceid"];
    $date1 = $_GET["date1"];
    $time1 = $_GET["time1"];
    $time2 = $_GET["time2"];

    $link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    mysql_select_db(DB_NAME,$link);
    mysql_query("SET NAMES 'utf8'");

    $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
    $res_user = mysql_query($sql_user, $link);
    $data_user = mysql_fetch_array($res_user);

    $selectT = $data_user["firstname"]." ".$data_user["lastname"];
    
    $sql_dev = "SELECT * FROM device WHERE id='".$_GET["deviceid"]."'";
    $res_dev = mysql_query($sql_dev, $link);
    $data_dev = mysql_fetch_array($res_dev);

    $deviceName = $data_dev["device_desc"];
    if($data_dev["device_type_id"] == "1"){ //GBox
        $unix_time1 = mktime(substr($time1, 0, 2), substr($time1, 3, 2), 0, substr($date1, 5, 2), substr($date1, 8, 2), substr($date1, 0, 4)) - date("Z");
        $unix_time2 = mktime(substr($time2, 0, 2), substr($time2, 3, 2), 0, substr($date1, 5, 2), substr($date1, 8, 2), substr($date1, 0, 4)) - date("Z");

        $spd_unit=1.825; $acc_limit=1.5;

        $sql = "SELECT * FROM data WHERE deviceid='".$deviceid."' AND time>='".$unix_time1."' AND time<='".$unix_time2."' ORDER BY time ASC";
    }
    else if($data_dev["device_type_id"] == "2"){ //DG200
        $Datetime = date("Y-m-d", mktime(0, 0, 0, substr($date1, 5, 2), substr($date1, 8, 2), substr($date1, 0, 4)));

        $spd_unit=1;     $acc_limit=2;

        $sql = "SELECT * FROM datadg200 WHERE deviceid='".$deviceid."' AND date='".$Datetime."' AND time>='".$time1."' AND time<='".$time2."' ORDER BY time ASC";
    }
    else if($data_dev["device_type_id"] == "3"){ //DLT
        $Datetime = date("Y-m-d", mktime(0, 0, 0, substr($date1, 5, 2), substr($date1, 8, 2), substr($date1, 0, 4)));

        $spd_unit=1;     $acc_limit=2;

        $sql = "SELECT * FROM datadlt01 WHERE deviceid='".$deviceid."' AND date='".$Datetime."' AND time>='".$time1."' AND time<='".$time2."' ORDER BY time ASC";
    }
    else if($data_dev["device_type_id"] == "4"){ //RV3D
        $Datetime = date("Y-m-d", mktime(0, 0, 0, substr($date1, 5, 2), substr($date1, 8, 2), substr($date1, 0, 4)));

        $spd_unit=1;     $acc_limit=2;

        $sql = "SELECT * FROM datarv3d WHERE deviceid='".$deviceid."' AND date='".$Datetime."' AND time>='".$time1."' AND time<='".$time2."' ORDER BY time ASC";
    }
    else{
        $spd_unit=1.825;     $acc_limit=1.5;
    }

    $res = mysql_query($sql, $link);
    $i = 0;
    $speed_max=0;
    $dis_sum = 0;
    while($data = mysql_fetch_array($res)){
        $i++;

        if($data_dev["device_type_id"] == "1"){
            $time = date('H:i:s', $data['time'] + date("Z"));
        }
        else{
            $time = $data["time"];
        }

        $lat = $data["latitude"];
        $long = $data["longitude"];
        $direction = $data["direction"];
        $speedj = $data["speed"];
        $altitude = $data["altitude"];

        $speed_i[$i] = $speedj * $spd_unit ;
        $time_i[$i] = $time;
        $lat_i[$i] = $lat;
        $lon_i[$i] = $long;
        $dir_i[$i] = $direction;
        $alt_i[$i] = $altitude;

        if ($speed_i[$i]>=$speed_max){
            $speed_max = $speed_i[$i];
        }

        if($i != 1) {
            $time_s = explode(":", $time_i[$i - 1]);
            $sec1 = ((($time_s[0]) * 3600) + (($time_s[1]) * 60) + ($time_s[2]));

            $time_s = explode(":", $time_i[$i]);
            $sec2 = ((($time_s[0]) * 3600) + (($time_s[1]) * 60) + ($time_s[2]));
            $sec_del = $sec2 - $sec1;

            if ($sec_del >= 10) {
                $sec_del = 0;
            }
        }
        else{
            $sec_del = 0;
        }

        if($i != 1) {
            $velocity = (($speed_i[$i] + $speed_i[$i - 1]) / 2) * (1000 / 3600);
            $distance = $velocity * $sec_del;
            $dis_sum += $distance;
        }
    }

    $num_rows = $i;

    $lat_begin = $lat_i[1];
    $lon_begin = $lon_i[1];
    $lat_end = $lat_i[$num_rows];
    $lon_end = $lon_i[$num_rows];

    $TimeBegin = $time_i[1];
    $TimeEnd = $time_i[$num_rows];

    $speed_maxy = round(($speed_max),2);

    /* =============================================================================== */
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

    $latB1 = DMStoDECLn($lat_begin);
    $latB2 = DMStoDECLn($lat_end);
    $lonB1 = DMStoDECLn($lon_begin);
    $lonB2 = DMStoDECLn($lon_end);

    if (($latB1>=14.0070) AND ($latB1<=14.0230)) { $tripdir = "A - B "; }
    elseif (($latB1>=14.0725) AND ($latB1<=14.0768)) { $tripdir = "B - A "; }
    elseif (($latB1>=14.7496) AND ($latB1<=14.9898) AND ($latB2>=13.8120) AND ($latB2<=13.8841)) { $tripdir = "NRM - BKK "; }
    elseif (($latB1>=13.8100) AND ($latB1<=13.8841) AND ($latB2>=14.7496) AND ($latB2<=14.9900)) { $tripdir = "BKK - NRM"; }
    elseif (($latB1>=16.4599) AND ($latB1<=17.2220) AND ($latB2>=19.8111) AND ($latB2<=19.8690) ) { $tripdir = "PNL - CHR"; }
    elseif (($latB1>=19.8111) AND ($latB1<=19.8690) AND ($latB2>=16.4599) AND ($latB2<=16.9620) ) { $tripdir = "CHR - PNL"; }
    elseif (($latB1>=13.8041) AND ($latB1<=13.8841) AND ($latB2>=16.4599) AND ($latB2<=16.8220) AND ($lonB2>=98.6824) ) { $tripdir = "BKK - PNL"; }
    elseif (($latB1>=16.4599) AND ($latB1<=16.9620) AND ($lonB1>=98.7890) AND ($latB2>=13.8100) AND ($latB2<=13.8841) ) { $tripdir = "PNL - BKK"; }
    elseif (($latB1>=13.8041) AND ($latB1<=13.8841) AND ($latB2>=16.4599) AND ($latB2<=17.2958) AND ($lonB2<=99.8660) AND ($lonB2>=99.7166) ) { $tripdir = "BKK - SKT"; }
    elseif (($latB2>=13.8041) AND ($latB2<=13.8841) AND ($latB1>=16.4599) AND ($latB1<=17.2958) AND ($lonB1<=99.8860) AND ($lonB1>=99.7166) ) { $tripdir = "SKT - BKK"; }
    elseif (($latB1<=13.8200) AND ($latB2>=18.4112) AND ($latB2<19.7364) AND ($lonB2<=100.0699) ) { $tripdir = "BKK - CHM "; }
    elseif (($latB2<=13.8141) AND ($latB1>=18.7500) AND ($latB1<=18.9500) ) { $tripdir = "CHM - BKK "; }
    elseif (($latB1>=19.6064) AND ($latB2<=13.9051)) { $tripdir = "CHR - BKK "; }
    elseif (($latB1<=13.9051) AND ($latB2>=19.7364)) { $tripdir = "BKK - CHR "; }
    elseif (($latB1<=13.8151) AND ($latB2>=16.6353 ) AND ($lonB2<=98.682422)) { $tripdir = "BKK - MSD "; }
    elseif (($latB2<=13.8151) AND ($latB1>=16.6353 ) AND ($lonB1<=99.2000)) { $tripdir = "MSD - BKK "; }
    elseif (($latB2>=13.7178 ) AND ($latB1>=9.1379 ) AND ($latB1<=10.0110)) { $tripdir = "SRT - BKK "; }
    elseif (($latB1>=13.7178 ) AND ($latB2>=9.1379 ) AND ($latB2<=9.4194)) { $tripdir = "BKK - SRT "; }
    elseif (($latB1>=13.7178 ) AND ($latB2>=10.455651 ) AND ($latB2<=10.564052)) { $tripdir = "BKK - CMP "; }
    elseif (($latB1<=7.1920 ) AND ($latB1>=7.1518 ) ) { $tripdir = "SKL - HYD "; }
    elseif (($latB1<=7.0290 )  ) { $tripdir = "HYD - SKL "; }

    elseif ( ($latB1<=13.74029) AND ($latB2>=13.8020) ) { $tripdir = "KSU1 - KSU2 "; }
    elseif ( ($latB1>=13.70903) AND ($latB2<=13.7501) ) { $tripdir = "KSU2 - KSU1 "; }

    elseif ( ($latB1<=16.757628) AND ( ($latB2>=16.8900) AND ($latB2<=17.0061) ) ) { $tripdir = "PNL - SKT"; }
    elseif ( ($latB1>=16.7441) AND ($latB2<=14.5158)  ) { $tripdir = "PNL - ATG"; }

    elseif ( ($latB1>=14.4621) AND ($latB2<=14.2009)  ) { $tripdir = "ATG - NNY"; }

    elseif ( ($lonB1<=101.544) AND ($lonB2>=102.0982)  ) { $tripdir = "359"; }
    elseif ( ($latB1>=14.1749) AND ($lonB2>=101.5131)  ) { $tripdir = "NNY - SKW"; }

    elseif ( ($lonB1<=101.2180) AND ($lonB2<=100.5399) AND ($latB1<=14.4153) ) { $tripdir = "NYY - ATG"; }

    elseif ( ($latB1<=14.4691) AND ($latB2<=15.0642)  ) { $tripdir = "ANG - CHN"; }

    elseif ( ($latB1>=18.0000) AND ($latB1<=18.5786) AND ($latB2>=18.7814)  ) { $tripdir = "LMP - CHM"; }

    elseif ( ($latB1<=18.8442) AND ($latB2>=19.2970)  ) { $tripdir = "CHM - MHS"; }
    elseif ( ($latB1>=19.3237) AND ($latB2<=18.9522)  ) { $tripdir = "MHS - CHM"; }

    elseif ( ($latB1<=16.7799) AND ($latB2>=16.8148)  ) { $tripdir = "NU - PNL"; }

    elseif ( ($latB1<=14.4952) AND ($latB2>=15.0478)  ) { $tripdir = "ANG - CHN"; }

    else {$tripdir = "UnKnow";}

    if (($tripdir == "UnKnow") OR ($tripdir == "PNL - SKT") ) {$goname0 = "HYD - SKL ";}
    elseif ( ($tripdir == "PNL - ATG") OR ($tripdir == "ATG - NNY") OR ($tripdir == "NNY - SKW") OR ($tripdir == "359") OR
        ($tripdir == "NYY - ATG") OR ($tripdir == "ANG - CHN") OR ($tripdir == "LMP - CHM") OR ($tripdir == "CHM - MHS")
        OR ($tripdir == "MHS - CHM") OR ($tripdir == "NU - PNL") )
    {$goname0 = "HYD - SKL ";}

    else  {$goname0 = $tripdir;}

    $strSubmit = "SELECT DISTINCT * FROM `routescore` WHERE `goname` = '$goname0' " ; /*The Last time stamp*/

    $objSubmit1 = mysql_query($strSubmit, $link) or die ("Error Query [".$strSubmit."]");
    $submit = mysql_fetch_array($objSubmit1);

    $nums_i = $submit["numscore"];
    $score_SA = $submit["scoresa"];
    $dis_norm_i = $submit["disavg"];
    $spd_a = $submit["vavg"];
    $time_d = $submit["timeavg"];

    $score100_i = $submit["totals"];
    $name_i = $submit["name"];
    $score_i = $submit["scoresa"];
    $spd_SA1 = $submit["spd1avg"];
    $spd_SA2 = $submit["spd2avg"];
    $spd_SA3 = $submit["spd3avg"];
    $spd_SA4 = $submit["spd4avg"];
    $spd_SA_i = $spd_SA1 + $spd_SA2 + $spd_SA3 + $spd_SA4 ;
    $acc_SA_i = $submit["accavg"];
    $turn_SA_i = $submit["turnavg"];
    $zone_SA1 = $submit["zone1avg"];
    $zone_SA2 = $submit["zone2avg"];
    $zone_SA3 = $submit["zone3avg"];
    $zone_SA4 = $submit["zone4avg"];
    $zone_SA_i = $zone_SA1 + $zone_SA2 + $zone_SA3 + $zone_SA4;
    //$spdMax = $submit["speedmax"];
    $spdMaxR = $submit["speedmax"];
    $accMax = $submit["accmax"];
    $turnMax = $submit["turnmax"];
    $zoneMax = $submit["zonemax"];
    $scoreMax = $submit["scoremax"];

    //print $spdMaxR;

    $dis_a = $dis_norm_i;
    $time_a = "$time_d";
    $num_score=$nums_i;

    ?>
</body>
</html>
