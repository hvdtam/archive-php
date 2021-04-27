<?php
define('_IN_JOHNCMS', 1);
$headmod = 'mod';
require('../incfiles/core.php');
$sql1 = "CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL auto_increment,
  `refid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `soft` text NOT NULL,
  `text` text NOT NULL,
  `price` varchar(4) NOT NULL,
  `true` varchar(1) NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
$sql2 = "CREATE TABLE IF NOT EXISTS `cms_quiz_log` (
  `id` int(11) NOT NULL auto_increment,
  `matter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` varchar(5) NOT NULL,
  `purse` varchar(12) NOT NULL default '',
  `time` int(11) NOT NULL,
  `close` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
$sql3 = "CREATE TABLE `cms_quiz_com` (`id` int(11) NOT NULL AUTO_INCREMENT, `quiz` int(11) NOT NULL, `user` int(11) NOT NULL, `text` text NOT NULL, `time` int(11) NOT NULL default '0', PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
mysql_query($sql1) or die('lỗi1! Vui lòng xóa dòng 5->20 để tiếp tục install');
mysql_query($sql2) or die('lỗi 2! Vui lòng xóa dòng 21->30 để tiếp tục install');
mysql_query($sql3) or die('lỗi 3! Vui lòng xóa dòng 31 để tiếp tục install');
echo 'Bạn đã cài đặt thành công.';
?>