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
         data.addColumn('number', 'Speed');
         data.addColumn('number', 'Acc');
         data.addColumn('number', 'Turn');
         data.addColumn('number', 'Zone');

        <?php
        error_reporting(E_ERROR);
        require(dirname(__FILE__)."/../../config.php");
        $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
        $objDB = mysqli_select_db(DB_NAME);  /*Start Frame at Open selectable Always*/
        mysqli_query("SET NAMES 'tis620'");

        $exe = "SELECT indei,tsmp ,date,pack,total,tripdir,daylight,`speedavg`,`distanceavg`,`timeavg` FROM `totalscore` ORDER BY  `total`";
        $result = mysqli_query($exe)or die(mysqli_error());
        $num_score = mysqli_numrows($result);

        $date1="2013-09-17";
        $total1 = 9999;
        $P0 = 0; $P1 = 0; $P6 = 0; $P8 = 0;
        $total_sum = 0; $dis_sum = 0; $time_sum = 0; $speed_sum = 0;
        for ($i=0; $i<$num_score; $i++) {

            list($in0,$tsmp0,$date0,$pack10,$total,$tripdir0,$daylight0,$speedavg1,$distanceavg1,$timeavg1) = mysqli_fetch_row($result);

            $P = explode(":",$pack10);
            $P88 = ($P[8])/10;
            $P66 = $P[6]+$P[7];

            $P0 = $P0+$P[0];
            $P1 = $P1+$P[1];

            $P6 = $P6+$P[6];
            $P8 = $P8+($P[8]/10);

            echo " data.addRows([ ['$date0',$P[1],$P[0],$P66,$P88 ] ]); ";

            $total_sum = $total_sum + $total;
            $dis_sum = $dis_sum+$distanceavg1;
            $time_sum = $time_sum+$timeavg1;
            $speed_sum = $speed_sum+$speedavg1;

            if ($i==5) { $trip = $tripdir0; }

            if ($date0>$date2)      {$date2=$date0;}
            elseif ($date0<$date1)  {$date1=$date0;}

            if ($total>$total2)     {$total2=$total;}
            if ($total<$total1) {$total1=$total;}

        }

        $PTotal = $P0+$P1+$P6+$P8;
        if ($PTotal!=0) {

            $P0 = ($P0/$PTotal)*100;
            $P1 = ($P1/$PTotal)*100;
            $P6 = ($P6/$PTotal)*100;
            $P8 = ($P8/$PTotal)*100;

        }
        $P0 = round($P0,2);
        $P1 = round($P1,2);
        $P6 = round($P6,2);
        $P8 = round($P8,2);


        if ($num_score!=0) {

            $total_sum = $total_sum/$num_score;
            $dis_sum = $dis_sum/$num_score;
            $time_sum = $time_sum/$num_score;
            $speed_sum = $speed_sum/$num_score;
        }
        $total_sum = round($total_sum,2);
        $dis_sum = round($dis_sum,2);
        $time_sum = round($time_sum,0);
        $speed_sum = round($speed_sum,2);

        if     (($trip=="SKT - BKK") OR ($trip=="BKK - SKT") ) { $trip = "Sukothai";}
        elseif (($trip=="CHR - BKK") OR ($trip=="BKK - CHR") ) { $trip = "ChengRai";}
        elseif (($trip=="NRM - BKK") OR ($trip=="BKK - NRM") ) { $trip = "NakornRachasima";}
        elseif (($trip=="A - B") OR ($trip=="B - A") )         { $trip = "My Test";}
        elseif (($trip=="SRT - BKK") OR ($trip=="BKK - SRT") ) { $trip = "Surathani";}
        elseif (($trip=="CHM - BKK") OR ($trip=="BKK - CHM") ) { $trip = "ChengMai";}

        ?>

   
     var options = {

    <?php echo " title: 'Total Score : $trip ',
     titleTextStyle: {color: 'red', fontSize: 15},

          hAxis: {title: 'Test Date', minValue: 0 ,  count: 1 ,  baselineColor: 'red'
                 ,gridlines:{color:'gray'},titleTextStyle:{color: 'black' , fontSize: 15}
                 },
          vAxis: {title: 'Total Score',  minValue: 0 ,   count: 1, baselineColor: 'red'
                 ,titleTextStyle:{color: 'black' , fontSize: 15}
                 },

        width: 800,
        height: 400,
        legend: { position: 'right', maxLines: 3 ,  textStyle: {color: 'black', fontSize: 15}},
    	bar: {groupWidth: '75%'},
        isStacked: true,
      };
      ";     ?>
      
      var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
      chart.draw(data, options);
  }
  </script>
<div id="columnchart_stacked" style="width: 800px; height: 400px;">
</div>


  </body>
</html>
