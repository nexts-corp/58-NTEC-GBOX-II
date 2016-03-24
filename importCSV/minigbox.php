<?php
set_time_limit(0);
require(dirname(__FILE__)."/../config.php");

$link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
mysqli_select_db(DB_NAME, $link);
mysqli_query("SET NAMES 'utf8'");

//$filename = "dataminigbox_Test21.csv";

$file = fopen($filename,"r");
$count = 0;

while(($objArr = fgetcsv($file, 1000, ",")) !== FALSE) {
    if($objArr[0] != ""){

        $deviceSerial = $objArr[0];

        $sql_dev = "SELECT * FROM device WHERE device_serial='".$deviceSerial."'";
        $res_dev = mysqli_query($sql_dev, $link);
        $data_dev = mysqli_fetch_array($res_dev);

        $deviceId = $data_dev['id'];
        $date = $objArr[1];
        $time = $objArr[2];
        $lat = $objArr[3];
        $latDir = "N";
        $long = $objArr[4];
        $longDir = "E";
        $speed = $objArr[5];
        $direction = $objArr[6];
        $alt = $objArr[7];
        $adc1 = $objArr[8];
        $adc2 = $objArr[9];

        //$adc1 = 0;
        //$adc2 = 0;

        if($count == 0) $sessionId = getSession($deviceId);

        if (strlen($time)<6) $time = str_pad($time, 6, "0", STR_PAD_LEFT);
        if (strlen($date)<6) $date = str_pad($date, 6, "0", STR_PAD_LEFT);
        if ($time!='000000' && $date!='000000') {
            $time_arr = explode(":", $time);
            $date_arr = explode("-", $date);

            $unixtime = mktime($time_arr[0], $time_arr[1], $time_arr[2], $date_arr[1], $date_arr[2], $date_arr[0]) - date('Z');
        }
        else
            $unixtime = time()-date('Z'); //UTC


        /*$sql_ck = "SELECT COUNT(*) AS numrow FROM data WHERE deviceid='".$deviceId."' AND time='".$unixtime."'";
        $res_ck = mysqli_query($sql_ck, $link);
        $data_ck = mysqli_fetch_array($res_ck);
        $rows = $data_ck['numrow'];

        //print $rows;
        if($rows == 0){*/
        $query = "INSERT INTO data(deviceid, sessionid, time, latitude, longitude, speed, altitude, direction, adc1, adc2)"
            ." VALUES ('".$deviceId."', '".$sessionId."', '".$unixtime."', '".$lat.$latDir."', '".$long.$longDir."', '".$speed."', '".$alt."', '".$direction."', $adc1, $adc2);";
        if ($result = mysqli_query($query, $link)){
            print ($count+1).$query."<br>";
        }

        $count++;
    }


}
fclose($file);

mysqli_close($link);

function getSession($deviceId){
    $link = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD);
    mysqli_select_db(DB_NAME, $link);
    mysqli_query("SET NAMES 'utf8'");

    $retry_counter = 0;
    $sessionId_found = 1;
    while ($sessionId_found > 0 && $retry_counter < 500) {
        $sessionId = '';
        $randnum = rand(ord('1'),ord('Z')-7);
        if ($randnum>57) $randnum += 7;
        $sessionId .= chr($randnum);
        $randnum = rand(ord('0'),ord('Z')-7);
        if ($randnum>57) $randnum += 7;
        $sessionId .= chr($randnum);
        $randnum = rand(ord('0'),ord('Z')-7);
        if ($randnum>57) $randnum += 7;
        $sessionId .= chr($randnum);
        $randnum = rand(ord('0'),ord('Z')-7);
        if ($randnum>57) $randnum += 7;
        $sessionId .= chr($randnum);
        $randnum = rand(ord('0'),ord('Z')-7);
        if ($randnum>57) $randnum += 7;
        $sessionId .= chr($randnum);
        $randnum = rand(ord('0'),ord('Z')-7);
        if ($randnum>57) $randnum += 7;

        $sessionId .= chr($randnum);
        $sessionId = strtolower($sessionId);

        $sessionId_found = 0;
        $sql = "SELECT COUNT(sessionid) AS row FROM session WHERE sessionid='".$sessionId."'";
        $res = mysqli_query($sql, $link);
        if($data = mysqli_fetch_array($res)){
            $sessionId_found = $data['row'];

            if($sessionId_found == 0){
                $sql_ses = "INSERT INTO session(deviceid, sessionid) VALUES('".$deviceId."', '".$sessionId."')";
                $res_ses = mysqli_query($sql_ses, $link);
            }
        }
        $retry_counter++;
    }

    return $sessionId;
}
?>