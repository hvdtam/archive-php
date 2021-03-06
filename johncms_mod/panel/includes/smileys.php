<?php

/**
 * @package     JohnCMS
 * @link        http://johncms.com
 * @copyright   Copyright (C) 2008-2011 JohnCMS Community
 * @license     LICENSE.txt (see attached file)
 * @version     VERSION.txt (see attached file)
 * @author      http://johncms.com/about
 */

defined('_IN_JOHNADM') or die('Error: restricted access');

echo '<div class="phdr"><a href="index.php"><b>' . $lng['admin_panel'] . '</b></a> | ' . $lng['smileys'] . '</div>';

$ext = array('gif', 'jpg', 'jpeg', 'png'); // Список разрешенных расширений
$smileys = array();

// Обрабатываем простые смайлы
foreach(glob($rootpath . 'images/smileys/simply/*') as $var){
    $file = basename($var);
    $name = explode(".", $file);
    if (in_array($name[1], $ext)) {
        $smileys['usr'][':' . $name[0]] = '<img src="' . $set['homeurl'] . '/images/smileys/simply/' . $file . '" alt="" />';
    }
}

// Обрабатываем Админские смайлы
foreach(glob($rootpath . 'images/smileys/admin/*') as $var){
    $file = basename($var);
    $name = explode(".", $file);
    if (in_array($name[1], $ext)) {
        $smileys['adm'][':' . functions::trans($name[0]) . ':'] = '<img src="' . $set['homeurl'] . '/images/smileys/admin/' . $file . '" alt="" />';
        $smileys['adm'][':' . $name[0] . ':'] = '<img src="' . $set['homeurl'] . '/images/smileys/admin/' . $file . '" alt="" />';
    }
}

// Обрабатываем смайлы каталога
foreach(glob($rootpath . 'images/smileys/user/*/*') as $var){
    $file = basename($var);
    $name = explode(".", $file);
    if (in_array($name[1], $ext)) {
        $path = str_replace('..', $set['homeurl'], dirname($var));
        $smileys['usr'][':' . functions::trans($name[0]) . ':'] = '<img src="' . $path . '/' . $file . '" alt="" />';
        $smileys['usr'][':' . $name[0] . ':'] = '<img src="' . $path . '/' . $file . '" alt="" />';
    }
}

// Записываем в файл Кэша
if (file_put_contents($rootpath . 'files/cache/smileys.dat', serialize($smileys))) {
    echo '<div class="gmenu"><p>' . $lng['smileys_updated'] . '</p></div>';
} else {
    echo '<div class="rmenu"><p>' . $lng['smileys_error'] . '</p></div>';
}
$total = count($smileys['adm']) + count($smileys['usr']);
echo '<div class="phdr">' . $lng['total'] . ': ' . $total . '</div>';
echo '<p><a href="index.php">' . $lng['admin_panel'] . '</a></p>';

?>
