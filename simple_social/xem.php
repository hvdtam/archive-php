<?php
require_once('inc/db.php');
require_once('inc/fun.php');
if(!isset($_GET['url'])){
b_go('index.html');
}else{
$url =$_GET['url'];
$id =$_GET['id'];
$sql = mysql_query("SELECT * FROM truyen WHERE url='$url' and id = '$id'");
if(mysql_num_rows($sql)==0){
$tit = 'Lỗi Đường Dẫn';
require_once('inc/tren.php');
div('menu', '&rsaquo; <b>Lỗi Đường Dẫn</b>').b_loi('Đường dẫn không tồn tại hoặc đã bị xóa!', '../index.html');
}else{
$ar=mysql_fetch_array($sql);
$m=mysql_fetch_array(mysql_query("SELECT * FROM theloai WHERE id='{$ar['idm']}'"));
$murl = $m['url'];
if(isset($_GET['vote'])){
if(mysql_result(mysql_query("select count('id') from `vote` where `idt`= '$id' and `ip`='$ip'"),0)==0){
mysql_query("INSERT INTO `vote` SET `idt`='$id', `ip`='$ip'");
mysql_query("UPDATE `truyen` SET `thich`=`thich`+'1' where `id`= '$id'");
}
b_go($home.'/m_'.$url.'/tr'.$id.'_'.$url.'.html'); }
$tit = $ar['name'].' - '.$m['tenmuc'];
$key = $ar['key'];
require_once('inc/tren.php');
mysql_query("UPDATE `truyen` SET `xem`=`xem`+1 WHERE `id`='$id'");
div('menu', '&rsaquo; <b>'.$ar['name'].'</b>').div('main', '# Thể loại: <a href="'.$home.'/m_'.$murl.'">'. $m['tenmuc'].'</a><br>
# Đăng lúc: '.$ar['thoigian'].'<br>
# '.$ar['xem'].' xem<br>
# Thích: '.$ar['thich'].(mysql_num_rows(mysql_query("SELECT * FROM `vote` WHERE `idt`='$id' and `ip`='$ip'"))==0 ? ' <b style="color:red"><a href="'.$home.'/m_'.$murl.'/like'.$id.'_'.$url.'.html"><img src="../img/like.png"></a></b>':' thích').'<br>
# Chia sẽ: <a href="http://www.facebook.com/share.php?u='.$home.'/m_'.$murl.'/tr'.$id.'_'.$url.'.html" title="Share on FACEBOOK"><img src="http://gocdidong-
com.googlecode.com/files/shareon_facebook.png" height="15px" alt="" /></a>
<a href="http://twitter.com/?status='.$ar['name'].'&nbsp;'.$home.'/m_'.$murl.'/tr'.$id.'_'.$url.'.html"
title="Share on TWITTER"><img src="http://gocdidong-com.googlecode.com/files/shareon_twitter.png" height="15px" alt="" /></a>
<a href="http://link.apps.zing.vn/share?u='.$home.'/m_'.$murl.'/tr'.$id.'_'.$url.'.html&amp;&t='.$ar['name'].'" title="Share on ZingMe"><img src="http://gocdidong-com.googlecode.com/files/shareon_zingme.gif" height="15px" alt="" /></a><br>
'.($admin ? '&rsaquo; <a href="../admin/sua.php?id='.$ar['id'].'&sua">Chỉnh sửa</a> | <a href="../admin/sua.php?id='.$ar['id'].'&xoa">Xóa</a>':''));
$show = b_set('show');
$tx = $ar['noidung'];
$strrpos = mb_strrpos($tx, " ");
$total = 1;
if(isset($_GET['p'])){
$page = abs(intval($_GET['p']));
if($page == 0)
$page = 1;
$start = $page-1;
}else{
$page = $start+1; }
$ta = 0;
if($strrpos){
while($ta < $strrpos){
$string = mb_substr($tx, $ta, $show);
$tb = mb_strrpos($string, " ");
$m_sim = $tb;
$strings[$total] = $string;
$ta = $tb + $ta;
if($page == $total){
$nd = $strings[$total]; }
if($strings[$total] == ""){
$ta = $strrpos++;
}else{
$total++; } }
if($page >= $total){
$page = $total-1;
$nd = $strings[$page]; }
$total = $total-1;
if($page != $total){
$prb = mb_strrpos($nd, " ");
$nd = mb_substr($nd, 0, $prb); } }else{
$nd = $tx; }
echo '<div class="xem"><a name="view"></a>'.nl2br(bbcode(smi($nd))).'</div>';
if($page != 1) $pervpage = ' <a href= "'.$home.'/m_'.$murl.'/p'.($page-1).'_'.$id.'_'.$url.'.html">&laquo;</a> ';
if($page != $total) $nextpage = ' <a href="'.$home.'/m_'.$murl.'/p'.($page+1).'_'.$id.'_'.$url.'.html">&raquo;</a>';
if($page-4 > 0) $first = '<a href="'.$home.'/m_'.$murl.'/tr'.$id.'_'.$url.'.html">1</a>...';
if($page+4 <= $total) $last = '...<a href="'.$home.'/m_'.$murl.'/p'.$total.'_'.$id.'_'.$url.'.html">'.$total.'</a>';
if($page-2 > 0) $page2left = ' <a href= "'.$home.'/m_'.$murl.'/p'.($page-2).'_'.$id.'_'.$url.'.html">'.($page-2).'</a> ';
if($page-1 > 0) $page1left = '<a href= "'.$home.'/m_'.$murl.'/p'.($page-1).'_'.$id.'_'.$url.'.html">'.($page-1).'</a> ';
if($page+2 <= $total) $page2right = ' <a href= "'.$home.'/m_'.$murl.'/p'.($page+2).'_'.$id.'_'.$url.'.html">'.($page+2).'</a>';
if($page+1 <= $total) $page1right = ' <a href="'.$home.'/m_'.$murl.'/p'.($page+1).'_'.$id.'_'.$url.'.html">'.($page+1).'</a>';
echo '<div class="trang"><a href="#view">↑</a> '.$pervpage.$first.$page2left.$page1left.'<b class="ipage">'.$page.'</b>'.$page1right.$page2right.$last.$nextpage.'</div><div class="main">● <a href="'.$home.'/comment/tr'.$id.'_'.$url.'.html">Bình luận</a> ('.mysql_num_rows(mysql_query("select id from `comment` where `idt` = '$id'")).')</div>
<div class="tmn">Tags: ';
$key=explode(' ', $ar['name']);
$total = count($key);
for($k=0; $k<$total; $k++){
$tags .= ($k > 0 && $k < $total ? ' | ':NULL).'<a href="../tim.php?key='.$key[$k].'">'.$key[$k].'</a>'; }
echo $tags.'</div>';
$sq2 = mysql_query("select id, idm, url, xem, name from `truyen` where `idm` = '{$ar['idm']}' and `id` != '$id' order by rand() desc limit 5;");
$con = mysql_num_rows($sq2);
if($con != 0){
div('menu', '&rsaquo; <b>Bài Viết Khác</b>');
while($i=mysql_fetch_array($sq2)){
echo '<div class="list">● <a href="'.$home.'/m_'.murl($i['idm']).'/tr'.$i['id'].'_'.$i['url'].'.html">'.$i['name'].'</a> '.$i['xem'].' xem</div>';
} } } }
require_once('inc/duoi.php');
?>
