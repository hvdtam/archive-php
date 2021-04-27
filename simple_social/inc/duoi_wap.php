<?php
echo '<div class="tmn"><a href="'.$home.'/index.html"><img src="'.$home.'/img/back.gif"></a> <a href="#TOP"><img src="'.$home.'/img/top.gif"></a>'.($admin ? ' <a href="'.$home.'/admin"><img src="'.$home.'/img/cpanel.png"></a> <a href="'.$home.'/thoat.php"><img src="'.$home.'/img/exit.png"></a>':'').'</div></div></body></html>';
mysql_close($db_MrTam);
ob_end_flush();
?>
<?php
include("stats.inc.php");
include("count.php");
include("online.php");

echo(" | ".$daily_hits_size." | ".$total_hits."</small></div>");
echo '<center><a href="http://www.ping-fast.com/ping-my-blog6931" target="_blank"><img src="http://www.ping-fast.com/iping.php?aut=EC153B028BB768920487F89D5739455201155A64B924A54A750E6D8DD2AD0BC1854A7AD421A02FC8C1" alt="ping fast  my blog, website, or RSS feed for Free" border="0" /></a>
<a href="http://wapsoc.net/?uid=228" target="_blank"><img src="http://wapsoc.net/count.php?uid=228" width="70" height="15"/></a>
<a alt="google pagerank" href="http://www.mypagerank.net"><img width="50" height="15"  src="http://www.mypagerank.net/services/gbla/gbla.php?s=98161c55fea1609f1ea7d8bd7703331e01155a64f524e9437c0764c8db" title="Googlebot" border="0" /></a></center>';
?>
