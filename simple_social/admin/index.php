<?php
require_once("../inc/db.php");
require_once("../inc/fun.php");
$tit = 'Admin Cpanel';
require_once("../inc/tren.php");
div('menu', '<b>&rsaquo;</b> Admin Cpanel');
if($admin){
if(isset($_GET['del'])){
$expire_time = 20;
foreach(glob('../files/*.jar') as $Filename){
$FileCreationTime = filectime($Filename);
$FileAge = time() - $FileCreationTime;
if($FileAge > ($expire_time*60)){
unlink($Filename);
} }
foreach(glob('../files/*.jad') as $Filename){
$FileCreationTime = filectime($Filename);
$FileAge = time() - $FileCreationTime;
if($FileAge > ($expire_time*60)){
unlink($Filename);
} } }
div('main', '&rsaquo; <a href="theloai.php">Quản lý Thể loại</a><br>
&rsaquo; <a href="post.php">Đăng truyện mới</a><br>
&rsaquo; <a href="user.php">Sửa Hồ sơ</a><br>
&rsaquo; <a href="caidat.php">Cài đặt wap</a><br>
&rsaquo; <a href="?del">Xóa file rác</a>');
require_once("../inc/duoi.php");
exit;
}

$form = '<form action="?log" method="post">
<img src="../img/user.png">Tài khoản:<br><input type="text" name="nick" value="" size="15"><br>
<img src="../img/pass.png">Mật khẩu:<br><input type="password" name="pass" value="" size="15">
<br><input type="submit" value="Đăng Nhập"></form>';

if(isset($_GET['log'])){
$nick = addslashes($_POST['nick']);
$pass = md5(md5(addslashes($_POST['pass'])));
$u=mysql_fetch_array(mysql_query("SELECT * FROM admin WHERE nick='$nick'"));
if($_COOKIE['log']== 3){
div('loi', '<img src="../img/loi.png"> Bạn đã nhập sai '.$_COOKIE['log'].'/3 lần cho phép!').div('main', 'Để bảo mật tài khoản bạn vui lòng chờ 15phút nữa!');
require_once("../inc/duoi.php");
exit;
}
if($pass != $u['pass']){
$num = $_COOKIE['log']+1;
setcookie("log", $num, time()+900);
div('loi', '<img src="../img/loi.png"> Bạn đã nhập sai '.$num.'/3 lần cho phép!').div('main', $form);
require_once("../inc/duoi.php");
exit;
}

if($nick != $u['nick']){
$num = $_COOKIE['log']+1;
setcookie("log", $num, time()+900);
div('loi', '<img src="../img/loi.png"> Bạn đã nhập sai '.$num.'/3 lần cho phép!').div('main', $form);
require_once("../inc/duoi.php");
exit;
}

$_SESSION['uid'] = $u['id'];
$ses = substr(md5(md5(rand(1000,99999))),0,10);
$_SESSION['ses'] = $ses;
mysql_query("UPDATE `admin` SET `ses`= '$ses' WHERE `id`='".$u['id']."'");
b_go('../admin');
}

if(!$admin){
div('main', 'Để vào trang quản lý vui lòng bạn đăng nhập!<br>'.$form);
require_once("../inc/duoi.php");
exit;
}

?>
