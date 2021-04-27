<?php
echo '<div class="fmenu">Bài viết mới</div>';
$tong = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `close`!='1'"), 0);

$req = mysql_query("SELECT * FROM `forum` WHERE `type` = 't' and kedit='0' AND `kiemduyet` = '1' AND `close`!='1' ORDER BY `time` DESC LIMIT $start, 5");
while ($arr = mysql_fetch_array($req)) {
$q3 = mysql_query("select `id`, `refid`, `text` from `forum` where type='r' and id='" . $arr['refid'] . "'");
$razd = mysql_fetch_array($q3);
$q4 = mysql_query("select `id`, `refid`, `text` from `forum` where type='f' and id='" . $razd['refid'] . "'");
$frm = mysql_fetch_array($q4);
$nikuser = mysql_query("SELECT `from`,`id`, `time` FROM `forum` WHERE `type` = 'm' AND `close` != '1' AND `refid` = '" . $arr['id'] . "'ORDER BY time DESC");
$colmes1 = mysql_num_rows($nikuser);
$cpg = ceil($colmes1 / $kmess);
$nam = mysql_fetch_array($nikuser);
echo is_integer($i / 2) ? '<div class="list1">' : '<div class="list2">';
echo '<img src="/images/np.gif" alt=""/>';
if ($arr['realid'] == 1)
echo '<img src="/images/rate.gif" alt=""/>';
echo '&nbsp;<a href="/forum/index.php?id=' . $arr['id'] . ($cpg > 1 && $_SESSION['uppost'] ? '&amp;page=' . $cpg : '') . '">' .bbcode::tags($arr['text']). '</a>&nbsp;[' . $colmes1 . ']';
if ($cpg > 1)
echo '&nbsp;<a href="/forum/index.php?id=' . $arr['id'] . ($_SESSION['uppost'] ? '' : '&amp;page=' . $cpg) . '#' . $nam['id'].'">&gt;&gt;</a>';
echo '</div>';
$i++;
}
if ($tong > $kmess){echo '<div class="menu">' . functions::display_pagination('index.php?', $start, $tong, $kmess) . '</div>';}
?>
