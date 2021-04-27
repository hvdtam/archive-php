<?php
ob_start();
include("osv_func.php");
include 'head.php';
$cpp=$_GET["cpp"];
if($cpp<500){
/* jika jumlah char perhalaman kurang dari 500 kita pakai default 500 */
$cpp=500;}
//judul site kamu
$nama_site="Source code";
//url ke main page
$link="index.php";
//background site kamu
$background="#7fffd4";
//warna text
$text="#0000ff";
//jangan diedit mulai dr sini.. tp boleh aja klo mao edit.
$url=$_GET["url"];
$copy=$_GET["copy"];
echo "<a name=\"top\"></a>";
echo "<div class='phdr'>$nama_site</div>";
//halaman. . .
$page=$_GET["page"];
if($page==""||$page<=0
)$page=1;
if(ereg("^http://",$url)){
$ff=@htmlspecialchars(file_get_contents($url));
$ff=nl2br($ff);
}else{
echo "Nhap url";}
$jumlah=strlen($ff);
$num_items=$jumlah;
$items_per_page=$cpp;
$num_pages=ceil($num_items/$items_per_page); if(($page>$num_pages)&&
$page!=1)$page=$num_pages;
$limit_start=($page-1)*$items_per_page;
echo "<form action=\"osv.php?copy=$copy\" method=\"get\"><input type=\"text\" name=\"url\" value=\"http://\" /><br />";
echo "Char/page:<input name=\"cpp\" type=\"text\" format=\"*n\" size=\"4\" maxlength=\"4\" value=\"1500\" /><br />";
echo "<input type=\"submit\" value=\"Xem\" /></form>";
echo "<div style='background-color:#333333;color:#ffffff;border-style:ridge;border-color:#00ccff;border-width:1px'>";
$pr=($page*$cpp)-$cpp;
$view=substr($ff,$pr,$cpp);
if($copy=="yes"){
echo "<textarea>$view</textarea>";}
else{
echo altecom($view);}
echo "</div></div>";
echo "<p>";
if($copy=="yes"){
echo "<a href=\"osv.php?url=$url&amp;page=$page&amp;cpp=$cpp\"><font color="red">Ngưng chế độ sao chép</font></a>";}
else{
echo "<a href=\"osv.php?url=$url&amp;copy=yes&amp;page=$page&amp;cpp=$cpp\"><font color="red">kích hoạt chế độ sao chép</font></a>";}
echo "<br />";
if($page>1 ){
$ppage=$page-1;
echo "[<a href=\"osv.php?url=$url&amp;copy=$copy&amp;cpp=$cpp&amp;page=$ppage\"> Truoc | </a>";
}
echo "<a href=\"#top\">Top</a>";
if($page<$num_pages){
$npage=$page +1 ;
echo "<a href=\"osv.php?url=$url&amp;copy=$copy&amp;cpp=$cpp&amp;page=$npage\"> | Sau </a>]";
}
if($page>'0' && $num_pages<='10'){
echo "<br />";
for($i=1;$i<=$num_pages;$i++){
if($i!=$page){
echo "[<a href=\"osv.php?url=$url&amp;page=$i&amp;copy=$copy&amp;cpp=$cpp\">$i</a>]";}else{
echo "[$i]";}}}else
{
echo "<br />$page/$num_pages<form action=\"osv.php?url=$url&amp;copy=$copy&amp;cpp=$cpp\" method=\"get\"><input type=\"text\" format=\"*n\" name=\"page\" size=\"2\" value=\"\"/><input type=\"submit\" value=\"Đến trang\"/>";}
if($url!=""){
echo "<br /><a href=\"$url\">$url</a><br />";}
echo "<a href=\"$link?cpp=$cpp\">Trang chu</a>";
include 'foot.php';
?>