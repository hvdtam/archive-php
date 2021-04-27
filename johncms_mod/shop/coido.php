<?php

define('_IN_JOHNCMS', 1);

$textl = 'Mua item cánh';

$headmod = 'nick';

require_once ("../incfiles/core.php");

require_once ("../incfiles/head.php");

if ($id && $id != $user_id) {

    $req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");

    if (mysql_m_rows($req)) {

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

    echo '<br/>Bạn không được phép để thực hiện các hoạt động, bạn phải<br/><b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/>';

    require_once ('../incfiles/end.php');

    exit;

}

echo '<div class="me">Shop Thời Trang |  <a href="../shop/pet.php?act=pet">Thú cưng</a> | <a href="../shop/munam.php?act=mu">Mũ Nam</a> | <a href="../shop/munu.php?act=mu">Mũ Nữ</a> |<a href="../shop/aonam.php?act=ao">Áo Nam</a> | <a href="../shop/ao.php?act=ao">Áo Nữ</a> |<a href="../shop/quannam.php?act=quan">Quần Nam</a> | <a href="../shop/quan.php?act=quan">Quần Nữ</a> |<a href="../shop/giaynam.php?act=giay">Giầy Nam</a> | <a href="../shop/giay.php?act=giay">Giầy Nữ</a>   |<a href="../shop/xe.php?">  Xe </a>   |<a href="../shop/card.php">Thẻ VIP™  | <a href="../shop/vukhi.php?act=vukhi">Vũ Khí™</a>  | <a href="../shop/phukien.php?act=phukien">Phụ kiện™ </a> | <a href="../shop/icon.php?act=icon">Icons™</a> | <a href="../shop/coidonam.php?act=coido">Kiếm Nam™</a> | <a href="../shop/coido.php?act=coido">Kiếm Nữ™</a> | <a href="../shop/coido.php?act=coido">Cánh Nữ™</a> | <a href="../shop/coidonam.php?act=coido">Cánh Nam™</a></div>';

echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';

if (!empty($user['vgold']))

    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

////////////////////////////



switch($act){

case 'coido' :
if($user['balans']>=0){

echo '<div> <form action="coido.php?act=coidobuy" name="coido" method="post">

<b><font color = red>Chú ý: </font></b>Bạn có chắc muốn vứt hết đồ áo của mình không<br>



<input type="submit" name="submit" value="Đồng ý"/> </form> </div> '; 

}else{

echo display_error('Lỗi cho người dùng');

}

break;

case 'coidobuy' :

if($user['balans']>=0){

$coido = ($_POST['coido']); 

mysql_query("UPDATE `users` SET `ao` = 0 ,`quan` = 0, `choang` = 0,`kiem` = 0 ,`canh` = 0,`giay` = 0,`toc` = 0  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="me"><b>Bạn đã vứt hết đồ của mình!</b></div>';

echo '<div class="me"><a href="../users/tudo.php">Tủ đồ</a></div>';





header('Location:../shop/coido.php?act=coidobuyo');

exit();



}else{

echo '<div class="me"><b><font color=red>Lỗi: </font></b>Bạn gặp phải một trong các lỗi sau:</div><br>';echo '<div class="me">-Bạn không đủ Điểm kinh nghiệm.<br>-Bạn không được mua đồ khác giới tính chứ<br>-Bạn không đủ số VGold hoặc VND, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'coidobuyo' :

echo '<div class="gmenu">Bạn đã vứt hết đồ!</div>';

echo '<div class="me"><a href="../users/tudo.php">Tủ đồ</a></div>';

break;

default :

echo '<div class="bme">Đẳng cấp thú nuôi!</div>';

echo '<div class="me">Thay đổi: <li><a href="pet.php?act=color">Thú nuôi</a></li>';

echo '<div class="me">Thay đổi: <li><a href="nick.php?act=color">Màu nick thường</a></li>';

echo '<div class="me">Thay đổi: <li><a href="nickvip.php?act=color">Màu nick VIP</a></li>';







}

echo '<b><a href="../users/tudo.php?id=' .$user['id'] . '" style="color:lime">+Nhân vật của  ' . $user['name'] . ' </a></b>';

echo '<div class="me"><a href="../shop/shop.php">Shop</a></div>';

require_once ("../incfiles/end.php");

?>