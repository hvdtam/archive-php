<?php
ob_start();
include 'head.php';
$char_per_page=3000;
$nama_site="Xem code";
//url ke main page
$link="xemcode.php";
//background site kamu
$background="black";
//warna text
$text="lime";
//jangan diedit mulai dr sini..
$url=$_GET["url"];
$copy=$_GET["copy"];
header("Content-type:text/html");
header("Cache-Control:no-cache");
echo ("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//VI\"><html><head><title>Xem Source WAP HTML</title></head><body bgcolor='".$background."' text='".$text."'><p align='center'>");
echo "<a name=\"top\"></a>";
echo "<b><big>$nama_site</big></b><br />";
//halaman. . .
$page=$_GET["page"];
if($page==""||$page<=0
)$page=1;
if(ereg("^http://",$url)){
$ff=@htmlspecialchars(file_get_contents($url));
$ff=nl2br($ff);
}else{
echo "Nhap Url";}
$jumlah=strlen($ff);
$num_items=$jumlah;
$items_per_page=$char_per_page;
$num_pages=ceil($num_items/$items_per_page); if(($page>$num_pages)&&
$page!=1)$page=$num_pages;
$limit_start=($page-1)*$items_per_page;
echo "<form action=\"xemcode.php?sid=$sid&amp;uid=$uid&amp;copy=$copy\" method=\"get\"><input type=\"text\" name=\"url\" value=\"http://\" />";
echo "<input type=\"submit\" value=\"XEM\" /></form></p>";
echo "<center>";
echo "<div style='background-color:#333333;color:green;border-style:ridge;border-color:#00ccff;border-width:1px'>";
$pr=($page*$char_per_page)-$char_per_page;
$view=substr($ff,$pr,$char_per_page);
function altecom($view){
$view=preg_replace("/\&lt;a href\=(.*?)&gt;(.*?)&lt;\/a&gt;/i","<font color=\"red\">&lt;a href=</font><font color=\"yellow\">\\1</font><font color=\"red\">&gt;</font><font color=\"aqua\">\\2</font><font color=\"red\">&lt;/a&gt;</font>",$view);
$view=str_replace("&lt;div","<font color=\"lime\">&lt;div</font>",$view);
$view=str_replace("&lt;/div&gt;","<font color=\"lime\">&lt;/div&gt;</font>",$view);
$view=preg_replace("/\{(.*?)\}/i","<font color=\"#7fffd4\">{\\1}</font>",$view);
$view=str_replace("\r","<br />\r\n",$view);
return $view; }
$vie=altecom($view);
if($copy=="yes"){
echo "<textarea>$view</textarea>";}
else{
echo "$vie";}
echo "</div></center>";
echo "<p align=\"center\">";
if($copy=="yes"){
echo "<a href=\"xemcode.php?sid=$sid&amp;url=$url&amp;page=$page&amp;uid=$uid\">Che do thuong</a>";}
else{
echo "<a href=\"xemcode.php?sid=$sid&amp;url=$url&amp;copy=yes&amp;page=$page&amp;uid=$uid\"><b>Kích hoạt chế độ Copy</b></a>";}
echo "<br />";
if($page>1 ){
$ppage=$page-1;
echo "<a href=\"xemcode.php?sid=$sid&amp;url=$url&amp;copy=$copy&amp;uid=$uid&amp;page=$ppage\">[Truoc|</a>";
}
echo "<a href=\"#top\">Dau trang</a>";
if($page<$num_pages){
$npage=$page +1 ;
echo "<a href=\"xemcode.php?sid=$sid&amp;url=$url&amp;copy=$copy&amp;uid=$uid&amp;page=$npage\">|Sau]</a>";
}
if($page>'0' && $num_pages<='10'){
echo "<br />";
for($i=1;$i<=$num_pages;$i++){
if($i!=$page){
echo "[<a href=\"xemcode.php?sid=$sid&amp;url=$url&amp;page=$i&amp;copy=$copy&amp;uid=$uid\">$i</a>]";}else{
echo "[$i]";}}}else
{
echo "<br/>$page/$num_pages<form action=\"xemcode.php?sid=$sid&amp;url=$url&amp;copy=$copy&amp;uid=$uid\" method=\"get\"><input type=\"text\" format=\"*n\" name=\"page\" size=\"2\" value=\"\"/><input type=\"submit\" value=\"đến\"/>";}
if($url!=""){
echo "<br />Dang xem trang: <a href=\"$url\"><br>$url</a>";}
include 'foot.php';?>