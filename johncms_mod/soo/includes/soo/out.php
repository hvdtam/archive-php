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
if (!$user_id) {
    
    echo functions::display_error($lng['access_guest_forbidden']);
    require('../incfiles/end.php');
    exit;
}

$reqs = mysql_query("SELECT * FROM `soo` WHERE `type` = '2' AND `id`='$id'");
$ress = mysql_fetch_assoc($reqs);
if(!$ress){
    require_once('../incfiles/head.php');
    echo functions::display_error('Không Có Bang Hội!');
    require_once ('../incfiles/end.php');
    exit;
}


$us = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));
if ($us['rights'] != 9){

if ($us == 0){
echo 'Bạn không phải là một thành viên của!<br /><div class="list1"><a href="../soo/?act=soo&amp;id=' . $id . '">Quay Lại</a></div>';
} 
else
{    
$out = mysql_query("DELETE FROM `soo_users` WHERE `user_id` = '$user_id'");
if($out)
echo 'Bạn đã thành công rời khỏi Bang Hội. <br /><div class="list1"><a href="../soo/?act=soo&amp;id=' . $id . '">Quay Lại</a></div>';
}
}
else
echo functions::display_error();

?>   