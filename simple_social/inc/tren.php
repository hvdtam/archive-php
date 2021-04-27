<?php

if (isset($_COOKIE['the']))
{
$the = $_COOKIE['the'];
}
elseif (!$is_mobile)
{
$the = 'wap';
} else {
$the = 'web';
}
if ($the == 'web')
{
$version = 'web';
$vers = 'tren_web.php';
$end_vers = 'duoi_web.php';
}
if ($the == 'wap')
{
$version = 'wap';
$vers = 'tren_wap.php';
$end_vers = 'duoi_wap.php';
}
require_once (''.$vers.'');

?>
