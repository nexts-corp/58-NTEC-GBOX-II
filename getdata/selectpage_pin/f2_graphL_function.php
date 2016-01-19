<html>
  <head>
  <title> TATANAD GPS Supervisory Check list 02 </title>
  <meta http-equiv="Content-Language" content="th">
<meta http-equiv="content-Type" content="text/html; charset=window-874">
<meta http-equiv="content-Type" content="text/html; charset=tis-620">
 <html>
  <head>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;
key=ABQIAAAA1TLsxD4XQeiCmWpYnzZ5nhQxeaWx9A5kVr5BJSPxoxZpsh84nhSlSg9dsNKIUF6TfIL-XzBIaHb9yA"
type="text/javascript"></script>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>

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
    
if ($menu!=6) {

if ($over_index<100) {
    $lo= $spd_pint1[$over_index];
    $hi= $spd_pint2[$over_index];
}
elseif (($over_index>=100) AND ($over_index<200)) {
     $jj = $over_index-100;
     $lo = $dowsy_point1[$jj];
     $hi = $dowsy_point2[$jj];
     
  if ($jj==99) {
     $lo = $pointSea2;
    $hi = $pointSea1;     }
     
}
elseif (($over_index>=200) AND ($over_index<300)) {
     $jj = $over_index-200;
     $lo = $point0[$jj];
     $hi = $point4[$jj];
     
     
}
elseif (($over_index>=400) AND ($over_index<500)) {

     $lo = $pointE1;
     $hi = $pointE2;
}
elseif (($over_index>=500) AND ($over_index<600)) {

$gg = $over_index-500;

     $lo = $crossPoint1[$gg];
     $hi = $crossPoint4[$gg];

}

elseif (($over_index>=800) AND ($over_index<900)) {

   $gg = $over_index-800;

    $lo  = $zero_bus_point1[$gg] - 5;
    $hi  = $zero_bus_point2[$gg] + 5 ;


}
}


if ($menu==6) {

$lo = $sp1;
$hi = $sp2;

}
     
$int_speed=0;  $delta_speed=0;
  for ($i=$lo; $i<=$hi ; $i++) {
  
    $time_v = explode(":", $time_i[$i-1]);
    $sec3 = ((($time_v[0])*3600) + (($time_v[1])*60) + ($time_v[2]));
    
    $time_v = explode(":", $time_i[$i]);
    $sec5 = ((($time_v[0])*3600) + (($time_v[1])*60) + ($time_v[2]));
    
    $sec_del3 = $sec5 - $sec3;
    $delta_speed = $speed_i[$i] - $speed_i[$i-1];
    
    if ($sec_del3!=0) {$accGP = (($delta_speed/$sec_del3) * (1000/3600)); }

     $int_speed = $int_speed + $delta_speed;

     $del_alt = $alt_i[$i]- $alt_i[$i-1];
     $int_alt = $int_alt  + $del_alt;
     $altit = $alt_i[$i];

     $delta_dir = $dir_i[$i] - $dir_i[$i-1];
     $int_delT = $int_delT + $delta_dir;
    
    if ($myUser=="DLT01") {
      if ($int_delT<-90)      {$int_delT = $int_delT + 180;}     /* Right turn and cross Q4-Q1.  */
       elseif ($int_delT>90)  {$int_delT = $int_delT - 180;}     /* Left turn and cross Q1-Q4.  */
    }
    else {
      if ($int_delT<-180)      {$int_delT = $int_delT + 360;}     /* Right turn and cross Q4-Q1.  */
       elseif ($int_delT>180)  {$int_delT = $int_delT - 360;}     /* Left turn and cross Q1-Q4.  */
    }
    
    echo " data.addRows([ [$i,$speed_i[$i],$accGP,$int_delT,$int_alt ] ]); ";
    }

   echo " var options = {
                      title: '$myUser Point $over_index ($lo-$hi)' ,titleTextStyle: {color: 'blue', fontSize: 12} , ";   ?>
                      legend: {position: 'left', textStyle: {color: 'black', fontSize: 10}},

    <?php echo "   hAxis: {title: 'time (@second)', minValue: $lo,  count: 2, baselineColor: 'red'     " ; ?>
                             ,titleTextStyle:{color: 'black' , fontSize: 12}
                             },
                             
               vAxis: {title: 'vehicle speed (km/hr)', minValue: 40,  baselineColor: 'green'
                             ,titleTextStyle:{color: 'black' , fontSize: 12}
                             },
                             
                      legend: {position: 'top', textStyle: {color: 'black', fontSize: 10}}


                      };
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);       }

</script>

  </head>
  
<body onload="initialize()" onunload="GUnload()">

     <div id="chart_div" style="width: 380px; height: 220px;"> </div>

</body>
</html>
