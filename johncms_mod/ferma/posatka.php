<?php

define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
$id = intval ($_GET['id']);
if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Chỉ cho thành viên đăng ký tham gia!</div>');

require_once ('../incfiles/end.php');
exit;
}


$user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 1"));

$total = mysql_result ( mysql_query ( "SELECT COUNT(*) FROM `gratka` WHERE `ferma`='" .$id. "'" ), 0 );


$ferma = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '$id' LIMIT 1"));

if(mysql_num_rows(mysql_query ( "SELECT * FROM `ferma` WHERE `id`='" . $id . "' AND `user` = '" .$user_id. "' LIMIT 1" )) == 0){
$textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Đây không phải trang trại</div>' );
echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );

require_once ('../incfiles/end.php');

exit;
}
/*
if(!preg_match("|^[\d]+$|",$_GET['id']))
{         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="bmenu">Yêu cầu định dạng không hợp lệ! Kiểm tra URL!</div>');

require_once ('../incfiles/end.php');

exit;
}
*/

if ($total == 3 && $ferma['level'] == 1){         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );
echo ( '<div class="menu">
<a href="/ferma/index.php?">khu nông trại</a></div>' );
require_once ('../incfiles/end.php');

exit; }

if ($total == 6 && $ferma['level'] == 2){         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );
echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );

require_once ('../incfiles/end.php');

exit;}

if ($total == 9 && $ferma['level'] == 3){         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );
echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );

require_once ('../incfiles/end.php');
exit;}

if ($total == 12 && $ferma['level'] == 4){         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );

echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php');
exit;
}

if ($total == 15 && $ferma['level'] == 5){         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );
echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );

require_once ('../incfiles/end.php');
exit;}

if ($total == 18 && $ferma['level'] == 6){
$textl = 'Oshica';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );

echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php');
exit;}
if ($total == 21 && $ferma['level'] == 7){
$textl = 'Oshica';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );
echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );

exit;}
if ($total == 24 && $ferma['level'] == 8){
$textl = 'Oshica';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );

echo ( '<div class="menu">

<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php');
exit;}

if ($total == 27 && $ferma['level'] == 9){         $textl = 'Oshika';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Nông trại có cấp độ quá thấp</div>' );
echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );

require_once ('../incfiles/end.php');
exit;}
$act = isset ( $_GET['act'] ) ? $_GET['act'] : NULL;

switch ($act){

default:

if ($ferma['user'] == $user_id) {
$textl = 'Mua cây giống';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">Mua cây giống</div>');


echo ( 'Hãy mua loại giống tương ứng với số tiền và lever của bạn<br/>
Loại cây - Giá - Thời gian thu hoạch.<br/>

<form action="posatka.php?act=ok&amp;id=' .$id. '" method="post"><div class="menu">' );
echo ( '
Chọn cây giống:
<select name="ima">' );

$query = mysql_query ( "SELECT * FROM `semena` WHERE `level` <= '" . $ferma['level'] . "'");
while($row = mysql_fetch_array($query )){
$time = $row['date']*60;
echo ( '<option value="' .$row['id']. '">Cây: ' .$row['name']. ' Giá:' .$row['cena']. ' Thu hoạch sau:' .$time. 'giây</option>' );
}
echo ( '<br/>
<input type="submit" value="Mua"/></div></form><br/>' );
}
break;
case 'ok' :


//////Вредители!!

if ($ferma['level'] <= 5)
{
$vred = rand (0,8) ;
}

if ( $ferma['level'] > 6  )
{
$vred = rand (0,15) ;
}
/////////Вредители!!!



$textl = 'Mua cây giống';        require_once ('../incfiles/head.php');echo ('<div class="phdr">' .$textl.'</div>');
$ima = intval ( $_POST['ima'] );
$semena = mysql_fetch_assoc(mysql_query("SELECT * FROM `semena` WHERE `id` = '" .$ima. "' LIMIT 1"));

if ($ferma['level'] >= $semena['level'] && $user['balans'] >= $semena['cena']) {

mysql_query("UPDATE `users` SET `balans`=`balans`-'" .$semena['cena']. "' WHERE `id`='".$user_id."'");
mysql_query ( "INSERT INTO `gratka` ( `ferma`, `name`, `date`, `date2`, `dohot`, `semid`,`vred` ) VALUES ('" .$id. "', '" .$semena['name']. "', '" .time(). "', '" .(time() +$semena['date']). "', '" .$semena['cena2']."', '" .$semena['id']. "', '" .$vred."')" );

mysql_query("UPDATE `ferma` SET `dohot`=`dohot`+'" .$semena['cena2']. "' WHERE `id`='".$id."'");

mysql_query("UPDATE `users` SET `balans`=`balans`+'".$semena['cena2']."' WHERE `id`='".$user_id."'");
echo ( '<div class="rmenu">Giao dịch thành công</div>' );
}
else {
echo ( '<div class="rmenu"> Bạn không có đủ tiền để mua cây giống này</div>' );
}


}

echo ( '<div class="menu">
<a href="/ferma/ferma.php?id=' .$id. '">Nông trại của bạn</a><br/>
<a href="/ferma/index.php?">Khu nông trại</a></div>' );
require_once ('../incfiles/end.php');

?>
