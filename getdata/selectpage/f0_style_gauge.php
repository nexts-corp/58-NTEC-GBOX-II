<html>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["gauge"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            <?php
            $magG = 100;
            $avg_scale = ($total_avg100/$total_max100) *100 ;

            $ratio =  ($magG - $avg_scale)/3;
            $ratio = round($ratio,2);

            $green = 40;
            $yellow = 60;
            $red =  80;

            $total_scr = round((($total_100/$total_max100) *100),2);
            $speed_scr = round((($speed_100/$speed_max100) *100),2);
            $acc_scr = round((($acc_100/$acc_max100) *100),2);
            $turn_scr = round((($turn_100/$turn_max100) *100),2);

            echo "
                var data = google.visualization.arrayToDataTable([
                  ['Label', 'Value'],
                  ['Score', $total_scr],
                  ['Speed', $speed_scr],
                  ['Acc', $acc_scr],
                  ['Turn', $turn_scr]
                ]);
             ";


            echo "    var options = {
                  width: 240, height: 240,
                  max: $magG,

                  redFrom: $red, redTo: $magG,
                  yellowFrom:$yellow, yellowTo: $red,
                  greenFrom: $green, greenTo: $yellow,

                  minorTicks: 5
                };

                ";
            ?>

            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="chart_div" style="width: 240px; height: 240px; display: block; margin: 0 auto;"></div>
</body>
</html>
