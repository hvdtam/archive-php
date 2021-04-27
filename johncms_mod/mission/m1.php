<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 1 - Vàng Chiến Chấm! ';
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
echo '<span style="color:#ff4500"><b>Nhiệm vụ 1: Bước khởi đầu</b></span>';
if($user['mission']==0){
echo '<div><b>Kyndy</b>: Chào <a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>, đây là lần đầu ngươi đến với diễn đàn TaMk phải không? Ta trông ngươi khá trẻ, ưm nhìn ngươi cũng
ưa nhìn đấy! Có lẽ người giới thiệu đã nói qua cho ngươi về TaMk. Nơi đây là thế giới của những thành viên năng động nhất. Chắc rằng hắn cũng đã nói ngươi phải đến
tìm ta đúng không? ta tên là kyndy, ta đã có cấp độ rìu vàng rồi. Thời gian ngươi đến đây sẽ do ta chỉ dạy và hướng dẫn giúp ngươi trở thành một poster Huyền thoại.<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Ông đã có cấp độ rìu vàng, trời!!! Tôi hi vọng ông sẽ giúp đỡ tôi
nhiều, tôi đã nghe qua về truyền thuyết rìu vàng chiến, chưa có ai lấy được nó dù là một poster Siêu Sao có đúng không?</span><div>';

echo '<div><b>kyndy</b>: ' . $user['name'] . ' ngươi đang mơ đấy sao, Một poster Siêu Sao không đủ đẳng cấp lấy rìu vàng chiến, người lấy nó
chỉ có thể là một poster Huyền Thoại, ta đã đến thế giới này 50 năm rồi cũng chỉ lấy được rìu vàng thôi! ngươi còn trẻ, ta hi vọng sẽ giúp đỡ được ngươi trở thành poster Thần Thoại.<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Cảm ơn ông, tôi có thể gọi ông là sư phụ không?</span><div>';

echo '<div><b>kyndy</b>: Ngươi điên rồi hả <a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>. Gọi ta bằng sư  phụ liệu ngày mai ta có đi cưa gái được nữa không?
đừng câu giờ nữa, hãy chăm chỉ tập luyện, ta sẽ hướng dẫn ngươi, bây giờ là nhiệm vụ đầu tiên ta giao cho ngươi, hãy vâng lời và luyện tập thật tốt, ngươi hãy
đến khu vực diễn đàn và post 50 bài viết đơn giản. Chú ý ta dạy ngươi trở thành poster chứ không phải trở thành một spammer rõ chưa? Nào hãy bắt đầu đi!!!<div>';
echo '</br>';
echo '<div><b>Nhiệm vụ: Post 50 bài viết trong diễn đàn</b></div>';
echo '<div>Phần thưởng: 2.000 VND</div>';
echo '<div><a href="../mission/a1.php?act=m">Nhận phần thưởng nhiệm vụ Bước Khởi Đầu</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>
