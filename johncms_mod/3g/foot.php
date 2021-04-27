<?php
include("stats.inc.php");
include("count.php");
echo '<center><a name="top"></a><a href="#bottom">Lên ^ trên</a></center>';
echo("<div class=\"bmenu\" align=\"center\"><small>Online: ".$online." | ".$daily_hits_size." | ".$total_hits."</small></div>");
echo "</div><div class=\"notice\"><center>";
list($msec,$sec)=explode(chr(3),microtime()); echo'<div class=\"notice\">Load '.round(($sec + $msec) - $conf['headtime'],3).'s</small>';
echo '</body></html>';
?>
<?php
echo'<center><a title="Vietnam Backlinks" href="http://www.backlinks.vn/" target="_blank"><img src="http://www.backlinks.vn/ads/backlinks.png" alt="Vietnam Backlinks" width="80" height="15" border="0" /></a>
<!-- Start Backlink Code --><a target="_blank" title="Free Automatic Link" href="http://camthachmyanmar.com.vn/backlink/"><img border="0" width="80" alt="Free Automatic Link" src="http://camthachmyanmar.com.vn/ec.gif" height="15" /></a><!-- End Backlink Code --></center>';
include("file.html");

?>
