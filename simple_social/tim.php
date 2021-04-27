<?php
require_once("inc/db.php");
require_once("inc/fun.php");
if(isset($_GET['key'])){
if(empty($_GET['key'])){
$tit = 'Lỗi Tìm Kiếm &bull; Truyện Hay, Wap Đọc Truyện, Truyện Thư Giản';
require_once("inc/tren.php");div('menu', '&rsaquo;<b> Lỗi Tìm Kiếm</b>').div('main', 'Bạn phải nhập 1 từ khóa!<br><form method="get" action="tim.php"><input type="text" name="key" value="" /><input class="submit" type="submit" value="Tìm" /></form>');
require_once("inc/duoi.php");
exit;
}

$key = $_GET['key'];
$total=mysql_result(mysql_query("SELECT count('id') from truyen where `noidung` like '%".mysql_escape_string($key)."%' or `name` like '%".mysql_escape_string($key)."%';"),0);
$p = $_GET['p'];
if(empty($_GET['p'])) $p=1;
if($p > 1) $hal=' Page #'.$p;
$show=10;
if($total=="0"){
$tit = 'Không Có Kết Quả - Tìm Kiếm &bull; Truyện Hay, Wap Đọc Truyện, Truyện Thư Giản';
require_once("inc/tren.php");div('menu', '&rsaquo;<b> Không Tìm Thấy</b>').div('main', 'Bạn hãy thử tìm với một từ khóa khác!<br><form method="get" action="tim.php"><input type="text" name="key" value="" /><input class="submit" type="submit" value="Tìm" /></form>');
require_once("inc/duoi.php");
exit;
}

$tit = (!empty($_GET['p']) ? $trang.' '.$_GET['p'].' &bull; ':NULL).'Tags &quot;'.$_GET['key'].'&quot; &bull; Truyện Hay, Wap Đọc Truyện, Truyện Thư Giản';
require_once("inc/tren.php");div('menu', '&rsaquo;<b> '.$total.' Kết Quả</b>').div('main', 'Đã tìm thấy '.$total.' kết quả!<br><form method="get" action="tim.php"><input type="text" name="key" value="'.$_GET['key'].'" /><input class="submit" type="submit" value="Tìm" /></form>');
$pg=ceil($total/$show);
if($p>$pg && $p!=1)
$p=$pg;
if($p<1)
$p=1;
$j = ($p-1) * $show;
$a=mysql_query("select id, idm, name, url, xem from truyen where `noidung` like '%".mysql_escape_string($key)."%' or `name` like '%".mysql_escape_string($key)."%' order by id desc limit $j, $show");
while($v=mysql_fetch_array($a))
{echo '<div class="list"><img src="img/next.png"> <a href="'.$home.'/m_'.murl($v['idm']).'/tr'.$v['id'].'_'.$v['url'].'.html">'.$v['name'].'</a> -'.$v['xem'].' xem</div>';
}
if($total > $show){
echo '<div class="trang">';
$sc= 5;
$st=floor($p/$sc)*$sc;
$en=$st+$sc;
$g=$st;
if($g<"2") print('');
else
if($g>"0") {if($g-1 == 1) {$page='tim.php?key='.$_GET['key'];} else{$page='tim.php?key='.$_GET['key'].'&p='.($g-1); }
print('<a href="'.$page.'">&laquo;</a> ');}
else
print("");
for($g;($g<$en);$g++){
if($g=="1" and $g!=$p){
print('<a href="tim.php?key='.$_GET['key'].'&p=1">1</a> ');
}elseif($g=="1" and $g==$p){
print('<b class="ipage">1</b> ');
}elseif($g==$p){
print(' <b class="ipage">'.$g.'</b> ');
}elseif($g<=$pg){
if($g>"0") {if($p!="1") {$xx="$g";} else{$xx=$g;}
print('<a href="tim.php?key='.$_GET['key'].'&p='.$xx.'">'.$g.'</a> ');} }else{
print(' ');
} }
if($g<=$pg) {if(empty($_GET['p'])) {$xx=$g;} else{$xx=''.$g;}
print('<a href="tim.php?key='.$_GET['key'].'&p='.$xx.'">&raquo;</a>');}else
print(' '); }
echo '</div>';
require_once("inc/duoi.php");
exit; }

$tit = 'Tìm Kiếm &bull; Truyện Hay, Wap Đọc Truyện, Truyện Thư Giản';
require_once("inc/tren.php");
div('menu', '&rsaquo;<b> Tìm Kiếm Truyện</b>').div('main', '<form method="get" action="tim.php"><input type="text" name="key" value="" /><input class="submit" type="submit" value="Tìm" /></form>');
require_once("inc/duoi.php");
?>
