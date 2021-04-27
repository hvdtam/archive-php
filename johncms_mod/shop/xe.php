<?php

define('_IN_JOHNCMS', 1);

$textl = 'Shop Giao dịch ';

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

echo display_error ('<br/>Bạn không được phép để thực hiện các hoạt động, bạn phải<br/><b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/>');

require_once ('../incfiles/end.php');

exit;

}

echo '<div class="menu">Shop | <a href="../shop/card.php">Thế Giới Xe</a> </li>';



echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';

if (!empty($user['vgold']))

echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Mua XE</div>';


////////////////////////////

echo '<div><B>Mua Xe Máy giá <font color =red>200.000 VGold</font></b></div>';

echo '<li><img src="../xe/xe7.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/xemay.php?act=xemay""><b>Mua</b></a></li>';

echo '<div>____________________</div>';

////////////////////////////

////////////////////////////


echo '<div><b>Xe OTO giá <font color=red>1000.000 VGold</font></b></div>';

echo '<li><img src="../xe/xe42.gif" width="80" height="30" align="middle"/>&nbsp;<a href="../shop/xeoto.php?act=xeoto""><b>Mua</b></a></li>';

echo '<div>____________________</div>';

////////////////////////////

echo '<div class="menu"><a href="../shop/index.php">Shop TaMk</a></div>';

require_once ("../incfiles/end.php");

?>
