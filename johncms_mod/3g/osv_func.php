<?php
function altecom($view){
/* jika ingin menambahkan fungsi atau mereplace text, edit text "ganti_text" dan "dengan_text" */
$view=str_replace("ocwteam.com","<b>ocwteam.com</b>",$view);
$view=str_replace("ganti_text","dengan_text",$view);
$view=str_replace("ganti_text","dengan_text",$view);
$view=str_replace("ganti_text","dengan_text",$view);
$view=str_replace("ganti_text","dengan_text",$view);
/* yang di bawah ini jangan d edit */
$view=preg_replace("~&lt;[^<>]*&gt;~iU",
"<font color=\"#7fffd4\">\\0</font>",$view);
$view=preg_replace("~(&lt;[^\s!]*\s)([^<>]*)([/?]?&gt;)~iU",
"\\1<font color=\"#00ff00\">\\2</font>\\3",$view);
$view=preg_replace("~&lt;!--.*--&gt;~iU",
"<font color=\"#ffaaff\">\\0</font>",$view);
$view=preg_replace("~(&quot;|&#039;)[^<>]*(&quot;|&#039;)~iU",
"<font color=\"#ffff00\">\\0</font>",$view);
$view=preg_replace("/\{(.*?)\}/i","<font color=\"red\">{\\1}</font>",$view);
$view=str_replace("\r","<br />\r\n",$view);
return $view;}
?>