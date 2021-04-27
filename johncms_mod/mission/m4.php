<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 3 - Vàng Chiến Chấm! ';
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
echo '<span style="color:#ff4500"><b>Nhiệm vụ 4: Ông ấy nói ' . $user['name'] . ' hãy biết cảm ơn!</b></span>';
if($user['mission']==3){
echo '<div><b>kyndy</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>, Cuối cùng ngươi cũng đã trở lại!, ngươi tham gia trò chơi với cháu ta đấy sao. Nó là một cô bé tinh nghịch
nhưng khả năng của nó, ta nghĩ cũng không kém ngươi mấy đâu!.<div>';

echo '<div><span style="color:#FF00FF"><a href="../str/ankenta.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Ông đã đi đâu vậy?</span><div>';

echo '<div><b>kyndy</b>: ' . $user['name'] . ' Ta sắp phải rời khỏi đây một thời gian, ta có lí do bí mật, ta muốn giúp ngươi nhưng rất tiếc có lẽ ngươi sẽ phải 
lên đường đi tìm truyền thuyết Chiến Vàng Chấm sớm hơn dự định, ta chưa dạy ngươi được nhiều điều nhưng đứa cháu gái của ta đã giúp ngươi đạt được một
 phần rồi, ít nhất giờ đây ngươi cũng đã là poster Nghiệp Dư.<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Tôi sẽ phải đi ngay sao?</span><div>';

echo '<div><b>kyndy</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a> đừng lo, cháu gái ta cũng sẽ đi cùng ngươi<div>';
echo '<div><span style="color:#FF00FF"><a href="../str/ankenta.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Hix!!! Lee sao?</span><div>';
echo '<div><b>Lee</b>: Không muốn đi cùng tôi sao nhóc, ^^ ai za cũng đã đạt được rìu sắt rồi, nhưng trình độ của cậu còn lâu mới đạt bằng tôi<div>';
echo '<div><span style="color:#FF00FF"><a href="../str/ankenta.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: ưm,(thật là một cô bé hống hách)</span><div>';
echo '<div><b>kyndy</b>:  <a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a> ngày mai hai đứa sẽ lên đường, còn bây giờ <a href="../str/ankenta.php?id=' . $user['id'] . '">' . $user['name'] . '</a>
hãy giúp ta làm một việc, hãy đến gửi lời cảm ơn giúp ta tới những người bạn trong VND, ta sắp lên đường nên khá bận rộn, họ đã giúp ta khá nhiều. 
' . $user['name'] . ' hãy biết cảm ơn những người đã giúp ngươi, cuộc sống cần có sự biết ơn và kính trọng!<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Tôi sẽ chuyển lời cảm ơn!</span><div>';
echo '<div><b>Lee</b>: Mau nhanh còn đi nào, con rùa <a href="../str/ankenta.php?id=' . $user['id'] . '">' . $user['name'] . '</a> chậm quá hihi^^!<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: hix...( đến chết với 2 ông cháu này quá)</span><div>';
echo '</br>';
echo '<div><b>Nhiệm vụ: Thanks 5 bài viết trong khu vực Diễn đàn</b></div>';
echo '<div>Phần thưởng: 2.000 VND</div>';
echo '<div><a href="../mission/a4.php?act=m">Nhận nhiệm vụ Ông ấy nói ' . $user['name'] . ' hãy biết cảm ơn!</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>