<?php
define('_IN_JOHNCMS', 1);
$textl = 'Mua vip';
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
echo '<div class="gray">Mua phụ kiện với giá 15.000 VND!</div>';
////////////////////////////
switch($act){
case 'phukien' :
if($user['balans']>=15000){
echo '<div> <form action="phukien.php?act=phukienbuy" name="phukien" method="post">
<input type="radio" name="phukien" value="1"/> <img src="../images/phukien/1.gif" width="50" height="50" align="middle"/>&nbsp;Hoa bó nhỏ<br/>
<input type="radio" name="phukien" value="2"/> <img src="../images/phukien/2.gif" width="50" height="50" align="middle"/>&nbsp;Hoa bó cao<br/>
<input type="radio" name="phukien" value="3"/> <img src="../images/phukien/3.gif" width="50" height="50" align="middle"/>&nbsp;Hoa hồng bó<br/>
<input type="radio" name="phukien" value="4"/> <img src="../images/phukien/4.gif" width="50" height="50" align="middle"/>&nbsp;Hoa bó tròn<br/>
<input type="radio" name="phukien" value="5"/> <img src="../images/phukien/5.gif" width="50" height="50" align="middle"/>&nbsp;Hoa bó kiểu<br/>
<input type="radio" name="phukien" value="6"/> <img src="../images/phukien/6.gif" width="50" height="50" align="middle"/>&nbsp;Hoa hồng nhật<br/>
<input type="radio" name="phukien" value="7"/> <img src="../images/phukien/7.gif" width="50" height="50" align="middle"/>&nbsp;Hoa hồng tím<br/>
<input type="radio" name="phukien" value="8"/> <img src="../images/phukien/8.gif" width="50" height="50" align="middle"/>&nbsp;Kem ốc quế<br/>
<input type="radio" name="phukien" value="9"/> <img src="../images/phukien/9.gif" width="50" height="50" align="middle"/>&nbsp;Kem ốc quế đôi<br/>
<input type="radio" name="phukien" value="10"/> <img src="../images/phukien/10.gif" width="50" height="50" align="middle"/>&nbsp;Kem đậu<br/>
<input type="radio" name="phukien" value="11"/> <img src="../images/phukien/11.gif" width="50" height="50" align="middle"/>&nbsp;Kem kiểu<br/>
<input type="radio" name="phukien" value="12"/> <img src="../images/phukien/12.gif" width="50" height="50" align="middle"/>&nbsp;Kem socola<br/>
<input type="radio" name="phukien" value="13"/> <img src="../images/phukien/13.gif" width="50" height="50" align="middle"/>&nbsp;Kem ly<br/>
<input type="radio" name="phukien" value="14"/> <img src="../images/phukien/14.gif" width="50" height="50" align="middle"/>&nbsp;Kem que socola<br/>
<input type="radio" name="phukien" value="15"/> <img src="../images/phukien/15.gif" width="50" height="50" align="middle"/>&nbsp;Mặt trời<br/>
<input type="radio" name="phukien" value="16"/> <img src="../images/phukien/16.gif" width="50" height="50" align="middle"/>&nbsp;Kính thời trang<br/>
<input type="submit" name="submit" value="Mua"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'phukienbuy' :
if($user['balans']>=15000){
$phukien = ($_POST['phukien']); 
mysql_query("UPDATE `users` SET `phukien` = '$phukien' ,`balans`=`balans`-15000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item mũ, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';


header('Location:../shop/phukien.php?act=phukienbuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ sốVGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'mubuyo' :
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item mũ, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';
break;
default :
echo '<div class="bmenu">Đẳng cấp vip!</div>';
echo '<div class="menu">Thay đổi:<li><a href="nick.php?act=color">Màu nick thường</a></li>';
echo '<li><a href="nickvip.php?act=color">Màu nick VIP</a></li>';
echo '<li><span class="gray"><a href="/shop/napvg.php"><b>NạpVGold ngay!!</b></a></li></div>';


}
echo '<div class="menu"><a href="../shop/index.php">Shop item</a></div>';
require_once ("../incfiles/end.php");