<?php include"head.php" ?>
<?




$do = $_GET['do'];

if ($do=="banner")
{

// Set the content-type
header('Content-type: image/png');
header("Content-Disposition: filename=mybanner.png");




$text4 = $_REQUEST['text'];
///////////////////////////////////
$timenow = time();
$newdate = date('D jS M y',$timenow);
$timenow = date("h:i:s A", $timenow);
$font = $_REQUEST['font'];

if ($font=="AGENO___.TTF")
{
$fontsize = "20";
}
else
{
$fontsize = "30";
}

if ($font=="")
{
$font = "ARIALBD.TTF";
}
//////////////////////////////////

///////////////////////////////////

 $imagesrc = $_REQUEST['background'];

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
// Create the image

 $im = imagecreatefromgif("images/$imagesrc");

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 200, 40);
$black = imagecolorallocate($im, 0, 0, 0);


imagettftext($im, 20, 0, 135, 44, $black, $font, $text4);
imagettftext($im, 20, 0, 134, 43, $white, $font, $text4);


// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);

}
else
{

echo "<html>
<head>

<meta name=\"description\" content=\"Free Banner Image 4 Ur WapSite\" />
<meta name=\"keywords\" content=\"banner,image,wapsite,website,customisable\" />
<meta name=\"author\" content=\"pmbguy\" />
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=ISO-8859-1\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"../style.php?uid=1\"/>
<title>PMB'z Banner Settings</title>
</head>
<body>
<table class=\"i180\"><tr><td><center>
<form method=\"post\" action=\"$PHP_SELF?do=banner\">
Enter Your Text:<br/><input type=\"text\" maxlength=\"20\" value=\"ENTER TEXT\" name=\"text\"><hr/>
Select background image:<br />";

$count = 0;
if ($handle = opendir('./images')) {
    while (false !== ($file = readdir($handle))) {



        if ($file != "." && $file != "..") {$count++;
        
        if ($count=="1")
        {
        print("<img src=\"phpThumb/phpThumb.php?w=200&src=../images/$file\"><br/><input type=\"radio\" checked=\"checked\" name=\"background\" value=\"$file\" /><br/>$file<br />\n");
        }
          else
          {
            print("<img src=\"phpThumb/phpThumb.php?w=200&src=../images/$file\"><br/><input type=\"radio\" name=\"background\" value=\"$file\" /><br/>$file<br />\n");
          }
        }
    }
    closedir($handle);
}

echo "<hr/>Select font:<br />";

$count = 0;
if ($handle = opendir('./')) {
    while (false !== ($file = readdir($handle))) {
         $file2 = strrev($file);
         $ext=explode(".", $file2);
         $ext = strrev($ext[0]);
         $ext = strtolower($ext);

        if ($file != "." && $file != ".." && $ext=="ttf") {$count++;
                  if ($count=="1")
        {
        print("<input type=\"radio\" checked=\"checked\" name=\"font\" value=\"$file\" /><br/>$file<br />\n");
        }
          else
          {
            print("<input type=\"radio\" name=\"font\" value=\"$file\" /><br/>$file<br />\n");
          }
        }
    }
    closedir($handle);
}

echo "<br/>
<input type=\"submit\" value=\"Make Logo\">
</form>
<hr/>

</td></tr></table>
</body>
</html>";

}
?>

<?php include"foot.php" ?>