<?php
define('_IN_JOHNCMS', 1);
$textl = 'Thẻ lập Fam';
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
echo '<div class="menu">Shop </a></div>';

echo '<li><span class="gray"><b>Tài khoản bạn đang có:</b></li>';
if (!empty($user['vgold']))
    echo '<li><span class="gray">VGold: </span>' . $user['vgold'] . '</li>';
if (!empty($user['balans']))
    echo '<li><span class="gray">VND: </span>' . $user['balans'] . '</li>';

echo '<div class="gray">Lệnh bài lập Gia tộc giá 100.000 VGold!</div>';
switch($act){
case 'fam' :
if($user['vgold']>=100000){
echo '<div> <form action="lapfam.php?act=fambuy" name="fam" method="post">
<input type="text" name="fam" value="Nhập tên Gia tộc"/>
<input type="submit" name="submit" value="Tạo fam "/></form></div>';
}else{
echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'fambuy' :
if($user['vgold']>=100000){
$fam = ($_POST['fam']); 
mysql_query("UPDATE `users` SET `fam` = '$fam' , `vgold`=`vgold`-100000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Giao dịch thành công, Gia tộc của bạn đã được tạo: '.$user['fam'].' .Hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';


header('Location:../shop/lapfam.php?act=fambuyo');
exit();

}else{
echo '<div class="menu">Bạn không đủ số VGold, hãy kiểm tra lại và liên hệ với Admin để nạp thẻ!</div>';
}
break;
case 'fambuyo' :
echo '<div class="menu">Giao dịch thành công, Gia tộc của bạn đã được tạo: '.$user['fam'].' .Hãy kiểm tra thông tin cá nhân!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';
break;
default :




}
echo '<div class="menu"><a href="../shop/shop.php">Shop</a></div>';
require_once ("../incfiles/end.php");
?>