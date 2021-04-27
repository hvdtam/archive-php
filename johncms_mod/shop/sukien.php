<?php
define('_IN_JOHNCMS', 1);
$textl = 'Thẻ Nhân đôi điểm kinh nghiệm';
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
    display_error('Chỉ cho người dùng đăng ký');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu">Shop | <a href="../shop/card.php">Thẻ</a> | <a href="../shop/icon.php?act=icon">Icon</a> | <a href="../shop/pet.php?act=pet">Thú nuôi</a> | <a href="../shop/tamtrang.php?act=tamtrang">Tâm trạng</a></div>';echo '<div class="menu"><a href="../shop/vip.php?act=vip">VIP</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ</a> |<a href="../shop/kiemnam.php?act=kiem">Kiếm Nam</a> | <a href="../shop/quannu.php?act=quan">Quần Nữ</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a> |<a href="../shop/phukien.php?act=phukien">Phụ Kiện</a> | <a href="../shop/vukhi.php?act=vukhi">Vũ khí</a> | <a href="../shop/sukien.php">Sự kiện</a></div>';echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';
if (!empty($user['vecw']))
    echo '<li><span class="gray">VVND: </span>' . $user['vecw'] . '</li>';
if (!empty($user['balans']))
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<li><span class="gray"><b><color=#ff00ff>Sự kiện</color></b></li>';
echo '<li><span class="gray"><b><color=#ff4500>Bản cập nhật 1.2 sẽ ra mất trong thời gian tới</color></b></li>';
echo '<li><span class="gray">Hàng trăm item mới cực kool!</li>';
echo '<li><span class="gray">Náo nhiệt cùng thẻ x2 EXP & VND -VGold</li>';
echo '<li><span class="gray">Thú cưng không còn làm cảnh</li>';
echo '<li><span class="gray">Vip Icon và Xcon mới</li>';
echo '<li><span class="gray">Quần áo mới cực hot</li>';
echo '<li><span class="gray">Vũ khí cực vip để chiến đấu vái vật</li>';
echo '<li><span class="gray">Còn nhiều tiện ích khác nữa</li>';
echo '<div class="menu"><a href="../shop/index.php">Shop item</a></div>';
require_once ("../incfiles/end.php");
?>