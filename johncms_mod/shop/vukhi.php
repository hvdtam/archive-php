<?php
define('_IN_JOHNCMS', 1);
$textl = 'Mua Vũ khí';
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
echo '<div class="gray">Mua vũ khí - 70.000 VND!</div>';
////////////////////////////
switch($act){
case 'vukhi' :
if($user['balans']>=0){
echo '<div> <form action="vukhi.php?act=vukhibuy" name="vukhi" method="post">
<input type="radio" name="vukhi" value="1"/> <img src="../images/vukhi/1.jpg" width="50" height="50" align="middle"/>&nbsp; FN M249 MINIMI<br/>
<input type="radio" name="vukhi" value="2"/> <img src="../images/vukhi/2.jpg" width="50" height="50" align="middle"/>&nbsp; DE - Crystal<br/>
<input type="radio" name="vukhi" value="3"/> <img src="../images/vukhi/3.jpg" width="50" height="50" align="middle"/>&nbsp; RPK-Gold<br/>
<input type="radio" name="vukhi" value="4"/> <img src="../images/vukhi/4.jpg" width="50" height="50" align="middle"/>&nbsp; Micro Galil-Scope<br/>
<input type="radio" name="vukhi" value="5"/> <img src="../images/vukhi/5.jpg" width="50" height="50" align="middle"/>&nbsp; AK-47 Silver<br/>
<input type="radio" name="vukhi" value="6"/> <img src="../images/vukhi/6.jpg" width="50" height="50" align="middle"/>&nbsp; Dual Colt IGold<br/>
<input type="radio" name="vukhi" value="7"/> <img src="../images/vukhi/7.jpg" width="50" height="50" align="middle"/>&nbsp; Dual Uzi<br/>
<input type="radio" name="vukhi" value="8"/> <img src="../images/vukhi/8.jpg" width="50" height="50" align="middle"/>&nbsp; Lựu đạn bí ngô<br/>
<input type="radio" name="vukhi" value="9"/> <img src="../images/vukhi/9.jpg" width="50" height="50" align="middle"/>&nbsp; DRAGUNOV<br/>
<input type="radio" name="vukhi" value="10"/> <img src="../images/vukhi/10.jpg" width="50" height="50" align="middle"/>&nbsp; AWM-CAMO<br/>
<input type="radio" name="vukhi" value="11"/> <img src="../images/vukhi/11.jpg" width="50" height="50" align="middle"/>&nbsp; Micro-GALIL<br/>
<input type="radio" name="vukhi" value="12"/> <img src="../images/vukhi/12.jpg" width="50" height="50" align="middle"/>&nbsp; SCAR-Heavy<br/>
<input type="radio" name="vukhi" value="13"/> <img src="../images/vukhi/13.jpg" width="50" height="50" align="middle"/>&nbsp; Grenade<br/>
<input type="radio" name="vukhi" value="14"/> <img src="../images/vukhi/14.jpg" width="50" height="50" align="middle"/>&nbsp; FLASHBANG<br/>
<input type="radio" name="vukhi" value="15"/> <img src="../images/vukhi/15.jpg" width="50" height="50" align="middle"/>&nbsp; Xẻng quân dụng<br/>
<input type="radio" name="vukhi" value="16"/> <img src="../images/vukhi/16.jpg" width="50" height="50" align="middle"/>&nbsp; B.C-Axe<br/>
<input type="radio" name="vukhi" value="17"/> <img src="../images/vukhi/17.jpg" width="50" height="50" align="middle"/>&nbsp; COLT-1911<br/>
<input type="radio" name="vukhi" value="18"/> <img src="../images/vukhi/18.jpg" width="50" height="50" align="middle"/>&nbsp; Beretta-M9<br/>
<input type="radio" name="vukhi" value="19"/> <img src="../images/vukhi/19.jpg" width="50" height="50" align="middle"/>&nbsp; ANACONDA<br/>
<input type="radio" name="vukhi" value="20"/> <img src="../images/vukhi/20.png" width="50" height="50" align="middle"/>&nbsp; XM1014<br/>
<input type="radio" name="vukhi" value="21"/> <img src="../images/vukhi/21.jpg" width="50" height="50" align="middle"/>&nbsp; SG522<br/>
<input type="radio" name="vukhi" value="22"/> <img src="../images/vukhi/22.jpg" width="50" height="50" align="middle"/>&nbsp; SCAR-Light<br/>
<input type="radio" name="vukhi" value="23"/> <img src="../images/vukhi/23.jpg" width="50" height="50" align="middle"/>&nbsp; RPK-Camo<br/>
<input type="radio" name="vukhi" value="24"/> <img src="../images/vukhi/24.jpg" width="50" height="50" align="middle"/>&nbsp; RPK<br/>
<input type="radio" name="vukhi" value="25"/> <img src="../images/vukhi/25.jpg" width="50" height="50" align="middle"/>&nbsp; MP5<br/>
<input type="radio" name="vukhi" value="26"/> <img src="../images/vukhi/26.jpg" width="50" height="50" align="middle"/>&nbsp; Mini Uzi<br/>
<input type="radio" name="vukhi" value="27"/> <img src="../images/vukhi/27.jpg" width="50" height="50" align="middle"/>&nbsp; M60<br/>
<input type="radio" name="vukhi" value="28"/> <img src="../images/vukhi/28.jpg" width="50" height="50" align="middle"/>&nbsp; M700<br/>
<input type="submit" name="submit" value="Mua"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ số VVND hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'vukhibuy' :
if($user['balans']>=70000){
$vukhi = ($_POST['vukhi']); 
mysql_query("UPDATE `users` SET `vukhi` = '$vukhi' ,`balans`=`balans`-70000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được thú nuôi, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';


header('Location:../shop/vukhi.php?act=vukhibuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ số VVND hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'vukhibuyo' :
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được thú nuôi, hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';
break;
default :
echo '<div class="bmenu">Đẳng cấp thú nuôi!</div>';
echo '<div class="menu">Thay đổi: <li><a href="pet.php?act=color">Thú nuôi</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nick.php?act=color">Màu nick thường</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nickvip.php?act=color">Màu nick VIP</a></li>';
echo '<li><span class="gray"><a href="/shop/napvg.php"><b>Nạp VVND ngay!!</b></a></li>';


}
echo '<div class="menu"><a href="../shop/index.php">Shop item</a></div>';
require_once ("../incfiles/end.php");