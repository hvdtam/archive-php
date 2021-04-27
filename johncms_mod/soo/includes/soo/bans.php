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
    require('../incfiles/head.php');
    echo functions::display_error($lng['access_guest_forbidden']);
    require('../incfiles/end.php');
    exit;
}


if($mod1['mod'] == 2 && $usin != 1 ){
    echo functions::display_error('không truy cập!');
    echo '<br /><div class="list1"><a href="../soo/?id='. $mod1['cat'] .'">Trong Danh Mục</a></div>';
    require('../incfiles/end.php');
    exit;
}
echo '<div class="phdr"><b>Danh Sách Cấm</b></div>';

        $total = mysql_num_rows(mysql_query("SELECT * FROM `soo_ban_users` WHERE `sid`='$id'  "));
       $req = mysql_query("SELECT `soo_ban_users`.`id` as `banid`, `soo_ban_users`.*, `users`.* FROM `soo_ban_users` LEFT JOIN `users` ON `soo_ban_users`.`user_id`=`users`.`id` WHERE `soo_ban_users`.`sid`='" . $id . "'  ORDER BY `soo_ban_users`.`ban_time` DESC LIMIT $start, $kmess");
        $i = 0;
        if($total){
        while ($res = mysql_fetch_assoc($req)) {
    echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
if($res['ban_time'] > time()){
$unban = '[<a href="../soo/?act=ban&amp;mod=cancel&amp;user=' . $res['id'] . '&amp;ban='.$res['banid'].'&amp;sid='.$id.'">unban</a>]';
}else{
$unban='[<a href="../soo/?act=ban&amp;mod=delete&amp;user=' . $res['id'] . '&amp;ban=' . $res['banid'] . '&amp;sid='.$id.'">Hủy bỏ lệnh cấm</a>]';
}
$history='[<a href="../soo/?act=ban&amp;user='.$res['id'].'&amp;sid='.$id.'">Lịch sử vi phạm</a>] ';
    echo functions::display_user($res,1);
echo '<small>';
echo '<li><span class="gray">Cấm:</span> <b>' . $res['ban_who'] . '</b></li>';
echo $history;
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));

                echo ($us['rights'] >= 7 ? ''.$unban.'' : '');
echo '</small>';
echo '</div>';
    ++$i;
            
        }
        echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $id .'">Quay Lại</a></div>';
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
        } else {
            echo functions::display_error('Пусто!');
        echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $id .'">Quay Lại</a></div>';
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
            require_once('../incfiles/end.php');
        }
        if ($total > $kmess) {
            echo '<p>' . functions::display_pagination('../soo/?act=bans&amp;id='. sid .'', $start, $total, $kmess) . '</p>' .
                 '<p><form action="../soo/?act=bans&amp;id='. $id .'" method="post">' .
                 '<input type="text" name="page" size="2"/>' .
                 '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
        }


?>