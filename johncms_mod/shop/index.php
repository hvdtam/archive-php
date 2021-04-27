<?
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
require_once ('../incfiles/head.php');


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


echo '<div class="menu">Shop | <a href="../shop/card.php">Thẻ</a> | <a href="../shop/icon.php?act=icon">Icon</a> | <a href="../shop/pet.php?act=pet">Thú nuôi</a> | <a href="../shop/tamtrang.php?act=tamtrang">Tâm trạng</a></div>';echo '<div class="menu"><a href="../shop/vip.php?act=vip">VIP</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ</a> |<a href="../shop/kiemnam.php?act=kiem">Kiếm Nam</a> | <a href="../shop/quannu.php?act=quan">Quần Nữ</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a> |<a href="../shop/phukien.php?act=phukien">Phụ Kiện</a> | <a href="../shop/vukhi.php?act=vukhi">Vũ khí</a> | <a href="../shop/sukien.php">Sự kiện</a></div>';echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';


if (!empty($user['vgold']))


echo '<li><span class="gray" style="color:violet">VGold: </span>' . $user['vgold'] . '</li>';


if (!empty($user['balans']))


echo '<li><span class="gray" style="color:violet">VND: </span>' . $user['balans'] . '</li>';


echo '<div class="menu" align="center" style="color:MediumSpringGreen"><p><b>Shop Thời Trang TaMk.tK</b> ';

echo '<div class="menu" align="center"><a href="../shop/bank.php">Ngân Hàng</a></div> ';

echo '<div class="menu" align="center" style="color:red"><p><b>Bản cập nhật mới nhất</b> ';


echo '<li><span class="gray">Quần áo mới cực kool!</li>';
echo '<li><span class="gray">Mua Cánh và kiếm thể hiện đẳng cấp!<font color = "red"> (update)</font></li>';
echo '<li><span class="gray">Quần áo mới cực kool!</li>';
echo '<li><span class="gray">Nuôi thú cưng!</li>';
echo '<li><span class="gray">Trang bị vũ khí!</li>';
echo '<li><span class="gray">Style phong phú</li>';
echo '<li><span class="gray">Icon thẻ vip và nhiều....</li>';





echo '<li><span class="gray">Cập nhật liên tục!</li>';


echo '<b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Tủ đồ của  ' . $user['name'] . ' </a></b>';





require_once ("../incfiles/end.php");


?>
