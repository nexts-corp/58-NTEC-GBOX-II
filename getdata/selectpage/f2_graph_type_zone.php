<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require(dirname(__FILE__)."/../../config.php");
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
            $db = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
            $objDB = mysqli_select_db(DB_NAME);

            $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
            $res_user = mysqli_query($sql_user, $db);
            $data_user = mysqli_fetch_array($res_user);

            $selectT = $data_user["firstname"]." ".$data_user["lastname"];

            $sql_dev = "SELECT * FROM device WHERE id='".$_GET["deviceid"]."'";
            $res_dev = mysqli_query($sql_dev, $db);
            $data_dev = mysqli_fetch_array($res_dev);

            $deviceName = $data_dev["device_desc"];

            $id = $_GET["deviceid"];
            $Date1 = $_GET["date1"];
            $Time1 = $_GET["time1"];
            $Time2 = $_GET["time2"];

            $strSubmit = " SELECT * FROM  `zonetype` WHERE  `date` =  '$Date1' AND  `time1` =  '$Time1'  " ; /*The Last time stamp*/
            $objSubmit1 = mysqli_query($strSubmit) or die ("Error Query [".$strSubmit."]");
            $submit = mysqli_fetch_array($objSubmit1);

            $cr = $submit["cross"];
            $st = $submit["stop"];
            $nst = $submit["nstop"];
            $tr = $submit["train"];
            $cu = $submit["curve"];
            $lc = $submit["lanechange"];
            $ot = $submit["overtake"];
            $sl = $submit["slope"];


            echo "
                    var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['cross', $cr],
                    ['stop',  $st],
                    ['nstop',  $nst],
                    ['train',  $tr],
                    ['curve',  $cu],
                    ['lanechange',  $lc],
                    ['overtake',  $ot],
                    ['slope',  $sl],

                    ]);
                ";

            echo "  var options = {
                        title: 'Type of Zoning Behavior $id Date : $Date1  Time :  $Time1 - $Time2 '
                    };
                ";
            ?>

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="piechart" style="width: 1000px; height: 600px;"></div>
</body>
</html>
