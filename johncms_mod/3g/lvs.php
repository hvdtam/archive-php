<?php  
	
	include 'head.php';

	$d=$_GET['d']; 
	$id=$_GET['id']; 
	$t=$_GET['t']; 
	$xem=$_GET['xem']; 
	switch($xem){ 
		case'sao': if(empty($d)){$tin=file_get_contents('http://m.xalo.vn/sao.mobi');
		} if($d){$tin=file_get_contents('http://m.xalo.vn/sao.mobi?id='.$id.'&t='.$t.'&d='.$d );
		} 
		$tin=preg_replace('|<body>(.*?)src="/micon/ical.gif|is','<body><div class="white"><img src="/img/ical.gif',$tin); 
		$tin=preg_replace('|<div class="white"><img src="/img/ical.gif(.*?)Khám(.*?)<a|is','<div class="white"><img src="/img/ical.gif',$tin); $tin=preg_replace('|<form(.*?)</html>|is','',$tin); $tin=preg_replace('|<title>(.*?)</title>|is','<title>Lich van su </title>',$tin);  $tin=str_replace('sao.mobi?','lvs.php?xem=sao&',$tin); $tin=str_replace('lvs.mobi','lvs.php',$tin); 
		echo$tin;
		break;
default: 
	if(empty($d)){$tin=file_get_contents("http://m.xalo.vn/lvs.mobi") ;} if($d){$tin=file_get_contents("http://m.xalo.vn/lvs.mobi?d=".$d=str_replace('-','',$d)) ;} 
$tin=preg_replace('|<body>(.*?)<img src="/micon/ical.gif" border="0"/>|is','<body><div class="white"><img src="/img/ical.gif">',$tin); $tin=preg_replace('|<form(.*?)</html>|is','',$tin);  $tin=str_replace('sao.mobi?','lvs.php?xem=sao&',$tin); $tin=str_replace('lvs.mobi','lvs.php',$tin); $tin=preg_replace('|<img src="/micon/ical.gif">(.*?)Khám(.*?)<a|is','<img src="/micon/ical.gif"><a',$tin); $tin=preg_replace('|<a href="/m/lvs/(.*?)</a>|is','',$tin); $tin=preg_replace('|<title>(.*?)</title>|is','<title>Lich van su</title>',$tin);    
echo$tin; 
include"form.php";
} 
echo '</div>';
include"foot.php";
?>
</body></html>
