<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Chữ kí diễn đàn';
require('../incfiles/head.php');
echo '<div class="phdr"><b>Chữ kí diễn đàn</b></div>';
if(isset($_POST['submit'])){
$msg=$_POST['msg'];
if(empty($msg)){
echo 'Bạn chưa nhập chữ kí của bạn.<br/><a href="chuki.php?">Làm lại</a>';
}elseif(strlen($msg) > 100){
echo 'Chữ kí của bạn quá dài,nó không thể nhiều hơn 100 kí tự.<br/><a href="chuki.php?">Làm lại</a>';
}else{
if ($datauser['balans'] >= 0)
{
mysql_query("UPDATE `users` SET `balans`='".$msg."',
`balans`=`balans` 0 WHERE `id`='".$user_id."'");
echo 'Chữ kí của bạn đã lưu thành công.';
} else {
echo 'Bạn ko đủ tiền để cài đặt';
}
}
}else{
echo '' .
'<div class="gmenu">Giá: 500 Vnd<br/><form method="post">' .
'Nội dung chữ kí:<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="msg"></textarea>' .
'<br/>' .
'<input type="submit" value="Lưu lại" name="submit" /><br />' .
'</form></div>' .
'';
}
echo '<div class="phdr"><a href="index.php">' . $lng['back'] . '</a></div>';
require_once('../incfiles/end.php');
?>
