<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title> TATANAD GPS Supervisory Driver Behavior Score </title>

    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">

</head>
<body>
 
    <?php
    $RouteT[1] = "Test1";    $routedir[1] = "A - B";
    $RouteT[2] = "Test1";    $routedir[2] = "B - A";
  
    $RouteT[3] = "Test2";    $routedir[3] = "BKK - NRM";
    $RouteT[4] = "Test2";    $routedir[4] = "NRM - BKK";

    $RouteT[5] = "Test3";    $routedir[5] = "BKK - NRM";
    $RouteT[6] = "Test3";    $routedir[6] = "NRM - BKK";

    $RouteT[7] = "Test4";    $routedir[7] = "BKK - CHR";
    $RouteT[8] = "Test4";    $routedir[8] = "CHR - BKK";

    $RouteT[9]  = "Test6";   $routedir[9] = "BKK - SKT";
    $RouteT[10] = "Test6";   $routedir[10] = "SKT - BKK";

    $RouteT[11] = "Test7";   $routedir[11] = "BKK - CHM";
    $RouteT[12] = "Test7";   $routedir[12] = "CHM - BKK";

    $RouteT[13] = "Test8";   $routedir[13] = "BKK - SRT";
    $RouteT[14] = "Test8";   $routedir[14] = "SRT - BKK";

    $RouteT[15] = "Test8B";  $routedir[15] = "BKK - SRT";
    $RouteT[16] = "Test8B";  $routedir[16] = "SRT - BKK";

    $RouteT[21] = "Test9";   $routedir[21] = "BKK - MSD";
    $RouteT[22] = "Test9";   $routedir[22] = "MSD - BKK";

    $RouteT[18] = "Test18";  $routedir[18] = "SKL - HYD";
    $RouteT[19] = "Test18";  $routedir[19] = "HYD - SKL";

    $RouteT[23] = "Test20";  $routedir[23] = "KSU1 - KSU2";
    $RouteT[24] = "Test21";  $routedir[24] = "KSU2 - KSU1";
  
    $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
    $objDB = mysqli_select_db(DB_NAME);

    for ($i=1; $i<=24; $i++) {
        $strSubmit = "SELECT DISTINCT * FROM `routescore` WHERE `test` = '$RouteT[$i]' AND `goname` = '$routedir[$i]' " ; /*The Last time stamp*/
        $objSubmit1 = mysqli_query($strSubmit) or die ("Error Query [".$strSubmit."]");
        $submit = mysqli_fetch_array($objSubmit1);

        $nums[$i] = $submit["numscore"];

        $score100[$i] = $submit["totals"];
        $name[$i]     = $submit["name"];
        $dis_norm[$i] = $submit["disavg"];
        $time[$i] = $submit["timeavg"];
        $score[$i] = $submit["scoresa"];

        $spd_a = $submit["vavg"];

        $spd_SA1 = $submit["spd1avg"];
        $spd_SA2 = $submit["spd2avg"];
        $spd_SA3 = $submit["spd3avg"];
        $spd_SA4 = $submit["spd4avg"];

        $spd_SA[$i]  =  $spd_SA1 + $spd_SA2 + $spd_SA3 + $spd_SA4 ;
  
        $acc_SA[$i] =  $submit["accavg"];
        $turn_SA[$i] = $submit["turnavg"];

        $zone_SA1 = $submit["zone1avg"];
        $zone_SA2 = $submit["zone2avg"];
        $zone_SA3 = $submit["zone3avg"];
        $zone_SA4 = $submit["zone4avg"];
        $zone_SA[$i]  = $zone_SA1 + $zone_SA2 + $zone_SA3 + $zone_SA4;

        $score_SA = $submit["scoresa"];

        $spdMax = $submit["speedmax"];
        $accMax = $submit["accmax"];
        $turnMax = $submit["turnmax"];
        $zoneMax = $submit["zonemax"];
        $scoreMax = $submit["scoremax"];
        /*------------- Calculating for Display ----------------------- */
    }
    ?>
</body>
</html>


