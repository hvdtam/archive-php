<?php
echo '<center><a name="top"></a><a href="#bottom">Lên ^ trên</a></center>';
echo "</div><div class=\"notice\"><center>";
list($msec,$sec)=explode(chr(3),microtime()); echo'<div class=\"notice\">Load '.round(($sec + $msec) - $conf['headtime'],3).'s</small></div>';
echo '</body></html>';
?>
