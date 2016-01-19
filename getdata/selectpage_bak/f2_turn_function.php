<HTML>
<HEAD>
 <TITLE> New Document</TITLE>
<meta http-equiv="Content-Language" content="th">
<meta http-equiv="content-Type" content="text/html; charset=window-874">
<meta http-equiv="content-Type" content="text/html; charset=tis-620">

</HEAD>
<BODY>
<?php

    $maxSpeed=0;
    $distance=0; $direction0=0;

    $RA_total=0; $RB_total=0; $RC_total=0; $RD_total=0;
    $LA_total=0; $LB_total=0; $LC_total=0; $LD_total=0;
    $RCA_total=0; $LCB_total=0; $SCA_total=0; $SCB_total=0;

    $RTurnA=0; $RcountA=0; $LTurnA=0; $LcountA=0;
    $RTurnB=0; $RcountB=0; $LTurnB=0; $LcountB=0;
    $RTurnC=0; $RcountC=0; $LTurnC=0; $LcountC=0;
    $RTurnD=0; $RcountD=0; $LTurnD=0; $LcountD=0;
    $UcountA =0;  $dirA=0;
    $sum_distance=0;
    $delta_distance=0;
    $dir_A=0; $dir_B=0; $dir_C=0;  $dir_D=0;
    $startA=0; $startB=0;   $startC=0;  $startD=0;
    $sum_theta=0;     $del_theta=0;  $rst_start=0;
    $stopC=0; $Cstop=0;
    $CcountRB=0; $CcountSA=0; $CcountSB=0; $DstopCnt=0;
    $maxD = 0;   $maxtheta0=0; $max_theta=0;  $max_o=0;     $max_theta_gap=0;
    $int_diff2 = 0;
    $diff2=0;  $Ddir=555;      $Dstop=0;   $D2cnt=0;
   $tata=0;         $speed_max=0;
   $Ddir0=0;   $accAltmax=0;
   
     $total1 = 0;
     $total2 = 0;
     $total3 = 0;        $UTotal=0;     $curve_over=0;

   $RA_score=0; $RB_score=0; $RC_score=0; $RD_score=0;

   if ($deviceD == "globalsat")  {$spd_unit=1;     $acc_limit=2;}
   elseif ($deviceD == "3dgps")  {$spd_unit=1.825; $acc_limit=2;}
   elseif ($deviceD == "dg200")  {$spd_unit=1;     $acc_limit=1.5;}
   elseif ($deviceD == "gps01")  {$spd_unit=1.825; $acc_limit=1.5;}
   elseif ($deviceD == "DLT01")  {$spd_unit=1;     $acc_limit=1.5;}
   elseif ($deviceD == "DLT02")  {$spd_unit=1;     $acc_limit=1.5;}
   else                          {$spd_unit=1.825; $acc_limit=1.5;}
   
   for ($pp=1; $pp<=$num_rows; $pp++) {
   
   $jhk = $jhk+1;

    $altitude = $alt_i[$pp];
    $time = $time_i[$pp];
    $lat = $lat_i[$pp];
    $long = $lon_i[$pp];

    $speed = $speed_i[$pp]*$spd_unit;

    $directionC = $dir_i[$pp];
    $direction = $directionC;
    $directionC0 = $directionC;

       $lat0 = $lat;
       $lon0 = $long;
       $lat1 = DMStoDECLn($lat);
       $lon1 = DMStoDECLn($long);

       $time_s = explode(":", $time);
       $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
       $sec_del = $sec - $sec0;
        if ($sec_del <=0) {$sec_del=0;}
       $sec0 = $sec;

     $v2=round($speed,4);

     if ($pp>=2) {
       if ($sec_del!=0) {
         $acc_map  = (($v2 - $v1)/$sec_del) * (1000/3600);  /* km/hr to m/s*/

     $distance = (($v1+$v2)/2) * (1000/3600) * $sec_del;

     $sum_distance = $sum_distance+$distance;
        }
       else {$acc_map=0;}
       /*$acc_map = abs($acc_map); */
     }
     $v1=$v2;

     if ($pp==2) { $timeStr = $time;}
     if ($pp==$num_rows) {$timeStp = $time;}

     if ($speed>$maxSpeed) {$maxSpeed=$speed;}

    if ($pp>1) {
    
     $Dalt = $dir_i[$pp]-$dir_i[$pp-1];

      $del_theta = $direction - $direction0;                    /* Calculate delta theta in 1 second */
        if ($del_theta<-180) {$del_theta = $del_theta+360;}     /* Right turn and cross Q4-Q1.  */
        if ($del_theta>180)  {$del_theta = $del_theta-360;}     /* Left turn and cross Q1-Q4.  */
      $direction0 = $direction;
      $sum_theta = $sum_theta + $del_theta;

      if ( (abs($sum_theta)>=3) and ($distance1==0) ) {   /* Start Turn Detection by 3 degree changing */
         $distance1 = $sum_distance;                      /* 3 degree change and distance is counted */
         $direction1 = $direction;                        /* Flag direction @start turn */
         $stor_D = $sum_theta;                            /* Keep sum_theta @ 3 degree */
         $maxtheta1 = $direction;
         $Ddir0 = $direction;
         $maxD=0;  $maxDO=0;
         $maxP=0;   $Dstop=0;  $speed_max=0;

         $alt_pnt1 = $altitude;
         
       }

      if ($direction1 != 0) {
         $delta_theta = $direction - $direction1;          /* Calculate delta_theta */
           if ($delta_theta<-180)
              {$delta_theta = $delta_theta+360; }          /* Right turn and cross Q4-Q1. */
           if ($delta_theta>180)
              {$delta_theta = $delta_theta-360; }          /* Left turn and cross Q1-Q4.  */
           if ($speed>=$speed_max) {$speed_max = $speed;}
     /*      if ((abs($acc_map))>=(abs($accAltmax))) {$accAltmax = $acc_map; $alt_pnt2 = $pp;}   */
           
         /*$delta_theta = $delta_theta + $stor_D;          /* Return sumtheta @ 3 degree */
      }

  /* Road Curve analytic */

       $Ddir = $direction - $dirA;
         if ($Ddir<-180) {$Ddir = $Ddir+360;}               /* Right turn and cross Q4-Q1.  */
         if ($Ddir>180)  {$Ddir = $Ddir-360;}               /* Left turn and cross Q1-Q4.  */
       $dirA = $direction;

       if ((abs($Ddir)>0.4) AND ($startC==0))  {            /* Start Curve Detected */
          $start_click=$pp; $startC=1;
          $stopC=0; $Cstop=0;   $int_dir=0;
          $o=0; $int_alt=0;   $g_curve=0;
          $str_point[$str_point_cnt] = $pp; $str_pnt=$pp;
          $str_point_cnt=$str_point_cnt+1;
        $startDis = $sum_distance;
          $lat01 = $lat1;
          $lon01 = $lon1;
       
         }

       if (($direction1 != 0) AND ($startC==1))  {          /* Begin Integrate direction and Integrate Altitude */
          $int_dir = $Ddir + $int_dir;
          $distanceC = $distanceC + $distance;
          
          $int_alt = $Dalt + $int_alt;
          $o = $o+1;
          $intAlt1[$o] = $altitude;
          
        }

   /* second order diff for angle*/
      if (($Ddir0!=0) AND ($startC==1)) {
         $diff2 = $direction - $Ddir0;
           if ($diff2<-180) {$diff2 = $diff2+360;}               /* Right turn and cross Q4-Q1. */
           if ($diff2>180)  {$diff2 = $diff2-360;}               /* Left turn and cross Q1-Q4.  */
         $Ddir0 = $direction;

         $int_diff2 = $int_diff2 + $diff2;

         $diffdiff = $diff2 - $diff22;
         $diff22 = $diff2;

         if ( ($int_diff2>=0) AND ($diffdiff<0)) {
             $DstopCnt=$DstopCnt+1;
             if ($DstopCnt==2)  {$Dstop=1; $DstopCnt==0; $maxtheta0=$direction; $Ddir0=0; $int_diff2 =0; $diffdiff=0; $D2cnt=$D2cnt+1; }
            }

         elseif ( ($int_diff2<=0) AND ($diffdiff>0)) {
             $DstopCnt=$DstopCnt+1;
             if ($DstopCnt==2)  {$Dstop=-1; $DstopCnt==0; $maxtheta0=$direction; $Ddir0=0; $int_diff2 =0; $diffdiff=0; $D2cnt=$D2cnt+1;}
            }
         else {$DstopCnt=0;}

       }

   /* Stop Curve Detected : first diff  */
       if ((abs($Ddir)<=0.4) AND ($startC==1) AND ($speed!=0)) {
          $Cstop = $Cstop+1;
          if ($Cstop==1) {$ja=$pp;}
          if ($Cstop==2) {
             $jaja = $pp-$ja;
             if ($jaja<=5)    {
              $stopC=1; $maxtheta2=$direction; $Cstop=0;  $distance1=0;

              }
             elseif ($jaja>5) {$Cstop=0; $stopC=0;}
          }
        }

 /* Range Curve Analytic  */

     if (($startC==1) AND (abs($acc_map)>abs($g_curve))) {
       $g_curve = $acc_map;
       $g_max=$pp;
       $alt_pnt2 = $pp;

     }

/* Deep Curve Analytic */

        if ((abs($Dstop)==1) AND ($startC==1) AND ($maxP==0) )  {          /* Max delta Theta*/
          $maxDO = $direction -  $maxtheta1;
          if ($maxDO < -180) { $maxDO = $maxDO + 360; }               /* Right turn and cross Q4-Q1. */
          if ($maxDO > 180)  { $maxDO = $maxDO - 360; }               /* Left turn and cross Q1-Q4.  */

          if (abs($maxDO) >= abs($maxD))    { $maxD=$maxDO; }
          elseif (abs($maxDO) < abs($maxD)) { $maxP=1; }

        }

/* Turn analytic */

      if (($delta_theta>80) AND ($delta_theta<=160) AND ($startC==1) AND (($stopC==1) OR (abs($Dstop)==1))  ) {

        $stp_point_cnt=$stp_point_cnt+1;
        $delta_tt[$stp_point_cnt]=$delta_theta;
        $stp_point[$stp_point_cnt]="$str_pnt-$pp";
        $g_over[$stp_point_cnt] = $g_curve;
        $g_curve=0;
        $g_over1= $g_over[$stp_point_cnt];
        $SpeedMax[$stp_point_cnt] = $speed_max;
        
        $altH1[$stp_point_cnt] = $alt_pnt1;
        $altH2[$stp_point_cnt] = $alt_pnt2;
        $AccSlope[$stp_point_cnt] = $altitude-$intAlt1[1];
        
        $latBE1[$stp_point_cnt] = $lat01;
        $lonBE1[$stp_point_cnt] = $lon01;
        $latBE2[$stp_point_cnt] = $lat1;
        $lonBE2[$stp_point_cnt] = $lon1;

        $distance2 = $sum_distance;
        $delta_distance = $sum_distance-$startDis;
        $delDis[$stp_point_cnt]=round($delta_distance,4);

          if ($delta_distance <=45) {
            $RcountA = $RcountA+1;
            $RpointA[$RcountA] = $pp;
            if ($speed_max<=20) {$RT_fontA[$RcountA]="#088A29";$RA_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$RT_fontA[$RcountA]="#AEB404";$RA_weight=0.8;}
               elseif ($speed_max>40) {$RT_fontA[$RcountA]="#B40404";$RA_weight=0.6;}
            $RAscore = $RA_weight+$RA_score;
            $RA_total = $RA_total+1;
            
            $typeTurn = "Right-A";

          }

          elseif (($delta_distance >45) AND ($delta_distance <=100) ) {
            $RcountB = $RcountB+1; $RpointB[$RcountB] = $pp;
            if ($speed_max<=20) {$RT_fontB[$RcountB]="#088A29"; $RB_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$RT_fontB[$RcountB]="#AEB404"; $RB_weight=0.8;}
               elseif ($speed_max>40) {$RT_fontB[$RcountB]="#B40404"; $RB_weight=0.6;}

            $RB_score = $RB_weight+$RB_score;
            $RB_total = $RB_total+1;
            $typeTurn = "Right-B";
          }

          elseif (($delta_distance >100) AND ($delta_distance <=200) ) {
            $RcountC = $RcountC+1; $RpointC[$RcountC] = $pp;
            if ($speed_max<=20) {$RT_fontC[$RcountC]="#088A29";;$RC_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$RT_fontC[$RcountC]="#AEB404";$RC_weight=0.8;}
               elseif ($speed_max>40) {$RT_fontC[$RcountC]="#B40404";$RC_weight=0.6;}

            $RC_score = $RC_weight+$RC_score;
            $RC_total = $RC_total+1;
            $typeTurn = "Right-C";
          }

          elseif ($delta_distance >200)  {
            $RcountD = $RcountD+1; $RpointD[$RcountD] = $pp;
            if ($speed_max<=20) {$RT_fontD[$RcountD]="#088A29";$RD_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$RT_fontD[$RcountD]="#AEB404";$RD_weight=0.8;}
               elseif ($speed_max>40) {$RT_fontD[$RcountD]="#B40404";$RD_weight=0.6;}

            $RD_score = $RD_weight+$RD_score;
            $RD_total = $RD_total+1;
            $typeTurn = "Right-D";
          }

         $type_Turn[$stp_point_cnt] =$typeTurn;
          
         $speed_max=0;                     $sum_theta=0;
         $direction1=$direction;           $delta_theta=0;
         $delta_distance=0;                $rst_start=0;
         $distanceC=0;                     $distance1=0;
         $startDis=0;
         if (abs($Dstop)!=1) {  $startC=0; $Cstop=0;  }

         $stopC=0;      $max=0;
         $int_dir=0;   $maxD=0;     $Dstop=0;
         $dirA = $direction;        $cnt_gap=0;
       }

     if (($delta_theta<-80) AND ($delta_theta>=-160) AND ($startC==1) AND (($stopC==1) OR (abs($Dstop)==1))  ) {
         $stp_point_cnt=$stp_point_cnt+1;
         $delta_tt[$stp_point_cnt]=$delta_theta;
         $stp_point[$stp_point_cnt]="$str_pnt-$pp";

          /*  $sec_curve_delta[$stp_point_cnt] = $sec-$sec_curve;       */

            $g_over[$stp_point_cnt] = $g_curve;
            $g_curve=0;
            $g_over1= $g_over[$stp_point_cnt];
            $SpeedMax[$stp_point_cnt] = $speed_max;

        $altH1[$stp_point_cnt] = $alt_pnt1;
        $altH2[$stp_point_cnt] = $alt_pnt2;
        $AccSlope[$stp_point_cnt] = $altitude-$intAlt1[1];

        $latBE1[$stp_point_cnt] = $lat01;
        $lonBE1[$stp_point_cnt] = $lon01;
        $latBE2[$stp_point_cnt] = $lat1;
        $lonBE2[$stp_point_cnt] = $lon1;

        $distance2 = $sum_distance;
        $delta_distance = $sum_distance-$startDis;
        $delDis[$stp_point_cnt]=round($delta_distance,4);

          if ($delta_distance <=45) {
            $LcountA = $LcountA+1; $LpointA[$LcountA] = $pp;
            if ($speed_max<=20) {$LT_fontA[$LcountA]="#088A29";$LB_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$LT_fontA[$LcountA]="#AEB404";$LA_weight=0.8;}
               elseif ($speed_max>40) {$LT_fontA[$LcountA]="#B40404"; $LA_weight=0.6;}
            $LA_score = $LA_weight+$LA_score;
            $LA_total = $LA_total+1;

           $typeTurn = "Left-A";
          }

          elseif (($delta_distance >45) AND ($delta_distance <=100) ) {
            $LcountB = $LcountB+1; $LpointB[$LcountB] = $pp;
            if ($speed_max<=20) {$LT_fontB[$LcountB]="#088A29";$LB_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$LT_fontB[$LcountB]="#AEB404";$LB_weight=0.8;}
               elseif ($speed_max>40) {$LT_fontB[$LcountB]="#B40404";$LB_weight=0.6; }
            $LB_score = $LB_weight+$LB_score;
            $LB_total = $LB_total+1;
          $typeTurn = "Left-B";
          }

          elseif (($delta_distance >100) AND ($delta_distance <=200) ) {
            $LcountC = $LcountC+1; $LpointC[$LcountC] = $pp;
            if ($speed_max<=20) {$LT_fontC[$LcountC]="#088A29";$LC_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$LT_fontC[$LcountC]="#AEB404";$LC_weight=0.8;}
               elseif ($speed_max>40) {$LT_fontC[$LcountC]="#B40404";$LC_weight=0.6;}
            $LC_score = $LC_weight+$LC_score;
            $LC_total = $LC_total+1;
            $typeTurn = "Left-C";
          }

          elseif ($delta_distance >200)  {
            $LcountD = $LcountD+1; $LpointD[$LcountD] = $pp;
            if ($speed_max<=20) {$LT_fontD[$LcountD]="#088A29";$LD_weight=1.0;}
               elseif (($speed_max>20) AND ($speed_max<=40)) {$LT_fontD[$LcountD]="#AEB404";$LD_weight=0.8;}
               elseif ($speed_max>40) {$LT_fontD[$LcountD]="#B40404";$LD_weight=0.6;}
            $LD_score = $LD_weight+$LD_score;
            $LD_total = $LD_total+1;
            $typeTurn = "Left-D";
          }

          $type_Turn[$stp_point_cnt] =$typeTurn;

          $speed_max=0;
          $distance1 =0;  $Dstop=0;
          $sum_theta=0;
          $direction1 =$direction;
          $delta_theta=0;
          $delta_distance=0;
          $rst_start=0;

          $distanceC=0;   $startDis=0;
          if ($Dstop!=1) { $startC=0; $Cstop=0;  }
          $stopC=0;
          $int_dir=0;   $maxD=0;     $Dstop=0;
          $dirA = $direction;        $cnt_gap=0;

       }
/* ===================== U Turn Analytic ====================== */

    if (($delta_theta>160) AND ($startC==1) AND (($stopC==1) OR (abs($Dstop)==1))  ) {
         $stp_point_cnt=$stp_point_cnt+1;
         $delta_tt[$stp_point_cnt]=$delta_theta;
         $stp_point[$stp_point_cnt]="$str_pnt-$pp";

          /*  $sec_curve_delta[$stp_point_cnt] = $sec-$sec_curve;       */

         $g_over[$stp_point_cnt] = $g_curve;
         $g_curve=0;
         $g_over1= $g_over[$stp_point_cnt];
         $SpeedMax[$stp_point_cnt] = $speed_max;

        $altH1[$stp_point_cnt] = $alt_pnt1;
        $altH2[$stp_point_cnt] = $alt_pnt2;
        $AccSlope[$stp_point_cnt] = $altitude-$intAlt1[1];

        $latBE1[$stp_point_cnt] = $lat01;
        $lonBE1[$stp_point_cnt] = $lon01;
        $latBE2[$stp_point_cnt] = $lat1;
        $lonBE2[$stp_point_cnt] = $lon1;
        
        $distance2 = $sum_distance;
        $delta_distance = $sum_distance-$startDis;
        $delDis[$stp_point_cnt]=round($delta_distance,4);

         $UTotal = $UTotal+1;

         $typeTurn = "U-Turn";


         $type_Turn[$stp_point_cnt] =$typeTurn;

          $speed_max=0;
          $distance1 =0;  $Dstop=0;
          $sum_theta=0;
          $direction1 =$direction;
          $delta_theta=0;
          $delta_distance=0;
          $rst_start=0;

          $distanceC=0;   $startDis=0;
          if ($Dstop!=1) { $startC=0; $Cstop=0;  }
          $stopC=0;
          $int_dir=0;   $maxD=0;     $Dstop=0;
          $dirA = $direction;        $cnt_gap=0;

    }

/*  Road Curve Detector  */

   if ((($startC==1) AND ($stopC==1)) AND (abs($int_dir)>=6) AND (abs($delta_theta)<=80) AND (abs($maxD)>=10) AND ($D2cnt!=2) ) {
            $stp_point_cnt=$stp_point_cnt+1;
            $delta_tt[$stp_point_cnt]=$delta_theta;
            $stp_point[$stp_point_cnt]="$str_pnt-$pp";

            /*$sec_curve_delta[$stp_point_cnt] = $sec-$sec_curve;     */
            $SpeedMax[$stp_point_cnt] = $speed_max;
            $g_over[$stp_point_cnt] = $g_curve;
            $g_curve=0;
            $g_over1= $g_over[$stp_point_cnt];
            
        $altH1[$stp_point_cnt] = $alt_pnt1;
        $altH2[$stp_point_cnt] = $alt_pnt2;
        $AccSlope[$stp_point_cnt] = $altitude-$intAlt1[1];

        $distance2 = $sum_distance;
        $delta_distance = $sum_distance-$startDis;
        $delDis[$stp_point_cnt]=round($delta_distance,4);


        $latBE1[$stp_point_cnt] = $lat01;
        $lonBE1[$stp_point_cnt] = $lon01;
        $latBE2[$stp_point_cnt] = $lat1;
        $lonBE2[$stp_point_cnt] = $lon1;

         if ($delta_theta>0) {
            $CcountRB = $CcountRB+1; $CpointRB[$CcountRB] = $pp;
            if ($speed_max<=30) {$RC_fontB[$CcountRB]="#088A29";$RC_weight=1.0;}
               elseif (($speed_max>45) AND ($speed_max<=60)) {$RC_fontB[$CcountRB]="#AEB404";$RC_weight=0.8;}
               elseif ($speed_max>60) {$RC_fontB[$CcountRB]="#B40404";$RC_weight=0.8;}
            $RCA_score = $RC_weight+$RCA_score;
            $RCA_total = $RCA_total+1;

            $typeTurn = "Curve-R";
         }

         if ($delta_theta<0) {
            $CcountLB = $CcountLB+1; $CpointLB[$CcountLB] = $pp;
            if ($speed_max<=30) {$LC_fontB[$CcountLB]="#088A29";$RC_weight=1.0;}
               elseif (($speed_max>45) AND ($speed_max<=60)) {$LC_fontB[$CcountLB]="#AEB404";$LCB_weight=0.8;}
               elseif ($speed_max>60) {$LC_fontB[$CcountLB]="#B40404";$LCB_weight=0.6;}
            $LCB_score = $LCB_weight+$LCB_score;
            $LCB_total = $LCB_total+1;
             $typeTurn = "Curve-L";
         }

         $type_Turn[$stp_point_cnt] =$typeTurn;
         $speed_max=0;
         $distanceC=0;
         $distance1=0;         $startDis=0;
         $startC=0;
         $stopC=0; $Cstop=0;
         $Cstop=0;          $Dstop=0;
         $int_dir=0;        $cnt_gap=0;
         $maxD=0;  $maxDO=0;
    }

/*  Road S-Curve Detector  */

     $s_theta = abs($maxtheta2 - $maxtheta1);

       if ( $s_theta <-180) { $s_theta  = $s_theta + 360; }          /* Right turn and cross Q4-Q1. */
       if ( $s_theta >180)  { $s_theta  = $s_theta - 360; }          /* Left turn and cross Q1-Q4.  */

      if (($startC==1) AND ($stopC==1) AND ($s_theta<15) AND (abs($maxD)>=15)  AND (abs($maxD)<=30) )  {

            $stp_point_cnt=$stp_point_cnt+1;
            $delta_tt[$stp_point_cnt]=$delta_theta;
            $stp_point[$stp_point_cnt]="$str_pnt-$pp";

            /*$sec_curve_delta[$stp_point_cnt] = $sec-$sec_curve;     */
            $SpeedMax[$stp_point_cnt] = $speed_max;
            $g_over[$stp_point_cnt] = $g_curve;
            $g_curve=0;
            $g_over1= $g_over[$stp_point_cnt];

        $altH1[$stp_point_cnt] = $alt_pnt1;
        $altH2[$stp_point_cnt] = $alt_pnt2;
        $AccSlope[$stp_point_cnt] = $altitude-$intAlt1[1];

        $latBE1[$stp_point_cnt] = $lat01;
        $lonBE1[$stp_point_cnt] = $lon01;
        $latBE2[$stp_point_cnt] = $lat1;
        $lonBE2[$stp_point_cnt] = $lon1;
        
        $distance2 = $sum_distance;
        $delta_distance = $sum_distance-$startDis;
        $delDis[$stp_point_cnt]=round($delta_distance,4);

         $CcountSA = $CcountSA+1; $CpointSA[$CcountSA] = $pp;
             if ($speed_max<=60) {$SC_fontA[$CcountSA]="#088A29";$SCA_weight=1.0;}
               elseif (($speed_max>60) AND ($speed_max<=80)) {$SC_fontA[$CcountSA]="#AEB404"; $SCA_weight=0.8;}
               elseif ($speed_max>80) {$SC_fontA[$CcountSA]="#B40404"; $SCA_weight=0.6;}

         $SCA_score = $SCA_weight+$SCA_score;
         $SCA_total = $SCA_total+1;

          $typeTurn = "SCurve-A";
          $speed_max=0;
         $distanceC=0;  $sum_theta=0;            $startDis=0;
         $startC=0;
         $stopC=0;   $Cstop=0;   $Dstop=0; $cnt_gap=0;
         $int_dir=0;
         $maxD=0;  $maxDO=0;  $s_theta=0;
         $maxtheta0 = 0;   $maxtheta2 = 0; $cnt_gap=0; $max_theta_gap =0; $max_theta=0; $maxtheta1=0;
         $D2cnt=0;

       $type_Turn[$stp_point_cnt] =$typeTurn;
       }

      elseif (($startC==1) AND ($stopC==1) AND ($s_theta<15) AND (abs($maxD)>30) )  {

         $stp_point_cnt=$stp_point_cnt+1;
         $delta_tt[$stp_point_cnt]=$delta_theta;
         $stp_point[$stp_point_cnt]="$str_pnt-$pp";
         $SpeedMax[$stp_point_cnt] = $speed_max;
         
          $latBE1[$stp_point_cnt] = $lat01;
        $lonBE1[$stp_point_cnt] = $lon01;
        $latBE2[$stp_point_cnt] = $lat1;
        $lonBE2[$stp_point_cnt] = $lon1;

        $altH1[$stp_point_cnt] = $alt_pnt1;
        $altH2[$stp_point_cnt] = $alt_pnt2;
        $AccSlope[$stp_point_cnt] = $altitude-$intAlt1[1];

         $g_over[$stp_point_cnt] = $g_curve;
         $g_curve=0;
         $g_over1= $g_over[$stp_point_cnt];
        $distance2 = $sum_distance;
        $delta_distance = $sum_distance-$startDis;
        $delDis[$stp_point_cnt]=round($delta_distance,4);

         $CcountSB = $CcountSB+1; $CpointSB[$CcountSB] = $pp;
            if ($speed_max<=60) {$SC_fontB[$CcountSB]="#088A29";$SCB_weight=1.0;}
               elseif (($speed_max>60) AND ($speed_max<=80)) {$SC_fontB[$CcountSB]="#AEB404";$SCB_weight=0.8;}
               elseif ($speed_max>80) {$SC_fontB[$CcountSB]="#B40404";$SCB_weight=0.6;}

         $SCB_score = $SCB_weight+$SCB_score;            $startDis=0;
         $SCB_total = $SCB_total+1;
         $typeTurn = "SCurve-B";
         $distanceC=0;   $speed_max=0;
         $startC=0;
         $stopC=0;   $Cstop=0;   $Dstop=0; $cnt_gap=0;
         $int_dir=0;
          $maxD=0;  $maxDO=0;  $s_theta=0;
         $maxtheta0 = 0;   $maxtheta2 = 0;  $max_theta_gap =0; $max_theta=0; $maxtheta1=0;
         $D2cnt=0;
       $type_Turn[$stp_point_cnt] =$typeTurn;
       }
       


/* Reset Calulator when integrate direction<15 degree : noise */

      if ( ($startC==1) AND ($stopC==1) AND (abs($int_dir)<10)  ){

         $distanceC=0;      $sum_theta=0;  $g_curve=0;  $speed_max=0;      $startDis=0;
         $startC=0;
         $stopC=0; $Cstop=0; $Dstop=0;  $cnt_gap=0;
         $int_dir=0;
          $maxD=0;  $maxDO=0;
         $maxtheta = 0;   $maxtheta0 = 0; $max_theta_gap =0; $max_theta=0; $maxtheta0=0;
       }

      if ((($Ddir>=-0.4) AND ($Ddir<0)) OR (($Ddir>0) AND ($Ddir<=0.4)))  {
      $noise = $noise+1;
      if ($noise>=10) {
         $startC=0; $noise=0; $sum_theta=0;
         $distance1 = 0;                         /* 3 degree change and distance is counted */
         $sum_theta=0;      $startDis=0;
         $Dstop=0;
         $maxD=0;  $maxDO=0; $maxP=0;       $speed_max=0;
         $g_curve=0;

/*         $direction1 = 0;                        /* Flag direction @start turn */
/*         $stor_D = 0;                            /* Keep sum_theta @ 3 degree */
/*         $maxtheta1 = 0;
/*         $Ddir0 = 0;    */
         }
      }
      else {$noise=0;}

    }   /* End of if calculator */

    elseif ($pp==1) { $direction0=$direction; $direction1=$direction; $sum_theta=0; $startC=0;$dirA = $direction; }

    }  /* End of for */


  $LTotal = $LcountA + $LcountB + $LcountC + $LcountD;
  $RTotal = $RcountA + $RcountB + $RcountC + $RcountD;

  $CTotalL = $CcountLA + $CcountLB;
  $CTotalR = $CcountRA + $CcountRB;
  $CTotalS = $CcountSA + $CcountSB;

  $time_s = explode(":", $TimeBegin);
  $secE00 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

  $LaneC=0; $LaneC_over=0;$LaneC2_over=0;
  
  for ($m=1; $m<=$stp_point_cnt; $m++) {
  
      $AccSlope[$m] = round($AccSlope[$m],2);
  
     /*if ($sec_curve_delta[$m]<=10) { $curve_over=$curve_over+1;}   */
       $g_over[$m] = $g_over[$m]/9.81;
       
       if ( abs($g_over[$m])>=0.15) {
          $curve_over = $curve_over+1;
          $Ttype_over[$curve_over] = $type_Turn[$m];
       }

       $g_overR[$m] = round($g_over[$m],4);

       $k0 = explode("-",$stp_point[$m]);
       $k1 = $k0[0]; $k2 = $k0[1];

       $time01 = $time_i[$k1];
       $time_s = explode(":", $time01);
       $sec01 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

       $time02 = $time_i[$k2];
       $time_s = explode(":", $time02);
       $sec02 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));

       $secE01 = $sec01 - $secE00;
       $secE02 = $sec02 - $secE00;
       $sec00  = $sec02 - $sec01;

       $deltaT = $secE01;
       $hour_trip = floor($deltaT/3600);
       $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
       
       if ($deltaT<60) {$sec_trip = $deltaT;}
       elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
       elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
       $TE1_turn[$m] = "$min_trip:$sec_trip";

       $deltaT = $secE02;
       $hour_trip = floor($deltaT/3600);
       $min_trip = ((floor($deltaT/60)) - ($hour_trip*60));
       
       if ($deltaT<60) {$sec_trip = $deltaT;}
       elseif ((60<=$deltaT) AND ($deltaT<3600)) {$sec_trip = ($deltaT- ($min_trip*60));}
       elseif ($deltaT>=3600) {$sec_trip = ($deltaT- ($min_trip*60) - ($hour_trip*3600));}
       $TE2_turn[$m] = "$min_trip:$sec_trip";

       if ($sec00!=0) {
            $deltaDS1 = $delta_tt[$m]/$sec00;
            $deltaDS[$m] = round($deltaDS1,2);
       }
       
       if ( ($type_Turn[$m]=="SCurve-A") OR ($type_Turn[$m]=="SCurve-B")  ) {

           $LaneC = $LaneC+1;
           if ($sec00<=7) { $LaneC_over = $LaneC_over+1; }

          if (($g_over[$m]>=0.15) OR ($deltaDS1>=18) ) {
           $LaneC2_over = $LaneC2_over+1;
       }
           
       }

  }

     $total1 = $LTotal+$RTotal+$CTotalL+$CTotalR+$CTotalS+$UTotal;
     $total2 = $curve_over;
     $total3 = $UTotal;
     $curve_turn = "$stp_point_cnt.$total2";

?>
</BODY>
</HTML>
