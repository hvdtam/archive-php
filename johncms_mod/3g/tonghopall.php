<?php
include 'dkmb7.php';
$z=$_GET['z'];
$zs=$_GET['zs'];
$z=str_replace('/', '&', $z);
$zs=str_replace('/', '&', $zs);
$search=$_GET['search'];
$sec=$_GET['sec'];
$host = "http://m.zedge.net";
if(isset($_GET["search"])){
$file=file("$host/?s_p=$zs&p=$z&search=$search&sec=$sec");}elseif("$z"){
$file=file("$host/?s_p=$zs&p=$z");}elseif("zs"){
if(!empty($file)){
$file=file("$host/?s_p=$zs");}else{
$file=file("$host/?s_p=$zs&ref=touch");}}else{
$file=file("$host/");}
$file=@implode("", $file);
$a=explode('<body>',$file);
$b=@explode('</body>',$a[1]);
$file=$b[0];
$c=explode('./content-relay-m.php',$file);
$d=@explode('"',$c[1]);
$url=$d[0];
$link="http://m.zedge.net/content-relay-m.php$url";
$link=get_link("$link");
$file=str_replace('?p=', '?zs='.$zs.'&z=', $file);
$file=str_replace('?s_p=', '?zs=', $file);
$file=str_replace('&amp;q','&q',$file);
$file=str_replace('&amp;xs','&xs',$file);
$file=str_replace('&amp;ys','&ys',$file);
$file=str_replace('&amp;','/',$file);
$file=str_replace('name="p"','name="z"',$file);
$file=str_replace('./img/', ''.$host.'/img/', $file);
$file=str_replace('<div style="padding:3px;padding-top:4px;line-height:9px;" class="hLo">&nbsp;&nbsp;</div>', '', $file);
$file=str_replace('<h1>', '&nbsp;<b>', $file);
$file=str_replace('</h1>', '</b>', $file);
$file = preg_replace('/<div(.*?)class="hUp">(.*?)<\/div>/i','',$file);
$file = preg_replace('/<a(.*?)?z=login">(.*?)<\/a><br \/>/i','',$file);
$file = preg_replace('/<div><a href="(.*?)view-item-comments(.*?)<\/a><\/div>/i','',$file);
$file = preg_replace('/<p><em>(.*?)<\/em><\/p>/i','',$file);
$file=str_replace('Zedge','',$file);
$file=str_replace('Ad:','',$file);
$file=str_replace('<input type="hidden"', '<input type="hidden" name="zs" value="'.$zs.'" /><input type="hidden"', $file);
$file=str_replace('<div style="padding-bottom: 10px; font-size: x-small;">','<div class="row1">',$file);
$file=str_replace('>Page',' class="ad">Page',$file);
$file=str_replace('<div style="height:10px;"></div>','',$file);
$file=str_replace('<div class="padBot10"></div>','',$file);
$file=str_replace('<div class="padTop5"></div>','',$file);
$file=preg_replace('|<div class="advertCont(.*?)</div></div></div>|is','',$file);
$file=preg_replace('/<a href="http:\/\/(.*?)smaato.net(.*?)<\/a>/is','',$file);
$file=preg_replace('/<a href="http:\/\/(.*?)mojiva.com(.*?)<\/a>/is','',$file);
$file=preg_replace('/<a href="http:\/\/c.admob.com(.*?)<\/a>/is','',$file);
$file=preg_replace('/<a href="http:\/\/click.buzzcity.net(.*?)<\/a>/is','',$file);
$file=preg_replace('/href=".\/content-relay-m.php(.*?)"/i', 'href="'.$link.'"', $file);
$file=preg_replace('/href="http:\/\/c.mobpartner.mobi(.*?)"/i','href="http://besttop.mobi/in.php?id=68151" rel="nofollow"',$file);
$file=preg_replace('/<option value="19">(.*?)<\/select>/i','</select>',$file);
$file=preg_replace('/The good news(.*?)website./is','',$file);
$file=preg_replace('/<p class="zerozero">(.*?)<\/div>/i','',$file);
$file=preg_replace('/<div class="fMenu">(.*)/i','',$file);
$file=preg_replace('/<div style="padding-top:5px;"><strong>(.*)/i','</div>',$file);
$file=preg_replace('/<div class="rl">(.*)/i','',$file);

include 'head.php';
echo (!empty($file)) ? $file : '<div class="row1">&nbsp;<b>Error loading contents.</b> <a href="./">Select Device</a></div>';
echo '<div class="rl"><a href="./?zs='.$zs.'" class="rlA">Main Page</a></div>';
include 'foot.php';
?>
