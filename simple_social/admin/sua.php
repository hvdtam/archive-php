<?php
error_reporting(0);
require_once("../inc/db.php");
require_once("../inc/fun.php");
require_once("../inc/seo.php");
if($admin){
if(isset($_GET['luu'])){
$tit = 'Chỉnh Sửa';
require_once("../inc/tren.php");
div('menu', '&rsaquo; <b>Chỉnh Sửa</b>');
$name = htmlspecialchars($_POST['name']);
$key = htmlspecialchars($_POST['key']);
$noidung = htmlspecialchars($_POST['noidung']);
if(empty($name)){
b_loi('Không được để trống tên Truyện', '../admin/sua.php?sua&id='.$_GET['id']);
}else{
$url = seo($name);
mysql_query("UPDATE `truyen` SET `name` = '$name', `url` = '$url', `noidung` = '$noidung', `key` = '$key', `idm` = '{$_POST['theloai']}' where id='{$_GET['id']}'");
b_go(''.$home.'/m_'.murl($_POST['theloai']).'/tr'.$_GET['id'].'_'.$url.'.html');
} }elseif(isset($_GET['sua'])){
$tit = 'Chỉnh Sửa';
require_once("../inc/tren.php");
div('menu', '&rsaquo; <b>Chỉnh Sửa</b>');
$sql=mysql_query("select * from truyen where id='{$_GET['id']}'");
if(mysql_num_rows($sql)==0){
b_loi('Không tìm thấy bài viết này!', '../admin');
}else{
$ar=mysql_fetch_array($sql);
echo '<div class="main"><form action ="../admin/sua.php?luu&id='.$_GET['id'].'" method="post">
&bull;Tiêu đề: *<br>
<input type="text" name="name" value="'.$ar['name'].'" size="15"/><br>
&bull;Thể Loại: *<br><select name="theloai"><option value="'.$ar['idm'].'">Không đổi</option>';
$sql = mysql_query("select `id`,`tenmuc` from `theloai` order by tenmuc asc");
while($r = mysql_fetch_array($sql)){
echo '<option value="'.$r['id'].'">'.$r['tenmuc'].'</option>'; }
echo '</select><br>
&bull;Nội dung: <br>
<textarea name="noidung" rows="7" cols="25">'.$ar['noidung'].'</textarea><br>
&bull;Keyword: <br>
<textarea name="key" rows="3" cols="20">'.$ar['key'].'</textarea><br>
<input type="submit" value="Thay đổi"></form></div>';
} }elseif(isset($_GET['xoa'])){
$tit = 'Xóa Truyện';
require_once("../inc/tren.php");
div('menu', '&rsaquo; <b>Xoá Truyện</b>');
$sql=mysql_query("select id, idm, url, name from truyen where id='{$_GET['id']}'");
if(mysql_num_rows($sql)==0){
b_loi('Không tìm thấy bài viết này!', '../admin');
}else{
$ar=mysql_fetch_array($sql);
div('main', 'Xác nhận xóa "'.$ar['name'].'"?<br><a href="../admin/sua.php?okxoa&id='.$_GET['id'].'">Xóa</a> | <a href="'.$home.'/m_'.murl($ar['idm']).'/tr'.$_GET['id'].'_'.$ar['url'].'.html">Bỏ qua</a>');
} }elseif(isset($_GET['okxoa'])){
$tit = 'Xóa Truyện';
require_once("../inc/tren.php");
div('menu', 'Xoá Truyện');
$sql=mysql_query("select id from truyen where id='{$_GET['id']}'");
if(mysql_num_rows($sql)==0){
b_loi('Không tìm thấy bài viết này!', '../admin');
}else{
mysql_query("DELETE FROM `truyen` WHERE `id`='{$_GET['id']}'");
mysql_query("DELETE FROM `comment` WHERE `idg`='{$_GET['id']}'");
mysql_query("DELETE FROM `vote` WHERE `idg`='{$_GET['id']}'");
b_go('../theloai.html');
} }else{
b_go('../admin'); } }else{
b_go('../admin'); }
require_once("../inc/duoi.php");
?>
