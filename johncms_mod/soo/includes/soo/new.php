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



if (isset($_POST['submit'])) {
$name = isset($_POST['name']) ? functions::check($_POST['name']) : '';
$desc = isset($_POST['desc']) ? functions::check($_POST['desc']) : '';
$mot = isset($_POST['mot']) ? functions::check($_POST['mot']) : '';
$mod = isset($_POST['mod']) ? functions::check($_POST['mod']) : '';
$rule = isset($_POST['rule']) ? functions::check($_POST['rule']) : '';
$link = isset($_POST['link']) ? functions::check($_POST['link']) : '';

if (empty($name))
$error[] = 'Chưa Nhập Tên Bang Hội.';
if (empty($mot))
$error[] = 'Chưa Nhập Phương Châm Hoạt Động.';
if (empty($link))
$error[] = 'Chưa Nhập Địa Chỉ.';
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `soo` WHERE `type` = '2' AND `cat` = '$id' AND `name` = '$name'"), 0) > 0)
$error[] = 'Một cộng đồng như vậy là đã!';
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `soo` WHERE `type` = '2' AND `cat` = '$id' AND `link` = '$link'"), 0) > 0)
$error[] = 'Địa Chỉ Này Đã Được!';

if ($error) {
echo functions::display_error($error, '<a href="../soo/?act=new&amp;id=' . $id . '">Lặp lại</a>');
require('../incfiles/end.php');
exit;
}

$sql= array();
$sql = mysql_query("INSERT INTO `soo` SET
`cat` = '$id',
`type` = '2',
`name` = '$name',
`desc` = '$desc',
`user_id` = '$user_id',
`mod` = '$mod',
`mot` = '$mot',
`rule` = '$rule',
`link` = '$link'");
$soo_id = mysql_insert_id();
$sql = mysql_query("INSERT INTO `soo_forum` SET
`sid` = '" . $soo_id . "',
`type` = 'f',
`text` = '$name',
`soft` = '$desc',
`realid` = '$sort'");
$sql = mysql_query("INSERT INTO `soo_users` SET
`sid`='$soo_id',
`user_id`='$user_id',
`rights`='9'
");
if($sql){
echo '<div class="phdr"><b>Tạo Bang Hội</b></div><div class="list1">Đã Tạo Bang Hội</div>';
echo '<div class="list2"><a href="../soo/?act=soo&amp;id=' . $soo_id . '">Bang Hội</a></div>';
} else {
echo 'Lỗi';
}
} else {
echo '<div class="phdr"><b>Tạo Ra Một Bang Hội</b></div><div class="menu">' .
'<form action="../soo/?act=new&amp;id=' . $id . '" method="post">
*Tên:<br/><input type="text" name="name"/><br/>' .
'*Phương Châm Hoạt Động:<br/><input type="text" name="mot"/><br/>' .
'*Địa Chỉ:<br/><input type="text" name="link"/><br/>' .
'Mô Tả(max. 500):<br/><textarea name="desc" cols="24" rows="4"></textarea><br/>';
echo '<b>Kiểu Bang Hội:</b><br />';
echo '<input type="radio" value="0" name="mod"/>&nbsp;Tham Gia Tự Do<br />';
echo '<input type="radio" value="1" name="mod"/>&nbsp;Đóng Cửa<br />';
echo '<input type="radio" value="2" name="mod"/>&nbsp;Cần Có Giấy Mời<br />';
echo ' <input type="submit" name="submit" value="Tạo"/><br/></form></div>';

echo '<br /><div class="list1"><a href="../soo/?id='. $id .'">Quay Lại</a></div>';
}



?>
