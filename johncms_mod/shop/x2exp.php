<?php

define('_IN_JOHNCMS', 1);

$textl = 'Thẻ Nhân đôi điểm kinh nghiệm';

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



echo '<div class="gray">Thẻ nhân đôi EXP giá 20.000 VGold!</div>';

switch($act){

case 'x2' :

if($user['vgold']>=200000){

echo '<div> <form action="x2exp.php?act=x2buy" name="x2" method="post">

<input type="radio" name="x2" value=""/>  Chấp nhận nhân đôi số điểm kinh nghiệm đang có<br/>

<input type="submit" name="submit" value="Mua"/> </form> </div> '; 

}else{

echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'x2buy' :

if($user['vgold']>=200000){

$postforum = ($_POST['x2']); 

mysql_query("UPDATE `users` SET `postforum` = `postforum`*2 , `postguest` = `postguest`*2 ,`vgold`=`vgold`-200000  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="menu">Giao dịch thành công. Điểm kinh nghiệm của bạn đã nhân đôi, hãy kiểm tra thông tin cá nhân!</div>';

echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';





header('Location:../shop/x2exp.php?act=x2buyo');

exit();



}else{

echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'x2buyo' :

echo '<div class="menu">Giao dịch thành công. Điểm kinh nghiệm của bạn đã nhân đôi, hãy kiểm tra thông tin cá nhân!</div>';

echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';

break;

default :






}

echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';

require_once ("../incfiles/end.php");

?>