<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
         
     data.addColumn('number', 'Release');
     data.addColumn('number', 'Overtake');
     data.addColumn('number', 'Close to');
     data.addColumn('number', 'Stop');
     data.addColumn('number', 'Slalom');
     data.addColumn('number', 'Walking');
     data.addColumn('number', 'GPSLose');

<?php
   $selectT = $_GET["selectT"];
   //$selectT = $_REQUEST["selectT"];

   if ($selectT=="") {$selectT="Test18";}

   $db = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
   $objDB = mysql_select_db(DB_NAME); /*Start Frame at Open selectable Always*/
   mysql_query("SET NAMES 'tis620'");

   $exe1 = "SELECT `number`,`name`,`device`,`route`,`acclimit`,`speedunit`,`date`,`time1`,`time2`,`numscore`,`x1`,`x2`
            FROM `selecttest` WHERE `name`='$selectT' ORDER BY `date` ASC ";
   $result = mysql_query($exe1)or die(mysql_error());
   $num_rows = mysql_numrows($result);

   for ($i=0; $i<$num_rows; $i++) {
     list($number,$name,$device,$route,$acclimit,$speedunit,$date,$time1,$time2,$numscore,$x1,$x2) = mysql_fetch_row($result);
     $dateT[$i] = $date;
     $time1T[$i] = $time1;
     $time2T[$i] = $time2;
   }
     $nums_score = $num_rows-1;

    $sql = " TRUNCATE TABLE  `intacc` ";
    $result = mysql_query($sql);

   $k=0;

   for ($i=1; $i<=$nums_score; $i++) {

/* === Select Last Calculation of Each Date-Time (16 Date-Time) ===*/

$exe1 = "SELECT  `spdavg` ,`spdmax` ,`accmax` ,`accmin` ,`distance` ,`forcet` ,`release` ,`overtake` ,`closeto` ,`stop` ,`type0`
         ,`type` ,`score` FROM `acctype`

         WHERE `test`='$selectT' AND `date`='$dateT[$i]' AND `time1`='$time1T[$i]'  ORDER BY  `score` DESC  ";

$result = mysql_query($exe1)or die(mysql_error());
$num_rows = mysql_numrows($result);

list($spdavg0 ,$spdmax0 ,$accmax0 ,$accmin0 ,$distance0 ,$forcet0 ,$release0 ,$overtake0 ,$closeto0 ,$stop0 ,$type00,$typeT0 ,$scoreT0) = mysql_fetch_row($result);

    $strSQL = " INSERT INTO  `intacc` (  `index` ,  `test` ,  `date` ,  `time1` ,  `time2` ,  `spdavg` ,  `spdmax` ,  `accmax` ,  `accmin` ,  `distance` ,  `forcet` ,  `release` ,  `overtake` ,  `closeto` ,  `stop` ,  `type0`,  `type` ,  `score` )
VALUES (
'$i', '$selectT','$dateT[$i]','$time1[$i]','$time2[$i]','$spdavg0','$spdmax0','$accmax0','$accmin0','$distance0','$forcet0','$release0',
      '$overtake0',  '$closeto0',  '$stop0',  '$type00' ,  '$typeT0',  '$scoreT0'
);
";
    $objQuery = mysql_query($strSQL);

}

/*==== Ready for 16 date-time Update Score ===*/


$exe1 = "SELECT `index`,`test`,`date`,`time1`,`time2`,`spdavg`,`spdmax`,`accmax`,`accmin`,`distance`,`forcet`,`release`,`overtake`,`closeto` ,  `stop` ,`type0`
         FROM `intacc` ORDER BY `score` ";
$result = mysql_query($exe1)or die(mysql_error());
$num_score = mysql_numrows($result);

 for ($j=0; $j<=$num_score; $j++) {

 list($index0,$test0,$date0,$time10,$time20,$spdavg0,$spdmax0,$accmax0,$accmin0,$distance0,$forcet0,$release0,$overtake0,$closeto0,$stop0,$type00) = mysql_fetch_row($result);

$arr = explode(':',$release0);
$rel1[$j] = $rel1[$j] + $arr[0] + $arr[1] + $arr[2];

$arr = explode(':',$overtake0);
$overt[$j] = $overt[$j] + $arr[0] + $arr[1] + $arr[2]+ $arr[3] + $arr[4] + $arr[5];

$arr = explode(':',$closeto0);
$close[$j] = $close[$j] + $arr[0] + $arr[1] + $arr[2]+ $arr[3] + $arr[4] + $arr[5];

$arr = explode(':',$stop0);
$stop[$j] = $stop[$j] + $arr[0] + $arr[1] + $arr[2]+ $arr[3] + $arr[4] + $arr[5];

$arr = explode(':',$type00);
$sla[$j] = $arr[0]+0;
$walk[$j] = $arr[1]+0;
$lose[$j] = $arr[2]+0;

$time_s1 = explode(":", $time10);
$sec1 = ((($time_s1[0])*3600) + (($time_s1[1])*60) + ($time_s1[2]));
$time_s2 = explode(":", $time20);
$sec2 = ((($time_s2[0])*3600) + (($time_s2[1])*60) + ($time_s2[2]));
$Dsec = $sec2-$sec1;

if ($Dsec!=0) {
   $dura100[$j] = round((($duration0/$Dsec)*100),2);
   $Dsec0=$Dsec0+$Dsec;
   }

     $distanceSum = $distanceSum + $distance0;
     $datev[$j] = $date0;

$gpslose = $gpslose + $lose[$j];
$walkk = $walkk+$walk[$j];
$slalomm = $slalomm+ $sla[$j];
$stopp = $stopp+$stop[$j];
$closee = $closee + $close[$j];
$overr = $overr + $overt[$j];
$rell = $rell+$rel1[$j];

}

$scoreT = $gpslose+ $walkk+  $slalomm+  $stopp+ $closee+ $overr+$rell;

if ($scoreT!=0) {
   $gpslose = round((100*$gpslose/$scoreT),2);
   $walkk =   round((100*$walkk/$scoreT),2);
   $slalomm =   round((100*$slalomm/$scoreT),2);
   $closee =   round((100*$closee/$scoreT),2);
   $stopp =   round((100*$stopp/$scoreT),2);
   $overr =   round((100*$overr/$scoreT),2);
   $rell =   round((100*$rell/$scoreT),2);
}

      $date2 = "0000-00-00";
      $date1 = "9999-99-99";

   for ($i=0; $i<$num_score; $i++) {
   
      echo " data.addRows([ ['$datev[$i]',$rel1[$i] ,$overt[$i],$close[$i],$stop[$i],$sla[$i],$walk[$i],$lose[$i] ] ]); ";
      
      $otp1_sum = $otp1_sum + $otp1[$i];
      $otp2_sum = $otp2_sum + $otp2[$i];
      $otp3_sum = $otp3_sum + $otp3[$i];
      $otp4_sum = $otp4_sum + $otp4[$i];
      
      $utpd_sum = $utpd_sum + $utpd[$i];
      $utpl_sum = $utpl_sum + $utpl[$i];
      
      if       ($datev[$i]>=$date2) { $date2 = $datev[$i];}
      elseif   ($datev[$i]<=$date1) { $date1 = $datev[$i];}
   }
   
   $sum =  $otp1_sum + $otp2_sum + $otp3_sum + $otp4_sum + $utpd_sum + $utpl_sum;
   
   if ($sum!=0) {
   
       $otp1_sum1 = round((100*$otp1_sum/$sum),2);
       $otp2_sum1 = round((100*$otp2_sum/$sum),2);
       $otp3_sum1 = round((100*$otp3_sum/$sum),2);
       $otp4_sum1 = round((100*$otp4_sum/$sum),2);
       
       $utpd_sum1 = round((100*$utpd_sum/$sum),2);
       $utpl_sum1 = round((100*$utpl_sum/$sum),2);
       
   }
   
   if ($num_score!=0) {

       $otp1_sum2 = round(($otp1_sum/$num_score),2);
       $otp2_sum2 = round(($otp2_sum/$num_score),2);
       $otp3_sum2 = round(($otp3_sum/$num_score),2);
       $otp4_sum2 = round(($otp4_sum/$num_score),2);

       $utpd_sum2 = round(($utpd_sum/$num_score),2);
       $utpl_sum2 = round(($utpl_sum/$num_score),2);

   }
   

   ?>
   
     var options = {

    <?php echo " title: 'Acceleration Type : $route ($selectT) : $dateT[0] - $dateT[$nums_score]',
     titleTextStyle: {color: 'red', fontSize: 15},

          hAxis: {title: 'Test Date', minValue: 0 ,  count: 1 ,  baselineColor: 'red'
                 ,gridlines:{color:'gray'},titleTextStyle:{color: 'black' , fontSize: 15}
                 },
          vAxis: {title: 'number of acceleration type',  minValue: 0 ,  maxValue:6 ,  count: 1, baselineColor: 'red'
                 ,titleTextStyle:{color: 'black' , fontSize: 15}
                 },

        width: 1000,
        height: 400,
        legend: { position: 'right', maxLines: 3 ,  textStyle: {color: 'black', fontSize: 13}},
    	bar: {groupWidth: '75%'},
        isStacked: true,

         colors : ['#0080FF', '#CEF6F5', '#00FF00', '#BCF5A9', '#F4FA58', '#F2F5A9', '#CC2EFA', '#F5A9BC', '#FE2E64'],
      };
      ";     ?>
      
      var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
      chart.draw(data, options);
  }
  </script>
<div id="columnchart_stacked" style="width: 1000px; height: 400px;"></div>


  </body>
</html>
