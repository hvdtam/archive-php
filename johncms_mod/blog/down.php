<?php
require_once('inc/db.php');
require_once('inc/fun.php');require_once('inc/seo.php');
$id = $_GET['id'];
if(!isset($id)){
b_go('index.html');
}
$tit = 'Tải Bài Viết';
require_once('inc/tren.php');
div('menu', '&rsaquo; <b>Tải Bài Viết</b>');$sql = mysql_query("SELECT url, name, noidung FROM `truyen` WHERE `id`='$id'");
if(mysql_num_rows($sql) == 0) {
div('main', 'Không tìm thấy bài viết này!');
exit; }
$ar = mysql_fetch_array($sql);
$strlen = strlen($ar['noidung']);
$file = seo($ar['name']).'.jar';
$file2 = seo($ar['name']).'.jad';
if(!file_exists('files/'.$file)) {
$result = "\n".$ar['name']."\n\n----------\n\n".$ar['noidung']."\n\nWap truyện $home";
file_put_contents('java/11111', $result);
$manifest_text = 'Manifest-Version: 1.0
MIDlet-Vendor: BenTreWap.Com
Langid: 1
MIDlet-Version: 1.9.3
Nokia-MIDlet-On-Screen-Keypad: no
Created-By: 14.2-b01 (Sun Microsystems Inc.)
MIDlet-Data-Size: 32000
MIDlet-Name: '.$ar['name'].'
Ant-Version: Apache Ant 1.7.0
MicroEdition-Configuration: CLDC-1.0
MIDlet-1: '.$ar['name'].', /i.png, BenTreWap
Codes: 11111
MIDlet-Icon: /i.png
MIDlet-Info-URL: '.$home.'
MIDlet-Description: Ứng dụng Đọc truyện '.$ar['name'].'
MIDlet-Delete-Confirm: Đọc thêm truyện hay, truyện mới, thư giản '.$home.'
MicroEdition-Profile: MIDP-2.0';
file_put_contents('java/META-INF/MANIFEST.MF', $manifest_text);
require_once ('inc/zip.php');
$archive = new PclZip('files/'.$file);
$list = $archive->create('java', PCLZIP_OPT_REMOVE_PATH, 'java');
if(!file_exists('files/'.$file2)){
$filesize = filesize('files/'.$file);
$jad_text = $manifest_text.'
MIDlet-Jar-Size: '.$filesize.'
MIDlet-Jar-URL: '.$home.'/files/'.$file;
$files = fopen('files/'.$file2, 'w+');
flock($files, LOCK_EX);
fputs($files, $jad_text);
flock($files, LOCK_UN);
fclose($files);
}
div('main', '<img src="img/next.png">Truyện: '.$ar['name'].'<br><img src="img/next.png">Tải xuống: <a href="files/'.$file.'">JAR</a> | <a href="files/'.$file2.'">JAD</a>').div('main', '<img src="img/next.png"><a href="tr_'.$ar['url'].'.html">Quay lại</a>');
}else{
div('main', '<img src="img/next.png">Truyện: '.$ar['name'].'<br><img src="img/next.png">Tải xuống: <a href="files/'.$file.'">JAR</a> | <a href="files/'.$file2.'">JAD</a>').div('main', '<img src="img/next.png"><a href="tr_'.$ar['url'].'.html">Quay lại</a>');
}
require 'inc/duoi.php';
?>