<?php
define('_IN_JOHNCMS', 1);
$textl = 'Mua thú nuôi';
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
echo '<div class="menu">Shop | <a href="../shop/card.php">Thẻ</a> | <a href="../shop/icon.php?act=icon">Icon</a> | <a href="../shop/pet.php?act=pet">Thú nuôi</a> | <a href="../shop/tamtrang.php?act=tamtrang">Tâm trạng</a></div>';echo '<div class="menu"><a href="../shop/vip.php?act=vip">VIP</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ</a> |<a href="../shop/kiemnam.php?act=kiem">Kiếm Nam</a> | <a href="../shop/quannu.php?act=quan">Quần Nữ</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a> |<a href="../shop/phukien.php?act=phukien">Phụ Kiện</a> | <a href="../shop/vukhi.php?act=vukhi">Vũ khí</a> | <a href="../shop/sukien.php">Sự kiện</a></div>';echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';
if (!empty($user['vgold']))
    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';
if (!empty($user['balans']))
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';
echo '<div class="gray">Mua thú nuôi giá 1.000 VGold!</div>';
////////////////////////////
switch($act){
case 'pet' :
if($user['vgold']>=0){
echo '<div> <form action="pet.php?act=petbuy" name="pet" method="post">
<input type="radio" name="pet" value="1"/> <img src="../pet/1.gif" width="50" height="50" align="middle"/>&nbsp;Bò sữa ú ù<br/>
<input type="radio" name="pet" value="2"/> <img src="../pet/2.gif" width="50" height="50" align="middle"/>&nbsp;Bướm xinh<br/>
<input type="radio" name="pet" value="3"/> <img src="../pet/3.gif" width="50" height="50" align="middle"/>&nbsp;Cá Denkô <br/>
<input type="radio" name="pet" value="4"/> <img src="../pet/4.gif" width="50" height="50" align="middle"/>&nbsp;Cua Baki<br/>
<input type="radio" name="pet" value="5"/> <img src="../pet/5.gif" width="50" height="50" align="middle"/>&nbsp;Chim cánh cụt<br/>
<input type="radio" name="pet" value="6"/> <img src="../pet/6.gif" width="50" height="50" align="middle"/>&nbsp;Chim Neomi<br/>
<input type="radio" name="pet" value="7"/> <img src="../pet/7.gif" width="50" height="50" align="middle"/>&nbsp;Chim Lenkô<br/>
<input type="radio" name="pet" value="8"/> <img src="../pet/8.gif" width="50" height="50" align="middle"/>&nbsp;Cún Nofi<br/>
<input type="radio" name="pet" value="9"/> <img src="../pet/9.gif" width="50" height="50" align="middle"/>&nbsp;Chó Lucky<br/>
<input type="radio" name="pet" value="10"/> <img src="../pet/10.gif" width="50" height="50" align="middle"/>&nbsp;Hươu sừng tấm<br/>
<input type="radio" name="pet" value="11"/> <img src="../pet/11.gif" width="50" height="50" align="middle"/>&nbsp;Heo boo mami<br/>
<input type="radio" name="pet" value="12"/> <img src="../pet/12.gif" width="50" height="50" align="middle"/>&nbsp;Ong vàng Hera<br/>
<input type="radio" name="pet" value="13"/> <img src="../pet/13.gif" width="50" height="50" align="middle"/>&nbsp;Thỏ xám kichu<br/>
<input type="radio" name="pet" value="14"/> <img src="../pet/14.gif" width="50" height="50" align="middle"/>&nbsp;Voi Nemo<br/>
<input type="submit" name="submit" value="Mua"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không có đủ VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'petbuy' :
if($user['vgold']>=1000){
$pet = ($_POST['pet']); 
mysql_query("UPDATE `users` SET `pet` = '$pet' ,`vgold`=`vgold`-1000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được thú nuôi, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';


header('Location:../shop/pet.php?act=petbuyo');
exit();

}else{
echo '<div class="menu">Bạn không có đủ VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'petbuyo' :
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được thú nuôi, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';
break;
default :
echo '<div class="bmenu">Đẳng cấp thú nuôi!</div>';
echo '<div class="menu">Thay đổi: <li><a href="pet.php?act=color">Thú nuôi</a></li>';





}
echo '<b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Nhân vật của  ' . $user['name'] . ' </a></b>';
echo '<div class="menu"><a href="../shop/index.php">Shop Thời Trang</a></div>';
require_once ("../incfiles/end.php");