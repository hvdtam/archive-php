<?php
#bo dau van ban
function tiengviet($str) {
$str=strtr($str, array(
"A"=>"A", "a"=>"a",
"B"=>"B", "b"=>"b",
"C"=>"C", "c"=>"c",
"D"=>"D", "d"=>"d",
"E"=>"E", "e"=>"e",
"F"=>"F", "f"=>"f",
"G"=>"G", "g"=>"g",
"H"=>"H", "h"=>"h",
"I"=>"I", "i"=>"i",
"J"=>"J", "j"=>"j",
"K"=>"K", "k"=>"k",
"L"=>"L", "l"=>"l",
"M"=>"M", "m"=>"m",
"N"=>"N", "n"=>"n",
"O"=>"O", "o"=>"o",
"P"=>"P", "p"=>"p",
"R"=>"R", "r"=>"r",
"S"=>"S", "s"=>"s",
"T"=>"T", "t"=>"t",
"U"=>"U", "u"=>"u",
"V"=>"V", "v"=>"v",
"W"=>"W", "w"=>"w",
"Y"=>"Y", "y"=>"y",
"Z"=>"Z", "z"=>"z",
"As"=>"Á", "Ax"=>"Ã", "Aj"=>"Ạ", "Af"=>"À", "Ar"=>"Ả",
"Es"=>"É", "Ex"=>"Ẽ", "Ej"=>"Ẹ", "Ef"=>"È", "Er"=>"Ẻ",
"Ys"=>"Ý", "Yx"=>"Ỹ", "Yj"=>"Ỵ", "Yf"=>"Ỳ", "Yr"=>"Ỷ",
"Us"=>"Ú", "Ux"=>"Ũ", "Uj"=>"Ụ", "Uf"=>"Ù", "Ur"=>"Ủ",
"Os"=>"Ó", "Ox"=>"Õ", "Oj"=>"Ọ", "Of"=>"Ò", "Or"=>"Ỏ",
"Is"=>"Í", "Ix"=>"Ĩ", "Ij"=>"Ị", "If"=>"Ì", "Ir"=>"Ỉ",
"Aas"=>"Ấ", "Aax"=>"Ẫ", "Aaj"=>"Ậ","Aaf"=>"Ầ", "Aar"=>"Ẩ",
"Ees"=>"Ế", "Eex"=>"Ễ", "Eej"=>"Ệ","Eef"=>"Ề", "Eer"=>"Ể",
"Oos"=>"Ố", "Oox"=>"Ỗ", "Ooj"=>"Ộ","Oof"=>"Ồ", "Oor"=>"Ổ",
"Ows"=>"Ớ", "Owx"=>"Ớ", "Owj"=>"Ợ","Owf"=>"Ờ", "Owr"=>"Ở",
"Aws"=>"Ẵ", "Awx"=>"Ẵ", "Awj"=>"Ặ","Awf"=>"Ằ", "Awr"=>"Ẳ",
"Uws"=>"Ứ", "Uwx"=>"Ữ", "Uwj"=>"Ự","Uwf"=>"Ừ", "Uwr"=>"Ử","Dd"=>"Đ",
"as"=>"á", "ax"=>"ã", "aj"=>"ạ", "af"=>"à", "ar"=>"ả",
"es"=>"é", "ex"=>"ẽ", "ej"=>"ẹ", "ef"=>"è", "er"=>"ẻ",
"ys"=>"ý", "yx"=>"ỹ", "yj"=>"ỵ", "yf"=>"ỳ", "yr"=>"ỷ",
"us"=>"ú", "ux"=>"ũ", "uj"=>"ụ", "uf"=>"ù", "ur"=>"ủ",
"os"=>"ó", "ox"=>"õ", "oj"=>"ọ", "of"=>"ò", "or"=>"ỏ",
"is"=>"í", "ix"=>"ĩ", "ij"=>"ị", "if"=>"ì", "ir"=>"ỉ",
"aas"=>"ấ", "aax"=>"ẫ", "aaj"=>"ậ", "aaf"=>"ầ", "aar"=>"ẩ",
"ees"=>"ế", "eex"=>"ễ", "eej"=>"ệ", "eef"=>"ề", "eer"=>"ể",
"oos"=>"ố", "oox"=>"ỗ", "ooj"=>"ộ", "oof"=>"ồ", "oor"=>"ổ",
"ees"=>"ế", "eex"=>"ễ", "eej"=>"ệ", "eef"=>"ề", "eer"=>"ể",
"ows"=>"ớ", "owx"=>"ớ", "owj"=>"ợ", "owf"=>"ờ", "owr"=>"ở",
"aws"=>"ắ", "awx"=>"ẵ", "awj"=>"ặ", "awf"=>"ằ", "awr"=>"ẳ",
"uws"=>"ứ", "uwx"=>"ữ", "uwj"=>"ự", "uwf"=>"ừ", "uwr"=>"ử",
"uw"=>"ư",
"aw"=>"ă", "aa"=>"â", "oo"=>"ô","ee"=>"ê",
"uw"=>"ư", "ow"=>"ơ", "dd"=>"đ"));
return $str;
}
?>
