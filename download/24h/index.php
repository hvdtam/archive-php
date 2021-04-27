<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet" media="screen, handheld" href="styles.css">
<?php
include 'func.php';
include 'head.php';
$url = $_GET['t'];
if ($url == null)
$url = $_GET['cat'];
$url = 'http://m.24h.com.vn' . $url;
$cont = get_contents($url);

# GET POST VIEW
if ($_GET[t] != null) {
$chuyenmuc = pick('<strong>', '</strong>', $cont) or DIE('ERROR CHUYEN MUC');
$chuyenmuc = '<div class="ten-chuyen-muc" id="breadcrumb"><strong>' . $chuyenmuc . '</strong></div>';
$chuyenmuc=str_replace('<a href="/', '<a href="?cat=/', $chuyenmuc);


$tinanh = pick('<div class="tin-anh">', '<div class="chuyen-muc">', $cont);
$tinanh = '<div class="tin-anh">' . $tinanh . '<div class="chuyen-muc">';
$tinanh = str_replace('<a href="/', '<a href="?t=/', $tinanh);
$tinanh = str_replace('src="/upload/', 'src="http://m.24h.com.vn/upload/', $tinanh);

$tinanh = str_replace('(24h)', '(TK News)', $tinanh);
#$tinanh=str_replace('24H', 'TK NEWS', $tinanh);
$tinanh = str_replace('<a href="http://www.24h.com.vn', '<a href="?t=', $tinanh);
$tinanh = str_replace('src="../../../..', 'src="http://m.24h.com.vn', $tinanh);

echo "<title>TK TK - Tin tức </title>";
echo $chuyenmuc . '' . $tinanh . '' . $ccmuc;


# GET MORE
$cons = explode('<div class="chuyen-muc">', $cont);
for ($i = 1; $i < count($cons); $i++) {
$tenchuyenmuc = pick('<div class="ten-chuyen-muc">', '</div>', $cons[$i]);
$tenchuyenmuc = '<div class="ten-chuyen-muc">' . $tenchuyenmuc . '</div>';

$tinccm = pick('<ul', '</ul>', $cons[$i]);
$tinccm = '<ul' . $tinccm . '</ul>';
$tinccm = str_replace('<a href="/', '<a href="?t=/', $tinccm);
echo $tenchuyenmuc . '' . $tinccm;
}
include('end.php');
exit;
}


# GET CATALOG
if ($_GET['cat'] != null) {
$cont = str_replace('<div id="breadcrumb" class="ten-chuyen-muc">', '<div class="ten-chuyen-muc">', $cont);
$cons = explode('<div class="ten-chuyen-muc">', $cont);


for ($i = 1; $i < count($cons); $i++) {
echo "<title>TK TK - Tin tức </title>";
$phantrang = pick('<div class="phan-trang">', '</div>', $cons[$i]);
$phantrang = '<div class="phan-trang">' . $phantrang . '</div>';


$tenchuyenmuc = pick('<strong>', '</strong>', $cons[$i]);
$tenchuyenmuc = '<div class="ten-chuyen-muc"><strong>' . $tenchuyenmuc . '</strong></div>';
$tenchuyenmuc = str_replace('<a href="/', '<a href="?cat=/', $tenchuyenmuc);
if ($i == 1)
echo $tenchuyenmuc;
$khac = pick('<h2>', '</h2>', $cons[$i]);
$khac = '<div class="ten-chuyen-muc"><strong>' . $khac . '</strong></div>';
if ($i != 1)
echo $khac;


$tin = explode('<div class="tin-anh">', $cons[$i]);
for ($j = 1; $j < count($tin); $j++) {
$tinanh= '<div class="tin-anh">'.$tin[$j];
$tinanh=pick('<div class="tin-anh">','</div>',$tinanh);
$tinanh='<div class="tin-anh">'.$tinanh.'</div>';
$tinanh = str_replace('<a href="/', '<a href="?t=/', $tinanh);
$tinanh = str_replace('src="/upload/', 'src="http://m.24h.com.vn/upload/', $tinanh);
echo $tinanh.'</div>';
}

echo $phantrang;
#echo $cons[$i];
}
include('footer.php');
exit;
}



# INDEX HOME
$cons = explode('<div class="chuyen-muc">', $cont);

for ($i = 1; $i < count($cons); $i++) {
$tenchuyenmuc = pick('<div class="ten-chuyen-muc">', '</div>', $cons[$i]);
$tenchuyenmuc = '<div class="ten-chuyen-muc">' . $tenchuyenmuc . '</div>';
$tenchuyenmuc= str_replace('<a href="/', '<a href="?cat=/', $tenchuyenmuc);
$tenchuyenmuc= str_replace('href="/', 'href="?cat=/', $tenchuyenmuc);


$tinanh = pick('<div class="tin-anh">', '</div>', $cons[$i]);
$tinanh = '<div class="tin-anh">' . $tinanh . '</div>';
$tinanh = str_replace('<a href="/', '<a href="?t=/', $tinanh);
$tinanh = str_replace('src="', 'src="http://m.24h.com.vn/', $tinanh);
$tinanh = str_replace('http://m.24h.com.vn/http://img-m.24hstatic.com', 'http://img-m.24hstatic.com', $tinanh);



$xemthem = pick('<div class="xem-them">', '</div>', $cons[$i]);
$xemthem = '<div class="xem-them">' . $xemthem . '</div>';
$xemthem = str_replace('<a href="/', '<a href="?t=/', $xemthem);

$tinkhac = pick('<ul>', '</ul>', $cons[$i]);
$tinkhac = '<ul>' . $tinkhac . '</ul>';
$tinkhac = str_replace('<a href="/', '<a href="?t=/', $tinkhac);
echo "<title>Tin tức 24h</title>";
echo '<div class="chuyen-muc">';
echo $tenchuyenmuc . '' . $tinanh . '' . $tinkhac . '' . $xemthem . '</div>';
}
include('../end.php');
?>
