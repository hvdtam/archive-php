<?php

define('_IN_JOHNCMS', 1);

$textl = 'Mua phụ kiện';

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





echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';

if (!empty($user['vgold']))

    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';

if (!empty($user['balans']))

    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Mua phụ kiện với giá 2.000 VGold!</div>';

////////////////////////////

switch($act){

case 'phukien' :

if($user['vgold']>=0){echo '<div> <form action="phukien.php?act=phukienbuy" name="phukien" method="post"><input type="radio" name="phukien" value="1"/> <img src="../images/phukien/1.gif" width="50" height="50" align="middle"/>Búa Bò Sữa<br/><input type="radio" name="phukien" value="2"/> <img src="../images/phukien/2.gif" width="50" height="50" align="middle"/>Dùi Cui<br/><input type="radio" name="phukien" value="3"/> <img src="../images/phukien/3.gif" width="50" height="50" align="middle"/>Kem SoCoLa<br/><input type="radio" name="phukien" value="4"/> <img src="../images/phukien/4.gif" width="50" height="50" align="middle"/>Kem Vani<br/><input type="radio" name="phukien" value="5"/> <img src="../images/phukien/5.gif" width="50" height="50" align="middle"/>Ví Tiền<br/><input type="radio" name="phukien" value="6"/> <img src="../images/phukien/6.gif" width="50" height="50" align="middle"/>Chảo Chống Dính<br/><input type="radio" name="phukien" value="7"/> <img src="../images/phukien/7.gif" width="50" height="50" align="middle"/>Túi Xách<br/><input type="radio" name="phukien" value="8"/> <img src="../images/phukien/8.gif" width="50" height="50" align="middle"/>Cánh Thiên Thần<br/><input type="radio" name="phukien" value="9"/> <img src="../images/phukien/9.gif" width="50" height="50" align="middle"/>Cánh Hạc<br/><input type="radio" name="phukien" value="10"/> <img src="../images/phukien/10.gif" width="50" height="50" align="middle"/>Cánh Ác Quỷ<br/><input type="radio" name="phukien" value="11"/> <img src="../images/phukien/11.gif" width="50" height="50" align="middle"/>Cánh Hạc Trắng<br/><input type="radio" name="phukien" value="12"/> <img src="../images/phukien/12.gif" width="50" height="50" align="middle"/>Kẹo Mút Trái Tim<br/><input type="radio" name="phukien" value="13"/> <img src="../images/phukien/13.gif" width="50" height="50" align="middle"/>Quạt Trung Hoa<br/><input type="radio" name="phukien" value="14"/> <img src="../images/phukien/14.gif" width="50" height="50" align="middle"/>Lao Điện<br/><input type="radio" name="phukien" value="15"/> <img src="../images/phukien/15.gif" width="50" height="50" align="middle"/>Dèn Lồng<br/><input type="radio" name="phukien" value="16"/> <img src="../images/phukien/16.gif" width="50" height="50" align="middle"/>Hoa Hồng<br/><input type="submit" name="submit" value="Mua"/> </form> </div> ';

}else{

echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'phukienbuy' :

if($user['vgold']>=2000){

$phukien = ($_POST['phukien']); 

mysql_query("UPDATE `users` SET `phukien` = '$phukien' ,`vgold`=`vgold`-2000  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được 1 món phụ kiện, hãy kiểm tra tủ đồ!</div>';

echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';





header('Location:../shop/phukien.php?act=phukienbuyo');

exit();



}else{

echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'phukienbuyo' :

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được 1 món phụ kiện, hãy kiểm tra tủ đồ!</div>';

echo '<div class="menu"><a href="../users/tudo.php">Tủ đồ</a></div>';

break;

default :






}

echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';

require_once ("../incfiles/end.php");