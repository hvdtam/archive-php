<?php
error_reporting(0);
require_once("../inc/db.php");
require_once("../inc/fun.php");
$tit = 'Sửa Cài Đặt Gốc';
require_once("../inc/tren.php");
if($admin){
if(isset($_GET['luu'])){
$mindex = ($_POST['mindex']==1 ? 'on':'off');
$bindex = ($_POST['bindex']==1 ? 'on':'off');
$title = (empty($_POST['title']) ? 'BenTreWap.Com':$_POST['title']);
$show = (empty($_POST['show']) ? '1000':$_POST['show']);
$copy = (empty($_POST['copy']) ? 'BenTreWap.Com':$_POST['copy']);
$set = array(
1 => $_POST['home'],
2 => $title,
3 => $mindex,
4 => $bindex,
5 => $_POST['key'],
6 => $copy,
7 => $show);

if(empty($set[1])){
div('loi', '<img src="../img/loi.png"> Không được để trống ô có dấu *');
}else{
$i =1;
foreach ($set as $set){
mysql_query("update setting set value='$set' where id='$i'");
$i++; }
b_go('../admin/caidat.php?ok'); } }

div('menu', 'Sửa Cài Đặt Gốc').div('main', (isset($_GET['ok']) ? div('ok', 'Thay đổi thành công!'):NULL).'<form action ="../admin/caidat.php?luu" method="post"><br>
&bull;Trang Chủ: *<br>
<input type="text" name="home" value="'.$home.'" size="15"/><br>
&bull;Tiêu đề Wap:<br>
<input type="text" name="title" value="'.b_set('title').'" size="15"/><br>
&bull;Tên Wap:<br>
<input type="text" name="copy" value="'.b_set('copy').'" size="15"/><br>
<input type="checkbox" name="mindex" value="1"'.(b_set('mindex')=='on' ? ' checked="checked"':NULL).'/> Bật thể loại ở trang chủ<br>
<input type="checkbox" name="bindex" value="1"'.(b_set('bindex')=='on' ? ' checked="checked"':NULL).'/> Bật danh sách ở trang chủ<br>
&bull;Từ Khóa:<br>
<textarea cols="20" rows="3" name="key">'.b_set('key').'</textarea><br>
&bull;Kí tự show:<br>
<input type="text" name="show" value="'.b_set('show').'" size="15"/><br>
<input type="submit" value="Thay Đổi">  <a href="../admin">Bỏ qua</a></form>');
}else{
b_go('../admin');
}
require_once("../inc/duoi.php");
?>
