<?php
include('../head.php');
include('../func.php');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://hinhanhgaidep.com');
  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16'); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Language: en-us,en;q=0.7,de-de;q=0.3','Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5'));

$crazy0 = curl_exec($ch);

curl_close($ch);

$rem = array('href="http://hinhanhgaidep.com/page','<a href="http://hinhanhgaidep.com/" title="home">Home</a>',);

$rep = array('href="hinhxinh2.php?dir=/page','<a href="http://MChanTroi.Net/" title="home">Home</a>');

$crazy2 = str_replace($rem, $rep, $crazy0);

echo $crazy2;
include('../foot.php');
?>