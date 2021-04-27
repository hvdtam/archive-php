<?php

define('_IN_JOHNCMS', 1);
$day = date("d");
$month = date("m");
$year = date("y");
$h=date("H + 7");
if (preg_match("|http://|",$msg) ||preg_match("|Http://|",$msg) || preg_match("|Http://www.|",$msg) ||preg_match("|http://www.|",$msg) || preg_match("|www.|",$msg) || preg_match("|moi anh em ghe tham|",$msg) || preg_match("|mời ae ghé thăm|",$msg)) {
$botvip = array			(
1  => "Cấm quảng cáo wap dưới mọi hình thức!!",
2  => "$login thử phát nữa xem nào. :ha:",
3  => "$login muốn đi du lịch hem :ban:",
4  => "Ui Bot vào rùi wap cùi lắm!",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|đi cf|",$msg) ||preg_match("|đi cafe|",$msg) || preg_match("|di cafe|",$msg) ||preg_match("|cafe di|",$msg) || preg_match("|CAFE đi|",$msg) || preg_match("|cafe không bot|",$msg) || preg_match("|cafe nào|",$msg)) {
$botvip = array			(
1  => "$login có đi không mà rủ! Mà bot thích nhất cafe có gái ôm đó :haha:",
2  => "$login tính trốn việc hả :ban:",
3  => "Đi thì đi 1 mình đi Bot không đi đâu",
4  => "Cafe ôm không anh em!",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|biet khong|",$msg) ||preg_match("|biết không|",$msg) || preg_match("|biết|",$msg) ||preg_match("|biet|",$msg) || preg_match("|bit|",$msg) || preg_match("|bik|",$msg) || preg_match("|Bik|",$msg)) {
$botvip = array			(
1  => "Có mình Bot biết thôi!",
2  => "BOT biết đấy gọi số bot đi đây nè 0972 ngày mai mới lắp",
3  => "BOT chịu hỏi thầy phán ý.",

);
srand ((double) microtime() * 100000);
$randnum = rand(1,3);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|help me|",$msg) ||preg_match("|help|",$msg) || preg_match("|Help|",$msg) ||preg_match("|giúp|",$msg) || preg_match("|giúp với|",$msg) || preg_match("|giup|",$msg) || preg_match("|HELP|",$msg)) {
$botvip = array			(
1  => "$login ơi bot giúp cho :haha:",
2  => "$login bot biết nhưng k giúp đâu! :chemgio:",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,2);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|bot|",$msg) || preg_match("|Bot|",$msg) || preg_match("|BOt|",$msg) || preg_match("|BOT|",$msg) || preg_match("|b0t|",$msg)) {
$botvip = array			(
1  => "Ở đây ai tên là bot ra $login hỏi gì này?",
2  => "Thuê bao quý khách vừa gọi hiện đang tán gái xin quý khách vui lòng gọi lại sau!",
3  => "$login gọi bot hả có việc gì không??",
4  => "Suỵt BOT đang tán gái tý pm nhé.",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|time|",$msg) || preg_match("|TIME|",$msg) || preg_match("|Time|",$msg) || preg_match("|may gio|",$msg) || preg_match("|mấy giờ|",$msg) || preg_match("|giờ bot|",$msg)) {
$day = date("d");
$month = date("m");
$year = date("y");
$h=date("H");
$botvip = array			(
1  => "Bây giờ là $h+7 giờ ngày $day tháng $month năm $year!",
2  => "Giờ ngày hôn nay bằng giờ ngày hôm qua!",
3  => "$login à cái này Bot không nói được!",
4  => "Đi hỏi người khác xem mấy giờ rồi thì bot nó cho :ha:",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|tamK|",$msg) || preg_match("|TamK|",$msg) || preg_match("|wapka|",$msg) || preg_match("|wapego|",$msg) || preg_match("|TAMK|",$msg) || preg_match("|TaMk|",$msg) || preg_match("|tamk|",$msg)) {
$botvip = array			(
1  => "TaMk Bận tán gái rùi!",
2  => "TaMk là admin wap này đấy.",
3  => "$login có việc gì thế TaMk đang bận học",
4  => "Lại xin xỏ hả hay phàn làn gì thì pm riêng ấy!",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|bun|",$msg) || preg_match("|Buồn|",$msg) || preg_match("|Buon|",$msg) || preg_match("|BUỒN|",$msg) || preg_match("|BUON|",$msg) || preg_match("|BOT ơi bùn quá|",$msg) || preg_match("|BUN|",$msg)) {
$botvip = array			(
1  => "$login buồn à ở đây chơi cùng anh em cho đỡ buồn",
2  => "Buồn thì đi ngủ đi ở đây làm gì?",
3  => "$login có việc gì thế tamk đang bận học",
4  => "Buồn thế à! Chia sẻ cùng Bot nha. :ha:",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|test|",$msg) ||preg_match("|Test|",$msg) || preg_match("|TEST|",$msg) ||preg_match("|thu nghiem|",$msg) || preg_match("|thử nghiệm|",$msg) || preg_match("|TEst|",$msg) || preg_match("|TESt|",$msg)) {
$botvip = array			(
1  => "$login ơi thành côn rồi kìa! Khao đê",
2  => "wap bạn đã die :haha:",
3  => "$login học dốt thì nói tiếng việt đê",
4  => "Test gì đấy?!",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|bot điên|",$msg) ||preg_match("|bot dien|",$msg) || preg_match("|Bot điên|",$msg) ||preg_match("|Bot dien|",$msg) || preg_match("|BOT ĐIÊN|",$msg) || preg_match("|BOT điên|",$msg) || preg_match("|bOt dien|",$msg)) {
$botvip = array			(
1  => "Chửi ai đấy nói lại xem nào.hừm",
2  => "Chửi làm gì thích ra đường đánh nhau lun",
3  => "$login muốn ăn đòn hay sao",
4  => "Đồ vô văn hóa",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|Bot ngu|",$msg) || preg_match("|bot ngu|",$msg) ||preg_match("|Bot Ngu|",$msg) || preg_match("|BOT NGU|",$msg) ||preg_match("|BOT ngu|",$msg) || preg_match("|BOT Dốt|",$msg) || preg_match("|BOT đần|",$msg) || preg_match("|bOt dan|",$msg)) {
$botvip = array			(
1  => "Chửi ai đấy nói lại xem nào.hừm",
2  => "Chửi làm gì thích ra đường đánh nhau lun",
3  => "$login muốn ra đảo hem",
4  => "Hơn 1 số thằng như $login là được!",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|bot ngu qua|",$msg) ||preg_match("|thằng bot ngu|",$msg) || preg_match("|bot ngu vl|",$msg) ||preg_match("|bot khon vai|",$msg)) {
$botvip = array			(
1  => "BOT chỉ thế thôi $login khôn thì nói xem hum nay đề vào bao nhiu! :haha:",
2  => "$login mún ăn gạch không :bannhau:",
3  => "Hơn 1 số thằng như $login là được! ",
4  => "Ngu nhưng chém gió giỏi hơn $login đấy :chemgio:",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,4);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|Im đi|",$msg) ||preg_match("|im đi|",$msg) || preg_match("|BOT IM ĐI|",$msg) ||preg_match("|bot im đi|",$msg)) {
$botvip = array			(
1  => "BOT chỉ thế thôi $login đi chỗ khác mà chơi :bunngu:",
2  => "$login mún ăn gạch không :bannhau:",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,2);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|yeu|",$msg) ||preg_match("|Yêu|",$msg) || preg_match("|YEU|",$msg) ||preg_match("|yêu|",$msg)) {
$botvip = array			(
1  => "Yêu hả? $login yêu BOT đúng hem? :$!",
2  => "Trong đây là BOT đẹp trai nhứt đó! $login yêu BOT đê...",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,2);
$bot =''. $botvip[$randnum].'';
}
if (preg_match("|share|",$msg) ||preg_match("|Share|",$msg)) {
$botvip = array			(
1  => "Share hả. share gì thế. Share cho tớ luôn!",
2  => "$login share kìa. Thank đi anh em :haha:",
);
srand ((double) microtime() * 100000);
$randnum = rand(1,2);
$bot =''. $botvip[$randnum].'';
}
?>
