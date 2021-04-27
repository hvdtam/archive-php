<?
{
$roq = mysql_query("SELECT `guest`.*, `users`.`name`, `users`.`rights`, `users`.`lastdate`, `users`.`sex`, `users`.`status`, `users`.`datereg`, `users`.`ip` , `users`.`browser`   FROM `guest` LEFT JOIN `users` ON `guest`.`user_id` = `users`.`id` ORDER BY `time` DESC LIMIT 5;");;
while ($res = mysql_fetch_array($roq))
{
      if ($res['rights'] == 0) {
$res['colornick'] = '#000000';
}

    if ($res['rights'] == 1) {
$res['colornick'] = '#008000';
}

      if ($res['rights'] == 2) {
$res['colornick'] = '#008000';
}


      if ($res['rights'] == 3) {
$res['colornick'] = '#008000';
}


      if ($res['rights'] == 4) {
$res['colornick'] = '#008000';
}


      if ($res['rights'] == 5) {
$res['colornick'] = '#008000';
}


      if ($res['rights'] == 6) {
$res['colornick'] = '#0000FF';
}


      if ($res['rights'] == 7) {
$res['colornick'] = '#FFD700';
}

       if ($res['rights'] == 9)

{
$res['colornick'] = '#ff0000';
}
       if ($res['rights'] == 10)
  {
$res['colornick'] = '#a52a2a';
}

                  echo (time() > $res['lastdate'] + 300 ? '<font color="red" size="4" align="absmiddle">&bull;</font> ' : '<font color="green" size="4" align="absmiddle">&bull;</font> ');
// icon seks
global $set_user, $realtime, $user_id, $admp, $home;
echo '<a href="../users/profile.php?user=' . $res['user_id'] . '"><font color="' . $res['colornick'] . '"><b>' . $res['name'] . '</b></b></font></a> ';
$ontimes = $res['lastdate'] + 300;
if ($realtime > $ontimes)
{
echo '<span style="color:black;"><b>:</b></span>';
}
else
{
echo '<span style="color:black"><b>:</b></span>';
}
echo ' ';
  /////////

 if($user_id) {
$post = str_replace('[you]', $login, $post);
} else {
$post = str_replace('[you]', 'Khách', $post);
}

$post = functions::checkout($res['text'], 1, 1);
$post = functions::smileys($post, $res['rights'] >= 1 ? 1 : 0);

// text
if (mb_strlen($post) >= 1000)
{
$post = mb_substr($post, 0, 1000);
echo $post.' ';
}
else
{
echo $post;
}
echo '<br/>';
++$i;
}
}
?>