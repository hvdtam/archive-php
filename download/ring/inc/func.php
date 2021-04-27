<?php
function grabkvs($url)
{
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/27.2020; U; en) Presto/2.8.119 Version/11.10');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$kvs=curl_exec($ch);
curl_close($ch);
return $kvs;
}
?>
