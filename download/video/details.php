<?php
                               /*========================================================*\
                                           * Mobile Youtube Script
                                          * Downloaded Frm : www.wapscripts.info
                                         * Free Wapscripts,Cheap Translated Script
                                        * Live Support- (c)Powered by www.wapscripts.info

                              \*=========================================================*/
////////////////////////////// Download stuff
$action = $_GET["action"];
if ($action=="download")
{
// File: 	phpyoutube.php
// Version: 2.2
// Date:	06/04/2009
// Web:		http://blog.unijimpe.net
function getContent($url) {
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_HEADER, 0);

    ob_start();
    curl_exec ($ch);
    curl_close ($ch);
    $string = ob_get_contents();
    ob_end_clean();
    return $string;    
}
function fetch_headers($url) {
	$headers = array();
	$url = trim($url);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_NOBODY ,1);
	$data = curl_exec($ch);
	$errormsg = curl_error($ch);
	curl_close($ch);
					
	$headers = explode("\n", $data);
	return $headers;
}
function getYoutubeToken($id) {
	$path = "http://www.youtube.com/get_video_info?";
	$cont = getContent($path."&video_id=".$id);
	parse_str($cont, $opts);
	return $opts['token'];
}


$videoItem = trim($_GET['item']);
$videoType = "";
$videoPath = "http://www.youtube.com/get_video";

if ($_GET['type'] != "0") {
	$videoType = "&fmt=".$_GET['type'];
}
if ($videoItem != "") {
	$videoTokn = getYoutubeToken($videoItem);
	$videoURL = $videoPath."?video_id=".$videoItem."&t=".$videoTokn.$videoType."&asv=";
	$headers = fetch_headers($videoURL);
	for ($i=0; $i<count($headers); $i++) {
		if (strstr($headers[$i], "ocation:")) {
			$str1 = explode("ocation:", $headers[$i]);
			$link = trim($str1[1]);
			break;
		}
	}
	$vn=rand(0,9999);
   
   if($_GET['type']==17){
      header("Content-Type: video/3gp");   
        header("Content-Disposition: attachment; filename=\"$vn-(WapScripts.info).3gp\""); 
   }
   else if($_GET['type']==18){
      header("Content-Type: video/mp4");   
        header("Content-Disposition: attachment; filename=\"$vn-(WapScripts.info).mp4\"");
   }
   else{
      header("Content-Type: video/x-flv");   
        header("Content-Disposition: attachment; filename=\"$vn-(WapScripts.info).flv\"");
   }

      readfile($link);
       flush();
       exit();
}
}

/////////////End of download stuff

include("page_head.php");

?>

    <?php
    // function to parse a video <entry>
    function parseVideoEntry($entry) {      
      $obj= new stdClass;
      
      // get author name and feed URL
      $obj->author = $entry->author->name;
      $obj->authorURL = $entry->author->uri;
      
      // get nodes in media: namespace for media information
      $media = $entry->children('http://search.yahoo.com/mrss/');
      $obj->title = $media->group->title;
      $obj->description = $media->group->description;
      
      // get video player URL
      $attrs = $media->group->player->attributes();
      $obj->watchURL = $attrs['url']; 
      
      // get video thumbnail
      $attrs = $media->group->thumbnail[0]->attributes();
      $obj->thumbnailURL = $attrs['url']; 
            
      // get <yt:duration> node for video length
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->duration->attributes();
      $obj->length = $attrs['seconds']; 
      
      // get <yt:stats> node for viewer statistics
      $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
      if ($yt->statistics) {
      $attrs = $yt->statistics->attributes();
      $obj->viewCount = $attrs['viewCount']; 
      } else {
      $obj->viewCount = 0;
      }





      // get <gd:rating> node for video ratings
      $gd = $entry->children('http://schemas.google.com/g/2005'); 
      if ($gd->rating) { 
        $attrs = $gd->rating->attributes();
        $obj->rating = $attrs['average']; 
      } else {
        $obj->rating = 0;         
      }
        
      // get <gd:comments> node for video comments
      $gd = $entry->children('http://schemas.google.com/g/2005');
      if ($gd->comments->feedLink) { 
        $attrs = $gd->comments->feedLink->attributes();
        $obj->commentsURL = $attrs['href']; 
        $obj->commentsCount = $attrs['countHint']; 
      }
      
      // get feed URL for video responses
      $entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
      $nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.responses']"); 
      if (count($nodeset) > 0) {
        $obj->responsesURL = $nodeset[0]['href'];      
      }
         
      // get feed URL for related videos
      $entry->registerXPathNamespace('feed', 'http://www.w3.org/2005/Atom');
      $nodeset = $entry->xpath("feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.related']"); 
      if (count($nodeset) > 0) {
        $obj->relatedURL = $nodeset[0]['href'];      
      }
    
      // return object to caller  
      return $obj;      
    }   
    
    // get video ID from $_GET 
    if (!isset($_GET['id'])) {
      die ('ERROR: Missing video ID');  
    } else {
      $vid = $_GET['id'];
    }

    // set video data feed URL
    $feedURL = 'http://gdata.youtube.com/feeds/mobile/videos/' . $vid;

    // read feed into SimpleXML object
    $entry = simplexml_load_file($feedURL);
    
    // parse video entry
    $video = parseVideoEntry($entry);





       
    // display main video title

echo "<div class=\"header\">";
echo "{$video->title}";
echo "</div>";


    // get mobile stream url

$mobstream = $_GET["mobstream"];


    // display video thumbnail/stream/download 
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<?php
    echo "<div class=\"shoutmenu\">\n";
    echo "<img class=\"avatar\" src=\"$video->thumbnailURL\" alt=\"\" /><br/>\n";
    echo "<a href=\"$mobstream\">Xem online trên mobile</a><br/>\n";

?>


                
                <input name="item" id="item" type="hidden" value="<?php echo "$vid";?>" />
                <input name="action" type="hidden" value="download" />
                <select id="type" name="type">
                  
                  <option value="17">3GP &nbsp;</option>
                  <option value="18">MP4 &nbsp;</option>
                  <option value="0">FLV &nbsp;</option>
                </select>
                
                
                <input name="btget" id="btget" type="submit" value="Tải về" />


             
<?php

 echo "</div></form>";

          // display Full description
if(isset($_GET["fulldscr"]))
{
echo "<div class=\"shout\">Thông tin video:</div>\n";

echo "<div class=\"menu3\">\n";
    echo "<b>Thời lượng:</b> ";
    echo sprintf("%0.2f", $video->length/60) . " min<br/> 
    <b>Đánh giá:</b> {$video->rating}<br/> <b>Lượt xem:</b> {$video->viewCount}<br/>\n";
echo "</div>";
    ?>
  </body>
</html>    
<?php
exit();
}

echo "<div class=\"shout\">Thông tin video:</div>\n";

echo "<div class=\"menu3\">\n";
    echo "<b>Thời lượng:</b> ";
    echo sprintf("%0.2f", $video->length/60) . " min<br/> 
    <b>Đánh giá:</b> {$video->rating}<br/> <b>Lượt xem:</b> {$video->viewCount}<br/>\n";
echo "</div>"; 
  
    ?>  

    <?php      
    // if form submitted
        $vq = $video->title;
        $vq = ereg_replace('[[:space:]]+', ' ', trim($vq));
        $vq = urlencode($vq);
   
      
      // set max results per page
      if (!isset($_GET['i']) || empty($_GET['i'])) {
        $i = 5;
      } else {
        $i = htmlentities($_GET['i']);
      }
      
      // set sort critera
      if (!isset($_GET['s']) || empty($_GET['s'])) {
        $s = 'viewCount';
      } else {
        $s = htmlentities($_GET['s']);
      }
      
      // set start index
      if (!isset($_GET['pageID']) || $_GET['pageID'] <= 0) {
        $o = 1;  
      } else {        
        $pageID = htmlentities($_GET['pageID']);
        $o = (($pageID-1) * $i)+1;  
      }
      
      // generate feed URL
      $feedURL = "http://gdata.youtube.com/feeds/mobile/videos?vq={$vq}&orderby={$s}&max-results=5&start-index={$o}&format=1";
      
      // read feed into SimpleXML object
      $sxml = simplexml_load_file($feedURL);
      
      // get summary counts from opensearch: namespace
      $counts = $sxml->children('http://a9.com/-/spec/opensearchrss/1.0/');
      $total = $counts->totalResults; 
      $startOffset = $counts->startIndex; 
      $endOffset = ($startOffset-1) + $counts->itemsPerPage;       
      
      // include Pager class
      require_once 'Pager/Pager.php';
      $params = array(
          'mode'       => 'Jumping',
          'perPage'    => $i,
          'delta'      => 5,
          'totalItems' => $total,
      );
      $pager = & Pager::factory($params);
      $links = $pager->getLinks();     
      ?>
      
      <div class="header"><?php echo $_GET['vq']; ?>Video liên quan:</div>

      <?php    
      // iterate over entries in resultset
      // print each entry's details
      foreach ($sxml->entry as $entry) {
        // get nodes in media: namespace for media information
        $media = $entry->children('http://search.yahoo.com/mrss/');
        
        // get video player URL
        $attrs = $media->group->player->attributes();
        $watch = $attrs['url']; 

        // get 3GP STREAM URL 2
        $attrs = $media->group->content[0]->attributes();
        $mobilestream = $attrs['url']; 
        
        // get video thumbnail
        $attrs = $media->group->thumbnail[0]->attributes();
        $thumbnail = $attrs['url']; 
        
        // get <yt:duration> node for video length
        $yt = $media->children('http://gdata.youtube.com/schemas/2007');
        $attrs = $yt->duration->attributes();
        $length = $attrs['seconds']; 
        
        ////////// get <yt:stats> node for viewer statistics
       ///$yt = $entry->children('http://gdata.youtube.com/schemas/2007');
       ///if ($yt->statistics) {
       ///$attrs = $yt->statistics->attributes();
       ///$viewCount = $attrs['viewCount']; 
       ///} else {
       ///  $viewCount = 0; 
       ///}




        


      
        // get <gd:rating> node for video ratings
        $gd = $entry->children('http://schemas.google.com/g/2005'); 
        if ($gd->rating) {
          $attrs = $gd->rating->attributes();
          $rating = $attrs['average']; 
        } else {
          $rating = 0; 
        }

        // get video ID
        $arr = explode('/',$entry->id);
        $id = $arr[count($arr)-1];
             
        // print record
  ?>

<div class="menu3">
<table>
<tr valign="middle">
<td>

<?php

///////// PREVIEW IMAGE AS A LINK TO MOBILE STREAM

echo "<a href=\"{$mobilestream}\">";
echo "<img class=\"avatar\" src=\"$thumbnail\" width=\"60\" height=\"45\" alt=\"\" />";
echo "</a>\n";
?>

</td>
<td style="padding-left:2px;">
<div style="padding-bottom:1px;">

<?php

///////// VIDEO TITLE AS A LINK TO DETAILS PAGE

echo "<a href=\"details.php?id=$id&amp;mobstream={$mobilestream}\">{$media->group->title}</a>\n";
?>

</div>

<?php

///////// VIDEO LENGHT AS MM:SS // VIDEO RATING OUT OF 5

if (($rating=="0") || (($rating>0.0) && ($rating<0.5)))
{
$rating = "<img src=\"stars/0.0.gif\" alt=\"\"/>";
}else
if (($rating=="0.5") || (($rating>0.5) && ($rating<1.0)))
{
$rating = "<img src=\"stars/0.5.gif\" alt=\"\"/>";
}else
if (($rating=="1.0") || (($rating>1.0) && ($rating<1.5)))
{
$rating = "<img src=\"stars/1.0.gif\" alt=\"\"/>";
}else
if (($rating=="1.5") || (($rating>1.5) && ($rating<2.0)))
{
$rating = "<img src=\"stars/1.5.gif\" alt=\"\"/>";
}else
if (($rating=="2.0") || (($rating>2.0) && ($rating<2.5)))
{
$rating = "<img src=\"stars/2.0.gif\" alt=\"\"/>";
}else
if (($rating=="2.5") || (($rating>2.5) && ($rating<3.0)))
{
$rating = "<img src=\"stars/2.5.gif\" alt=\"\"/>";
}else
if (($rating=="3.0") || (($rating>3.0) && ($rating<3.5)))
{
$rating = "<img src=\"stars/3.0.gif\" alt=\"\"/>";
}else
if (($rating=="3.5") || (($rating>3.5) && ($rating<4.0)))
{
$rating = "<img src=\"stars/3.5.gif\" alt=\"\"/>";
}else
if (($rating=="4.0") || (($rating>4.0) && ($rating<4.5)))
{
$rating = "<img src=\"stars/4.0.gif\" alt=\"\"/>";
}else
if (($rating=="4.5") || (($rating>4.5) && ($rating<5.0)))
{
$rating = "<img src=\"stars/4.5.gif\" alt=\"\"/>";
}else
if (($rating=="5.0") || ($rating>5.0))
{
$rating = "<img src=\"stars/5.0.gif\" alt=\"\"/>";
}



echo sprintf("%0.2f", $length/60) . "&nbsp;&nbsp;&nbsp; {$rating} <br/>";

echo "</td></tr></table></div>";

}
   
include("footer.php");

?>