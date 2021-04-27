<?php
define('_IN_JOHNCMS', 1);
$textl = 'Mua vip';
$headmod = 'muavip';
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
echo '<div class="menu">Mua vip</div>';
echo '<div class="gray">Bạn cần có trên 20 thank để mua vip</div>';
switch($act){
case 'muavip' :
if($user['thank_duoc']>=20 && $user['balans']>=10000){
echo '<div> <form action="muavip.php?act=muavipbuy" name="muavip" method="post">
<input type="radio" name="muavip" value="1"/> Thành viên vip<br/>
<input type="radio" name="muavip" value="0"/> Thành viên thường<br/>

<input type="submit" name="submit" value="Đồng ý"/> </form> </div> '; 
}else{
echo '<div class="menu">Bạn không đủ 20 Thanker, hãy cố gắng post bài để nhận thank nha!</div>';
}
break;
case 'muavipbuy' :
if($user['thank_duoc']>=20 && $user['balans']>=10000){
$memvip = ($_POST['muavip']); 
mysql_query("UPDATE `users` SET `memvip` = '$memvip' ,`balans`=`balans`-10000  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Bạn đã trở thành thành viên vip và có quyền vào kho hàng!</div>';



header('Location:../shop/muavip.php?act=muavipbuyo');
exit();

}else{
echo '<div class="menu"> Bạn không đủ 20 Thanker, hãy cố gắng post bài để nhận thank nha!</div>';
}
break;
case 'muavipbuyo' :
echo '<div class="menu">Bạn đã trở thành thành viên vip và có quyền vào kho hàng!</div>';

break;
default :
echo '<div class="menu"><a href="../shop/muavip.php?act=muavip">Mua vip</a></div>';

}
echo '<div class="menu"><a href="../str/anketa.php">Hồ sơ cá nhân</a></div>';
require_once ("../incfiles/end.php");
?>
