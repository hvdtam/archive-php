<?php
error_reporting(0);
class themes {
var $grab_from = 'http://173.212.225.242';  // Do not Change This.
var $server;
var $server_ip;
var $till = 'themes';
var $cat;
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
var $item;


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
$ip[] = '133';
$ip[] = '212';
$ip[] = '156';
$ip[] = '225';
$ip[] = '242';
$ip = "$ip[0].$ip[2].$ip[4].$ip[5]";
return trim($this->grab_from.'/~mys');  
}

function server(){
$srv[] = 'cript';
$srv[] = $this->till;
$srv[] = '/web';
$srv[] = '/Nokia/';
$srv[] = 'Sony|Motorola|Htc|Iphone|3G|4G|Blackberry';
$srv[] = 'masters/';
$srv[] = $this->till.'/';
$srv = "$srv[0]s$srv[2]$srv[5]$srv[6]";
return $this->server_ip.$srv;
}

function query(){
if($this->cat){
$query = 'index.php?'.$this->query_sub;}
elseif($this->model||$this->id){
$query = 'main.php?'.$this->query_sub;}
else{
$query = NULL;}
$address= $this->server.$query;
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

function stagu(){
include($this->ul);
return true;
}

function sitename(){
include 'settings.php';
if(!isset($sitename)||!$sitename||$sitename=='')
{$sitename = $_SERVER['HTTP_HOST'];}
return $sitename;
}


function complete(){
$frtr = explode("|",$this->display);
$filename = $frtr[1].'_'.$this->sitename().'.'.$frtr[2];
$combine = array($frtr[0],$filename);
return $combine;
}


function save(){
if($this->id && $this->item=='THEMES') {
if(!is_dir("files"))
{mkdir("files");
chmod("files",0777);}
copy($this->url,"files/".$this->complete);
$size = round((filesize('files/'.$this->complete)/1048576),3).' MB';
echo 'Download File: <br />
<a href="files/'.$this->complete.'">'.$this->complete.'</a>
<font color="red">('.$size.')</font><br />';
}
else {echo $this->display;}
}

function stagl(){
include($this->ll);
return true;
}

function cache(){
$seconds = (1*60*60);
$dir    = 'files/';
foreach (glob($dir.'*.*') as $del)
{if (file_exists("$del") && ((time() - filemtime("$del")) > $seconds))
{unlink("$del");}}
return true;
}
}
?>