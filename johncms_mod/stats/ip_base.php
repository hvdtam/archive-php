<?php
//////////////////////////////////////////
//   Модуль статистики для JohnCMS      //
//////////////////////////////////////////
//  Автор: Максим (Simba)               //
//  Wap site - http://symbos.su         //
//////////////////////////////////////////

define('_IN_JOHNCMS', 1);
$headmod = 'statistik';
$textl = 'Cơ sở dữ liệu quản lý IP';
require_once '../incfiles/core.php';
require_once '../incfiles/head.php';
$act = isset($_GET['act']) ? $_GET['act'] : '';
if ($rights >= 9){

switch ($act){
    ////////////////////////////////////
    //////// Управление базой IP ///////
    ////////////////////////////////////
    case 'base':
    echo'<div class="phdr">Quản Lý Cơ Sở Dữ Liệu IP</div>';
    $count_ip = mysql_result(mysql_query("SELECT COUNT(*) FROM `counter_ip_base`;"), 0);
    if($count_ip > 0){
    $ip_base = mysql_query("SELECT * FROM `counter_ip_base` LIMIT ".$start.",".$kmess);
    $i = 0;
    while($arr = mysql_fetch_array($ip_base)){
    echo ($i % 2) ? '<div class="list1">' : '<div class="list2">';
        ++$i;
    echo ''.long2ip($arr['start']).' - '.long2ip($arr['stop']).' | '.$arr['operator'].' | '.$arr['country'].'
    <div class="sub"><a href="ip_base.php?act=base_edit&amp;id='.$arr['id'].'">Thay đổi</a> | <a href="ip_base.php?act=base_delete&amp;id='.$arr['id'].'">Hủy bỏ</a></div></div>';
    }

    echo '<div class="phdr">Tổng IP: ' . $count_ip . '</div>';
    if ($count_ip > $kmess){
        echo '<div class="topmenu">';
    	echo '' . functions::display_pagination('ip_base.php?act=base&amp;', $start, $count_ip, $kmess) . '</div>';
    	echo '<p><form action="ip_base.php" method="get"><input type="hidden" name="act" value="base"/><input type="text" name="page" size="2"/><input type="submit" value="Đến trang &gt;&gt;"/></form></p>';}

    }else{ echo'<div class="rmenu">Không phù hợp với bất kỳ địa chỉ IP trong cơ sở dữ liệu!</div>'; }
    echo'<div class="menu"><a href="ip_base.php?act=base_add">Thêm IP</a></div>';
    break;

    ////////////////////////////////////
    //////// Изменение IP в базе ///////
    ////////////////////////////////////
    case 'base_edit':
    echo'<div class="phdr">Thay đổi IP</div>';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (isset($_POST['submit']))
    {
    mysql_query("UPDATE `counter_ip_base` SET
    `start` = '".ip2long($_POST['start'])."',
    `stop` = '".ip2long($_POST['stop'])."',
    `operator` = '".functions::check($_POST['operator'])."',
    `country` = '".functions::check($_POST['country'])."'
    WHERE `id` = '" . $id . "' LIMIT 1;");
    echo '<div class="gmenu">Thay đổi đã được lưu!</div>';
    }

    $ip_base = mysql_query("SELECT * FROM `counter_ip_base` WHERE `id` = '".$id."'");
    if (mysql_num_rows($ip_base) > 0) {
    $arr = mysql_fetch_array($ip_base);
    echo '<form action="ip_base.php?act=base_edit&amp;id='.$id.'" method="post">
    <div class="menu">Lên trên của phạm vi các:<br/>
    <input type="text" name="start" value="'.long2ip($arr['start']).'"/></div><div class="menu">
    Kết thúc phạm vi:<br/>
    <input type="text" name="stop" value="'.long2ip($arr['stop']).'"/></div><div class="menu">
    Nhà điều hành:<br/>
    <input type="text" name="operator" value="'.$arr['operator'].'"/></div><div class="menu">
    Quốc gia:<br/>
    <input type="text" name="country" value="'.$arr['country'].'"/></div><div class="menu">
    <span class="red">Điền vào các lĩnh vực không có lỗi, nếu không có thể là vấn đề nguồn gốc của các số liệu thống kê!</span><br/>
    <input type="submit" name="submit" value="Thay đổi"/></div>
    </form>';
    }else{
        echo'<div class="rmenu">Lỗi! Không tìm thấy!</div>';
    }
    echo'<div class="menu"><a href="ip_base.php?act=base">Danh sách IP</a></div>';
    break;

    ////////////////////////////////////
    //////// Удаление IP из базы ///////
    ////////////////////////////////////
    case 'base_delete':
    echo'<div class="phdr">Loại bỏ IP</div>';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $ip_base = mysql_query("SELECT * FROM `counter_ip_base` WHERE `id` = '".$id."'");
    if (mysql_num_rows($ip_base) > 0) {
    mysql_query("DELETE FROM `counter_ip_base` WHERE `id` = '".$id."' LIMIT 1");
    echo'<div class="gmenu">Gỡ bỏ thành công!</div>';
    }else{
        echo'<div class="rmenu">Lỗi! Không tìm thấy!</div>';
    }
    echo'<div class="menu"><a href="ip_base.php?act=base">Danh sách IP</a></div>';
    break;

    ////////////////////////////////////
    //////// Изменение IP в базе ///////
    ////////////////////////////////////
    case 'base_add':
    echo'<div class="phdr">Thêm IP</div>';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if (isset($_POST['submit']))
    {
    $operator = ($_POST['operator']) ? functions::check($_POST['operator']) : functions::check($_POST['s_operator']);
    $country = ($_POST['country']) ? functions::check($_POST['country']) : functions::check($_POST['s_country']);
    $error = '';
    $ip1 = ip2long($_POST['start']);
    $ip2 = ip2long($_POST['stop']);
    if (!$ip1)
    $error = '<div>Địa chỉ đầu tiên không hợp lệ</div>';
    if (!$ip2)
    $error .= '<div>Địa chỉ thứ hai không hợp lệ</div>';
    if (!$error && $ip1 > $ip2)
    $error = 'Địa chỉ thứ hai phải lớn hơn đầu tiên';
    if(empty($operator))
    $error .= '<div>Xin vui lòng nhập các nhà điều hành!</div>';
    if(empty($country))
    $error .= '<div>Xin vui lòng nhập các quốc gia!</div>';

    if(!$error){
    mysql_query("INSERT INTO `counter_ip_base` SET
    `start` = '".$ip1."',
    `stop` = '".$ip2."',
    `operator` = '".$operator."',
    `country` = '".$country."';");
    echo '<div class="gmenu">Thêm thành công!</div>';
    }else{
        echo functions::display_error($error, '<a href="ip_base.php?act=base_add">Trở lại</a>');
    }

    }else{
    echo '<form action="ip_base.php?act=base_add" method="post">
    <div class="menu">Lên trên của phạm vi:<br/>
    <input type="text" name="start"/><br/>
    <small>Ví dụ: 192.168.192.168</small></div><div class="menu">
    Kết thúc phạm vi:<br/>
    <input type="text" name="stop"/><br/>
    <small>Ví dụ: 192.189.122.18</small></div><div class="menu">
    Оператор:<br/>
    <input type="text" name="operator"/><br/>
    <small>Ví dụ: Beeline</small></div>';
    echo '<div class="menu">Chọn một nhà điều hành từ những cái hiện có:<br/>
    <select name="s_operator" class="textbox">';
    $impcat = mysql_query("SELECT * FROM `counter_ip_base` GROUP BY `operator`;");
    echo '<option value="">không được chọn</option>';
    while ($arr = mysql_fetch_array($impcat)) {
        echo '<option value="' . $arr['operator'] . '">' . $arr['operator'] . '</option>';
            }
            echo '</select><br/>
            <small>Để viết bằng tay, để lại "không được chọn"</small>
            </div>';
    echo '<div class="menu">
    Страна:<br/>
    <input type="text" name="country"/><br/>
    <small>Ví dụ, Nga</small></div>';
    
    echo '<div class="menu">Chọn một quốc gia từ những cái hiện có:<br/>
    <select name="s_country" class="textbox">';
    $impcat = mysql_query("SELECT * FROM `counter_ip_base` GROUP BY `country`;");
    echo '<option value="">Не выбрана</option>';
    while ($arr = mysql_fetch_array($impcat)) {
        echo '<option value="' . $arr['country'] . '">' . $arr['country'] . '</option>';
            }
            echo '</select><br/>
            <small>Để viết bằng tay, để lại "không được chọn"</small></div>';
    
    echo '<div class="menu">
    <span class="red">Điền vào các lĩnh vực không có lỗi, nếu không có thể là vấn đề nguồn gốc của các số liệu thống kê!<br/>
    Lên trên phạm vi nên được ít hơn so với kết thúc (xem ví dụ)!</span><br/>
    <input type="submit" name="submit" value="Thêm"/></div>
    </form>';
    }
    echo'<div class="menu"><a href="ip_base.php?act=base">Danh sách IP</a></div>';    
    break;
}

echo '<div class="gmenu"><a href="index.php">Các số liệu thống kê</a></div>';

}else{
    echo '<div class="rmenu">Truy cập bị từ chối!</div>';
}
require_once '../incfiles/end.php';
?>