<?php

include("../head.php");

echo "<center class=\"b\">";
echo "<form action=\"download.php\" method=\"post\">";
echo "	Tên Logo[a-Z.]<br/><input name=\"text\" type=\"text\" value=\"\"><br/>";
echo "	Góc quay [1-180]<br/><input name=\"angle\" type=\"text\" value=\"\"><br/>";
echo "	Size chữ[1-40]<br/><input name=\"size\" type=\"text\" value=\"20\"><br/>";
echo "	Màu Nền<br/><input name=\"bg\" type=\"text\" value=\"ffffff\"><br/>";
echo "	Độ trong sáng (Nền)[0-127]<br/>(chỉ PNG)<br/><input name=\"b_alpha\" maxlength=\"3\" type=\"text\" value=\"0\"><br/>";
echo "	 Màu chữ<br/><input name=\"txtcolor\" type=\"\" value=\"000000\"><br/>";

echo"Font Style<br/>
<select name='font' class='textbox'>";

$dir = opendir ("fonts/");
while ($file = readdir ($dir))
{
if (( $file != ".") && ($file != "..") && ($file != ".htaccess") && ($file != "index.php")  && ($file != "$css.css")  )
{ $file= str_replace(".ttf","",$file);
echo "<option>$file</option>";
}}
echo "</select><br/>";
closedir ($dir);

echo "	Định dạng<br/><select size=\"1\" name=\"format\">
<option value=\"jpeg\">JPEG</option>
<option value=\"png\">PNG</option>
<option value=\"gif\">GIF</option>
</select>";

echo "<br/><input type=\"submit\" value=\"create\">";
echo "</form>";
echo "</center>";
include("../foot.php");

?>
