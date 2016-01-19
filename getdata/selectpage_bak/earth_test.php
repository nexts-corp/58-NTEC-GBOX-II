<html>
<head>
   <title>multigeometry_example.html</title>

   <script src="//www.google.com/jsapi?key=ABQIAAAA1TLsxD4XQeiCmWpYnzZ5nhQxeaWx9A5kVr5BJSPxoxZpsh84nhSlSg9dsNKIUF6TfIL-XzBIaHb9yA"></script>

   <script type="text/javascript">
      var ge;
      google.load("earth", "1", {"other_params":"sensor=false"});

      function init() {
         google.earth.createInstance('map3d', initCB, failureCB);
      }

      function initCB(instance) {

         ge = instance;
         ge.getWindow().setVisibility(true);
         ge.getNavigationControl().setVisibility(ge.VISIBILITY_SHOW);

         var line1 = ge.createLineString('');
<?php

if ($over_index<100) {
    $lo = $spd_pint1[$over_index];
    $hi = $spd_pint[$over_index];
}

elseif (($over_index>=300) AND ($over_index<400)) {
     $jj=$over_index-300;
     $lo = $point0[$jj];
     $hi = $point4[$jj];
}

elseif (($over_index>=400) AND ($over_index<500)) {

     $lo = $pointE[0];
     $hi = $pointE[1];
 }

elseif (($over_index>=500) AND ($over_index<600)) {

    $gg = $over_index-500;
    $lo = $crossPoint1[$gg];
    $hi = $crossPoint4[$gg];
}

elseif (($over_index>=600) AND ($over_index<700)) {

    $gg = $over_index-600;
    $pointE = explode("-",$stp_point[$gg]);

    $lo = $pointE[0];
    $hi = $pointE[1];
}

  /*$num_rowsEarth = 1000;    */

       for ($i=1; $i<$num_rows; $i++) {
        $latt = DMStoDECLn($lat_i[$i]);
        $lonn = DMStoDECLn($lon_i[$i]);

     if (($latt>=40) OR ($latt==0)) {
          $latt = DMStoDECLn($lat_i[10]);
          $lonn = DMStoDECLn($lon_i[10]);
        }

       echo "line1.getCoordinates().pushLatLngAlt($latt, $lonn, 0); ";
  /*   echo "line1.getCoordinates().pushLatLngAlt(13.997618, 100.636883, 0); ";  */
       }
   ?>
         line1.setTessellate(true);
         line1.setAltitudeMode(ge.ALTITUDE_CLAMP_TO_GROUND);

         var line2 = ge.createLineString('');
   <?php
        echo "line2.getCoordinates().pushLatLngAlt($latt, $lonn, 0); ";
        echo "line2.getCoordinates().pushLatLngAlt($latt, $lonn, 0); ";
   ?>
         line2.setTessellate(true);
         line2.setAltitudeMode(ge.ALTITUDE_CLAMP_TO_GROUND);

         var multiGeometry = ge.createMultiGeometry('');
         multiGeometry.getGeometries().appendChild(line1);
         multiGeometry.getGeometries().appendChild(line2);

         var multGeoPlacemark = ge.createPlacemark('');
         multGeoPlacemark.setGeometry(multiGeometry);

         multGeoPlacemark.setStyleSelector(ge.createStyle(''));
         var lineStyle = multGeoPlacemark.getStyleSelector().getLineStyle();
         lineStyle.setWidth(10);
         lineStyle.getColor().set('ffff0000');

         ge.getFeatures().appendChild(multGeoPlacemark);

         multGeoPlacemark.setName('Line Strings');
         multGeoPlacemark.setDescription('Two separate lineStrings, one description.');

         var la = ge.createLookAt('');
   <?php
         $latlo = DMStoDECLn($lat_i[$lo]);
         $lonlo = DMStoDECLn($lon_i[$lo]);
         echo "la.set($latlo, $lonlo, 0, ge.ALTITUDE_RELATIVE_TO_GROUND, -8.541, 66.213, 8000); ";
   ?>
         ge.getView().setAbstractView(la);
         
// Create the placemark
var lineStringPlacemark = ge.createPlacemark('');

// Create the LineString
var lineString = ge.createLineString('');
lineStringPlacemark.setGeometry(lineString);


lineString.setExtrude(true);
lineString.setAltitudeMode(ge.ALTITUDE_RELATIVE_TO_GROUND);

  // Add LineString points

<?php

    $speedE_sum =0;
    
    for ($i=$lo; $i<$hi; $i++) {
        $latt = DMStoDECLn($lat_i[$i]);
        $lonn = DMStoDECLn($lon_i[$i]);
        
        $speedE_div = $speed_i[$i] - $speed_i[$i-1];
        $speedE_sum = $speedE_sum + $speedE_div;
        $speedE0 = ($speedE_sum)*10;

        echo "lineString.getCoordinates().pushLatLngAlt($latt,$lonn,$speedE0); ";
    }
?>
// Create a style and set width and color of line
lineStringPlacemark.setStyleSelector(ge.createStyle(''));
var lineStyle = lineStringPlacemark.getStyleSelector().getLineStyle();
lineStyle.setWidth(5);
lineStyle.getColor().set('ffff0000'); // aabbggrr format

// Add the feature to Earth
ge.getFeatures().appendChild(lineStringPlacemark);
var multGeoPlacemark = ge.createPlacemark('');
multGeoPlacemark.setGeometry(multiGeometry);

multGeoPlacemark.setStyleSelector(ge.createStyle(''));
var lineStyle = multGeoPlacemark.getStyleSelector().getLineStyle();
lineStyle.setWidth(10);
lineStyle.getColor().set('ff00ff00');

ge.getFeatures().appendChild(multGeoPlacemark);

multGeoPlacemark.setName('Line Strings');
multGeoPlacemark.setDescription('Two separate lineStrings, one description.');

 }

      function failureCB(errorCode) {
      }

      google.setOnLoadCallback(init);
   </script>

</head>
<body>

   <div id="map3d" style="height:400px; width:600px;"></div>

</body>
</html>

