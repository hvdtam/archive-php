<?php

/**
 * @package     TrinhHuyenTrang
 * @link        http://trinhhuyentrang.org
 * @copyright   Copyright (C) 2008-2011 Huyen Trang
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      Tong Hoai
 */


define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
    $textl = '' .$lng['quatang0']. '';
    require('../incfiles/head.php');
echo '<div class="mainblok"><div class="phdr"><b>' .$lng['quatang0']. '</b></div>';
switch ($act){
case 'url':
if(isset($_POST['submit'])){
	$baihat=$_POST['baihat'];
        $nhan=$_POST['nhan'];
        $msg=$_POST['msg'];
        $url=$_POST['url'];
$error = array();
	if(empty($baihat)){
		echo '' .$lng['quatang7']. '<br/><a href="chuki.php?">' .$lng['quatang10']. '</a>';
        }
	if(empty($url)){
		echo '' .$lng['quatang9']. '<br/><a href="chuki.php?">' .$lng['quatang17']. '</a>';
        }
	if(empty($nhan)){
		echo '' .$lng['quatang8']. '<br/><a href="chuki.php?">' .$lng['quatang10']. '</a>';
	}
	if(empty($msg)){
		echo '' .$lng['quatang9']. '<br/><a href="chuki.php?">' .$lng['quatang10']. '</a>';
} else {
if ($datauser['balans'] >= 100)
{
mysql_query("UPDATE `users` SET `balans`=`balans` - 100 WHERE `id`='".$user_id."'");
mysql_query("UPDATE `quatang` SET `baihat`='".$baihat."', `user_id_gui`='".$user_id."', `user_id_nhan`='".$nhan."', `text`='".$msg."', `url`='".$url."' WHERE `id`='0'");
mysql_query("insert into `privat` values(0,'" . $nhan . "','Bạn vừa nhận được 1 bài hát từ một người bạn của bạn với nội dung: " . $msg . ".','" . time() . "','Admin','in','no','Quà tặng âm nhạc','0','','','','" . mysql_real_escape_string($fname) . "');");

echo '<div class="menu">' .$lng['quatang11']. '</div>';
} else {
echo '<div class="menu">' .$lng['quatang16']. '</div>';
}
}
}else{
echo '' .
'<div class="gmenu">+ ' .$lng['quatang19']. '<a href="index.php"> Click</a><br/>+ ' .$lng['quatang12']. ' 100 $<br/><form method="post">' .
'' .$lng['quatang13']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="baihat"></textarea>' .
'' .$lng['quatang18']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="url"></textarea>' .
'' .$lng['quatang14']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="nhan"></textarea>' .
'' .$lng['quatang15']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="msg"></textarea>' .
'<input type="submit" value="OK" name="submit" /><br />' .
'</form></div>' .
'';
}
   break;
   default:
if(isset($_POST['submit'])){
	$baihat=$_POST['baihat'];
        $nhan=$_POST['nhan'];
        $msg=$_POST['msg'];
$error = array();
	if(empty($baihat)){
		echo '' .$lng['quatang7']. '<br/><a href="chuki.php?">' .$lng['quatang10']. '</a>';
}
	if(empty($nhan)){
		echo '' .$lng['quatang8']. '<br/><a href="chuki.php?">' .$lng['quatang10']. '</a>';
	}
	if(empty($msg)){
		echo '' .$lng['quatang9']. '<br/><a href="chuki.php?">' .$lng['quatang10']. '</a>';
} else {
if ($datauser['balans'] >= 100)
{
mysql_query("UPDATE `users` SET `balans`=`balans` - 100 WHERE `id`='".$user_id."'");
mysql_query("UPDATE `quatang` SET `baihat`='".$baihat."', `user_id_gui`='".$user_id."', `user_id_nhan`='".$nhan."', `text`='".$msg."', `url`='empty' WHERE `id`='0'");
mysql_query("insert into `privat` values(0,'" . $nhan . "','Bạn vừa nhận được 1 bài hát từ một người bạn của bạn với nội dung: " . $msg . ".','" . time() . "','Admin','in','no','Quà tặng âm nhạc','0','','','','" . mysql_real_escape_string($fname) . "');");

echo '<div class="menu">' .$lng['quatang11']. '</div>';
} else {
echo '<div class="menu">' .$lng['quatang16']. '</div>';
}
}
}else{
echo '' .
'<div class="gmenu">+ ' .$lng['quatang19']. '<a href="index.php?act=url"> Click</a><br/>+ ' .$lng['quatang12']. ' 100 $<br/><form method="post">' .
'' .$lng['quatang13']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="baihat"></textarea>' .
'' .$lng['quatang14']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="nhan"></textarea>' .
'' .$lng['quatang15']. '<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="msg"></textarea>' .
'<br/>' .
'<input type="submit" value="OK" name="submit" /><br />' .
'</form></div>' .
'';
}
}
echo '<div class="phdr"><a href="index.php">' . $lng['back'] . '</a></div></div>';
require_once('../incfiles/end.php');
?>