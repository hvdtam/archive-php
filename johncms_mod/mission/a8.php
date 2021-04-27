<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết';
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
echo '<div class="menu"><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a> - <a href="../users/profile.php?id=' . $user['id'] . '">Thông tin cá nhân</a></div>';
echo '<div class="gray"><b>Nhiệm vụ 8: Tập luyện</b></div>';
$user_u = $user['id'];
$req_u = mysql_query("SELECT * FROM `users` WHERE `id` = '$user_u' LIMIT 1");
$res_u = mysql_fetch_array($req_u);
$exp = $res_u['postforum']*155+$res_u['postguest']*10;
switch($act){
case 'm' :
if($exp>=120000 && $user['mission']==7){
echo '<div> <form action="a8.php?act=mbuy" name="m" method="post">
<input type="radio" name="m" value="15000"/>  Nhận phần thưởng 15.000 DGold<br/>
<input type="submit" name="submit" value="Nhận"/> </form> </div> '; 
}else{
echo '<div class="menu">Nhiệm vụ chưa hoàn thành!</div>';
}
break;
case 'mbuy' :
if($exp>=120000 && $user['mission']==7){
$m = ($_POST['m']); 
mysql_query("UPDATE `users` SET `balans` = (`balans`+'$m') ,`mission`=`mission`+1  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Nhiệm vụ hoàn thành, bạn nhận được 15.000 Dgold!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';
echo '<div class="menu><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';

header('Location:../mission/a8.php?act=mbuyo');
exit();

}else{
echo '<div class="menu">Nhiệm vụ chưa hoàn thành!</div>';
}
break;
case 'mbuyo' :
echo '<div class="menu">Nhiệm vụ hoàn thành, bạn nhận được 15.000 Dgold!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';
break;
default :
echo '<div class="bmenu">Đẳng cấp thú nuôi!</div>';
echo '<div class="menu">Thay đổi: <li><a href="pet.php?act=color">Thú nuôi</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nick.php?act=color">Màu nick thường</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nickvip.php?act=color">Màu nick VIP</a></li>';
echo '<li><span class="gray"><a href="http://cutevn.tk/wap/str/napvg.php"><b>Nạp VGold ngay!!</b></a></li>';


}

require_once ("../incfiles/end.php");
?>