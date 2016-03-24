<?php
error_reporting(0);
require(dirname(__FILE__)."/../../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title> TATANAD GPS Supervisory Driver Behavior Score </title>

<meta http-equiv="Content-Language" content="th">
<meta http-equiv="content-Type" content="text/html; charset=window-874">
<meta http-equiv="content-Type" content="text/html; charset=tis-620">

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;
key=ABQIAAAA1TLsxD4XQeiCmWpYnzZ5nhQxeaWx9A5kVr5BJSPxoxZpsh84nhSlSg9dsNKIUF6TfIL-XzBIaHb9yA"
type="text/javascript"></script>

<script type="text/javascript">

function createMarker(point,html,icon) {
    var BlueIcon = new GIcon(G_DEFAULT_ICON);
        BlueIcon.image = icon;
        BlueIcon.title = "test";
        markerOptions = { icon : BlueIcon };
        BlueIcon.shadowSize = new GSize(16, 16);
        BlueIcon.iconSize = new GSize(16, 16);
        BlueIcon.iconAnchor = new GPoint(10, 10);

    var marker = new GMarker(point,markerOptions);
   // var label = new ELabel(point, "1");
    var msg1 = html;
    GEvent.addListener(marker, "click", function() {marker.openInfoWindowHtml(html);} );

    return marker;

    }

 function createMarker2(point,html,icon) {
    var BlueIcon = new GIcon(G_DEFAULT_ICON);
        BlueIcon.image = icon;
        BlueIcon.title = "test";
        markerOptions = { icon : BlueIcon };
        BlueIcon.shadowSize = new GSize(16, 16);
        BlueIcon.iconSize = new GSize(32, 32);
        BlueIcon.iconAnchor = new GPoint(10, 10);

    var marker = new GMarker(point,markerOptions);
   // var label = new ELabel(point, "1");
    var msg1 = html;
    GEvent.addListener(marker, "click", function() {marker.openInfoWindowHtml(html);} );

    return marker;

    }

function initialize() {
    	if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas") );
  		//map.removeMapType(G_HYBRID_MAP);
        map.setMapType(G_NORMAL_MAP);
		map.setCenter(new GLatLng(14.0700, 100.6200), 11);
		var mapControl = new GMapTypeControl();
		map.addControl(mapControl);
		map.addControl(new GLargeMapControl());

<?php  /* Read Data to Marker icon #####################################################*/
    $db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    //$objDB = mysqli_select_db("tanadgps");

    mysqli_select_db(DB_NAME, $db);

    /*$execute = "SELECT id FROM device WHERE device_serial='".$_GET['serial']."'";
    $result = mysqli_query($execute)or die(mysqli_error());
    $data = mysqli_fetch_array($result);
*/
    $fleet = $_GET["id"];
    $start_arr = explode(":", $_GET["time1"]);
    $stop_arr = explode(":", $_GET["time2"]);

    $day_arr = explode("/", $_GET["day1"]);

    $sql_dev = "SELECT * FROM device WHERE id='".$_GET["id"]."'";
    $res_dev = mysqli_query($sql_dev, $db);
    $data_dev = mysqli_fetch_array($res_dev);

    if($data_dev["device_type_id"] == "1"){ //GBox
        $Time1 = mktime($start_arr[0], $start_arr[1], 0, $day_arr[1], $day_arr[0], $day_arr[2]) - date("Z");
        $Time2 = mktime($stop_arr[0], $stop_arr[1], 0, $day_arr[1], $day_arr[0], $day_arr[2]) - date("Z");

        $exe1 = "SELECT time,latitude,longitude,speed,direction FROM `data` WHERE `deviceid` = '$fleet' AND `time` >= '$Time1' AND `time` <= '$Time2' ORDER BY  `time` ASC";
    }
    else if($data_dev["device_type_id"] == "2"){ //DG200
        $Date = date("Y-m-d", mktime(0, 0, 0, $day_arr[1], $day_arr[0], $day_arr[2]));
        $Time1 = $_GET["time1"];
        $Time2 = $_GET["time2"];

        $exe1 = "SELECT time,latitude,longitude,speed,direction FROM `datadg200` WHERE `deviceid` = '$fleet' AND `date` = '$Date' AND `time` >= '$Time1' AND `time` <= '$Time2' ORDER BY  `time` ASC";
    }
    else if($data_dev["device_type_id"] == "3"){ //DLT
        $Date = date("Y-m-d", mktime(0, 0, 0, $day_arr[1], $day_arr[0], $day_arr[2]));
        $Time1 = $_GET["time1"];
        $Time2 = $_GET["time2"];

        $exe1 = "SELECT time,latitude,longitude,speed,direction FROM `datadlt01` WHERE `deviceid` = '$fleet' AND `date` = '$Date' AND `time` >= '$Time1' AND `time` <= '$Time2' ORDER BY  `time` ASC";
    }
    else if($data_dev["device_type_id"] == "4"){ //RV3D
        $Date = date("Y-m-d", mktime(0, 0, 0, $day_arr[1], $day_arr[0], $day_arr[2]));
        $Time1 = $_GET["time1"];
        $Time2 = $_GET["time2"];

        $exe1 = "SELECT time,latitude,longitude,speed,direction FROM `datarv3d` WHERE `deviceid` = '$fleet' AND `date` = '$Date' AND `time` >= '$Time1' AND `time` <= '$Time2' ORDER BY  `time` ASC";
    }
    $result1 = mysqli_query($exe1)or die(mysqli_error());
    $num_rows = mysqli_numrows($result1);

    $time_sec1 = explode(":", $Time1);
    $sec1 = ((($time_sec1[0])*3600) + (($time_sec1[1])*60) + ($time_sec1[2]));

    $time_sec2 = explode(":", $Time2);
    $sec2 = ((($time_sec2[0])*3600) + (($time_sec2[1])*60) + ($time_sec2[2]));

    $deltaT = $sec2-$sec1;

   if ($num_rows!=0) {

   /*while(list($time,$lat,$long,$speed,$direction) = mysqli_fetch_row($result1)){  */
   for ($i=0; $i<=$num_rows; $i++) {

    list($time,$lat,$long,$speed,$DirAlt) = mysqli_fetch_row($result1);

     $lat1 = DMStoDECLn($lat);
     $lon1 = DMStoDECLn($long);
     $direction = $DirAlt;

     if ($i==1) {
       echo "map.setCenter(new GLatLng(".$lat1.",".$lon1."), 6);\n";
       $timeStr = $time;
     }

     if ($i==$num_rows) {$timeStp = $time;}

    /* Icon for speed zone */
     if ($speed<81) {$icon = "m1.png";}
         elseif (($speed>=81) AND ($speed<=88)) { $icon = "m2.png"; }
         elseif (($speed>88) AND ($speed<=96)) { $icon = "m3.png"; }
         elseif (($speed>96) AND ($speed<=104)) { $icon = "m4.png"; }
         elseif ( $speed>104) {$icon = "m5.png"; }

    $i_div =  ($i%1);
    if ($i_div==0) {
        $time_convert = date("d-m-Y H:i:s", $time + date("Z"));

        echo "\n var point = new GLatLng(".$lat1.",".$lon1.");\n";
        echo "\n var msg_marker = 'point($i) Time : $time_convert ($time)   <br> Vehicle speed : $speed km/hr <br> Direction : $direction degree<br> Latitude : $lat1 <br> Longitude : $lon1';\n";
        echo "\n var icon_sty = '$icon';\n";
        echo "var marker = createMarker(point,msg_marker,icon_sty);\n";
        echo "map.addOverlay(marker);\n";
        echo "\n";
    }


    }  /* close while/for loop*/

    }  /* End of if numrows*/

    elseif ($num_rows==0)   {

        echo "map.setCenter(new GLatLng(14.0700,100.6200),6);\n";
        echo "\n var point = new GLatLng(14.0700,100.6200);\n";
        echo "\n var msg_marker = 'Time : 0 <br> Vehicle speed : 0 km/hr <br> 0 m <br> Latitude : 0 <br> Longitude : 0';\n";
        echo "\n var icon_sty = '$icon';\n";
        echo "var marker = createMarker(point,msg_marker,icon_sty);\n";
        echo "map.addOverlay(marker);\n";
        echo "\n";
    } /* End of if else : num_row!=0 */

/* ======================================== */

    echo " var boundaries = new GLatLngBounds(new GLatLng(14.0700,100.6200), new GLatLng(14.0800,100.6300));   ";
    echo " var oldmap = new GGroundOverlay('http://www.thairoadsafety.net/DrivingScore/bus.png', boundaries);  ";
    echo " map.setUIToDefault();   ";
    echo " map.addOverlay(oldmap); ";


?>

} // End of if (in function)
} // End of Function

</script>
</head>

<body onload="initialize()" style="margin: 0">
 <div class="ds_pointer" style="position: absolute;z-index: 100;color: #fff;background-color: rgba(0,0,0,.7)"><?php echo $_GET["id"]." (จำนวนจุด $num_rows)"; ?></div>
 <div id="map_canvas" style="width:100%; height:1000px"></div>

</body>
</html>


