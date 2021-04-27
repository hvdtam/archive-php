<?php
                               /*========================================================*\
                                           * Mobile Youtube Script
                                          * Downloaded Frm : www.wapscripts.info
                                         * Free Wapscripts,Cheap Translated Script
                                        * Live Support- (c)Powered by www.wapscripts.info

                              \*=========================================================*/
include("config.php");
function connectdb()
{
    global $dbname, $dbuser, $dbhost, $dbpass;
    $conms = @mysql_connect($dbhost,$dbuser,$dbpass); //connect mysql
    if(!$conms) return false;
    $condb = @mysql_select_db($dbname);
    if(!$condb) return false;
    return true;
}
?>