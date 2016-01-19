<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php
            $j1 = $LTotal ;
            $j2 = $RTotal ;
            $j3 = $CTotalL ;
            $j4 = $CTotalR ;
            $j5 = $CTotalS ;
            $j6 = $UTotal ;

            echo "
                  var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  ['Left turn', $j1],
                  ['Right turn',  $j2],
                  ['Left Curve',  $j3],
                  ['Right curve',  $j4],
                  ['S curve',  $j5],
                  ['U turn',  $j6],

                ]);
               ";

            echo "  var options = {
                    title: 'Type of Turn Behavior'
                    };
                ";
            ?>

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="piechart" style="width: 450px; height: 200px;"></div>
</body>
</html>
