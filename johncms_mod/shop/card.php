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
    display_error('Chỉ cho người dùng đăng ký');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu">Shop | <a href="../shop/card.php">Thẻ</a> | <a href="../shop/icon.php?act=icon">Icon</a> | <a href="../shop/pet.php?act=pet">Thú nuôi</a> | <a href="../shop/tamtrang.php?act=tamtrang">Tâm trạng</a></div>';echo '<div class="menu"><a href="../shop/vip.php?act=vip">VIP</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ</a> |<a href="../shop/kiemnam.php?act=kiem">Kiếm Nam</a> | <a href="../shop/quannu.php?act=quan">Quần Nữ</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a> |<a href="../shop/phukien.php?act=phukien">Phụ Kiện</a> | <a href="../shop/vukhi.php?act=vukhi">Vũ khí</a> | <a href="../shop/sukien.php">Sự kiện</a></div>';echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';
if (!empty($user['vecw']))
    echo '<li><span class="gray">VVND: </span>' . $user['vecw'] . '</li>';
if (!empty($user['balans']))
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';
echo '<div class="gray">Mua thẻ item!</div>';
////////////////////////////
echo '<div>Thẻ đổi màu nick - 20.000 VND</div>';
echo '<li><img src="../images/the/1.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/colornick.php?act=color"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////

////////////////////////////
echo '<div>Thẻ miễn dịch - 100.000.000 VND [HOT]</div>';
echo '<li><img src="../images/the/1.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/miendichnick.php"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////

////////////////////////////
echo '<div>Thẻ đổi màu nick vip - 50VGold</div>';
echo '<li><img src="../images/the/2.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/colornickvip.php?act=color"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ tạo phòng VIP - 300VGold</div>';
echo '<li><img src="../images/the/10.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/phongvip.php?act=mua"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ kết hôn 500.000 VND</div>';
echo '<li><img src="../images/the/4.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/dkkethon.php?act=mua"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Lọ thuốc đổi giới tính - 50.000 VND</div>';
echo '<li><img src="../images/the/5.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/doigioi.php?act=doigioi"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ ly hôn - 10.000 VND</div>';
echo '<li><img src="../images/the/8.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/lyhon.php?act=lyhon"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ đổi tên - 100VGold</div>';
echo '<li><img src="../images/the/1.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/doiten.php?act=name"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ reset cấp độ -  90.000 VND</div>';
echo '<li><img src="../images/the/10.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/resetcapdo.php?act=del"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ nhân đôi kinh nghiệm -  10.000VGold</div>';
echo '<li><img src="../images/the/9.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/x2exp.php?act=x2"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ Chuyển đổi VND</div>';
echo '<li><img src="../images/the/5.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/chuyenecw.php"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ lập fam -  1.000.000 VND</div>';
echo '<li><img src="../images/the/11.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/lapfam.php?act=fam"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ thay đổi cảm xúc -  2.000 VND</div>';
echo '<li><img src="../images/the/7.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/tamtrang.php?act=tamtrang"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ tổ chức kết hôn - 1.000.000 VND</div>';
echo '<li><img src="../images/the/4.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/kethon.php?act=mua"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div>Thẻ gia nhập fam - 100.000 VND</div>';
echo '<li><img src="../images/the/13.gif" width="50" height="50" align="middle"/>&nbsp;<a href="../shop/vaofam.php"><b>Mua</b></a></li>';
echo '<div>____________________</div>';
////////////////////////////
echo '<div class="menu"><a href="../shop/index.php">Shop item</a></div>';
require_once ("../incfiles/end.php");
?>