<?php

define('_IN_JOHNCMS', 1);

$textl = 'Mua item áo choàng';

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

    echo display_error ('<br/>Bạn không được phép để thực hiện các hoạt động, bạn phải<br/><b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/>');

    require_once ('../incfiles/end.php');

    exit;

}

echo '<div class="menu">Shop Thời Trang |  <a href="../shop/pet.php?act=pet">Thú cưng</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/choangnam.php?act=choang">Quần Nam</a> | <a href="../shop/choangnu.php?act=choang">Quần Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a>   |<a href="../shop/xe.php?">  Xe </a>   |<a href="../shop/card.php">Thẻ VIP™  | <a href="../shop/vukhi.php?act=vukhi">Vũ Khí™</a>  | <a href="../shop/phukien.php?act=phukien">Phụ kiện™ </a> | <a href="../shop/icon.php?act=icon">Icons™</a> | <a href="../shop/kiemnam.php?act=kiem">Kiếm Nam™</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ™</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ™</a> | <a href="../shop/canhnam.php?act=canh">Cánh Nam™</a></div>';

echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';

if (!empty($user['vgold']))

    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Mua item áo choàng giá 50.000 VND!</div>';

////////////////////////////

switch($act){

case 'choang' :

if($user['balans']>=0){

echo '<div> <form action="choangnam.php?act=choangbuy" name="choang" method="post">

<input type="radio" name="choang" value="1"/> <img src="../item/choang/boy/item/1.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="2"/> <img src="../item/choang/boy/item/2.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="3"/> <img src="../item/choang/boy/item/3.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="4"/> <img src="../item/choang/boy/item/4.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="5"/> <img src="../item/choang/boy/item/5.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="6"/> <img src="../item/choang/boy/item/6.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="7"/> <img src="../item/choang/boy/item/7.png" align="middle"/>&nbsp;<br/>

<input type="radio" name="choang" value="8"/> <img src="../item/choang/boy/item/8.png" align="middle"/>&nbsp;<br/>

<input type="submit" name="submit" value="Mua"/> </form> </div> '; 

}else{

echo '<div class="menu">Bạn không được mua đồ khác giới tính!</div>';

}

break;

case 'choangbuy' :

if($user['balans']>=50000 && $user['sex']==m){

$choang = ($_POST['choang']); 

mysql_query("UPDATE `users` SET `choang` = '$choang' ,`balans`=`balans`-50000  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item , hãy kiểm tra tủ đồ!</div>';

echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';





header('Location:../shop/choangnam.php?act=choangbuyo');

exit();



}else{

echo '<div class="menu"><b><font color=red>Lỗi: </font></b>Bạn gặp phải một trong các lỗi sau:</div><br>';
echo '<div class="menu">-Bạn không đủ Điểm kinh nghiệm.<br>-Bạn không được mua đồ khác giới tính chứ<br>-Bạn không đủ số VGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'choangbuyo' :

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item , hãy kiểm tra tủ đồ!</div>';

echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';

break;

default :









}

echo '<b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Nhân vật của  ' . $user['name'] . ' </a></b>';

echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';

require_once ("../incfiles/end.php");
?>