<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>JavaScript Datepicker Test</title>

    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
</head>

<body>

    <?php
    $osp[1] = 0; $osp[2] = 0; $osp[3] = 0; $osp[4] = 0;
    $over = 0; $sec0 = 0;
    $score[1] = 0; $score[2] = 0; $score[3] = 0; $score[4] = 0;
    $type1 = 0;  $type2 = 0;  $type3 = 0;
    $speed_sec = 0; $distance_sum = 0; $distance = 0; $dis_long = 0; $dis_sum = 0;
    $v1 = 0; $v2 = 0; $v3 = 0;
    $second0 = 1; $second1 = 0; $second2 = 0; $second3 = 0; $second4 = 0;
    $speed_str = 0; $speed_stp = 0;
    $dowsy_cnt = 0; $dow_cnt = 0; $nodawsy_cnt = 0; $speedd_agv=0; $dowsy_start=0; $dowsy_stop=0;
    $int_delT = 0; $delta_theta = 0;  $spdT1 = 0; $spdT2 = 0;
    $take = 0; $speed_maxd = 0; $zero_min = 9999;

    $zero_cnt = 0; $zero_stop=0; $zero_start = 0; $speed_str=0; $zero_bus_cnt=0;
    $stop_bus_cnt = 0; $sum_dis_dw=0; $speed_max=0; $int_speed =0;
    $int_dirt =0;
    
    $alt_sumE =0;
    $alt_max = 0;
    $alt_min=9999;
    
    $int_spd_dif = 0;
    $spd_dif = 0;

    $time_long = 0;
    for ($i=1; $i<$num_rows; $i++) {
        $bb = $i;
        $date0 = $DateBegin;
        $time0 = $time_i[$i];
        $lat0 = $lat_i[$i];
        $lon0 = $lon_i[$i];
        $spd8 = $speed_i[$i];
        $alt0 = $dir_i[$i];

        $altitudE = $alt_i[$i];

        $time = $time0;

        $direction = $alt0;
        $spd[$bb] = $spd8;
        $timePP[$bb] = $time;
        $v2 = $spd8*(1000/3600);
    
        $time_s = explode(":", $time);
        $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
        $sec_del7 = $sec - $sec0;                                       /* second */

        if (($sec_del7 <=0) OR ($bb==0)) {
            $sec_del7 = 0;
        }
        $sec0 = $sec;
        $sec_zero[$bb]=$sec;
      
        if ($bb>=1) {
            /* Integrate Delta Thetha */
            $direct[$bb] = $direction;
            $int_Dtheta[$bb] = 0;
            if ($bb>=2) {
                $delta_theta = $direct[$bb] - $direct[$bb-1];
            }
      
            /* ==================================================== */
            $sec_dow[$bb] = $sec_del7;

            if ($sec_del7 !=0) {
                $av = (($v2-$v1) /$sec_del7 );
            }
            if ($i==0) {
                $av = 0;
            } //old $k==0
            $av = round($av,2);

            $v3 = abs($v2 + $v1)/2;
            $distance = $v2 * $sec_del7;                                   /* mater */

            if ($bb==1) {
                $dis_long = 0;
            }
            else {
                $dis_long = $dis_long + $distance;
                $time_long =  $time_long + $sec_del7;
            }

            $dis_sum = round(($dis_long/1000),4);                          /* Kilomater */

            if (($spd8>=81) AND ($speed_str==0)) {
                $startT=$time;
                $start_pt = $bb;
                $speed_str = 1; $speed_stp=0;
                $sec_start = $sec0;
                $start_distance = $dis_sum;
                $pnt1 = $bb;
                $speed_max=$spd8; $point_max = $bb;
                $int_delT = $int_delT +  $delta_theta ;
                $direct1 = $direction;

                $lat_01 =  $lat0;
                $lon_01 =  $lon0;

                $altitudE0 = $altitudE;
            }

            elseif (($spd8>=81) AND ($speed_str==1)) {
                $speed_sec = $speed_sec+$sec_del7;
                if ($spd8>$speed_max) {
                    $speed_max = $spd8;
                    $point_max = $bb;
                    $lat_max0 = $lat0;
                    $lon_max0 = $lon0;
                }

                $int_delT = $int_delT +  $delta_theta ;
                if ($int_delT<-180) {
                    $int_delT = $int_delT + 360;
                }     /* Right turn and cross Q4-Q1.  */
                elseif ($int_delT>180) {
                    $int_delT = $int_delT - 360;
                }     /* Left turn and cross Q1-Q4.  */

                $int_Dtheta[$bb] = $int_delT;

                if ((abs($int_delT)>=7) AND ($take==0) AND ($take2==0)) {
                    $spdT1 = $sec0;
                    $take = 1;
                }
                elseif ((abs($int_delT)<7)  AND ($take==1) AND ($take2==0)) {
                    $spdT3 = $sec0-$spdT1;
                    $take2 = 1;
                }

                if (abs($int_delT)>abs($intDmax)) {
                    $intDmax = $int_Dtheta[$bb];
                    $spdT2 = $sec0;
                }

                $del_alt = $altitudE - $altitudE0;
                $alt_sumE = $alt_sumE + $del_alt;

                if (abs($alt_sumE)>=abs($alt_max)) {
                    $alt_max = $alt_sumE;
                }
                /* elseif (abs($alt_sumE)<=$alt_min)  {$alt_min = $alt_sumE;} */

                $altitudE0 = $altitudE;
            }

            if ((($spd8<81)) AND ($speed_str==1)) {
                $speed_stp = 1;
                $speed_sec = $speed_sec+$sec_del7;
            }

            if (($speed_str==1) AND ($speed_stp==1) AND ($speed_sec>=40)) {
                $over = $over +1;
                $spd_pint1[$over] = $pnt1;
                $spd_pint[$over] = $bb;
                $spd_pint2[$over] = $point_max;
                $timep[$over] = $time;
                $spd_max[$over] = round($speed_max,2);
                $speed_time[$over] =  $speed_sec;
                $speed_dis[$over] = round(($dis_sum - $start_distance),2);

                $start_time[$over] = $startT;
                $stop_time[$over] = $time;
          
                $lat_max[$over] =  DMStoDECLn($lat_max0);
                $lon_max[$over] =  DMStoDECLn($lon_max0);

                $latBe1[$over] = $lat_01;
                $lonBe1[$over] = $lon_01;

                $latEn1[$over] = $lat0;
                $lonEn1[$over] = $lon0;

                $dis7[$over] = $dis_sum - $start_distance;

                $intDmax7[$over] = round($intDmax,2);
                if ($spdT3=="") {$spdT3=0;}
                $spdT7[$over] = $spdT3;

                $altMaxi[$over]= round($alt_sumE,2);

                $diff_dir[$over] = $direction - $direct1;
                if ($diff_dir[$over]<-180) {
                    $diff_dir[$over] = $diff_dir[$over] + 360;
                }     /* Right turn and cross Q4-Q1.  */
                elseif ($diff_dir[$over]>180) {
                    $diff_dir[$over] = $diff_dir[$over] - 360;
                }     /* Left turn and cross Q1-Q4.  */
                $diff_dir[$over] = round($diff_dir[$over],2);

                if ($speed_sec>=40) {
                    $font_spd[$over] = "#DF0000";
                }
                 elseif ($speed_sec<40) {
                     $font_spd[$over] = "#000000";
                 }

                if ($speed_sec>=40) {
                    if (($speed_max>=81) AND ($speed_max<88)) {
                        $osp[1]=$osp[1]+1;
                        $score[1]=$score[1]+0.2;
                        $overt[$over]=0.2;
                        $second1 = $second1 + $speed_time[$over];
                    }

                    elseif (($speed_max>=88) AND ($speed_max<96)) {
                        $osp[2] = $osp[2]+1;
                        $score[2] = $score[2]+0.4;
                        $overt[$over] = 0.4;
                        $second2 = $second2 + $speed_time[$over];
                    }

                    elseif (($speed_max>=96) AND ($speed_max<104)) {
                        $osp[3]=$osp[3]+1;
                        $score[3]=$score[3]+0.6;
                        $overt[$over]=0.6;
                        $second3 = $second3 + $speed_time[$over];
                    }

                    elseif ($speed_max>=104) {
                        $osp[4]=$osp[4]+1;
                        $score[4]=$score[4]+0.8;
                        $overt[$over]=0.8;
                        $second4 = $second4 + $speed_time[$over];
                    }
                }

                if ($speed_max<81) {
                    $colorp[$over] = "m1.png";
                }
                elseif (($speed_max>=81) AND ($speed_max<88)) {
                    $colorp[$over] = "m2.png";
                }
                elseif (($speed_max>=88) AND ($speed_max<96)) {
                    $colorp[$over] = "m3.png";
                }
                elseif (($speed_max>=96) AND ($speed_max<104)) {
                    $colorp[$over] = "m4.png";
                }
                elseif ($speed_max>=104) {
                    $colorp[$over] = "m5.png";
                }

                $speed_str = 0;
                $speed_stp = 0;
                $speed_sec = 0;
                $speed_max = 0;
                $int_delT = 0;
                $intDmax = 0;
                $spdT1 = 0;
                $spdT2 = 0;
                $take = 0;
                $take2 = 0;
          
                $alt_sumE = 0;
                $alt_max = 0;
                $alt_min = 9999;
            }

            elseif (($speed_str==1) AND ($speed_stp==1) AND ($speed_sec<40)) {
                $speed_sec = 0;
                $speed_str = 0;
                $speed_stp = 0;
                $speed_sec = 0;
                $speed_max = 0;
                $int_delT = 0;
                $intDmax = 0;
                $spdT1 = 0;
                $spdT2 = 0;
                $take = 0;
                $take2 = 0;

                $alt_sumE = 0;
                $alt_max = 0;
                $alt_min = 9999;
            }

            if (($spd8>=81) AND ($spd8<88)) {
                $g[1] = $g[1]+1;
            }
            elseif (($spd8>=88) AND ($spd8<96)) {
                $g[2] = $g[2]+1;
            }
            elseif (($spd8>=96) AND ($spd8<104)) {
                $g[3] = $g[3]+1;
            }
            elseif ($spd8>=104) {
                $g[4] = $g[4]+1;
            }

            /* ###############====== dowsy detection  ========================================*/
            if ($bb>=2) {
                $delta_direct = $direct[$bb] - $direct[$bb-1];
            }

            if($bb != 1) {
                $delta_speed = abs($spd[$bb] - $spd[$bb - 1]); /* m/s */
                $avg_spd = abs($spd[$bb] + $spd[$bb - 1]) / 2 * (1000 / 3600);
            }
            else{
                $delta_speed = 0;
                $avg_spd = 0;
            }

            if (($delta_speed<=1) AND ($dowsy_start==0)) {         /* 1 km/hr */
                $dowsy_start=1;
                $spd1 = $spd[$bb];
                $ds_point1 = $bb;
                $dowsy_t1 = $sec;
                $dowsy_tj = $time;
                $dowsy_dis1 = $dis_sum;

                $lat_01D = $lat0;
                $lon_01D = $lon0;
            }

            elseif (($delta_speed<=1) AND ($dowsy_start==1)) {         /* 1 km/hr */
                $sum_dis_dw = $sum_dis_dw + ($sec_dow[$bb] * $avg_spd);

                if ($spd8>$speed_maxd) {
                    $speed_maxd = $spd8;
                    $point_maxd = $bb;
                }
           
                $int_speed = $int_speed + ($spd[$bb] - $spd[$bb-1]);
           
                $int_dirt = $int_dirt + $delta_direct;
                if ($int_dirt<-180) {
                    $int_dirt = $int_dirt + 360;
                }     /* Right turn and cross Q4-Q1.  */
                elseif ($int_dirt>180) {
                    $int_dirt = $int_dirt - 360;
                }     /* Left turn and cross Q1-Q4.  */
                $int_dirt = round($int_dirt,2);
            }

            elseif (($delta_speed>1) AND ($dowsy_start==1)){
                $nodawsy_cnt = $nodawsy_cnt+1;
                if ($nodawsy_cnt>=2) {
                    $nodawsy_cnt = 0;
                    $dowsy_stop=1;
                }
            }

            if (($dowsy_start==1) AND ($dowsy_stop==1)) {
                $dow_cnt = $bb-$ds_point1;
                $spd2 = ($v2+$spd1)/2;

                $time_div = $sec - $dowsy_t1;

                if (($dow_cnt>=60) AND ($spd2>=20) AND ($time_div>=300)) {
                    $dowsy_cnt = $dowsy_cnt+1;
                    $dowsy_point2[$dowsy_cnt] = $bb;
                    $dowsy_point1[$dowsy_cnt] = $ds_point1;
                    $dowsy_speed[$dowsy_cnt] =  round($avg_spd,2);

                    $dowsy_distance[$dowsy_cnt] = $dis_sum - $dowsy_dis1;

                    $dowsy_time[$dowsy_cnt] =  $sec - $dowsy_t1;
                    $dowsy_spdm[$dowsy_cnt] =  $speed_maxd;
                    $dowsy_intv[$dowsy_cnt] = $int_speed;
                    $dowsy_intd[$dowsy_cnt] = $int_dirt;
                    $dowsy_TT1[$dowsy_cnt] = $dowsy_tj;
                    $dowsy_TT2[$dowsy_cnt] = $time;

                    $latD1[$dowsy_cnt] = $lat_01D;
                    $lonD1[$dowsy_cnt] = $lon_01D;

                    $latDEn1[$dowsy_cnt] = $lat0;
                    $lonDEn1[$dowsy_cnt] = $lon0;

                    $unControl[$dowsy_cnt] = "dowsy";

                    $dowsyAltMax[$dowsy_cnt]= round($alt_sumE,2);
                }

                $dow_cnt = 0;
                $speedd_agv=0;
                $dowsy_start=0;
                $dowsy_stop=0;
                $sum_dis_dw=0;
                $speed_maxd=0;
                $int_speed=0;
                $int_dirt =0;
            }

            $lat1 = DMStoDECLn($lat0);
            $lon1 = DMStoDECLn($lon0);

            if (( $spd8<=10) AND ($lat1>=9.3128) AND ($lat1<=9.3528) AND ($lon1>=99.7238) AND ($lon1<=99.7638)) {
                $pointSea1 = $bb;
            }
            elseif (( $spd8<=10) AND ($lat1>=9.6885) AND ($lat1<=9.7285) AND ($lon1>=99.9641) AND ($lon1<=100.0041)) {
                $pointSea2 = $bb;
            }

            /* ================= Zero Speed Detection  ========================================*/

            if ($bb>=2) {
                $spd_dif = $spd[$bb] - $spd[$bb-1];

                if (abs($spd_dif)>20) {
                    $spd_dif = 0;
                }
     
                $int_spd_dif = $int_spd_dif + $spd_dif;

                if (($zero_start==0) AND ($zero_stop==0) AND ($spd[$bb]<=5)) {
                    $zero_start=1;
                    $zp1 = $sec_zero[$bb];
                    $zp_point1 = $bb;
                    $spd_dif0 = $spd[$bb];
                    $zpt1 = $timePP[$bb];

                    $latZ1 = DMStoDECLn($lat0);
                    $lonZ1 = DMStoDECLn($lon0);

                    $zero_max = 0;
                    $zero_min = 9999;
                }

                elseif (($zero_start==1) AND ($zero_stop==0) AND ($spd[$bb]>5)) {
                    $zero_stop =1;
                    $zp_point2 = $bb;
                    $zp2 = $sec_zero[$bb];
                    $zpt2 = $timePP[$bb];

                    $latZ2 = DMStoDECLn($lat0);
                    $lonZ2 = DMStoDECLn($lon0);
                }
       
                elseif (($zero_start==1) AND ($zero_stop==0) AND ($spd[$bb]<=5)) {
                    if ($spd[$bb]>=$zero_max) {
                        $zero_max = $spd[$bb];
                    }
                    if ($spd[$bb]<=$zero_min) {
                        $zero_min = $spd[$bb];
                    }
                    $zero_sec = $zero_sec + $sec_del7;
                }

                if (($zero_start==1) AND ($zero_stop==1)) {
                    $zero_intT =  $zp2 - $zp1;
         
                    if ($zero_intT>=20) {
                        $zero_bus_cnt = $zero_bus_cnt+1;

                        $zero_bus_time[$zero_bus_cnt] = $zero_intT;
                        $zero_bus_point1[$zero_bus_cnt] = $zp_point1;
                        $zero_bus_point2[$zero_bus_cnt] = $zp_point2;

                        $zero_latB[$zero_bus_cnt] = $latZ1;
                        $zero_lonB[$zero_bus_cnt] = $lonZ1;

                        $zero_latE[$zero_bus_cnt] = $latZ2;
                        $zero_lonE[$zero_bus_cnt] = $lonZ2;

                        $zero_type[$zero_bus_cnt] = "Bus Stop";
                        $zero_vmax[$zero_bus_cnt] = $zero_max;
                        $zero_vmin[$zero_bus_cnt] = $zero_min;

                        $zeroT1[$zero_bus_cnt] = $zpt1;
                        $zeroT2[$zero_bus_cnt] = $zpt2;

                        $zero_secz[$zero_bus_cnt] = $zero_sec;
                    }
           
                    $zero_sec = 0;
                    $zero_max = 0;
                    $zero_min = 9999;
                    $zero_intT = 0;
                    $zero_start = 0;
                    $zero_stop = 0;
                    $int_spd_dif = 0;
                }
            } /* ======== End of zero speed ================================*/
        }   /* End if 1 */
    }   /* End for */

    /* ========= Speed Type Detection============================================= */
    for ($bb=1; $bb<=$over; $bb++) {
        if ((abs($intDmax7[$bb])>=12) AND (abs($diff_dir[$bb])<=12) AND ($spdT7[$bb]<40) AND (abs($altMaxi[$bb])<20)) {
            $spdType[$bb] = 1;
            $type1 = $type1 + 1;
        }
        elseif ((abs($intDmax7[$bb])>=12) AND (abs($diff_dir[$bb])<=12) AND ($spdT7[$bb]<40) AND (abs($altMaxi[$bb])>=20)) {
            $spdType[$bb] = 4;
            $type4 = $type4+1;
        }
        elseif ((abs($intDmax7[$bb])>=12) AND (abs($diff_dir[$bb])>12) AND (abs($altMaxi[$bb])<20)) {
            $spdType[$bb] = 2;
            $type2 = $type2+1;
        }
        elseif ((abs($intDmax7[$bb])>=12) AND (abs($diff_dir[$bb])>12) AND (abs($altMaxi[$bb])>=20)) {
            $spdType[$bb] = 5;
            $type5 = $type5+1;
        }
        elseif ((abs($intDmax7[$bb])>=12) AND (abs($diff_dir[$bb])<=12)) {
            $spdType[$bb] = 3;
            $type3 = $type3+1;
        }
        else {
            if (abs($altMaxi[$bb])<20)  {
                $spdType[$bb] = 0;
                $type0 = $type0+1;
            }
            elseif (abs($altMaxi[$bb])>=20) {
                $spdType[$bb] = 6;
                $type6 = $type6+1;
            }
        }

        if (($lat_max[$bb]>=13.84) AND ($lat_max[$bb]<14.07)) {
            $spdZone[$bb] = "z01";
        }
        elseif (($lat_max[$bb]>=14.07) AND ($lat_max[$bb]<14.47)) {
            $spdZone[$bb] = "z02";
        }
        elseif (($lat_max[$bb]>=14.47) AND ($lat_max[$bb]<14.61)) {
            $spdZone[$bb] = "z03";
        }
        elseif (($lat_max[$bb]>=14.61) AND ($lat_max[$bb]<14.64)) {
            $spdZone[$bb] = "z04";
        }
        elseif (($lat_max[$bb]>=14.64) AND ($lat_max[$bb]<14.73)) {
            $spdZone[$bb] = "z05";
        }
        elseif (($lat_max[$bb]>=14.73) AND ($lat_max[$bb]<14.86)) {
            $spdZone[$bb] = "z06";
        }
        elseif (($lat_max[$bb]>=14.86) AND ($lat_max[$bb]<14.95)) {
            $spdZone[$bb] = "z07";
        }
        elseif (($lat_max[$bb]>=14.95) AND ($lat_max[$bb]<14.98)) {
            $spdZone[$bb] = "z08";
        }
        else {
            $spdZone[$bb] = "z00";
        }
    }

    /* ================= Zoning Speed Detection  ====================================*/

    $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
    mysql_select_db(DB_NAME, $db);
    $exe2 = "SELECT latitude,longitude,colorD,colorDF,type FROM `dangerous`";
    $result2 = mysql_query($exe2)or die(mysql_error());
    $dan_rows = mysql_numrows($result2);

    $latD = array();
    $lonD = array();
    $latOffset = 0.0015;
    $lonOffset = 0.0017;

    $i = 0;
    while(list($Dlat,$Dlon,$colorD,$colorDF,$Dtype) = mysql_fetch_row($result2)){
        $latD[$i] = $Dlat;
        $lonD[$i] = $Dlon;
        $Dtype2[$i] = $Dtype;
        $i = $i+1;
    }
  
    $mark = 0;
    $start_zone = 0;
    $stop_zone = 0;
    $spd_zoning = 0;
    $spd_zone_cnt = 0;
    $delta_spd_min = 999;
  
    for ($n=0; $n<($dan_rows); $n++) {
        $lon_Lz[$n] = $lonD[$n] + 0.0015;
        $lon_Rz[$n] = $lonD[$n] - 0.0015;
        $lat_Lz[$n] = $latD[$n] + 0.0012;
        $lat_Rz[$n] = $latD[$n] - 0.0012;
        $typez[$n] = $Dtype2[$n];
    }
  
    $int_delta = 0;
    $sec0 = 0;
    $int_speed = 0;
    $int_dist = 0;
    $stop_bus_cnt = 0;

    for ($i=1; $i<$num_rows; $i++) {

        $time0 = $time_i[$i];
        $lat0 = $lat_i[$i];
        $lon0 = $lon_i[$i];
        $spd0 = $speed_i[$i];
        $dir0 = $dir_i[$i];

        $delta_spd = $speed_i[$i]-$speed_i[$i-1];
        $delta_dir = $dir_i[$i]-$dir_i[$i-1];
        if ($delta_dir<-180) {
            $delta_dir = $delta_dir + 360;
        }     /* Right turn and cross Q4-Q1.  */
        elseif ($delta_dir>180) {
            $delta_dir = $delta_dir - 360;
        }     /* Left turn and cross Q1-Q4.  */
        $delta_dir = round($delta_dir,2);

        $lat1 = DMStoDECLn($lat0);
        $lon1 = DMStoDECLn($lon0);

        $time_s = explode(":", $time0);
        $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
        $sec_del8 = $sec-$sec0;
        $sec0 = $sec;

        $dis7 = $spd0*$sec_del8*(1/3600);
      
        /* ---------------------------------------- */
        if (($start_zone==0) AND ($stop_zone==0)) {
            for ($n=0; $n<($dan_rows); $n++) {
                if (($lon1>=$lon_Rz[$n]) AND ($lon1<=$lon_Lz[$n]) AND ($lat1>=$lat_Rz[$n]) AND ($lat1<=$lat_Lz[$n]) AND (($typez[$n]==1) OR ($typez[$n]==2) OR ($typez[$n]==3) OR ($typez[$n]==4) OR ($typez[$n]==5))) {
                    $mark = $n;
                    $start_zone = 1;
                    $type_k = $typez[$n];
                    $zpoint  = $i;
                    $tttime  = $time0;
                    $zoneTime1 = $sec_del8;

                    $int_delta = $int_delta + $delta_dir;
                    $int_speed = $int_speed + $delta_spd;
                    $int_dist = $int_dist + $dis7;
                    $n = $dan_rows;      /* Clear $n*/

                    $lat_Z1 = $lat0;
                    $lon_Z1 = $lon0;
                }
            }
        }   /* End of Start zone */
  
        /* ---------------------------------------- */
        if (($start_zone==1) AND ($stop_zone==0)) {
            if ($delta_spd<=$delta_spd_min) {
                $delta_spd_min = $delta_spd;
            }
            if (($lon1<$lon_Rz[$mark]) OR ($lon1>$lon_Lz[$mark]) OR ($lat1<$lat_Rz[$mark]) OR ($lat1>$lat_Lz[$mark])) {
                $stop_zone=1;
            }
        }

        if (($start_zone==1) AND ($stop_zone==1)) {
            if (($delta_spd_min>=-20) AND ($spd0>=40) AND ($i>=15)){
                $time_s = explode(":", $tttime);
                $sec4 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

                $disz = round($int_dist,6);

                $spd_zone_cnt = $spd_zone_cnt+1;
                $un2 = $spd_zone_cnt + $dowsy_cnt;
                $unControl[$un2] = "zoning";
                $dowsy_spdm[$un2] = $spd0;
                $dowsy_point1[$un2] = $zpoint;
                $dowsy_point2[$un2] = $i;
                $dowsy_intd[$un2] =  round($int_delta,2);
                $dowsy_time[$un2] =  $sec-$sec4;
                $dowsy_TT1[$un2] = $tttime;
                $dowsy_TT2[$un2] = $time0;
                $dowsy_intv[$un2] = round($int_speed,2);
                $dowsy_distance[$un2]= abs($disz);

                /*  $latZ1[$un2] = $lat_Z1;
                $lonZ1[$un2] = $lon_Z1;   */

                $latZ1En[$un2] = $lat0;
                $lonZ1En[$un2] = $lon0;

                if (($time>="14:00:00") AND ($time<="16:00:00")) {
                    $primtime[$spd_zone_cnt] = 1;
                }
                else {
                    $primtime[$spd_zone_cnt] = 0;
                }

                $delta_spd_min = 999;
            }

            $start_zone = 0;
            $stop_zone = 0;
            $int_delta = 0;
            $int_speed = 0;
            $int_dist = 0;
        }

        /* ============= GPS Lose Detection ================= */

        if ($sec_del8>=300) {
            $stop_bus_cnt = $stop_bus_cnt+1;
            $spd_dif = $spd[$bb] - $spd[$bb-1];

            $stop_bus_time[$stop_bus_cnt] = $sec_del8;
            $stop_bus_point1[$stop_bus_cnt] = $i-1;
            $stop_bus_point2[$stop_bus_cnt] = $i;

            $stop_bus_speed[$stop_bus_cnt] = $delta_spd;
            $stop_bus_T1[$stop_bus_cnt] = $zero_intT;

            $latGPS1[$stop_bus_cnt] = DMStoDECLn($lat_i[$i-1]);
            $lonGPS1[$stop_bus_cnt] = DMStoDECLn($lon_i[$i-1]);

            $latGPS2[$stop_bus_cnt] = DMStoDECLn($lat_i[$i]);
            $lonGPS2[$stop_bus_cnt] = DMStoDECLn($lon_i[$i]);
        }

    /* ----------End of $i = num_rows----------------------- */
    }
  
    /* =========================================================== */
    $score2 = $score[1]+$score[2]+$score[3]+$score[4];

    $score2_1 = $score[1];
    $score2_2 = $score[2];
    $score2_3 = $score[3];
    $score2_4 = $score[4];

    $osp1 = $osp[1];
    $osp2 = $osp[2];
    $osp3 = $osp[3];
    $osp4 = $osp[4];
    ?>

</body>
</html>



