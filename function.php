<?php
function adc2channel($adc){
    $adc_arr = explode(";", $adc);
    $adc1_arr = array();
    $adc2_arr = array();
    for($i = 0; $i < count($adc_arr); $i++){
        // adc 1
        if($i % 2 == 0) $adc1_arr[] = $adc_arr[$i];
        // adc 2
        else $adc2_arr[] = $adc_arr[$i];
    }
    $adc1 = implode(";", $adc1_arr);
    $adc2 = implode(";", $adc2_arr);

    $value["adc1"] = $adc1;
    $value["adc2"] = $adc2;

    return $value;
}

function time2unix($date, $time){
    if (strlen($time)<6) $time = str_pad($time, 6, "0", STR_PAD_LEFT);
    if (strlen($date)<6) $date = str_pad($date, 6, "0", STR_PAD_LEFT);
    if ($time!='000000' && $date!='000000')
        $unixtime = mktime(substr($time, 0, 2),substr($time, 2, 2),substr($time, 4, 2),substr($date, 2, 2),substr($date, 0, 2),substr($date, 4, 2)); //UTC
    else
        $unixtime = time()-date('Z'); //UTC

    return $unixtime + date("Z"); // UTC + Time Zone (+7)
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