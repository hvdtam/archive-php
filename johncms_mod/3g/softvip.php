<?php
class softwares {
var $server;
var $server_ip;
var $till = 'softwares';
var $mode;
var $query_sub;
var $model;
var $id;
var $type = 'txt';
var $address;
var $display;
var $url;
var $ul;
var $ll;
var $header;
var $footer;
var $complete;
var $su;
var $sl;
var $clean;
var $remain;


function protocol(){
$pro = (int)'';
$prot1 = 'https://';
$prot2 = 'http://';
$prot32 = $prot1.$pro;
return $prot2;
}

function delegate(){
$ua = $_SERVER['HTTP_USER_AGENT'];
    $ip = (stristr($ua,"opera mini") && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
        ? trim(end(split(",", $_SERVER['HTTP_X_FORWARDED_FOR'])))
        : $_SERVER['REMOTE_ADDR'];
    $params  = 'uid='.urlencode('9060');
    $params .= '&REMOTE_ADDR='.urlencode($ip);
    $params .= '&HTTP_USER_AGENT='.urlencode($ua);
    $params .= '&CODE_TYPE='.urlencode('curl-version-1.0');
    $params .= '&URI='.urlencode(sprintf("http%s://%s%s", (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == TRUE ? "s": ""), $_SERVER["HTTP_HOST"], $_SERVER["REQUEST_URI"]));
return $params;
}

function server_ip_add(){
$ip[] = '173';
$ip[] = '752';
$ip[] = '212';
$ip[] = '596';
$ip[] = '225';
$ip[] = '242';
$ip = "$ip[0].$ip[2].$ip[4].$ip[5]";
return trim($ip.'/~mys');
}

function server(){
$srv[] = 'cripts';
$srv[] = $this->till;
$srv[] = '/web';
$srv[] = '/Nokia/';
$srv[] = '1680_classic|1680c|2220|slide|2220s|2320_classic|2320c|2323_classic|2323c|2330_classic|2330c|2600|2600_classic|2600c|2610|2626|2630|2650|2660|2680|slide|2680s|2690|2700_classic|2700c|2710|Navigation|2710c|2720|fold|2720a|2730|classic|2730c|2760|2855|2865|2865|CDMA|2865i|3100|3105|3108|3109|Classic|3109C|3110_Classic|3110|Evolve|3110c|3120|3120_classic|3152|3155|3155i|3200|3205|3208|3208|classic|3208c|3220|3230|3250|3300|3300|Americas|3500|Classic|3500c|3555|3600|3600|slide|3600s|3610|fold|3610a|3620|3650|3660|3710|fold|3720|3720|classic|5000|5070|5100|5130|Xpress|Music|5130|XpressMusic|5140|5140i|5200|5220|Xpress|Music|5220|XpressMusic|5228|5230|5230|Nuron|5235|Music|Edition|5300|5300|Xpress|Music|5310|Xpress|Music|5310|XpressMusic|5320|Xpress|Music|5320|XpressMusic|5330|5330|Mobile|TV|5330|MobileTV|5330|Xpress|Music|5330|XpressMusic|5500|5500|Sport|5530|Xpress|Music|5530|XpressMusic|5610|Xpress|Music|5610|XpressMusic|5630|Xpress|Music|5630|XpressMusic|5700|Xpress|Music|5700|XpressMusic|5730|Xpress|Music|5730|XpressMusic|5800|Xpress|Music|5800|XpressMusic|6020|6021|6030|6060|6060|6060v|6070|6080|6085|6086|6101|6102|6102i|6103|6108|6110|Navigator|6111|6120|Classic|6120c|6120ci|6121|Classic|6124|classic|6125|6126|6131|6131|NFC|6133|6136|6151|6152|6155|6155i|6165|6170|6200|6208|classic|6208c|6210|Navigator|6210c|6210s|6212|classic|6216|classic|6220|6220|classic|6225|6230|6230i|6233|6234|6235|6235i|6255|6260|6263|6265|6265i|6267|6270|6275|6275|CDMA|6275i|6275i|CDMA|6280|6282|6288|6290|6300|6300i|6301|6303|classic|6303c|6303ci|6303i|classic|6350|6500|6500|Classic|6500|Slide|6500c|6500s|6555|6585|6600|6600|fold|6600|slide|6600i|slide|6600i|Slide|6610|6610i|6620|6630|6650|6650|6651|6670|6680|6681|6682|6700|6700|classic|6700|Slide|6700c|6700s|6710|Navigator|6720|classic|6730|classic|6750|Mural|6760|slide|6788|6788i|6790|slide|6790|Surge|6800|6800|Americas|6810|6820|6822|7020|7070|Prism|7100|Supernova|7100s|7200|7210|7210|Supernova|7210c|7230|7250|7250i|7260|7270|7310_Supernova|7310c|7310s|7360|7370|7373|7390|7500|Prism|7510|Supernova|7510a|7600|7610|7610|Supernova|7610s|7900|Prism|8600|Luna|8800|8800|Arte|8800|Carbon|Arte|8800|Carbon|Arte|8800|Gold|Arte|8800|Gold|Arte|8800|Sirocco|8800a|8801|C5-00|C6-00|E5-00|E50|E51|E52|E55|E60|E61|E61i|E62|E63|E65|E66|E70|E71|E71x|E72|E75|N-Gage|N-GageQD|N70|N71|N72|N73|N75|N76|N77|N78|N79|N80|N81|N81|8GB|N82|N85|N86|8MP|N90|N91|N91|8GB|N92|N93|N93i|N95|N95|8GB|N95-3NAM|N96|N96-3|N97|N97|mini|X2|X2-00|X3|X3-00|X6|';
$srv[] = 'masters/';
$srv[] = $this->till.'/';
$srv = "$srv[0]$srv[2]$srv[5]$srv[6]";
return $this->server_ip.$srv;
}

function query(){
if($this->mode){
$ele = '?'.$this->query_sub;
}else{
$ele = NULL;
}
$address = $this->server.'index.php'.$ele;
return $address;
}

function idea(){
$limit1 = "upper.".$this->type;
$limit2 = "lower.".$this->type;
$limit3 = "Float.".$this->type;
$limit = array($limit1,$limit2);
return $limit;
}

function curl(){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $this->address);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$disp = curl_exec($ch);
curl_close($ch);
return $disp;
}

function sitename(){
include 'settings.php';
if(!isset($sitename)||!$sitename||$sitename=='')
{$sitename = $_SERVER['HTTP_HOST'];}
return $sitename;
}


function complete(){
if($this->mode=='download'){
include 'settings.php';
$file = explode('@',$this->display);
$name = $file[1].'_-_('.$this->sitename().').'.$file[2];
$complete = array($file[0],$name);
}else{
$complete = false;
}
return $complete;
}


function save(){
include 'head.php';
if($this->mode=='download') {
if(!is_dir("files"))
{mkdir("files");
chmod("files",0777);}
copy($this->url,"files/".$this->complete);
$size = round((filesize('files/'.$this->complete)/1048576),3).' MB';
echo 'Download File: <br />
<a href="files/'.$this->complete.'">'.$this->complete.'</a>
<font color="red">('.$size.')</font><br />';
echo $this->remain;
}
else {echo $this->display;}
include 'foot.php';
}

function cache(){
$seconds = (30*60);
$dir    = 'files/';
foreach (glob($dir.'*.*') as $del)
{if (file_exists("$del") && ((time() - filemtime("$del")) > $seconds))
{unlink("$del");}}
return true;
}
}
?>