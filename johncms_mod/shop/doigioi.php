<?php

define('_IN_JOHNCMS', 1);

$textl = 'Thẻ thay đổi giới tính';

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

if (!empty($user['vgold']))

echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';



echo '<div class="gray">Thẻ xoá giới tính giá 20.000 VND!</div>';

switch($act){

case 'doigioi' :

if($user['balans']>=20000){

echo '<div> <form action="doigioi.php?act=doigioibuy" name="color" method="post">

<input type="radio" name="doigioi" value="dl"/>Bạn muốn giấu giới tính của bạn?<br/>

<input type="submit" name="submit" value="Đồng ý"/> </form> </div> ';

}else{

echo '<div class="menu">Bạn không đủ số VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'doigioibuy' :

if($user['balans']>=20000){

$pet = ($_POST['color']);

mysql_query("UPDATE `users` SET `sex` = '$sex' ,`balans`=`balans`-20000  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="menu">Giao dịch thành công. Giới tính của bạn đã được thay đổi, hãy kiểm tra thông tin cá nhân!</div>';

echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';





header('Location:../shop/doigioi.php?act=doigioibuyo');

exit();



}else{

echo '<div class="menu">Bạn không đủ số VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'doigioibuyo' :

echo '<div class="menu">Giao dịch thành công. Giới tính của bạn đã được thay đổi, hãy kiểm tra thông tin cá nhân!</div>';

echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';

break;

default :















}

echo '<div class="menu"><a href="../shop/shop.php">Shop TaMk</a></div>';

require_once ("../incfiles/end.php");

?>
