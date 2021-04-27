<?php

/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/

defined('_IN_JOHNCMS') or die('Restricted access');

class functions extends core
{
/*
-----------------------------------------------------------------
Антифлуд
-----------------------------------------------------------------
Режимы работы:
1 - Адаптивный
2 - День / Ночь
3 - День
4 - Ночь
-----------------------------------------------------------------
*/
public static function antiflood()
{
$default = array(
'mode' => 2,
'day' => 10,
'night' => 30,
'dayfrom' => 10,
'dayto' => 22
);
$af = isset(self::$system_set['antiflood']) ? unserialize(self::$system_set['antiflood']) : $default;
switch ($af['mode']) {
case 1:
// Адаптивный режим
$adm = mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `rights` > 0 AND `lastdate` > " . (time() - 300)), 0);
$limit = $adm > 0 ? $af['day'] : $af['night'];
break;
case 3:
// День
$limit = $af['day'];
break;
case 4:
// Ночь
$limit = $af['night'];
break;
default:
// По умолчанию день / ночь
$c_time = date('G', time());
$limit = $c_time > $af['day'] && $c_time < $af['night'] ? $af['day'] : $af['night'];
}
if (self::$user_rights > 0)
$limit = 4; // Для Администрации задаем лимит в 4 секунды
$flood = self::$user_data['lastpost'] + $limit - time();
if ($flood > 0)
return $flood;
else
return false;
}

/*
-----------------------------------------------------------------
Маскировка ссылок в тексте
-----------------------------------------------------------------
*/
public static function antilink($var)
{
$var = preg_replace('~\\[url=(https?://.+?)\\](.+?)\\[/url\\]|(https?://(www.)?[0-9a-z\.-]+\.[0-9a-z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', '###', $var);
$replace = array(
'.ru' => '***',
'.com' => '***',
'.biz' => '***',
'.cn' => '***',
'.in' => '***',
'.net' => '***',
'.org' => '***',
'.info' => '***',
'.mobi' => '***',
'.wen' => '***',
'.kmx' => '***',
'.h2m' => '***'
);
return strtr($var, $replace);
}

/*
-----------------------------------------------------------------
Проверка переменных
-----------------------------------------------------------------
*/
public static function check($str)
{
$str = htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
$str = nl2br($str);
$str = strtr($str, array(
chr(0) => '',
chr(1) => '',
chr(2) => '',
chr(3) => '',
chr(4) => '',
chr(5) => '',
chr(6) => '',
chr(7) => '',
chr(8) => '',
chr(9) => '',
chr(10) => '',
chr(11) => '',
chr(12) => '',
chr(13) => '',
chr(14) => '',
chr(15) => '',
chr(16) => '',
chr(17) => '',
chr(18) => '',
chr(19) => '',
chr(20) => '',
chr(21) => '',
chr(22) => '',
chr(23) => '',
chr(24) => '',
chr(25) => '',
chr(26) => '',
chr(27) => '',
chr(28) => '',
chr(29) => '',
chr(30) => '',
chr(31) => ''
));
$str = str_replace("'", "&#39;", $str);
$str = str_replace('\\', "&#92;", $str);
$str = str_replace("|", "I", $str);
$str = str_replace("||", "I", $str);
$str = str_replace("/\\\$/", "&#36;", $str);
$str = mysql_real_escape_string($str);
return $str;
}

/*
-----------------------------------------------------------------
Обработка текстов перед выводом на экран
-----------------------------------------------------------------
$br=1           обработка переносов строк
$br=2           подстановка пробела, вместо переноса
$tags=1         обработка тэгов
$tags=2         вырезание тэгов
-----------------------------------------------------------------
*/
public static function checkout($str, $br = 0, $tags = 0)
{
$str = htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
if ($br == 1)
$str = nl2br($str);
elseif ($br == 2)
$str = str_replace("\r\n", ' ', $str);
if ($tags == 1)
$str = tags(url($str));
elseif ($tags == 2)
$str = notags($str);
$replace = array(
chr(0) => '',
chr(1) => '',
chr(2) => '',
chr(3) => '',
chr(4) => '',
chr(5) => '',
chr(6) => '',
chr(7) => '',
chr(8) => '',
chr(9) => '',
chr(11) => '',
chr(12) => '',
chr(13) => '',
chr(14) => '',
chr(15) => '',
chr(16) => '',
chr(17) => '',
chr(18) => '',
chr(19) => '',
chr(20) => '',
chr(21) => '',
chr(22) => '',
chr(23) => '',
chr(24) => '',
chr(25) => '',
chr(26) => '',
chr(27) => '',
chr(28) => '',
chr(29) => '',
chr(30) => '',
chr(31) => ''
);
return strtr($str, $replace);
}

/*
-----------------------------------------------------------------
Показ различных счетчиков внизу страницы
-----------------------------------------------------------------
*/
public static function display_counters()
{
global $headmod;
$req = mysql_query("SELECT * FROM `cms_counters` WHERE `switch` = '1' ORDER BY `sort` ASC");
if (mysql_num_rows($req) > 0) {
while (($res = mysql_fetch_array($req)) !== false) {
$link1 = ($res['mode'] == 1 || $res['mode'] == 2) ? $res['link1'] : $res['link2'];
$link2 = $res['mode'] == 2 ? $res['link1'] : $res['link2'];
$count = ($headmod == 'mainpage') ? $link1 : $link2;
if (!empty($count))
echo $count;
}
}
}

/*
-----------------------------------------------------------------
Показываем дату с учетом сдвига времени
-----------------------------------------------------------------
*/
public static function display_date($var)
{
$shift = (self::$system_set['timeshift'] + self::$user_set['timeshift']) * 3600;
if (date('Y', $var) == date('Y', time())) {
if (date('z', $var + $shift) == date('z', time() + $shift))
return self::$lng['today'] . ', ' . date("H:i", $var + $shift);
if (date('z', $var + $shift) == date('z', time() + $shift) - 1)
return self::$lng['yesterday'] . ', ' . date("H:i", $var + $shift);
}
return date("d.m.Y / H:i", $var + $shift);
}

/*
-----------------------------------------------------------------
Сообщения об ошибках
-----------------------------------------------------------------
*/
public static function display_error($error = NULL, $link = NULL)
{
if (!empty($error)) {
return '<div class="rmenu"><p><b>' . self::$lng['error'] . '!</b><br />' .
(is_array($error) ? implode('<br />', $error) : $error) . '</p>' .
(!empty($link) ? '<p>' . $link . '</p>' : '') . '</div>';
} else {
return false;
}
}

/*
-----------------------------------------------------------------
Отображение различных меню
-----------------------------------------------------------------
$delimiter - разделитель между пунктами
$end_space - выводится в конце
-----------------------------------------------------------------
*/
public static function display_menu($val = array(), $delimiter = ' | ', $end_space = '')
{
return implode($delimiter, array_diff($val, array(''))) . $end_space;
}

/*
-----------------------------------------------------------------
Постраничная навигация
За основу взята аналогичная функция от форума SMF2.0
-----------------------------------------------------------------
*/
public static function display_pagination($base_url, $start, $max_value, $num_per_page)
{
$neighbors = 2;
if ($start >= $max_value)
$start = max(0, (int)$max_value - (((int)$max_value % (int)$num_per_page) == 0 ? $num_per_page : ((int)$max_value % (int)$num_per_page)));
else
$start = max(0, (int)$start - ((int)$start % (int)$num_per_page));
$base_link = '<a class="pagenav" href="' . strtr($base_url, array('%' => '%%')) . 'page=%d' . '">%s</a>';
$out[] = $start == 0 ? '' : sprintf($base_link, $start / $num_per_page, '&lt;&lt;');
if ($start > $num_per_page * $neighbors)
$out[] = sprintf($base_link, 1, '1');
if ($start > $num_per_page * ($neighbors + 1))
$out[] = '<span style="font-weight: bold;">...</span>';
for ($nCont = $neighbors; $nCont >= 1; $nCont--)
if ($start >= $num_per_page * $nCont) {
$tmpStart = $start - $num_per_page * $nCont;
$out[] = sprintf($base_link, $tmpStart / $num_per_page + 1, $tmpStart / $num_per_page + 1);
}
$out[] = '<span class="currentpage"><b>' . ($start / $num_per_page + 1) . '</b></span>';
$tmpMaxPages = (int)(($max_value - 1) / $num_per_page) * $num_per_page;
for ($nCont = 1; $nCont <= $neighbors; $nCont++)
if ($start + $num_per_page * $nCont <= $tmpMaxPages) {
$tmpStart = $start + $num_per_page * $nCont;
$out[] = sprintf($base_link, $tmpStart / $num_per_page + 1, $tmpStart / $num_per_page + 1);
}
if ($start + $num_per_page * ($neighbors + 1) < $tmpMaxPages)
$out[] = '<span style="font-weight: bold;">...</span>';
if ($start + $num_per_page * $neighbors < $tmpMaxPages)
$out[] = sprintf($base_link, $tmpMaxPages / $num_per_page + 1, $tmpMaxPages / $num_per_page + 1);
if ($start + $num_per_page < $max_value) {
$display_page = ($start + $num_per_page) > $max_value ? $max_value : ($start / $num_per_page + 2);
$out[] = sprintf($base_link, $display_page, '&gt;&gt;');
}
return implode(' ', $out);
}

/*
-----------------------------------------------------------------
Показываем местоположение пользователя
-----------------------------------------------------------------
*/
public static function display_place($user_id = '', $place = '')
{
global $headmod;
$place = explode(",", $place);
$placelist = parent::load_lng('places');
if (array_key_exists($place[0], $placelist)) {
if ($place[0] == 'profile') {
if ($place[1] == $user_id) {
return '<a href="' . self::$system_set['homeurl'] . '/users/profile.php?user=' . $place[1] . '">' . $placelist['profile_personal'] . '</a>';
} else {
$user = self::get_user($place[1]);
return $placelist['profile'] . ': <a href="' . self::$system_set['homeurl'] . '/users/profile.php?user=' . $user['id'] . '">' . $user['name'] . '</a>';
}
}
elseif ($place[0] == 'online' && isset($headmod) && $headmod == 'online') return $placelist['here'];
else return str_replace('#home#', self::$system_set['homeurl'], $placelist[$place[0]]);
}
else return '<a href="' . self::$system_set['homeurl'] . '/index.php">' . $placelist['homepage'] . '</a>';
}

/*
-----------------------------------------------------------------
Отображения личных данных пользователя
-----------------------------------------------------------------
$user          (array)     массив запроса в таблицу `users`
$arg           (array)     Массив параметров отображения
[lastvisit] (boolean)   Дата и время последнего визита
[stshide]   (boolean)   Скрыть статус (если есть)
[iphide]    (boolean)   Скрыть (не показывать) IP и UserAgent
[iphist]    (boolean)   Показывать ссылку на историю IP

[header]    (string)    Текст в строке после Ника пользователя
[body]      (string)    Основной текст, под ником пользователя
[sub]       (string)    Строка выводится вверху области "sub"
[footer]    (string)    Строка выводится внизу области "sub"
-----------------------------------------------------------------
*/
public static function display_user($user = false, $arg = false)
{
global $rootpath, $mod;
$out = false;

if (!$user['id']) {
$out = '<b>' . self::$lng['guest'] . '</b>';
if (!empty($user['name']))
$out .= ': ' . $user['name'];
if (!empty($arg['header']))
$out .= ' ' . $arg['header'];
} else {
if (self::$user_set['avatar']) {
$out .= '<div>';
if (file_exists(($rootpath . 'files/users/avatar/' . $user['id'] . '.png')))
$out .= '<a>';
else
$out .= '<a>';
$out .= '<a>';
}
if ($user['sex'])
$out .= '<div class="list">»
';
else
$out .= '<img src="' . self::$system_set['homeurl'] . '/images/del.png" width="12" height="12" align="middle" />&#160;';
if ($user['rights'] == 0 ) {
$colornick['colornick'] = '000000';
$colornickk['colornick'] = '000000';
}
if ($user['rights'] == 1 ) {
$colornick['colornick'] = '9900ff';
$colornickk['colornick'] = '9900ff';
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
$colornick['colornick'] = 'ff0000';
$colornickk['colornick'] = 'ff0000';
}
if ($user['rights'] == 10 ) {
$colornick['colornick'] = 'ff0000';
$colornickk['colornick'] = 'ff0000';
}
if ($user['rights'] == 10 ) {
$out .= !$user_id || $user_id == $user['id'] ? '<a
href="../users/profile.php?user=' . $user['id'] . '"><span style="color:
rgb(255, 0, 0); background: url(/images/6.gif) repeat scroll 0% 0%
transparent;" border="0"><b>' . $user['name'] . '
</b></span></a>' : '<a href="../users/profile.php?user=' .
$user['id'] . '"><span style="color: rgb(255, 0, 0); background:
url(/images/6.gif) repeat scroll 0% 0% transparent;"
border="0"><b>' . $user['name'] . ' </b></span></a>';
}else {

$out .= !$user_id || $user_id == $user['id'] ? '<a
href="../users/profile.php?user=' . $user['id'] . '"><span
style="color:#' . $colornick['colornick'] . '"><b>' . $user['name'] . '
</b></span></a>' : '<a href="../users/profile.php?user=' .
$user['id'] . '"><span style="color:#' . $colornickk['colornick'] .
'"><b>' . $user['name'] . ' </b></span></a>';
}
$rank = array(
0 => '<a>',
1 => '<a>',
3 => '<a>',
4 => '<a>',
6 => '<a>',
7 => '<a>',
9 => '<a>',
10 => '<a>'
);
$out .= ' ' . $rank[$user['rights']];
//    $out .= '<a>';
$out .= (time() > $user['lastdate'] + 300 ? '<font
color="black">♥</font>' : '<font color="red">♥</font>');
if (!empty($arg['header']))
$out .= ' ' . $arg['header'];
if (!isset($arg['stshide']) && !empty($user['status']))
$out .= '</div>';
if (self::$user_set['avatar'])
$out .= '</div></div>';
}
if (isset($arg['body']))
$out .= '<div>' . $arg['body'] . '</div>';
$ipinf = !isset($arg['iphide']) && (self::$user_rights || ($user['id'] && $user['id'] == self::$user_id)) ? 1 : 0;
$lastvisit = time() > $user['lastdate'] + 300 && isset($arg['lastvisit']) ? self::display_date($user['lastdate']) : false;
if ($ipinf || $lastvisit || isset($arg['sub']) && !empty($arg['sub']) || isset($arg['footer'])) {
$out .= '<div class="sub">';
if (isset($arg['sub']))
$out .= '<div>' . $arg['sub'] . '</div>';
if ($lastvisit)
$out .= '<div><span class="gray">' . self::$lng['last_visit'] . ':</span> ' . $lastvisit . '</div></div>';
$iphist = '';
if ($ipinf) {
$out .= '<div></div>' . $res['soft'] . '</div></div>' .
'</div></div></div> ';
$hist = $mod == 'history' ? '&amp;mod=history' : '';
$ip = long2ip($user['ip']);
if (self::$user_rights && isset($user['ip_via_proxy']) && $user['ip_via_proxy']) {
$out .= '<b class="red"><a href="' . self::$system_set['homeurl'] . '/' . self::$system_set['admp'] . '/index.php?act=search_ip&amp;ip=' . $ip . $hist . '">' . $ip . '</a></b> / ';
$out .= '<a href="' . self::$system_set['homeurl'] . '/' . self::$system_set['admp'] . '/index.php?act=search_ip&amp;ip=' . long2ip($user['ip_via_proxy']) . $hist . '">' . long2ip($user['ip_via_proxy']) . '</a>';
} elseif (self::$user_rights) {
$out .= '<a>';
} else {
$out .= $ip . $iphist;
}
if (isset($arg['iphist'])) {
$iptotal = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_users_iphistory` WHERE `user_id` = '" . $user['id'] . "'"), 0);
$out .= '<a>';
}
$out .= '</div></div>';
}
if (isset($arg['footer']))
$out .= $arg['footer'];
$out .= '</div></div>';
}
return $out;
}

/*
-----------------------------------------------------------------
Форматирование имени файла
-----------------------------------------------------------------
*/
public static function format($name)
{
$f1 = strrpos($name, ".");
$f2 = substr($name, $f1 + 1, 999);
$fname = strtolower($f2);
return $fname;
}

/*
-----------------------------------------------------------------
Получаем данные пользователя
-----------------------------------------------------------------
*/
public static function get_user($id = false)
{
if ($id && $id != self::$user_id) {
$req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id'");
if (mysql_num_rows($req)) {
return mysql_fetch_assoc($req);
} else {
return false;
}
} else {
return self::$user_data;
}
}

/*
-----------------------------------------------------------------
Транслитерация с Русского в латиницу
-----------------------------------------------------------------
*/
public static function rus_lat($str)
{
$replace = array(
'а' => 'a',
'б' => 'b',
'в' => 'v',
'г' => 'g',
'д' => 'd',
'е' => 'e',
'ё' => 'e',
'ж' => 'j',
'з' => 'z',
'и' => 'i',
'й' => 'i',
'к' => 'k',
'л' => 'l',
'м' => 'm',
'н' => 'n',
'о' => 'o',
'п' => 'p',
'р' => 'r',
'с' => 's',
'т' => 't',
'у' => 'u',
'ф' => 'f',
'х' => 'h',
'ц' => 'c',
'ч' => 'ch',
'ш' => 'sh',
'щ' => 'sch',
'ъ' => "",
'ы' => 'y',
'ь' => "",
'э' => 'ye',
'ю' => 'yu',
'я' => 'ya'
);
return strtr($str, $replace);
}

/*
-----------------------------------------------------------------
Обработка смайлов
-----------------------------------------------------------------
*/
public static function smileys($str, $adm = false)
{
global $rootpath;
static $smileys_cache = array();
if (empty($smileys_cache)) {
$file = $rootpath . 'files/cache/smileys.dat';
if (file_exists($file) && ($smileys = file_get_contents($file)) !== false) {
$smileys_cache = unserialize($smileys);
return strtr($str, ($adm ? array_merge($smileys_cache['usr'], $smileys_cache['adm']) : $smileys_cache['usr']));
} else {
return $str;
}
} else {
return strtr($str, ($adm ? array_merge($smileys_cache['usr'], $smileys_cache['adm']) : $smileys_cache['usr']));
}
}

/*
-----------------------------------------------------------------
Функция пересчета на дни, или часы
-----------------------------------------------------------------
*/
public static function timecount($var)
{
global $lng;
if ($var < 0) $var = 0;
$day = ceil($var / 86400);
if ($var > 345600) return $day . ' ' . $lng['timecount_days'];
if ($var >= 172800) return $day . ' ' . $lng['timecount_days_r'];
if ($var >= 86400) return '1 ' . $lng['timecount_day'];
return date("G:i:s", mktime(0, 0, $var));
}

/*
-----------------------------------------------------------------
Транслитерация текста
-----------------------------------------------------------------
*/

/*
-----------------------------------------------------------------
Транслитерация текста
-----------------------------------------------------------------
*/
public static function thai($text)
{
$text = html_entity_decode(trim($text), ENT_QUOTES, 'UTF-8');
$text=str_replace(" ","-", $text);$text=str_replace("--","-", $text);
$text=str_replace("@","-",$text);$text=str_replace("/","-",$text);
$text=str_replace("\\","-",$text);$text=str_replace(":","",$text);
$text=str_replace("\"","",$text);$text=str_replace("'","",$text);
$text=str_replace("<","",$text);$text=str_replace(">","",$text);
$text=str_replace(",","",$text);$text=str_replace("?","",$text);
$text=str_replace(";","",$text);$text=str_replace(".","",$text);
$text=str_replace("[","",$text);$text=str_replace("]","",$text);
$text=str_replace("(","",$text);$text=str_replace(")","",$text);
$text=str_replace("́","", $text);
$text=str_replace("̀","", $text);
$text=str_replace("̃","", $text);
$text=str_replace("̣","", $text);
$text=str_replace("̉","", $text);
$text=str_replace("*","",$text);$text=str_replace("!","",$text);
$text=str_replace("$","-",$text);$text=str_replace("&","-and-",$text);
$text=str_replace("%","",$text);$text=str_replace("#","",$text);
$text=str_replace("^","",$text);$text=str_replace("=","",$text);
$text=str_replace("+","",$text);$text=str_replace("~","",$text);
$text=str_replace("`","",$text);$text=str_replace("--","-",$text);
$text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
$text = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
$text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
$text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
$text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);
$text = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $text);
$text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
$text = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
$text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
$text = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
$text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
$text = preg_replace("/(đ)/", 'd', $text);
$text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
$text = preg_replace("/(đ)/", 'd', $text);
$text = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);
$text = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);
$text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);
$text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);
$text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);
$text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);
$text = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);
$text = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);
$text = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);
$text = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);
$text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);
$text = preg_replace("/(Đ)/", 'D', $text);
$text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);
$text = preg_replace("/(Đ)/", 'D', $text);
$text=strtolower($text);
return $text;
}
////////////////////////
public static function display_pagination2($base_url, $start, $max_value, $num_per_page)
{
$neighbors = 2;
if ($start >= $max_value)
$start = max(0, (int)$max_value - (((int)$max_value % (int)$num_per_page) == 0 ? $num_per_page : ((int)$max_value % (int)$num_per_page)));
else
$start = max(0, (int)$start - ((int)$start % (int)$num_per_page));
$base_link = '<a class="pagenav" href="' . strtr($base_url, array('%' => '%%')) . '_p%d.kely' . '">%s</a>';
$out[] = $start == 0 ? '' : sprintf($base_link, $start / $num_per_page, '&lt;&lt;');
if ($start > $num_per_page * $neighbors)
$out[] = sprintf($base_link, 1, '1');
if ($start > $num_per_page * ($neighbors + 1))
$out[] = '<span style="font-weight: bold;">...</span>';
for ($nCont = $neighbors; $nCont >= 1; $nCont--)
if ($start >= $num_per_page * $nCont) {
$tmpStart = $start - $num_per_page * $nCont;
$out[] = sprintf($base_link, $tmpStart / $num_per_page + 1, $tmpStart / $num_per_page + 1);
}
$out[] = '<span class="currentpage"><b>' . ($start / $num_per_page + 1) . '</b></span>';
$tmpMaxPages = (int)(($max_value - 1) / $num_per_page) * $num_per_page;
for ($nCont = 1; $nCont <= $neighbors; $nCont++)
if ($start + $num_per_page * $nCont <= $tmpMaxPages) {
$tmpStart = $start + $num_per_page * $nCont;
$out[] = sprintf($base_link, $tmpStart / $num_per_page + 1, $tmpStart / $num_per_page + 1);
}
if ($start + $num_per_page * ($neighbors + 1) < $tmpMaxPages)
$out[] = '<span style="font-weight: bold;">...</span>';
if ($start + $num_per_page * $neighbors < $tmpMaxPages)
$out[] = sprintf($base_link, $tmpMaxPages / $num_per_page + 1, $tmpMaxPages / $num_per_page + 1);
if ($start + $num_per_page < $max_value) {
$display_page = ($start + $num_per_page) > $max_value ? $max_value : ($start / $num_per_page + 2);
$out[] = sprintf($base_link, $display_page, '&gt;&gt;');
}
return implode(' ', $out);
}
public static function trans($str)
{
$replace = array(
"A"=>"A","a"=>"a",
"B"=>"B","b"=>"b",
"C"=>"C","c"=>"c",
"D"=>"D","d"=>"d",
"E"=>"E","e"=>"e",
"F"=>"F","f"=>"f",
"G"=>"G","g"=>"g",
"H"=>"H","h"=>"h",
"I"=>"I","i"=>"i",
"J"=>"J","j"=>"j",
"K"=>"K","k"=>"k",
"L"=>"L","l"=>"l",
"M"=>"M","m"=>"m",
"N"=>"N","n"=>"n",
"O"=>"O","o"=>"o",
"P"=>"P","p"=>"p",
"R"=>"R","r"=>"r",
"S"=>"S","s"=>"s",
"T"=>"T","t"=>"t",
"U"=>"U","u"=>"u",
"V"=>"V","v"=>"v",
"W"=>"W","w"=>"w",
"Y"=>"Y","y"=>"y",
"Z"=>"Z","z"=>"z",
"As"=>"Á","Ax"=>"Ã","Aj"=>"Ạ","Af"=>"À","Ar"=>"Ả",
"Es"=>"É","Ex"=>"Ẽ","Ej"=>"Ẹ","Ef"=>"È","Er"=>"Ẻ",
"Ys"=>"Ý","Yx"=>"Ỹ","Yj"=>"Ỵ","Yf"=>"Ỳ","Yr"=>"Ỷ",
"Us"=>"Ú","Ux"=>"Ũ","Uj"=>"Ụ","Uf"=>"Ù","Ur"=>"Ủ",
"Os"=>"Ó","Ox"=>"Õ","Oj"=>"Ọ","Of"=>"Ò","Or"=>"Ỏ",
"Is"=>"Í","Ix"=>"Ĩ","Ij"=>"Ị","If"=>"Ì","Ir"=>"Ỉ",
"Aas"=>"Ấ","Aax"=>"Ẫ","Aaj"=>"Ậ","Aaf"=>"Ầ","Aar"=>"Ẩ",
"Ees"=>"Ế","Eex"=>"Ễ","Eej"=>"Ệ","Eef"=>"Ề","Eer"=>"Ể",
"Oos"=>"Ố","Oox"=>"Ỗ","Ooj"=>"Ộ","Oof"=>"Ồ","Oor"=>"Ổ",
"Ows"=>"Ớ","Owx"=>"Ớ","Owj"=>"Ợ","Owf"=>"Ờ","Owr"=>"Ở",
"Aws"=>"Ẵ","Awx"=>"Ẵ","Awj"=>"Ặ","Awf"=>"Ằ","Awr"=>"Ẳ",
"Uws"=>"Ứ","Uwx"=>"Ữ","Uwj"=>"Ự","Uwf"=>"Ừ","Uwr"=>"Ử",
"as"=>"á","ax"=>"ã","aj"=>"ạ","af"=>"à","ar"=>"ả",
"es"=>"é","ex"=>"ẽ","ej"=>"ẹ","ef"=>"è","er"=>"ẻ",
"ys"=>"ý","yx"=>"ỹ","yj"=>"ỵ","yf"=>"ỳ","yr"=>"ỷ",
"us"=>"ú","ux"=>"ũ","uj"=>"ụ","uf"=>"ù","ur"=>"ủ",
"os"=>"ó","ox"=>"õ","oj"=>"ọ","of"=>"ò","or"=>"ỏ",
"is"=>"í","ix"=>"ĩ","ij"=>"ị","if"=>"ì","ir"=>"ỉ",
"aas"=>"ấ","aax"=>"ẫ","aaj"=>"ậ","aaf"=>"ầ","aar"=>"ẩ",
"ees"=>"ế","eex"=>"ễ","eej"=>"ệ","eef"=>"ề","eer"=>"ể",
"oos"=>"ố","oox"=>"ỗ","ooj"=>"ộ","oof"=>"ồ","oor"=>"ổ",
"ees"=>"ế","eex"=>"ễ","eej"=>"ệ","eef"=>"ề","eer"=>"ể",
"ows"=>"ớ","owx"=>"ớ","owj"=>"ợ","owf"=>"ờ","owr"=>"ở",
"aws"=>"ắ","awx"=>"ẵ","awj"=>"ặ","awf"=>"ằ","awr"=>"ẳ",
"uws"=>"ứ","uwx"=>"ữ","uwj"=>"ự","uwf"=>"ừ","uwr"=>"ử",
"uw"=>"ư","aw"=>"ă","aa"=>"â","oo"=>"ô", "ee"=>"ê",
"ow"=>"ơ", "dd"=>"đ","uw"=>"ư",
"lon"=>"l*n", "dit"=>"d*t", "dyt"=>"d*t",
"djt"=>"d*t", "địt"=>"đ*t", "lồn"=>"l*n", "dcm"=>"đập con
muỗi", "dkm"=>"đập con muỗi", "fuck"=>"fuc*"
);
return strtr($str, $replace);
}
}
?>
