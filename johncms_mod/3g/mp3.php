<?php
include"head.php";
$q=$_GET['q'];
if(empty($q)){$file=file_get_contents('http://mobile.socbay.com/wap/wap/tim-kiem/0/mp3');}else{$file=file_get_contents('http://mobile.socbay.com/wap/wap/tim-kiem/0/mp3/'.$q) ;} $file=preg_replace('|<?(.*?)<body>|is','<body>',$file); $file=str_replace('"http://mobile.socbay.com/wap/wap/tim-kiem/0/mp3','"/mp3.php?q=',$file);  $file=preg_replace('|<body(.*?)submit(.*?)>|is','<body><b style="color:green;">Tên bài hát: (cs) :</b><br/><form method="GET" action="mp3.php"><input type="text" name="q"><input type="submit" value="Tìm">',$file); $file=preg_replace('|<div class="go-back(.*?)href="http://mobile.socbay.com(.*?)</html>|is','',$file);  echo(!empty($file))?$file: 'ERROR';
include"foot.php";
?>