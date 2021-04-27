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


$mod1 = mysql_fetch_array(mysql_query("SELECT `mod`,`cat` FROM `soo` WHERE `id` = '$id'"));
$usin = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = '$id' AND `user_id` = '$user_id'"));



if($mod1['mod'] == 2 && $usin != 1 ){
    echo functions::display_error('không truy cập!');
    echo '<br /><div class="list1"><a href="../soo/?id='. $mod1['cat'] .'">Trong Danh Mục</a></div>';
    require('../incfiles/end.php');
    exit;
}

echo '<div class="phdr"><b><a href="../soo/?act=soo&amp;id='. $id .'">Bang Hội </a>| Thông Tin</b></div>';
        $req = mysql_query("SELECT * FROM `soo` WHERE `id` = $id AND `type` = '2' ");
function p($length) {
$vals = "abcdefghijklmnopqrstuvwxyz0123456789";
for ($i = 1; $i <= $length; $i++) {
$result .= $vals{rand(0, strlen($vals))};
}
return $result;
}

$req1 = mysql_query("SELECT * FROM `soo` WHERE `type`='2' AND `id`='$id'");
$res = mysql_fetch_assoc($req1);

if($res['mod']==2){
$ost = time() - $res['p_time'];
if($ost > (24*3600)){
$gen_p = p(5);
$sql = mysql_query("UPDATE `soo` SET
        `p` = '".$gen_p."',
        `p_time` = '".time()."'
        WHERE `id` = '".$id."' LIMIT 1");
if(!$sql) echo '<br/>Không thể tạo một mật khẩu!';
} else {
$us = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));
$res['p_time'] = $res['p_time']+$set_user['sdvig']*3600;
echo ($us['rights'] >= 0 ? '<div class="list1">Mật Khẩu Cho 24 Giờ <b>'.$res['p'].'</b><br/>Hết Hạn Mật Khẩu:<br/>с '.date("d.m (H:i)", $res['p_time']).' до '.date("d.m (H:i)", $res['p_time']+(24*3600)).'</div>' : '');
}
}
        
        while ($res = mysql_fetch_array($req)) {
            
            if (!empty($res['mot'])){
            echo '<div class="list2">Phương Châm Hoạt Động: '.$res['mot'].'</div>';
            }
            else
            echo '<div class="list2">Phương Châm Sống: Không</div>';
            
            if (!empty($res['desc'])){
            echo '<div class="list2">Mô Tả: '.$res['desc'].'</div>';
            }
            else
            echo '<div class="list2">Mô Tả: Trống</div>';
            
            if (!empty($res['rule'])){
            echo '<div class="list2">Quy Định: '.$res['rule'].'</div>';
            }
            else
            echo '<div class="list2">Trống</div>';
            
            echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='.$res['id'].'">Quay Lại</a></div>';
            
        }



?>