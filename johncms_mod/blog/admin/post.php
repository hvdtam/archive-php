<?php
error_reporting(0);
require_once("../inc/db.php");
require_once("../inc/fun.php");
require_once("../inc/seo.php");
if($admin){
if(isset($_GET['post'])){
$tit = 'Đăng Bài Viết Mới';
require_once("../inc/tren.php");
div('menu', '&rsaquo; <b>Đăng Bài Viết Mới</b>');
$name = htmlspecialchars($_POST['name']);
$key = htmlspecialchars($_POST['key']);
$noidung = htmlspecialchars($_POST['noidung']);
if(empty($name) || empty($_POST['theloai'])){
b_loi('Không được để trống phần có dấu *', 'post.php');
}else{
$url = seo($name);
mysql_query("INSERT INTO `truyen` SET `url` = '$url', `key` = '$key', `noidung` = '$noidung', `name` = '$name', `thoigian` = '".date("d,m,y -H:i")."', `time` = '".time()."', `idm` = '{$_POST['theloai']}'");
echo '<div class="main">Đăng thành công '.$name.'!<br>&raquo;<a href="post.php">Đăng thêm</a><br>&raquo;<a href="'.$home.'/m_'.murl($_POST['theloai']).'/tr'.mysql_insert_id().'_'.$url.'.html">Tới bài này</a></form></div>';
} }else{
$tit = 'Đăng Bài Viết Mới';
require_once("../inc/tren.php");
div('menu', '&rsaquo; <b>Đăng Bài Viết Mới</b>');
echo '<div class="main"><form action ="?post" method="post">
&bull;Tiêu đề: *<br>
<input type="text" name="name" value="" size="15"/><br>
&bull;Thể Loại: *<br><select name="theloai"><option value="">Chọn Một</option>';
$sql = mysql_query("select `id`,`tenmuc` from `theloai` order by tenmuc asc");
while($r = mysql_fetch_array($sql)){
echo '<option value="'.$r['id'].'">'.$r['tenmuc'].'</option>'; }
echo '</select><br>
&bull;Nội dung: <br>
<textarea name="noidung" rows="7" cols="20"></textarea><br>
&bull;Keyword: <br>
<textarea name="key" rows="3" cols="20"></textarea><br>
<input type="submit" value="Đăng"></form></div>';
} }else{
b_go('../admin');
}
require_once("../inc/duoi.php");
?>
