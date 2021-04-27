<?php
define('_IN_JOHNCMS', 1);
$headmod = 'Nông trại vui vẻ';
$rootpath = '../';
require_once ('../incfiles/core.php');
require_once ('../incfiles/ferma_func.php');
if(!$user_id)
{         $textl = 'Oshibka';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ('<div class="rmenu">Game chỉ cho phép nick đã đăng ký tham gia</div>');
require_once ('../incfiles/end.php');
exit;
}
////Конец шапки///
$act = isset ( $_GET['act'] ) ? $_GET['act'] : NULL;
switch ($act){
default:
$textl = 'Hỏi đáp game Nông Trại';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="rmenu">Các câu hỏi thường gặp<br/></div> <div class="menu"><a href="faq.php?act=level">Phần thưởng khi lên cấp</a></div>
<div class="menu"><a href="faq.php?act="level2">Còn lại anh em hỏi trong Room chat của tamk nha!</a></div><br/>' );
break;
case 'level' :
$textl = 'Các quy định nâng cao mức độ kinh doanh trang trại';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="gmenu">Bảng hạch toán kinh doanh nông trại.<br/>
Hãy nhớ rằng cấp độ nông trại càng cao thì cơ hội phát triển sẽ tốt hơn.</div>
<div class="list1">
1 Cấp 1 bạn có thế phát triển Nông trại VND </div>
<div class="list2">
2 Cấp 2 bạn sẽ được ' .$conf['level_2']. ' Xu</div>
<div class="list1">
3 Cấp 3 bạn sẽ được ' .$conf['level_3']. ' Xu</div>
<div class="list2">
4 Cấp 4 bạn sẽ được ' .$conf['level_4']. ' Xu </div>
<div class="list1">
5 Cấp 5 bạn sẽ được ' .$conf['level_5']. ' Xu</div>
<div class="list2">
6 Cấp 6 bạn sẽ được ' .$conf['level_6']. ' Xu</div>
<div class="list1">
7 Cấp 7 bạn sẽ được ' .$conf['level_7']. ' Xu</div>
<div class="list2">
8 Cấp 8 bạn sẽ được ' .$conf['level_8']. ' Xu</div>
<div class="list1">
9 Cấp 9 bạn sẽ được ' .$conf['level_9']. ' Xu</div>
<div class="list2">
10 Cấp 10 bạn sẽ được ' .$conf['level_10']. ' Xu</div>' );
break;
case 'level2' :
$textl = 'Những thứ bạn có thể mua khi lên cấp!';
require_once ('../incfiles/head.php');
echo ('
<div class="phdr">' .$textl.'</div>');
echo ( '<div class="gmenu">Độ kinh doanh được xác định bằng thu nhập của bạn từ các trang trại càng có nhiều Xu thì độ phát triển nông trại của bạn sẽ tốt hơn.<br/>
Dưới đây là bảng cung cấp thông tin về hạt giống cho bạn ở mỗi cấp độ.</div><div class="rmenu">Lưu ý: Có thể sẽ khác với thực tế</div>
<div class="menu">
1 Cấp 1 bạn có thể trồng Hành, củ cải, xà lách và cà rốt</div><div class="menu">
2 Cấp 2 = Bạn có thể trồng thêm Đậu hà lan</div>
<div class="menu">
3 Cấp 3 = Bạn có thể trồng thêm Tỏi, Me</div>
<div class="menu">
4 Cấp 4 = Bạn có thể trồng thêm Dưa chuột, Hành tây (Репчетый) </div>
<div class="menu">
5 Cấp 5 = Bạn có thể trồng thêm dưa hấu </div>
<div class="menu">
6 Cấp 6 = Bạn có thể trồng thêm khoai tây, bắp, atisô và ớt.</div>
<div class="menu">
7 Cấp 7 = Bạn có thể trồng thêm lúa gạo, lúa mì và yến mạch.</div>
<div class="menu">
8 Cấp 8 = Bạn có thể trồng thêm Nho, mận, ành đào.</div>
<div class="menu">
9 Cấp 9 = Bạn có thể trồng thêm dừa, chuối, ổi</div>
<div class="menu">
10 Cấp 10 = Bạn có thể trồng thêm Quýt, chanh, cam, bưởi 5 roi</div>' );
break;
////Ноги страницы///
}
echo ( '<div class="menu"> <a href="/ferma/index.php?">Về danh sách các nông trại</a></div>' );
require_once ('../incfiles/end.php');
?>
