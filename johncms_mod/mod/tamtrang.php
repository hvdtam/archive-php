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
$textl = 'Thay đổi status';
require('../incfiles/head.php');
echo '<div class="phdr"><b>Tâm Trạng Ver 4.4</b></div>';
if(isset($_POST['submit'])){
$msg=$_POST['msg'];
if(empty($msg)){
echo 'Bạn chưa nhập status của bạn.<br/><a href="status.php">Làm lại</a>';
}elseif(strlen($msg) > 60){
echo 'Tâm trạng của bạn quá dài,nó không thể nhiều hơn 60 kí tự.<br/><a href="tamtrang.php">Làm lại</a>';
}else{
if ($datauser['balans'] >= 10000)
{
mysql_query("UPDATE `users` SET `status`='".$msg."',
`balans`=`balans` - 10000 WHERE `id`='".$user_id."'");
echo 'Tâm trạng của bạn đã lưu thành công.';
} else {
echo 'Bạn ko đủ tiền để cài đặt';
}
}
}else{
echo '' .
'<div class="gmenu">Giá: 10000 $ VND<br/><form method="post">' .
'Nội dung status:<br/><textarea cols="' . $set_user['field_w'] . '" rows="' . $set_user['field_h'] . '" name="msg"></textarea>' .
'<br/>' .
'<input type="submit" value="Lưu lại" name="submit" /><br />' .
'</form></div>' .
'';
}
echo '<div class="phdr"><a href="index.php">' . $lng['back'] . '</a></div>';
require_once('../incfiles/end.php');
?>
