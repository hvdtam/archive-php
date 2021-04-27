<?php
/////////////////////////////////////
//////http://daymonn.h2m.ru//////////
/////Darts mod by Daymonn///////////
///////////////////////////////////
define('_IN_JOHNCMS', 1);
$textl = 'Game Phi Tiêu Online !';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
$rand = mt_rand(100, 999);
$balans_plus = "300";
$balans_minus = "100";
echo "<div class='phdr'>Phi tiêu cùng TaMk !</div>";
if ($user_id) {
switch ($act) {
case "go":
if ($datauser['balans'] >= 300) {
$num1 = mt_rand(1, 6);
$num3 = mt_rand(1, 6);
echo '<div class="gmenu">';
echo 'Kết quả của TaMk: <br/>';
echo '<img src="' . $num1 . '.gif" alt=""/><br/><br/>';
echo 'Kết quả của Bạn: <br/>';
echo '<img src="' . $num3 . '.gif" alt=""/><br/><br/></div>';
$num_bank = $num1;
$num_user = $num3;
if ($num_bank > $num_user) {
mysql_query("update `users` set balans=balans-100 where id='" .
$user_id . "' LIMIT 1;");
echo 'TaMk : Èo sao bạn phi gà thế mình xin 100 VNĐ nhé hé hé ! ';
}
if ($num_bank < $num_user) {
mysql_query("update `users` set balans=balans+300 where id='" .
$user_id . "' LIMIT 1;");
echo 'TaMk : Ọc được lắm thắng cả tớ cớ đó tặng bạn 300 VNĐ nè! ';
}
if ($num_bank == $num_user) {
mysql_query("update `users` set balans=balans+0 where id='" .
$user_id . "' LIMIT 1;");
echo 'TaMk : Ố Ồ ném được đó ngang cơ vs Tớ cơ đó chơi tiếp ko ? ';
}
echo '<br />Bạn có: ' . $datauser['balans'].' VNĐ';
echo '</div><div class="menu">
<b><a href="?act=go&amp;rand=' . $rand .
'">Ném Phi Tiêu</a></b><br/>';
echo '<a href="?">Trở lại</a><br />';
/////////////////////////
//задержка 1 сек
//sleep(1);
///////////////////////
} else {
echo display_error("Bạn không thể chơi khi không có đủ tiền.<br/> Hãy post bài cho wap thật nhiều để có VNĐ chơi game nhé.");
echo "<div class='menu'><a href='../?'><font color=blue><b>Hướng dẫn</font></a></div>";
require_once ("../incfiles/end.php");
exit;
}
break;
case "faq":
echo '<div class="gmenu">Để tham gia vào trò chơi, bấm vào "Chơi Luôn" và sau đó ném một phi tiêu của cơ hội<br/>';
echo 'Khi thua TaMk ,bạn sẽ bị An lấy đi 100 VNĐ<br/>';
echo 'Khi thắng TaMk ,Bạn sẽ được tặng 100 VNĐ<br/>';
echo 'Bạn không thể tham gia chơi game khi có ít hơn 1000 VNĐ<br/>';
echo 'Chúc các bạn chơi game vui vẻ!</div>';
echo '<div class="menu"><a href="?">Trở lại</a></div><br />';
break;
default:
echo '<div class="gmenu"><img src="dartslogo.png" alt=""/></div><br/>';
echo 'Bạn có: ' . $datauser['balans'].' VNĐ';
{
}
echo '</div><div class="menu">
<a href="?act=faq&amp;">Làm thế nào để chơi?</a>&nbsp;<a href="?act=go&amp;rand=' . $rand .
'"><br/>Вắt đầu chơi!</a><br />';
break;
}
} else {
echo display_error("Trò chơi chỉ có sẵn cho người dùng đăng ký của trang web");
}
require_once ("../incfiles/end.php");
?>
