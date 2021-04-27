<?php include '../head.php';?><script language="Javascript">
var g_r, g_g, g_b;
var r1, g1, b1, r2, g2, b2, r3, g3, b3, dr, dg, db, dr1, dg1, db1, dr2, dg2, db2;
var g_cstyle, prevbkc;

function ShowHideOptions()
{
var ctl;

if (document.form1.color_style.value == "rain")
{
if (document.all)
{
document.all["rainonly"].style.visibility = "visible";
document.all["gradonly"].style.visibility = "hidden";
document.all["grad3only"].style.visibility = "hidden";
}
if (document.layers)
{
document.layers["rainonly"].visibility = "visible";
document.layers["gradonly"].visibility = "hidden";
document.layers["grad3only"].visibility = "hidden";
}
ctl = document.getElementById("rainonly");
if (ctl) ctl.style.display = "";
ctl = document.getElementById("gradonly");
if (ctl) ctl.style.display = "none";
ctl = document.getElementById("grad3only");
if (ctl) ctl.style.display = "none";

}

if (document.form1.color_style.value == "grad1" || document.form1.color_style.value == "grad2")
{
if (document.all)
{
document.all["rainonly"].style.visibility = "hidden";
document.all["gradonly"].style.visibility = "visible";
document.all["grad3only"].style.visibility = "hidden";
}
if (document.layers)
{
document.layers["rainonly"].visibility = "hidden";
document.layers["gradonly"].visibility = "visible";
document.layers["grad3only"].visibility = "hidden";
}

ctl = document.getElementById("rainonly");
if (ctl) ctl.style.display = "none";
ctl = document.getElementById("gradonly");
if (ctl) ctl.style.display = "";
ctl = document.getElementById("grad3only");
if (ctl) ctl.style.display = "none";

}

if (document.form1.color_style.value == "grad3")
{
if (document.all)
{
document.all["rainonly"].style.visibility = "hidden";
document.all["gradonly"].style.visibility = "hidden";
document.all["grad3only"].style.visibility = "visible";
}
if (document.layers)
{
document.layers["rainonly"].visibility = "hidden";
document.layers["gradonly"].visibility = "hidden";
document.layers["grad3only"].visibility = "visible";
}
ctl = document.getElementById("rainonly");
if (ctl) ctl.style.display = "none";
ctl = document.getElementById("gradonly");
if (ctl) ctl.style.display = "none";
ctl = document.getElementById("grad3only");
if (ctl) ctl.style.display = "";

}


preview();

}

function tohex(decval)
{
var l, h;
var str = "";

l = Math.floor(decval % 16);
h = Math.floor(decval / 16);

if (h < 10)
{
str = "" + h;
}
if (h > 9)
{
switch(h)
{
case 10: str = "A"; break;
case 11: str = "B"; break;
case 12: str = "C"; break;
case 13: str = "D"; break;
case 14: str = "E"; break;
case 15: str = "F"; break;
default: str = "X"; break;
}
}

if (l < 10)
{
str = str + "" + l;
}
if (l > 9)
{
switch(l)
{
case 10: str += "A"; break;
case 11: str += "B"; break;
case 12: str += "C"; break;
case 13: str += "D"; break;
case 14: str += "E"; break;
case 15: str += "F"; break;
default: str += "X"; break;
}
}

return str;
}

function todec(hexval)
{
var l, h;
hexstr = new String(hexval);

switch(hexstr.charAt(0))
{
case "A": h = 10; break;
case "B": h = 11; break;
case "C": h = 12; break;
case "D": h = 13; break;
case "E": h = 14; break;
case "F": h = 15; break;
default: h = eval(hexstr.charAt(0));
}

switch(hexstr.charAt(1))
{
case "A": l = 10; break;
case "B": l = 11; break;
case "C": l = 12; break;
case "D": l = 13; break;
case "E": l = 14; break;
case "F": l = 15; break;
default: l = eval(hexstr.charAt(1));
}

return l + 16 * h;

}

function hexToRGB(hexval)
{
// wWw.TaMk.tK
str = new String(hexval);

// wWw.TaMk.tK
if (str.charAt(0) == "#") str = str.substr(1);

// wWw.TaMk.tK
g_r = todec(str.substr(0, 2));
g_g = todec(str.substr(2, 2));
g_b = todec(str.substr(4, 2));
}

function getSFXColor(k)
{
var r, g, b, k1, min, max;

// wWw.TaMk.tK
if (g_cstyle == 0)
{
if (document.form1.rvsdir.checked == 0) k1 = k;
else k1 = 5.3 - k;

r = 127 + 127 * Math.cos(k1 - .5);
g = 127 + 127 * Math.cos(k1 - 2.5);
b = 127 + 127 * Math.cos(k1 - 4.5);

if (document.form1.invcol.checked != 0)
{
r = 255 - r;
g = 255 - g;
b = 255 - b;
}

// wWw.TaMk.tK
min = r;
if (g < min) min = g;
if (b < min) min = b;

// wWw.TaMk.tK
r -= min;
g -= min;
b -= min;

// wWw.TaMk.tK
max = r;
if (g > max) max = g;
if (b > max) max = b;

// wWw.TaMk.tK
max = 255.0 / max;		// wWw.TaMk.tK
r *= max;
g *= max;
b *= max;

// Adjust for brightness and contrast
max = (document.form1.bright.value / 255) * (document.form1.cont.value / 255);
min = (255 - document.form1.cont.value) * (document.form1.bright.value / 255);

r = r*max + min;
g = g*max + min;
b = b*max + min;

if (r < 0) r = 0;
if (g < 0) g = 0;
if (b < 0) b = 0;

if (r > 255) r = 255;
if (g > 255) g = 255;
if (b > 255) b = 255;

}			// color style == rainbow

// Are we doing gradients?
if (g_cstyle == 1)
{
k -= Math.floor(k);
r = r1 + k * dr;
g = g1 + k * dg;
b = b1 + k * db;
}			// color style == grad1

if (g_cstyle == 2)
{
k -= 2 * Math.floor(k/2);

if (k < 1)
{
r = r1 + k * dr;
g = g1 + k * dg;
b = b1 + k * db;
}

if (k >= 1)
{
k -= 2;
r = r1 - k * dr;
g = g1 - k * dg;
b = b1 - k * db;
}

}			// color style == grad2

if (g_cstyle == 3)
{
k -= 3 * Math.floor(k/3);

if (k < 1)
{
r = r1 + k * dr;
g = g1 + k * dg;
b = b1 + k * db;
}

if (k >= 1 && k < 2)
{
k -= 1;
r = r2 + k * dr1;
g = g2 + k * dg1;
b = b2 + k * db1;
}

if (k >= 2)
{
k -= 2;
r = r3 + k * dr2;
g = g3 + k * dg2;
b = b3 + k * db2;
}

}			// color style == grad3

g_r = r;
g_g = g;
g_b = b;

}



function setOutSizeIndicator(divtext)
{
document.getElementById("charssub").setAttribute("id", "oldsub");
var newdiv=document.createElement("div");
newdiv.setAttribute("id", "charssub");
var newtext=document.createTextNode(divtext);
newdiv.appendChild(newtext);
document.getElementById("chars").appendChild(newdiv);
document.getElementById("chars").removeChild(document.getElementById("oldsub"));

}



function preview()
{
var i, k, l, scale, res;
var j = 45;

res = eval(document.form1.res.value);
if (res < 1) res = 1;

if (document.form1.color_style.value == "rain")
{
scale = Math.PI * (2 * eval(document.form1.reps.value) - .21) / j;
g_cstyle = 0;
}
if (document.form1.color_style.value == "grad1")
{
scale = document.form1.reps.value / j;
g_cstyle = 1;
}
if (document.form1.color_style.value == "grad2")
{
scale = 2.0 * document.form1.reps.value / j;
g_cstyle = 2;
}
if (document.form1.color_style.value == "grad3")
{
scale = 3.0 * document.form1.reps.value / j;
g_cstyle = 3;
}

// Are we doing gradients? If so, get the gradient variables ready.
if (document.form1.color_style.value == "grad1" || document.form1.color_style.value == "grad2")
{
hexToRGB(document.form1.rgb1.value);

// Obtain RGB values from hex codes
r1 = g_r;
g1 = g_g;
b1 = g_b;

hexToRGB(document.form1.rgb2.value);

r2 = g_r;
g2 = g_g;
b2 = g_b;

// Find delta values (decimal figure used to ensure floating point math)
dr = 0.0 + r2 - r1;
dg = 0.0 + g2 - g1;
db = 0.0 + b2 - b1;
}

if (document.form1.color_style.value == "grad3")
{
hexToRGB(document.form1.rgb1a.value);

// Obtain RGB values from hex codes
r1 = g_r;
g1 = g_g;
b1 = g_b;

hexToRGB(document.form1.rgb2a.value);

r2 = g_r;
g2 = g_g;
b2 = g_b;

hexToRGB(document.form1.rgb3a.value);

r3 = g_r;
g3 = g_g;
b3 = g_b;

// Find delta values (decimal figure used to ensure floating point math)
dr = 0.0 + r2 - r1;
dg = 0.0 + g2 - g1;
db = 0.0 + b2 - b1;

dr1 = 0.0 + r3 - r2;
dg1 = 0.0 + g3 - g2;
db1 = 0.0 + b3 - b2;

dr2 = 0.0 + r1 - r3;
dg2 = 0.0 + g1 - g3;
db2 = 0.0 + b1 - b3;
}

for (i=0; i<j; i += res)
{
k = scale * i;
getSFXColor(k);

for (l=i; (l<i+res) && (l<j); l++)
{
eval("document.getElementById(\"lorem" + l + "\").style.color = \"#" + tohex(g_r) + tohex(g_g) + tohex(g_b) + "\";");
}

}				// for i
}				// preview()

function MakeSFX()
{

var r, g, b;
var i, j, k, l;
var x, scale, res;
var min, max;
var in_tag = 0;
var oignumi = 0;
temp = new String("");

// Initialize string variables
instr = new String(document.form1.intxt.value);
outstr = new String("");
tempstr = new String("");
res = eval(document.form1.res.value);
if (res < 1) res = 1;

// Get the length and scale. For rainbows, the scale must be such that one cycle comes out to almost 2pi.
j = instr.length;
if (document.form1.color_style.value == "rain")
{
scale = Math.PI * (2 * eval(document.form1.reps.value) - .21) / j;
g_cstyle = 0;
}
if (document.form1.color_style.value == "grad1")
{
scale = document.form1.reps.value / j;
g_cstyle = 1;
}
if (document.form1.color_style.value == "grad2")
{
scale = 2.0 * document.form1.reps.value / j;
g_cstyle = 2;
}
if (document.form1.color_style.value == "grad3")
{
scale = 3.0 * document.form1.reps.value / j;
g_cstyle = 3;
}

// Are we doing gradients? If so, get the gradient variables ready.
if (document.form1.color_style.value == "grad1" || document.form1.color_style.value == "grad2")
{
hexToRGB(document.form1.rgb1.value);

// Obtain RGB values from hex codes
r1 = g_r;
g1 = g_g;
b1 = g_b;

hexToRGB(document.form1.rgb2.value);

r2 = g_r;
g2 = g_g;
b2 = g_b;

// Find delta values (decimal figure used to ensure floating point math)
dr = 0.0 + r2 - r1;
dg = 0.0 + g2 - g1;
db = 0.0 + b2 - b1;
}

// Start the loop
for (i=0; i<j; i++)
{
// First of all, is this the opening bracket of a tag?
if (instr.charAt(i) == "<") in_tag = 1;

// If this character is within a tag, do not apply colorization to it.

if (in_tag == 0)
{
// Determine the RGB values
k = scale * i;

getSFXColor(k);
r = g_r;
g = g_g;
b = g_b;

// Convert to hexadecimal
tempstr = tohex(r) + tohex(g) + tohex(b);

// Get the character to colorize
temp = instr.charAt(i);

// Is it a &; code?
if (instr.charAt(i) == "&")
{

// Search forward until either a semicolon, tag, or space is found
for (l=i+1; l<j; l++)
{
if (instr.charAt(l) == " ") break;
if (instr.charAt(l) == "<") break;
if (instr.charAt(l) == ">") break;
if (instr.charAt(l) == ";") break;
}			// for l

// If it's a semicolon, then we have ourselves a character.
if (instr.charAt(l) == ";")
{
temp = instr.substr(i, l-i+1);
}

}			// temp == "&"

// Are we outputting HTML or BBCode?
if (document.form1.out_format.value == "html")
{
if (i % res == 0) { outstr = outstr + "<font color='#" + tempstr + "'>"; oignumi = 1; }
outstr = outstr + temp;
if ((i+1) % res == 0) { outstr = outstr + "</font>"; oignumi = 0; }
}			// out_format = HTML

if (document.form1.out_format.value == "bbc")
{
if (i % res == 0) { outstr = outstr + "[color=#" + tempstr + "]"; oignumi = 1; }
outstr = outstr + temp;
if ((i+1) % res == 0) { outstr = outstr + "[/color]"; oignumi = 0; }
}			// out_format = BBCode

if (temp.length > 1) i += (temp.length - 1);

}	// in_tag == 0

if (in_tag == 1) outstr = outstr + instr.charAt(i);

// We have to check for the closing bracket of a tag last so it doesn't get colorized.
if (instr.charAt(i) == ">") in_tag = 0;

}

if (oignumi > 0)
{
if (document.form1.out_format.value == "html") outstr = outstr + "</font>";
if (document.form1.out_format.value == "bbc") outstr = outstr + "[/color]";
}

document.form1.outtxt.value = outstr;

//if (document.getElementById("chars").hasChildNodes())
//{
// document.getElementById("chars").removeChild("charssub");
//}

// var newdiv=document.createElement("div");
// newdiv.setAttribute("id", "charssub");
setOutSizeIndicator("Output: " + outstr.length + " characters.");
// newdiv.appendChild(newtext);
// document.getElementById("chars").appendChild(newdiv);
// document.getElementById("chars").removeChild(document.getElementById("oldsub"));

}



function UpdateRGB(ctl)
{
var lum;

// Set the background color to whatever the user has typed in
ctl.style.backgroundColor = ctl.value;

// Get RGB values from the user's selection
hexToRGB(ctl.value);

// Obtain luminance measurement
lum = .29 * g_r + .57 * g_g + .14 * g_b;

if (lum < 96)
{
ctl.style.color = "#FFFFFF";
}
else
{
ctl.style.color = "#000000";
}

preview();

}


function flipbkg(ctl)
{
if (prevbkc == "#FFFFFF") prevbkc = "#000000";
else prevbkc = "#FFFFFF";

ctl.style.backgroundColor = prevbkc;
}


</script>
</head>
<body onLoad="ShowHideOptions();">
<div class="ad" align="center"><h2>Rainbow Text - Tao chu nhieu mau</h2><form name="form1">
<div id="prevout"> </div>
<div class="content"><center><b>Tùy chọn:</b>phong cách màu sắc<br /><select name="color_style" onChange="ShowHideOptions();"><option value="rain">cầu vồng</option>
<option value="grad1">một lớp</option>
<option value="grad2">hai lớp</option>

<option value="grad3">ba lớp</option>
</select><br />
Định dạng Rainbow<br /><select name="out_format">
<option value="html">HTML</option>
<option value="bbc">BBCode</option>
</select><br />
<div id="rainonly"><div><table style="width:100%;">
<tr><td>Độ sáng (0-255)</td>
<td><input type="text" name="bright" style="width:50%;" value="255" onChange="preview();">
</td></tr><tr>
<td>Nhược điểm (0-255)
</td><td>

<input type="text" name="cont" style="width:50%;" value="225" onChange="preview();">
</td></tr></table>
<input type="checkbox" name="rvsdir" onClick="preview();"> Ngược hướng
<br />
<input type="checkbox" name="invcol" onClick="preview();"> đảo màu
</div></div>
<div id="gradonly">Mã màu khối chữ và số<br /><table style="width:100%;">
<tr><td>Màu bắt đầu</td>
<td>
<input type="text" name="rgb1" style="width:50%;" value="#FF0059" style="background-color: #000000; color: #FFFFFF;" onChange="UpdateRGB(this);"></td></tr>
<tr><td>Màu cuối</td><td>
<input type="text" name="rgb2" style="width:50%;" value="#9900FF" style="background-color: #9900FF; color: #FFFFFF;" onChange="UpdateRGB(this);"></td></tr>

</table>
</div>
<div id="grad3only">Mã màu khối chữ và số<br /><table style="width:100%;">
<tr><td>Màu bắt đầu</td>
<td>
<input type="text" name="rgb1a" style="width:50%;" value="#FF0059" style="background-color: #CC9966; color: #000000;" onChange="UpdateRGB(this);">
</td></tr>
<tr><td>Màu Trung gian</td><td>
<input type="text" name="rgb2a" style="width:50%;" value="#A1FF00" style="background-color: #66CC00; color: #000000;" onChange="UpdateRGB(this);">
</td></tr>
<tr><td>Màu cuối</td><td>
<input type="text" name="rgb3a" style="width:50%;" value="#00C1FF" style="background-color: #99CCFF; color: #000000;" onChange="UpdateRGB(this);">
</td></tr>

</table>
</div><table style="width:100%;">
<tr>
<td>lặp lại</td>

<td><input type="text" name="reps" size="2" value="1" onChange="preview();"></td>
</tr>
<tr>
<td>Quyết định</td>
<td><input type="text" name="res" size="2" value="1" onChange="preview();"></td>
</tr></table>
<b>văn bản :</b><br />
<textarea style="width:50%;" name="intxt">wellcome to wWw.TaMk.tK</textarea><br /><b>
<a href="javascript:MakeSFX();" class="ad">TẠO</a></b><br />
<b>Kết quả:</b><br />
<textarea style="width:50%;" name="outtxt"></textarea><br/>

<div id="chars" align="center"><div id="charssub"> </div><b><input type="reset" class="footer" value="Lam lai"></b></div>
</div></form>
</div>
</div>
<?php include '../foot.php';?>
