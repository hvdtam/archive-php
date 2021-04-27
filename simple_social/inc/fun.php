<?php
$db_MrTam = mysql_pconnect(db_host, db_user, db_pass) or die("Không thể kết nối tới database!");
mysql_select_db(db_name) or die("Không chọn được database");
date_default_timezone_set('Asia/Ho_Chi_Minh');
ob_start();
session_start();
if(isset($_SESSION['uid']) && isset($_SESSION['ses'])){
$uid = $_SESSION['uid'];
$ses = $_SESSION['ses'];
$ad=@mysql_fetch_array(mysql_query("SELECT * FROM `admin` WHERE `id` = '$uid' and `ses` = '$ses'"));
$admin = $ad['id'];
}

function div($div, $text){
echo '<div class="'.$div.'">'.$text.'</div>'; }

function subtok($string,$chr,$pos,$len = NULL){
return implode($chr,array_slice(explode($chr,$string),$pos,$len));
}

function nguon($agent){
if(empty($agent)){ $agent = $_SERVER['HTTP_USER_AGENT']; }
if(stripos($agent, 'Avant Browser') !== false){
return 'Avant Browser';
}elseif(stripos($agent, 'Acoo Browser') !== false){
return 'Acoo Browser';
}elseif(stripos($agent, 'MyIE2') !== false){
return 'MyIE2';
}elseif(preg_match('|Iron/([0-9a-z\.]*)|i', $agent, $pocket)){
return 'SRWare Iron ' . subtok($pocket[1], '.', 0, 2);
}elseif(preg_match('|Chrome/([0-9a-z\.]*)|i', $agent, $pocket)){
return 'Chrome ' . subtok($pocket[1], '.', 0, 3);
}elseif(preg_match('#(Maxthon|NetCaptor)( [0-9a-z\.]*)?#i', $agent, $pocket)){
return $pocket[1] . $pocket[2];
}elseif(stripos($agent, 'Safari') !== false && preg_match('|Version/([0-9]{1,2}.[0-9]{1,2})|i', $agent, $pocket)){
return 'Safari ' . subtok($pocket[1], '.', 0, 3);
} elseif (preg_match('#(NetFront|K-Meleon|Netscape|Galeon|Epiphany|Konqueror|Safari|Opera Mini|Opera Mobile/Opera Mobi)/([0-9a-z\.]*)#i', $agent, $pocket)){
return $pocket[1] . ' ' . subtok($pocket[2], '.', 0, 2);
}elseif(stripos($agent, 'Opera') !== false && preg_match('|Version/([0-9]{1,2}.[0-9]{1,2})|i', $agent, $pocket)){
return 'Opera ' . $pocket[1];
}elseif(preg_match('|Opera[/ ]([0-9a-z\.]*)|i', $agent, $pocket)){
return 'Opera ' . subtok($pocket[1], '.', 0, 2);
}elseif(preg_match('|Orca/([ 0-9a-z\.]*)|i', $agent, $pocket)){
return 'Orca ' . subtok($pocket[1], '.', 0, 2);
}elseif(preg_match('#(SeaMonkey|Firefox|GranParadiso|Minefield|Shiretoko)/([0-9a-z\.]*)#i', $agent, $pocket)){
return $pocket[1] . ' ' . subtok($pocket[2], '.', 0, 3);
}elseif(preg_match('|rv:([0-9a-z\.]*)|i', $agent, $pocket) && strpos($agent, 'Mozilla/') !== false){
return 'Mozilla ' . subtok($pocket[1], '.', 0, 2);
}elseif(preg_match('|Lynx/([0-9a-z\.]*)|i', $agent, $pocket)){
return 'Lynx ' . subtok($pocket[1], '.', 0, 2);
}elseif(preg_match('|MSIE ([0-9a-z\.]*)|i', $agent, $pocket)){
return 'IE ' . subtok($pocket[1], '.', 0, 2);
}elseif(preg_match('|Googlebot/([0-9a-z\.]*)|i', $agent, $pocket)){
return 'Google Bot ' . subtok($pocket[1], '/', 0, 2);
}elseif(preg_match('|Yandex|i', $agent)){
return 'Yandex Bot ';
}elseif(preg_match('|Nokia([0-9a-z\.\-\_]*)|i', $agent, $pocket)){
return 'Nokia '.$pocket[1];
}else{
$agent = preg_replace('|http://|i', '', $agent);
$agent = strtok($agent, '/ ');
$agent = substr($agent, 0, 22);
$agent = subtok($agent, '.', 0, 2);
if(!empty($agent)){
return $agent;
} }
return 'Unknown'; }

function b_set($key){
$set = mysql_fetch_assoc(mysql_query("select * from `setting` where `name`='$key' limit 1;"));
return $set ? $set['value']:'';
}
function murl($id){
$m = mysql_fetch_assoc(mysql_query("select url from `theloai` where `id`='$id'"));
return $m['url'];
}
function bbcode($msg){
$bbcode = array(
"/\[b\](.*?)\[\/b\]/is" => "<b>$1</b>",
"/\[i\](.*?)\[\/i\]/is" => "<i>$1</i>",
"/\[u\](.*?)\[\/u\]/is" => "<u>$1</u>",
"/\[s\](.*?)\[\/s\]/is" => "<s>$1</s>",
"/\[center\](.*?)\[\/center\]/is" => "<center>$1</center>",
"/\[red\](.*?)\[\/red\]/is" => "<font color=\"red\">$1</font>",
"/\[blue\](.*?)\[\/blue\]/is" => "<font color=\"blue\">$1</font>",
"/\[img\](.*?)\[\/img\]/is" => "<div align=\"center\"><img src=\"$1\" style=\"width:50%\" alt=\"10Bc1.Tk\"><br><a href=\"$1\">Tải ảnh gốc</a></div>",
"/\[url\=(.*?)\](.*?)\[\/url\]/is" => "<a href=\"$1\" target=\"_blank\">$2</a>",
"/\[color\=(.*?)\](.*?)\[\/color\]/is" => "<font color=\"$1\">$2</font>",
"/\n\n/i" => "",
"#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#" => "\\1<a onclick=\"errr();\" href=\"\\2\" target=\"_blank\">\\2</a>"
);
$msg=preg_replace(array_keys($bbcode), array_values($bbcode), $msg);
return $msg;
}
function smi($txt){
$txt = str_replace(':hix:', '<img src="../img/smi/hix.gif">', $txt);
$txt = str_replace(':aa:', '<img src="../img/smi/aa.gif">', $txt);
$txt = str_replace(':nghi:', '<img src="../img/smi/nghi.gif">', $txt);
$txt = str_replace(':oai:', '<img src="../img/smi/oai.gif">', $txt);
$txt = str_replace(':he:', '<img src="../img/smi/he.gif">', $txt);
$txt = str_replace(':nong:', '<img src="../img/smi/nong.gif">', $txt);
$txt = str_replace('KeoSua.Mobi', '10Bc1.Tk', $txt);
$txt = str_replace('GocMaster.com', '10Bc1.Tk', $txt);
$txt = str_replace('[text]', '<textarea>', $txt);
$txt = str_replace('WapMa.Mobi', '10Bc1.Tk', $txt);
$txt = str_replace('[/text]', '</textarea>', $txt);
$txt = str_replace('=))', '<img src="../img/smi/=)).gif">', $txt);
return $txt;
}

function b_loi($text, $url){
echo '<div class="loi"><img src="'.b_set(home).'/img/loi.png"> '.$text.'<br><img src="'.b_set(home).'/img/quay.png"> <a href="'.$url.'">Quay lại</a></div>';
}

function b_link($url, $text){
return '<a href="'.$url.'"> '.$text.'</a>';
}

function b_go($link){
header('location: '.$link);
exit;
}

function b_ip(){
foreach(array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
if(array_key_exists($key,$_SERVER)===true){
foreach(explode(',',$_SERVER[$key]) as $ip){
if(filter_var($ip, FILTER_VALIDATE_IP)!==false){
return $ip;
} } } } }
function ctime($t){
$tt=time()-$t;
$tp='giây';
if($tt>=60 && $tt<3600){
$tt=floor($tt/60);
$tp='phút'; }
if($tt>=3600 && $tt<86400){
$tt=floor($tt/3600);
$tp='giờ'; }
if($tt>= 86400 && $tt <  2592000){
$tt=floor($tt/86400);
$tp='ngày'; }
if($tt >=  2592000){
$tt=floor($tt/2592000);
$tp='tháng'; }
return "$tt $tp";
}


$ip = b_ip();
$home = b_set(home);

?>
