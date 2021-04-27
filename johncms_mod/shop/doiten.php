<?php
define('_IN_JOHNCMS', 1);
$textl = 'Thẻ đổi tên';
$headmod = 'nick';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if ($id && $id != $user_id) {
$req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
if (mysql_num_rows($req)) {
$user = mysql_fetch_assoc($req);
}
else {

}
}
else {
$id = false;
$user = $datauser;
}

if (!$user_id) {
require_once ('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require_once ('../incfiles/end.php');
exit;
}

echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';

if (!empty($user['balans']))
echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Thẻ đổi tên giá 10.000 VND!</div>';
switch($act){
case 'name' :
if($user['balans']>=10000){
echo '<div> <form action="doiten.php?act=namebuy" name="name" method="post">
<input type="text" name="name" value="Nhập tên cần đổi"/>
<input type="submit" name="submit" value="Đổi tên"/></form></div>';
}else{
echo '<div class="menu">Bạn không đủ số VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'namebuy' :
if($user['balans']>=10000){
$name = ($_POST['name']);
mysql_query("UPDATE `users` SET `name` = '$name' , `balans`=`balans`-10000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công, nickname đã đổi thành : '.$user['name'].' .Hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';


header('Location:../shop/doiten.php?act=namebuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ số VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'namebuyo' :
echo '<div class="menu">Giao dịch thành công, nickname đã đổi thành : '.$user['name'].' .Hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';
break;
default :



}
echo '<div class="menu"><a href="../shop/shop.php">Shop TaMk</a></div>';
require_once ("../incfiles/end.php");
?>
