<link rel="stylesheet" type="text/css" href="http://kenh143.vcmedia.vn/soha/c/style.css?v=3">
<?php
define('_IN_VINAFUN', 1);
require_once ('replacetonghop.php');

$type = $_GET['type'];
$duongdan = $_GET['view'];

switch ($type)
{
  case 'detail':
	$url= "http://m.soha.vn".$duongdan."";
	$source = grab_link($url);
	$batdau = '<div class="wrapper">';
	$ketthuc = '<div class="categories">';
	$tinphp = laynoidung($source, $batdau, $ketthuc);
      $tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
      $tinphp = preg_replace("/<a href='/",'<a href="?type=detail&view=',$tinphp);
      require_once ("head.php");
	  echo '<div class="phdr">Tin tức (soha)</div>';
	echo $tinphp;
	echo '<div class="categories"><h3 class="topic_title">Chọn chủ đề</h3>
	<p class="topic_item"><a href="/soha">Trang chủ</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10015/hinh-su.htm">Hình sự</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10002/the-thao.htm">Thể thao</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10009/xa-hoi.htm">Xã hội</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10010/chuyen-la.htm">Chuyện lạ</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10001/giai-tri.htm">Giải trí</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10014/gioi-tinh.htm">Sức khỏe - Giới tính</a></p></div>';
      require_once ("foot.php");
      break;
        
default:
      require_once ("head.php");
	  echo '<div class="phdr">Tin tức (soha)</div>';
	$source = grab_link("http://m.soha.vn/news.htm");
	$batdau = '<div class="wrapper">';
	$ketthuc = '<div class="categories">';
	$tinphp = laynoidung($source, $batdau, $ketthuc);
	$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
	$tinphp = preg_replace('/<a class="title" href="/','<a href="?type=detail&view=',$tinphp);
	echo $tinphp;
	echo '<div class="categories"><h3 class="topic_title">Chọn chủ đề</h3>
	<p class="topic_item"><a href="/soha">Trang chủ</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10015/hinh-su.htm">Hình sự</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10002/the-thao.htm">Thể thao</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10009/xa-hoi.htm">Xã hội</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10010/chuyen-la.htm">Chuyện lạ</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10001/giai-tri.htm">Giải trí</a></p>
	<p class="topic_item"><a href="?type=detail&view=/c0s10014/gioi-tinh.htm">Sức khỏe - Giới tính</a></p></div>';
      require_once ("foot.php");
}

exit;
?>