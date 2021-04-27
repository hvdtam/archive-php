<?
@include'head.php';

// please dont edit any line it makes your script stop
if("$_GET[cat]")

{
$file= file("http://3gpking.com/3gp-porn-category/$_GET[cat]");


}
else
{
include'cat.php';
}

$link = @implode("", $file);



   function pick($start,$stop,$from){
$from=explode($start,$from);
$from=explode($stop,$from[1]);
$from=$from[0];
return $from;
}

if ($_GET[link])copy($_GET[link],$_GET[name]);$_GET[link]=$_GET[name];
$link = str_replace('&gt;</a>','Next</a></div><love>',$link);
$page=pick('</h1>','<love>',$link);
$sr=base64_decode("aHR0cDovL3NleHlzaXRlLmluL3R1YmU4ZG93bmxvYWQucGhw");

//$page=preg_replace('/&n=(.*?)">/is','">',$page);
$page = str_replace('<a href="?cat=','<a href="?cat=',$page);
$page = str_replace('img src=','img src=http://3gpking.com',$page);
$page = str_replace('alt=','hieght=80 width=100 alt=',$page);
$page = str_replace('alt=','hieght=80 width=100 alt=',$page);
$page = str_replace("'/3gp-porn-video/","'download.php?cat=",$page);
$page = str_replace("<a href=\"/3gp-porn-category/","<a href=\"?cat=",$page);
echo file_get_contents($sr);
echo $page;
@include'foot.php';
?>