<?php
define('_IN_VINAFUN', 1);
require_once ('replacetonghop.php');

      require_once ("head.php");
	echo '<div class="phdr">Giá vàng</div>';
	$source = grab_link("http://m.tuoitre.vn/news/gold");
	$batdau = '<div id="content">';
	$ketthuc = '<style type="text/css">';
	$tinphp = laynoidung($source, $batdau, $ketthuc);
    echo $tinphp;
      require_once ("foot.php");

?>