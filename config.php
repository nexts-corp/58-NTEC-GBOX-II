<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'minigbox');
//define('DB_USERNAME', 'postgres');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'dd1234');

define('GPSINTERVAL_DEFAULT', '1');

define("ADMINISTRATOR", "Administrator");
define("SUPERUSER", "Superuser");
define("USER", "User");
define("MOD_PASSWORD", "minigbox");

$DB_LINK;

function mysql_connect($dbhost,$dbusrname,$dbpassword){
 $DB_LINK= mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);  
 
 return $DB_LINK;
}
function mysql_select_db($db,$link){
    return true;
}

function mysql_query($sql){
    return mysqli_query($DB_LINK,$sql);
}

function mysql_fetch_array($res){
    return mysqli_fetch_array($res);
}

function mysql_close(){
    mysqli_close($DB_LINK);
}




$link = mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
$select = mysql_select_db(DB_NAME, $link);
mysql_query("SET NAMES 'utf8'");


function GetFromBrowser($value_name,$old_value='',$convert=true) {
    $form_ary = array();
    if (isset($HTTP_POST_VARS)) $form_ary = array_merge($form_ary,$HTTP_POST_VARS);
    if (isset($HTTP_GET_VARS)) $form_ary = array_merge($form_ary,$HTTP_GET_VARS);
    if (isset($_REQUEST)) $form_ary = array_merge($form_ary,$_REQUEST);
    if (isset($_GET)) $form_ary = array_merge($form_ary,$_GET);
    if (!isset($form_ary[$value_name])) return $old_value;
    $output_str = $form_ary[$value_name];
    $output_str = ereg_replace("\+", "_PLUSSIGN_", $output_str);
    if ($convert==true) {
//		$output_str = ereg_replace("'", "&#0039;", $output_str);
//		$output_str = ereg_replace('"', "&#0034;", $output_str);
        $output_str = ereg_replace("<", "&lt;", $output_str);
        $output_str = ereg_replace(">", "&gt;", $output_str);
        $output_str = ereg_replace("&lt;&lt;", "<", $output_str);
        $output_str = ereg_replace("&gt;&gt;", ">", $output_str);
        $output_str = ereg_replace("\n", "<BR>", $output_str);
        $output_str = urldecode($output_str);
    }
    $output_str = ereg_replace("_PLUSSIGN_", "+", $output_str);
    return $output_str;
}

function GPSToGEarth($input) {
    if (strpos($input,"N")!==false || strpos($input,"E")!==false){
        $output=1;
    }
    else{
        $output=-1;
    }
    $input = floatval($input);
    settype($output,"float");
    $output = $output * (floor($input/100)+(fmod($input,100)/60));

    return sprintf('%01.6f', $output);
}

function get_deffreq() {
    $str = file_get_contents(dirname(realpath(__FILE__)).'/config.php');
    if (strpos($str,'GPSINTERVAL_DEFAULT')===false) return str_pad(GPSINTERVAL_DEFAULT, 4, "0", STR_PAD_LEFT);
    $str = substr($str,strpos($str,'GPSINTERVAL_DEFAULT'),strpos($str,';',strpos($str,'GPSINTERVAL_DEFAULT'))-strpos($str,'GPSINTERVAL_DEFAULT'));
    $str = str_replace(' ','',$str);
    $str = substr($str,22,strpos($str,"'",23)-22);
    return str_pad($str, 4, "0", STR_PAD_LEFT);
}

function DMStoDECLn($pos) {
    $long_shift = $pos/100;
    $lon_deg = floor($long_shift);
    $lon_lipda = floor(($long_shift-$lon_deg)*100);
    $lon_phil = ((($long_shift-$lon_deg)*100)-$lon_lipda)*60;
    return $lon_deg+((($lon_lipda*60)+($lon_phil))/3600);
}

function DECtoDMSLn($dec){
    $vars = explode(".",$dec);
    $DD = $vars[0] * 100;
    $dddd = ($dec - $vars[0])*60;
    return round(($DD+$dddd),8);
}

function distank($lat1,$lon1,$lat2,$lon2) {
    $R = 6371; $dLat = ($lat2-$lat1);
    $dLon = ($lon2-$lon1);
    $a = sin(deg2rad($dLat/2)) * sin(deg2rad($dLat/2)) + sin(deg2rad($dLon/2)) * sin(deg2rad($dLon/2)) * cos(deg2rad($lat1)) * cos(deg2rad($lat2));
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $d = $R * $c;
    return round($d,5);
}
?>