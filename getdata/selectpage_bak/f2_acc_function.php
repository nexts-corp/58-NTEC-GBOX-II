<HTML>
<HEAD>
 <title> (Acceleration Function) TATANAD GPS Supervisory Driver Behavior Score   </title>

<meta http-equiv="Content-Language" content="th">
<meta http-equiv="content-Type" content="text/html; charset=window-874">
<meta http-equiv="content-Type" content="text/html; charset=tis-620">

</HEAD>
<BODY>
<?php
    error_reporting(E_ERROR);
    $acc_cnt=0;    $break_time=0; $breakR_time=0;   $BD=0;      $accPmax=0; $accPmin=0;
    $acc_stop = 1; $acc_start=0;  $stop_cnt = 0;
    $k=0;  $acc_max=0; $acc1=0;   $acc2=0; $acc3=0;     $accP_max1=0;
    $acc_area=0;  $sta_count=0;   $acc_area_0=0;   $int_delT=0;
    $dis_acc_sum = 0;  $intDelMax=0;  $force=0;  $scc_stop2 = 0;   $gpsl=0;
$sec0 = 0; $int_acc = 0; $acc_cnt2=0; $acc_fag_p=0; $acc_fag_n=0; $secj=0; $speed2=0;

   for ($i=1; $i<=$num_rows; $i++) {

    $time = $time_i[$i];
    $lat = $lat_i[$i];
    $long = $lon_i[$i];
    $speed = $speed_i[$i];
    $direction = $dir_i[$i];

/* Time & Time Interval Calculation */
    $time_s = explode(":", $time);
    $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
    $sec_del = $sec - $sec0;

    if ($sec_del <=0) {$sec_del=0;}
    $sec0 = $sec;
       if($i != 1) {
           $delta_dir = $dir_i[$i] - $dir_i[$i - 1];
       }
       else{
           $delta_dir = 0;
       }
    if (abs($delta_dir)>=30) {$delta_dir=0;}
    
/* Speed & Acc Calculation & Distance */

    $speed = $speed ;
    $speedP[$i] = $speed * (1000/3600);               /* Speed in m/s unit */

    $dis_acc = $speedP[$i] * $sec_del;
    $dis_acc_sum = $dis_acc_sum + $dis_acc;

    if ($sec_del!=0)
       {
           if($i != 1) {
               $acc = (($speedP[$i] - $speedP[$i - 1]) / $sec_del);
           }
           else{
               $acc = 0;
           }
       }

    if ( ($sec_del>10) OR ($sec_del==0) )
       { $acc = 0;}

    $acc_si = round(($acc),6);
    $acc_graph[$i]= round(($acc ),4);

    if ($acc>$accPmax) {$accPmax=round($acc,4);}
    if ($acc<$accPmin) {$accPmin=round($acc,4);}

       if($i != 1) {
           $del_acc[$i] = $acc_graph[$i] - $acc_graph[$i - 1];
       }
       else{
           $del_acc[$i] = 0;
       }

    if ($i>=2) {
     $dir[$i] = $direction;
     $acc_si = round($acc,6);
     $acc2 = round($acc,6);
     $acc3 = $acc2 - $acc1;
     $acc1 = $acc2;


   if ($sec_del!=0) {
        $acc = ($speedP[$i] - $speedP[$i-1]) / $sec_del;  }
        
   if ( ($sec_del>10) OR ($sec_del==0) )
         { $acc = 0;}

   $acc_si = round(($acc),6);

/* ===== Integrate acc & Start-Stop Detected =============== */

   $int_acc = $int_acc + $acc_si;
   
   if ( (abs($int_acc)>=0.5) AND ($acc_start==0) AND ($acc_stop==1) ) {

   if ($int_acc>=0)      { $acc_fag = 1; }
     elseif ($int_acc<0) { $acc_fag = 0; }

     $pointt0 = $i;
     $dis0 = $dis_acc_sum;
     $speed1 = $speed;
     $acc_cnt2 = $acc_cnt2+1;
     $time_use1 = $sec;
     
     $latBe = $lat;
     $lonBe = $long;
     
     $acc00 = $int_acc;
     $time1a = $time;
     $time1sec = $sec;
     $acc_start = 1;                         /* $Acc Start Detected*/
     $acc_stop2 = 0 ;
     $force = 0;
     $acc_spd_max=0;
   }

/*===  $Acc Over Limit Start Detected =====*/

  if ((abs($acc_si)>=$acc_limit) AND ($acc_start==1) AND ($acc_stop==1)) {

      $font_point[$acc_cnt] = "#DF0000";
      $point1[$acc_cnt] = $i;
      /* $acc_start=1; */
      $acc_stop =0;

   }
    
/* ========================================================= */

    if ( ($acc_start==1) AND ($acc_stop2==0)  ){
    
       $force = $force+$acc_si;
       
    if ( ($speed >= $acc_spd_max)  ) { $acc_spd_max = $speed;}

    }

    if ( ( (abs($acc_si)<0.01) OR ($acc_fag_p>=3) OR ($acc_fag_n>=3) )  AND ($acc_start==1) AND ($acc_stop==0) )  {

       $stop_cnt = $stop_cnt+1;
       $time_use2 = $sec - $time_use1;

        if ( ($stop_cnt>=3) AND ($time_use2>=10) ) {

           $acc_cnt=$acc_cnt+1;
           $dis_use[$acc_cnt] = round(($dis_acc_sum-$dis0),4);
           $accP_max[$acc_cnt] = $accP_max1;
           $acc_maxPoint[$acc_cnt] = $pointt2;
           $time_use[$acc_cnt] = $time_use2;
           $del_a[$acc_cnt] = $int_acc - $acc00;
           $acc_vmax[$acc_cnt] =  $acc_spd_max;
           $acc_fagg[$acc_cnt]=$acc_fag_p;
           $point0[$acc_cnt] = $pointt0;

            $point4[$acc_cnt] = $i;
            $time1_acc[$acc_cnt] = $time1a;
            $time2_acc[$acc_cnt] = $time;
            $timesec[$acc_cnt] = $sec - $time1sec;
            $speed_diff[$acc_cnt]=$speed-$speed1;
            $speed_end[$acc_cnt]=$speed;
            
           $int_del_dir[$acc_cnt] =  $int_delT;
           $intdelMax1[$acc_cnt] = $intDelMax;
           $intdelMaxP[$acc_cnt] = $intMaxP;

           $forceP[$acc_cnt] = $force;
           
           $latABe[$acc_cnt] = $latBe;
           $lonABe[$acc_cnt] = $lonBe;
           
           $latAEn[$acc_cnt] = $lat;
           $lonAEn[$acc_cnt] = $long;

            $acc_stop =  1;   $acc_stop2=1;
            $acc_start = 0;
            $int_acc = 0;

            $acc_spd_max=0;    $accP_max1=0;  $int_delT=0;  $intDelMax=0;
            $speed1 = 0;
            $stop_cnt = 0;
            $acc_fag_p = 0; $acc_fag_n = 0;           $force=0;
        }

        elseif ( ($stop_cnt>=3) AND ($time_use2<10)   ) {

            $acc_stop =  1;      $acc_stop2=1;
            $acc_start = 0;
                                           $int_acc = 0;
            $speed1 = 0;
            $stop_cnt = 0;
            $acc_fag_p = 0; $acc_fag_n = 0;  $int_delT=0; $intDelMax=0;
            $acc_spd_max=0;    $accP_max1=0;     $force=0;
        }
        $time_use2=0;

    }
    
/* ------------------ */

    elseif ( ((abs($acc_si)>=0.01) ) AND ($acc_start==1) AND ($acc_stop==0) )  {
    
       if (($acc_fag==0) AND ($acc_si>0.1) ) {

            $acc_fag_p = $acc_fag_p+1;
            $acc_fag_n = 0;

       }

       elseif (($acc_fag==1) AND ($acc_si<0.1) ) {

            $acc_fag_n = $acc_fag_n+1;
            $acc_fag_p = 0;

       }
       
       if (abs($acc_si) >= abs($accP_max1) )  {
         $accP_max1 =  $acc_si ;
         $pointt2 = $i;
       }

      $int_delT = $int_delT + $delta_dir;

      if ($int_delT<-180)     {$int_delT = $int_delT + 360;}     /* Right turn and cross Q4-Q1.  */
      elseif ($int_delT>180)  {$int_delT = $int_delT - 360;}     /* Left turn and cross Q1-Q4.  */

      if (abs($int_delT)>=abs($intDelMax)) {$intDelMax=$int_delT; $intMaxP=$i;}

    }
/* ------------------ */

    elseif ( (abs($acc_si)<0.1) AND ($acc_start==1)  )  {   /* Clear Flag */
      $acc_start = 0;
      $int_acc = 0;
      $stop_cnt = 0;
      $acc_direc=3;
      $int_delT=0;  $accP_max1=0;
    }
    
/* ============= GPS Lose Detection ================= */

   if ($sec_del>=300) {

      $gpsl = $gpsl+1;
      $spd_dif = $spd[$i] - $spd[$i-1];

      $gpslT[$gpsl] = $sec_del;
      $gpsl_point1[$gpsl] = $i-1;
      $gpsl_point2[$gpsl] = $i;


      $latGPS1[$stop_bus_cnt] = DMStoDECLn($lat_i[$i-1]);
      $lonGPS1[$stop_bus_cnt] = DMStoDECLn($lon_i[$i-1]);

      $latGPS2[$stop_bus_cnt] = DMStoDECLn($lat_i[$i]);
      $lonGPS2[$stop_bus_cnt] = DMStoDECLn($lon_i[$i]);

     }
    

  }  /* end of if $i>=2 */
  } /* close for/while loop */

 /* ============= Area Graph Pendal State ===========================*/
 if ($over_index==0) {$over_index=301;}
 $ja = $over_index-300;
 $sta_count_jj=0;
 $pn=0;
 
 $typeNum011 = 0;
 $typeNum012 = 0;
 $typeNum01=0;$typeNum02=0;$typeNum03=0;$typeNum04=0; $typeNum05=0;$typeNum06=0;
 $typeNum11=0;$typeNum12=0;$typeNum13=0;$typeNum14=0; $typeNum15=0;$typeNum16=0;
 $typeNum21=0;$typeNum22=0;$typeNum23=0;$typeNum24=0; $typeNum25=0;$typeNum26=0;
 $typeNum31=0;$typeNum32=0;$typeNum33=0;$typeNum34=0; $typeNum35=0;$typeNum36=0;
 $typeNum41=0;$typeNum42=0;$typeNum43=0;$typeNum44=0; $typeNum45=0;$typeNum46=0;
 
 for ($k=1; $k<=$acc_cnt; $k++) {
 
   $steer_cnt[$k] =-1;   $checkA[$k]=0;
   $acc_area=0;   $Amax_cnt = 0;
   $acc_si0=0;  $acc_si=0;
   $int_acc=0 ; $dela_acc=0;   $sta_count=0;
   $pandal[0] = 99;
   $int_delT=0;

   $lo = $point0[$k]-1;
   $hi = $point4[$k];

   for ($i=$lo; $i<=$hi; $i++) {

    $time = $time_i[$i];
    $lat = $lat_i[$i];
    $long = $lon_i[$i];
    $speed = $speed_i[$i];
    $direction = $dir_i[$i];
    
    if ($i==$lo) { $speed0 = $speedP[$i]; }

    if ($i==$hi) { $speed2 = $speedP[$i]; }
    
/* Time & Time Interval Calculation */

    $time_s = explode(":", $time);
    $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
    $sec_del = $sec - $secj;
    
    if ($sec_del <=0) {$sec_del=0;}
      $secj = $sec;

    if ($sec_del!=0)
       { $acc = (($speedP[$i] - $speedP[$i-1])/$sec_del);  }
       
    elseif ( ($sec_del>10) OR ($sec_del==0) )
       { $acc = 0; }

    $acc_si = $acc;
    $acc_i[$i] = $acc;
    
/* === Integrate All Curve & Maximum Accelleration cumulative ============================= */

 if ($i>=$lo+1)   {

    $delta_dir = $dir_i[$i] - $dir_i[$i-1];
    if (abs($delta_dir)>=30) {$delta_dir=0;}

    $int_delT = $int_delT + $delta_dir;
    if ($int_delT<-180)     {$int_delT = $int_delT + 360;}     /* Right turn and cross Q4-Q1.  */
     elseif ($int_delT>180) {$int_delT = $int_delT - 360;}     /* Left turn and cross Q1-Q4.  */

    $dela_acc = $acc_i[$i] - $acc_i[$i-1];
    $int_acc = $int_acc + $acc;
    $intAcc[$i] = abs($int_acc);

   $intdelMax1[$k] =  $int_delT;
   
   if ($i==$lo+1) {

     $int_delT_max = $int_delT; $int_delT_min= $int_delT;
     
    }

   if ($intAcc[$i]>$intAcc[$i-1])  {                           /* Accelleration Quadrant */

       $intAccMax = $int_acc;                                  /* keep Max integrate Force */
       $int_delTM = $int_delT;                                 /* keep Mzx integrate direction */
       $MP = $i;
       $Amax_cnt = 0;

      }

    elseif ($intAcc[$i]<=$intAcc[$i-1]) {                      /* Deceleration Quadrant */
       $Amax_cnt = $Amax_cnt + 1;                              /* Counter for confirm Dec.*/
         
       if ($Amax_cnt>=2) {

         $Max_accP[$k] = $intAccMax;                           /* keep max Acc for $k */
         $Max_accPoint[$k] = $MP;                              /* keep max Acc Point for $k */
         $Max_accDir[$k] = round($int_delTM,2);
         $Amax_cnt = 0;

       }
       
    }

  }
    
  if ( ($i==$hi) AND ($Max_accP[$k]==0) )  {                  /* No confirm Brake Counter */
      $Max_accP[$k] = $int_acc;
      $Max_accPoint[$k] = $i;
  }

 /* ------ Status Pendal Checking --------- */

      if     ($acc_si>=0) {$area_pos = 1;}
      elseif ($acc_si<0)  {$area_pos = 0;}

      if ($sta_count==0) {
       if ($int_acc>=0)     {$acc_stat[$sta_count] = 1;  $area_pos_0 = 1;}
       elseif ($int_acc<0)  {$acc_stat[$sta_count] = 0;  $area_pos_0 = 0;}
       
       $brkpoint[$sta_count] = $i;
       $sta_count = $sta_count+1;

     }

     else {                                               /* Area Position Checking and State counter */
     
      if (($area_pos_0==0) AND ($area_pos==1) ) {         /* light red */
       $acc_stat[$sta_count] = 1;
       $brkpoint[$sta_count] = $i;

       if ($acc_stat[$sta_count-1]==3) { $acc_stat[$sta_count] = 3; }
       $sta_count = $sta_count+1;
       
      }
      
      elseif (($area_pos_0==0) AND ($area_pos==0) ) {      /*red */
       $acc_stat[$sta_count] = 2;
       $brkpoint[$sta_count] = $i;
       $sta_count = $sta_count+1;

      }
      
      elseif (($area_pos_0==1) AND ($area_pos==0) ) {      /* light blue */
       $acc_stat[$sta_count] = 3;
       $brkpoint[$sta_count] = $i;

       if ($acc_stat[$sta_count-1]==1) {  $acc_stat[$sta_count] = 1;  }
       $sta_count = $sta_count+1;
       
      }

      elseif (($area_pos_0==1) AND ($area_pos==1) ) {     /* blue */
       $acc_stat[$sta_count] = 4;
       $brkpoint[$sta_count] = $i;
       $sta_count = $sta_count+1;

      }

    }
 $area_pos_0 = $area_pos;
 
/* --- Press Padel Check for $k --- */

     if ( ( ($acc_stat[$sta_count-1]==4)   OR ($acc_stat[$sta_count-1]==2) ) AND
          ( ($acc_stat[$sta_count-2]==1)   OR ($acc_stat[$sta_count-2]==3) )) {

       $checkA[$k]=$checkA[$k]+1;;
     }

/* --- Status Steering Checking --- */
      $sta_count0 = $sta_count-1;

      if     ($int_delT>=0) {
        $steer_stat[$sta_count0] = 1;
        if ( (($i>=$lo+2)) AND ($steer_stat[$sta_count0-1]==0) AND ($steer_stat[$sta_count0-2]==1) ) {
          $steer_stat[$sta_count0-1] = 1;
        }

      }
      elseif ($int_delT<0)  {
         $steer_stat[$sta_count0] = 0;
         if ( (($i>=$lo+2)) AND ($steer_stat[$sta_count0-1]==1) AND ($steer_stat[$sta_count0-2]==0) ) {
          $steer_stat[$sta_count0-1] = 0;
        }

      }

       if($sta_count0 != 0) {
           if (($steer_stat[$sta_count0]) != ($steer_stat[$sta_count0 - 1])) {
               $steer_cnt[$k] = $steer_cnt[$k] + 1;
           }
       }

/* Detect Count of Pandel Status for Over_index  */

    if ($k==$ja)  {
    
/* Status Pendal Checking */

      $speed0jj = round($speed0,2);
      $speed2jj = round($speed2,2);

      $sta_count_jj               = $sta_count;
      $steer_stat_jj[$sta_count]  =  $steer_stat[$sta_count];
      $steer_stat_jj[$sta_count-1]  =  $steer_stat[$sta_count-1];
      
      $acc_stat_jj[$sta_count_jj-1] = $acc_stat[$sta_count-1];

      if ($acc_stat_jj[$sta_count_jj-1] != $pandal[$pn] )   {

         $pn = $pn + 1;
         $pandal[$pn] = $acc_stat_jj[$sta_count_jj-1];

      }
      
       $steer_cnt_jj = $steer_cnt[$k];
       
        if   ($steer_cnt[$k]<=2)   {$StrTypejj[$k] = "StrG";   }
        elseif ($steer_cnt[$k]>2 ) {$StrTypejj[$k] = "StrNG";  }
      
    }
    
  } /* close for/while loop lo-hi */
  
/* ========= Type Detect ========================================================*/
  
 /* ------ Pedal Type ------------------------------ */

  if   (($forceP[$k]<0) AND (($checkA[$k]<=2) ) ) {
    $accType[$k] = "BrkG";
  }
  
  elseif   (($forceP[$k]<0) AND (($checkA[$k]>2) ) ) {
    $accType[$k] = "BrkNG";
  }

   elseif   (($forceP[$k]>0) AND (($checkA[$k]<=2) ) ) {
    $accType[$k] = "AccG";
  }

  elseif   (($forceP[$k]>0) AND (($checkA[$k]>2) ) ) {
    $accType[$k] = "AccNG";
  }
  else { $accType[$k] = "NA";   }

/* ------ Steer Type ------------------------------ */

  if   ($steer_cnt[$k]<=2)  {
    $StrType[$k] = "StrG";
  }

  elseif ($steer_cnt[$k]>2 ) {
    $StrType[$k] = "StrNG";
  }

  /* ------ Salalom Type ------------------------------ */

  
/* --- 0.1 Salalom --- */

     if  ( (($accType[$k]=="AccNG") OR ($accType[$k]=="BrkNG")) AND ($StrType[$k]=="StrNG") )  {
     $StrType[$k] = "Slalom";  $typeNum01 = $typeNum01+1;
     
     if ($acc_vmax[$k]>=80) {$typeNum011 = $typeNum011+1;}
       else                 {$typeNum012 = $typeNum012+1;}

     }
    
/* --- 0.2 Walking --- */

     elseif ( ($speed0<=5) AND ($speed2<=10)  ) {
     $StrType[$k] = "Walking"; $typeNum02 = $typeNum02+1;
     
      if   (($accType[$k]=="AccNG") OR ($accType[$k]=="BrkNG")) { $typeNum021 = $typeNum021+1; }
      else { $typeNum022 = $typeNum022+1; }
     
  }

/* --- 1.1 Sudden Release --- */
       if ( ($speed0<=5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="AccG") AND (abs($intdelMax1[$k])<=10)) {
       $StrType[$k] = "SRelease";   $typeNum11 = $typeNum11+1;
       }

/*- 1.2 Sudden Release - Curve ---*/
      elseif ( ($speed0<=5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="AccG") AND (abs($intdelMax1[$k])>10)) {
      $StrType[$k] = "SReleaseC";   $typeNum12 = $typeNum12+1;
      }
      
/*- 1.3 Sudden Release - Slalom--- */
      elseif ( ($speed0<=5) AND ($StrType[$k]=="StrNG") AND ($accType[$k]=="AccG") AND (abs($intdelMax1[$k])<=10)) {
      $StrType[$k] = "SRelease_Sl"; $typeNum13 = $typeNum13+1;
      }

/* ------------------------------------------------------------- */

/*- 2.1 Sudden Overtake --- */
      elseif ( ($speed2>$speed0) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="AccG") AND (abs($intdelMax1[$k])<=10) ) {
      $StrType[$k] = "Overtake";      $typeNum21 = $typeNum21+1;
     }
/*- 2.2 Sudden Overtake - Slalom --- */
        elseif ( ($speed2>$speed0) AND ($StrType[$k]=="StrNG") AND ($accType[$k]=="AccG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "Overtake_SA";    $typeNum22 = $typeNum22+1;
        }
/*- 2.3 Nard Sudden Overtake --- */
        elseif ( ($speed2>$speed0) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="AccNG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "HOvertake"; $typeNum23 = $typeNum23+1;
        }
/*- 2.4 Hard Sudden Overtake - Curve --- */
        elseif ( ($speed2>$speed0) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="AccNG") AND (abs($intdelMax1[$k])>10) ) {
        $StrType[$k] = "HOvertake_C";    $typeNum24 = $typeNum24+1;
        }
/*- 2.5 Sudden Overtake - Right --- */
        elseif ( ($speed2>$speed0) AND ($accType[$k]=="AccG") AND ($intdelMax1[$k]>10) ) {
        $StrType[$k] = "OvertakeCR";  $typeNum25 = $typeNum25+1;
        }
  
/*- 2.6 Hard Sudden Overtake - Left --- */
        elseif ( ($speed2>$speed0) AND ($accType[$k]=="AccG") AND ($intdelMax1[$k]<-10) ) {
        $StrType[$k] = "OvertakeCL";  $typeNum26 = $typeNum26+1;
        }
/* ------------------------------------------------------------- */

/*- 3.1 Sudden Close to --- */
        elseif ( ($speed0>=$speed2) AND ($speed2>5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="BrkG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "CloseTo";  $typeNum31 = $typeNum31+1;
        }
/*- 3.2 Sudden Close to - Hard --- */
        elseif ( ($speed0>=$speed2) AND ($speed2>5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="BrkNG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "CloseToH";  $typeNum32 = $typeNum32+1;
        }
/*- 3.3 Sudden Close to Hard and Curve --- */
        elseif ( ($speed0>=$speed2) AND ($speed2>5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="BrkNG") AND (abs($intdelMax1[$k])>10) ) {
        $StrType[$k] = "CloseToHC"; $typeNum33 = $typeNum33+1;
        }
/*- 3.4 Sudden Close to - Slalom --- */
        elseif ( ($speed0>=$speed2) AND ($speed2>5) AND ($StrType[$k]=="StrNG") AND ($accType[$k]=="BrkG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "CloseToSA";  $typeNum34 = $typeNum34+1;
        }
/*- 3.5 Sudden Close to - Slalom and Curve --- */
        elseif ( ($speed0>=$speed2) AND ($speed2>5) AND ($StrType[$k]=="StrNG") AND ($accType[$k]=="BrkG") AND (abs($intdelMax1[$k])>10) ) {
        $StrType[$k] = "CloseToSAC"; $typeNum35 = $typeNum35+1;
        }
/*- 3.6 Sudden Close to - Very Hard --- */
        elseif ( ($speed0>=$speed2) AND ($speed2>5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="AccG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "CloseToVH";  $typeNum36 = $typeNum36+1;
        }

/* ------------------------------------------------------------- */

/*- 4.1 Sudden Stop --- */
        elseif ( ($speed2<=5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="BrkG") AND (abs($intdelMax1[$k])<=10) ) {
        $StrType[$k] = "SStop";  $typeNum41 = $typeNum41+1;
        }
/*- 4.2 Sudden Stop-Curve --- */
        elseif ( ($StrType[$k]=="StrG") AND ($accType[$k]=="BrkG") AND (abs($intdelMax1[$k])>10)) {
        $StrType[$k] = "SStopC"; $typeNum42 = $typeNum42+1;
        }
/*- 4.3 Sudden Stop-Curve --- */
        elseif ( ($speed2<=5) AND ($StrType[$k]=="StrNG") AND ($accType[$k]=="BrkG")  ) {
        $StrType[$k] = "Stop_SA";  $typeNum43 = $typeNum43+1;
  }
/*- 4.4 Sudden Stop-Hard --- */
        elseif ( ($speed2<=5) AND ($StrType[$k]=="StrG") AND ($accType[$k]=="BrkNG")  ) {
        $StrType[$k] = "StopH"; $typeNum44 = $typeNum44+1;
        }
/*- 4.5 Sudden Stop-Hard Left--- */
  elseif ( ($speed2<=5) AND ($accType[$k]=="BrkG") AND ($intdelMax1[$k]<=-10) ) {
    $StrType[$k] = "StopHL";    $typeNum45 = $typeNum45+1;
  }


/* ----------------------------------------------------------------------------- */

     $forceT = $forceT+$forceP[$k] ;
  }  /* close for/while loop $k */
  
/* ----------------------------------------------------------------------------- */

$acc_num_1= $acc_cnt;
$acc_num_2= $acc_cnt2;
$pn = $pn -1;

$typeNum0 = "$typeNum01:$typeNum02:$gpsl";
$typeNum1 = "$typeNum11:$typeNum12:$typeNum13";
$typeNum2 = "$typeNum21:$typeNum22:$typeNum23:$typeNum24:$typeNum25:$typeNum26";
$typeNum3 = "$typeNum31:$typeNum32:$typeNum33:$typeNum34:$typeNum35:$typeNum36";
$typeNum4 = "$typeNum41:$typeNum42:$typeNum43:$typeNum44:$typeNum45:$typeNum46";

$scoreT =  $typeNum01+$typeNum02+$gpsl+$typeNum11+$typeNum12+$typeNum13+$typeNum21+$typeNum22+$typeNum23+$typeNum24+$typeNum25+$typeNum26
           +$typeNum31+$typeNum32+$typeNum33+$typeNum34+$typeNum35+$typeNum36+$typeNum41+$typeNum42+$typeNum43+$typeNum44+$typeNum45+$typeNum46;

?>
</BODY>
</HTML>
