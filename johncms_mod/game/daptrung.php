<?php
define('_IN_JOHNCMS', 1);
$headmod = 'Đập trứng Ola';
require('../incfiles/core.php');
require_once ("../incfiles/head.php");
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}else{
switch($_GET['t'])
{
default:
echo'+ Bạn có: '.$datauser['balans'].'VNĐ<br>+ TaMk.tK. Đập trúng sẽ được 25k VNĐ, thua bị trừ 5k VNĐ.
<br>+ Trong khi đập nếu may mắn trúng trứng đặc biệt sẽ được x2.
<br>+ Số trứng gồm 3 trứng 1 - 3<br>+ Chọn Một Trứng:<br> <div align="center">
<a href="?t=ketqua&dap=1"><img src="http://321chat.tk/img/trung1.gif"></a>
<a href="?t=ketqua&dap=2"><img src="http://321chat.tk/img/trung2.gif"></a>
<a href="?t=ketqua&dap=3"><img src="http://321chat.tk/img/trung3.gif" class="baiviet"></a></div>
</div><div class="main_menu"></div><br>';
break;
case 'ketqua':
$dap = $_GET['dap'];
$tien = '5000';
if($dap < 1 || $dap > 3)
{
echo 'Định hack à? Mơ đi<br><div class="main_menu"># <a href="daptrung.php">Quay lại</a></div>';
}elseif($datauser['balans'] < $tien)
{
echo 'Không đủ tiền ùi!<br><div class="main_menu"># <a href="daptrung.php">Quay lại</a></div>';
}else{
$tientrung = $tien*5;
$ketqua = rand(1,3);
$mayman = rand(1,3);
if ($dap == $ketqua)
{
if ($dap == $mayman)
{
$tmm = $tientrung+$tientrung;
mysql_query("UPDATE `users` SET `balans`=`balans`+'".$tmm."'  WHERE `id` = '$user_id' LIMIT 1");
echo 'Chúc mừng '.$datauser['name'].' đã đập trúng trứng '.$ketqua.' cùng trúng trứng may mắn Và nhận được x2 tiền thắng lên '.$tmm.' VNĐ<br><div class="main_menu"># <a href="daptrung.php">Chơi tiếp</a></div>';
}else{
mysql_query("UPDATE `users` SET `balans`=`balans`+'".$tientrung."'  WHERE `id` = '$user_id' LIMIT 1");echo '<img src="http://321chat.tk/img/trungvo.png" class="baiviet"> Xin chúc mừng '.$datauser['name'].' đã đập trúng trứng '.$ketqua.'. Và nhận được '.$tientrung.'VNĐ<br><div class="main_menu">&raquo;<a href="daptrung.php">Chơi tiếp</a></div>';
} }else{
mysql_query("UPDATE `users` SET `balans`=`balans`-'".$tien."'  WHERE `id` = '$user_id' LIMIT 1");
echo 'Trứng đúng là '.$ketqua.' rất tiếc bạn đã đập trật và bị trừ '.$tien.' VNĐ<br><div class="main_menu"># <a href="daptrung.php">Chơi tiếp</a></div>';
} }
break;
} }
require_once("../incfiles/end.php");
?>
