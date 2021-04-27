<?php

define('_IN_JOHNCMS', 1);

$textl = 'Mua Icon';

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



echo '<div class="gray">Mua Icon  giá 1000 VGold!</div>';

switch($act){

case 'icon' :

if($user['vgold']>=0){

echo '<div> <form action="icon.php?act=iconbuy" name="icon" method="post">

<input type="radio" name="icon" value="1"/> <img src="../icon/1.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="2"/> <img src="../icon/2.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="3"/> <img src="../icon/3.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="4"/> <img src="../icon/4.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="5"/> <img src="../icon/5.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="6"/> <img src="../icon/6.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="7"/> <img src="../icon/7.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="8"/> <img src="../icon/8.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="9"/> <img src="../icon/9.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="10"/> <img src="../icon/10.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="11"/> <img src="../icon/11.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="12"/> <img src="../icon/12.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="13"/> <img src="../icon/13.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="14"/> <img src="../icon/14.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="15"/> <img src="../icon/15.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="16"/> <img src="../icon/16.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="17"/> <img src="../icon/17.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="18"/> <img src="../icon/18.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="19"/> <img src="../icon/19.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="20"/> <img src="../icon/20.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="21"/> <img src="../icon/21.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="22"/> <img src="../icon/22.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="23"/> <img src="../icon/23.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="24"/> <img src="../icon/24.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="25"/> <img src="../icon/25.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="26"/> <img src="../icon/26.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="27"/> <img src="../icon/27.gif" width="15" height="15" align="middle"/>&nbsp;<br/>

<input type="radio" name="icon" value="28"/> <img src="../icon/28.gif" width="15" height="15" align="middle"/>&nbsp;<br/>


<input type="submit" name="submit" value="Mua"/> </form> </div> '; 

}else{

echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'iconbuy' :

if($user['vgold']>=1000){

$icon = ($_POST['icon']); 

mysql_query("UPDATE `users` SET `icon` = '$icon' ,`vgold`=`vgold`-1000  WHERE `id` = '$user_id' LIMIT 1");

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được icon hãy kiểm tra!</div>';



header('Location:../shop/icon.php?act=iconbuyo');

exit();



}else{

echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';

}

break;

case 'iconbuyo' :

echo '<div class="menu">Giao dịch thành công. Bạn đã nhận được icon hãy kiểm tra!</div>';



break;

default :








}

echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';

require_once ("../incfiles/end.php");

?>