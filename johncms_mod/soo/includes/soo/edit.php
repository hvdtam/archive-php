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

require_once('../incfiles/head.php');


$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));


   if ($us['rights'] == 9){

$req = mysql_query("SELECT * FROM `soo` WHERE `type` = '2' AND `id` = '$id' LIMIT 1");
    $res = mysql_fetch_assoc($req);

    if (isset($_POST['submit'])) {


$name = trim($_POST['name']);
        if (empty($name))
            $error[] = 'Xin vui lòng nhập';


        if ($error) {
            $error[] = '<a href="../soo/?act=edit&amp;id=' . $id . '">Lặp lại</a>';
            echo functions::display_error($error);
            require('../incfiles/end.php');
            exit;
        }
        $name = mysql_real_escape_string($name);
        $desc = isset($_POST['desc']) ? functions::check($_POST['desc']) : '';
        $mot = isset($_POST['mot']) ? functions::check($_POST['mot']) : '';
        $rule = isset($_POST['rule']) ? functions::check($_POST['rule']) : '';
        mysql_query("UPDATE `soo` SET `name`='$name', `desc` = '$desc', `mot`='$mot' WHERE `id` = '$id' LIMIT 1");
        echo '<div class="phdr"><b>Thay Đổi Bang Hội </b></div><div class="list1">Bang Hội Đã Thay Đổi</div>';
            echo '<div class="list2"><a href="../soo/?act=soo&amp;id=' . $id . '">Bang Hội</a></div>';
        
    } else {
        
        echo '<div class="phdr"><b>Thay Đổi Bang Hội:</b> ' . $res['name'] . '</div>' .
        '<div class="menu"><form action="../soo/?act=edit&amp;id=' . $id . '" method="post">' .
        '*Tên:<br/><input type="text" name="name" value="' . functions::checkout($res['name']) . '"/><br/>' .
        '*Phương Châm Hoạt Động:<br/><input type="text" name="mot" value="' . functions::checkout($res['mot']) . '"/><br/>' .
        'Quy Định:<br/><textarea name="desc" cols="24" rows="4">"' . functions::checkout($res['rule']) . '"</textarea><br/>' .
        'Mô Tả:<br/><textarea name="desc" cols="24" rows="4">"' . functions::checkout($res['desc']) . '"</textarea><br/>';

        echo '<input type="submit" name="submit" value="Thay Đổi"/><br/></form></div>';
        
        echo '<hr /><div class="func"><a href="../soo/?act=img&amp;id='. $id .'">Thay Đổi Logo</a><br />
        <a href="../soo/?act=del&amp;id='. $id .'">Hủy Bỏ Bang Hội</a></div>';
        
        echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $id .'">Quay Lại</a></div>';
    }
    }
    else 
    {
    echo functions::display_error('không truy cập');
    echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $id .'">Quay Lại</a></div>';
            require('../incfiles/end.php');
            exit;
    }



?>