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
echo '<div class="gray"><b>Nhiệm vụ 1: Bước Khởi Đầu</b></div>';
switch($act){
case 'm' :
if($user['postforum']>=50 && $user['mission']==0){
echo '<div> <form action="a1.php?act=mbuy" name="m" method="post">
<input type="radio" name="m" value="2000"/>  Nhận phần thưởng 2.000 VND<br/>
<input type="submit" name="submit" value="Nhận"/> </form> </div> '; 
}else{
echo '<div class="menu">Nhiệm vụ chưa hoàn thành!</div>';
}
break;
case 'mbuy' :
if($user['postforum']>=50 && $user['mission']==0){
$m = ($_POST['m']); 
mysql_query("UPDATE `users` SET `balans` = (`balans`+'$m') ,`mission`=`mission`+1  WHERE `id` = '$user_id' LIMIT 1");
echo '<div class="menu">Nhiệm vụ hoàn thành, bạn nhận được 2.000 VND!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';
echo '<div class="menu><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';

header('Location:../mission/a1.php?act=mbuyo');
exit();

}else{
echo '<div class="menu">Nhiệm vụ chưa hoàn thành!</div>';
}
break;
case 'mbuyo' :
echo '<div class="menu">Nhiệm vụ hoàn thành, bạn nhận được 2.000 VND!</div>';
echo '<div class="menu"><a href="../users/profile.php">Thông tin cá nhân</a></div>';
break;
default :
echo '<div class="bmenu">Đẳng cấp thú nuôi!</div>';
echo '<div class="menu">Thay đổi: <li><a href="pet.php?act=color">Thú nuôi</a></li>';
echo '<div class="menu">Thay đổi: <li><a href="nick.php?act=color">Màu nick </a></li>';



}

require_once ("../incfiles/end.php");
?>