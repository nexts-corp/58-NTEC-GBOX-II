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
         data.addColumn('number', 'speed');
         data.addColumn('number', 'acc (m/s2) x 10');
         data.addColumn('number', 'deltaD');
         data.addColumn('number', 'altitude(m)');
    <?php
if ($over_index<100) {
    $lo= $spd_pint1[$over_index];
    $hi= $spd_pint[$over_index];
}
elseif (($over_index>=100) AND ($over_index<300)) {
     $jj = $over_index-100;
     $lo = $dowsy_point1[$jj];
     $hi = $dowsy_point2[$jj];
     }
elseif (($over_index>=300) AND ($over_index<400)) {
     $jj = $over_index-300;
 $lo = $pointE1;
 $hi = $pointE2;
     }
 $lo = $pointE1;
 $hi = $pointE2;
$int_speed=0;  $delta_speed=0;

    for ($i=$lo; $i<=$hi ; $i++) {

     $del_alt = $alt_i[$i]- $alt_i[$i-1];
     $int_alt = $int_alt  + $del_alt;
     $altit = $alt_i[$i];

     $time = $time_i[$i];
     
       $time_s = explode(":", $time);
       $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
       $sec_del = $sec - $sec0;
        if ($sec_del <=0) {$sec_del=0;}
       $sec0 = $sec;

    $delta_speed = $speed_i[$i] - $speed_i[$i-1];

     if ($sec_del!=0) {
         $acc_map  = (($delta_speed )/$sec_del) * (1000/3600);  /* km/hr to m/s*/
         
         $acc_int = ($acc_map)/9.81;
         $acc_int = round((100*$acc_int),2);

     }

    $int_speed = $int_speed + $delta_speed;

    $delta_dir = $dir_i[$i] - $dir_i[$i-1];
        if ($delta_dir<-180)     {$delta_dir = $delta_dir+360;}     /* Right turn and cross Q4-Q1.  */
        elseif ($delta_dir>180)  {$delta_dir = $delta_dir-360;}     /* Left turn and cross Q1-Q4.  */

    
    $int_delT = $int_delT + $delta_dir;
    
/*    if ($myUser=="DLT01") {
      if ($int_delT<=-90)      {$int_delT = $int_delT + 180;}     /* Right turn and cross Q4-Q1.  */
/*       elseif ($int_delT>=90)  {$int_delT = $int_delT - 180;}     /* Left turn and cross Q1-Q4.  */
/*    }
    else {
      if ($int_delT<=-180)      {$int_delT = $int_delT + 360;}     /* Right turn and cross Q4-Q1.  */
/*       elseif ($int_delT>=180)  {$int_delT = $int_delT - 360;}     /* Left turn and cross Q1-Q4.  */
/*    } */

    echo " data.addRows([ [$i, $speed_i[$i],$acc_int,$int_delT,$int_alt  ] ]); ";
    }

    ?>

    <?php echo " var options = { title: '$myUser Point $over_index ($lo-$hi)' ,titleTextStyle: {color: 'blue', fontSize: 10} , ";   ?>
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

     <div id="chart_div" style="width: 400px; height: 220px;"> </div>

</body>
</html>
