<?

$link = $_GET['link'];
$link=base64_decode($link);
$link = ''.$link.'-Yoursitename'; // <<-- add your site name HEre
//$link = str_replace(' ','%20',$link);

//echo $link;

header('Location: '.$link);

?>