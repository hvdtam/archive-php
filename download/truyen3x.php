<?
define('_IN_VINAFUN', 1);
require_once ('replacetonghop.php');
$type = $_GET['type'];
$truyen = $_GET['truyen'];
$duongdan = $_GET['view'];
if($truyen=='0-9'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/5-0-9";}
if($truyen=='a'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/6-a";}
if($truyen=='b'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/7-b";}
if($truyen=='c'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/8-c";}
if($truyen=='ch'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/10-ch";}
if($truyen=='d'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/9-d";}
if($truyen=='eg'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/12-g";}
if($truyen=='h'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/13-h";}
if($truyen=='ik'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/14-i-k";}
if($truyen=='l'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/15-l";}
if($truyen=='n'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/24-n";}
if($truyen=='ngngh'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/31-ng-ngh";}
if($truyen=='nh'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/30-nh";}
if($truyen=='m'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/16-m";}
if($truyen=='op'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/17-o-p";}
if($truyen=='qr'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/18-q-r";}
if($truyen=='s'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/19-s";}
if($truyen=='t'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/20-t";}
if($truyen=='thtr'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/21-th-tr";}
if($truyen=='uv'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/22-u-v";}
if($truyen=='xy'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/23-x-y";}
if($truyen=='dtla1'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/3-dong-tinh-luyen-ai-nu";}
if($truyen=='dtla2'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/6-dong-tinh-luyen-ai-nam";}
if($truyen=='loanluan'){$linktruyen="http://www.truyenviet.com/truyen-nguoi-lon/4-loan-luan";}
switch ($type)
{
case 'aaa':
require_once ("head.php");
echo '<div class="phdr">Truyện 3x</div></div>';
$source = grab_link($linktruyen);
$batdau = '<span>Add Your Site</span>';
$ketthuc = '<span style="font-family: arial,helvetica,sans-serif;">©2002-2009 TruyenViet.com</span>';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
echo $tinphp;
echo '</div>';
echo '';
require_once ("foot.php");
break;
case 'detail':
$url= "http://truyenviet.com/trang-chu/truyen-nguoi-lon".$duongdan."";
$source = grab_link($url);
$batdau = '<span>Add Your Site</span>';
$ketthuc = '<span style="font-family: arial,helvetica,sans-serif;">©2002-2009 TruyenViet.com</span>';
$tinphp = laynoidung($source, $batdau, $ketthuc);
$tinphp = preg_replace('/<a href="/','<a href="?type=detail&view=',$tinphp);
$tinphp = preg_replace("/<a href='/",'<a href="?type=detail&view=',$tinphp);
$tinphp = preg_replace('#<img src="#is','<img alt="image" src="',$tinphp);
$tinphp = preg_replace("#<img src='#is",'<img alt="image" src="',$tinphp);
$title = explode('<b>',$tinphp);
$title = explode('</b><br/>',$title[1]);
$title = $title[0];
require_once ("head.php");
echo '<div class="phdr">Truyện 3x</div>';
echo $tinphp;
require_once ("foot.php");
break;
default:
$title = "Báo Điện Tử";
require_once ("head.php");
echo '<div class="phdr">Truyện 3x Việt</div>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=0-9">Từ 0-9 (15 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=a">Từ A (32 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=b">Từ B (65 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=c">Từ C (67 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=ch">Từ Ch (74 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=d">Từ D - Đ (43 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=eg">Từ E - G (27 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=h">Từ H (19 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=ik">Từ I - K (18 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=l">Từ L (28 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=n">Từ N (23 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=ngngh">Từ Ng -Ngh (39 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=nh">Từ Nh (23 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=m">Từ M (52 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=op">Từ O - P (11 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=qr">Từ Q -R (7 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=s">Từ S (11 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=t">Từ T (49 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=thtr">Từ Th - Tr(50 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=uv">Từ U - V (21 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=xy">Từ X -Y (11 danh mục)</a><br/>
[<font color="blue"><b>TK</b></font>] <a href="truyen3x.php?type=aaa&truyen=qr">Đồng Tính Luyến Ái Nữ (9 danh mục)</a><br/>
<br/>';
require_once ("foot.php");
}
exit;
?>
