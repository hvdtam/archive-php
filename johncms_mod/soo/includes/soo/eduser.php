<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

/*
-----------------------------------------------------------------
Закрываем от неавторизованных юзеров
-----------------------------------------------------------------
*/
if (!$user_id && !$set['active']) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_guest_forbidden']);
    require('../incfiles/end.php');
    exit;
}

$sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));
$req = mysql_query("SELECT  `soo_users`.`rights` AS `rsoo`, `soo_users`.*, `users`.* FROM `soo_users` LEFT JOIN `users` ON `soo_users`.`user_id`=`users`.`id` WHERE `soo_users`.`user_id` = '$id' AND `soo_users`.`sid`='$sid'");
$user1=mysql_fetch_array($req);



if ($us['rights'] != 9){
    echo functions::display_error('lôi!');
    require_once ('../incfiles/end.php');
    exit;
}

if (isset($_GET['yes'])){
    
    if($us['rights'] == 9){
$sql = mysql_query("UPDATE `soo_users` 
SET
`rights` = '9'
WHERE `user_id` = '".$id."' AND `sid` = '".$sid."' LIMIT 1");
$sql1 = mysql_query("UPDATE `soo_users` 
SET
`rights` = '8'
WHERE `user_id` = '".$user_id."' AND `sid` = '".$sid."' LIMIT 1");
if(!$sql || !$sql1){
 echo functions::display_error('lôi!');
    require_once ('../incfiles/end.php');
    exit;
}
}else{
echo 'Không đủ đặc quyền!!';
    require_once ('../incfiles/end.php');
    exit;
}
echo 'Bạn đang không còn là sobschestva người sáng tạo! tác giả mới <b>'.$user1['name'].'</b><br/><a href="../soo/?act=users&amp;id=' . $sid . '">Tiến hành</a>';
    require_once ('../incfiles/end.php');
    exit;
        break;
}
if(isset($_GET['ok'])){
    
    
    
    if($us['rights'] != 9){
    echo functions::display_error('Không đủ đặc quyền!');
    require_once ('../incfiles/end.php');
    exit;
}
if (isset($_POST['submit'])) {
    $us1['rights'] = intval($_POST['rights']);

if($us1['rights']==9 && !$yes){
echo 'Bạn có chắc chắn bạn muốn truyền tải các vị trí của người sử dụng Đấng Tạo Hóa<b>'.$user1['name'].'</b>?'; 
echo '<br/><h3><a href="../soo/?act=eduser&amp;id=' . $id. '&amp;sid='.$sid.'&amp;yes"> vâng</a>|<a href="../soo/?act=eduser&amp;id=' . $id. '&amp;sid='.$sid.'">không</a></h3>';
    require_once ('../incfiles/end.php');
    exit;
}else{
$sql3 = mysql_query("UPDATE `soo_users` 
SET
`rights` = '".$us1['rights']."'
WHERE `user_id` = '".$id."' AND `sid` = '".$sid."'");
if(!$sql3){
 echo functions::display_error('lôi!');
    require_once ('../incfiles/end.php');
    exit;
}
}
}
header('Location: ../soo/?act=users&id=' . $sid . '');
        break;
    
    
    
}
else{

echo '<div class="phdr">Bạn có muốn chỉ định</div><div class="gmenu"> '.functions::display_user($user1,1).'';

echo '<form action="../soo/?act=eduser&amp;id=' . $id. '&amp;sid='.$sid.'&amp;ok" method="post">';

   if ($us['rights'] >= 8){

        echo '<input type="radio" value="0" name="rights" ' . (!$user1['rsoo'] ? 'checked="checked"' : '') . '/>&nbsp;<b>Một thành viên của cộng đồng</b><br />';
        echo '<input type="radio" value="7" name="rights" ' . ($user1['rsoo'] == 7 ? 'checked="checked"' : '') . '/>&nbsp;Модератор<br />';
}
 if ($us['rights'] == 9){
        echo '<input type="radio" value="8" name="rights" ' . ($user1['rsoo'] == 8 ? 'checked="checked"' : '') . '/>&nbsp;Quản trị viên<br />';
        echo '<div class="sub"><input type="radio" value="9" name="rights" ' . ($user1['rsoo'] == 9 ? 'checked="checked"' : '') . '/>&nbsp;<b>Đấng Tạo Hóa</b><br/><small>(Chuyển quyền sở hữu của câu lạc bộ!)</small></div>';
}
echo '<br/><input type="submit" value="lưu" name="submit" />';
echo '</form></div>';
echo '<div class="phdr" '.$kop.'><a href="users_soo.php?id='.$sid.'">Quay Lại</a></div>';
        
}


?>