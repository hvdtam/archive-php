<?php

if (preg_match('|#avatar|',$msg)) {

if($datauser['balans'] < 200) {

$bot = '@'.$login.' không đủ tiền để xem avatar đâu nhé!';

} else {
mysql_query("UPDATE users SET balans=balans+200 WHERE id=3 LIMIT 1");

mysql_query("UPDATE users SET balans=balans-200 WHERE id='$user_id' LIMIT 1");

function avatar($wapnha){

$wapnha=str_replace("#avatar ","",$wapnha);

$wapnha=str_replace("#avatar","",$wapnha);



$zingnet = strtolower($wapnha);

return $wapnha;

}

$avatar = 'teamobi.com/services/avatar/image/' . avatar($msg) . '.gif';

$bot = 'Nhân vật [b]' . avatar($msg) . '[/b] trong avatar[br][img='.$avatar.'][br]'.$login.' trừ 200VNĐ';

}

}

?>
