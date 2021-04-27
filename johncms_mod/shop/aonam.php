<?php
define('_IN_JOHNCMS', 1);
$textl = 'Mua item áo';
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
echo '<div class="gray">Mua item áo giá 50.000 VND!</div>';
////////////////////////////
switch($act){
case 'ao' :
if($user['balans']>=0){


echo '<div> <form action="aonam.php?act=aobuy" name="ao" method="post">
<input type="radio" name="ao" value="1"/> <img src="../item/ao/boy/item/1.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="2"/> <img src="../item/ao/boy/item/2.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="3"/> <img src="../item/ao/boy/item/3.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="4"/> <img src="../item/ao/boy/item/4.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="6"/> <img src="../item/ao/boy/item/6.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="7"/> <img src="../item/ao/boy/item/7.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="8"/> <img src="../item/ao/boy/item/8.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="9"/> <img src="../item/ao/boy/item/9.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="10"/> <img src="../item/ao/boy/item/10.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="11"/> <img src="../item/ao/boy/item/11.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="12"/> <img src="../item/ao/boy/item/12.png" align="middle"/>&nbsp;<br/>
<input type="radio" name="ao" value="13"/> <img src="../item/ao/boy/item/13.png" align="middle"/>&nbsp;<br/>

<input type="submit" name="submit" value="Mua"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn là nam hay nữ thế? Sao mua đồ khác giới tính hả!</div>';
}
break;
case 'aobuy' :
if($user['balans']>=40000 && $user['sex']==m){
$ao = ($_POST['ao']); 
mysql_query("UPDATE `users` SET `ao` = '$ao' ,`balans`=`balans`-50000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item , hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ của bạn!</a></div>';


header('Location:../shop/aonam.php?act=aobuyo');
exit();

}else{
echo '<div class="menu">Bạn không được mua đồ khác giới tính chứ, Bạn không đủ số VGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'aobuyo' :
echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item , hãy kiểm tra tủ đồ!</div>';
echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';
break;
default :







}
echo '<b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Nhân vật của  ' . $user['name'] . ' </a></b>';
echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';
require_once ("../incfiles/end.php");