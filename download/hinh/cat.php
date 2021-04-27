<?php
$sehife = isset($_GET['sehife']) ? '&sehife='.$_GET['sehife']:'';
$m = $_GET['m'];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://alomob.net/pict/cat.php?resl='.$_GET['resl'].$sehife.'&lg=en');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/html','charset:UTF-8'));
curl_setopt($curl, CURLOPT_USERAGENT, 'Nokia5130c-2/2.0 (07.96) Profile/MIDP-2.1 Configuration/CLDC-1.1');
curl_setopt($curl, CURLOPT_REFERER, 'http://bentrewap.com');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
$nd = curl_exec($curl);
curl_close($curl);
$nd = preg_replace(array('/<!(.+?)<a href="top.php?(.+?)TOP 100<\/a><br\/>/is', '/<form name="sfiles"(.+?)<\/html>/is'), '', $nd);
$nd = preg_replace(array('/<a href="pict.php(.+?)&amp;lg=en">(.+?)<\/a>(.+?)<br\/>/i', '/<a href="cat.php(.+?)&amp;lg=en">(.+?)<br\/>/i'), array("<div class=\"main\"><img src=\"http://truyen.bentrewap.com/img/next.png\"> <a href=\"pict.php$1&amp;m=$m&amp;mn=$2\">$2</a> $3</div>", "<div class=\"main\"><a href=\"cat.php$1&amp;m=$m\">$2</div>"), $nd);
$nd = str_replace(array('News', 'Backgrounds', 'Art & 3D', 'Humor', 'Cartoons', 'Anime and Manga', 'Fantasy', 'Toys', 'Nature', 'Beautiful animals', 'Funny animals', 'Cats', 'Dogs', 'Birds', 'Insects', 'Waterland', 'Flowers', 'Fruits and Vegetables', 'Food and Beverages', 'Love and Hearts', 'Man and Woman', 'Girls', 'Eyes', 'Lips', 'Children', 'Men', 'Music and Musicians', 'Movies and Performers', 'Sports and Dance', 'Emo and Gothic', 'Horror', 'Architecture', 'Transportation', 'Auto', 'Kosmos', 'Computers', 'Symbols and logos', 'Watches and Accessories', 'Money & Excitement', 'Ornaments', 'Weapon', 'Horoscope', 'Politics', 'New Year', 'Others', '&lt;&lt;Back', 'Next&gt;&gt;', 'Search'), array('Mới nhất', 'Hình nền', 'Nghệ thuật 3D', 'Hài hước', 'Phim hoạt hình', 'Ảnh động', 'Tưởng tượng', 'Đồ chơi', 'Thiên nhiên', 'Động vật đẹp', 'Động vật hài hước', 'Mèo', 'Chó', 'Chim', 'Côn trùng', 'Động vật biển', 'Hoa', 'Hoa quả và rau', 'Thức ăn', 'Trái tim và tình yêu', 'Đàn ông và phụ nữ', 'Cô gái', 'Mắt', 'Môi', 'Trẻ em', 'Đàn ông', 'Âm nhạc', 'Phim ảnh', 'Thể thao', 'Cổ điển', 'Kinh dị', 'Kiến thức', 'Giao thông', 'Tự động công nghệ', 'Vũ trụ', 'Máy tính', 'Logo và biểu tượng', 'Đồng hồ và phụ kiện', 'Money & Excitement', 'Trang trí', 'Vũ khí', 'Chòm sao', 'Chính trị', 'Năm mới', 'Khác', '&laquo;Quay lại', 'Tiếp theo&raquo;', 'Tìm'), $nd);
echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>'.$m.' - Hình Nền Tổng Hợp</title>
<meta name="keywords" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" />
<meta name="description" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" /><link rel="shortcut icon" href="http://truyen.bentrewap.com/img/fav.ico"/>
<title>Hình Nền Tổng Hợp</title>
<meta name="keywords" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" />
<meta name="description" content="hinh nen tong hop, hinh nen dien thoai, wap tai hinh nen, hinh nen dep nhap, hinh nen mobile, wap hinh nen, wap tai hinh" /><link rel="shortcut icon" href="http://10bc1.tk/img/fav.ico"/>
<link rel="stylesheet" href="http://10bc1.tk/img/style.css" media="all" />
<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/style.css" media="all" />
<div class="main index">
<div id="menu">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="active"><a href="http://' . $_SERVER['HTTP_HOST'] . '">Home</a></td>
<td  width="10" ><a href="http://up.wapdep.tk/">Up</a></td>
<td  width="10"><a href="http://' . $_SERVER['HTTP_HOST'] . '/mp3.php">Mp3</a></td>
<td  width="10"><a href="http://wapdep.tk/chat">Chat</a></td>
</tr>
</tbody></table>
</div></div>
<a name="TOP"><div class="menu">&rsaquo;<b> '.$m.'</b></div> '.$nd.'<div class="foot"><a href="http://LaiVung2.Tk">LaiVung2.Tk</a></div></body></html>';
?>
