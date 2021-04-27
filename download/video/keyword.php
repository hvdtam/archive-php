<?php
                               /*========================================================*\
                                           * Mobile Youtube Script
                                          * Downloaded Frm : www.wapscripts.info
                                         * Free Wapscripts,Cheap Translated Script
                                        * Live Support- (c)Powered by www.wapscripts.info

                              \*=========================================================*/
include("page_head.php");
?>
<div class="catchtubebetalogo">
<a href="/index.php"><img src="/newlogo.png"></a>
</div>
<br/>
<?
include("config.php"); 
include("core.php"); 
connectdb();

 $result = mysql_query("SELECT * FROM search ORDER BY id DESC LIMIT 0,60");
while($row = mysql_fetch_array($result))
  {
  echo "<a href=\"http://catchtube.mobi/search.php?vq=". $row['keyword'] ."&s=viewCount&submit=Search\">" . $row['keyword'] . "</a> | ";
  }

?>
<div style="catchtubebeta1">
<form method="get" action="search.php" >
      <br/>Tìm kiếm:<a href="keyword.php">(?)</a><br/>
      <input type="text" name="vq" maxlength="128" size="15"style="color:#333;padding:0;font-family:Verdana, Arial, sans-serif;width:65%" />
      <input type="submit" name="submit" value="Search" style="padding:0;color:black;margin-top:2px;font-size:100%" /> 
</form>
</div>
<?
include("ctubefooter.php");
?>