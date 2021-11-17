<?php
/*
* Usama Ejaz
* thedeveloper24.com
* osamaejaz1[at]gmail.com
*/

require_once("config.php");

function isTime($timestamp){
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}



header('Content-type: application/json');
if(empty($_GET['time'])){
	$q=mysqli_query($con, "SELECT * FROM my_shoutbox ORDER BY id DESC LIMIT 30");
} else {
	$time = $_GET['time'];
	$q=mysqli_query($con, "SELECT * FROM my_shoutbox WHERE time >= '$time' ORDER BY id DESC LIMIT 30");
}

if(!$q){ die(); }
$data=array();
while($r=mysqli_fetch_array($q, MYSQLI_ASSOC)){
$name=$r['name'];
$r['name']=stripslashes($name);
$message=$r['message'];
$message=preg_replace("/[\r\n]+/", "\n", $message);

$r['message']=nl2br(stripslashes($message));
$url=$r['url'];
$data[]=$r;
}
echo json_encode($data);
?>