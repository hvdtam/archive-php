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

$mp = new mainpage();
/*
-----------------------------------------------------------------
Функция отображения списков
-----------------------------------------------------------------
*/

/*
-----------------------------------------------------------------
Tin tuc
-----------------------------------------------------------------
*/


echo $mp->news;


/*
----------------------------------------------------------------------------------------------------------------------------------
*/

echo '<div class="phdr"><a href="../users/album.php?act=list"><b>Đăng ảnh nào!</b></a></div><div class="mainblok"><div class="list1">';
$hammad4=mysql_query("SELECT `id`, `user_id`, `album_id`, `tmb_name`, `time` FROM `cms_album_files` order by rand() limit 1 ");
$ar34=mysql_fetch_array($hammad4);
$hammad41=mysql_query("SELECT `id`, `user_id`, `album_id`, `tmb_name`, `time` FROM `cms_album_files` order by rand() limit 1 ");
$ar35=mysql_fetch_array($hammad41);
$hammad42=mysql_query("SELECT `id`, `user_id`, `album_id`, `tmb_name`, `time` FROM `cms_album_files` order by rand() limit 1 ");
$ar33=mysql_fetch_array($hammad42);
$hammad420=mysql_query("SELECT `id`, `user_id`, `album_id`, `tmb_name`, `time` FROM `cms_album_files` order by rand() limit 1 ");
$ar330=mysql_fetch_array($hammad420);
echo '<center><table cellpadding="0" cellspacing="0" width="100%" border="1"><tbody><tr>';
echo'<td width="25%" align="center"><a href="../users/album.php?act=show&al='.$ar34['album_id'] .'&img='.$ar34['id'] .'&user='.$ar34['user_id'] .'&view"><img width="70%" src="../files/users/album/'.$ar34['user_id'] .'/'.$ar34['tmb_name'] .'" alt="'.$ar34['id'] .'"/></a></td>';
echo'<td width="25%" align="center"><a href="../users/album.php?act=show&al='.$ar33['album_id'] .'&img='.$ar33['id'] .'&user='.$ar33['user_id'] .'&view"><img width="70%" src="../files/users/album/'.$ar33['user_id'] .'/'.$ar33['tmb_name'] .'" alt="'.$ar33['id'] .'"/></a></td>';
echo'<td width="25%" align="center"><a href="../users/album.php?act=show&al='.$ar330['album_id'] .'&img='.$ar330['id'] .'&user='.$ar330['user_id'] .'&view"><img width="70%" src="../files/users/album/'.$ar330['user_id'] .'/'.$ar330['tmb_name'] .'" alt="'.$ar330['id'] .'"/></a></td>';
echo'<td width="25%" align="center"><a href="../users/album.php?act=show&al='.$ar35['album_id'] .'&img='.$ar35['id'] .'&user='.$ar35['user_id'] .'&view"><img width="70%" src="../files/users/album/'.$ar35['user_id'] .'/'.$ar35['tmb_name'] .'" alt="'.$ar35['id'] .'"/></a></td>';
echo '</center></tr></tbody></table></div></div><br/>';
echo '<div class="phdr"><b>Tin Nhanh</b></div><div class="mainblok">';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' AND `home`>'0' AND `close` != '1'"), 0);
$req = mysql_query("SELECT * FROM `forum` WHERE `type`='t' AND `home`>'0' ORDER BY `time` DESC LIMIT $start, $kmess");

while($res = mysql_fetch_array($req)) {
$noidung = mysql_query("SELECT `id`, `refid`, `text`, `img`, `view` FROM `forum` WHERE `type`='m' AND `refid`='" . $res['id'] . "'");
$t = mysql_fetch_array($noidung);
$q3 = mysql_query("SELECT `id`, `refid`, `text`, `img`, `view` FROM `forum` WHERE `type`='r' AND `id`='" . $res['refid'] . "'");
$razd = mysql_fetch_array($q3);
$q4 = mysql_query("SELECT `text` FROM `forum` WHERE `type`='f' AND `id`='" . $razd['refid'] . "'");
$frm = mysql_fetch_array($q4);
$colmes = mysql_query("SELECT * FROM `forum` WHERE `refid` = '" . $res['id'] . "' AND `type` = 'm'" . ($rights >= 7 ? '' : " AND `close` != '1'") . " ORDER BY `time` DESC");
$colmes1 = mysql_num_rows($colmes);
$cpg = ceil($colmes1 / $kmess);
echo '<div class="menu"><div style="margin:0px 0px 1px 0px;padding:0px 0px 1px 0px;border-bottom:1px dashed #cecece">';
echo '<img src="/images/new.gif"> <a href="../forum/' . functions::thai($res['text']) . '_' . $res['id'] . '.kely"><b>' . $res['text'] .	'</b></a>&#160;<br />';
echo 'Bởi: <font style="color:DeepPink;">'.$res['from'].'</font> - ' . functions::display_date($res['time']) . ' - Lượt xem: '.$res['view'].'</div>';

/*
-----------------------------------------------------------------
Noi dung bai viet
-----------------------------------------------------------------
*/
echo '<table cellpadding="2" cellspacing="0" width="100%"><tbody><tr><td width="auto" align="left">';
if($res['img']){
echo '<a href="../forum/' . functions::thai($res['text']) . '_' . $res['id'] . '.kely"><img src="' . $res['img'] . '" alt="' . $res['text'] . '" class="image"></a>';
}else{
echo '<a href="../forum/' . functions::thai($res['text']) . '_' . $res['id'] . '.kely"><img src="images/mongmo.png" alt="' . $res['text'] . '" class="image"></a>';
}
echo '</td><td width="75%"><small>';
$text = $t['text'];
$cut = '100';
if ($set_forum['postcut'] && mb_strlen($text) > $cut) {
$text = mb_substr($text, 0, $cut);
$text = functions::checkout($text, 1, 1);
$text = preg_replace('#\[c\](.*?)\[/c\]#si', '<div class="bbcode_container"><div class="bbcode_quote"><div class="quote_container"><div class="bbcode_quote_container"></div>\1</div></div></div>', $text);
if ($set_user['smileys'])
$text = functions::smileys($text, $t['rights'] ? 1 : 0);
echo bbcode::notags($text) . '...<br /><a href="index.php?act=post&amp;id=' . $colmes1['id'] . '">' . $lng_forum['read_all'] . ' &gt;&gt;</a>';

} else {
$text = mb_substr($text, 0, $cut);
$text = functions::checkout($text, 1, 1);
if ($set_user['smileys'])
$text = functions::smileys($text, $t['rights'] ? 1 : 0);
echo $text;

}

echo '...</small></td></tr></tbody></table></div>';
}
// Trang bai viet

if ($total > $kmess) {
echo '<br /><div class="topmenu" align="center">' . functions::display_pagination('index.php?', $start, $total, $kmess) . '</div>' .
'<p><form action="index.php" method="get"><input type="text" name="page" size="2"/>' .
'<input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p></div>';
}
/*
-----------------------------------------------------------------
-----------------------------------------------------------------
*/
//chuyen muc
echo '<br/><div class="phdr"><b>Chuyên mục</b></div><div class="mainblok">';
            $req = mysql_query("SELECT * FROM `forum` WHERE `type` = 'f' ORDER BY `realid` ASC");
            $i = 0;
            while ($res = mysql_fetch_assoc($req)) {
                echo $i % 2 ? '<div class="menu">' : '<div class="menu">';
                echo '•<a href="'.$home.'/forum/' . functions::thai($res['text']) . '_' . $res['id'] . '.kely">' . $res['text'] . '</a>';
                echo '</div>';
                ++$i;
            }
echo '</div>';
?>
