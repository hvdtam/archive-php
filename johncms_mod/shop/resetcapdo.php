<?php
define('_IN_JOHNCMS', 1);
$textl = 'Thẻ Reset cấp độ';
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

echo '<div class="gray">Thẻ reset cấp độ - 90.000 VND!</div>';
switch($act){
case 'del' :
if($user['balans']>=90000){
echo '<div> <form action="resetcapdo.php?act=delbuy" name="del" method="post">
<input type="radio" name="del" value=""/>  Chấp nhận resset cấp độ trở về 0<br/>
<input type="submit" name="submit" value="Reset"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'delbuy' :
if($user['balans']>=90000){
$postforum = ($_POST['del']); 
mysql_query("UPDATE `users` SET `postforum` = '0' , `postguest` = '0' ,`balans`=`balans`-90000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công. Cấp độ của bạn đã trở về 0, hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php?user=' . $user_id . '">Thông tin cá nhân</a></div>';


header('Location:../shop/resetcapdo.php?act=delbuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'delbuyo' :
echo '<div class="menu">Giao dịch thành công. Cấp độ của bạn đã trở về 0, hãy kiểm tra thông tin cá nhân!</div>';
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