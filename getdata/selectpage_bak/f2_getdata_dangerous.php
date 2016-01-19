<HTML>
<HEAD>
    <TITLE>New Document</TITLE>
</HEAD>
<BODY>


<?php
$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_NAME,$link);
mysql_query("SET NAMES 'utf8'");

$exe2 = "SELECT latitude,longitude,colorD,colorDF,type FROM dangerous";
$result2 = mysql_query($exe2)or die(mysql_error());
$dan_rows = mysql_numrows($result2);

$latD = array (  );   $lonD = array (  );
$latOffset = 0.0015; $lonOffset = 0.0017;

$i = 0;
while(list($Dlat,$Dlon,$colorD,$colorDF,$Dtype) = mysql_fetch_row($result2)){
    $latD[$i] = $Dlat;
    $lonD[$i] = $Dlon;
    $Dtype2[$i] = $Dtype;
    $i++;
}
mysql_close($link);

?>
</BODY>
</HTML>
