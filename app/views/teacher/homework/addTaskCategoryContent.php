<?php foreach($this->categoryContent as $content) { ?>
    <div onclick="<?php if(isset($content['category'])) echo 'loadCategoryContent('.$content['id'].')'; else echo 'addTask('.$content['id'].')'; ?>" class="category" style="background-image: url(<?php echo $content['imgurl']; ?>)">
        <h4 class="categoryname"><?php if(isset($content['category'])) echo $content['category']; else echo $content['title'];?></h4>
    </div>
<?php } ?>