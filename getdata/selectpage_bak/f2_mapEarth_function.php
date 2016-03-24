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
        var map = new GMap2(document.getElementById("map_canvas"),{ size: new GSize(550,360) } );
  		//map.removeMapType(G_HYBRID_MAP);
        //map.setMapType(G_NORMAL_MAP);

        map.setMapType(G_SATELLITE_MAP);
		map.setCenter(new GLatLng(14.0700, 100.6200), 11);
		var mapControl = new GMapTypeControl();
		map.addControl(mapControl);
		map.addControl(new GLargeMapControl());

<?php  /* Read Data to Marker icon #####################################################*/

if ($over_index < 100) {
    $lo= $spd_pint1[$over_index];
    $hi= $spd_pint[$over_index];
}
  elseif (($over_index>=300) AND ($over_index<400)) {
     $jj = $over_index-300;
     $lo = $point0[$jj];
     $hi = $point4[$jj];
     }
     
  elseif (($over_index>=400) AND ($over_index<500)) {
     $jj = $over_index-400;
     $lo = $pointE1;
     $hi = $pointE1;
     }

  if ($num_rows!=0) {

   $maxSpeed=0;  $crossj = $over_index-400;

   for ($i=1; $i<=$num_rows; $i++) {

    $lat1L[$i] = DMStoDECLn($lat_i[$i]);
    $lon1L[$i] = DMStoDECLn($lon_i[$i]);

    $speed = $speed_i[$i]*$spd_unit;
    if (($driver == "3dgps01") OR ($driver == "dg200") OR ($driver == "gps01")) {$direction = $DirAlt;}

     $lat1 = DMStoDECLn($lat_i[$i]);
     $lon1 = DMStoDECLn($lon_i[$i]);
     $x = round($lon1,6);
     $y = round($lat1,6);
     $direction = $dir_i[$i];
     
     if ($i==$lo) {
       $lat_1 = $lat1;
       $lon_1 = $lon1;
       echo "map.setCenter(new GLatLng(".$lat_1.",".$lon_1."),14);\n";
     }
     
     if ($time==$times1) { $latL1 = $lat1; $lonL1 = $lon1;  }
     if ($time==$times2) { $latL2 = $lat1; $lonL2 = $lon1;  }
     
     if ($i==1) { $timeStr = $time;}
     if ($i==$num_rows) {$timeStp = $time;}

     if ($speed>$maxSpeed) {$maxSpeed=round($speed,2);}

    /*$distance = distank($lat0,$lon0,$lat1,$lon1); */

        /* Icon for speed zone */
         if ($speed<81) {$icon = "m1.png";}
            elseif (($speed>=81) AND ($speed<=88)) { $icon = "m2.png"; }
            elseif (($speed>88) AND ($speed<=96))  { $icon = "m3.png"; }
            elseif (($speed>96) AND ($speed<=104)) { $icon = "m4.png"; }
            elseif ( $speed>104) {$icon = "m5.png"; }

         if     (($over_index<100)  AND($i==$spd_pint2[$over_index])) {$icon = "bus.png";}
         elseif (($over_index>=100) AND ($over_index<300) AND ($i==$dowsy_point1[$jj]))     {$icon = "bus.png";}
        elseif (($over_index>=400) AND ($i==$crossPoint1[$jj]))      {$icon = "bus.png";}

     $i_div =  ($i%10);
    
    if ($i_div==0) {
        echo "\n var point = new GLatLng(".$lat1.",".$lon1.");\n";
        echo "\n var msg_marker = 'point($i) Time : $time   <br> Vehicle speed : $speed km/hr <br> Direction : $direction degree<br> Latitude : $y <br> Longitude : $x';\n";
        echo "\n var icon_sty = '$icon';\n";

     if ($icon == "bus.png")
         { echo "var marker = createMarker2(point,msg_marker,icon_sty);\n";   }
     else
         { echo "var marker = createMarker(point,msg_marker,icon_sty);\n";   }
        
        echo "map.addOverlay(marker);\n";
        echo "\n";
    }
        
    }  /* close while/for loop*/

    }  /* End of if numrows*/

    elseif ($num_rows==0)   {

        echo "map.setCenter(new GLatLng(14.0700,100.6200),6);\n";
        echo "\n var point = new GLatLng(14.0700,100.6200);\n";
        echo "\n var msg_marker = 'Time : 0 <br> Vehicle speed : 0 km/hr <br> 0 m <br> Latitude : 0 <br> Longitude : 0';\n";

        echo "var marker = createMarker(point,msg_marker,icon_sty);\n";
        echo "map.addOverlay(marker);\n";
        echo "\n";
    } /* End of if else : num_row!=0 */

/* ======================================== */

    echo " var boundaries = new GLatLngBounds(new GLatLng(14.0700,100.6200), new GLatLng(14.0800,100.6300));   ";
    echo " var oldmap = new GGroundOverlay('http://www.thairoadsafety.net/DrivingScore/bus.png', boundaries);  ";
    echo " map.setUIToDefault();   ";
    echo " map.addOverlay(oldmap); ";

/* Read and Draw Dangerous Zone #################################################*/

/*    $myDB2 = "dangerous";
    mysql_select_db($myDB2, $db);
    $exe2 = "SELECT latitude,longitude,colorD,colorDF,type FROM `2555`";
    $result2 = mysql_query($exe2)or die(mysql_error());
    $dan_rows = mysql_numrows($result2);

  $latD = array (  );   $lonD = array (  );  $colorD = array ( );  $colorDF = array ( );
  $i = 0;

while(list($Dlat,$Dlon,$Dcolor,$DFcolor,$Dtype) = mysql_fetch_row($result2)){

     $latD[$i] = $Dlat;
     $lonD[$i] = $Dlon;
     $colorD[$i] = $Dcolor;
     $colorDF[$i] = $DFcolor;
     $i = $i+1;

   }

    $latOffsetA = 0.0015; $lonOffsetA = 0.0017;
    $latOffsetB = 0.0012; $lonOffsetB = 0.0012;
    $D1_Score1 = array (0,0,0,0);
    $D1_Score2 = array (0,0,0,0);
    $D1_Score3 = array (0,0,0,0);
    $Dan_Score1 = 0;   $Dan_Score2 = 0;
    $Dan_Score3 = 0;   $GSpeedRZone =0;
    $GSpeedYZone = 0;  $GSpeedGZone = 0;
    $YSpeedRZone = 0;  $YSpeedYZone = 0;
    $score14=0; $score14n=0;

 for ($i = 0; $i <= ($dan_rows-1); $i++) {

     echo "\n var polygon = new GPolygon([

          new GLatLng($latD[$i] , $lonD[$i] - $lonOffsetA),
          new GLatLng($latD[$i] + $latOffsetB , $lonD[$i] - $lonOffsetB),

          new GLatLng($latD[$i] + $latOffsetA, $lonD[$i]),
          new GLatLng($latD[$i] + $latOffsetB , $lonD[$i] + $lonOffsetB),

          new GLatLng($latD[$i], $lonD[$i] + $lonOffsetA),
          new GLatLng($latD[$i] - $latOffsetB , $lonD[$i] + $lonOffsetB),

          new GLatLng($latD[$i] - $latOffsetA, $lonD[$i]),
          new GLatLng($latD[$i] - $latOffsetB , $lonD[$i] - $lonOffsetB),

          new GLatLng($latD[$i], $lonD[$i] - $lonOffsetA)],
          '$colorD[$i]' , 2, 1, '$colorDF[$i]', 0.5);
          map.addOverlay(polygon); \n";

    $latD_L = DECtoDMSLn(($latD[$i] +  $latOffsetA));
    $latD_R = DECtoDMSLn(($latD[$i] -  $latOffsetA));

    $lonD_L = DECtoDMSLn(($lonD[$i] +  $lonOffsetA));
    $lonD_R = DECtoDMSLn(($lonD[$i] -  $lonOffsetA));

    switch ($colorD[$i])
    {
       case "#f33f00" : $zone1 = 0;  $zone2 = -2;  $zone3 = -4; break;
       case "#FFBF00" : $zone1 = -1; $zone2 = 0;  $zone3 = -2; break;
       case "#088A29" : $zone1 = -2; $zone2 = -1;  $zone3 = 0;
    }


 }   /* close for */

/* ================================= */
/*if ($selectT=="Submit speed over") {
   echo " var polyline = new GPolyline([
  		  new GLatLng($latL1,$lonL1),
  		  new GLatLng($latL2,$lonL2)
		], '#ff0000', 10);   ";

   echo "  map.addOverlay(polyline); ";
} */
?>

var polyline = new GPolyline([
  new GLatLng(14.95, 101.62),
  new GLatLng(14.95, 102.42)
], "#ff0000", 2);
map.addOverlay(polyline);

var polyline = new GPolyline([
  new GLatLng(14.98, 101.69),
  new GLatLng(14.98, 102.49)
], "#ff0000", 2);
map.addOverlay(polyline);

} // End of if (in function)
} // End of Function

</script>
</head>

<body onload="initialize()" onunload="GUnload()">
<div id="map_canvas" style="width: 550px; height: 300px"></div>

</body>
</html>


