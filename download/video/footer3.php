<div class="shout">Tìm kiếm</div>
<form method="get" action="search.php">
<div class="menu3">
      Tìm kiếm: <br/>
      <input type="text" name="vq" /><br />
     
      Sắp xếp theo: 
      <select name="s">
        <option value="viewCount">Lượt xem</option>
        <option value="rating">Lượt đánh giá</option>
        <option value="published">Mới nhất</option>
      </select>
      <br/>
      <input type="submit" name="submit" value="Search"/> 
</div> 

<div class="catchtubebeta1">Menu</div>
<div class="menu3">
<a href="categories.php">Danh mục chính</a> |
<a href="most_recent.php">Mới nhất</a> |
<a href="recently_featured.php">Trong tuồn</a> |
<a href="most_viewed.php">Xem nhiều</a> |
<a href="top_favorites.php">Top Yêu thích</a> |
<a href="top_rated.php">Bảng xếp hạng</a>
</div>
</body>
</html>
<?php
include '../foot.php'; 
?>