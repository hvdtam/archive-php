<?php

/*
WMR: R118530587041
ICQ: 365848916
Автор: VladiSs
Сайт: http://wapnex.ru
*/

defined('_IN_JOHNCMS') or die('Error: restricted access');

if (empty($_GET['n'])) {
    require('../incfiles/head.php');
    echo functions::display_error($lng['error_wrong_data']);
    require('../incfiles/end.php');
    exit;
}
$n = trim($_GET['n']);
$o = opendir("../files/soo/forum/topics");
while ($f = readdir($o)) {
    if ($f != "." && $f != ".." && $f != "../soo/?mod=forum" && $f != ".htaccess") {
        $ff = functions::format($f);
        $f1 = str_replace(".$ff", "", $f);
        $a[] = $f;
        $b[] = $f1;
    }
}
$tt = count($a);
if (!in_array($n, $b)) {
    require_once('../incfiles/head.php');
    echo functions::display_error($lng['error_wrong_data']);
    require_once('../incfiles/end.php');
    exit;
}
for ($i = 0; $i < $tt; $i++) {
    $tf = functions::format($a[$i]);
    $tf1 = str_replace(".$tf", "", $a[$i]);
    if ($n == $tf1) {
        header("Location: ../files/soo/forum/topics/$n.$tf");
    }
}

?>