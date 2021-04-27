<?php
require_once ('ae.php');

// Устанавливаем текущее время
$time = time();

// Соединение с базой
$dbcnx = mysql_connect($db_host,$db_user,$db_pass);
if (!$dbcnx) {exit ("Сервер базы данных не доступен");}
if (!mysql_select_db($db_name , $dbcnx)){exit ("База данных не доступна");}
mysql_query('SET NAMES "utf8"');

if (get_magic_quotes_gpc()) {
// Удаляем слэши, если открыт magic_quotes_gpc
$in = array(& $_GET, & $_POST, & $_COOKIE);
while (list($k, $v) = each($in)) {
foreach ($v as $key => $val) {
if (!is_array($val)) {
$in[$k][$key] = stripslashes($val);
continue;
}
$in[] = & $in[$k][$key];
}
}
unset ($in);
if (!empty ($_FILES)) {
foreach ($_FILES as $k => $v) {
$_FILES[$k]['name'] = stripslashes((string) $v['name']);
}
}
}

// Буфферизация вывода
if ($set['gzip'] && @extension_loaded('zlib')) {
@ini_set('zlib.output_compression_level', 3);
ob_start('ob_gzhandler');
}
else {
ob_start();
}
session_start();

$usr_ps = false;
$usr_id = false;
$level =  0;

// Права доступа
if (isset($_COOKIE['cusr_ps']) && isset($_COOKIE['cusr_id'])) {
$usr_id = intval(base64_decode($_COOKIE['cusr_id']));
$usr_ps = md5(base64_decode($_COOKIE['cusr_ps']));
$_SESSION['usr_id'] = $usr_id;
$_SESSION['usr_ps'] = $usr_ps;
}

$usr_id = isset($_SESSION['usr_id']) ? intval($_SESSION['usr_id']) : '';
$usr_ps = isset($_SESSION['usr_ps']) ? $_SESSION['usr_ps'] : '';

// Получаем основные настройки системы
// Задаем настройки системы
$m = mysql_query("SELECT * FROM `set`;");
$set = array();
while ($res = mysql_fetch_row($m)) $set[$res[0]] = $res[1];
mysql_free_result($m);
$home = $set['home'];
$num = $set['on_page'];

//Получаем и фильтруем основные переменные для системы
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$page = isset ($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;

// Запрос к юзеру
if ($usr_ps && $usr_id) {
$req = mysql_query("SELECT * FROM `users` WHERE `id` = '$usr_id' LIMIT 1");
if (mysql_num_rows($req)) {
$datauser = mysql_fetch_assoc($req);
if ($usr_ps === $datauser['pass']) {
// Получаем данные пользователя
$login = $datauser['name'];            // Логин (Ник) пользователя
//  $level = $datauser['level'];
$level = 2;
// Статус юзера
$status = array(1 =>'Модератор',2 =>'Администратор');

}
else {
// Если пароль не совпадает, уничтожаем переменные сессии и чистим куки
unset ($_SESSION['usr_id']);
unset ($_SESSION['usr_ps']);
setcookie('cusr_id', '');
setcookie('cusr_ps', '');
$cusr_id = false;
$cusr_ps = false;
}
}
else {
// Если юзер не найден, уничтожаем переменные сессии и чистим куки
unset ($_SESSION['usr_id']);
unset ($_SESSION['usr_ps']);
setcookie('cusr_id', '');
setcookie('cusr_ps', '');
$cusr_id = false;
$cusr_ps = false;
}
}

// Подключаем файл функций
require_once ('func.php');
// Кто online
$ons = mysql_query("SELECT * FROM `online` WHERE `ip` = '".ip2int(getip())."'");
if (mysql_num_rows($ons)) {
mysql_query("UPDATE `online` SET `time` = $time WHERE `ip` = '".ip2int(getip())."'");
} else {
mysql_query("INSERT INTO `online` SET `ip` = '".ip2int(getip())."' , `time` = $time");
}
mysql_query("DELETE FROM `online` WHERE `time` + 300 < $time ");
?>
