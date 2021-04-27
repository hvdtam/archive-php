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
if(isset($_POST['submit'])){

if(empty($_POST['lydo'])){
echo 'Bạn chưa nhập lý do ly hôn<div class="list1"><a href="?">Quay lại</a></div>';
}
elseif($datauser['balans'] < 15000)
{
echo 'Bạn không đủ tiền để ly hôn<br/><div class="list1"><a href="?">Quay lại</a></div>';
}
else
{
$noidung = ''.$datauser['name'].' muốn chia tay với bạn vì '.$_POST['lydo'].'
             Bạn có đồng ý không?<br/>
            <font color="red"><a href="../mod/lyhon.php?act=dongy">Đồng ý</a>  <a href="../mod/lyhon.php?act=khong">Không đồng ý</a></font>';
mysql_query("insert into `privat` values(0,'".$datauser['love']."','" . $noidung . "','" .time(). "','Ly Hôn','in','no','Giấy chia tay','0','','','','" . mysql_real_escape_string($fname) . "');");
mysql_query("UPDATE `users` SET
`balans`=`balans` - 15000 WHERE `id`='".$user_id."'");
$bot =''.$datauser['name'].' muốn chia tay '.$datauser['love'].' vì '.$_POST['lydo'].' ';
mysql_query("INSERT INTO `qchat` SET
`time`='" . time() . "',
`user_id`='2',
`text`='" . mysql_real_escape_string($bot) . "';");
echo 'Bạn vừa đề nghị chia tay';
}
}
else
{
echo 'Phí dịch vụ 15.000VNĐ để làm đơn ly hôn';
echo '
<center><h1>Đơn Ly Hôn</h1></center><br/>
' .
'<form method="post">' .
'Bạn :'. $datauser['name'].'' .
'<br/>Muốn ly hôn với:'. $datauser['love'].'' .
'<br/>Vì:<input type="text" name="lydo" value="" size="20"/>' .
'<br/>' .
'<input type="submit" value="Đồng ý" name="submit" /><br />' .
'</form>' .
'';
}
break;
case 'dongy':
$arr = mysql_fetch_array(mysql_query("select * from `users` WHERE `love` = '".$datauser['name']."' LIMIT 1"));

if($datauser['balans'] < 15000)
{
echo 'Bạn không đủ tiền để ly hôn<br/><div class="list1"><a href="?">Quay lại</a></div>';
}
elseif(empty($arr['name']))
{
echo 'Không có ai muốn kết hôn với bạn';
}
else
{
echo '<h1>Hai bạn đã ly hôn</h1>';
$bot =''.$datauser['love'].' vừa chia tay '.$datauser['name'].'';
mysql_query("UPDATE `users` SET
 `love`='' WHERE `name`='".$datauser['love']."'");
mysql_query("UPDATE `users` SET
`love`='' WHERE `id`='".$datauser['id']."'");
$noidung = ''.$datauser['name'].' đã đồng ý chia tay với bạn';
mysql_query("insert into `privat` values(0,'".$datauser['love']."','" . $noidung . "','" .time(). "','Đồng ý chia tay','in','no','Ly hôn','0','','','','" . mysql_real_escape_string($fname) . "');");

$time = time() + 86400;
mysql_query("INSERT INTO `qchat` SET
`time`='" . time() . "',
`user_id`='2',
`text`='" . mysql_real_escape_string($bot) . "';");
mysql_query("DELETE FROM `kethon` WHERE `vo`='" . $datauser['name'] . "' LIMIT 1;");
mysql_query("DELETE FROM `kethon` WHERE `chong`='" . $datauser['name'] . "' LIMIT 1;");
}
break;
case 'khong':
echo 'Bạn không đồng ý chia tay với '.$datauser['love'].'';
$noidung = 'Người ấy không dồng ý lấy bạn';
mysql_query("insert into `privat` values(0,'".$datauser['love']."','" . $noidung . "','" .time(). "','Không đồng ý ly hôn','in','no','Ly Hôn','0','','','','" . mysql_real_escape_string($fname) . "');");

break;
}

echo '<div class="phdr"><a href="../index.php">' . $lng['back'] . '</a></div>';
require_once('../incfiles/end.php');
?>