<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 7 - Vàng Chiến Chấm! ';
$headmod = 'nick';
require_once ("../incfiles/core.php");
require_once ("../incfiles/head.php");
if ($id && $id != $user_id) {
    $req = mysql_query("SELECT * FROM `users` WHERE `id` = '$id' LIMIT 1");
    if (mysql_num_rows($req)) {
        $user = mysql_fetch_assoc($req);
}
else {

}
}
else {
$id = false;
$user = $datauser;
}

if (!$user_id) {
    require_once ('../incfiles/head.php');
     echo display_error ('<br/>Bạn không được phép để thực hiện các hoạt động, bạn phải<br/><b><a href="../login.php">Đăng nhập</a></b> hoặc <b><a href="../registration.php">Đăng ký</a></b><br/>');
    require_once ('../incfiles/end.php');
    exit;
}
echo '<div class="menu"><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a> - <a href="../users/profile.php?id=' . $user['id'] . '">Thông tin cá nhân</a></div>';
echo '<span style="color:#ff4500"><b>Nhiệm vụ 7: Nông trại vui vẻ</b></span>';
if($user['mission']==6){
echo '<div><b>..........</b></div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Tôi đang bước tiếp những bước
đi cho đoạn đường phía trước, tôi cảm thấy mình thật ngốc khi mắc lừa mụ phù thuỷ đó, tôi phải cứu Lee. Hi vọng mụ ta sẽ không làm gì cô ấy.....</span><div>';

echo '<div><b>Nông dân</b>: Chào cậu bé, cậu đang đi về phía ngôi làng phía trước phải không?.<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>:Vâng thưa ông, tôi đã đi qua
khu rừng ma quái, tôi đã để mụ phù thuỷ bắt cô bạn gái đi. Tôi muốn cứu cô ấy, ông có biết ai có thể giúp tôi?</span><div>';

echo '<div><b>Nông dân</b>: Tôi không biết, cậu thoát khỏi tay mụ ta sao? Mụ ta là một mụ phù thuỷ độc ác và man rợ, nhưng mụ ta  chỉ đe doạ và tấn
công những Poster đi tìm truyền thuyết Chiến Thần Chấm thôi, tôi ở đây cũng lâu và không ít lần thấy sự ra đi của những Poster non trẻ, cậu là một
người mày mắn đó, tôi tự hỏi cậu đã làm cách nào, Mụ ta luôn đưa ra những câu hỏi và bắt họ trả lời, chỉ có những poster ở VND mới có đủ thông minh
để thoát khỏi...<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Vâng tôi là poster ở VND,
tôi được giao nhiệm vụ đi tìm truyền thuyết đó....</span><div>';

echo '<div><b>Nông dân</b>: Tôi nghĩ ông Thuny có thể giúp cậu, ông ta là một ông chủ lớn, ông ta có rất nhiều trang trại, hãy đến đó và xin làm việc
, tôi nghĩ ông ta có thể giúp cậu vì trước đây Thuny đã từng đi tìm Jane để trả thù cho sự ác độc của mụ, ông ta không giết được Jane nhưng đã để lại một
vết thương cho mụ ta. Hãy đến đó và xin sự giúp đỡ của Thuny<div>';

echo '<div><b>.............</b></div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>:ông có phải là Thuny</span><div>';
echo '<div><b>Thuny</b>: Đúng rồi cậu nhóc, cậu đến xin ta một công việc phải không?<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>:Vâng nhưng tôi muốn
một điều kiện, tôi sẽ làm việc cho ông và tôi muốn ông hãy giúp tôi cứu cô bạn đã bị Jane bắt đi</span><div>';
echo '<div><b>Thuny</b>:ưm, ta có thể giúp cậu, lâu rồi ta không trở lại khu rừng đó, mụ ta giăng đầy cạm bẫy, ta từng suýt mất mạng trong lần trả
thù mụ Jane. nhưng ta tin sẽ có một ngày ta hạ được Jane!.. Ngươi là một poster sao?<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>:Vâng, tôi đi tìm
truyền thuyết Chiến Chấm Vàng</span><div>';

echo '<div><b>Thuny</b>: Haha, cậu biết không, hồi còn trẻ ta cũng đã từng một poster đấy, ta cũng đi tìm truyền thuyết và mang theo hoài bão lớn
nhưng cuối cùng ta đã phải trở về với một chiếc rìu vàng...<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: ồ, ông là poster rìu vàng sao?.</span><div>';

echo '<div><b>Thuny</b>: Haha, chuyện cũng lâu rồi, thôi nào, ta đang rất bận, hãy giúp ta mua những nông trại và trồng những loại cây, ta muốn cậu thu được 500.000 Xu,
Đừng lười nhác, hãy làm việc thật chăm chỉ, ta với cậu phải kiếm tiền để mua một số thứ đấy. nếu cậu không cố gắng sẽ không giúp được bạn cậu đâu..<div>';


echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Vâng, tôi sẽ làm....( Lee, đợi tôi...)</span><div>';

echo '</br>';
echo '<div><b>Nhiệm vụ: Thu 500.000 Xu từ nông trại</b></div>';
echo '<div>Yêu cầu: có trên 10 DDVIP</div>';
echo '<div>Phần thưởng: 8.000 VND</div>';
echo '<div><a href="../mission/a7.php?act=mbuy">Nhận nhiệm vụ Nông trại vui vẻ</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>