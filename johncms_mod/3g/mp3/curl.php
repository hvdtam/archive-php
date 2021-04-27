<?php
error_reporting(0);
$loading = sys_getloadavg ();
$limit = 15;
if ($loading [0] >= $limit )
header('HTTP/1.1 503 Too busy, try again later' );
function get($url){
$timeout=30;
$user='Nokia5130c-2/2.0 (05.80) Profile/MIDP-2.1 Configuration/CLDC-1.1';
$ch=curl_init();
curl_setopt($ch,CURLOPT_COOKIESESSION,TRUE);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
curl_setopt($ch,CURLOPT_USERAGENT,$user);
curl_setopt($ch,CURLOPT_POST,1);
$data=array('quality'=>$_GET['quality'],'token'=>$_GET['token'],'q'=>$_GET['q'],'t'=>$_GET['t'],'page'=>$_GET['page'],'id'=>$_GET['id']);
curl_setopt($ch,CURLOPT_POSTFILEDS,$data);

$ret=curl_exec($ch);
return $ret; }

function pick($bd,$kt,$n){
$a=explode($bd,$n);
$b=explode($kt,$a[1]);
$c=$b[0];
return $c;}

?>
