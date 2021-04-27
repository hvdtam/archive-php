<?php
define('_IN_JOHNCMS', 1);
$textl = 'Thẻ gia nhập FAM';
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
if (!empty($user['balans']))
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';
if (!empty($user['balans']))
    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

echo '<div class="gray">Thẻ gia nhập FAM - level búa gỗ đôi - 100000VND!</div>';
switch($act){
case 'mua' :
if($user['balans']>=100000)
if($user['postforum']>=50){
echo '<div> <form action="vaofam.php?act=muabuy" name="mua" method="post">
<input type="text" name="mua" value="Nhập tên Fam"/><br/>
<input type="submit" name="submit" value="Vào Fam"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ cấp độ!</div>';
}
break;
case 'muabuy' :
if($user['balans']>=100000)
if($user['postforum']>=50){
$mua = ($_POST['mua']); 
mysql_query("UPDATE `users` SET `fam` = '$mua' , `balans`=`balans`-100000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Gia nhập Fam  ' .$user['fam']. '  thành công!!</div>';
echo '<div class="menu"><a href="../users/profile.php?user=' . $user_id . '">Thông tin cá nhân</a></div>';


header('Location:../shop/vaofam.php?act=muabuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'muabuyo' :
echo '<div class="menu">Gia nhập Fam  '.$user['fam'].'  thành công!</div>';
echo '<div class="menu"><a href="../users/profile.php?user=' . $user_id . '">Thông tin cá nhân</a></div>';
break;
default :
echo '<div class="menu">Bạn muốn vào ư. điều đó thật đơn giản bạn chỉ cần vào trực tiếp hồ sơ cá nhân của người đã tạo fam bạn ấn vào chử "Vào fam"</div>';
echo '<div class="menu">Lưu ý: điều kiện vào fam cấp bậc phải từ búa gỗ trỡ lên và phải có đủ tiền để vào fam</div>';
}
echo '<div class="menu"><a href="../shop/index.php">Shop item</a></div>';
require_once ("../incfiles/end.php");
?>