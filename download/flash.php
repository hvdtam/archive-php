<?php
include 'head.php';

if(!$_GET['xem'] && !$_GET['down']) {
$flash = file_get_contents('http://flash.mobik.ru');
preg_match("/<div class=\"menu_green_a\">(.*?)<\/div><div class=\"reclama\">/is",$flash,$matches);
$flash=str_replace('<a href="','<a href="?xem=',$matches[1]);
$nga = array('Автомобили','Игры','Разное','Спорт','Технологии','Оригинальные','Анимация','Часы','Мультики','Часы: Эротика','Эротика','Животные','Цветы','Темы для SE','Природа','Лобовь','Дети','Новый год','Бренды');
$viet = array('Xe hơi','Trò chơi','Khác','Thể thao','Công nghệ','Bản gốc','Hoạt hình','Giờ đồng hồ','Phim hoạt hình','Giờ làm việc: dành cho người lớn','Erotica','Động vật','Hoa','Sony Ericsson','Thiên nhiên','Head-','Trẻ em','Năm mới','Thương hiệu');
$flash = str_replace($nga,$viet,$flash);
echo $flash;
}
else {
if(isset($_GET['xem'])) {
$flash = file_get_contents('http://flash.mobik.ru/'.$_GET['xem'].'&category='.$_GET['category'].(!$_GET['page']?NULL:'&page='.$_GET['page']));
preg_match("/<div class=\"menu_green_a\">(.*?)<\/div><div class=\"reclama\">/is",$flash,$matches);
$flash=str_replace('<a href="?module=flash','<a href="?xem=?module=flash',$matches[1]);
$flash=str_replace('<a href="?module=download','<a href="?down=?module=download',$flash);
$nga = array('Размер','кб','Скачало','чел','скачать','Стр','из','Навигация','Скачать');
$viet = array('Kích thước','KB','Lượt tải','lượt','Tải về','Trang','trong','Trang','Xem');
$flash = str_replace($nga,$viet,$flash);
$flash = str_replace('download.php','http://flash.mobik.ru/download.php',$flash);
echo $flash;
}
if(isset($_GET['down']))
{ $flash = file_get_contents('http://flash.mobik.ru/'.$_GET['down'].'&category='.$_GET['category'].(!$_GET['id']?NULL:'&id='.$_GET['id']));
preg_match("/<div class=\"menu_green_a\">(.*?)<\/div><div class=\"reclama\">/is",$flash,$matches);
$nga = array('Размер','кб','Скачало','чел','Название','Скачать Flash');
$viet = array('Kích thước','KB','Lượt tải','lượt','Tên','Tải về Flash');
$flash = str_replace($nga,$viet,$matches[1]);
$flash = str_replace('<a href="','<a href="http://flash.mobik.ru/',$flash);
echo $flash; } }
include 'end.php';

?>
