<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                Mobile Content Management System                    //
// Project site:          http://johncms.com                                  //
// Support site:          http://gazenwagen.com                               //
////////////////////////////////////////////////////////////////////////////////
// Mod BOT kể truyện cười ngẫu nhiên và BOT đọc KQXS for JohnCMS by Quyetdaik //
//            Liên hệ khi cần hỗ trợ: http://wapchua.info                     //
////////////////////////////////////////////////////////////////////////////////
*/

define('_IN_JOHNCMS', 1);

if(preg_match('|cuoi|',$msg) ||preg_match('|Cuoi|',$msg) ||preg_match('|CUOI|',$msg)) {

function laynoidung ($noidung, $start, $stop) {
$bd = strpos ($noidung, $start);
$kt = strpos(substr($noidung,$bd),$stop) + $bd;
$content = substr($noidung, $bd, $kt - $bd);
return $content;
}
		$maso = rand(100,999);
		$u = 'http://image.thegioitrochoi.vn/wap/truyencuoi/viewdetail.aspx?tcid='.$maso;
		$link=$u;
		$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, $header);   //trace header response
    curl_setopt($ch, CURLOPT_NOBODY, $header);  //return body
    curl_setopt($ch, CURLOPT_URL, $u);   //curl Targeted URL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_REFERER, $ref);   //fake referer
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    
        $ketqua = curl_exec($ch);
        curl_close($ch);
		
$cuoi = explode('0912345678',$ketqua);
$cuoi = explode('<u>Truyen khac</u>',$cuoi[1]);
$cuoi = $cuoi[0];
$cuoi = preg_replace('|</b(.*)b>|is','',$cuoi);
$cuoi = str_replace('<br/>','
',$cuoi);
		
$bot = $cuoi;

}
?>