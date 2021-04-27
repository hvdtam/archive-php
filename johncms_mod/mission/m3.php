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
echo '<span style="color:#ff4500"><b>Nhiệm vụ 3: Lời thách thức của Lee</b></span>';
if($user['mission']==2){
echo '<div><b>Lee</b>:<a href="../users/profile.php?id=' . $user['id'] . '"> Chào ' . $user['name'] . '</a>, cậu đã về đấy sao? việc ông tôi giao cho cậu cậu đã hoàn thành rồi chứ!.<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Cậu là ai vậy? sao cậu lại ở đây.
à có phải cậu là cháu của ông kyndy không?</span><div>';

echo '<div><b>Lee</b>: đúng vậy ' . $user['name'] . ' ông tôi đã ra ngoài, ông dặn tôi ở đây đợi cậu, nghe nói cậu là một poster có tiềm tố! Này cậu có nghe tôi 
đang nói gì không???<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: (Cô bé xinh quá) à... tôi có nghe,
ừm cậu tên là gì, tôi là ' . $user['name'] . ', thật ra tôi cũng mới bắt đầu thôi!</span><div>';

echo '<div><b>Lee</b>: ưm tôi biết <a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a> à! Thật ra tôi cũng nghĩ là cậu không có khả năng đó<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Hix!!!</span><div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: à bên cạnh tên cậu là cấp độ gì đó</span><div>';
echo '<div><b>Lee</b>: Tôi đã lấy được rìu sắt rồi, rất hiếm người mới bắt đầu mà có khả năng có được rìu sắt, tôi nghĩ cậu cũng không có đâu<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Tôi tin tôi có thể!</span><div>';
echo '<div><b>Lee</b>: Cậu có thể sao <a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>: haha, thật buồn cười, cậu đúng là một đứa nhóc<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Rồi tôi sẽ cho cậu thấy</span><div>';
echo '<div><b>Lee</b>: tôi đã mất 2 tuần để đạt cấp rìu sắt với 130 bài post, tôi không tin một người mới bắt đầu như bạn có thể làm đc điều đó. Hãy chứng minh cho tôi thấy bạn đủ khả năng để lên cấp rìu
 sắt bằng thực lực của một poster. Tôi tin bạn sẽ chẳng bao giờ làm được<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: tôi sẽ sớm trở lại....</span><div>';
echo '</br>';
echo '<div><b>Nhiệm vụ: Đạt cấp độ rìu sắt (post 130)</b></div>';
echo '<div>Phần thưởng: 4.500 VND</div>';
echo '<div><a href="../mission/a3.php?act=m">Nhận nhiệm vụ Lời Thách Thức Của Lee</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>