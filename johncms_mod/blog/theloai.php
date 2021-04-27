<?php
require_once('inc/db.php');
require_once('inc/fun.php');
if(isset($_GET['url'])){
$url = $_GET['url'];
$sql = mysql_query("SELECT * FROM theloai WHERE url='$url'");
$m=mysql_fetch_array($sql);
if(mysql_num_rows($sql)==0){
$tit = 'Danh Sách Thể Loại';
require_once('inc/tren.php');
div('menu', '&rsaquo;<b> Danh Sách Thể Loại</b>').b_loi('Đường dẫn đến Thể loại không tồn tại!', 'theloai.html');
}else{
$tit = (isset($_GET['p']) ? 'Trang '.$_GET['p'].' - ':NULL).' '.$m['tenmuc'];
require_once('inc/tren.php');
$murl = $m['url'];
div('menu', '&rsaquo;<b> '.$m['tenmuc'].'</b>');
$total=mysql_result(mysql_query("SELECT count('id') FROM truyen where idm = '{$m['id']}'"),0);
$p = $_GET['p'];
if(empty($_GET['p'])) $p=1;
if($p > 1) $hal=' Page #'.$p;
$show = 10;
if($total==0){
div('list', 'Chưa có bài đăng nào!');
}else{
$pg=ceil($total/$show);
if($p>$pg && $p!=1)
$p=$pg;
if($p<1)
$p=1;
$j =($p-1)*$show;
$b=mysql_query("select id, url, name, xem from truyen where idm = '{$m['id']}' order by id desc limit $j, $show;");
while($v=mysql_fetch_array($b)){
echo '<div class="list"><img src="img/next.png"> <a href="'.$home.'/m_'.$murl.'/tr'.$v['id'].'_'.$v['url'].'.html">'.$v['name'].'</a> -'.$v['xem'].' xem</div>';
}
if($total > $show){
echo '<div class="trang">';
$sc= 5;
$st=floor($p/$sc)*$sc;
$en=$st+$sc;
$g=$st;
if($g<"2") print('');
else
if($g>"0") {if($g-1 == 1) {$page='m_'.$url.'';} else{$page='p'.($g-1).'_'.$url;}
print('<a href="'.$page.'">&laquo;</a> ');}
else
print("");
for($g;($g<$en);$g++){
if($g=="1" and $g!=$p){
print('<a href="m_'.$url.'">1</a> ');
}elseif($g=="1" and $g==$p){
print('<b class="ipage">1</b> ');
}elseif($g==$p){
print(' <b class="ipage">'.$g.'</b> ');
}elseif($g<=$pg){
if($g>"0") {if($p!="1") {$xx="$g";} else{$xx=$g;}
print('<a href="p'.$xx.'_'.$url.'">'.$g.'</a> ');} }else{
print(' ');
} }
if($g<=$pg) {if(empty($_GET['p'])) {$xx=$g;} else{$xx=''.$g;}
print('<a href="p'.$xx.'_'.$url.'">&raquo;</a>');}else
print(' '); }
echo '</div>'; }
} }else{
$tit = 'Danh Sách Thể Loại';
require_once('inc/tren.php');
div('menu', '&rsaquo;<b> Danh Sách Thể Loại</b>');
$sql=mysql_query("select * from theloai order by tenmuc asc");
$count = mysql_num_rows($sql);
if($count==0){
div('main', 'Chưa có thể loại');
}else
while($arr=mysql_fetch_array($sql)){
div('main', '<img src="img/next.png"> <a href="m_'.$arr['url'].'">'.$arr['tenmuc'].'</a> ['.(int)mysql_result(mysql_query("select count('id') from `truyen` WHERE `idm` = '{$arr['id']}'"),0).']'); } }

require_once('inc/duoi.php');
?>
