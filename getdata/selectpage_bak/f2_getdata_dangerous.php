<HTML>
<HEAD>
    <TITLE>New Document</TITLE>
</HEAD>
<BODY>


<?php
$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysqli_select_db(DB_NAME,$link);
mysqli_query("SET NAMES 'utf8'");

$exe2 = "SELECT latitude,longitude,colorD,colorDF,type FROM dangerous";
$result2 = mysqli_query($exe2)or die(mysqli_error());
$dan_rows = mysqli_numrows($result2);

$latD = array (  );   $lonD = array (  );
$latOffset = 0.0015; $lonOffset = 0.0017;

$i = 0;
while(list($Dlat,$Dlon,$colorD,$colorDF,$Dtype) = mysqli_fetch_row($result2)){
    $latD[$i] = $Dlat;
    $lonD[$i] = $Dlon;
    $Dtype2[$i] = $Dtype;
    $i++;
}
mysqli_close($link);

?>
</BODY>
</HTML>
