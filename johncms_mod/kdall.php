<?php
/*
Mod kd all b.viet for johncms by NhanhNao.Mobi
Xin vui long ko xoa ban quyen tac gia
*/
define('_IN_JOHNCMS', 1);
$rootpath = '';
require('incfiles/core.php');
require('incfiles/head.php');
if ($rights < 7) {
echo'<div class="rmenu">Lỗi! Bạn ko đủ quyền k.duyệt bài viết</div>';
exit;
}
//Mod kd all
$kiemduyet = mysql_result(mysql_query("SELECT COUNT(*) FROM `forum` WHERE `type` = 't' and kedit='0' AND `kiemduyet` != '1' AND `close`!='1'"), 0);
$asp = mysql_query("SELECT * FROM `forum` WHERE `type` = 't' and kedit='0' AND `kiemduyet` != '1' AND `close`!='1' ORDER BY `time` DESC LIMIT $kiemduyet;");
$d = 0;
if ($kiemduyet > 0) {
while ($res = mysql_fetch_assoc($asp)) {
$id = $res['id'];
mysql_query("UPDATE `forum` SET  `kiemduyet` = '1', `time` = '$realtime', `kiemduyet_who` = 'Hệ Thống' WHERE `id` = '".$id."'");
$d++;
}
echo '<div class="gmenu">Đã kiểm duyệt tất cả <b>'.$d.'</b> bài viết!</div>';
} else {
echo'<div class="rmenu">Ko có chủ đề nào để k.duyệt</div>';
}
require('incfiles/end.php');
?>
