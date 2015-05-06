<?php foreach($this->categories as $category) { ?>
    <div class="category" onclick="loadCategoryContent(<?php echo $category['id']?>)" style="background-image: url('<?php echo $category['imgurl']; ?>')"><div class="categoryname"><?php echo $category['category'] ;?></div></div>

<?php } ?>