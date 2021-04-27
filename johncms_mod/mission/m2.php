<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 2 - Vàng Chiến Chấm! ';
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
echo '<span style="color:#ff4500"><b>Nhiệm vụ 2: Những người bạn</b></span>';
if($user['mission']==1){
echo '<div><b>Kyndy</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>, Ngươi học khá nhanh đấy, ta chưa từng thấy một poster nào có triển vọng
trở thành một Huyền Thoại hơn ngươi. 50 bài viết đó sẽ giúp ngươi có kinh nghiệm hơn trong chặng đường phía trước, bây giờ ta muốn ngươi làm một việc.<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Cảm ơn lời khen của ông
tôi sẽ phải làm gì tiếp theo?</span><div>';

echo '<div><b>Kyndy</b>: Không khó khăn đâu ' . $user['name'] . ', chỉ là gặp một vài người bạn và làm quen với họ. Họ cũng như ngươi, đi tìm truyền thuyết Vàng Chiến Chấm<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Tôi có thể gặp họ ở đâu?</span><div>';

echo '<div><b>Kyndy</b>: <a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>. Hãy đến khu chat room và nói chuyện với những người bạn ở đó
họ là những thành viên của TaMk. Họ rất vui tính đó, nhớ là hãy nói chuyện với họ 60 câu nói nhé! Nếu ngươi nói ít hơn không ai thấy thú vị khi làm quen với nhà ngươi
đâu. Có cả TiểuNghi ở phòng chat đó, nhanh đi đi và hãy sớm trở về!<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: :ha: Tôi sẽ sớm trở lại.</span><div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: ( thật là một dịp tốt để mình làm quen
với các bạn ở VND, vui quá!!!</span><div>';
echo '</br>';
echo '<div><b>Nhiệm vụ: Post 60 bài viết trong khu vực chat room</b></div>';
echo '<div>Phần thưởng: 1.500 VND</div>';
echo '<div><a href="../mission/a2.php?act=m">Nhận nhiệm vụ Những Người Bạn</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>
