<?php

define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
$user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 1"));
$act = isset ( $_GET['act'] ) ? $_GET['act'] : NULL;

switch ($act){

default:

if(!$user_id)
{         $textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Chỉ cho thành viên tham gia!</div>');

require_once ('../incfiles/end.php');
exit;
}
$textl = 'Ngân hàng';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( 'Xin chào <b> ' . $login . '</b> thân yêu!
<br/>Chào mừng bạn đến với TaMk Bank, nơi đổi tiền
và giao dịch đơn vị tiền nông nghiệp của Nông Trại Vui Vẻ.
<br/>
Bạn có <b>'.$user['balans'].'</b> $VND<br/>
Ban có: <b>'.$user['balans'].'</b> Xu<br/>Bạn có thể đổi 1 VND thành '.$conf['kurs']. ' xu để mua cây giống và phân bón.<br/>
<form action="bank.php?act=change" method="post">
Nhập số VND muốn đổi sang Xu:<br/><input name="num" type="text" value="' .$user['balans']. '"/><br/>
<input type="submit" value="Đổi"/></form><br/>
Bạn có thể đổi Xu sang VND <br/>
Từ '.$conf['kurs2']. ' Xu có thể đổi thành 1 VND  <br/>
<form action="bank.php?act=change2" method="post">Nhập số Xu muốn đổi sang VND:<br/><input name="money" type="text" value="' .$user['balans']. '"/><br/><input type="submit" value="Đổi"/></form>' );

break;


case 'change2':

$textl = 'Giao dịch';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
$money = abs(intval($_POST['balans']));

if(!$money){

echo ( 'Поле не заполнино!' );

echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại Ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;};

if($user['balans']<=$money){
echo ( 'У вас нет столько монет!' );
echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại Ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;
}
if($user['balans']<=$conf['kurs2']){
echo ( 'Bạn không có đủ tiền xu, bạn nên có tối thiểu ' .$conf['kurs2']. 'Xu !' );

echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại Ngân hàng</a></div>' );exit;
}
$baks = $money/$conf['kurs2'];
mysql_query("UPDATE `users` SET `balans`=`balans`+$baks, `balans`=`balans`-$money WHERE `id`='".$user_id."'");
echo 'Giao dịch thành công ! <a href="bank.php">Quay lại ngân hàng</a><br/>';
echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại Ngân hàng</a></div>' );break;


case 'change':
$textl = 'Giao dịch';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');

$num = abs(intval($_POST['num']));

if(!$num){
echo ( 'Поля не заполнино!' );

echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại ngân hàng</a></div>' );exit;
}

if($user['balans'] <= $num){
echo ( 'Bạn có quá nhiều VND!' );

echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;
}


if($user['balans']== 0){
echo ( 'Bạn không có đủ VND, bạn nên có ít nhất 1 VND !' );

echo ( '<div class="menu">
<a href="/ferma/bank.php?">Quay lại ngân hàng</a></div>' );require_once ('../incfiles/end.php');
exit;}
$baks=$num*$conf['kurs'];
mysql_query("UPDATE `users` SET `balans`=`balans`+'$baks',`balans`=`balans`-'$num' WHERE `id`='".$user_id."'");
echo 'Giao dịch thành công! ';
break;


};


echo ( '<div class="menu">
<a href="/ferma/index.php?">Khu nông trại</a></div>' );require_once ('../incfiles/end.php');



?>
