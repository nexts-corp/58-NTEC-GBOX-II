<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

      function drawChart() {

        <?php
    require(dirname(__FILE__)."/../../config.php");
    $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Error Connect to Database");
    $objDB = mysql_select_db(DB_NAME);

    $sql_user = "SELECT * FROM user WHERE username='".$_COOKIE["gbox"]["username"]."'";
    $res_user = mysql_query($sql_user, $db);
    $data_user = mysql_fetch_array($res_user);

    $selectT = $data_user["firstname"]." ".$data_user["lastname"];

    $sql_dev = "SELECT * FROM device WHERE id='".$_GET["deviceid"]."'";
    $res_dev = mysql_query($sql_dev, $db);
    $data_dev = mysql_fetch_array($res_dev);

    $deviceName = $data_dev["device_desc"];

    $id = $_GET["deviceid"];
    $Date1 = $_GET["date1"];
    $Time1 = $_GET["time1"];
    $Time2 = $_GET["time2"];

    $strSubmit = " SELECT * FROM  `acctype` WHERE  `date` =  '$Date1' AND  `time1` =  '$Time1'  " ; /*The Last time stamp*/
    $objSubmit1 = mysql_query($strSubmit, $db) or die ("Error Query [".$strSubmit."]");
    $submit = mysql_fetch_array($objSubmit1);

    $k1 = $submit["release"];
    $k2 = explode(":",$k1);
    $l0 = (int)$k2[0];   $l1 = (int)$k2[1];  $l2 = (int)$k2[2];
    $release = $l0 + $l1 + $l2;

    $k1 = $submit["overtake"];
    $k2 = explode(":",$k1);
    $l0 = (int)$k2[0];   $l1 = (int)$k2[1];  $l2 = (int)$k2[2];
    $l3 = (int)$k2[3];   $l4 = (int)$k2[4];  $l5 = (int)$k2[5];
    $overtake = $l0 + $l1 + $l2 + $l3 + $l4 + $l5;

    $k1 = $submit["closeto"];
    $k2 = explode(":",$k1);
    $l0 = (int)$k2[0];   $l1 = (int)$k2[1];  $l2 = (int)$k2[2];
    $l3 = (int)$k2[3];   $l4 = (int)$k2[4];  $l5 = (int)$k2[5];
    $closeto = $l0 + $l1 + $l2 + $l3 + $l4 + $l5;

    $k1 = $submit["stop"];
    $k2 = explode(":",$k1);
    $l0 = (int)$k2[0];   $l1 = (int)$k2[1];  $l2 = (int)$k2[2];
    $l3 = (int)$k2[3];   $l4 = (int)$k2[4];  $l5 = (int)$k2[5];
    $stop = $l0 + $l1 + $l2 + $l3 + $l4 + $l5;

    $k1 = $submit["type0"];
    $k2 = explode(":",$k1);
    $l0 = (int)$k2[0];   $l1 = (int)$k2[1];  $l2 = (int)$k2[2];
    $type0 = $l0 + $l1 + $l2 ;
    $slalom = $l0;
    $walking = $l1;
    $lose = $l2;

    /*  $j1 = $typeNum11 + $typeNum12 + $typeNum13 + $typeNum14 + $typeNum15 + $typeNum16 ;
      $j2 = $typeNum21 + $typeNum22 + $typeNum23 + $typeNum24 + $typeNum25 + $typeNum26 ;
      $j3 = $typeNum31 + $typeNum32 + $typeNum33 + $typeNum34 + $typeNum35 + $typeNum36 ;
      $j4 = $typeNum41 + $typeNum42 + $typeNum43 + $typeNum44 + $typeNum45 + $typeNum46 ;
      $j5 = $typeNum51 + $typeNum52 + $typeNum53 + $typeNum54 + $typeNum55 + $typeNum56 ;    */


    echo "
          var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Release', $release],
          ['Overtake',  $overtake],
          ['Close to',  $closeto],
          ['Stop',  $stop],
          ['Slalom',  $slalom],
          ['Walking',  $walking],
          ['GPS Lose',  $lose],
        ]);
       ";

    echo "  var options = {
          title: 'Type of ACC. Behavior $deviceName Date : $Date1  Time :  $Time1 - $Time2 '
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
