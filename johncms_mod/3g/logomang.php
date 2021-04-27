<?php
// mod Gemorroj



include 'head.php';
###############If the search is off ###############


  echo '<div class="phdr">[<font color="red"><b>MCT</b></font>] Tạo logo mạng </div>';

////////////////
////logo mang////
////////////
$type = $_GET['type'];

switch ($type) {
case 'taive' :
$dc_text=$_POST['text']; 
$dc_hextext=$_POST['hextext'];  $dc_fontface=$_POST['fontface']; $dc_size=$_POST['size']; $dc_hexback=$_POST['hexback'];
 $dc_transpara=$_POST['transpara'];                          
$so="%23";                             $logo="http://realwap.net/logo_maker/logo.php?text=$dc_text&amp;hextext=$so$dc_hextext&amp;fontface=$dc_fontface&amp;size=$dc_size&amp;hexback=$so$dc_hexback&amp;transpara=$dc_transpara";
echo '<font Color="red"><b>Tạo logo thành công !!</font></b><br/>'; 
echo '<img src="' . $logo . '" alt="logo"/> <br/>'; echo '<a href="' . $logo . '"/><font Color="green">Cài làm logo mạng</font></a><br/>';  
 echo '<div class="caption">Chỉ dành riêng cho mobile, sữ dụng trình duyệt của máy tải về. Nếu sử dụng opera thì chọn open/mở và tải về, thoát ra và lưu logo lại.</div>
';
break; 
default:
echo '<div>Dịch vụ tạo logo mạng hoàn toàn miễn phí khẳng định đẳng cấp chú dế yêu của bạn. Chỉ dành riêng cho máy S40.</div>'; 
} 

echo '<div><form action="logomang.php?type=taive" method="post"> Tên logo:<br/><input type="text" name="text" title="Logo Text" value="ECW"/><br/> Màu logo:<br/><select name="hextext" title="Text colour"><option value="000000">Đen</option><option value="FFFFFF">Trắng</option><option value="66FFFF">Xanh lợt</option><option value="800000">Đỏ tươi</option><option value="C0C0C0">Xám</option><option value="808000">Vỏ đậu</option><option value="000080">Xanh lam</option><option value="800080">Tím đậm</option><option value="FFFF00">Vàng</option><option value="FF00FF">Tím lợt</option><option value="FFCC00">Cam</option><option value="FF3300">Đỏ huyết</option><option value="FFCCFF">Hồng</option><option value="99CCFF">Xanh da trời</option><option value="FFFFFF">Trắng sữa</option></select>
<br/> Kiểu Logo :<br/>
<select name="fontface" title="Text style">
<option value="wretch">wretch</option>
<option value="antsypan">antsypan</option>
<option value="artro">arabic</option>
<option value="artrbdo">arabic bold</option>
<option value="argosmf">argosmf</option>
<option value="fontleroy">fontleroy</option>
<option value="gogobig">gogobig</option>

<option value="pothead">pot head</option>
<option value="three">funk</option>
<option value="comets">comets</option>
<option value="four">highlander</option>
<option value="alien">alienated</option>
<option value="basic">squaresville</option>
<option value="dirty">dirty</option>
<option value="belvedere">belvedere</option>
<option value="evil">resident evil</option>

<option value="barmyarmy">chicken soup</option>
<option value="db">piped in</option>
<option value="hollowtip">hollowtip</option>
<option value="blocked">blocked up</option>
<option value="corrosion">corrosion</option>
<option value="insert.coin">insert coin</option>
<option value="greek.geek">greek geek</option>
<option value="bigus.dickus">bigus dickus</option>
<option value="aljazeera">al jazeera</option>

<option value="ethnic">ethnic</option>
<option value="pacman">pacman</option>
<option value="wapscallion">wapscallion</option>
<option value="flame">flame game</option>
<option value="surgery">surgery</option>
<option value="kittens">kittens</option>
<option value="ps2">ps2</option>
<option value="pricedow">grand theft auto</option>
<option value="pinholes">pinholes</option>

<option value="docket">bread docket</option>
<option value="lineup">line up</option>
<option value="seventies">seventies</option>
<option value="futurion">futurion</option>
<option value="admin">admin password</option>
<option value="slicey">slicey slicey</option>
<option value="squire">squire</option>
<option value="fishmap">fishmap</option>
<option value="spike">spike</option>

<option value="hitcounter">hit counter</option>
<option value="humanitarian">humanitarian</option>
<option value="barred">barred code</option>
<option value="cheers">cheers</option>
<option value="phoenix">crispy aromatic phoenix</option>
<option value="bladed">bladed</option>
<option value="ghost">friendliest ghost</option>
<option value="godfather">godfather</option>
<option value="hellraiser">hellraiser</option>

<option value="bevelled">bevelled</option>
<option value="copyright">copyright</option>
<option value="iconic">iconic values</option>
<option value="haw">hazard awareness</option></select>
<br/> Kích cỡ logo: <br/><select name = "size" title = "Font size"><option value = "10">1</option><option value = "13">2</option><option value = "16">3</option><option value = "18">4</option><option value = "21">5</option><option value = "25">6</option><option value = "28">7</option><option value = "30">8</option><option value = "34">9</option><option value = "37">10</option></select><br/> Màu nền: <br/><select name = "hexback" title = "Background"><option value="000000">Đen</option><option value="FFFFFF">Trắng</option><option value="66FFFF">Xanh lợt</option><option value="800000">Đỏ tươi</option><option value="C0C0C0">Xám</option><option value="808000">Vỏ đậu</option><option value="000080">Xanh lam</option><option value="800080">Tím đậm</option><option value="FFFF00">Vàng</option><option value="FF00FF">Tím lợt</option><option value="FFCC00">Cam</option><option value="FF3300">Đỏ huyết</option><option value="FFCCFF">Hồng</option><option value="99CCFF">Xanh da trời</option><option value="FFFFFF">Trắng sữa</option></select><br/>Không sữ dụng nền: <input type = "checkbox" name = "transpara" value = "yes"/><br/><input type = "submit" value = "Tạo logo"/></form></div>';
 
   
include 'foot.php';
?>