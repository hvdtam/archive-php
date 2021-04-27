<?php
 define('_IN_VINAFUN', 1);
 require_once ('replace247.php');
 include('head.php');


$type = $_GET['s'];
$bao = $_GET['bao'];
$duongdan = $_GET['w'];


switch ($type)
{        
  case 'm':
   $url= "http://m.tin247.com/".$duongdan."";
   $source = grab_link($url);
   $batdau = '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
   $ketthuc = '<div class="break_module"></div>';
   $tinphp = laynoidung($source, $batdau, $ketthuc);
   $tinphp = str_replace('<a href="/">M.TIN247.COM</a>','<div class="phdr">Tin tức (tin247)</div>',$tinphp);
      $tinphp = str_replace('<a href="','<a href="?s=m&w=',$tinphp);
  echo $tinphp;
 
      break;      
        
 
default:
      $url= "http://m.tin247.com/";
   $source = grab_link($url);
   $batdau = '<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">';
   $ketthuc = '<div class="break_module"></div></div><div id="container_footer"';
   $tinphp = laynoidung($source, $batdau, $ketthuc);
   $tinphp = str_replace('<a href="/">M.TIN247.COM</a>','<div class="phdr">Tin tức (tin247)</div>',$tinphp);
   $tinphp = str_replace('<a href="','<a href="?s=m&w=',$tinphp);
  echo $tinphp;
 
      
}
include ('foot.php');
exit;

?>