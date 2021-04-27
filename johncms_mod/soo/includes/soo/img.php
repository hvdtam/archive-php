<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

require_once ('../incfiles/lib/class.upload.php');
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


$us = mysql_fetch_array(mysql_query("SELECT * FROM `soo_users` WHERE `sid` = ' " . $id . " ' AND `user_id`=' " . $user_id . " '  "));


   if ($us['rights'] == 9){

require_once('../incfiles/head.php');
$req = mysql_query("SELECT * FROM `soo` WHERE `type` = '2' AND `id`='$id'");
$res = mysql_fetch_assoc($req);

if(!$res)
{
echo functions::display_error('Bang Hội không tồn tại!'); 
echo '<br /><div class="list1"><a href="../soo/?act=soo&amp;id='. $id .'">Quay Lại</a></div>'; 
require_once ('../incfiles/end.php'); 
exit; 
}

echo '<div class="phdr"><b>Logo Hiện Tại:</b></div>';
            if (file_exists(('../files/soo/logo/' . $res['id'] . '_logo.png')))
            {
            echo '<a href="../files/soo/logo/' . $res['id'] . '.png"><img src="../files/soo/logo/' . $res['id'] . '_logo.png" alt="' . $res['id'] . '"/></a>';
            } else {
            echo '<img src="../images/soo/nologo.png" alt="nologo"/>';
            }
            
if (isset ($_POST['submit'])) {
$handle = new upload($_FILES['imagefile']);
if ($handle->uploaded) {
// Обрабатываем фото
$handle->file_new_name_body = $res['id'];
//$handle->mime_check = false;
$handle->allowed = array('image/jpeg', 'image/gif', 'image/png');
$handle->file_max_size = 1024 * $set['flsz'];
$handle->file_overwrite = true;
$handle->image_resize = true;
$handle->image_x = 320;
$handle->image_ratio_y = true;
$handle->image_convert = 'png';
$handle->process('../files/soo/logo/');
if ($handle->processed) {
// Обрабатываем превьюшку
$handle->file_new_name_body = $res['id'] . '_logo';
$handle->file_overwrite = true;
$handle->image_resize = true;
$handle->image_x = 150;
$handle->image_ratio_y = true;
$handle->image_convert = 'png';
$handle->process('../files/soo/logo/');
if ($handle->processed) {
echo '<div class="gmenu"><p>Logo Được Tải<br /><a href="../soo/?act=soo&amp;id='.$res['id'].'">Tiến Hành</a></p></div>';
}
else {
echo functions::display_error($handle->error);
}
}
else {
echo functions::display_error($handle->error);
}
$handle->clean();
}
}
else {
echo '<form enctype="multipart/form-data" method="post" action="../soo/?act=img&amp;id='.$id.'"><div class="menu"><p>';
echo 'Chọn Hình Ảnh:<br /><input type="file" name="imagefile" value="" />';
echo '<input type="hidden" name="MAX_FILE_SIZE" value="' . (1024 * $set['flsz']) . '" />';
echo '</p><p><input type="submit" name="submit" value="Gỡ Bỏ" />';
echo '</p></div></form>';
echo '<div class="phdr"><a href="../soo/?act=soo&amp;id='.$res['id'].'">Bang Hội</a><br/><small>Các tập tin cho phép JPG, JPEG, PNG, GIF<br />Tập tin kích thước không được vượt quá ' . $set['flsz'] . ' kb.<br />';
echo 'Những hình ảnh mới thay thế cái cũ (nếu có)</small></div>';
}

    }
    else 
    {
    echo functions::display_error('không truy cập!');
    echo '<br /><div class="list1"><a href="../soo/">Quay Lại</a></div>';
            require('../incfiles/end.php');
            exit;
    }

?>
