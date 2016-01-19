<html>
  <head>
    <!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
     var data = new google.visualization.DataTable();

         data.addColumn('number', 'Time');
         data.addColumn('number', 'Speed');
         data.addColumn('number', 'Acc');
         data.addColumn('number', 'DeltaD');
         data.addColumn('number', 'Altitude(m)');
<?php

   /*   $lo= $spd_pint1[$over_index];
      $hi= $spd_pint2[$over_index];    */
      
   if ($deviceD == "globalsat")  {$spd_unit=1;     $acc_limit=2;}
   elseif ($deviceD == "3dgps")  {$spd_unit=1.825; $acc_limit=2;}
   elseif ($deviceD == "dg200")  {$spd_unit=1;     $acc_limit=1.5;}
   elseif ($deviceD == "gps01")  {$spd_unit=1.825; $acc_limit=1.5;}
   elseif ($deviceD == "DLT01")  {$spd_unit=1;     $acc_limit=1.5;}
   elseif ($deviceD == "DLT02")  {$spd_unit=1;     $acc_limit=1.5;}
   else                          {$spd_unit=1.825; $acc_limit=1.5;}
   
if ($over_index<100) {
    $lo = $spd_pint1[$over_index];
    $hi = $spd_pint[$over_index];
}
elseif (($over_index>=100) AND ($over_index<300)) {
     $jj = $over_index-100;
     $lo = $dowsy_point1[$jj];
     $hi = $dowsy_point2[$jj];
     }
elseif (($over_index>=300) AND ($over_index<400)) {
     $jj=$over_index-300;
     $lo = $point0[$jj];
     $hi = $point4[$jj];
}

elseif (($over_index>=400) AND ($over_index<500)) {
     $jj = $over_index-400;
     $lo = $crossPoint1[$jj];
     $hi = $crossPoint4[$jj];
     }

     else {
     $lo = $pointE[0];
     $hi = $pointE[1];
     }

      for ($i=$lo; $i<=$hi ; $i++) {
      
        $time_v = explode(":", $time_i[$i-1]);
        $sec3 = ((($time_v[0])*3600) + (($time_v[1])*60) + ($time_v[2]));

        $time_v = explode(":", $time_i[$i]);
        $sec5 = ((($time_v[0])*3600) + (($time_v[1])*60) + ($time_v[2]));

        $sec_del3 = $sec5 - $sec3;
        $delta_speed = $speed_i[$i] - $speed_i[$i-1];
        
        $spd = ($speed_i[$i] * $spd_unit);
        
        $del_theta = $dir_i[$i] - $dir_i[$i-1];
        if ($del_theta<-180) {$del_theta = $del_theta+360;}     /* Right turn and cross Q4-Q1.  */
        if ($del_theta>180)  {$del_theta = $del_theta-360;}     /* Left turn and cross Q1-Q4.  */


        $int_delT = $int_delT + $del_theta;
        

        $del_alt = $alt_i[$i]- $alt_i[$i-1];
        $int_alt = $int_alt  + $del_alt;
     
       if ($sec_del3!=0) {$accGP = (($spd_unit*$delta_speed/$sec_del3) * (1000/3600)*10); }
      
            echo " data.addRows([ [$i,$spd,$accGP,$int_delT,$int_alt ] ]);  ";
     }
?>

        var options = {
          title: 'Driving Behavior',
          hAxis: {title: 'point',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 380px; height: 220px;"></div>
  </body>
</html>
