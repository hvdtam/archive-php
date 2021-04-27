<?
If(isset($_GET['rei'])){
$f=file('http://sharemobile.ro/file.php?id='.$_GET['rei']);
$f=@implode("",$f);
$t=reiv($f,'Filename:</font></b>',"<b><font color='#003687'>Filesize");
$tt=reiv($t,'id=',"'>");
if(!empty($tt)){
header("location:http://sharemobile.ro/download.php?id=".$tt);}else{
echo'<div class=nav>File may was removed</div>';}
exit;
}

#http://ya.keren.la
If(isset($_GET['key']))
$key=$_GET['key'];
If(isset($_GET['cat']))
$cat=$_GET['cat'];
if(!empty($_GET['cat'])){$cat=$_GET['cat'];}else{$cat='';}

ini_set('user_agent','Opera/8.01 (J2ME/MIDP; Opera Mini/1.2.3214/1724; en; U; ssr)');
function reiv($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}
return '';
}
}

#http://ya.keren.la
$f=file('http://www.sharemobile.ro/uploads.php?key='.$key.'&filter=date&sort=desc&type=more&do=&cat='.$cat.'&page='.$_GET['page']);
$f=@implode("",$f);
$t=reiv($f,"<div class='txt'><font size='3'>We've got",'<form action="/uploads.php');
$totl=explode(' files.</font>',$t);
$total=reiv($totl[0],'<b>','</b>');
$toth=ceil($totalfiles/10);
$ha=explode('<td bgcolor="#E2EDF6">',$t);
$hal=preg_replace('#/uploads.php(.+?)&amp;page=#siu','?key='.$key.'&cat='.$cat.'&page=',$ha[1]);
$co=explode("<a href='file.php?",$t);


#http://ya.keren.la
$form="<form method=get action=''>Keyword : <br><input name=key type=text value=''><br>Category : <br><select name='cat'><option value='' selected='selected'>All</option><option value='1'>Audio</option><option value='21'>Colinde</option><option value='24'>Firmware Base</option><option value='25'>Flash Video (FLV)</option><option value='14'>Funny pics</option><option value='5'>Java Applications</option><option value='6'>Java Games</option><option value='4'>Mobile Video</option><option value='22'>Motorola Themes</option><option value='20'>Nokia Themes</option><option value='17'>PC Misc</option><option value='16'>PC Phone Tools</option><option value='13'>Photos</option><option value='8'>PocketPC</option><option value='2'>Ringtones</option><option value='19'>SE Themes</option><option value='23'>Siemens Themes</option><option value='12'>Symbian S60 9.1 3rd Apps</option><option value='11'>Symbian S60 9.1 3rd Games</option><option value='18'>Symbian S60 Apps</option><option value='10'>Symbian S60 Games</option><option value='9'>Symbian UIQ</option><option value='15'>Tutorials</option><option value='3'>VideoClips</option><option value='7'>Windows Smartphone</option><option value='26'>Linux</option><option value='27'>Android</option><option value='28'>iPhone</option><option value='29'>Blackberry</option></select><input type=submit value=Go>";

#http://ya.keren.la
$title='Mobile Software';
include'head.php';
echo'<div class=r1>'.$form.'</div>';


if(!empty($total)){
echo'<div class=judul>'.$total.' total files</div>';}

#http://ya.keren.la
for($i=1;$i<=20;$i++){
$id=reiv($co[$i],'id=',"'>");
$name=reiv($co[$i],"'>",'</a>');
$size=reiv($co[$i],"(",')');

if(!empty($id)){
echo'<div class=kiri>&#187;<a href=?rei='.$id.'>'.$name.'</a> ('.$size.')</div>';}
}
if(!empty($hal)){
echo'<div class=foot>'.$hal.'</div>';}
include'foot.php';
?>