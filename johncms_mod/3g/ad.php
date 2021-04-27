<?php
/*******************************************************************************
*  Title: Random text script (RanTex)
*  Version: 1.0 @ January 4, 2009
*  Author: Klemen Stirn
*  Website: http://www.wapscripts.info
********************************************************************************
*  COPYRIGHT NOTICE
*  Copyright 2009 Klemen Stirn. All Rights Reserved.
*
*  This script may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Klemen Stirn from any
*  liability that might arise from it's use.
*
*  If you are using this script you are required to place a link
*  to WapScripts on your website. You will find some link suggestions here:
*  http://www.wapscripts.info/link2us.php
*
*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.
*
*  Obtain permission before redistributing this software over the Internet
*  or in any other medium. In all cases copyright and header must remain
*  intact. This Copyright is in full effect in any country that has
*  International Trade Agreements with the United States of America or
*  with the European Union.
*******************************************************************************/

/*******************************************************************************
*  SETTINGS
*
*  See readme.htm file for further instructions!
*******************************************************************************/

/* File, where the random text/quotes are stored one per line */
$settings['text_from_file'] = '../ads.txt';

/*
   If you prefer you can list quotes that RanTex will choose from here.
   In this case set above variable to $settings['text_from_file'] = '';
*/
$settings['quotes'] = array(
'First quote',
'Multi
line
quote',
'Second quote',
'Third quote',
'Some text with <b>HTML</b> code!',
'Any single quotes \' must be escaped with a backslash',
'A quote with a <a href="http://www.wapscripts.info">link</a>!',
);

/*
   How to display the text?
   0 = raw mode: print the text as it is, when using RanTex as an include
   1 = Javascript mode: when using Javascript to display the quote
*/
$settings['display_type'] = 0;

/* Allow on-the-fly settings override? 0 = NO, 1 = YES */
$settings['allow_otf'] = 1;

/*******************************************************************************
*  DO NOT EDIT BELOW...
*
*  ...or at least make a backup before you do!
*******************************************************************************/

/* Override type? */
if ($settings['allow_otf'] && isset($_GET['type']))
{
	$type = intval($_GET['type']);
}
else
{
	$type = $settings['display_type'];
}

/* Get a list of all text options */
if ($settings['text_from_file'])
{
	$settings['quotes'] = file($settings['text_from_file']);
}

/* If we have any text choose a random one, otherwise show 'No text to choose from' */
if (count($settings['quotes']))
{
	$txt = $settings['quotes'][array_rand($settings['quotes'])];
}
else
{
	$txr = 'No text to choose from';
}

/* Output the image according to the selected type */
if ($type)
{
    /* New lines will break Javascript, remove any and replace them with <br /> */
    $txt = nl2br(trim($txt));
    $txt = str_replace(array("\n","\r"),'',$txt);
	echo 'document.write(\''.addslashes($txt).'\')';
}
else
{
	echo  '<div class="list1">'.$txt.'</div>';
	
}
?>
