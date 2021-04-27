<?php
include 'config.php';
list($msec,$sec)=explode(chr(32),microtime());
$HeadTime=$sec+$msec;
echo '<html><head><title>
'.$title.'
</title>';
include '../head.php';
echo '<div class="bmenu">
Máy tính tình yêu!</div>
<div class="menu"><center><form class="form" name="love" method="post" action="rez.php">
Tên của bạn<br/>
<input class="input" name="name" title="Name"/><br/>
Tên của nàng<br/>
<input class="input" name="partner" title="Name"/><br/><br/>
<input type="image" value="Calculate" src="cal.gif"/><br/><br/>
</form></center></div>';
echo '<div class="menu">Tổng số tình yêu: ';
include 'hit.php';

list($msec,$sec)=explode(chr(32),microtime());
echo "[".round(($sec+$msec)-$HeadTime,4)."]";

echo '</div>';
include '../end.php';

?>
