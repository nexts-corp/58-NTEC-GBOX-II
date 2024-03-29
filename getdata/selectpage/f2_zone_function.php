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
    $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
    mysql_select_db(DB_NAME, $db);
    $exe2 = "SELECT latitude,longitude,colorD,colorDF,type FROM `dangerous`";
    $result2 = mysql_query($exe2)or die(mysql_error());
    $dan_rows = mysql_numrows($result2);

    $latD = array (  );   $lonD = array (  );
    $latOffset = 0.0015; $lonOffset = 0.0017;

    $i = 0;
    while(list($Dlat,$Dlon,$colorD,$colorDF,$Dtype) = mysql_fetch_row($result2)){
        $latD[$i] = $Dlat;
        $lonD[$i] = $Dlon;
        $Dtype2[$i] = $Dtype;
        $i = $i+1;
    }

    for ($n=0; $n<($dan_rows); $n++) {
        $lon_Lz[$n] = $lonD[$n] + 0.00010;
        $lon_Rz[$n] = $lonD[$n] - 0.00010;
        $lat_Lz[$n] = $latD[$n] + 0.00012;
        $lat_Rz[$n] = $latD[$n] - 0.00012;
        $typez[$n] = $Dtype2[$n];
    }

    /* -- Initial parameter */
    $score6 = 0; $score7 = 0; $score9 = 0; $score10 = 0; $score11 = 0; $score12 = 0; $score13 = 0;
    $score14 = 0; $score6n = 0;  $score7n = 0; $score9n = 0; $score10n = 0; $score11n = 0; $score12n = 0;
    $score13n = 0;  $score14n = 0; $scoreB = "-";
    $k = 0;
    $acc_str = 0; $acc_num = 0; $acc_stp = 0; $dan_stp=1; $acc_num1 = 0;
    $mark = 99; $markc = 99; $markd = 99; $marke = 99; $markf = 99; $mark8 = 99;
    $crss_str = 0; $crss_stp = 1; $cross_cnt3 = 0; $nspeed = 999; $Osp_stp = 1;
    $dir_cnt = 0; $dir_cnt1 = 0; $dir_str = 0; $dir_stp = 0; $cross_cnt3 = 0;
    $v_min = 999; $acc_speed1 = 0; $nstop_cnt1 = 0; $nstop_cnt2 = 0; $tstop_cnt2 = 0; $tstop_cnt1 = 0;
    $stop_cnt2 = 0; $stop_time = 0; $stop_cnt = 0; $nzero_cnt = 0; $zoneP = 0;

    $acc_stop = 1; $acc_start=0; $acc_cnt=0; $zero_start = 0; $zero_stop = 0;
    $stop_cnt1 = 0; $stop_in=0; $tspeed= 999; $dis_summ = 0; $distanceZ = 0;

    for ($i=1; $i<=4; $i++) {
        $score[$i] =  0;
        $oversp[$i] = 0;
        $osp[$i] = 0;
    }

    $dis_summ = 0; $distance = 0; $sec0 = 0; $av_sec = 0; $Turn_cntD = 0; $back_cnt = 0; $turn_str = 0;
    $sumdir = 0; $sumalt = 0; $avv1 = 0;

    /*============== Read Data Point and initialial data */

    for ($k=1; $k<= $num_rows; $k++) {
        $time = $time_i[$k];
        $lat = $lat_i[$k];
        $lon = $lon_i[$k];
        $speed = $speed_i[$k]*$spd_unit;
        $direction = $dir_i[$k];
        $altitude =  $alt_i[$k];

        if($k != 1) {
            $deldir = $dir_i[$k] - $dir_i[$k - 1];            /* integrate dir */
        }
        else{
            $deldir = 0;
        }
        if (abs($deldir)>=10) {
            $deldir = 0;
        }
        $sumdir = $deldir + $sumdir;

        if($k != 1) {
            $delalt = $alt_i[$k] - $alt_i[$k - 1];            /* integrate dir */
        }
        else{
            $delalt = 0;
        }
        if (abs($delalt)>=3) {
            $delalt = 0;
        }
        $sumalt = $delalt + $sumalt;

        /* Secondary parameter calculation */
        $lonn = DMStoDECLn($lon);
        $latt = DMStoDECLn($lat);

        $speedP[$k] =  $speed*(1000/3600);
        $time_s = explode(":", $time);
        $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
        $sec_del = $sec-$sec0;
        $sec0=$sec;

        $distanceZ = $speedP[$k] * $sec_del;
        $dis_summ  = $distanceZ + $dis_summ;

        /* [Score 9] Calculate Over speed in Cross Zone */

        if ($sec_del!=0) {
            if($k != 1) {
                $avv = (($speedP[$k] - $speedP[$k - 1]) / $sec_del);
            }
            else{
                $avv = 0;
            }
        }

        else {
            $avv = 0;
        }
  
        $av_diff = round(($avv - $avv1),4);
        $avv1 = $avv;
        $vv1 = $speed;

        if ($markc==99)  {                      /*== Entri zone condition Markc99 , out of zone ==*/
            for ($n=0; $n<($dan_rows); $n++) {    /*== Detect number and zone type ==*/

                if (($typez[$n]==4) AND ($lonn>=$lon_Rz[$n]) AND ($lonn<=$lon_Lz[$n]) AND ($latt>=$lat_Rz[$n]) AND ($latt<=$lat_Lz[$n]) ) {

                    $cross_zone = $cross_zone+1;

                    $markc = $n;
                    $v_min = 999;
                    $n = $dan_rows;

                    $crossP1 = $k;
                    $timeC1 = $time;
                    $disC1 = $dis_summ;

                    $sumdir1_1 = $sumdir;
                    $sumalt1_1 = $sumalt;
                }
            }
        }

        elseif ($markc!=99) {

            if (($lonn>=$lon_Rz[$markc]) AND ($lonn<=$lon_Lz[$markc]) AND ($latt>=$lat_Rz[$markc]) AND ($latt<=$lat_Lz[$markc])) {

                if ($speed < $v_min) { $v_min = $speed; }

                if ($avv < 0) {
                   $cross_str = 1;
                   $cross_cnt = $cross_cnt + 1;
                   if ($speed<=3) {
                       $min_spd = 1;
                   }

                }

                elseif (($avv>=0) AND ($cross_str==1)) {

                   $brk_speed[$cross_cnt2] =  round($speed,2);
                   $dif_speed =   $brk_speed[$cross_cnt2] -  $brk_speed[$cross_cnt2-1];

                   if ($dif_speed<0) {
                       $safe1_cnt = $safe1_cnt+1;
                   }
                   if (($dif_speed<0) AND ($speed<=3)) {
                       $safe2_cnt = $safe2_cnt+1;
                   }

                   $cross_cnt2 = $cross_cnt2 + 1;

                   $in_zone_cnt1[$cross_cnt3] = $cross_cnt2;        /* number of cross pass*/

                   $in_zone_cnt2[$cross_cnt3] = $safe1_cnt;         /* number of end speed dec.*/
                   $in_zone_cnt3[$cross_cnt3] = $safe2_cnt;         /* number of end speed acc.*/

                   $v_min0[$cross_cnt3] = round($v_min,2);

                   $cross_cnt= 0;
                   $safe1_cnt = 0;
                   $safe2_cnt = 0;
                }
            }

            if (($lonn<($lonD[$markc]-0.00010)) OR ($lonn>($lonD[$markc]+0.00010)) OR ($latt<($latD[$markc]-0.00012)) OR ($latt>($latD[$markc]+0.00012))){

                if ($speed < $v_min) {
                    $v_min = $speed;
                }

                $zoneP = $zoneP+1;
                $crossPoint1[$zoneP] = $crossP1;
                $crossPoint4[$zoneP] = $k;
                $crossSPD[$zoneP] = $v_min;

                $crossT1[$zoneP] = $timeC1;
                $crossT2[$zoneP] = $time;

                $crossDis[$zoneP] = round(($dis_summ - $disC1),2);

                $sumdir1[$zoneP] =  $sumdir - $sumdir1_1 ;
                $sumalt1[$zoneP] =  $sumalt - $sumalt1_1 ;

                if ($v_min>=20) {
                    $cross_cnt3 = $cross_cnt3+1;
                    $zone_type[$zoneP] = "CrossOver";
                }
                elseif ($v_min<=3) {
                    $zone_type[$zoneP] = "CrossStop";
                }
                else {
                    $zone_type[$zoneP] = "Cross";
                }

                if (( $in_zone_cnt3[$cross_cnt3] >=1) AND ($in_zone_cnt2[$cross_cnt3] >=1) AND ($in_zone_cnt1[$cross_cnt3] >=1)) {
                    $cross_score[$cross_cnt3] = 10;
                }
                elseif (( $in_zone_cnt2[$cross_cnt3] >=1) AND ( $in_zone_cnt1[$cross_cnt3] >=1) AND ($v_min>3) AND ($v_min<=20) ) {
                    $cross_score[$cross_cnt3] = 5;
                }
                elseif ( ($in_zone_cnt1[$cross_cnt3] >=1) AND ($v_min>20)) {
                    $cross_score[$cross_cnt3] = 2;
                }

                $cross_score[$cross_cnt3] = $cross_cnt3;

                $v_min = 999;
                $cross_stp=1;
                $cross_str=0;
                $cross_cnt = 0;
                $cross_cnt2 = 0;
                $markc = 99;

            }
        }

        /* [Score 11] Count for Stop Zone ############### */

        if ($markd==99) {
            for ($n=0; $n<($dan_rows); $n++) {
                if (($typez[$n]==1) AND ($lonn>=$lon_Rz[$n]) AND ($lonn<=$lon_Lz[$n]) AND ($latt>=$lat_Rz[$n]) AND ($latt<=$lat_Lz[$n])) {
                    $markd=$n;
                    $n = $dan_rows;
                    $stop_cnt1 = $stop_cnt1+1;
                    $stopP1 = $k;
                    $stop_in=1;
                    $timeS1 = $time;
                    $disS1 = $dis_summ;

                    $sumdir2_1 = $sumdir;
                    $sumalt2_1 = $sumalt;
                }
            }
        }

        elseif ($markd!=99)  {
            if ( ($lonn>=($lonD[$markd]-0.0010)) AND ($lonn<=($lonD[$markd]+0.0010)) AND ($latt>=($latD[$markd]-0.0012)) AND ($latt<=($latD[$markd]+0.0012))) {

                if ($speed>3) {
                    $stop_time = $stop_time + 1;
                }
                $stop_str=1;

                if ($speed<$speed_min) { $speed_min = $speed; }
            }
        }

        if (($lonn<($lonD[$markd]-0.0010)) OR ($lonn>($lonD[$markd]+0.0010)) OR ($latt<($latD[$markd]-0.0012)) OR ($latt>($latD[$markd]+0.0012))) {
            if ($stop_str==1) {
                $stop_cnt2 = $stop_cnt2 + 1;
                $speed_m[$stop_cnt2] = round($speed_min,2);

                $stop_cnt = $stop_cnt+1;
                $zoneP = $zoneP + 1;

                $crossPoint1[$zoneP] = $stopP1;
                $crossPoint4[$zoneP] = $k;
                $crossSPD[$zoneP] = $speed_min;
                $zone_type[$zoneP] = "BStop";
                $crossT1[$zoneP] = $timeS1;
                $crossT2[$zoneP] = $time;
                $crossDis[$zoneP] = round(($dis_summ - $disS1),2);

                $sumdir1[$zoneP] = $sumdir  - $sumdir2_1 ;
                $sumalt1[$zoneP] = $sumalt  - $sumalt2_1 ;
            }
            $stop_str = 0;
            $stop_cntj = 0;
            $speed_min = 999;

            $markd = 99;
        }

        /* [Score 12] Count for Speed over 10 km/hr ON No Park ############### */

        if ($marke==99) {
            for ($n=0; $n<($dan_rows); $n++) {
                if (($typez[$n]==2) AND ($lonn>=$lon_Rz[$n]) AND ($lonn<=$lon_Lz[$n]) AND ($latt>=$lat_Rz[$n]) AND ($latt<=$lat_Lz[$n])) {
                    $marke=$n;
                    $n = $dan_rows;
                    $parkP1 = $k;
                    $timePrk1 = $time;
                    $disPrk1 = $dis_summ;

                    $sumdir3_1 = $sumdir;
                    $sumalt3_1 = $sumalt;
                }
            }
        }

        elseif ($marke!=99) {
            if ( ($lonn>=($lonD[$marke]-0.0010)) AND ($lonn<=($lonD[$marke]+0.0010)) AND ($latt>=($latD[$marke]-0.0012)) AND ($latt<=($latD[$marke]+0.0012))) {
                $nstop_cnt = $nstop_cnt + 1;
                $nstop_str = 1;

                if ($speed<$nspeed) {
                    $nspeed = $speed;
                }
            }
        }

        if (($lonn<($lonD[$marke]-0.0010)) OR ($lonn>($lonD[$marke]+0.0010)) OR ($latt<($latD[$marke]-0.0012)) OR ($latt>($latD[$marke]+0.0012))) {
            if ($nstop_str==1) {
                $nstop_cnt1 = $nstop_cnt1 + 1;
                if ($nspeed>=3) {
                    $nstop_cnt2 = $nstop_cnt2+1;
                    $zoneP = $zoneP + 1;

                    $crossPoint1[$zoneP] = $parkP1;
                    $crossPoint4[$zoneP] = $k;
                    $crossSPD[$zoneP] = $nspeed;
                    $zone_type[$zoneP] = "Park";
                    $crossT1[$zoneP] = $timePrk1;
                    $crossT2[$zoneP] = $time;
                    $crossDis[$zoneP] = round(($dis_summ - $disPrk1),2);

                    $sumdir1[$zoneP] = $sumdir - $sumdir3_1   ;
                    $sumalt1[$zoneP] = $sumalt - $sumalt3_1   ;
                }
            }

            $nstop_str =0;
            $nstop_cnt = 0;
            $nspeed=999;

            $marke = 99;
        }

        /* [Score 13] Count for Speed over 10 km/hr ON Train Zone ############### */

        if ($markf==99) {
            for ($n=0; $n<($dan_rows); $n++) {

                if (($typez[$n]==5) AND ($lonn>=$lon_Rz[$n]) AND ($lonn<=$lon_Lz[$n]) AND ($latt>=$lat_Rz[$n]) AND ($latt<=$lat_Lz[$n])) {
                    $markf = $n;
                    $trainP1 = $k;
                    $trainT1 = $time;
                    $n = $dan_rows;

                    $sumdir4_1 = $sumdir;
                    $sumalt4_1 = $sumalt;
                }
            }
        }

        elseif ($markf!=99) {

            if ( ($lonn>=($lonD[$markf]-0.0010)) AND ($lonn<=($lonD[$markf]+0.0010)) AND ($latt>=($latD[$markf]-0.0012)) AND ($latt<=($latD[$markf]+0.0012))) {

                $tstop_cnt = $tstop_cnt + 1;
                $tstop_str=1;

                if ($speed<=20) {
                    $t_latt = DMStoDECLn ($lat);
                    $t_lonn = DMStoDECLn ($lon);

                }
                 
                if ($speed<=$tspeed) {
                    $tspeed=$speed;
                    $t_latt = DMStoDECLn ($lat);
                    $t_lonn = DMStoDECLn ($lon);
                }
            }
        }

        if (($lonn<($lonD[$markf]-0.0010)) OR ($lonn>($lonD[$markf]+0.0010)) OR ($latt<($latD[$markf]-0.0012)) OR ($latt>($latD[$markf]+0.0012))){
            if ($tstop_str==1) {
                $tstop_cnt1 = $tstop_cnt1+1;

                $lat_t = $latD[$markf];
                $lon_t = $lonD[$markf];

                $dis_train = 1000*distank($lat_t,$lon_t,$t_latt,$t_lonn);

                if   ($dis_train<20) {
                    $tstop_cnt2 = $tstop_cnt2+1;
                }
                $zoneP = $zoneP + 1;

                $crossPoint1[$zoneP] = $trainP1;
                $crossPoint4[$zoneP] = $k;
                $crossSPD[$zoneP] = $tspeed;
                $zone_type[$zoneP] = "Train";
                $crossT1[$zoneP] = $trainT1;
                $crossT2[$zoneP] = $time;
                $crossDis[$zoneP] = $dis_train;

                $sumdir1[$zoneP] = $sumdir - $sumdir4_1  ;
                $sumalt1[$zoneP] = $sumalt - $sumalt4_1  ;

            }

            $tstop_str =0;
            $tstop_cnt = 0;
            $tspeed=999;

            $markf = 99;
        }
    }   /* close while/for of Read Point*/

    for ($n=1; $n<=($zoneP); $n++) {
        $time01 = $crossT1[$n];
        $time_s = explode(":", $time01);
        $sec01 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

        $time02 = $crossT2[$n];
        $time_s = explode(":", $time02);
        $sec02 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

        $durat[$n] = $sec02 - $sec01;

        $pp1 = $crossPoint1[$n];
        $pp2 = $crossPoint4[$n];
        $latz1[$n]= $lat_i[$pp1];
        $lonz1[$n]= $lon_i[$pp1];
        $latz2[$n]= $lat_i[$pp2];
        $lonz2[$n]= $lon_i[$pp2];

        $sumdir1[$n] = round($sumdir1[$n],4);
        $sumalt1[$n] = round($sumalt1[$n],2);
    }

    $cross_num = $nzero_cnt;
    mysql_close($db);
    ?>
</body>
</html>


