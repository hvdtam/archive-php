<?
define('_IN_JOHNCMS', 1);
$textl = 'Gửi bài viết mới';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if ($id && $id != $user_id) {
    $req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
    if (mysql_num_rows($req)) {
        $user = mysql_fetch_assoc($req);
}

}
else {
$id = false;
$user = $datauser;
}

if (!$user_id) {
    require_once ('../incfiles/head.php');
    display_error('Chỉ cho người dùng đăng ký');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div style="color:green;"><b>Gửi bài viết mới trên diễn đàn</b></div>';
echo '<div style="color:red"><i>Khi bạn gửi bài viết trên diễn đàn, đồng nghĩa là bạn chấp nhận những quy định
của thienthanz.com, chúng tôi không chịu trách nhiệm trước bất kì thông tin nào bạn đưa lên diễn đàn. Chúng tôi
hoàn toàn không có liên hệ nào với các tác giả của bài viết, phần mềm, game, nhạc... Cảm ơn!</i></div>';
                echo '<div><ul>';
        $req = mysql_query("SELECT `id`, `text`, `soft` FROM `forum` WHERE `type`='f' ORDER BY `realid`");
        while ($res = mysql_fetch_array($req)) {
            echo ($i % 2) ? '<li>' : '<li>';
            $count = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type`='r' and `refid`='" . $res['id'] . "'"), 0);
            echo '<b>' . $res['text'] . '</b>';
            echo '<ul>';
            $vnit = $res['id'];
                $req1 = mysql_query("SELECT `id`, `text`, `soft` FROM `forum` WHERE `type`='r' AND `refid`='$vnit' ORDER BY `realid`");
                while ($res1 = mysql_fetch_assoc($req1)) {
            echo ($i % 2) ? '<li>' : '<li>';
                echo '<a href="index.php?act=nt&amp;id=' . $res1['id'] . '">' . $res1['text'] . '</a>';
            echo '</li>';
                ++$i;

                }
            echo '</ul></li>';
            ++$i;
        }
            echo '</ul></div>';

require_once ("../incfiles/end.php");
?>