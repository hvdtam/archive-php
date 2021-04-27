<?php
/* 
---
 Функций для Онлайн игры ферма
---
*/

//Функция вывода время 

function tdate($time=NULL)
{
if ($time==NULL)$time=time();
else $time=$time;
$timep="".date("j M Y в H:i", $time)."";
$time_p[0]=date("j n Y", $time);
$time_p[1]=date("H:i", $time);
if ($time_p[0]==date("j n Y", time()))$timep="Hôm nay $time_p[1]";
if ($time_p[0]==date("j n Y", time()-86400))$timep="Hôm qua $time_p[1]";
$timep=str_replace("Jan","tháng 1",$timep);
$timep=str_replace("Feb","tháng 2",$timep);
$timep=str_replace("Mar","tháng 3",$timep);
$timep=str_replace("May","tháng 5",$timep);
$timep=str_replace("Apr","tháng 4",$timep);
$timep=str_replace("Jun","tháng 6",$timep);
$timep=str_replace("Jul","tháng 7",$timep);
$timep=str_replace("Aug","tháng 8",$timep);
$timep=str_replace("Sep","tháng 19",$timep);
$timep=str_replace("Oct","tháng 10",$timep);
$timep=str_replace("Nov","tháng 11",$timep);
$timep=str_replace("Dec","tháng 12",$timep);
return $timep;
}
$conf = mysql_fetch_array(mysql_query ( "SELECT * FROM `ferma_config` WHERE `id`='1'"));
?>