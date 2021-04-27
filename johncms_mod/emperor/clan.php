<?php
###########################
#  Данная версия скрипта принадлежит       #
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
function klanai_first()
{
echo "<div class=\"main\"Next";
pochta();
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=registracija\">Tham gia gia tộc</a><br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=mano\">Gia tộc của tôi</a><br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=istoti\">Để tham gia vào gia tộc</a><br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=spisok\">Danh sách các gia tộc</a><br/>";
echo "----------<br/>";
echo "<a href=\"game.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Trang chủ</a>";
}

function regas_first()
{
echo "<div class=\"main\">";
pochta();
echo "Lập 1 Gia tộc sẽ mất 10.000 vàng.<br/>";
echo "<form action=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=registruoti\" method=\"post\">Tên Gia tộc:<br/>";
echo "<input type=\"text\" name=\"pav\" maxlength=\"20\"/><br/>";
echo "Mật khẩu<br/>";
echo "<input type=\"text\" name=\"pass\" maxlength=\"20\"/><br/>";
echo "<input type=\"submit\" value=\"Đăng ký\" class=\"ibutton\"></form>";
echo "----------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}

function registruoja()
{
if(ereg_replace("[A-za-zА-яа-я0-9]+", "", $_POST[pav]) && ereg_replace("[A-za-z0-9]+", "", $_POST[pass]))
{
echo "<div class=\"main\">";
pochta();
echo "Sử dụng các ký tự không đúng!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
$st = 10000;
$_POST[pav] = iconv('utf-8', 'windows-1251', $_POST[pav]);
$q=mysql_query("SELECT * FROM war WHERE `usr` = '$_GET[usr]' && `pwd` = '$_GET[pwd]';");
$war=mysql_fetch_array($q);
$tikr = mysql_num_rows(mysql_query("SELECT ikurejas FROM klanai WHERE ikurejas = '$_GET[usr]'"));
$tikr_pav = mysql_num_rows(mysql_query("SELECT pavadinimas FROM klanai WHERE pavadinimas = '$_POST[pav]'"));
if($tikr == 0 && $tikr_pav == 0 && $_POST[pav] != "" && $_POST[pass] != "" && $st<=$war['pinigai'])
{
$new_money = $war[pinigai]-$st;
mysql_query("INSERT INTO klanai SET ikurejas = '$_GET[usr]', pavadinimas = '$_POST[pav]', pass = '$_POST[pass]'");
mysql_query("UPDATE war SET klanas = '$_POST[pav]', pinigai = '$new_money' WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'");
$_POST[pav] = iconv('windows-1251', 'utf-8', $_POST[pav]);
echo "<div class=\"main\">";
pochta();
echo "Chúc mừng! Bạn đả tạo thành công 1 Gia Tộc<br/> Tên Gia tộc: <b>$_POST[pav]</b><br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=mano\">Trong gia tộc của tôi</a>";
}
elseif($tikr > 0)
{
echo "<div class=\"main\">";
pochta();
echo "У вас уже есть клан!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($st > $war['pinigai']){
echo "<div class=\"main\">";
pochta();
echo "Bạn không đủ Vàng!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($tikr_pav > 0)
{
echo "<div class=\"main\">";
pochta();
echo "Tên Gia Tộc đả có!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($_POST[pav] == "" || $_POST[pass] == "")
{
echo "<div class=\"main\">";
pochta();
echo "Bạn còn lại một lĩnh vực mục trống!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
}

function mano_klanas()
{
$tikr = mysql_num_rows(mysql_query("SELECT ikurejas FROM klanai WHERE ikurejas = '$_GET[usr]'"));
if($tikr > 0)
{
$admin = "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=admin\">Chức năng của Đấng Tạo Hóa của gia tộc!</a><br/>";
}
else{$admin = "";}
$patikrinimas = mysql_num_rows(mysql_query("SELECT usr, klanas FROM war WHERE usr = '$_GET[usr]' AND klanas != ''"));
if($patikrinimas > 0)
{
$asdf = mysql_fetch_array(mysql_query("SELECT klanas FROM war WHERE usr = '$_GET[usr]'"));
$klanas = strip_tags($asdf['klanas']);
$klanas = iconv("windows-1251","utf-8",$klanas);
echo "<div class=\"main\">";
pochta();
echo "Gia tộc của bạn: <b>$klanas</b><br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=nariai\">Thành phần của gia tộc</a><br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=finansai\">Tài chính</a><br/>";
echo "-------<br/>";
echo "$admin";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Bạn chưa đăng ký trong gia tộc nào!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}

function nariai()
{
$pat = mysql_fetch_array(mysql_query("SELECT usr, klanas FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));
$klanas = strip_tags($pat['klanas']);
if($klanas != "")
{
$m = mysql_fetch_array(mysql_query("SELECT ikurejas, pavadinimas, money FROM klanai WHERE pavadinimas = '$klanas'"));
$ikurejas = strip_tags($m['ikurejas']);
$pinigai = strip_tags($m['balans']);
$pavadinimas = strip_tags($m['pavadinimas']);

$i = 1;
$m = mysql_query("SELECT usr, klanas FROM war WHERE klanas = '$klanas'");
$pavadinimas = iconv("windows-1251","utf-8",$pavadinimas);
echo "<div class=\"main\">";
pochta();
echo "Tên Gia tộc: <b>$pavadinimas</b><br/>";
echo "Thành lập: <b>$ikurejas</b><br/>";
echo "Состав клана:<br/>";
while($mm = mysql_fetch_array($m))
{
$i2 = $i++;
$nickai = strip_tags($mm['usr']);
echo "$i2.$nickai<br/>";
}
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không thuộc về một gia tộc nào!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
function priemimas()
{
echo "<div class=\"main\">";
pochta();
echo "Để tham gia vào gia tộc bạn phải mất 2000 Vàng!";
echo "<form action=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=istoti_i\" method=\"post\">Viết tên của gia tộc mà bạn muốn vào:<br/>";
echo "<input type=\"text\" name=\"pavad\" maxlength=\"20\"/><br/>";
echo "Mật khẩu:<br/>";
echo "<input type=\"password\" name=\"slapt\" maxlength=\"20\"/><br/>";
echo "<input type=\"submit\" value=\"Вступить\" class=\"ibutton\"></form>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}

function istojimas()
{
if(ereg_replace("[A-za-zА-яа-я0-9]+", "", $_POST[pavad]) && ereg_replace("[A-za-z0-9]+", "", $_POST[slapt]))
{
echo "<div class=\"main\">";
pochta();
echo "Bạn đả sử dụng ký tự không cho phép!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
$st = 2000;
$_POST[pavad] = iconv("utf-8","windows-1251",$_POST[pavad]);
$q=mysql_query("SELECT * FROM war WHERE `usr` = '$_GET[usr]' && `pwd` = '$_GET[pwd]';");
$war=mysql_fetch_array($q);
$tikr = mysql_num_rows(mysql_query("SELECT pass, pavadinimas FROM klanai WHERE pavadinimas = '$_POST[pavad]' AND pass = '$_POST[slapt]'"));
$tikrina = mysql_num_rows(mysql_query("SELECT usr, klanas FROM war WHERE usr = '$_GET[usr]' AND klanas != ''"));
if($tikr > 0 && $tikrina == 0 && $_POST[pavad] != "" && $_POST[slapt] != "" && $st <= $war[pinigai])
{
$new_pinigai = $war[pinigai]-$st;
mysql_query("UPDATE war SET klanas = '$_POST[pavad]', pinigai = '$new_pinigai' WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'");
echo "<div class=\"main\">";
pochta();
$_POST[pavad] = iconv("windows-1251","utf-8",$_POST[pavad]);
echo "Bạn đã vào<b>$_POST[pavad]</b> Gia tộc!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($_POST[pavad] == "" || $_POST[slapt] == "")
{
echo "<div class=\"main\">";
pochta();
echo "Trống!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($war[pinigai]<$st){
echo "<div class=\"main\">";
pochta();
echo "Bạn có một vài người khác!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($tikrina > 0)
{
echo "<div class=\"main\">";
pochta();
echo "Bạn đã thuộc về gia tộc, vì vậy bạn không thể trở lại!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Tên Gia tộc hoặc Mật khẩu không chính xác!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
}

function admin_first()
{
$tikr = mysql_num_rows(mysql_query("SELECT ikurejas FROM klanai WHERE ikurejas = '$_GET[usr]'"));
if($tikr > 0)
{
echo "<div class=\"main\">";
pochta();
echo "<form action=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=pasalinti\" method=\"post\">Viết tên của Hoàng đế, những người muốn thoát khỏi gia tộc:<br/>";
echo "<input type=\"text\" name=\"name\" maxlength=\"20\"/><br/>";
echo "<input type=\"submit\" value=\"Убрать\" class=\"ibutton\"></form>";
echo "-------<br/>";
echo "<b>Thay đổi mật khẩu:</b><br/>";
echo "<form action=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=keisti_pass\" method=\"post\">Nhập mật khẩu mới:<br/>";
echo "<input type=\"text\" name=\"pwd\" maxlength=\"20\"/><br/>";
echo "<input type=\"submit\" value=\"Изменить\" class=\"ibutton\"></form>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không cần phải nhập gia tộc của mình!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
function admin()
{
if(ereg_replace("[A-za-zА-яа-я0-9]+", "", $_POST[name]))
{
echo "<div class=\"main\">";
pochta();
echo "Sử dụng ký tự trái phép!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
$d = mysql_fetch_array(mysql_query("SELECT pavadinimas, ikurejas FROM klanai WHERE ikurejas = '$_GET[usr]'"));
$ikurejas = strip_tags($d['ikurejas']);
$pavadinimas = strip_tags($d['pavadinimas']);
$c = mysql_fetch_array(mysql_query("SELECT usr, klanas FROM war WHERE usr = '$_POST[name]'"));
$klano_pav = strip_tags($c['klanas']);
if($ikurejas == "$_GET[usr]" && $_POST[name] != "" && $klano_pav == "$pavadinimas" && $_POST[name] != "$ikurejas")
{
mysql_query("UPDATE war SET klanas = '' WHERE usr = '$_POST[name]'");
echo "<div class=\"main\">";
pochta();
echo "Bạn đuổi ra khỏi $_POST[name] Gia tộc!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($ikurejas != "$_GET[usr]")
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không phải là trưởng tộc!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($pavadinimas != "$klano_pav")
{
echo "<div class=\"main\">";
pochta();
echo "Hoàng đế này không thuộc về gia tộc của bạn!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif($_POST[name] == "$ikurejas")
{
echo "<div class=\"main\">";
pochta();
echo "Bản thân mình trong gia tộc của tôi không thể!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Không nhập tên của Hoàng đế!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
}

function keicia_pass()
{
if(ereg_replace("[A-za-z0-9]+", "", $_POST[pwd]))
{
echo "<div class=\"main\">";
pochta();
echo "Sử dụng các ký tự không cho phép!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
elseif(empty($_POST[pwd]))
{
echo "<div class=\"main\">";
pochta();
echo "Bạn chưa nhập mật khẩu!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
$a = mysql_fetch_array(mysql_query("SELECT pavadinimas, ikurejas FROM klanai WHERE ikurejas = '$_GET[usr]'"));
$ikurejas = strip_tags($a['ikurejas']);

if($ikurejas == $_GET[usr])
{
mysql_query("UPDATE klanai SET pass = '$_POST[pwd]' WHERE ikurejas = '$_GET[usr]'");
echo "<div class=\"main\">";
pochta();
echo "Thay đổi mật khẩu<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Lỗi!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
}
function finansai_first()
{
$as = mysql_fetch_array(mysql_query("SELECT klanas FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));
$klanas = strip_tags($as['klanas']);
if($klanas != "")
{
$s = mysql_fetch_array(mysql_query("SELECT money FROM klanai WHERE pavadinimas = '$klanas'"));
$pinigai = strip_tags($s['balans']);
$klanas = iconv("windows-1251","utf-8",$klanas);
echo "<div class=\"main\">";
pochta();
echo "Gia tộc của bạn: <b>$klanas</b><br/>";
echo "Tài khoản của gia tộc <b>$pinigai</b> др.<br/>";
echo "-------<br/>";
echo "Nhập số tiền bạn muốn sung vào tài khoản của gia tộc:<br/>";
echo "<form action=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=padet\" method=\"post\"><input type=\"text\" format=\"5N\" name=\"mon\"/><br/>";
echo "<input type=\"submit\" value=\"Đặt\" class=\"ibutton\"></form>";
echo "-------<br/>";
echo "Nhập số tiền bạn muốn lấy từ tài khoản của gia tộc:<br/>";
echo "<form action=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=isimti\" method=\"post\"><input type=\"text\" format=\"5N\" name=\"pin\"/><br/>";
echo "<input type=\"submit\" value=\"Hãy\" class=\"ibutton\"></form>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không thuộc về gia tộc này!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
function padeti()
{
if(is_numeric($_POST[mon]))
{
$_POST[mon] = str_replace("-", "", $_POST[mon]);
$as = mysql_fetch_array(mysql_query("SELECT pinigai, klanas FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));
$klanas = strip_tags($as['klanas']);
$moneyy = strip_tags($as['pinigai']);
if($klanas != "" && $moneyy >= $_POST[mon])
{
$ss = mysql_fetch_array(mysql_query("SELECT money FROM klanai WHERE pavadinimas = '$klanas'"));
$pinigai = strip_tags($ss['balans']);

$new_pinigai = $pinigai + $_POST[mon];
$new_pinigaii = $moneyy - $_POST[mon];
mysql_query("UPDATE klanai SET money = '$new_pinigai' WHERE pavadinimas = '$klanas'");
mysql_query("UPDATE war SET pinigai = '$new_pinigaii' WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'");
echo "<div class=\"main\">";
pochta();
echo "вы положили на счет $_POST[mon] др.!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=finansai\">Quay lại</a>";
}
elseif($_POST[mon] > $moneyy)
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không phải là những người khác rất nhiều!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không thuộc về gia tộc nào!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Trong lĩnh vực nhập cảnh bạn có thể nhập chỉ số toàn bộ!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}

function isimt()
{
if(is_numeric($_POST[pin]))
{
$_POST[pin] = str_replace("-", "", $_POST[pin]);
$as = mysql_fetch_array(mysql_query("SELECT klanas, pinigai FROM war WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'"));
$klanas = strip_tags($as['klanas']);
$mone = strip_tags($as['pinigai']);

$ss = mysql_fetch_array(mysql_query("SELECT money FROM klanai WHERE pavadinimas = '$klanas'"));
$pinigai = strip_tags($ss['balans']);

if($klanas != "" && $pinigai >= $_POST[pin])
{
$new_pinigai = $pinigai - $_POST[pin];
$new_pinigaii = $mone + $_POST[pin];
mysql_query("UPDATE klanai SET money = '$new_pinigai' WHERE pavadinimas = '$klanas'");
mysql_query("UPDATE war SET pinigai = '$new_pinigaii' WHERE usr = '$_GET[usr]' AND pwd = '$_GET[pwd]'");
echo "<div class=\"main\">";
pochta();
echo "Bạn có số tiền  $_POST[pin] vàng.!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=finansai\">Quay lại</a>";
}
elseif($_POST[pin] > $pinigai)
{
echo "<div class=\"main\">";
pochta();
echo "Trên tài khoản của người khác quá nhiều không thể chuyển.!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Bạn không thuộc về một gia tộc nào!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}
else
{
echo "<div class=\"main\">";
pochta();
echo "Trong hộp đầu vào có thể được chỉ dẫn về số lượng!!!<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
}

function klanu_spisok()
{
if ($_GET[page] == "" || $_GET[page] < 0 || $_GET[page] == "0")
{
$_GET[page] = 0;
}
$next = $_GET[page] + 1;
$back = $_GET[page] - 1;
$num = $_GET[page] * 10;
if($_GET[page] == "0")
{$i = 1;}
else{$i = ($_GET[page]*10)+1;}
$viso = mysql_num_rows(mysql_query("SELECT pavadinimas FROM klanai"));
$puslap = floor($viso/10);
$r = mysql_query("SELECT pavadinimas, ikurejas, money FROM klanai ORDER BY money DESC LIMIT $num, 10");
echo "<div class=\"main\">";
pochta();
echo "<b>.Tên Gia tộc[vàng](Người lập):.</b><br/>";
while($a = mysql_fetch_array($r))
{
$i2 = $i++;
$ikr = strip_tags($a['ikurejas']);
$pav = strip_tags($a['pavadinimas']);
$money = strip_tags($a['balans']);
$pav = iconv("windows-1251","utf-8",$pav);
echo "$i2.<u><b>$pav</b></u>[<u>$money</u>](<i>$ikr</i>)<br/>";
}
if ($_GET[page] > 0)
{
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=spisok&amp;page=$back\">&lt;&lt;</a>";
}
elseif ($_GET[page] == 0)
{
echo "&lt;&lt;";
}
if($_GET[page] < $puslap || $_GET[page] == "" || $_GET[page] == 0)
{echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=spisok&amp;page=$next\">&gt;&gt;</a><br/>";}
else
{echo "&gt;&gt;<br/>";}

echo "<b>Toàn bộ gia tộc:</b> $viso<br/>";
echo "-------<br/>";
echo "<a href=\"clan.php?usr=$_GET[usr]&amp;pwd=$_GET[pwd]&amp;id=\">Quay lại</a>";
}
if($tikr == 1)
{
if($_GET[id] == "")
{
$set['title']='Gia tộc';
head();
title ();
klanai_first();}
elseif($_GET[id] == "registracija")
{
$set['title']='Tham gia Gia tộc';
head();
title ();
regas_first();}
elseif($_GET[id] == "registruoti")
{
$set['title']='Tham gia Gia tộc';
head();
title ();
registruoja();}
elseif($_GET[id] == "mano")
{
$set['title']='Gia tộc của tôi';
head();
title ();
mano_klanas();}
elseif($_GET[id] == "nariai")
{
$set['title']='Thành phần của gia tộc';
head();
title ();
nariai();}
elseif($_GET[id] == "istoti")
{
$set['title']='Để tham gia vào gia tộc';
head();
title ();
priemimas();}
elseif($_GET[id] == "istoti_i")
{
$set['title']='Để tham gia vào gia tộc';
head();
title ();
istojimas();}
elseif($_GET[id] == "admin")
{
$set['title']='Bảng điều khiển của người đứng đầu gia tộc';
head();
title ();
admin_first();}
elseif($_GET[id] == "pasalinti")
{
$set['title']='Loại bỏ khỏi gia tộc';
head();
title ();
admin();}
elseif($_GET[id] == "keisti_pass")
{
$set['title']='Thay đổi mật khẩu';
head();
title ();
keicia_pass();}
elseif($_GET[id] == "spisok")
{
$set['title']='Danh sách các gia tộc';
head();
title ();
klanu_spisok();}
elseif($_GET[id] == "finansai")
{
$set['title']='Ngân quỹ Gia tộc';
head();
title ();
finansai_first();}
elseif($_GET[id] == "padet")
{
$set['title']='Tài chính gia tộc';
head();
title ();
padeti();}
elseif($_GET[id] == "isimti")
{
$set['title']='Ngân quỹ Gia tộc';
head();
title ();
isimt();}
}
else
{
echo "<div class=\"main\">";
echo "Bạn không phải là một thành viên gia tộc nào!!!<br/>";
}
?>
