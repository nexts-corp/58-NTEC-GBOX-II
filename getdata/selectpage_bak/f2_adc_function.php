<HTML>
<HEAD>
 <TITLE>New Document</TITLE>
</HEAD>
<BODY>
<?php

$adc1_num = 0; $adc1_start=0; $adc1_stop=1;

  for ($i=1; $i<$num_rows; $i++) {

      $adc1 = $adc1_i[$i];

    if (($adc1!="SUCC") AND ($adc1_start==0) AND ($adc1_stop==1)) {
    
      $adc1_num = $adc1_num+1;
      
      $time1_adc1[$adc1_num] = $time_i[$i];
      $num_rows1_adc1[$adc1_num] = $i;
      
      $adc1_start=1;
      $adc1_stop=0;
    }
    
    elseif  ($adc1=="SUCC")   {
      $time2_adc1[$adc1_num] = $time_i[$i];

      $num_rows2_adc1[$adc1_num] = $i;
      
       $adc1_stop=1;
       $adc1_start=0;
    
    }
    
    }
     echo "ADC1 data : $adc1_num";
?>
</BODY>
</HTML>
