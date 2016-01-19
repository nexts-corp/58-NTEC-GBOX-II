<?php
error_reporting(E_ERROR);
require(dirname(__FILE__)."/../../config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title> TATANAD GPS Supervisory Driver Behavior Score </title>

    <link rel="stylesheet" type="text/css" href="/_static/dc0755fd3f/css/screen-docs.css" />
    <link rel="stylesheet" href="//www.google.com/cse/style/look/default.css" type="text/css" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400" type="text/css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script id="jqueryui" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js" defer async></script>
    <script src="//www.google.com/jsapi?key=AIzaSyCZfHRnq7tigC-COeQRmoa9Cxr0vbrK6xw"></script>
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body class="docs framebox_body">
    <script type="text/javascript">
        google.load("visualization", '1.1', {packages:['corechart']});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
    
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Date');
            data.addColumn('number', '81-88 km/hr');
            data.addColumn('number', '89-96 km/hr');
            data.addColumn('number', '97-104 km/hr');
            data.addColumn('number', 'over 104 km/hr');

            <?php
            $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
            $objDB = mysql_select_db(DB_NAME);  /*Start Frame at Open selectable Always*/
            mysql_query("SET NAMES 'tis620'");
  
            $exe = "SELECT test,indei,tsmp ,date,pack,total,tripdir,daylight,`speedavg`,`distanceavg`,`timeavg`
                    FROM `totalscore` ORDER BY  `spdscore`";
            $result = mysql_query($exe)or die(mysql_error());
            $num_score = mysql_numrows($result);
  
            $date1="2018-09-17";
            $total1 = 9999;
            for ($i=0; $i<$num_score; $i++) {
   
                list($selectT,$in0,$tsmp0,$date0,$pack10,$total,$tripdir0,$daylight0,$speedavg1,$distanceavg1,$timeavg1) = mysql_fetch_row($result);

                $P = explode(":",$pack10);
      
                echo " data.addRows([ ['$date0',$P[2],$P[3],$P[4],$P[5] ] ]); ";
      
                $v_avg = $v_avg + $speedavg1;
                $d_avg = $d_avg + $distanceavg1;
                $t_avg = $t_avg + $timeavg1;
      
                $pv1 = $pv1 + $P[5];
                $pv2 = $pv2 + $P[4];
                $pv3 = $pv3 + $P[3];
                $pv4 = $pv4 + $P[2];

                $v_high[$i] = $P[5]+$P[4];
                $v_low[$i]  = $P[3]+$P[2];
      
                $vs = $v_high[$i]+$v_low[$i];

                if ($vs!=0) {
                    $v_hl[$i] = 100 * $v_high[$i]/$vs;
                }

                $total_sum = $total_sum + $total;
                $dis_sum = $dis_sum+$distanceavg1;
                $time_sum = $time_sum+$timeavg1;
                $speed_sum = $speed_sum+$speedavg1;
      
                if ($i==3) {
                    $trip = $tripdir0;
                }

                if ($date0>$date2) {
                    $date2 = $date0;
                }
                elseif ($date0<$date1) {
                    $date1 = $date0;
                }

                if ($total>$total2) {
                    $total2 = $total;
                }
                if ($total<$total1) {
                    $total1 = $total;
                }

            }
            $pp = $pv1+$pv2+$pv3+$pv4;
            if ($pp!=0) {
                $pv01 = ($pv1/$pp)*100;
                $pv02 = ($pv2/$pp)*100;
                $pv03 = ($pv3/$pp)*100;
                $pv04 = ($pv4/$pp)*100;
            }
   
   if ($num_score!=0) {$total_sum = $total_sum/$num_score; }
   $total_sum = round($total_sum,2);
   
   if ($num_score!=0) {$dis_sum = $dis_sum/$num_score; }
   $dis_sum = round($dis_sum,2);

   if ($num_score!=0) {$time_sum = $time_sum/$num_score; }
   $time_sum = round($time_sum,0);

   if ($num_score!=0) {$speed_sum = $speed_sum/$num_score; }
   $speed_sum = round($speed_sum,2);
   
   if     (($trip=="SKT - BKK") OR ($trip=="BKK - SKT") ) { $trip = "Sukothai";}
   elseif (($trip=="CHR - BKK") OR ($trip=="BKK - CHR") ) { $trip = "ChengRai";}
   elseif (($trip=="NRM - BKK") OR ($trip=="BKK - NRM") ) { $trip = "NakornRachasima"; $deviceD="dg200";}
   elseif (($trip=="A - B") OR ($trip=="B - A") )         { $trip = "My Test";}
   elseif (($trip=="SRT - BKK") OR ($trip=="BKK - SRT") ) { $trip = "Surathani";}
   elseif (($trip=="CHM - BKK") OR ($trip=="BKK - CHM") ) { $trip = "ChengMai";}
   elseif (($trip=="MSD - BKK") OR ($trip=="BKK - MSD") ) { $trip = "Tak (MeaSod)";}
   
   elseif (($trip=="MSD - BKK") OR ($trip=="BKK - MSD") ) { $trip = "Tak (MeaSod)";}
   
         $v_avg = round(($v_avg/24),2);
       $d_avg = round(($d_avg/24),2);
       $t_avg = round(($t_avg/24),2);
   
   ?>
   
     var options = {

    <?php echo " title: 'Speed Score : $selectT',
     titleTextStyle: {color: 'red', fontSize: 15},

          hAxis: {title: 'Test Date', minValue: 0 ,  count: 1 ,  baselineColor: 'red'
                 ,gridlines:{color:'gray'},titleTextStyle:{color: 'black' , fontSize: 15}
                 },
          vAxis: {title: 'vehicle speed (km/hr)',  minValue: 0 ,  maxValue:3 ,  count: 1, baselineColor: 'red'
                 ,titleTextStyle:{color: 'black' , fontSize: 15}
                 },

        width: 800,
        height: 400,
        legend: { position: 'right', maxLines: 3 ,  textStyle: {color: 'black', fontSize: 10}},
    	bar: {groupWidth: '75%'},
        isStacked: true,

         colors : ['#00BFFF', '#F4FA58', '#FE2E2E', '#FF00BF'],
      };
      ";     ?>
      
      var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
      chart.draw(data, options);
  }
  </script>
<div id="columnchart_stacked" style="width: 800px; height: 400px;"></div>


  </body>
</html>
