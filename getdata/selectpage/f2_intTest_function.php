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
    $score_max = 0;
    $speed_max1 = 0;
 
    $db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    $objDB = mysqli_select_db(DB_NAME);  /*Start Frame at Open selectable Always*/
    mysqli_query("SET NAMES 'tis620'");

    $sql = " TRUNCATE TABLE  `totalscore` ";
    $objQuery = mysqli_query($sql);

    /* === Read for All Test in Select test ==================*/

    $tnum = str_split ( $selectT,4);
    $number = $tnum[1];

    $exe1 = "SELECT `number`,`name`,`device`,`route`,`acclimit`,`speedunit`,`date`,`time1`,`time2`,`numscore`,`x1`,`x2`
            FROM `selecttest` WHERE `number`='$number' ORDER BY `date` ASC ";
    $result = mysqli_query($exe1)or die(mysqli_error());
    $num_rows = mysqli_numrows($result);

    for ($i=0; $i<$num_rows; $i++) {
        list($number,$name,$device,$route,$acclimit,$speedunit,$date,$time1,$time2,$numscore,$x1,$x2) = mysqli_fetch_row($result);
        $dateT[$i] = $date;
        $time1T[$i] = $time1;
        $time2T[$i] = $time2;
    }

    $nums_score = $num_rows-1;                  /* mumber of score list */
      
    /* ============================== Calculate num score Trip for =================================== */

    $k = 0;
    for ($i=0; $i<=$nums_score; $i++) {
        $num_score = $nums_score;

        /* =========== Select Last Calculation of Each Date-Time (16 Date-Time) ================================================ */

        $exe1 = "SELECT timestmp,date,pack1,tripdir,daylight,speedavg,distanceavg,timeavg FROM `selectscore` WHERE `date`='$dateT[$i]'
                AND `time1`='$time1T[$i]'  ORDER BY  `timestmp` DESC  ";
        $result = mysqli_query($exe1)or die(mysqli_error());
        $num_rows = mysqli_numrows($result);

        list($stmp0,$date0,$pack10,$tripdir0,$daylight0,$speedavg0,$distanceavg0,$timeavg0) = mysqli_fetch_row($result);

        $time_stamp = explode(" " ,$stmp0);
        $timestp[$i] =  $time_stamp[0];
        $date[$i] = $date0;
        $pack1[$i] = $pack10;
        $rout[$i] =  $tripdir0;
        $day[$i] =   $daylight0;

        $pack[$i] = array( $timestp[$i],$date[$i],$pack1[$i],$rout[$i],$day[$i]);
        $score_pack[$i] = implode(":",$pack[$i]);

        $pg = explode(":",$pack10);
        $speed_score = $pg[1];

        $total0 = explode(':',$pack10);

        $total[$i] =  $total0[13];

        $tripdir[$i] = $tripdir0;
        $daylight[$i] = $daylight0;

        /* Insert UPDATE total score of Each Date-Time (16 Date-Time) */

        $strSQL = "INSERT INTO  `totalscore` (`test`,`indei`,`tsmp` ,`date` ,  `pack` ,  `total`,  `tripdir`,  `daylight`,`speedavg`,  `distanceavg`,`timeavg`,`spdscore`)
                   VALUES  ('$selectT','$i' , NOW( ),'$date0', '$pack10',  '$total[$i]',  '$tripdir0',  '$daylight0' ,$speedavg0,$distanceavg0,$timeavg0,$speed_score );";
        $objQuery = mysqli_query($strSQL);
    }

    /*====================== Read Data Score for Source ============================== */

    if ($sort=="Date") {
        $sort = "date";
    }
    elseif ($sort=="Total") {
        $sort = "total";
    }
    elseif ($sort=="Trip") {
        $sort = "tripdir";
    }
    elseif ($sort=="Day") {
        $sort = "daylight";
    }
    else {
        $sort = "date";
    }


    $exe1 = "SELECT indei,tsmp ,date ,pack,total,tripdir,daylight,`speedavg`,`distanceavg`,`timeavg`
            FROM `totalscore` ORDER BY  `$sort` ASC LIMIT 0 ,44   ";
    $result = mysqli_query($exe1)or die(mysqli_error());
   
    $v_avg = 0;
    $d_avg = 0;
    $t_avg = 0;
    $zoneZ = 0;
    $sum_acc = 0;
    $sum_speed = 0;
    $sum_turn = 0;
    $zone_score = 0;
    $total_avg = 0;
    $z1 = 0;            /* Speed Zone Score */
    $z2 = 0;            /* Cross score*/
    $z3 = 0;            /* Bus Stop score*/
    $z4 = 0;           /* Train score*/
    $z5 = 0;           /* Nostop score*/

    for ($i=0; $i<=$num_score; $i++) {
        list($in0,$tsmp0,$date0,$pack10,$total,$tripdir0,$daylight0,$speedavg1,$distanceavg1,$timeavg1) = mysqli_fetch_row($result);

        $tsmp[$i] = $tsmp0;
        $datefg[$i] = $date0;
        $pack1[$i] = $pack10;
        $rout[$i] = $tripdir0;
        $day[$i] = $daylight0;
      
        $score[$i] = $total;
        $vd[$i] =  $speedavg1;
        $dist[$i] = $distanceavg1;
        $timeN[$i] = $timeavg1;
      
        /* else {$bback = $bback + 1; $tripbk = $tripdir0;}  */

        $pack[$i] = array($datefg[$i],$pack1[$i],$rout[$i],$day[$i]);
        $score_pack[$i] = implode(":",$pack[$i]);
        $data_score[$i]= $score_pack[$i];

        $v_avg = $v_avg + $speedavg1;
        $d_avg = $d_avg + $distanceavg1;
        $t_avg = $t_avg + $timeavg1;
        $total_avg = $total_avg + $total;
       
        if ($distanceavg1!=0) {
            $total100[$i] = ($total/$distanceavg1)*100;
        }

        $spdv = explode(":" , $pack10);

        $accS =  $spdv[0] + $accS;
        $spdS =  $spdv[1] + $spdS;

        $spdv1 = $spdv[2]+$spdv1;
        $spdv2 = $spdv[3]+$spdv2;
        $spdv3 = $spdv[4]+$spdv3;
        $spdv4 = $spdv[5]+$spdv4;

        $acc_score7[$i] = $spdv[0];
        $speed_score7[$i] = $spdv[1];
        $turn_score7[$i] = $spdv[6] + $spdv[7];
        $zone_score7[$i] = $spdv[8] + $spdv[9] + $spdv[10] + $spdv[11] + $spdv[12];

        $trnS =  $spdv[6]+$trnS;
        $trnUS =  $spdv[7]+$trnUS;

        $zoneZ1 =  $spdv[8] + $zoneZ1;
        $zoneZ2 =  $spdv[9] + $zoneZ2;
        $zoneZ3 =  $spdv[10] + $zoneZ3;
        $zoneZ4 =  $spdv[11] + $zoneZ4;
        $zoneZ5 =  $spdv[12] + $zoneZ5;
       
        $vs1[$i] = $spdv[2];
        $vs2[$i] = $spdv[3];
        $vs3[$i] = $spdv[4];
        $vs4[$i] = $spdv[5];

        $accSC[$i] =  $spdv[0];
        $turnSC[$i] =  $spdv[6];
        $turnUSC[$i] =  $spdv[7];

        $zz1[$i] = $spdv[8];
        $zz2[$i] = $spdv[9];
        $zz3[$i] = $spdv[10];
        $zz4[$i] = $spdv[11];
        $zz5[$i] = $spdv[12];
       
    }
       
    $accS = round(($accS/($num_score+1)),2);
    $spdS = round(($spdS/($num_score+1)),2);
    $trnS = round(($trnS/($num_score+1)),2);
    $trnUS = round(($trnUS/($num_score+1)),2);
    $zoneZ1 = round(($zoneZ1/($num_score+1)),2);
    $zoneZ2 = round(($zoneZ2/($num_score+1)),2);
    $zoneZ3 = round(($zoneZ3/($num_score+1)),2);
    $zoneZ4 = round(($zoneZ4/($num_score+1)),2);

    $v_avg = round(($v_avg/($num_score+1)),2);
    $d_avg = round(($d_avg/($num_score+1)),2);
    $t_avg = round(($t_avg/($num_score+1)),2);
       
    $total_avg =  round(($total_avg/($num_score+1)),2);

    $hour_trip = floor($t_avg/3600);
    $min_trip = ((floor($t_avg/60)) - ($hour_trip*60));
    if ($t_avg<60) {
        $sec_trip = $t_avg;
    }
    elseif ((60<=$t_avg) AND ($t_avg<3600)) {
        $sec_trip = ($t_avg-($min_trip*60));
    }
    elseif ($t_avg>=3600) {
        $sec_trip = ($t_avg-($min_trip*60) - ($hour_trip*3600));
    }
    $sec_trip = round($sec_trip,0);
    $time_d  = "$hour_trip hr $min_trip min $sec_trip sec";

    /* ========================================================== */

    $db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    mysqli_query("SET NAMES 'tis620'");
    $objDB = mysqli_select_db(DB_NAME); /*Start Frame at Open selectable Always*/

    $sql = " DELETE FROM  `routescore` WHERE  `name` = '$route' AND   `test`  = '$selectT' LIMIT 10 ; ";
    mysqli_query($sql);

    $tripgo = $rout[1];

    for ($i=0; $i<=$num_score; $i++) {

        $n = $n+1;

        if ($rout[$i] == $tripgo) {
            $gogo = $gogo+1;
            $dist1 = $dist[$i] + $dist1;

            $tim1 = $timeN[$i] + $tim1;
            $vd1 = $vd[$i] + $vd1;

            $vs11 = $vs1[$i] + $vs11;
            $vs21 = $vs2[$i] + $vs21;
            $vs31 = $vs3[$i] + $vs31;
            $vs41 = $vs4[$i] + $vs41;

            $accSC1  = $accSC[$i] + $accSC1;
            $turnSC1  = $turnSC[$i] + $turnSC1;
            $turnUSC1 = $turnUSC[$i] + $turnUSC1;

            $zz11 = $zz1[$i] + $zz11;
            $zz12 = $zz2[$i] + $zz12;
            $zz13 = $zz3[$i] + $zz13;
            $zz14 = $zz4[$i] + $zz14;
            $zz15 = $zz5[$i] + $zz15;

            $total100s1 = $total100s1 + $total100[$i];

            $score_SA = $score_SA + $score[$i];

            if ($score[$i]>=$score_max) {
                $score_max = $score[$i];
            }
            if ($speed_score7[$i]>=$speed_max) {
                $speed_max = $speed_score7[$i];
            }
            if ($acc_score7[$i]>=$acc_max) {
                $acc_max = $acc_score7[$i];
            }
            if ($turn_score7[$i]>=$turn_max) {
                $turn_max = $turn_score7[$i];
            }
            if ($zone_score7[$i]>=$zone_max) {
                $zone_max = $zone_score7[$i];
            }
        }
   
        elseif (($rout[$i]!= $tripgo) AND ($rout[$i]!= "UnKnow")) {
            $n2 = $n2+1;
            $bback = $bback +1;

            $tripbk = $rout[$i];

            $dist2 = $dist[$i] + $dist2;
            $tim2 = $timeN[$i] + $tim2;
            $vd2 = $vd[$i] + $vd2;

            $vs12 = $vs1[$i] +$vs12;
            $vs22 = $vs2[$i] +$vs22;
            $vs32 = $vs3[$i] +$vs32;
            $vs42 = $vs4[$i] +$vs42;
            $accSC2  = $accSC[$i] + $accSC2;
            $turnSC2  = $turnSC[$i] + $turnSC2;
            $turnUSC2 = $turnUSC[$i] + $turnUSC2;
     
            $zz21 = $zz1[$i] + $zz21;
            $zz22 = $zz2[$i] + $zz22;
            $zz23 = $zz3[$i] + $zz23;
            $zz24 = $zz4[$i] + $zz24;
            $zz25 = $zz5[$i] + $zz25;

            $total100s2 = $total100s2 + $total100[$i];
            $score_SA2 = $score_SA2 + $score[$i];
     
            if ($score[$i]>=$score_max2) {
                $score_max2 = $score[$i];
            }
            if ($speed_score7[$i]>=$speed_max2) {
                $speed_max2 = $speed_score7[$i];
            }
            if ($acc_score7[$i]>=$acc_max2) {
                $acc_max2 = $acc_score7[$i];
            }
            if ($turn_score7[$i]>=$turn_max2) {
                $turn_max2 = $turn_score7[$i];
            }
            if ($zone_score7[$i]>=$zone_max2) {
                $zone_max2 = $zone_score7[$i];
            }
        }
    }

    if ($gogo<>0) {
        $dist1 = round(($dist1/$gogo),2);
        $tim1 =  round(($tim1/$gogo),2);
        $vd1 =  round(($vd1/$gogo),2);
        $vs11 =  round(($vs11/$gogo),2);
        $vs21 =  round(($vs21/$gogo),2);
        $vs31 =  round(($vs31/$gogo),2);
        $vs41 =  round(($vs41/$gogo),2);
        $accSC1 =  round(($accSC1/$gogo),2);
        $turnSC1 =  round(($turnSC1/$gogo),2);
        $turnUSC1 =  round(($turnUSC1/$gogo),2);

        $zz11 =  round(($zz11/$gogo),2);
        $zz12 =  round(($zz12/$gogo),2);
        $zz13 =  round(($zz13/$gogo),2);
        $zz14 =  round(($zz14/$gogo),2);
        $zz15 =  round(($zz15/$gogo),2);

        $total100s1 =  round(($total100s1/$gogo),2);

        $score_SA  =  round(($score_SA/$gogo),2);
    }

    if ($bback<>0) {
        $dist2 = round(($dist2/$bback),2);
        $tim2 =  round(($tim2/$bback),2);
        $vd2 =  round(($vd2/$bback),2);
        $vs12 =  round(($vs12/$bback),2);
        $vs22 =  round(($vs22/$bback),2);
        $vs32 =  round(($vs32/$bback),2);
        $vs42 =  round(($vs42/$bback),2);
        $accSC2 =  round(($accSC2/$bback),2);
        $turnSC2 =  round(($turnSC2/$bback),2);
        $turnUSC2 =  round(($turnUSC2/$bback),2);

        $zz21 =  round(($zz21/$bback),2);
        $zz22 =  round(($zz22/$bback),2);
        $zz23 =  round(($zz23/$bback),2);
        $zz24 =  round(($zz24/$bback),2);
        $zz25 =  round(($zz25/$bback),2);

        $total100s2 =  round(($total100s2/$bback),2);

        $score_SA2  =  round(($score_SA2/$bback),2);
    }

    $strSQL = " INSERT INTO  `routescore` (`name` ,`test` ,`numscore`,`totals` ,`disavg` ,`timeavg` ,`vavg` ,`spd1avg` ,`spd2avg` ,`spd3avg`,`spd4avg` ,
                    `accavg` ,`turnavg` ,`uturnavg` ,`zone1avg`,`zone2avg`,`zone3avg`,`zone4avg`,`zone5avg`,`goname`,`gonum`
                    ,`scoresa`,`scoremax`,`speedmax`,`accmax`,`turnmax`,`zonemax`)
                VALUES ('$route',  '$selectT', '$n', '$total100s1','$dist1','$tim1','$vd1','$vs11','$vs21','$vs31','$vs41','$accSC1','$turnSC1','$turnUSC1','$zz11',  '$zz12','$zz13','$zz14','$zz15','$tripgo','$gogo'
                    ,'$score_SA','$score_max','$speed_max','$acc_max','$turn_max','$zone_max');";
    $objQuery = mysqli_query($strSQL);

    /* -------------------------------------------- */

    $strSQL = " INSERT INTO  `routescore` (`name` ,`test` ,`numscore`,`totals` ,`disavg` ,`timeavg` ,`vavg` ,`spd1avg` ,`spd2avg` ,`spd3avg`,`spd4avg` ,
                    `accavg` ,`turnavg` ,`uturnavg` ,`zone1avg`,`zone2avg`,`zone3avg`,`zone4avg`,`zone5avg`,`goname`,`gonum`
                    ,`scoresa`,`scoremax`,`speedmax`,`accmax`,`turnmax`,`zonemax`)
                VALUES ('$route',  '$selectT', '$n2', '$total100s2','$dist2','$tim2','$vd2','$vs12','$vs22','$vs32','$vs42','$accSC2','$turnSC2','$turnUSC2','$zz21','$zz22','$zz23','$zz24','$zz25','$tripbk','$bback'
                    ,'$score_SA2','$score_max2','$speed_max2','$acc_max2','$turn_max2','$zone_max2' );";
    $objQuery = mysqli_query($strSQL);
    ?>
</body>
</html>


