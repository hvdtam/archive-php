<?php
define('_IN_VINAFUN', 1);
require_once ('replacetonghop.php');

      require_once ("head.php");
    echo '<div class="phdr">[<font color="red"><b>MCT</b></font>] Lịch truyền hình</div>';
	$source = grab_link("http://m.tuoitre.vn/news/tv");
	$batdau = '<div style="padding: 5px;">';
	$ketthuc = '<style type="text/css">';
	$tinphp = laynoidung($source, $batdau, $ketthuc);
	echo $tinphp;
      require_once ("foot.php");

?>