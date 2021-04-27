<?php
error_reporting(0);
include('funcnew.php');
include('head.php');

echo '<div class="menu"><div class="bmenu"> <a title="Trang chủ" href="/new.php">New</a> <a title="Bóng đá" href="?cat=/bong-da-c48.html">Bóng đá</a> <a title="Tin tức" href="?cat=/tin-tuc-trong-ngay-c46.html">Tin tức</a> <a title="Hình sự" href="?cat=/an-ninh-hinh-su-c51.html">Hình sự</a> <a title="Cười" href="?cat=/cuoi-24h-c70.html">Cười</a></div>';
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
$tinanh =str_replace('<a href="/', '<a href="?t=/', $tinanh);
$tinanh = str_replace('src="/upload/', 'src="http://m.24h.com.vn/upload/', $tinanh);

$tinanh = str_replace('(24h)', '(QP)', $tinanh);
#$tinanh=str_replace('24H', 'QP', $tinanh);
$tinanh = str_replace('<a href="http://www.24h.com.vn', '<a href="?t=', $tinanh);
$tinanh = str_replace('src="../../../..', 'src="http://m.24h.com.vn', $tinanh);
echo "<title>QP News - Tin tức trên Mobile cập nhật 24/7</title>";
echo $chuyenmuc . '' . $tinanh . '' . $ccmuc;
# GET MORE
$cons = explode('<div class="chuyen-muc">', $cont);
for ($i = 1; $i < count($cons); $i++) {
$tenchuyenmuc = pick('<div class="ten-chuyen-muc">', '</div>', $cons[$i]);
$tenchuyenmuc = '<div class="ten-chuyen-muc">' . $tenchuyenmuc . '</div>';

$tcauhinhcm = pick('<ul', '</ul>', $cons[$i]);
$tcauhinhcm = '<ul' . $tcauhinhcm . '</ul>';
$tcauhinhcm = str_replace('<a href="/', '<a href="?t=/', $tcauhinhcm);
echo $tenchuyenmuc . '' . $tcauhinhcm;
}
echo '<div class="bmenu"> <a title="Trang chủ" href="/new.php">New</a> <a title="Bóng đá" href="?cat=/bong-da-c48.html">Bóng đá</a> <a title="Tin tức" href="?cat=/tin-tuc-trong-ngay-c46.html">Tin tức</a> <a title="Hình sự" href="?cat=/an-ninh-hinh-su-c51.html">Hình sự</a> <a title="Cười" href="?cat=/cuoi-24h-c70.html">Cười</a></div></div>'; include('end.php');
exit;
}


# GET CATALOG
if ($_GET['cat'] != null) {
$cont = str_replace('<div id="breadcrumb" class="ten-chuyen-muc">', '<div class="ten-chuyen-muc">', $cont);
$cons = explode('<div class="ten-chuyen-muc">', $cont);


for ($i = 1; $i < count($cons); $i++) {
echo "<title>QP News - Tin tức trên Mobile cập nhật 24/7</title>";
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
echo '<div class="bmenu"> <a title="Trang chủ" href="/new.php">New</a> <a title="Bóng đá" href="?cat=/bong-da-c48.html">Bóng đá</a> <a title="Tin tức" href="?cat=/tin-tuc-trong-ngay-c46.html">Tin tức</a> <a title="Hình sự" href="?cat=/an-ninh-hinh-su-c51.html">Hình sự</a> <a title="Cười" href="?cat=/cuoi-24h-c70.html">Cười</a></div></div>'; include('end.php');
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
$tinanh = str_replace('src="', 'src="', $tinanh);
$xemthem = pick('<div class="xem-them">', '</div>', $cons[$i]);
$xemthem = '<div class="xem-them">' . $xemthem . '</div>';
$xemthem = str_replace('<a href="/', '<a href="?t=/', $xemthem);

$tinkhac = pick('<ul>', '</ul>', $cons[$i]);
$tinkhac = '<ul>' . $tinkhac . '</ul>';
$tinkhac = str_replace('<a href="/', '<a href="?t=/', $tinkhac);
echo "<title>QP News - Tin tức trên Mobile cập nhật 24/7</title>";
echo '<div class="chuyen-muc">';
echo $tenchuyenmuc . '' . $tinanh . '' . $tinkhac . '' . $xemthem . '</div>';
}
echo '<div class="bmenu"> <a title="Trang chủ" href="/new.php">New</a> <a title="Bóng đá" href="?cat=/bong-da-c48.html">Bóng đá</a> <a title="Tin tức" href="?cat=/tin-tuc-trong-ngay-c46.html">Tin tức</a> <a title="Hình sự" href="?cat=/an-ninh-hinh-su-c51.html">Hình sự</a> <a title="Cười" href="?cat=/cuoi-24h-c70.html">Cười</a></div></div>'; include('end.php');
?>
