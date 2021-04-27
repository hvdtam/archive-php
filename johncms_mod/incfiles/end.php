<?php
/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/
defined('_IN_JOHNCMS') or die('Error: restricted access');
// Рекламный блок сайта
if (!empty($cms_ads[2]))
echo '<div class="gmenu">' . $cms_ads[2] . '</div>';
echo '</div><a>';
if ($headmod != "mainpage" || ($headmod == 'mainpage' && $act))
echo '<a>';
// Счетчик посетителей онлайн
echo '</div><div class="phdr">' . counters::online() . '</div>';
function show_online($user = array(), $status = 0, $ip = 0, $str = '', $text = '', $sub = '') {
global $set_user,$realtime, $user_id, $admp, $home;
$out = false;
if ($user['rights'] == 0 ) {
$colornick['colornick'] = '000000';
$colornickk['colornick'] = '000000';
}
if ($user['rights'] == 1 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($user['rights'] == 2 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($user['rights'] == 3 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($user['rights'] == 4 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($user['rights'] == 5 ) {
$colornick['colornick'] = '008000';
$colornickk['colornick'] = '008000';
}
if ($user['rights'] == 6 ) {
$colornick['colornick'] = '0000ff';
$colornickk['colornick'] = '0000ff';
}
if ($user['rights'] == 7 ) {
$colornick['colornick'] = 'ff0000';
$colornickk['colornick'] = 'ff0000';
}
if ($user['rights'] == 9 ) {
$vip['vip'] = '<span style="color: rgb(255, 0, 0); repeat scroll 0% 0% transparent;" border="0">';
$vip1['vip1'] = '</span>';
}
if ($user['rights'] == 10 ) {
$vip['vip'] = '<span style="color: rgb(255, 0, 0);  repeat scroll 0% 0% transparent;" border="0">';
$vip1['vip1'] = '</span>';
}
$out .= !$user_id || $user_id == $user['id'] ? '<a href="../users/profile.php?user=' . $user['id'] . '"><span style="color:#' . $colornick['colornick'] . '">' .$vip['vip']. '' . $user['name'] . '' .$vip1['vip1']. '</span></a>' : '<a href="../users/profile.php?user=' . $user['id'] . '"><span style="color:#' . $colornickk['colornick'] . '">' .$vip['vip']. '' . $user['name'] . '' .$vip1['vip1']. '</span></a>';
return $out;
}
function timecount($var) {
if ($var < 0)
$var = 0;
$day = ceil($var / 86400);
if ($var > 345600) {
$str = $day . ' Giờ';
}  elseif ($var >= 172800) {
$str = $day . ' Рhút';
}  elseif ($var >= 86400) {
$str = '1 Giây';
} else {
$str = gmdate('G:i:s', $var);
}
return $str;
}
$on = $_GET['on'];
switch($on) {
default:
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `lastdate` > '" . (time() - 300) . "'"), 0);
if ($total > 0)
{
echo '<div class="gmenu"><p>';
echo '<div>';
$onltime = '".time() - 300."';
$gbot = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
$yanbot = 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)';
$bing = 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)';
$msn = 'msnbot/1.1 (+http://search.msn.com/msnbot.htm)';
$bd = 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)';
$DCM = 'DoCoMo/2.0 N905i(c100;TB;W24H16) (compatible; Googlebot-Mobile/2.1; +http://www.google.com/bot.html)';
$yahoo = 'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)';
$Ahrefs = 'Mozilla/5.0 (compatible; AhrefsBot/3.1; +http://ahrefs.com/robot/)';
$Sosos = 'Sosospider+(+http://help.soso.com/webspider.htm)';

$googlebot = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$gbot'"), 0);
$yandexbot = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$yanbot'"), 0);
$bingbot = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$bing'"), 0);
$baidu = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$msn'"), 0);
$msnbot = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$bd'"), 0);
$yahoobot = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$yahoo'"), 0);
$DoCoMo = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$DCM'"), 0);
$AhrefsBot = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$Ahrefs'"), 0);
$Sosospider = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '$onltime' AND `browser`='$Sosos'"), 0);
$usere = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `lastdate` > '" . (time() - 300) . "'"), 0);
$tamune = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_sessions` WHERE `lastdate` > '" . (time() - 300) . "'"), 0);
$total = $total+$googlebot+$msnbot+$yandexbot+$bingbot+$yahoobot+$baidu+$DoCoMo+$AhrefsBot+$Sosospider+$usere+$tamune;
if ($total) {
echo '<a>'.($googlebot > 2 ? '<font color="red">Google</font>, ' : '').''.($yandexbot > 2 ? '<font color="117cd6">Yandex</font>, ' : '').''.($bingbot > 2 ? '<font color="red">Bing</font>, ' : '').''.($baidu > 2 ? '<font color="1d942e">Baidu</font>, ' : '').''.($msnbot > 2 ? '<font color="c4a916">MSN</font>, ' : '').''.($yahoobot > 2 ? '<font color="b70db9">Yahoo</font>, ' : '').''.($DoCoMo > 2 ? '<a>' : '').''.($AhrefsBot > 2 ? '<font color="red">AhrefsBot</font>, ' : '').''.($Sosospider > 2 ? '<font color="0d66b9">Soso</font>, ' : '').'';
}

$req = mysql_query("SELECT * FROM `" . ($act == 'guest' ? 'cms_guests' : 'users') . "` WHERE `preg`='1' and `lastdate` > '" . (time() - 300) . "' ORDER BY " . ($act == 'guest' ? "`movings` DESC" : "`name` ASC") . " LIMIT 1000");
while ($res = mysql_fetch_assoc($req)) {
echo show_online($res, 0, ($act == 'guest' || ($rights >= 1 && $rights >= $res['rights']) ? ($rights >= 6 ? 2 : 1) : 0), ' (' . $res['movings'] . ' - ' . timecount($realtime - $res['sestime']) . ') ' . $place);
echo ', ';
++$l;
}
echo'</p></div>';
}
else {
echo '<div class="menu"><p>Không ai thành viên nào online!</p></div>';
}
break;
}
echo'</b>';
echo '<div style="text-align:center">';
//echo '<p><b>' . $set['copyright'] . '</b></p>';
// Счетчики каталогов quang cao duoi day
// Рекламный блок сайта
if (!empty($cms_ads[3]))
echo '<br />' . $cms_ads[3];
/*
-----------------------------------------------------------------
ВНИМАНИЕ!!!
Данный копирайт нельзя убирать в течение 60 дней с момента установки скриптов
-----------------------------------------------------------------
ATTENTION!!!
The copyright could not be removed within 60 days of installation scripts
-----------------------------------------------------------------
*/
echo '
<a>';
echo '</div></body></html>';
?>
