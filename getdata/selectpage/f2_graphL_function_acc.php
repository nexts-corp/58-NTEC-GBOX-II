<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title> TATANAD GPS Supervisory Check list 02 </title>

    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">

    <script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA1TLsxD4XQeiCmWpYnzZ5nhQxeaWx9A5kVr5BJSPxoxZpsh84nhSlSg9dsNKIUF6TfIL-XzBIaHb9yA"></script>
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>

    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();

            data.addColumn('number', 'Time');
            data.addColumn('number', 'speed');
            data.addColumn('number', 'force');
            data.addColumn('number', 'acc (m/s2)');
            data.addColumn('number', 'direction');

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
                $lo = $point0[$jj];
                $hi = $point4[$jj];
            }
            elseif (($over_index>=500) AND ($over_index<600)) {
                $jj = $over_index-500;
                $lo = $crossPoint1[$jj];
                $hi = $crossPoint4[$jj];
            }
            elseif (($over_index>=600) AND ($over_index<700)) {
                $jj = $over_index-600;
                $kk = explode("-",$stp_point[$jj]);
                $lo = $kk[0];
                $hi = $kk[1];
            }
     
            $int_speed = 0;
            $delta_speed = 0;
            $int_acc = 0;
            $int_delT = 0;
            for ($i=$lo; $i<=$hi ; $i++) {
                if ($i==$lo) {
                    $time = $time_i[$i-1];
                    $time_s = explode(":", $time);
                    $sec0 = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                }

                $time = $time_i[$i];
                $time_s = explode(":", $time);
                $sec = ((($time_s[0])*3600) + (($time_s[1])*60) + ($time_s[2]));
                $sec_del = $sec - $sec0;

                if ($sec_del <=0) {
                    $sec_del = 0;
                }
                $sec0 = $sec;

                $speed = $speed_i[$i];
      
                $speedP[$i] = $speed * (1000/3600);               /* Speed in m/s unit */

                if ($sec_del!=0) {
                    $acc = (($speedP[$i] - $speedP[$i-1])/$sec_del);
                }      /* m/s2 */

                if (($sec_del>10) OR ($sec_del==0)) {
                    $acc = 0;
                }

                $acc_si = round($acc,6);

                $delta_speed = $speed_i[$i] - $speed_i[$i-1];
      
                $int_speed = $int_speed + $delta_speed;

                $spdM = $speed_i[$i];

                $spdA = $delta_speed*(1000/3600);
                if ($sec_del!=0) {
                    $accx = $spdA/$sec_del;
                }
      
                $accP[$i] = $acc;
      
                $dela_acc = $accP[$i] - $accP[$i-1];
                $int_acc = $int_acc + $accP[$i];

                $delta_dir = $dir_i[$i] - $dir_i[$i-1];
                if (abs($delta_dir)>=30) {
                    $delta_dir=0;
                }
    
                $int_delT = $int_delT + $delta_dir;
                if ($int_delT<-180) {
                    $int_delT = $int_delT + 360;
                }     /* Right turn and cross Q4-Q1.  */
                elseif ($int_delT>180) {
                    $int_delT = $int_delT - 360;
                }     /* Left turn and cross Q1-Q4.  */
       
                /*   $delta_dir = $dir_i[$i] - $dir_i[$i-1];
                 $int_delT = $int_delT + $delta_dir;

                 if ($int_delT<-180)      {$int_delT = $int_delT + 360;}     /* Right turn and cross Q4-Q1.  */
                /*   elseif ($int_delT>180)  {$int_delT = $int_delT - 360;}     /* Left turn and cross Q1-Q4.  */

                echo " data.addRows([ [$i, $spdM,$int_acc,$acc_si,$int_delT ] ]); ";

            }

            ?>

            var options = {
                title: '<?php echo "Point $over_index ($lo-$hi)";?>' ,
                titleTextStyle: {
                    color: 'blue',
                    fontSize: 10
                },
                legend: {
                    position: 'right',
                    textStyle: {
                        color: 'black',
                        fontSize: 10
                    }
                },
                hAxis: {
                    title: 'time (@second)',
                    count: 2,
                    baselineColor: 'red',
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 12
                    }
                },
                vAxis: {
                    title: 'Driving parameter',
                    baselineColor: 'green',
                    titleTextStyle:{
                        color: 'black',
                        fontSize: 12
                    }
                },
                legend: {
                    position: 'top',
                    textStyle: {
                        color: 'black',
                        fontSize: 10
                    }
                }

            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    </script>
</head>
<body onload="initialize()" onunload="GUnload()">
     <div id="chart_div" style="width: 100%; height: 240px;"> </div>
</body>
</html>
