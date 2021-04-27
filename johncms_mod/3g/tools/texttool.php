<?
function rainbow($text)
{
	//
	// Mod code ntn.h2m.ru
	//
	
	if ( !defined('RAINBOW_COLORS_LOADED') )
	{
		$colors = load_rainbow_colors ();
	}
	$text = trim(stripslashes($text));
	$length = strlen($text);
	$result = '';
	$color_counter = 0;
	$TAG_OPEN = false;
	for ( $i = 0; $i < $length; $i++ )
	{
		$char = substr($text, $i, 1);
		if ( !$TAG_OPEN )
		{
			if ( $char == '<' )
			{
				$TAG_OPEN = true;
				$result .= $char;
			}
			elseif ( preg_match("#\S#i", $char) )
			{
				$color_counter++;
				$result .= '<font color="' . $colors[$color_counter] . '">' . $char . '</font>';
				$color_counter = ( $color_counter == 7 ) ? 0 : $color_counter;
			}
			else
			{
				$result .= $char;
			}
		}
		else
		{
			if ( $char == '>' )
			{
				$TAG_OPEN = false;
			}
			$result .= $char;
		}
	}
	return $result;
}

function load_rainbow_colors ()
{
	return array(
		1 => 'red',
		2 => 'orange',
		3 => 'yellow',
		4 => 'green',
		5 => 'blue',
		6 => 'indigo',
		7 => 'violet'
		);
}
require '../head.php';
echo '<div class="menu">';
echo '<p align=center><big><b>Text Tool</b></big></p><div align=left>';
###############################
echo'
<form action="texttool.php" method=GET>
Enter text<input type="text" name="s"><input type="submit" name="sub" value="Creat">
</form>
<hr>';
if ($_GET['sub'])
{
echo '<hr>';
echo 'Preview: '.rainbow($_GET['s']).'<br />';
echo 'Copy: <textarea>'.rainbow($_GET['s']).'</textarea>';
}
echo '</div>';
###############################
require '../foot.php';
?>
