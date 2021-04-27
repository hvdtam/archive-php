<?php
require_once('i/~head.php');
require_once('inc/db.php');
require_once('inc/fun.php');
if(isset($_GET['thich'])){
$tit = 'Top Truyện Hay, Top Truyện Hot, Truyện Hay Nhất, Wap Đọc Truyện';
$key = 'top truyen hay, top truyen hot, wap doc truyen, truyen hay, truyen hot, truyen thu gian';
require_once("inc/tren.php");
$sql=mysql_query("select idm, id, url, name, xem from truyen where thich > '0' order by thich desc limit 0,15;");
$con=mysql_num_rows($sql);
div('menu', '&rsaquo;<b> Top Truyện Hay</b>');
if($con == 0) {
div('main', 'Danh sách trống!');
}else{
while($v=mysql_fetch_array($sql)){
echo '<div class="list">» <a href="'.$home.'/m_'.murl($v['idm']).'/tr'.$v['id'].'_'.$v['url'].'.html">'.$v['name'].'</a>  '.$v['xem'].' xem</div>';
} }
require_once("inc/duoi.php");
exit;
}
if(isset($_GET['xem'])){
$tit = 'Top Xem Nhiều, Truyện Hay Nhất, Wap Đọc Truyện';
$key = 'wap doc truyen, truyen hay nhat, truyen hot nhat, truyen xem nhieu, xem nhieu nhat, wap truyen hay';
require_once("inc/tren.php");
$sql=mysql_query("select id, idm, url, name, xem from truyen where xem > '0' order by xem desc limit 0,15;");
$con=mysql_num_rows($sql);
div('menu', '&rsaquo;<b> Top Xem Nhiều</b>');
if($con == 0) {
div('main', 'Danh sách trống!');
}else{
while($v=mysql_fetch_array($sql)){
echo '<div class="list">» <a href="'.$home.'/m_'.murl($v['idm']).'/tr'.$v['id'].'_'.$v['url'].'.html">'.$v['name'].'</a> '.$v['xem'].' xem</div>';
} }
require_once("inc/duoi.php");
exit;
}
$tit = (isset($_GET['p']) ? 'Trang '.$_GET['p'].' - ':NULL).b_set('title').' ';
$key = 'wap doc truyen, wap xem truyen, truyen hay nhat, wap truyen hay';
require_once('inc/tren.php');
if(b_set('bindex') == 'on'){
div('menu', '&rsaquo;<b> Truyện Mới Nhất</b>');
$total=mysql_result(mysql_query("SELECT count('id') FROM truyen"),0);
$p = $_GET['p'];
if(empty($_GET['p'])) $p=1;
if($p>1) $hal=' Page #'.$p;
$show = 10;
if($total==0){
div('main', 'Chưa có bài đăng nào');
}else{
$pg=ceil($total/$show);
if($p>$pg && $p!=1)
$p=$pg;
if($p<1)
$p=1;
$j =($p-1)*$show;
$b=mysql_query("select idm, id, url, name, xem from truyen order by id desc limit $j, $show;");
while($v=mysql_fetch_array($b)){
echo '<div class="list">» <a href="'.$home.'/m_'.murl($v['idm']).'/tr'.$v['id'].'_'.$v['url'].'.html">'.$v['name'].'</a> '.$v['xem'].' xem</div>';
}
if($total > $show){
echo '<div class="trang">';
$sc= 5;
$st=floor($p/$sc)*$sc;
$en=$st+$sc;
$g=$st;
if($g<"2") print('');
else
if($g>"0") {if($g-1 == 1) {$page='index.html';} else{$page='trang-'.($g-1).'.html';}
print('<a href="'.$page.'">&laquo;</a> ');}
else
print("");
for($g;($g<$en);$g++){
if($g=="1" and $g!=$p){
print('<a href="index.html">1</a> ');
}elseif($g=="1" and $g==$p){
print('<b class="ipage">1</b> ');
}elseif($g==$p){
print(' <b class="ipage">'.$g.'</b> ');
}elseif($g<=$pg){
if($g>"0") {if($p!="1") {$xx="$g";} else{$xx=$g;}
print('<a href="trang-'.$xx.'.html">'.$g.'</a> ');} }else{
print(' ');
} }
if($g<=$pg) {if(empty($_GET['p'])) {$xx=$g;} else{$xx=''.$g;}
print('<a href="trang-'.$xx.'.html">&raquo;</a>');}else
print(' '); }
echo '</div>'; } }
if(b_set('mindex')=='on'){
div('menu', '&rsaquo;<b> Các Thể Loại</b>');
$sql=mysql_query("select * from theloai order by tenmuc asc");
$count = mysql_num_rows($sql);
if($count==0){
div('main', 'Chưa có thể loại');
}else{
while($arr=mysql_fetch_array($sql)){
div('main', '» <a href="m_'.$arr['url'].'">'.$arr['tenmuc'].'</a> ['.(int)mysql_result(mysql_query("select count('id') from `truyen` WHERE `idm` = '{$arr['id']}'"),0).']');
} } }

echo '<div class="menu">&rsaquo;<b> Menu Wap</b></div>
<div class="main">» <a href="top-like.html">Top yêu thích</a></div>
<div class="main">» <a href="top-view.html">Top xem nhiều</a></div>
<div class="menu">&rsaquo;<b> Thống Kê</b></div>
<div class="main">» Thể loại: '.(int)mysql_result(mysql_query("select count('id') from theloai"),0).'</div>
<div class="main">» Bài đăng: '.(int)mysql_result(mysql_query("select count('id') from truyen"),0).'</div>
<div class="main">» <a href="comment">Các bình luận</a> '.(int)mysql_result(mysql_query("select count('id') from comment"),0).' </div>';
require_once('inc/duoi.php');
?>
