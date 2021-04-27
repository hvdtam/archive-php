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

/*
-----------------------------------------------------------------
РћР±СЂР°Р±РѕС‚РєР° СЃСЃС‹Р»РѕРє Рё С‚СЌРіРѕРІ BBCODE РІ С‚РµРєСЃС‚Рµ
-----------------------------------------------------------------
*/
function tags($var = '') {
global $user_id, $login;
$var = preg_replace(array('#\[php\](.*?)\[\/php\]#se'), array("''.highlight('$1').''"), str_replace("]\n", "]", $var));
$var = preg_replace('#\[code\](.*?)\[/code\]#si', '<div class="bmenu">Mã</div><div class="quote">\1</div>', $var);
$var = preg_replace('#\[text\](.*?)\[/text\]#si', 'TEXT:<br><textarea>\1</textarea><br>', $var);
$var = preg_replace('#\[vblue\](.*?)\[/vblue\]#si', '<span style="text-shadow: 1px 3px 9px blue;">\1</span>', $var);
$var = preg_replace('#\[vgreen\](.*?)\[/vgreen\]#si', '<span style="text-shadow: 1px 3px 9px green;">\1</span>', $var);
$var = preg_replace('#\[vred\](.*?)\[/vred\]#si', '<span style="text-shadow: 1px 3px 9px red;">\1</span>', $var);
$var = preg_replace('#\[b\](.*?)\[/b\]#si', '<span style="font-weight: bold;">\1</span>', $var);
$var = str_replace('[br]', '<br>', $var);
$var = preg_replace('#\[i\](.*?)\[/i\]#si', '<span style="font-style:italic;">\1</span>', $var);
$var = preg_replace('#\[u\](.*?)\[/u\]#si', '<span style="text-decoration:underline;">\1</span>', $var);
$var = preg_replace('#\[s\](.*?)\[/s\]#si', '<span style="text-decoration: line-through;">\1</span>', $var);
$var = preg_replace('#\[phai\](.+?)\[/phai\]#is', '<div align="right">\1</div>', $var );
$var = preg_replace('#\[center\](.+?)\[/center\]#is', '<div align="center">\1</div>', $var );
$var = preg_replace('#\[CENTER\](.+?)\[/CENTER\]#is', '<div align="center">\1</div>', $var );
$var = preg_replace('#\[LEFT\](.+?)\[/LEFT\]#is', '<div align="left">\1</div>', $var );
$var = preg_replace('#\[left\](.+?)\[/left\]#is', '<div align="left">\1</div>', $var );
$var = preg_replace('#\[right\](.+?)\[/right\]#is', '<div align="right">\1</div>', $var );
$var = preg_replace('#\[RIGHT\](.+?)\[/RIGHT\]#is', '<div align="right">\1</div>', $var );
$var = preg_replace('#\[trai\](.+?)\[/trai\]#is', '<div align="left">\1</div>', $var );
$var = preg_replace('#\[giua\](.+?)\[/giua\]#is', '<div align="center">\1</div>', $var );
$var = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:red">\1</span>', $var);
$var = preg_replace('#\[green\](.*?)\[/green\]#si', '<span style="color:green">\1</span>', $var);
$var = preg_replace('#\[blue\](.*?)\[/blue\]#si', '<span style="color:blue">\1</span>', $var);
$var = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="quote">\1</div>', $var);
$var = preg_replace('#\[quote=(.*?)\](.*?)\[/quote\]#si', '<div class="quote">\1 đã viết</div><div class="quote">\2</div>', $var);
$var = preg_replace('#\[img=(.+?)\]#is', '<center><div><a href="http://\1"><img src="http://\1" alt="click" border="0" width="100" /></a></div></center>', $var);
$var = preg_replace('#\[img](.+?)\[/img]#is', '<center><div><a href="http://\1"><img src="http://\1" alt="click" border="0" width="150" /></a></div></center><br/>', $var);
$var = preg_replace('#\[url](.+?)\[/url]#is', '\1<br/>', $var);
$var = preg_replace('#\[img=(.+?)\][/img]#is', '<center><div><a href="http://\1"><img src="http://\1" alt="click" border="0" width="150" /></a></div></center>', $var);
$var = preg_replace('#\[COLOR=(.+?)\](.+?)\[/COLOR\]#is', '<font style="color:\1;">\2</font>', $var );
$var = preg_replace('#\[color=(.+?)\](.+?)\[/color\]#is', '<font style="color:\1;">\2</font>', $var );
$var = preg_replace('#\[SIZE=(.+?)\](.+?)\[/SIZE\]#is', '<font style="font-size:\1;">\2</font>', $var );
$var = preg_replace('#\[size=(.+?)\](.+?)\[/size\]#is', '<font style="font-size:\1;">\2</font>', $var );
$var = preg_replace('#\[FONT=(.+?)\](.+?)\[/FONT\]#is', '<font face="\1">\2</font>', $var );
$var = preg_replace('#\[font=(.+?)\](.+?)\[/font\]#is', '<font face="\1">\2</font>', $var );
if($user_id) {
$var = preg_replace("#\[url=(.+?)\](.+?)\[/url\]#is", "".("<a href=\"http://\\1\">\\2</a>")."", $var );
$var = preg_replace("#\[URL=(.+?)\](.+?)\[/URL\]#is", "".("<a href=\"http://\\1\">\\2</a>")."", $var );
} else {
$var = preg_replace('#\[URL=(.+?)\](.+?)\[/URL\]#is', '<b>Vui lòng <a href="/login.php">Đăng nhập</a> or <a href="/registration.php">Đăng ký</a> để thấy link</b>', $var);
$var = preg_replace('#\[url=(.+?)\](.+?)\[/url\]#is', '<b>Vui lòng <a href="/login.php">Đăng nhập</a> or <a href="/registration.php">Đăng ký</a> để thấy link</b>', $var);
}
$var = str_replace('[you]', $login, $var);
return $var;
}
function url($var)
{
if (!function_exists('process_url')) {
function process_url($url)
{
if (!isset($url[3])) {
$tmp = parse_url($url[1]);
if ('http://' . $tmp['host'] == core::$system_set['homeurl'] || isset(core::$user_set['direct_url']) && core::$user_set['direct_url']) {
return '<a href="' . $url[1] . '">' . $url[2] . '</a>';
} else {
return '<a href="' . core::$system_set['homeurl'] . '/go.php?url=' . base64_encode($url[1]) . '">' . $url[2] . '</a>';
}
} else {
$tmp = parse_url($url[3]);
$url[3] = str_replace(':', '&#58;', $url[3]);
if ('http://' . $tmp['host'] == core::$system_set['homeurl'] || isset(core::$user_set['direct_url']) && core::$user_set['direct_url']) {
return '<a href="' . $url[3] . '">' . $url[3] . '</a>';
} else {
return '<a href="' . core::$system_set['homeurl'] . '/go.php?url=' . base64_encode($url[3]) . '">' . $url[3] . '</a>';
}
}
}
}
$var = str_replace('[img=http://', '[img=', $var);
$var = str_replace('[IMG=http://', '[IMG=', $var);
$var = str_replace('[url=http://', '[url=', $var);
$var = str_replace('[URL=http://', '[URL=', $var);
$var = str_replace('[img]http://', '[img]', $var);
$var = str_replace('[IMG]http://', '[IMG]', $var);
return preg_replace_callback('~\\[url=(https?://.+?)\\](.+?)\\[/url\\]|(https?://(www.)?[0-9a-z\.-]+\.[0-9a-z]{2,6}[0-9a-zA-Z/\?\.\~&amp;_=/%-:#]*)~', 'process_url', $var);
}
function notags($var = '') {
$var = strtr($var, array (
'[green]' => '',
'[/green]' => '',
'[/vgreen]' => '',
'[/vred]' => '',
'[/vblue]' => '',
'[vgreen]' => '',
'[vred]' => '',
'[vblue]' => '',
'[red]' => '',
'[/red]' => '',
'[blue]' => '',
'[/blue]' => '',
'[b]' => '',
'[/b]' => '',
'[i]' => '',
'[/i]' => '',
'[u]' => '',
'[/u]' => '',
'[s]' => '',
'[/s]' => '',
'[c]' => '',
'[/c]' => ''
));

return $var;
}
function highlight($php) {
$php = strtr($php, array (
'<br />' => '',
'\\' => 'slash_JOHNCMS'
));

$php = html_entity_decode(trim($php), ENT_QUOTES, 'UTF-8');
$php = substr($php, 0, 2) != "<?" ? $php = "<?php\n" . $php . "\n?>" : $php;
$php = highlight_string(stripslashes($php), true);
$php = strtr($php, array (
'slash_JOHNCMS' => '&#92;',
':' => '&#58;',
'[' => '&#91;',
'&nbsp;' => ' '
));

return '<div class="phpcode">' . $php . '</div>';
}
?>
