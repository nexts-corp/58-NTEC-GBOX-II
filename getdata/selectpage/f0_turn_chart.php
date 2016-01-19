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
            data.addColumn('number', 'Turn');
            data.addColumn('number', 'U Turn');

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

                echo " data.addRows([ ['$date0',$P[6],$P[7] ] ]); ";
            }
            ?>

            var options = {
                title: 'Turn Score : <?php echo $selectT;?>',
                titleTextStyle: {
                    color: 'red',
                    fontSize: 15
                },
                hAxis: {
                    title: 'Test Date',
                    minValue: 0,
                    count: 1,
                    baselineColor: 'red',
                    gridlines: {
                        color: 'gray'
                    },
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 15
                    }
                },
                vAxis: {
                    title: 'vehicle speed (km/hr)',
                    minValue: 0,
                    maxValue: 3,
                    count: 1,
                    baselineColor: 'red',
                    titleTextStyle: {
                        color: 'black',
                        fontSize: 15
                    }
                },
                width: 800,
                height: 400,
                legend: {
                    position: 'right',
                    maxLines: 3,
                    textStyle: {
                        color: 'black',
                        fontSize: 10
                    }
                },
                bar: {
                    groupWidth: '75%'
                },
                isStacked: true,
                colors : ['#00BFFF', '#F4FA58', '#FE2E2E', '#FF00BF']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
            chart.draw(data, options);
        }
    </script>

    <div id="columnchart_stacked" style="width: 800px; height: 400px;"></div>
</body>
</html>
