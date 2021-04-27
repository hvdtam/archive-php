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

$reqs = mysql_query("SELECT * FROM `soo` WHERE `type` = '2' AND `id`='$id'");
$ress = mysql_fetch_assoc($reqs);
if(!$ress){
    require_once('../incfiles/head.php');
    echo functions::display_error('Bang Hội Không Có!');
    require_once ('../incfiles/end.php');
    exit;
}

$mod1 = mysql_fetch_array(mysql_query("SELECT * FROM `soo` WHERE `id` = '$id'"));
$lvl = mysql_fetch_assoc(mysql_query("SELECT * FROM `soo_users` WHERE `sid`='$id'  AND `user_id`='$user_id'"));


if($mod1['mod']==2 && !$lvl){
    if (isset($_POST['p'])) {
        if ($mod1['p'] == trim($_POST['p']))
            $_SESSION['p'] = $mod1['p'];
        else
            echo functions::display_error('Mật Khẩu Sai!');
    }
    
$input = $_GET['p'];

    if (!isset($_SESSION['p']) || $_SESSION['p'] != $mod1['p']) {
        echo '<form action="../soo/?act=in&amp;id='. $id .'" method="post"><p>';
        echo 'Mật Khẩu:<br/><input type="text" name="p" value="'.$input.'"/></p>';
        echo '<p><input type="submit" name="submit" value="Vào"/></p>';
        echo '</form>';

require_once('../incfiles/end.php');
    exit;
}
}


$us = mysql_num_rows(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));


if ($us == 1){
echo 'Bạn Đã Là Thành Viên! <br /><div class="list1"><a href="../soo/?act=soo&amp;id=' . $id . '">Quay Lại</a></div>';
}
else
{
$in = mysql_query("INSERT INTO `soo_users` SET
                `sid` = '$id',
                `rights` = '0',
                `mod` = '0',
               `user_id` = '$user_id'");
if($in)
echo 'Bạn đã nhập thành công vào Bang Hội. <br /><div class="list1"><a href="../soo/?act=soo&amp;id=' . $id . '">Quay Lại</a></div>';
}

?>    