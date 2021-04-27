<?php
define('_IN_JOHNCMS', 1);
$textl = 'Khu Nap Năng Lượng Cho Thành Viên TaMk.tK';
$headmod = 'nick';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if (!$user_id) {
echo '<div class="rmenu">Trang dành cho thành viên. Vui lòng <a href=../login.php>Đăng nhập</a> hoặc <a href=../registration.php>Đăng ký</a></div>';
require_once ('../incfiles/end.php');
exit;
}
echo '<li><span class="gray"><b>Thông Tin Của Bạn</b></li>';
if (!empty($datauser['mana']))
echo '<span class="gray">Bạn Có: <b>' . $datauser['mana'] . '% Mana</b></span><br/>';
echo '<span class="gray">Bạn Có: <b>' . $datauser['balans'] . ' VND</b></span><br/>';
echo '<span class="gray">Giá: 50VND/1%</span>';
if (!$act){
echo '<div> <form action="napmn.php?act=ok" name="chem" method="post">
<b>Nhập Số Mana Cần Mua(%):</b><br><input type="text" name="chem" value=""/>
<input type="submit" name="submit" value="Mua"/></form></div>';
} else {
$chem = $_POST['chem'];
$xu = $chem*100;
if($datauser['balans'] > $xu && $xu > 10){								$msg = 'Bạn Đã Mua '.$chem.'% Mana Và Tài Khoản Bị -'.$xu.' VND!
Chúc Bạn 1 Ngày Vui Vẻ!';


mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $msg . "','".time()."','BOT','in','no','Giao Dịch Mana Thành Công','0','','','','" . mysql_real_escape_string($fname) . "');");


$msg1 = 'Hi. BOT Vừa Bán Cho [b][red]'.$login.'[/b][/red] Với [red][b]'.$chem.'%[/b][/red] Mana, May Mà [red][b]'.$login.'[/b][/red] Đã Thanh Toán Đầy Đủ [red][b]'.$xu.'[/b][/red] VND, Không Bớt 1 Xu! :music:';
mysql_query("UPDATE `users` SET `mana`=`mana`+'$chem'  WHERE `id` = '$user_id' LIMIT 1");
mysql_query("UPDATE `users` SET `balans`=`balans`-'$xu'  WHERE `id` = '$user_id' LIMIT 1");
mysql_query("INSERT INTO `forum` SET
`refid` = '203',

`type` = 'm' ,

`time` = '" . time() . "',

`user_id` = '2',

`from` = 'BOT',

`ip` = '00000',

`ip_via_proxy` = '" . core::$ip_via_proxy . "',

`soft` = '" . mysql_real_escape_string($agn1) . "',

`text` = '" . mysql_real_escape_string($msg1) . "'

");

$fadd = mysql_insert_id();

// ĐĐ±Đ½Đ¾Đ²Đ»ÑĐµĐ¼ Đ²Ñ€ĐµĐ¼Ñ Ñ‚Đ¾Đ¿Đ¸ĐºĐ°

mysql_query("UPDATE `forum` SET

`time` = '" . time() . "'

WHERE `id` = '203'

");

// ĐĐ±Đ½Đ¾Đ²Đ»ÑĐµĐ¼ Đ²Ñ€ĐµĐ¼Ñ Ñ‚Đ¾Đ¿Đ¸ĐºĐ°
mysql_query("UPDATE `forum` SET `time` = 'time()' WHERE `id` = 'X' LIMIT 1") or die('KhĂ´ng thĂª̀‰ cĂ¢̀£p nhĂ¢̀£t');
// ĐĐ±Đ½Đ¾Đ²Đ»ÑĐµĐ¼ ÑÑ‚Đ°Ñ‚Đ¸ÑÑ‚Đ¸ĐºÑƒ ÑĐ·ĐµÑ€Đ°
mysql_query("UPDATE `users` SET
`postforum`=`postforum`+1,
`balans`=`balans`+500,
`lastpost` = 'time()'
WHERE `id` = 'X'");
echo '<div class="menu">Bạn Đã Mua '.$chem.'% Mana Và Tài Khoản Bị -'.$xu.' VND!</div>';
}else{
echo '<div class="menu">Bạn Không Đủ Tiền Để Nạp Năng Lượng!</div>';
}
}
require_once ("../incfiles/end.php");
?>
