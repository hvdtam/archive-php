<?php
# penalty for JohnCMS 3.xx
# Author: seg0ro http://mobilarts.ru
# Not for sale!

$headmod = 'penalty';
define('_IN_JOHNCMS', 1);
require_once ('../incfiles/core.php');
$textl = 'Suốt phạt';
require_once ("../incfiles/head.php");

if($user['balans']>=1000){
            echo 'bạn không đủ tiền VND';
            require_once('incfiles/end.php');
            exit;
        }
		
$goal = ($_SESSION['goal'] ? $_SESSION['goal'] : '0');
$attempt = ($_SESSION['attempt'] ? $_SESSION['attempt'] : '0');
$graph = $_SESSION['graph'];
switch ($act){

case'graph';
if ($graph)
$_SESSION['graph'] = 0;
else
$_SESSION['graph'] = 1;
header ("Location: index.php");
break;

case'reset';
$_SESSION['goal'] = 0;
$_SESSION['attempt'] = 0;
header ("Location: index.php");
break;

case 'kick': 
echo '<div class="phdr">Suốt phạt</div>';
if ($_POST['dir']){
$dir = rand(1, 4);
$_SESSION['attempt'] = $attempt + 1;
if ($dir == $_POST['dir']){
$goal2 = $datauser['balans'] - 1000;
mysql_query("UPDATE `users` SET `balans`= '$goal2', `lastpost` = '$realtime' WHERE `id` = '$user_id'");
echo '<div class="rmenu">Rất tiết thủ môn đã bắt bóng bạn sẽ bị trừ 1000 VND<br /><a href="?">Tiếp tục</a></div>';
}else{
$_SESSION['goal'] = $goal + 1;
$goal2 = $datauser['balans'] + 1350;
mysql_query("UPDATE `users` SET `balans`= '$goal2', `lastpost` = '$realtime' WHERE `id` = '$user_id'");
echo '<div class="gmemu">Ohyea vô rồi hay quá ta bạn sẽ đươc cộng 1350 VND!<br /><a href="?">Tiếp tục</a></div>';
}
}else{
echo display_error('Bạn đã không chọn hướng!<br /><a href="?">Quay lại</a>');
}
break;

default:
echo '<div class="phdr">Suốt phạt</div>';
echo '<form action="index.php?act=kick" method="post">';
echo '<div class="gmenu">CPU vs '.($user_id ? $login : 'Khách').'<br />Suốt vào '.$goal.' lần trong '.$attempt.' lần suốt</div>';
if ($graph){
echo '<div class="list1"><table width="108" height="100" style="border: 2px solid black;"><tr align="center" style="background: silver;"><td><input type="radio" value="1" name="dir" /> <b>9</b></td><td><b>9</b> <input type="radio" value="2" name="dir" /></td></tr><tr align="center" style="background: silver;"><td><input type="radio" value="3" name="dir" /> <b>6</b></td><td><b>6</b> <input type="radio" value="4" name="dir" /></td></tr><tr><td colspan="2" align="center" style="background: green;"><input type="submit" name="submit" value="Suốt" /></td></tr></table></div>';
echo '<small><div class="b">Bạn hãy chọn hướng rồi ấn nút "Suốt"<br />Để ghi điểm nha!</div></small>';
}else{
echo '<div class="list1"><table width="108" height="100" style="color: white; background-image: url(../penalty/images/gate.gif);" border="0"><tr align="center"><td><input type="radio" value="1" name="dir" /> <b>9</b></td><td><b>9</b> <input type="radio" value="2" name="dir" /></td></tr><tr align="center"><td><input type="radio" value="3" name="dir" /> <b>6</b></td><td><b>6</b> <input type="radio" value="4" name="dir" /></td></tr><tr><td colspan="2" align="center" valign="bottom"><input type="image" name="submit" src="../penalty/images/ball.png" /></td></tr></table></div>';
echo '<small><div class="b">Bạn hãy hướng rồi ấn vào hình quả bóng<br />Để ghi điểm nha!</div></small>';
}
echo '</form>';
echo '<div class="rmenu"><a href="index.php?act=reset">Thiết lập lại</a><br /><a href="index.php?act=graph">'.($graph ? 'Mở' : 'Tắt').' Hình ảnh</a></div>';
}
require_once ("../incfiles/end.php");
?>