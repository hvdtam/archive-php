<?php
$model = isset($_GET['model']) ? '?model='.$_GET['model']:'';
$phone = isset($_GET['phone']) ? '?phone='.$_GET['phone']:'';
$cat = (isset($_GET['cat']) ? '?cat='.$_GET['cat']:'').(isset($_GET['mod']) ? '&mod='.$_GET['mod']:'').(isset($_GET['page']) ? '&page='.$_GET['page']:'');
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://4ik.ru/themes/'.$model.$phone.$cat);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/html','charset:UTF-8'));
curl_setopt($curl, CURLOPT_USERAGENT, 'Nokia5130c-2/2.0 (07.96) Profile/MIDP-2.1 Configuration/CLDC-1.1');
curl_setopt($curl, CURLOPT_REFERER, 'http://4ik.ru');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
$nd = curl_exec($curl);
curl_close($curl);
$nd = preg_replace(array('/<?(.+?)<\/div><div class="e88"><\/div><\/div><div class="ul_blue">/is', '/<hr \/><div class="ul_blue"><div class="header_red">(.+?)<\/html>/siu', '/<\/div><div class="ul_blue"><div class="header_red">(.+?)<\/html>/siu'), '', $nd);
$nd = str_replace(array('<div class="e88">', ')</div>', '</div></div><hr />', '<div class="navigation">', '<span>', '</span>', './'), array('', ')<br/>', '', '<div class="trang">', '<b class="ipage">', '</b>', ''), $nd);
$nd = preg_replace(array('/<img src="img\/arrow.gif"(.+?)href="(.+?)<br\/>/i', '/<div class="header_tet">(.+?)<\/div>/i', '/<img src="(.+?)" alt="(.+?)file=(.+?)&(.+?)">(.+?)<\/a><br\/>/i'), array("<div class=\"main\"><img src=\"http://truyen.bentrewap.com/img/next.png\"> <a href=\"$2</div>", "<div class=\"menu\"><b>&rsaquo;</b> $1</div>", "<div class=\"list\"><img src=\"http://4ik.ru/themes/$1\" alt=\"321Chat.Tk\"/><br/>&rsaquo;<a href=\"http://theme.bentrewap.com/?load=$3\">$5</a></div>"), $nd);
$nd = str_replace(array('Темы для', 'Темы', 'Абстракции', 'Фильмы', 'Животные', 'Автомобили', 'Разное', 'Природа', 'Игры', 'Оригинальные', 'Компьютеры', 'Спорт', 'Технологии', 'Мультфильмы', 'Научно-фантастические', 'Бренды', 'Ландшафты', 'Болливуд', 'Праздничные', 'Смешные', 'Знаки и поговорки', 'Люди'), array('Chủ đề', 'Chủ đề', 'Tổng hợp', 'Phim', 'Động vật', 'Ô tô', 'Linh tinh', 'Thiên nhiên', 'Trò chơi', 'Bản gốc', 'Máy tính', 'Thể thao', 'Công nghệ', 'Ảnh động', 'Khoa học viễn tưởng', 'Thương hiệu', 'Cảnh quan', 'Bollywood', 'Kỳ nghỉ', 'Hài hước', 'Các dấu hiệu và câu hỏi', 'Cô gái'), $nd);

echo '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>Chủ Đề Điện Thoại, Wap Tải Chủ Đề, Wap Tải Theme, Theme Mobile </title>
<meta name="keywords" content="theme dep, wap tai theme, wap tai chu de, chu de dien thoai, wap chu de, chu de dep, theme dep" />
<meta name="description" content="theme dep, wap tai theme, wap tai chu de, chu de dien thoai, wap chu de, chu de dep, theme dep" /><link rel="shortcut icon" href="http://' . $_SERVER['HTTP_HOST'] . '/favicon.ico"/>
<link rel="stylesheet" href="http://' . $_SERVER['HTTP_HOST'] . '/style.css" media="all" />
<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" /></head><body>
<style>
.forum #mn, .forum #search .text  {border-color:#FFB600;}
.forum #header {height:37px;background repeat-x;padding:3px 0 0 10px}
.forum #mn .active, .forum #search .button, .forum h1.title {background:#FFB600;}
.forum #footer {text-align:center;padding:5px 0;background:#e28b08;color:#fff}
.forum .list li {list-style:square;margin:3px 0 3px 13px;color:#e28b08}
.forum .tab .active {color:#b01e1e}
.forum .guide li {color:#000}
.forum .msg {border-bottom: 1px solid #E7E7E7; padding: 5px;background:#FAFAFA}
.forum .error {color:#b0397c}
.forum .info {color:#494949}
.forum p,td {line-height:10px}
#mn {padding-left:5px;border-bottom:5px solid #FFB600;font-size:12px}
#mn a {color:#494949;font-weight:bold}
#mn tr, #mn td{height:25px;padding-top:4px}
#mn td {padding-left:5px;padding-right:5px;text-align:center}
#mn .active {background:#FFB600;}
#mn .active a {color:#fff}
.sitemap {
font-size: xx-small;
position: relative;
width: 100%;
height: 38px;
z-index: 1;
overflow: auto;
}</style></head><body>
<div class="main index">
<div id="mn">
<table cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="active"><a href="http://' . $_SERVER['HTTP_HOST'] . '">Home</a></td>
<td  width="10" ><a href="http://up.wapdep.tk/">Up</a></td>
<td  width="10"><a href="http://' . $_SERVER['HTTP_HOST'] . '/mp3.php">Mp3</a></td>
<td  width="10"><a href="http://321chat.tk/chat">Chat</a></td>
</tr>
</tbody></table>
</div></div>
<a name="TOP">'.$nd.'
</body></html>';
?>
