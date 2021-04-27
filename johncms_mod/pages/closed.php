<?php

/*
////////////////////////////////////////////////////////////////////////////////
// JohnCMS                Mobile Content Management System                    //
// Project site:          http://johncms.com                                  //
// Support site:          http://gazenwagen.com                               //
////////////////////////////////////////////////////////////////////////////////
// Lead Developer:        Oleg Kasyanov   (AlkatraZ)  alkatraz@gazenwagen.com //
// Development Team:      Eugene Ryabinin (john77)    john77@gazenwagen.com   //
//                        Dmitry Liseenko (FlySelf)   flyself@johncms.com     //
////////////////////////////////////////////////////////////////////////////////
*/

define('_IN_JOHNCMS', 1);
require('../incfiles/core.php');
$textl = 'Сайт закрыт';
$headmod = 'closed';
require('../incfiles/head.php');

if ($set['closed']) {
	if (!empty($set['close_message']))
	$new = $set['close_message'];
	$new = htmlspecialchars($new, ENT_QUOTES, 'UTF-8') ; 
	$new = functions::checkout($new, 1, 1);
	echo $new ;
} else {
    header('Location: ' . $set['homeurl'] . '/index.php');
    exit;
} 
require('../incfiles/end.php');

?>