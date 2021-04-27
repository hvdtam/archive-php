<?
if (!isset($_GET['p']))exit;
$p=max(0,min(3000,intval($_GET['p'])));

$x=128;
$y=11;

if ($p<=100)
{
$x2=@intval($x/(100/$p));
$img=imagecreate($x,$y);
$col['back']=imagecolorallocate($img, 250,250,255);
$col['draw']=imagecolorallocate($img, 218,226,232);
$col['font']=imagecolorallocate($img, 88,88,88);
$col['border']=imagecolorallocate($img, 192,204,217);
imagefill($img, $x, $y, $col['back']);
imagefilledrectangle($img, 0, 0, $x2, $y, $col['draw']);
imagerectangle($img, 0, 0, $x-1, $y-1, $col['border']);
imagettftext ($img, 7, 0, $x/10, $y-2, $col['font'], 'users/arial.ttf', "Danh vọng: $p %");
}
elseif ($p>100 && $p<=300)
{
$x2=@intval($x/(300/$p));
$img=imagecreate($x,$y);
$col['back']=imagecolorallocate($img, 245,235,187);
$col['draw']=imagecolorallocate($img, 211,202,151);
$col['font']=imagecolorallocate($img, 88,88,88);
$col['border']=imagecolorallocate($img, 204,196,144);
imagefill($img, $x, $y, $col['back']);
imagefilledrectangle($img, 0, 0, $x2, $y, $col['draw']);
imagerectangle($img, 0, 0, $x-1, $y-1, $col['border']);
imagettftext ($img, 7, 0, $x/10, $y-2, $col['font'], 'users/arial.ttf', "Danh vọng: $p %");
}
elseif ($p>300)
{
$x2=@intval($x/(3000/$p));
$img=imagecreate($x,$y);
$col['back']=imagecolorallocate($img, 225,204,126);
$col['draw']=imagecolorallocate($img, 203,180,100);
$col['font']=imagecolorallocate($img, 88,88,88);
$col['border']=imagecolorallocate($img, 178,159,78);

imagefill($img, $x, $y, $col['back']);
imagefilledrectangle($img, 0, 0, $x2, $y, $col['draw']);
imagerectangle($img, 0, 0, $x-1, $y-1, $col['border']);
imagettftext ($img, 7, 0, $x/10, $y-2, $col['font'], 'users/arial.ttf', "Danh vọng: $p %");
}


header("Content-type: image/png");
imagepng($img);
?>
