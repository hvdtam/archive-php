<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));

if($us['rights'] == 9){
if (isset($_POST['submit'])) {

$delfor = mysql_query("DELETE FROM `soo_forum` WHERE `sid` = '". $id ."'");
$delus = mysql_query("DELETE FROM `soo_users` WHERE `sid` ='". $id ."'");
$og = mysql_query("DELETE FROM `soo` WHERE `id`='" . $id . "'");

if ($og == true) {
echo '<div class="rmenu"><p><b>Bang Hội Đã Bị Xóa!</b></p></div>';
} else {
echo '<div class="rmenu"><p><b>Lỗi!</b></p></div>';
}
echo '<div class="list1"><a href="../">Trang Chủ</a></div>';
} else {
echo '<p><b>Bạn có chắc bạn muốn loại bỏ Bang Hội, cùng với tất cả các thông tin?</b></p>';
echo '<form action="" method="post">';
echo '<input type="submit" name="submit" value="Xoá"/> | <a href="../soo/?act=soo&amp;id='. $id .'"><b>Không</b></a></form>';


}


}
else
{
    header('Location: ../?err');
    exit;
}





?>