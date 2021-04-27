<?




$file= file("http://3gpking.com/3gp-porn-video/$_GET[cat]");
$link = @implode("", $file);


   function pick($start,$stop,$from){
$from=explode($start,$from);
$from=explode($stop,$from[1]);
$from=$from[0];
return $from;
}


$url=pick('<a href = ','>',$link);

$url2=str_replace('fmt=3gp','fmt=mp4',$url);

$nam = str_replace('</b>','-(Yoursitename).3gp</b>',$link);
$name=pick('<b>','</b>',$nam);
$detail=pick('</b><br>','Mb<br>',$link);





$detail = str_replace('img src=','img src=http://3gpking.com',$detail);

$title=$_GET[cat];
$title= str_replace("/",",",$title);
$title= str_replace("-"," ",$title);


@include'head.php';

echo '<div class="tlth">';
echo $name;
echo '</div><div class="tltable">';
echo $detail;
echo '</div><h2 class="post0" align="center">
  <a href="dl.php?link='.base64_encode($url).'">Download File with 3gp LQ
  </a><br><a href="dl.php?link='.base64_encode($url2).'">Download with mp4 HD
  </a></h2>';

@include'foot.php';
?>

