<?php
define('_IN_JOHNCMS', 1);
$textl = 'Mua giầy';
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
echo '<div class="gray">Mua giầy - 20.000 VND!</div>';
////////////////////////////
switch($act){
case 'giay' :
if($user['balans']>=0){
echo '<div> <form action="giay.php?act=giaybuy" name="giay" method="post">
<input type="radio" name="giay" value="1"/> <img src="../images/item/giay/1.gif" width="50" height="50" align="middle"/>&nbsp;Giầy hồng nữ<br/>
<input type="radio" name="giay" value="2"/> <img src="../images/item/giay/2.gif" width="50" height="50" align="middle"/>&nbsp;Giầy trắng nam<br/>
<input type="radio" name="giay" value="3"/> <img src="../images/item/giay/3.gif" width="50" height="50" align="middle"/>&nbsp;Giầy cao gót nữ<br/>
<input type="radio" name="giay" value="4"/> <img src="../images/item/giay/4.gif" width="50" height="50" align="middle"/>&nbsp;Guốc nữ vàng<br/>
<input type="radio" name="giay" value="5"/> <img src="../images/item/giay/5.gif" width="50" height="50" align="middle"/>&nbsp;Giày xiteen nam<br/>
<input type="radio" name="giay" value="6"/> <img src="../images/item/giay/6.gif" width="50" height="50" align="middle"/>&nbsp;Giày đen nam<br/>
<input type="radio" name="giay" value="7"/> <img src="../images/item/giay/7.gif" width="50" height="50" align="middle"/>&nbsp;Guốc đỏ nữ<br/>
<input type="radio" name="giay" value="8"/> <img src="../images/item/giay/8.gif" width="50" height="50" align="middle"/>&nbsp;Dép tông sọc trắng<br/>
<input type="radio" name="giay" value="9"/> <img src="../images/item/giay/9.gif" width="50" height="50" align="middle"/>&nbsp;Dép tông nữ<br/>
<input type="radio" name="giay" value="10"/> <img src="../images/item/giay/10.gif" width="50" height="50" align="middle"/>&nbsp;Dép tông đen<br/>
<input type="radio" name="giay" value="11"/> <img src="../images/item/giay/11.gif" width="50" height="50" align="middle"/>&nbsp;Dép tông xanh nữ<br/>
<input type="radio" name="giay" value="12"/> <img src="../images/item/giay/12.gif" width="50" height="50" align="middle"/>&nbsp;Dép tổ ong VIP<br/>
<input type="radio" name="giay" value="13"/> <img src="../images/item/giay/13.gif" width="50" height="50" align="middle"/>&nbsp;Giày trắng cao cổ nam<br/>
<input type="radio" name="giay" value="14"/> <img src="../images/item/giay/14.gif" width="50" height="50" align="middle"/>&nbsp;Guốc da đen nữ<br/>
<input type="submit" name="submit" value="Mua"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'giaybuy' :
if($user['balans']>=20000){
$giay = ($_POST['giay']); 
mysql_query("UPDATE `users` SET `giay` = '$giay' ,`balans`=`balans`-20000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được giầy, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';


header('Location:../shop/giay.php?act=giaybuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'giaybuyo' :
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được giầy, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../str/tudo.php">Tủ đồ</a></div>';
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