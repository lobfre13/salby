<?php foreach($this->categories as $category) { ?>
<div class="category" onclick="loadCategoryContent(<?php echo $category['id']?>)" style="background-image: url('<?php echo $category['imgurl']; ?>')"><?php echo $category['category'] ;?></div>

<?php } ?>