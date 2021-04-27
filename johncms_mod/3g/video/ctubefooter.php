<?php
                               /*========================================================*\
                                           * Mobile Youtube Script
                                          * Downloaded Frm : www.wapscripts.info
                                         * Free Wapscripts,Cheap Translated Script
                                        * Live Support- (c)Powered by www.wapscripts.info

                              \*=========================================================*/
// include Pager class
      require_once 'Pager/Pager.php';
      $params = array(
          'mode'       => 'Jumping',
          'perPage'    => 5,
          'delta'      => 5,
          'totalItems' => $total,
      );
      $pager = & Pager::factory($params);
      $links = $pager->getLinks();  
      // print page links

echo "<div class=\"shout\">";
      echo $links['all'];
echo"</div>";
?>


<div class="catchtubebeta1">Menu</div>
<div class="menu3">
<a href="categories.php">Danh mục chính</a> |
<a href="most_recent.php">Mới nhất</a> |
<a href="recently_featured.php">Trong tuần</a> |
<a href="most_viewed.php">Xem nhiều</a> |
<a href="top_favorites.php">Yêu thích</a> |
<a href="top_rated.php">Bảng xếp hạng</a>
</div>
</body>
</html>
<?php
include '../foot.php'; 
?>