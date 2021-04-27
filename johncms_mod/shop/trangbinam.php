<?php

define('_IN_JOHNCMS', 1);

$textl = 'Mua item kiếm';

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

echo '<div class="menu">Shop Thời Trang |  <a href="../shop/pet.php?act=pet">Thú cưng</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/aonu.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/quannu.php?act=quan">Quần Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giaynu.php?act=giay">Giầy Nữ</a>   |<a href="../shop/xe.php?">  Xe </a>   |<a href="../shop/card.php">Thẻ VIP™  | <a href="../shop/vukhi.php?act=vukhi">Vũ Khí™</a>  | <a href="../shop/phukien.php?act=phukien">Phụ kiện™ </a> | <a href="../shop/icon.php?act=icon">Icons™</a> | <a href="../shop/kiemnam.php?act=kiem">Kiếm Nam™</a> | <a href="../shop/kiemnu.php?act=kiem">Kiếm Nữ™</a> | <a href="../shop/canhnu.php?act=canh">Cánh Nữ™</a> | <a href="../shop/canhnam.php?act=canh">Cánh Nam™</a></div>';

echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';

if (!empty($user['vgold']))

    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Mua item áo giá 500.000 VND!</div>';
echo '<div class="gray"><b>Chú ý: Điểm kinh nghiệm tối thiểu <font color=red>77500 exp</font></b></div>';

////////////////////////////

switch($act){

case 'trangbi' :

if($user['balans']>=0){





echo '<div> <form action="kiemnam.php?act=kiembuy" name="kiem" method="post">

<input type="radio" name="kiem" value="1"/> <img src="../item/kiem/boy/item/1.png" align="middle"/>&nbsp;<br/>



<input type="submit" name="submit" value="Mua"/> </form> </div> '; 

}else{

echo '<div class="menu">Bạn là nam hay nữ thế? Định mua đồ khác giới tính hả!</div>';

}

break;

case 'kiembuy' :

if($user['balans']>=500000 &&  $exp <77500 && $user['sex']==m){

$kiem = ($_POST['kiem']); 

mysql_query("UPDATE `users` SET `kiem` = '$kiem' ,`balans`=`balans`-500000  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được item , hãy kiểm tra tủ đồ!</div>';

echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ của bạn!</a></div>';





header('Location:../shop/kiemnam.php?act=kiembuyo');

exit();



}else{
echo '<div class="menu">Bạn gặp phải một trong các lỗi sau:</div><br>';

echo '<div class="menu">-Bạn không đủ Điểm kinh nghiệm.<br>-Bạn không được mua đồ khác giới tính chứ<br>-Bạn không đủ số VGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'kiembuyo' :

echo '<div class="menu">Gikiem dịch thành công. Bạn đã nhận được item , hãy kiểm tra tủ đồ!</div>';

echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';

break;

default :















}

echo '<b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Nhân vật của  ' . $user['name'] . ' </a></b>';

echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';

require_once ("../incfiles/end.php");
?>