<?php
define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
if(!$user_id)
{         $textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Game chỉ cho thành viên tham gia!</div>');
require_once ('../incfiles/end.php');
exit;
}
$act = isset ( $_GET['act'] ) ? $_GET['act'] : NULL;
switch ($act){
default:
$textl = 'Nông trại vui vẻ';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
$query = mysql_query ( "SELECT * FROM `ferma` WHERE `user`='" .$user_id. "' ORDER BY `date` DESC LIMIT " .$start. ", " . $kmess );
if(mysql_num_rows($query ) == 0){
echo ('<div class="rmenu">Bạn chưa có nông trại</div>');
} else
while($row = mysql_fetch_array($query ))
{
if ($row['mesto'] == 1){ $img = '<img src="img/mesto1.png" alt="+"/>';}
if ($row['mesto'] == 2){ $img = '<img src="img/mesto2.png" alt="+"/>';}
if ($row['mesto'] == 3){ $img = '<a>';}
echo ( '<div class="menu">Tên: <b>'.$row['name'].'</b> cấp '.$row['level'].'' );
if ($row['mesto'] > 0){echo ( '<br/>' );}
echo ( '<br/><a href="ferma.php?id=' .$row['id']. '">Vào xem </a><br/><a href="index.php?act=del&amp;id='.$row['id'].'">Bán nông trại</a></div>' );
}
$total = mysql_result ( mysql_query ( "SELECT COUNT(*) FROM `ferma` WHERE `user` = '" .$user_id. "'" ), 0 );
if ($total > $kmess) {
echo '<p>' . pagenav('index.php?', $start, $total, $kmess) . '</p>';
}
$guest = mysql_result ( mysql_query ( "SELECT COUNT(*) FROM `ferma_guest` WHERE `id` > '0'" ), 0 );
echo ( '<hr/><div class="rmenu"><br/><img src="img/ico.png" alt="+"/> <a href="/chat">Chat</a> [' .$guest. ']<br/>
<img src="img/star.gif" alt="+"/> <a href="top.php">Top ViP</a><br/>
<img src="img/bank.gif" alt="+"/> <a href="bank.php">Ngân hàng</a><br/><img src="img/money.png" alt="+"/> <a href="new_ferma.php">Tạo Nông trại</a><br/><img src="img/info.png" alt="+"/> <a href="new.php">Nông trại mới</a><br/> <br/><img src="img/info.png" alt="+"/> <a href="faq.php">Trợ giúp</a><br/> </div><div class="phdr">Tổng số nông trại của bạn: ' .$total. '</div>' );
if ($rights == 3 || $rights >= 6) {
echo ( '<div class="phdr"></div>' );
}
break;
case 'del' :
$id = intval ( $_GET['id'] ) ? ( int ) $_GET['id'] : NULL;
$ferma = mysql_fetch_assoc(mysql_query("SELECT * FROM `ferma` WHERE `id` = '$id' LIMIT 1"));
if(mysql_num_rows(mysql_query ( "SELECT * FROM `ferma` WHERE `id`='" .$id. "' AND `user` = '" .$user_id. "' LIMIT 1" )) == 0){
$textl = 'Ошибка';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Đây không phải nông trại</div>' );
require_once ('../incfiles/end.php');
exit;
}
if ($ferma['user'] == $user_id && $ferma['id'] == $id){
$textl = 'Phá?';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
if ( isset ( $_GET['yes'] ) )
{
mysql_unbuffered_query ( "DELETE FROM `ferma` WHERE `id`='" .$id. "'" );
echo ( '<div class="rmenu">Phá nông trại xong!</div>' );
exit;}
echo 'Bạn có muốn phá nông trại? <a href="index.php?act=del&amp;id=' .$id. '&amp;yes">Đồng ý/a> <a href="index.php?">Không</a>';
require_once ('../incfiles/end.php');exit;
}else
{
$textl = 'Ошибкa';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Đây không phải nông trại của bạn, bạn không thể phá!</div>' );
break;
}
}
require_once ('../incfiles/end.php');
?>
