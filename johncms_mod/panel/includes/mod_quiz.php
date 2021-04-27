<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS v.1.1.0                     30.05.2008                             //
// Официальный сайт сайт проекта:      http://johncms.com                     //
// Дополнительный сайт поддержки:      http://gazenwagen.com                  //
////////////////////////////////////////////////////////////////////////////////
// JohnCMS core team:                                                         //
// Евгений Рябинин aka john77          john77@gazenwagen.com                  //
// Олег Касьянов aka AlkatraZ          alkatraz@gazenwagen.com                //
//                                                                            //
// Плагиат и удаление копирайтов заруганы на ближайших родственников!!!       //
////////////////////////////////////////////////////////////////////////////////
// Автор модуля - Янулов
*/

defined('_IN_JOHNADM') or die('Error: restricted access');

if ($rights < 3)
    die('Error: restricted access');

switch ($mod) {
    case "close":
        if (isset($_GET['yes'])) {
            $dc = $_SESSION['dc'];
            foreach ($dc as $closeid) {
                mysql_query("UPDATE `cms_quiz_log` SET `close` = '1' WHERE `id`='" . intval($closeid) . "';");
            }
            echo "Người chiến thắng được đánh dấu ẩn<br/><a href='index.php?act=mod_quiz&amp;mod=winners'>Quay lại</a><br/>";
        } else {
            if (empty($_POST['closech'])) {
                echo '<p>Bạn không chọn ẩn<br/><a href="index.php?act=mod_quiz&amp;mod=winners">Quay lại</a></p>';
                require_once("../incfiles/end.php");
                exit;
            }
            foreach ($_POST['closech'] as $v) {
                $dc[] = intval($v);
            }
            $_SESSION['dc'] = $dc;
            echo '<p>Bạn có chắc chắn muốn ẩn những người đoạt giải được lựa chọn?<br/><a href="index.php?act=mod_quiz&amp;mod=close&amp;yes">Có</a> | <a href="index.php?act=mod_quiz&amp;mod=winners">Không</a></p>';
        }
        break;

    case "delete":
        if (!$id) {
            echo 'Dữ liệu không hợp lệ';
            require_once ('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `quiz` WHERE `id`='$id'");
        $res = mysql_fetch_array($req);
        switch ($res['type']) {
            case 'q' :
                if (isset ($_GET['yes'])) {
                    mysql_query("DELETE FROM `quiz` WHERE `type` = 'q' AND `id` = '" . $id . "'");
                    mysql_query("DELETE FROM `cms_quiz_log` WHERE `matter_id` = '" . $id . "'");
                    echo '<div class="gmenu"><p>Thể loại xoá thành công!<br/><a href="index.php?act=mod_quiz&amp;mod=cat&amp;id=' . $res['refid'] . '">Tiếp tục</a></p></div>';
                } else {
                    echo '<div class="phdr"><b>Loại bỏ các vấn đề</b></div>';
                    echo '<div class="rmenu"><p>Bạn có chắc chắn muốn xóa các câu hỏi?<br /><a href="index.php?act=mod_quiz&amp;mod=delete&amp;id=' . $id . '&amp;yes">Xóa</a> | <a href="index.php?act=mod_quiz&amp;mod=cat&amp;id=' . $res['refid'] . '">Huỷ</a></p></div>';
                    echo '<div class="phdr">&nbsp;</div>';
                }
                break;

            case 'c' :
                echo '<div class="phdr"><b>Xóa thể loại:</b> ' . $res['text'] . '</div>';
                if (isset ($_GET['yes'])) {
                    mysql_query("DELETE FROM `quiz` WHERE `type` = 'c' AND `id` = '" . $id . "'");
                    mysql_query("DELETE FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $id . "'");
                    echo '<div class="rmenu"><p>Thể loại bỏ</p></div>';
                } else {
                    echo '<form action="index.php?act=mod_quiz&amp;mod=delete&amp;id=' . $id . '&amp;yes" method="post">';
                    echo '<div class="rmenu"><p>Bạn có thực sự muốn xóa các thể loại?</p><p><input type="submit" value=" Xóa "/></p></div>';
                    echo '</form>';
                }
                echo '<div class="phdr"><a href="index.php?act=mod_quiz">Quay lại</a></div>';
                break;
        }
        break;

    case 'edit' :
        if (!$id) {
            echo 'Dữ liệu không hợp lệ';
            require_once ('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `quiz` WHERE `id`='" . $id . "';");
        $res = mysql_fetch_array($req);
        switch ($res['type']) {
            case 'q' :
                if (isset($_POST['submit'])) {
                    $error = array ();
                    $price = isset ($_POST['price']) ? intval($_POST['price']) : 1;
                    $true = isset($_POST['true']) ? intval($_POST['true']) : '';
                    $matter = trim($_POST['matter']);
                    $option1 = trim($_POST['option1']);
                    $option2 = trim($_POST['option2']);
                    $option3 = trim($_POST['option3']);
                    $option4 = trim($_POST['option4']);
                    if (($_POST['submit']) && $price < 1 || $price > 99)
                        $error[] = 'Tổng hợp là vượt ra ngoài giới hạn cho phép';
                    if (($_POST['submit']) && empty($matter) || $matter && (strlen($matter) < 2 || strlen($matter) > 500))
                        $error[] = 'Chiều dài của câu hỏi không được ít hơn 2 và không quá 500 ký tự';
                    if (($_POST['submit']) && empty($option1) || empty($option2) || empty($option3) || empty($option4))
                        $error[] = 'Bạn phải điền vào tất cả các lựa chọn trả lời';
                    if (!$error) {
                        mysql_query("UPDATE `quiz` SET
                `text` = '" . mysql_real_escape_string($matter) . "',
                `price` = '$price',
                `true` = '$true',
                `option1` = '$option1',
                `option2` = '$option2',
                `option3` = '$option3',
                `option4` = '$option4'
                 WHERE `id` = '" . $id . "';");
                        header("location: index.php?act=mod_quiz&mod=cat&id=$res[refid]");
                    } else {
                        echo $error, '<a href="index.php?act=mod_quiz&amp;mod=edit&amp;id=' . $id . '">Trở về</a>';
                    }
                } else {
                    $price = $res['price'];
                    $matter = htmlentities($res['text'], ENT_QUOTES, 'UTF-8');
                    $option1 = htmlentities($res['option1'], ENT_QUOTES, 'UTF-8');
                    $option2 = htmlentities($res['option2'], ENT_QUOTES, 'UTF-8');
                    $option3 = htmlentities($res['option3'], ENT_QUOTES, 'UTF-8');
                    $option4 = htmlentities($res['option4'], ENT_QUOTES, 'UTF-8');
                    echo '<div class="phdr"><b>Chỉnh sửa câu hỏi</b></div>';
                    echo '<form enctype="multipart/form-data" action="index.php?act=mod_quiz&amp;mod=edit&amp;id=' . $id . '" method="post">';
                    echo '<div class="menu"><p><h3>Giá</h3><input type="text" size="3" maxlength="2" name="price" value="' . $price . '" />&nbsp;(1 - 99)</p>';
                    echo '<p><h3>Câu hỏi</h3><textarea name="matter" cols="24" rows="4">' . $matter . '</textarea><br /><small>tối thiểu. 2, tối đa. 500 Kí tự</small></p>';
                    echo '<p><h3>Có thể có câu trả lời</h3>Tùy chọn 1:<br /><input type="text" value="' . $option1 . '" name="option1" /><br />';
                    echo 'Tùy chọn 2:<br /><input type="text" value="' . $option2 . '" name="option2" /><br />';
                    echo 'Tùy chọn 3:<br /><input type="text" value="' . $option3 . '" name="option3" /><br />';
                    echo 'Tùy chọn 4:<br /><input type="text" value="' . $option4 . '" name="option4" /></p>';
                    echo '<p><h3>Câu trả lời chính xác nằm ở:</h3><select name="true">';
                    echo '<option value="1"' . ($res['true'] == 1 ? ' selected="selected">' : '>') . 'Tùy chọn 1</option>';
                    echo '<option value="2"' . ($res['true'] == 2 ? ' selected="selected">' : '>') . 'Tùy chọn 2</option>';
                    echo '<option value="3"' . ($res['true'] == 3 ? ' selected="selected">' : '>') . 'Tùy chọn 3</option>';
                    echo '<option value="4"' . ($res['true'] == 4 ? ' selected="selected">' : '>') . 'Tùy chọn 4</option>';
                    echo '</select></p>';
                    echo '<p><input type="submit" title="Nhấn vào đây để gửi" name="submit" value="Đăng câu hỏi" /></p></div></form>';
                    echo '<div class="phdr"><a href="index.php?act=mod_quiz&amp;mod=cat&amp;id=' . $res['refid'] . '">Quay lại</a></div>';
                    echo '<p><a href="index.php">Admin Panel</a></p>';
                }
                break;

            case 'c' :
                if (isset($_POST['submit'])) {
                    $error = array ();
                    $name = trim($_POST['name']);
                    $desc = trim($_POST['desc']);
                    if (($_POST['submit']) && empty($_POST['name']))
                        $error[] = 'Bạn đã không nhập vào tên thể loại';
                    if ($name && (strlen($name) < 2 || strlen($name) > 100))
                        $error[] = 'Tiêu đề không được ít hơn 2 và không quá 100 ký tự';
                    if ($desc && (strlen($desc) < 2 || strlen($desc) > 500))
                        $error[] = 'Mô tả không được ít hơn 2 và không quá 500 ký tự';
                    if (!$error) {
                        mysql_query("UPDATE `quiz` SET
                `soft` = '$desc',
                `text` = '" . mysql_real_escape_string($name) . "'
                 WHERE `id` = '" . $id . "';");
                        header("location: index.php?act=mod_quiz");
                    } else {
                        echo $error, '<a href="index.php?act=mod_quiz&amp;mod=edit&amp;id=' . $id . '">Làm lại</a>';
                    }
                } else {
                    $name = htmlentities($res['text'], ENT_QUOTES, 'UTF-8');
                    $desc = htmlentities($res['soft'], ENT_QUOTES, 'UTF-8');
                    echo '<div class="phdr"><b>Chỉnh sửa chuyên mục</b></div>';
                    echo '<form enctype="multipart/form-data" action="index.php?act=mod_quiz&amp;mod=edit&amp;id=' . $id . '" method="post">';
                    echo '<div class="gmenu"><p><h3>Tiêu đề</h3><input type="text" value="' . $name . '" name="name"/><br /><small>tối thiểu. 2, tối đa. 100 ký tự</small></p>';
                    echo '<p><h3>Mô tả</h3><textarea name="desc" cols="24" rows="4">' . $desc . '</textarea><br /><small>tối thiểu. 2, tối đa. 100 ký tự<br />Mô tả không nhất thiết</small></p>';
                    echo '<p><input type="submit" title="Nhấn vào đây để gửi" name="submit" value="Lưu" /></p></div></form>';
                    echo '<div class="phdr"><a href="index.php?act=mod_quiz">Quay lại</a></div>';
                    echo '<p><a href="index.php">Admin Panel</a></p>';
                }
                break;
        }
        break;

    case 'add' :
        if ($id) {
            if (isset($_POST['submit'])) {
                $error = array ();
                $price = isset ($_POST['price']) ? intval($_POST['price']) : 1;
                $true = isset($_POST['true']) ? intval($_POST['true']) : '';
                $matter = trim($_POST['matter']);
                $option1 = trim($_POST['option1']);
                $option2 = trim($_POST['option2']);
                $option3 = trim($_POST['option3']);
                $option4 = trim($_POST['option4']);
                if (($_POST['submit']) && $price < 1 || $price > 99)
                    $error[] = ' Tổng hợp là vượt ra ngoài giới hạn cho phép';
                if (($_POST['submit']) && empty($matter) || $matter && (strlen($matter) < 2 || strlen($matter) > 500))
                    $error[] = ' Chiều dài của câu hỏi nên được không ít hơn 2 và không quá 500 ký tự';
                if (($_POST['submit']) && empty($option1) || empty($option2) || empty($option3) || empty($option4))
                    $error[] = 'Bạn phải điền vào tất cả các lựa chọn của bốn câu trả lời';
                if (!$error) {
                    mysql_query("INSERT INTO `quiz` SET
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
                    echo '<div class="gmenu"><p>Câu hỏi đặt ra đã được lưu<br /><a href="index.php?act=mod_quiz&amp;mod=cat&amp;id=' . $id . '">Trong thể loại</a></p></div>';
                } else {
                    echo $error, '<a href="index.php?act=mod_quiz&amp;mod=add&amp;id=' . $id . '">Trở về</a>';
                }
            } else {
                $req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'c' AND `id`='" . $id . "'");
                $res = mysql_fetch_array($req);
                echo '<div class="phdr"><b>Thêm một câu hỏi</b></div>';
                echo '<div class="bmenu">Trong thể loại: ' . $res['text'] . '</div>';
                echo '<form enctype="multipart/form-data" action="index.php?act=mod_quiz&amp;mod=add&amp;id=' . $id . '" method="post">';
                echo '<div class="menu"><p><h3>Giá</h3><input type="text" size="3" maxlength="2" name="price" value="" />&nbsp;(1 - 99)</p>';
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
            if (isset($_POST['submit'])) {
                $error = array ();
                $name = trim($_POST['name']);
                $desc = trim($_POST['desc']);
                if (($_POST['submit']) && empty($_POST['name']))
                    $error[] = 'Bạn đã không nhập vào tên thể loại';
                if ($name && (strlen($name) < 2 || strlen($name) > 100))
                    $error[] = 'Tiêu đề không được ít hơn 2 và không quá 100 ký tự';
                if ($desc && (strlen($desc) < 2 || strlen($desc) > 500))
                    $error[] = 'Mô tả phải lớn hơn 2 và không quá 500 ký tự';
                if (!$error) {
                    mysql_query("INSERT INTO `quiz` SET
                `time` = '$realtime',
                `type` = 'c',
                `soft` = '$desc',
                `text` = '" . mysql_real_escape_string($name) . "';");
                    echo '<div class="gmenu"><p>Thể loại được tạo ra thành công<br /><a href="index.php?act=mod_quiz">Tất cả thể loại</a></p></div>';
                } else {
                    echo $error, '<a href="index.php?act=mod_quiz&amp;mod=add">Lặp lại</a>';
                }
            } else {
                echo '<div class="phdr"><b>Thêm một loại</b></div>';
                echo '<form enctype="multipart/form-data" action="index.php?act=mod_quiz&amp;mod=add" method="post">';
                echo '<div class="gmenu"><p><h3>Tiêu đề</h3><input type="text" name="name" /><br /><small>Min. 2, tối đa. 100 ký tự</small></p>';
                echo '<p><h3>Mô tả</h3><textarea name="desc" cols="24" rows="4"></textarea><br /><small>Min. 2, tối đa. 100 ký tự<br />Mô tả không nhất thiết</small></p>';
                echo '<p><input type="submit" title="Nhấn vào đây để gửi" name="submit" value="Lưu" /></p></div></form>';
                echo '<div class="phdr"><a href="index.php?act=mod_quiz">Назад</a></div>';
                echo '<p><a href="index.php">Admin Panel</a></p>';
            }
        }
        break;

    case 'cat' :
        if (!$id) {
            echo 'Dữ liệu không hợp lệ';
            require_once ('../incfiles/end.php');
            exit;
        }
        $req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'c' AND `id`='" . $id . "'");
        $res = mysql_fetch_array($req);
        echo '<div class="phdr"><b>' . $res['text'] . '</b> | Danh mục các vấn đề</div>';
        $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $id . "'"), 0);
        $req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $id . "' ORDER BY `time` DESC LIMIT $start,$kmess");
        while ($res = mysql_fetch_array($req)) {
            echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
            $text = htmlentities($res['text'], ENT_QUOTES, 'UTF-8');
            $text = functions::checkout($text, 1, 1);
            $text = str_replace("\r\n", "<br />", $text);
            $text = functions::smileys($text, 1);
            echo '<p><h3><img src="'.$homeurl.'/images/question.png" width="16" height="16" class="left" />&nbsp;Câu hỏi</h3><ul>';
            echo '<span class ="gray"><small>Giá: <b>' . $res['price'] . '</b> VGold</small></span></ul></p><p>' . $text . '</p>';
            echo '<p><h3><img src="'.$homeurl.'/images/star.gif" width="16" height="16" class="left" />&nbsp;Đáp án có thể là:</h3><ul>';
            echo '<li>' . $res['option1'] . '</li>';
            echo '<li>' . $res['option2'] . '</li>';
            echo '<li>' . $res['option3'] . '</li>';
            echo '<li>' . $res['option4'] . '</li></ul></p>';
            echo '<div class="sub"><a href="index.php?act=mod_quiz&amp;mod=edit&amp;id=' . $res['id'] . '">Chỉnh sửa</a> | ';
            echo '<a href="index.php?act=mod_quiz&amp;mod=delete&amp;id=' . $res['id'] . '">Xóa</a></div></div>';
            ++$i;
        }
        echo '<div class="gmenu"><form action="index.php?act=mod_quiz&amp;mod=add&amp;id=' . $id . '" method="post"><input type="submit" value="Thêm" /></form></div>';
        echo '<div class="phdr"><a href="index.php?act=mod_quiz">Tất cả thể loại</a></div>';
        if ($total > $kmess) {
            echo '<p>' . functions::display_pagination('index.php?act=mod_guiz&amp;mod=cat&amp;id=' . $id . '&amp;', $start, $total, $kmess) . '</p>';
            echo '<p><form action="index.php?act=mod_guiz&amp;mod=cat&amp;id=' . $id . '" method="post"><input type="submit" value="Chuyển đến trang &gt;&gt;"/></form></p>';
        }
        echo '<p><a href="index.php">Admin Panel</a></p>';
        break;

    case 'winners' :
        echo '<div class="phdr"><b>Những người trả lời chính xác trắc nghiệm</b></div>';
        $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `result` = 'true' AND `close` != '1'"), 0);
        if ($total) {
            $req = mysql_query("SELECT * FROM `cms_quiz_log` WHERE `result` = 'true' AND `close` != '1' ORDER BY `time` DESC LIMIT $start,$kmess");
            echo '<form action="index.php?act=mod_quiz&amp;mod=close" method="post">';
            while ($res = mysql_fetch_array($req)) {
                echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
                $user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `id`='" . $res['user_id'] . "';"));
                $matter = mysql_fetch_array(mysql_query("SELECT * FROM `quiz` WHERE `id`='" . $res['matter_id'] . "';"));
                echo '<img src="'.$homeurl.'/images/coins.png" alt="coins" />&nbsp;<span class="green">' . $matter['price'] . '</span>&nbsp;';
                echo '<a href="../users/profile.php?user=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>&nbsp;';
                echo '<span class="gray">(' . date("d.m.y / H:i", $res['time'] + $set_user['sdvig'] * 3600) . ')</span><br />';
                echo '<img src="'.$homeurl.'/images/card.png" alt="card" />&nbsp;Props: R' . $res['purse'];
                echo '<div class="sub"><input type="checkbox" name="closech[]" value="' . $res['id'] . '"/>&nbsp;' . $matter['text'] . '</div></div>';
                ++$i;
            }
            echo '<div class="rmenu"><input type="submit" value=" Che "/></div>';
            echo '</form>';
        } else {
            echo '<div class="menu"><p>Danh sách này chưa có người nào</p></div>';
        }
        echo '<div class="phdr"><a href="index.php?act=mod_quiz">Quay lại</a></div>';
        if ($total > $kmess) {
            echo '<p>' . functions::display_pagination('index.php?act=mod_guiz&amp;mod=winners&amp;', $start, $total, $kmess) . '</p>';
            echo '<p><form action="index.php?act=mod_guiz&amp;mod=winners" method="post"><input type="submit" value="Chuyển đến trang &gt;&gt;"/></form></p>';
        }
        echo '<p><a href="index.php">Admin Panel</a></p>';
        break;

    default :
        echo '<div class="phdr"><a href="index.php"><b>Admin Panel</b></a> | Trắc nghiệm</div>';
        $vn = mysql_result(mysql_query("SELECT COUNT(*) FROM `cms_quiz_log` WHERE `result` = 'true' AND `close` != '1'"), 0);
        echo '<div class="rmenu"><a href="index.php?act=mod_quiz&amp;mod=winners">Những người trả lời đúng của trắc nghiệm:</a> (' . $vn . ')</div>';
        $total = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'c'"), 0);
        $req = mysql_query("SELECT * FROM `quiz` WHERE `type` = 'c' LIMIT $start,$kmess");
        while ($res = mysql_fetch_array($req)) {
            echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
            $colq = mysql_result(mysql_query("SELECT COUNT(*) FROM `quiz` WHERE `type` = 'q' AND `refid` = '" . $res['id'] . "'"), 0);
            echo '<img src="'.$homeurl.'/images/cat.png" alt="cat" />&nbsp;<a href="index.php?act=mod_quiz&amp;mod=cat&amp;id=' . $res['id'] . '"><b>' . $res['text'] . '</b></a> (' . $colq . ') <a href="../users/quiz.php?act=cat&amp;id=' . $res['id'] . '">&gt;&gt;</a>';
            if (!empty($res['soft']))
                echo '<br /><small><span class="gray">' . $res['soft'] . '</span></small>';
            echo '<div class="sub"><a href="index.php?act=mod_quiz&amp;mod=edit&amp;id=' . $res['id'] . '">Chỉnh sửa</a> | ';
            echo '<a href="index.php?act=mod_quiz&amp;mod=delete&amp;id=' . $res['id'] . '">Xóa</a></div></div>';
            ++$i;
        }
        echo '<div class="gmenu"><form action="index.php?act=mod_quiz&amp;mod=add" method="post"><input type="submit" value="Thêm" /></form></div>';
        echo '<div class="phdr"><a href="../users/quiz.php">Trắc nghiệm</a></div>';
        if ($total > $kmess) {
            echo '<p>' . functions::display_pagination('index.php?act=mod_guiz&amp;', $start, $total, $kmess) . '</p>';
            echo '<p><form action="index.php?act=mod_guiz" method="post"><input type="submit" value="Chuyển đến trang &gt;&gt;"/></form></p>';
        }
        echo '<p><a href="index.php">Admin Panel</a></p>';
}

?>