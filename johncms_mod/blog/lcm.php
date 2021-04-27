<?php
require_once('inc/db.php');
require_once('inc/fun.php');
$tit = 'Bình Luận Truyện, Wap Truyện Hay, Top Truyện Hot, Truyện Hay Nhất, Wap Đọc Truyện';
$key = 'top truyen hay, top truyen hot, wap doc truyen, truyen hay, truyen hot, truyen thu gian';
require_once("inc/tren.php");
div('menu', '&rsaquo;<b> Bình Luận Truyện</b>');
$total=mysql_result(mysql_query("SELECT count('id') FROM comment"),0);
$p = $_GET['p'];
if(empty($_GET['p'])) $p=1;
if($p>1) $hal=' Page #'.$p;
$show = 10;
if($total==0){
div('main', 'Chưa có bình luận mới!');
}else{
$pg=ceil($total/$show);
if($p>$pg && $p!=1)
$p=$pg;
if($p<1)
$p=1;
$j =($p-1)*$show;
$b=mysql_query("select * from comment order by id desc limit $j, $show;");
while($v=mysql_fetch_array($b)){$ar = mysql_fetch_array(mysql_query("select idm, id, url, name from truyen where id = '{$v['idt']}'"));
if(strlen($v['comment']) > 50){
$cm = $v['comment'];
}else{
$cm = mb_substr($v['comment'], 0, 50, 'UTF-8');
}
echo '<div class="main"><b style="color:green">&rsaquo;'.$v['name'].'</b>: '.nl2br(smi($cm)).'<br>Cách đây '.ctime($v['time']).' từ <a href="'.$home.'/m_'.murl($ar['idm']).'/tr'.$ar['id'].'_'.$ar['url'].'.html">'.$ar['name'].'</a></div>';
}
if($total > $show){
echo '<div class="trang">';
$sc= 10;
$st=floor($p/$sc)*$sc;
$en=$st+$sc;
$g=$st;
if($g<"2") print('');
else
if($g>"0") {if($g-1 == 1) {$page='comment';} else{$page='comment-'.($g-1);}
print('<a href="'.$page.'">[&laquo;]</a> ');}
else
print("");
for($g;($g<$en);$g++){
if($g=="1" and $g!=$p){
print('<a href="comment">1</a> ');
}elseif($g=="1" and $g==$p){
print('<b class="ipage">1</b> ');
}elseif($g==$p){
print(' <b class="ipage">'.$g.'</b> ');
}elseif($g<=$pg){
if($g>"0") {if($p!="1") {$xx="$g";} else{$xx=$g;}
print('<a href="comment-'.$xx.'">'.$g.'</a> ');} }else{
print(' ');
} }
if($g<=$pg) {if(empty($_GET['p'])) {$xx=$g;} else{$xx=''.$g;}
print('<a href="comment-'.$xx.'">[&raquo;]</a>');}else
print(' '); }
echo '</div>'; }
require_once('inc/duoi.php');
?>
