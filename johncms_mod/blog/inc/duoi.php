<?php
echo '<div class="tmn"><a href="'.$home.'/index.html"><img src="'.$home.'/img/back.gif"></a> <a href="#TOP"><img src="'.$home.'/img/top.gif"></a>'.($admin ? ' <a href="'.$home.'/admin"><img src="'.$home.'/img/cpanel.png"></a> <a href="'.$home.'/thoat.php"><img src="'.$home.'/img/exit.png"></a>':'').'</div><div class="foot">
© <a href="http://bentrewap.com">BTW</a> & <a href="'.$home.'">'.b_set('copy').'</a><br>
All rights reserved</div></body></html>';
mysql_close($db_MrTam);
ob_end_flush();
?>
