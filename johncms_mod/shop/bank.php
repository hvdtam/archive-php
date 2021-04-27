<?php
define('_IN_JOHNCMS', 1);
$headmod = 'Ngân hàng';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
$user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = '$user_id' LIMIT 1"));
$act = isset ( $_GET['act'] ) ? $_GET['act'] : NULL;
switch ($act){
default:
if(!$user_id)
{         $textl = 'Bó tay';
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
<br/>Chào mừng bạn đến với Ngân hàng tamk! Nơi mua bán,
giao dịch tiền VND, Mana và VGold
<br/><div class="gmenu">
Bạn có <b>'.$user['vgold'].'</b> VGold<br/>
Ban có: <b>'.$user['balans'].'</b> VND</div>
<div class="list1">
Bạn có thể bán 1 VGold để lấy '.$conf['kurs']. ' VND.<br/>
<form action="bank.php?act=change" method="post">
Nhập số VGold muốn bán:<br/><input name="num" type="text" value=""/><br/>
<input type="submit" value="Bán"/></form></div>
<div class="list1">
Bạn cũng có thể dùng VND để mua VGold<br/>
Cần '.$conf['kurs2']. ' VND để mua được 1 VGold  <br/>
<form action="bank.php?act=change2" method="post">Nhập số Vgold muốn mua:<br/>
<input name="money" type="text" value=""/><br/>
<input type="submit" value="Mua"/></form></div>' );
break;
case 'change2':
$textl = 'Giao dịch';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
$money = abs(intval($_POST['money']));
if(!$money){
echo ( 'Sai!!!' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;};
if($user['balans']<=$money*$conf['kurs2']){
echo ( 'Không đủ VND để mua số VGold!' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;
}
if($user['balans']<=$conf['kurs2']){
echo ( 'Bạn không có đủ tiền VND, bạn nên có tối thiểu ' .$conf['kurs2']. 'VND !' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );exit;
}
$baks = $money*$conf['kurs2'];
mysql_query("UPDATE `users` SET `vgold`=`vgold`+$money, `balans`=`balans`-$baks WHERE `id`='".$user_id."'");
echo 'Giao dịch thành công ! <a href="/shop/bank.php">Quay lại ngân hàng</a><br/>';
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );break;
/////////////////////////////////////////////////
case 'change3':
$textl = 'Giao dịch';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
$mana = abs(intval($_POST['mana']));
if($user['balans']<=$mana*$conf['dsm']){
echo ( 'Hơ! Phải chừa lại 1 ít VND chứ!' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;
}
if($user['balans']<=$conf['dsm']){
echo ( 'Bạn không có đủ tiền VND, bạn nên có tối thiểu '.$conf['dsm']. ' VND !' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );exit;
}
$baks = $mana*$conf['dsm'];
mysql_query("UPDATE `users` SET `mana`=`mana`+$mana, `balans`=`balans`-$baks WHERE `id`='".$user_id."'");
echo 'Giao dịch thành công ! <a href="/shop/bank.php">Quay lại ngân hàng</a><br/>';
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại Ngân hàng</a></div>' );break;
/////////////////////////////////////
case 'change':
$textl = 'Giao dịch';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
$num = abs(intval($_POST['num']));
if(!$num){
echo ( 'Sai!!!' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại ngân hàng</a></div>' );exit;
}
if($user['vgold'] <= $num){
echo ( 'Không đủ VGold!' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;
}
if($user['vgold']== 0){
echo ( 'Bạn không có đủ Vgold, bạn nên có ít nhất 1 VGold !' );
echo ( '<div class="menu">
<a href="/shop/bank.php?">Quay lại ngân hàng</a></div>' );
require_once ('../incfiles/end.php');
exit;}
$baks=$num*$conf['kurs'];
mysql_query("UPDATE `users` SET `balans`=`balans`+'$baks',`vgold`=`vgold`-'$num' WHERE `id`='".$user_id."'");
echo 'Giao dịch thành công!';
break;
};
echo ( '<div class="menu">
<a href="/shop/bank.php?">Ngân Hàng</a></div>' );
require_once ('../incfiles/end.php');
?>
