<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
      
<?php

echo "   var data = new google.visualization.DataTable();

         data.addColumn('number', 'Time');
         data.addColumn('number', 'ADC1');
         data.addColumn('number', 'ADC2');
         data.addColumn('number', 'ADC3');
         data.addColumn('number', 'ADC4');   ";


     $lo =  $num_rows1_adc1[2];
     $hi =  $num_rows2_adc1[2];
     
      for ($i=$lo; $i<=$hi ; $i++) {

      $adc1 = $adc1_i[$i];
      $adc_dat =  explode(";", $adc1);

       for ($j=1; $j<=100 ; $j++) {
        $k=$k+1;
        $T1 = $adc_dat[$j];
        $T2 = 0;
        $T3 = 0;
        $T4 = 0;
        
        echo " data.addRows([ [$k,$T1, $T2 ,$T3, $T4 ] ]); ";
       }
      }
      
    ?>
    <?php echo " var options = { title: 'Point $lo - $hi' ,titleTextStyle: {color: 'blue', fontSize: 10} , ";   ?>
                      legend: {position: 'left', textStyle: {color: 'black', fontSize: 10}},

           <?php echo "   hAxis: {title: 'time (@second)', count: 0.1, baselineColor: 'red'     " ; ?>
                             ,titleTextStyle:{color: 'black' , fontSize: 12}
                             },
                   vAxis: {title: 'vehicle speed (km/hr)', baselineColor: 'green'
                             ,titleTextStyle:{color: 'black' , fontSize: 12}
                             },
                      legend: {position: 'top', textStyle: {color: 'black', fontSize: 10}}

                      };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 600px; height: 300px;"></div>
  </body>
</html>
