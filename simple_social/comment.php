<?php
require_once('inc/db.php');
require_once('inc/fun.php');
if(!isset($_GET['url'])){
b_go('index.html');
}else{
$url = $_GET['url'];
$id = $_GET['id'];
$sql = mysql_query("SELECT `idm`, `key`, `name` FROM `truyen` WHERE `url` = '$url' and `id` = '$id'");
if(mysql_num_rows($sql)==0){
$tit = 'Lỗi Đường Dẫn';
require_once('inc/tren.php');
div('menu', '&rsaquo; <b>Lỗi Đường Dẫn</b>').b_loi('Đường dẫn không tồn tại hoặc đã bị xóa!', 'index.html');
}else{
$ar=mysql_fetch_array($sql);
if($_POST['submit'] && $_POST['msg'] && $_POST['name'] && strlen($_POST['msg'])>5 && $_POST['cap'] == $_SESSION['ktc']){
mysql_query("INSERT INTO comment SET comment = '".htmlspecialchars($_POST['msg'])."', name = '".htmlspecialchars($_POST['name'])."', idt = '$id', time = '".time()."'");
$_SESSION['name'] = $_POST['name'];
}elseif(isset($_GET['delpost'])){
if(mysql_num_rows(mysql_query("SELECT id FROM comment WHERE idt='$id' and id = '{$_GET['delpost']}'"))>0 && $admin){
mysql_query("DELETE FROM comment WHERE id = '{$_GET['delpost']}'"); }
header('Location:'.$home.'/comment/tr'.$id.'_'.$url.'.html');
exit; }
$tit = 'Bình Luận '.$ar['name'];
$key = $ar['key'];
require_once('inc/tren.php');
div('menu', '&rsaquo; <b>Bình Luận Truyện</b>');
$total=mysql_result(mysql_query("SELECT count(*) FROM comment where idt = '$id'"),0);
$p = $_GET['p'];
if(empty($_GET['p'])) $p=1;
if($p>1) $hal=' Page #'.$p;
$show=8;
if($total==0){
div('main', 'Chưa có bình luận!');
}else{
$pg=ceil($total/$show);
if($p>$pg && $p!=1)
$p=$pg;
if($p<1)
$p=1;
$j =($p-1)*$show;
$b=mysql_query("select * from comment where idt = '$id' order by id desc limit $j, $show;");
while($v=mysql_fetch_array($b)){
echo '<div class="main"><b style="color:green">&rsaquo;'.$v['name'].'</b>: '.nl2br(bbcode(smi($v['comment']))).' '.($admin ? '[<a href="'.$home.'/comment/del'.$v['id'].'_'.$id.'_'.$url.'.html">Xóa</a>]':'').'<br>Cách đây '.ctime($v['time']).'</div>';
}
if($total > $show){
echo '<div class="main" style="text-align:center">';
if($p != 1){
echo '&laquo;<a href="'.$home.'/comment/p'.($p-1).'_'.$id.'_'.$url.'.html">Trước</a> '; }
echo ' <b>['.$p.'/'.$pg.']</b> ';
if($j+$show < $total){
echo ' <a href="'.$home.'/comment/p'.($p+1).'_'.$id.'_'.$url.'.html">Xem thêm</a>&raquo;'; }
} } echo '</div><div class="main"><form action="" method="post">
&bull; Tên <input type="text" name="name" size="10" value="'.$_SESSION['name'].'"><br>
<textarea cols="15" name="msg" rows="3"></textarea><br>-Nhập mã: <input type="text" name="cap" size="4"> <img src="../cap'.rand(0001,9999).'.gif"><br>
<input type="submit" name="submit" class="submit" value="Viết">  |  <a href="smi_'.$id.'_'.$url.'.html">Mặt cười</a></form></div>';
if(isset($_GET['smi'])){
echo '<div class="main"><input type="text" value=":hix:" size="3"><img src="../img/smi/hix.gif"> <input type="text" value=":aa:" size="3"><img src="../img/smi/aa.gif"> <input type="text" value=":nghi:" size="3"><img src="../img/smi/nghi.gif">
<br>
<input type="text" value=":oai:" size="3"><img src="../img/smi/oai.gif"> <input type="text" value=":he:" size="3"><img src="../img/smi/he.gif"> <input type="text" value=":nong:" size="3"><img src="../img/smi/nong.gif">
<br>
<input type="text" value=":buon:" size="3"><img src="../img/smi/buon.gif"> <input type="text" value=":im:" size="3"><img src="../img/smi/im.gif"> <input type="text" value=":D" size="3"><img src="../img/smi/D.gif">
<br>
<input type="text" value=":buc:" size="3"><img src="../img/smi/buc.gif"> <input type="text" value=":-?" size="3"><img src="../img/smi/hoi.gif"> <input type="text" value=":)" size="3"><img src="../img/smi/).gif">
<br>
<input type="text" value=":(" size="3"><img src="../img/smi/(.gif"> <input type="text" value="=))" size="3"><img src="../img/smi/=)).gif">  [<a href="'.$home.'/comment/tr'.$id.'_'.$url.'.html">Đóng</a>]</div>';
}
echo '<div class="main"><img src="../img/next.png"> <a href="'.$home.'/m_'.murl($ar['idm']).'/tr'.$id.'_'.$url.'.html">Quay bài viết</a></div>';
} }
require_once('inc/duoi.php');
?>
