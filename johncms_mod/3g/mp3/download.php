<?php
include'curl.php';
$url='http://mp3.zing.vn/bai-hat/tylg/'.$_GET['id'].'.html';
$html=get($url);
$link='http://mp3.zing.vn/download/song/'.pick('"http://mp3.zing.vn/download/song/','"',$html);
header("Location: $link");
?>
