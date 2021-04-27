<?php
error_reporting(0);
require_once("../inc/db.php");
require_once("../inc/fun.php");
$tit = 'Quản Lý Thể Loại';
require_once("../inc/tren.php");
require_once("../inc/seo.php");
if($admin){
if(isset($_GET['tao'])){
div('menu', '&rsaquo; <b>Thêm Thể Loại</b>');
$ten = htmlspecialchars($_POST['ten']);
if(mysql_num_rows(mysql_query("SELECT tenmuc FROM theloai WHERE tenmuc='$ten'"))>0){
b_loi('Đã có một thể loại cùng tên!', '../admin/theloai.php?them');
}elseif(strlen($ten) > 50){
b_loi('Tên thể loại nhiều nhất 50kí tự!', '../admin/theloai.php?them');
}elseif(empty($ten)){
b_loi('Bạn chưa nhập tên thể loại!', '../admin/theloai.php?them');
}else{
mysql_query("INSERT INTO `theloai` SET `tenmuc` = '$ten', `url` = '".seo($ten)."'");
div('ok', 'Thêm thành công "'.$ten.'"!').div('main', '<form action ="?tao" method="post">&bull;Tên Mục:( Max 50)<br><input type="text" name="ten" value="" size="15"/><br>
<input type="submit" value="Thêm Tiếp">  <a href="../admin/theloai.php">Bỏ qua</a></form>');
} }elseif(isset($_GET['doiten'])){
div('menu', '&rsaquo; <b>Đổi Tên Thể Loại</b>');
$sql = mysql_query("SELECT tenmuc FROM `theloai` WHERE `id`='{$_GET['id']}'");
if(mysql_num_rows($sql)==0){
b_loi('Thể loại không tìm thấy!', '../admin/theloai.php');
}else{
$ar=mysql_fetch_array($sql);
div('main', '<form action="?luu&id='.$_GET['id'].'" method="post"><b>'.$ar['tenmuc'].'</b><br/><input type="text" size="10" name="ten" value="'.$ar['tenmuc'].'"><br/><input type="submit" value="Thay đổi">  <a href="../admin/theloai.php">Bỏ qua</a></form>');
} }elseif(isset($_GET['luu'])){
div('menu', '&rsaquo; <b>Đổi Tên Thể Loại</b>');
$ten = htmlspecialchars($_POST['ten']);
if(mysql_num_rows(mysql_query("SELECT tenmuc FROM `theloai` WHERE `tenmuc`='$ten'"))>0){
b_loi('Bạn chưa thay đổi!  [<a href="../admin/theloai.php">Bỏ qua</a>]', '../admin/theloai.php?doiten&id='.$_GET['id']);
}elseif(strlen($ten) > 50){
b_loi('Tên thể loại nhiều nhất 50kí tự!', '../admin/theloai.php?doiten&id='.$_GET['id']);
}elseif(empty($ten)){
b_loi('Bạn chưa nhập tên thể loại!', '../admin/theloai.php?doiten&id='.$_GET['id']);
}else{
mysql_query("UPDATE `theloai` SET `tenmuc`='$ten', `url`='".seo($ten)."' WHERE `id`='{$_GET['id']}'");
b_go('../admin/theloai.php');
} }elseif(isset($_GET['them'])){
div('menu', '&rsaquo; <b>Thêm Thể Loại</b>').div('main', '<form action ="?tao" method="post">&bull;Tên Mục:( Max 50)<br><input type="text" name="ten" value="" size="15"/><br>
<input type="submit" value="Tạo Mục"></form>');
}else{
div('menu', '&rsaquo; <b>Các Thể Loại</b>');
$sql=mysql_query("select * from theloai order by tenmuc asc");
$count=mysql_result(mysql_query("select count(*) from theloai"),0);
if($count==0){
div('main', 'Chưa có thể loại');
}else
while($arr=mysql_fetch_array($sql)){
div('main', '&rsaquo; <a href="../m_'.$arr['url'].'" title="'.$arr['tenmuc'].'">'.mb_substr($arr['tenmuc'], 0, 20, 'UTF-8').'</a> |<a href="../admin/theloai.php?doiten&id='.$arr['id'].'">Sửa</a>');
}
div('main', '<img src="../img/add.png">'.b_link('../admin/theloai.php?them', 'Thêm mới'));
} }else{
b_go('../admin');
}
require_once("../inc/duoi.php");
?>
