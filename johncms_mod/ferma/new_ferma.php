<?php
define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
if(!$user_id)
{         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu"> Chỉ cho thành viên tham gia!</div>');
require_once ('../incfiles/end.php');
exit;
}
$total = mysql_result ( mysql_query ( "SELECT COUNT(*) FROM `ferma` WHERE `user` = '" .$user_id. "'" ), 0 );
if ($total==0){
$cena = $conf['cena_ferma'];
}else{
$cena = $total*$conf['cena_ferma'];
}          $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 1"));
if ($user['balans'] >= $cena)
{
$act = isset ( $_GET['act'] ) ? $_GET['act'] : NULL;
switch ($act){
default:
$textl = 'Xây dựng nông trại';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Thông báo!<br/>Khi xây dựng một nông trại tài khoản của bạn sẽ bị trừ ' .$cena. ' Xu</div>
<form action="new_ferma.php?act=new" method="post">
<div class="menu">Tên trang trại:<br/><input name="name" type="text" value=""/><br/>
<br/><input type="submit" name="submit" value="Xây dựng"/> </div></form>' );
break;
case 'new' :
if (isset($_POST['submit'])) {
$ima=htmlspecialchars(mysql_real_escape_string(trim($_POST['name'])));
if (empty($ima))
$error = $error . 'Chưa đặt tên!<br/>';
elseif (mb_strlen($ima) < 3 || mb_strlen($ima) > 15)
$error = $error . 'Tên không hợp lệ chiều dài<br />';
$req = mysql_query("SELECT * FROM `ferma` WHERE `name`='" . mysql_real_escape_string($ima) . "';");
if (mysql_num_rows($req) != 0) {
$error = 'Tên nông trại này đã có <br/>Chọn một tên nông trại khác.<br/>';
}
$textl = 'Xây dựng nông trại';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
if ($error) {
$textl = 'Ошибка';
require_once ("../incfiles/head.php");
echo '<div class="rmenu"><p>' . $error . '</p></div>';
require_once ("../incfiles/end.php");
exit;
}
mysql_query("UPDATE `users` SET `balans`=`balans`-'$cena' WHERE `id`='".$user_id."'");
mysql_query ( "INSERT INTO `ferma` ( `user`, `name`, `opyt`, `level`, `date`, `dohot` ) VALUES ('" .$user_id. "', '" .functions::check($ima). "', '0', '1', '" .time(). "', '0')" ) ? print "Nông trại đã xây dựng xong!" : print ( "Lỗi sozdananiya nông ( " . mysql_error () . ")" );
$fid = mysql_insert_id ();
echo ( '<div class="rmenu"><a href="ferma.php?id=' .$fid. '">Vào nông trại</a></div>' );
}
}
}else
{
$textl = 'Ошибка';
require_once ("../incfiles/head.php");
echo ( '<div class="rmenu"><p>' . $textl . '</p></div>' );
echo ( '<div class="rmenu">Bạn chưa đủ ' .$cena. ' Xu.<br/></div>' );
}
require_once ('../incfiles/end.php');
?>
