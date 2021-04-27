<?php include"func.php"; include"../head.php";
echo '<div class="menu"><div>';
$z=$_GET['z'];  if(empty($z)){$url="http://socbay.com/wap/home/cate";}else{$url="http://wap.socbay.com/wap/$z";}  $source=grab_link($url); $batdau='</table>'; $ketthuc='<div class="info">'; $file=laynoidung($source, $batdau, $ketthuc);  $file=str_replace('f="http://wap.socbay.com/wap/','f="/socbay/dv',$file); $file=str_replace('/socbay/dvhome/down','http://wap.socbay.com/wap/home/down',$file); $file=str_replace('/socbay/dvmp3/do','http://socbay.com/wap/mp3/do',$file); $file=preg_replace('|src="ht(.*?)?src|is','src="http://m.xalo.vn/mthumb?url',$file); $file=str_replace('<div>','<div>&#187;',$file); $file=str_replace('socbay/dvhttp','http',$file); $file=preg_replace('|&w=(.*?)"/>|is','&amp;type=JPEG&amp;w=100&amp;h=100"/>',$file);  echo(!empty($file))?'<div class="bmenu">WAP SOCBAY</div>'.$file:'RELOAD!';
echo '';
include"../end.php";


?>
