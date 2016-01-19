<?php
require(dirname(__FILE__)."/config.php");

// Get data from GPS device via HTTP
// Format: xxxxxx,yyyyyy,225446,A,1311.7836,N,10056.2358,E,000.5,191194,aaa,bbb,ccc,ddd,e,f,NetworkName,LAC,CID,CellName^

$data = GetFromBrowser("data", "", "");

$data = str_replace('%5E','^',$data);
$data_arr = explode("^", $data);

$deviceSerial = '';
$sessionId = '';
$counter_added = 0;
$reqsession_respond = '';

$link = pg_connect("host='".DB_HOST."' port=5432 user='".DB_USERNAME."' password=".DB_PASSWORD." dbname='".DB_NAME."'");
if(count($data_arr) > 0){
    $i = 0;
    while($i < count($data_arr)){
        $input = $data_arr[$i];
        if(stripos($input, "HTTP/1.0") === false){
            if(substr_count($input, ',') == 11){
                list($deviceSerial,$sessionId,$time,$active,$lat,$latDir,$long,$longDir,$speed,$date,$alt,$direction) = split(",", $input,12);
                $adc = "";
            }
            elseif(substr_count($input, ',') == 12){
                list($deviceSerial,$sessionId,$time,$active,$lat,$latDir,$long,$longDir,$speed,$date,$alt,$direction,$adc) = split(",", $input,13);
                //print $deviceSerial." ".$sessionId."\r\n";
            }
            elseif(substr_count($input, ',') == 10){
                list($time,$active,$lat,$latDir,$long,$longDir,$speed,$date,$alt,$direction,$adc) = split(",", $input,11);
                //print $deviceSerial." ".$sessionId."\r\n";
            }
            $sql_dev = "SELECT * FROM device WHERE device_serial='".$deviceSerial."'";
            $res_dev = pg_query($link, $sql_dev);
            $data_dev = pg_fetch_array($res_dev);
            if(!empty($data_dev['id'])){
                $deviceId = $data_dev['id'];

                if (strlen($time)<6) $time = str_pad($time, 6, "0", STR_PAD_LEFT);
                if (strlen($date)<6) $date = str_pad($date, 6, "0", STR_PAD_LEFT);
                if ($time!='000000' && $date!='000000')
                    $unixtime = mktime(substr($time, 0, 2),substr($time, 2, 2),substr($time, 4, 2),substr($date, 2, 2),substr($date, 0, 2),substr($date, 4, 2)); //UTC
                else
                    $unixtime = time()-date('Z'); //UTC

                $sql_ck = "SELECT COUNT(*) AS numrow FROM data WHERE deviceid='".$deviceId."' AND time='".$unixtime."'";
                $res_ck = pg_query($link, $sql_ck);
                $data_ck = pg_fetch_array($res_ck);

                if($data_ck['numrow'] == 0){
                    if (!empty($sessionId)) {
                        if ($sessionId=='REQSID') {
                            $sql_repeat = "SELECT COUNT(*) AS numrow FROM data WHERE deviceid='".$deviceId."' AND time='".$unixtime."'";
                            $res_repeat = pg_query($link, $sql_repeat);
                            $data_repeat = pg_fetch_array($res_repeat);
                                // check data repeater
                            if($data_repeat['numrow'] == 0){
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
                                    $res = pg_query($link, $sql);
                                    if($data = pg_fetch_array($res)){
                                        $sessionId_found = $data['row'];

                                        if($sessionId_found == 0){
                                            $sql_ses = "INSERT INTO session(deviceid, sessionid) VALUES('".$deviceId."', '".$sessionId."')";
                                            $res_ses = pg_query($link, $sql_ses);
                                        }
                                    }
                                    $retry_counter++;
                                }

                                //$REQSID_Freq = '0005';
                                //$REQSID_Freq = str_pad($REQSID_Freq, 4, "0", STR_PAD_LEFT);
                                $reqsession_respond = $sessionId."OK!\r\n";
                            }
                        }
                        else{
                            //$REQSID_Freq = '0001';
                            //$REQSID_Freq = str_pad($REQSID_Freq, 4, "0", STR_PAD_LEFT);
                            $reqsession_respond = $sessionId."OK!\r\n";
                        }

                        //Uncomment the 'continue' line to discard GPS-not-fixed data
                        //if ($valid!='A') continue;

                        //$speed = round($speed*1.852,1);
                        if($adc == "OFF"){
                            $query = "INSERT INTO data(deviceid, sessionid, time, active, lat, long, speed, alt, direction, adc1, adc2)"
                                ." VALUES ('".$deviceId."', '".$sessionId."', '".$unixtime."', '".$active."', '".$lat.$latDir."', '".$long.$longDir."', '".$speed."', '".$alt."', '".$direction."', 'OFF', 'OFF');";
                            if ($result = pg_query($link,$query)) {
                                $counter_added += pg_affected_rows($result);
                                pg_free_result($result);
                            }
                            //print $query."\r\n";
                        }
                        else{
                            $adc_arr = explode(";", $adc);
                            $adc1_arr = array();
                            $adc2_arr = array();
                            for($i = 0; $i < count($adc_arr); $i++){
                                // adc 1
                                if($i % 2 == 0) $adc1_arr[] = $adc_arr[$i];
                                else $adc2_arr[] = $adc_arr[$i];
                            }
                            $adc1 = implode(";", $adc1_arr);
                            $adc2 = implode(";", $adc2_arr);
                            $sql_ck = "SELECT * FROM data WHERE deviceid='".$deviceId."' AND sessionid='".$sessionId."' ORDER BY time DESC";
                            $res_ck = pg_query($link, $sql_ck);
                            $data_ck = pg_fetch_array($res_ck);
                            if($data_ck['sessionid'] == "" || ($data_ck['adc1'] == "OFF" && $data_ck['adc2'] == "OFF")){
                                $query = "INSERT INTO data(deviceid, sessionid, time, active, lat, long, speed, alt, direction, adc1, adc2)"
                                    ." VALUES ('".$deviceId."', '".$sessionId."', '".$unixtime."', '".$active."', '".$lat.$latDir."', '".$long.$longDir."', '".$speed."', '".$alt."', '".$direction."', '".$adc1."', '".$adc2."')";
                                if ($result = pg_query($link,$query)) {
                                    $counter_added += pg_affected_rows($result);
                                    pg_free_result($result);
                                }
                            }
                            else{
                                $update1 = $data_ck['adc1'].";".$adc1;
                                $update2 = $data_ck['adc2'].";".$adc2;
                                $query = "UPDATE data SET adc1='".$update1."', adc2='".$update2."' WHERE deviceid='".$data_ck['deviceid']."' AND sessionid='".$data_ck['sessionid']."' AND time='".$data_ck['time']."'";
                                if ($result = pg_query($link,$query)) {
                                    $counter_added += pg_affected_rows($result);
                                    pg_free_result($result);
                                }
                                //print $query;
                            }
                        }
                    }
                }
            }
        }
        $i++;
    }
}
if (!empty($reqsession_respond)) {
    //sleep(1);
    header("Content-Type: text/plain");
    //header("Content-Type: text/html");
    print $reqsession_respond;
}
else{
    //print get_deffreq()."FAIL\r\n";
    //sleep(1);
    header("Content-Type: text/plain");
    //header("Content-Type: text/html");
    print "FAIL!!\r\n";
}

pg_close($link);