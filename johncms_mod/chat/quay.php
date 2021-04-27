<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                Mobile Content Management System                    //
// Project site:          http://johncms.com                                  //
// Support site:          http://gazenwagen.com                               //
////////////////////////////////////////////////////////////////////////////////
// Lead Developer:        Oleg Kasyanov   (AlkatraZ)  alkatraz@gazenwagen.com //
// Development Team:      Eugene Ryabinin (john77)    john77@gazenwagen.com   //
//                        Dmitry Liseenko (FlySelf)   flyself@johncms.com     //
////////////////////////////////////////////////////////////////////////////////
*/

define('_IN_JOHNCMS', 1);
$topic = '4174';
$time = time()+5;
$idbot = '2';
if(preg_match('|Quay|',$msg) ||preg_match('|quay|',$msg) ||preg_match('|QUAY|',$msg)) {
if($datauser['balans'] < 1000) {
$quay = '[red]'.$login.'[/red] ko đủ tiền để quay đâu nhé!';
} else {
$rand = rand(1000, 9999);
$card = rand(1111111111111, 9999999999999);
$quay = '[red]'.$login.'[/red] quay được số [red]'.$rand.'[/red] chúc may mắn lần sau! BOT đã lấy của [red]'.$login.'[/red] 1.000xu!';
mysql_query("UPDATE users SET balans=balans+1000 WHERE id=2 LIMIT 1");
mysql_query("UPDATE users SET balans=balans-1000 WHERE id='$user_id' LIMIT 1");
if(preg_match('|9999|',$rand)) {
$quay = '[red]'.$login.'[/red] quay đc số [red]'.$rand.'[/red]! Xin chúc mừng đã trúng giải biệt của chương trình quay số may mắn! Mở hộp thư nhận thưởng nhé!';
$msg = 'Xin chúc mừng bạn đã quay đc giải biệt của chương trình quay số may mắn! Giải thưởng 1.000.000xu !';
mysql_query("UPDATE users SET balans=balans+1001000 WHERE id='$user_id' LIMIT 1");
mysql_query("insert into `privat` values(0,'" . $login . "','".$msg."','" . $realtime . "','BOT','in','no','Giải thưởng quay số','0','','','',0);");
$sent = '[red]'.$login.'[/red] đã trúng 1000000xu do tham gia chương trình quay số may mắn vào ngày '.date('d/m', time()).'! BOT đã thanh toán!';
$time = time();
mysql_query("INSERT INTO `forum` SET
`refid`='$topic',
`type` = 'm',
`time` = '$realtime',
`user_id` = '2',
`from` = 'BOT',
`ip` = '1.2.3.4.1',
`soft` = 'BOT BROWSER 1.0',
`text` = '" . mysql_real_escape_string($sent) . "'") or die('BOT ko thể xử lý');
// Обновляем время топика
mysql_query("UPDATE `forum` SET `time` = '$realtime' WHERE `id` = '$topic' LIMIT 1") or die('Không thể cập nhật');
// Обновляем статистику юзера
mysql_query("UPDATE `users` SET
`postforum`=`postforum`+1,
`balans`=`balans`+100,
`lastpost` = '$time'
WHERE `id` = '2'
");
} else {
if(preg_match('|999|',$rand)) {
$quay = 'zeze [red]'.$login.'[/red] đã quay đc số [red]'.$rand.'[/red]! Xin chúc mừng đã quay đc giải nhất của chương trình quay số may mắn! Giải thưởng gồm 100.000xu ! Cảm ơn!';
$sent = '[red]'.$login.'[/red] đã trúng 100.000xu do tham gia chương trình quay số may mắn vào ngày '.date('d/m', time()).'! BOT đã thanh toán!';
$time = time();
mysql_query("UPDATE users SET balans=balans+101000 WHERE id='$user_id' LIMIT 1");
mysql_query("INSERT INTO `forum` SET
`refid`='$topic',
`type` = 'm',
`time` = '$realtime',
`user_id` = '2',
`from` = 'BOT',
`ip` = '1.2.3.4.1',
`soft` = 'BOT BROWSER 1.0',
`text` = '" . mysql_real_escape_string($sent) . "'") or die('BOT ko thể xử lý');
// Обновляем время топика
mysql_query("UPDATE `forum` SET `time` = '$realtime' WHERE `id` = '$topic' LIMIT 1") or die('Không thể cập nhật');
// Обновляем статистику юзера
mysql_query("UPDATE `users` SET
`postforum`=`postforum`+1,
`balans`=`balans`+100,
`lastpost` = '$time'
WHERE `id` = '2'
");
} else {
if(preg_match('|99|',$rand)) {
$quay = 'ồ. [red]'.$login.'[/red] quay đc số [red]'.$rand.'[/red]! Xin chúc mừng đã quay đc giải nhì của chương trình quay số may mắn! Giải thưởng 50.000xu ! cảm ơn bạn đã tham gia!';
$sent = '[red]'.$login.'[/red] đã trúng 10000xu do tham gia chương trình quay số may mắn vào ngày '.date('d/m', time()).'! BOT đã thanh toán!';
$time = time();
mysql_query("UPDATE users SET balans=balans+51000 WHERE id='$user_id' LIMIT 1");
mysql_query("INSERT INTO `forum` SET
`refid`='$topic',
`type` = 'm',
`time` = '$realtime',
`user_id` = '2',
`from` = 'BOT',
`ip` = '1.2.3.4.1',
`soft` = 'BOT BROWSER 1.0',
`text` = '" . mysql_real_escape_string($sent) . "'") or die('BOT ko thể xử lý');
// Обновляем время топика
mysql_query("UPDATE `forum` SET `time` = '$realtime' WHERE `id` = '$topic' LIMIT 1") or die('Không thể cập nhật');
// Обновляем статистику юзера
mysql_query("UPDATE `users` SET
`postforum`=`postforum`+1,
`balans`=`balans`+100,
`lastpost` = '$time'
WHERE `id` = '2'
");
} else {
if(preg_match('|00|',$rand) ||preg_match('|11|',$rand) ||preg_match('|22|',$rand) ||preg_match('|33|',$rand) ||preg_match('|44|',$rand) ||preg_match('|55|',$rand) ||preg_match('|66|',$rand) ||preg_match('|77|',$rand) ||preg_match('|88|',$rand)) {
$quay = 'à zí ạ zị. [red]'.$login.'[/red] quay đc số [red]'.$rand.'[/red]! Xin chúc mừng [red]'.$login.'[/red] đã quay đc giải ba của chương trình quay số may mắn! BOT đã send 10.000xu cho [red]'.$login.'[/red] rồi đấy!';
mysql_query("UPDATE users SET balans=balans+11000 WHERE id='$user_id' LIMIT 1");
$sent = '[red]'.$login.'[/red] đã trúng 10000xu do tham gia chương trình quay số may mắn vào ngày '.date('d/m', time()).'! BOT đã thanh toán!';
$time = time();
mysql_query("INSERT INTO `forum` SET
`refid`='$topic',
`type` = 'm',
`time` = '$realtime',
`user_id` = '2',
`from` = 'BOT',
`ip` = '1.2.3.4.1',
`soft` = 'BOT BROWSER 1.0',
`text` = '" . mysql_real_escape_string($sent) . "'") or die('BOT ko thể xử lý');
// Обновляем время топика
mysql_query("UPDATE `forum` SET `time` = '$realtime' WHERE `id` = '$topic' LIMIT 1") or die('Không thể cập nhật');
// Обновляем статистику юзера
mysql_query("UPDATE `users` SET
`postforum`=`postforum`+1,
`balans`=`balans`+100,
`lastpost` = '$time'
WHERE `id` = '2'
");
}
}
}
}
}
}
if($quay) {
mysql_query("INSERT INTO `guest` SET
`adm` = '$admset',
`time` = '$time',
`user_id` = '$idbot',
`name` = 'BOT',
`text` = '" . mysql_real_escape_string($quay) . "',
`ip` = '60543201',
`browser` = 'Iphone'
");
}
?>
