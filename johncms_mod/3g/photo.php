<?php
error_reporting(0); 
include 'head.php';

$act=$_GET['act']; 
$s=$_GET['s']; 
$c=$_GET['c']; 
$p=$_GET['p']; 
$q=$_GET['q']; 
$z=$_GET['z'];
switch($act){case'cat': if(!isset($p)){$m=file_get_contents('http://m.xalo.vn/photo.mptc?c='.$c);
} if(isset($p)){$m=file_get_contents('http://m.xalo.vn/photo.mptc?c='.$c.'&p='.$p);
} 
include 'replacephoto.php'; 
break; 
case'down': if(isset($s)){$m=file_get_contents('http://m.xalo.vn/photo.mpts?s='.$s);
} 
include 'replacephoto.php'; 
break; 
case'search': 
	if(isset($q)){ $m=file_get_contents('http://m.xalo.vn/kq.mphotos?q='.$q=str_replace(' ','+',$q)); 
} 
include 'replacephoto.php'; 
break; 
case'next': if(isset($z)){$m=file_get_contents('http://m.xalo.vn/'.$z.'.mphotos');
} 
include 'replacephoto.php'; 
break; 
default: 
	$m=file_get_contents('http://m.xalo.vn/photo.mobi'); 
include 'replacephoto.php'; 
}

include 'foot.php';  

?>
