<?

$link=mysql_connect("53476f055e81994c02000008-nectec.clouddd.in.th","adminlYkzegJ","MaLQvrNyPEpn");
mysql_select_db("thairoadsafety",$link);

// Check connection
if (mysql_errno()) {
  echo "Failed to connect to MySQL: " . mysql_error();
}
 
 if ($_GET['data'] <> null){
	 
	 $arr=explode('^',$_GET['data']);
	 $arr_first=explode(',',$arr[0]);
	 $deviceid=$arr_first[0];
	 $sessionid=$arr_first[1];
	 if ($sessionid == "REQSID"){
		 $sessionid = generateRandomString();
	 }
	 
	 $num_rows=checkdevice($deviceid);
	 if ($num_rows !=0){

	  
	  $arr_count=count($arr)-1;
	  
	  for ($i=0; $i<$arr_count; $i++)
	  { 
	     
	      if ($i==0){
	      	$arr_next =explode(',',$arr[$i]);
		    $time= date('H:i:s', $arr_next[2] + date("Z"));  	
		   	 
		    $lat=$arr_next[4];
		    $long=$arr_next[6];
		    $adcswap1=$arr_next[12];

		    if ($adcswap1 =="OFF"){
			    $adc1=0.00;
			    $adc2=0.00;

                $date=convertdate($arr_next[9]);
                $num_checkdata=checkdata($deviceid,$sessionid,$date,$time);

                if ($num_checkdata == 0){

                    $sql="INSERT INTO route_data (deviceid,sessionid,time,date,active,lat,longf,speed,alt,adc1,adc2,direction) VALUES ('$deviceid','$sessionid','$time','$date','$arr_next[3]','$lat','$long',$arr_next[8],'$arr_next[10]','$adc1','$adc2',$arr_next[11]);";
                    //echo $sql;
                    if (!mysql_query($sql)) {
                        die('Error: ' . mysql_error($sql));
                    }

                }
			}else{
				$adcswap=adc2channel($adcswap1);
				$adc1=$adcswap["adc1"];
				$adc2=$adcswap["adc2"];

                $date=convertdate($arr_next[9]);
                $num_checkdata=checkdata($deviceid,$sessionid,$date,$time);

                if ($num_checkdata == 0){

                    $sql_last = "SELECT * FROM route_data WHERE deviceid='$deviceid' AND sessionid='$sessionid' ORDER BY date,time DESC";
                    $res_last = mysql_query($sql_last);
                    $data_last = mysql_fetch_array($res_last);
                    if($data_last['sessionid'] == "" || ($data_last['adc1'] == "0.00" && $data_last['adc2'] == "0.00")){

                        $sql="INSERT INTO route_data (deviceid,sessionid,time,date,active,lat,longf,speed,alt,adc1,adc2,direction) VALUES ('$deviceid','$sessionid','$time','$date','$arr_next[3]','$lat','$long',$arr_next[8],'$arr_next[10]','$adc1','$adc2',$arr_next[11]);";
                        //echo $sql;
                        if (!mysql_query($sql)) {
                            die('Error: ' . mysql_error($sql));
                        }
                    }
                    else{
                        $update1 = $data_last['adc1'].";".$adc1;
                        $update2 = $data_last['adc2'].";".$adc2;
                        $sql = "UPDATE route_data SET adc1='$update1', adc2='$update2' WHERE deviceid='".$data_last['deviceid']."' AND sessionid='".$data_last['sessionid']."' AND date='".$data_last['date']."' AND time='".$data_last['time']."'";
                        if (!mysql_query($sql)) {
                            die('Error: ' . mysql_error($sql));
                        }
                    }

                }
			}
	      } // end if ($i==0)
	      
	      if($i>0) {	      
	      	$arr_next =explode(',',$arr[$i]);
	      	$time= date('H:i:s', $arr_next[0] + date("Z"));  
	      	//$date= date('Y-m-d', $arr_next[7]);	 
	      	$lat=$arr_next[4];
		    $long=$arr_next[6];	      	
		    $adcswap1=$arr_next[10];
		  
	      	if ($adcswap1 =="OFF"){
				$adc1=0.00;
			  	$adc2=0.00;
			}else{
			   	$adcswap=adc2channel($adcswap1);
			   	$adc1=$adcswap["adc1"];
			   	$adc2=$adcswap["adc2"];
			}		  
			$date=convertdate($arr_next[7]);
			$num_checkdata=checkdata($deviceid,$sessionid,$date,$time);
			
			if ($num_checkdata == 0){ 
				
				$sql="INSERT INTO route_data (deviceid,sessionid,time,date,active,lat,longf,speed,alt,adc1,adc2,direction) VALUES ('$deviceid','$sessionid','$time','$date','$arr_next[1]','$lat','$long',$arr_next[6],'$arr_next[8]','$adc1','$adc2',$arr_next[9]);";
			//echo $sql;
			if (!mysql_query($sql)) {
			  die('Error: ' . mysql_error($sql));
			  }
			}
			
			
		  } // end    if($i>0)
	 	
	  } // end for
echo $sessionid."OK!";
} else 
{
 echo "FAIL!!";
}
	 
	 
	 
	 	  
 }else {
	echo "No Data Retrive"; 
 }// end  get
 
 
  

 
 
 /* Start Function */
 
 function adc2channel($adc){
    $adc_arr = explode(";", $adc);
    $adc1_arr = array();
    $adc2_arr = array();
    for($i = 0; $i < count($adc_arr); $i++){
        // adc 1
        if($i % 2 == 0 && $adc_arr[$i] !=null) 
        {
        $adc1_arr[] = $adc_arr[$i];
        } 
        // adc 2
        elseif ($adc_arr[$i] !=null) 
        { $adc2_arr[] = $adc_arr[$i];} 
    }

    $adc1 = implode(";", $adc1_arr);
    $adc2 = implode(";", $adc2_arr);

    $value["adc1"] = $adc1;
    $value["adc2"] = $adc2;


    return $value;
}

function convertdate($date) {
	$new_date = date("Y-m-d", mktime(0, 0, 0, substr($date, 2, 2),substr($date, 0, 2),substr($date, 4, 2)));
    return $new_date;

}

function time2unix($date, $time){
    if (strlen($time)<6) $time = str_pad($time, 6, "0", STR_PAD_LEFT);
    if (strlen($date)<6) $date = str_pad($date, 6, "0", STR_PAD_LEFT);
    if ($time!='000000' && $date!='000000')
        $unixtime = mktime(substr($time, 0, 2),substr($time, 2, 2),substr($time, 4, 2),substr($date, 2, 2),substr($date, 0, 2),substr($date, 4, 2)); //UTC
    else
        $unixtime = time()-date('Z'); //UTC

    return $unixtime; // UTC + Time Zone (+7)
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
 
function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

 /* End Function */
 
function checkdevice($deviceid){
	$sqlchk="select deviceid from device where deviceid='".$deviceid . "';";
	$result = mysql_query($sqlchk);
	$num_rows = mysql_num_rows($result);
	return $num_rows;
}

function checkdata($deviceid,$sessionid,$date,$time){
    
	$sqlchkdat="select * from route_data where deviceid='".$deviceid . "'";
	$sqlchkdat.="and sessionid='". $sessionid."' and time='".$time . "' and  date='". $date ."';";
	$result = mysql_query($sqlchkdat);
	$num_rows_checkdata = mysql_num_rows($result);	
	return $num_rows_checkdata;
}
 
 
mysql_close($link); 
 
 
 /*  
http://localhost/passing/recv.php?data=ID0001,3yvxgn,100000,A,1311.7836,N,10056.2358,E,100.00,010514,00.01,000.00,OFF^ HTTP/1.0
http://localhost/passing/passing.php?data=ID0001,3yvxgn,100000,A,1311.7836,N,10056.2358,E,100.00,010514,00.01,000.00,0716;0879;1044;1006;1248;1140;1315;1241;1443;1266;1399;1308;^ HTTP/1.0

http://localhost/passing/recv.php?data=ID0001,REQSID,
081455,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081456,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081457,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081458,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081459,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081500,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081501,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081502,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081503,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081504,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081505,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081506,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081507,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081508,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081509,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081510,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081511,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081512,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081513,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^
081514,V,1349.1570,N,10030.7624,E,000.00,180614,-33.4,000.00,OFF^ HTTP/1.0 	 
 */
?>