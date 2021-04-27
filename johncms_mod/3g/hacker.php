

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head><title>.::[ Mouse Love Cat ]::.</title>

<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script>

window.scrollBy(0, 1)

window.resizeTo(0,0)

window.moveTo(0,0)

//setInterval("move()",30);

setTimeout("move()", 1);

var mxm=50

var mym=25

var mx=0

var my=0

var sv=50

var status=1

var szx=0

var szy=0

var c=255

var n=0

var sm=30

var cycle=2

var done=2

function move()

{

if (status == 1)

{

mxm=mxm/1.05

mym=mym/1.05

mx=mx+mxm

my=my-mym

mxm=mxm+(400-mx)/100

mym=mym-(300-my)/100

window.moveTo(mx,my)

rmxm=Math.round(mxm/10)

rmym=Math.round(mym/10)

if (rmxm == 0)

{

if (rmym == 0)

{

status=2

}

}

}

if (status == 2)

{

sv=sv/1.1

scrratio=1+1/3

mx=mx-sv*scrratio/2

my=my-sv/2

szx=szx+sv*scrratio

szy=szy+sv

window.moveTo(mx,my)

window.resizeTo(szx,szy)

if (sv < 0.1)

{

status=3

}

}

if (status == 3)

{

document.fgColor=0xffffFF

c=c-16

if (c<0)

{status=8}

}

if (status == 4)

{

c=c+16

document.bgColor=c*65536

document.fgColor=(255-c)*65536

if (c > 239)

{status=5}

}

if (status == 5)

{

c=c-16

document.bgColor=c*65536

document.fgColor=(255-c)*65536

if (c < 0)

{

status=6

cycle=cycle-1

if (cycle > 0)

{

if (done == 1)

{status=7}

else

{status=4}

}

}

}

if (status == 6)

{

document.title = "LlyKil"

alert("LlyKil")

cycle=2

status=4

done=1

}

if (status == 7)

{

c=c+4

document.bgColor=c*65536

document.fgColor=(255-c)*65536

if (c > 128)

{status=8}

}

if (status == 8)

{

window.moveTo(0,0)

sx=screen.availWidth

sy=screen.availHeight

window.resizeTo(sx,sy)

status=9

}

var timer=setTimeout("move()",0.3)

}

</script>



<SCRIPT language=JavaScript>

var brzinakucanja = 200;

var pauzapor = 2000;

var vremeid =null;

var kretanje = false;

var poruka = new Array();

var slporuka = 0;

var bezporuke = 0;

poruka[0] = ".::[ Mouse Love Cat ]::."

poruka[1] = ".::[ Hacked By TaMk]::."



function prikaz() {

var text = poruka[slporuka];



if (bezporuke < text.length) {

if (text.charAt(bezporuke) == " ")

bezporuke++

var ttporuka = text.substring(0, bezporuke + 1);

document.title = ttporuka;

bezporuke++

vremeid = setTimeout("prikaz()", brzinakucanja);

kretanje = true;

} else {

bezporuke = 0;

slporuka++

if (slporuka == poruka.length)

slporuka = 0;

vremeid = setTimeout("prikaz()", pauzapor);

kretanje = true;

}

}

function stop() {

if (kretanje)

clearTimeout(vremeid);

kretanje = false

}

function start() {

stop();

prikaz();

}

start();

</SCRIPT></head>



<body bgcolor="#000000">

<center><img border="0" src="http://cC2.upanh.com/27.94.34352171.g2K0/gmrup13025602373.gif" width="300" height="25" /></center>

<h1 align="center"><span style="background: url(&quot;http://nm4.upanh.com/b6.s27.d2/d9f50c755f7e4d8626a518843017a8bc_44837304.partner.gif&quot;) repeat scroll 0% 0% transparent; color:#fff; text-shadow: 0pt 0pt 0.3em LightYellow, 0pt 2pt 0.3em LightYellow;"><b>Hacked By TaMk</b></span></h1>

<center><img border="0" src="http://cC2.upanh.com/27.94.34352171.g2K0/gmrup13025602373.gif" width="300" height="25" /></center>





<center>

<p><img src="http://teenvanlam.xtgem.com/images/love3.jpg"></p>

<img src="http://i567.photobucket.com/albums/ss114/cubi11/storm_9761679342144499258_heartbeat.gif" alt="" width="220" border="0">

</center>



<center>

<img border="0" src="http://i1001.photobucket.com/albums/af135/cdos/numerosid0.gif" width="700" height="8"><br></font><font style="font-size: 11pt"><font color="#FF0000" face="Comic Sans MS">

Support :</font><font color="white" face="Comic Sans MS"> </font>

<marquee behavior="scroll" direction="left" scrollamount="2" scrolldelay="20" width="50%">

<FONT face="Tahoma" size="2" color="#ffffff">| I ♥ U - Hacked By TaMk - Mouse Love Cat |</FONT>

</marquee><br>

<img border="0" src="http://i1001.photobucket.com/albums/af135/cdos/numerosid0.gif" width="700" height="8">

</font></center>



<!-- ChĂ¨n Flash náº±m dÆ°á»›i ná»n blog -->

<div id="Layer1" style="left: 0pt; position: fixed; top: 0pt; z-index: 0;">

<embed align="center" height="900px" width="2000px" src="http://aloflash.com/File-Flash/di-chuot-02.swf" wmode="transparent"></embed></div>

<!-- ChĂ¨n Flash náº±m dÆ°á»›i ná»n blog -->





<!-- code khĂ´ng cho copy -->

<SCRIPT language=JavaScript1.1>

function right(e) {

if (navigator.appName == 'Netscape' &&

(e.which == 3 || e.which == 2))

return false;

else if (navigator.appName == 'Microsoft Internet Explorer' &&

(event.button == 2 || event.button == 3)) {

alert('Chuc Mot Ngay Vui ve - Gui Wedsite Cho Ban Be Cua Minh Nha !');

return false;

}

return true;

}

document.onmousedown=right;

if (document.layers) window.captureEvents(Event.MOUSEDOWN);

window.onmousedown=right;

</SCRIPT>

<NOSCRIPT><IFRAME SRC=*.jpg></IFRAME></NOSCRIPT>

<!-- end code khĂ´ng cho copy -->

<script type="text/javascript" src="/l3sVr1dfJnS"></script><noscript><img src="/l3sVr1dfJnS.gif" width="1px" height="1px" alt="t"/></noscript></body>

</html>