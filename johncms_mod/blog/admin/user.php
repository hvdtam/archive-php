<?php
error_reporting(0);
require_once("../inc/db.php");
require_once("../inc/fun.php");
$tit = 'Sửa Hồ Sơ';
require_once("../inc/tren.php");
if($admin){
if(isset($_GET['nick'])){
if(empty($_POST['nick'])){
div('loi', '<img src="../img/loi.png"> Không được để trống tên đăng nhập!');
}else{
mysql_query("UPDATE `admin` SET `nick` = '{$_POST['nick']}' where id='{$ad['id']}'");
b_go('../admin/user.php?ok'); } }
if(isset($_GET['pass'])){
if(empty($_POST['pass'])){
div('loi', '<img src="../img/loi.png"> Không được để trống mật khẩu');
}else{
mysql_query("UPDATE `admin` SET `pass` = '".md5(md5($_POST['pass']))."' where id='{$ad['id']}'");
b_go('../admin/user.php?ok'); } }
div('menu', '&rsaquo; <b>Sửa Hồ Sơ</b>').div('main', (isset($_GET['ok']) ? div('ok', 'Thay đổi thành công!'):NULL).'<form action ="../admin/user.php?nick" method="post"><br>
&bull;Đổi nick đăng nhập: *<br>
<input type="text" name="nick" value="'.$ad['nick'].'" size="15"/><br>
<input type="submit" value="Thay Đổi">  <a href="../admin">Bỏ qua</a></form><br>
<form action ="../admin/user.php?pass" method="post">&bull;Đổi mật khẩu: *<br>
<input type="text" name="pass" value="" size="15"/><br>
<input type="submit" value="Thay Đổi">  <a href="../admin">Bỏ qua</a></form>');
}else{
b_go('../admin');
}
require_once("../inc/duoi.php");
?>
