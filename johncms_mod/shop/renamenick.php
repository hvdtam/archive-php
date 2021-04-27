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
    display_error('Chỉ cho người dùng đăng ký');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu">Shop | <a href="../shop/card.php">Thẻ</a> | <a href="../shop/icon.php?act=icon">Icon</a> | <a href="../shop/pet.php?act=pet">Thú nuôi</a> | <a href="../shop/tamtrang.php?act=tamtrang">Tâm trạng</a></div>';echo '<div class="menu"><a href="../shop/vip.php?act=vip">VIP</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ</a> |<a href="../shop/kiemnam.php?act=kiem">Kiếm Nam</a> | <a href="../shop/quannu.php?act=quan">Quần Nữ</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a> |<a href="../shop/phukien.php?act=phukien">Phụ Kiện</a> | <a href="../shop/vukhi.php?act=vukhi">Vũ khí</a> | <a href="../shop/sukien.php">Sự kiện</a></div>';echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';
if (!empty($user['vecw']))
    echo '<li><span class="gray">vVND: </span>' . $user['vecw'] . '</li>';
if (!empty($user['balans']))
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Thẻ đổi tên - 100VGold!</div>';
mysql_query("UPDATE `users` SET `name` = '" . $user['name'] . "' WHERE `id` = '" . $user['id'] . "'");
switch($act){
case 'name' :
if($user['vecw']>=100){
echo '<div><form action="doiten.php?act=namebuy" name="name" method="post">
<input type="text" value="' . $user['name'] . '" name="name" />
<input type="submit" name="submit" value="Đổi tên"/></form></div>';
}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'namebuy' :
if($user['vecw']>=100){
$name = isset($_POST['name']) ? functions::check(mb_substr($_POST['name'], 0, 100)) : $user['name'];
if(empty($name)){
		echo 'Bạn chưa nhập tên của bạn.<br/><a href="chuki.php?">Làm lại</a>';
	}elseif(strlen($name) < 2 || strlen($name) > 100){
		echo 'Tên của bạn ít nhất 2 kí tự, tối đa 100 kí tự.<br/><a href="chuki.php?">Làm lại</a>';
	}else{
mysql_query("UPDATE `users` SET `name` = '$name' , `vecw`=`vecw`-100  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công, nickname đã đổi thành : '.$user['name'].' .Hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php?user=' . $user_id . '">Thông tin cá nhân</a></div>';

header('Location:../shop/doiten.php?act=namebuyo');
exit();
}
}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'namebuyo' :
echo '<div class="menu">Giao dịch thành công, nickname đã đổi thành : '.$user['name'].' .Hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php?user=' . $user_id . '">Thông tin cá nhân</a></div>';
break;
default :
echo '<div class="bmenu">Đẳng cấp thú nuôi!</div>';
echo '<div class="menu">Thay đổi: <li><a href="pet.php?act=color">Thú nuôi</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nick.php?act=color">Màu nick thường</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nickvip.php?act=color">Màu nick VIP</a></li>';
echo '<li><span class="gray"><a href="/shop/napvg.php"><b>NạpVGold ngay!!</b></a></li>';


}
echo '<div class="menu"><a href="../shop/index.php">Shop item</a></div>';
require_once ("../incfiles/end.php");
?>