<?php

ob_start();
echo '<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><title>Install Code - Code By MrTâm</title><body>';

if(isset($_GET['res'])){
unset($_SESSION['t']);
}
if(!$_SESSION['t']){
if(isset($_GET['ok'])){
$db_name = trim($_POST['db_name']);
$db_user = trim($_POST['db_user']);
$db_pass = trim($_POST['db_pass']);
$db_host = trim($_POST['db_host']);
if(!mysql_connect($db_host, $db_user, $db_pass)){
echo 'Sai thông tin kết nối!<br><form action="?ok" method="post">Tên Database:<br>
<input type="text" name="db_name" value="'.(isset($db_name) ? $db_name:'MrTam_db').'"><br/>
User MySQL:<br>
<input type="text" name="db_user" value="'.(isset($db_user) ? $db_user:'root').'"><br>
Password MySQL:<br>
<input type="password" name="db_pass" value="'.(isset($db_pass) ? $db_pass:'').'"><br/>
Host MySQL:<br>
<input type="text" name="db_host" value="'.(isset($db_host) ? $db_host:'localhost').'"><br>
<input type="submit" value="Bắt Đầu"></form>';
}elseif(!mysql_select_db($db_name)){
echo 'Sai database!<br><form action="?ok" method="post">Tên Database:<br>
<input type="text" name="db_name" value="'.(isset($db_name) ? $db_name:'MrTam_db').'"><br/>
User MySQL:<br>
<input type="text" name="db_user" value="'.(isset($db_user) ? $db_user:'root').'"><br>
Password MySQL:<br>
<input type="password" name="db_pass" value="'.(isset($db_pass) ? $db_pass:'').'"><br/>
Host MySQL:<br>
<input type="text" name="db_host" value="'.(isset($db_host) ? $db_host:'localhost').'"><br>
<input type="submit" value="Bắt Đầu"></form>';
}else{
$str = "<?php\r\n" .
"define('db_host', '" . $db_host . "');\r\n" .
"define('db_name', '" . $db_name . "');\r\n" .
"define('db_user', '" . $db_user . "');\r\n" .
"define('db_pass', '" . $db_pass . "');\r\n" .
"?>";
if(!file_put_contents('inc/db.php', $str)){
echo 'Không tạo được db.php!<br><form action="?ok" method="post">Tên Database:<br>
<input type="text" name="db_name" value="'.(isset($db_name) ? $db_name:'MrTam_db').'"><br/>
User MySQL:<br>
<input type="text" name="db_user" value="'.(isset($db_user) ? $db_user:'root').'"><br>
Password MySQL:<br>
<input type="password" name="db_pass" value="'.(isset($db_pass) ? $db_pass:'').'"><br/>
Host MySQL:<br>
<input type="text" name="db_host" value="'.(isset($db_host) ? $db_host:'localhost').'"><br>
<input type="submit" value="Bắt Đầu"></form>';
}else{
include 'inc/db.php';
include 'inc/fun.php';
mysql_query("DROP TABLE IF EXISTS `setting`");
mysql_query("CREATE TABLE `setting` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`name` text NOT NULL,
`value` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
mysql_query("DROP TABLE IF EXISTS `theloai`;");
mysql_query("CREATE TABLE `theloai` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`tenmuc` varchar(500) NOT NULL,
`url` varchar(500) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
mysql_query("DROP TABLE IF EXISTS `truyen`;");
mysql_query("CREATE TABLE `truyen` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`xem` int(250) NOT NULL DEFAULT '0',
`idm` text NOT NULL,
`url` text NOT NULL,
`noidung` text NOT NULL,
`thich` int(250) NOT NULL DEFAULT '0',
`time` int(250) NOT NULL,
`thoigian` varchar(250) NOT NULL,
`name` text NOT NULL,
`key` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
mysql_query("DROP TABLE IF EXISTS `comment`;");
mysql_query("CREATE TABLE `comment` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`time` varchar(50) NOT NULL,
`name` varchar(15) NOT NULL,`comment` varchar(300) NOT NULL,`idt` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");mysql_query("DROP TABLE IF EXISTS `vote`;");
mysql_query("CREATE TABLE `vote` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`ip` varchar(50) NOT NULL,
`idt` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");mysql_query("DROP TABLE IF EXISTS `admin`;");
mysql_query("CREATE TABLE `admin` (
`id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
`nick` varchar(20) NOT NULL,
`pass` varchar(300) NOT NULL,
`ses` varchar(50) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");$url = 'http://'.$_SERVER['SERVER_NAME'].str_replace('/install.php', '', $_SERVER['PHP_SELF']);
mysql_query("INSERT INTO `setting` (`id`, `name`, `value`) VALUES (1, 'home', '$url'),
(2, 'title', 'BenTreWap'),
(3, 'mindex', 'on'),
(4, 'bindex', 'on'),
(5, 'key', 'code By MrTam'),
(6, 'copy', 'MrTam'),
(7, 'show', '1000')");
$_SESSION['t'] = 'ok';
echo '<form action="?ok" method="post">Tên đăng nhập:<br>
<input type="text" name="nick" value=""><br>
Mật khẩu:<br>
<input type="password" name="pass" value=""><br/>
Nhập Lại:<br/><input type="password" name="passb" value=""><br>
<input type="submit" value="Tiếp Tục">   <a href="?res">Làm lại</a></form></body></html>';
exit; } } }else{
chmod('inc', 0777);
echo '<form action="?ok" method="post">Tên Database:<br>
<input type="text" name="db_name" value="'.(isset($db_name) ? $db_name:'MrTam_db').'"><br/>
User MySQL:<br>
<input type="text" name="db_user" value="'.(isset($db_user) ? $db_user:'root').'"><br>
Password MySQL:<br>
<input type="password" name="db_pass" value="'.(isset($db_pass) ? $db_pass:'').'"><br/>
Host MySQL:<br>
<input type="text" name="db_host" value="'.(isset($db_host) ? $db_host:'localhost').'"><br>
<input type="submit" value="Bắt Đầu"></form>'; } }

if($_SESSION['t']){
if(isset($_GET['ok'])){
$nick= trim($_POST['nick']);
$pass= trim($_POST['pass']);
$passb= trim($_POST['passb']);
if($pass!= $passb){
echo '2 Mật khẩu khác nhau!<br><form action="?ok" method="post">Tên đăng nhập:<br>
<input type="text" name="nick" value="'.(isset($nick) ? $nick:'admin').'"><br>
Mật khẩu:<br>
<input type="password" name="pass" value=""><br/>
Nhập Lại:<br/><input type="password" name="passb" value=""><br>
<input type="submit" value="Tiếp Tục"></form>   <a href="?res">Làm lại</a>';
}elseif(!$pass && !$passb){
echo 'Vui lòng nhập mậ t khẩu!<br><form action="?ok" method="post">Tên đăng nhập:<br>
<input type="text" name="nick" value="'.(isset($nick) ? $nick:'admin').'"><br>
Mật khẩu:<br>
<input type="password" name="pass" value=""><br/>
Nhập Lại:<br/><input type="password" name="passb" value=""><br>
<input type="submit" value="Tiếp Tục"></form>   <a href="?res">Làm lại</a>';
}elseif(!$nick){
echo 'Vui lòng nhập tên đăng nhập!<br><form action="?ok" method="post">Tên đăng nhập:<br>
<input type="text" name="nick" value="'.(isset($nick) ? $nick:'admin').'"><br>
Mật khẩu:<br>
<input type="password" name="pass" value=""><br/>
Nhập Lại:<br/><input type="password" name="passb" value=""><br>
<input type="submit" value="Tiếp Tục"></form>   <a href="?res">Làm lại</a>';
}else{
include 'inc/db.php';
include 'inc/fun.php';
mysql_query("INSERT INTO `admin` SET `nick` = '$nick', `pass` = '".md5(md5($pass))."'");
echo 'Install Thành Công!<br>&raquo; <a href="admin">Tiếp tục</a>';
chmod('inc', 0755);
unset($_SESSION['t']);
} }else{
echo '<form action="?ok" method="post">Tên đăng nhập:<br>
<input type="text" name="nick" value=""><br>
Mật khẩu:<br><input type="password" name="pass" value=""><br/>
Nhập Lại:<br/><input type="password" name="passb" value=""><br>
<input type="submit" value="Tiếp Tục">   <a href="?res">Làm lại</a></form>';
} }
echo '</body></html>';
?>
