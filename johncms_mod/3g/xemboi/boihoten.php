<?php
require_once ("head.php");
$xboi = $_GET['boi'];
$xboilink='./data/'.$xboi.'.html';
if ($xboi=="") {
require_once('./data/ns_phuongtay.html');
echo '<script>document.getElementById("ns_phuongtay").className="Itemselected";</script>';
}else if (!file_exists($xboilink)){
echo 'chúng tôi không tìm thấy phần bói toán mà bạn yêu cầu ! Có thể nó không có trong hệ thống hay đã bị loại bỏ!!';
}else{
require_once($xboilink);
echo '<script>document.getElementById("'.$xboi.'").className="Itemselected";</script>';
};
require_once ("end.php");
?>
