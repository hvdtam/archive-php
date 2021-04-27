<?php
include'func.php';
include'../head.php';
$page = $_GET['page'];
$id = $_GET['id'];
$search = $_GET['search'];
$cat = $_GET['cat'];
if($cat) {
$source=grab_link('http://vn-books.totalh.com/benh-vien-online/?go=list&show=list&cat_id='.$cat.'');
}
if($page) {
$source=grab_link('http://vn-books.totalh.com/benh-vien-online/index.php?pg='.$page.'.html');
} else {
$source=grab_link('http://vn-books.totalh.com/benh-vien-online/index.php');
}
if($id) {
$source=grab_link('http://vn-books.totalh.com/benh-vien-online/index.php?go=play&id='.$id.'');
}
if($search) {
$source=grab_link('http://vn-books.totalh.com/benh-vien-online/index.php?go=search&keyword='.$search.'&type=song');
}
if($id) {
$batdau = '</style>';
} else {
$batdau='</form>';
}
$ketthuc='<div class="bmenu" align="center"><b>';
$view=laynoidung($source, $batdau, $ketthuc);
$view= str_replace('index.php','benhvien.php',$view);
$view= str_replace('go=list&show=list&cat_id=','cat=',$view);
$view= str_replace('/benh-vien-online/','',$view);
$view= str_replace('?go=play&id=','?id=',$view);
$view= str_replace('?pg=','?page=',$view);
$view= str_replace('.html','',$view);
$view= str_replace('#Mobile','',$view);
$view= str_replace('<div class="header"','<div class="phdr"',$view);
$view= str_replace('<img src="templates/funnycolors/images/logo.gif" border="0" alt="KENHDIDONG.COM" /></div>','',$view);
$view= str_replace('templates/funnycolors/images/micon.gif','img/ic.png',$view);
$view= str_replace('theloai.gif','img/dir.png',$view);
$view= str_replace('<div class="gmenu" align="center">','<div class="topmenu">',$view);
echo '<div class="rmenu"><form action="benhvien.php" method="get"><input type="text" name="search" value="Nhập tên căn bệnh"><input type="submit" value="Tìm"></form></div>';
echo $view;
include'../foot.php';
?>