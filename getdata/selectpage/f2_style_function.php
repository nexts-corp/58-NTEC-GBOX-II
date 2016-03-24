<HTML>
<HEAD>
    <TITLE> Driving Style function </TITLE>
</HEAD>
<BODY>
<?php

$totalL2 = ($spd_zone_cnt + $cross_cnt3 + $stop_cnt2 + $tstop_cnt2 + $nstop_cnt2) /10;  /* zone score */

$totalL = $total2 + $total3;                                                           /* Turn score */
$totlescore = $score2 + $acc_num_1 + $totalL + $totalL2;                               /* Total score */

/* ----------- Normalize 100 km In Route (average) --------------------------- */

if ($dis_a<>0) {

    $speed_max100 = round ((($spdMaxR/$dis_a)*100),2);
    $speed_avg100 = round ((($spd_SA/$dis_a)*100),2);

    $acc_max100 = round ((($accMax/$dis_a)*100),2);
    $acc_avg100 = round ((($acc_SA/$dis_a)*100),2);

    $turn_max100 = round ((($turnMax/$dis_a)*100),2);
    $turn_avg100 = round ((($turn_SA/$dis_a)*100),2);

    $zone_max100 = round ((($zoneMax/$dis_a)*10),2);
    $zone_avg100 = round ((($zone_SA/$dis_a)*10),2);

    $total_max100 = round ((($scoreMax/$dis_a)*100),2);

    $total_avg100 = round ((($score_SA/$dis_a)*100),2);

}

/* ----------- Normalize 100 km In case ------------------------------------- */

if ($dis_sum_km<>0) {

    $speed_100 = round ((($score2/$dis_sum_km)*100),2);
    $acc_100 = round ((($acc_num_1/$dis_sum_km)*100),2);
    $turn_100 = round ((($totalL/$dis_sum_km)*100),2);

    $zone_100 = round ((($totalL2/$dis_sum_km)*100),2);

    $total_100 = round ((($totlescore/$dis_sum_km)*100),2);

}

/* ----------- Normalize 100 % by Average (Average = 100) ------------------ */

$speed100A = 100;   $acc100A = 100;     $turn100A = 100;   $zone100A = 100;    $total100A = 100;

if ($speed_avg100<>0) { $spdNrm   = (100/$speed_avg100) * $speed_100 ;      }
if ($acc_avg100<>0)   { $accNrm   = (100/$acc_avg100) * $acc_100 ;   }
if ($turn_avg100<>0)  { $turnNrm  = (100/$turn_avg100) * $turn_100 ;    }
if ($zone_avg100<>0)  { $zoneNrm  = (100/$zone_avg100) * $zone_100 ;    }
if ($total_avg100<>0) { $totalNrm = (100/$total_avg100) * $total_100 ;    }

/* -------------------------------------------------------------------------- */

if ($speed_max100!=0) {$speed_score =  ($speed_100 / $speed_max100) * 100;     }
$speed_score = round($speed_score,2);

$score_difV = $speed_100 - $speed_avg100;
if     ($score_difV>0)  {$diffG_V = ">";}
elseif ($score_difV==0) {$diffG_V = "=";}
elseif ($score_difV<0)  {$diffG_V = "<";}


$score_difA = $acc_num_1 - $acc_SA;
if     ($score_difA>0) {$diffG_A = ">";}
elseif ($score_difA==0) {$diffG_A = "=";}
elseif ($score_difA<0) {$diffG_A = "<";}

$score_difT = $totalL - $turn_SA;
if ($score_difT>0) {$diffG = ">";}
elseif ($score_difT==0) {$diffG = "=";}
elseif ($score_difT<0) {$diffG = "<";}

$score_difTo = $totlescore - $score_SA;
if ($score_difTo>0)      {$diffG_To = ">";}
elseif ($score_difTo==0) {$diffG_To = "=";}
elseif ($score_difTo<0)  {$diffG_To = "<";}

/* ---------------- Speed Style ---------------------- */

for ($i=1; $i<=60; $i++) { $ST[$i] = 0; }

for ($i=1; $i<=$over; $i++) {

    if     ($spdType[$i]==1) {$tp3 = $tp3+1; }
    elseif ($spdType[$i]==2) {$tp2 = $tp2+1; }
    elseif ($spdType[$i]==0) {$tp1 = $tp1+1; }
    else                     {$typeSJ[$i] = "Other";}

    if (($spd_max[$i]>=81) AND ($spd_max[$i]<88)) {

        $pt4 = $pt4+1;
        $dura4 = $dura4+$speed_time[$i];
        $dis4 = $dis4+$speed_dis[$i];

        if     ($spdType[$i]==1) {$ST[1] = $ST[1]+1; }
        elseif ($spdType[$i]==2) {$ST[2] = $ST[2]+1; }
        elseif ($spdType[$i]==0) {$ST[0] = $ST[0]+1; }
        elseif ($spdType[$i]==4) {$ST[4] = $ST[4]+1; }
        elseif ($spdType[$i]==5) {$ST[5] = $ST[5]+1; }
        elseif ($spdType[$i]==6) {$ST[6] = $ST[6]+1; }
        else {$pt4_0 = $pt4_0+1; }

    }

    elseif (($spd_max[$i]>=88) AND ($spd_max[$i]<96)) {

        $pt3 = $pt3+1;
        $dura3 = $dura3+$speed_time[$i];
        $dis3 = $dis3+$speed_dis[$i];

        if     ($spdType[$i]==1) {$ST[8] = $ST[8]+1; }
        elseif ($spdType[$i]==2) {$ST[9] = $ST[9]+1; }
        elseif ($spdType[$i]==0) {$ST[7] = $ST[7]+1; }
        elseif ($spdType[$i]==4) {$ST[10] = $ST[10]+1; }
        elseif ($spdType[$i]==5) {$ST[11] = $ST[11]+1; }
        elseif ($spdType[$i]==6) {$ST[12] = $ST[12]+1; }
        else {$pt3_0 = $pt3_0+1;;} }

    elseif (($spd_max[$i]>=96) AND ($spd_max[$i]<104)) {

        $pt2 = $pt2+1;
        $dura2 = $dura2+$speed_time[$i];
        $dis2 = $dis2+$speed_dis[$i];

        if     ($spdType[$i]==1) {$ST[14] = $ST[14]+1; }
        elseif ($spdType[$i]==2) {$ST[15] = $ST[15]+1; }
        elseif ($spdType[$i]==0) {$ST[13] = $ST[13]+1; }
        elseif ($spdType[$i]==4) {$ST[16] = $ST[16]+1; }
        elseif ($spdType[$i]==5) {$ST[17] = $ST[17]+1; }
        elseif ($spdType[$i]==6) {$ST[18] = $ST[18]+1; }
        else {$pt2_0 = $pt2_0+1;} }

    elseif ($spd_max[$i]>=104) {
        $dura1 = $dura1+$speed_time[$i];
        $dis11 = $dis11+$speed_dis[$i];
        $pt1 = $pt1+1;

        if ($spdType[$i]==1)     {$ST[20] = $ST[20]+1; }
        elseif ($spdType[$i]==2) {$ST[21] = $ST[21]+1; }
        elseif ($spdType[$i]==0) {$ST[19] = $ST[19]+1; }
        elseif ($spdType[$i]==4) {$ST[22] = $ST[22]+1; }
        elseif ($spdType[$i]==5) {$ST[23] = $ST[23]+1; }
        elseif ($spdType[$i]==6) {$ST[24] = $ST[24]+1; }

        else {$pt1_0 = $pt1_0+1;} }
}

for ($i=1; $i<=60; $i++) {
    if ($ST[$i]>=$ST_max) { $ST_i = $i; $ST_max = $ST[$i]; }
}

$sp_level = $ST_max;
$sp_type = $ST_i;

switch ($ST_i) {

    case 0 : $sp = "ปานกลาง"; $typ = "ทางตรง"; break;
    case 1 : $sp = "ปานกลาง"; $typ = "เปลี่ยนเลน"; break;
    case 2 : $sp = "ปานกลาง"; $typ = "ทางโค้ง "; break;
    case 4 : $sp = "ปานกลาง"; $typ = "เปลี่ยนเลน ทางชัน"; break;
    case 5 : $sp = "ปานกลาง"; $typ = "ทางโค้ง ทางชัน"; break;
    case 6 : $sp = "ปานกลาง"; $typ = "ทางตรง ทางชัน"; break;

    case 7 :  $sp = "อย่างสูง";  $typ = "ทางตรง"; break;
    case 8 :  $sp = "อย่างสูง";  $typ = "เปลี่ยนเลน"; break;
    case 9 :  $sp = "อย่างสูง";  $typ = "ทางโค้ง "; break;
    case 10 : $sp = "อย่างสูง";  $typ = "เปลี่ยนเลน ทางชัน"; break;
    case 11 : $sp = "อย่างสูง";  $typ = "ทางโค้ง ทางชัน"; break;
    case 12 : $sp = "อย่างสูง;"; $typ = "ทางตรง ทางชัน"; break;

    case 13 : $sp = "อย่างสูงมาก"; $typ = "ทางตรง"; break;
    case 14 : $sp = "อย่างสูงมาก"; $typ = "เปลี่ยนเลน"; break;
    case 15 : $sp = "อย่างสูงมาก"; $typ = "ทางโค้ง"; break;
    case 16 : $sp = "อย่างสูงมาก"; $typ = "เปลี่ยนเลน ทางชัน"; break;
    case 17 : $sp = "อย่างสูงมาก"; $typ = "ทางโค้ง ทางชัน"; break;
    case 18 : $sp = "อย่างสูงมาก"; $typ = "ทางตรง ทางชัน"; break;

    case 19 : $sp = "อย่างสูงยิ่งยวด"; $typ = "ทางตรง"; break;
    case 20 : $sp = "อย่างสูงยิ่งยวด"; $typ = "เปลี่ยนเลน"; break;
    case 21 : $sp = "อย่างสูงยิ่งยวด"; $typ = "ทางโค้ง"; break;
    case 22 : $sp = "อย่างสูงยิ่งยวด"; $typ = "เปลี่ยนเลน ทางชัน"; break;
    case 23 : $sp = "อย่างสูงยิ่งยวด"; $typ = "ทางโค้ง ทางชัน"; break;
    case 24 : $sp = "อย่างสูงยิ่งยวด"; $typ = "ทางตรง ทางชัน"; break; }

/* ---------------- Acc Style ---------------------- */

$type_max =0;
$typeA[0] = $typeNum01+$typeNum02+$gpsl;
$typeA[1] = $typeNum11+$typeNum12+$typeNum13;
$typeA[2] = $typeNum21+$typeNum22+$typeNum23+$typeNum24+$typeNum25+$typeNum26;
$typeA[3] = $typeNum31+$typeNum32+$typeNum33+$typeNum34+$typeNum35+$typeNum36;
$typeA[4] = $typeNum41+$typeNum42+$typeNum43+$typeNum44+$typeNum45+$typeNum46;
$typeA[5] = $typeNum01;
$typeA[6] = $typeNum02;

for ($i=1; $i<=6; $i++) {
    if ( ($typeA[$i])>($type_max) ) {
        $type_max = $typeA[$i]; $max = $i;                   ; /* maximum of Acc Type */
    }
}

$acc_level = $max;
$acc_type = $type_max;

switch ($max) {

    case 0 : $ac = "&#3626;&#3656;&#3634;&#3618;&#3652;&#3611;&#3617;&#3634;"; break;

    case 1 : $ac = "การออกตัว";                                     /* Release type */
        $typeA1[1]=$typeNum11; $typeA1[2]=$typeNum12; $typeA1[3]=$typeNum13; $max2 = 1;

        for ($i=2; $i<=3; $i++) {
            if ($typeA1[$i]> $type_max2) {$type_max2 = $typeA1[$i]; $max2 = $i;}
        }
        break;

    case 2 : $ac = "การแซง";                                    /* Overtake type */
        $typeA2[1]=$typeNum21; $typeA2[2]=$typeNum22; $typeA2[3]=$typeNum23;
        $typeA2[4]=$typeNum24; $typeA2[5]=$typeNum25; $typeA2[6]=$typeNum26; $max2 = 1;

        for ($i=2; $i<=6; $i++) {
            if ($typeA2[$i]> $type_max2) {
                $type_max2 = $typeA2[$i]; $max2 = $i;}
        }
        break;

    case 3 : $ac = "กระชั้นชิด";                                      /*Close to type */
        $typeA3[1]=$typeNum31; $typeA3[2]=$typeNum32; $typeA3[3]=$typeNum33; $typeA3[4]=$typeNum34;
        $typeA3[5]=$typeNum35; $typeA3[6]=$typeNum36; $max2 = 1;

        for ($i=2; $i<=6; $i++) {
            if ($typeA3[$i]>$type_max2) {
                $type_max2 = $typeA3[$i]; $max2 = $i;
            }
        }
        break;

    case 4 : $ac = "การจอด";                                           /*Stop type */
        $typeA4[1]=$typeNum41; $typeA4[2]=$typeNum42; $typeA4[3]=$typeNum43;
        $typeA4[4]=$typeNum44; $typeA4[5]=$typeNum45; $max2 = 1;

        for ($i=2; $i<=4; $i++) {
            if ($typeA4[$i]>= $type_max2) {
                $type_max2 = $typeA4[$i]; $max2 = $i;
            }
        }
        break;

    case 5 : $ac = "ส่ายไปมา";                                        /*Slalom type */
        $typeA5[1]=$typeNum011; $typeA5[2]=$typeNum012; $max2 = 1;
        $type_max1 = $typeA5[1];

        if ($typeA5[2]>= $type_max2) {
            $type_max2 = $typeA5[2]; $max2 = 2;
        }
        break;

    case 6 : $ac = "การชะลอรถ";                                       /*Walking type */
        $typeA6[1]=$typeNum021; $typeA6[2]=$typeNum022;
        $max2 = 1; $type_max1 = $typeA6[1];

        if ($typeA6[2]>= $type_max2) {
            $type_max2 = $typeA6[2]; $max2 = 2;
        }
        break; }

/* Max2 into Type */
if ($max==1) {
    switch ($max2) {
        case 1 : $acp = "ให้มากขึ้น"; break;
        case 2 : $acp = "ให้มากในทางโค้ง"; break;
        case 3 : $acp = "การส่ายไปมา"; break;
    }
}

if ($max==2) {
    switch ($max2) {
        case 1 : $acp = "ให้มากขึ้น"; break;
        case 2 : $acp = "การส่ายไปมา"; break;
        case 3 : $acp = "มากอย่างยิ่ง"; break;
        case 4 : $acp = "ให้มากขึ้นในทางโค้ง"; break;
        case 5 : $acp = "ในทางโค้ง"; break;
        case 6 : $acp = "การแซงซ้าย"; break;
    }
}

if ($max==3) {
    switch ($max2) {
        case 1 : $acp = "ให้มากขึ้น"; break;
        case 2 : $acp = "ให้มากอย่างยิ่ง"; break;
        case 3 : $acp = "ให้มากในทางโค้ง"; break;
        case 4 : $acp = "การส่ายไปมา"; break;
        case 5 : $acp = "การส่ายไปมาในทางโค้ง"; break;
        case 6 : $acp = "อย่างยิ่งยวด"; break;
    }
}

if ($max==4) {
    switch ($max2) {
        case 1 : $acp = "ให้มากขึ้น"; break;
        case 2 : $acp = "ให้มากในทางโค้ง"; break;
        case 3 : $acp = "แบบส่ายไปมา"; break;
        case 4 : $acp = "อย่างรุนแรง"; break;
        case 5 : $acp = "การเข้าจอดซ้าย"; break;
    }
}

if ($max==5) {
    switch ($max2) {
        case 1 : $acp = "ให้มากอย่างยิ่ง"; break;
        case 2 : $acp = "ให้มาก"; break;
    }
}

if ($max==6) {
    switch ($max2) {
        case 1 : $acp = "ส่ายไปมา"; break;
        case 2 : $acp = "ให้มากขึ้น"; break;
    }
}

/* ---------------- Turn Style ---------------------- */

$type_max =0;
$typeA[1] = $LTotal;
$typeA[2] = $RTotal;
$typeA[3] = $CTotalL;
$typeA[4] = $CTotalR;
$typeA[5] = $CTotalS;
$typeA[6] = $UTotal;

for ($i=1; $i<=6; $i++) {
    if ( ($typeA[$i])>($type_max) ) {
        $type_max = $typeA[$i]; $max = $i;
    }
}

$turn_level = $max;
$turn_type = $type_max;

switch ($max) {
    case 0 : $tp = "&#3626;&#3656;&#3634;&#3618;&#3652;&#3611;&#3617;&#3634;"; break;
    case 1 : $tp = "การเลี้ยวทางซ้าย"; break;
    case 2 : $tp = "การเลี้ยวทางขวา"; break;
    case 3 : $tp = "การเข้าโค้งทางซ้าย"; break;
    case 4 : $tp = "การเข้าโค้งทางขวา"; break;
    case 5 : $tp = "การเข้าโค้งตัวเอส"; break;
    case 6 : $tp = "การกลับรถ"; break; }

for ($i=1; $i<=$stp_point_cnt; $i++) {
    if (($SpeedMax>=81) AND ($SpeedMax<88) )     {$vt[1] = $vt[1]+1;}
    elseif (($SpeedMax>=88) AND ($SpeedMax<96) ) {$vt[2] = $vt[2]+1;}
    elseif (($SpeedMax>=96) AND ($SpeedMax<104)) {$vt[3] = $vt[3]+1;}
    elseif ($SpeedMax>=104) {$vt[4] = $vt[4]+1;}
}
for ($i=1; $i<=4; $i++) {
    if ( $vt[$i] > $vtmax ) {$vtmax=$vt[$i]; $vtmaxi = $i;}
}

switch ($vtmaxi) {
    case 1 : $tnp = "สูงปานกลาง"; break;
    case 2 : $tnp = "สูงมาก"; break;
    case 3 : $tnp = "สูงมากยิ่ง"; break;
    case 4 : $tnp = "อันตรายมาก"; break;
}

/*  $db = mysqli_connect("localhost","tatanad","tata789") or die("Error Connect to Database");
  $objDB = mysqli_select_db("thairoadsafety");

  $strSQL = "DELETE FROM  `drivername` WHERE  `name` = '$DName' AND  `route`  =  '$tripdir' AND  `date` =  '$Date1'
             AND  `time1` =  '$TimeBegin'  ;  ";
  $objQuery = mysqli_query($strSQL);
  
  $strSQL = "INSERT INTO `drivername` (`test` ,`name` ,`route` ,`date` ,`time1` ,`time2` ,`splevel` ,`sptype` ,`acclevel` ,`acctype` ,
                                       `turnlevel` ,`turntype` ,`total`,`distance`,`v_score` ,`a_score`,`t_score` )
                                       
             VALUES ('$testn', '$DName', '$tripdir','$Date1','$TimeBegin','$TimeEnd','$sp_level','$sp_type','$acc_level','$acc_type',
                        '$turn_level','$turn_type','$total_100','$dis_sum_km','$speed_100','$acc_100','$turn_100' );";

  $objQuery = mysqli_query($strSQL);
*/
if ($total_max100<>0) { $total_scr = round((($total_100/$total_max100) *100),2); }
if ($speed_max100<>0) { $speed_scr = round((($speed_100/$speed_max100) *100),2); }
if ($acc_max100<>0)   { $acc_scr = round((($acc_100/$acc_max100) *100),2);  }
if ($turn_max100<>0)  { $turn_scr = round((($turn_100/$turn_max100) *100),2);  }

if     ($total_scr<=40) { $zero_cm = "ยอดเยี่ยม";  $zero_bm = "แต่เราคิดว่า คุณยังสามารถเพิ่มระดับความปลอดภัยได้อีก";}
elseif ( ($total_scr>40) AND ($total_scr<=60) ) { $zero_cm = "ดีมาก"; $zero_bm = "คุณยังสามารถเพิ่มระดับความปลอดภัยได้อีก"; }
elseif ( ($total_scr>60) AND ($total_scr<=80) ) { $zero_cm = "พอใช้ได้"; $zero_bm = "คุณจะสามารถเพิ่มระดับความปลอดภัยได้ เมื่อให้ความสำคัญกับสิ่งนี้"; }


elseif ($total_scr>80) { $zero_cm = "ค่อนข้างแย่";  $zero_bm = "บางทีคุณอาจจะต้องให้ความสำคัญกับคำแนะนำนี้";}

if ( ($turn_scr > $speed_scr) AND ($turn_scr > $acc_scr) ) {

    $firt_cm1 = "โปรดเพิ่มความระมัดระวัง $tp";
    $firt_cm2 = "ในระดับ $tnp";

    $danger = "$tp:$tnp";

    if  ($acc_scr > $speed_scr)  {
        $second_cm1 = "โปรดเพิ่มความระมัดระวัง การเร่ง $acp";
        $second_cm2 = "ในระดับ $ac";
        $third_cm1 = "โปรดเพิ่มความระมัดระวัง การใช้ความเร็ว $sp";
        $third_cm2 = "ในช่วง $typ";
    }

    elseif  ($speed_scr > $acc_scr)  {
        $third_cm1 = "โปรดเพิ่มความระมัดระวัง การเร่ง $acp";
        $third_cm2 = "ในระดับ $ac";

        $second_cm1 = "โปรดเพิ่มความระมัดระวัง การใช้ความเร็ว $sp";
        $second_cm2 = "ในระดับ $typ";

    }

}

elseif ( ($acc_scr > $speed_scr) AND ($acc_scr > $turn_scr) ) {

    $firt_cm1 = "โปรดเพิ่มความระมัดระวัง การเร่ง $acp";
    $firt_cm2 = "ในระดับ $ac";
    $danger = "$acp:$ac";

    if  ($turn_scr > $speed_scr)  {
        $second_cm1 = "โปรดเพิ่มความระมัดระวัง $tp";
        $second_cm2 = "ในระดับ $tnp";
        $third_cm1 = "โปรดเพิ่มความระมัดระวัง การใช้ความเร็ว $sp";
        $third_cm2 = "ในช่วง $typ";
    }

    elseif  ($speed_scr > $turn_scr)  {
        $second_cm1 = "โปรดเพิ่มความระมัดระวัง การใช้ความเร็ว $sp";
        $second_cm2 = "ในระดับ $typ";
        $third_cm1 = "โปรดเพิ่มความระมัดระวัง $tp";
        $third_cm2 = "ในระดับ $tnp";

    }

}

elseif ( ($speed_scr > $turn_scr) AND ($speed_scr > $acc_scr) ) {

    $firt_cm1 = "โปรดเพิ่มความระมัดระวัง การใช้ความเร็ว $sp";
    $firt_cm2 = "ในช่วง $typ";
    $danger = "$sp:$typ";

    if  ($turn_scr > $acc_scr)  {
        $second_cm1 = "โปรดเพิ่มความระมัดระวัง $tp";
        $second_cm2 = "ในระดับ $tnp";
        $third_cm1 = "โปรดเพิ่มความระมัดระวัง การเร่ง $acp";
        $third_cm2 = "ในระดับ $ac";
    }

    elseif  ($acc_scr > $turn_scr)  {
        $second_cm1 = "โปรดเพิ่มความระมัดระวัง การเร่ง $acp";
        $second_cm2 = "ในระดับ $ac";
        $third_cm1 = "โปรดเพิ่มความระมัดระวัง $tp";
        $third_cm2 = "ในระดับ $tnp";

    }

}

$db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
$objDB = mysqli_select_db(DB_NAME);
mysqli_query("SET NAMES 'utf8'");

$strSQL = "DELETE FROM  `drivername` WHERE  `name` = '$DName' AND  `route`  =  '$tripdir' AND  `date` =  '$Date1'
             AND  `time1` =  '$TimeBegin'  ;  ";
$objQuery = mysqli_query($strSQL);

$strSQL = "INSERT INTO `drivername` (`test` ,`name` ,`route` ,`date` ,`time1` ,`time2` ,`splevel` ,`sptype` ,`acclevel` ,`acctype` ,
                                       `turnlevel` ,`turntype` ,`total`,`distance`,`v_score` ,`a_score`,`t_score`,`danger` )

             VALUES ('$testn', '$DName', '$tripdir','$Date1','$TimeBegin','$TimeEnd','$sp_level','$sp_type','$acc_level','$acc_type',
                        '$turn_level','$turn_type','$total_100','$dis_sum_km','$speed_100','$acc_100','$turn_100','$danger' );";

$objQuery = mysqli_query($strSQL);


?>
</BODY>
</HTML>
