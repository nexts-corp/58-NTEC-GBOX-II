<?php
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>TATANAD Data Acquistion</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
google.load('visualization', '1', {packages:['gauge']});
google.setOnLoadCallback(drawChart);
function drawChart() {
<?php
$nd100 = fopen('score.txt', 'r');
$data_input = fgets($nd100);
fclose($nd100);
$dat_in = explode('|',$data_input); $v1=$dat_in[4]; $v2=$dat_in[5]; $v3=$dat_in[6]; $v4=$dat_in[7]; echo " var data = google.visualization.arrayToDataTable([
['Label', 'Value'],
['V1', $v1],
['V2', $v2],
['V3', $v3],
['V4', $v4]
]);
";
?>
var options = { width: 600, height: 220, max:5,
redFrom: 3, redTo: 5,
yellowFrom:2, yellowTo: 3, greenFrom:1, greenTo:2,
minorTicks: 0.1
};
var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
chart.draw(data, options);
}
</script></head>
<body>




<form method="post" action="NetDAQ01.php" enctype="multipart/form-data">

<table style="width: 900px; height: 137px; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="4" cellspacing="2">
<tbody>
<tr align="center">
<td colspan="3" rowspan="1" style="background-color: rgb(51, 153, 204); text-align: left; width: 495px;"><span style="font-family: arial,sans-serif; font-size: small; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none; font-weight: bold; color: white;">&nbsp;Data&nbsp;acquisition &nbsp;<?php require(dirname(__FILE__)."/../../config.php");
$deviceid = $_GET["deviceid"];
$Date1 = $_GET["date1"];
$time1 = $_GET["time1"];
$time2 = $_GET["time2"];

$Time1 = $time1;
$Time2 = $time2;

include("f2_getdata_gbox.php"); 


include("f2_adc_function.php");?> </span><span style="color: rgb(0, 0, 0); font-family: arial,sans-serif; font-size: small; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;"></span></td>
</tr>
<tr>
<td colspan="1" rowspan="1" style="background-color: rgb(153, 255, 255); width: 377px;"><span style="font-family: Arial;"></span><span style="font-family: Arial;">&nbsp;</span><span style="font-family: Arial;"><small> &#3623;&#3633;&#3609;&#3607;&#3637;&#3656; <?php 
echo "$Date1";?> &#3648;&#3623;&#3621;&#3634; <?php 
echo "$Time1 - $Time2";?> &#3592;&#3635;&#3609;&#3623;&#3609;&#3586;&#3657;&#3629;&#3617;&#3641;&#3621; <?php echo "$num_rows";?></small><br>
</span>
    <!--<php title="include('select_date.php');"></php>--></td>
<td rowspan="1" style="background-color: rgb(255, 255, 204); text-align: left; width: 495px;" colspan="2"><small><small style="font-family: Arial;">
    <!--<php title="$today = date(&quot;D j M Y&quot;); $time = date(&quot;G:i:s&quot;); echo &quot; &lt;b&gt;Date :&lt;/b&gt; $today &lt;b&gt; Time :&lt;/b&gt; $time&lt;b&gt; Device :&lt;/b&gt; ND100&quot;; " xmlns="http://disruptive-innovations.com/zoo/nvu"></php>--></small>&nbsp;</small>
    <!--<php title="echo &quot;$date_dump[$CallData]&quot;; "></php>-->
    <!--<php title="echo &quot;$num_rows2&quot;; "></php>--></td>
</tr>
<tr>
<td style="width: 377px;"><small>
        <!--<php title="include('select_date.php');"></php>--></small></td>
<td style="text-align: center; width: 495px;" colspan="1" rowspan="4"><?php $name = $point;
/* include('NetDAQ_gauge.php'); */?><small><span style="font-family: Arial;">center</span></small>
<?php $point_in = $point;
if (($point=="") OR ($point<=0.1)) {$point_in=0.1;}
echo "<input value='$point_in' size='2' name='point'><small><span
style='font-family: Arial;'> ";
?>&nbsp;<input name="CallData" value="X1" type="submit"> <input name="CallData" value="X20" type="submit"> <input name="CallData" value="X100" type="submit"> <input style="font-size: 14px; font-weight: bold;" name="CallData" value="All" type="submit"></td>
<td></td>
</tr>
<tr>
<td colspan="1" rowspan="5" style="vertical-align: top; text-align: left; background-color: rgb(204, 255, 255); width: 377px;"><small>
</small><small>
        <!--<php title="$nd100 = fopen('dataID1_5D.csv', 'r'); $num=0; while (!feof($nd100)) { $data[$num] = fgets($nd100); $num = $num+1; } echo &quot;$data[1]&quot;; " xmlns="http://disruptive-innovations.com/zoo/nvu"></php>--></small>
        <!--<php title="include('select_date.php');"></php>-->
    <small>Event Index<br><?php
for ($i=1; $i<=$adc1_num; $i++) {

echo " <b> &#3621;&#3635;&#3604;&#3633;&#3610;&#3607;&#3637;&#3656; $i </b> &#3648;&#3623;&#3621;&#3634; $time1_adc1[$i] - $time2_adc1[$i] , index $num_rows1_adc1[$i] - $num_rows2_adc1[$i] <br> ";

}



?><br><span style="font-family: Arial;"></span>
        <!--<php title="include('select_date.php');"></php>--></small>
<br><br><br>&nbsp;</td>
<td></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
</tr>
<tr>
<td align="undefined" valign="undefined"></td>
</tr>
<tr>
<td colspan="1" rowspan="3" style="text-align: center; vertical-align: top; width: 495px;"><?php include("f2_adc_graph.php");?></td>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr><td style="background-color: rgb(204, 255, 255); vertical-align: bottom; width: 377px;"><?php echo "<table border='1' bordercolor='white' width='300'> <tr bgcolor='#A9E2F3'> <td colspan='4'> <b> Event Number  </b> $date_dump[$CallData] </td> </tr>";
echo "<tr> <td align='center'> &#3588;&#3619;&#3633;&#3657;&#3591;&#3607;&#3637;&#3656; </td> <td align='center'> time </td> <td align='center'> duration </td> <td align='center'> Vmax </td> </tr> ";

for ($m=1; $m<=$dump_num2; $m++) {
 $duration = $time_dump2[$m] - $time_dump1[$m];
echo "<tr> 
<td align='center'> $m </td> 
<td align='center'> $time_dump1[$m] - $time_dump2[$m] </td> 
<td align='center'>  $duration </td> <td align='center'> $dump_max[$m] </td> </tr>


"; 

}
echo "</table>";?></td><td></td></tr><tr>
<td colspan="3" rowspan="1" style="text-align: center; height: 5px; width: 495px;"><small><small><?php if ($fileErr==0) {
$lo = rand(0,180);
$hi = $lo+720;
$T2 = rand(10,50);
$j = 0;
$dat = explode(',',$data[10]);
echo "<table width='990'> ";
echo " <tr bgcolor='#F4FA58'> <td align='center'><b> $dat[0] </b> </td> <td align='center'><b> $dat[1] </b> </td> <td align='center'><b> $dat[2] </b> </td> <td align='center'><b> $dat[3] </b> </td> <td align='center'><b> $dat[4] </b> </td> <td align='center'><b> $dat[5] </b> </td> <td align='center'><b> $dat[6] </b> </td> <td align='center'><b> $dat[7] </b> </td> <td align='center'><b> $dat[8] </b> </td> <td align='center'><b> $dat[9] </b> </td> <td align='center'><b> $dat[10] </b> </td> <td align='center'><b> $dat[11] </b> </td> <td align='center'><b> $dat[12] </b> </td> <td align='center'><b> $dat[13] </b> </td> <td align='center'><b> $dat[14] </b> </td> <td align='center'><b> $dat[15] </b> </td> <td align='center'><b> $dat[16] </b> </td> <td align='center'><b> $dat[17] </b> </td> <td align='center'><b> $dat[18] </b> </td> <td align='center'><b> $dat[19] </b> </td> </tr> "; 

for ($i=0; $i<=($num_rows2) ; $i++) {
if ($bg == "#F2F5A9") { $bg = "#F4FA58";}
else { $bg = "#F2F5A9";}
echo " <tr bgcolor='$bg'> <td> $time_i[$i] </td>
<td> $adc1_i[$i] </td> <td> $adc2_i[$i] </td> <td> $adc3_i[$i] </td> <td> $adc4_i[$i] </td> <td> $adc5_i[$i] </td>
<td> $adc6_i[$i] </td> <td> $adc7_i[$i] </td> <td> $adc8_i[$i] </td> <td> $dump_i[$i] </td> <td> - </td><td> - </td>
<td> - </td><td> - </td>
<td> - </td><td> - </td>
<td> - </td><td> - </td>
<td> - </td>
</tr> ";
}
echo "</table> ";
}?></small></small></td>
</tr>
<tr>
<td style="background-color: rgb(255, 255, 153); height: 8px; width: 377px;"></td>
<td style="background-color: rgb(255, 255, 153); height: 8px; width: 495px;"></td>
<td></td>
</tr>
</tbody>
</table>

</form>
</body></html>