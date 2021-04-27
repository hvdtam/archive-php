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

                 
        /*
        -----------------------------------------------------------------
        Список Пользователей Сообществ
        -----------------------------------------------------------------
        */
        echo '<div class="phdr"><b>Bang Hội</b></div>';
        $req = mysql_query("SELECT * FROM `soo_users` WHERE `sid` = $id ORDER BY `id`  DESC LIMIT $start, $kmess ");
        $total = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = $id "));
        
        $i = 0;
        while ($res = mysql_fetch_array($req)) {
            $uid = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id` = " . $res['user_id'] . ""));
            echo $i % 2 ? '<div class="list2">' : '<div class="list1">';

                    if ($uid['sex'])
                        echo '<img src="../theme/' . $set_user['skin'] . '/images/' . ($uid['sex'] == 'm' ? 'm' : 'w') . ($uid['datereg'] > time() - 86400 ? '_new' : '') . '.png" width="16" height="16" align="middle" />&#160;';
                    else
                        echo '<img src="../images/del.png" width="12" height="12" align="middle" alt=""/>&#160;';
                        if($res['user_id'] != $user_id)
            echo '<a href="../users/profile.php?user=' . $res['user_id'] . '">' . $uid['name'] . '</a> ';
            else
            echo $uid['name'];
            // Метка должности
                    $user_rights = array(
                        7 => ' (Người Sán Lập)',
                        8 => ' (Admin)',
                        9 => ' (Thành Viên)'
                    );
                    echo @$user_rights[$res['rights']];

                     // Метка Онлайн / Офлайн
                    echo (time() > $uid['lastdate'] + 300 ? '<span class="red"> [Off]</span> ' : '<span class="green"> [ON]</span> ');
                    $us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));
                    if ($us['rights'] == 9){
                    if($res['user_id'] != $user_id){
                    echo '<a href="../soo/?act=eduser&amp;id='. $res['user_id'] .'&amp;sid='. $id .'">[Thứ Tự.] </a>';
                    echo '<a href="../soo/?act=deluser&amp;id='. $res['user_id'] .'&amp;sid='. $id .'">[X]</a>';
                    }
                    // Бан 
                    if($us['rights'] >= 7){
                    if($res['user_id'] != $user_id)
                    echo '<a href="../soo/?act=ban&amp;mod=do&amp;user=' . $res['user_id'] . '&amp;fid=' . $res['id'] . '&amp;sid=' . $id . '"><span class="cytate" style="color:red;"> [Cấm] </span></a>';
                    }
                    }
            echo '</div>';
            ++$i;
            
        }
        
        
        echo '<br/><div class="list1"><a href="../soo/?act=soo&amp;id='.$id.'">Quay Lại</a></div>';
        echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
        if ($total > $kmess) {
                    echo '<div class="topmenu">' . functions::display_pagination('../soo/?id=' . $id . '&amp;', $start, $total, $kmess) . '</div>' .
                         '<p><form action="../soo/?id=' . $id . '" method="post">' .
                         '<input type="text" name="page" size="2"/>' .
                         '<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/>' .
                         '</form></p>';
                }
        
            
?>