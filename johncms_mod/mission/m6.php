<?php
define('_IN_JOHNCMS', 1);
$textl = 'Nhiệm vụ truyền thuyết 6 - Vàng Chiến Chấm! ';
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
echo '<span style="color:#ff4500"><b>Nhiệm vụ 6: Mụ phù thuỷ Jane</b></span>';
if($user['mission']==5){
echo '<div><b>5 ngày sau...</b></div>';
echo '<div><b>Lee</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>, tôi thấy mệt quá, chúng ta rời thị trấn Small đã 5 ngày
rồi và giờ đang bị lạc giữa khu rừng đáng ghét này. huhu, ' . $user['name'] . ' tôi mệt lắm  .<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Cố gắng lên đi Lee, chúng ta
phải rời khỏi đây sớm trước khi trời tối, có lẽ những con thú dữ trong rừng sẽ không buông tha chúng ta khi màn đêm bao phủ đâu.</span><div>';

echo '<div><b>Lee</b>: Thú cưng của chúng ta cũng đã mệt rồi, tôi nhìn nó đáng thương quá.<div>';
echo '<div>..............................Xoạt.........</div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Lee cẩn thận!!!, có gì đó
nguy hiểm, nó đang bao quanh 2 đứa mình, Lee mau bế thú nuôi lên..!!</span><div>';

echo '<div><b>Jane</b>:<a href="../users/profile.php?id=' . $user['id'] . '">' . $user['name'] . '</a>?, ngươi đúng là ' . $user['name'] . ' sao??? haha lại còn
đi cùng một cô bé thật dễ thương nữa haha!!!<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Trời..!! Mụ là ai, khuôn mặt thật
kinh tởm, tránh xa Lee ra, đừng động đến chúng tôi, chúng tôi là những Poster đã được giao xứ mệnh đi tìm truyền thuyết Chiến Chấm Vàng. Đừng trách
tôi không nói trước, cả 2 chúng tôi đều là Poster có cấp độ trên rìu sắt đó...</span><div>';

echo '<div><b>Jane</b>:Doạ ta sao hai đứa nhóc ranh, >"<!!! ta chính là Phù thuỷ Jane trong truyền thuyết, chẳng nhẽ các ngươi đã đến khu rừng chết chóc
mà không hề hay biết )), một lũ ngu ngốc, chuẩn bị nộp mạng cho những đứa con của ta đi, có lẽ các ngươi đã nghe thấy tiếng chúng hú rồi chứ.. haha
những tên Poster Chuyên Nghiệp cũng đã bị chúng nuốt nói gì đến 2 đứa nhãi poster Nghiệp Dư...khà khà<div>';

echo '<div><b>Hú hú.............</b></div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Là tiếng chó sói tru!!!</span><div>';
echo '<div><b>Lee</b>:huhu, ' . $user['name'] . '  ơi, tôi không muốn, chưa bao giờ tôi đến đây, tôi thấy sợ... .<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: (Lee khóc??? Trông cô
ấy lúc này thật dễ thương khác hẳn Lee kiêu ngạo khó coi hàng ngày.. ) Không ngươi không được động đến chúng ta - Ta sẽ bảo vệ Lee!</span><div>';
echo '<div><b>Jane</b>:Hô hô, muốn bảo vệ cô bé đó hả, hè hè ta cũng không muốn giết các ngươi ngay, ta vô tình biết được tin lão già kyndy đã giao xứ
mệnh đi tìm Chiến Chấm Vàng cho cháu gái lão và một Poster trẻ tuổi là ngươi, ta còn biết lão đã rời khỏi VND để đi làm một việc bí mật nữa. Thằng ranh
' . $user['name'] . ', hê hê, ta cũng muốn thử sức poster nhãi ranh mà lão kyndy cử đến xem sao!<div>';
echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: ngươi định làm gì
đồ phù thuỷ độc ác</span><div>';

echo '<div><b>Jane</b>:Cũng chẳng có gì, sẽ không khó khăn cho ngươi nếu ngươi thật sự có bản lĩnh haha, ta tạm thời sẽ giữ con bé Lee xinh xắn này lại
đây, trong khu rừng này có một đôi rìu sắt, ui ta nhỡ đánh mất đâu đó, haha ta muốn ngươi đi tìm cho ta.<div>';

echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Hừ.., ta đồng ý, sau đó ngươi
phải trả Lee lại và để yên cho chúng ta đi.</span><div>';

echo '<div><b>Jane</b>:kha kha, đơn giản vậy sao nhóc, nghe ta nói nốt đã, trong khu rừng có vô số cạm bẫy, những chiếc rìu ngươi tìm thấy đâu chắc
đã là thật, ngươi phải trả giá nếu tìm sai, và ta cũng dặn ngươi, có thể ngươi sẽ mất đi một phần 10 kinh nghiệm ngươi đang có đấy kha kha.<div>';


echo '<div><span style="color:#FF00FF"><a href="../users/profile.php?id=' . $user['id'] . '"><b>' . $user['name'] . '</b></a>: Đồ mụ phù thuỷ già...
Hừ ta phải tìm thấy nó, rìu sắt đôi, ta phải tìm thấy....( Lee, đừng khóc, tôi sẽ sớm trở lại, Lee tôi mến bạn...)</span><div>';

echo '</br>';
echo '<div><b>Nhiệm vụ: Tìm rìu sắt đôi thật</b></div>';
echo '<div>Yêu cầu: có trên 2.000 VND</div>';
echo '<div>Phần thưởng: 3.000 EXP</div>';
echo '<div><a href="../mission/ma6.php">Nhận nhiệm vụ Mụ phù thuỷ Jane</a></div>';
}else{
echo '<div class="menu">Chấp nhận nhiệm vụ thất bại!</div>';
}
echo '<div><a href="../mission/index.php">Danh sách nhiệm vụ truyền thuyết</a></div>';
require_once ("../incfiles/end.php");
?>