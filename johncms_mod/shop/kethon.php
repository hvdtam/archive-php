<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
if(!$user_id){
require('../incfiles/head.php');
echo functions::display_error($lng['access_guest_forbidden']);
require('../incfiles/end.php');
exit;
}
$textl = 'Kết hôn';
require('../incfiles/head.php');
switch($_GET['act'])
{
default:
if(empty($datauser['love']))
{
if(isset($_POST['submit'])){
$love=$_POST['love'];
$sql = @mysql_query("SELECT name FROM users WHERE name='".$love."'");
$arr = mysql_fetch_array(mysql_query("select * from `users` WHERE `name` = '".$love."' LIMIT 1"));
if (@mysql_num_rows($sql) == 0)
{
echo 'Người bạn muốn kết hôn không có trong diễn đàn!<br/>hãy mời người đó vào đi bạn<div class="list1"><a href="?">Quay lại</a></div>';
}
elseif($datauser['sex'] == $arr['sex'])
{
echo 'Bạn nên xem lại giới tính của mình đi nhé<div class="list1"><a href="?">Quay lại</a></div>';
}
elseif(empty($love)){
echo 'Bạn chưa nhập tên Nửa Kia của mình<div class="list1"><a href="?">Quay lại</a></div>';
}
elseif($datauser['balans'] < 15000)
{
echo 'Bạn không đủ tiền để đăng kí<br/><div class="list1"><a href="?">Quay lại</a></div>';
}
else
{
$noidung = ''.$datauser['name'].' muốn kết hôn với bạn<br/>Bạn có đồng ý không?<br/>
<font color="red"><a href="../mod/kethon.php?act=dongy">Đồng ý</a>  <a href="../mod/kethon.php?act=khong">Không đồng ý</a></font>';
mysql_query("insert into `privat` values(0,'".$love."','" . $noidung . "','" .time(). "','Đăng kí kết hôn','in','no','Lời mời kết hôn','0','','','','" . mysql_real_escape_string($fname) . "');");
mysql_query("UPDATE `users` SET
`balans`=`balans` - 15000 , `love`='$love' WHERE `id`='".$user_id."'");
echo 'Mời thành công';
}
}
else
{
echo 'Phí dịch vụ 15.000VNĐ cho một lần gửi.Chi phí tổ chức đám cưới là 300.000 nếu nửa kia đồng ý.';
echo '
<center><h1>Đơn Đăng kí kết hôn</h1></center><br/>
Hôm nay ngày lành tháng tôt ' .
'<form method="post">' .
'Bạn :'. $datauser['name'].'' .
'<br/>Muốn lấy:<input type="text" name="love" value="" size="20"/>' .
'<br/>Để lên vợ lên chồng. '. $datauser['name'].' có đồng ý không' .
'<br/>' .
'<input type="submit" value="Đồng ý" name="submit" /><br />' .
'</form>' .
'';
}
}
else
{
echo 'Bạn đã lấy hoặc đang đăng kí kết hôn với <b>'.$datauser['love'].'</b><br/>Nều muốn lấy người khác hãy ly dị với <b>'.$datauser['love'].'</b>';
}
break;
case 'dongy':
$arr = mysql_fetch_array(mysql_query("select * from `users` WHERE `love` = '".$datauser['name']."' LIMIT 1"));

if($datauser['balans'] < 300000)
{
echo 'Bạn không đủ tiền để kết hôn. bạn phải có 300000<br/><div class="list1"><a href="?">Quay lại</a></div>';
}
elseif(empty($arr['name']))
{
echo 'Không có ai muốn kết hôn với bạn';
}
else
{
echo '<h1>Hai bạn giờ đã thành vợ chồng</h1><br/>
Xin hay mời mọi người tời dự đám cười của hai bạn.Được tổ chức tại trang chủ<font color ="red">Tại trang chủ</font/>';
mysql_query("UPDATE `users` SET
`balans`=`balans` - 300000 , `love`='".$arr['name']."' WHERE `id`='".$user_id."'");
$noidung = ''.$datauser['name'].' đã đồng ý kết hôn với bạn<br/>Hãy mời mọi người vào chung vui nào. Tổ chức tại trang chủ';
mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $noidung . "','" .time(). "','Đồng ý kết hôn','in','no','Đồng ý kết hôn','0','','','','" . mysql_real_escape_string($fname) . "');");
mysql_query("UPDATE `users` SET
`balans`=`balans` - 300000 WHERE `name`='".$arr['name']."'");
$time = time() + 86400;
mysql_query("INSERT INTO `kethon` SET
`time` = '" . $time . "',
`vo` = '" . $datauser['name'] . "',
`chong` = '" . $arr['name'] . "'

;");
$ten ='Lễ Thành Hôn Của [red][b]'.$datauser['name'].'[/b][/red] và [red][b]'.$arr['name'].'[/b][/red]';
$noidung =' [img]http://m.tamk.tk/mod/love.gif[/img]
Hôm nay ngày lành tháng tốt, được sự tác hợp của [red]TaMk[/red] cùng toàn thể thành viên TaMk.tK !
Chúng ta cùng nhau có mặt tại đây để chứng giám
cho tình yêu của đôi uyên ương trẻ
[b]'.$datauser['name'].'[/b] và [b]'.$arr['name'].'[/b] chúc cho đôi uyên ương trẻ trăm năm hạnh phúc.
[red]Ta tuyên bố hai con chính thức trở thành vợ chồng[/red].
[b]Hôn Lễ Chính Thức Bắt Đầu[/b]
Mọi người vào chung vui cùng đôi bạn trẻ';
mysql_query("INSERT INTO `forum` SET
`refid` = '68',
`type` = 't',
`time` = '" . time() . "',
`user_id` = '2',
`from` = 'BOT (Cha Sứ)',
`text` = '$ten'
");
$rid = mysql_insert_id();
// Добавляем текст поста
mysql_query("INSERT INTO `forum` SET
`refid` = '$rid',
`type` = 'm',
`hide` = '$hide',
`time` = '" . time() . "',
`user_id` = '2',
`from` = 'BOT (Cha Sứ)',
`ip` = '1.0.0.0',
`ip_via_proxy` = '12345678',
`soft` = 'Iphon4S',
`text` = '" . mysql_real_escape_string($noidung) . "'
");
}
break;
case 'khong':
$arr = mysql_fetch_array(mysql_query("select * from `users` WHERE `love` = '".$datauser['name']."' LIMIT 1"));
echo 'Bạn không đồng ý lấy '.$arr['name'].'';
$noidung = 'Người ấy không đồng ý lấy bạn';
mysql_query("insert into `privat` values(0,'".$arr['name']."','" . $noidung . "','" .time(). "','Không đồng ý kết hôn','in','no','Đồng ý kết hôn','0','','','','" . mysql_real_escape_string($fname) . "');");
mysql_query("UPDATE `users` SET
`love`='' WHERE `name`='".$arr['name']."'");

break;
}

echo '<div class="phdr"><a href="../index.php">' . $lng['back'] . '</a></div>';
require_once('../incfiles/end.php');
?>
