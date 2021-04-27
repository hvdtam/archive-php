<?php
$home='/mp3/';

include'curl.php';
$html=get($url);
$token=!empty($_GET['token']) ? $_GET['token'] : pick('token=','"',$html);
$status=pick('<form','</form',$html);
if(empty($status)){ echo'<a href="'.$_SERVER['REQUEST_URL'].'">có lỗi xảy ra,click vào đây để tiếp tục</a>';
break;
exit; }
$html=str_replace(array('href="/web/','href="http://mp3.m.zing.vn/web/'),'href="'.$home.'web/',$html);
$html=str_replace('head01','bmenu',$html);
$html=str_replace('snav2','bmenu',$html);
$html=preg_replace('|<!DOC(.*?)</form>|is','',$html);
$html=preg_replace('|"http://login.(.*?)"|is','"/mp3/download.php?id='.$_GET['id'].'"',$html);
$html=preg_replace('|<div id="footer">(.*?)</html>|is','',$html);
$html=preg_replace('|Ca sĩ</a></span>(.*?)</div>|is','Ca sĩ</a></span></div>',$html);
$html=str_replace('inv snavselect','currentpage',$html);
$html=str_replace('bpaging nobrd','topmenu',$html);
$html=str_replace('tabnav3','bmenu',$html);
$html=explode('<div class="fr">',$html);
for($i=0;$i<count($html); $i++){
$out.=$html[$i].($i % 2 ? (($i!=count($html)-1) ? '<div class="menu">':''):(($i!=count($html)-1) ? '<div class="menu">':'')); }
$html='<div><div class="form"><form method="get" action= "'.$home.'web/search"><input type="hidden" name="t" value="0"><input type="hidden" name="quality" value="1"><input type="hidden" name="ver" value="w"><input type="hidden" name="token" value="'.(!empty($_GET['token']) ? $_GET['token'] : pick('token=','"',$out)).'"><table width= "100%" cellpadding= "0" > <tbody> <tr> <td style= "padding-right:5px" > <input class= "input" name= "q" value= "" type= "text" > <div style= "margin-top:2px" > <input class= "input" value= "Tìm" type= "submit" > </div> </td> </tr> </tbody> </table> </form>'.$out;
$textl=pick('<strong>','</strong>',$html);
$textl=strip_tags($textl);
?>
