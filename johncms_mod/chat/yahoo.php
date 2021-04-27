<?php

if (preg_match('|#yahoo|',$msg)) {

if($datauser['balans'] < 200) {

$bot = '@'.$login.' không đủ tiền để xem avatar đâu nhé!';

} else {
mysql_query("UPDATE users SET balans=balans+200 WHERE id=3 LIMIT 1");

mysql_query("UPDATE users SET balans=balans-200 WHERE id='$user_id' LIMIT 1");

function avatar($wapnha){

$wapnha=str_replace("#yahoo","",$wapnha);

$wapnha=str_replace("#yahoo","",$wapnha);



$zingnet = strtolower($wapnha);

return $wapnha;

}

$avatar = 'http://img.msg.yahoo.com/avatar.php?yids=' . avatar($msg) . '';

$bot = 'Avatar [b]' . avatar($msg) . '[/b] trong Yahoo! Massage[br][img='.$avatar.'][br]'.$login.' trừ 200VNĐ';

}

}

?>
