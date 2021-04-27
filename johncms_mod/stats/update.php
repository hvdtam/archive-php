<?php

define('_IN_JOHNCMS', 1);

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Content-type: application/xhtml+xml; charset=UTF-8");
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en'>
<head>
<meta http-equiv='content-type' content='application/xhtml+xml; charset=utf-8'/>";
echo "<title>Обновление модуля Статистики</title>
<style type='text/css'>
body { font-weight: normal; font-family: Century Gothic; font-size: 12px; color: #FFFFFF; background-color: #000033}
a:link { text-decoration: underline; color : #D3ECFF}
a:active { text-decoration: underline; color : #2F3528 }
a:visited { text-decoration: underline; color : #31F7D4}
a:hover { text-decoration: none; font-size: 12px; color : #E4F992 }
.red { color: #FF0000; font-weight: bold; }
.green{ color: #009933; font-weight: bold; }
.gray{ color: #FF0000; font: small; }
</style>
</head><body>";
echo '<big><b>Модуль статистики 6.2</b></big><br />Обновление<hr />';

// Подключаемся к базе данных
require_once ("../incfiles/db.php");
$connect = mysql_connect($db_host, $db_user, $db_pass) or die('cannot connect to server</body></html>');
mysql_select_db($db_name) or die('cannot connect to db');
mysql_query("SET NAMES 'utf8'", $connect);

$do = isset($_GET['do']) ? $_GET['do'] : '';
switch ($do)
{
    case 'step1':
        echo '<b><u>Chuẩn bị các bảng</u></b><br />';
        // Таблица
		mysql_query("ALTER TABLE `counter` ADD `ip_via_proxy` VARCHAR( 15 ) NOT NULL AFTER `ip`;");
        echo '<span class="green">OK</span> bảng truy cập được cập nhật thành công<br />';

        echo '<hr /><a href="update.php?do=final">Tiến hành</a>';
        break;

    case 'final':
        echo '<b><span class="green">Xin chúc mừng!</span></b><br />Thủ tục cập nhật kết thúc thành công. <br /> Đừng quên để xóa các tập tin update.php';
        echo '<hr /><a href="../../index.php">Trở lại</a>';
        break;

    default:
        echo '<p><big><span class="red">ВНИМАНИЕ!</span></big><ul>';
        echo '<li>Trước khi bắt đầu quá trình nâng cấp, luôn luôn tạo bản sao lưu cơ sở dữ liệu. Nếu vì một số lý do cài đặt không diễn ra cho đến khi kết thúc, bạn phải khôi phục lại cơ sở dữ liệu từ bản sao lưu.</li>';
        echo '<li>Nếu bạn nhấp vào liên kết "Tiếp tục", bãi bỏ những thay đổi trong cơ sở dữ liệu sẽ không có thể mà không khôi phục lại từ bản sao lưu.</li>';
        echo '<li></li>';
        echo '</ul></p>';
        echo '<hr />Bạn có chắc chắn?<br /><a href="update.php?do=step1">Tiến hành</a>';
}

echo '</body>
</html>';

?>