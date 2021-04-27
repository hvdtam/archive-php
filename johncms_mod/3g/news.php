<?
define('_IN_VINAFUN', 1);
require_once ('replacetonghop.php');
$duongdan = $_GET['view'];
$url= "http://docbao.viettelmobile.com.vn".$duongdan."";
$source = grab_link($url);
$batdau = '<b>';
$ketthuc = '-------------';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?view=',$tinphp);
$tinphp = preg_replace("/<a href='/",'<a href="?view=',$tinphp);
$tinphp = preg_replace('#<img src="#is','<img alt="image" src="http://docbao.viettelmobile.com.vn/',$tinphp);
$tinphp = preg_replace("#<img src='#is",'<img alt="image" src="http://docbao.viettelmobile.com.vn/',$tinphp);
$title = explode('<b>',$tinphp);
$title = explode('</b><br/>',$title[1]);
$title = $title[0];
include 'head.php';
echo $tinphp;
include ("foot.php");
?>