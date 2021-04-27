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

$sid = isset($_REQUEST['sid']) ? abs(intval($_REQUEST['sid'])) : false;
$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $sid . " ' AND `user_id`=' " . $user_id . " '  "));

if($us['rights'] == 9){
if (isset($_POST['submit'])) {

$delus = mysql_query("DELETE  FROM `soo_users` WHERE `sid` = '$sid' AND `user_id` = '$id'");

if ($delus) {
echo '<div class="rmenu"><p><b>Người sử dụng bị loại bỏ!</b></p></div>';
} else {
echo '<div class="rmenu"><p><b>lôi!</b></p></div>';
}
echo '<div class="list1"><a href="/">Trang Chủ</a></div>';
} else {
echo '<p><b>Bạn có chắc bạn muốn xóa người sử dụng?</b></p>';
echo '<form name="form" action="" method="post">';
echo '<Input Name="submit" Type="submit" value="Xóa"> | <a href="../soo/?act=soo&amp;id='.$id.'"><b>Hủy</b></a></form>';


}

}
else
{
    header('Location: ../?err');
    exit;
}





?>   