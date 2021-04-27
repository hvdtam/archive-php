<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 8 - Vàng Chiến Chấm! ';
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
echo '<span style="color:#ff4500"><b>Nhiệm vụ 8: Tập luyện</b></span>';
if($user['mission']==7){
echo '<div><b>...3 tháng sau.......</b></div>';

echo '<div><b>Thuny</b>: Khá lắm, ta đã không nhìn nhầm cậu. Bây giờ ta bắt đầu tập luyện cho cậu, số tiên Xu mà cậu kiếm được hãy đổi nó ra VND
chúng ta sẽ dùng đến khi cần thiết<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>:Vâng thưa ông,
Tôi sẽ phải tập luyện ra sao?</span><div>';

echo '<div><b>Thuny</b>: Cậu là một poster, hãy xứng đáng là một poster, khi chiến đấu với mụ phù thuỷ hãy dũng cảm và dùng trí thông minh cùng
sự nhạy bén của cậu. Ngày trước ta cũng đã tập luyện khá tốt.<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Tôi phải làm gì?</span><div>';

echo '<div><b>Nông dân</b>: Hãy quay trở lại ngôi làng của chúng ta và cố gắng đạt được 120.000 điểm kinh nghiệm, lúc đó hãy quay lại đây. ta sẽ giúp cậu
bước tập luyện tiếp theo<div>';


echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Vâng, thưa Thuny</span><div>';

echo '</br>';
echo '<div><b>Nhiệm vụ: Đạt 120.000 EXP</b></div>';
echo '<div>Phần thưởng: 15.000 VND</div>';
echo '<div><a href="../mission/a8.php?act=mbuy">Nhận nhiệm vụ Tập luyện</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>