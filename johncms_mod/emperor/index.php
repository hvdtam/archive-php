<?php
define('_IN_JOHNCMS', 1);

$textl = 'Đế chế';
$headmod = 'emperor';

require_once ("../incfiles/core.php");if (!$user_id) {    require('../incfiles/head.php');    echo functions::display_error($lng['access_guest_forbidden']);    require('../incfiles/end.php');    exit;}
require_once ("../incfiles/head.php");

echo '<div class="phdr">Game trực tuyến</div>';

if ($ban['1'])
{
echo '<p>Đối với các bạn truy cập bị từ chối.</p>';
require_once ("../incfiles/end.php");
exit;
}

if ($user_id)
{

$ms = mysql_fetch_array(mysql_query("SELECT `id`
FROM `emperor_users`
WHERE user_id='" . $idus . "' LIMIT 1;"));

if ($ms['id'])
{
echo 'Chào mừng đến với trò chơi Đế chế của TK! Chào:' . $login . '<br />
<a href="game.php">Vào trò chơi>></a><br/>';

}
else
{
function profform()
{
echo '<b>Chào mừng đến với Đế chế!</b><br />Để bắt đầu trò chơi bạn nên tập làm quen với các quy tắc và tạo ra một profile trên diện thoại của bạn của bạn<br /><br />
<form action="index.php" method="post">
<input name="governed" type="checkbox" value="1"></input>
<a href="read.php?do=governed">Tôi đã đọc các quy tắc!</a><br />
<input type="submit" name="submit" value="Tạo Hồ Sơ"/><br /><br /></form>';
}

if (isset($_POST['submit']))
{
if (intval($_POST['governed']) != 1)
{
echo '<br /><b>LỖI!</b><br />Bạn nên đọc các điều lệ!!!<br /><br />';
profform();
}
else
{
$time_tax = $realtime + (12 * 60 * 60);
mysql_query("insert into `emperor_users` set
`user_id`='" . $idus . "',
`time_tax`='" . $time_tax . "';");

echo '<b>Xin chúc mừng!</b><br />Tạo hồ sơ thành công<br/>Bây giờ bạn có thể bắt đầu trò chơi
<br /><a href="game.php">Bắt đầu!>></a><br/>';
}
}
else
{
profform();
}
}
}

require_once ("../incfiles/end.php");

?>
