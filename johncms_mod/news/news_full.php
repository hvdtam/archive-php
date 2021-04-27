<?

define('_IN_JOHNCMS', 1);

$textl = 'Новости ресурса';
$headmod = "news";
require_once ("../incfiles/core.php");
$lng_news = core::load_lng('news'); // Загружаем язык модуля
require_once ("../incfiles/head.php");

$req = mysql_query("SELECT * FROM `news` where id='" . $id . "' ORDER BY `time` DESC LIMIT 1");
while ($res = mysql_fetch_array($req)) {
    echo '<p>';
    $text = $res['text'];
	$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
	$text = str_replace("\r\n", "<br/>", $text);
	$text = bbcode::tags($text);
	$text = functions::smileys($text);
	echo '<div class="venom-blockheader">
			<div class="l"></div>
			<div class="r"></div>
			<h3 class="t">' . $res['name'] . '</h3>
		</div>';	
	
	echo '<span class="gray"><small>' . $lng['author'] . ': ' . $res['avt'] . ' (' . functions::display_date($res['time']) . ')</small></span>' .
                 '<br />' . $text . '<div class="sub">';
	if ($res['kom'] != 0 && $res['kom'] != "") {
        $mes = mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 'm' AND `refid` = '" . $res['kom'] . "'");
        $komm = mysql_result($mes, 0) - 1;
        if ($komm >= 0)
            echo '<a href="../forum/?id=' . $res['kom'] . '">' . $lng_news['discuss_on_forum'] . ' (' . $komm . ')</a><br/>';
    }
    if ($rights >= 6) {
        echo '<a href="index.php?do=edit&amp;id=' . $res['id'] . '">' . $lng['edit'] . '</a> | ' .
                     '<a href="index.php?do=del&amp;id=' . $res['id'] . '">' . $lng['delete'] . '</a>';
    }	
	echo '<p><a href="news.php">Все новости</a></p>';
echo '</div>';
}

require_once ("../incfiles/end.php");

?>