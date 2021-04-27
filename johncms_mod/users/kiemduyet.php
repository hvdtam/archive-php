<?php

define('_IN_JOHNCMS', 1);

$headmod = 'kiemduyet';

$textl = 'Kiểm duyệt bài viết';

require_once('../incfiles/core.php');
require_once('../incfiles/head.php');
if ($user_id && $rights >= 3) {

$kiemduyet = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `kiemduyet` != '1' AND `close`!='1'"), 0);
if ($kiemduyet > 0) {
echo '<div class="menu" ><b>Tổng số chủ đề: ' . $kiemduyet . ' </b></div>';
} else {
echo 'Không có chủ đề nào đang chờ kiểm duyệt.';}

$req = mysql_query("SELECT * FROM `forum` WHERE `type` = 't' and kedit='0' AND `kiemduyet` != '1' AND `close`!='1' ORDER BY `time` DESC LIMIT 20");

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

echo '<img src="../images/' . ($arr['edit'] == 1 ? 'tz' : 'np') . '.gif" alt=""/>';

if ($arr['realid'] == 1)

echo '&nbsp;<img src="../images/rate.gif" alt=""/>';

echo '&nbsp;<a href="../forum/index.php?id=' . $arr['id'] . ($_SESSION['uppost'] ? '' : '&amp;page=' . $cpg) . '">' . $arr['text'] . '</a>&nbsp;[' . $colmes1 . ']';
if ($cpg > 1)
echo '&nbsp;<a href="../forum/index.php?id=' . $arr['id'] . ($_SESSION['uppost'] ? '' : '&amp;clip&amp;page=' . $cpg) . '#' . $nam['id'].'">&gt;&gt;</a>';


echo '<div class="sub">';

echo $arr['from'];

if (!empty ($nam['from'])) {

echo '&nbsp;/&nbsp;' . $nam['from'];

}



echo '</div>';

echo '</div>';

$i++;

}
} else {
echo 'Lỗi!';
}

require_once('../incfiles/end.php');

?>
