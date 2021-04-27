<?php
/**
* @package     JohnCMS
* @link        http://johncms.com
* @copyright   Copyright (C) 2008-2011 JohnCMS Community
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      http://johncms.com/about
*/
define('_IN_JOHNCMS', 1);
$headmod = 'quiz';
$rootpath = '../';
$realtime = time();
$textl = 'Trắc nghiệm';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if (!$user_id) {
echo 'Chỉ cho thành viên';
require_once('../incfiles/end.php');
exit;
}
if($_GET['quiz']) {
echo '<div class="phdr"><b><a href="quiz.php">Trắc nghiệm</a></b></div>';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type`='q' AND `id` = '" . $_GET['quiz'] . "'"), 0);
$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `matter_id` = '" . $_GET['quiz'] . "'"), 0);
$result2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `matter_id` = '" . $_GET['quiz'] . "' AND `result`='true'"), 0);
$result3 = $result-$result2;
if ($total) {
$req = mysql_query("SELECT * FROM `quiz` WHERE `type`='q' AND `id` = '" . $_GET['quiz'] . "' LIMIT 1");
while ($res = mysql_fetch_array($req)) {
echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
$text = functions::checkout($res['text'], 1, 1);
$text = str_replace("\r\n", "<br />", $text);
$text = functions::smileys($text, 1);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$res['user']."' LIMIT 1"));
echo '<p><h3><img src="'.$homeurl.'/images/question.png" width="16" height="16" class="left" />&nbsp;Câu hỏi</h3><ul>';
echo '<span class ="gray"><small>Giá: <b>' . $res['price'] . '</b> Xu</small><br><small>Người gửi: <b>' . $user['name'] . '</b></small></span></ul></p><p>' . $text . '</p>';
$count1 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $res['id'] . "'"), 0);
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $res['id'] . "' AND `result` = 'true'"), 0);
if ($user_id && $res['user'] != $user_id) {
if ($count1 == 0) {
echo '<form action="quiz.php?act=ans&amp;id=' . $res['id'] . '" method="post">';
echo '<p><h3><img src="'.$homeurl.'/images/star.gif" width="16" height="16" class="left" />&nbsp;Chọn câu trả lời</h3>';
echo '<input type="radio" name="optionch" value="1" checked="checked"/>&nbsp;' . $res['option1'] . '<br />';
echo '<input type="radio" name="optionch" value="2"/>&nbsp;' . $res['option2'] . '<br>';
echo '<input type="radio" name="optionch" value="3"/>&nbsp;' . $res['option3'] . '<br />';
echo '<input type="radio" name="optionch" value="4"/>&nbsp;' . $res['option4'] . '</p>';
echo '<p><input type="submit" name="submit" value=" Trả lời "/></p></form>';
} else {
echo '<p><h3>Bạn ' . ($count2 > 0 ? 'có thể' : 'không thể') . ' trả lời cho câu hỏi này</h3></p>';
}
}
echo '<div class="user">Có <b>'.$result.'</b> người trả lời: '.$result2.' đúng và '.$result3.' sai.</div>';
echo '</div>';
echo '<div class="phdr">Bình luận</div>';
if($user_id) {
echo '<div class="gmenu"><form action="quiz.php?act=com&id='.$_GET['quiz'].'" method="POST"><input type="text" name="text" size="7"><input type="submit" name="submit" value="Gửi"></form></div>';
}
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_com` WHERE `quiz`='".$_GET["quiz"]."'"), 0);
if($total) {
$req = mysql_query("SELECT * FROM `cms_quiz_com` WHERE `quiz`='".$_GET["quiz"]."' ORDER BY `time` DESC LIMIT $start, $kmess");
while($res = mysql_fetch_assoc($req)) {
echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
$text = functions::checkout($res['text'], 1, 1);
$res_u = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$res["user"]."'"));
echo (time() > $res_u['lastdate'] + 600 ? '<font color="red"><b>&#x2022;</b></font>' : '<font color="green"><b>&#x2022;</b></font>');
echo '<a href="/users/profile.php?user='.$res['user'].'">'.$res_u['name'].'</a> ('.functions::display_date($res['time']).')<br>'.$text.'</div>';
++$i;
}
} else {
echo 'Chưa có bình luận cho câu này!';
}
echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
// Навигация по страницам
if ($total > $kmess) {
echo '<p>' . functions::display_pagination('quiz.php?', $start, $total, $kmess) . '</p>';
echo '<p><form action="botpanel.php" method="get"><input type="text" name="page" size="2"/><input type="submit" value="' . $lng['to_page'] . ' &gt;&gt;"/></form></p>';
}
}
} else {
echo '<div class="menu"><p>Không có câu hỏi</p></div>';
}
require_once ("../incfiles/end.php");
exit;
}
if (!empty($_GET['act'])) {
$act = functions::check($_GET['act']);
}
switch ($act) {
case 'new' :
echo '<div class="phdr"><b>Trắc nghiệm</b></div>';
echo '<div class="bmenu">Câu hỏi mới</div>';
$old = $realtime - (3 * 24 * 3600);
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `time` > '" . $old . "' AND `type` = 'q'"), 0);
if ($total) {
$req = mysql_query("SELECT * FROM `quiz` WHERE `time` > '" . $old . "' AND `type` = 'q' ORDER BY `time` DESC LIMIT $start,$kmess");
while ($res = mysql_fetch_array($req)) {
echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
$text = $res['text'];
$text = functions::checkout($text, 1, 1);
$text = str_replace("\r\n", "<br />", $text);
$text = functions::smileys($text, 1);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$res['user']."' LIMIT 1"));
echo '<p><h3><img src="'.$homeurl.'/images/question.png" width="16" height="16" class="left" />&nbsp;Câu hỏi</h3><ul>';
echo '<span class ="gray"><small>Giá: <b>' . $res['price'] . '</b> Xu</small><br><small>Người gửi: <b>' . $user['name'] . '</b></small></span></ul></p><p>' . $text . '</p>';
$count1 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $res['id'] . "'"), 0);
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $res['id'] . "' AND `result` = 'true'"), 0);
if ($user_id && $res['user'] != $user_id) {
if ($count1 == 0) {
echo '<a href="quiz.php?quiz='.$res['id'].'">Trả lời</a>';
} else {
echo '<p><h3>Bạn ' . ($count2 > 0 ? 'đoán' : 'không thể đoán') . ' vấn đề này</h3></p>';
}
}
echo '</div>';
++$i;
}
} else {
echo '<div class="menu"><p>Không có câu hỏi mới</p></div>';
}
echo '<div class="phdr">Tổng số vấn đề:&nbsp;' . $total . '</div>';
if ($total > $kmess) {
echo '<p>' . functions::display_pagination('quiz.php?act=new&amp;', $start, $total, $kmess) . '</p>';
echo '<p><form action="quiz.php?act=new" method="post"><input type="submit" value="Chuyển đến trang &gt;&gt;"/></form></p>';
}
echo '<p><a href="quiz.php">Quay lại</a></p>';
break;
case 'cat' :
if (!$id) {
echo 'Dữ liệu không hợp lệ';
require_once ('../incfiles/end.php');
exit;
}
$req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'c' AND `id`='" . $id . "'");
$res = mysql_fetch_array($req);
echo '<div class="phdr"><b><a href="quiz.php">Trắc nghiệm</a></b> | ' . $res['text'] . '</div>';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $id . "'"), 0);
if ($total) {
$req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $id . "' ORDER BY `time` DESC LIMIT $start,$kmess");
while ($res = mysql_fetch_array($req)) {
echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
$text = $res['text'];
$text = functions::checkout($text, 1, 1);
$text = str_replace("\r\n", "<br />", $text);
$text = functions::smileys($text, 1);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='".$res['user']."' LIMIT 1"));
echo '<p><h3><img src="'.$homeurl.'/images/question.png" width="16" height="16" class="left" />&nbsp;Câu hỏi</h3><ul>';
echo '<span class ="gray"><small>Giá: <b>' . $res['price'] . '</b> Xu</small><br><small>Người gửi: <b>' . $user['name'] . '</b></small></span></ul></p><p>' . $text . '</p>';
$count1 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $res['id'] . "'"), 0);
$count2 = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $res['id'] . "' AND `result` = 'true'"), 0);
if ($user_id && $res['user'] != $user_id) {
if ($count1 == 0) {
echo '<a href="quiz.php?quiz='.$res['id'].'">Trả lời</a>';
} else {
echo '<p><h3>Bạn ' . ($count2 > 0 ? 'có thể' : 'không thể') . ' trả lời cho câu hỏi này</h3></p>';
}
}
echo '</div>';
++$i;
}
} else {
echo '<div class="menu"><p>Không có câu hỏi</p></div>';
}
echo '<div class="gmenu"><form action="quiz.php?act=add&id='.$id.'" method="post"><input type="submit" value="Gửi câu hỏi"></form></div><div class="phdr">Tổng số vấn đề:&nbsp;' . $total . '</div>';
if ($total > $kmess) {
echo '<p>' . functions::display_pagination('quiz.php?act=cat&amp;id=' . $id . '&amp;', $start, $total, $kmess) . '</p>';
echo '<p><form action="quiz.php?act=cat&amp;id=' . $id . '" method="post"><input type="submit" value="Chuyển đến trang &gt;&gt;"/></form></p>';
}
echo '<p><a href="quiz.php">Trong thể loại</a></p>';
break;
case 'ans' :
if (!$id) {
echo ' Dữ liệu không hợp lệ';
require_once ('../incfiles/end.php');
exit;
}
$usr_ans = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `user_id` = '" . $user_id . "' AND `matter_id` = '" . $id . "'"), 0);
if ($usr_ans != 0) {
echo 'Bạn đã trả lời câu hỏi này';
require_once ('../incfiles/end.php');
exit;
}
$req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'q' AND `id`='" . $id . "'");
$res = mysql_fetch_array($req);
$price = $res['price'];
echo '<div class="phdr"><b>Trả lời cho câu hỏi:</b> ' . $res['text'] . '</div>';
if (isset($_POST['submit'])) {
$error = array ();
if ($datauser['balans'] < $price) {
$error .= 'Bạn phải có số tiền lớn hơn số tiền cược của câu hỏi.';
}
if (!$error) {
$optionid = $_POST['optionch'];
if ($optionid == $res['true']) {
echo '<div class="gmenu"><p>Xin chúc mừng! Bạn trả lời đúng câu hỏi,<br />Bạn nhận được '.$price.'xu từ câu hỏi này</p></div>';
mysql_query("UPDATE `users` SET `balans`=`balans`+'$price' WHERE `id` = '" . $user_id . "'");
mysql_query("UPDATE `users` SET `balans`=`balans`-'$price' WHERE `id` = '" . $res['user'] . "'");
$result = 'true';
} else {
echo '<div class="rmenu"><p>Xin lỗi, câu trả lời của bạn là sai. Và bạn bị trừ '.$price.'xu</p></div>';
mysql_query("UPDATE `users` SET `balans`=`balans`-'$price' WHERE `id` = '" . $user_id . "'");
mysql_query("UPDATE `users` SET `balans`=`balans`+'$price' WHERE `id` = '" . $res['user'] . "'");
$result = 'false';
}
mysql_query("INSERT INTO `cms_quiz_log` SET
`matter_id` = '$id',
`user_id` = '$user_id',
`result` = '$result',
`purse` = '$purse',
`time` = '$realtime';");
} else {
echo $error;
}
}
echo '<div class="phdr"><a href="quiz.php?act=cat&amp;id=' . $res['refid'] . '">Quay lại</a></div>';
break;
case 'com':
if (!$id) {
echo functions::display_error(' Dữ liệu không hợp lệ');
require_once ('../incfiles/end.php');
exit;
}
if (!$user_id) {
echo functions::display_error('Bạn không thể gửi bình luận');
require_once ('../incfiles/end.php');
exit;
}
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'q' AND `id`='" . $id . "'"), 0);
if ($check == 0) {
echo functions::display_error('Dữ liệu không hợp lệ');
require_once ('../incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
$error = array ();
$text = isset($_POST['text']) ? $_POST['text'] : '';
if(!$text || strlen($text) <= 2 || strlen($text) > 500)
$error[] = 'Văn bản không hợp lệ';
if(!$error) {
mysql_query("INSERT INTO `cms_quiz_com` SET
`quiz` = '$id' ,
`user` = '$user_id',
`text` = '" . mysql_real_escape_string($text) . "',
`time` = '$realtime'
");
header("Location: quiz.php?quiz=$id");
} else {
echo functions::display_error($error, '<a href="quiz.php?quiz='.$id.'">Trở về</a>');
}
}
break;
case 'add' :
$check = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'c' AND `id`='" . $id . "'"), 0);
if ($id && $check != 0) {
if (isset($_POST['submit'])) {
$error = false;
$price = isset ($_POST['price']) ? intval($_POST['price']) : 1;
$true = isset($_POST['true']) ? intval($_POST['true']) : '';
$matter = trim($_POST['matter']);
$option1 = trim($_POST['option1']);
$option2 = trim($_POST['option2']);
$option3 = trim($_POST['option3']);
$option4 = trim($_POST['option4']);
if (($_POST['submit']) && $price < 1 || $price > 99)
$error .= ' Tổng hợp là vượt ra ngoài giới hạn cho phép';
if ($datauser['balans'] < $price)
$error .= ' Bạn ko đủ tiền cược';
if (($_POST['submit']) && empty($matter) || $matter && (strlen($matter) < 2 || strlen($matter) > 500))
$error .= ' Chiều dài của câu hỏi nên được không ít hơn 2 và không quá 500 ký tự';
if (($_POST['submit']) && empty($option1) || empty($option2) || empty($option3) || empty($option4))
$error .= 'Bạn phải điền vào tất cả các lựa chọn của bốn câu trả lời';
if (!$error) {
mysql_query("INSERT INTO `quiz` SET
`user` = '$user_id',
`time` = '$realtime',
`refid` = '$id',
`type` = 'q',
`text` = '" . mysql_real_escape_string($matter) . "',
`price` = '$price',
`true` = '$true',
`option1` = '$option1',
`option2` = '$option2',
`option3` = '$option3',
`option4` = '$option4';");
mysql_query("UPDATE `users` SET `balans`=`balans`-'$price' WHERE `id` = '" . $user_id . "'");
echo '<div class="gmenu"><p>Câu hỏi đặt ra đã được lưu<br /><a href="quiz.php?act=cat&id=' . $id . '">Trong thể loại</a></p></div>';
} else {
echo $error, '<a href="index.php?act=add&amp;id=' . $id . '">Trở về</a>';
}
} else {
$req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'c' AND `id`='" . $id . "'");
$res = mysql_fetch_array($req);
echo '<div class="phdr"><b>Thêm một câu hỏi</b></div>';
echo '<div class="bmenu">Trong thể loại: ' . $res['text'] . '</div>';
echo '<form enctype="multipart/form-data" action="quiz.php?act=add&amp;id=' . $id . '" method="post">';
echo '<div class="menu"><p><h3>Giá</h3><input type="text" size="3" maxlength="2" name="price" value="" />&nbsp;(1xu - 99xu)</p>';
echo '<p><h3>Câu hỏi</h3><textarea name="matter" cols="24" rows="4"></textarea><br /><small>tối thiểu. 2, tối đa. 500 kí tự</small></p>';
echo '<p><h3>Có thể có câu trả lời</h3>Tùy chọn 1:<br /><input type="text" name="option1" /><br />';
echo 'Tùy chọn 2:<br /><input type="text" name="option2" /><br />';
echo 'Tùy chọn 3:<br /><input type="text" name="option3" /><br />';
echo 'Tùy chọn 4:<br /><input type="text" name="option4" /></p>';
echo '<p><h3>Câu trả lời chính xác nằm ở:</h3><select name="true">';
echo '<option value="1">Tùy chọn 1</option>';
echo '<option value="2">Tùy chọn 2</option>';
echo '<option value="3">Tùy chọn 3</option>';
echo '<option value="4">Tùy chọn 4</option>';
echo '</select></p>';
echo '<p><input type="submit" title="Nhấn vào đây để gửi" name="submit" value="Đăng câu hỏi" /></p></div></form>';
echo '<div class="phdr"><a href="index.php?act=mod_quiz&amp;mod=cat&amp;id=' . $id . '">Quay lại</a></div>';
echo '<p><a href="index.php">Admin Panel</a></p>';
}
} else {
if($rights > 3) {
if (isset($_POST['submit'])) {
$error = false;
$name = trim($_POST['name']);
$desc = trim($_POST['desc']);
if (($_POST['submit']) && empty($_POST['name']))
$error .= 'Bạn đã không nhập vào tên thể loại';
if ($name && (strlen($name) < 2 || strlen($name) > 100))
$error .= 'Tiêu đề không được ít hơn 2 và không quá 100 ký tự';
if ($desc && (strlen($desc) < 2 || strlen($desc) > 500))
$error .= 'Mô tả phải lớn hơn 2 và không quá 500 ký tự';
if (!$error) {
mysql_query("INSERT INTO `quiz` SET
`time` = '$realtime',
`type` = 'c',
`soft` = '$desc',
`text` = '" . mysql_real_escape_string($name) . "';");
echo '<div class="gmenu"><p>Thể loại được tạo ra thành công<br /><a href="quiz.php">Tất cả thể loại</a></p></div>';
} else {
echo $error, '<a href="quiz.php?act=add">Làm lại</a>';
}
} else {
echo '<div class="phdr"><b>Thêm một loại</b></div>';
echo '<form enctype="multipart/form-data" action="quiz.php?act=add" method="post">';
echo '<div class="gmenu"><p><h3>Tiêu đề</h3><input type="text" name="name" /><br /><small>Min. 2, tối đa. 100 ký tự</small></p>';
echo '<p><h3>Mô tả</h3><textarea name="desc" cols="24" rows="4"></textarea><br /><small>Min. 2, tối đa. 100 ký tự<br />Mô tả không nhất thiết</small></p>';
echo '<p><input type="submit" title="Nhấn vào đây để gửi" name="submit" value="Lưu" /></p></div></form>';
echo '<div class="phdr"><a href="quiz.php">Trắc nghiệm</a></div>';
}
} else {
echo 'Bạn ko có quyền này';
}
}
break;
default:
echo '<div class="phdr"><b>Quiz</b>'.($rights >= 3 ? ' | <a href="/panel/?act=mod_quiz">Admin Panel</a>' : '').'</div>';
$old = $realtime - (3 * 24 * 3600);
$new = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `time` > '" . $old . "' AND `type` = 'q'"), 0);
echo '<div class="gmenu"><p><a href="quiz.php?act=new">Câu hỏi mới</a> (' . $new . ')</p></div>';
$total = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'c'"), 0);
if ($total) {
$req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'c' LIMIT $start,$kmess");
while ($res = mysql_fetch_array($req)) {
echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
$colq = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $res['id'] . "'"), 0);
echo '<img src="'.$homeurl.'/images/cat.png" alt="cat" />&nbsp;<a href="quiz.php?act=cat&amp;id=' . $res['id'] . '"><b>' . $res['text'] . '</b></a> (' . $colq . ') </div>';
if (!empty($res['soft']))
echo '<div class="sub">' . $res['soft'] . '</div></div>';
++$i;
}
} else {
echo '<div class="menu"><p>Hạng mục không được tạo ra</p></div>';
}
if($rights > 3) {
echo '<div class="phdr"><form action="?act=add" method="post"><input type="submit" value="Thêm thể loại"></form></div>';
}
echo '<div class="phdr">Tổng số hạng mục:&nbsp;' . $total . '</div>';
if ($total > $kmess) {
echo '<p>' . functions::display_pagination('quiz.php?', $start, $total, $kmess) . '</p>';
echo '<p><form action="quiz.php" method="post"><input type="submit" value="Chuyển đến trang &gt;&gt;"/></form></p>';
}
break;
}
require_once ("../incfiles/end.php");
?>
