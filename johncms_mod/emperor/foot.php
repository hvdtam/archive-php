<?
###########################
#  Данная версия скрипта принадлежит       # 
#       LiraS aka Артур Лукин Иванович          #
#   Вносить свои изменения крайне               #
#                 запрещенно!                                    #
###########################
//низ проекта:)
echo '</div><div class="foot"><a href="http://waplog.mobi/from.php?s_id=11495"><img src="http://waplog.mobi/11495.small" alt="waplog.MOBI" /></div>';
echo "<div class=\"copy\">";
if(isset($_GET['site']) && isset($_GET['name']))
{
echo "&copy;<a href=\"redirect.php?site=$_GET[site]\">".$_GET['name']."</a>";
}
else{
echo "&copy;GaMe.RU TeaM<br/></div>";
}
echo "</body></html>";
?>