<?php

$url='http://mp3.m.zing.vn/web/artist/list?'.$_SERVER['QUERY_STRING'];
include'get-and-edit.php';
include'../head.php';
echo $html;
include'../end.php';

?>
