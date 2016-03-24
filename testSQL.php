<?php
$link = mysql_connect("localhost","mysqluser","intelenicsdb");
if($link){
    print "OK";
}
else{
    print "Not OK!!!!!!!!!!";
}
mysql_select_db("minigbox",$link);
mysql_query("SET NAMES 'utf8'");

$sql = "SELECT * FROM data WHERE deviceid='11' AND time='1417409276'";
$res = mysql_query($sql);
$data = mysql_fetch_array($res);


print_r($data);

print date("d-m-Y H:i:s", $data["time"] + date("Z"));
$x  = mktime(12, 24, 1, 12, 4, 2014);
//print date("d-m-Y H:i:s", $x);

$link = null;
?>