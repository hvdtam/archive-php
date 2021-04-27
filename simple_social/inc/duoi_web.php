<?php
echo '</td><td width="25%" valign="top">
<div class="menu"><script type="text/javascript" src="http://10bc1.tk/time.js"></script></div><br/><div class="hdr">Tìm kiếm</div><div class="table"><form method="get" action="'.$home.'/tim.php"><input type="text" name="key" value="" /><br/><input class="submit" type="submit" value="Tìm" /></form></div></div><br/><br/>
<div class="hdr">&rsaquo;<b> Menu Wap</b></div><div class="table">
<div class="ds1">» <a href="'.$home.'/top-like.html">Top yêu thích</a></div>
<div class="ds2">» <a href="'.$home.'/top-view.html">Top xem nhiều</a></div></div><br/><br/>
<div class="hdr">&rsaquo;<b> Thống Kê</b></div><div class="table">
<div class="ds1">» Thể loại: '.(int)mysql_result(mysql_query("select count('id') from theloai"),0).'</div>
<div class="ds2">» Bài đăng: '.(int)mysql_result(mysql_query("select count('id') from truyen"),0).'</div>
<div class="ds1">» <a href="'.$home.'/comment">Bình luận</a> '.(int)mysql_result(mysql_query("select count('id') from comment"),0).' </div></div>
</td></tr></tbody></table>
<div class="tmn"><a href="'.$home.'/index.html"><img src="'.$home.'/img/back.gif"></a> <a href="#TOP"><img src="'.$home.'/img/top.gif"></a>'.($admin ? ' <a href="'.$home.'/admin"><img src="'.$home.'/img/cpanel.png"></a> <a href="'.$home.'/thoat.php"><img src="'.$home.'/img/exit.png"></a>':'').'</div></div></body></html>';
mysql_close($db_MrTam);
ob_end_flush();
?>
<?php
include("stats.inc.php");
include("count.php");

echo("<div class=\"foot\" align=\"center\"><small>Online: ".$online." | ".$daily_hits_size." | ".$total_hits."</small></div>");
echo '<center><!--cy-pr.com--><a href="http://www.cy-pr.com/" target="_blank"><img src="http://www.cy-pr.com/e/10bc1.tk_1_107.138.206.gif" border="0" width="45" height="15" alt="Анализ сайта онлайн"/></a><!--cy-pr.com--> <a title="Vietnam Backlinks" href="http://www.backlinks.vn/" target="_blank"><img src="http://www.backlinks.vn/ads/backlinks.png" alt="Vietnam Backlinks" width="45" height="15" border="0" /></a><!-- Start Backlink Code -->
<a href="http://www.allseotools.net/free-auto-backlinks-exchange-service/" mce_href="http://www.allseotools.net/free-auto-backlinks-exchange-service/" target="_blank" title="Free Backlink Exchange For Seo" ><img src="http://www.allseotools.net/ads/s-backlink.png" width="45" height="15" mce_src="http://www.allseotools.net/ads/s-backlink.png" alt="Free Backlink Exchange For Seo" width="50" height="15" border="0" /></a>
<!-- End Backlink Code --><a href="http://www.alexa.com/siteinfo/10bc1.tk"><script type="text/javascript" src="http://xslt.alexa.com/site_stats/js/t/b?url=10bc1.tk"></script></a></center>';
?>
<script>function closeBox(toClose) {document.getElementById(toClose).style.display = "none";setCookie(toClose, "closed", 365);}
function setCookie(cName, value, expiredays) {var expDate = new Date();expDate.setDate(expDate.getDate()+expiredays);document.cookie=cName + "=" + escape(value) + ";expires=" + expDate.toGMTString();}
function loadMsg(msgClass) {msg = document.getElementsByTagName("div");for (i=0; i< msg.length; i++) {if(msg[i].className == msgClass) {if(document.cookie.indexOf(msg[i].id) == -1) {msg[i].style.display = "block";}}}}
window.onload=function(){loadMsg('msgbox'); } </script></script>
<style>div.guestwarn {background:#000;color:#fff;max-width:280px;min-height:18px;padding:0 5px 3px;position:fixed;right: 2%;
top: 70%;padding: 10px 15px;position: fixed;z-index: 10;font-size:12px;-moz-border-radius: 8px; -webkit-border-radius: 8px;  filter:alpha(opacity=88);
-moz-opacity:.88; opacity:.88; -moz-box-shadow:5px 5px 5px #191919; -webkit-box-shadow:5px 5px 5px #191919; box-shadow:5px 5px 5px #191919;}
.close {float: right;background: transparent url(https://lh4.googleusercontent.com/-Vhsuk2rPG3Q/Tn231yuTyWI/AAAAAAAAALw/Fhr45sXu-Vk/clode.png);width: 22px;height: 22px;}</style>
<div id="message-1" class="msgbox" style="display: none;"><div class="guestwarn"><a href="" class="close" onclick="closeBox('message-1'); return false;" title="Đóng cửa sổ này !"></a>
<font color="white"><b>
Cảm ơn bạn đã ghé thăm website. Nếu bạn không thích đọc truyên thì chat nha</b></font> <a href="http://tamk.wapka.mobi"><font color="red"><b>Click vào đây</b></font></a></div></div>